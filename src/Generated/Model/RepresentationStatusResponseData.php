<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;
class RepresentationStatusResponseData implements AdditionalPropertiesInterface
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
     * Stage of the AEAT representation of the company.
     * 
     * - `NOT_STARTED`: no representation document has been generated yet.
     * - `PDF_GENERATED`: the document is generated and waits for a digital signature.
     * - `SUBMITTED`: returned only by the submit operation, as its acknowledgement; this
     *   read never returns it.
     * - `ACTIVE`: the signed document was accepted and the representation is in force,
     *   so invoices of this NIF can be submitted to the AEAT in Live.
     * - `ERROR`: reserved; not currently returned.
     * - `CANCELLED`: the representation was cancelled. Invoices of this NIF are not
     *   submitted to the AEAT in Live until a new signed document is accepted.
     * 
     *
     * @var string
     */
    protected $status;
    /**
     * @var string
     */
    protected $message;
    /**
     * @var \DateTime
     */
    protected $updatedAt;
    /**
     * Stage of the AEAT representation of the company.
     * 
     * - `NOT_STARTED`: no representation document has been generated yet.
     * - `PDF_GENERATED`: the document is generated and waits for a digital signature.
     * - `SUBMITTED`: returned only by the submit operation, as its acknowledgement; this
     *   read never returns it.
     * - `ACTIVE`: the signed document was accepted and the representation is in force,
     *   so invoices of this NIF can be submitted to the AEAT in Live.
     * - `ERROR`: reserved; not currently returned.
     * - `CANCELLED`: the representation was cancelled. Invoices of this NIF are not
     *   submitted to the AEAT in Live until a new signed document is accepted.
     * 
     *
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }
    /**
    * Stage of the AEAT representation of the company.
    
    - `NOT_STARTED`: no representation document has been generated yet.
    - `PDF_GENERATED`: the document is generated and waits for a digital signature.
    - `SUBMITTED`: returned only by the submit operation, as its acknowledgement; this
     read never returns it.
    - `ACTIVE`: the signed document was accepted and the representation is in force,
     so invoices of this NIF can be submitted to the AEAT in Live.
    - `ERROR`: reserved; not currently returned.
    - `CANCELLED`: the representation was cancelled. Invoices of this NIF are not
     submitted to the AEAT in Live until a new signed document is accepted.
    
    *
    * @param string $status
    *
    * @return self
    */
    public function setStatus(string $status): self
    {
        $this->initialized['status'] = true;
        $this->status = $status;
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
     * @return \DateTime
     */
    public function getUpdatedAt(): \DateTime
    {
        return $this->updatedAt;
    }
    /**
     * @param \DateTime $updatedAt
     *
     * @return self
     */
    public function setUpdatedAt(\DateTime $updatedAt): self
    {
        $this->initialized['updatedAt'] = true;
        $this->updatedAt = $updatedAt;
        return $this;
    }
    public function definedProperties(): array
    {
        return ['status' => ['status', 'getStatus', 'setStatus'], 'message' => ['message', 'getMessage', 'setMessage'], 'updatedAt' => ['updated_at', 'getUpdatedAt', 'setUpdatedAt']];
    }
}