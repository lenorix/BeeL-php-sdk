<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;

class CorrectiveInvoiceErrorDetails implements AdditionalPropertiesInterface
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
     * The rate whose taxable base the corrective would take below zero: the tax, its rate and,
     * when there is one, the equivalence surcharge (`IVA 21%`, `IVA 21% + RE 5.2%`), or
     * `SUPLIDO` for disbursements (`CORRECTIVE_EXCEEDS_INVOICED_AMOUNT`).
     *
     *
     * @var string
     */
    protected $taxGroup;

    /**
     * How much of that rate is still invoiced and can be rectified downwards, in euros with
     * two decimals: the original plus the correctives already issued against it
     * (`CORRECTIVE_EXCEEDS_INVOICED_AMOUNT`).
     *
     *
     * @var string
     */
    protected $maxReduction;

    /**
     * The last day on which the corrective could have been issued: four years after
     * `counted_from` (`CORRECTIVE_OUT_OF_TIME`).
     *
     *
     * @var \DateTime
     */
    protected $deadline;

    /**
     * The date a period counts from. For `CORRECTIVE_OUT_OF_TIME`, the original's operation
     * date (its `operation_date`, or its `issue_date` when it has none) or the
     * `circumstance_date` of an article 80 cause when one was sent. For
     * `CORRECTIVE_BAD_DEBT_TOO_EARLY`, the original's operation date.
     *
     *
     * @var \DateTime
     */
    protected $countedFrom;

    /**
     * The first day on which a bad-debt corrective (`R3`) is possible: six months after the
     * original's operation date, which is `counted_from` (`CORRECTIVE_BAD_DEBT_TOO_EARLY`).
     * One year applies instead when the previous year's turnover exceeded 6,010,121.04 €.
     *
     *
     * @var \DateTime
     */
    protected $earliestDate;

    /**
     * The rate whose taxable base the corrective would take below zero: the tax, its rate and,
     * when there is one, the equivalence surcharge (`IVA 21%`, `IVA 21% + RE 5.2%`), or
     * `SUPLIDO` for disbursements (`CORRECTIVE_EXCEEDS_INVOICED_AMOUNT`).
     */
    public function getTaxGroup(): string
    {
        return $this->taxGroup;
    }

    /**
     * The rate whose taxable base the corrective would take below zero: the tax, its rate and,
    when there is one, the equivalence surcharge (`IVA 21%`, `IVA 21% + RE 5.2%`), or
    `SUPLIDO` for disbursements (`CORRECTIVE_EXCEEDS_INVOICED_AMOUNT`).
     */
    public function setTaxGroup(string $taxGroup): self
    {
        $this->initialized['taxGroup'] = true;
        $this->taxGroup = $taxGroup;

        return $this;
    }

    /**
     * How much of that rate is still invoiced and can be rectified downwards, in euros with
     * two decimals: the original plus the correctives already issued against it
     * (`CORRECTIVE_EXCEEDS_INVOICED_AMOUNT`).
     */
    public function getMaxReduction(): string
    {
        return $this->maxReduction;
    }

    /**
     * How much of that rate is still invoiced and can be rectified downwards, in euros with
    two decimals: the original plus the correctives already issued against it
    (`CORRECTIVE_EXCEEDS_INVOICED_AMOUNT`).
     */
    public function setMaxReduction(string $maxReduction): self
    {
        $this->initialized['maxReduction'] = true;
        $this->maxReduction = $maxReduction;

        return $this;
    }

    /**
     * The last day on which the corrective could have been issued: four years after
     * `counted_from` (`CORRECTIVE_OUT_OF_TIME`).
     */
    public function getDeadline(): \DateTime
    {
        return $this->deadline;
    }

    /**
     * The last day on which the corrective could have been issued: four years after
    `counted_from` (`CORRECTIVE_OUT_OF_TIME`).
     */
    public function setDeadline(\DateTime $deadline): self
    {
        $this->initialized['deadline'] = true;
        $this->deadline = $deadline;

        return $this;
    }

    /**
     * The date a period counts from. For `CORRECTIVE_OUT_OF_TIME`, the original's operation
     * date (its `operation_date`, or its `issue_date` when it has none) or the
     * `circumstance_date` of an article 80 cause when one was sent. For
     * `CORRECTIVE_BAD_DEBT_TOO_EARLY`, the original's operation date.
     */
    public function getCountedFrom(): \DateTime
    {
        return $this->countedFrom;
    }

    /**
     * The date a period counts from. For `CORRECTIVE_OUT_OF_TIME`, the original's operation
    date (its `operation_date`, or its `issue_date` when it has none) or the
    `circumstance_date` of an article 80 cause when one was sent. For
    `CORRECTIVE_BAD_DEBT_TOO_EARLY`, the original's operation date.
     */
    public function setCountedFrom(\DateTime $countedFrom): self
    {
        $this->initialized['countedFrom'] = true;
        $this->countedFrom = $countedFrom;

        return $this;
    }

    /**
     * The first day on which a bad-debt corrective (`R3`) is possible: six months after the
     * original's operation date, which is `counted_from` (`CORRECTIVE_BAD_DEBT_TOO_EARLY`).
     * One year applies instead when the previous year's turnover exceeded 6,010,121.04 €.
     */
    public function getEarliestDate(): \DateTime
    {
        return $this->earliestDate;
    }

    /**
     * The first day on which a bad-debt corrective (`R3`) is possible: six months after the
    original's operation date, which is `counted_from` (`CORRECTIVE_BAD_DEBT_TOO_EARLY`).
    One year applies instead when the previous year's turnover exceeded 6,010,121.04 €.
     */
    public function setEarliestDate(\DateTime $earliestDate): self
    {
        $this->initialized['earliestDate'] = true;
        $this->earliestDate = $earliestDate;

        return $this;
    }

    public function definedProperties(): array
    {
        return ['taxGroup' => ['tax_group', 'getTaxGroup', 'setTaxGroup'], 'maxReduction' => ['max_reduction', 'getMaxReduction', 'setMaxReduction'], 'deadline' => ['deadline', 'getDeadline', 'setDeadline'], 'countedFrom' => ['counted_from', 'getCountedFrom', 'setCountedFrom'], 'earliestDate' => ['earliest_date', 'getEarliestDate', 'setEarliestDate']];
    }
}
