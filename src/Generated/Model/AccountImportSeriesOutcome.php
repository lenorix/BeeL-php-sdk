<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;
class AccountImportSeriesOutcome implements AdditionalPropertiesInterface
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
     * * `ALREADY_EXISTS` — the account already numbers like this. Nothing was touched. A series
     *   counts as present when it numbers identically, whether it is written with `{CODIGO}` or
     *   with the code spelled out.
     * * `CREATED` — the series was created (in a preview: would be).
     * * `MANUAL_REVIEW_REQUIRED` — neither the declared code nor its `<code>2` fallback is free,
     *   or the resolved format falls outside the series grammar. Inventing a third code would be
     *   guessing, and changing the format of a series that has already numbered a document is not
     *   something an import may do. Resolve it on the account and re-upload.
     * 
     *
     * @var string
     */
    protected $action;
    /**
     * Code the series was created under — not necessarily the declared one, when that was already taken by a different numbering.
     *
     * @var string|null
     */
    protected $code;
    /**
     * Format with `{REF}` already resolved to this row's `external_ref`.
     *
     * @var string|null
     */
    protected $format;
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
     * * `ALREADY_EXISTS` — the account already numbers like this. Nothing was touched. A series
     *   counts as present when it numbers identically, whether it is written with `{CODIGO}` or
     *   with the code spelled out.
     * * `CREATED` — the series was created (in a preview: would be).
     * * `MANUAL_REVIEW_REQUIRED` — neither the declared code nor its `<code>2` fallback is free,
     *   or the resolved format falls outside the series grammar. Inventing a third code would be
     *   guessing, and changing the format of a series that has already numbered a document is not
     *   something an import may do. Resolve it on the account and re-upload.
     * 
     *
     * @return string
     */
    public function getAction(): string
    {
        return $this->action;
    }
    /**
    * * `ALREADY_EXISTS` — the account already numbers like this. Nothing was touched. A series
     counts as present when it numbers identically, whether it is written with `{CODIGO}` or
     with the code spelled out.
    * `CREATED` — the series was created (in a preview: would be).
    * `MANUAL_REVIEW_REQUIRED` — neither the declared code nor its `<code>2` fallback is free,
     or the resolved format falls outside the series grammar. Inventing a third code would be
     guessing, and changing the format of a series that has already numbered a document is not
     something an import may do. Resolve it on the account and re-upload.
    
    *
    * @param string $action
    *
    * @return self
    */
    public function setAction(string $action): self
    {
        $this->initialized['action'] = true;
        $this->action = $action;
        return $this;
    }
    /**
     * Code the series was created under — not necessarily the declared one, when that was already taken by a different numbering.
     *
     * @return string|null
     */
    public function getCode(): ?string
    {
        return $this->code;
    }
    /**
     * Code the series was created under — not necessarily the declared one, when that was already taken by a different numbering.
     *
     * @param string|null $code
     *
     * @return self
     */
    public function setCode(?string $code): self
    {
        $this->initialized['code'] = true;
        $this->code = $code;
        return $this;
    }
    /**
     * Format with `{REF}` already resolved to this row's `external_ref`.
     *
     * @return string|null
     */
    public function getFormat(): ?string
    {
        return $this->format;
    }
    /**
     * Format with `{REF}` already resolved to this row's `external_ref`.
     *
     * @param string|null $format
     *
     * @return self
     */
    public function setFormat(?string $format): self
    {
        $this->initialized['format'] = true;
        $this->format = $format;
        return $this;
    }
    public function definedProperties(): array
    {
        return ['documentType' => ['document_type', 'getDocumentType', 'setDocumentType'], 'action' => ['action', 'getAction', 'setAction'], 'code' => ['code', 'getCode', 'setCode'], 'format' => ['format', 'getFormat', 'setFormat']];
    }
}