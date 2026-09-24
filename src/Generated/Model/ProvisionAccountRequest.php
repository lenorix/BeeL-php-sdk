<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;

class ProvisionAccountRequest implements AdditionalPropertiesInterface
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
     * Optional. Email address of the account holder, used as their login. Omit it to create the account **without a person**: no login, no `person_id` and no `claim_token`. You can add the holder later with `POST /v1/accounts/{account_id}/claim-tokens`. Required when `send_email` is `true` (there is nobody to write to otherwise) — else `422`.
     *
     * @var string
     */
    protected $email;

    /**
     * Human-readable name for the account. Must not be blank.
     *
     * @var string
     */
    protected $displayName;

    /**
     * Your own identifier for this account in your system. Used as an idempotency key: re-provisioning with the same `external_ref` returns the existing account (201, not 409).
     *
     * @var string
     */
    protected $externalRef;

    /**
     * Preferred language for the account holder. Defaults to `es`.
     *
     * @var string
     */
    protected $language;

    /**
     * Optional. The access you retain over this account after provisioning. Defaults to `NONE` (you cover their subscription but cannot access their data). Change it later via PATCH /v1/accounts/{account_id}/access-level. This field was previously named `access`; the old name is still accepted as an alias for backwards compatibility and will be withdrawn in a future major version — send `access_level`.
     *
     * @var string
     */
    protected $accessLevel;

    /**
     * Optional fiscal identity. When present, the account is created **ready to invoice** in one call: its company record, a default invoice series and VeriFactu config are set up atomically, and the response returns `company_id` (the value for the `BeeL-Active-Company` header when issuing invoices). Omit it to create an empty account the holder completes on claim. **Required when `access_level` is `OPERATE`** (issuing on their behalf needs a NIF) — else `422`.
     *
     * @var ProvisionAccountRequestTaxProfile
     */
    protected $taxProfile;

    /**
     * Optional. When `true`, BeeL emails the account holder a claim link (`/reclamar?token=...`) so they can set their password and take ownership. Defaults to `false`: by default you receive the `claim_token` in the response and deliver it yourself. Requires a deliverable `email`: sending `true` without one returns `422`.
     *
     * @var bool
     */
    protected $sendEmail = false;

    /**
     * Optional. Email address of the account holder, used as their login. Omit it to create the account **without a person**: no login, no `person_id` and no `claim_token`. You can add the holder later with `POST /v1/accounts/{account_id}/claim-tokens`. Required when `send_email` is `true` (there is nobody to write to otherwise) — else `422`.
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * Optional. Email address of the account holder, used as their login. Omit it to create the account **without a person**: no login, no `person_id` and no `claim_token`. You can add the holder later with `POST /v1/accounts/{account_id}/claim-tokens`. Required when `send_email` is `true` (there is nobody to write to otherwise) — else `422`.
     */
    public function setEmail(string $email): self
    {
        $this->initialized['email'] = true;
        $this->email = $email;

        return $this;
    }

    /**
     * Human-readable name for the account. Must not be blank.
     */
    public function getDisplayName(): string
    {
        return $this->displayName;
    }

    /**
     * Human-readable name for the account. Must not be blank.
     */
    public function setDisplayName(string $displayName): self
    {
        $this->initialized['displayName'] = true;
        $this->displayName = $displayName;

        return $this;
    }

    /**
     * Your own identifier for this account in your system. Used as an idempotency key: re-provisioning with the same `external_ref` returns the existing account (201, not 409).
     */
    public function getExternalRef(): string
    {
        return $this->externalRef;
    }

    /**
     * Your own identifier for this account in your system. Used as an idempotency key: re-provisioning with the same `external_ref` returns the existing account (201, not 409).
     */
    public function setExternalRef(string $externalRef): self
    {
        $this->initialized['externalRef'] = true;
        $this->externalRef = $externalRef;

        return $this;
    }

    /**
     * Preferred language for the account holder. Defaults to `es`.
     */
    public function getLanguage(): string
    {
        return $this->language;
    }

    /**
     * Preferred language for the account holder. Defaults to `es`.
     */
    public function setLanguage(string $language): self
    {
        $this->initialized['language'] = true;
        $this->language = $language;

        return $this;
    }

    /**
     * Optional. The access you retain over this account after provisioning. Defaults to `NONE` (you cover their subscription but cannot access their data). Change it later via PATCH /v1/accounts/{account_id}/access-level. This field was previously named `access`; the old name is still accepted as an alias for backwards compatibility and will be withdrawn in a future major version — send `access_level`.
     */
    public function getAccessLevel(): string
    {
        return $this->accessLevel;
    }

    /**
     * Optional. The access you retain over this account after provisioning. Defaults to `NONE` (you cover their subscription but cannot access their data). Change it later via PATCH /v1/accounts/{account_id}/access-level. This field was previously named `access`; the old name is still accepted as an alias for backwards compatibility and will be withdrawn in a future major version — send `access_level`.
     */
    public function setAccessLevel(string $accessLevel): self
    {
        $this->initialized['accessLevel'] = true;
        $this->accessLevel = $accessLevel;

        return $this;
    }

    /**
     * Optional fiscal identity. When present, the account is created **ready to invoice** in one call: its company record, a default invoice series and VeriFactu config are set up atomically, and the response returns `company_id` (the value for the `BeeL-Active-Company` header when issuing invoices). Omit it to create an empty account the holder completes on claim. **Required when `access_level` is `OPERATE`** (issuing on their behalf needs a NIF) — else `422`.
     */
    public function getTaxProfile(): ProvisionAccountRequestTaxProfile
    {
        return $this->taxProfile;
    }

    /**
     * Optional fiscal identity. When present, the account is created **ready to invoice** in one call: its company record, a default invoice series and VeriFactu config are set up atomically, and the response returns `company_id` (the value for the `BeeL-Active-Company` header when issuing invoices). Omit it to create an empty account the holder completes on claim. **Required when `access_level` is `OPERATE`** (issuing on their behalf needs a NIF) — else `422`.
     */
    public function setTaxProfile(ProvisionAccountRequestTaxProfile $taxProfile): self
    {
        $this->initialized['taxProfile'] = true;
        $this->taxProfile = $taxProfile;

        return $this;
    }

    /**
     * Optional. When `true`, BeeL emails the account holder a claim link (`/reclamar?token=...`) so they can set their password and take ownership. Defaults to `false`: by default you receive the `claim_token` in the response and deliver it yourself. Requires a deliverable `email`: sending `true` without one returns `422`.
     */
    public function getSendEmail(): bool
    {
        return $this->sendEmail;
    }

    /**
     * Optional. When `true`, BeeL emails the account holder a claim link (`/reclamar?token=...`) so they can set their password and take ownership. Defaults to `false`: by default you receive the `claim_token` in the response and deliver it yourself. Requires a deliverable `email`: sending `true` without one returns `422`.
     */
    public function setSendEmail(bool $sendEmail): self
    {
        $this->initialized['sendEmail'] = true;
        $this->sendEmail = $sendEmail;

        return $this;
    }

    public function definedProperties(): array
    {
        return ['email' => ['email', 'getEmail', 'setEmail'], 'displayName' => ['display_name', 'getDisplayName', 'setDisplayName'], 'externalRef' => ['external_ref', 'getExternalRef', 'setExternalRef'], 'language' => ['language', 'getLanguage', 'setLanguage'], 'accessLevel' => ['access_level', 'getAccessLevel', 'setAccessLevel'], 'taxProfile' => ['tax_profile', 'getTaxProfile', 'setTaxProfile'], 'sendEmail' => ['send_email', 'getSendEmail', 'setSendEmail']];
    }
}
