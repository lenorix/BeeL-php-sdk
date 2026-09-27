<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;

class PatchSeriesRequest implements AdditionalPropertiesInterface
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
     * Descriptive name of the series. Cannot be cleared.
     *
     * @var string
     */
    protected $name;

    /**
     * Alphanumeric series code (used in {CODIGO} variable).
     * Allows uppercase letters, numbers, hyphens and underscores.
     *
     *
     * @var string
     */
    protected $code;

    /**
     * Series description. Send `null` to clear it.
     *
     * @var string|null
     */
    protected $description;

    /**
     * Format template with available variables (UPPERCASE ONLY):
     * - {CODIGO}: Series code (e.g., "FAC")
     * - {YYYY}: Year with 4 digits (e.g., "2025")
     * - {YY}: Year with 2 digits (e.g., "25")
     * - {MM}: Month with 2 digits (e.g., "01")
     * - {NUM}: Sequential number without padding (e.g., "1")
     * - {NUM:X}: Sequential number with padding (e.g., {NUM:4} → "0001")
     *
     * **REQUIRED**: Must contain at least {NUM} or {NUM:X}
     * **IMPORTANT**: Only uppercase (rejects {yy}, {mm}, {codigo}, etc.)
     *
     * Valid examples:
     * - "{CODIGO}-{YYYY}-{NUM:4}" → "FAC-2025-0001"
     * - "{CODIGO}/{NUM:6}" → "FAC/000001"
     * - "{YYYY}{MM}-{NUM:3}" → "202501-001"
     *
     *
     * @var string
     */
    protected $format;

    /**
     * Counter reset policy:
     * - NEVER: Counter never resets (continuous numbering)
     * - ANNUAL: Counter resets yearly
     * - MONTHLY: Counter resets monthly
     *
     *
     * @var string
     */
    protected $counterReset;

    /**
     * Initial number for this series counter.
     * Only while the series has no issued invoices.
     *
     *
     * @var int
     */
    protected $initialNumber;

    /**
     * Whether the series is active.
     *
     * **Restriction:** A default series cannot be deactivated
     * (another must be set as default first).
     *
     *
     * @var bool
     */
    protected $active;

    /**
     * Whether this is the default series.
     *
     * **Restriction:** An inactive series cannot be marked as default.
     *
     *
     * @var bool
     */
    protected $defaultSeries;

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
     * Descriptive name of the series. Cannot be cleared.
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Descriptive name of the series. Cannot be cleared.
     */
    public function setName(string $name): self
    {
        $this->initialized['name'] = true;
        $this->name = $name;

        return $this;
    }

    /**
     * Alphanumeric series code (used in {CODIGO} variable).
     * Allows uppercase letters, numbers, hyphens and underscores.
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * Alphanumeric series code (used in {CODIGO} variable).
    Allows uppercase letters, numbers, hyphens and underscores.
     */
    public function setCode(string $code): self
    {
        $this->initialized['code'] = true;
        $this->code = $code;

        return $this;
    }

    /**
     * Series description. Send `null` to clear it.
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * Series description. Send `null` to clear it.
     */
    public function setDescription(?string $description): self
    {
        $this->initialized['description'] = true;
        $this->description = $description;

        return $this;
    }

    /**
     * Format template with available variables (UPPERCASE ONLY):
     * - {CODIGO}: Series code (e.g., "FAC")
     * - {YYYY}: Year with 4 digits (e.g., "2025")
     * - {YY}: Year with 2 digits (e.g., "25")
     * - {MM}: Month with 2 digits (e.g., "01")
     * - {NUM}: Sequential number without padding (e.g., "1")
     * - {NUM:X}: Sequential number with padding (e.g., {NUM:4} → "0001")
     *
     * **REQUIRED**: Must contain at least {NUM} or {NUM:X}
     * **IMPORTANT**: Only uppercase (rejects {yy}, {mm}, {codigo}, etc.)
     *
     * Valid examples:
     * - "{CODIGO}-{YYYY}-{NUM:4}" → "FAC-2025-0001"
     * - "{CODIGO}/{NUM:6}" → "FAC/000001"
     * - "{YYYY}{MM}-{NUM:3}" → "202501-001"
     */
    public function getFormat(): string
    {
        return $this->format;
    }

    /**
     * Format template with available variables (UPPERCASE ONLY):
    - {CODIGO}: Series code (e.g., "FAC")
    - {YYYY}: Year with 4 digits (e.g., "2025")
    - {YY}: Year with 2 digits (e.g., "25")
    - {MM}: Month with 2 digits (e.g., "01")
    - {NUM}: Sequential number without padding (e.g., "1")
    - {NUM:X}: Sequential number with padding (e.g., {NUM:4} → "0001")

     **REQUIRED**: Must contain at least {NUM} or {NUM:X}
     **IMPORTANT**: Only uppercase (rejects {yy}, {mm}, {codigo}, etc.)

    Valid examples:
    - "{CODIGO}-{YYYY}-{NUM:4}" → "FAC-2025-0001"
    - "{CODIGO}/{NUM:6}" → "FAC/000001"
    - "{YYYY}{MM}-{NUM:3}" → "202501-001"
     */
    public function setFormat(string $format): self
    {
        $this->initialized['format'] = true;
        $this->format = $format;

        return $this;
    }

    /**
     * Counter reset policy:
     * - NEVER: Counter never resets (continuous numbering)
     * - ANNUAL: Counter resets yearly
     * - MONTHLY: Counter resets monthly
     */
    public function getCounterReset(): string
    {
        return $this->counterReset;
    }

    /**
     * Counter reset policy:
    - NEVER: Counter never resets (continuous numbering)
    - ANNUAL: Counter resets yearly
    - MONTHLY: Counter resets monthly
     */
    public function setCounterReset(string $counterReset): self
    {
        $this->initialized['counterReset'] = true;
        $this->counterReset = $counterReset;

        return $this;
    }

    /**
     * Initial number for this series counter.
     * Only while the series has no issued invoices.
     */
    public function getInitialNumber(): int
    {
        return $this->initialNumber;
    }

    /**
     * Initial number for this series counter.
    Only while the series has no issued invoices.
     */
    public function setInitialNumber(int $initialNumber): self
    {
        $this->initialized['initialNumber'] = true;
        $this->initialNumber = $initialNumber;

        return $this;
    }

    /**
     * Whether the series is active.
     *
     * **Restriction:** A default series cannot be deactivated
     * (another must be set as default first).
     */
    public function getActive(): bool
    {
        return $this->active;
    }

    /**
     * Whether the series is active.

     **Restriction:** A default series cannot be deactivated
    (another must be set as default first).
     */
    public function setActive(bool $active): self
    {
        $this->initialized['active'] = true;
        $this->active = $active;

        return $this;
    }

    /**
     * Whether this is the default series.
     *
     * **Restriction:** An inactive series cannot be marked as default.
     */
    public function getDefaultSeries(): bool
    {
        return $this->defaultSeries;
    }

    /**
     * Whether this is the default series.
     **Restriction:** An inactive series cannot be marked as default.
     */
    public function setDefaultSeries(bool $defaultSeries): self
    {
        $this->initialized['defaultSeries'] = true;
        $this->defaultSeries = $defaultSeries;

        return $this;
    }

    public function definedProperties(): array
    {
        return ['documentType' => ['document_type', 'getDocumentType', 'setDocumentType'], 'name' => ['name', 'getName', 'setName'], 'code' => ['code', 'getCode', 'setCode'], 'description' => ['description', 'getDescription', 'setDescription'], 'format' => ['format', 'getFormat', 'setFormat'], 'counterReset' => ['counter_reset', 'getCounterReset', 'setCounterReset'], 'initialNumber' => ['initial_number', 'getInitialNumber', 'setInitialNumber'], 'active' => ['active', 'getActive', 'setActive'], 'defaultSeries' => ['default_series', 'getDefaultSeries', 'setDefaultSeries']];
    }
}
