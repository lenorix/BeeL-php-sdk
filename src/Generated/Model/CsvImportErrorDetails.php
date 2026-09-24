<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;
class CsvImportErrorDetails implements AdditionalPropertiesInterface
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
     * Size of the uploaded file, in MB rounded to one decimal (`CSV_FILE_TOO_LARGE`)
     *
     * @var float
     */
    protected $fileSizeMb;
    /**
     * Largest file the operation accepts, in MB (`CSV_FILE_TOO_LARGE`)
     *
     * @var int
     */
    protected $maxFileSizeMb;
    /**
     * Data rows read from the file, header row excluded (`TOO_MANY_RECORDS`)
     *
     * @var int
     */
    protected $recordCount;
    /**
     * Most data rows the operation accepts (`TOO_MANY_RECORDS`)
     *
     * @var int
     */
    protected $maxRecords;
    /**
     * Every required column absent from the header row, not just the first one found missing
     * (`MISSING_HEADERS`)
     * 
     *
     * @var list<string>
     */
    protected $missingHeaders;
    /**
     * Columns actually read from the header row, one entry per column (`MISSING_HEADERS`).
     * Comparing it against `missing_headers` names what to add to the file.
     * 
     *
     * @var list<string>
     */
    protected $foundHeaders;
    /**
     * Size of the uploaded file, in MB rounded to one decimal (`CSV_FILE_TOO_LARGE`)
     *
     * @return float
     */
    public function getFileSizeMb(): float
    {
        return $this->fileSizeMb;
    }
    /**
     * Size of the uploaded file, in MB rounded to one decimal (`CSV_FILE_TOO_LARGE`)
     *
     * @param float $fileSizeMb
     *
     * @return self
     */
    public function setFileSizeMb(float $fileSizeMb): self
    {
        $this->initialized['fileSizeMb'] = true;
        $this->fileSizeMb = $fileSizeMb;
        return $this;
    }
    /**
     * Largest file the operation accepts, in MB (`CSV_FILE_TOO_LARGE`)
     *
     * @return int
     */
    public function getMaxFileSizeMb(): int
    {
        return $this->maxFileSizeMb;
    }
    /**
     * Largest file the operation accepts, in MB (`CSV_FILE_TOO_LARGE`)
     *
     * @param int $maxFileSizeMb
     *
     * @return self
     */
    public function setMaxFileSizeMb(int $maxFileSizeMb): self
    {
        $this->initialized['maxFileSizeMb'] = true;
        $this->maxFileSizeMb = $maxFileSizeMb;
        return $this;
    }
    /**
     * Data rows read from the file, header row excluded (`TOO_MANY_RECORDS`)
     *
     * @return int
     */
    public function getRecordCount(): int
    {
        return $this->recordCount;
    }
    /**
     * Data rows read from the file, header row excluded (`TOO_MANY_RECORDS`)
     *
     * @param int $recordCount
     *
     * @return self
     */
    public function setRecordCount(int $recordCount): self
    {
        $this->initialized['recordCount'] = true;
        $this->recordCount = $recordCount;
        return $this;
    }
    /**
     * Most data rows the operation accepts (`TOO_MANY_RECORDS`)
     *
     * @return int
     */
    public function getMaxRecords(): int
    {
        return $this->maxRecords;
    }
    /**
     * Most data rows the operation accepts (`TOO_MANY_RECORDS`)
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
     * Every required column absent from the header row, not just the first one found missing
     * (`MISSING_HEADERS`)
     * 
     *
     * @return list<string>
     */
    public function getMissingHeaders(): array
    {
        return $this->missingHeaders;
    }
    /**
    * Every required column absent from the header row, not just the first one found missing
    (`MISSING_HEADERS`)
    
    *
    * @param list<string> $missingHeaders
    *
    * @return self
    */
    public function setMissingHeaders(array $missingHeaders): self
    {
        $this->initialized['missingHeaders'] = true;
        $this->missingHeaders = $missingHeaders;
        return $this;
    }
    /**
     * Columns actually read from the header row, one entry per column (`MISSING_HEADERS`).
     * Comparing it against `missing_headers` names what to add to the file.
     * 
     *
     * @return list<string>
     */
    public function getFoundHeaders(): array
    {
        return $this->foundHeaders;
    }
    /**
    * Columns actually read from the header row, one entry per column (`MISSING_HEADERS`).
    Comparing it against `missing_headers` names what to add to the file.
    
    *
    * @param list<string> $foundHeaders
    *
    * @return self
    */
    public function setFoundHeaders(array $foundHeaders): self
    {
        $this->initialized['foundHeaders'] = true;
        $this->foundHeaders = $foundHeaders;
        return $this;
    }
    public function definedProperties(): array
    {
        return ['fileSizeMb' => ['file_size_mb', 'getFileSizeMb', 'setFileSizeMb'], 'maxFileSizeMb' => ['max_file_size_mb', 'getMaxFileSizeMb', 'setMaxFileSizeMb'], 'recordCount' => ['record_count', 'getRecordCount', 'setRecordCount'], 'maxRecords' => ['max_records', 'getMaxRecords', 'setMaxRecords'], 'missingHeaders' => ['missing_headers', 'getMissingHeaders', 'setMissingHeaders'], 'foundHeaders' => ['found_headers', 'getFoundHeaders', 'setFoundHeaders']];
    }
}