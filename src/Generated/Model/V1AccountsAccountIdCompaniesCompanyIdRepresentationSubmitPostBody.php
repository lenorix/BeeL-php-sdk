<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;
class V1AccountsAccountIdCompaniesCompanyIdRepresentationSubmitPostBody implements AdditionalPropertiesInterface
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
     * Signed PDF file
     *
     * @var string|resource|\Psr\Http\Message\StreamInterface
     */
    protected $file;
    /**
     * Signed PDF file
     *
     * @return string|resource|\Psr\Http\Message\StreamInterface
     */
    public function getFile()
    {
        return $this->file;
    }
    /**
     * Signed PDF file
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
    public function definedProperties(): array
    {
        return ['file' => ['file', 'getFile', 'setFile']];
    }
}