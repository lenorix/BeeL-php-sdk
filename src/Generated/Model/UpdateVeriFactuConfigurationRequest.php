<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;

class UpdateVeriFactuConfigurationRequest implements AdditionalPropertiesInterface
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
     * Whether this tax ID is under the VeriFactu regime in the environment of the request.
     *
     * It is a fact about the **taxpayer**, not about a document: while it is on, *every*
     * invoice of this tax ID is registered with the AEAT; while it is off, none is. There
     * is no per-invoice choice.
     *
     * Turning it on **registers the tax ID with the provider in the same call**, atomically:
     * if the provider rejects it, nothing is persisted and the response carries the reason.
     * In Live it requires a signed and validated AEAT representation first
     * (`VERIFACTU_REPRESENTATION_REQUIRED`).
     *
     * In **sandbox VeriFactu is always on and cannot be turned off**
     * (`VERIFACTU_ALWAYS_ON_IN_SANDBOX`): nothing there reaches the real AEAT.
     *
     *
     * @var bool
     */
    protected $enabled;

    /**
     * Whether this tax ID is under the VeriFactu regime in the environment of the request.
     *
     * It is a fact about the **taxpayer**, not about a document: while it is on, *every*
     * invoice of this tax ID is registered with the AEAT; while it is off, none is. There
     * is no per-invoice choice.
     *
     * Turning it on **registers the tax ID with the provider in the same call**, atomically:
     * if the provider rejects it, nothing is persisted and the response carries the reason.
     * In Live it requires a signed and validated AEAT representation first
     * (`VERIFACTU_REPRESENTATION_REQUIRED`).
     *
     * In **sandbox VeriFactu is always on and cannot be turned off**
     * (`VERIFACTU_ALWAYS_ON_IN_SANDBOX`): nothing there reaches the real AEAT.
     */
    public function getEnabled(): bool
    {
        return $this->enabled;
    }

    /**
     * Whether this tax ID is under the VeriFactu regime in the environment of the request.

    It is a fact about the **taxpayer**, not about a document: while it is on, *every*
    invoice of this tax ID is registered with the AEAT; while it is off, none is. There
    is no per-invoice choice.

    Turning it on **registers the tax ID with the provider in the same call**, atomically:
    if the provider rejects it, nothing is persisted and the response carries the reason.
    In Live it requires a signed and validated AEAT representation first
    (`VERIFACTU_REPRESENTATION_REQUIRED`).

    In **sandbox VeriFactu is always on and cannot be turned off**
    (`VERIFACTU_ALWAYS_ON_IN_SANDBOX`): nothing there reaches the real AEAT.
     */
    public function setEnabled(bool $enabled): self
    {
        $this->initialized['enabled'] = true;
        $this->enabled = $enabled;

        return $this;
    }

    public function definedProperties(): array
    {
        return ['enabled' => ['enabled', 'getEnabled', 'setEnabled']];
    }
}
