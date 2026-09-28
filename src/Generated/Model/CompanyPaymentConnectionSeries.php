<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;

class CompanyPaymentConnectionSeries implements AdditionalPropertiesInterface
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
     * Series for auto-issued ordinary invoices.
     *
     * @var string|null
     */
    protected $ordinaria;

    /**
     * Series for auto-issued simplified invoices.
     *
     * @var string|null
     */
    protected $simplificada;

    /**
     * Series for auto-issued corrective invoices (refunds).
     *
     * @var string|null
     */
    protected $rectificativa;

    /**
     * Series for auto-issued ordinary invoices.
     */
    public function getOrdinaria(): ?string
    {
        return $this->ordinaria;
    }

    /**
     * Series for auto-issued ordinary invoices.
     */
    public function setOrdinaria(?string $ordinaria): self
    {
        $this->initialized['ordinaria'] = true;
        $this->ordinaria = $ordinaria;

        return $this;
    }

    /**
     * Series for auto-issued simplified invoices.
     */
    public function getSimplificada(): ?string
    {
        return $this->simplificada;
    }

    /**
     * Series for auto-issued simplified invoices.
     */
    public function setSimplificada(?string $simplificada): self
    {
        $this->initialized['simplificada'] = true;
        $this->simplificada = $simplificada;

        return $this;
    }

    /**
     * Series for auto-issued corrective invoices (refunds).
     */
    public function getRectificativa(): ?string
    {
        return $this->rectificativa;
    }

    /**
     * Series for auto-issued corrective invoices (refunds).
     */
    public function setRectificativa(?string $rectificativa): self
    {
        $this->initialized['rectificativa'] = true;
        $this->rectificativa = $rectificativa;

        return $this;
    }

    public function definedProperties(): array
    {
        return ['ordinaria' => ['ordinaria', 'getOrdinaria', 'setOrdinaria'], 'simplificada' => ['simplificada', 'getSimplificada', 'setSimplificada'], 'rectificativa' => ['rectificativa', 'getRectificativa', 'setRectificativa']];
    }
}
