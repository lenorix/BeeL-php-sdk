<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;
class CompanyResponse implements AdditionalPropertiesInterface
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
     * @var bool
     */
    protected $success;
    /**
     * A company owned by the account.
     * 
     * Its status is described by **two independent axes** — do not conflate them:
     * 
     * * **Mode activation** (`in_test` / `in_prod`) — which modes this NIF is
     *   activated in, matching the dashboard's Test/Live switch. A company is a
     *   single env-agnostic record — there is no Test copy and no Live copy of it;
     *   what is per-mode is the *activation*, and a NIF can be activated in Test, in
     *   Live, in both, or in neither. It decides where invoices and quota are
     *   accounted, NOT whether they reach AEAT.
     * * **AEAT emission capability** (`account_state`, `verifactu_status`, and the
     *   `readiness` block requested with `?include=readiness`) — whether invoices are
     *   submitted to AEAT with a signed VeriFactu representation.
     * 
     * A company can bill in the **Live** mode and still have AEAT emission disabled
     * (e.g. before the VeriFactu representation is signed). `TEST_ONLY` /
     * `in_prod=false` therefore do **not** mean "this account cannot invoice".
     * 
     * **Every field `PATCH /v1/companies/{company_id}` accepts is read back here** — same
     * names, same types as `UpdateCompanyRequest`. A field with no value is absent, which
     * means "nothing stored", never "hidden from you": the field set does not depend on who
     * asks (owner, member with `VIEW`, API key or the managed twin
     * `GET /v1/accounts/{account_id}/companies` all see the same one).
     * 
     *
     * @var CompanyData
     */
    protected $data;
    /**
     * @var ResponseMeta
     */
    protected $meta;
    /**
     * @return bool
     */
    public function getSuccess(): bool
    {
        return $this->success;
    }
    /**
     * @param bool $success
     *
     * @return self
     */
    public function setSuccess(bool $success): self
    {
        $this->initialized['success'] = true;
        $this->success = $success;
        return $this;
    }
    /**
     * A company owned by the account.
     * 
     * Its status is described by **two independent axes** — do not conflate them:
     * 
     * * **Mode activation** (`in_test` / `in_prod`) — which modes this NIF is
     *   activated in, matching the dashboard's Test/Live switch. A company is a
     *   single env-agnostic record — there is no Test copy and no Live copy of it;
     *   what is per-mode is the *activation*, and a NIF can be activated in Test, in
     *   Live, in both, or in neither. It decides where invoices and quota are
     *   accounted, NOT whether they reach AEAT.
     * * **AEAT emission capability** (`account_state`, `verifactu_status`, and the
     *   `readiness` block requested with `?include=readiness`) — whether invoices are
     *   submitted to AEAT with a signed VeriFactu representation.
     * 
     * A company can bill in the **Live** mode and still have AEAT emission disabled
     * (e.g. before the VeriFactu representation is signed). `TEST_ONLY` /
     * `in_prod=false` therefore do **not** mean "this account cannot invoice".
     * 
     * **Every field `PATCH /v1/companies/{company_id}` accepts is read back here** — same
     * names, same types as `UpdateCompanyRequest`. A field with no value is absent, which
     * means "nothing stored", never "hidden from you": the field set does not depend on who
     * asks (owner, member with `VIEW`, API key or the managed twin
     * `GET /v1/accounts/{account_id}/companies` all see the same one).
     * 
     *
     * @return CompanyData
     */
    public function getData(): CompanyData
    {
        return $this->data;
    }
    /**
    * A company owned by the account.
    
    Its status is described by **two independent axes** — do not conflate them:
    
    * **Mode activation** (`in_test` / `in_prod`) — which modes this NIF is
     activated in, matching the dashboard's Test/Live switch. A company is a
     single env-agnostic record — there is no Test copy and no Live copy of it;
     what is per-mode is the *activation*, and a NIF can be activated in Test, in
     Live, in both, or in neither. It decides where invoices and quota are
     accounted, NOT whether they reach AEAT.
    * **AEAT emission capability** (`account_state`, `verifactu_status`, and the
     `readiness` block requested with `?include=readiness`) — whether invoices are
     submitted to AEAT with a signed VeriFactu representation.
    
    A company can bill in the **Live** mode and still have AEAT emission disabled
    (e.g. before the VeriFactu representation is signed). `TEST_ONLY` /
    `in_prod=false` therefore do **not** mean "this account cannot invoice".
    
    **Every field `PATCH /v1/companies/{company_id}` accepts is read back here** — same
    names, same types as `UpdateCompanyRequest`. A field with no value is absent, which
    means "nothing stored", never "hidden from you": the field set does not depend on who
    asks (owner, member with `VIEW`, API key or the managed twin
    `GET /v1/accounts/{account_id}/companies` all see the same one).
    
    *
    * @param CompanyData $data
    *
    * @return self
    */
    public function setData(CompanyData $data): self
    {
        $this->initialized['data'] = true;
        $this->data = $data;
        return $this;
    }
    /**
     * @return ResponseMeta
     */
    public function getMeta(): ResponseMeta
    {
        return $this->meta;
    }
    /**
     * @param ResponseMeta $meta
     *
     * @return self
     */
    public function setMeta(ResponseMeta $meta): self
    {
        $this->initialized['meta'] = true;
        $this->meta = $meta;
        return $this;
    }
    public function definedProperties(): array
    {
        return ['success' => ['success', 'getSuccess', 'setSuccess'], 'data' => ['data', 'getData', 'setData'], 'meta' => ['meta', 'getMeta', 'setMeta']];
    }
}