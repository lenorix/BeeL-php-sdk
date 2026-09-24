<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;

class SetAccountOwnerRequest implements AdditionalPropertiesInterface
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
     * Membership UUID of the member who becomes OWNER.
     *
     * @var string
     */
    protected $memberId;

    /**
     * Membership UUID of the member who becomes OWNER.
     */
    public function getMemberId(): string
    {
        return $this->memberId;
    }

    /**
     * Membership UUID of the member who becomes OWNER.
     */
    public function setMemberId(string $memberId): self
    {
        $this->initialized['memberId'] = true;
        $this->memberId = $memberId;

        return $this;
    }

    public function definedProperties(): array
    {
        return ['memberId' => ['member_id', 'getMemberId', 'setMemberId']];
    }
}
