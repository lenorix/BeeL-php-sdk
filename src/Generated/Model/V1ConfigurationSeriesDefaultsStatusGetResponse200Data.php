<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;

class V1ConfigurationSeriesDefaultsStatusGetResponse200Data implements AdditionalPropertiesInterface
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
     * @var list<DocumentTypeDefaultStatus>
     */
    protected $defaults;

    /**
     * @return list<DocumentTypeDefaultStatus>
     */
    public function getDefaults(): array
    {
        return $this->defaults;
    }

    /**
     * @param  list<DocumentTypeDefaultStatus>  $defaults
     */
    public function setDefaults(array $defaults): self
    {
        $this->initialized['defaults'] = true;
        $this->defaults = $defaults;

        return $this;
    }

    public function definedProperties(): array
    {
        return ['defaults' => ['defaults', 'getDefaults', 'setDefaults']];
    }
}
