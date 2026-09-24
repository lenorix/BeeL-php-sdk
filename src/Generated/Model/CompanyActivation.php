<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;
class CompanyActivation implements AdditionalPropertiesInterface
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
    protected $companyId;
    /**
     * Mode a record lives in — its Test/Live twin. It decides where invoices, customers and
     * quota are accounted.
     * 
     * For a company it also decides which AEAT its NIF is registered against: switching a
     * company on in `PROD` is what registers it with the real AEAT, so `aeat_environment`
     * is that same mode and uses this same enum.
     * 
     *
     * @var string
     */
    protected $environment;
    /**
     * The company was already on in that mode and nothing was written.
     *
     * @var bool
     */
    protected $alreadyActive;
    /**
     * The call removed a pending switch-off. Comes with `already_active: true`, since the activation never stopped being live. Nothing was charged or credited.
     *
     * @var bool
     */
    protected $scheduledDeactivationCancelled;
    /**
     * @return string
     */
    public function getCompanyId(): string
    {
        return $this->companyId;
    }
    /**
     * @param string $companyId
     *
     * @return self
     */
    public function setCompanyId(string $companyId): self
    {
        $this->initialized['companyId'] = true;
        $this->companyId = $companyId;
        return $this;
    }
    /**
     * Mode a record lives in — its Test/Live twin. It decides where invoices, customers and
     * quota are accounted.
     * 
     * For a company it also decides which AEAT its NIF is registered against: switching a
     * company on in `PROD` is what registers it with the real AEAT, so `aeat_environment`
     * is that same mode and uses this same enum.
     * 
     *
     * @return string
     */
    public function getEnvironment(): string
    {
        return $this->environment;
    }
    /**
    * Mode a record lives in — its Test/Live twin. It decides where invoices, customers and
    quota are accounted.
    
    For a company it also decides which AEAT its NIF is registered against: switching a
    company on in `PROD` is what registers it with the real AEAT, so `aeat_environment`
    is that same mode and uses this same enum.
    
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
    /**
     * The company was already on in that mode and nothing was written.
     *
     * @return bool
     */
    public function getAlreadyActive(): bool
    {
        return $this->alreadyActive;
    }
    /**
     * The company was already on in that mode and nothing was written.
     *
     * @param bool $alreadyActive
     *
     * @return self
     */
    public function setAlreadyActive(bool $alreadyActive): self
    {
        $this->initialized['alreadyActive'] = true;
        $this->alreadyActive = $alreadyActive;
        return $this;
    }
    /**
     * The call removed a pending switch-off. Comes with `already_active: true`, since the activation never stopped being live. Nothing was charged or credited.
     *
     * @return bool
     */
    public function getScheduledDeactivationCancelled(): bool
    {
        return $this->scheduledDeactivationCancelled;
    }
    /**
     * The call removed a pending switch-off. Comes with `already_active: true`, since the activation never stopped being live. Nothing was charged or credited.
     *
     * @param bool $scheduledDeactivationCancelled
     *
     * @return self
     */
    public function setScheduledDeactivationCancelled(bool $scheduledDeactivationCancelled): self
    {
        $this->initialized['scheduledDeactivationCancelled'] = true;
        $this->scheduledDeactivationCancelled = $scheduledDeactivationCancelled;
        return $this;
    }
    public function definedProperties(): array
    {
        return ['companyId' => ['company_id', 'getCompanyId', 'setCompanyId'], 'environment' => ['environment', 'getEnvironment', 'setEnvironment'], 'alreadyActive' => ['already_active', 'getAlreadyActive', 'setAlreadyActive'], 'scheduledDeactivationCancelled' => ['scheduled_deactivation_cancelled', 'getScheduledDeactivationCancelled', 'setScheduledDeactivationCancelled']];
    }
}