<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;
class RecurringInvoiceStatsBlock implements AdditionalPropertiesInterface
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
     * Schedules in this block, priced or not. It counts schedules, not money, so a schedule
     * whose amount could not be computed is still counted here.
     * 
     *
     * @var int
     */
    protected $count;
    /**
     * Sum of what each schedule in this block will charge on its next invoice — the very same
     * per-schedule number the list publishes as `amount`, added up. Adding the `amount` of the
     * rows by hand gives exactly this figure, to the cent: it is one arithmetic, not two.
     * 
     * It covers `count − uncounted_count` schedules: the ones that could not be priced are
     * **not** added as zero, they are left out and counted in `uncounted_count`.
     * 
     * **Literal, not normalised.** Every schedule is monthly today, so adding the next
     * invoices already is a per-month figure. It is not converted across frequencies, and it
     * is not an MRR: it carries taxes and withholding exactly as the invoice will.
     * 
     * Always a number, never `null` — with no schedules at all it is `0`.
     * 
     *
     * @var float
     */
    protected $monthlyAmount;
    /**
     * Schedules of this block whose lines the engine could not price — the same ones the list
     * returns with `amount: null` (no lines, or lines the engine rejects). They are excluded
     * from `monthly_amount` and counted here, so a partial total never passes for a complete
     * one. `0` means the total covers every schedule in the block.
     * 
     *
     * @var int
     */
    protected $uncountedCount;
    /**
     * Schedules in this block, priced or not. It counts schedules, not money, so a schedule
     * whose amount could not be computed is still counted here.
     * 
     *
     * @return int
     */
    public function getCount(): int
    {
        return $this->count;
    }
    /**
    * Schedules in this block, priced or not. It counts schedules, not money, so a schedule
    whose amount could not be computed is still counted here.
    
    *
    * @param int $count
    *
    * @return self
    */
    public function setCount(int $count): self
    {
        $this->initialized['count'] = true;
        $this->count = $count;
        return $this;
    }
    /**
     * Sum of what each schedule in this block will charge on its next invoice — the very same
     * per-schedule number the list publishes as `amount`, added up. Adding the `amount` of the
     * rows by hand gives exactly this figure, to the cent: it is one arithmetic, not two.
     * 
     * It covers `count − uncounted_count` schedules: the ones that could not be priced are
     * **not** added as zero, they are left out and counted in `uncounted_count`.
     * 
     * **Literal, not normalised.** Every schedule is monthly today, so adding the next
     * invoices already is a per-month figure. It is not converted across frequencies, and it
     * is not an MRR: it carries taxes and withholding exactly as the invoice will.
     * 
     * Always a number, never `null` — with no schedules at all it is `0`.
     * 
     *
     * @return float
     */
    public function getMonthlyAmount(): float
    {
        return $this->monthlyAmount;
    }
    /**
    * Sum of what each schedule in this block will charge on its next invoice — the very same
    per-schedule number the list publishes as `amount`, added up. Adding the `amount` of the
    rows by hand gives exactly this figure, to the cent: it is one arithmetic, not two.
    
    It covers `count − uncounted_count` schedules: the ones that could not be priced are
    **not** added as zero, they are left out and counted in `uncounted_count`.
    
    **Literal, not normalised.** Every schedule is monthly today, so adding the next
    invoices already is a per-month figure. It is not converted across frequencies, and it
    is not an MRR: it carries taxes and withholding exactly as the invoice will.
    
    Always a number, never `null` — with no schedules at all it is `0`.
    
    *
    * @param float $monthlyAmount
    *
    * @return self
    */
    public function setMonthlyAmount(float $monthlyAmount): self
    {
        $this->initialized['monthlyAmount'] = true;
        $this->monthlyAmount = $monthlyAmount;
        return $this;
    }
    /**
     * Schedules of this block whose lines the engine could not price — the same ones the list
     * returns with `amount: null` (no lines, or lines the engine rejects). They are excluded
     * from `monthly_amount` and counted here, so a partial total never passes for a complete
     * one. `0` means the total covers every schedule in the block.
     * 
     *
     * @return int
     */
    public function getUncountedCount(): int
    {
        return $this->uncountedCount;
    }
    /**
    * Schedules of this block whose lines the engine could not price — the same ones the list
    returns with `amount: null` (no lines, or lines the engine rejects). They are excluded
    from `monthly_amount` and counted here, so a partial total never passes for a complete
    one. `0` means the total covers every schedule in the block.
    
    *
    * @param int $uncountedCount
    *
    * @return self
    */
    public function setUncountedCount(int $uncountedCount): self
    {
        $this->initialized['uncountedCount'] = true;
        $this->uncountedCount = $uncountedCount;
        return $this;
    }
    public function definedProperties(): array
    {
        return ['count' => ['count', 'getCount', 'setCount'], 'monthlyAmount' => ['monthly_amount', 'getMonthlyAmount', 'setMonthlyAmount'], 'uncountedCount' => ['uncounted_count', 'getUncountedCount', 'setUncountedCount']];
    }
}