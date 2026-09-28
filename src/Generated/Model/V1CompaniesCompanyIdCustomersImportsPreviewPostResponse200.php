<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;
class V1CompaniesCompanyIdCustomersImportsPreviewPostResponse200 implements AdditionalPropertiesInterface
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
     * Unified format for customer validation results.
     * Used for bulk validation (JSON), CSV import and Holded Excel import.
     * 
     * One shape for every bulk and import outcome, so a caller reads a batch creation, a CSV
     * import and a Holded import the same way.
     * 
     *
     * @var CustomerValidationUnifiedResult
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
     * Unified format for customer validation results.
     * Used for bulk validation (JSON), CSV import and Holded Excel import.
     * 
     * One shape for every bulk and import outcome, so a caller reads a batch creation, a CSV
     * import and a Holded import the same way.
     * 
     *
     * @return CustomerValidationUnifiedResult
     */
    public function getData(): CustomerValidationUnifiedResult
    {
        return $this->data;
    }
    /**
    * Unified format for customer validation results.
    Used for bulk validation (JSON), CSV import and Holded Excel import.
    
    One shape for every bulk and import outcome, so a caller reads a batch creation, a CSV
    import and a Holded import the same way.
    
    *
    * @param CustomerValidationUnifiedResult $data
    *
    * @return self
    */
    public function setData(CustomerValidationUnifiedResult $data): self
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