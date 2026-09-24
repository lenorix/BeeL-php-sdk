<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;

class CreateClaimTokenRequest implements AdditionalPropertiesInterface
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
     * The holder's email address, used as their login. **Required when the account has no holder** (else `422`). If the account already has one, it must match theirs — a different address returns `409 CLAIM_TOKEN_HOLDER_MISMATCH` rather than silently replacing the holder.
     *
     * @var string
     */
    protected $email;

    /**
     * Preferred language for a holder created by this call. Defaults to `es`. Ignored when the account already has a holder.
     *
     * @var string
     */
    protected $language;

    /**
     * The holder's email address, used as their login. **Required when the account has no holder** (else `422`). If the account already has one, it must match theirs — a different address returns `409 CLAIM_TOKEN_HOLDER_MISMATCH` rather than silently replacing the holder.
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * The holder's email address, used as their login. **Required when the account has no holder** (else `422`). If the account already has one, it must match theirs — a different address returns `409 CLAIM_TOKEN_HOLDER_MISMATCH` rather than silently replacing the holder.
     */
    public function setEmail(string $email): self
    {
        $this->initialized['email'] = true;
        $this->email = $email;

        return $this;
    }

    /**
     * Preferred language for a holder created by this call. Defaults to `es`. Ignored when the account already has a holder.
     */
    public function getLanguage(): string
    {
        return $this->language;
    }

    /**
     * Preferred language for a holder created by this call. Defaults to `es`. Ignored when the account already has a holder.
     */
    public function setLanguage(string $language): self
    {
        $this->initialized['language'] = true;
        $this->language = $language;

        return $this;
    }

    public function definedProperties(): array
    {
        return ['email' => ['email', 'getEmail', 'setEmail'], 'language' => ['language', 'getLanguage', 'setLanguage']];
    }
}
