<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;

class IssuerData implements AdditionalPropertiesInterface
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
     * Issuer legal name
     *
     * @var string
     */
    protected $legalName;

    /**
     * Issuer trade name (optional)
     *
     * @var string|null
     */
    protected $tradeName;

    /**
     * Spanish Tax ID (9 alphanumeric characters).
     * Valid formats:
     * - DNI: 8 digits + letter (e.g., 12345678A)
     * - NIE: X/Y/Z + 7 digits + letter (e.g., X1234567A)
     * - CIF: Letter + 7 digits + digit/letter (e.g., B12345674)
     *
     *
     * @var string
     */
    protected $nif;

    /**
     * Issuer address as stored. Optional and absent when the company has not registered its
     * address yet: an address is either complete or it is not there, so no partial address
     * and no placeholder is ever returned in its place.
     *
     *
     * @var IssuerDataAddress
     */
    protected $address;

    /**
     * Phone number. Allows digits, spaces, dashes, parentheses, and optional leading +
     *
     * @var string
     */
    protected $phone;

    /**
     * Email address (minimum valid email is 5 chars, e.g. a@b.co)
     *
     * @var string
     */
    protected $email;

    /**
     * Issuer website (optional)
     *
     * @var string|null
     */
    protected $website;

    /**
     * Issuer logo URL (optional)
     *
     * @var string|null
     */
    protected $logoUrl;

    /**
     * Additional issuer information (collegiate number, professional registration, etc.)
     *
     *
     * @var string|null
     */
    protected $additionalInfo;

    /**
     * Issuer legal name
     */
    public function getLegalName(): string
    {
        return $this->legalName;
    }

    /**
     * Issuer legal name
     */
    public function setLegalName(string $legalName): self
    {
        $this->initialized['legalName'] = true;
        $this->legalName = $legalName;

        return $this;
    }

    /**
     * Issuer trade name (optional)
     */
    public function getTradeName(): ?string
    {
        return $this->tradeName;
    }

    /**
     * Issuer trade name (optional)
     */
    public function setTradeName(?string $tradeName): self
    {
        $this->initialized['tradeName'] = true;
        $this->tradeName = $tradeName;

        return $this;
    }

    /**
     * Spanish Tax ID (9 alphanumeric characters).
     * Valid formats:
     * - DNI: 8 digits + letter (e.g., 12345678A)
     * - NIE: X/Y/Z + 7 digits + letter (e.g., X1234567A)
     * - CIF: Letter + 7 digits + digit/letter (e.g., B12345674)
     */
    public function getNif(): string
    {
        return $this->nif;
    }

    /**
     * Spanish Tax ID (9 alphanumeric characters).
    Valid formats:
    - DNI: 8 digits + letter (e.g., 12345678A)
    - NIE: X/Y/Z + 7 digits + letter (e.g., X1234567A)
    - CIF: Letter + 7 digits + digit/letter (e.g., B12345674)
     */
    public function setNif(string $nif): self
    {
        $this->initialized['nif'] = true;
        $this->nif = $nif;

        return $this;
    }

    /**
     * Issuer address as stored. Optional and absent when the company has not registered its
     * address yet: an address is either complete or it is not there, so no partial address
     * and no placeholder is ever returned in its place.
     */
    public function getAddress(): IssuerDataAddress
    {
        return $this->address;
    }

    /**
     * Issuer address as stored. Optional and absent when the company has not registered its
    address yet: an address is either complete or it is not there, so no partial address
    and no placeholder is ever returned in its place.
     */
    public function setAddress(IssuerDataAddress $address): self
    {
        $this->initialized['address'] = true;
        $this->address = $address;

        return $this;
    }

    /**
     * Phone number. Allows digits, spaces, dashes, parentheses, and optional leading +
     */
    public function getPhone(): string
    {
        return $this->phone;
    }

    /**
     * Phone number. Allows digits, spaces, dashes, parentheses, and optional leading +
     */
    public function setPhone(string $phone): self
    {
        $this->initialized['phone'] = true;
        $this->phone = $phone;

        return $this;
    }

    /**
     * Email address (minimum valid email is 5 chars, e.g. a@b.co)
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * Email address (minimum valid email is 5 chars, e.g. a@b.co)
     */
    public function setEmail(string $email): self
    {
        $this->initialized['email'] = true;
        $this->email = $email;

        return $this;
    }

    /**
     * Issuer website (optional)
     */
    public function getWebsite(): ?string
    {
        return $this->website;
    }

    /**
     * Issuer website (optional)
     */
    public function setWebsite(?string $website): self
    {
        $this->initialized['website'] = true;
        $this->website = $website;

        return $this;
    }

    /**
     * Issuer logo URL (optional)
     */
    public function getLogoUrl(): ?string
    {
        return $this->logoUrl;
    }

    /**
     * Issuer logo URL (optional)
     */
    public function setLogoUrl(?string $logoUrl): self
    {
        $this->initialized['logoUrl'] = true;
        $this->logoUrl = $logoUrl;

        return $this;
    }

    /**
     * Additional issuer information (collegiate number, professional registration, etc.)
     */
    public function getAdditionalInfo(): ?string
    {
        return $this->additionalInfo;
    }

    /**
     * Additional issuer information (collegiate number, professional registration, etc.)
     */
    public function setAdditionalInfo(?string $additionalInfo): self
    {
        $this->initialized['additionalInfo'] = true;
        $this->additionalInfo = $additionalInfo;

        return $this;
    }

    public function definedProperties(): array
    {
        return ['legalName' => ['legal_name', 'getLegalName', 'setLegalName'], 'tradeName' => ['trade_name', 'getTradeName', 'setTradeName'], 'nif' => ['nif', 'getNif', 'setNif'], 'address' => ['address', 'getAddress', 'setAddress'], 'phone' => ['phone', 'getPhone', 'setPhone'], 'email' => ['email', 'getEmail', 'setEmail'], 'website' => ['website', 'getWebsite', 'setWebsite'], 'logoUrl' => ['logo_url', 'getLogoUrl', 'setLogoUrl'], 'additionalInfo' => ['additional_info', 'getAdditionalInfo', 'setAdditionalInfo']];
    }
}
