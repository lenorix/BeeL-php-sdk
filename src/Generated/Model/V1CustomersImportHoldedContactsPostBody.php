<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;
use Psr\Http\Message\StreamInterface;

class V1CustomersImportHoldedContactsPostBody implements AdditionalPropertiesInterface
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
     * Excel file (.xlsx) of contacts exported from Holded
     *
     * @var string|resource|StreamInterface
     */
    protected $file;

    /**
     * If true: parsing and mapping only without importing to DB.
     * If false: parsing + mapping + actual import.
     *
     *
     * @var bool
     */
    protected $preview = true;

    /**
     * Excel file (.xlsx) of contacts exported from Holded
     *
     * @return string|resource|StreamInterface
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * Excel file (.xlsx) of contacts exported from Holded
     *
     * @param  string|resource|StreamInterface  $file
     */
    public function setFile($file): self
    {
        $this->initialized['file'] = true;
        $this->file = $file;

        return $this;
    }

    /**
     * If true: parsing and mapping only without importing to DB.
     * If false: parsing + mapping + actual import.
     */
    public function getPreview(): bool
    {
        return $this->preview;
    }

    /**
     * If true: parsing and mapping only without importing to DB.
    If false: parsing + mapping + actual import.
     */
    public function setPreview(bool $preview): self
    {
        $this->initialized['preview'] = true;
        $this->preview = $preview;

        return $this;
    }

    public function definedProperties(): array
    {
        return ['file' => ['file', 'getFile', 'setFile'], 'preview' => ['preview', 'getPreview', 'setPreview']];
    }
}
