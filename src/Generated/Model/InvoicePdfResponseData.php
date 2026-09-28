<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;
class InvoicePdfResponseData implements AdditionalPropertiesInterface
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
     * Pre-signed URL to download the PDF (valid for 5 minutes)
     *
     * @var string
     */
    protected $downloadUrl;
    /**
     * Seconds until the URL expires
     *
     * @var int
     */
    protected $expiresInSeconds;
    /**
     * Suggested filename for download
     *
     * @var string
     */
    protected $fileName;
    /**
     * Pre-signed URL to download the PDF (valid for 5 minutes)
     *
     * @return string
     */
    public function getDownloadUrl(): string
    {
        return $this->downloadUrl;
    }
    /**
     * Pre-signed URL to download the PDF (valid for 5 minutes)
     *
     * @param string $downloadUrl
     *
     * @return self
     */
    public function setDownloadUrl(string $downloadUrl): self
    {
        $this->initialized['downloadUrl'] = true;
        $this->downloadUrl = $downloadUrl;
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
    /**
     * Suggested filename for download
     *
     * @return string
     */
    public function getFileName(): string
    {
        return $this->fileName;
    }
    /**
     * Suggested filename for download
     *
     * @param string $fileName
     *
     * @return self
     */
    public function setFileName(string $fileName): self
    {
        $this->initialized['fileName'] = true;
        $this->fileName = $fileName;
        return $this;
    }
    public function definedProperties(): array
    {
        return ['downloadUrl' => ['download_url', 'getDownloadUrl', 'setDownloadUrl'], 'expiresInSeconds' => ['expires_in_seconds', 'getExpiresInSeconds', 'setExpiresInSeconds'], 'fileName' => ['file_name', 'getFileName', 'setFileName']];
    }
}