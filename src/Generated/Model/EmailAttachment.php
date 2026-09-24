<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;

class EmailAttachment implements AdditionalPropertiesInterface
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
     * File name
     *
     * @var string
     */
    protected $filename;

    /**
     * MIME type of the attachment
     *
     * @var string
     */
    protected $contentType;

    /**
     * Size in bytes, if known
     *
     * @var int
     */
    protected $size;

    /**
     * Temporary download URL signed by the provider (may expire). Null
     * if the provider does not supply it.
     *
     *
     * @var string|null
     */
    protected $downloadUrl;

    /**
     * File name
     */
    public function getFilename(): string
    {
        return $this->filename;
    }

    /**
     * File name
     */
    public function setFilename(string $filename): self
    {
        $this->initialized['filename'] = true;
        $this->filename = $filename;

        return $this;
    }

    /**
     * MIME type of the attachment
     */
    public function getContentType(): string
    {
        return $this->contentType;
    }

    /**
     * MIME type of the attachment
     */
    public function setContentType(string $contentType): self
    {
        $this->initialized['contentType'] = true;
        $this->contentType = $contentType;

        return $this;
    }

    /**
     * Size in bytes, if known
     */
    public function getSize(): int
    {
        return $this->size;
    }

    /**
     * Size in bytes, if known
     */
    public function setSize(int $size): self
    {
        $this->initialized['size'] = true;
        $this->size = $size;

        return $this;
    }

    /**
     * Temporary download URL signed by the provider (may expire). Null
     * if the provider does not supply it.
     */
    public function getDownloadUrl(): ?string
    {
        return $this->downloadUrl;
    }

    /**
     * Temporary download URL signed by the provider (may expire). Null
    if the provider does not supply it.
     */
    public function setDownloadUrl(?string $downloadUrl): self
    {
        $this->initialized['downloadUrl'] = true;
        $this->downloadUrl = $downloadUrl;

        return $this;
    }

    public function definedProperties(): array
    {
        return ['filename' => ['filename', 'getFilename', 'setFilename'], 'contentType' => ['content_type', 'getContentType', 'setContentType'], 'size' => ['size', 'getSize', 'setSize'], 'downloadUrl' => ['download_url', 'getDownloadUrl', 'setDownloadUrl']];
    }
}
