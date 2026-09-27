<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;

class CompanySeriesNumbering implements AdditionalPropertiesInterface
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
     * Number this series' counter starts at, to continue the numbering already used
     * elsewhere. Defaults to 1 when omitted.
     *
     *
     * @var int
     */
    protected $initialNumber;

    /**
     * Format template this series' invoice numbers are printed with. Defaults to
     * `{CODIGO}-{YYYY}-{NUM:4}` when omitted.
     *
     *
     * @var string
     */
    protected $format;

    /**
     * When this series' counter resets (`NEVER`/`ANNUAL`/`MONTHLY`). Defaults to
     * `ANNUAL` when omitted — so a custom `format` without a year token must come
     * with `counter_reset: NEVER`.
     *
     *
     * @var string
     */
    protected $counterReset;

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
     * Number this series' counter starts at, to continue the numbering already used
     * elsewhere. Defaults to 1 when omitted.
     */
    public function getInitialNumber(): int
    {
        return $this->initialNumber;
    }

    /**
     * Number this series' counter starts at, to continue the numbering already used
    elsewhere. Defaults to 1 when omitted.
     */
    public function setInitialNumber(int $initialNumber): self
    {
        $this->initialized['initialNumber'] = true;
        $this->initialNumber = $initialNumber;

        return $this;
    }

    /**
     * Format template this series' invoice numbers are printed with. Defaults to
     * `{CODIGO}-{YYYY}-{NUM:4}` when omitted.
     */
    public function getFormat(): string
    {
        return $this->format;
    }

    /**
     * Format template this series' invoice numbers are printed with. Defaults to
    `{CODIGO}-{YYYY}-{NUM:4}` when omitted.
     */
    public function setFormat(string $format): self
    {
        $this->initialized['format'] = true;
        $this->format = $format;

        return $this;
    }

    /**
     * When this series' counter resets (`NEVER`/`ANNUAL`/`MONTHLY`). Defaults to
     * `ANNUAL` when omitted — so a custom `format` without a year token must come
     * with `counter_reset: NEVER`.
     */
    public function getCounterReset(): string
    {
        return $this->counterReset;
    }

    /**
     * When this series' counter resets (`NEVER`/`ANNUAL`/`MONTHLY`). Defaults to
    `ANNUAL` when omitted — so a custom `format` without a year token must come
    with `counter_reset: NEVER`.
     */
    public function setCounterReset(string $counterReset): self
    {
        $this->initialized['counterReset'] = true;
        $this->counterReset = $counterReset;

        return $this;
    }

    public function definedProperties(): array
    {
        return ['code' => ['code', 'getCode', 'setCode'], 'initialNumber' => ['initial_number', 'getInitialNumber', 'setInitialNumber'], 'format' => ['format', 'getFormat', 'setFormat'], 'counterReset' => ['counter_reset', 'getCounterReset', 'setCounterReset']];
    }
}
