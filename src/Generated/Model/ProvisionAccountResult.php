<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;
class ProvisionAccountResult implements AdditionalPropertiesInterface
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
     * The account holder. `null` when the account was provisioned **without `email`**: it has no person yet, and gains one when a claim token is issued.
     *
     * @var string|null
     */
    protected $personId;
    /**
     * @var string
     */
    protected $accountId;
    /**
     * Lifecycle stage of the account right after this call. A newly provisioned account is `PROVISIONED` (not yet claimed). Combined with `claim_token`, it is self-explanatory: a `null` `claim_token` with `status: CLAIMED`/`ACTIVE` means the holder already took ownership (not an error).
     *
     * @var string
     */
    protected $status;
    /**
     * Single-use claim token (shown once); `null` if the account is already claimed, or if a claim link issued earlier is still valid (see `claim_link_already_issued`).
     *
     * @var string|null
     */
    protected $claimToken;
    /**
     * Ready-to-use claim link for the account holder, built by BeeL for the current environment (no need to assemble `/reclamar?token=` yourself). `null` when `claim_token` is `null`.
     *
     * @var string|null
     */
    protected $claimUrl;
    /**
     * `true` when this call repeated the provision of an unclaimed account that already has a claim link still valid (pending and not expired). That link is **kept working**: nothing is issued or revoked, `claim_token` and `claim_url` come back `null`, and no email is re-sent even with `send_email: true` (there is no token in clear to send). The link you already handed out is the one the holder uses. To replace it on purpose, call `POST /v1/accounts/{account_id}/claim-tokens`, which revokes the previous one. `false` otherwise.
     *
     * @var bool
     */
    protected $claimLinkAlreadyIssued;
    /**
     * The account's company id (a UUID) — send it in the `BeeL-Active-Company` header to operate on this account. Every account is born with one company: with a `tax_profile` it is ready to invoice; without one it has no NIF yet (the holder registers it on claim), and its issuing readiness reports `COMPANY_HAS_NO_NIF` until then. `null` only when resending an `external_ref` whose account now holds two or more companies.
     *
     * @var string|null
     */
    protected $companyId;
    /**
     * The account holder. `null` when the account was provisioned **without `email`**: it has no person yet, and gains one when a claim token is issued.
     *
     * @return string|null
     */
    public function getPersonId(): ?string
    {
        return $this->personId;
    }
    /**
     * The account holder. `null` when the account was provisioned **without `email`**: it has no person yet, and gains one when a claim token is issued.
     *
     * @param string|null $personId
     *
     * @return self
     */
    public function setPersonId(?string $personId): self
    {
        $this->initialized['personId'] = true;
        $this->personId = $personId;
        return $this;
    }
    /**
     * @return string
     */
    public function getAccountId(): string
    {
        return $this->accountId;
    }
    /**
     * @param string $accountId
     *
     * @return self
     */
    public function setAccountId(string $accountId): self
    {
        $this->initialized['accountId'] = true;
        $this->accountId = $accountId;
        return $this;
    }
    /**
     * Lifecycle stage of the account right after this call. A newly provisioned account is `PROVISIONED` (not yet claimed). Combined with `claim_token`, it is self-explanatory: a `null` `claim_token` with `status: CLAIMED`/`ACTIVE` means the holder already took ownership (not an error).
     *
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }
    /**
     * Lifecycle stage of the account right after this call. A newly provisioned account is `PROVISIONED` (not yet claimed). Combined with `claim_token`, it is self-explanatory: a `null` `claim_token` with `status: CLAIMED`/`ACTIVE` means the holder already took ownership (not an error).
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
     * Single-use claim token (shown once); `null` if the account is already claimed, or if a claim link issued earlier is still valid (see `claim_link_already_issued`).
     *
     * @return string|null
     */
    public function getClaimToken(): ?string
    {
        return $this->claimToken;
    }
    /**
     * Single-use claim token (shown once); `null` if the account is already claimed, or if a claim link issued earlier is still valid (see `claim_link_already_issued`).
     *
     * @param string|null $claimToken
     *
     * @return self
     */
    public function setClaimToken(?string $claimToken): self
    {
        $this->initialized['claimToken'] = true;
        $this->claimToken = $claimToken;
        return $this;
    }
    /**
     * Ready-to-use claim link for the account holder, built by BeeL for the current environment (no need to assemble `/reclamar?token=` yourself). `null` when `claim_token` is `null`.
     *
     * @return string|null
     */
    public function getClaimUrl(): ?string
    {
        return $this->claimUrl;
    }
    /**
     * Ready-to-use claim link for the account holder, built by BeeL for the current environment (no need to assemble `/reclamar?token=` yourself). `null` when `claim_token` is `null`.
     *
     * @param string|null $claimUrl
     *
     * @return self
     */
    public function setClaimUrl(?string $claimUrl): self
    {
        $this->initialized['claimUrl'] = true;
        $this->claimUrl = $claimUrl;
        return $this;
    }
    /**
     * `true` when this call repeated the provision of an unclaimed account that already has a claim link still valid (pending and not expired). That link is **kept working**: nothing is issued or revoked, `claim_token` and `claim_url` come back `null`, and no email is re-sent even with `send_email: true` (there is no token in clear to send). The link you already handed out is the one the holder uses. To replace it on purpose, call `POST /v1/accounts/{account_id}/claim-tokens`, which revokes the previous one. `false` otherwise.
     *
     * @return bool
     */
    public function getClaimLinkAlreadyIssued(): bool
    {
        return $this->claimLinkAlreadyIssued;
    }
    /**
     * `true` when this call repeated the provision of an unclaimed account that already has a claim link still valid (pending and not expired). That link is **kept working**: nothing is issued or revoked, `claim_token` and `claim_url` come back `null`, and no email is re-sent even with `send_email: true` (there is no token in clear to send). The link you already handed out is the one the holder uses. To replace it on purpose, call `POST /v1/accounts/{account_id}/claim-tokens`, which revokes the previous one. `false` otherwise.
     *
     * @param bool $claimLinkAlreadyIssued
     *
     * @return self
     */
    public function setClaimLinkAlreadyIssued(bool $claimLinkAlreadyIssued): self
    {
        $this->initialized['claimLinkAlreadyIssued'] = true;
        $this->claimLinkAlreadyIssued = $claimLinkAlreadyIssued;
        return $this;
    }
    /**
     * The account's company id (a UUID) — send it in the `BeeL-Active-Company` header to operate on this account. Every account is born with one company: with a `tax_profile` it is ready to invoice; without one it has no NIF yet (the holder registers it on claim), and its issuing readiness reports `COMPANY_HAS_NO_NIF` until then. `null` only when resending an `external_ref` whose account now holds two or more companies.
     *
     * @return string|null
     */
    public function getCompanyId(): ?string
    {
        return $this->companyId;
    }
    /**
     * The account's company id (a UUID) — send it in the `BeeL-Active-Company` header to operate on this account. Every account is born with one company: with a `tax_profile` it is ready to invoice; without one it has no NIF yet (the holder registers it on claim), and its issuing readiness reports `COMPANY_HAS_NO_NIF` until then. `null` only when resending an `external_ref` whose account now holds two or more companies.
     *
     * @param string|null $companyId
     *
     * @return self
     */
    public function setCompanyId(?string $companyId): self
    {
        $this->initialized['companyId'] = true;
        $this->companyId = $companyId;
        return $this;
    }
    public function definedProperties(): array
    {
        return ['personId' => ['person_id', 'getPersonId', 'setPersonId'], 'accountId' => ['account_id', 'getAccountId', 'setAccountId'], 'status' => ['status', 'getStatus', 'setStatus'], 'claimToken' => ['claim_token', 'getClaimToken', 'setClaimToken'], 'claimUrl' => ['claim_url', 'getClaimUrl', 'setClaimUrl'], 'claimLinkAlreadyIssued' => ['claim_link_already_issued', 'getClaimLinkAlreadyIssued', 'setClaimLinkAlreadyIssued'], 'companyId' => ['company_id', 'getCompanyId', 'setCompanyId']];
    }
}