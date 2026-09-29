<?php

declare(strict_types=1);

namespace Lenorix\BeelSdk\Builder;

use Lenorix\BeelSdk\Generated\Model\CreateInvoiceRequest;
use Lenorix\BeelSdk\Generated\Model\CreateInvoiceRequestLinesItem;
use Lenorix\BeelSdk\Generated\Model\CreateInvoiceRequestLinesItemMainTax;
use Lenorix\BeelSdk\Generated\Model\Recipient;
use Lenorix\BeelSdk\Http\RequestModels;

/** Build a Jane-generated invoice request using a fluent interface. */
final class InvoiceBuilder
{
    private CreateInvoiceRequest $request;

    /** @var list<CreateInvoiceRequestLinesItem> */
    private array $lines = [];

    private ?string $customerId = null;

    private ?CreateInvoiceRequestLinesItemMainTax $mainTax = null;

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

    /** Set the date the invoiced service or transaction took place: the calendar day of a date object, in its own time zone. */
    public function operationDate(\DateTimeInterface|string $date): self
    {
        $this->request->setOperationDate(self::day($date));

        return $this;
    }

    /** Set the payment due date, which must be today or later: the calendar day of a date object, in its own time zone. */
    public function dueDate(\DateTimeInterface|string $date): self
    {
        $this->request->setDueDate(self::day($date));

        return $this;
    }

    /**
     * Set the main tax of every line added with {@see addLine()} after this call, unless the line passes its own.
     *
     * @param  CreateInvoiceRequestLinesItemMainTax|array<string, mixed>  $tax  For example `['type' => 'IVA', 'percentage' => 21, 'regime_key' => '01']`.
     */
    public function mainTax(CreateInvoiceRequestLinesItemMainTax|array $tax): self
    {
        $this->mainTax = RequestModels::from($tax, CreateInvoiceRequestLinesItemMainTax::class);

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
     * BeeL requires a tax on every `NORMAL` line: pass `$mainTax`, or set a default with {@see mainTax()}.
     *
     * @param  CreateInvoiceRequestLinesItemMainTax|array<string, mixed>|null  $mainTax  The tax of this line, instead of the default.
     */
    public function addLine(string $description, float $quantity, float $unitPrice, float $discountPercentage = 0, CreateInvoiceRequestLinesItemMainTax|array|null $mainTax = null): self
    {
        $line = (new CreateInvoiceRequestLinesItem)
            ->setLineType('NORMAL')->setDescription($description)->setQuantity($quantity)
            ->setUnitPrice($unitPrice)->setDiscountPercentage($discountPercentage);
        $tax = RequestModels::from($mainTax, CreateInvoiceRequestLinesItemMainTax::class) ?? $this->mainTax;
        if ($tax !== null) {
            $line->setMainTax(clone $tax);
        }
        $this->lines[] = $line;

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

    /** The calendar day of a date: a date object keeps its own time zone instead of moving to UTC, which could change the day. */
    private static function day(\DateTimeInterface|string $date): \DateTime
    {
        return $date instanceof \DateTimeInterface
            ? new \DateTime($date->format('Y-m-d'))
            : new \DateTime($date);
    }

    /**
     * Build the Jane-generated request model.
     *
     * @throws \LogicException If no saved customer or invoice line was provided.
     */
    public function build(): CreateInvoiceRequest
    {
        if (! $this->customerId) {
            throw new \LogicException('Customer ID is required');
        }
        if ($this->lines === []) {
            throw new \LogicException('At least one invoice line is required');
        }

        // A fresh model on every call, like the Node.js SDK: later builder calls never change it.
        return (clone $this->request)->setLines(array_map(static fn (object $line): object => clone $line, $this->lines));
    }
}
