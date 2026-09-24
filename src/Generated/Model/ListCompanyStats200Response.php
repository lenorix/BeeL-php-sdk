<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;

class ListCompanyStats200Response implements AdditionalPropertiesInterface
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
     * @var ListCompanyStats200ResponseData
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

    public function getData(): ListCompanyStats200ResponseData
    {
        return $this->data;
    }

    public function setData(ListCompanyStats200ResponseData $data): self
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
