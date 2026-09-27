<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;

class VeriFactuConfiguration implements AdditionalPropertiesInterface
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
     * Whether this tax ID is under the VeriFactu regime in the environment of the request:
     * while it is on, every invoice of this tax ID is registered with the AEAT; while it is
     * off, none is. Always `true` in sandbox.
     *
     *
     * @var bool
     */
    protected $enabled;

    /**
     * Whether the tax ID is registered with the VeriFactu provider for this environment
     * (null if VeriFactu was never enabled):
     * - ACTIVATED: registered and ready to submit
     * - DEACTIVATED: not registered, or deregistered (data retained for 30 days)
     *
     * **In Live**, `enabled: true` implies `ACTIVATED`: enabling *is* registering, atomically.
     * **In sandbox that implication does not hold**: `enabled` is always `true` there — it is a
     * constant of the mode, not a decision — while the registration travels asynchronously, so
     * `nif_status` can still be `DEACTIVATED` or null for a while. The former `PENDING` and
     * `ERROR` values described an in-between state that no longer exists.
     *
     *
     * @var string|null
     */
    protected $nifStatus;

    /**
     * Successful activation date in VeriFactu production
     *
     * @var \DateTime|null
     */
    protected $nifRegisteredAt;

    /**
     * Single derived VeriFactu state for the (NIF, environment) of the
     * request — the ONE truth every UI surface (settings banner, activation
     * card, invoice form) reads, so they can no longer contradict each other.
     * Read-only; resolved server-side. Null only if never configured.
     * - DISABLED: VeriFactu not enabled for this account.
     * - UNSIGNED: enabled but the NIF has no signed AEAT representation.
     * - NOT_ACTIVATED: signed, but no API key for the operating environment.
     * - ACTIVE: signed and activated with API key: ready to submit.
     * - ERROR: historical, no longer reachable. Activation is atomic: a failed
     *   activation leaves nothing persisted and returns the reason, so no row ever rests in
     *   this state. Kept in the enum so old clients keep parsing stored values.
     *
     *
     * @var string|null
     */
    protected $status;

    /**
     * Secondary flag: whether the NIF has a signed AEAT representation
     * (per-NIF, shared across environments). Data for the wizard, NOT the gate.
     *
     *
     * @var bool|null
     */
    protected $signed;

    /**
     * Secondary flag: whether the NIF is activated (has an API key) in the
     * operating environment (per-environment). Data, NOT the gate.
     *
     *
     * @var bool|null
     */
    protected $activated;

    /**
     * Secondary flag: whether a representation PDF artifact exists. Used by
     * the signature wizard as secondary data, NOT the source of truth of the gate.
     *
     *
     * @var bool|null
     */
    protected $pdfGenerated;

    /**
     * Whether this tax ID is under the VeriFactu regime in the environment of the request:
     * while it is on, every invoice of this tax ID is registered with the AEAT; while it is
     * off, none is. Always `true` in sandbox.
     */
    public function getEnabled(): bool
    {
        return $this->enabled;
    }

    /**
     * Whether this tax ID is under the VeriFactu regime in the environment of the request:
    while it is on, every invoice of this tax ID is registered with the AEAT; while it is
    off, none is. Always `true` in sandbox.
     */
    public function setEnabled(bool $enabled): self
    {
        $this->initialized['enabled'] = true;
        $this->enabled = $enabled;

        return $this;
    }

    /**
     * Whether the tax ID is registered with the VeriFactu provider for this environment
     * (null if VeriFactu was never enabled):
     * - ACTIVATED: registered and ready to submit
     * - DEACTIVATED: not registered, or deregistered (data retained for 30 days)
     *
     * **In Live**, `enabled: true` implies `ACTIVATED`: enabling *is* registering, atomically.
     * **In sandbox that implication does not hold**: `enabled` is always `true` there — it is a
     * constant of the mode, not a decision — while the registration travels asynchronously, so
     * `nif_status` can still be `DEACTIVATED` or null for a while. The former `PENDING` and
     * `ERROR` values described an in-between state that no longer exists.
     */
    public function getNifStatus(): ?string
    {
        return $this->nifStatus;
    }

    /**
     * Whether the tax ID is registered with the VeriFactu provider for this environment
    (null if VeriFactu was never enabled):
    - ACTIVATED: registered and ready to submit
    - DEACTIVATED: not registered, or deregistered (data retained for 30 days)

     **In Live**, `enabled: true` implies `ACTIVATED`: enabling *is* registering, atomically.
     **In sandbox that implication does not hold**: `enabled` is always `true` there — it is a
    constant of the mode, not a decision — while the registration travels asynchronously, so
    `nif_status` can still be `DEACTIVATED` or null for a while. The former `PENDING` and
    `ERROR` values described an in-between state that no longer exists.
     */
    public function setNifStatus(?string $nifStatus): self
    {
        $this->initialized['nifStatus'] = true;
        $this->nifStatus = $nifStatus;

        return $this;
    }

    /**
     * Successful activation date in VeriFactu production
     */
    public function getNifRegisteredAt(): ?\DateTime
    {
        return $this->nifRegisteredAt;
    }

    /**
     * Successful activation date in VeriFactu production
     */
    public function setNifRegisteredAt(?\DateTime $nifRegisteredAt): self
    {
        $this->initialized['nifRegisteredAt'] = true;
        $this->nifRegisteredAt = $nifRegisteredAt;

        return $this;
    }

    /**
     * Single derived VeriFactu state for the (NIF, environment) of the
     * request — the ONE truth every UI surface (settings banner, activation
     * card, invoice form) reads, so they can no longer contradict each other.
     * Read-only; resolved server-side. Null only if never configured.
     * - DISABLED: VeriFactu not enabled for this account.
     * - UNSIGNED: enabled but the NIF has no signed AEAT representation.
     * - NOT_ACTIVATED: signed, but no API key for the operating environment.
     * - ACTIVE: signed and activated with API key: ready to submit.
     * - ERROR: historical, no longer reachable. Activation is atomic: a failed
     *   activation leaves nothing persisted and returns the reason, so no row ever rests in
     *   this state. Kept in the enum so old clients keep parsing stored values.
     */
    public function getStatus(): ?string
    {
        return $this->status;
    }

    /**
     * Single derived VeriFactu state for the (NIF, environment) of the
    request — the ONE truth every UI surface (settings banner, activation
    card, invoice form) reads, so they can no longer contradict each other.
    Read-only; resolved server-side. Null only if never configured.
    - DISABLED: VeriFactu not enabled for this account.
    - UNSIGNED: enabled but the NIF has no signed AEAT representation.
    - NOT_ACTIVATED: signed, but no API key for the operating environment.
    - ACTIVE: signed and activated with API key: ready to submit.
    - ERROR: historical, no longer reachable. Activation is atomic: a failed
     activation leaves nothing persisted and returns the reason, so no row ever rests in
     this state. Kept in the enum so old clients keep parsing stored values.
     */
    public function setStatus(?string $status): self
    {
        $this->initialized['status'] = true;
        $this->status = $status;

        return $this;
    }

    /**
     * Secondary flag: whether the NIF has a signed AEAT representation
     * (per-NIF, shared across environments). Data for the wizard, NOT the gate.
     */
    public function getSigned(): ?bool
    {
        return $this->signed;
    }

    /**
     * Secondary flag: whether the NIF has a signed AEAT representation
    (per-NIF, shared across environments). Data for the wizard, NOT the gate.
     */
    public function setSigned(?bool $signed): self
    {
        $this->initialized['signed'] = true;
        $this->signed = $signed;

        return $this;
    }

    /**
     * Secondary flag: whether the NIF is activated (has an API key) in the
     * operating environment (per-environment). Data, NOT the gate.
     */
    public function getActivated(): ?bool
    {
        return $this->activated;
    }

    /**
     * Secondary flag: whether the NIF is activated (has an API key) in the
    operating environment (per-environment). Data, NOT the gate.
     */
    public function setActivated(?bool $activated): self
    {
        $this->initialized['activated'] = true;
        $this->activated = $activated;

        return $this;
    }

    /**
     * Secondary flag: whether a representation PDF artifact exists. Used by
     * the signature wizard as secondary data, NOT the source of truth of the gate.
     */
    public function getPdfGenerated(): ?bool
    {
        return $this->pdfGenerated;
    }

    /**
     * Secondary flag: whether a representation PDF artifact exists. Used by
    the signature wizard as secondary data, NOT the source of truth of the gate.
     */
    public function setPdfGenerated(?bool $pdfGenerated): self
    {
        $this->initialized['pdfGenerated'] = true;
        $this->pdfGenerated = $pdfGenerated;

        return $this;
    }

    public function definedProperties(): array
    {
        return ['enabled' => ['enabled', 'getEnabled', 'setEnabled'], 'nifStatus' => ['nif_status', 'getNifStatus', 'setNifStatus'], 'nifRegisteredAt' => ['nif_registered_at', 'getNifRegisteredAt', 'setNifRegisteredAt'], 'status' => ['status', 'getStatus', 'setStatus'], 'signed' => ['signed', 'getSigned', 'setSigned'], 'activated' => ['activated', 'getActivated', 'setActivated'], 'pdfGenerated' => ['pdf_generated', 'getPdfGenerated', 'setPdfGenerated']];
    }
}
