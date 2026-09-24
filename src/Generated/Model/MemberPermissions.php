<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;
class MemberPermissions implements AdditionalPropertiesInterface
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
     * Whether the caller may change this member's role (to one of `assignable_roles`).
     *
     * @var bool
     */
    protected $canChangeRole;
    /**
     * Roles the caller may assign to this member (excludes the current one, the ones reserved to a higher role, and always `OWNER` — ownership is handed over with `can_transfer_ownership`, not by assigning the role).
     *
     * @var list<string>
     */
    protected $assignableRoles;
    /**
     * Whether the caller may remove this member from the account.
     *
     * @var bool
     */
    protected $canRemove;
    /**
     * Whether the caller (OWNER) may transfer ownership to this member.
     *
     * @var bool
     */
    protected $canTransferOwnership;
    /**
     * Whether the caller may edit this member's company grants (MEMBER only).
     *
     * @var bool
     */
    protected $canEditGrants;
    /**
     * Whether the caller may change this member's role (to one of `assignable_roles`).
     *
     * @return bool
     */
    public function getCanChangeRole(): bool
    {
        return $this->canChangeRole;
    }
    /**
     * Whether the caller may change this member's role (to one of `assignable_roles`).
     *
     * @param bool $canChangeRole
     *
     * @return self
     */
    public function setCanChangeRole(bool $canChangeRole): self
    {
        $this->initialized['canChangeRole'] = true;
        $this->canChangeRole = $canChangeRole;
        return $this;
    }
    /**
     * Roles the caller may assign to this member (excludes the current one, the ones reserved to a higher role, and always `OWNER` — ownership is handed over with `can_transfer_ownership`, not by assigning the role).
     *
     * @return list<string>
     */
    public function getAssignableRoles(): array
    {
        return $this->assignableRoles;
    }
    /**
     * Roles the caller may assign to this member (excludes the current one, the ones reserved to a higher role, and always `OWNER` — ownership is handed over with `can_transfer_ownership`, not by assigning the role).
     *
     * @param list<string> $assignableRoles
     *
     * @return self
     */
    public function setAssignableRoles(array $assignableRoles): self
    {
        $this->initialized['assignableRoles'] = true;
        $this->assignableRoles = $assignableRoles;
        return $this;
    }
    /**
     * Whether the caller may remove this member from the account.
     *
     * @return bool
     */
    public function getCanRemove(): bool
    {
        return $this->canRemove;
    }
    /**
     * Whether the caller may remove this member from the account.
     *
     * @param bool $canRemove
     *
     * @return self
     */
    public function setCanRemove(bool $canRemove): self
    {
        $this->initialized['canRemove'] = true;
        $this->canRemove = $canRemove;
        return $this;
    }
    /**
     * Whether the caller (OWNER) may transfer ownership to this member.
     *
     * @return bool
     */
    public function getCanTransferOwnership(): bool
    {
        return $this->canTransferOwnership;
    }
    /**
     * Whether the caller (OWNER) may transfer ownership to this member.
     *
     * @param bool $canTransferOwnership
     *
     * @return self
     */
    public function setCanTransferOwnership(bool $canTransferOwnership): self
    {
        $this->initialized['canTransferOwnership'] = true;
        $this->canTransferOwnership = $canTransferOwnership;
        return $this;
    }
    /**
     * Whether the caller may edit this member's company grants (MEMBER only).
     *
     * @return bool
     */
    public function getCanEditGrants(): bool
    {
        return $this->canEditGrants;
    }
    /**
     * Whether the caller may edit this member's company grants (MEMBER only).
     *
     * @param bool $canEditGrants
     *
     * @return self
     */
    public function setCanEditGrants(bool $canEditGrants): self
    {
        $this->initialized['canEditGrants'] = true;
        $this->canEditGrants = $canEditGrants;
        return $this;
    }
    public function definedProperties(): array
    {
        return ['canChangeRole' => ['can_change_role', 'getCanChangeRole', 'setCanChangeRole'], 'assignableRoles' => ['assignable_roles', 'getAssignableRoles', 'setAssignableRoles'], 'canRemove' => ['can_remove', 'getCanRemove', 'setCanRemove'], 'canTransferOwnership' => ['can_transfer_ownership', 'getCanTransferOwnership', 'setCanTransferOwnership'], 'canEditGrants' => ['can_edit_grants', 'getCanEditGrants', 'setCanEditGrants']];
    }
}