<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;

class V1AccountsAccountIdInvitationsGetResponse200Data implements AdditionalPropertiesInterface
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
     * @var list<InvitationSummary>
     */
    protected $invitations;

    /**
     * @var Pagination
     */
    protected $pagination;

    /**
     * @return list<InvitationSummary>
     */
    public function getInvitations(): array
    {
        return $this->invitations;
    }

    /**
     * @param  list<InvitationSummary>  $invitations
     */
    public function setInvitations(array $invitations): self
    {
        $this->initialized['invitations'] = true;
        $this->invitations = $invitations;

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
        return ['invitations' => ['invitations', 'getInvitations', 'setInvitations'], 'pagination' => ['pagination', 'getPagination', 'setPagination']];
    }
}
