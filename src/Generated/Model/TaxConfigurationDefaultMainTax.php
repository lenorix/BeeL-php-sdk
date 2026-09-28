<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;
class TaxConfigurationDefaultMainTax implements AdditionalPropertiesInterface
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
     * Tax type by territory:
     * - IVA: Iberian Peninsula and Balearic Islands (4%, 10%, 21%; 2%, 5% and 7.5% only on operations of their period)
     * - IGIC: Canary Islands (0%, 3%, 5%, 7%, 9.5%, 15%, 20%)
     * - IPSI: Ceuta and Melilla (0.5%, 1%, 2%, 4%, 8%, 10%)
     * - OTHER: Configurable 0%-100%
     * 
     * Under IVA and IPSI, 0% is not one of these rates: it is the exemption/non-subject
     * sentinel and always travels with an `exemption_reason`. IGIC's 0% is a real rate.
     * See `TaxInfo` for the full rules.
     * 
     *
     * @var string
     */
    protected $type;
    /**
     * Tax percentage
     *
     * @var float
     */
    protected $percentage;
    /**
     * Regime key according to VeriFactu regulations. Omitted, `01` (general regime) applies:
     * - 01: General regime operation
     * - 02: Export (IVA and IGIC; not IPSI, whose AEAT list is `01, 08, 11, 18, 19, 20`)
     * - 03: Used goods, art, antiques (not accepted, see below)
     * - 04: Investment gold
     * - 05: Travel agencies
     * - 06: Group of entities (not accepted, see below)
     * - 07: Cash basis
     * - 08: Operation subject to another indirect tax — IPSI or IGIC on an IVA line, IPSI or IVA
     *   on an IGIC line. It is **not** the general regime of IGIC, which is `01`.
     * - 09: Mediating agencies
     * - 10: Third-party collections
     * - 11: Local rental
     * - 14: VAT pending in certifications (not accepted, see below)
     * - 15: VAT pending successive tract
     * - 17: OSS and IOSS
     * - 18: Equivalence surcharge
     * - 19: REAGYP
     * - 20: Simplified regime
     * 
     * **What AEAT requires with each key** (Validaciones VERI*FACTU 3.1.3.15.6), checked on
     * IVA and IGIC lines before the invoice is numbered. Otherwise the request is rejected with
     * `422` and the code in brackets:
     * - `04`: only reverse charge (an `ISP_ART_84_2_*` reason) or an exemption
     *   (`REGIME_KEY_CLASSIFICATION_NOT_ACCEPTED`).
     * - `08`: only `exemption_reason: NO_SUJETA_LOCALIZACION`, at 0 %
     *   (`REGIME_KEY_CLASSIFICATION_NOT_ACCEPTED`).
     * - `10`: only `exemption_reason: NO_SUJETA_ART_7_9`, on a `STANDARD` invoice whose
     *   recipient has a `nif` (`REGIME_KEY_CLASSIFICATION_NOT_ACCEPTED`,
     *   `REGIME_KEY_REQUIRES_STANDARD_INVOICE`, `REGIME_KEY_REQUIRES_RECIPIENT_NIF`).
     * - `11` (IVA): a subject line only at 21 %, and no reverse charge
     *   (`REGIME_KEY_REQUIRES_VAT_RATE`, `REGIME_KEY_CLASSIFICATION_NOT_ACCEPTED`).
     * - `06` and `14` are not accepted (`REGIME_KEY_NOT_SUPPORTED`): AEAT requires with them
     *   data the invoice does not carry (a cost-based taxable base; an operation date after the
     *   issue date and a public-administration recipient).
     * - `03` (used goods) is not accepted (`REGIME_KEY_NOT_SUPPORTED`): under it the invoice
     *   must not show the tax separately (RD 1619/2012, art. 16.2.c), and it always does. The
     *   corrective of an invoice that already carried `03` keeps it.
     * - `05` (travel agencies) and `07` (cash basis) are accepted, and the invoice PDF carries
     *   the mention of their regime (RD 1619/2012, art. 6.1 n and p). `07`: no reverse charge,
     *   no non-subject reason and, of the exemptions, only art. 20 or `OTRO`
     *   (`REGIME_KEY_CLASSIFICATION_NOT_ACCEPTED`).
     * `GET /v1/tax-types` only offers the keys that are accepted.
     * 
     * **One exception to "a key you send is the key you get":** when the line ends up
     * carrying an equivalence surcharge — whether you sent `equivalence_surcharge_rate`
     * or it was inherited from the company's tax configuration — a `01` is rewritten to
     * `18`, because a surcharge under the general regime is fiscally incoherent. Send
     * `equivalence_surcharge_rate: 0` explicitly to keep `01`. See
     * `equivalence_surcharge_rate` in the invoice line for the full rules.
     * 
     *
     * @var string
     */
    protected $regimeKey;
    /**
     * Tax type by territory:
     * - IVA: Iberian Peninsula and Balearic Islands (4%, 10%, 21%; 2%, 5% and 7.5% only on operations of their period)
     * - IGIC: Canary Islands (0%, 3%, 5%, 7%, 9.5%, 15%, 20%)
     * - IPSI: Ceuta and Melilla (0.5%, 1%, 2%, 4%, 8%, 10%)
     * - OTHER: Configurable 0%-100%
     * 
     * Under IVA and IPSI, 0% is not one of these rates: it is the exemption/non-subject
     * sentinel and always travels with an `exemption_reason`. IGIC's 0% is a real rate.
     * See `TaxInfo` for the full rules.
     * 
     *
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }
    /**
    * Tax type by territory:
    - IVA: Iberian Peninsula and Balearic Islands (4%, 10%, 21%; 2%, 5% and 7.5% only on operations of their period)
    - IGIC: Canary Islands (0%, 3%, 5%, 7%, 9.5%, 15%, 20%)
    - IPSI: Ceuta and Melilla (0.5%, 1%, 2%, 4%, 8%, 10%)
    - OTHER: Configurable 0%-100%
    
    Under IVA and IPSI, 0% is not one of these rates: it is the exemption/non-subject
    sentinel and always travels with an `exemption_reason`. IGIC's 0% is a real rate.
    See `TaxInfo` for the full rules.
    
    *
    * @param string $type
    *
    * @return self
    */
    public function setType(string $type): self
    {
        $this->initialized['type'] = true;
        $this->type = $type;
        return $this;
    }
    /**
     * Tax percentage
     *
     * @return float
     */
    public function getPercentage(): float
    {
        return $this->percentage;
    }
    /**
     * Tax percentage
     *
     * @param float $percentage
     *
     * @return self
     */
    public function setPercentage(float $percentage): self
    {
        $this->initialized['percentage'] = true;
        $this->percentage = $percentage;
        return $this;
    }
    /**
     * Regime key according to VeriFactu regulations. Omitted, `01` (general regime) applies:
     * - 01: General regime operation
     * - 02: Export (IVA and IGIC; not IPSI, whose AEAT list is `01, 08, 11, 18, 19, 20`)
     * - 03: Used goods, art, antiques (not accepted, see below)
     * - 04: Investment gold
     * - 05: Travel agencies
     * - 06: Group of entities (not accepted, see below)
     * - 07: Cash basis
     * - 08: Operation subject to another indirect tax — IPSI or IGIC on an IVA line, IPSI or IVA
     *   on an IGIC line. It is **not** the general regime of IGIC, which is `01`.
     * - 09: Mediating agencies
     * - 10: Third-party collections
     * - 11: Local rental
     * - 14: VAT pending in certifications (not accepted, see below)
     * - 15: VAT pending successive tract
     * - 17: OSS and IOSS
     * - 18: Equivalence surcharge
     * - 19: REAGYP
     * - 20: Simplified regime
     * 
     * **What AEAT requires with each key** (Validaciones VERI*FACTU 3.1.3.15.6), checked on
     * IVA and IGIC lines before the invoice is numbered. Otherwise the request is rejected with
     * `422` and the code in brackets:
     * - `04`: only reverse charge (an `ISP_ART_84_2_*` reason) or an exemption
     *   (`REGIME_KEY_CLASSIFICATION_NOT_ACCEPTED`).
     * - `08`: only `exemption_reason: NO_SUJETA_LOCALIZACION`, at 0 %
     *   (`REGIME_KEY_CLASSIFICATION_NOT_ACCEPTED`).
     * - `10`: only `exemption_reason: NO_SUJETA_ART_7_9`, on a `STANDARD` invoice whose
     *   recipient has a `nif` (`REGIME_KEY_CLASSIFICATION_NOT_ACCEPTED`,
     *   `REGIME_KEY_REQUIRES_STANDARD_INVOICE`, `REGIME_KEY_REQUIRES_RECIPIENT_NIF`).
     * - `11` (IVA): a subject line only at 21 %, and no reverse charge
     *   (`REGIME_KEY_REQUIRES_VAT_RATE`, `REGIME_KEY_CLASSIFICATION_NOT_ACCEPTED`).
     * - `06` and `14` are not accepted (`REGIME_KEY_NOT_SUPPORTED`): AEAT requires with them
     *   data the invoice does not carry (a cost-based taxable base; an operation date after the
     *   issue date and a public-administration recipient).
     * - `03` (used goods) is not accepted (`REGIME_KEY_NOT_SUPPORTED`): under it the invoice
     *   must not show the tax separately (RD 1619/2012, art. 16.2.c), and it always does. The
     *   corrective of an invoice that already carried `03` keeps it.
     * - `05` (travel agencies) and `07` (cash basis) are accepted, and the invoice PDF carries
     *   the mention of their regime (RD 1619/2012, art. 6.1 n and p). `07`: no reverse charge,
     *   no non-subject reason and, of the exemptions, only art. 20 or `OTRO`
     *   (`REGIME_KEY_CLASSIFICATION_NOT_ACCEPTED`).
     * `GET /v1/tax-types` only offers the keys that are accepted.
     * 
     * **One exception to "a key you send is the key you get":** when the line ends up
     * carrying an equivalence surcharge — whether you sent `equivalence_surcharge_rate`
     * or it was inherited from the company's tax configuration — a `01` is rewritten to
     * `18`, because a surcharge under the general regime is fiscally incoherent. Send
     * `equivalence_surcharge_rate: 0` explicitly to keep `01`. See
     * `equivalence_surcharge_rate` in the invoice line for the full rules.
     * 
     *
     * @return string
     */
    public function getRegimeKey(): string
    {
        return $this->regimeKey;
    }
    /**
    * Regime key according to VeriFactu regulations. Omitted, `01` (general regime) applies:
    - 01: General regime operation
    - 02: Export (IVA and IGIC; not IPSI, whose AEAT list is `01, 08, 11, 18, 19, 20`)
    - 03: Used goods, art, antiques (not accepted, see below)
    - 04: Investment gold
    - 05: Travel agencies
    - 06: Group of entities (not accepted, see below)
    - 07: Cash basis
    - 08: Operation subject to another indirect tax — IPSI or IGIC on an IVA line, IPSI or IVA
     on an IGIC line. It is **not** the general regime of IGIC, which is `01`.
    - 09: Mediating agencies
    - 10: Third-party collections
    - 11: Local rental
    - 14: VAT pending in certifications (not accepted, see below)
    - 15: VAT pending successive tract
    - 17: OSS and IOSS
    - 18: Equivalence surcharge
    - 19: REAGYP
    - 20: Simplified regime
    
    **What AEAT requires with each key** (Validaciones VERI*FACTU 3.1.3.15.6), checked on
    IVA and IGIC lines before the invoice is numbered. Otherwise the request is rejected with
    `422` and the code in brackets:
    - `04`: only reverse charge (an `ISP_ART_84_2_*` reason) or an exemption
     (`REGIME_KEY_CLASSIFICATION_NOT_ACCEPTED`).
    - `08`: only `exemption_reason: NO_SUJETA_LOCALIZACION`, at 0 %
     (`REGIME_KEY_CLASSIFICATION_NOT_ACCEPTED`).
    - `10`: only `exemption_reason: NO_SUJETA_ART_7_9`, on a `STANDARD` invoice whose
     recipient has a `nif` (`REGIME_KEY_CLASSIFICATION_NOT_ACCEPTED`,
     `REGIME_KEY_REQUIRES_STANDARD_INVOICE`, `REGIME_KEY_REQUIRES_RECIPIENT_NIF`).
    - `11` (IVA): a subject line only at 21 %, and no reverse charge
     (`REGIME_KEY_REQUIRES_VAT_RATE`, `REGIME_KEY_CLASSIFICATION_NOT_ACCEPTED`).
    - `06` and `14` are not accepted (`REGIME_KEY_NOT_SUPPORTED`): AEAT requires with them
     data the invoice does not carry (a cost-based taxable base; an operation date after the
     issue date and a public-administration recipient).
    - `03` (used goods) is not accepted (`REGIME_KEY_NOT_SUPPORTED`): under it the invoice
     must not show the tax separately (RD 1619/2012, art. 16.2.c), and it always does. The
     corrective of an invoice that already carried `03` keeps it.
    - `05` (travel agencies) and `07` (cash basis) are accepted, and the invoice PDF carries
     the mention of their regime (RD 1619/2012, art. 6.1 n and p). `07`: no reverse charge,
     no non-subject reason and, of the exemptions, only art. 20 or `OTRO`
     (`REGIME_KEY_CLASSIFICATION_NOT_ACCEPTED`).
    `GET /v1/tax-types` only offers the keys that are accepted.
    
    **One exception to "a key you send is the key you get":** when the line ends up
    carrying an equivalence surcharge — whether you sent `equivalence_surcharge_rate`
    or it was inherited from the company's tax configuration — a `01` is rewritten to
    `18`, because a surcharge under the general regime is fiscally incoherent. Send
    `equivalence_surcharge_rate: 0` explicitly to keep `01`. See
    `equivalence_surcharge_rate` in the invoice line for the full rules.
    
    *
    * @param string $regimeKey
    *
    * @return self
    */
    public function setRegimeKey(string $regimeKey): self
    {
        $this->initialized['regimeKey'] = true;
        $this->regimeKey = $regimeKey;
        return $this;
    }
    public function definedProperties(): array
    {
        return ['type' => ['type', 'getType', 'setType'], 'percentage' => ['percentage', 'getPercentage', 'setPercentage'], 'regimeKey' => ['regime_key', 'getRegimeKey', 'setRegimeKey']];
    }
}