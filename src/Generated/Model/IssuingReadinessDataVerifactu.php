<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;
class IssuingReadinessDataVerifactu implements AdditionalPropertiesInterface
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
     * true only when the company is operationally `ready` AND its VeriFactu
     * capability chain is clean. An operational blocker (missing NIF, default
     * series, or an incomplete fiscal identity) makes this false even if the
     * chain itself is complete — and, since those are not chain stages, it does
     * so with an EMPTY `blockers` list here. The reason is in the top-level
     * `blockers`, which is where operational blockers are reported.
     * 
     *
     * @var bool|null
     */
    protected $ready;
    /**
     * ONLY the incremental VeriFactu capability stages, in order and mutually
     * exclusive — one reason at a time, without repeating the operational
     * blockers (NIF/series/fiscal identity) listed above. The stages, and how to
     * clear each one, are the same as in the top-level `blockers`:
     * 
     * - `ENV_MISMATCH`: the company is not activated in the environment of the request.
     * - `NIF_NOT_REGISTERED`: the NIF is not registered for VeriFactu submission in
     *   this environment; turning VeriFactu on registers it.
     * - `NIF_REPRESENTATION_REQUIRED`: no signed AEAT representation in force. Only
     *   appears where a signed representation is actually demanded (Live).
     * 
     *
     * @var list<string>|null
     */
    protected $blockers;
    /**
     * true only when the company is operationally `ready` AND its VeriFactu
     * capability chain is clean. An operational blocker (missing NIF, default
     * series, or an incomplete fiscal identity) makes this false even if the
     * chain itself is complete — and, since those are not chain stages, it does
     * so with an EMPTY `blockers` list here. The reason is in the top-level
     * `blockers`, which is where operational blockers are reported.
     * 
     *
     * @return bool|null
     */
    public function getReady(): ?bool
    {
        return $this->ready;
    }
    /**
    * true only when the company is operationally `ready` AND its VeriFactu
    capability chain is clean. An operational blocker (missing NIF, default
    series, or an incomplete fiscal identity) makes this false even if the
    chain itself is complete — and, since those are not chain stages, it does
    so with an EMPTY `blockers` list here. The reason is in the top-level
    `blockers`, which is where operational blockers are reported.
    
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
     * ONLY the incremental VeriFactu capability stages, in order and mutually
     * exclusive — one reason at a time, without repeating the operational
     * blockers (NIF/series/fiscal identity) listed above. The stages, and how to
     * clear each one, are the same as in the top-level `blockers`:
     * 
     * - `ENV_MISMATCH`: the company is not activated in the environment of the request.
     * - `NIF_NOT_REGISTERED`: the NIF is not registered for VeriFactu submission in
     *   this environment; turning VeriFactu on registers it.
     * - `NIF_REPRESENTATION_REQUIRED`: no signed AEAT representation in force. Only
     *   appears where a signed representation is actually demanded (Live).
     * 
     *
     * @return list<string>|null
     */
    public function getBlockers(): ?array
    {
        return $this->blockers;
    }
    /**
    * ONLY the incremental VeriFactu capability stages, in order and mutually
    exclusive — one reason at a time, without repeating the operational
    blockers (NIF/series/fiscal identity) listed above. The stages, and how to
    clear each one, are the same as in the top-level `blockers`:
    
    - `ENV_MISMATCH`: the company is not activated in the environment of the request.
    - `NIF_NOT_REGISTERED`: the NIF is not registered for VeriFactu submission in
     this environment; turning VeriFactu on registers it.
    - `NIF_REPRESENTATION_REQUIRED`: no signed AEAT representation in force. Only
     appears where a signed representation is actually demanded (Live).
    
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
    public function definedProperties(): array
    {
        return ['ready' => ['ready', 'getReady', 'setReady'], 'blockers' => ['blockers', 'getBlockers', 'setBlockers']];
    }
}