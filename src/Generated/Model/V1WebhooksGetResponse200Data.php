<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;

class V1WebhooksGetResponse200Data implements AdditionalPropertiesInterface
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
     * @var list<WebhookSubscription>|null
     */
    protected $webhooks;

    /**
     * @var Pagination|null
     */
    protected $pagination;

    /**
     * @return list<WebhookSubscription>|null
     */
    public function getWebhooks(): ?array
    {
        return $this->webhooks;
    }

    /**
     * @param  list<WebhookSubscription>|null  $webhooks
     */
    public function setWebhooks(?array $webhooks): self
    {
        $this->initialized['webhooks'] = true;
        $this->webhooks = $webhooks;

        return $this;
    }

    public function getPagination(): ?Pagination
    {
        return $this->pagination;
    }

    public function setPagination(?Pagination $pagination): self
    {
        $this->initialized['pagination'] = true;
        $this->pagination = $pagination;

        return $this;
    }

    public function definedProperties(): array
    {
        return ['webhooks' => ['webhooks', 'getWebhooks', 'setWebhooks'], 'pagination' => ['pagination', 'getPagination', 'setPagination']];
    }
}
