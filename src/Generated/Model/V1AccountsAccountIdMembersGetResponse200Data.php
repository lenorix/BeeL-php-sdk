<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;

class V1AccountsAccountIdMembersGetResponse200Data implements AdditionalPropertiesInterface
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
     * @var list<AccountMember>
     */
    protected $members;

    /**
     * @var Pagination
     */
    protected $pagination;

    /**
     * @return list<AccountMember>
     */
    public function getMembers(): array
    {
        return $this->members;
    }

    /**
     * @param  list<AccountMember>  $members
     */
    public function setMembers(array $members): self
    {
        $this->initialized['members'] = true;
        $this->members = $members;

        return $this;
    }

    public function getPagination(): Pagination
    {
        return $this->pagination;
    }

    public function setPagination(Pagination $pagination): self
    {
        $this->initialized['pagination'] = true;
        $this->pagination = $pagination;

        return $this;
    }

    public function definedProperties(): array
    {
        return ['members' => ['members', 'getMembers', 'setMembers'], 'pagination' => ['pagination', 'getPagination', 'setPagination']];
    }
}
