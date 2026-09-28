<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;
class V1CompaniesCompanyIdInvoicesInvoiceIdVerifactuRecordsGetResponse200Data implements AdditionalPropertiesInterface
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
     * @var list<VeriFactuRecord>
     */
    protected $records;
    /**
     * @return list<VeriFactuRecord>
     */
    public function getRecords(): array
    {
        return $this->records;
    }
    /**
     * @param list<VeriFactuRecord> $records
     *
     * @return self
     */
    public function setRecords(array $records): self
    {
        $this->initialized['records'] = true;
        $this->records = $records;
        return $this;
    }
    public function definedProperties(): array
    {
        return ['records' => ['records', 'getRecords', 'setRecords']];
    }
}