<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;
class V1AccountsPostResponse201 implements AdditionalPropertiesInterface
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
     * @var bool
     */
    protected $success;
    /**
     * Result of a successful account provision. `claim_token` is a single-use secret to deliver to the account holder so they can set their password and take ownership. It is returned only once and invalidated on re-issue; `null` if the account was already claimed, and also `null` when the account was provisioned without `email` (there is no holder to hand it to yet). `claim_url` is the ready-to-use claim link BeeL builds for the current environment; `status` disambiguates a `null` `claim_token` (already claimed) from an error.
     *
     * @var ProvisionAccountResult
     */
    protected $data;
    /**
     * @var ResponseMeta
     */
    protected $meta;
    /**
     * @return bool
     */
    public function getSuccess(): bool
    {
        return $this->success;
    }
    /**
     * @param bool $success
     *
     * @return self
     */
    public function setSuccess(bool $success): self
    {
        $this->initialized['success'] = true;
        $this->success = $success;
        return $this;
    }
    /**
     * Result of a successful account provision. `claim_token` is a single-use secret to deliver to the account holder so they can set their password and take ownership. It is returned only once and invalidated on re-issue; `null` if the account was already claimed, and also `null` when the account was provisioned without `email` (there is no holder to hand it to yet). `claim_url` is the ready-to-use claim link BeeL builds for the current environment; `status` disambiguates a `null` `claim_token` (already claimed) from an error.
     *
     * @return ProvisionAccountResult
     */
    public function getData(): ProvisionAccountResult
    {
        return $this->data;
    }
    /**
     * Result of a successful account provision. `claim_token` is a single-use secret to deliver to the account holder so they can set their password and take ownership. It is returned only once and invalidated on re-issue; `null` if the account was already claimed, and also `null` when the account was provisioned without `email` (there is no holder to hand it to yet). `claim_url` is the ready-to-use claim link BeeL builds for the current environment; `status` disambiguates a `null` `claim_token` (already claimed) from an error.
     *
     * @param ProvisionAccountResult $data
     *
     * @return self
     */
    public function setData(ProvisionAccountResult $data): self
    {
        $this->initialized['data'] = true;
        $this->data = $data;
        return $this;
    }
    /**
     * @return ResponseMeta
     */
    public function getMeta(): ResponseMeta
    {
        return $this->meta;
    }
    /**
     * @param ResponseMeta $meta
     *
     * @return self
     */
    public function setMeta(ResponseMeta $meta): self
    {
        $this->initialized['meta'] = true;
        $this->meta = $meta;
        return $this;
    }
    public function definedProperties(): array
    {
        return ['success' => ['success', 'getSuccess', 'setSuccess'], 'data' => ['data', 'getData', 'setData'], 'meta' => ['meta', 'getMeta', 'setMeta']];
    }
}