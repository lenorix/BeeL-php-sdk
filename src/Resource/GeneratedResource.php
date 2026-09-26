<?php

declare(strict_types=1);

namespace Lenorix\BeelSdk\Resource;

use Lenorix\BeelSdk\Exception\BeelApiError;
use Lenorix\BeelSdk\Exception\BeelNotReadyError;
use Lenorix\BeelSdk\Generated\Client;
use Lenorix\BeelSdk\Generated\Model\ErrorResponse;
use Lenorix\BeelSdk\Http\RequestOptions;
use Lenorix\BeelSdk\Http\RequestOptionsSlot;
use Lenorix\BeelSdk\Http\ResponseContext;
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

            if ($batch === [] || ! $this->hasNextPage($response)) {
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

    /** Run one generated endpoint call and unwrap its generated response envelope. */
    protected function execute(callable $operation): mixed
    {
        $this->responseContext?->reset();

        try {
            $response = $this->responseContext === null
                ? $operation()
                : $this->responseContext->withRequestOptions($this->options(), $operation);
        } catch (Throwable $exception) {
            throw BeelApiError::fromGenerated($exception);
        }

        if ($response instanceof ErrorResponse) {
            throw BeelApiError::fromErrorResponse(
                $response,
                $this->responseContext?->response(),
                $this->responseContext?->body(),
            );
        }

        return $this->unwrap($response);
    }

    /**
     * Run an operation that BeeL may answer with `202` while the result is still being generated.
     *
     * @throws BeelNotReadyError If BeeL answers `202`, with its `Retry-After` in seconds.
     */
    protected function executeReady(callable $operation, string $notReadyMessage): mixed
    {
        $result = $this->execute($operation);
        $response = $this->responseContext?->response();
        if ($response === null || $response->getStatusCode() !== 202) {
            return $result;
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
