<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;

class ResponseCustomerImportRejectedError implements AdditionalPropertiesInterface
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
     * Machine-readable context for an import file the operation rejected as a whole. Every field
     * is optional: each `error.code` fills the pair that applies to it and leaves the rest absent,
     * so the value and the limit it exceeded can be compared without parsing `error.message`.
     *
     *
     * @var CsvImportErrorDetails
     */
    protected $details;

    public function getCode(): string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->initialized['code'] = true;
        $this->code = $code;

        return $this;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function setMessage(string $message): self
    {
        $this->initialized['message'] = true;
        $this->message = $message;

        return $this;
    }

    /**
     * Machine-readable context for an import file the operation rejected as a whole. Every field
     * is optional: each `error.code` fills the pair that applies to it and leaves the rest absent,
     * so the value and the limit it exceeded can be compared without parsing `error.message`.
     */
    public function getDetails(): CsvImportErrorDetails
    {
        return $this->details;
    }

    /**
     * Machine-readable context for an import file the operation rejected as a whole. Every field
    is optional: each `error.code` fills the pair that applies to it and leaves the rest absent,
    so the value and the limit it exceeded can be compared without parsing `error.message`.
     */
    public function setDetails(CsvImportErrorDetails $details): self
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
