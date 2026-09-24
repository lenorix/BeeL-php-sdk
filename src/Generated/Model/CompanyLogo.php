<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;
class CompanyLogo implements AdditionalPropertiesInterface
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
     * Public URL of the stored logo.
     *
     * @var string
     */
    protected $logoUrl;
    /**
     * Public URL of the stored logo.
     *
     * @return string
     */
    public function getLogoUrl(): string
    {
        return $this->logoUrl;
    }
    /**
     * Public URL of the stored logo.
     *
     * @param string $logoUrl
     *
     * @return self
     */
    public function setLogoUrl(string $logoUrl): self
    {
        $this->initialized['logoUrl'] = true;
        $this->logoUrl = $logoUrl;
        return $this;
    }
    public function definedProperties(): array
    {
        return ['logoUrl' => ['logo_url', 'getLogoUrl', 'setLogoUrl']];
    }
}