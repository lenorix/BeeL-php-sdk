<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;
class InvoiceCustomizationOptionsResponse implements AdditionalPropertiesInterface
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
     * Templates available to render the invoices of a NIF.
     *
     * @var list<InvoiceTemplateOption>
     */
    protected $templateTypes;
    /**
     * Templates available to render the invoices of a NIF.
     *
     * @return list<InvoiceTemplateOption>
     */
    public function getTemplateTypes(): array
    {
        return $this->templateTypes;
    }
    /**
     * Templates available to render the invoices of a NIF.
     *
     * @param list<InvoiceTemplateOption> $templateTypes
     *
     * @return self
     */
    public function setTemplateTypes(array $templateTypes): self
    {
        $this->initialized['templateTypes'] = true;
        $this->templateTypes = $templateTypes;
        return $this;
    }
    public function definedProperties(): array
    {
        return ['templateTypes' => ['template_types', 'getTemplateTypes', 'setTemplateTypes']];
    }
}