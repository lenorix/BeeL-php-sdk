<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;
class AccountMember implements AdditionalPropertiesInterface
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
     * Membership UUID — the handle for every member operation (change role, set grants, remove, transfer ownership). Identifies this person **in this account**.
     *
     * @var string
     */
    protected $memberId;
    /**
     * Person UUID — the stable identity of the human. The same person keeps this `person_id` in every account they belong to (with a different `member_id` in each), so you can recognise the same person across the accounts you manage. Not needed to call any endpoint.
     *
     * @var string
     */
    protected $personId;
    /**
     * Email address of the person.
     *
     * @var string|null
     */
    protected $email;
    /**
     * Who administers the account. Independent of `access_level`, which says how much access someone has to a given company.
     * 
     * `OWNER` — full control, including billing, API keys and transferring ownership. Exactly one per account, so it is never an accepted value when you SET a role (inviting a member or changing one's role): both reject it with `422 OWNER_ROLE_NOT_ASSIGNABLE`. Ownership moves only through `PUT /v1/accounts/{account_id}/owner`.
     * `ADMIN` — everything an `OWNER` can do, except transferring ownership.
     * `MEMBER` — no account administration. Access to each company is granted individually and reported as `access_level`; a member only sees the companies granted to them.
     *
     * @var string
     */
    protected $accountRole;
    /**
     * The member's company grants (empty for OWNER/ADMIN, who have implicit access to all).
     *
     * @var list<GrantAssignment>
     */
    protected $grants;
    /**
     * Which management actions you may take on THIS member, resolved by the server for the authenticated caller. Use it to decide what to offer instead of discovering the answer through a `403`. It is advisory: every action is enforced server-side regardless, so you never need to reimplement the role policy.
     *
     * @var MemberPermissions
     */
    protected $permissions;
    /**
     * Membership UUID — the handle for every member operation (change role, set grants, remove, transfer ownership). Identifies this person **in this account**.
     *
     * @return string
     */
    public function getMemberId(): string
    {
        return $this->memberId;
    }
    /**
     * Membership UUID — the handle for every member operation (change role, set grants, remove, transfer ownership). Identifies this person **in this account**.
     *
     * @param string $memberId
     *
     * @return self
     */
    public function setMemberId(string $memberId): self
    {
        $this->initialized['memberId'] = true;
        $this->memberId = $memberId;
        return $this;
    }
    /**
     * Person UUID — the stable identity of the human. The same person keeps this `person_id` in every account they belong to (with a different `member_id` in each), so you can recognise the same person across the accounts you manage. Not needed to call any endpoint.
     *
     * @return string
     */
    public function getPersonId(): string
    {
        return $this->personId;
    }
    /**
     * Person UUID — the stable identity of the human. The same person keeps this `person_id` in every account they belong to (with a different `member_id` in each), so you can recognise the same person across the accounts you manage. Not needed to call any endpoint.
     *
     * @param string $personId
     *
     * @return self
     */
    public function setPersonId(string $personId): self
    {
        $this->initialized['personId'] = true;
        $this->personId = $personId;
        return $this;
    }
    /**
     * Email address of the person.
     *
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }
    /**
     * Email address of the person.
     *
     * @param string|null $email
     *
     * @return self
     */
    public function setEmail(?string $email): self
    {
        $this->initialized['email'] = true;
        $this->email = $email;
        return $this;
    }
    /**
     * Who administers the account. Independent of `access_level`, which says how much access someone has to a given company.
     * 
     * `OWNER` — full control, including billing, API keys and transferring ownership. Exactly one per account, so it is never an accepted value when you SET a role (inviting a member or changing one's role): both reject it with `422 OWNER_ROLE_NOT_ASSIGNABLE`. Ownership moves only through `PUT /v1/accounts/{account_id}/owner`.
     * `ADMIN` — everything an `OWNER` can do, except transferring ownership.
     * `MEMBER` — no account administration. Access to each company is granted individually and reported as `access_level`; a member only sees the companies granted to them.
     *
     * @return string
     */
    public function getAccountRole(): string
    {
        return $this->accountRole;
    }
    /**
    * Who administers the account. Independent of `access_level`, which says how much access someone has to a given company.
    
    `OWNER` — full control, including billing, API keys and transferring ownership. Exactly one per account, so it is never an accepted value when you SET a role (inviting a member or changing one's role): both reject it with `422 OWNER_ROLE_NOT_ASSIGNABLE`. Ownership moves only through `PUT /v1/accounts/{account_id}/owner`.
    `ADMIN` — everything an `OWNER` can do, except transferring ownership.
    `MEMBER` — no account administration. Access to each company is granted individually and reported as `access_level`; a member only sees the companies granted to them.
    *
    * @param string $accountRole
    *
    * @return self
    */
    public function setAccountRole(string $accountRole): self
    {
        $this->initialized['accountRole'] = true;
        $this->accountRole = $accountRole;
        return $this;
    }
    /**
     * The member's company grants (empty for OWNER/ADMIN, who have implicit access to all).
     *
     * @return list<GrantAssignment>
     */
    public function getGrants(): array
    {
        return $this->grants;
    }
    /**
     * The member's company grants (empty for OWNER/ADMIN, who have implicit access to all).
     *
     * @param list<GrantAssignment> $grants
     *
     * @return self
     */
    public function setGrants(array $grants): self
    {
        $this->initialized['grants'] = true;
        $this->grants = $grants;
        return $this;
    }
    /**
     * Which management actions you may take on THIS member, resolved by the server for the authenticated caller. Use it to decide what to offer instead of discovering the answer through a `403`. It is advisory: every action is enforced server-side regardless, so you never need to reimplement the role policy.
     *
     * @return MemberPermissions
     */
    public function getPermissions(): MemberPermissions
    {
        return $this->permissions;
    }
    /**
     * Which management actions you may take on THIS member, resolved by the server for the authenticated caller. Use it to decide what to offer instead of discovering the answer through a `403`. It is advisory: every action is enforced server-side regardless, so you never need to reimplement the role policy.
     *
     * @param MemberPermissions $permissions
     *
     * @return self
     */
    public function setPermissions(MemberPermissions $permissions): self
    {
        $this->initialized['permissions'] = true;
        $this->permissions = $permissions;
        return $this;
    }
    public function definedProperties(): array
    {
        return ['memberId' => ['member_id', 'getMemberId', 'setMemberId'], 'personId' => ['person_id', 'getPersonId', 'setPersonId'], 'email' => ['email', 'getEmail', 'setEmail'], 'accountRole' => ['account_role', 'getAccountRole', 'setAccountRole'], 'grants' => ['grants', 'getGrants', 'setGrants'], 'permissions' => ['permissions', 'getPermissions', 'setPermissions']];
    }
}