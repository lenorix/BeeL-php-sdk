<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;
class AccountImportResult implements AdditionalPropertiesInterface
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
     * @var AccountImportMetadata
     */
    protected $metadata;
    /**
     * One entry per data row of the accounts file, in file order and **never filtered**: a row that failed keeps its place and its `row_number`, so the answer lines up with the spreadsheet.
     *
     * @var list<AccountImportItem>
     */
    protected $accountsValidation;
    /**
     * The optional customers file, checked **once** for the whole import. Absent when none was sent. What each account did with it is on its own row.
     *
     * @var AccountImportResultCustomersSource
     */
    protected $customersSource;
    /**
     * What the shared customers file did on **your own** company, when `options.apply_customers_to_own_company` asked for it. Absent otherwise. It sits at this level and not among the rows because your company is not a row of the accounts file: it is not provisioned, not activated and not given series — only its customers are seeded.
     * 
     * Same shape as the per-account outcome, with one difference that `metadata.is_dry_run` settles: in a preview `created` is what **would** be created, since nothing was written; in an import it is what reached the database. `already_existed` is what the company already knew either way — which is what makes re-uploading the file cheap here too.
     * 
     * **It is deliberately not added to `statistics.customers_created`.** That counter is about the accounts you imported, and folding your own copy into it would inflate the number you reconcile your onboarding against.
     * 
     * Your own company also **fails like a row**: if seeding it fails, the managed accounts already seeded stay exactly as they are and the failure is reported here, with its rows counted in `failed`.
     *
     * @var AccountImportResultOwnCompanyCustomers
     */
    protected $ownCompanyCustomers;
    /**
     * Aggregated outcome. Every field except the write counters classifies rows of the accounts file: each row falls into exactly one of `valid`, `with_warnings`, `already_existed`, `blocked` and `with_errors`, so those five add up to `total_rows`.
     * 
     * The write counters — `accounts_created`, `live_activations_created`, `series_created`, `customers_created` — are the only fields that count writes, so they are what to read to know whether an import worked. They are all `0` in a preview.
     *
     * @var AccountImportStatistics
     */
    protected $statistics;
    /**
     * @return AccountImportMetadata
     */
    public function getMetadata(): AccountImportMetadata
    {
        return $this->metadata;
    }
    /**
     * @param AccountImportMetadata $metadata
     *
     * @return self
     */
    public function setMetadata(AccountImportMetadata $metadata): self
    {
        $this->initialized['metadata'] = true;
        $this->metadata = $metadata;
        return $this;
    }
    /**
     * One entry per data row of the accounts file, in file order and **never filtered**: a row that failed keeps its place and its `row_number`, so the answer lines up with the spreadsheet.
     *
     * @return list<AccountImportItem>
     */
    public function getAccountsValidation(): array
    {
        return $this->accountsValidation;
    }
    /**
     * One entry per data row of the accounts file, in file order and **never filtered**: a row that failed keeps its place and its `row_number`, so the answer lines up with the spreadsheet.
     *
     * @param list<AccountImportItem> $accountsValidation
     *
     * @return self
     */
    public function setAccountsValidation(array $accountsValidation): self
    {
        $this->initialized['accountsValidation'] = true;
        $this->accountsValidation = $accountsValidation;
        return $this;
    }
    /**
     * The optional customers file, checked **once** for the whole import. Absent when none was sent. What each account did with it is on its own row.
     *
     * @return AccountImportResultCustomersSource
     */
    public function getCustomersSource(): AccountImportResultCustomersSource
    {
        return $this->customersSource;
    }
    /**
     * The optional customers file, checked **once** for the whole import. Absent when none was sent. What each account did with it is on its own row.
     *
     * @param AccountImportResultCustomersSource $customersSource
     *
     * @return self
     */
    public function setCustomersSource(AccountImportResultCustomersSource $customersSource): self
    {
        $this->initialized['customersSource'] = true;
        $this->customersSource = $customersSource;
        return $this;
    }
    /**
     * What the shared customers file did on **your own** company, when `options.apply_customers_to_own_company` asked for it. Absent otherwise. It sits at this level and not among the rows because your company is not a row of the accounts file: it is not provisioned, not activated and not given series — only its customers are seeded.
     * 
     * Same shape as the per-account outcome, with one difference that `metadata.is_dry_run` settles: in a preview `created` is what **would** be created, since nothing was written; in an import it is what reached the database. `already_existed` is what the company already knew either way — which is what makes re-uploading the file cheap here too.
     * 
     * **It is deliberately not added to `statistics.customers_created`.** That counter is about the accounts you imported, and folding your own copy into it would inflate the number you reconcile your onboarding against.
     * 
     * Your own company also **fails like a row**: if seeding it fails, the managed accounts already seeded stay exactly as they are and the failure is reported here, with its rows counted in `failed`.
     *
     * @return AccountImportResultOwnCompanyCustomers
     */
    public function getOwnCompanyCustomers(): AccountImportResultOwnCompanyCustomers
    {
        return $this->ownCompanyCustomers;
    }
    /**
    * What the shared customers file did on **your own** company, when `options.apply_customers_to_own_company` asked for it. Absent otherwise. It sits at this level and not among the rows because your company is not a row of the accounts file: it is not provisioned, not activated and not given series — only its customers are seeded.
    
    Same shape as the per-account outcome, with one difference that `metadata.is_dry_run` settles: in a preview `created` is what **would** be created, since nothing was written; in an import it is what reached the database. `already_existed` is what the company already knew either way — which is what makes re-uploading the file cheap here too.
    
    **It is deliberately not added to `statistics.customers_created`.** That counter is about the accounts you imported, and folding your own copy into it would inflate the number you reconcile your onboarding against.
    
    Your own company also **fails like a row**: if seeding it fails, the managed accounts already seeded stay exactly as they are and the failure is reported here, with its rows counted in `failed`.
    *
    * @param AccountImportResultOwnCompanyCustomers $ownCompanyCustomers
    *
    * @return self
    */
    public function setOwnCompanyCustomers(AccountImportResultOwnCompanyCustomers $ownCompanyCustomers): self
    {
        $this->initialized['ownCompanyCustomers'] = true;
        $this->ownCompanyCustomers = $ownCompanyCustomers;
        return $this;
    }
    /**
     * Aggregated outcome. Every field except the write counters classifies rows of the accounts file: each row falls into exactly one of `valid`, `with_warnings`, `already_existed`, `blocked` and `with_errors`, so those five add up to `total_rows`.
     * 
     * The write counters — `accounts_created`, `live_activations_created`, `series_created`, `customers_created` — are the only fields that count writes, so they are what to read to know whether an import worked. They are all `0` in a preview.
     *
     * @return AccountImportStatistics
     */
    public function getStatistics(): AccountImportStatistics
    {
        return $this->statistics;
    }
    /**
    * Aggregated outcome. Every field except the write counters classifies rows of the accounts file: each row falls into exactly one of `valid`, `with_warnings`, `already_existed`, `blocked` and `with_errors`, so those five add up to `total_rows`.
    
    The write counters — `accounts_created`, `live_activations_created`, `series_created`, `customers_created` — are the only fields that count writes, so they are what to read to know whether an import worked. They are all `0` in a preview.
    *
    * @param AccountImportStatistics $statistics
    *
    * @return self
    */
    public function setStatistics(AccountImportStatistics $statistics): self
    {
        $this->initialized['statistics'] = true;
        $this->statistics = $statistics;
        return $this;
    }
    public function definedProperties(): array
    {
        return ['metadata' => ['metadata', 'getMetadata', 'setMetadata'], 'accountsValidation' => ['accounts_validation', 'getAccountsValidation', 'setAccountsValidation'], 'customersSource' => ['customers_source', 'getCustomersSource', 'setCustomersSource'], 'ownCompanyCustomers' => ['own_company_customers', 'getOwnCompanyCustomers', 'setOwnCompanyCustomers'], 'statistics' => ['statistics', 'getStatistics', 'setStatistics']];
    }
}