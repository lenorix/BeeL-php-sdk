<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;

class AccountImportItem implements AdditionalPropertiesInterface
{
    use AdditionalAndPatternProperties;

    /**
     * @var array
     */
    protected $initialized = [];

    public function isInitialized($property): bool
    {
        return array_key_exists($property, $this->initialized);
    }

    /**
     * Row number **as the spreadsheet counts it**: the header is row 1, so the first account is row 2. Not an index — the point is that you can open the file and go to that line.
     *
     * @var int
     */
    protected $rowNumber;

    /**
     * Your own id for the account; `null` when the row was too malformed to read it.
     *
     * @var string|null
     */
    protected $externalRef;

    /**
     * The row's tax id, normalised; `null` when it could not be read.
     *
     * @var string|null
     */
    protected $nif;

    /**
     * Outcome of one row. The same five values are used by the preview and by the import — the
     * preview reports what the import would reach — so no value tells you which operation
     * produced the payload; `metadata.is_dry_run` does.
     *
     * * `VALID` — complete and reachable. Provisioned by the import; would be by a preview.
     * * `WARNING` — the same, with non-blocking warnings.
     * * `ALREADY_EXISTS` — an account with this `external_ref` is already yours. A documented
     *   success, not a collision: provisioning is idempotent by `external_ref`, so nothing is
     *   created and nothing is billed again. On an import the row is still reconciled (Live,
     *   series, customers), which is what makes re-uploading the same file useful.
     * * `BLOCKED` — well formed but not executable. `errors` says why, and it is always something
     *   to resolve outside the file.
     * * `ERROR` — the row's own data is wrong. `errors` says which column.
     *
     *
     * @var string
     */
    protected $status;

    /**
     * Whether this row's NIF may be switched on in Live, decided exactly as `POST /v1/companies/{company_id}/activations` decides it. Anything other than `ENTITLED` blocks the row: the import never opens a checkout on your behalf. Absent when the row was rejected before reaching that question.
     *
     * @var string
     */
    protected $liveActivationVerdict;

    /**
     * The account this row produced — the same shape `POST /v1/accounts` returns, carrying `account_id`, `company_id` and the single-use `claim_token` / `claim_url` to hand to the holder. Absent in a preview (nothing was provisioned) and on a `BLOCKED` or `ERROR` row. On `ALREADY_EXISTS` it is the account that was already there. **The token is shown once**: store it, or re-issue it with `POST /v1/accounts/{account_id}/claim-tokens`.
     *
     * @var AccountImportItemAccount
     */
    protected $account;

    /**
     * What each declared series did on this account. Empty when the import declares none.
     *
     * @var list<AccountImportSeriesOutcome>
     */
    protected $series;

    /**
     * How the shared customers file landed on **this** account. Absent in a preview, and when no customers file was sent: whether a customer is new depends on the account, and that only shows up when the import runs.
     *
     * @var AccountImportItemCustomers
     */
    protected $customers;

    /**
     * What stops this row. A row with errors is never executed.
     *
     * @var list<AccountImportIssue>
     */
    protected $errors;

    /**
     * What you should know even though the row goes through.
     *
     * @var list<AccountImportIssue>
     */
    protected $warnings;

    /**
     * Row number **as the spreadsheet counts it**: the header is row 1, so the first account is row 2. Not an index — the point is that you can open the file and go to that line.
     */
    public function getRowNumber(): int
    {
        return $this->rowNumber;
    }

    /**
     * Row number **as the spreadsheet counts it**: the header is row 1, so the first account is row 2. Not an index — the point is that you can open the file and go to that line.
     */
    public function setRowNumber(int $rowNumber): self
    {
        $this->initialized['rowNumber'] = true;
        $this->rowNumber = $rowNumber;

        return $this;
    }

    /**
     * Your own id for the account; `null` when the row was too malformed to read it.
     */
    public function getExternalRef(): ?string
    {
        return $this->externalRef;
    }

    /**
     * Your own id for the account; `null` when the row was too malformed to read it.
     */
    public function setExternalRef(?string $externalRef): self
    {
        $this->initialized['externalRef'] = true;
        $this->externalRef = $externalRef;

        return $this;
    }

    /**
     * The row's tax id, normalised; `null` when it could not be read.
     */
    public function getNif(): ?string
    {
        return $this->nif;
    }

    /**
     * The row's tax id, normalised; `null` when it could not be read.
     */
    public function setNif(?string $nif): self
    {
        $this->initialized['nif'] = true;
        $this->nif = $nif;

        return $this;
    }

    /**
     * Outcome of one row. The same five values are used by the preview and by the import — the
     * preview reports what the import would reach — so no value tells you which operation
     * produced the payload; `metadata.is_dry_run` does.
     *
     * * `VALID` — complete and reachable. Provisioned by the import; would be by a preview.
     * * `WARNING` — the same, with non-blocking warnings.
     * * `ALREADY_EXISTS` — an account with this `external_ref` is already yours. A documented
     *   success, not a collision: provisioning is idempotent by `external_ref`, so nothing is
     *   created and nothing is billed again. On an import the row is still reconciled (Live,
     *   series, customers), which is what makes re-uploading the same file useful.
     * * `BLOCKED` — well formed but not executable. `errors` says why, and it is always something
     *   to resolve outside the file.
     * * `ERROR` — the row's own data is wrong. `errors` says which column.
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * Outcome of one row. The same five values are used by the preview and by the import — the
    preview reports what the import would reach — so no value tells you which operation
    produced the payload; `metadata.is_dry_run` does.

     * `VALID` — complete and reachable. Provisioned by the import; would be by a preview.
     * `WARNING` — the same, with non-blocking warnings.
     * `ALREADY_EXISTS` — an account with this `external_ref` is already yours. A documented
     success, not a collision: provisioning is idempotent by `external_ref`, so nothing is
     created and nothing is billed again. On an import the row is still reconciled (Live,
     series, customers), which is what makes re-uploading the same file useful.
     * `BLOCKED` — well formed but not executable. `errors` says why, and it is always something
     to resolve outside the file.
     * `ERROR` — the row's own data is wrong. `errors` says which column.
     */
    public function setStatus(string $status): self
    {
        $this->initialized['status'] = true;
        $this->status = $status;

        return $this;
    }

