<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;
class SendEmailRequest implements AdditionalPropertiesInterface
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
     * If not specified, uses the customer's email
     *
     * @var list<string>
     */
    protected $recipients;
    /**
     * CC recipients. Copied addresses count as recipients of the message: they are subject
     * to the same sending restrictions and to the same quota as the addresses in `recipients`.
     * When omitted, the CC addresses configured in the sender's email defaults apply; send an
     * empty array to deliver the message without any copy.
     * 
     *
     * @var list<string>
     */
    protected $cc;
    /**
     * Email subject (optional, if not specified uses a default)
     *
     * @var string
     */
    protected $subject;
    /**
     * Custom message (optional, added before standard message)
     *
     * @var string
     */
    protected $message;
    /**
     * @var bool
     */
    protected $attachPdf = true;
    /**
     * Attach a ZIP archive (`suplidos_<invoice-number>.zip`) containing the PDFs of the source invoices referenced by the invoice's SUPLIDO consolidation lines (`source_invoice_ids`). Each PDF inside the ZIP is named `<invoice-number>_<issuer-tax-id>.pdf`. Requires `attach_pdf: true` (the ZIP accompanies the invoice PDF). Access to sources owned by managed accounts is re-checked at send time with the same rules as issuing; the request fails with an actionable error — never a partial ZIP — if the invoice has no consolidation sources (`ATTACH_SOURCE_INVOICES_NO_SOURCES`), a source is not reachable (`ATTACH_SOURCE_INVOICE_UNAVAILABLE`), a source has no generated PDF (`ATTACH_SOURCE_PDF_MISSING`), or the ZIP exceeds the size limit (`ATTACH_SOURCE_ZIP_TOO_LARGE`).
     *
     * @var bool
     */
    protected $attachSourceInvoices = false;
    /**
     * Email language. If not provided, uses the user's language (same fallback as the bulk send). Sin `default:` a propósito: quien resuelve el idioma es el servicio, no el DTO.
     *
     * @var string
     */
    protected $language;
    /**
     * If not specified, uses the customer's email
     *
     * @return list<string>
     */
    public function getRecipients(): array
    {
        return $this->recipients;
    }
    /**
     * If not specified, uses the customer's email
     *
     * @param list<string> $recipients
     *
     * @return self
     */
    public function setRecipients(array $recipients): self
    {
        $this->initialized['recipients'] = true;
        $this->recipients = $recipients;
        return $this;
    }
    /**
     * CC recipients. Copied addresses count as recipients of the message: they are subject
     * to the same sending restrictions and to the same quota as the addresses in `recipients`.
     * When omitted, the CC addresses configured in the sender's email defaults apply; send an
     * empty array to deliver the message without any copy.
     * 
     *
     * @return list<string>
     */
    public function getCc(): array
    {
        return $this->cc;
    }
    /**
    * CC recipients. Copied addresses count as recipients of the message: they are subject
    to the same sending restrictions and to the same quota as the addresses in `recipients`.
    When omitted, the CC addresses configured in the sender's email defaults apply; send an
    empty array to deliver the message without any copy.
    
    *
    * @param list<string> $cc
    *
    * @return self
    */
    public function setCc(array $cc): self
    {
        $this->initialized['cc'] = true;
        $this->cc = $cc;
        return $this;
    }
    /**
     * Email subject (optional, if not specified uses a default)
     *
     * @return string
     */
    public function getSubject(): string
    {
        return $this->subject;
    }
    /**
     * Email subject (optional, if not specified uses a default)
     *
     * @param string $subject
     *
     * @return self
     */
    public function setSubject(string $subject): self
    {
        $this->initialized['subject'] = true;
        $this->subject = $subject;
        return $this;
    }
    /**
     * Custom message (optional, added before standard message)
     *
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }
    /**
     * Custom message (optional, added before standard message)
     *
     * @param string $message
     *
     * @return self
     */
    public function setMessage(string $message): self
    {
        $this->initialized['message'] = true;
        $this->message = $message;
        return $this;
    }
    /**
     * @return bool
     */
    public function getAttachPdf(): bool
    {
        return $this->attachPdf;
    }
    /**
     * @param bool $attachPdf
     *
     * @return self
     */
    public function setAttachPdf(bool $attachPdf): self
    {
        $this->initialized['attachPdf'] = true;
        $this->attachPdf = $attachPdf;
        return $this;
    }
    /**
     * Attach a ZIP archive (`suplidos_<invoice-number>.zip`) containing the PDFs of the source invoices referenced by the invoice's SUPLIDO consolidation lines (`source_invoice_ids`). Each PDF inside the ZIP is named `<invoice-number>_<issuer-tax-id>.pdf`. Requires `attach_pdf: true` (the ZIP accompanies the invoice PDF). Access to sources owned by managed accounts is re-checked at send time with the same rules as issuing; the request fails with an actionable error — never a partial ZIP — if the invoice has no consolidation sources (`ATTACH_SOURCE_INVOICES_NO_SOURCES`), a source is not reachable (`ATTACH_SOURCE_INVOICE_UNAVAILABLE`), a source has no generated PDF (`ATTACH_SOURCE_PDF_MISSING`), or the ZIP exceeds the size limit (`ATTACH_SOURCE_ZIP_TOO_LARGE`).
     *
     * @return bool
     */
    public function getAttachSourceInvoices(): bool
    {
        return $this->attachSourceInvoices;
    }
    /**
     * Attach a ZIP archive (`suplidos_<invoice-number>.zip`) containing the PDFs of the source invoices referenced by the invoice's SUPLIDO consolidation lines (`source_invoice_ids`). Each PDF inside the ZIP is named `<invoice-number>_<issuer-tax-id>.pdf`. Requires `attach_pdf: true` (the ZIP accompanies the invoice PDF). Access to sources owned by managed accounts is re-checked at send time with the same rules as issuing; the request fails with an actionable error — never a partial ZIP — if the invoice has no consolidation sources (`ATTACH_SOURCE_INVOICES_NO_SOURCES`), a source is not reachable (`ATTACH_SOURCE_INVOICE_UNAVAILABLE`), a source has no generated PDF (`ATTACH_SOURCE_PDF_MISSING`), or the ZIP exceeds the size limit (`ATTACH_SOURCE_ZIP_TOO_LARGE`).
     *
     * @param bool $attachSourceInvoices
     *
     * @return self
     */
    public function setAttachSourceInvoices(bool $attachSourceInvoices): self
    {
        $this->initialized['attachSourceInvoices'] = true;
        $this->attachSourceInvoices = $attachSourceInvoices;
        return $this;
    }
    /**
     * Email language. If not provided, uses the user's language (same fallback as the bulk send). Sin `default:` a propósito: quien resuelve el idioma es el servicio, no el DTO.
     *
     * @return string
     */
    public function getLanguage(): string
    {
        return $this->language;
    }
    /**
     * Email language. If not provided, uses the user's language (same fallback as the bulk send). Sin `default:` a propósito: quien resuelve el idioma es el servicio, no el DTO.
     *
     * @param string $language
     *
     * @return self
     */
    public function setLanguage(string $language): self
    {
        $this->initialized['language'] = true;
        $this->language = $language;
        return $this;
    }
    public function definedProperties(): array
    {
        return ['recipients' => ['recipients', 'getRecipients', 'setRecipients'], 'cc' => ['cc', 'getCc', 'setCc'], 'subject' => ['subject', 'getSubject', 'setSubject'], 'message' => ['message', 'getMessage', 'setMessage'], 'attachPdf' => ['attach_pdf', 'getAttachPdf', 'setAttachPdf'], 'attachSourceInvoices' => ['attach_source_invoices', 'getAttachSourceInvoices', 'setAttachSourceInvoices'], 'language' => ['language', 'getLanguage', 'setLanguage']];
    }
}