<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;
class CompanyStatsData implements AdditionalPropertiesInterface
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
     * @var string
     */
    protected $companyId;
    /**
     * Fiscal documents issued by this company, under the **real-net criterion**: drafts, scheduled invoices and proformas never count (there is no fiscal document yet); a rectifying invoice counts as a document of its own; and a voided invoice counts only when a live, non-voided rectifying invoice compensates it — total or partial alike. A direct void ("issued by mistake", with no rectifying invoice) drops the document from the aggregate, because fiscally it should never have existed.
     * Not monotonic: voiding an invoice that nothing compensates lowers this count. Do not use it as a synchronisation cursor — webhooks and `GET /v1/accounts/{account_id}/request-logs` are the surfaces for that.
     *
     * @var int
     */
    protected $invoiceCount;
    /**
     * Issue date of the most recent document in the same set as `invoice_count` (ISO 8601), or null if none. This is the issue date, not the accrual date: it answers when this company last issued, not which period the amounts belong to. Like the count it is not monotonic — voiding the most recent invoice moves this date *backwards*, to the one before it.
     *
     * @var \DateTime|null
     */
    protected $lastInvoiceAt;
    /**
     * @return string
     */
    public function getCompanyId(): string
    {
        return $this->companyId;
    }
    /**
     * @param string $companyId
     *
     * @return self
     */
    public function setCompanyId(string $companyId): self
    {
        $this->initialized['companyId'] = true;
        $this->companyId = $companyId;
        return $this;
    }
    /**
     * Fiscal documents issued by this company, under the **real-net criterion**: drafts, scheduled invoices and proformas never count (there is no fiscal document yet); a rectifying invoice counts as a document of its own; and a voided invoice counts only when a live, non-voided rectifying invoice compensates it — total or partial alike. A direct void ("issued by mistake", with no rectifying invoice) drops the document from the aggregate, because fiscally it should never have existed.
     * Not monotonic: voiding an invoice that nothing compensates lowers this count. Do not use it as a synchronisation cursor — webhooks and `GET /v1/accounts/{account_id}/request-logs` are the surfaces for that.
     *
     * @return int
     */
    public function getInvoiceCount(): int
    {
        return $this->invoiceCount;
    }
    /**
    * Fiscal documents issued by this company, under the **real-net criterion**: drafts, scheduled invoices and proformas never count (there is no fiscal document yet); a rectifying invoice counts as a document of its own; and a voided invoice counts only when a live, non-voided rectifying invoice compensates it — total or partial alike. A direct void ("issued by mistake", with no rectifying invoice) drops the document from the aggregate, because fiscally it should never have existed.
    Not monotonic: voiding an invoice that nothing compensates lowers this count. Do not use it as a synchronisation cursor — webhooks and `GET /v1/accounts/{account_id}/request-logs` are the surfaces for that.
    *
    * @param int $invoiceCount
    *
    * @return self
    */
    public function setInvoiceCount(int $invoiceCount): self
    {
        $this->initialized['invoiceCount'] = true;
        $this->invoiceCount = $invoiceCount;
        return $this;
    }
    /**
     * Issue date of the most recent document in the same set as `invoice_count` (ISO 8601), or null if none. This is the issue date, not the accrual date: it answers when this company last issued, not which period the amounts belong to. Like the count it is not monotonic — voiding the most recent invoice moves this date *backwards*, to the one before it.
     *
     * @return \DateTime|null
     */
    public function getLastInvoiceAt(): ?\DateTime
    {
        return $this->lastInvoiceAt;
    }
    /**
     * Issue date of the most recent document in the same set as `invoice_count` (ISO 8601), or null if none. This is the issue date, not the accrual date: it answers when this company last issued, not which period the amounts belong to. Like the count it is not monotonic — voiding the most recent invoice moves this date *backwards*, to the one before it.
     *
     * @param \DateTime|null $lastInvoiceAt
     *
     * @return self
     */
    public function setLastInvoiceAt(?\DateTime $lastInvoiceAt): self
    {
        $this->initialized['lastInvoiceAt'] = true;
        $this->lastInvoiceAt = $lastInvoiceAt;
        return $this;
    }
    public function definedProperties(): array
    {
        return ['companyId' => ['company_id', 'getCompanyId', 'setCompanyId'], 'invoiceCount' => ['invoice_count', 'getInvoiceCount', 'setInvoiceCount'], 'lastInvoiceAt' => ['last_invoice_at', 'getLastInvoiceAt', 'setLastInvoiceAt']];
    }
}