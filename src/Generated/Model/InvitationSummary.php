<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;
class InvitationSummary implements AdditionalPropertiesInterface
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
     * Lifecycle state of a member invitation. `PENDING`: active and not yet expired; `ACCEPTED`: accepted by the invitee; `REVOKED`: cancelled before acceptance; `EXPIRED`: passed the expiry date without being accepted.
     *
     * @var string
     */
    protected $status;
    /**
     * @var \DateTime
     */
    protected $createdAt;
    /**
     * @var \DateTime
     */
    protected $expiresAt;
    /**
     * @return string
     */
    public function getInvitationId(): string
    {
        return $this->invitationId;
    }
    /**
     * @param string $invitationId
     *
     * @return self
     */
    public function setInvitationId(string $invitationId): self
    {
        $this->initialized['invitationId'] = true;
        $this->invitationId = $invitationId;
        return $this;
    }
    /**
     * @return string
     */
    public function getInvitedEmail(): string
    {
        return $this->invitedEmail;
    }
    /**
     * @param string $invitedEmail
     *
     * @return self
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
     * Lifecycle state of a member invitation. `PENDING`: active and not yet expired; `ACCEPTED`: accepted by the invitee; `REVOKED`: cancelled before acceptance; `EXPIRED`: passed the expiry date without being accepted.
     *
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }
    /**
     * Lifecycle state of a member invitation. `PENDING`: active and not yet expired; `ACCEPTED`: accepted by the invitee; `REVOKED`: cancelled before acceptance; `EXPIRED`: passed the expiry date without being accepted.
     *
     * @param string $status
     *
     * @return self
     */
    public function setStatus(string $status): self
    {
        $this->initialized['status'] = true;
        $this->status = $status;
        return $this;
    }
    /**
     * @return \DateTime
     */
    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }
    /**
     * @param \DateTime $createdAt
     *
     * @return self
     */
    public function setCreatedAt(\DateTime $createdAt): self
    {
        $this->initialized['createdAt'] = true;
        $this->createdAt = $createdAt;
        return $this;
    }
    /**
     * @return \DateTime
     */
    public function getExpiresAt(): \DateTime
    {
        return $this->expiresAt;
    }
    /**
     * @param \DateTime $expiresAt
     *
     * @return self
     */
    public function setExpiresAt(\DateTime $expiresAt): self
    {
        $this->initialized['expiresAt'] = true;
        $this->expiresAt = $expiresAt;
        return $this;
    }
    public function definedProperties(): array
    {
        return ['invitationId' => ['invitation_id', 'getInvitationId', 'setInvitationId'], 'invitedEmail' => ['invited_email', 'getInvitedEmail', 'setInvitedEmail'], 'accountRole' => ['account_role', 'getAccountRole', 'setAccountRole'], 'status' => ['status', 'getStatus', 'setStatus'], 'createdAt' => ['created_at', 'getCreatedAt', 'setCreatedAt'], 'expiresAt' => ['expires_at', 'getExpiresAt', 'setExpiresAt']];
    }
}