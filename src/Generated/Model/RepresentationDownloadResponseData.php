<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;
class RepresentationDownloadResponseData implements AdditionalPropertiesInterface
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
     * @var string|null
     */
    protected $downloadUrl;
    /**
     * @var int|null
     */
    protected $expiresInSeconds;
    /**
     * @return string|null
     */
    public function getDownloadUrl(): ?string
    {
        return $this->downloadUrl;
    }
    /**
     * @param string|null $downloadUrl
     *
     * @return self
     */
    public function setDownloadUrl(?string $downloadUrl): self
    {
        $this->initialized['downloadUrl'] = true;
        $this->downloadUrl = $downloadUrl;
        return $this;
    }
    /**
     * @return int|null
     */
    public function getExpiresInSeconds(): ?int
    {
        return $this->expiresInSeconds;
    }
    /**
     * @param int|null $expiresInSeconds
     *
     * @return self
     */
    public function setExpiresInSeconds(?int $expiresInSeconds): self
    {
        $this->initialized['expiresInSeconds'] = true;
        $this->expiresInSeconds = $expiresInSeconds;
        return $this;
    }
    public function definedProperties(): array
    {
        return ['downloadUrl' => ['download_url', 'getDownloadUrl', 'setDownloadUrl'], 'expiresInSeconds' => ['expires_in_seconds', 'getExpiresInSeconds', 'setExpiresInSeconds']];
    }
}