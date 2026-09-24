<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;

class V1CompaniesCompanyIdRecurringInvoicesRecurringInvoiceIdNextOccurrenceGetResponse200 implements AdditionalPropertiesInterface
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
     * @var bool
     */
    protected $success;

    /**
     * The invoice a recurring template would produce on its next generation, computed
     * from the current issuer, recipient and series data. Nothing is persisted and no
     * numbering is consumed, so it carries neither `id` nor `created_at`/`updated_at`,
     * and `invoice_number` and `number` travel as `null` — the number is assigned when
     * the invoice is actually generated. Every other field is the one the generated
     * invoice would carry.
     *
     *
     * @var NextOccurrence
     */
    protected $data;

    /**
     * @var ResponseMeta
     */
    protected $meta;

    public function getSuccess(): bool
    {
        return $this->success;
    }

    public function setSuccess(bool $success): self
    {
        $this->initialized['success'] = true;
        $this->success = $success;

        return $this;
    }

    /**
     * The invoice a recurring template would produce on its next generation, computed
     * from the current issuer, recipient and series data. Nothing is persisted and no
     * numbering is consumed, so it carries neither `id` nor `created_at`/`updated_at`,
     * and `invoice_number` and `number` travel as `null` — the number is assigned when
     * the invoice is actually generated. Every other field is the one the generated
     * invoice would carry.
     */
    public function getData(): NextOccurrence
    {
        return $this->data;
    }

    /**
     * The invoice a recurring template would produce on its next generation, computed
    from the current issuer, recipient and series data. Nothing is persisted and no
    numbering is consumed, so it carries neither `id` nor `created_at`/`updated_at`,
    and `invoice_number` and `number` travel as `null` — the number is assigned when
    the invoice is actually generated. Every other field is the one the generated
    invoice would carry.
     */
    public function setData(NextOccurrence $data): self
    {
        $this->initialized['data'] = true;
        $this->data = $data;

        return $this;
    }

    public function getMeta(): ResponseMeta
    {
        return $this->meta;
    }

    public function setMeta(ResponseMeta $meta): self
    {
        $this->initialized['meta'] = true;
        $this->meta = $meta;

        return $this;
    }

    public function definedProperties(): array
    {
        return ['success' => ['success', 'getSuccess', 'setSuccess'], 'data' => ['data', 'getData', 'setData'], 'meta' => ['meta', 'getMeta', 'setMeta']];
    }
}
