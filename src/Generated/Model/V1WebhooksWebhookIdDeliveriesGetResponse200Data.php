<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;

class V1WebhooksWebhookIdDeliveriesGetResponse200Data implements AdditionalPropertiesInterface
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
     * @var list<WebhookDeliveryLog>
     */
    protected $deliveries;

    /**
     * @var Pagination
     */
    protected $pagination;

    /**
     * @return list<WebhookDeliveryLog>
     */
    public function getDeliveries(): array
    {
        return $this->deliveries;
    }

    /**
     * @param  list<WebhookDeliveryLog>  $deliveries
     */
    public function setDeliveries(array $deliveries): self
    {
        $this->initialized['deliveries'] = true;
        $this->deliveries = $deliveries;

        return $this;
    }

    public function getPagination(): Pagination
    {
        return $this->pagination;
    }

    public function setPagination(Pagination $pagination): self
    {
        $this->initialized['pagination'] = true;
        $this->pagination = $pagination;

        return $this;
    }

    public function definedProperties(): array
    {
        return ['deliveries' => ['deliveries', 'getDeliveries', 'setDeliveries'], 'pagination' => ['pagination', 'getPagination', 'setPagination']];
    }
}
