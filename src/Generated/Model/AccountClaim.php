<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;
class AccountClaim implements AdditionalPropertiesInterface
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
     * State of the account's claim link — the handover of the account to its holder. It answers the only question the manager has in front of a list: *can this person still take their account, or do I have to send them a new link?*
     * 
     * `NOT_ISSUED` (no claim token was ever issued: the account was provisioned without `email` and has no holder yet); `PENDING` (a token is live — the holder can still claim); `EXPIRED` (the last token issued has lapsed, so the link in the holder's inbox no longer works); `CLAIMED` (the holder set their password and took ownership — nothing left to claim). `EXPIRED` and `NOT_ISSUED` are deliberately distinct: "it ran out" and "it was never sent" call for the same action but are not the same fact, and reporting one as the other would make the list lie.
     *
     * @var string
     */
    protected $status;
    /**
     * When the last issued token stops (`PENDING`) or stopped (`EXPIRED`) working. Tokens last 30 days from issue. `null` for `NOT_ISSUED` and `CLAIMED`, where there is no expiry to report.
     *
     * @var \DateTime|null
     */
    protected $expiresAt;
    /**
     * State of the account's claim link — the handover of the account to its holder. It answers the only question the manager has in front of a list: *can this person still take their account, or do I have to send them a new link?*
     * 
     * `NOT_ISSUED` (no claim token was ever issued: the account was provisioned without `email` and has no holder yet); `PENDING` (a token is live — the holder can still claim); `EXPIRED` (the last token issued has lapsed, so the link in the holder's inbox no longer works); `CLAIMED` (the holder set their password and took ownership — nothing left to claim). `EXPIRED` and `NOT_ISSUED` are deliberately distinct: "it ran out" and "it was never sent" call for the same action but are not the same fact, and reporting one as the other would make the list lie.
     *
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }
    /**
    * State of the account's claim link — the handover of the account to its holder. It answers the only question the manager has in front of a list: *can this person still take their account, or do I have to send them a new link?*
    
    `NOT_ISSUED` (no claim token was ever issued: the account was provisioned without `email` and has no holder yet); `PENDING` (a token is live — the holder can still claim); `EXPIRED` (the last token issued has lapsed, so the link in the holder's inbox no longer works); `CLAIMED` (the holder set their password and took ownership — nothing left to claim). `EXPIRED` and `NOT_ISSUED` are deliberately distinct: "it ran out" and "it was never sent" call for the same action but are not the same fact, and reporting one as the other would make the list lie.
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
     * When the last issued token stops (`PENDING`) or stopped (`EXPIRED`) working. Tokens last 30 days from issue. `null` for `NOT_ISSUED` and `CLAIMED`, where there is no expiry to report.
     *
     * @return \DateTime|null
     */
    public function getExpiresAt(): ?\DateTime
    {
        return $this->expiresAt;
    }
    /**
     * When the last issued token stops (`PENDING`) or stopped (`EXPIRED`) working. Tokens last 30 days from issue. `null` for `NOT_ISSUED` and `CLAIMED`, where there is no expiry to report.
     *
     * @param \DateTime|null $expiresAt
     *
     * @return self
     */
    public function setExpiresAt(?\DateTime $expiresAt): self
    {
        $this->initialized['expiresAt'] = true;
        $this->expiresAt = $expiresAt;
        return $this;
    }
    public function definedProperties(): array
    {
        return ['status' => ['status', 'getStatus', 'setStatus'], 'expiresAt' => ['expires_at', 'getExpiresAt', 'setExpiresAt']];
    }
}