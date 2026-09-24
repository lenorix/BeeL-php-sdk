<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;

class CompanyDataReadiness implements AdditionalPropertiesInterface
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
     * true if the company can issue invoices (no blockers).
     *
     * @var bool
     */
    protected $ready;

    /**
     * Reasons the company cannot issue yet (empty when ready).
     * `PROFILE_INCOMPLETE` means the company's fiscal identity is not complete
     * enough to write an invoice header (entity type, legal name, fiscal address);
     * a missing NIF is reported as `COMPANY_HAS_NO_NIF` instead, not as both.
     *
     *
     * @var list<string>
     */
    protected $blockers;

    /**
     * The compliance question, separate from the operational `ready` above: would
     * this NIF pass a VeriFactu emission right now? Relevant before putting the company
     * under the VeriFactu regime. For a company already under the regime,
     * `verifactu.ready` coincides with `ready` (same evaluation).
     *
     *
     * @var IssuingReadinessDataVerifactu
     */
    protected $verifactu;

    /**
     * true if the company can issue invoices (no blockers).
     */
    public function getReady(): bool
    {
        return $this->ready;
    }

    /**
     * true if the company can issue invoices (no blockers).
     */
    public function setReady(bool $ready): self
    {
        $this->initialized['ready'] = true;
        $this->ready = $ready;

        return $this;
    }

    /**
     * Reasons the company cannot issue yet (empty when ready).
     * `PROFILE_INCOMPLETE` means the company's fiscal identity is not complete
     * enough to write an invoice header (entity type, legal name, fiscal address);
     * a missing NIF is reported as `COMPANY_HAS_NO_NIF` instead, not as both.
     *
     *
     * @return list<string>
     */
    public function getBlockers(): array
    {
        return $this->blockers;
    }

    /**
     * Reasons the company cannot issue yet (empty when ready).
    `PROFILE_INCOMPLETE` means the company's fiscal identity is not complete
    enough to write an invoice header (entity type, legal name, fiscal address);
    a missing NIF is reported as `COMPANY_HAS_NO_NIF` instead, not as both.

     *
     * @param  list<string>  $blockers
     */
    public function setBlockers(array $blockers): self
    {
        $this->initialized['blockers'] = true;
        $this->blockers = $blockers;

        return $this;
    }

    /**
     * The compliance question, separate from the operational `ready` above: would
     * this NIF pass a VeriFactu emission right now? Relevant before putting the company
     * under the VeriFactu regime. For a company already under the regime,
     * `verifactu.ready` coincides with `ready` (same evaluation).
     */
    public function getVerifactu(): IssuingReadinessDataVerifactu
    {
        return $this->verifactu;
    }

    /**
     * The compliance question, separate from the operational `ready` above: would
    this NIF pass a VeriFactu emission right now? Relevant before putting the company
    under the VeriFactu regime. For a company already under the regime,
    `verifactu.ready` coincides with `ready` (same evaluation).
     */
    public function setVerifactu(IssuingReadinessDataVerifactu $verifactu): self
    {
        $this->initialized['verifactu'] = true;
        $this->verifactu = $verifactu;

        return $this;
    }

    public function definedProperties(): array
    {
        return ['ready' => ['ready', 'getReady', 'setReady'], 'blockers' => ['blockers', 'getBlockers', 'setBlockers'], 'verifactu' => ['verifactu', 'getVerifactu', 'setVerifactu']];
    }
}
