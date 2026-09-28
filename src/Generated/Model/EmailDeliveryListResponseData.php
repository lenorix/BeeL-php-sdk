<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;
class EmailDeliveryListResponseData implements AdditionalPropertiesInterface
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
     * @var list<EmailDeliveryResponse>
     */
    protected $emails;
    /**
     * @var Pagination
     */
    protected $pagination;
    /**
     * @return list<EmailDeliveryResponse>
     */
    public function getEmails(): array
    {
        return $this->emails;
    }
    /**
     * @param list<EmailDeliveryResponse> $emails
     *
     * @return self
     */
    public function setEmails(array $emails): self
    {
        $this->initialized['emails'] = true;
        $this->emails = $emails;
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
    public function definedProperties(): array
    {
        return ['emails' => ['emails', 'getEmails', 'setEmails'], 'pagination' => ['pagination', 'getPagination', 'setPagination']];
    }
}