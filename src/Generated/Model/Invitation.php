<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;

class Invitation implements AdditionalPropertiesInterface
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
     * @var string
     */
    protected $invitationId;

    /**
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
     * @var \DateTime
     */
    protected $expiresAt;

    /**
     * Single-use acceptance token (shown once); the source of truth of the invitation.
     *
     * @var string
     */
    protected $token;

    /**
     * Ready-to-use acceptance link for the invitee, built by BeeL for the current environment (no need to assemble `/aceptar?token=` yourself). Derived from `token`, which remains the single-use source of truth. `null` only if no token was issued.
     *
     * @var string|null
     */
    protected $invitationUrl;

    public function getInvitationId(): string
    {
        return $this->invitationId;
    }

    public function setInvitationId(string $invitationId): self
    {
        $this->initialized['invitationId'] = true;
        $this->invitationId = $invitationId;

        return $this;
    }

    public function getInvitedEmail(): string
    {
        return $this->invitedEmail;
    }

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

    public function getExpiresAt(): \DateTime
    {
        return $this->expiresAt;
    }

    public function setExpiresAt(\DateTime $expiresAt): self
    {
        $this->initialized['expiresAt'] = true;
        $this->expiresAt = $expiresAt;

        return $this;
    }

    /**
     * Single-use acceptance token (shown once); the source of truth of the invitation.
     */
    public function getToken(): string
    {
        return $this->token;
    }

    /**
     * Single-use acceptance token (shown once); the source of truth of the invitation.
     */
    public function setToken(string $token): self
    {
        $this->initialized['token'] = true;
        $this->token = $token;

        return $this;
    }

    /**
     * Ready-to-use acceptance link for the invitee, built by BeeL for the current environment (no need to assemble `/aceptar?token=` yourself). Derived from `token`, which remains the single-use source of truth. `null` only if no token was issued.
     */
    public function getInvitationUrl(): ?string
    {
        return $this->invitationUrl;
    }

    /**
     * Ready-to-use acceptance link for the invitee, built by BeeL for the current environment (no need to assemble `/aceptar?token=` yourself). Derived from `token`, which remains the single-use source of truth. `null` only if no token was issued.
     */
    public function setInvitationUrl(?string $invitationUrl): self
    {
        $this->initialized['invitationUrl'] = true;
        $this->invitationUrl = $invitationUrl;

        return $this;
    }

    public function definedProperties(): array
    {
        return ['invitationId' => ['invitation_id', 'getInvitationId', 'setInvitationId'], 'invitedEmail' => ['invited_email', 'getInvitedEmail', 'setInvitedEmail'], 'accountRole' => ['account_role', 'getAccountRole', 'setAccountRole'], 'expiresAt' => ['expires_at', 'getExpiresAt', 'setExpiresAt'], 'token' => ['token', 'getToken', 'setToken'], 'invitationUrl' => ['invitation_url', 'getInvitationUrl', 'setInvitationUrl']];
    }
}
