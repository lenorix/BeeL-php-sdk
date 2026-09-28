<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;
use Psr\Http\Message\StreamInterface;

class V1CompaniesCompanyIdLogoPutBody implements AdditionalPropertiesInterface
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
     * Logo image file (JPEG or PNG, up to 1 MB).
     *
     * @var string|resource|StreamInterface
     */
    protected $file;

    /**
     * Logo image file (JPEG or PNG, up to 1 MB).
     *
     * @return string|resource|StreamInterface
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * Logo image file (JPEG or PNG, up to 1 MB).
     *
     * @param  string|resource|StreamInterface  $file
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
