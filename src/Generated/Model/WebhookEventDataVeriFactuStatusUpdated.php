<?php

namespace Lenorix\BeelSdk\Generated\Model;

class WebhookEventDataVeriFactuStatusUpdated
{
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
    protected $invoiceId;

    /**
     * @var string|null
     */
    protected $invoiceNumber;

    /**
     * @var string
     */
    protected $verifactuRegistrationId;

    /**
     * Which record changed status: the registration (`REGISTRATION`) or the cancellation of a
     * voided invoice (`VOID`). It is the record `verifactu_registration_id` identifies, the
     * same one `verifactu-records` lists with that `operation`.
     *
     *
     * @var string
     */
    protected $operation;

    /**
     * Status of this registration before the change. Omitted on the first notification of a
     * registration, because there is no earlier status: the submission was just accepted for
     * processing (`new_status` is `PENDING`) or it was rejected before reaching the AEAT
     * (`new_status` is `REJECTED`).
     *
     *
     * @var string|null
     */
    protected $previousStatus;

    /**
     * Submission status of an invoice's VeriFactu record to AEAT.
     *
     * Single vocabulary for the whole axis: the same values are published in
     * `verifactu.submission_status` of an invoice and accepted by the `verifactu_status`
     * filter of `GET /v1/invoices`, so a value read from an invoice can be fed straight
     * back into the filter.
     *
     * * `PENDING` — queued, AEAT has not answered yet. A temporary AEAT server error also
     *   stays `PENDING`: BeeL. retries it automatically, and it only becomes `REJECTED` if the
     *   retries run out.
     * * `ACCEPTED` — accepted by AEAT (with or without non-blocking warnings).
     * * `VOIDED` — a cancellation record was accepted by AEAT.
     * * `REJECTED` — rejected by AEAT, or the submission was rejected by the provider
     *   before reaching AEAT (see `error_code` / `error_message`).
     * * `NOT_SUBMITTED` — the invoice is issued with VeriFactu enabled but has no live
     *   record: the submission fell through (lost event, exhausted retries) and AEAT
     *   does not know the invoice exists. Transient right after issuing (the async
     *   submission may still be in flight); if it persists, the registration needs to
     *   be re-driven.
     *
     * Drafts and scheduled invoices have no submission to describe yet and omit the
     * field. Invoices with `verifactu.enabled = false` are outside this axis and are
     * selected with the `verifactu_enabled` filter.
     *
     *
     * @var string
     */
    protected $newStatus;

    /**
     * AEAT verification URL encoded in the invoice QR code. Set when the registration is
     * submitted, so it is carried by every later status change, `REJECTED` included.
     *
     *
     * @var string|null
     */
    protected $qrUrl;

    /**
     * QR code as base64-encoded PNG for embedding in PDFs. Set when the registration is
     * submitted, so it does not wait for `ACCEPTED`.
     *
     *
     * @var string|null
     */
    protected $qrBase64;

    /**
     * SHA-256 hash of the registration record, as VeriFactu defines it. Set when the
     * registration is submitted.
     *
     *
     * @var string|null
     */
    protected $invoiceHash;

    /**
     * @var string|null
     */
    protected $errorCode;

    /**
     * Human-readable reason for the outcome. When the AEAT reported a remark or an error, it is
     * the AEAT's own description. When BeeL. decided the outcome (the submission was rejected
     * before reaching the AEAT, or BeeL. stopped waiting for a final answer), it is a message
     * written by BeeL., in English.
     *
     *
     * @var string|null
     */
    protected $errorMessage;

    public function getInvoiceId(): string
    {
        return $this->invoiceId;
    }

    public function setInvoiceId(string $invoiceId): self
    {
        $this->initialized['invoiceId'] = true;
        $this->invoiceId = $invoiceId;

        return $this;
    }

    public function getInvoiceNumber(): ?string
    {
        return $this->invoiceNumber;
    }

