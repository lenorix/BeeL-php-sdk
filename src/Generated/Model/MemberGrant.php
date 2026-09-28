<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;

class MemberGrant implements AdditionalPropertiesInterface
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
     * Unique identifier (UUID) of the company within the account.
     *
     * @var string
     */
    protected $companyId;

    /**
     * Access the member has over this company.
     *
     * @var string
     */
    protected $accessLevel;

    /**
     * Legal name of the company; the trade name is never used here. `null` when the company has no legal name yet (possible before onboarding completes) or no longer exists. Treat it as optional: a client must not require it to be present. Never falls back to the identifier: `company_id` already carries it.
     *
     * @var string|null
     */
    protected $companyName;

    /**
     * Unique identifier (UUID) of the company within the account.
     */
    public function getCompanyId(): string
    {
        return $this->companyId;
    }

    /**
     * Unique identifier (UUID) of the company within the account.
     */
    public function setCompanyId(string $companyId): self
    {
        $this->initialized['companyId'] = true;
        $this->companyId = $companyId;

        return $this;
    }

    /**
     * Access the member has over this company.
     */
    public function getAccessLevel(): string
    {
        return $this->accessLevel;
    }

    /**
     * Access the member has over this company.
     */
    public function setAccessLevel(string $accessLevel): self
    {
        $this->initialized['accessLevel'] = true;
        $this->accessLevel = $accessLevel;

        return $this;
    }

    /**
     * Legal name of the company; the trade name is never used here. `null` when the company has no legal name yet (possible before onboarding completes) or no longer exists. Treat it as optional: a client must not require it to be present. Never falls back to the identifier: `company_id` already carries it.
     */
    public function getCompanyName(): ?string
    {
        return $this->companyName;
    }

    /**
     * Legal name of the company; the trade name is never used here. `null` when the company has no legal name yet (possible before onboarding completes) or no longer exists. Treat it as optional: a client must not require it to be present. Never falls back to the identifier: `company_id` already carries it.
     */
    public function setCompanyName(?string $companyName): self
    {
        $this->initialized['companyName'] = true;
        $this->companyName = $companyName;

        return $this;
    }

    public function definedProperties(): array
    {
        return ['companyId' => ['company_id', 'getCompanyId', 'setCompanyId'], 'accessLevel' => ['access_level', 'getAccessLevel', 'setAccessLevel'], 'companyName' => ['company_name', 'getCompanyName', 'setCompanyName']];
    }
}
