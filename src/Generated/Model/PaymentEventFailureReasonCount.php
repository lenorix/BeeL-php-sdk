<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;
class PaymentEventFailureReasonCount implements AdditionalPropertiesInterface
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
     * Stable identifier of the reason. Branch on this, not on `label`.
     *
     * @var string
     */
    protected $code;
    /**
     * The reason written out for a person, in the language of the request.
     *
     * @var string
     */
    protected $label;
    /**
     * Events of the connection with this reason.
     *
     * @var int
     */
    protected $count;
    /**
     * Stable identifier of the reason. Branch on this, not on `label`.
     *
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }
    /**
     * Stable identifier of the reason. Branch on this, not on `label`.
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
     * The reason written out for a person, in the language of the request.
     *
     * @return string
     */
    public function getLabel(): string
    {
        return $this->label;
    }
    /**
     * The reason written out for a person, in the language of the request.
     *
     * @param string $label
     *
     * @return self
     */
    public function setLabel(string $label): self
    {
        $this->initialized['label'] = true;
        $this->label = $label;
        return $this;
    }
    /**
     * Events of the connection with this reason.
     *
     * @return int
     */
    public function getCount(): int
    {
        return $this->count;
    }
    /**
     * Events of the connection with this reason.
     *
     * @param int $count
     *
     * @return self
     */
    public function setCount(int $count): self
    {
        $this->initialized['count'] = true;
        $this->count = $count;
        return $this;
    }
    public function definedProperties(): array
    {
        return ['code' => ['code', 'getCode', 'setCode'], 'label' => ['label', 'getLabel', 'setLabel'], 'count' => ['count', 'getCount', 'setCount']];
    }
}