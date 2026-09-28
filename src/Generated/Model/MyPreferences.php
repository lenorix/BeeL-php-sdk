<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;

class MyPreferences implements AdditionalPropertiesInterface
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
     * Supported languages: `es` Spanish, `en` English, `ca` Catalan.
     *
     *
     * @var string
     */
    protected $language;

    /**
     * Supported languages: `es` Spanish, `en` English, `ca` Catalan.
     */
    public function getLanguage(): string
    {
        return $this->language;
    }

    /**
     * Supported languages: `es` Spanish, `en` English, `ca` Catalan.
     */
    public function setLanguage(string $language): self
    {
        $this->initialized['language'] = true;
        $this->language = $language;

        return $this;
    }

    public function definedProperties(): array
    {
        return ['language' => ['language', 'getLanguage', 'setLanguage']];
    }
}
