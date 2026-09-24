<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;
class V1AccountsAccountIdUsageGetResponse200 implements AdditionalPropertiesInterface
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
     * @var bool
     */
    protected $success;
    /**
     * Provisioning usage for the calling provisioner. `nifs` is the billable count, and the billable unit is the **provisioned account**, not the real NIF: every account you provision counts as 1 — including empty/unclaimed ones (each provisioned account is born with a placeholder company row), whether or not the holder has registered a real NIF yet. So a newly provisioned empty account contributes 1 to `nifs`, not 0.
     *
     * @var ProvisioningUsage
     */
    protected $data;
    /**
     * @var ResponseMeta
     */
    protected $meta;
    /**
     * @return bool
     */
    public function getSuccess(): bool
    {
        return $this->success;
    }
    /**
     * @param bool $success
     *
     * @return self
     */
    public function setSuccess(bool $success): self
    {
        $this->initialized['success'] = true;
        $this->success = $success;
        return $this;
    }
    /**
     * Provisioning usage for the calling provisioner. `nifs` is the billable count, and the billable unit is the **provisioned account**, not the real NIF: every account you provision counts as 1 — including empty/unclaimed ones (each provisioned account is born with a placeholder company row), whether or not the holder has registered a real NIF yet. So a newly provisioned empty account contributes 1 to `nifs`, not 0.
     *
     * @return ProvisioningUsage
     */
    public function getData(): ProvisioningUsage
    {
        return $this->data;
    }
    /**
     * Provisioning usage for the calling provisioner. `nifs` is the billable count, and the billable unit is the **provisioned account**, not the real NIF: every account you provision counts as 1 — including empty/unclaimed ones (each provisioned account is born with a placeholder company row), whether or not the holder has registered a real NIF yet. So a newly provisioned empty account contributes 1 to `nifs`, not 0.
     *
     * @param ProvisioningUsage $data
     *
     * @return self
     */
    public function setData(ProvisioningUsage $data): self
    {
        $this->initialized['data'] = true;
        $this->data = $data;
        return $this;
    }
    /**
     * @return ResponseMeta
     */
    public function getMeta(): ResponseMeta
    {
        return $this->meta;
    }
    /**
     * @param ResponseMeta $meta
     *
     * @return self
     */
    public function setMeta(ResponseMeta $meta): self
    {
        $this->initialized['meta'] = true;
        $this->meta = $meta;
        return $this;
    }
    public function definedProperties(): array
    {
        return ['success' => ['success', 'getSuccess', 'setSuccess'], 'data' => ['data', 'getData', 'setData'], 'meta' => ['meta', 'getMeta', 'setMeta']];
    }
}