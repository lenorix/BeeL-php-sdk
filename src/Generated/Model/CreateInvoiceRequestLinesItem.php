<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;

class CreateInvoiceRequestLinesItem implements AdditionalPropertiesInterface
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
     * Description of invoiced concept. Required for NORMAL lines;
     * optional for SUPLIDO lines (may be empty or absent).
     *
     *
     * @var string
     */
    protected $description;

    /**
     * Product/service quantity (can be negative for franchises or discounts)
     *
     * @var float
     */
    protected $quantity;

    /**
     * @var string
     */
    protected $unit;

    /**
     * Unit price before taxes. `0` is accepted (a discount granted before or
     * simultaneously with the sale, e.g. a free introductory month).
     * Supports up to 4 decimal places for micro-pricing (e.g., €0.0897/unit for labels, packaging).
     *
     *
     * @var float
     */
    protected $unitPrice;

    /**
     * Declared line total excluding taxes (total-declared mode, e.g. 300 units
     * invoiced for exactly 1.00). The taxable base of the line is EXACTLY this
     * amount — it is never recalculated from the unit price. The unit price
     * becomes derived and informational (`total / quantity`, 4 decimals).
     * Each line must carry exactly one of `unit_price`, `total_excluding_tax`
     * or `total_including_tax` (anything else is rejected with
     * `LINE_UNIT_PRICE_XOR_DECLARED_TOTAL`). Incompatible with
     * `discount_percentage` (`LINE_DECLARED_TOTAL_FORBIDS_DISCOUNT`): any
     * discount is already included in the declared total. Can be negative
     * in corrective invoices.
     *
     *
     * @var float
     */
    protected $totalExcludingTax;

    /**
     * Declared line total including taxes (tax-inclusive total-declared
     * mode): what the customer paid for this line — taxable base + VAT +
     * equivalence surcharge. IRPF withholding is NOT part of it (it is a
     * retention, not price; it is computed on the derived base as usual).
     * The engine works the breakdown backwards from the unrounded base
     * (`base_raw = total / (1 + vat + surcharge)`, DGT V1919-18) so the
     * rounded amounts add up to the declared total exactly (e.g. 100.00
     * at 21% → 82.64 + 17.36 = 100.00). On exempt or 0% lines it is
     * equivalent to `total_excluding_tax` (base = total, quota 0).
     * Each line must carry exactly one of `unit_price`, `total_excluding_tax`
     * or `total_including_tax` (anything else is rejected with
     * `LINE_UNIT_PRICE_XOR_DECLARED_TOTAL`). Incompatible with
     * `discount_percentage` (`LINE_DECLARED_TOTAL_FORBIDS_DISCOUNT`).
     * Can be negative in corrective invoices.
     *
     *
     * @var float
     */
    protected $totalIncludingTax;

    /**
     * Discount percentage applied (0-100)
     *
     * @var float
     */
    protected $discountPercentage = 0;

    /**
     * Main tax of the line: regime (IVA/IGIC/IPSI/OTHER), percentage and regime key.
     *
     * **Mandatory on `NORMAL` lines.** It is never defaulted: omitting it is rejected
     * with `422 LINE_MAIN_TAX_REQUIRED`, and is never filled in from the company's
     * `default_main_tax` — that setting is a UI prefill, not an API default, because
     * which tax a line bears is a fiscal decision that drives the VeriFactu breakdown
     * and therefore the legal validity of the document.
     *
     * **Forbidden on `SUPLIDO` lines**, which are payments made on behalf of the
     * client and sit outside VAT (art. 78.Tres.3 LIVA): sending one is rejected with
     * `422 LINE_SUPLIDO_MUST_HAVE_NO_TAX`. That conditional obligation is why the
     * field is not listed under `required`: OpenAPI 3.0 cannot express "required
     * unless `line_type` is `SUPLIDO`".
     *
     * A 0 % under IVA or IPSI is not a rate but the exemption sentinel and needs an
     * `exemption_reason`; see `TaxInfo`.
     *
     *
     * @var CreateInvoiceRequestLinesItemMainTax
     */
    protected $mainTax;

    /**
     * Equivalence surcharge rate for this line.
     *
     * **Default behaviour:** if omitted and the company has
     * `apply_equivalence_surcharge: true` in its tax configuration,
     * the line inherits the surcharge — and its percentage is a legal
     * function of the line's VAT rate, not the configured default:
     * 21 ↔ 5.2, 10 ↔ 1.4, 5 ↔ 0.625, 4 ↔ 0.5 (the pairs enumerated by
     * `EquivalenceSurchargePercentage`). A company configured with
     * `default_equivalence_surcharge: 5.2` therefore produces 1.4 on a
     * 10% line, not 5.2.
     *
     * **The inheritance also rewrites the line's `regime_key` from `01`
     * to `18`** (special regime for equivalence surcharge). This is
     * deliberate: a surcharge and general regime `01` are fiscally
     * incoherent, so the line comes back as `18` even if `01` was sent.
     *
     * To issue a line **without** surcharge under such a company, send
     * `equivalence_surcharge_rate: 0` explicitly — exactly as with
     * `irpf_rate`: the `01` regime key is then respected and no
     * surcharge is applied. Sending an explicit rate greater than 0
     * together with `regime_key: "01"` is **not** rejected: the very
     * same rewrite applies and the line comes back as `18`.
     *
     * **Any other regime with a surcharge is rejected** with
     * `422 SURCHARGE_REQUIRES_REGIME`. Only the general regime `01`
     * **rewrites**; REBU (`03`), exports (`02`), OSS (`17`)… never do,
     * because a surcharge under them is fiscally invalid — an error to
     * surface, not a shorthand to normalise.
     *
     *
     * @var float
     */
    protected $equivalenceSurchargeRate;

    /**
     * IRPF withholding rate for this line.
     *
     * **Default behaviour:** if omitted, the line inherits the
     * account's default IRPF rate (configured in the tax profile,
     * e.g. 15%). To issue a line **without** withholding you must
     * send `irpf_rate: 0` explicitly. On SIMPLIFIED invoices (F2)
     * IRPF withholding is **not allowed** (AEAT forbids it on F2):
     * sending an `irpf_rate` other than 0 is **rejected** with
     * `SIMPLIFICADA_FORBIDS_IRPF` — it is not coerced to 0. Omit the
     * field or send `irpf_rate: 0` on F2 lines. On all other invoice
     * types an explicit value is always respected.
     *
     *
     * @var int
     */
    protected $irpfRate;

    /**
     * Tax exemption reason code per Spanish VAT Law (Ley 37/1992 LIVA).
     * VeriFactu mapping: EXENTA_ART_20→E1, EXENTA_ART_21→E2, EXENTA_ART_22→E3,
     * EXENTA_ART_24→E4, EXENTA_ART_25→E5, rest→E6. ISP→S2, NO_SUJETA→N1/N2.
     * When OTRO, a custom text must be provided in exemption_reason_text.
     *
     *
     * @var string
     */
    protected $exemptionReason;

    /**
     * Custom exemption text. Only used when exemption_reason is OTRO.
     *
     * @var string|null
     */
    protected $exemptionReasonText;

    /**
     * Fiscal line type. Defaults to `NORMAL`.
     * Use `SUPLIDO` for payments on behalf of the final client
     * (art. 78.Tres.3 LIVA). Requires `source_invoice_reference`.
     *
     *
     * @var string
     */
    protected $lineType = 'NORMAL';

    /**
     * Reference to the original invoice issued by the third party in the
     * client's name. Required when `line_type=SUPLIDO`.
     *
     *
     * @var string|null
     */
    protected $sourceInvoiceReference;

    /**
     * Ids of the issued invoices that make up the SUPLIDO. They may belong to the
     * issuing account or to accounts it manages with VIEW access.
     * Their sum is the amount (never typed). Audit traceability.
     *
     *
     * @var list<string>
     */
    protected $sourceInvoiceIds;

    /**
     * Description of invoiced concept. Required for NORMAL lines;
     * optional for SUPLIDO lines (may be empty or absent).
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * Description of invoiced concept. Required for NORMAL lines;
    optional for SUPLIDO lines (may be empty or absent).
     */
    public function setDescription(string $description): self
    {
        $this->initialized['description'] = true;
        $this->description = $description;

        return $this;
    }

    /**
     * Product/service quantity (can be negative for franchises or discounts)
     */
    public function getQuantity(): float
    {
        return $this->quantity;
    }

    /**
     * Product/service quantity (can be negative for franchises or discounts)
     */
    public function setQuantity(float $quantity): self
    {
        $this->initialized['quantity'] = true;
        $this->quantity = $quantity;

        return $this;
    }

    public function getUnit(): string
    {
        return $this->unit;
    }

    public function setUnit(string $unit): self
    {
        $this->initialized['unit'] = true;
        $this->unit = $unit;

        return $this;
    }

    /**
     * Unit price before taxes. `0` is accepted (a discount granted before or
     * simultaneously with the sale, e.g. a free introductory month).
     * Supports up to 4 decimal places for micro-pricing (e.g., €0.0897/unit for labels, packaging).
     */
    public function getUnitPrice(): float
    {
        return $this->unitPrice;
    }

    /**
     * Unit price before taxes. `0` is accepted (a discount granted before or
    simultaneously with the sale, e.g. a free introductory month).
    Supports up to 4 decimal places for micro-pricing (e.g., €0.0897/unit for labels, packaging).
     */
    public function setUnitPrice(float $unitPrice): self
    {
        $this->initialized['unitPrice'] = true;
        $this->unitPrice = $unitPrice;

        return $this;
    }

    /**
     * Declared line total excluding taxes (total-declared mode, e.g. 300 units
     * invoiced for exactly 1.00). The taxable base of the line is EXACTLY this
     * amount — it is never recalculated from the unit price. The unit price
     * becomes derived and informational (`total / quantity`, 4 decimals).
     * Each line must carry exactly one of `unit_price`, `total_excluding_tax`
     * or `total_including_tax` (anything else is rejected with
     * `LINE_UNIT_PRICE_XOR_DECLARED_TOTAL`). Incompatible with
     * `discount_percentage` (`LINE_DECLARED_TOTAL_FORBIDS_DISCOUNT`): any
     * discount is already included in the declared total. Can be negative
     * in corrective invoices.
     */
    public function getTotalExcludingTax(): float
    {
        return $this->totalExcludingTax;
    }

    /**
     * Declared line total excluding taxes (total-declared mode, e.g. 300 units
    invoiced for exactly 1.00). The taxable base of the line is EXACTLY this
    amount — it is never recalculated from the unit price. The unit price
    becomes derived and informational (`total / quantity`, 4 decimals).
    Each line must carry exactly one of `unit_price`, `total_excluding_tax`
    or `total_including_tax` (anything else is rejected with
    `LINE_UNIT_PRICE_XOR_DECLARED_TOTAL`). Incompatible with
    `discount_percentage` (`LINE_DECLARED_TOTAL_FORBIDS_DISCOUNT`): any
    discount is already included in the declared total. Can be negative
    in corrective invoices.
     */
    public function setTotalExcludingTax(float $totalExcludingTax): self
    {
        $this->initialized['totalExcludingTax'] = true;
        $this->totalExcludingTax = $totalExcludingTax;

        return $this;
    }

    /**
     * Declared line total including taxes (tax-inclusive total-declared
     * mode): what the customer paid for this line — taxable base + VAT +
     * equivalence surcharge. IRPF withholding is NOT part of it (it is a
     * retention, not price; it is computed on the derived base as usual).
     * The engine works the breakdown backwards from the unrounded base
     * (`base_raw = total / (1 + vat + surcharge)`, DGT V1919-18) so the
     * rounded amounts add up to the declared total exactly (e.g. 100.00
     * at 21% → 82.64 + 17.36 = 100.00). On exempt or 0% lines it is
     * equivalent to `total_excluding_tax` (base = total, quota 0).
     * Each line must carry exactly one of `unit_price`, `total_excluding_tax`
     * or `total_including_tax` (anything else is rejected with
     * `LINE_UNIT_PRICE_XOR_DECLARED_TOTAL`). Incompatible with
     * `discount_percentage` (`LINE_DECLARED_TOTAL_FORBIDS_DISCOUNT`).
     * Can be negative in corrective invoices.
     */
    public function getTotalIncludingTax(): float
    {
        return $this->totalIncludingTax;
    }

    /**
     * Declared line total including taxes (tax-inclusive total-declared
    mode): what the customer paid for this line — taxable base + VAT +
    equivalence surcharge. IRPF withholding is NOT part of it (it is a
    retention, not price; it is computed on the derived base as usual).
    The engine works the breakdown backwards from the unrounded base
    (`base_raw = total / (1 + vat + surcharge)`, DGT V1919-18) so the
    rounded amounts add up to the declared total exactly (e.g. 100.00
    at 21% → 82.64 + 17.36 = 100.00). On exempt or 0% lines it is
    equivalent to `total_excluding_tax` (base = total, quota 0).
    Each line must carry exactly one of `unit_price`, `total_excluding_tax`
    or `total_including_tax` (anything else is rejected with
    `LINE_UNIT_PRICE_XOR_DECLARED_TOTAL`). Incompatible with
    `discount_percentage` (`LINE_DECLARED_TOTAL_FORBIDS_DISCOUNT`).
    Can be negative in corrective invoices.
     */
    public function setTotalIncludingTax(float $totalIncludingTax): self
    {
        $this->initialized['totalIncludingTax'] = true;
        $this->totalIncludingTax = $totalIncludingTax;

        return $this;
    }

    /**
     * Discount percentage applied (0-100)
     */
    public function getDiscountPercentage(): float
    {
        return $this->discountPercentage;
    }

    /**
     * Discount percentage applied (0-100)
     */
    public function setDiscountPercentage(float $discountPercentage): self
    {
        $this->initialized['discountPercentage'] = true;
        $this->discountPercentage = $discountPercentage;

        return $this;
    }

    /**
     * Main tax of the line: regime (IVA/IGIC/IPSI/OTHER), percentage and regime key.
     *
     * **Mandatory on `NORMAL` lines.** It is never defaulted: omitting it is rejected
     * with `422 LINE_MAIN_TAX_REQUIRED`, and is never filled in from the company's
     * `default_main_tax` — that setting is a UI prefill, not an API default, because
     * which tax a line bears is a fiscal decision that drives the VeriFactu breakdown
     * and therefore the legal validity of the document.
     *
     * **Forbidden on `SUPLIDO` lines**, which are payments made on behalf of the
     * client and sit outside VAT (art. 78.Tres.3 LIVA): sending one is rejected with
     * `422 LINE_SUPLIDO_MUST_HAVE_NO_TAX`. That conditional obligation is why the
     * field is not listed under `required`: OpenAPI 3.0 cannot express "required
     * unless `line_type` is `SUPLIDO`".
     *
     * A 0 % under IVA or IPSI is not a rate but the exemption sentinel and needs an
     * `exemption_reason`; see `TaxInfo`.
     */
    public function getMainTax(): CreateInvoiceRequestLinesItemMainTax
    {
        return $this->mainTax;
    }

    /**
     * Main tax of the line: regime (IVA/IGIC/IPSI/OTHER), percentage and regime key.

     **Mandatory on `NORMAL` lines.** It is never defaulted: omitting it is rejected
    with `422 LINE_MAIN_TAX_REQUIRED`, and is never filled in from the company's
    `default_main_tax` — that setting is a UI prefill, not an API default, because
    which tax a line bears is a fiscal decision that drives the VeriFactu breakdown
    and therefore the legal validity of the document.

     **Forbidden on `SUPLIDO` lines**, which are payments made on behalf of the
    client and sit outside VAT (art. 78.Tres.3 LIVA): sending one is rejected with
    `422 LINE_SUPLIDO_MUST_HAVE_NO_TAX`. That conditional obligation is why the
    field is not listed under `required`: OpenAPI 3.0 cannot express "required
    unless `line_type` is `SUPLIDO`".

    A 0 % under IVA or IPSI is not a rate but the exemption sentinel and needs an
    `exemption_reason`; see `TaxInfo`.
     */
    public function setMainTax(CreateInvoiceRequestLinesItemMainTax $mainTax): self
    {
        $this->initialized['mainTax'] = true;
        $this->mainTax = $mainTax;

        return $this;
    }

    /**
     * Equivalence surcharge rate for this line.
     *
     * **Default behaviour:** if omitted and the company has
     * `apply_equivalence_surcharge: true` in its tax configuration,
     * the line inherits the surcharge — and its percentage is a legal
     * function of the line's VAT rate, not the configured default:
     * 21 ↔ 5.2, 10 ↔ 1.4, 5 ↔ 0.625, 4 ↔ 0.5 (the pairs enumerated by
     * `EquivalenceSurchargePercentage`). A company configured with
     * `default_equivalence_surcharge: 5.2` therefore produces 1.4 on a
     * 10% line, not 5.2.
     *
     * **The inheritance also rewrites the line's `regime_key` from `01`
     * to `18`** (special regime for equivalence surcharge). This is
     * deliberate: a surcharge and general regime `01` are fiscally
     * incoherent, so the line comes back as `18` even if `01` was sent.
     *
     * To issue a line **without** surcharge under such a company, send
     * `equivalence_surcharge_rate: 0` explicitly — exactly as with
     * `irpf_rate`: the `01` regime key is then respected and no
     * surcharge is applied. Sending an explicit rate greater than 0
     * together with `regime_key: "01"` is **not** rejected: the very
     * same rewrite applies and the line comes back as `18`.
     *
     * **Any other regime with a surcharge is rejected** with
     * `422 SURCHARGE_REQUIRES_REGIME`. Only the general regime `01`
     * **rewrites**; REBU (`03`), exports (`02`), OSS (`17`)… never do,
     * because a surcharge under them is fiscally invalid — an error to
     * surface, not a shorthand to normalise.
     */
    public function getEquivalenceSurchargeRate(): float
    {
        return $this->equivalenceSurchargeRate;
    }

    /**
     * Equivalence surcharge rate for this line.

     **Default behaviour:** if omitted and the company has
    `apply_equivalence_surcharge: true` in its tax configuration,
    the line inherits the surcharge — and its percentage is a legal
    function of the line's VAT rate, not the configured default:
    21 ↔ 5.2, 10 ↔ 1.4, 5 ↔ 0.625, 4 ↔ 0.5 (the pairs enumerated by
    `EquivalenceSurchargePercentage`). A company configured with
    `default_equivalence_surcharge: 5.2` therefore produces 1.4 on a
    10% line, not 5.2.

     **The inheritance also rewrites the line's `regime_key` from `01`
    to `18`** (special regime for equivalence surcharge). This is
    deliberate: a surcharge and general regime `01` are fiscally
    incoherent, so the line comes back as `18` even if `01` was sent.

    To issue a line **without** surcharge under such a company, send
    `equivalence_surcharge_rate: 0` explicitly — exactly as with
    `irpf_rate`: the `01` regime key is then respected and no
    surcharge is applied. Sending an explicit rate greater than 0
    together with `regime_key: "01"` is **not** rejected: the very
    same rewrite applies and the line comes back as `18`.

     **Any other regime with a surcharge is rejected** with
    `422 SURCHARGE_REQUIRES_REGIME`. Only the general regime `01`
     **rewrites**; REBU (`03`), exports (`02`), OSS (`17`)… never do,
    because a surcharge under them is fiscally invalid — an error to
    surface, not a shorthand to normalise.
     */
    public function setEquivalenceSurchargeRate(float $equivalenceSurchargeRate): self
    {
        $this->initialized['equivalenceSurchargeRate'] = true;
        $this->equivalenceSurchargeRate = $equivalenceSurchargeRate;

        return $this;
    }

    /**
     * IRPF withholding rate for this line.
     *
     * **Default behaviour:** if omitted, the line inherits the
     * account's default IRPF rate (configured in the tax profile,
     * e.g. 15%). To issue a line **without** withholding you must
     * send `irpf_rate: 0` explicitly. On SIMPLIFIED invoices (F2)
     * IRPF withholding is **not allowed** (AEAT forbids it on F2):
     * sending an `irpf_rate` other than 0 is **rejected** with
     * `SIMPLIFICADA_FORBIDS_IRPF` — it is not coerced to 0. Omit the
     * field or send `irpf_rate: 0` on F2 lines. On all other invoice
     * types an explicit value is always respected.
     */
    public function getIrpfRate(): int
    {
        return $this->irpfRate;
    }

    /**
     * IRPF withholding rate for this line.

     **Default behaviour:** if omitted, the line inherits the
    account's default IRPF rate (configured in the tax profile,
    e.g. 15%). To issue a line **without** withholding you must
    send `irpf_rate: 0` explicitly. On SIMPLIFIED invoices (F2)
    IRPF withholding is **not allowed** (AEAT forbids it on F2):
    sending an `irpf_rate` other than 0 is **rejected** with
    `SIMPLIFICADA_FORBIDS_IRPF` — it is not coerced to 0. Omit the
    field or send `irpf_rate: 0` on F2 lines. On all other invoice
    types an explicit value is always respected.
     */
    public function setIrpfRate(int $irpfRate): self
    {
        $this->initialized['irpfRate'] = true;
        $this->irpfRate = $irpfRate;

        return $this;
    }

    /**
     * Tax exemption reason code per Spanish VAT Law (Ley 37/1992 LIVA).
     * VeriFactu mapping: EXENTA_ART_20→E1, EXENTA_ART_21→E2, EXENTA_ART_22→E3,
     * EXENTA_ART_24→E4, EXENTA_ART_25→E5, rest→E6. ISP→S2, NO_SUJETA→N1/N2.
     * When OTRO, a custom text must be provided in exemption_reason_text.
     */
    public function getExemptionReason(): string
    {
        return $this->exemptionReason;
    }

    /**
     * Tax exemption reason code per Spanish VAT Law (Ley 37/1992 LIVA).
    VeriFactu mapping: EXENTA_ART_20→E1, EXENTA_ART_21→E2, EXENTA_ART_22→E3,
    EXENTA_ART_24→E4, EXENTA_ART_25→E5, rest→E6. ISP→S2, NO_SUJETA→N1/N2.
    When OTRO, a custom text must be provided in exemption_reason_text.
     */
    public function setExemptionReason(string $exemptionReason): self
    {
        $this->initialized['exemptionReason'] = true;
        $this->exemptionReason = $exemptionReason;

        return $this;
    }

    /**
     * Custom exemption text. Only used when exemption_reason is OTRO.
     */
    public function getExemptionReasonText(): ?string
    {
        return $this->exemptionReasonText;
    }

    /**
     * Custom exemption text. Only used when exemption_reason is OTRO.
     */
    public function setExemptionReasonText(?string $exemptionReasonText): self
    {
        $this->initialized['exemptionReasonText'] = true;
        $this->exemptionReasonText = $exemptionReasonText;

        return $this;
    }

    /**
     * Fiscal line type. Defaults to `NORMAL`.
     * Use `SUPLIDO` for payments on behalf of the final client
     * (art. 78.Tres.3 LIVA). Requires `source_invoice_reference`.
     */
    public function getLineType(): string
    {
        return $this->lineType;
    }

    /**
     * Fiscal line type. Defaults to `NORMAL`.
    Use `SUPLIDO` for payments on behalf of the final client
    (art. 78.Tres.3 LIVA). Requires `source_invoice_reference`.
     */
    public function setLineType(string $lineType): self
    {
        $this->initialized['lineType'] = true;
        $this->lineType = $lineType;

        return $this;
    }

    /**
     * Reference to the original invoice issued by the third party in the
     * client's name. Required when `line_type=SUPLIDO`.
     */
    public function getSourceInvoiceReference(): ?string
    {
        return $this->sourceInvoiceReference;
    }

    /**
     * Reference to the original invoice issued by the third party in the
    client's name. Required when `line_type=SUPLIDO`.
     */
    public function setSourceInvoiceReference(?string $sourceInvoiceReference): self
    {
        $this->initialized['sourceInvoiceReference'] = true;
        $this->sourceInvoiceReference = $sourceInvoiceReference;

        return $this;
    }

    /**
     * Ids of the issued invoices that make up the SUPLIDO. They may belong to the
     * issuing account or to accounts it manages with VIEW access.
     * Their sum is the amount (never typed). Audit traceability.
     *
     *
     * @return list<string>
     */
    public function getSourceInvoiceIds(): array
    {
        return $this->sourceInvoiceIds;
    }

    /**
     * Ids of the issued invoices that make up the SUPLIDO. They may belong to the
    issuing account or to accounts it manages with VIEW access.
    Their sum is the amount (never typed). Audit traceability.

     *
     * @param  list<string>  $sourceInvoiceIds
     */
    public function setSourceInvoiceIds(array $sourceInvoiceIds): self
    {
        $this->initialized['sourceInvoiceIds'] = true;
        $this->sourceInvoiceIds = $sourceInvoiceIds;

        return $this;
    }

    public function definedProperties(): array
    {
        return ['description' => ['description', 'getDescription', 'setDescription'], 'quantity' => ['quantity', 'getQuantity', 'setQuantity'], 'unit' => ['unit', 'getUnit', 'setUnit'], 'unitPrice' => ['unit_price', 'getUnitPrice', 'setUnitPrice'], 'totalExcludingTax' => ['total_excluding_tax', 'getTotalExcludingTax', 'setTotalExcludingTax'], 'totalIncludingTax' => ['total_including_tax', 'getTotalIncludingTax', 'setTotalIncludingTax'], 'discountPercentage' => ['discount_percentage', 'getDiscountPercentage', 'setDiscountPercentage'], 'mainTax' => ['main_tax', 'getMainTax', 'setMainTax'], 'equivalenceSurchargeRate' => ['equivalence_surcharge_rate', 'getEquivalenceSurchargeRate', 'setEquivalenceSurchargeRate'], 'irpfRate' => ['irpf_rate', 'getIrpfRate', 'setIrpfRate'], 'exemptionReason' => ['exemption_reason', 'getExemptionReason', 'setExemptionReason'], 'exemptionReasonText' => ['exemption_reason_text', 'getExemptionReasonText', 'setExemptionReasonText'], 'lineType' => ['line_type', 'getLineType', 'setLineType'], 'sourceInvoiceReference' => ['source_invoice_reference', 'getSourceInvoiceReference', 'setSourceInvoiceReference'], 'sourceInvoiceIds' => ['source_invoice_ids', 'getSourceInvoiceIds', 'setSourceInvoiceIds']];
    }
}