    /**
     * Whether this row's NIF may be switched on in Live, decided exactly as `POST /v1/companies/{company_id}/activations` decides it. Anything other than `ENTITLED` blocks the row: the import never opens a checkout on your behalf. Absent when the row was rejected before reaching that question.
     */
    public function getLiveActivationVerdict(): string
    {
        return $this->liveActivationVerdict;
    }

    /**
     * Whether this row's NIF may be switched on in Live, decided exactly as `POST /v1/companies/{company_id}/activations` decides it. Anything other than `ENTITLED` blocks the row: the import never opens a checkout on your behalf. Absent when the row was rejected before reaching that question.
     */
    public function setLiveActivationVerdict(string $liveActivationVerdict): self
    {
        $this->initialized['liveActivationVerdict'] = true;
        $this->liveActivationVerdict = $liveActivationVerdict;

        return $this;
    }

    /**
     * The account this row produced — the same shape `POST /v1/accounts` returns, carrying `account_id`, `company_id` and the single-use `claim_token` / `claim_url` to hand to the holder. Absent in a preview (nothing was provisioned) and on a `BLOCKED` or `ERROR` row. On `ALREADY_EXISTS` it is the account that was already there. **The token is shown once**: store it, or re-issue it with `POST /v1/accounts/{account_id}/claim-tokens`.
     */
    public function getAccount(): AccountImportItemAccount
    {
        return $this->account;
    }

    /**
     * The account this row produced — the same shape `POST /v1/accounts` returns, carrying `account_id`, `company_id` and the single-use `claim_token` / `claim_url` to hand to the holder. Absent in a preview (nothing was provisioned) and on a `BLOCKED` or `ERROR` row. On `ALREADY_EXISTS` it is the account that was already there. **The token is shown once**: store it, or re-issue it with `POST /v1/accounts/{account_id}/claim-tokens`.
     */
    public function setAccount(AccountImportItemAccount $account): self
    {
        $this->initialized['account'] = true;
        $this->account = $account;

        return $this;
    }

    /**
     * What each declared series did on this account. Empty when the import declares none.
     *
     * @return list<AccountImportSeriesOutcome>
     */
    public function getSeries(): array
    {
        return $this->series;
    }

    /**
     * What each declared series did on this account. Empty when the import declares none.
     *
     * @param  list<AccountImportSeriesOutcome>  $series
     */
    public function setSeries(array $series): self
    {
        $this->initialized['series'] = true;
        $this->series = $series;

        return $this;
    }

    /**
     * How the shared customers file landed on **this** account. Absent in a preview, and when no customers file was sent: whether a customer is new depends on the account, and that only shows up when the import runs.
     */
    public function getCustomers(): AccountImportItemCustomers
    {
        return $this->customers;
    }

    /**
     * How the shared customers file landed on **this** account. Absent in a preview, and when no customers file was sent: whether a customer is new depends on the account, and that only shows up when the import runs.
     */
    public function setCustomers(AccountImportItemCustomers $customers): self
    {
        $this->initialized['customers'] = true;
        $this->customers = $customers;

        return $this;
    }

    /**
     * What stops this row. A row with errors is never executed.
     *
     * @return list<AccountImportIssue>
     */
    public function getErrors(): array
    {
        return $this->errors;
    }

    /**
     * What stops this row. A row with errors is never executed.
     *
     * @param  list<AccountImportIssue>  $errors
     */
    public function setErrors(array $errors): self
    {
        $this->initialized['errors'] = true;
        $this->errors = $errors;

        return $this;
    }

    /**
     * What you should know even though the row goes through.
     *
     * @return list<AccountImportIssue>
     */
    public function getWarnings(): array
    {
        return $this->warnings;
    }

    /**
     * What you should know even though the row goes through.
     *
     * @param  list<AccountImportIssue>  $warnings
     */
    public function setWarnings(array $warnings): self
    {
        $this->initialized['warnings'] = true;
        $this->warnings = $warnings;

        return $this;
    }

    public function definedProperties(): array
    {
        return ['rowNumber' => ['row_number', 'getRowNumber', 'setRowNumber'], 'externalRef' => ['external_ref', 'getExternalRef', 'setExternalRef'], 'nif' => ['nif', 'getNif', 'setNif'], 'status' => ['status', 'getStatus', 'setStatus'], 'liveActivationVerdict' => ['live_activation_verdict', 'getLiveActivationVerdict', 'setLiveActivationVerdict'], 'account' => ['account', 'getAccount', 'setAccount'], 'series' => ['series', 'getSeries', 'setSeries'], 'customers' => ['customers', 'getCustomers', 'setCustomers'], 'errors' => ['errors', 'getErrors', 'setErrors'], 'warnings' => ['warnings', 'getWarnings', 'setWarnings']];
    }
}
