<?php

declare(strict_types=1);

namespace Lenorix\BeelSdk\Builder;

use Lenorix\BeelSdk\Generated\Model\CreateInvoiceRequest;
use Lenorix\BeelSdk\Generated\Model\CreateInvoiceRequestLinesItem;
use Lenorix\BeelSdk\Generated\Model\Recipient;

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

    public static function create(): self
    {
        return new self;
    }

    public function type(string $type): self
    {
        $this->request->setType($type);

        return $this;
    }

    public function forCustomer(string $customerId): self
    {
        $this->customerId = $customerId;
        $this->request->setRecipient((new Recipient)->setCustomerId($customerId));

        return $this;
    }

    public function operationDate(\DateTimeInterface|string $date): self
    {
        $this->request->setOperationDate($date instanceof \DateTimeInterface
            ? \DateTime::createFromInterface($date)->setTimezone(new \DateTimeZone('UTC'))
            : new \DateTime($date));

        return $this;
    }

    public function dueDate(\DateTimeInterface|string $date): self
    {
        $this->request->setDueDate($date instanceof \DateTimeInterface
            ? \DateTime::createFromInterface($date)->setTimezone(new \DateTimeZone('UTC'))
            : new \DateTime($date));

        return $this;
    }

    public function series(string $seriesId): self
    {
        $this->request->setSeriesId($seriesId);

        return $this;
    }

    public function externalRef(string $reference): self
    {
        $this->request->setExternalRef($reference);

        return $this;
    }

    /**
     * @param  array<string, mixed>  $metadata
     */
    public function metadata(array $metadata): self
    {
        $this->request->setMetadata($metadata);

        return $this;
    }

    public function notes(string $notes): self
    {
        $this->request->setNotes($notes);

        return $this;
    }

    public function addLine(string $description, float $quantity, float $unitPrice, float $discountPercentage = 0): self
    {
        $this->lines[] = (new CreateInvoiceRequestLinesItem)
            ->setLineType('NORMAL')->setDescription($description)->setQuantity($quantity)
            ->setUnitPrice($unitPrice)->setDiscountPercentage($discountPercentage);

        return $this;
    }

    public function addLineObject(CreateInvoiceRequestLinesItem $line): self
    {
        $this->lines[] = $line;

        return $this;
    }

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
