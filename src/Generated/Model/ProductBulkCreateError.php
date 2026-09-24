<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;

class ProductBulkCreateError implements AdditionalPropertiesInterface
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
     * `PRODUCT_DUPLICATE` is deliberately the same code the single `POST` answers with `409`,
     * so the single and the bulk route never disagree about the same product.
     *
     *
     * @var string
     */
    protected $code;

    /**
     * Human-readable text, already resolved to the language of the request. It used to be the
     * raw i18n key, which neither reads nor is stable against a rename of the key.
     *
     *
     * @var string
     */
    protected $message;

    /**
     * Stable, uppercase, never translated — this is what an integration compares.
     * `PRODUCT_DUPLICATE` is deliberately the same code the single `POST` answers with `409`,
     * so the single and the bulk route never disagree about the same product.
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * Stable, uppercase, never translated — this is what an integration compares.
    `PRODUCT_DUPLICATE` is deliberately the same code the single `POST` answers with `409`,
    so the single and the bulk route never disagree about the same product.
     */
    public function setCode(string $code): self
    {
        $this->initialized['code'] = true;
        $this->code = $code;

        return $this;
    }

    /**
     * Human-readable text, already resolved to the language of the request. It used to be the
     * raw i18n key, which neither reads nor is stable against a rename of the key.
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * Human-readable text, already resolved to the language of the request. It used to be the
    raw i18n key, which neither reads nor is stable against a rename of the key.
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
