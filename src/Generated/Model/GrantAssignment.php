<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;

class GrantAssignment implements AdditionalPropertiesInterface
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
     * Access the member gets over this company. `NONE` is not accepted here: a grant that
     * grants nothing is not a grant. Remove access by deleting the grant
     * (`DELETE /v1/accounts/{account_id}/members/{member_id}/grants/{company_id}`).
     *
     *
     * @var string
     */
    protected $accessLevel;

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
     * Access the member gets over this company. `NONE` is not accepted here: a grant that
     * grants nothing is not a grant. Remove access by deleting the grant
     * (`DELETE /v1/accounts/{account_id}/members/{member_id}/grants/{company_id}`).
     */
    public function getAccessLevel(): string
    {
        return $this->accessLevel;
    }

    /**
     * Access the member gets over this company. `NONE` is not accepted here: a grant that
    grants nothing is not a grant. Remove access by deleting the grant
    (`DELETE /v1/accounts/{account_id}/members/{member_id}/grants/{company_id}`).
     */
    public function setAccessLevel(string $accessLevel): self
    {
        $this->initialized['accessLevel'] = true;
        $this->accessLevel = $accessLevel;

        return $this;
    }

    public function definedProperties(): array
    {
        return ['companyId' => ['company_id', 'getCompanyId', 'setCompanyId'], 'accessLevel' => ['access_level', 'getAccessLevel', 'setAccessLevel']];
    }
}
