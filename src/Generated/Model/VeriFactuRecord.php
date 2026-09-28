<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;
class VeriFactuRecord implements AdditionalPropertiesInterface
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
     * Record ID. Same value as `verifactu_registration_id` in the payload of the
     * `verifactu.status.updated` webhook event.
     * 
     *
     * @var string
     */
    protected $id;
    /**
     * Operation a VeriFactu record submits to the AEAT.
     * 
     * * `REGISTRATION` — registration of the invoice.
     * * `VOID` — cancellation of a previously registered invoice.
     * 
     *
     * @var string
     */
    protected $operation;
    /**
     * Submission status of this record, in the same vocabulary as the invoice's
     * `verifactu.submission_status`. For `operation` `VOID` the final successful state is
     * `VOIDED`, not `ACCEPTED`; a rejected cancellation is `REJECTED`. On `REJECTED`,
     * `error_message` gives the reason and `error_code` carries the AEAT's code when the AEAT
     * gave one.
     * 
     *
     * @var string
     */
    protected $submissionStatus;
    /**
     * Invoice SHA-256 hash according to VeriFactu regulations. Only on `REGISTRATION` records.
     *
     * @var string
     */
    protected $invoiceHash;
    /**
     * Identifier (UUID) of this record in the VeriFactu submission, assigned when it is
     * submitted. It is not an AEAT code: quote it when you ask BeeL about the record.
     * 
     *
     * @var string
     */
    protected $registrationNumber;
    /**
     * Date and time this record was created. A record rejected before reaching the AEAT
     * also has one.
     * 
     *
     * @var \DateTime
     */
    protected $registeredAt;
    /**
     * AEAT verification URL encoded in the invoice QR code. Only on `REGISTRATION` records.
     * 
     *
     * @var string
     */
    protected $qrUrl;
    /**
     * Error code returned by the AEAT. Present when the AEAT reported a remark or an error on
     * the record.
     * 
     *
     * @var string|null
     */
    protected $errorCode;
    /**
     * Human-readable reason for the outcome. When the AEAT reported a remark or an error on the
     * record, it is the AEAT's own description. When BeeL. decided the outcome (the submission
     * was rejected before reaching the AEAT, or BeeL. stopped waiting for a final answer), it
     * is a message written by BeeL., in the language of the request.
     * 
     *
     * @var string|null
     */
    protected $errorMessage;
    /**
     * Record ID. Same value as `verifactu_registration_id` in the payload of the
     * `verifactu.status.updated` webhook event.
     * 
     *
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }
    /**
    * Record ID. Same value as `verifactu_registration_id` in the payload of the
    `verifactu.status.updated` webhook event.
    
    *
    * @param string $id
    *
    * @return self
    */
    public function setId(string $id): self
    {
        $this->initialized['id'] = true;
        $this->id = $id;
        return $this;
    }
    /**
     * Operation a VeriFactu record submits to the AEAT.
     * 
     * * `REGISTRATION` — registration of the invoice.
     * * `VOID` — cancellation of a previously registered invoice.
     * 
     *
     * @return string
     */
    public function getOperation(): string
    {
        return $this->operation;
    }
    /**
    * Operation a VeriFactu record submits to the AEAT.
    
    * `REGISTRATION` — registration of the invoice.
    * `VOID` — cancellation of a previously registered invoice.
    
    *
    * @param string $operation
    *
    * @return self
    */
    public function setOperation(string $operation): self
    {
        $this->initialized['operation'] = true;
        $this->operation = $operation;
        return $this;
    }
    /**
     * Submission status of this record, in the same vocabulary as the invoice's
     * `verifactu.submission_status`. For `operation` `VOID` the final successful state is
     * `VOIDED`, not `ACCEPTED`; a rejected cancellation is `REJECTED`. On `REJECTED`,
     * `error_message` gives the reason and `error_code` carries the AEAT's code when the AEAT
     * gave one.
     * 
     *
     * @return string
     */
    public function getSubmissionStatus(): string
    {
        return $this->submissionStatus;
    }
    /**
    * Submission status of this record, in the same vocabulary as the invoice's
    `verifactu.submission_status`. For `operation` `VOID` the final successful state is
    `VOIDED`, not `ACCEPTED`; a rejected cancellation is `REJECTED`. On `REJECTED`,
    `error_message` gives the reason and `error_code` carries the AEAT's code when the AEAT
    gave one.
    
    *
    * @param string $submissionStatus
    *
    * @return self
    */
    public function setSubmissionStatus(string $submissionStatus): self
    {
        $this->initialized['submissionStatus'] = true;
        $this->submissionStatus = $submissionStatus;
        return $this;
    }
    /**
     * Invoice SHA-256 hash according to VeriFactu regulations. Only on `REGISTRATION` records.
     *
     * @return string
     */
    public function getInvoiceHash(): string
    {
        return $this->invoiceHash;
    }
    /**
     * Invoice SHA-256 hash according to VeriFactu regulations. Only on `REGISTRATION` records.
     *
     * @param string $invoiceHash
     *
     * @return self
     */
    public function setInvoiceHash(string $invoiceHash): self
    {
        $this->initialized['invoiceHash'] = true;
        $this->invoiceHash = $invoiceHash;
        return $this;
    }
    /**
     * Identifier (UUID) of this record in the VeriFactu submission, assigned when it is
     * submitted. It is not an AEAT code: quote it when you ask BeeL about the record.
     * 
     *
     * @return string
     */
    public function getRegistrationNumber(): string
    {
        return $this->registrationNumber;
    }
    /**
    * Identifier (UUID) of this record in the VeriFactu submission, assigned when it is
    submitted. It is not an AEAT code: quote it when you ask BeeL about the record.
    
    *
    * @param string $registrationNumber
    *
    * @return self
    */
    public function setRegistrationNumber(string $registrationNumber): self
    {
        $this->initialized['registrationNumber'] = true;
        $this->registrationNumber = $registrationNumber;
        return $this;
    }
    /**
     * Date and time this record was created. A record rejected before reaching the AEAT
     * also has one.
     * 
     *
     * @return \DateTime
     */
    public function getRegisteredAt(): \DateTime
    {
        return $this->registeredAt;
    }
    /**
    * Date and time this record was created. A record rejected before reaching the AEAT
    also has one.
    
    *
    * @param \DateTime $registeredAt
    *
    * @return self
    */
    public function setRegisteredAt(\DateTime $registeredAt): self
    {
        $this->initialized['registeredAt'] = true;
        $this->registeredAt = $registeredAt;
        return $this;
    }
    /**
     * AEAT verification URL encoded in the invoice QR code. Only on `REGISTRATION` records.
     * 
     *
     * @return string
     */
    public function getQrUrl(): string
    {
        return $this->qrUrl;
    }
    /**
     * AEAT verification URL encoded in the invoice QR code. Only on `REGISTRATION` records.
     *
     * @param string $qrUrl
     *
     * @return self
     */
    public function setQrUrl(string $qrUrl): self
    {
        $this->initialized['qrUrl'] = true;
        $this->qrUrl = $qrUrl;
        return $this;
    }
    /**
     * Error code returned by the AEAT. Present when the AEAT reported a remark or an error on
     * the record.
     * 
     *
     * @return string|null
     */
    public function getErrorCode(): ?string
    {
        return $this->errorCode;
    }
    /**
    * Error code returned by the AEAT. Present when the AEAT reported a remark or an error on
    the record.
    
    *
    * @param string|null $errorCode
    *
    * @return self
    */
    public function setErrorCode(?string $errorCode): self
    {
        $this->initialized['errorCode'] = true;
        $this->errorCode = $errorCode;
        return $this;
    }
    /**
     * Human-readable reason for the outcome. When the AEAT reported a remark or an error on the
     * record, it is the AEAT's own description. When BeeL. decided the outcome (the submission
     * was rejected before reaching the AEAT, or BeeL. stopped waiting for a final answer), it
     * is a message written by BeeL., in the language of the request.
     * 
     *
     * @return string|null
     */
    public function getErrorMessage(): ?string
    {
        return $this->errorMessage;
    }
    /**
    * Human-readable reason for the outcome. When the AEAT reported a remark or an error on the
    record, it is the AEAT's own description. When BeeL. decided the outcome (the submission
    was rejected before reaching the AEAT, or BeeL. stopped waiting for a final answer), it
    is a message written by BeeL., in the language of the request.
    
    *
    * @param string|null $errorMessage
    *
    * @return self
    */
    public function setErrorMessage(?string $errorMessage): self
    {
        $this->initialized['errorMessage'] = true;
        $this->errorMessage = $errorMessage;
        return $this;
    }
    public function definedProperties(): array
    {
        return ['id' => ['id', 'getId', 'setId'], 'operation' => ['operation', 'getOperation', 'setOperation'], 'submissionStatus' => ['submission_status', 'getSubmissionStatus', 'setSubmissionStatus'], 'invoiceHash' => ['invoice_hash', 'getInvoiceHash', 'setInvoiceHash'], 'registrationNumber' => ['registration_number', 'getRegistrationNumber', 'setRegistrationNumber'], 'registeredAt' => ['registered_at', 'getRegisteredAt', 'setRegisteredAt'], 'qrUrl' => ['qr_url', 'getQrUrl', 'setQrUrl'], 'errorCode' => ['error_code', 'getErrorCode', 'setErrorCode'], 'errorMessage' => ['error_message', 'getErrorMessage', 'setErrorMessage']];
    }
}