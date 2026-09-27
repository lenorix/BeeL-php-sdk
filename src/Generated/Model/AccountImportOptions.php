<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;

class AccountImportOptions implements AdditionalPropertiesInterface
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
     * The access you keep over every account of this file. Defaults to `OPERATE` — not to `NONE` as in `POST /v1/accounts`, and the difference is deliberate: a file-driven import is re-run to reconcile what is missing, and reconciling an account's series and customers is a write that `VIEW` cannot do. An account you already manage with less than this is reported `BLOCKED` and skipped: once its holder has claimed it, only they can raise your access again.
     *
     * @var string
     */
    protected $accessLevel;

    /**
     * Invoice series every account must end up with, declared once. Each entry is a `CreateSeriesRequest` exactly as `POST /v1/companies/{company_id}/series` takes it, with one addition: the token `{REF}` in `name` and `format` is replaced with the row's `external_ref` **before** the series is created, which is how a single declaration numbers every account distinguishably. `{REF}` is vocabulary of this endpoint only — what reaches the series is a literal format, so nothing downstream has to learn a new variable. A row whose `external_ref` would produce a format outside the series grammar (uppercase letters, digits, `-`, `_`, `/`, `:`) is reported and its series left alone.
     *
     * Leave it out and each account keeps the default series its activation seeds.
     *
     * @var list<CreateSeriesRequest>
     */
    protected $series;

    /**
     * Load the shared customers file into **your own** company too, not only into the managed accounts the file describes. Off by default: an import of accounts writes on the accounts it imports, and a file that quietly also wrote on your own customers would be a surprise nobody asked for.
     *
     * **Your own company is the one in focus for this request** — the same one every company-scoped write of the API uses, and never one this endpoint picks for you. With several NIFs and none in focus the whole import is refused with `403` `ACTIVE_COMPANY_REQUIRED`, decided **before the files are read**: no account is provisioned and nothing is billed. Sending the option without `customers_file` is a `422`, decided in the same place — there is nothing to apply.
     *
     * With an API key it needs `customers:write` on top of the `accounts:write` the operation already requires. It writes customers; a key that may not write customers must not get to through an accounts import. A dashboard session is governed by the role's capabilities over the company in focus, as everywhere else.
     *
     * What it did comes back in `own_company_customers`, apart from the per-account counters.
     *
     * @var bool
     */
    protected $applyCustomersToOwnCompany = false;

    /**
     * The access you keep over every account of this file. Defaults to `OPERATE` — not to `NONE` as in `POST /v1/accounts`, and the difference is deliberate: a file-driven import is re-run to reconcile what is missing, and reconciling an account's series and customers is a write that `VIEW` cannot do. An account you already manage with less than this is reported `BLOCKED` and skipped: once its holder has claimed it, only they can raise your access again.
     */
    public function getAccessLevel(): string
    {
        return $this->accessLevel;
    }

    /**
     * The access you keep over every account of this file. Defaults to `OPERATE` — not to `NONE` as in `POST /v1/accounts`, and the difference is deliberate: a file-driven import is re-run to reconcile what is missing, and reconciling an account's series and customers is a write that `VIEW` cannot do. An account you already manage with less than this is reported `BLOCKED` and skipped: once its holder has claimed it, only they can raise your access again.
     */
    public function setAccessLevel(string $accessLevel): self
    {
        $this->initialized['accessLevel'] = true;
        $this->accessLevel = $accessLevel;

        return $this;
    }

    /**
     * Invoice series every account must end up with, declared once. Each entry is a `CreateSeriesRequest` exactly as `POST /v1/companies/{company_id}/series` takes it, with one addition: the token `{REF}` in `name` and `format` is replaced with the row's `external_ref` **before** the series is created, which is how a single declaration numbers every account distinguishably. `{REF}` is vocabulary of this endpoint only — what reaches the series is a literal format, so nothing downstream has to learn a new variable. A row whose `external_ref` would produce a format outside the series grammar (uppercase letters, digits, `-`, `_`, `/`, `:`) is reported and its series left alone.
     *
     * Leave it out and each account keeps the default series its activation seeds.
     *
     * @return list<CreateSeriesRequest>
     */
    public function getSeries(): array
    {
        return $this->series;
    }

    /**
     * Invoice series every account must end up with, declared once. Each entry is a `CreateSeriesRequest` exactly as `POST /v1/companies/{company_id}/series` takes it, with one addition: the token `{REF}` in `name` and `format` is replaced with the row's `external_ref` **before** the series is created, which is how a single declaration numbers every account distinguishably. `{REF}` is vocabulary of this endpoint only — what reaches the series is a literal format, so nothing downstream has to learn a new variable. A row whose `external_ref` would produce a format outside the series grammar (uppercase letters, digits, `-`, `_`, `/`, `:`) is reported and its series left alone.

    Leave it out and each account keeps the default series its activation seeds.
     *
     * @param  list<CreateSeriesRequest>  $series
     */
    public function setSeries(array $series): self
    {
        $this->initialized['series'] = true;
        $this->series = $series;

        return $this;
    }

    /**
     * Load the shared customers file into **your own** company too, not only into the managed accounts the file describes. Off by default: an import of accounts writes on the accounts it imports, and a file that quietly also wrote on your own customers would be a surprise nobody asked for.
     *
     * **Your own company is the one in focus for this request** — the same one every company-scoped write of the API uses, and never one this endpoint picks for you. With several NIFs and none in focus the whole import is refused with `403` `ACTIVE_COMPANY_REQUIRED`, decided **before the files are read**: no account is provisioned and nothing is billed. Sending the option without `customers_file` is a `422`, decided in the same place — there is nothing to apply.
     *
     * With an API key it needs `customers:write` on top of the `accounts:write` the operation already requires. It writes customers; a key that may not write customers must not get to through an accounts import. A dashboard session is governed by the role's capabilities over the company in focus, as everywhere else.
     *
     * What it did comes back in `own_company_customers`, apart from the per-account counters.
     */
    public function getApplyCustomersToOwnCompany(): bool
    {
        return $this->applyCustomersToOwnCompany;
    }

    /**
     * Load the shared customers file into **your own** company too, not only into the managed accounts the file describes. Off by default: an import of accounts writes on the accounts it imports, and a file that quietly also wrote on your own customers would be a surprise nobody asked for.

     **Your own company is the one in focus for this request** — the same one every company-scoped write of the API uses, and never one this endpoint picks for you. With several NIFs and none in focus the whole import is refused with `403` `ACTIVE_COMPANY_REQUIRED`, decided **before the files are read**: no account is provisioned and nothing is billed. Sending the option without `customers_file` is a `422`, decided in the same place — there is nothing to apply.

    With an API key it needs `customers:write` on top of the `accounts:write` the operation already requires. It writes customers; a key that may not write customers must not get to through an accounts import. A dashboard session is governed by the role's capabilities over the company in focus, as everywhere else.

    What it did comes back in `own_company_customers`, apart from the per-account counters.
     */
    public function setApplyCustomersToOwnCompany(bool $applyCustomersToOwnCompany): self
    {
        $this->initialized['applyCustomersToOwnCompany'] = true;
        $this->applyCustomersToOwnCompany = $applyCustomersToOwnCompany;

        return $this;
    }

    public function definedProperties(): array
    {
        return ['accessLevel' => ['access_level', 'getAccessLevel', 'setAccessLevel'], 'series' => ['series', 'getSeries', 'setSeries'], 'applyCustomersToOwnCompany' => ['apply_customers_to_own_company', 'getApplyCustomersToOwnCompany', 'setApplyCustomersToOwnCompany']];
    }
}
