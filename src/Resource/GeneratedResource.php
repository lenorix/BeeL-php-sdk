<?php

declare(strict_types=1);

namespace Lenorix\BeelSdk\Resource;

use Lenorix\BeelSdk\Exception\BeelApiError;
use Lenorix\BeelSdk\Exception\BeelNotReadyError;
use Lenorix\BeelSdk\Exception\BeelUnexpectedResponseError;
use Lenorix\BeelSdk\Generated\Client;
use Lenorix\BeelSdk\Generated\Model\ErrorResponse;
use Lenorix\BeelSdk\Generated\Runtime\Client\Endpoint;
use Lenorix\BeelSdk\Http\RequestOptions;
use Lenorix\BeelSdk\Http\RequestOptionsSlot;
use Lenorix\BeelSdk\Http\ResponseContext;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\Serializer\Exception\NotEncodableValueException;
use Throwable;

/** Shared error mapping and response unwrapping for resources that call Jane directly. */
abstract readonly class GeneratedResource
{
    private RequestOptionsSlot $requestOptions;

    public function __construct(
        protected Client $client,
        protected ?ResponseContext $responseContext = null,
    ) {
        $this->requestOptions = new RequestOptionsSlot;
    }

    /**
     * Return a copy of this resource that sends the given options with each request.
     *
     * The copy's child resources (for example `$company->withOptions(...)->invoices`)
     * use the same options; this instance is left unchanged. An idempotency key is
     * sent on every request made through the copy, so scope it to a single write:
     * `$company->invoices->withOptions(new RequestOptions(idempotencyKey: 'order-42'))->create($request)`.
     * These options take precedence over headers passed as method arguments.
     */
    public function withOptions(RequestOptions $options): static
    {
        if ($this->responseContext === null) {
            throw new \LogicException('Request options need a resource created by a Beel client.');
        }

        $copy = clone $this;
        $copy->applyOptions($options);

        return $copy;
    }

    public function __clone()
    {
        $this->requestOptions = new RequestOptionsSlot;
        foreach (get_object_vars($this) as $name => $value) {
            if ($value instanceof self) {
                $this->{$name} = clone $value;
            }
        }
    }

    /** Options this instance sends with each request, if any. */
    protected function options(): ?RequestOptions
    {
        return $this->requestOptions->options;
    }

    /**
     * Give a resource created on demand the same request options as this one.
     *
     * @template T of GeneratedResource
     *
     * @param  T  $resource
     * @return T
     */
    protected function inheritOptions(self $resource): self
    {
        $options = $this->options();

        return $options === null ? $resource : $resource->withOptions($options);
    }

    /**
     * Lazily yield every item of a page-numbered list, fetching each page when it is reached.
     *
     * Starts at `$query['page']` (default 1) and keeps the other query options,
     * including `limit`, for every page.
     *
     * @template TPage of object
     * @template TItem
     *
     * @param  callable(array<string, mixed>): TPage  $fetchPage  Fetches one page for a query.
     * @param  callable(TPage): list<TItem>  $items  Returns the items of a fetched page.
     * @param  array<string, mixed>  $query
     * @return \Generator<int, TItem>
     */
    protected function paginate(callable $fetchPage, callable $items, array $query): \Generator
    {
        $page = max(1, (int) ($query['page'] ?? 1));

        while (true) {
            $response = $fetchPage([...$query, 'page' => $page]);
            $batch = $items($response);
            foreach ($batch as $item) {
                yield $item;
            }

            $reportedPage = $this->reportedPage($response);
            if ($batch === [] || ! $this->hasNextPage($response) || ($reportedPage !== null && $reportedPage !== $page)) {
                return;
            }
            $page++;
        }
    }

    /**
     * Lazily yield every item of a cursor-paginated list.
     *
     * @template TPage of object
     * @template TItem
     *
     * @param  callable(array<string, mixed>): TPage  $fetchPage  Fetches one page for a query.
     * @param  callable(TPage): list<TItem>  $items  Returns the items of a fetched page.
     * @param  callable(TPage): ?string  $nextCursor  Returns the cursor of the next page, or null on the last one.
     * @param  array<string, mixed>  $query
     * @return \Generator<int, TItem>
     */
    protected function paginateCursor(callable $fetchPage, callable $items, callable $nextCursor, array $query): \Generator
    {
        while (true) {
            $response = $fetchPage($query);
            $batch = $items($response);
            foreach ($batch as $item) {
                yield $item;
            }

            $cursor = $nextCursor($response);
            if ($batch === [] || $cursor === null || $cursor === '' || $cursor === ($query['cursor'] ?? null)) {
                return;
            }
            $query['cursor'] = $cursor;
        }
    }

    /**
     * Run one generated endpoint call and unwrap its generated response envelope.
     *
     * @throws BeelUnexpectedResponseError If BeeL answers a success status with nothing the SDK can read.
     */
    protected function execute(callable $operation): mixed
    {
        return $this->unwrap($this->requireBody($this->call($operation)));
    }

    /** Run one generated endpoint call whose success, usually a `204`, carries no body to return. */
    protected function executeVoid(callable $operation): void
    {
        $this->call($operation);
    }

    /** Run one generated endpoint call and map every failure; the result may be null when nothing was read. */
    private function call(callable $operation): mixed
    {
        $this->responseContext?->reset();

        try {
            $response = $this->responseContext === null
                ? $operation()
                : $this->responseContext->withRequestOptions($this->options(), $operation);
        } catch (NotEncodableValueException $exception) {
            // A JSON Content-Type with a body that is not JSON, such as an empty one or a proxy's error page.
            $httpResponse = $this->responseContext?->response();
            if ($httpResponse !== null && $httpResponse->getStatusCode() >= 400) {
                throw BeelApiError::fromErrorResponse(new ErrorResponse, $httpResponse, $this->responseContext->body());
            }

            throw $this->unreadable($exception) ?? BeelApiError::fromGenerated($exception);
        } catch (Throwable $exception) {
            throw BeelApiError::fromGenerated($exception);
        }

        $httpResponse = $this->responseContext?->response();
        // An error status the operation does not declare (such as an empty 503 from a proxy) comes back
        // as null, and is read from its body here. A client generated with BeeL's `default` response,
        // which bin/prepare-openapi.php drops, returns an ErrorResponse for it instead.
        if ($httpResponse !== null && $httpResponse->getStatusCode() >= 400) {
            throw BeelApiError::fromErrorResponse(
                $response instanceof ErrorResponse ? $response : new ErrorResponse,
                $httpResponse,
                $this->responseContext->body(),
            );
        }

        return $response;
    }

    /**
     * Jane reads nothing (null) from a success status the operation does not declare or whose body is
     * not JSON, which an operation returning a model cannot turn into its result. A client generated
     * with BeeL's `default` response reads such a JSON body as an ErrorResponse instead: on a success
     * status, that would report a possible success as a failed request.
     */
    private function requireBody(mixed $response): mixed
    {
        if ($response === null || $response instanceof ErrorResponse) {
            $unreadable = $this->unreadable();
            if ($unreadable !== null) {
                throw $unreadable;
            }
            if ($response instanceof ErrorResponse) {
                // Without the HTTP response to tell a success from a failure, keep reporting the error.
                throw BeelApiError::fromErrorResponse($response);
            }
        }

        return $response;
    }

    /** The error for a success response the SDK could not read, or null when the last response was not a success. */
    private function unreadable(?Throwable $previous = null): ?BeelUnexpectedResponseError
    {
        $response = $this->responseContext?->response();
        if ($response === null || $response->getStatusCode() < 200 || $response->getStatusCode() >= 300) {
            return null;
        }

        return new BeelUnexpectedResponseError($response->getStatusCode(), $response->getHeaderLine('X-Request-Id') ?: null, $previous);
    }

    /**
     * Run an endpoint and return its HTTP response without letting Jane read the body.
     *
     * Use it for operations that return a file: the successful body is left unread for the
     * caller to stream. Responses outside `2xx` are mapped to {@see BeelApiError}.
     *
     * @param  bool|null  $retryServerErrors  Default for {@see RequestOptions::$retryServerErrors} when the caller sets none.
     *
     * @throws BeelApiError If BeeL answers outside `2xx`.
     */
    protected function executeRaw(Endpoint $endpoint, ?bool $retryServerErrors = null): ResponseInterface
    {
        if ($this->responseContext === null) {
            throw new \LogicException('Raw responses need a resource created by a Beel client.');
        }
        $this->responseContext->reset();
        $options = ($this->options() ?? new RequestOptions)->withDefaults($retryServerErrors);

        try {
            $response = $this->responseContext->withRequestOptions($options, fn (): ResponseInterface => $this->client->executeRawEndpoint($endpoint));
        } catch (Throwable $exception) {
            throw BeelApiError::fromGenerated($exception);
        }

        $status = $response->getStatusCode();
        if ($status >= 200 && $status < 300) {
            return $response;
        }

        // Error bodies are small JSON documents; read them from the response, which may not be seekable.
        throw BeelApiError::fromErrorResponse(new ErrorResponse, $response, (string) $response->getBody());
    }

    /**
     * Run an operation that BeeL may answer with `202` while the result is still being generated.
     *
     * @throws BeelNotReadyError If BeeL answers `202`, with its `Retry-After` in seconds.
     */
    protected function executeReady(callable $operation, string $notReadyMessage): mixed
    {
        $result = $this->call($operation);
        $response = $this->responseContext?->response();
        if ($response === null || $response->getStatusCode() !== 202) {
            return $this->unwrap($this->requireBody($result));
        }

        $retryAfter = trim($response->getHeaderLine('Retry-After'));
        $seconds = match (true) {
            ctype_digit($retryAfter) => (int) $retryAfter,
            $retryAfter !== '' && ($retryAt = strtotime($retryAfter)) !== false => max(0, $retryAt - time()),
            default => null,
        };

        throw new BeelNotReadyError($notReadyMessage, $seconds, $response->getHeaderLine('X-Request-Id') ?: null);
    }

    /**
     * Headers for BeeL's `Prefer: wait=N`, which bounds how long a request waits for an asynchronous result.
     *
     * @return array<string, string>
     */
    protected function preferWait(?int $waitSeconds): array
    {
        if ($waitSeconds === null) {
            return [];
        }
        if ($waitSeconds < 0) {
            throw new \InvalidArgumentException('Wait seconds must not be negative.');
        }

        return ['Prefer' => 'wait='.$waitSeconds];
    }

    private function applyOptions(RequestOptions $options): void
    {
        $this->requestOptions->options = $options;
        foreach (get_object_vars($this) as $value) {
            if ($value instanceof self) {
                $value->applyOptions($options);
            }
        }
    }

    /**
     * The page number BeeL says it answered, or null when it does not say.
     *
     * A server that ignored `page` would keep answering the same page with `has_next`;
     * comparing the two stops the iteration instead of looping forever.
     */
    private function reportedPage(object $response): ?int
    {
        if (! method_exists($response, 'isInitialized') || ! method_exists($response, 'getPagination') || ! $response->isInitialized('pagination')) {
            return null;
        }
        $pagination = $response->getPagination();

        return is_object($pagination) && method_exists($pagination, 'isInitialized') && method_exists($pagination, 'getCurrentPage')
            && $pagination->isInitialized('currentPage') ? (int) $pagination->getCurrentPage() : null;
    }

    /**
     * Read `has_next`, which BeeL may omit, and fall back to comparing page numbers.
     */
    private function hasNextPage(object $response): bool
    {
        if (! method_exists($response, 'isInitialized') || ! method_exists($response, 'getPagination') || ! $response->isInitialized('pagination')) {
            return false;
        }

        $pagination = $response->getPagination();
        if (! is_object($pagination) || ! method_exists($pagination, 'isInitialized')) {
            return false;
        }
        if ($pagination->isInitialized('hasNext') && method_exists($pagination, 'getHasNext')) {
            return (bool) $pagination->getHasNext();
        }
        if ($pagination->isInitialized('currentPage') && $pagination->isInitialized('totalPages')
            && method_exists($pagination, 'getCurrentPage') && method_exists($pagination, 'getTotalPages')) {
            return $pagination->getCurrentPage() < $pagination->getTotalPages();
        }

        return false;
    }

    private function unwrap(mixed $response): mixed
    {
        if (is_object($response) && method_exists($response, 'getData')) {
            return $response->getData();
        }

        return $response;
    }
}
