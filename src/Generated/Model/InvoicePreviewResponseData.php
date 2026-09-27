<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;
class InvoicePreviewResponseData implements AdditionalPropertiesInterface
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
     * Pre-signed URL to the invoice preview image (WebP), for inline rendering (valid for 5 minutes)
     *
     * @var string
     */
    protected $imageUrl;
    /**
     * Seconds until the URL expires
     *
     * @var int
     */
    protected $expiresInSeconds;
    /**
     * Pre-signed URL to the invoice preview image (WebP), for inline rendering (valid for 5 minutes)
     *
     * @return string
     */
    public function getImageUrl(): string
    {
        return $this->imageUrl;
    }
    /**
     * Pre-signed URL to the invoice preview image (WebP), for inline rendering (valid for 5 minutes)
     *
     * @param string $imageUrl
     *
     * @return self
     */
    public function setImageUrl(string $imageUrl): self
    {
        $this->initialized['imageUrl'] = true;
        $this->imageUrl = $imageUrl;
        return $this;
    }
    /**
     * Seconds until the URL expires
     *
     * @return int
     */
    public function getExpiresInSeconds(): int
    {
        return $this->expiresInSeconds;
    }
    /**
     * Seconds until the URL expires
     *
     * @param int $expiresInSeconds
     *
     * @return self
     */
    public function setExpiresInSeconds(int $expiresInSeconds): self
    {
        $this->initialized['expiresInSeconds'] = true;
        $this->expiresInSeconds = $expiresInSeconds;
        return $this;
    }
    public function definedProperties(): array
    {
        return ['imageUrl' => ['image_url', 'getImageUrl', 'setImageUrl'], 'expiresInSeconds' => ['expires_in_seconds', 'getExpiresInSeconds', 'setExpiresInSeconds']];
    }
}