    public function setInvoiceNumber(?string $invoiceNumber): self
    {
        $this->initialized['invoiceNumber'] = true;
        $this->invoiceNumber = $invoiceNumber;

        return $this;
    }

    public function getVerifactuRegistrationId(): string
    {
        return $this->verifactuRegistrationId;
    }

    public function setVerifactuRegistrationId(string $verifactuRegistrationId): self
    {
        $this->initialized['verifactuRegistrationId'] = true;
        $this->verifactuRegistrationId = $verifactuRegistrationId;

        return $this;
    }

    /**
     * Which record changed status: the registration (`REGISTRATION`) or the cancellation of a
     * voided invoice (`VOID`). It is the record `verifactu_registration_id` identifies, the
     * same one `verifactu-records` lists with that `operation`.
     */
    public function getOperation(): string
    {
        return $this->operation;
    }

    /**
     * Which record changed status: the registration (`REGISTRATION`) or the cancellation of a
    voided invoice (`VOID`). It is the record `verifactu_registration_id` identifies, the
    same one `verifactu-records` lists with that `operation`.
     */
    public function setOperation(string $operation): self
    {
        $this->initialized['operation'] = true;
        $this->operation = $operation;

        return $this;
    }

    /**
     * Status of this registration before the change. Omitted on the first notification of a
     * registration, because there is no earlier status: the submission was just accepted for
     * processing (`new_status` is `PENDING`) or it was rejected before reaching the AEAT
     * (`new_status` is `REJECTED`).
     */
    public function getPreviousStatus(): ?string
    {
        return $this->previousStatus;
    }

    /**
     * Status of this registration before the change. Omitted on the first notification of a
    registration, because there is no earlier status: the submission was just accepted for
    processing (`new_status` is `PENDING`) or it was rejected before reaching the AEAT
    (`new_status` is `REJECTED`).
     */
    public function setPreviousStatus(?string $previousStatus): self
    {
        $this->initialized['previousStatus'] = true;
        $this->previousStatus = $previousStatus;

        return $this;
    }

    /**
     * Submission status of an invoice's VeriFactu record to AEAT.
     *
     * Single vocabulary for the whole axis: the same values are published in
     * `verifactu.submission_status` of an invoice and accepted by the `verifactu_status`
     * filter of `GET /v1/invoices`, so a value read from an invoice can be fed straight
     * back into the filter.
     *
     * * `PENDING` — queued, AEAT has not answered yet. A temporary AEAT server error also
     *   stays `PENDING`: BeeL. retries it automatically, and it only becomes `REJECTED` if the
     *   retries run out.
     * * `ACCEPTED` — accepted by AEAT (with or without non-blocking warnings).
     * * `VOIDED` — a cancellation record was accepted by AEAT.
     * * `REJECTED` — rejected by AEAT, or the submission was rejected by the provider
     *   before reaching AEAT (see `error_code` / `error_message`).
     * * `NOT_SUBMITTED` — the invoice is issued with VeriFactu enabled but has no live
     *   record: the submission fell through (lost event, exhausted retries) and AEAT
     *   does not know the invoice exists. Transient right after issuing (the async
     *   submission may still be in flight); if it persists, the registration needs to
     *   be re-driven.
     *
     * Drafts and scheduled invoices have no submission to describe yet and omit the
     * field. Invoices with `verifactu.enabled = false` are outside this axis and are
     * selected with the `verifactu_enabled` filter.
     */
    public function getNewStatus(): string
    {
        return $this->newStatus;
    }

