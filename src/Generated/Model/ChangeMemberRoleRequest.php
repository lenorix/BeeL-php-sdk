<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;

class ChangeMemberRoleRequest implements AdditionalPropertiesInterface
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
     * Who administers the account. Independent of `access_level`, which says how much access someone has to a given company.
     *
     * `OWNER` — full control, including billing, API keys and transferring ownership. Exactly one per account, so it is never an accepted value when you SET a role (inviting a member or changing one's role): both reject it with `422 OWNER_ROLE_NOT_ASSIGNABLE`. Ownership moves only through `PUT /v1/accounts/{account_id}/owner`.
     * `ADMIN` — everything an `OWNER` can do, except transferring ownership.
     * `MEMBER` — no account administration. Access to each company is granted individually and reported as `access_level`; a member only sees the companies granted to them.
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
     */
    public function setAccountRole(string $accountRole): self
    {
        $this->initialized['accountRole'] = true;
        $this->accountRole = $accountRole;

        return $this;
    }

    public function definedProperties(): array
    {
        return ['accountRole' => ['account_role', 'getAccountRole', 'setAccountRole']];
    }
}
