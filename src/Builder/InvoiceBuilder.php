<?php

declare(strict_types=1);

namespace Lenorix\BeelSdk\Builder;

use Lenorix\BeelSdk\Generated\Model\CreateInvoiceRequest;
use Lenorix\BeelSdk\Generated\Model\CreateInvoiceRequestLinesItem;
use Lenorix\BeelSdk\Generated\Model\Recipient;

/** Build a Jane-generated invoice request using a fluent interface. */
final class InvoiceBuilder
{
    private CreateInvoiceRequest $request;

    /** @var list<CreateInvoiceRequestLinesItem> */
    private array $lines = [];

    private ?string $customerId = null;

    private function __construct()
    {
        $this->request = (new CreateInvoiceRequest)->setType('STANDARD');
    }

    /** Start a builder with the `STANDARD` invoice type. */
    public static function create(): self
    {
        return new self;
    }

    /** Set the invoice document type (`STANDARD`, `SIMPLIFIED` or `PROFORMA`). */
    public function type(string $type): self
    {
        $this->request->setType($type);

        return $this;
    }

    /** Use a saved company customer as the invoice recipient. */
    public function forCustomer(string $customerId): self
    {
        $this->customerId = $customerId;
        $this->request->setRecipient((new Recipient)->setCustomerId($customerId));

        return $this;
    }

    /** Set the date the invoiced service or transaction took place. */
    public function operationDate(\DateTimeInterface|string $date): self
    {
        $this->request->setOperationDate($date instanceof \DateTimeInterface
            ? \DateTime::createFromInterface($date)->setTimezone(new \DateTimeZone('UTC'))
            : new \DateTime($date));

        return $this;
    }

    /** Set the payment due date. It must be today or a future date. */
    public function dueDate(\DateTimeInterface|string $date): self
    {
        $this->request->setDueDate($date instanceof \DateTimeInterface
            ? \DateTime::createFromInterface($date)->setTimezone(new \DateTimeZone('UTC'))
            : new \DateTime($date));

        return $this;
    }

    /** Choose the invoice numbering series. */
    public function series(string $seriesId): self
    {
        $this->request->setSeriesId($seriesId);

        return $this;
    }

    /** Set a client-side reference used to find or prevent duplicate business invoices. */
    public function externalRef(string $reference): self
    {
        $this->request->setExternalRef($reference);

        return $this;
    }

    /** @param array<string, mixed> $metadata Key/value data attached to the invoice for your own integrations. */
    public function metadata(array $metadata): self
    {
        $this->request->setMetadata($metadata);

        return $this;
    }

    /** Set notes to include on the invoice. */
    public function notes(string $notes): self
    {
        $this->request->setNotes($notes);

        return $this;
    }

    /**
     * Add a normal service or product line.
     *
     * This shortcut does not set `main_tax`. BeeL requires an explicit tax on every
     * `NORMAL` line, so use {@see addLineObject()} with a generated line model that
     * includes its tax before sending the built request.
     */
    public function addLine(string $description, float $quantity, float $unitPrice, float $discountPercentage = 0): self
    {
        $this->lines[] = (new CreateInvoiceRequestLinesItem)
            ->setLineType('NORMAL')->setDescription($description)->setQuantity($quantity)
            ->setUnitPrice($unitPrice)->setDiscountPercentage($discountPercentage);

        return $this;
    }

    /**
     * Add a Jane-generated invoice line.
     *
     * Include `main_tax` on a `NORMAL` line. `SUPLIDO` lines must have no tax.
     */
    public function addLineObject(CreateInvoiceRequestLinesItem $line): self
    {
        $this->lines[] = $line;

        return $this;
    }

    /**
     * Build the Jane-generated request model.
     *
     * @throws \LogicException If no saved customer or invoice line was provided.
     */
    public function build(): CreateInvoiceRequest
    {
        if (! $this->customerId) {
            throw new \LogicException('\Lenorix\BeelSdk\Generated\Model\Customer ID is required.');
        }
        if ($this->lines === []) {
            throw new \LogicException('At least one invoice line is required.');
        }
        $this->request->setLines($this->lines);

        return $this->request;
    }
}
