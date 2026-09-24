<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;

class WebhookEvent implements AdditionalPropertiesInterface
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
     * Unique webhook event ID (UUID).
     *
     * @var string
     */
    protected $id;

    /**
     * Available webhook event types:
     * - `invoice.issued` — Invoice issued and finalized
     * - `invoice.email.sent` — Invoice sent by email
     * - `invoice.pdf.generated` — The PDF of an invoice was (re)rendered, so any copy you cached
     *   is stale; fetch it again from the PDF endpoint
     * - `invoice.voided` — Invoice voided
     * - `recurring_invoice.paused` — A schedule stopped generating on its own (downgrade or a
     *   permanent generation failure); the invoice it was going to issue will not arrive
     * - `invoice.schedule_failed` — A scheduled invoice could not be issued on its date and BeeL.
     *   gave up retrying; it stays in drafts and can be issued by hand once the cause is fixed
     * - `verifactu.status.updated` — VeriFactu status changed (see `VeriFactuSubmissionStatus`)
     * - `account.claimed` — A provisioned account was claimed by its holder
     * - `company.created` — A company was created inside a provisioned account
     * - `representation.signed` — Fiscal representation signed for a NIF (production invoicing enabled)
     *
     * The `account.*` events are delivered only to the **provisioner** that created the
     * account; a subscription on any other account never receives them.
     *
     *
     * @var string
     */
    protected $type;

    /**
     * @var \DateTime
     */
    protected $createdAt;

    /**
     * @var string
     */
    protected $apiVersion;

    /**
     * Deprecated in favour of the `TEST`/`PROD` environment vocabulary: `livemode: true` is equivalent to environment `PROD`.
     *
     * @deprecated
     *
     * @var bool
     */
    protected $livemode;

    /**
     * `true` only for test deliveries triggered from the dashboard.
     *
     * @var bool|null
     */
    protected $test;

    /**
     * Unique identifier (UUID) of the company the event is about, or `null` when the event is
     * not scoped to a specific company. A single endpoint receives events for every company it
     * manages; route on this field.
     *
     *
     * @var string|null
     */
    protected $companyId;

    /**
     * NIF of the company the event is about.
     *
     * @var string|null
     */
    protected $nif;

    /**
     * Account the event happened in. For your own events this is your account; for
     * events of accounts you manage it identifies which one.
     *
     *
     * @var string|null
     */
    protected $accountId;

    /**
     * Your own identifier for that account, as supplied when you provisioned it
     * (`external_ref`). `null` for accounts you did not provision.
     *
     *
     * @var string|null
     */
    protected $accountExternalRef;

    /**
     * How `account_id` relates to you: `own` when the event happened in your own account,
     * `managed` when it happened in an account you manage. `null` when the event is not
     * scoped to an account.
     *
     *
     * @var string|null
     */
    protected $accountRelationship;

    /**
     * @var WebhookEventDataInvoiceIssued|WebhookEventDataInvoiceEmailSent|WebhookEventDataInvoicePdfGenerated|WebhookEventDataInvoiceVoided|WebhookEventDataRecurringInvoicePaused|WebhookEventDataInvoiceScheduleFailed|WebhookEventDataVeriFactuStatusUpdated|WebhookEventDataAccountClaimed|WebhookEventDataCompanyCreated|WebhookEventDataRepresentationSigned
     */
    protected $data;

    /**
     * Unique webhook event ID (UUID).
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * Unique webhook event ID (UUID).
     */
    public function setId(string $id): self
    {
        $this->initialized['id'] = true;
        $this->id = $id;

        return $this;
    }

    /**
     * Available webhook event types:
     * - `invoice.issued` — Invoice issued and finalized
     * - `invoice.email.sent` — Invoice sent by email
     * - `invoice.pdf.generated` — The PDF of an invoice was (re)rendered, so any copy you cached
     *   is stale; fetch it again from the PDF endpoint
     * - `invoice.voided` — Invoice voided
     * - `recurring_invoice.paused` — A schedule stopped generating on its own (downgrade or a
     *   permanent generation failure); the invoice it was going to issue will not arrive
     * - `invoice.schedule_failed` — A scheduled invoice could not be issued on its date and BeeL.
     *   gave up retrying; it stays in drafts and can be issued by hand once the cause is fixed
     * - `verifactu.status.updated` — VeriFactu status changed (see `VeriFactuSubmissionStatus`)
     * - `account.claimed` — A provisioned account was claimed by its holder
     * - `company.created` — A company was created inside a provisioned account
     * - `representation.signed` — Fiscal representation signed for a NIF (production invoicing enabled)
     *
     * The `account.*` events are delivered only to the **provisioner** that created the
     * account; a subscription on any other account never receives them.
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * Available webhook event types:
    - `invoice.issued` — Invoice issued and finalized
    - `invoice.email.sent` — Invoice sent by email
    - `invoice.pdf.generated` — The PDF of an invoice was (re)rendered, so any copy you cached
     is stale; fetch it again from the PDF endpoint
    - `invoice.voided` — Invoice voided
    - `recurring_invoice.paused` — A schedule stopped generating on its own (downgrade or a
     permanent generation failure); the invoice it was going to issue will not arrive
    - `invoice.schedule_failed` — A scheduled invoice could not be issued on its date and BeeL.
     gave up retrying; it stays in drafts and can be issued by hand once the cause is fixed
    - `verifactu.status.updated` — VeriFactu status changed (see `VeriFactuSubmissionStatus`)
    - `account.claimed` — A provisioned account was claimed by its holder
    - `company.created` — A company was created inside a provisioned account
    - `representation.signed` — Fiscal representation signed for a NIF (production invoicing enabled)

    The `account.*` events are delivered only to the **provisioner** that created the
    account; a subscription on any other account never receives them.
     */
    public function setType(string $type): self
    {
        $this->initialized['type'] = true;
        $this->type = $type;

        return $this;
    }

    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTime $createdAt): self
    {
        $this->initialized['createdAt'] = true;
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getApiVersion(): string
    {
        return $this->apiVersion;
    }

    public function setApiVersion(string $apiVersion): self
    {
        $this->initialized['apiVersion'] = true;
        $this->apiVersion = $apiVersion;

        return $this;
    }

    /**
     * Deprecated in favour of the `TEST`/`PROD` environment vocabulary: `livemode: true` is equivalent to environment `PROD`.
     *
     * @deprecated
     */
    public function getLivemode(): bool
    {
        return $this->livemode;
    }

    /**
     * Deprecated in favour of the `TEST`/`PROD` environment vocabulary: `livemode: true` is equivalent to environment `PROD`.
     *
     *
     * @deprecated
     */
    public function setLivemode(bool $livemode): self
    {
        $this->initialized['livemode'] = true;
        $this->livemode = $livemode;

        return $this;
    }

    /**
     * `true` only for test deliveries triggered from the dashboard.
     */
    public function getTest(): ?bool
    {
        return $this->test;
    }

    /**
     * `true` only for test deliveries triggered from the dashboard.
     */
    public function setTest(?bool $test): self
    {
        $this->initialized['test'] = true;
        $this->test = $test;

        return $this;
    }

    /**
     * Unique identifier (UUID) of the company the event is about, or `null` when the event is
     * not scoped to a specific company. A single endpoint receives events for every company it
     * manages; route on this field.
     */
    public function getCompanyId(): ?string
    {
        return $this->companyId;
    }

    /**
     * Unique identifier (UUID) of the company the event is about, or `null` when the event is
    not scoped to a specific company. A single endpoint receives events for every company it
    manages; route on this field.
     */
    public function setCompanyId(?string $companyId): self
    {
        $this->initialized['companyId'] = true;
        $this->companyId = $companyId;

        return $this;
    }

    /**
     * NIF of the company the event is about.
     */
    public function getNif(): ?string
    {
        return $this->nif;
    }

    /**
     * NIF of the company the event is about.
     */
    public function setNif(?string $nif): self
    {
        $this->initialized['nif'] = true;
        $this->nif = $nif;

        return $this;
    }

    /**
     * Account the event happened in. For your own events this is your account; for
     * events of accounts you manage it identifies which one.
     */
    public function getAccountId(): ?string
    {
        return $this->accountId;
    }

    /**
     * Account the event happened in. For your own events this is your account; for
    events of accounts you manage it identifies which one.
     */
    public function setAccountId(?string $accountId): self
    {
        $this->initialized['accountId'] = true;
        $this->accountId = $accountId;

        return $this;
    }

    /**
     * Your own identifier for that account, as supplied when you provisioned it
     * (`external_ref`). `null` for accounts you did not provision.
     */
    public function getAccountExternalRef(): ?string
    {
        return $this->accountExternalRef;
    }

    /**
     * Your own identifier for that account, as supplied when you provisioned it
    (`external_ref`). `null` for accounts you did not provision.
     */
    public function setAccountExternalRef(?string $accountExternalRef): self
    {
        $this->initialized['accountExternalRef'] = true;
        $this->accountExternalRef = $accountExternalRef;

        return $this;
    }

    /**
     * How `account_id` relates to you: `own` when the event happened in your own account,
     * `managed` when it happened in an account you manage. `null` when the event is not
     * scoped to an account.
     */
    public function getAccountRelationship(): ?string
    {
        return $this->accountRelationship;
    }

    /**
     * How `account_id` relates to you: `own` when the event happened in your own account,
    `managed` when it happened in an account you manage. `null` when the event is not
    scoped to an account.
     */
    public function setAccountRelationship(?string $accountRelationship): self
    {
        $this->initialized['accountRelationship'] = true;
        $this->accountRelationship = $accountRelationship;

        return $this;
    }

    /**
     * @return WebhookEventDataInvoiceIssued|WebhookEventDataInvoiceEmailSent|WebhookEventDataInvoicePdfGenerated|WebhookEventDataInvoiceVoided|WebhookEventDataRecurringInvoicePaused|WebhookEventDataInvoiceScheduleFailed|WebhookEventDataVeriFactuStatusUpdated|WebhookEventDataAccountClaimed|WebhookEventDataCompanyCreated|WebhookEventDataRepresentationSigned
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param  WebhookEventDataInvoiceIssued|WebhookEventDataInvoiceEmailSent|WebhookEventDataInvoicePdfGenerated|WebhookEventDataInvoiceVoided|WebhookEventDataRecurringInvoicePaused|WebhookEventDataInvoiceScheduleFailed|WebhookEventDataVeriFactuStatusUpdated|WebhookEventDataAccountClaimed|WebhookEventDataCompanyCreated|WebhookEventDataRepresentationSigned  $data
     */
    public function setData($data): self
    {
        $this->initialized['data'] = true;
        $this->data = $data;

        return $this;
    }

    public function definedProperties(): array
    {
        return ['id' => ['id', 'getId', 'setId'], 'type' => ['type', 'getType', 'setType'], 'createdAt' => ['created_at', 'getCreatedAt', 'setCreatedAt'], 'apiVersion' => ['api_version', 'getApiVersion', 'setApiVersion'], 'livemode' => ['livemode', 'getLivemode', 'setLivemode'], 'test' => ['test', 'getTest', 'setTest'], 'companyId' => ['company_id', 'getCompanyId', 'setCompanyId'], 'nif' => ['nif', 'getNif', 'setNif'], 'accountId' => ['account_id', 'getAccountId', 'setAccountId'], 'accountExternalRef' => ['account_external_ref', 'getAccountExternalRef', 'setAccountExternalRef'], 'accountRelationship' => ['account_relationship', 'getAccountRelationship', 'setAccountRelationship'], 'data' => ['data', 'getData', 'setData']];
    }
}
