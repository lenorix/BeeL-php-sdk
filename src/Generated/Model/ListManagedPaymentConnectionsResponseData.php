<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;
class ListManagedPaymentConnectionsResponseData implements AdditionalPropertiesInterface
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
     * @var list<ManagedPaymentConnection>
     */
    protected $connections;
    /**
     * @return list<ManagedPaymentConnection>
     */
    public function getConnections(): array
    {
        return $this->connections;
    }
    /**
     * @param list<ManagedPaymentConnection> $connections
     *
     * @return self
     */
    public function setConnections(array $connections): self
    {
        $this->initialized['connections'] = true;
        $this->connections = $connections;
        return $this;
    }
    public function definedProperties(): array
    {
        return ['connections' => ['connections', 'getConnections', 'setConnections']];
    }
}