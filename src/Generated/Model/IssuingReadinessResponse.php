<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;

class IssuingReadinessResponse implements AdditionalPropertiesInterface
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
     * Issuing-readiness of a company: whether it can issue its STANDARD invoice
     * right now, in this environment, and — if not — exactly what is missing. `ready`
     * is true only when `blockers` is empty. Issuing any fiscal document requires the
     * company to be activated in that environment (`COMPANY_NOT_ACTIVATED` otherwise),
     * whether or not it goes to VeriFactu. The VeriFactu capability chain (census,
     * signature) is only demanded on top of that when the company is under the VeriFactu
     * regime in this environment — the same fact that decides, at issue time, whether its
     * invoices are registered. With VeriFactu off, a NIF, a default series and a live
     * activation are enough to be ready.
     *
     *
     * @var IssuingReadinessData
     */
    protected $data;

    /**
     * @var ResponseMeta
     */
    protected $meta;

    public function getSuccess(): bool
    {
        return $this->success;
    }

    public function setSuccess(bool $success): self
    {
        $this->initialized['success'] = true;
        $this->success = $success;

        return $this;
    }

    /**
     * Issuing-readiness of a company: whether it can issue its STANDARD invoice
     * right now, in this environment, and — if not — exactly what is missing. `ready`
     * is true only when `blockers` is empty. Issuing any fiscal document requires the
     * company to be activated in that environment (`COMPANY_NOT_ACTIVATED` otherwise),
     * whether or not it goes to VeriFactu. The VeriFactu capability chain (census,
     * signature) is only demanded on top of that when the company is under the VeriFactu
     * regime in this environment — the same fact that decides, at issue time, whether its
     * invoices are registered. With VeriFactu off, a NIF, a default series and a live
     * activation are enough to be ready.
     */
    public function getData(): IssuingReadinessData
    {
        return $this->data;
    }

    /**
     * Issuing-readiness of a company: whether it can issue its STANDARD invoice
    right now, in this environment, and — if not — exactly what is missing. `ready`
    is true only when `blockers` is empty. Issuing any fiscal document requires the
    company to be activated in that environment (`COMPANY_NOT_ACTIVATED` otherwise),
    whether or not it goes to VeriFactu. The VeriFactu capability chain (census,
    signature) is only demanded on top of that when the company is under the VeriFactu
    regime in this environment — the same fact that decides, at issue time, whether its
    invoices are registered. With VeriFactu off, a NIF, a default series and a live
    activation are enough to be ready.
     */
    public function setData(IssuingReadinessData $data): self
    {
        $this->initialized['data'] = true;
        $this->data = $data;

        return $this;
    }

    public function getMeta(): ResponseMeta
    {
        return $this->meta;
    }

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
