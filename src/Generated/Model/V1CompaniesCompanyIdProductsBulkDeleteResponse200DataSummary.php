<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;
class V1CompaniesCompanyIdProductsBulkDeleteResponse200DataSummary implements AdditionalPropertiesInterface
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
     * @var int|null
     */
    protected $totalProcessed;
    /**
     * @var int|null
     */
    protected $successful;
    /**
     * @var int|null
     */
    protected $failed;
    /**
     * @return int|null
     */
    public function getTotalProcessed(): ?int
    {
        return $this->totalProcessed;
    }
    /**
     * @param int|null $totalProcessed
     *
     * @return self
     */
    public function setTotalProcessed(?int $totalProcessed): self
    {
        $this->initialized['totalProcessed'] = true;
        $this->totalProcessed = $totalProcessed;
        return $this;
    }
    /**
     * @return int|null
     */
    public function getSuccessful(): ?int
    {
        return $this->successful;
    }
    /**
     * @param int|null $successful
     *
     * @return self
     */
    public function setSuccessful(?int $successful): self
    {
        $this->initialized['successful'] = true;
        $this->successful = $successful;
        return $this;
    }
    /**
     * @return int|null
     */
    public function getFailed(): ?int
    {
        return $this->failed;
    }
    /**
     * @param int|null $failed
     *
     * @return self
     */
    public function setFailed(?int $failed): self
    {
        $this->initialized['failed'] = true;
        $this->failed = $failed;
        return $this;
    }
    public function definedProperties(): array
    {
        return ['totalProcessed' => ['total_processed', 'getTotalProcessed', 'setTotalProcessed'], 'successful' => ['successful', 'getSuccessful', 'setSuccessful'], 'failed' => ['failed', 'getFailed', 'setFailed']];
    }
}