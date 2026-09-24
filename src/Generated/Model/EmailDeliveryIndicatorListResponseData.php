<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;

class EmailDeliveryIndicatorListResponseData implements AdditionalPropertiesInterface
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
     * @var list<EmailDeliveryIndicator>
     */
    protected $indicators;

    /**
     * @return list<EmailDeliveryIndicator>
     */
    public function getIndicators(): array
    {
        return $this->indicators;
    }

    /**
     * @param  list<EmailDeliveryIndicator>  $indicators
     */
    public function setIndicators(array $indicators): self
    {
        $this->initialized['indicators'] = true;
        $this->indicators = $indicators;

        return $this;
    }

    public function definedProperties(): array
    {
        return ['indicators' => ['indicators', 'getIndicators', 'setIndicators']];
    }
}
