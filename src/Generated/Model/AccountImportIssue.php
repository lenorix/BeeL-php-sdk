<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;

class AccountImportIssue implements AdditionalPropertiesInterface
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
     * Machine-readable reason for an issue. New values are added as the import learns to explain
     * more; treat an unknown one as a generic problem rather than failing.
     *
     * Read straight off the row: `REQUIRED_FIELD_MISSING` (the column is there and its **cell** is
     * empty — a missing column is a whole-file error, not a row one), `EXTERNAL_REF_DUPLICATED`,
     * `ENTITY_TYPE_UNKNOWN`, `NIF_INVALID_FORMAT`, `EMAIL_INVALID`, `POSTAL_CODE_INVALID`,
     * `IBAN_INVALID`, `IRPF_NOT_NUMERIC`, `LANGUAGE_UNSUPPORTED`.
     *
     * `IRPF_NOT_ALLOWED` — the rate is a number but not one the law admits (0, 1, 2, 7, 15, 19,
     * 24). It is an **error**, not a warning: letting it through buys a green preview and an
     * account that fails on its first invoice months later, when nobody connects the two.
     *
     * `POSTAL_CODE_PADDED` — a warning: the postal code was padded with leading zeros, which is
     * almost always the right repair but does change the value, and the first digit picks the
     * province.
     *
     * Census: `NIF_NOT_IN_CENSUS` — the tax id is not in the AEAT register or is no longer active.
     * For an **individual** it also covers a legal name that does not match the one on file; for a
     * **legal entity** the name is not checked at all, because the AEAT identifies a company by its
     * CIF alone and has no answer that means "this name is not the one".
     *
     * State of the account rather than of the file, and the ones that produce `BLOCKED`:
     * `ACCOUNT_ALREADY_EXISTS` (a warning, not a blocker), `ACCESS_LEVEL_INSUFFICIENT`,
     * `LIVE_ACTIVATION_NOT_ENTITLED`, `NIF_ALREADY_LIVE_ELSEWHERE`,
     * `PROVISIONING_EMAIL_ALREADY_REGISTERED`, `PROVISIONING_ACCOUNT_CLAIMED` — each the wire code
     * the equivalent single-account call answers with, so the remedy is the one already documented
     * there.
     *
     * Series: `SERIES_CODE_TAKEN`, `SERIES_MANUAL_RESOLUTION_REQUIRED` (the declared code and its
     * `<code>2` fallback are both taken), `SERIES_CODE_DUPLICATED` (this same import declares the
     * code twice), `SERIES_FORMAT_INVALID` (the format, once `{REF}` is resolved, cannot number —
     * no `{NUM}`, or the `external_ref` added characters the grammar rejects) and
     * `SERIES_DEFAULT_REPLACED`. The first four leave the account **without** that series, and say
     * so.
     *
     * Customers file: `CUSTOMER_ROW_REJECTED` — a row of the shared customers file that will not
     * load anywhere. One issue per offending column, each with the message the customer import
     * wrote for it; a row rejected with no column-level detail carries a single one. The census
     * code above is used here too, but only ever on the `nif` column.
     *
     * Anything else: `UNEXPECTED_ROW_FAILURE`, with the detail in `value`.
     *
     *
     * @var string
     */
    protected $code;

    /**
     * Column of the file involved; `null` when the issue is about the row as a whole.
     *
     * @var string|null
     */
    protected $column;

    /**
     * The offending value, already normalised.
     *
     * @var string|null
     */
    protected $value;

    /**
     * Human-readable explanation, in the language of the request. Issues coming from the customers file are the exception: they carry the wording the customer import itself produced, which is Spanish — the same text `POST /v1/companies/{company_id}/customers/imports/preview` returns. Re-labelling them to translate would collapse every error of a row into one repeated sentence, which is worse than one untranslated one.
     *
     * @var string
     */
    protected $message;

    /**
     * Machine-readable reason for an issue. New values are added as the import learns to explain
     * more; treat an unknown one as a generic problem rather than failing.
     *
     * Read straight off the row: `REQUIRED_FIELD_MISSING` (the column is there and its **cell** is
     * empty — a missing column is a whole-file error, not a row one), `EXTERNAL_REF_DUPLICATED`,
     * `ENTITY_TYPE_UNKNOWN`, `NIF_INVALID_FORMAT`, `EMAIL_INVALID`, `POSTAL_CODE_INVALID`,
     * `IBAN_INVALID`, `IRPF_NOT_NUMERIC`, `LANGUAGE_UNSUPPORTED`.
     *
     * `IRPF_NOT_ALLOWED` — the rate is a number but not one the law admits (0, 1, 2, 7, 15, 19,
     * 24). It is an **error**, not a warning: letting it through buys a green preview and an
     * account that fails on its first invoice months later, when nobody connects the two.
     *
     * `POSTAL_CODE_PADDED` — a warning: the postal code was padded with leading zeros, which is
     * almost always the right repair but does change the value, and the first digit picks the
     * province.
     *
     * Census: `NIF_NOT_IN_CENSUS` — the tax id is not in the AEAT register or is no longer active.
     * For an **individual** it also covers a legal name that does not match the one on file; for a
     * **legal entity** the name is not checked at all, because the AEAT identifies a company by its
     * CIF alone and has no answer that means "this name is not the one".
     *
     * State of the account rather than of the file, and the ones that produce `BLOCKED`:
     * `ACCOUNT_ALREADY_EXISTS` (a warning, not a blocker), `ACCESS_LEVEL_INSUFFICIENT`,
     * `LIVE_ACTIVATION_NOT_ENTITLED`, `NIF_ALREADY_LIVE_ELSEWHERE`,
     * `PROVISIONING_EMAIL_ALREADY_REGISTERED`, `PROVISIONING_ACCOUNT_CLAIMED` — each the wire code
     * the equivalent single-account call answers with, so the remedy is the one already documented
     * there.
     *
     * Series: `SERIES_CODE_TAKEN`, `SERIES_MANUAL_RESOLUTION_REQUIRED` (the declared code and its
     * `<code>2` fallback are both taken), `SERIES_CODE_DUPLICATED` (this same import declares the
     * code twice), `SERIES_FORMAT_INVALID` (the format, once `{REF}` is resolved, cannot number —
     * no `{NUM}`, or the `external_ref` added characters the grammar rejects) and
     * `SERIES_DEFAULT_REPLACED`. The first four leave the account **without** that series, and say
     * so.
     *
     * Customers file: `CUSTOMER_ROW_REJECTED` — a row of the shared customers file that will not
     * load anywhere. One issue per offending column, each with the message the customer import
     * wrote for it; a row rejected with no column-level detail carries a single one. The census
     * code above is used here too, but only ever on the `nif` column.
     *
     * Anything else: `UNEXPECTED_ROW_FAILURE`, with the detail in `value`.
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * Machine-readable reason for an issue. New values are added as the import learns to explain
    more; treat an unknown one as a generic problem rather than failing.

    Read straight off the row: `REQUIRED_FIELD_MISSING` (the column is there and its **cell** is
    empty — a missing column is a whole-file error, not a row one), `EXTERNAL_REF_DUPLICATED`,
    `ENTITY_TYPE_UNKNOWN`, `NIF_INVALID_FORMAT`, `EMAIL_INVALID`, `POSTAL_CODE_INVALID`,
    `IBAN_INVALID`, `IRPF_NOT_NUMERIC`, `LANGUAGE_UNSUPPORTED`.

    `IRPF_NOT_ALLOWED` — the rate is a number but not one the law admits (0, 1, 2, 7, 15, 19,
    24). It is an **error**, not a warning: letting it through buys a green preview and an
    account that fails on its first invoice months later, when nobody connects the two.

    `POSTAL_CODE_PADDED` — a warning: the postal code was padded with leading zeros, which is
    almost always the right repair but does change the value, and the first digit picks the
    province.

    Census: `NIF_NOT_IN_CENSUS` — the tax id is not in the AEAT register or is no longer active.
    For an **individual** it also covers a legal name that does not match the one on file; for a
     **legal entity** the name is not checked at all, because the AEAT identifies a company by its
    CIF alone and has no answer that means "this name is not the one".

    State of the account rather than of the file, and the ones that produce `BLOCKED`:
    `ACCOUNT_ALREADY_EXISTS` (a warning, not a blocker), `ACCESS_LEVEL_INSUFFICIENT`,
    `LIVE_ACTIVATION_NOT_ENTITLED`, `NIF_ALREADY_LIVE_ELSEWHERE`,
    `PROVISIONING_EMAIL_ALREADY_REGISTERED`, `PROVISIONING_ACCOUNT_CLAIMED` — each the wire code
    the equivalent single-account call answers with, so the remedy is the one already documented
    there.

    Series: `SERIES_CODE_TAKEN`, `SERIES_MANUAL_RESOLUTION_REQUIRED` (the declared code and its
    `<code>2` fallback are both taken), `SERIES_CODE_DUPLICATED` (this same import declares the
    code twice), `SERIES_FORMAT_INVALID` (the format, once `{REF}` is resolved, cannot number —
    no `{NUM}`, or the `external_ref` added characters the grammar rejects) and
    `SERIES_DEFAULT_REPLACED`. The first four leave the account **without** that series, and say
    so.

    Customers file: `CUSTOMER_ROW_REJECTED` — a row of the shared customers file that will not
    load anywhere. One issue per offending column, each with the message the customer import
    wrote for it; a row rejected with no column-level detail carries a single one. The census
    code above is used here too, but only ever on the `nif` column.

    Anything else: `UNEXPECTED_ROW_FAILURE`, with the detail in `value`.
     */
    public function setCode(string $code): self
    {
        $this->initialized['code'] = true;
        $this->code = $code;

        return $this;
    }

    /**
     * Column of the file involved; `null` when the issue is about the row as a whole.
     */
    public function getColumn(): ?string
    {
        return $this->column;
    }

    /**
     * Column of the file involved; `null` when the issue is about the row as a whole.
     */
    public function setColumn(?string $column): self
    {
        $this->initialized['column'] = true;
        $this->column = $column;

        return $this;
    }

    /**
     * The offending value, already normalised.
     */
    public function getValue(): ?string
    {
        return $this->value;
    }

    /**
     * The offending value, already normalised.
     */
    public function setValue(?string $value): self
    {
        $this->initialized['value'] = true;
        $this->value = $value;

        return $this;
    }

    /**
     * Human-readable explanation, in the language of the request. Issues coming from the customers file are the exception: they carry the wording the customer import itself produced, which is Spanish — the same text `POST /v1/companies/{company_id}/customers/imports/preview` returns. Re-labelling them to translate would collapse every error of a row into one repeated sentence, which is worse than one untranslated one.
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * Human-readable explanation, in the language of the request. Issues coming from the customers file are the exception: they carry the wording the customer import itself produced, which is Spanish — the same text `POST /v1/companies/{company_id}/customers/imports/preview` returns. Re-labelling them to translate would collapse every error of a row into one repeated sentence, which is worse than one untranslated one.
     */
    public function setMessage(string $message): self
    {
        $this->initialized['message'] = true;
        $this->message = $message;

        return $this;
    }

    public function definedProperties(): array
    {
        return ['code' => ['code', 'getCode', 'setCode'], 'column' => ['column', 'getColumn', 'setColumn'], 'value' => ['value', 'getValue', 'setValue'], 'message' => ['message', 'getMessage', 'setMessage']];
    }
}
