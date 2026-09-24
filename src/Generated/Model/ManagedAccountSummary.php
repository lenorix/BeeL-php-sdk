<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;
class ManagedAccountSummary implements AdditionalPropertiesInterface
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
    protected $accountId;
    /**
     * The id you assigned to this account in your own system when provisioning it.
     *
     * @var string
     */
    protected $externalRef;
    /**
     * @var string
     */
    protected $displayName;
    /**
     * How much access an actor has to an account or a company. The same three values are used everywhere access is granted or reported — whether the actor is a member of the account or a provisioner managing it on someone's behalf.
     * 
     * `NONE` — no access to the data.
     * `VIEW` — read invoices, customers, products, series and fiscal data.
     * `OPERATE` — everything in `VIEW`, plus creating and editing them. Issuing invoices for an account you manage additionally requires a signed fiscal representation from the account holder (see `/v1/accounts/{account_id}/companies/{company_id}/representation`).
     * 
     * Access level never affects billing: whoever provisioned an account pays for its subscription regardless of the level they keep over it.
     *
     * @var string
     */
    protected $accessLevel;
    /**
     * Lifecycle stage of a provisioned account. The claim gates the stage: `PROVISIONED` (created, not yet claimed — the holder has not set a password / taken ownership, even if a NIF was seeded at provisioning or you invoice on their behalf with `OPERATE`); `CLAIMED` (the holder set their password and took ownership, no NIF yet); `ACTIVE` (claimed and has at least one NIF — can operate under their own ownership).
     *
     * @var string
     */
    protected $status;
    /**
     * State of the account's claim link. `status` here refines the `PROVISIONED` stage of `status` above, which cannot tell "the holder still has a working link" from "their link expired a month ago" — the difference between waiting and having to act.
     *
     * @var ManagedAccountSummaryClaim
     */
    protected $claim;
    /**
     * The account's **single** company id (a UUID) — the value for the `BeeL-Active-Company` header when operating on this account. It is a **scalar, not a list**: it is present only when the account holds exactly one NIF, and is `null` both when the account has no NIF yet and when it holds two or more. For a multi-NIF account, list them with `GET /v1/accounts/{account_id}/companies`. Same meaning as `company_id` in the response to `POST /v1/accounts`.
     *
     * @var string|null
     */
    protected $companyId;
    /**
     * Whether the account holder has signed at least one fiscal representation.
     *
     * @var bool
     */
    protected $representationSigned;
    /**
     * @var \DateTime
     */
    protected $createdAt;
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
     * The id you assigned to this account in your own system when provisioning it.
     *
     * @return string
     */
    public function getExternalRef(): string
    {
        return $this->externalRef;
    }
    /**
     * The id you assigned to this account in your own system when provisioning it.
     *
     * @param string $externalRef
     *
     * @return self
     */
    public function setExternalRef(string $externalRef): self
    {
        $this->initialized['externalRef'] = true;
        $this->externalRef = $externalRef;
        return $this;
    }
    /**
     * @return string
     */
    public function getDisplayName(): string
    {
        return $this->displayName;
    }
    /**
     * @param string $displayName
     *
     * @return self
     */
    public function setDisplayName(string $displayName): self
    {
        $this->initialized['displayName'] = true;
        $this->displayName = $displayName;
        return $this;
    }
    /**
     * How much access an actor has to an account or a company. The same three values are used everywhere access is granted or reported — whether the actor is a member of the account or a provisioner managing it on someone's behalf.
     * 
     * `NONE` — no access to the data.
     * `VIEW` — read invoices, customers, products, series and fiscal data.
     * `OPERATE` — everything in `VIEW`, plus creating and editing them. Issuing invoices for an account you manage additionally requires a signed fiscal representation from the account holder (see `/v1/accounts/{account_id}/companies/{company_id}/representation`).
     * 
     * Access level never affects billing: whoever provisioned an account pays for its subscription regardless of the level they keep over it.
     *
     * @return string
     */
    public function getAccessLevel(): string
    {
        return $this->accessLevel;
    }
    /**
    * How much access an actor has to an account or a company. The same three values are used everywhere access is granted or reported — whether the actor is a member of the account or a provisioner managing it on someone's behalf.
    
    `NONE` — no access to the data.
    `VIEW` — read invoices, customers, products, series and fiscal data.
    `OPERATE` — everything in `VIEW`, plus creating and editing them. Issuing invoices for an account you manage additionally requires a signed fiscal representation from the account holder (see `/v1/accounts/{account_id}/companies/{company_id}/representation`).
    
    Access level never affects billing: whoever provisioned an account pays for its subscription regardless of the level they keep over it.
    *
    * @param string $accessLevel
    *
    * @return self
    */
    public function setAccessLevel(string $accessLevel): self
    {
        $this->initialized['accessLevel'] = true;
        $this->accessLevel = $accessLevel;
        return $this;
    }
    /**
     * Lifecycle stage of a provisioned account. The claim gates the stage: `PROVISIONED` (created, not yet claimed — the holder has not set a password / taken ownership, even if a NIF was seeded at provisioning or you invoice on their behalf with `OPERATE`); `CLAIMED` (the holder set their password and took ownership, no NIF yet); `ACTIVE` (claimed and has at least one NIF — can operate under their own ownership).
     *
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }
    /**
     * Lifecycle stage of a provisioned account. The claim gates the stage: `PROVISIONED` (created, not yet claimed — the holder has not set a password / taken ownership, even if a NIF was seeded at provisioning or you invoice on their behalf with `OPERATE`); `CLAIMED` (the holder set their password and took ownership, no NIF yet); `ACTIVE` (claimed and has at least one NIF — can operate under their own ownership).
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
     * State of the account's claim link. `status` here refines the `PROVISIONED` stage of `status` above, which cannot tell "the holder still has a working link" from "their link expired a month ago" — the difference between waiting and having to act.
     *
     * @return ManagedAccountSummaryClaim
     */
    public function getClaim(): ManagedAccountSummaryClaim
    {
        return $this->claim;
    }
    /**
     * State of the account's claim link. `status` here refines the `PROVISIONED` stage of `status` above, which cannot tell "the holder still has a working link" from "their link expired a month ago" — the difference between waiting and having to act.
     *
     * @param ManagedAccountSummaryClaim $claim
     *
     * @return self
     */
    public function setClaim(ManagedAccountSummaryClaim $claim): self
    {
        $this->initialized['claim'] = true;
        $this->claim = $claim;
        return $this;
    }
    /**
     * The account's **single** company id (a UUID) — the value for the `BeeL-Active-Company` header when operating on this account. It is a **scalar, not a list**: it is present only when the account holds exactly one NIF, and is `null` both when the account has no NIF yet and when it holds two or more. For a multi-NIF account, list them with `GET /v1/accounts/{account_id}/companies`. Same meaning as `company_id` in the response to `POST /v1/accounts`.
     *
     * @return string|null
     */
    public function getCompanyId(): ?string
    {
        return $this->companyId;
    }
    /**
     * The account's **single** company id (a UUID) — the value for the `BeeL-Active-Company` header when operating on this account. It is a **scalar, not a list**: it is present only when the account holds exactly one NIF, and is `null` both when the account has no NIF yet and when it holds two or more. For a multi-NIF account, list them with `GET /v1/accounts/{account_id}/companies`. Same meaning as `company_id` in the response to `POST /v1/accounts`.
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
    /**
     * Whether the account holder has signed at least one fiscal representation.
     *
     * @return bool
     */
    public function getRepresentationSigned(): bool
    {
        return $this->representationSigned;
    }
    /**
     * Whether the account holder has signed at least one fiscal representation.
     *
     * @param bool $representationSigned
     *
     * @return self
     */
    public function setRepresentationSigned(bool $representationSigned): self
    {
        $this->initialized['representationSigned'] = true;
        $this->representationSigned = $representationSigned;
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
    public function definedProperties(): array
    {
        return ['accountId' => ['account_id', 'getAccountId', 'setAccountId'], 'externalRef' => ['external_ref', 'getExternalRef', 'setExternalRef'], 'displayName' => ['display_name', 'getDisplayName', 'setDisplayName'], 'accessLevel' => ['access_level', 'getAccessLevel', 'setAccessLevel'], 'status' => ['status', 'getStatus', 'setStatus'], 'claim' => ['claim', 'getClaim', 'setClaim'], 'companyId' => ['company_id', 'getCompanyId', 'setCompanyId'], 'representationSigned' => ['representation_signed', 'getRepresentationSigned', 'setRepresentationSigned'], 'createdAt' => ['created_at', 'getCreatedAt', 'setCreatedAt']];
    }
}