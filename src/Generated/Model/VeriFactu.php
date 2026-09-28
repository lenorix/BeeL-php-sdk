<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;
class VeriFactu implements AdditionalPropertiesInterface
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
     * Whether this invoice was registered with the AEAT under VeriFactu. Read-only: it records
     * the regime of the issuing tax ID at the moment of issuance.
     * 
     *
     * @var bool|null
     */
    protected $enabled;
    /**
     * SHA-256 hash of the registration record, as VeriFactu defines it. Present from the
     * moment the registration is submitted, while `submission_status` is still `PENDING`,
     * and kept whatever the AEAT answers.
     * 
     *
     * @var string|null
     */
    protected $invoiceHash;
    /**
     * Identifier (UUID) of this record in the VeriFactu submission, assigned when it is
     * submitted. It is not an AEAT code: quote it when you ask BeeL about the record.
     * 
     *
     * @var string|null
     */
    protected $registrationNumber;
    /**
     * AEAT verification URL encoded in the invoice QR code. Present from the moment the
     * registration is submitted, while `submission_status` is still `PENDING`.
     * 
     *
     * @var string|null
     */
    protected $qrUrl;
    /**
     * QR code as base64-encoded PNG for embedding in custom PDFs. Present from the moment
     * the registration is submitted, while `submission_status` is still `PENDING`; it does
     * not wait for the AEAT to accept the record.
     * 
     *
     * @var string|null
     */
    protected $qrBase64;
    /**
     * VeriFactu registration date and time
     *
     * @var \DateTime|null
     */
    protected $registeredAt;
    /**
     * @var string|null
     */
    protected $submissionStatus;
    /**
     * Why this invoice was not submitted to AEAT, when a submission was expected and
     * omitted. Null in every other case, including invoices that are not subject to
     * VeriFactu at all.
     * 
     *
     * @var string|null
     */
    protected $skipReason;
    /**
     * Error code returned by AEAT. Present when the AEAT reported a remark or an error on the record.
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
     * Whether this invoice was registered with the AEAT under VeriFactu. Read-only: it records
     * the regime of the issuing tax ID at the moment of issuance.
     * 
     *
     * @return bool|null
     */
    public function getEnabled(): ?bool
    {
        return $this->enabled;
    }
    /**
    * Whether this invoice was registered with the AEAT under VeriFactu. Read-only: it records
    the regime of the issuing tax ID at the moment of issuance.
    
    *
    * @param bool|null $enabled
    *
    * @return self
    */
    public function setEnabled(?bool $enabled): self
    {
        $this->initialized['enabled'] = true;
        $this->enabled = $enabled;
        return $this;
    }
    /**
     * SHA-256 hash of the registration record, as VeriFactu defines it. Present from the
     * moment the registration is submitted, while `submission_status` is still `PENDING`,
     * and kept whatever the AEAT answers.
     * 
     *
     * @return string|null
     */
    public function getInvoiceHash(): ?string
    {
        return $this->invoiceHash;
    }
    /**
    * SHA-256 hash of the registration record, as VeriFactu defines it. Present from the
    moment the registration is submitted, while `submission_status` is still `PENDING`,
    and kept whatever the AEAT answers.
    
    *
    * @param string|null $invoiceHash
    *
    * @return self
    */
    public function setInvoiceHash(?string $invoiceHash): self
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
     * @return string|null
     */
    public function getRegistrationNumber(): ?string
    {
        return $this->registrationNumber;
    }
    /**
    * Identifier (UUID) of this record in the VeriFactu submission, assigned when it is
    submitted. It is not an AEAT code: quote it when you ask BeeL about the record.
    
    *
    * @param string|null $registrationNumber
    *
    * @return self
    */
    public function setRegistrationNumber(?string $registrationNumber): self
    {
        $this->initialized['registrationNumber'] = true;
        $this->registrationNumber = $registrationNumber;
        return $this;
    }
    /**
     * AEAT verification URL encoded in the invoice QR code. Present from the moment the
     * registration is submitted, while `submission_status` is still `PENDING`.
     * 
     *
     * @return string|null
     */
    public function getQrUrl(): ?string
    {
        return $this->qrUrl;
    }
    /**
    * AEAT verification URL encoded in the invoice QR code. Present from the moment the
    registration is submitted, while `submission_status` is still `PENDING`.
    
    *
    * @param string|null $qrUrl
    *
    * @return self
    */
    public function setQrUrl(?string $qrUrl): self
    {
        $this->initialized['qrUrl'] = true;
        $this->qrUrl = $qrUrl;
        return $this;
    }
    /**
     * QR code as base64-encoded PNG for embedding in custom PDFs. Present from the moment
     * the registration is submitted, while `submission_status` is still `PENDING`; it does
     * not wait for the AEAT to accept the record.
     * 
     *
     * @return string|null
     */
    public function getQrBase64(): ?string
    {
        return $this->qrBase64;
    }
    /**
    * QR code as base64-encoded PNG for embedding in custom PDFs. Present from the moment
    the registration is submitted, while `submission_status` is still `PENDING`; it does
    not wait for the AEAT to accept the record.
    
    *
    * @param string|null $qrBase64
    *
    * @return self
    */
    public function setQrBase64(?string $qrBase64): self
    {
        $this->initialized['qrBase64'] = true;
        $this->qrBase64 = $qrBase64;
        return $this;
    }
    /**
     * VeriFactu registration date and time
     *
     * @return \DateTime|null
     */
    public function getRegisteredAt(): ?\DateTime
    {
        return $this->registeredAt;
    }
    /**
     * VeriFactu registration date and time
     *
     * @param \DateTime|null $registeredAt
     *
     * @return self
     */
    public function setRegisteredAt(?\DateTime $registeredAt): self
    {
        $this->initialized['registeredAt'] = true;
        $this->registeredAt = $registeredAt;
        return $this;
    }
    /**
     * @return string|null
     */
    public function getSubmissionStatus(): ?string
    {
        return $this->submissionStatus;
    }
    /**
     * @param string|null $submissionStatus
     *
     * @return self
     */
    public function setSubmissionStatus(?string $submissionStatus): self
    {
        $this->initialized['submissionStatus'] = true;
        $this->submissionStatus = $submissionStatus;
        return $this;
    }
    /**
     * Why this invoice was not submitted to AEAT, when a submission was expected and
     * omitted. Null in every other case, including invoices that are not subject to
     * VeriFactu at all.
     * 
     *
     * @return string|null
     */
    public function getSkipReason(): ?string
    {
        return $this->skipReason;
    }
    /**
    * Why this invoice was not submitted to AEAT, when a submission was expected and
    omitted. Null in every other case, including invoices that are not subject to
    VeriFactu at all.
    
    *
    * @param string|null $skipReason
    *
    * @return self
    */
    public function setSkipReason(?string $skipReason): self
    {
        $this->initialized['skipReason'] = true;
        $this->skipReason = $skipReason;
        return $this;
    }
    /**
     * Error code returned by AEAT. Present when the AEAT reported a remark or an error on the record.
     *
     * @return string|null
     */
    public function getErrorCode(): ?string
    {
        return $this->errorCode;
    }
    /**
     * Error code returned by AEAT. Present when the AEAT reported a remark or an error on the record.
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
        return ['enabled' => ['enabled', 'getEnabled', 'setEnabled'], 'invoiceHash' => ['invoice_hash', 'getInvoiceHash', 'setInvoiceHash'], 'registrationNumber' => ['registration_number', 'getRegistrationNumber', 'setRegistrationNumber'], 'qrUrl' => ['qr_url', 'getQrUrl', 'setQrUrl'], 'qrBase64' => ['qr_base64', 'getQrBase64', 'setQrBase64'], 'registeredAt' => ['registered_at', 'getRegisteredAt', 'setRegisteredAt'], 'submissionStatus' => ['submission_status', 'getSubmissionStatus', 'setSubmissionStatus'], 'skipReason' => ['skip_reason', 'getSkipReason', 'setSkipReason'], 'errorCode' => ['error_code', 'getErrorCode', 'setErrorCode'], 'errorMessage' => ['error_message', 'getErrorMessage', 'setErrorMessage']];
    }
}