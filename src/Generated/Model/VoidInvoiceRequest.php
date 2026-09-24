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
     * **Deprecated and ignored.** The void is recorded with the instant it actually takes
     * place, returned as `voided_at` on the invoice. A void cannot be dated by the caller,
     * so any value sent here has no effect and will be removed in a future version.
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
     * **Deprecated and ignored.** The void is recorded with the instant it actually takes
     * place, returned as `voided_at` on the invoice. A void cannot be dated by the caller,
     * so any value sent here has no effect and will be removed in a future version.
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
    * **Deprecated and ignored.** The void is recorded with the instant it actually takes
    place, returned as `voided_at` on the invoice. A void cannot be dated by the caller,
    so any value sent here has no effect and will be removed in a future version.
    
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
        return ['reason' => ['reason', 'getReason', 'setReason'], 'voidDate' => ['void_date', 'getVoidDate', 'setVoidDate']];
    }
}