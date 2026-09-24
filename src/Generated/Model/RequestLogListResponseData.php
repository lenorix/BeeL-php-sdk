<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;

class RequestLogListResponseData implements AdditionalPropertiesInterface
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
     * @var list<RequestLogSummary>
     */
    protected $requestLogs;

    /**
     * Cursor-based pagination (keyset on _time + request_id). APL does not support cheap offset.
     *
     * @var RequestLogCursorPagination
     */
    protected $pagination;

    /**
     * @return list<RequestLogSummary>
     */
    public function getRequestLogs(): array
    {
        return $this->requestLogs;
    }

    /**
     * @param  list<RequestLogSummary>  $requestLogs
     */
    public function setRequestLogs(array $requestLogs): self
    {
        $this->initialized['requestLogs'] = true;
        $this->requestLogs = $requestLogs;

        return $this;
    }

    /**
     * Cursor-based pagination (keyset on _time + request_id). APL does not support cheap offset.
     */
    public function getPagination(): RequestLogCursorPagination
    {
        return $this->pagination;
    }

    /**
     * Cursor-based pagination (keyset on _time + request_id). APL does not support cheap offset.
     */
    public function setPagination(RequestLogCursorPagination $pagination): self
    {
        $this->initialized['pagination'] = true;
        $this->pagination = $pagination;

        return $this;
    }

    public function definedProperties(): array
    {
        return ['requestLogs' => ['request_logs', 'getRequestLogs', 'setRequestLogs'], 'pagination' => ['pagination', 'getPagination', 'setPagination']];
    }
}
