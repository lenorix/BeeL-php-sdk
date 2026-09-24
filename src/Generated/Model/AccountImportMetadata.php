<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;
class AccountImportMetadata implements AdditionalPropertiesInterface
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
     * `true` for the preview (nothing was written), `false` for the import. It is what tells the two answers apart when they are stored side by side.
     *
     * @var bool
     */
    protected $isDryRun;
    /**
     * Data rows found in the accounts file, header excluded.
     *
     * @var int
     */
    protected $totalRows;
    /**
     * @var int
     */
    protected $processingTimeMs;
    /**
     * Name of the uploaded accounts file, as your client sent it.
     *
     * @var string|null
     */
    protected $accountsFilename;
    /**
     * Name of the uploaded customers file; `null` when none was sent.
     *
     * @var string|null
     */
    protected $customersFilename;
    /**
     * The mode this import ran in, taken from the credential. Restated because it decides whether the NIFs were switched on against the real AEAT and whether anything was billed.
     *
     * @var string
     */
    protected $environment;
    /**
     * `true` for the preview (nothing was written), `false` for the import. It is what tells the two answers apart when they are stored side by side.
     *
     * @return bool
     */
    public function getIsDryRun(): bool
    {
        return $this->isDryRun;
    }
    /**
     * `true` for the preview (nothing was written), `false` for the import. It is what tells the two answers apart when they are stored side by side.
     *
     * @param bool $isDryRun
     *
     * @return self
     */
    public function setIsDryRun(bool $isDryRun): self
    {
        $this->initialized['isDryRun'] = true;
        $this->isDryRun = $isDryRun;
        return $this;
    }
    /**
     * Data rows found in the accounts file, header excluded.
     *
     * @return int
     */
    public function getTotalRows(): int
    {
        return $this->totalRows;
    }
    /**
     * Data rows found in the accounts file, header excluded.
     *
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
     * @return int
     */
    public function getProcessingTimeMs(): int
    {
        return $this->processingTimeMs;
    }
    /**
     * @param int $processingTimeMs
     *
     * @return self
     */
    public function setProcessingTimeMs(int $processingTimeMs): self
    {
        $this->initialized['processingTimeMs'] = true;
        $this->processingTimeMs = $processingTimeMs;
        return $this;
    }
    /**
     * Name of the uploaded accounts file, as your client sent it.
     *
     * @return string|null
     */
    public function getAccountsFilename(): ?string
    {
        return $this->accountsFilename;
    }
    /**
     * Name of the uploaded accounts file, as your client sent it.
     *
     * @param string|null $accountsFilename
     *
     * @return self
     */
    public function setAccountsFilename(?string $accountsFilename): self
    {
        $this->initialized['accountsFilename'] = true;
        $this->accountsFilename = $accountsFilename;
        return $this;
    }
    /**
     * Name of the uploaded customers file; `null` when none was sent.
     *
     * @return string|null
     */
    public function getCustomersFilename(): ?string
    {
        return $this->customersFilename;
    }
    /**
     * Name of the uploaded customers file; `null` when none was sent.
     *
     * @param string|null $customersFilename
     *
     * @return self
     */
    public function setCustomersFilename(?string $customersFilename): self
    {
        $this->initialized['customersFilename'] = true;
        $this->customersFilename = $customersFilename;
        return $this;
    }
    /**
     * The mode this import ran in, taken from the credential. Restated because it decides whether the NIFs were switched on against the real AEAT and whether anything was billed.
     *
     * @return string
     */
    public function getEnvironment(): string
    {
        return $this->environment;
    }
    /**
     * The mode this import ran in, taken from the credential. Restated because it decides whether the NIFs were switched on against the real AEAT and whether anything was billed.
     *
     * @param string $environment
     *
     * @return self
     */
    public function setEnvironment(string $environment): self
    {
        $this->initialized['environment'] = true;
        $this->environment = $environment;
        return $this;
    }
    public function definedProperties(): array
    {
        return ['isDryRun' => ['is_dry_run', 'getIsDryRun', 'setIsDryRun'], 'totalRows' => ['total_rows', 'getTotalRows', 'setTotalRows'], 'processingTimeMs' => ['processing_time_ms', 'getProcessingTimeMs', 'setProcessingTimeMs'], 'accountsFilename' => ['accounts_filename', 'getAccountsFilename', 'setAccountsFilename'], 'customersFilename' => ['customers_filename', 'getCustomersFilename', 'setCustomersFilename'], 'environment' => ['environment', 'getEnvironment', 'setEnvironment']];
    }
}