<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;
class V1CompaniesCompanyIdCustomersImportsPostBody implements AdditionalPropertiesInterface
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
     * File with the customers to import, in the format of `source`
     *
     * @var string|resource|\Psr\Http\Message\StreamInterface
     */
    protected $file;
    /**
     * Format of the file being imported. It is required and has no default: a new origin must be
     * declared explicitly, so adding one never changes the meaning of an existing request.
     * 
     *
     * @var string
     */
    protected $source;
    /**
     * File with the customers to import, in the format of `source`
     *
     * @return string|resource|\Psr\Http\Message\StreamInterface
     */
    public function getFile()
    {
        return $this->file;
    }
    /**
     * File with the customers to import, in the format of `source`
     *
     * @param string|resource|\Psr\Http\Message\StreamInterface $file
     *
     * @return self
     */
    public function setFile($file): self
    {
        $this->initialized['file'] = true;
        $this->file = $file;
        return $this;
    }
    /**
     * Format of the file being imported. It is required and has no default: a new origin must be
     * declared explicitly, so adding one never changes the meaning of an existing request.
     * 
     *
     * @return string
     */
    public function getSource(): string
    {
        return $this->source;
    }
    /**
    * Format of the file being imported. It is required and has no default: a new origin must be
    declared explicitly, so adding one never changes the meaning of an existing request.
    
    *
    * @param string $source
    *
    * @return self
    */
    public function setSource(string $source): self
    {
        $this->initialized['source'] = true;
        $this->source = $source;
        return $this;
    }
    public function definedProperties(): array
    {
        return ['file' => ['file', 'getFile', 'setFile'], 'source' => ['source', 'getSource', 'setSource']];
    }
}