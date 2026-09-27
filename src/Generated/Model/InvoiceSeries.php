<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;
class InvoiceSeries implements AdditionalPropertiesInterface
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
     * Unique series ID
     *
     * @var string
     */
    protected $id;
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
     * Descriptive name of the series
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
     * Optional series description
     *
     * @var string
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
     * Initial number configured for this series counter.
     * Defines from which number invoice numbering will start.
     * 
     *
     * @var int
     */
    protected $initialNumber = 1;
    /**
     * Indicates whether the series is active
     *
     * @var bool
     */
    protected $active = true;
    /**
     * Indicates whether this is the user's default series (only one can be)
     *
     * @var bool
     */
    protected $defaultSeries = false;
    /**
     * `true` once this series has issued at least one invoice. From that point the
     * fields that drive numbering (`code`, `format`, `counter_reset`, `initial_number`)
     * are permanently locked and any attempt to change them is rejected — numbering can
     * only be adjusted **before** the first invoice of a series. Cosmetic fields
     * (`name`, `description`) remain editable. To use a different numbering, create a
     * new series.
     * 
     *
     * @var bool
     */
    protected $numberingLocked;
    /**
     * Creation date
     *
     * @var \DateTime
     */
    protected $createdAt;
    /**
     * Next invoice number that will be assigned for this series
     *
     * @var int
     */
    protected $nextNumber;
    /**
     * Last update date
     *
     * @var \DateTime
     */
    protected $updatedAt;
    /**
     * Unique series ID
     *
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }
    /**
     * Unique series ID
     *
     * @param string $id
     *
     * @return self
     */
    public function setId(string $id): self
    {
        $this->initialized['id'] = true;
        $this->id = $id;
        return $this;
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
     * @return string
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
    
    *
    * @param string $documentType
    *
    * @return self
    */
    public function setDocumentType(string $documentType): self
    {
        $this->initialized['documentType'] = true;
        $this->documentType = $documentType;
        return $this;
    }
    /**
     * Descriptive name of the series
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }
    /**
     * Descriptive name of the series
     *
     * @param string $name
     *
     * @return self
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
     * 
     *
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }
    /**
    * Alphanumeric series code (used in {CODIGO} variable).
    Allows uppercase letters, numbers, hyphens and underscores.
    
    *
    * @param string $code
    *
    * @return self
    */
    public function setCode(string $code): self
    {
        $this->initialized['code'] = true;
        $this->code = $code;
        return $this;
    }
    /**
     * Optional series description
     *
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }
    /**
     * Optional series description
     *
     * @param string $description
     *
     * @return self
     */
    public function setDescription(string $description): self
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
     * 
     *
     * @return string
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
    
    *
    * @param string $format
    *
    * @return self
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
     * 
     *
     * @return string
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
    
    *
    * @param string $counterReset
    *
    * @return self
    */
    public function setCounterReset(string $counterReset): self
    {
        $this->initialized['counterReset'] = true;
        $this->counterReset = $counterReset;
        return $this;
    }
    /**
     * Initial number configured for this series counter.
     * Defines from which number invoice numbering will start.
     * 
     *
     * @return int
     */
    public function getInitialNumber(): int
    {
        return $this->initialNumber;
    }
    /**
    * Initial number configured for this series counter.
    Defines from which number invoice numbering will start.
    
    *
    * @param int $initialNumber
    *
    * @return self
    */
    public function setInitialNumber(int $initialNumber): self
    {
        $this->initialized['initialNumber'] = true;
        $this->initialNumber = $initialNumber;
        return $this;
    }
    /**
     * Indicates whether the series is active
     *
     * @return bool
     */
    public function getActive(): bool
    {
        return $this->active;
    }
    /**
     * Indicates whether the series is active
     *
     * @param bool $active
     *
     * @return self
     */
    public function setActive(bool $active): self
    {
        $this->initialized['active'] = true;
        $this->active = $active;
        return $this;
    }
    /**
     * Indicates whether this is the user's default series (only one can be)
     *
     * @return bool
     */
    public function getDefaultSeries(): bool
    {
        return $this->defaultSeries;
    }
    /**
     * Indicates whether this is the user's default series (only one can be)
     *
     * @param bool $defaultSeries
     *
     * @return self
     */
    public function setDefaultSeries(bool $defaultSeries): self
    {
        $this->initialized['defaultSeries'] = true;
        $this->defaultSeries = $defaultSeries;
        return $this;
    }
    /**
     * `true` once this series has issued at least one invoice. From that point the
     * fields that drive numbering (`code`, `format`, `counter_reset`, `initial_number`)
     * are permanently locked and any attempt to change them is rejected — numbering can
     * only be adjusted **before** the first invoice of a series. Cosmetic fields
     * (`name`, `description`) remain editable. To use a different numbering, create a
     * new series.
     * 
     *
     * @return bool
     */
    public function getNumberingLocked(): bool
    {
        return $this->numberingLocked;
    }
    /**
    * `true` once this series has issued at least one invoice. From that point the
    fields that drive numbering (`code`, `format`, `counter_reset`, `initial_number`)
    are permanently locked and any attempt to change them is rejected — numbering can
    only be adjusted **before** the first invoice of a series. Cosmetic fields
    (`name`, `description`) remain editable. To use a different numbering, create a
    new series.
    
    *
    * @param bool $numberingLocked
    *
    * @return self
    */
    public function setNumberingLocked(bool $numberingLocked): self
    {
        $this->initialized['numberingLocked'] = true;
        $this->numberingLocked = $numberingLocked;
        return $this;
    }
    /**
     * Creation date
     *
     * @return \DateTime
     */
    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }
    /**
     * Creation date
     *
     * @param \DateTime $createdAt
     *
     * @return self
     */
    public function setCreatedAt(\DateTime $createdAt): self
    {
        $this->initialized['createdAt'] = true;
        $this->createdAt = $createdAt;
        return $this;
    }
    /**
     * Next invoice number that will be assigned for this series
     *
     * @return int
     */
    public function getNextNumber(): int
    {
        return $this->nextNumber;
    }
    /**
     * Next invoice number that will be assigned for this series
     *
     * @param int $nextNumber
     *
     * @return self
     */
    public function setNextNumber(int $nextNumber): self
    {
        $this->initialized['nextNumber'] = true;
        $this->nextNumber = $nextNumber;
        return $this;
    }
    /**
     * Last update date
     *
     * @return \DateTime
     */
    public function getUpdatedAt(): \DateTime
    {
        return $this->updatedAt;
    }
    /**
     * Last update date
     *
     * @param \DateTime $updatedAt
     *
     * @return self
     */
    public function setUpdatedAt(\DateTime $updatedAt): self
    {
        $this->initialized['updatedAt'] = true;
        $this->updatedAt = $updatedAt;
        return $this;
    }
    public function definedProperties(): array
    {
        return ['id' => ['id', 'getId', 'setId'], 'documentType' => ['document_type', 'getDocumentType', 'setDocumentType'], 'name' => ['name', 'getName', 'setName'], 'code' => ['code', 'getCode', 'setCode'], 'description' => ['description', 'getDescription', 'setDescription'], 'format' => ['format', 'getFormat', 'setFormat'], 'counterReset' => ['counter_reset', 'getCounterReset', 'setCounterReset'], 'initialNumber' => ['initial_number', 'getInitialNumber', 'setInitialNumber'], 'active' => ['active', 'getActive', 'setActive'], 'defaultSeries' => ['default_series', 'getDefaultSeries', 'setDefaultSeries'], 'numberingLocked' => ['numbering_locked', 'getNumberingLocked', 'setNumberingLocked'], 'createdAt' => ['created_at', 'getCreatedAt', 'setCreatedAt'], 'nextNumber' => ['next_number', 'getNextNumber', 'setNextNumber'], 'updatedAt' => ['updated_at', 'getUpdatedAt', 'setUpdatedAt']];
    }
}