    /**
     * Submission status of an invoice's VeriFactu record to AEAT.

    Single vocabulary for the whole axis: the same values are published in
    `verifactu.submission_status` of an invoice and accepted by the `verifactu_status`
    filter of `GET /v1/invoices`, so a value read from an invoice can be fed straight
    back into the filter.

     * `PENDING` — queued, AEAT has not answered yet. A temporary AEAT server error also
     stays `PENDING`: BeeL. retries it automatically, and it only becomes `REJECTED` if the
     retries run out.
     * `ACCEPTED` — accepted by AEAT (with or without non-blocking warnings).
     * `VOIDED` — a cancellation record was accepted by AEAT.
     * `REJECTED` — rejected by AEAT, or the submission was rejected by the provider
     before reaching AEAT (see `error_code` / `error_message`).
     * `NOT_SUBMITTED` — the invoice is issued with VeriFactu enabled but has no live
     record: the submission fell through (lost event, exhausted retries) and AEAT
     does not know the invoice exists. Transient right after issuing (the async
     submission may still be in flight); if it persists, the registration needs to
     be re-driven.

    Drafts and scheduled invoices have no submission to describe yet and omit the
    field. Invoices with `verifactu.enabled = false` are outside this axis and are
    selected with the `verifactu_enabled` filter.
     */
    public function setNewStatus(string $newStatus): self
    {
        $this->initialized['newStatus'] = true;
        $this->newStatus = $newStatus;

        return $this;
    }

    /**
     * AEAT verification URL encoded in the invoice QR code. Set when the registration is
     * submitted, so it is carried by every later status change, `REJECTED` included.
     */
    public function getQrUrl(): ?string
    {
        return $this->qrUrl;
    }

    /**
     * AEAT verification URL encoded in the invoice QR code. Set when the registration is
    submitted, so it is carried by every later status change, `REJECTED` included.
     */
    public function setQrUrl(?string $qrUrl): self
    {
        $this->initialized['qrUrl'] = true;
        $this->qrUrl = $qrUrl;

        return $this;
    }

    /**
     * QR code as base64-encoded PNG for embedding in PDFs. Set when the registration is
     * submitted, so it does not wait for `ACCEPTED`.
     */
    public function getQrBase64(): ?string
    {
        return $this->qrBase64;
    }

    /**
     * QR code as base64-encoded PNG for embedding in PDFs. Set when the registration is
    submitted, so it does not wait for `ACCEPTED`.
     */
    public function setQrBase64(?string $qrBase64): self
    {
        $this->initialized['qrBase64'] = true;
        $this->qrBase64 = $qrBase64;

        return $this;
    }

    /**
     * SHA-256 hash of the registration record, as VeriFactu defines it. Set when the
     * registration is submitted.
     */
    public function getInvoiceHash(): ?string
    {
        return $this->invoiceHash;
    }

    /**
     * SHA-256 hash of the registration record, as VeriFactu defines it. Set when the
    registration is submitted.
     */
    public function setInvoiceHash(?string $invoiceHash): self
    {
        $this->initialized['invoiceHash'] = true;
        $this->invoiceHash = $invoiceHash;

        return $this;
    }

    public function getErrorCode(): ?string
    {
        return $this->errorCode;
    }

    public function setErrorCode(?string $errorCode): self
    {
        $this->initialized['errorCode'] = true;
        $this->errorCode = $errorCode;

        return $this;
    }

    /**
     * Human-readable reason for the outcome. When the AEAT reported a remark or an error, it is
     * the AEAT's own description. When BeeL. decided the outcome (the submission was rejected
     * before reaching the AEAT, or BeeL. stopped waiting for a final answer), it is a message
     * written by BeeL., in English.
     */
    public function getErrorMessage(): ?string
    {
        return $this->errorMessage;
    }

    /**
     * Human-readable reason for the outcome. When the AEAT reported a remark or an error, it is
    the AEAT's own description. When BeeL. decided the outcome (the submission was rejected
    before reaching the AEAT, or BeeL. stopped waiting for a final answer), it is a message
    written by BeeL., in English.
     */
    public function setErrorMessage(?string $errorMessage): self
    {
        $this->initialized['errorMessage'] = true;
        $this->errorMessage = $errorMessage;

        return $this;
    }
}
