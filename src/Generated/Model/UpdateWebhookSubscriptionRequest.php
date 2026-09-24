<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;

class UpdateWebhookSubscriptionRequest implements AdditionalPropertiesInterface
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
     * New HTTPS endpoint URL.
     *
     * @var string|null
     */
    protected $url;

    /**
     * New list of event types to subscribe to.
     *
     * @var list<string>|null
     */
    protected $events;

    /**
     * Enable or disable the webhook subscription.
     *
     * @var bool|null
     */
    protected $active;

    /**
     * New set of accounts this subscription receives events from. Same field name and values as the `account_relationship` carried by every event envelope.
     *
     *
     * @var string|null
     */
    protected $accountRelationship;

    /**
     * New HTTPS endpoint URL.
     */
    public function getUrl(): ?string
    {
        return $this->url;
    }

    /**
     * New HTTPS endpoint URL.
     */
    public function setUrl(?string $url): self
    {
        $this->initialized['url'] = true;
        $this->url = $url;

        return $this;
    }

    /**
     * New list of event types to subscribe to.
     *
     * @return list<string>|null
     */
    public function getEvents(): ?array
    {
        return $this->events;
    }

    /**
     * New list of event types to subscribe to.
     *
     * @param  list<string>|null  $events
     */
    public function setEvents(?array $events): self
    {
        $this->initialized['events'] = true;
        $this->events = $events;

        return $this;
    }

    /**
     * Enable or disable the webhook subscription.
     */
    public function getActive(): ?bool
    {
        return $this->active;
    }

    /**
     * Enable or disable the webhook subscription.
     */
    public function setActive(?bool $active): self
    {
        $this->initialized['active'] = true;
        $this->active = $active;

        return $this;
    }

    /**
     * New set of accounts this subscription receives events from. Same field name and values as the `account_relationship` carried by every event envelope.
     */
    public function getAccountRelationship(): ?string
    {
        return $this->accountRelationship;
    }

    /**
     * New set of accounts this subscription receives events from. Same field name and values as the `account_relationship` carried by every event envelope.
     */
    public function setAccountRelationship(?string $accountRelationship): self
    {
        $this->initialized['accountRelationship'] = true;
        $this->accountRelationship = $accountRelationship;

        return $this;
    }

    public function definedProperties(): array
    {
        return ['url' => ['url', 'getUrl', 'setUrl'], 'events' => ['events', 'getEvents', 'setEvents'], 'active' => ['active', 'getActive', 'setActive'], 'accountRelationship' => ['account_relationship', 'getAccountRelationship', 'setAccountRelationship']];
    }
}
