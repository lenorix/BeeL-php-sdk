<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;
use Psr\Http\Message\StreamInterface;

class AccountImportUpload implements AdditionalPropertiesInterface
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
     * CSV with one managed account per row, in the format of `GET /v1/templates/account-import`: UTF-8, header names matched case-insensitively, and `,`, `;` or tab accepted as separator.
     *
     * The header row does not have to be the first line. A spreadsheet almost never starts on it — there is a title, sometimes a blank line — and that preamble travels ahead of the data when the sheet is exported. Everything before the first line carrying the required columns is ignored, within the first 20 lines. Reported `row_number`s still count from the top of the file, so they match what you see when you open it.
     *
     * @var string|resource|StreamInterface
     */
    protected $accountsFile;

    /**
     * Optional CSV of customers to apply to **every** account of this import, in the format of `GET /v1/templates/customer-import`. Idempotent by tax id. Its preamble is skipped the same way — it comes out of the same spreadsheet.
     *
     * @var string|resource|StreamInterface
     */
    protected $customersFile;

    /**
     * Settings that apply to **every row** of the file. They live here and not as columns because an agency onboards all of its managed accounts the same way: a column nobody varies is a column everybody mistypes.
     *
     * Travels as an `application/json` part named `options` inside the multipart body — send it with its own `Content-Type: application/json` (`-F 'options=…;type=application/json'` in curl). Omit the part entirely to take the defaults.
     *
     * @var AccountImportOptions
     */
    protected $options;

    /**
     * CSV with one managed account per row, in the format of `GET /v1/templates/account-import`: UTF-8, header names matched case-insensitively, and `,`, `;` or tab accepted as separator.
     *
     * The header row does not have to be the first line. A spreadsheet almost never starts on it — there is a title, sometimes a blank line — and that preamble travels ahead of the data when the sheet is exported. Everything before the first line carrying the required columns is ignored, within the first 20 lines. Reported `row_number`s still count from the top of the file, so they match what you see when you open it.
     *
     * @return string|resource|StreamInterface
     */
    public function getAccountsFile()
    {
        return $this->accountsFile;
    }

    /**
     * CSV with one managed account per row, in the format of `GET /v1/templates/account-import`: UTF-8, header names matched case-insensitively, and `,`, `;` or tab accepted as separator.

    The header row does not have to be the first line. A spreadsheet almost never starts on it — there is a title, sometimes a blank line — and that preamble travels ahead of the data when the sheet is exported. Everything before the first line carrying the required columns is ignored, within the first 20 lines. Reported `row_number`s still count from the top of the file, so they match what you see when you open it.
     *
     * @param  string|resource|StreamInterface  $accountsFile
     */
    public function setAccountsFile($accountsFile): self
    {
        $this->initialized['accountsFile'] = true;
        $this->accountsFile = $accountsFile;

        return $this;
    }

    /**
     * Optional CSV of customers to apply to **every** account of this import, in the format of `GET /v1/templates/customer-import`. Idempotent by tax id. Its preamble is skipped the same way — it comes out of the same spreadsheet.
     *
     * @return string|resource|StreamInterface
     */
    public function getCustomersFile()
    {
        return $this->customersFile;
    }

    /**
     * Optional CSV of customers to apply to **every** account of this import, in the format of `GET /v1/templates/customer-import`. Idempotent by tax id. Its preamble is skipped the same way — it comes out of the same spreadsheet.
     *
     * @param  string|resource|StreamInterface  $customersFile
     */
    public function setCustomersFile($customersFile): self
    {
        $this->initialized['customersFile'] = true;
        $this->customersFile = $customersFile;

        return $this;
    }

    /**
     * Settings that apply to **every row** of the file. They live here and not as columns because an agency onboards all of its managed accounts the same way: a column nobody varies is a column everybody mistypes.
     *
     * Travels as an `application/json` part named `options` inside the multipart body — send it with its own `Content-Type: application/json` (`-F 'options=…;type=application/json'` in curl). Omit the part entirely to take the defaults.
     */
    public function getOptions(): AccountImportOptions
    {
        return $this->options;
    }

    /**
     * Settings that apply to **every row** of the file. They live here and not as columns because an agency onboards all of its managed accounts the same way: a column nobody varies is a column everybody mistypes.

    Travels as an `application/json` part named `options` inside the multipart body — send it with its own `Content-Type: application/json` (`-F 'options=…;type=application/json'` in curl). Omit the part entirely to take the defaults.
     */
    public function setOptions(AccountImportOptions $options): self
    {
        $this->initialized['options'] = true;
        $this->options = $options;

        return $this;
    }

    public function definedProperties(): array
    {
        return ['accountsFile' => ['accounts_file', 'getAccountsFile', 'setAccountsFile'], 'customersFile' => ['customers_file', 'getCustomersFile', 'setCustomersFile'], 'options' => ['options', 'getOptions', 'setOptions']];
    }
}
