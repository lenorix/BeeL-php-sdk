<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;

class DocumentTypeDefaultStatus implements AdditionalPropertiesInterface
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
     * Document type associated with a series. Values mirror `InvoiceType`,
     * so the series a document needs is named exactly like the document:
     * - UNASSIGNED: Legacy series, compatible with any invoice type
     * - STANDARD: Standard invoice
     * - SIMPLIFIED: Simplified invoice
     * - CORRECTIVE: Corrects or cancels a previous invoice
     * - PROFORMA: Proforma (commercial document, non-fiscal numbering)
     *
     *
     * @var string
     */
    protected $documentType;

    /**
     * Whether the user has a default series for this document type.
     *
     * @var bool
     */
    protected $exists;

    /**
     * ID of the configured default series (only when exists=true).
     *
     * @var string|null
     */
    protected $seriesId;

    /**
     * Code of the configured default series (only when exists=true).
     *
     * @var string|null
     */
    protected $code;

    /**
     * Whether the default series is still **provisional**: it exists but has not
     * issued any invoice yet, so its numbering (`initial_number`) can still be
     * changed. The invoice creation screen uses this to warn that numbering will
     * start at 1 before it is too late — once the first invoice is issued the
     * numbering is frozen and `initial_number` can no longer be updated.
     *
     * Always `false` when `exists` is `false`.
     *
     *
     * @var bool
     */
    protected $provisional;

    /**
     * Document type associated with a series. Values mirror `InvoiceType`,
     * so the series a document needs is named exactly like the document:
     * - UNASSIGNED: Legacy series, compatible with any invoice type
     * - STANDARD: Standard invoice
     * - SIMPLIFIED: Simplified invoice
     * - CORRECTIVE: Corrects or cancels a previous invoice
     * - PROFORMA: Proforma (commercial document, non-fiscal numbering)
     */
    public function getDocumentType(): string
    {
        return $this->documentType;
    }

    /**
     * Document type associated with a series. Values mirror `InvoiceType`,
    so the series a document needs is named exactly like the document:
    - UNASSIGNED: Legacy series, compatible with any invoice type
    - STANDARD: Standard invoice
    - SIMPLIFIED: Simplified invoice
    - CORRECTIVE: Corrects or cancels a previous invoice
    - PROFORMA: Proforma (commercial document, non-fiscal numbering)
     */
    public function setDocumentType(string $documentType): self
    {
        $this->initialized['documentType'] = true;
        $this->documentType = $documentType;

        return $this;
    }

    /**
     * Whether the user has a default series for this document type.
     */
    public function getExists(): bool
    {
        return $this->exists;
    }

    /**
     * Whether the user has a default series for this document type.
     */
    public function setExists(bool $exists): self
    {
        $this->initialized['exists'] = true;
        $this->exists = $exists;

        return $this;
    }

    /**
     * ID of the configured default series (only when exists=true).
     */
    public function getSeriesId(): ?string
    {
        return $this->seriesId;
    }

    /**
     * ID of the configured default series (only when exists=true).
     */
    public function setSeriesId(?string $seriesId): self
    {
        $this->initialized['seriesId'] = true;
        $this->seriesId = $seriesId;

        return $this;
    }

    /**
     * Code of the configured default series (only when exists=true).
     */
    public function getCode(): ?string
    {
        return $this->code;
    }

    /**
     * Code of the configured default series (only when exists=true).
     */
    public function setCode(?string $code): self
    {
        $this->initialized['code'] = true;
        $this->code = $code;

        return $this;
    }

    /**
     * Whether the default series is still **provisional**: it exists but has not
     * issued any invoice yet, so its numbering (`initial_number`) can still be
     * changed. The invoice creation screen uses this to warn that numbering will
     * start at 1 before it is too late — once the first invoice is issued the
     * numbering is frozen and `initial_number` can no longer be updated.
     *
     * Always `false` when `exists` is `false`.
     */
    public function getProvisional(): bool
    {
        return $this->provisional;
    }

    /**
     * Whether the default series is still **provisional**: it exists but has not
    issued any invoice yet, so its numbering (`initial_number`) can still be
    changed. The invoice creation screen uses this to warn that numbering will
    start at 1 before it is too late — once the first invoice is issued the
    numbering is frozen and `initial_number` can no longer be updated.

    Always `false` when `exists` is `false`.
     */
    public function setProvisional(bool $provisional): self
    {
        $this->initialized['provisional'] = true;
        $this->provisional = $provisional;

        return $this;
    }

    public function definedProperties(): array
    {
        return ['documentType' => ['document_type', 'getDocumentType', 'setDocumentType'], 'exists' => ['exists', 'getExists', 'setExists'], 'seriesId' => ['series_id', 'getSeriesId', 'setSeriesId'], 'code' => ['code', 'getCode', 'setCode'], 'provisional' => ['provisional', 'getProvisional', 'setProvisional']];
    }
}
