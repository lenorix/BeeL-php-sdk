<?php

declare(strict_types=1);

namespace Lenorix\BeelSdk\Resource;

use Lenorix\BeelSdk\Exception\BeelApiError;
use Lenorix\BeelSdk\Generated\Client;
use Lenorix\BeelSdk\Generated\Model\ErrorResponse;
use Lenorix\BeelSdk\Http\ResponseContext;
use Throwable;

/** Shared error mapping and response unwrapping for resources that call Jane directly. */
abstract readonly class GeneratedResource
{
    public function __construct(
        protected Client $client,
        protected ?ResponseContext $responseContext = null,
    ) {}

    /** Run one generated endpoint call and unwrap its generated response envelope. */
    protected function execute(callable $operation): mixed
    {
        $this->responseContext?->reset();

        try {
            $response = $operation();
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

    private function unwrap(mixed $response): mixed
    {
        if (is_object($response) && method_exists($response, 'getData')) {
            return $response->getData();
        }

        return $response;
    }
}
