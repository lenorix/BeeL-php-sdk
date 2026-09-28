<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;
class ListManagedPaymentEventsResponseData implements AdditionalPropertiesInterface
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
     * @var list<ManagedPaymentEvent>
     */
    protected $events;
    /**
     * @var Pagination
     */
    protected $pagination;
    /**
     * How the events of the connection break down, over the whole connection and not just the
     * page you are reading. The filters of the request (`q`, `status`, `needs_action`, dates,
     * amounts and the rest) do not narrow these counts, which may therefore exceed
     * `pagination.total_items`: they are what lets you show "12 need action" without asking for
     * every page. Only two parameters have a bearing on them: `charges_only` changes what is
     * counted (money movements instead of events), and `include_discarded` decides whether
     * discarded events take part in `by_status` and `failure_reasons`.
     * 
     *
     * @var PaymentEventCounts
     */
    protected $counts;
    /**
     * @return list<ManagedPaymentEvent>
     */
    public function getEvents(): array
    {
        return $this->events;
    }
    /**
     * @param list<ManagedPaymentEvent> $events
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
     * @return Pagination
     */
    public function getPagination(): Pagination
    {
        return $this->pagination;
    }
    /**
     * @param Pagination $pagination
     *
     * @return self
     */
    public function setPagination(Pagination $pagination): self
    {
        $this->initialized['pagination'] = true;
        $this->pagination = $pagination;
        return $this;
    }
    /**
     * How the events of the connection break down, over the whole connection and not just the
     * page you are reading. The filters of the request (`q`, `status`, `needs_action`, dates,
     * amounts and the rest) do not narrow these counts, which may therefore exceed
     * `pagination.total_items`: they are what lets you show "12 need action" without asking for
     * every page. Only two parameters have a bearing on them: `charges_only` changes what is
     * counted (money movements instead of events), and `include_discarded` decides whether
     * discarded events take part in `by_status` and `failure_reasons`.
     * 
     *
     * @return PaymentEventCounts
     */
    public function getCounts(): PaymentEventCounts
    {
        return $this->counts;
    }
    /**
    * How the events of the connection break down, over the whole connection and not just the
    page you are reading. The filters of the request (`q`, `status`, `needs_action`, dates,
    amounts and the rest) do not narrow these counts, which may therefore exceed
    `pagination.total_items`: they are what lets you show "12 need action" without asking for
    every page. Only two parameters have a bearing on them: `charges_only` changes what is
    counted (money movements instead of events), and `include_discarded` decides whether
    discarded events take part in `by_status` and `failure_reasons`.
    
    *
    * @param PaymentEventCounts $counts
    *
    * @return self
    */
    public function setCounts(PaymentEventCounts $counts): self
    {
        $this->initialized['counts'] = true;
        $this->counts = $counts;
        return $this;
    }
    public function definedProperties(): array
    {
        return ['events' => ['events', 'getEvents', 'setEvents'], 'pagination' => ['pagination', 'getPagination', 'setPagination'], 'counts' => ['counts', 'getCounts', 'setCounts']];
    }
}