<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;

class ChangeAccessLevelRequest implements AdditionalPropertiesInterface
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
     * How much access an actor has to an account or a company. The same three values are used everywhere access is granted or reported — whether the actor is a member of the account or a provisioner managing it on someone's behalf.
     *
     * `NONE` — no access to the data.
     * `VIEW` — read invoices, customers, products, series and fiscal data.
     * `OPERATE` — everything in `VIEW`, plus creating and editing them. Issuing invoices for an account you manage additionally requires a signed fiscal representation from the account holder (see `/v1/accounts/{account_id}/companies/{company_id}/representation`).
     *
     * Access level never affects billing: whoever provisioned an account pays for its subscription regardless of the level they keep over it.
     *
     * @var string
     */
    protected $accessLevel;

    /**
     * How much access an actor has to an account or a company. The same three values are used everywhere access is granted or reported — whether the actor is a member of the account or a provisioner managing it on someone's behalf.
     *
     * `NONE` — no access to the data.
     * `VIEW` — read invoices, customers, products, series and fiscal data.
     * `OPERATE` — everything in `VIEW`, plus creating and editing them. Issuing invoices for an account you manage additionally requires a signed fiscal representation from the account holder (see `/v1/accounts/{account_id}/companies/{company_id}/representation`).
     *
     * Access level never affects billing: whoever provisioned an account pays for its subscription regardless of the level they keep over it.
     */
    public function getAccessLevel(): string
    {
        return $this->accessLevel;
    }

    /**
     * How much access an actor has to an account or a company. The same three values are used everywhere access is granted or reported — whether the actor is a member of the account or a provisioner managing it on someone's behalf.

    `NONE` — no access to the data.
    `VIEW` — read invoices, customers, products, series and fiscal data.
    `OPERATE` — everything in `VIEW`, plus creating and editing them. Issuing invoices for an account you manage additionally requires a signed fiscal representation from the account holder (see `/v1/accounts/{account_id}/companies/{company_id}/representation`).

    Access level never affects billing: whoever provisioned an account pays for its subscription regardless of the level they keep over it.
     */
    public function setAccessLevel(string $accessLevel): self
    {
        $this->initialized['accessLevel'] = true;
        $this->accessLevel = $accessLevel;

        return $this;
    }

    public function definedProperties(): array
    {
        return ['accessLevel' => ['access_level', 'getAccessLevel', 'setAccessLevel']];
    }
}
