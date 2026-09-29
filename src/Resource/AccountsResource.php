<?php

declare(strict_types=1);

namespace Lenorix\BeelSdk\Resource;

use Lenorix\BeelSdk\Generated\Model\AccountImportResult;
use Lenorix\BeelSdk\Generated\Model\AccountImportUpload;
use Lenorix\BeelSdk\Generated\Model\ManagedAccountSummary;
use Lenorix\BeelSdk\Generated\Model\ProvisionAccountRequest;
use Lenorix\BeelSdk\Generated\Model\ProvisionAccountResult;
use Lenorix\BeelSdk\Generated\Model\V1AccountsGetResponse200Data;

final readonly class AccountsResource extends GeneratedResource
{
    public function scope(string $accountId): AccountScope
    {
        return $this->inheritOptions(new AccountScope($this->client, $accountId, $this->responseContext));
    }

    /**
     * @param  array<string, mixed>  $query
     */
    public function list(array $query = []): V1AccountsGetResponse200Data
    {
        return $this->execute(fn () => $this->client->listAccounts($query));
    }

    /**
     * Iterate over all accounts, across every page.
     *
     * Pages are fetched lazily while you iterate by following `next_cursor`.
     * Filters and `limit` apply to every page.
     *
     * @param  array<string, mixed>  $query  The same filters as `list()`.
     * @return \Generator<int, ManagedAccountSummary>
     */
    public function all(array $query = []): \Generator
    {
        return $this->paginateCursor(
            fn (array $query): V1AccountsGetResponse200Data => $this->list($query),
            static fn (V1AccountsGetResponse200Data $page): array => $page->getAccounts(),
            static fn (V1AccountsGetResponse200Data $page): ?string => $page->isInitialized('nextCursor') ? $page->getNextCursor() : null,
            $query,
        );
    }

    /**
     * @param  ProvisionAccountRequest|array<string, mixed>  $request  The request as a model or as an array in API format.
     */
    public function provision(ProvisionAccountRequest|array $request): ProvisionAccountResult
    {
        $request = $this->model($request, ProvisionAccountRequest::class);

        return $this->execute(fn () => $this->client->provisionAccount($request));
    }

    public function get(string $accountId): ManagedAccountSummary
    {
        return $this->execute(fn () => $this->client->getAccount($accountId));
    }

    /**
     * Import managed accounts in bulk from CSV files, sent as `multipart/form-data`.
     *
     * @param  AccountImportUpload|array<string, mixed>  $request  The request as a model or as an array in API format, with `accounts_file` and optionally `customers_file` and `options`.
     * @param  array<string, mixed>  $headers  Request headers. BeeL requires an `Idempotency-Key`: without one here or in `withOptions()`, a new one is sent.
     *
     * @see https://docs.beel.es/accounts/createAccountImport
     */
    public function import(AccountImportUpload|array $request, array $headers = []): AccountImportResult
    {
        $request = $this->model($request, AccountImportUpload::class);

        return $this->execute(fn () => $this->client->createAccountImport($request, $this->withIdempotencyKey($headers)));
    }

    /**
     * Validate an account import without creating anything.
     *
     * @param  AccountImportUpload|array<string, mixed>  $request  The request as a model or as an array in API format.
     *
     * @see https://docs.beel.es/accounts/previewAccountImport
     */
    public function previewImport(AccountImportUpload|array $request): AccountImportResult
    {
        $request = $this->model($request, AccountImportUpload::class);

        return $this->execute(fn () => $this->client->previewAccountImport($request));
    }
}
