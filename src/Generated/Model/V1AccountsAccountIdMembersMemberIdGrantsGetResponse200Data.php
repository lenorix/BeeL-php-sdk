<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;

class V1AccountsAccountIdMembersMemberIdGrantsGetResponse200Data implements AdditionalPropertiesInterface
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
     * @var list<GrantAssignment>
     */
    protected $grants;

    /**
     * @var Pagination
     */
    protected $pagination;

    /**
     * @return list<GrantAssignment>
     */
    public function getGrants(): array
    {
        return $this->grants;
    }

    /**
     * @param  list<GrantAssignment>  $grants
     */
    public function setGrants(array $grants): self
    {
        $this->initialized['grants'] = true;
        $this->grants = $grants;

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
        return ['grants' => ['grants', 'getGrants', 'setGrants'], 'pagination' => ['pagination', 'getPagination', 'setPagination']];
    }
}
