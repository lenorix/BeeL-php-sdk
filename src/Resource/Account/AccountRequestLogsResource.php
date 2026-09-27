<?php

declare(strict_types=1);

namespace Lenorix\BeelSdk\Resource\Account;

use Lenorix\BeelSdk\Generated\Client;
use Lenorix\BeelSdk\Generated\Model\RequestLogDetail;
use Lenorix\BeelSdk\Generated\Model\RequestLogListResponseData;
use Lenorix\BeelSdk\Generated\Model\RequestLogSummary;
use Lenorix\BeelSdk\Http\ResponseContext;
use Lenorix\BeelSdk\Resource\GeneratedResource;

/** The history of API requests made to this account, for debugging. */
final readonly class AccountRequestLogsResource extends GeneratedResource
{
    public function __construct(Client $client, private string $accountId, ?ResponseContext $responseContext = null)
    {
        parent::__construct($client, $responseContext);
    }

    /**
     * List request logs, newest first.
     *
     * @param  array<string, mixed>  $query  Filters such as `only_errors`, `method`, `http_status`, `from`, `to`, `cursor` and `limit`.
     *
     * @see https://docs.beel.es/request-logs/listAccountRequestLogs
     */
    public function list(array $query = []): RequestLogListResponseData
    {
        return $this->execute(fn () => $this->client->listAccountRequestLogs($this->accountId, $query));
    }

    /**
     * Iterate over all matching request logs, following `next_cursor` lazily.
     *
     * @param  array<string, mixed>  $query  The same filters as `list()`.
     * @return \Generator<int, RequestLogSummary>
     */
    public function all(array $query = []): \Generator
    {
        return $this->paginateCursor(
            fn (array $query): RequestLogListResponseData => $this->list($query),
            static fn (RequestLogListResponseData $page): array => $page->getRequestLogs(),
            static fn (RequestLogListResponseData $page): ?string => $page->isInitialized('pagination') ? $page->getPagination()->getNextCursor() : null,
            $query,
        );
    }

    /**
     * Retrieve one request log with its request and response details.
     *
     * @param  array<string, mixed>  $query  Options such as `timestamp`, which speeds up the lookup.
     *
     * @see https://docs.beel.es/request-logs/getAccountRequestLog
     */
    public function get(string $requestId, array $query = []): RequestLogDetail
    {
        return $this->execute(fn () => $this->client->getAccountRequestLog($this->accountId, $requestId, $query));
    }
}
