<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;
class IssuingReadinessData implements AdditionalPropertiesInterface
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
     * @var bool|null
     */
    protected $ready;
    /**
     * Reasons the company cannot issue yet (empty when ready). Each one names what is
     * missing and how to clear it:
     * 
     * - `COMPANY_HAS_NO_NIF`: the company has no NIF. Set `nif` with
     *   `PATCH /v1/companies/{company_id}`; once set it cannot be changed.
     * - `SERIES_DEFAULT_NOT_FOUND`: there is no default `STANDARD` invoice series in this
     *   environment. The `SIMPLIFIED` and `CORRECTIVE` ones are created on first use.
     *   `PUT /v1/companies/{company_id}/series/defaults` creates the missing ones, or mark an
     *   existing series with `PUT /v1/companies/{company_id}/series/{series_id}/default`.
     * - `PROFILE_INCOMPLETE`: the fiscal identity is not complete enough to write an invoice
     *   header: entity type, legal name or full fiscal address is missing. Complete
     *   `entity_type`, `legal_name` and `address` with `PATCH /v1/companies/{company_id}`. A
     *   missing NIF is reported as `COMPANY_HAS_NO_NIF` instead, never as both.
     * - `COMPANY_NOT_ACTIVATED`: the company is not activated in the environment of the
     *   request, and it is not under the VeriFactu regime. Activate it with
     *   `POST /v1/companies/{company_id}/activations` for that environment.
     * - `ENV_MISMATCH`: the same missing activation, for a company under the VeriFactu
     *   regime. Activate it as above, or call with a credential of the environment where it
     *   is already activated. The first stage of the VeriFactu chain.
     * - `NIF_NOT_REGISTERED`: the NIF is not registered for VeriFactu submission in this
     *   environment. Turning VeriFactu on
     *   (`PUT /v1/companies/{company_id}/verifactu-configuration` with `enabled: true`)
     *   registers it; in Live that call needs the signed representation first. Never reported
     *   in Test, where the NIF is registered with its first submission.
     * - `NIF_REPRESENTATION_REQUIRED`: the NIF is registered, but there is no signed AEAT
     *   representation in force. Generate it with
     *   `POST /v1/companies/{company_id}/representation`, sign it digitally and send it with
     *   `POST /v1/companies/{company_id}/representation/submit`. Live only.
     * 
     *
     * @var list<string>|null
     */
    protected $blockers;
    /**
     * The compliance question, separate from the operational `ready` above: would
     * this NIF pass a VeriFactu emission right now? Relevant before putting the company
     * under the VeriFactu regime. For a company already under the regime,
     * `verifactu.ready` coincides with `ready` (same evaluation).
     * 
     *
     * @var IssuingReadinessDataVerifactu|null
     */
    protected $verifactu;
    /**
     * true if the company can issue invoices (no blockers).
     *
     * @return bool|null
     */
    public function getReady(): ?bool
    {
        return $this->ready;
    }
    /**
     * true if the company can issue invoices (no blockers).
     *
     * @param bool|null $ready
     *
     * @return self
     */
    public function setReady(?bool $ready): self
    {
        $this->initialized['ready'] = true;
        $this->ready = $ready;
        return $this;
    }
    /**
     * Reasons the company cannot issue yet (empty when ready). Each one names what is
     * missing and how to clear it:
     * 
     * - `COMPANY_HAS_NO_NIF`: the company has no NIF. Set `nif` with
     *   `PATCH /v1/companies/{company_id}`; once set it cannot be changed.
     * - `SERIES_DEFAULT_NOT_FOUND`: there is no default `STANDARD` invoice series in this
     *   environment. The `SIMPLIFIED` and `CORRECTIVE` ones are created on first use.
     *   `PUT /v1/companies/{company_id}/series/defaults` creates the missing ones, or mark an
     *   existing series with `PUT /v1/companies/{company_id}/series/{series_id}/default`.
     * - `PROFILE_INCOMPLETE`: the fiscal identity is not complete enough to write an invoice
     *   header: entity type, legal name or full fiscal address is missing. Complete
     *   `entity_type`, `legal_name` and `address` with `PATCH /v1/companies/{company_id}`. A
     *   missing NIF is reported as `COMPANY_HAS_NO_NIF` instead, never as both.
     * - `COMPANY_NOT_ACTIVATED`: the company is not activated in the environment of the
     *   request, and it is not under the VeriFactu regime. Activate it with
     *   `POST /v1/companies/{company_id}/activations` for that environment.
     * - `ENV_MISMATCH`: the same missing activation, for a company under the VeriFactu
     *   regime. Activate it as above, or call with a credential of the environment where it
     *   is already activated. The first stage of the VeriFactu chain.
     * - `NIF_NOT_REGISTERED`: the NIF is not registered for VeriFactu submission in this
     *   environment. Turning VeriFactu on
     *   (`PUT /v1/companies/{company_id}/verifactu-configuration` with `enabled: true`)
     *   registers it; in Live that call needs the signed representation first. Never reported
     *   in Test, where the NIF is registered with its first submission.
     * - `NIF_REPRESENTATION_REQUIRED`: the NIF is registered, but there is no signed AEAT
     *   representation in force. Generate it with
     *   `POST /v1/companies/{company_id}/representation`, sign it digitally and send it with
     *   `POST /v1/companies/{company_id}/representation/submit`. Live only.
     * 
     *
     * @return list<string>|null
     */
    public function getBlockers(): ?array
    {
        return $this->blockers;
    }
    /**
    * Reasons the company cannot issue yet (empty when ready). Each one names what is
    missing and how to clear it:
    
    - `COMPANY_HAS_NO_NIF`: the company has no NIF. Set `nif` with
     `PATCH /v1/companies/{company_id}`; once set it cannot be changed.
    - `SERIES_DEFAULT_NOT_FOUND`: there is no default `STANDARD` invoice series in this
     environment. The `SIMPLIFIED` and `CORRECTIVE` ones are created on first use.
     `PUT /v1/companies/{company_id}/series/defaults` creates the missing ones, or mark an
     existing series with `PUT /v1/companies/{company_id}/series/{series_id}/default`.
    - `PROFILE_INCOMPLETE`: the fiscal identity is not complete enough to write an invoice
     header: entity type, legal name or full fiscal address is missing. Complete
     `entity_type`, `legal_name` and `address` with `PATCH /v1/companies/{company_id}`. A
     missing NIF is reported as `COMPANY_HAS_NO_NIF` instead, never as both.
    - `COMPANY_NOT_ACTIVATED`: the company is not activated in the environment of the
     request, and it is not under the VeriFactu regime. Activate it with
     `POST /v1/companies/{company_id}/activations` for that environment.
    - `ENV_MISMATCH`: the same missing activation, for a company under the VeriFactu
     regime. Activate it as above, or call with a credential of the environment where it
     is already activated. The first stage of the VeriFactu chain.
    - `NIF_NOT_REGISTERED`: the NIF is not registered for VeriFactu submission in this
     environment. Turning VeriFactu on
     (`PUT /v1/companies/{company_id}/verifactu-configuration` with `enabled: true`)
     registers it; in Live that call needs the signed representation first. Never reported
     in Test, where the NIF is registered with its first submission.
    - `NIF_REPRESENTATION_REQUIRED`: the NIF is registered, but there is no signed AEAT
     representation in force. Generate it with
     `POST /v1/companies/{company_id}/representation`, sign it digitally and send it with
     `POST /v1/companies/{company_id}/representation/submit`. Live only.
    
    *
    * @param list<string>|null $blockers
    *
    * @return self
    */
    public function setBlockers(?array $blockers): self
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
     * 
     *
     * @return IssuingReadinessDataVerifactu|null
     */
    public function getVerifactu(): ?IssuingReadinessDataVerifactu
    {
        return $this->verifactu;
    }
    /**
    * The compliance question, separate from the operational `ready` above: would
    this NIF pass a VeriFactu emission right now? Relevant before putting the company
    under the VeriFactu regime. For a company already under the regime,
    `verifactu.ready` coincides with `ready` (same evaluation).
    
    *
    * @param IssuingReadinessDataVerifactu|null $verifactu
    *
    * @return self
    */
    public function setVerifactu(?IssuingReadinessDataVerifactu $verifactu): self
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