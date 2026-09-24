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
     * Single-use claim token (shown once); `null` if the account is already claimed.
     *
     * @var string|null
     */
    protected $claimToken;
    /**
     * Ready-to-use claim link for the account holder, built by BeeL for the current environment (no need to assemble `/reclamar?token=` yourself). `null` when `claim_token` is `null` (the account is already claimed).
     *
     * @var string|null
     */
    protected $claimUrl;
    /**
     * The account's company id (a UUID) — send it in the `BeeL-Active-Company` header to issue invoices for this account. Present when a `tax_profile` was provided (account ready to invoice); `null` for an empty account (the holder registers their NIF on claim).
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
     * Single-use claim token (shown once); `null` if the account is already claimed.
     *
     * @return string|null
     */
    public function getClaimToken(): ?string
    {
        return $this->claimToken;
    }
    /**
     * Single-use claim token (shown once); `null` if the account is already claimed.
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
     * Ready-to-use claim link for the account holder, built by BeeL for the current environment (no need to assemble `/reclamar?token=` yourself). `null` when `claim_token` is `null` (the account is already claimed).
     *
     * @return string|null
     */
    public function getClaimUrl(): ?string
    {
        return $this->claimUrl;
    }
    /**
     * Ready-to-use claim link for the account holder, built by BeeL for the current environment (no need to assemble `/reclamar?token=` yourself). `null` when `claim_token` is `null` (the account is already claimed).
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
     * The account's company id (a UUID) — send it in the `BeeL-Active-Company` header to issue invoices for this account. Present when a `tax_profile` was provided (account ready to invoice); `null` for an empty account (the holder registers their NIF on claim).
     *
     * @return string|null
     */
    public function getCompanyId(): ?string
    {
        return $this->companyId;
    }
    /**
     * The account's company id (a UUID) — send it in the `BeeL-Active-Company` header to issue invoices for this account. Present when a `tax_profile` was provided (account ready to invoice); `null` for an empty account (the holder registers their NIF on claim).
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
        return ['personId' => ['person_id', 'getPersonId', 'setPersonId'], 'accountId' => ['account_id', 'getAccountId', 'setAccountId'], 'status' => ['status', 'getStatus', 'setStatus'], 'claimToken' => ['claim_token', 'getClaimToken', 'setClaimToken'], 'claimUrl' => ['claim_url', 'getClaimUrl', 'setClaimUrl'], 'companyId' => ['company_id', 'getCompanyId', 'setCompanyId']];
    }
}