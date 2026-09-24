<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;

class ValidateNifResponse implements AdditionalPropertiesInterface
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
     * true if the NIF is in the AEAT census, **is active**, and — for an
     * individual — the name matches (status = VALID). false otherwise.
     *
     * For a legal entity the name is **not verified**: AEAT identifies a
     * company by its CIF alone, so `valid: true` says nothing about the name
     * you sent. See `legal_name_verified`.
     *
     * Being in the census is not enough: a deregistered or revoked NIF comes
     * back `false`. Read `census_status` to tell those apart from a NIF that
     * is simply not registered, because they are not fixed the same way.
     *
     * A **deregistered** NIF cannot issue invoices, but it can still receive
     * them — a company closing down does not stop you from invoicing what
     * accrued before it closed, and BeeL still accepts it as a recipient. A
     * **revoked** NIF cannot operate at all: it is rejected on both sides.
     *
     *
     * @var bool
     */
    protected $valid;

    /**
     * @var string
     */
    protected $status;

    /**
     * Legal name as it appears in the AEAT census — never an echo of the name
     * you sent. Only available if status = VALID.
     *
     * For a legal entity this is the only signal that your own name is wrong,
     * since the one you send is not checked: comparing the two is up to you.
     *
     * Deliberately withheld when an individual is not identified because the
     * name you sent is close but wrong (`census_status` =
     * `NOT_IDENTIFIED_SIMILAR`). AEAT does return the real name there, but
     * you have just shown you do not know it.
     *
     *
     * @var string|null
     */
    protected $legalName;

    /**
     * Whether AEAT actually cross-checked the `legal_name` you sent.
     *
     * `true` only for an **individual** that was identified: AEAT matches NIF
     * and name together there, so an identification is the check having
     * passed.
     *
     * Always `false` for a **legal entity** — its name is **not verified**.
     * AEAT identifies a company by its CIF alone and returns the census name
     * without looking at the one you sent, so `valid: true` says nothing about
     * your name. Comparing it against `legal_name` is up to you.
     *
     * Also `false` whenever the census was not reached at all (`PENDING`,
     * `ERROR`, or a syntactically invalid NIF).
     *
     *
     * @var bool
     */
    protected $legalNameVerified;

    /**
     * @var string
     */
    protected $censusStatus;

    /**
     * Descriptive message of the validation result.
     *
     * Examples:
     * - VALID: "NIF successfully validated against the AEAT census"
     * - INVALID: "NIF does not exist in the AEAT census"
     * - PENDING: "NIF validation is pending. The system will automatically validate it when the service is available."
     * - ERROR: "Error validating NIF: VeriFactu API timeout"
     *
     *
     * @var string
     */
    protected $message;

    /**
     * Timestamp of when the NIF was successfully validated.
     * Only available if status = VALID.
     *
     *
     * @var \DateTime|null
     */
    protected $validatedAt;

    /**
     * true if the NIF is in the AEAT census, **is active**, and — for an
     * individual — the name matches (status = VALID). false otherwise.
     *
     * For a legal entity the name is **not verified**: AEAT identifies a
     * company by its CIF alone, so `valid: true` says nothing about the name
     * you sent. See `legal_name_verified`.
     *
     * Being in the census is not enough: a deregistered or revoked NIF comes
     * back `false`. Read `census_status` to tell those apart from a NIF that
     * is simply not registered, because they are not fixed the same way.
     *
     * A **deregistered** NIF cannot issue invoices, but it can still receive
     * them — a company closing down does not stop you from invoicing what
     * accrued before it closed, and BeeL still accepts it as a recipient. A
     * **revoked** NIF cannot operate at all: it is rejected on both sides.
     */
    public function getValid(): bool
    {
        return $this->valid;
    }

    /**
     * true if the NIF is in the AEAT census, **is active**, and — for an
    individual — the name matches (status = VALID). false otherwise.

    For a legal entity the name is **not verified**: AEAT identifies a
    company by its CIF alone, so `valid: true` says nothing about the name
    you sent. See `legal_name_verified`.

    Being in the census is not enough: a deregistered or revoked NIF comes
    back `false`. Read `census_status` to tell those apart from a NIF that
    is simply not registered, because they are not fixed the same way.

    A **deregistered** NIF cannot issue invoices, but it can still receive
    them — a company closing down does not stop you from invoicing what
    accrued before it closed, and BeeL still accepts it as a recipient. A
     **revoked** NIF cannot operate at all: it is rejected on both sides.
     */
    public function setValid(bool $valid): self
    {
        $this->initialized['valid'] = true;
        $this->valid = $valid;

        return $this;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->initialized['status'] = true;
        $this->status = $status;

        return $this;
    }

    /**
     * Legal name as it appears in the AEAT census — never an echo of the name
     * you sent. Only available if status = VALID.
     *
     * For a legal entity this is the only signal that your own name is wrong,
     * since the one you send is not checked: comparing the two is up to you.
     *
     * Deliberately withheld when an individual is not identified because the
     * name you sent is close but wrong (`census_status` =
     * `NOT_IDENTIFIED_SIMILAR`). AEAT does return the real name there, but
     * you have just shown you do not know it.
     */
    public function getLegalName(): ?string
    {
        return $this->legalName;
    }

    /**
     * Legal name as it appears in the AEAT census — never an echo of the name
    you sent. Only available if status = VALID.

    For a legal entity this is the only signal that your own name is wrong,
    since the one you send is not checked: comparing the two is up to you.

    Deliberately withheld when an individual is not identified because the
    name you sent is close but wrong (`census_status` =
    `NOT_IDENTIFIED_SIMILAR`). AEAT does return the real name there, but
    you have just shown you do not know it.
     */
    public function setLegalName(?string $legalName): self
    {
        $this->initialized['legalName'] = true;
        $this->legalName = $legalName;

        return $this;
    }

    /**
     * Whether AEAT actually cross-checked the `legal_name` you sent.
     *
     * `true` only for an **individual** that was identified: AEAT matches NIF
     * and name together there, so an identification is the check having
     * passed.
     *
     * Always `false` for a **legal entity** — its name is **not verified**.
     * AEAT identifies a company by its CIF alone and returns the census name
     * without looking at the one you sent, so `valid: true` says nothing about
     * your name. Comparing it against `legal_name` is up to you.
     *
     * Also `false` whenever the census was not reached at all (`PENDING`,
     * `ERROR`, or a syntactically invalid NIF).
     */
    public function getLegalNameVerified(): bool
    {
        return $this->legalNameVerified;
    }

    /**
     * Whether AEAT actually cross-checked the `legal_name` you sent.

    `true` only for an **individual** that was identified: AEAT matches NIF
    and name together there, so an identification is the check having
    passed.

    Always `false` for a **legal entity** — its name is **not verified**.
    AEAT identifies a company by its CIF alone and returns the census name
    without looking at the one you sent, so `valid: true` says nothing about
    your name. Comparing it against `legal_name` is up to you.

    Also `false` whenever the census was not reached at all (`PENDING`,
    `ERROR`, or a syntactically invalid NIF).
     */
    public function setLegalNameVerified(bool $legalNameVerified): self
    {
        $this->initialized['legalNameVerified'] = true;
        $this->legalNameVerified = $legalNameVerified;

        return $this;
    }

    public function getCensusStatus(): string
    {
        return $this->censusStatus;
    }

    public function setCensusStatus(string $censusStatus): self
    {
        $this->initialized['censusStatus'] = true;
        $this->censusStatus = $censusStatus;

        return $this;
    }

    /**
     * Descriptive message of the validation result.
     *
     * Examples:
     * - VALID: "NIF successfully validated against the AEAT census"
     * - INVALID: "NIF does not exist in the AEAT census"
     * - PENDING: "NIF validation is pending. The system will automatically validate it when the service is available."
     * - ERROR: "Error validating NIF: VeriFactu API timeout"
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * Descriptive message of the validation result.

    Examples:
    - VALID: "NIF successfully validated against the AEAT census"
    - INVALID: "NIF does not exist in the AEAT census"
    - PENDING: "NIF validation is pending. The system will automatically validate it when the service is available."
    - ERROR: "Error validating NIF: VeriFactu API timeout"
     */
    public function setMessage(string $message): self
    {
        $this->initialized['message'] = true;
        $this->message = $message;

        return $this;
    }

    /**
     * Timestamp of when the NIF was successfully validated.
     * Only available if status = VALID.
     */
    public function getValidatedAt(): ?\DateTime
    {
        return $this->validatedAt;
    }

    /**
     * Timestamp of when the NIF was successfully validated.
    Only available if status = VALID.
     */
    public function setValidatedAt(?\DateTime $validatedAt): self
    {
        $this->initialized['validatedAt'] = true;
        $this->validatedAt = $validatedAt;

        return $this;
    }

    public function definedProperties(): array
    {
        return ['valid' => ['valid', 'getValid', 'setValid'], 'status' => ['status', 'getStatus', 'setStatus'], 'legalName' => ['legal_name', 'getLegalName', 'setLegalName'], 'legalNameVerified' => ['legal_name_verified', 'getLegalNameVerified', 'setLegalNameVerified'], 'censusStatus' => ['census_status', 'getCensusStatus', 'setCensusStatus'], 'message' => ['message', 'getMessage', 'setMessage'], 'validatedAt' => ['validated_at', 'getValidatedAt', 'setValidatedAt']];
    }
}
