<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;

class CompanyNumbering implements AdditionalPropertiesInterface
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
     * Alphanumeric series code (used in {CODIGO} variable).
     * Allows uppercase letters, numbers, hyphens and underscores.
     *
     *
     * @var string
     */
    protected $code;

    /**
     * Number the ordinary series counter starts at. If the last invoice issued
     * elsewhere was `2026-0150`, send `151`. Defaults to 1 when omitted.
     *
     *
     * @var int
     */
    protected $initialNumber;

    /**
     * Format template the ordinary series' invoice numbers are printed with
     * (`{CODIGO}`, `{YYYY}`/`{YY}`, `{MM}`, `{NUM}`/`{NUM:X}` — must contain `{NUM}`
     * or `{NUM:X}`). Defaults to `{CODIGO}-{YYYY}-{NUM:4}` when omitted.
     *
     *
     * @var string
     */
    protected $format;

    /**
     * When the ordinary series' counter resets (`NEVER`/`ANNUAL`/`MONTHLY`).
     * Defaults to `ANNUAL` when omitted — so a custom `format` without a year token
     * must come with `counter_reset: NEVER`.
     *
     *
     * @var string
     */
    protected $counterReset;

    /**
     * How one of the series the company is born with should be seeded. All fields are
     * optional and independent: omit one and it falls back to the system default. Same
     * format/reset compatibility rules and error codes as the parent block.
     *
     *
     * @var CompanySeriesNumbering
     */
    protected $simplified;

    /**
     * How one of the series the company is born with should be seeded. All fields are
     * optional and independent: omit one and it falls back to the system default. Same
     * format/reset compatibility rules and error codes as the parent block.
     *
     *
     * @var CompanySeriesNumbering
     */
    protected $corrective;

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
     * Number the ordinary series counter starts at. If the last invoice issued
     * elsewhere was `2026-0150`, send `151`. Defaults to 1 when omitted.
     */
    public function getInitialNumber(): int
    {
        return $this->initialNumber;
    }

    /**
     * Number the ordinary series counter starts at. If the last invoice issued
    elsewhere was `2026-0150`, send `151`. Defaults to 1 when omitted.
     */
    public function setInitialNumber(int $initialNumber): self
    {
        $this->initialized['initialNumber'] = true;
        $this->initialNumber = $initialNumber;

        return $this;
    }

    /**
     * Format template the ordinary series' invoice numbers are printed with
     * (`{CODIGO}`, `{YYYY}`/`{YY}`, `{MM}`, `{NUM}`/`{NUM:X}` — must contain `{NUM}`
     * or `{NUM:X}`). Defaults to `{CODIGO}-{YYYY}-{NUM:4}` when omitted.
     */
    public function getFormat(): string
    {
        return $this->format;
    }

    /**
     * Format template the ordinary series' invoice numbers are printed with
    (`{CODIGO}`, `{YYYY}`/`{YY}`, `{MM}`, `{NUM}`/`{NUM:X}` — must contain `{NUM}`
    or `{NUM:X}`). Defaults to `{CODIGO}-{YYYY}-{NUM:4}` when omitted.
     */
    public function setFormat(string $format): self
    {
        $this->initialized['format'] = true;
        $this->format = $format;

        return $this;
    }

    /**
     * When the ordinary series' counter resets (`NEVER`/`ANNUAL`/`MONTHLY`).
     * Defaults to `ANNUAL` when omitted — so a custom `format` without a year token
     * must come with `counter_reset: NEVER`.
     */
    public function getCounterReset(): string
    {
        return $this->counterReset;
    }

    /**
     * When the ordinary series' counter resets (`NEVER`/`ANNUAL`/`MONTHLY`).
    Defaults to `ANNUAL` when omitted — so a custom `format` without a year token
    must come with `counter_reset: NEVER`.
     */
    public function setCounterReset(string $counterReset): self
    {
        $this->initialized['counterReset'] = true;
        $this->counterReset = $counterReset;

        return $this;
    }

    /**
     * How one of the series the company is born with should be seeded. All fields are
     * optional and independent: omit one and it falls back to the system default. Same
     * format/reset compatibility rules and error codes as the parent block.
     */
    public function getSimplified(): CompanySeriesNumbering
    {
        return $this->simplified;
    }

    /**
     * How one of the series the company is born with should be seeded. All fields are
    optional and independent: omit one and it falls back to the system default. Same
    format/reset compatibility rules and error codes as the parent block.
     */
    public function setSimplified(CompanySeriesNumbering $simplified): self
    {
        $this->initialized['simplified'] = true;
        $this->simplified = $simplified;

        return $this;
    }

    /**
     * How one of the series the company is born with should be seeded. All fields are
     * optional and independent: omit one and it falls back to the system default. Same
     * format/reset compatibility rules and error codes as the parent block.
     */
    public function getCorrective(): CompanySeriesNumbering
    {
        return $this->corrective;
    }

    /**
     * How one of the series the company is born with should be seeded. All fields are
    optional and independent: omit one and it falls back to the system default. Same
    format/reset compatibility rules and error codes as the parent block.
     */
    public function setCorrective(CompanySeriesNumbering $corrective): self
    {
        $this->initialized['corrective'] = true;
        $this->corrective = $corrective;

        return $this;
    }

    public function definedProperties(): array
    {
        return ['code' => ['code', 'getCode', 'setCode'], 'initialNumber' => ['initial_number', 'getInitialNumber', 'setInitialNumber'], 'format' => ['format', 'getFormat', 'setFormat'], 'counterReset' => ['counter_reset', 'getCounterReset', 'setCounterReset'], 'simplified' => ['simplified', 'getSimplified', 'setSimplified'], 'corrective' => ['corrective', 'getCorrective', 'setCorrective']];
    }
}
