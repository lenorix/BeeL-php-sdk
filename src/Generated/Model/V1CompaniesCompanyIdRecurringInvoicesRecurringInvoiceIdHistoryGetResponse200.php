<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;
class V1CompaniesCompanyIdRecurringInvoicesRecurringInvoiceIdHistoryGetResponse200 implements AdditionalPropertiesInterface
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
     * @var V1CompaniesCompanyIdRecurringInvoicesRecurringInvoiceIdHistoryGetResponse200Data
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
     * @return V1CompaniesCompanyIdRecurringInvoicesRecurringInvoiceIdHistoryGetResponse200Data
     */
    public function getData(): V1CompaniesCompanyIdRecurringInvoicesRecurringInvoiceIdHistoryGetResponse200Data
    {
        return $this->data;
    }
    /**
     * @param V1CompaniesCompanyIdRecurringInvoicesRecurringInvoiceIdHistoryGetResponse200Data $data
     *
     * @return self
     */
    public function setData(V1CompaniesCompanyIdRecurringInvoicesRecurringInvoiceIdHistoryGetResponse200Data $data): self
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