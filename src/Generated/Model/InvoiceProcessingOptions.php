<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;

class InvoiceProcessingOptions implements AdditionalPropertiesInterface
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
     * If `true`, creates the invoice directly as **ISSUED** with a definitive number and PDF.
     * If `false` (default), creates as **DRAFT** without number (editable, no PDF).
     *
     *
     * @var bool
     */
    protected $issueDirectly = false;

    /**
     * Only applies when `issue_directly` is `true`.
     * If `true`, waits for PDF generation before returning the response (~1-3s).
     * If `false` (default), PDF is generated asynchronously in the background.
     *
     *
     * @var bool
     */
    protected $waitForPdf = false;

    /**
     * Only applies when `issue_directly` is `true`.
     * If `true`, sends the invoice by email with PDF attachment after issuing.
     * The email is sent asynchronously after the invoice is issued.
     *
     *
     * @var bool
     */
    protected $sendAutomatically = false;

    /**
     * Only applies when `send_automatically` is `true`. If `true`, the email sent after
     * issuing also attaches a ZIP (`suplidos_<invoice-number>.zip`) with the PDFs of the
     * source invoices referenced by the invoice's SUPLIDO consolidation lines
     * (`source_invoice_ids`). Each PDF inside the ZIP is named
     * `<invoice-number>_<issuer-tax-id>.pdf`. Access to sources owned by managed accounts is
     * re-checked with the same rules as issuing, and the request fails synchronously with an
     * actionable error — never a partial ZIP — if the invoice has no consolidation sources
     * (`ATTACH_SOURCE_INVOICES_NO_SOURCES`), a source is not reachable
     * (`ATTACH_SOURCE_INVOICE_UNAVAILABLE`) or a source has no generated PDF
     * (`ATTACH_SOURCE_PDF_MISSING`). The flag belongs to this issuing act only: it is never
     * stored on the invoice.
     *
     *
     * @var bool
     */
    protected $attachSourceInvoices = false;

    /**
     * Only applies when `send_automatically` is `true`.
     * Overrides default email settings. If not provided, uses the recipient's email.
     *
     *
     * @var InvoiceProcessingOptionsEmailConfig
     */
    protected $emailConfig;

    /**
     * If `true`, creates the invoice directly as **ISSUED** with a definitive number and PDF.
     * If `false` (default), creates as **DRAFT** without number (editable, no PDF).
     */
    public function getIssueDirectly(): bool
    {
        return $this->issueDirectly;
    }

    /**
     * If `true`, creates the invoice directly as **ISSUED** with a definitive number and PDF.
    If `false` (default), creates as **DRAFT** without number (editable, no PDF).
     */
    public function setIssueDirectly(bool $issueDirectly): self
    {
        $this->initialized['issueDirectly'] = true;
        $this->issueDirectly = $issueDirectly;

        return $this;
    }

    /**
     * Only applies when `issue_directly` is `true`.
     * If `true`, waits for PDF generation before returning the response (~1-3s).
     * If `false` (default), PDF is generated asynchronously in the background.
     */
    public function getWaitForPdf(): bool
    {
        return $this->waitForPdf;
    }

    /**
     * Only applies when `issue_directly` is `true`.
    If `true`, waits for PDF generation before returning the response (~1-3s).
    If `false` (default), PDF is generated asynchronously in the background.
     */
    public function setWaitForPdf(bool $waitForPdf): self
    {
        $this->initialized['waitForPdf'] = true;
        $this->waitForPdf = $waitForPdf;

        return $this;
    }

    /**
     * Only applies when `issue_directly` is `true`.
     * If `true`, sends the invoice by email with PDF attachment after issuing.
     * The email is sent asynchronously after the invoice is issued.
     */
    public function getSendAutomatically(): bool
    {
        return $this->sendAutomatically;
    }

    /**
     * Only applies when `issue_directly` is `true`.
    If `true`, sends the invoice by email with PDF attachment after issuing.
    The email is sent asynchronously after the invoice is issued.
     */
    public function setSendAutomatically(bool $sendAutomatically): self
    {
        $this->initialized['sendAutomatically'] = true;
        $this->sendAutomatically = $sendAutomatically;

        return $this;
    }

    /**
     * Only applies when `send_automatically` is `true`. If `true`, the email sent after
     * issuing also attaches a ZIP (`suplidos_<invoice-number>.zip`) with the PDFs of the
     * source invoices referenced by the invoice's SUPLIDO consolidation lines
     * (`source_invoice_ids`). Each PDF inside the ZIP is named
     * `<invoice-number>_<issuer-tax-id>.pdf`. Access to sources owned by managed accounts is
     * re-checked with the same rules as issuing, and the request fails synchronously with an
     * actionable error — never a partial ZIP — if the invoice has no consolidation sources
     * (`ATTACH_SOURCE_INVOICES_NO_SOURCES`), a source is not reachable
     * (`ATTACH_SOURCE_INVOICE_UNAVAILABLE`) or a source has no generated PDF
     * (`ATTACH_SOURCE_PDF_MISSING`). The flag belongs to this issuing act only: it is never
     * stored on the invoice.
     */
    public function getAttachSourceInvoices(): bool
    {
        return $this->attachSourceInvoices;
    }

    /**
     * Only applies when `send_automatically` is `true`. If `true`, the email sent after
    issuing also attaches a ZIP (`suplidos_<invoice-number>.zip`) with the PDFs of the
    source invoices referenced by the invoice's SUPLIDO consolidation lines
    (`source_invoice_ids`). Each PDF inside the ZIP is named
    `<invoice-number>_<issuer-tax-id>.pdf`. Access to sources owned by managed accounts is
    re-checked with the same rules as issuing, and the request fails synchronously with an
    actionable error — never a partial ZIP — if the invoice has no consolidation sources
    (`ATTACH_SOURCE_INVOICES_NO_SOURCES`), a source is not reachable
    (`ATTACH_SOURCE_INVOICE_UNAVAILABLE`) or a source has no generated PDF
    (`ATTACH_SOURCE_PDF_MISSING`). The flag belongs to this issuing act only: it is never
    stored on the invoice.
     */
    public function setAttachSourceInvoices(bool $attachSourceInvoices): self
    {
        $this->initialized['attachSourceInvoices'] = true;
        $this->attachSourceInvoices = $attachSourceInvoices;

        return $this;
    }

    /**
     * Only applies when `send_automatically` is `true`.
     * Overrides default email settings. If not provided, uses the recipient's email.
     */
    public function getEmailConfig(): InvoiceProcessingOptionsEmailConfig
    {
        return $this->emailConfig;
    }

    /**
     * Only applies when `send_automatically` is `true`.
    Overrides default email settings. If not provided, uses the recipient's email.
     */
    public function setEmailConfig(InvoiceProcessingOptionsEmailConfig $emailConfig): self
    {
        $this->initialized['emailConfig'] = true;
        $this->emailConfig = $emailConfig;

        return $this;
    }

    public function definedProperties(): array
    {
        return ['issueDirectly' => ['issue_directly', 'getIssueDirectly', 'setIssueDirectly'], 'waitForPdf' => ['wait_for_pdf', 'getWaitForPdf', 'setWaitForPdf'], 'sendAutomatically' => ['send_automatically', 'getSendAutomatically', 'setSendAutomatically'], 'attachSourceInvoices' => ['attach_source_invoices', 'getAttachSourceInvoices', 'setAttachSourceInvoices'], 'emailConfig' => ['email_config', 'getEmailConfig', 'setEmailConfig']];
    }
}
