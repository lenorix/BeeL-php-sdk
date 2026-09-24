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
     * Submission status of an invoice's VeriFactu record to AEAT.
     *
     * Single vocabulary for the whole axis: the same values are published in
     * `verifactu.submission_status` of an invoice and accepted by the `verifactu_status`
     * filter of `GET /v1/invoices`, so a value read from an invoice can be fed straight
     * back into the filter.
     *
     * * `PENDING` — queued, AEAT has not answered yet.
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
    protected $previousStatus;

    /**
     * Submission status of an invoice's VeriFactu record to AEAT.
     *
     * Single vocabulary for the whole axis: the same values are published in
     * `verifactu.submission_status` of an invoice and accepted by the `verifactu_status`
     * filter of `GET /v1/invoices`, so a value read from an invoice can be fed straight
     * back into the filter.
     *
     * * `PENDING` — queued, AEAT has not answered yet.
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
     * @var string|null
     */
    protected $qrUrl;

    /**
     * QR code as base64-encoded PNG for embedding in PDFs.
     *
     * @var string|null
     */
    protected $qrBase64;

    /**
     * @var string|null
     */
    protected $invoiceHash;

    /**
     * @var string|null
     */
    protected $errorCode;

    /**
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
     * Submission status of an invoice's VeriFactu record to AEAT.
     *
     * Single vocabulary for the whole axis: the same values are published in
     * `verifactu.submission_status` of an invoice and accepted by the `verifactu_status`
     * filter of `GET /v1/invoices`, so a value read from an invoice can be fed straight
     * back into the filter.
     *
     * * `PENDING` — queued, AEAT has not answered yet.
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
    public function getPreviousStatus(): string
    {
        return $this->previousStatus;
    }

    /**
     * Submission status of an invoice's VeriFactu record to AEAT.

    Single vocabulary for the whole axis: the same values are published in
    `verifactu.submission_status` of an invoice and accepted by the `verifactu_status`
    filter of `GET /v1/invoices`, so a value read from an invoice can be fed straight
    back into the filter.

     * `PENDING` — queued, AEAT has not answered yet.
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
    public function setPreviousStatus(string $previousStatus): self
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
     * * `PENDING` — queued, AEAT has not answered yet.
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

     * `PENDING` — queued, AEAT has not answered yet.
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

    public function getQrUrl(): ?string
    {
        return $this->qrUrl;
    }

    public function setQrUrl(?string $qrUrl): self
    {
        $this->initialized['qrUrl'] = true;
        $this->qrUrl = $qrUrl;

        return $this;
    }

    /**
     * QR code as base64-encoded PNG for embedding in PDFs.
     */
    public function getQrBase64(): ?string
    {
        return $this->qrBase64;
    }

    /**
     * QR code as base64-encoded PNG for embedding in PDFs.
     */
    public function setQrBase64(?string $qrBase64): self
    {
        $this->initialized['qrBase64'] = true;
        $this->qrBase64 = $qrBase64;

        return $this;
    }

    public function getInvoiceHash(): ?string
    {
        return $this->invoiceHash;
    }

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

    public function getErrorMessage(): ?string
    {
        return $this->errorMessage;
    }

    public function setErrorMessage(?string $errorMessage): self
    {
        $this->initialized['errorMessage'] = true;
        $this->errorMessage = $errorMessage;

        return $this;
    }
}
