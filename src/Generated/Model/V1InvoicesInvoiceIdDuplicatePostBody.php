<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;
class V1InvoicesInvoiceIdDuplicatePostBody implements AdditionalPropertiesInterface
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
     * Series ID for the new invoice.
     * If not provided, uses the same series as the original.
     * 
     *
     * @var string
     */
    protected $seriesId;
    /**
     * Observations for the new invoice.
     * If not provided, copies from the original invoice.
     * 
     *
     * @var string
     */
    protected $notes;
    /**
     * Series ID for the new invoice.
     * If not provided, uses the same series as the original.
     * 
     *
     * @return string
     */
    public function getSeriesId(): string
    {
        return $this->seriesId;
    }
    /**
    * Series ID for the new invoice.
    If not provided, uses the same series as the original.
    
    *
    * @param string $seriesId
    *
    * @return self
    */
    public function setSeriesId(string $seriesId): self
    {
        $this->initialized['seriesId'] = true;
        $this->seriesId = $seriesId;
        return $this;
    }
    /**
     * Observations for the new invoice.
     * If not provided, copies from the original invoice.
     * 
     *
     * @return string
     */
    public function getNotes(): string
    {
        return $this->notes;
    }
    /**
    * Observations for the new invoice.
    If not provided, copies from the original invoice.
    
    *
    * @param string $notes
    *
    * @return self
    */
    public function setNotes(string $notes): self
    {
        $this->initialized['notes'] = true;
        $this->notes = $notes;
        return $this;
    }
    public function definedProperties(): array
    {
        return ['seriesId' => ['series_id', 'getSeriesId', 'setSeriesId'], 'notes' => ['notes', 'getNotes', 'setNotes']];
    }
}