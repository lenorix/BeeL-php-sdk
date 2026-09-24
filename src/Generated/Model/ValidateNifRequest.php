<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;
class ValidateNifRequest implements AdditionalPropertiesInterface
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
     * @var string
     */
    protected $nif;
    /**
     * Last name and first name (individual) or business name (legal entity).
     * 
     * **Important**:
     * - REQUIRED for individuals (NIFs starting with a number)
     * - OPTIONAL for legal entities (NIFs starting with a letter)
     * 
     * For an **individual**, AEAT matches NIF and name together: send a name the
     * census does not recognise and the person is not identified, so the status
     * comes back `INVALID`.
     * 
     * For a **legal entity**, the name is **not verified**. AEAT identifies a
     * company by its CIF alone — there is no census answer meaning "this name is
     * wrong", so validation depends only on the CIF and any name you send is
     * accepted. Use the `legal_name` of the response to contrast your own.
     * 
     *
     * @var string|null
     */
    protected $legalName;
    /**
     * @return string
     */
    public function getNif(): string
    {
        return $this->nif;
    }
    /**
     * @param string $nif
     *
     * @return self
     */
    public function setNif(string $nif): self
    {
        $this->initialized['nif'] = true;
        $this->nif = $nif;
        return $this;
    }
    /**
     * Last name and first name (individual) or business name (legal entity).
     * 
     * **Important**:
     * - REQUIRED for individuals (NIFs starting with a number)
     * - OPTIONAL for legal entities (NIFs starting with a letter)
     * 
     * For an **individual**, AEAT matches NIF and name together: send a name the
     * census does not recognise and the person is not identified, so the status
     * comes back `INVALID`.
     * 
     * For a **legal entity**, the name is **not verified**. AEAT identifies a
     * company by its CIF alone — there is no census answer meaning "this name is
     * wrong", so validation depends only on the CIF and any name you send is
     * accepted. Use the `legal_name` of the response to contrast your own.
     * 
     *
     * @return string|null
     */
    public function getLegalName(): ?string
    {
        return $this->legalName;
    }
    /**
    * Last name and first name (individual) or business name (legal entity).
    
    **Important**:
    - REQUIRED for individuals (NIFs starting with a number)
    - OPTIONAL for legal entities (NIFs starting with a letter)
    
    For an **individual**, AEAT matches NIF and name together: send a name the
    census does not recognise and the person is not identified, so the status
    comes back `INVALID`.
    
    For a **legal entity**, the name is **not verified**. AEAT identifies a
    company by its CIF alone — there is no census answer meaning "this name is
    wrong", so validation depends only on the CIF and any name you send is
    accepted. Use the `legal_name` of the response to contrast your own.
    
    *
    * @param string|null $legalName
    *
    * @return self
    */
    public function setLegalName(?string $legalName): self
    {
        $this->initialized['legalName'] = true;
        $this->legalName = $legalName;
        return $this;
    }
    public function definedProperties(): array
    {
        return ['nif' => ['nif', 'getNif', 'setNif'], 'legalName' => ['legal_name', 'getLegalName', 'setLegalName']];
    }
}