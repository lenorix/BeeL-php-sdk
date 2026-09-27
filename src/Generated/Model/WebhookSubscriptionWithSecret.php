<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;

class WebhookSubscriptionWithSecret implements AdditionalPropertiesInterface
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
     * @var string
     */
    protected $id;

    /**
     * @var string
     */
    protected $url;

    /**
     * @var list<string>
     */
    protected $events;

    /**
     * @var bool
     */
    protected $active;

    /**
     * Which accounts this subscription receives events from. Same field name and values as the `account_relationship` carried by every event envelope.
     *
     *
     * @var string
     */
    protected $accountRelationship;

    /**
     * Who turned this subscription off. Absent while it is active. `beel` means we paused it because the endpoint went 25 consecutive deliveries without a single success over more than 48 hours — reactivating it requires a successful test delivery first.
     *
     *
     * @var string
     */
    protected $deactivatedBy;

    /**
     * When the subscription was turned off. Null while it is active.
     *
     * @var \DateTime|null
     */
    protected $deactivatedAt;

    /**
     * Last error seen in the current run of failed deliveries — what to fix. Cleared by the first successful delivery, together with the failure count.
     *
     *
     * @var string|null
     */
    protected $lastError;

    /**
     * Stable code for `last_error`. Cleared alongside it by the first successful delivery.
     *
     *
     * @var string
     */
    protected $lastErrorCause;

    /**
     * Deliveries in a row that never got through. A delivery that exhausted its 5 attempts counts as one. Any successful delivery resets it to zero, so a healthy endpoint with occasional blips stays near zero.
     *
     *
     * @var int
     */
    protected $consecutiveFailures;

    /**
     * Last delivery that succeeded. Null if none ever has.
     *
     * @var \DateTime|null
     */
    protected $lastUsedAt;

    /**
     * @var \DateTime
     */
    protected $createdAt;

    /**
     * HMAC-SHA256 signing secret. **Only returned on creation and secret rotation.**
     * Store it securely — it cannot be retrieved again.
     *
     *
     * @var string
     */
    protected $secret;

    /**
     * Outcome of a one-off signed test delivery sent to your URL as part of creating the
     * subscription, so you learn whether your endpoint answers without a second call.
     *
     * It is **best effort and never blocks the subscription**: the subscription in `data`
     * exists and is active regardless of what this says, and the field is `null` when the
     * test could not be run at all. A failure here means your endpoint is not ready yet —
     * typically because you registered before deploying it — not that anything went wrong
     * with the registration. Only present on creation, never on secret rotation.
     *
     *
     * @var WebhookSubscriptionWithSecretTestDelivery|null
     */
    protected $testDelivery;

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): self
    {
        $this->initialized['id'] = true;
        $this->id = $id;

        return $this;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function setUrl(string $url): self
    {
        $this->initialized['url'] = true;
        $this->url = $url;

        return $this;
    }

    /**
     * @return list<string>
     */
    public function getEvents(): array
    {
        return $this->events;
    }

    /**
     * @param  list<string>  $events
     */
    public function setEvents(array $events): self
    {
        $this->initialized['events'] = true;
        $this->events = $events;

        return $this;
    }

    public function getActive(): bool
    {
        return $this->active;
    }

    public function setActive(bool $active): self
    {
        $this->initialized['active'] = true;
        $this->active = $active;

        return $this;
    }

    /**
     * Which accounts this subscription receives events from. Same field name and values as the `account_relationship` carried by every event envelope.
     */
    public function getAccountRelationship(): string
    {
        return $this->accountRelationship;
    }

    /**
     * Which accounts this subscription receives events from. Same field name and values as the `account_relationship` carried by every event envelope.
     */
    public function setAccountRelationship(string $accountRelationship): self
    {
        $this->initialized['accountRelationship'] = true;
        $this->accountRelationship = $accountRelationship;

        return $this;
    }

    /**
     * Who turned this subscription off. Absent while it is active. `beel` means we paused it because the endpoint went 25 consecutive deliveries without a single success over more than 48 hours — reactivating it requires a successful test delivery first.
     */
    public function getDeactivatedBy(): string
    {
        return $this->deactivatedBy;
    }

    /**
     * Who turned this subscription off. Absent while it is active. `beel` means we paused it because the endpoint went 25 consecutive deliveries without a single success over more than 48 hours — reactivating it requires a successful test delivery first.
     */
    public function setDeactivatedBy(string $deactivatedBy): self
    {
        $this->initialized['deactivatedBy'] = true;
        $this->deactivatedBy = $deactivatedBy;

        return $this;
    }

    /**
     * When the subscription was turned off. Null while it is active.
     */
    public function getDeactivatedAt(): ?\DateTime
    {
        return $this->deactivatedAt;
    }

    /**
     * When the subscription was turned off. Null while it is active.
     */
    public function setDeactivatedAt(?\DateTime $deactivatedAt): self
    {
        $this->initialized['deactivatedAt'] = true;
        $this->deactivatedAt = $deactivatedAt;

        return $this;
    }

    /**
     * Last error seen in the current run of failed deliveries — what to fix. Cleared by the first successful delivery, together with the failure count.
     */
    public function getLastError(): ?string
    {
        return $this->lastError;
    }

    /**
     * Last error seen in the current run of failed deliveries — what to fix. Cleared by the first successful delivery, together with the failure count.
     */
    public function setLastError(?string $lastError): self
    {
        $this->initialized['lastError'] = true;
        $this->lastError = $lastError;

        return $this;
    }

    /**
     * Stable code for `last_error`. Cleared alongside it by the first successful delivery.
     */
    public function getLastErrorCause(): string
    {
        return $this->lastErrorCause;
    }

    /**
     * Stable code for `last_error`. Cleared alongside it by the first successful delivery.
     */
    public function setLastErrorCause(string $lastErrorCause): self
    {
        $this->initialized['lastErrorCause'] = true;
        $this->lastErrorCause = $lastErrorCause;

        return $this;
    }

    /**
     * Deliveries in a row that never got through. A delivery that exhausted its 5 attempts counts as one. Any successful delivery resets it to zero, so a healthy endpoint with occasional blips stays near zero.
     */
    public function getConsecutiveFailures(): int
    {
        return $this->consecutiveFailures;
    }

    /**
     * Deliveries in a row that never got through. A delivery that exhausted its 5 attempts counts as one. Any successful delivery resets it to zero, so a healthy endpoint with occasional blips stays near zero.
     */
    public function setConsecutiveFailures(int $consecutiveFailures): self
    {
        $this->initialized['consecutiveFailures'] = true;
        $this->consecutiveFailures = $consecutiveFailures;

        return $this;
    }

    /**
     * Last delivery that succeeded. Null if none ever has.
     */
    public function getLastUsedAt(): ?\DateTime
    {
        return $this->lastUsedAt;
    }

    /**
     * Last delivery that succeeded. Null if none ever has.
     */
    public function setLastUsedAt(?\DateTime $lastUsedAt): self
    {
        $this->initialized['lastUsedAt'] = true;
        $this->lastUsedAt = $lastUsedAt;

        return $this;
    }

    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTime $createdAt): self
    {
        $this->initialized['createdAt'] = true;
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * HMAC-SHA256 signing secret. **Only returned on creation and secret rotation.**
     * Store it securely — it cannot be retrieved again.
     */
    public function getSecret(): string
    {
        return $this->secret;
    }

    /**
     * HMAC-SHA256 signing secret. **Only returned on creation and secret rotation.**
    Store it securely — it cannot be retrieved again.
     */
    public function setSecret(string $secret): self
    {
        $this->initialized['secret'] = true;
        $this->secret = $secret;

        return $this;
    }

    /**
     * Outcome of a one-off signed test delivery sent to your URL as part of creating the
     * subscription, so you learn whether your endpoint answers without a second call.
     *
     * It is **best effort and never blocks the subscription**: the subscription in `data`
     * exists and is active regardless of what this says, and the field is `null` when the
     * test could not be run at all. A failure here means your endpoint is not ready yet —
     * typically because you registered before deploying it — not that anything went wrong
     * with the registration. Only present on creation, never on secret rotation.
     */
    public function getTestDelivery(): ?WebhookSubscriptionWithSecretTestDelivery
    {
        return $this->testDelivery;
    }

    /**
     * Outcome of a one-off signed test delivery sent to your URL as part of creating the
    subscription, so you learn whether your endpoint answers without a second call.

    It is **best effort and never blocks the subscription**: the subscription in `data`
    exists and is active regardless of what this says, and the field is `null` when the
    test could not be run at all. A failure here means your endpoint is not ready yet —
    typically because you registered before deploying it — not that anything went wrong
    with the registration. Only present on creation, never on secret rotation.
     */
    public function setTestDelivery(?WebhookSubscriptionWithSecretTestDelivery $testDelivery): self
    {
        $this->initialized['testDelivery'] = true;
        $this->testDelivery = $testDelivery;

        return $this;
    }

    public function definedProperties(): array
    {
        return ['id' => ['id', 'getId', 'setId'], 'url' => ['url', 'getUrl', 'setUrl'], 'events' => ['events', 'getEvents', 'setEvents'], 'active' => ['active', 'getActive', 'setActive'], 'accountRelationship' => ['account_relationship', 'getAccountRelationship', 'setAccountRelationship'], 'deactivatedBy' => ['deactivated_by', 'getDeactivatedBy', 'setDeactivatedBy'], 'deactivatedAt' => ['deactivated_at', 'getDeactivatedAt', 'setDeactivatedAt'], 'lastError' => ['last_error', 'getLastError', 'setLastError'], 'lastErrorCause' => ['last_error_cause', 'getLastErrorCause', 'setLastErrorCause'], 'consecutiveFailures' => ['consecutive_failures', 'getConsecutiveFailures', 'setConsecutiveFailures'], 'lastUsedAt' => ['last_used_at', 'getLastUsedAt', 'setLastUsedAt'], 'createdAt' => ['created_at', 'getCreatedAt', 'setCreatedAt'], 'secret' => ['secret', 'getSecret', 'setSecret'], 'testDelivery' => ['test_delivery', 'getTestDelivery', 'setTestDelivery']];
    }
}
