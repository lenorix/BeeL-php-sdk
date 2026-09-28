<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;
class PayloadTooLargeDetails implements AdditionalPropertiesInterface
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
     * Maximum size allowed for this request, in bytes. Absent when the
     * limit that was hit does not expose a numeric maximum.
     * 
     *
     * @var string
     */
    protected $maxSizeBytes;
    /**
     * The same maximum, rendered for display.
     *
     * @var string
     */
    protected $maxSizeFormatted;
    /**
     * Size the request declared in its `Content-Length` header. Present
     * when the whole body was measured, absent when the limit was reached
     * while reading an individual uploaded file.
     * 
     *
     * @var string
     */
    protected $requestSizeBytes;
    /**
     * Maximum size allowed for this request, in bytes. Absent when the
     * limit that was hit does not expose a numeric maximum.
     * 
     *
     * @return string
     */
    public function getMaxSizeBytes(): string
    {
        return $this->maxSizeBytes;
    }
    /**
    * Maximum size allowed for this request, in bytes. Absent when the
    limit that was hit does not expose a numeric maximum.
    
    *
    * @param string $maxSizeBytes
    *
    * @return self
    */
    public function setMaxSizeBytes(string $maxSizeBytes): self
    {
        $this->initialized['maxSizeBytes'] = true;
        $this->maxSizeBytes = $maxSizeBytes;
        return $this;
    }
    /**
     * The same maximum, rendered for display.
     *
     * @return string
     */
    public function getMaxSizeFormatted(): string
    {
        return $this->maxSizeFormatted;
    }
    /**
     * The same maximum, rendered for display.
     *
     * @param string $maxSizeFormatted
     *
     * @return self
     */
    public function setMaxSizeFormatted(string $maxSizeFormatted): self
    {
        $this->initialized['maxSizeFormatted'] = true;
        $this->maxSizeFormatted = $maxSizeFormatted;
        return $this;
    }
    /**
     * Size the request declared in its `Content-Length` header. Present
     * when the whole body was measured, absent when the limit was reached
     * while reading an individual uploaded file.
     * 
     *
     * @return string
     */
    public function getRequestSizeBytes(): string
    {
        return $this->requestSizeBytes;
    }
    /**
    * Size the request declared in its `Content-Length` header. Present
    when the whole body was measured, absent when the limit was reached
    while reading an individual uploaded file.
    
    *
    * @param string $requestSizeBytes
    *
    * @return self
    */
    public function setRequestSizeBytes(string $requestSizeBytes): self
    {
        $this->initialized['requestSizeBytes'] = true;
        $this->requestSizeBytes = $requestSizeBytes;
        return $this;
    }
    public function definedProperties(): array
    {
        return ['maxSizeBytes' => ['max_size_bytes', 'getMaxSizeBytes', 'setMaxSizeBytes'], 'maxSizeFormatted' => ['max_size_formatted', 'getMaxSizeFormatted', 'setMaxSizeFormatted'], 'requestSizeBytes' => ['request_size_bytes', 'getRequestSizeBytes', 'setRequestSizeBytes']];
    }
}