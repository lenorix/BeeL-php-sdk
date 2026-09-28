<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;
class V1CompaniesCompanyIdVerifactuConfigurationPutResponse200 implements AdditionalPropertiesInterface
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
     * VeriFactu configuration as resolved by the server. **Response only** — the update body is
     * `UpdateVeriFactuConfigurationRequest`, which carries just `enabled`.
     * 
     *
     * @var VeriFactuConfiguration
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
     * VeriFactu configuration as resolved by the server. **Response only** — the update body is
     * `UpdateVeriFactuConfigurationRequest`, which carries just `enabled`.
     * 
     *
     * @return VeriFactuConfiguration
     */
    public function getData(): VeriFactuConfiguration
    {
        return $this->data;
    }
    /**
    * VeriFactu configuration as resolved by the server. **Response only** — the update body is
    `UpdateVeriFactuConfigurationRequest`, which carries just `enabled`.
    
    *
    * @param VeriFactuConfiguration $data
    *
    * @return self
    */
    public function setData(VeriFactuConfiguration $data): self
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