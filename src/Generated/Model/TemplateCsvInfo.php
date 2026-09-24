<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;
class TemplateCsvInfo implements AdditionalPropertiesInterface
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
     * Template file name
     *
     * @var string
     */
    protected $filename;
    /**
     * Required CSV headers. Both the English headers below and their Spanish
     * equivalents are accepted by the import endpoint (the downloadable template
     * uses the Spanish headers):
     * `legal_name`=`nombre_fiscal`, `phone`=`telefono`,
     * `address_street`=`direccion_calle`, `address_number`=`direccion_numero`,
     * `address_postal_code`=`direccion_codigo_postal`,
     * `address_city`=`direccion_poblacion`, `address_province`=`direccion_provincia`
     * (`nif` and `email` are identical in both languages).
     * 
     *
     * @var list<string>
     */
    protected $headers;
    /**
     * Number of example rows in the template
     *
     * @var int
     */
    protected $exampleRows;
    /**
     * Maximum number of allowed records
     *
     * @var int
     */
    protected $maxRecords;
    /**
     * Maximum file size in MB
     *
     * @var float
     */
    protected $maxFileSizeMb;
    /**
     * Template file name
     *
     * @return string
     */
    public function getFilename(): string
    {
        return $this->filename;
    }
    /**
     * Template file name
     *
     * @param string $filename
     *
     * @return self
     */
    public function setFilename(string $filename): self
    {
        $this->initialized['filename'] = true;
        $this->filename = $filename;
        return $this;
    }
    /**
     * Required CSV headers. Both the English headers below and their Spanish
     * equivalents are accepted by the import endpoint (the downloadable template
     * uses the Spanish headers):
     * `legal_name`=`nombre_fiscal`, `phone`=`telefono`,
     * `address_street`=`direccion_calle`, `address_number`=`direccion_numero`,
     * `address_postal_code`=`direccion_codigo_postal`,
     * `address_city`=`direccion_poblacion`, `address_province`=`direccion_provincia`
     * (`nif` and `email` are identical in both languages).
     * 
     *
     * @return list<string>
     */
    public function getHeaders(): array
    {
        return $this->headers;
    }
    /**
    * Required CSV headers. Both the English headers below and their Spanish
    equivalents are accepted by the import endpoint (the downloadable template
    uses the Spanish headers):
    `legal_name`=`nombre_fiscal`, `phone`=`telefono`,
    `address_street`=`direccion_calle`, `address_number`=`direccion_numero`,
    `address_postal_code`=`direccion_codigo_postal`,
    `address_city`=`direccion_poblacion`, `address_province`=`direccion_provincia`
    (`nif` and `email` are identical in both languages).
    
    *
    * @param list<string> $headers
    *
    * @return self
    */
    public function setHeaders(array $headers): self
    {
        $this->initialized['headers'] = true;
        $this->headers = $headers;
        return $this;
    }
    /**
     * Number of example rows in the template
     *
     * @return int
     */
    public function getExampleRows(): int
    {
        return $this->exampleRows;
    }
    /**
     * Number of example rows in the template
     *
     * @param int $exampleRows
     *
     * @return self
     */
    public function setExampleRows(int $exampleRows): self
    {
        $this->initialized['exampleRows'] = true;
        $this->exampleRows = $exampleRows;
        return $this;
    }
    /**
     * Maximum number of allowed records
     *
     * @return int
     */
    public function getMaxRecords(): int
    {
        return $this->maxRecords;
    }
    /**
     * Maximum number of allowed records
     *
     * @param int $maxRecords
     *
     * @return self
     */
    public function setMaxRecords(int $maxRecords): self
    {
        $this->initialized['maxRecords'] = true;
        $this->maxRecords = $maxRecords;
        return $this;
    }
    /**
     * Maximum file size in MB
     *
     * @return float
     */
    public function getMaxFileSizeMb(): float
    {
        return $this->maxFileSizeMb;
    }
    /**
     * Maximum file size in MB
     *
     * @param float $maxFileSizeMb
     *
     * @return self
     */
    public function setMaxFileSizeMb(float $maxFileSizeMb): self
    {
        $this->initialized['maxFileSizeMb'] = true;
        $this->maxFileSizeMb = $maxFileSizeMb;
        return $this;
    }
    public function definedProperties(): array
    {
        return ['filename' => ['filename', 'getFilename', 'setFilename'], 'headers' => ['headers', 'getHeaders', 'setHeaders'], 'exampleRows' => ['example_rows', 'getExampleRows', 'setExampleRows'], 'maxRecords' => ['max_records', 'getMaxRecords', 'setMaxRecords'], 'maxFileSizeMb' => ['max_file_size_mb', 'getMaxFileSizeMb', 'setMaxFileSizeMb']];
    }
}