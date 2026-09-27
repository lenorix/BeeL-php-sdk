<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;
class AccountImportStatistics implements AdditionalPropertiesInterface
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
     * @var int
     */
    protected $valid;
    /**
     * @var int
     */
    protected $withWarnings;
    /**
     * @var int
     */
    protected $alreadyExisted;
    /**
     * @var int
     */
    protected $blocked;
    /**
     * @var int
     */
    protected $withErrors;
    /**
     * `valid + with_warnings` — rows a real import would provision.
     *
     * @var int
     */
    protected $importable;
    /**
     * Accounts actually provisioned by this request. Always `0` in a preview.
     *
     * @var int
     */
    protected $accountsCreated;
    /**
     * NIFs actually switched on by this request. In Live each one adds an item to your subscription, so this is what was billed. Always `0` in a preview.
     *
     * @var int
     */
    protected $liveActivationsCreated;
    /**
     * NIFs a real import **would** switch on. In a preview this is the billing forecast — read it before importing; in an import it is what is left, normally `0`.
     *
     * @var int
     */
    protected $liveActivationsPending;
    /**
     * @var int
     */
    protected $seriesCreated;
    /**
     * Customer rows created across all **managed accounts** of the file. `null` when no customers file was sent, and `0` in a preview. Your own company, when `options.apply_customers_to_own_company` asked for it, is counted apart in `own_company_customers` and never here.
     *
     * @var int|null
     */
    protected $customersCreated;
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
     * @return int
     */
    public function getValid(): int
    {
        return $this->valid;
    }
    /**
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
     * @return int
     */
    public function getWithWarnings(): int
    {
        return $this->withWarnings;
    }
    /**
     * @param int $withWarnings
     *
     * @return self
     */
    public function setWithWarnings(int $withWarnings): self
    {
        $this->initialized['withWarnings'] = true;
        $this->withWarnings = $withWarnings;
        return $this;
    }
    /**
     * @return int
     */
    public function getAlreadyExisted(): int
    {
        return $this->alreadyExisted;
    }
    /**
     * @param int $alreadyExisted
     *
     * @return self
     */
    public function setAlreadyExisted(int $alreadyExisted): self
    {
        $this->initialized['alreadyExisted'] = true;
        $this->alreadyExisted = $alreadyExisted;
        return $this;
    }
    /**
     * @return int
     */
    public function getBlocked(): int
    {
        return $this->blocked;
    }
    /**
     * @param int $blocked
     *
     * @return self
     */
    public function setBlocked(int $blocked): self
    {
        $this->initialized['blocked'] = true;
        $this->blocked = $blocked;
        return $this;
    }
    /**
     * @return int
     */
    public function getWithErrors(): int
    {
        return $this->withErrors;
    }
    /**
     * @param int $withErrors
     *
     * @return self
     */
    public function setWithErrors(int $withErrors): self
    {
        $this->initialized['withErrors'] = true;
        $this->withErrors = $withErrors;
        return $this;
    }
    /**
     * `valid + with_warnings` — rows a real import would provision.
     *
     * @return int
     */
    public function getImportable(): int
    {
        return $this->importable;
    }
    /**
     * `valid + with_warnings` — rows a real import would provision.
     *
     * @param int $importable
     *
     * @return self
     */
    public function setImportable(int $importable): self
    {
        $this->initialized['importable'] = true;
        $this->importable = $importable;
        return $this;
    }
    /**
     * Accounts actually provisioned by this request. Always `0` in a preview.
     *
     * @return int
     */
    public function getAccountsCreated(): int
    {
        return $this->accountsCreated;
    }
    /**
     * Accounts actually provisioned by this request. Always `0` in a preview.
     *
     * @param int $accountsCreated
     *
     * @return self
     */
    public function setAccountsCreated(int $accountsCreated): self
    {
        $this->initialized['accountsCreated'] = true;
        $this->accountsCreated = $accountsCreated;
        return $this;
    }
    /**
     * NIFs actually switched on by this request. In Live each one adds an item to your subscription, so this is what was billed. Always `0` in a preview.
     *
     * @return int
     */
    public function getLiveActivationsCreated(): int
    {
        return $this->liveActivationsCreated;
    }
    /**
     * NIFs actually switched on by this request. In Live each one adds an item to your subscription, so this is what was billed. Always `0` in a preview.
     *
     * @param int $liveActivationsCreated
     *
     * @return self
     */
    public function setLiveActivationsCreated(int $liveActivationsCreated): self
    {
        $this->initialized['liveActivationsCreated'] = true;
        $this->liveActivationsCreated = $liveActivationsCreated;
        return $this;
    }
    /**
     * NIFs a real import **would** switch on. In a preview this is the billing forecast — read it before importing; in an import it is what is left, normally `0`.
     *
     * @return int
     */
    public function getLiveActivationsPending(): int
    {
        return $this->liveActivationsPending;
    }
    /**
     * NIFs a real import **would** switch on. In a preview this is the billing forecast — read it before importing; in an import it is what is left, normally `0`.
     *
     * @param int $liveActivationsPending
     *
     * @return self
     */
    public function setLiveActivationsPending(int $liveActivationsPending): self
    {
        $this->initialized['liveActivationsPending'] = true;
        $this->liveActivationsPending = $liveActivationsPending;
        return $this;
    }
    /**
     * @return int
     */
    public function getSeriesCreated(): int
    {
        return $this->seriesCreated;
    }
    /**
     * @param int $seriesCreated
     *
     * @return self
     */
    public function setSeriesCreated(int $seriesCreated): self
    {
        $this->initialized['seriesCreated'] = true;
        $this->seriesCreated = $seriesCreated;
        return $this;
    }
    /**
     * Customer rows created across all **managed accounts** of the file. `null` when no customers file was sent, and `0` in a preview. Your own company, when `options.apply_customers_to_own_company` asked for it, is counted apart in `own_company_customers` and never here.
     *
     * @return int|null
     */
    public function getCustomersCreated(): ?int
    {
        return $this->customersCreated;
    }
    /**
     * Customer rows created across all **managed accounts** of the file. `null` when no customers file was sent, and `0` in a preview. Your own company, when `options.apply_customers_to_own_company` asked for it, is counted apart in `own_company_customers` and never here.
     *
     * @param int|null $customersCreated
     *
     * @return self
     */
    public function setCustomersCreated(?int $customersCreated): self
    {
        $this->initialized['customersCreated'] = true;
        $this->customersCreated = $customersCreated;
        return $this;
    }
    public function definedProperties(): array
    {
        return ['totalRows' => ['total_rows', 'getTotalRows', 'setTotalRows'], 'valid' => ['valid', 'getValid', 'setValid'], 'withWarnings' => ['with_warnings', 'getWithWarnings', 'setWithWarnings'], 'alreadyExisted' => ['already_existed', 'getAlreadyExisted', 'setAlreadyExisted'], 'blocked' => ['blocked', 'getBlocked', 'setBlocked'], 'withErrors' => ['with_errors', 'getWithErrors', 'setWithErrors'], 'importable' => ['importable', 'getImportable', 'setImportable'], 'accountsCreated' => ['accounts_created', 'getAccountsCreated', 'setAccountsCreated'], 'liveActivationsCreated' => ['live_activations_created', 'getLiveActivationsCreated', 'setLiveActivationsCreated'], 'liveActivationsPending' => ['live_activations_pending', 'getLiveActivationsPending', 'setLiveActivationsPending'], 'seriesCreated' => ['series_created', 'getSeriesCreated', 'setSeriesCreated'], 'customersCreated' => ['customers_created', 'getCustomersCreated', 'setCustomersCreated']];
    }
}