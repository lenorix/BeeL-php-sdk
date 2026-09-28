<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;

class PutMemberGrantRequest implements AdditionalPropertiesInterface
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
     * Access the member gets over this company.
     *
     * @var string
     */
    protected $accessLevel;

    /**
     * Access the member gets over this company.
     */
    public function getAccessLevel(): string
    {
        return $this->accessLevel;
    }

    /**
     * Access the member gets over this company.
     */
    public function setAccessLevel(string $accessLevel): self
    {
        $this->initialized['accessLevel'] = true;
        $this->accessLevel = $accessLevel;

        return $this;
    }

    public function definedProperties(): array
    {
        return ['accessLevel' => ['access_level', 'getAccessLevel', 'setAccessLevel']];
    }
}
