<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;
class V1CustomersImportCsvPreviewPostBody implements AdditionalPropertiesInterface
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
     * CSV file with customers to import
     *
     * @var string|resource|\Psr\Http\Message\StreamInterface
     */
    protected $file;
    /**
     * If true (recommended initially): preview only without persistence.
     * If false: preview + persistence of valid customers.
     * 
     *
     * @var bool
     */
    protected $dryRun = true;
    /**
     * CSV file with customers to import
     *
     * @return string|resource|\Psr\Http\Message\StreamInterface
     */
    public function getFile()
    {
        return $this->file;
    }
    /**
     * CSV file with customers to import
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
     * If true (recommended initially): preview only without persistence.
     * If false: preview + persistence of valid customers.
     * 
     *
     * @return bool
     */
    public function getDryRun(): bool
    {
        return $this->dryRun;
    }
    /**
    * If true (recommended initially): preview only without persistence.
    If false: preview + persistence of valid customers.
    
    *
    * @param bool $dryRun
    *
    * @return self
    */
    public function setDryRun(bool $dryRun): self
    {
        $this->initialized['dryRun'] = true;
        $this->dryRun = $dryRun;
        return $this;
    }
    public function definedProperties(): array
    {
        return ['file' => ['file', 'getFile', 'setFile'], 'dryRun' => ['dry_run', 'getDryRun', 'setDryRun']];
    }
}