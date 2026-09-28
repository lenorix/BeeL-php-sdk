<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;
class ProvisioningUsage implements AdditionalPropertiesInterface
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
     * Total accounts provisioned by this provisioner.
     *
     * @var int
     */
    protected $provisionedAccounts;
    /**
     * Billable count: one per provisioned account (each has a company row, placeholder or real), including empty/unclaimed accounts. Equals `provisioned_accounts` unless an account holds more than one NIF.
     *
     * @var int
     */
    protected $nifs;
    /**
     * Total accounts provisioned by this provisioner.
     *
     * @return int
     */
    public function getProvisionedAccounts(): int
    {
        return $this->provisionedAccounts;
    }
    /**
     * Total accounts provisioned by this provisioner.
     *
     * @param int $provisionedAccounts
     *
     * @return self
     */
    public function setProvisionedAccounts(int $provisionedAccounts): self
    {
        $this->initialized['provisionedAccounts'] = true;
        $this->provisionedAccounts = $provisionedAccounts;
        return $this;
    }
    /**
     * Billable count: one per provisioned account (each has a company row, placeholder or real), including empty/unclaimed accounts. Equals `provisioned_accounts` unless an account holds more than one NIF.
     *
     * @return int
     */
    public function getNifs(): int
    {
        return $this->nifs;
    }
    /**
     * Billable count: one per provisioned account (each has a company row, placeholder or real), including empty/unclaimed accounts. Equals `provisioned_accounts` unless an account holds more than one NIF.
     *
     * @param int $nifs
     *
     * @return self
     */
    public function setNifs(int $nifs): self
    {
        $this->initialized['nifs'] = true;
        $this->nifs = $nifs;
        return $this;
    }
    public function definedProperties(): array
    {
        return ['provisionedAccounts' => ['provisioned_accounts', 'getProvisionedAccounts', 'setProvisionedAccounts'], 'nifs' => ['nifs', 'getNifs', 'setNifs']];
    }
}