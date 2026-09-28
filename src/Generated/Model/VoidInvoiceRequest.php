<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;
class VoidInvoiceRequest implements AdditionalPropertiesInterface
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
     * Void reason (minimum 10 characters)
     *
     * @var string
     */
    protected $reason;
    /**
     * Confirms that the invoice was issued by mistake: the operation it describes never took
     * place, it was a test, or it is an accidental duplicate. A void is only for those cases
     * (RD 1007/2023, art. 11.1); an operation that did take place is corrected with a
     * corrective invoice.
     * 
     * Required as `true` when the invoice has already been sent or paid — delivering or
     * collecting it suggests the operation was real, so the void has to say it was not.
     * Without it such a void fails with `422 VOID_REQUIRES_ISSUED_IN_ERROR`.
     * 
     *
     * @var bool
     */
    protected $issuedInError = false;
    /**
     * **Deprecated.** The void is recorded with the instant it actually takes place,
     * returned as `voided_at` on the invoice: a void cannot be dated by the caller, and this
     * value never changes `voided_at`. It will be removed in a future version. A date earlier
     * than the invoice's issue date is rejected with `422 VOID_DATE_BEFORE_ISSUE_DATE`.
     * 
     *
     * @deprecated
     *
     * @var \DateTime
     */
    protected $voidDate;
    /**
     * Void reason (minimum 10 characters)
     *
     * @return string
     */
    public function getReason(): string
    {
        return $this->reason;
    }
    /**
     * Void reason (minimum 10 characters)
     *
     * @param string $reason
     *
     * @return self
     */
    public function setReason(string $reason): self
    {
        $this->initialized['reason'] = true;
        $this->reason = $reason;
        return $this;
    }
    /**
     * Confirms that the invoice was issued by mistake: the operation it describes never took
     * place, it was a test, or it is an accidental duplicate. A void is only for those cases
     * (RD 1007/2023, art. 11.1); an operation that did take place is corrected with a
     * corrective invoice.
     * 
     * Required as `true` when the invoice has already been sent or paid — delivering or
     * collecting it suggests the operation was real, so the void has to say it was not.
     * Without it such a void fails with `422 VOID_REQUIRES_ISSUED_IN_ERROR`.
     * 
     *
     * @return bool
     */
    public function getIssuedInError(): bool
    {
        return $this->issuedInError;
    }
    /**
    * Confirms that the invoice was issued by mistake: the operation it describes never took
    place, it was a test, or it is an accidental duplicate. A void is only for those cases
    (RD 1007/2023, art. 11.1); an operation that did take place is corrected with a
    corrective invoice.
    
    Required as `true` when the invoice has already been sent or paid — delivering or
    collecting it suggests the operation was real, so the void has to say it was not.
    Without it such a void fails with `422 VOID_REQUIRES_ISSUED_IN_ERROR`.
    
    *
    * @param bool $issuedInError
    *
    * @return self
    */
    public function setIssuedInError(bool $issuedInError): self
    {
        $this->initialized['issuedInError'] = true;
        $this->issuedInError = $issuedInError;
        return $this;
    }
    /**
     * **Deprecated.** The void is recorded with the instant it actually takes place,
     * returned as `voided_at` on the invoice: a void cannot be dated by the caller, and this
     * value never changes `voided_at`. It will be removed in a future version. A date earlier
     * than the invoice's issue date is rejected with `422 VOID_DATE_BEFORE_ISSUE_DATE`.
     * 
     *
     * @deprecated
     *
     * @return \DateTime
     */
    public function getVoidDate(): \DateTime
    {
        return $this->voidDate;
    }
    /**
    * **Deprecated.** The void is recorded with the instant it actually takes place,
    returned as `voided_at` on the invoice: a void cannot be dated by the caller, and this
    value never changes `voided_at`. It will be removed in a future version. A date earlier
    than the invoice's issue date is rejected with `422 VOID_DATE_BEFORE_ISSUE_DATE`.
    
    *
    * @param \DateTime $voidDate
    *
    * @deprecated
    *
    * @return self
    */
    public function setVoidDate(\DateTime $voidDate): self
    {
        $this->initialized['voidDate'] = true;
        $this->voidDate = $voidDate;
        return $this;
    }
    public function definedProperties(): array
    {
        return ['reason' => ['reason', 'getReason', 'setReason'], 'issuedInError' => ['issued_in_error', 'getIssuedInError', 'setIssuedInError'], 'voidDate' => ['void_date', 'getVoidDate', 'setVoidDate']];
    }
}