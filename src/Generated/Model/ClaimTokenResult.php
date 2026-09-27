<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;
class ClaimTokenResult implements AdditionalPropertiesInterface
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
     * The account holder — created by this call if the account had none.
     *
     * @var string
     */
    protected $personId;
    /**
     * Single-use claim token. Deliver it to the holder; it is never returned again.
     *
     * @var string
     */
    protected $claimToken;
    /**
     * Ready-to-use claim link built by BeeL. for the current environment.
     *
     * @var string
     */
    protected $claimUrl;
    /**
     * When the token stops working (30 days from issue). Issue a new one to replace it.
     *
     * @var \DateTime
     */
    protected $expiresAt;
    /**
     * The account holder — created by this call if the account had none.
     *
     * @return string
     */
    public function getPersonId(): string
    {
        return $this->personId;
    }
    /**
     * The account holder — created by this call if the account had none.
     *
     * @param string $personId
     *
     * @return self
     */
    public function setPersonId(string $personId): self
    {
        $this->initialized['personId'] = true;
        $this->personId = $personId;
        return $this;
    }
    /**
     * Single-use claim token. Deliver it to the holder; it is never returned again.
     *
     * @return string
     */
    public function getClaimToken(): string
    {
        return $this->claimToken;
    }
    /**
     * Single-use claim token. Deliver it to the holder; it is never returned again.
     *
     * @param string $claimToken
     *
     * @return self
     */
    public function setClaimToken(string $claimToken): self
    {
        $this->initialized['claimToken'] = true;
        $this->claimToken = $claimToken;
        return $this;
    }
    /**
     * Ready-to-use claim link built by BeeL. for the current environment.
     *
     * @return string
     */
    public function getClaimUrl(): string
    {
        return $this->claimUrl;
    }
    /**
     * Ready-to-use claim link built by BeeL. for the current environment.
     *
     * @param string $claimUrl
     *
     * @return self
     */
    public function setClaimUrl(string $claimUrl): self
    {
        $this->initialized['claimUrl'] = true;
        $this->claimUrl = $claimUrl;
        return $this;
    }
    /**
     * When the token stops working (30 days from issue). Issue a new one to replace it.
     *
     * @return \DateTime
     */
    public function getExpiresAt(): \DateTime
    {
        return $this->expiresAt;
    }
    /**
     * When the token stops working (30 days from issue). Issue a new one to replace it.
     *
     * @param \DateTime $expiresAt
     *
     * @return self
     */
    public function setExpiresAt(\DateTime $expiresAt): self
    {
        $this->initialized['expiresAt'] = true;
        $this->expiresAt = $expiresAt;
        return $this;
    }
    public function definedProperties(): array
    {
        return ['personId' => ['person_id', 'getPersonId', 'setPersonId'], 'claimToken' => ['claim_token', 'getClaimToken', 'setClaimToken'], 'claimUrl' => ['claim_url', 'getClaimUrl', 'setClaimUrl'], 'expiresAt' => ['expires_at', 'getExpiresAt', 'setExpiresAt']];
    }
}