<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;
class V1RecurringInvoicesRecurringInvoiceIdGeneratePostResponse201Data implements AdditionalPropertiesInterface
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
    protected $invoiceId;
    /**
     * The template's next generation date **after** this call consumed the
     * pending occurrence. `null` when the advance took the template past
     * its `end_date` and its status is now `COMPLETED`: there is no next
     * generation left.
     * 
     *
     * @var \DateTime|null
     */
    protected $nextGeneration;
    /**
     * @return string
     */
    public function getInvoiceId(): string
    {
        return $this->invoiceId;
    }
    /**
     * @param string $invoiceId
     *
     * @return self
     */
    public function setInvoiceId(string $invoiceId): self
    {
        $this->initialized['invoiceId'] = true;
        $this->invoiceId = $invoiceId;
        return $this;
    }
    /**
     * The template's next generation date **after** this call consumed the
     * pending occurrence. `null` when the advance took the template past
     * its `end_date` and its status is now `COMPLETED`: there is no next
     * generation left.
     * 
     *
     * @return \DateTime|null
     */
    public function getNextGeneration(): ?\DateTime
    {
        return $this->nextGeneration;
    }
    /**
    * The template's next generation date **after** this call consumed the
    pending occurrence. `null` when the advance took the template past
    its `end_date` and its status is now `COMPLETED`: there is no next
    generation left.
    
    *
    * @param \DateTime|null $nextGeneration
    *
    * @return self
    */
    public function setNextGeneration(?\DateTime $nextGeneration): self
    {
        $this->initialized['nextGeneration'] = true;
        $this->nextGeneration = $nextGeneration;
        return $this;
    }
    public function definedProperties(): array
    {
        return ['invoiceId' => ['invoice_id', 'getInvoiceId', 'setInvoiceId'], 'nextGeneration' => ['next_generation', 'getNextGeneration', 'setNextGeneration']];
    }
}