<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;
class AccountImportResultCustomersSource implements AdditionalPropertiesInterface
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
     * @var int
     */
    protected $totalRows;
    /**
     * Customers that will be applied to every account.
     *
     * @var int
     */
    protected $valid;
    /**
     * Customers that will be applied to none.
     *
     * @var int
     */
    protected $invalid;
    /**
     * The rejected rows, so you can fix the file. Valid rows are counted, not listed.
     *
     * @var list<AccountImportCustomerRow>
     */
    protected $rejected;
    /**
     * @return int
     */
    public function getTotalRows(): int
    {
        return $this->totalRows;
    }
    /**
     * @param int $totalRows
     *
     * @return self
     */
    public function setTotalRows(int $totalRows): self
    {
        $this->initialized['totalRows'] = true;
        $this->totalRows = $totalRows;
        return $this;
    }
    /**
     * Customers that will be applied to every account.
     *
     * @return int
     */
    public function getValid(): int
    {
        return $this->valid;
    }
    /**
     * Customers that will be applied to every account.
     *
     * @param int $valid
     *
     * @return self
     */
    public function setValid(int $valid): self
    {
        $this->initialized['valid'] = true;
        $this->valid = $valid;
        return $this;
    }
    /**
     * Customers that will be applied to none.
     *
     * @return int
     */
    public function getInvalid(): int
    {
        return $this->invalid;
    }
    /**
     * Customers that will be applied to none.
     *
     * @param int $invalid
     *
     * @return self
     */
    public function setInvalid(int $invalid): self
    {
        $this->initialized['invalid'] = true;
        $this->invalid = $invalid;
        return $this;
    }
    /**
     * The rejected rows, so you can fix the file. Valid rows are counted, not listed.
     *
     * @return list<AccountImportCustomerRow>
     */
    public function getRejected(): array
    {
        return $this->rejected;
    }
    /**
     * The rejected rows, so you can fix the file. Valid rows are counted, not listed.
     *
     * @param list<AccountImportCustomerRow> $rejected
     *
     * @return self
     */
    public function setRejected(array $rejected): self
    {
        $this->initialized['rejected'] = true;
        $this->rejected = $rejected;
        return $this;
    }
    public function definedProperties(): array
    {
        return ['totalRows' => ['total_rows', 'getTotalRows', 'setTotalRows'], 'valid' => ['valid', 'getValid', 'setValid'], 'invalid' => ['invalid', 'getInvalid', 'setInvalid'], 'rejected' => ['rejected', 'getRejected', 'setRejected']];
    }
}