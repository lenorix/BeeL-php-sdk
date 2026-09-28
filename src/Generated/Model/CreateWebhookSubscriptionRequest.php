<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;
class CreateWebhookSubscriptionRequest implements AdditionalPropertiesInterface
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
     * HTTPS endpoint URL that will receive webhook POST requests.
     *
     * @var string
     */
    protected $url;
    /**
     * List of event types to subscribe to.
     *
     * @var list<string>
     */
    protected $events;
    /**
     * Which accounts this subscription receives events from. Defaults to `own`. Same field name and values as the `account_relationship` carried by every event envelope.
     * 
     *
     * @var string
     */
    protected $accountRelationship = 'own';
    /**
     * HTTPS endpoint URL that will receive webhook POST requests.
     *
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }
    /**
     * HTTPS endpoint URL that will receive webhook POST requests.
     *
     * @param string $url
     *
     * @return self
     */
    public function setUrl(string $url): self
    {
        $this->initialized['url'] = true;
        $this->url = $url;
        return $this;
    }
    /**
     * List of event types to subscribe to.
     *
     * @return list<string>
     */
    public function getEvents(): array
    {
        return $this->events;
    }
    /**
     * List of event types to subscribe to.
     *
     * @param list<string> $events
     *
     * @return self
     */
    public function setEvents(array $events): self
    {
        $this->initialized['events'] = true;
        $this->events = $events;
        return $this;
    }
    /**
     * Which accounts this subscription receives events from. Defaults to `own`. Same field name and values as the `account_relationship` carried by every event envelope.
     * 
     *
     * @return string
     */
    public function getAccountRelationship(): string
    {
        return $this->accountRelationship;
    }
    /**
     * Which accounts this subscription receives events from. Defaults to `own`. Same field name and values as the `account_relationship` carried by every event envelope.
     *
     * @param string $accountRelationship
     *
     * @return self
     */
    public function setAccountRelationship(string $accountRelationship): self
    {
        $this->initialized['accountRelationship'] = true;
        $this->accountRelationship = $accountRelationship;
        return $this;
    }
    public function definedProperties(): array
    {
        return ['url' => ['url', 'getUrl', 'setUrl'], 'events' => ['events', 'getEvents', 'setEvents'], 'accountRelationship' => ['account_relationship', 'getAccountRelationship', 'setAccountRelationship']];
    }
}