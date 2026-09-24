<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;

class ConvertProformaToInvoiceRequest implements AdditionalPropertiesInterface
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
     * If `true`, emit the resulting invoice atomically in the same act
     * (assigns a fiscal number and runs the quota/ledger/VeriFactu→PDF flow).
     * If `false` or omitted, the invoice is left in `DRAFT`.
     *
     *
     * @var bool
     */
    protected $issue = false;

    /**
     * If `true`, emit the resulting invoice atomically in the same act
     * (assigns a fiscal number and runs the quota/ledger/VeriFactu→PDF flow).
     * If `false` or omitted, the invoice is left in `DRAFT`.
     */
    public function getIssue(): bool
    {
        return $this->issue;
    }

    /**
     * If `true`, emit the resulting invoice atomically in the same act
    (assigns a fiscal number and runs the quota/ledger/VeriFactu→PDF flow).
    If `false` or omitted, the invoice is left in `DRAFT`.
     */
    public function setIssue(bool $issue): self
    {
        $this->initialized['issue'] = true;
        $this->issue = $issue;

        return $this;
    }

    public function definedProperties(): array
    {
        return ['issue' => ['issue', 'getIssue', 'setIssue']];
    }
}
