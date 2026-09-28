<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;
class AccountImportCustomerRow implements AdditionalPropertiesInterface
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
     * Row as the spreadsheet counts it (header is row 1).
     *
     * @var int
     */
    protected $rowNumber;
    /**
     * @var string|null
     */
    protected $nif;
    /**
     * @var string|null
     */
    protected $legalName;
    /**
     * @var list<AccountImportIssue>
     */
    protected $errors;
    /**
     * Row as the spreadsheet counts it (header is row 1).
     *
     * @return int
     */
    public function getRowNumber(): int
    {
        return $this->rowNumber;
    }
    /**
     * Row as the spreadsheet counts it (header is row 1).
     *
     * @param int $rowNumber
     *
     * @return self
     */
    public function setRowNumber(int $rowNumber): self
    {
        $this->initialized['rowNumber'] = true;
        $this->rowNumber = $rowNumber;
        return $this;
    }
    /**
     * @return string|null
     */
    public function getNif(): ?string
    {
        return $this->nif;
    }
    /**
     * @param string|null $nif
     *
     * @return self
     */
    public function setNif(?string $nif): self
    {
        $this->initialized['nif'] = true;
        $this->nif = $nif;
        return $this;
    }
    /**
     * @return string|null
     */
    public function getLegalName(): ?string
    {
        return $this->legalName;
    }
    /**
     * @param string|null $legalName
     *
     * @return self
     */
    public function setLegalName(?string $legalName): self
    {
        $this->initialized['legalName'] = true;
        $this->legalName = $legalName;
        return $this;
    }
    /**
     * @return list<AccountImportIssue>
     */
    public function getErrors(): array
    {
        return $this->errors;
    }
    /**
     * @param list<AccountImportIssue> $errors
     *
     * @return self
     */
    public function setErrors(array $errors): self
    {
        $this->initialized['errors'] = true;
        $this->errors = $errors;
        return $this;
    }
    public function definedProperties(): array
    {
        return ['rowNumber' => ['row_number', 'getRowNumber', 'setRowNumber'], 'nif' => ['nif', 'getNif', 'setNif'], 'legalName' => ['legal_name', 'getLegalName', 'setLegalName'], 'errors' => ['errors', 'getErrors', 'setErrors']];
    }
}