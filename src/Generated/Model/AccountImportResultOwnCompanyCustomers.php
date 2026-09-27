<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;
class AccountImportResultOwnCompanyCustomers implements AdditionalPropertiesInterface
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
     * @var int
     */
    protected $created;
    /**
     * @var int
     */
    protected $alreadyExisted;
    /**
     * @var int
     */
    protected $failed;
    /**
     * @return int
     */
    public function getCreated(): int
    {
        return $this->created;
    }
    /**
     * @param int $created
     *
     * @return self
     */
    public function setCreated(int $created): self
    {
        $this->initialized['created'] = true;
        $this->created = $created;
        return $this;
    }
    /**
     * @return int
     */
    public function getAlreadyExisted(): int
    {
        return $this->alreadyExisted;
    }
    /**
     * @param int $alreadyExisted
     *
     * @return self
     */
    public function setAlreadyExisted(int $alreadyExisted): self
    {
        $this->initialized['alreadyExisted'] = true;
        $this->alreadyExisted = $alreadyExisted;
        return $this;
    }
    /**
     * @return int
     */
    public function getFailed(): int
    {
        return $this->failed;
    }
    /**
     * @param int $failed
     *
     * @return self
     */
    public function setFailed(int $failed): self
    {
        $this->initialized['failed'] = true;
        $this->failed = $failed;
        return $this;
    }
    public function definedProperties(): array
    {
        return ['created' => ['created', 'getCreated', 'setCreated'], 'alreadyExisted' => ['already_existed', 'getAlreadyExisted', 'setAlreadyExisted'], 'failed' => ['failed', 'getFailed', 'setFailed']];
    }
}