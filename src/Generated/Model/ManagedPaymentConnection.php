<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;
class ManagedPaymentConnection implements AdditionalPropertiesInterface
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
     * Unique identifier of the connection. It is what addresses the connection everywhere
     * else — `PATCH`, `DELETE` and events all take it as `{connection_id}`.
     * 
     *
     * @var string
     */
    protected $id;
    /**
     * Payment provider slug (lowercase).
     *
     * @var string
     */
    protected $provider;
    /**
     * Provider-side account id (e.g. Stripe `acct_...`).
     *
     * @var string
     */
    protected $externalAccountId;
    /**
     * Provider-side account display name, if any.
     *
     * @var string|null
     */
    protected $externalAccountName;
    /**
     * Mode the connection lives in (`beel_sk_test_*` → `TEST`, `beel_sk_live_*` → `PROD`).
     * Test and Live connections are independent, so the same provider account may appear in
     * both modes; this field tells them apart without inferring it from the key you asked
     * with.
     * 
     *
     * @var string
     */
    protected $environment;
    /**
     * Status of the payment provider connection.
     * 
     * - `PENDING`: authorization opened, not completed yet
     * - `ACTIVE`: the connection invoices incoming charges
     * - `DISCONNECTED`: withdrawn — it no longer invoices anything
     * - `ERROR`: the provider rejected the last call, so it needs reconnecting
     * 
     *
     * @var string
     */
    protected $status;
    /**
     * When the connection was established.
     *
     * @var \DateTime|null
     */
    protected $connectedAt;
    /**
     * Unique identifier of the connection. It is what addresses the connection everywhere
     * else — `PATCH`, `DELETE` and events all take it as `{connection_id}`.
     * 
     *
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }
    /**
    * Unique identifier of the connection. It is what addresses the connection everywhere
    else — `PATCH`, `DELETE` and events all take it as `{connection_id}`.
    
    *
    * @param string $id
    *
    * @return self
    */
    public function setId(string $id): self
    {
        $this->initialized['id'] = true;
        $this->id = $id;
        return $this;
    }
    /**
     * Payment provider slug (lowercase).
     *
     * @return string
     */
    public function getProvider(): string
    {
        return $this->provider;
    }
    /**
     * Payment provider slug (lowercase).
     *
     * @param string $provider
     *
     * @return self
     */
    public function setProvider(string $provider): self
    {
        $this->initialized['provider'] = true;
        $this->provider = $provider;
        return $this;
    }
    /**
     * Provider-side account id (e.g. Stripe `acct_...`).
     *
     * @return string
     */
    public function getExternalAccountId(): string
    {
        return $this->externalAccountId;
    }
    /**
     * Provider-side account id (e.g. Stripe `acct_...`).
     *
     * @param string $externalAccountId
     *
     * @return self
     */
    public function setExternalAccountId(string $externalAccountId): self
    {
        $this->initialized['externalAccountId'] = true;
        $this->externalAccountId = $externalAccountId;
        return $this;
    }
    /**
     * Provider-side account display name, if any.
     *
     * @return string|null
     */
    public function getExternalAccountName(): ?string
    {
        return $this->externalAccountName;
    }
    /**
     * Provider-side account display name, if any.
     *
     * @param string|null $externalAccountName
     *
     * @return self
     */
    public function setExternalAccountName(?string $externalAccountName): self
    {
        $this->initialized['externalAccountName'] = true;
        $this->externalAccountName = $externalAccountName;
        return $this;
    }
    /**
     * Mode the connection lives in (`beel_sk_test_*` → `TEST`, `beel_sk_live_*` → `PROD`).
     * Test and Live connections are independent, so the same provider account may appear in
     * both modes; this field tells them apart without inferring it from the key you asked
     * with.
     * 
     *
     * @return string
     */
    public function getEnvironment(): string
    {
        return $this->environment;
    }
    /**
    * Mode the connection lives in (`beel_sk_test_*` → `TEST`, `beel_sk_live_*` → `PROD`).
    Test and Live connections are independent, so the same provider account may appear in
    both modes; this field tells them apart without inferring it from the key you asked
    with.
    
    *
    * @param string $environment
    *
    * @return self
    */
    public function setEnvironment(string $environment): self
    {
        $this->initialized['environment'] = true;
        $this->environment = $environment;
        return $this;
    }
    /**
     * Status of the payment provider connection.
     * 
     * - `PENDING`: authorization opened, not completed yet
     * - `ACTIVE`: the connection invoices incoming charges
     * - `DISCONNECTED`: withdrawn — it no longer invoices anything
     * - `ERROR`: the provider rejected the last call, so it needs reconnecting
     * 
     *
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }
    /**
    * Status of the payment provider connection.
    
    - `PENDING`: authorization opened, not completed yet
    - `ACTIVE`: the connection invoices incoming charges
    - `DISCONNECTED`: withdrawn — it no longer invoices anything
    - `ERROR`: the provider rejected the last call, so it needs reconnecting
    
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
     * When the connection was established.
     *
     * @return \DateTime|null
     */
    public function getConnectedAt(): ?\DateTime
    {
        return $this->connectedAt;
    }
    /**
     * When the connection was established.
     *
     * @param \DateTime|null $connectedAt
     *
     * @return self
     */
    public function setConnectedAt(?\DateTime $connectedAt): self
    {
        $this->initialized['connectedAt'] = true;
        $this->connectedAt = $connectedAt;
        return $this;
    }
    public function definedProperties(): array
    {
        return ['id' => ['id', 'getId', 'setId'], 'provider' => ['provider', 'getProvider', 'setProvider'], 'externalAccountId' => ['external_account_id', 'getExternalAccountId', 'setExternalAccountId'], 'externalAccountName' => ['external_account_name', 'getExternalAccountName', 'setExternalAccountName'], 'environment' => ['environment', 'getEnvironment', 'setEnvironment'], 'status' => ['status', 'getStatus', 'setStatus'], 'connectedAt' => ['connected_at', 'getConnectedAt', 'setConnectedAt']];
    }
}