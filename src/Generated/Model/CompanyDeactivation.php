<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;
class CompanyDeactivation implements AdditionalPropertiesInterface
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
     * When the switch-off takes effect. Absent when immediate (Test, or Live under an enterprise contract). Until then the NIF still invoices and is not released.
     *
     * @var \DateTime|null
     */
    protected $effectiveAt;
    /**
     * The switch-off was already pending; the same date is returned.
     *
     * @var bool
     */
    protected $alreadyScheduled;
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
     * When the switch-off takes effect. Absent when immediate (Test, or Live under an enterprise contract). Until then the NIF still invoices and is not released.
     *
     * @return \DateTime|null
     */
    public function getEffectiveAt(): ?\DateTime
    {
        return $this->effectiveAt;
    }
    /**
     * When the switch-off takes effect. Absent when immediate (Test, or Live under an enterprise contract). Until then the NIF still invoices and is not released.
     *
     * @param \DateTime|null $effectiveAt
     *
     * @return self
     */
    public function setEffectiveAt(?\DateTime $effectiveAt): self
    {
        $this->initialized['effectiveAt'] = true;
        $this->effectiveAt = $effectiveAt;
        return $this;
    }
    /**
     * The switch-off was already pending; the same date is returned.
     *
     * @return bool
     */
    public function getAlreadyScheduled(): bool
    {
        return $this->alreadyScheduled;
    }
    /**
     * The switch-off was already pending; the same date is returned.
     *
     * @param bool $alreadyScheduled
     *
     * @return self
     */
    public function setAlreadyScheduled(bool $alreadyScheduled): self
    {
        $this->initialized['alreadyScheduled'] = true;
        $this->alreadyScheduled = $alreadyScheduled;
        return $this;
    }
    public function definedProperties(): array
    {
        return ['companyId' => ['company_id', 'getCompanyId', 'setCompanyId'], 'environment' => ['environment', 'getEnvironment', 'setEnvironment'], 'effectiveAt' => ['effective_at', 'getEffectiveAt', 'setEffectiveAt'], 'alreadyScheduled' => ['already_scheduled', 'getAlreadyScheduled', 'setAlreadyScheduled']];
    }
}