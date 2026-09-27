<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;

class ExemptionReasonCatalogEntry implements AdditionalPropertiesInterface
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
     * Enum value to send in invoice line exemption_reason field
     *
     * @var string
     */
    protected $code;

    /**
     * i18n key for the label (resolve via translations)
     *
     * @var string
     */
    protected $label;

    /**
     * i18n key for the description
     *
     * @var string
     */
    protected $description;

    /**
     * Category grouping for UI display
     *
     * @var string
     */
    protected $category;

    /**
     * Tax classification type that determines VeriFactu behavior:
     * - EXENTA: Exempt operation (E1-E6), no tax fields
     * - NO_SUJETA: Not subject to tax (N1), no tax fields
     * - NO_SUJETA_LOCALIZACION: Not subject by localization rules (N2), no tax fields
     * - SUJETA_NO_EXENTA_ISP: Reverse charge (S2), tax rate forced to 0%
     * - SUJETA_NO_EXENTA: Normal taxed (S1), requires tax rate
     *
     *
     * @var string
     */
    protected $classificationType;

    /**
     * Whether a NIF can declare this reason as its **default exemption** in
     * `PUT /v1/configuration/taxes`, or only per invoice line.
     *
     * Only the reasons the issuer verifies on its own qualify (`EXENTA_ART_20` and
     * `OTRO`). The ones depending on the recipient or the operation would assert a
     * fact — printed as a legal mention on every PDF — that nobody checked, and the
     * `REGIMEN_ART_*` ones are already derived from the stored regime key.
     *
     *
     * @var bool
     */
    protected $availableAsDefault;

    /**
     * Whether this reason can actually be sent in an invoice line's `exemption_reason`.
     *
     * Some reasons are published but not accepted: they are special-regime codes that do
     * not travel in VeriFactu's `operacion_exenta`, so the API rejects them on POST. They
     * are still listed —**marked, not removed**— because this catalogue also translates
     * codes that are already stored on past invoices.
     *
     * **Which ones is deliberately not written here.** Read this flag per entry instead of
     * hard-coding a list: it is derived from the same VeriFactu catalogue that decides the
     * rejection, so it follows AEAT the day the set changes — a list copied into prose (or
     * into your code) would not.
     *
     *
     * @var bool
     */
    protected $availableOnInvoiceLine;

    /**
     * Enum value to send in invoice line exemption_reason field
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * Enum value to send in invoice line exemption_reason field
     */
    public function setCode(string $code): self
    {
        $this->initialized['code'] = true;
        $this->code = $code;

        return $this;
    }

    /**
     * i18n key for the label (resolve via translations)
     */
    public function getLabel(): string
    {
        return $this->label;
    }

    /**
     * i18n key for the label (resolve via translations)
     */
    public function setLabel(string $label): self
    {
        $this->initialized['label'] = true;
        $this->label = $label;

        return $this;
    }

    /**
     * i18n key for the description
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * i18n key for the description
     */
    public function setDescription(string $description): self
    {
        $this->initialized['description'] = true;
        $this->description = $description;

        return $this;
    }

    /**
     * Category grouping for UI display
     */
    public function getCategory(): string
    {
        return $this->category;
    }

    /**
     * Category grouping for UI display
     */
    public function setCategory(string $category): self
    {
        $this->initialized['category'] = true;
        $this->category = $category;

        return $this;
    }

    /**
     * Tax classification type that determines VeriFactu behavior:
     * - EXENTA: Exempt operation (E1-E6), no tax fields
     * - NO_SUJETA: Not subject to tax (N1), no tax fields
     * - NO_SUJETA_LOCALIZACION: Not subject by localization rules (N2), no tax fields
     * - SUJETA_NO_EXENTA_ISP: Reverse charge (S2), tax rate forced to 0%
     * - SUJETA_NO_EXENTA: Normal taxed (S1), requires tax rate
     */
    public function getClassificationType(): string
    {
        return $this->classificationType;
    }

    /**
     * Tax classification type that determines VeriFactu behavior:
    - EXENTA: Exempt operation (E1-E6), no tax fields
    - NO_SUJETA: Not subject to tax (N1), no tax fields
    - NO_SUJETA_LOCALIZACION: Not subject by localization rules (N2), no tax fields
    - SUJETA_NO_EXENTA_ISP: Reverse charge (S2), tax rate forced to 0%
    - SUJETA_NO_EXENTA: Normal taxed (S1), requires tax rate
     */
    public function setClassificationType(string $classificationType): self
    {
        $this->initialized['classificationType'] = true;
        $this->classificationType = $classificationType;

        return $this;
    }

    /**
     * Whether a NIF can declare this reason as its **default exemption** in
     * `PUT /v1/configuration/taxes`, or only per invoice line.
     *
     * Only the reasons the issuer verifies on its own qualify (`EXENTA_ART_20` and
     * `OTRO`). The ones depending on the recipient or the operation would assert a
     * fact — printed as a legal mention on every PDF — that nobody checked, and the
     * `REGIMEN_ART_*` ones are already derived from the stored regime key.
     */
    public function getAvailableAsDefault(): bool
    {
        return $this->availableAsDefault;
    }

    /**
     * Whether a NIF can declare this reason as its **default exemption** in
    `PUT /v1/configuration/taxes`, or only per invoice line.

    Only the reasons the issuer verifies on its own qualify (`EXENTA_ART_20` and
    `OTRO`). The ones depending on the recipient or the operation would assert a
    fact — printed as a legal mention on every PDF — that nobody checked, and the
    `REGIMEN_ART_*` ones are already derived from the stored regime key.
     */
    public function setAvailableAsDefault(bool $availableAsDefault): self
    {
        $this->initialized['availableAsDefault'] = true;
        $this->availableAsDefault = $availableAsDefault;

        return $this;
    }

    /**
     * Whether this reason can actually be sent in an invoice line's `exemption_reason`.
     *
     * Some reasons are published but not accepted: they are special-regime codes that do
     * not travel in VeriFactu's `operacion_exenta`, so the API rejects them on POST. They
     * are still listed —**marked, not removed**— because this catalogue also translates
     * codes that are already stored on past invoices.
     *
     * **Which ones is deliberately not written here.** Read this flag per entry instead of
     * hard-coding a list: it is derived from the same VeriFactu catalogue that decides the
     * rejection, so it follows AEAT the day the set changes — a list copied into prose (or
     * into your code) would not.
     */
    public function getAvailableOnInvoiceLine(): bool
    {
        return $this->availableOnInvoiceLine;
    }

    /**
     * Whether this reason can actually be sent in an invoice line's `exemption_reason`.

    Some reasons are published but not accepted: they are special-regime codes that do
    not travel in VeriFactu's `operacion_exenta`, so the API rejects them on POST. They
    are still listed —**marked, not removed**— because this catalogue also translates
    codes that are already stored on past invoices.

     **Which ones is deliberately not written here.** Read this flag per entry instead of
    hard-coding a list: it is derived from the same VeriFactu catalogue that decides the
    rejection, so it follows AEAT the day the set changes — a list copied into prose (or
    into your code) would not.
     */
    public function setAvailableOnInvoiceLine(bool $availableOnInvoiceLine): self
    {
        $this->initialized['availableOnInvoiceLine'] = true;
        $this->availableOnInvoiceLine = $availableOnInvoiceLine;

        return $this;
    }

    public function definedProperties(): array
    {
        return ['code' => ['code', 'getCode', 'setCode'], 'label' => ['label', 'getLabel', 'setLabel'], 'description' => ['description', 'getDescription', 'setDescription'], 'category' => ['category', 'getCategory', 'setCategory'], 'classificationType' => ['classification_type', 'getClassificationType', 'setClassificationType'], 'availableAsDefault' => ['available_as_default', 'getAvailableAsDefault', 'setAvailableAsDefault'], 'availableOnInvoiceLine' => ['available_on_invoice_line', 'getAvailableOnInvoiceLine', 'setAvailableOnInvoiceLine']];
    }
}
