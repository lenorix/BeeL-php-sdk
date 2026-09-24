<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;
class ResponsePayloadTooLargeError implements AdditionalPropertiesInterface
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
     * @var string
     */
    protected $code;
    /**
     * @var string
     */
    protected $message;
    /**
     * Size information for a rejected payload. Byte counts are strings, not
     * numbers, to stay compatible with consumers of the pre-existing
     * `FILE_TOO_LARGE` response.
     * 
     *
     * @var PayloadTooLargeDetails
     */
    protected $details;
    /**
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }
    /**
     * @param string $code
     *
     * @return self
     */
    public function setCode(string $code): self
    {
        $this->initialized['code'] = true;
        $this->code = $code;
        return $this;
    }
    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }
    /**
     * @param string $message
     *
     * @return self
     */
    public function setMessage(string $message): self
    {
        $this->initialized['message'] = true;
        $this->message = $message;
        return $this;
    }
    /**
     * Size information for a rejected payload. Byte counts are strings, not
     * numbers, to stay compatible with consumers of the pre-existing
     * `FILE_TOO_LARGE` response.
     * 
     *
     * @return PayloadTooLargeDetails
     */
    public function getDetails(): PayloadTooLargeDetails
    {
        return $this->details;
    }
    /**
    * Size information for a rejected payload. Byte counts are strings, not
    numbers, to stay compatible with consumers of the pre-existing
    `FILE_TOO_LARGE` response.
    
    *
    * @param PayloadTooLargeDetails $details
    *
    * @return self
    */
    public function setDetails(PayloadTooLargeDetails $details): self
    {
        $this->initialized['details'] = true;
        $this->details = $details;
        return $this;
    }
    public function definedProperties(): array
    {
        return ['code' => ['code', 'getCode', 'setCode'], 'message' => ['message', 'getMessage', 'setMessage'], 'details' => ['details', 'getDetails', 'setDetails']];
    }
}