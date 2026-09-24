<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;

class V1RecurringInvoicesRecurringInvoiceIdHistoryGetResponse200Data implements AdditionalPropertiesInterface
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
     * @var list<GenerationHistoryResponse>
     */
    protected $history;

    /**
     * @return list<GenerationHistoryResponse>
     */
    public function getHistory(): array
    {
        return $this->history;
    }

    /**
     * @param  list<GenerationHistoryResponse>  $history
     */
    public function setHistory(array $history): self
    {
        $this->initialized['history'] = true;
        $this->history = $history;

        return $this;
    }

    public function definedProperties(): array
    {
        return ['history' => ['history', 'getHistory', 'setHistory']];
    }
}
