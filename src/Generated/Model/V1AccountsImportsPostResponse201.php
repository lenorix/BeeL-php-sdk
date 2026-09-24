<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;
class V1AccountsImportsPostResponse201 implements AdditionalPropertiesInterface
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
     * The outcome of the file, row by row, in one shape for the preview and for the import. Which one produced it is `metadata.is_dry_run`; what it actually wrote is the write counters in `statistics`.
     *
     * @var AccountImportResult
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
     * The outcome of the file, row by row, in one shape for the preview and for the import. Which one produced it is `metadata.is_dry_run`; what it actually wrote is the write counters in `statistics`.
     *
     * @return AccountImportResult
     */
    public function getData(): AccountImportResult
    {
        return $this->data;
    }
    /**
     * The outcome of the file, row by row, in one shape for the preview and for the import. Which one produced it is `metadata.is_dry_run`; what it actually wrote is the write counters in `statistics`.
     *
     * @param AccountImportResult $data
     *
     * @return self
     */
    public function setData(AccountImportResult $data): self
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