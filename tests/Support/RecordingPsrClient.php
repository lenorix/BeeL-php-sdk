<?php

declare(strict_types=1);

namespace Lenorix\BeelSdk\Tests\Support;

use LogicException;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

final class RecordingPsrClient implements ClientInterface
{
    /** @var list<RequestInterface> */
    public array $requests = [];

    /** @param list<ResponseInterface|\Throwable> $responses Answers in order; a Throwable is thrown instead, such as a connection error. */
    public function __construct(private array $responses) {}

    public function sendRequest(RequestInterface $request): ResponseInterface
    {
        $this->requests[] = $request;

        $response = array_shift($this->responses);
        if ($response === null) {
            throw new LogicException(sprintf(
                'Unexpected HTTP request in test: %s %s',
                $request->getMethod(),
                (string) $request->getUri(),
            ));
        }

        if ($response instanceof \Throwable) {
            throw $response;
        }

        return $response;
    }
}
