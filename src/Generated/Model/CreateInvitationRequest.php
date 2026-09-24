<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;

class CreateInvitationRequest implements AdditionalPropertiesInterface
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
     * Email address of the invited person.
     *
     * @var string
     */
    protected $invitedEmail;

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
     * If `true`, an invitation email with the acceptance link is sent to `invited_email` in addition to returning the token. Defaults to `false` (you deliver the token/link yourself).
     *
     * @var bool
     */
    protected $sendEmail = false;

    /**
     * Initial grants (only when `account_role` is `MEMBER`). Required: send `[]` to invite with no company access yet (granted later). An explicit `null` is rejected with 400.
     *
     * @var list<GrantAssignment>
     */
    protected $grants = [];

    /**
     * Email address of the invited person.
     */
    public function getInvitedEmail(): string
    {
        return $this->invitedEmail;
    }

    /**
     * Email address of the invited person.
     */
    public function setInvitedEmail(string $invitedEmail): self
    {
        $this->initialized['invitedEmail'] = true;
        $this->invitedEmail = $invitedEmail;

        return $this;
    }

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

    /**
     * If `true`, an invitation email with the acceptance link is sent to `invited_email` in addition to returning the token. Defaults to `false` (you deliver the token/link yourself).
     */
    public function getSendEmail(): bool
    {
        return $this->sendEmail;
    }

    /**
     * If `true`, an invitation email with the acceptance link is sent to `invited_email` in addition to returning the token. Defaults to `false` (you deliver the token/link yourself).
     */
    public function setSendEmail(bool $sendEmail): self
    {
        $this->initialized['sendEmail'] = true;
        $this->sendEmail = $sendEmail;

        return $this;
    }

    /**
     * Initial grants (only when `account_role` is `MEMBER`). Required: send `[]` to invite with no company access yet (granted later). An explicit `null` is rejected with 400.
     *
     * @return list<GrantAssignment>
     */
    public function getGrants(): array
    {
        return $this->grants;
    }

    /**
     * Initial grants (only when `account_role` is `MEMBER`). Required: send `[]` to invite with no company access yet (granted later). An explicit `null` is rejected with 400.
     *
     * @param  list<GrantAssignment>  $grants
     */
    public function setGrants(array $grants): self
    {
        $this->initialized['grants'] = true;
        $this->grants = $grants;

        return $this;
    }

    public function definedProperties(): array
    {
        return ['invitedEmail' => ['invited_email', 'getInvitedEmail', 'setInvitedEmail'], 'accountRole' => ['account_role', 'getAccountRole', 'setAccountRole'], 'sendEmail' => ['send_email', 'getSendEmail', 'setSendEmail'], 'grants' => ['grants', 'getGrants', 'setGrants']];
    }
}
