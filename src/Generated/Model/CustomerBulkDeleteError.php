<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;

class CustomerBulkDeleteError implements AdditionalPropertiesInterface
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
     * Stable, uppercase, never translated — this is what an integration compares.
     * `NOT_FOUND` means the id does not resolve to a customer of the company, and
     * `INTERNAL_ERROR` that the row failed for an unexpected reason and was not deleted.
     * `CLIENT_HAS_INVOICES` is deliberately the same code the single `DELETE` answers with
     * `409`, so the single and the bulk route never disagree about the same customer.
     * `CLIENT_HAS_RECURRING_INVOICE`: an active or paused recurring invoice uses the
     * customer as its recipient. The single `DELETE` rejects the same case with `400`
     * `REFERENCED_BY_RECURRING_INVOICE`.
     *
     *
     * @var string
     */
    protected $code;

    /**
     * Human-readable text, already resolved to the language of the request.
     *
     * @var string
     */
    protected $message;

    /**
     * Stable, uppercase, never translated — this is what an integration compares.
     * `NOT_FOUND` means the id does not resolve to a customer of the company, and
     * `INTERNAL_ERROR` that the row failed for an unexpected reason and was not deleted.
     * `CLIENT_HAS_INVOICES` is deliberately the same code the single `DELETE` answers with
     * `409`, so the single and the bulk route never disagree about the same customer.
     * `CLIENT_HAS_RECURRING_INVOICE`: an active or paused recurring invoice uses the
     * customer as its recipient. The single `DELETE` rejects the same case with `400`
     * `REFERENCED_BY_RECURRING_INVOICE`.
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * Stable, uppercase, never translated — this is what an integration compares.
    `NOT_FOUND` means the id does not resolve to a customer of the company, and
    `INTERNAL_ERROR` that the row failed for an unexpected reason and was not deleted.
    `CLIENT_HAS_INVOICES` is deliberately the same code the single `DELETE` answers with
    `409`, so the single and the bulk route never disagree about the same customer.
    `CLIENT_HAS_RECURRING_INVOICE`: an active or paused recurring invoice uses the
    customer as its recipient. The single `DELETE` rejects the same case with `400`
    `REFERENCED_BY_RECURRING_INVOICE`.
     */
    public function setCode(string $code): self
    {
        $this->initialized['code'] = true;
        $this->code = $code;

        return $this;
    }

    /**
     * Human-readable text, already resolved to the language of the request.
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * Human-readable text, already resolved to the language of the request.
     */
    public function setMessage(string $message): self
    {
        $this->initialized['message'] = true;
        $this->message = $message;

        return $this;
    }

    public function definedProperties(): array
    {
        return ['code' => ['code', 'getCode', 'setCode'], 'message' => ['message', 'getMessage', 'setMessage']];
    }
}
