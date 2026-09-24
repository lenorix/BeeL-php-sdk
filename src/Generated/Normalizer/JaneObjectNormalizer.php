<?php

namespace Lenorix\BeelSdk\Generated\Normalizer;

use Jane\Component\JsonSchemaRuntime\Reference;
use Lenorix\BeelSdk\Generated\Model\AccountClaim;
use Lenorix\BeelSdk\Generated\Model\AccountImportCustomerRow;
use Lenorix\BeelSdk\Generated\Model\AccountImportCustomersOutcome;
use Lenorix\BeelSdk\Generated\Model\AccountImportCustomersSource;
use Lenorix\BeelSdk\Generated\Model\AccountImportIssue;
use Lenorix\BeelSdk\Generated\Model\AccountImportItem;
use Lenorix\BeelSdk\Generated\Model\AccountImportItemAccount;
use Lenorix\BeelSdk\Generated\Model\AccountImportItemCustomers;
use Lenorix\BeelSdk\Generated\Model\AccountImportMetadata;
use Lenorix\BeelSdk\Generated\Model\AccountImportOptions;
use Lenorix\BeelSdk\Generated\Model\AccountImportResult;
use Lenorix\BeelSdk\Generated\Model\AccountImportResultCustomersSource;
use Lenorix\BeelSdk\Generated\Model\AccountImportResultOwnCompanyCustomers;
use Lenorix\BeelSdk\Generated\Model\AccountImportSeriesOutcome;
use Lenorix\BeelSdk\Generated\Model\AccountImportStatistics;
use Lenorix\BeelSdk\Generated\Model\AccountImportUpload;
use Lenorix\BeelSdk\Generated\Model\AccountMember;
use Lenorix\BeelSdk\Generated\Model\ActivateCompanyRequest;
use Lenorix\BeelSdk\Generated\Model\Address;
use Lenorix\BeelSdk\Generated\Model\AddressResponse;
use Lenorix\BeelSdk\Generated\Model\AlternativeIdentifier;
use Lenorix\BeelSdk\Generated\Model\BulkOperationResponse;
use Lenorix\BeelSdk\Generated\Model\BulkOperationResult;
use Lenorix\BeelSdk\Generated\Model\BulkOperationResultFailuresItem;
use Lenorix\BeelSdk\Generated\Model\ChangeAccessLevelRequest;
use Lenorix\BeelSdk\Generated\Model\ChangeMemberRoleRequest;
use Lenorix\BeelSdk\Generated\Model\ClaimTokenResult;
use Lenorix\BeelSdk\Generated\Model\CompanyActivation;
use Lenorix\BeelSdk\Generated\Model\CompanyActivationResponse;
use Lenorix\BeelSdk\Generated\Model\CompanyCreatedData;
use Lenorix\BeelSdk\Generated\Model\CompanyData;
use Lenorix\BeelSdk\Generated\Model\CompanyDataAddress;
use Lenorix\BeelSdk\Generated\Model\CompanyDataLegalRepresentative;
use Lenorix\BeelSdk\Generated\Model\CompanyDataReadiness;
use Lenorix\BeelSdk\Generated\Model\CompanyDeactivation;
use Lenorix\BeelSdk\Generated\Model\CompanyLogo;
use Lenorix\BeelSdk\Generated\Model\CompanyNumbering;
use Lenorix\BeelSdk\Generated\Model\CompanyPaymentConnection;
use Lenorix\BeelSdk\Generated\Model\CompanyPaymentConnectionFilters;
use Lenorix\BeelSdk\Generated\Model\CompanyPaymentConnectionResponse;
use Lenorix\BeelSdk\Generated\Model\CompanyPaymentConnectionSeries;
use Lenorix\BeelSdk\Generated\Model\CompanyPaymentConnectionTaxInclusiveTax;
use Lenorix\BeelSdk\Generated\Model\CompanyResponse;
use Lenorix\BeelSdk\Generated\Model\CompanyResponse201;
use Lenorix\BeelSdk\Generated\Model\CompanySeriesNumbering;
use Lenorix\BeelSdk\Generated\Model\CompanyStatsData;
use Lenorix\BeelSdk\Generated\Model\ConvertProformaToInvoiceRequest;
use Lenorix\BeelSdk\Generated\Model\CreateClaimTokenRequest;
use Lenorix\BeelSdk\Generated\Model\CreateCompanyRequest;
use Lenorix\BeelSdk\Generated\Model\CreateCorrectiveInvoiceRequest;
use Lenorix\BeelSdk\Generated\Model\CreateCorrectiveInvoiceRequestLinesItem;
use Lenorix\BeelSdk\Generated\Model\CreateCustomerRequest;
use Lenorix\BeelSdk\Generated\Model\CreateInvitationRequest;
use Lenorix\BeelSdk\Generated\Model\CreateInvoiceBatchRequest;
use Lenorix\BeelSdk\Generated\Model\CreateInvoiceDeliveryRequest;
use Lenorix\BeelSdk\Generated\Model\CreateInvoiceDerivationRequest;
use Lenorix\BeelSdk\Generated\Model\CreateInvoiceExportRequest;
use Lenorix\BeelSdk\Generated\Model\CreateInvoicePdfArchiveRequest;
use Lenorix\BeelSdk\Generated\Model\CreateInvoiceRequest;
use Lenorix\BeelSdk\Generated\Model\CreateInvoiceRequestLinesItem;
use Lenorix\BeelSdk\Generated\Model\CreateInvoiceRequestLinesItemMainTax;
use Lenorix\BeelSdk\Generated\Model\CreateProductRequest;
use Lenorix\BeelSdk\Generated\Model\CreateRecurringFromInvoiceRequest;
use Lenorix\BeelSdk\Generated\Model\CreateRecurringInvoiceDerivationRequest;
use Lenorix\BeelSdk\Generated\Model\CreateRecurringInvoiceRequest;
use Lenorix\BeelSdk\Generated\Model\CreateSeriesRequest;
use Lenorix\BeelSdk\Generated\Model\CreateWebhookSubscriptionRequest;
use Lenorix\BeelSdk\Generated\Model\CsvCustomerPreview;
use Lenorix\BeelSdk\Generated\Model\CsvCustomerPreviewCustomer;
use Lenorix\BeelSdk\Generated\Model\CsvImportErrorDetails;
use Lenorix\BeelSdk\Generated\Model\CsvImportMetadata;
use Lenorix\BeelSdk\Generated\Model\CsvImportPreviewResult;
use Lenorix\BeelSdk\Generated\Model\CsvImportResult;
use Lenorix\BeelSdk\Generated\Model\CsvImportStatistics;
use Lenorix\BeelSdk\Generated\Model\CsvValidationError;
use Lenorix\BeelSdk\Generated\Model\Customer;
use Lenorix\BeelSdk\Generated\Model\CustomerAddress;
use Lenorix\BeelSdk\Generated\Model\CustomerBulkDeleteError;
use Lenorix\BeelSdk\Generated\Model\CustomerBulkDeleteItem;
use Lenorix\BeelSdk\Generated\Model\CustomerBulkDeleteItemError;
use Lenorix\BeelSdk\Generated\Model\CustomerBulkDeleteLegacyError;
use Lenorix\BeelSdk\Generated\Model\CustomerBulkDeleteMetadata;
use Lenorix\BeelSdk\Generated\Model\CustomerBulkDeleteResult;
use Lenorix\BeelSdk\Generated\Model\CustomerBulkDeleteStatistics;
use Lenorix\BeelSdk\Generated\Model\CustomerEcho;
use Lenorix\BeelSdk\Generated\Model\CustomerValidationError;
use Lenorix\BeelSdk\Generated\Model\CustomerValidationItem;
use Lenorix\BeelSdk\Generated\Model\CustomerValidationItemCustomer;
use Lenorix\BeelSdk\Generated\Model\CustomerValidationMetadata;
use Lenorix\BeelSdk\Generated\Model\CustomerValidationStatistics;
use Lenorix\BeelSdk\Generated\Model\CustomerValidationUnifiedResult;
use Lenorix\BeelSdk\Generated\Model\CustomerValidationWarning;
use Lenorix\BeelSdk\Generated\Model\DiscardManagedPaymentEventResponse;
use Lenorix\BeelSdk\Generated\Model\DocumentTypeDefaultStatus;
use Lenorix\BeelSdk\Generated\Model\EmailAttachment;
use Lenorix\BeelSdk\Generated\Model\EmailConfiguration;
use Lenorix\BeelSdk\Generated\Model\EmailDeliveryDetail;
use Lenorix\BeelSdk\Generated\Model\EmailDeliveryDetailResponse;
use Lenorix\BeelSdk\Generated\Model\EmailDeliveryIndicator;
use Lenorix\BeelSdk\Generated\Model\EmailDeliveryIndicatorListResponse;
use Lenorix\BeelSdk\Generated\Model\EmailDeliveryIndicatorListResponseData;
use Lenorix\BeelSdk\Generated\Model\EmailDeliveryListResponse;
use Lenorix\BeelSdk\Generated\Model\EmailDeliveryListResponseData;
use Lenorix\BeelSdk\Generated\Model\EmailDeliveryResponse;
use Lenorix\BeelSdk\Generated\Model\EquivalenceSurcharge;
use Lenorix\BeelSdk\Generated\Model\ErrorDetail;
use Lenorix\BeelSdk\Generated\Model\ErrorResponse;
use Lenorix\BeelSdk\Generated\Model\ExemptionReasonCatalogEntry;
use Lenorix\BeelSdk\Generated\Model\FieldDeserializationError;
use Lenorix\BeelSdk\Generated\Model\FiscalSummaryResponse;
use Lenorix\BeelSdk\Generated\Model\GenerationHistoryResponse;
use Lenorix\BeelSdk\Generated\Model\GrantAssignment;
use Lenorix\BeelSdk\Generated\Model\InitiatePaymentConnectionRequest;
use Lenorix\BeelSdk\Generated\Model\InitiatePaymentConnectionResponse;
use Lenorix\BeelSdk\Generated\Model\InitiatePaymentConnectionResponseData;
use Lenorix\BeelSdk\Generated\Model\Invitation;
use Lenorix\BeelSdk\Generated\Model\InvitationSummary;
use Lenorix\BeelSdk\Generated\Model\Invoice;
use Lenorix\BeelSdk\Generated\Model\InvoiceAttachment;
use Lenorix\BeelSdk\Generated\Model\InvoiceBase;
use Lenorix\BeelSdk\Generated\Model\InvoiceBaseEmailConfig;
use Lenorix\BeelSdk\Generated\Model\InvoiceCustomization;
use Lenorix\BeelSdk\Generated\Model\InvoiceCustomizationOptionsResponse;
use Lenorix\BeelSdk\Generated\Model\InvoiceEmailDeliveryOutcome;
use Lenorix\BeelSdk\Generated\Model\InvoiceExportFilters;
use Lenorix\BeelSdk\Generated\Model\InvoiceFiscalData;
use Lenorix\BeelSdk\Generated\Model\InvoiceLine;
use Lenorix\BeelSdk\Generated\Model\InvoiceLineTemplateResponse;
use Lenorix\BeelSdk\Generated\Model\InvoicePdfResponse;
use Lenorix\BeelSdk\Generated\Model\InvoicePdfResponseData;
use Lenorix\BeelSdk\Generated\Model\InvoicePreviewResponse;
use Lenorix\BeelSdk\Generated\Model\InvoicePreviewResponseData;
use Lenorix\BeelSdk\Generated\Model\InvoiceProcessingOptions;
use Lenorix\BeelSdk\Generated\Model\InvoiceProcessingOptionsEmailConfig;
use Lenorix\BeelSdk\Generated\Model\InvoiceSchedule;
use Lenorix\BeelSdk\Generated\Model\InvoiceScheduleResponse;
use Lenorix\BeelSdk\Generated\Model\InvoiceSendRecord;
use Lenorix\BeelSdk\Generated\Model\InvoiceSeries;
use Lenorix\BeelSdk\Generated\Model\InvoiceTemplateOption;
use Lenorix\BeelSdk\Generated\Model\InvoiceTotals;
use Lenorix\BeelSdk\Generated\Model\InvoiceTotalsIrpfBreakdownItem;
use Lenorix\BeelSdk\Generated\Model\InvoiceTotalsSurchargeBreakdownItem;
use Lenorix\BeelSdk\Generated\Model\InvoiceTotalsVatBreakdownItem;
use Lenorix\BeelSdk\Generated\Model\IrpfBracket;
use Lenorix\BeelSdk\Generated\Model\IrpfType;
use Lenorix\BeelSdk\Generated\Model\IssuerData;
use Lenorix\BeelSdk\Generated\Model\IssuerDataAddress;
use Lenorix\BeelSdk\Generated\Model\IssuingReadinessData;
use Lenorix\BeelSdk\Generated\Model\IssuingReadinessDataVerifactu;
use Lenorix\BeelSdk\Generated\Model\IssuingReadinessResponse;
use Lenorix\BeelSdk\Generated\Model\LegalRepresentative;
use Lenorix\BeelSdk\Generated\Model\LegalRepresentativeAddress;
use Lenorix\BeelSdk\Generated\Model\LegalRepresentativeResponse;
use Lenorix\BeelSdk\Generated\Model\LegalRepresentativeResponseAddress;
use Lenorix\BeelSdk\Generated\Model\LineUnitPriceOutOfRangeDetails;
use Lenorix\BeelSdk\Generated\Model\ListCompanies200Response;
use Lenorix\BeelSdk\Generated\Model\ListCompanies200ResponseData;
use Lenorix\BeelSdk\Generated\Model\ListCompanyStats200Response;
use Lenorix\BeelSdk\Generated\Model\ListCompanyStats200ResponseData;
use Lenorix\BeelSdk\Generated\Model\ListManagedPaymentConnectionsResponse;
use Lenorix\BeelSdk\Generated\Model\ListManagedPaymentConnectionsResponseData;
use Lenorix\BeelSdk\Generated\Model\ListManagedPaymentEventsResponse;
use Lenorix\BeelSdk\Generated\Model\ListManagedPaymentEventsResponseData;
use Lenorix\BeelSdk\Generated\Model\ManagedAccountSummary;
use Lenorix\BeelSdk\Generated\Model\ManagedAccountSummaryClaim;
use Lenorix\BeelSdk\Generated\Model\ManagedPaymentConnection;
use Lenorix\BeelSdk\Generated\Model\ManagedPaymentEvent;
use Lenorix\BeelSdk\Generated\Model\ManagedPaymentEventDraftResponse;
use Lenorix\BeelSdk\Generated\Model\ManagedPaymentEventDraftResponseData;
use Lenorix\BeelSdk\Generated\Model\ManagedPaymentEventResponse;
use Lenorix\BeelSdk\Generated\Model\MemberPermissions;
use Lenorix\BeelSdk\Generated\Model\MyCredential;
use Lenorix\BeelSdk\Generated\Model\MyIdentity;
use Lenorix\BeelSdk\Generated\Model\MyPreferences;
use Lenorix\BeelSdk\Generated\Model\NextOccurrence;
use Lenorix\BeelSdk\Generated\Model\Pagination;
use Lenorix\BeelSdk\Generated\Model\PatchCustomerRequest;
use Lenorix\BeelSdk\Generated\Model\PatchCustomerRequestAddress;
use Lenorix\BeelSdk\Generated\Model\PatchCustomerRequestAlternativeId;
use Lenorix\BeelSdk\Generated\Model\PatchCustomerRequestPreferredPaymentMethod;
use Lenorix\BeelSdk\Generated\Model\PatchProductRequest;
use Lenorix\BeelSdk\Generated\Model\PatchProductRequestMainTax;
use Lenorix\BeelSdk\Generated\Model\PatchRecurringInvoiceRequest;
use Lenorix\BeelSdk\Generated\Model\PatchRecurringInvoiceRequestEmailConfiguration;
use Lenorix\BeelSdk\Generated\Model\PatchSeriesRequest;
use Lenorix\BeelSdk\Generated\Model\PayloadTooLargeDetails;
use Lenorix\BeelSdk\Generated\Model\PaymentEventCounts;
use Lenorix\BeelSdk\Generated\Model\PaymentEventFailureReasonCount;
use Lenorix\BeelSdk\Generated\Model\PaymentInfo;
use Lenorix\BeelSdk\Generated\Model\PaymentRequiredResponse;
use Lenorix\BeelSdk\Generated\Model\Product;
use Lenorix\BeelSdk\Generated\Model\ProductBulkCreateError;
use Lenorix\BeelSdk\Generated\Model\ProductBulkCreateItem;
use Lenorix\BeelSdk\Generated\Model\ProductBulkCreateItemError;
use Lenorix\BeelSdk\Generated\Model\ProductBulkCreateLegacyError;
use Lenorix\BeelSdk\Generated\Model\ProductBulkCreateLegacySummary;
use Lenorix\BeelSdk\Generated\Model\ProductBulkCreateMetadata;
use Lenorix\BeelSdk\Generated\Model\ProductBulkCreateResult;
use Lenorix\BeelSdk\Generated\Model\ProductBulkCreateResultSummary;
use Lenorix\BeelSdk\Generated\Model\ProductBulkCreateStatistics;
use Lenorix\BeelSdk\Generated\Model\ProductQueryParams;
use Lenorix\BeelSdk\Generated\Model\ProductResponse;
use Lenorix\BeelSdk\Generated\Model\ProductsListResponse;
use Lenorix\BeelSdk\Generated\Model\ProductsListResponseData;
use Lenorix\BeelSdk\Generated\Model\ProvisionAccountRequest;
use Lenorix\BeelSdk\Generated\Model\ProvisionAccountRequestTaxProfile;
use Lenorix\BeelSdk\Generated\Model\ProvisionAccountResult;
use Lenorix\BeelSdk\Generated\Model\ProvisioningUsage;
use Lenorix\BeelSdk\Generated\Model\ProvisionTaxProfile;
use Lenorix\BeelSdk\Generated\Model\PutMemberGrantRequest;
use Lenorix\BeelSdk\Generated\Model\QueriedPeriod;
use Lenorix\BeelSdk\Generated\Model\Recipient;
use Lenorix\BeelSdk\Generated\Model\RecipientAlternativeId;
use Lenorix\BeelSdk\Generated\Model\RecipientData;
use Lenorix\BeelSdk\Generated\Model\RecipientDataAddress;
use Lenorix\BeelSdk\Generated\Model\RecipientDataAlternativeId;
use Lenorix\BeelSdk\Generated\Model\RecurringEmailConfigRequest;
use Lenorix\BeelSdk\Generated\Model\RecurringEmailConfigResponse;
use Lenorix\BeelSdk\Generated\Model\RecurringInvoiceCompletion;
use Lenorix\BeelSdk\Generated\Model\RecurringInvoicePause;
use Lenorix\BeelSdk\Generated\Model\RecurringInvoiceResponse;
use Lenorix\BeelSdk\Generated\Model\RecurringInvoiceResponseRecipientAlternativeId;
use Lenorix\BeelSdk\Generated\Model\RecurringInvoiceStats;
use Lenorix\BeelSdk\Generated\Model\RecurringInvoiceStatsBlock;
use Lenorix\BeelSdk\Generated\Model\RecurringLineRequest;
use Lenorix\BeelSdk\Generated\Model\RelatedInvoice;
use Lenorix\BeelSdk\Generated\Model\RepresentationActionResponse;
use Lenorix\BeelSdk\Generated\Model\RepresentationActionResponseData;
use Lenorix\BeelSdk\Generated\Model\RepresentationDownloadResponse;
use Lenorix\BeelSdk\Generated\Model\RepresentationDownloadResponseData;
use Lenorix\BeelSdk\Generated\Model\RepresentationStatusResponse;
use Lenorix\BeelSdk\Generated\Model\RepresentationStatusResponseData;
use Lenorix\BeelSdk\Generated\Model\RequestLogCursorPagination;
use Lenorix\BeelSdk\Generated\Model\RequestLogDetail;
use Lenorix\BeelSdk\Generated\Model\RequestLogListResponse;
use Lenorix\BeelSdk\Generated\Model\RequestLogListResponseData;
use Lenorix\BeelSdk\Generated\Model\RequestLogSingleResponse;
use Lenorix\BeelSdk\Generated\Model\RequestLogSummary;
use Lenorix\BeelSdk\Generated\Model\ResolveManagedPaymentEventResponse;
use Lenorix\BeelSdk\Generated\Model\ResponseCustomerImportRejected;
use Lenorix\BeelSdk\Generated\Model\ResponseCustomerImportRejectedError;
use Lenorix\BeelSdk\Generated\Model\ResponseInvalidJsonFormat;
use Lenorix\BeelSdk\Generated\Model\ResponseInvalidJsonFormatError;
use Lenorix\BeelSdk\Generated\Model\ResponseMeta;
use Lenorix\BeelSdk\Generated\Model\ResponsePayloadTooLarge;
use Lenorix\BeelSdk\Generated\Model\ResponsePayloadTooLargeError;
use Lenorix\BeelSdk\Generated\Model\RestoreManagedPaymentEventResponse;
use Lenorix\BeelSdk\Generated\Model\RetryManagedPaymentEventResponse;
use Lenorix\BeelSdk\Generated\Model\SendEmailRequest;
use Lenorix\BeelSdk\Generated\Model\SeriesInfo;
use Lenorix\BeelSdk\Generated\Model\SetAccountOwnerRequest;
use Lenorix\BeelSdk\Generated\Model\SetInvoiceScheduleRequest;
use Lenorix\BeelSdk\Generated\Model\SetInvoiceStatusRequest;
use Lenorix\BeelSdk\Generated\Model\SetInvoiceStatusRequestPaymentMethod;
use Lenorix\BeelSdk\Generated\Model\SetRecurringInvoiceStatusRequest;
use Lenorix\BeelSdk\Generated\Model\SuccessResponse;
use Lenorix\BeelSdk\Generated\Model\SurchargeBreakdownItem;
use Lenorix\BeelSdk\Generated\Model\TaxBreakdownItem;
use Lenorix\BeelSdk\Generated\Model\TaxConfiguration;
use Lenorix\BeelSdk\Generated\Model\TaxConfigurationDefaultMainTax;
use Lenorix\BeelSdk\Generated\Model\TaxInfo;
use Lenorix\BeelSdk\Generated\Model\TaxPercentage;
use Lenorix\BeelSdk\Generated\Model\TaxRegime;
use Lenorix\BeelSdk\Generated\Model\TaxTypesCatalog;
use Lenorix\BeelSdk\Generated\Model\TaxTypesCatalogResponse;
use Lenorix\BeelSdk\Generated\Model\TemplateCsvInfo;
use Lenorix\BeelSdk\Generated\Model\UpdateCompanyPaymentConnectionRequest;
use Lenorix\BeelSdk\Generated\Model\UpdateCompanyPaymentConnectionRequestFilterConfig;
use Lenorix\BeelSdk\Generated\Model\UpdateCompanyPaymentConnectionRequestTaxInclusiveTax;
use Lenorix\BeelSdk\Generated\Model\UpdateCompanyPaymentConnectionSeries;
use Lenorix\BeelSdk\Generated\Model\UpdateCompanyRequest;
use Lenorix\BeelSdk\Generated\Model\UpdateCustomerRequest;
use Lenorix\BeelSdk\Generated\Model\UpdateCustomerRequestAlternativeId;
use Lenorix\BeelSdk\Generated\Model\UpdateInvoiceCustomizationRequest;
use Lenorix\BeelSdk\Generated\Model\UpdateInvoiceRequest;
use Lenorix\BeelSdk\Generated\Model\UpdateInvoiceRequestLinesItem;
use Lenorix\BeelSdk\Generated\Model\UpdateInvoiceRequestOptions;
use Lenorix\BeelSdk\Generated\Model\UpdateInvoiceRequestOptionsEmailConfig;
use Lenorix\BeelSdk\Generated\Model\UpdateInvoiceRequestPaymentInfo;
use Lenorix\BeelSdk\Generated\Model\UpdateInvoiceRequestRecipient;
use Lenorix\BeelSdk\Generated\Model\UpdateMeRequest;
use Lenorix\BeelSdk\Generated\Model\UpdateProductRequest;
use Lenorix\BeelSdk\Generated\Model\UpdateRecurringInvoiceRequest;
use Lenorix\BeelSdk\Generated\Model\UpdateSeriesRequest;
use Lenorix\BeelSdk\Generated\Model\UpdateTaxConfigurationRequest;
use Lenorix\BeelSdk\Generated\Model\UpdateTaxConfigurationRequestDefaultMainTax;
use Lenorix\BeelSdk\Generated\Model\UpdateVeriFactuConfigurationRequest;
use Lenorix\BeelSdk\Generated\Model\UpdateWebhookSubscriptionRequest;
use Lenorix\BeelSdk\Generated\Model\V1AccountsAccountIdClaimTokensPostResponse201;
use Lenorix\BeelSdk\Generated\Model\V1AccountsAccountIdCompaniesCompanyIdRepresentationSubmitPostBody;
use Lenorix\BeelSdk\Generated\Model\V1AccountsAccountIdGetResponse200;
use Lenorix\BeelSdk\Generated\Model\V1AccountsAccountIdInvitationsGetResponse200;
use Lenorix\BeelSdk\Generated\Model\V1AccountsAccountIdInvitationsGetResponse200Data;
use Lenorix\BeelSdk\Generated\Model\V1AccountsAccountIdInvitationsInvitationIdGetResponse200;
use Lenorix\BeelSdk\Generated\Model\V1AccountsAccountIdInvitationsPostResponse201;
use Lenorix\BeelSdk\Generated\Model\V1AccountsAccountIdMembersGetResponse200;
use Lenorix\BeelSdk\Generated\Model\V1AccountsAccountIdMembersGetResponse200Data;
use Lenorix\BeelSdk\Generated\Model\V1AccountsAccountIdMembersMemberIdGetResponse200;
use Lenorix\BeelSdk\Generated\Model\V1AccountsAccountIdMembersMemberIdGrantsCompanyIdPutResponse200;
use Lenorix\BeelSdk\Generated\Model\V1AccountsAccountIdMembersMemberIdGrantsGetResponse200;
use Lenorix\BeelSdk\Generated\Model\V1AccountsAccountIdMembersMemberIdGrantsGetResponse200Data;
use Lenorix\BeelSdk\Generated\Model\V1AccountsAccountIdMembersMemberIdPatchResponse200;
use Lenorix\BeelSdk\Generated\Model\V1AccountsAccountIdUsageGetResponse200;
use Lenorix\BeelSdk\Generated\Model\V1AccountsAccountIdWebhooksGetResponse200;
use Lenorix\BeelSdk\Generated\Model\V1AccountsAccountIdWebhooksGetResponse200Data;
use Lenorix\BeelSdk\Generated\Model\V1AccountsAccountIdWebhooksPostResponse201;
use Lenorix\BeelSdk\Generated\Model\V1AccountsAccountIdWebhooksWebhookIdDeliveriesDeliveryIdRetryPostResponse200;
use Lenorix\BeelSdk\Generated\Model\V1AccountsAccountIdWebhooksWebhookIdDeliveriesGetResponse200;
use Lenorix\BeelSdk\Generated\Model\V1AccountsAccountIdWebhooksWebhookIdDeliveriesGetResponse200Data;
use Lenorix\BeelSdk\Generated\Model\V1AccountsAccountIdWebhooksWebhookIdGetResponse200;
use Lenorix\BeelSdk\Generated\Model\V1AccountsAccountIdWebhooksWebhookIdPatchResponse200;
use Lenorix\BeelSdk\Generated\Model\V1AccountsAccountIdWebhooksWebhookIdSecretPostResponse200;
use Lenorix\BeelSdk\Generated\Model\V1AccountsAccountIdWebhooksWebhookIdTestPostResponse200;
use Lenorix\BeelSdk\Generated\Model\V1AccountsGetResponse200;
use Lenorix\BeelSdk\Generated\Model\V1AccountsGetResponse200Data;
use Lenorix\BeelSdk\Generated\Model\V1AccountsImportsPostResponse201;
use Lenorix\BeelSdk\Generated\Model\V1AccountsImportsPreviewPostResponse200;
use Lenorix\BeelSdk\Generated\Model\V1AccountsPostResponse201;
use Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdActivationsDeleteResponse200;
use Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdCustomersBulkDeleteResponse200;
use Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdCustomersBulkPostBody;
use Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdCustomersBulkPostResponse200;
use Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdCustomersBulkPostResponse201;
use Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdCustomersCustomerIdGetResponse200;
use Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdCustomersCustomerIdPatchResponse200;
use Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdCustomersGetResponse200;
use Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdCustomersGetResponse200Data;
use Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdCustomersImportsPostBody;
use Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdCustomersImportsPostResponse201;
use Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdCustomersImportsPreviewPostBody;
use Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdCustomersImportsPreviewPostResponse200;
use Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdCustomersPostResponse201;
use Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdFiscalSummaryGetResponse200;
use Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdInvoiceCustomizationGetResponse200;
use Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdInvoiceCustomizationPutResponse200;
use Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdInvoicesDeliveriesPostResponse200;
use Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdInvoicesDeliveriesPostResponse200Data;
use Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdInvoicesDeliveriesPostResponse200DataFailuresItem;
use Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdInvoicesDerivationsPostResponse201;
use Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdInvoicesGetResponse200;
use Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdInvoicesGetResponse200Data;
use Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdInvoicesInvoiceIdConvertToInvoicePostResponse201;
use Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdInvoicesInvoiceIdCorrectivePostResponse201;
use Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdInvoicesInvoiceIdGetResponse200;
use Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdInvoicesInvoiceIdIssuePostResponse200;
use Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdInvoicesInvoiceIdPatchResponse200;
use Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdInvoicesInvoiceIdSchedulePutResponse200;
use Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdInvoicesInvoiceIdSendPostResponse200;
use Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdInvoicesInvoiceIdSendPostResponse200Data;
use Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdInvoicesInvoiceIdStatusPutResponse200;
use Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdInvoicesInvoiceIdVoidPostResponse200;
use Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdInvoicesPostResponse201;
use Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdLogoPutBody;
use Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdLogoPutResponse200;
use Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdProductsBulkDeleteResponse200;
use Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdProductsBulkDeleteResponse200Data;
use Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdProductsBulkDeleteResponse200DataErrorsItem;
use Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdProductsBulkDeleteResponse200DataSummary;
use Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdProductsBulkPostBody;
use Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdProductsBulkPostResponse201;
use Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdProductsGetResponse200;
use Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdProductsGetResponse200Data;
use Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdProductsPostResponse201;
use Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdProductsProductIdGetResponse200;
use Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdProductsProductIdPatchResponse200;
use Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdRecurringInvoicesDerivationsPostResponse201;
use Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdRecurringInvoicesGetResponse200;
use Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdRecurringInvoicesGetResponse200Data;
use Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdRecurringInvoicesPostResponse201;
use Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdRecurringInvoicesRecurringInvoiceIdGeneratePostResponse201;
use Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdRecurringInvoicesRecurringInvoiceIdGeneratePostResponse201Data;
use Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdRecurringInvoicesRecurringInvoiceIdGetResponse200;
use Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdRecurringInvoicesRecurringInvoiceIdHistoryGetResponse200;
use Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdRecurringInvoicesRecurringInvoiceIdHistoryGetResponse200Data;
use Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdRecurringInvoicesRecurringInvoiceIdNextOccurrenceGetResponse200;
use Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdRecurringInvoicesRecurringInvoiceIdPatchResponse200;
use Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdRecurringInvoicesRecurringInvoiceIdSkipPostResponse200;
use Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdRecurringInvoicesRecurringInvoiceIdStatusPutResponse200;
use Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdRecurringInvoicesStatsGetResponse200;
use Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdRepresentationSubmitPostBody;
use Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdSeriesDefaultsGetResponse200;
use Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdSeriesDefaultsGetResponse200Data;
use Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdSeriesDefaultsPutResponse200;
use Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdSeriesDefaultsPutResponse200Data;
use Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdSeriesGetResponse200;
use Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdSeriesGetResponse200Data;
use Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdSeriesGetResponse200DataPagination;
use Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdSeriesPostResponse201;
use Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdSeriesSeriesIdDefaultPutResponse200;
use Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdSeriesSeriesIdGetResponse200;
use Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdSeriesSeriesIdPatchResponse200;
use Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdTaxConfigurationGetResponse200;
use Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdTaxConfigurationPutResponse200;
use Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdVerifactuConfigurationGetResponse200;
use Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdVerifactuConfigurationPutResponse200;
use Lenorix\BeelSdk\Generated\Model\V1ConfigurationInvoiceCustomizationOptionsGetResponse200;
use Lenorix\BeelSdk\Generated\Model\V1ConfigurationLanguagePutBody;
use Lenorix\BeelSdk\Generated\Model\V1ConfigurationLanguagePutResponse200;
use Lenorix\BeelSdk\Generated\Model\V1ConfigurationLanguagePutResponse200Data;
use Lenorix\BeelSdk\Generated\Model\V1ConfigurationSeriesDefaultsPostResponse200;
use Lenorix\BeelSdk\Generated\Model\V1ConfigurationSeriesDefaultsPostResponse200Data;
use Lenorix\BeelSdk\Generated\Model\V1ConfigurationSeriesDefaultsStatusGetResponse200;
use Lenorix\BeelSdk\Generated\Model\V1ConfigurationSeriesDefaultsStatusGetResponse200Data;
use Lenorix\BeelSdk\Generated\Model\V1ConfigurationSeriesGetResponse200;
use Lenorix\BeelSdk\Generated\Model\V1ConfigurationSeriesGetResponse200Data;
use Lenorix\BeelSdk\Generated\Model\V1ConfigurationSeriesGetResponse200DataPagination;
use Lenorix\BeelSdk\Generated\Model\V1ConfigurationSeriesPostResponse201;
use Lenorix\BeelSdk\Generated\Model\V1ConfigurationSeriesSeriesIdDefaultPostResponse200;
use Lenorix\BeelSdk\Generated\Model\V1ConfigurationSeriesSeriesIdPatchResponse200;
use Lenorix\BeelSdk\Generated\Model\V1ConfigurationSeriesSeriesIdPutResponse200;
use Lenorix\BeelSdk\Generated\Model\V1ConfigurationTaxesGetResponse200;
use Lenorix\BeelSdk\Generated\Model\V1ConfigurationTaxesPutResponse200;
use Lenorix\BeelSdk\Generated\Model\V1ConfigurationVerifactuGetResponse200;
use Lenorix\BeelSdk\Generated\Model\V1ConfigurationVerifactuPutResponse200;
use Lenorix\BeelSdk\Generated\Model\V1CustomersBulkDeleteResponse200;
use Lenorix\BeelSdk\Generated\Model\V1CustomersBulkPostBody;
use Lenorix\BeelSdk\Generated\Model\V1CustomersBulkPostResponse200;
use Lenorix\BeelSdk\Generated\Model\V1CustomersBulkPostResponse201;
use Lenorix\BeelSdk\Generated\Model\V1CustomersBulkPostResponse422;
use Lenorix\BeelSdk\Generated\Model\V1CustomersBulkPostResponse422Error;
use Lenorix\BeelSdk\Generated\Model\V1CustomersBulkPostResponse422ErrorErrorsItem;
use Lenorix\BeelSdk\Generated\Model\V1CustomersCustomerIdDeleteResponse200;
use Lenorix\BeelSdk\Generated\Model\V1CustomersCustomerIdDeleteResponse200Data;
use Lenorix\BeelSdk\Generated\Model\V1CustomersCustomerIdGetResponse200;
use Lenorix\BeelSdk\Generated\Model\V1CustomersCustomerIdPatchResponse200;
use Lenorix\BeelSdk\Generated\Model\V1CustomersCustomerIdPutResponse200;
use Lenorix\BeelSdk\Generated\Model\V1CustomersGetResponse200;
use Lenorix\BeelSdk\Generated\Model\V1CustomersGetResponse200Data;
use Lenorix\BeelSdk\Generated\Model\V1CustomersImportCsvPreviewPostBody;
use Lenorix\BeelSdk\Generated\Model\V1CustomersImportCsvPreviewPostResponse200;
use Lenorix\BeelSdk\Generated\Model\V1CustomersImportHoldedContactsPostBody;
use Lenorix\BeelSdk\Generated\Model\V1CustomersImportHoldedContactsPostResponse200;
use Lenorix\BeelSdk\Generated\Model\V1CustomersPostResponse201;
use Lenorix\BeelSdk\Generated\Model\V1InvoiceCustomizationOptionsGetResponse200;
use Lenorix\BeelSdk\Generated\Model\V1InvoicesBulkIssuePostBody;
use Lenorix\BeelSdk\Generated\Model\V1InvoicesBulkPdfPostBody;
use Lenorix\BeelSdk\Generated\Model\V1InvoicesBulkSendPostBody;
use Lenorix\BeelSdk\Generated\Model\V1InvoicesBulkSendPostResponse200;
use Lenorix\BeelSdk\Generated\Model\V1InvoicesBulkSendPostResponse200Data;
use Lenorix\BeelSdk\Generated\Model\V1InvoicesBulkSendPostResponse200DataFailuresItem;
use Lenorix\BeelSdk\Generated\Model\V1InvoicesBulkStatusPostBody;
use Lenorix\BeelSdk\Generated\Model\V1InvoicesExportExcelPostBody;
use Lenorix\BeelSdk\Generated\Model\V1InvoicesGetResponse200;
use Lenorix\BeelSdk\Generated\Model\V1InvoicesGetResponse200Data;
use Lenorix\BeelSdk\Generated\Model\V1InvoicesInvoiceIdConvertToInvoicePostResponse201;
use Lenorix\BeelSdk\Generated\Model\V1InvoicesInvoiceIdCorrectivePostResponse201;
use Lenorix\BeelSdk\Generated\Model\V1InvoicesInvoiceIdCreateRecurringPostResponse201;
use Lenorix\BeelSdk\Generated\Model\V1InvoicesInvoiceIdDuplicatePostBody;
use Lenorix\BeelSdk\Generated\Model\V1InvoicesInvoiceIdDuplicatePostResponse201;
use Lenorix\BeelSdk\Generated\Model\V1InvoicesInvoiceIdGetResponse200;
use Lenorix\BeelSdk\Generated\Model\V1InvoicesInvoiceIdIssuePostResponse200;
use Lenorix\BeelSdk\Generated\Model\V1InvoicesInvoiceIdMarkPaidPostBody;
use Lenorix\BeelSdk\Generated\Model\V1InvoicesInvoiceIdMarkPaidPostResponse200;
use Lenorix\BeelSdk\Generated\Model\V1InvoicesInvoiceIdMarkSentPostBody;
use Lenorix\BeelSdk\Generated\Model\V1InvoicesInvoiceIdMarkSentPostResponse200;
use Lenorix\BeelSdk\Generated\Model\V1InvoicesInvoiceIdPutResponse200;
use Lenorix\BeelSdk\Generated\Model\V1InvoicesInvoiceIdReschedulePatchBody;
use Lenorix\BeelSdk\Generated\Model\V1InvoicesInvoiceIdReschedulePatchResponse200;
use Lenorix\BeelSdk\Generated\Model\V1InvoicesInvoiceIdRevertToIssuedPostResponse200;
use Lenorix\BeelSdk\Generated\Model\V1InvoicesInvoiceIdSchedulePostBody;
use Lenorix\BeelSdk\Generated\Model\V1InvoicesInvoiceIdSchedulePostResponse200;
use Lenorix\BeelSdk\Generated\Model\V1InvoicesInvoiceIdSendPostResponse200;
use Lenorix\BeelSdk\Generated\Model\V1InvoicesInvoiceIdSendPostResponse200Data;
use Lenorix\BeelSdk\Generated\Model\V1InvoicesInvoiceIdUnschedulePostResponse200;
use Lenorix\BeelSdk\Generated\Model\V1InvoicesInvoiceIdVoidPostResponse200;
use Lenorix\BeelSdk\Generated\Model\V1InvoicesPostResponse201;
use Lenorix\BeelSdk\Generated\Model\V1MeIdentityGetResponse200;
use Lenorix\BeelSdk\Generated\Model\V1MePatchResponse200;
use Lenorix\BeelSdk\Generated\Model\V1NifValidatePostResponse200;
use Lenorix\BeelSdk\Generated\Model\V1ProductsBulkDeleteBody;
use Lenorix\BeelSdk\Generated\Model\V1ProductsBulkDeleteResponse200;
use Lenorix\BeelSdk\Generated\Model\V1ProductsBulkDeleteResponse200Data;
use Lenorix\BeelSdk\Generated\Model\V1ProductsBulkDeleteResponse200DataErrorsItem;
use Lenorix\BeelSdk\Generated\Model\V1ProductsBulkDeleteResponse200DataSummary;
use Lenorix\BeelSdk\Generated\Model\V1ProductsBulkPostBody;
use Lenorix\BeelSdk\Generated\Model\V1ProductsBulkPostResponse201;
use Lenorix\BeelSdk\Generated\Model\V1ProductsGetResponse200;
use Lenorix\BeelSdk\Generated\Model\V1ProductsGetResponse200Data;
use Lenorix\BeelSdk\Generated\Model\V1ProductsPostResponse201;
use Lenorix\BeelSdk\Generated\Model\V1ProductsProductIdGetResponse200;
use Lenorix\BeelSdk\Generated\Model\V1ProductsProductIdPatchResponse200;
use Lenorix\BeelSdk\Generated\Model\V1ProductsProductIdPutResponse200;
use Lenorix\BeelSdk\Generated\Model\V1ProductsSearchGetResponse200;
use Lenorix\BeelSdk\Generated\Model\V1RecurringInvoicesGetResponse200;
use Lenorix\BeelSdk\Generated\Model\V1RecurringInvoicesGetResponse200Data;
use Lenorix\BeelSdk\Generated\Model\V1RecurringInvoicesPostResponse201;
use Lenorix\BeelSdk\Generated\Model\V1RecurringInvoicesRecurringInvoiceIdGeneratePostResponse201;
use Lenorix\BeelSdk\Generated\Model\V1RecurringInvoicesRecurringInvoiceIdGeneratePostResponse201Data;
use Lenorix\BeelSdk\Generated\Model\V1RecurringInvoicesRecurringInvoiceIdGetResponse200;
use Lenorix\BeelSdk\Generated\Model\V1RecurringInvoicesRecurringInvoiceIdHistoryGetResponse200;
use Lenorix\BeelSdk\Generated\Model\V1RecurringInvoicesRecurringInvoiceIdHistoryGetResponse200Data;
use Lenorix\BeelSdk\Generated\Model\V1RecurringInvoicesRecurringInvoiceIdPatchResponse200;
use Lenorix\BeelSdk\Generated\Model\V1RecurringInvoicesRecurringInvoiceIdPausePostResponse200;
use Lenorix\BeelSdk\Generated\Model\V1RecurringInvoicesRecurringInvoiceIdPreviewGetResponse200;
use Lenorix\BeelSdk\Generated\Model\V1RecurringInvoicesRecurringInvoiceIdPutResponse200;
use Lenorix\BeelSdk\Generated\Model\V1RecurringInvoicesRecurringInvoiceIdResumePostResponse200;
use Lenorix\BeelSdk\Generated\Model\V1RecurringInvoicesRecurringInvoiceIdSkipPostResponse200;
use Lenorix\BeelSdk\Generated\Model\V1WebhooksGetResponse200;
use Lenorix\BeelSdk\Generated\Model\V1WebhooksGetResponse200Data;
use Lenorix\BeelSdk\Generated\Model\V1WebhooksPostResponse201;
use Lenorix\BeelSdk\Generated\Model\V1WebhooksWebhookIdDeliveriesDeliveryIdRetryPostResponse200;
use Lenorix\BeelSdk\Generated\Model\V1WebhooksWebhookIdDeliveriesGetResponse200;
use Lenorix\BeelSdk\Generated\Model\V1WebhooksWebhookIdDeliveriesGetResponse200Data;
use Lenorix\BeelSdk\Generated\Model\V1WebhooksWebhookIdGetResponse200;
use Lenorix\BeelSdk\Generated\Model\V1WebhooksWebhookIdPatchResponse200;
use Lenorix\BeelSdk\Generated\Model\V1WebhooksWebhookIdSecretPostResponse200;
use Lenorix\BeelSdk\Generated\Model\V1WebhooksWebhookIdTestPostResponse200;
use Lenorix\BeelSdk\Generated\Model\ValidateNifRequest;
use Lenorix\BeelSdk\Generated\Model\ValidateNifResponse;
use Lenorix\BeelSdk\Generated\Model\VatType;
use Lenorix\BeelSdk\Generated\Model\VeriFactu;
use Lenorix\BeelSdk\Generated\Model\VeriFactuConfiguration;
use Lenorix\BeelSdk\Generated\Model\VeriFactuRegimeKey;
use Lenorix\BeelSdk\Generated\Model\VoidInvoiceRequest;
use Lenorix\BeelSdk\Generated\Model\WebhookDeliveryLog;
use Lenorix\BeelSdk\Generated\Model\WebhookEvent;
use Lenorix\BeelSdk\Generated\Model\WebhookEventDataAccountClaimed;
use Lenorix\BeelSdk\Generated\Model\WebhookEventDataCompanyCreated;
use Lenorix\BeelSdk\Generated\Model\WebhookEventDataInvoiceEmailSent;
use Lenorix\BeelSdk\Generated\Model\WebhookEventDataInvoiceIssued;
use Lenorix\BeelSdk\Generated\Model\WebhookEventDataInvoicePdfGenerated;
use Lenorix\BeelSdk\Generated\Model\WebhookEventDataInvoiceScheduleFailed;
use Lenorix\BeelSdk\Generated\Model\WebhookEventDataInvoiceVoided;
use Lenorix\BeelSdk\Generated\Model\WebhookEventDataRecurringInvoicePaused;
use Lenorix\BeelSdk\Generated\Model\WebhookEventDataRepresentationSigned;
use Lenorix\BeelSdk\Generated\Model\WebhookEventDataVeriFactuStatusUpdated;
use Lenorix\BeelSdk\Generated\Model\WebhookSubscription;
use Lenorix\BeelSdk\Generated\Model\WebhookSubscriptionWithSecret;
use Lenorix\BeelSdk\Generated\Model\WebhookSubscriptionWithSecretTestDelivery;
use Lenorix\BeelSdk\Generated\Model\WebhookTestResult;
use Lenorix\BeelSdk\Generated\Runtime\Normalizer\CheckArray;
use Lenorix\BeelSdk\Generated\Runtime\Normalizer\ReferenceNormalizer;
use Lenorix\BeelSdk\Generated\Runtime\Normalizer\ValidatorTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class JaneObjectNormalizer implements DenormalizerAwareInterface, DenormalizerInterface, NormalizerAwareInterface, NormalizerInterface
{
    use CheckArray;
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use ValidatorTrait;

    protected $normalizers = [

        SuccessResponse::class => SuccessResponseNormalizer::class,

        ErrorResponse::class => ErrorResponseNormalizer::class,

        ErrorDetail::class => ErrorDetailNormalizer::class,

        LineUnitPriceOutOfRangeDetails::class => LineUnitPriceOutOfRangeDetailsNormalizer::class,

        ResponseMeta::class => ResponseMetaNormalizer::class,

        Pagination::class => PaginationNormalizer::class,

        LegalRepresentative::class => LegalRepresentativeNormalizer::class,

        LegalRepresentativeAddress::class => LegalRepresentativeAddressNormalizer::class,

        LegalRepresentativeResponse::class => LegalRepresentativeResponseNormalizer::class,

        LegalRepresentativeResponseAddress::class => LegalRepresentativeResponseAddressNormalizer::class,

        Address::class => AddressNormalizer::class,

        AddressResponse::class => AddressResponseNormalizer::class,

        Invoice::class => InvoiceNormalizer::class,

        SeriesInfo::class => SeriesInfoNormalizer::class,

        IssuerData::class => IssuerDataNormalizer::class,

        IssuerDataAddress::class => IssuerDataAddressNormalizer::class,

        RecipientData::class => RecipientDataNormalizer::class,

        RecipientDataAlternativeId::class => RecipientDataAlternativeIdNormalizer::class,

        RecipientDataAddress::class => RecipientDataAddressNormalizer::class,

        InvoiceLine::class => InvoiceLineNormalizer::class,

        InvoiceTotals::class => InvoiceTotalsNormalizer::class,

        InvoiceTotalsVatBreakdownItem::class => InvoiceTotalsVatBreakdownItemNormalizer::class,

        InvoiceTotalsSurchargeBreakdownItem::class => InvoiceTotalsSurchargeBreakdownItemNormalizer::class,

        InvoiceTotalsIrpfBreakdownItem::class => InvoiceTotalsIrpfBreakdownItemNormalizer::class,

        PaymentInfo::class => PaymentInfoNormalizer::class,

        VeriFactu::class => VeriFactuNormalizer::class,

        Recipient::class => RecipientNormalizer::class,

        RecipientAlternativeId::class => RecipientAlternativeIdNormalizer::class,

        CreateInvoiceRequest::class => CreateInvoiceRequestNormalizer::class,

        CreateInvoiceRequestLinesItem::class => CreateInvoiceRequestLinesItemNormalizer::class,

        CreateInvoiceRequestLinesItemMainTax::class => CreateInvoiceRequestLinesItemMainTaxNormalizer::class,

        InvoiceProcessingOptions::class => InvoiceProcessingOptionsNormalizer::class,

        InvoiceProcessingOptionsEmailConfig::class => InvoiceProcessingOptionsEmailConfigNormalizer::class,

        UpdateInvoiceRequest::class => UpdateInvoiceRequestNormalizer::class,

        UpdateInvoiceRequestRecipient::class => UpdateInvoiceRequestRecipientNormalizer::class,

        UpdateInvoiceRequestLinesItem::class => UpdateInvoiceRequestLinesItemNormalizer::class,

        UpdateInvoiceRequestPaymentInfo::class => UpdateInvoiceRequestPaymentInfoNormalizer::class,

        UpdateInvoiceRequestOptions::class => UpdateInvoiceRequestOptionsNormalizer::class,

        UpdateInvoiceRequestOptionsEmailConfig::class => UpdateInvoiceRequestOptionsEmailConfigNormalizer::class,

        EmailConfiguration::class => EmailConfigurationNormalizer::class,

        SendEmailRequest::class => SendEmailRequestNormalizer::class,

        CreateCorrectiveInvoiceRequest::class => CreateCorrectiveInvoiceRequestNormalizer::class,

        CreateCorrectiveInvoiceRequestLinesItem::class => CreateCorrectiveInvoiceRequestLinesItemNormalizer::class,

        InvoicePdfResponse::class => InvoicePdfResponseNormalizer::class,

        InvoicePdfResponseData::class => InvoicePdfResponseDataNormalizer::class,

        Customer::class => CustomerNormalizer::class,

        CustomerAddress::class => CustomerAddressNormalizer::class,

        AlternativeIdentifier::class => AlternativeIdentifierNormalizer::class,

        CreateCustomerRequest::class => CreateCustomerRequestNormalizer::class,

        UpdateCustomerRequest::class => UpdateCustomerRequestNormalizer::class,

        UpdateCustomerRequestAlternativeId::class => UpdateCustomerRequestAlternativeIdNormalizer::class,

        CsvImportResult::class => CsvImportResultNormalizer::class,

        CsvValidationError::class => CsvValidationErrorNormalizer::class,

        TemplateCsvInfo::class => TemplateCsvInfoNormalizer::class,

        CsvImportPreviewResult::class => CsvImportPreviewResultNormalizer::class,

        CsvImportMetadata::class => CsvImportMetadataNormalizer::class,

        CsvCustomerPreview::class => CsvCustomerPreviewNormalizer::class,

        CsvCustomerPreviewCustomer::class => CsvCustomerPreviewCustomerNormalizer::class,

        CsvImportStatistics::class => CsvImportStatisticsNormalizer::class,

        Product::class => ProductNormalizer::class,

        CreateProductRequest::class => CreateProductRequestNormalizer::class,

        UpdateProductRequest::class => UpdateProductRequestNormalizer::class,

        ProductResponse::class => ProductResponseNormalizer::class,

        ProductsListResponse::class => ProductsListResponseNormalizer::class,

        ProductsListResponseData::class => ProductsListResponseDataNormalizer::class,

        ProductQueryParams::class => ProductQueryParamsNormalizer::class,

        VeriFactuConfiguration::class => VeriFactuConfigurationNormalizer::class,

        UpdateVeriFactuConfigurationRequest::class => UpdateVeriFactuConfigurationRequestNormalizer::class,

        TaxConfiguration::class => TaxConfigurationNormalizer::class,

        TaxConfigurationDefaultMainTax::class => TaxConfigurationDefaultMainTaxNormalizer::class,

        InvoiceSeries::class => InvoiceSeriesNormalizer::class,

        TaxRegime::class => TaxRegimeNormalizer::class,

        VeriFactuRegimeKey::class => VeriFactuRegimeKeyNormalizer::class,

        TaxPercentage::class => TaxPercentageNormalizer::class,

        VatType::class => VatTypeNormalizer::class,

        IrpfType::class => IrpfTypeNormalizer::class,

        EquivalenceSurcharge::class => EquivalenceSurchargeNormalizer::class,

        CreateSeriesRequest::class => CreateSeriesRequestNormalizer::class,

        UpdateSeriesRequest::class => UpdateSeriesRequestNormalizer::class,

        UpdateTaxConfigurationRequest::class => UpdateTaxConfigurationRequestNormalizer::class,

        UpdateTaxConfigurationRequestDefaultMainTax::class => UpdateTaxConfigurationRequestDefaultMainTaxNormalizer::class,

        ValidateNifRequest::class => ValidateNifRequestNormalizer::class,

        ValidateNifResponse::class => ValidateNifResponseNormalizer::class,

        InvoiceTemplateOption::class => InvoiceTemplateOptionNormalizer::class,

        InvoiceCustomizationOptionsResponse::class => InvoiceCustomizationOptionsResponseNormalizer::class,

        TaxInfo::class => TaxInfoNormalizer::class,

        CustomerValidationUnifiedResult::class => CustomerValidationUnifiedResultNormalizer::class,

        CustomerValidationMetadata::class => CustomerValidationMetadataNormalizer::class,

        CustomerValidationItem::class => CustomerValidationItemNormalizer::class,

        CustomerValidationItemCustomer::class => CustomerValidationItemCustomerNormalizer::class,

        CustomerValidationError::class => CustomerValidationErrorNormalizer::class,

        CustomerValidationWarning::class => CustomerValidationWarningNormalizer::class,

        CustomerValidationStatistics::class => CustomerValidationStatisticsNormalizer::class,

        RecurringInvoiceResponse::class => RecurringInvoiceResponseNormalizer::class,

        RecurringInvoiceResponseRecipientAlternativeId::class => RecurringInvoiceResponseRecipientAlternativeIdNormalizer::class,

        InvoiceLineTemplateResponse::class => InvoiceLineTemplateResponseNormalizer::class,

        RecurringEmailConfigResponse::class => RecurringEmailConfigResponseNormalizer::class,

        UpdateRecurringInvoiceRequest::class => UpdateRecurringInvoiceRequestNormalizer::class,

        SetRecurringInvoiceStatusRequest::class => SetRecurringInvoiceStatusRequestNormalizer::class,

        CreateRecurringInvoiceRequest::class => CreateRecurringInvoiceRequestNormalizer::class,

        CreateRecurringFromInvoiceRequest::class => CreateRecurringFromInvoiceRequestNormalizer::class,

        RecurringLineRequest::class => RecurringLineRequestNormalizer::class,

        RecurringEmailConfigRequest::class => RecurringEmailConfigRequestNormalizer::class,

        GenerationHistoryResponse::class => GenerationHistoryResponseNormalizer::class,

        CreateCompanyRequest::class => CreateCompanyRequestNormalizer::class,

        UpdateCompanyRequest::class => UpdateCompanyRequestNormalizer::class,

        CompanyData::class => CompanyDataNormalizer::class,

        CompanyDataAddress::class => CompanyDataAddressNormalizer::class,

        CompanyDataLegalRepresentative::class => CompanyDataLegalRepresentativeNormalizer::class,

        CompanyDataReadiness::class => CompanyDataReadinessNormalizer::class,

        CompanyCreatedData::class => CompanyCreatedDataNormalizer::class,

        CompanyResponse201::class => CompanyResponse201Normalizer::class,

        CompanyResponse::class => CompanyResponseNormalizer::class,

        ListCompanies200Response::class => ListCompanies200ResponseNormalizer::class,

        ListCompanies200ResponseData::class => ListCompanies200ResponseDataNormalizer::class,

        RepresentationActionResponse::class => RepresentationActionResponseNormalizer::class,

        RepresentationActionResponseData::class => RepresentationActionResponseDataNormalizer::class,

        RepresentationDownloadResponse::class => RepresentationDownloadResponseNormalizer::class,

        RepresentationDownloadResponseData::class => RepresentationDownloadResponseDataNormalizer::class,

        RepresentationStatusResponse::class => RepresentationStatusResponseNormalizer::class,

        RepresentationStatusResponseData::class => RepresentationStatusResponseDataNormalizer::class,

        CompanyLogo::class => CompanyLogoNormalizer::class,

        InvoiceCustomization::class => InvoiceCustomizationNormalizer::class,

        UpdateInvoiceCustomizationRequest::class => UpdateInvoiceCustomizationRequestNormalizer::class,

        InitiatePaymentConnectionRequest::class => InitiatePaymentConnectionRequestNormalizer::class,

        InitiatePaymentConnectionResponse::class => InitiatePaymentConnectionResponseNormalizer::class,

        InitiatePaymentConnectionResponseData::class => InitiatePaymentConnectionResponseDataNormalizer::class,

        CompanyPaymentConnection::class => CompanyPaymentConnectionNormalizer::class,

        CompanyPaymentConnectionTaxInclusiveTax::class => CompanyPaymentConnectionTaxInclusiveTaxNormalizer::class,

        CompanyPaymentConnectionResponse::class => CompanyPaymentConnectionResponseNormalizer::class,

        UpdateCompanyPaymentConnectionRequest::class => UpdateCompanyPaymentConnectionRequestNormalizer::class,

        UpdateCompanyPaymentConnectionRequestTaxInclusiveTax::class => UpdateCompanyPaymentConnectionRequestTaxInclusiveTaxNormalizer::class,

        UpdateCompanyPaymentConnectionRequestFilterConfig::class => UpdateCompanyPaymentConnectionRequestFilterConfigNormalizer::class,

        ManagedPaymentEvent::class => ManagedPaymentEventNormalizer::class,

        ListManagedPaymentEventsResponse::class => ListManagedPaymentEventsResponseNormalizer::class,

        ListManagedPaymentEventsResponseData::class => ListManagedPaymentEventsResponseDataNormalizer::class,

        ManagedPaymentEventResponse::class => ManagedPaymentEventResponseNormalizer::class,

        RetryManagedPaymentEventResponse::class => RetryManagedPaymentEventResponseNormalizer::class,

        ResolveManagedPaymentEventResponse::class => ResolveManagedPaymentEventResponseNormalizer::class,

        DiscardManagedPaymentEventResponse::class => DiscardManagedPaymentEventResponseNormalizer::class,

        RestoreManagedPaymentEventResponse::class => RestoreManagedPaymentEventResponseNormalizer::class,

        ManagedPaymentEventDraftResponse::class => ManagedPaymentEventDraftResponseNormalizer::class,

        ManagedPaymentEventDraftResponseData::class => ManagedPaymentEventDraftResponseDataNormalizer::class,

        EmailDeliveryResponse::class => EmailDeliveryResponseNormalizer::class,

        EmailDeliveryListResponse::class => EmailDeliveryListResponseNormalizer::class,

        EmailDeliveryListResponseData::class => EmailDeliveryListResponseDataNormalizer::class,

        EmailDeliveryDetail::class => EmailDeliveryDetailNormalizer::class,

        EmailAttachment::class => EmailAttachmentNormalizer::class,

        RelatedInvoice::class => RelatedInvoiceNormalizer::class,

        EmailDeliveryDetailResponse::class => EmailDeliveryDetailResponseNormalizer::class,

        EmailDeliveryIndicator::class => EmailDeliveryIndicatorNormalizer::class,

        EmailDeliveryIndicatorListResponse::class => EmailDeliveryIndicatorListResponseNormalizer::class,

        EmailDeliveryIndicatorListResponseData::class => EmailDeliveryIndicatorListResponseDataNormalizer::class,

        QueriedPeriod::class => QueriedPeriodNormalizer::class,

        TaxBreakdownItem::class => TaxBreakdownItemNormalizer::class,

        SurchargeBreakdownItem::class => SurchargeBreakdownItemNormalizer::class,

        IrpfBracket::class => IrpfBracketNormalizer::class,

        InvoiceFiscalData::class => InvoiceFiscalDataNormalizer::class,

        FiscalSummaryResponse::class => FiscalSummaryResponseNormalizer::class,

        MyCredential::class => MyCredentialNormalizer::class,

        MyIdentity::class => MyIdentityNormalizer::class,

        UpdateMeRequest::class => UpdateMeRequestNormalizer::class,

        MyPreferences::class => MyPreferencesNormalizer::class,

        InvoiceAttachment::class => InvoiceAttachmentNormalizer::class,

        InvoiceSendRecord::class => InvoiceSendRecordNormalizer::class,

        InvoiceEmailDeliveryOutcome::class => InvoiceEmailDeliveryOutcomeNormalizer::class,

        InvoiceBase::class => InvoiceBaseNormalizer::class,

        InvoiceBaseEmailConfig::class => InvoiceBaseEmailConfigNormalizer::class,

        FieldDeserializationError::class => FieldDeserializationErrorNormalizer::class,

        BulkOperationResult::class => BulkOperationResultNormalizer::class,

        BulkOperationResultFailuresItem::class => BulkOperationResultFailuresItemNormalizer::class,

        BulkOperationResponse::class => BulkOperationResponseNormalizer::class,

        VoidInvoiceRequest::class => VoidInvoiceRequestNormalizer::class,

        ConvertProformaToInvoiceRequest::class => ConvertProformaToInvoiceRequestNormalizer::class,

        CreateInvoiceDerivationRequest::class => CreateInvoiceDerivationRequestNormalizer::class,

        CreateInvoiceBatchRequest::class => CreateInvoiceBatchRequestNormalizer::class,

        CreateInvoicePdfArchiveRequest::class => CreateInvoicePdfArchiveRequestNormalizer::class,

        CreateInvoiceDeliveryRequest::class => CreateInvoiceDeliveryRequestNormalizer::class,

        InvoiceExportFilters::class => InvoiceExportFiltersNormalizer::class,

        CreateInvoiceExportRequest::class => CreateInvoiceExportRequestNormalizer::class,

        InvoicePreviewResponse::class => InvoicePreviewResponseNormalizer::class,

        InvoicePreviewResponseData::class => InvoicePreviewResponseDataNormalizer::class,

        SetInvoiceStatusRequest::class => SetInvoiceStatusRequestNormalizer::class,

        SetInvoiceStatusRequestPaymentMethod::class => SetInvoiceStatusRequestPaymentMethodNormalizer::class,

        InvoiceSchedule::class => InvoiceScheduleNormalizer::class,

        InvoiceScheduleResponse::class => InvoiceScheduleResponseNormalizer::class,

        SetInvoiceScheduleRequest::class => SetInvoiceScheduleRequestNormalizer::class,

        RecurringInvoicePause::class => RecurringInvoicePauseNormalizer::class,

        RecurringInvoiceCompletion::class => RecurringInvoiceCompletionNormalizer::class,

        PatchRecurringInvoiceRequest::class => PatchRecurringInvoiceRequestNormalizer::class,

        PatchRecurringInvoiceRequestEmailConfiguration::class => PatchRecurringInvoiceRequestEmailConfigurationNormalizer::class,

        NextOccurrence::class => NextOccurrenceNormalizer::class,

        RecurringInvoiceStatsBlock::class => RecurringInvoiceStatsBlockNormalizer::class,

        RecurringInvoiceStats::class => RecurringInvoiceStatsNormalizer::class,

        CreateRecurringInvoiceDerivationRequest::class => CreateRecurringInvoiceDerivationRequestNormalizer::class,

        PatchCustomerRequest::class => PatchCustomerRequestNormalizer::class,

        PatchCustomerRequestAlternativeId::class => PatchCustomerRequestAlternativeIdNormalizer::class,

        PatchCustomerRequestAddress::class => PatchCustomerRequestAddressNormalizer::class,

        PatchCustomerRequestPreferredPaymentMethod::class => PatchCustomerRequestPreferredPaymentMethodNormalizer::class,

        CustomerEcho::class => CustomerEchoNormalizer::class,

        CustomerBulkDeleteMetadata::class => CustomerBulkDeleteMetadataNormalizer::class,

        CustomerBulkDeleteError::class => CustomerBulkDeleteErrorNormalizer::class,

        CustomerBulkDeleteItem::class => CustomerBulkDeleteItemNormalizer::class,

        CustomerBulkDeleteItemError::class => CustomerBulkDeleteItemErrorNormalizer::class,

        CustomerBulkDeleteStatistics::class => CustomerBulkDeleteStatisticsNormalizer::class,

        CustomerBulkDeleteLegacyError::class => CustomerBulkDeleteLegacyErrorNormalizer::class,

        CustomerBulkDeleteResult::class => CustomerBulkDeleteResultNormalizer::class,

        CsvImportErrorDetails::class => CsvImportErrorDetailsNormalizer::class,

        PatchProductRequest::class => PatchProductRequestNormalizer::class,

        PatchProductRequestMainTax::class => PatchProductRequestMainTaxNormalizer::class,

        ProductBulkCreateMetadata::class => ProductBulkCreateMetadataNormalizer::class,

        ProductBulkCreateError::class => ProductBulkCreateErrorNormalizer::class,

        ProductBulkCreateItem::class => ProductBulkCreateItemNormalizer::class,

        ProductBulkCreateItemError::class => ProductBulkCreateItemErrorNormalizer::class,

        ProductBulkCreateStatistics::class => ProductBulkCreateStatisticsNormalizer::class,

        ProductBulkCreateLegacyError::class => ProductBulkCreateLegacyErrorNormalizer::class,

        ProductBulkCreateLegacySummary::class => ProductBulkCreateLegacySummaryNormalizer::class,

        ProductBulkCreateResult::class => ProductBulkCreateResultNormalizer::class,

        ProductBulkCreateResultSummary::class => ProductBulkCreateResultSummaryNormalizer::class,

        GrantAssignment::class => GrantAssignmentNormalizer::class,

        MemberPermissions::class => MemberPermissionsNormalizer::class,

        AccountMember::class => AccountMemberNormalizer::class,

        ChangeMemberRoleRequest::class => ChangeMemberRoleRequestNormalizer::class,

        PutMemberGrantRequest::class => PutMemberGrantRequestNormalizer::class,

        SetAccountOwnerRequest::class => SetAccountOwnerRequestNormalizer::class,

        InvitationSummary::class => InvitationSummaryNormalizer::class,

        CreateInvitationRequest::class => CreateInvitationRequestNormalizer::class,

        Invitation::class => InvitationNormalizer::class,

        AccountClaim::class => AccountClaimNormalizer::class,

        ManagedAccountSummary::class => ManagedAccountSummaryNormalizer::class,

        ManagedAccountSummaryClaim::class => ManagedAccountSummaryClaimNormalizer::class,

        ProvisionTaxProfile::class => ProvisionTaxProfileNormalizer::class,

        ProvisionAccountRequest::class => ProvisionAccountRequestNormalizer::class,

        ProvisionAccountRequestTaxProfile::class => ProvisionAccountRequestTaxProfileNormalizer::class,

        ProvisionAccountResult::class => ProvisionAccountResultNormalizer::class,

        ChangeAccessLevelRequest::class => ChangeAccessLevelRequestNormalizer::class,

        CreateClaimTokenRequest::class => CreateClaimTokenRequestNormalizer::class,

        ClaimTokenResult::class => ClaimTokenResultNormalizer::class,

        ProvisioningUsage::class => ProvisioningUsageNormalizer::class,

        AccountImportOptions::class => AccountImportOptionsNormalizer::class,

        AccountImportUpload::class => AccountImportUploadNormalizer::class,

        AccountImportMetadata::class => AccountImportMetadataNormalizer::class,

        AccountImportSeriesOutcome::class => AccountImportSeriesOutcomeNormalizer::class,

        AccountImportCustomersOutcome::class => AccountImportCustomersOutcomeNormalizer::class,

        AccountImportIssue::class => AccountImportIssueNormalizer::class,

        AccountImportItem::class => AccountImportItemNormalizer::class,

        AccountImportItemAccount::class => AccountImportItemAccountNormalizer::class,

        AccountImportItemCustomers::class => AccountImportItemCustomersNormalizer::class,

        AccountImportCustomerRow::class => AccountImportCustomerRowNormalizer::class,

        AccountImportCustomersSource::class => AccountImportCustomersSourceNormalizer::class,

        AccountImportStatistics::class => AccountImportStatisticsNormalizer::class,

        AccountImportResult::class => AccountImportResultNormalizer::class,

        AccountImportResultCustomersSource::class => AccountImportResultCustomersSourceNormalizer::class,

        AccountImportResultOwnCompanyCustomers::class => AccountImportResultOwnCompanyCustomersNormalizer::class,

        PayloadTooLargeDetails::class => PayloadTooLargeDetailsNormalizer::class,

        ExemptionReasonCatalogEntry::class => ExemptionReasonCatalogEntryNormalizer::class,

        TaxTypesCatalog::class => TaxTypesCatalogNormalizer::class,

        TaxTypesCatalogResponse::class => TaxTypesCatalogResponseNormalizer::class,

        DocumentTypeDefaultStatus::class => DocumentTypeDefaultStatusNormalizer::class,

        PatchSeriesRequest::class => PatchSeriesRequestNormalizer::class,

        IssuingReadinessData::class => IssuingReadinessDataNormalizer::class,

        IssuingReadinessDataVerifactu::class => IssuingReadinessDataVerifactuNormalizer::class,

        CompanySeriesNumbering::class => CompanySeriesNumberingNormalizer::class,

        CompanyNumbering::class => CompanyNumberingNormalizer::class,

        PaymentRequiredResponse::class => PaymentRequiredResponseNormalizer::class,

        CompanyStatsData::class => CompanyStatsDataNormalizer::class,

        ListCompanyStats200Response::class => ListCompanyStats200ResponseNormalizer::class,

        ListCompanyStats200ResponseData::class => ListCompanyStats200ResponseDataNormalizer::class,

        IssuingReadinessResponse::class => IssuingReadinessResponseNormalizer::class,

        ActivateCompanyRequest::class => ActivateCompanyRequestNormalizer::class,

        CompanyActivation::class => CompanyActivationNormalizer::class,

        CompanyActivationResponse::class => CompanyActivationResponseNormalizer::class,

        CompanyDeactivation::class => CompanyDeactivationNormalizer::class,

        ManagedPaymentConnection::class => ManagedPaymentConnectionNormalizer::class,

        ListManagedPaymentConnectionsResponse::class => ListManagedPaymentConnectionsResponseNormalizer::class,

        ListManagedPaymentConnectionsResponseData::class => ListManagedPaymentConnectionsResponseDataNormalizer::class,

        UpdateCompanyPaymentConnectionSeries::class => UpdateCompanyPaymentConnectionSeriesNormalizer::class,

        CompanyPaymentConnectionFilters::class => CompanyPaymentConnectionFiltersNormalizer::class,

        CompanyPaymentConnectionSeries::class => CompanyPaymentConnectionSeriesNormalizer::class,

        PaymentEventFailureReasonCount::class => PaymentEventFailureReasonCountNormalizer::class,

        PaymentEventCounts::class => PaymentEventCountsNormalizer::class,

        WebhookSubscription::class => WebhookSubscriptionNormalizer::class,

        CreateWebhookSubscriptionRequest::class => CreateWebhookSubscriptionRequestNormalizer::class,

        WebhookTestResult::class => WebhookTestResultNormalizer::class,

        WebhookSubscriptionWithSecret::class => WebhookSubscriptionWithSecretNormalizer::class,

        WebhookSubscriptionWithSecretTestDelivery::class => WebhookSubscriptionWithSecretTestDeliveryNormalizer::class,

        WebhookEventDataInvoiceIssued::class => WebhookEventDataInvoiceIssuedNormalizer::class,

        WebhookEventDataInvoiceEmailSent::class => WebhookEventDataInvoiceEmailSentNormalizer::class,

        WebhookEventDataInvoicePdfGenerated::class => WebhookEventDataInvoicePdfGeneratedNormalizer::class,

        WebhookEventDataInvoiceVoided::class => WebhookEventDataInvoiceVoidedNormalizer::class,

        WebhookEventDataRecurringInvoicePaused::class => WebhookEventDataRecurringInvoicePausedNormalizer::class,

        WebhookEventDataInvoiceScheduleFailed::class => WebhookEventDataInvoiceScheduleFailedNormalizer::class,

        WebhookEventDataVeriFactuStatusUpdated::class => WebhookEventDataVeriFactuStatusUpdatedNormalizer::class,

        WebhookEventDataAccountClaimed::class => WebhookEventDataAccountClaimedNormalizer::class,

        WebhookEventDataCompanyCreated::class => WebhookEventDataCompanyCreatedNormalizer::class,

        WebhookEventDataRepresentationSigned::class => WebhookEventDataRepresentationSignedNormalizer::class,

        WebhookEvent::class => WebhookEventNormalizer::class,

        UpdateWebhookSubscriptionRequest::class => UpdateWebhookSubscriptionRequestNormalizer::class,

        WebhookDeliveryLog::class => WebhookDeliveryLogNormalizer::class,

        RequestLogSummary::class => RequestLogSummaryNormalizer::class,

        RequestLogCursorPagination::class => RequestLogCursorPaginationNormalizer::class,

        RequestLogListResponse::class => RequestLogListResponseNormalizer::class,

        RequestLogListResponseData::class => RequestLogListResponseDataNormalizer::class,

        RequestLogDetail::class => RequestLogDetailNormalizer::class,

        RequestLogSingleResponse::class => RequestLogSingleResponseNormalizer::class,

        ResponseInvalidJsonFormat::class => ResponseInvalidJsonFormatNormalizer::class,

        ResponseInvalidJsonFormatError::class => ResponseInvalidJsonFormatErrorNormalizer::class,

        ResponseCustomerImportRejected::class => ResponseCustomerImportRejectedNormalizer::class,

        ResponseCustomerImportRejectedError::class => ResponseCustomerImportRejectedErrorNormalizer::class,

        ResponsePayloadTooLarge::class => ResponsePayloadTooLargeNormalizer::class,

        ResponsePayloadTooLargeError::class => ResponsePayloadTooLargeErrorNormalizer::class,

        V1MeIdentityGetResponse200::class => V1MeIdentityGetResponse200Normalizer::class,

        V1MePatchResponse200::class => V1MePatchResponse200Normalizer::class,

        V1InvoicesGetResponse200::class => V1InvoicesGetResponse200Normalizer::class,

        V1InvoicesGetResponse200Data::class => V1InvoicesGetResponse200DataNormalizer::class,

        V1InvoicesPostResponse201::class => V1InvoicesPostResponse201Normalizer::class,

        V1InvoicesInvoiceIdGetResponse200::class => V1InvoicesInvoiceIdGetResponse200Normalizer::class,

        V1InvoicesInvoiceIdPutResponse200::class => V1InvoicesInvoiceIdPutResponse200Normalizer::class,

        V1InvoicesBulkPdfPostBody::class => V1InvoicesBulkPdfPostBodyNormalizer::class,

        V1InvoicesBulkSendPostBody::class => V1InvoicesBulkSendPostBodyNormalizer::class,

        V1InvoicesBulkSendPostResponse200::class => V1InvoicesBulkSendPostResponse200Normalizer::class,

        V1InvoicesBulkSendPostResponse200Data::class => V1InvoicesBulkSendPostResponse200DataNormalizer::class,

        V1InvoicesBulkSendPostResponse200DataFailuresItem::class => V1InvoicesBulkSendPostResponse200DataFailuresItemNormalizer::class,

        V1InvoicesBulkStatusPostBody::class => V1InvoicesBulkStatusPostBodyNormalizer::class,

        V1InvoicesBulkIssuePostBody::class => V1InvoicesBulkIssuePostBodyNormalizer::class,

        V1InvoicesInvoiceIdSendPostResponse200::class => V1InvoicesInvoiceIdSendPostResponse200Normalizer::class,

        V1InvoicesInvoiceIdSendPostResponse200Data::class => V1InvoicesInvoiceIdSendPostResponse200DataNormalizer::class,

        V1InvoicesInvoiceIdMarkPaidPostBody::class => V1InvoicesInvoiceIdMarkPaidPostBodyNormalizer::class,

        V1InvoicesInvoiceIdMarkPaidPostResponse200::class => V1InvoicesInvoiceIdMarkPaidPostResponse200Normalizer::class,

        V1InvoicesInvoiceIdVoidPostResponse200::class => V1InvoicesInvoiceIdVoidPostResponse200Normalizer::class,

        V1InvoicesInvoiceIdCorrectivePostResponse201::class => V1InvoicesInvoiceIdCorrectivePostResponse201Normalizer::class,

        V1InvoicesInvoiceIdIssuePostResponse200::class => V1InvoicesInvoiceIdIssuePostResponse200Normalizer::class,

        V1InvoicesInvoiceIdConvertToInvoicePostResponse201::class => V1InvoicesInvoiceIdConvertToInvoicePostResponse201Normalizer::class,

        V1InvoicesInvoiceIdMarkSentPostBody::class => V1InvoicesInvoiceIdMarkSentPostBodyNormalizer::class,

        V1InvoicesInvoiceIdMarkSentPostResponse200::class => V1InvoicesInvoiceIdMarkSentPostResponse200Normalizer::class,

        V1InvoicesInvoiceIdRevertToIssuedPostResponse200::class => V1InvoicesInvoiceIdRevertToIssuedPostResponse200Normalizer::class,

        V1InvoicesInvoiceIdSchedulePostBody::class => V1InvoicesInvoiceIdSchedulePostBodyNormalizer::class,

        V1InvoicesInvoiceIdSchedulePostResponse200::class => V1InvoicesInvoiceIdSchedulePostResponse200Normalizer::class,

        V1InvoicesInvoiceIdUnschedulePostResponse200::class => V1InvoicesInvoiceIdUnschedulePostResponse200Normalizer::class,

        V1InvoicesInvoiceIdReschedulePatchBody::class => V1InvoicesInvoiceIdReschedulePatchBodyNormalizer::class,

        V1InvoicesInvoiceIdReschedulePatchResponse200::class => V1InvoicesInvoiceIdReschedulePatchResponse200Normalizer::class,

        V1InvoicesInvoiceIdDuplicatePostBody::class => V1InvoicesInvoiceIdDuplicatePostBodyNormalizer::class,

        V1InvoicesInvoiceIdDuplicatePostResponse201::class => V1InvoicesInvoiceIdDuplicatePostResponse201Normalizer::class,

        V1InvoicesExportExcelPostBody::class => V1InvoicesExportExcelPostBodyNormalizer::class,

        V1CompaniesCompanyIdInvoicesGetResponse200::class => V1CompaniesCompanyIdInvoicesGetResponse200Normalizer::class,

        V1CompaniesCompanyIdInvoicesGetResponse200Data::class => V1CompaniesCompanyIdInvoicesGetResponse200DataNormalizer::class,

        V1CompaniesCompanyIdInvoicesPostResponse201::class => V1CompaniesCompanyIdInvoicesPostResponse201Normalizer::class,

        V1CompaniesCompanyIdInvoicesDerivationsPostResponse201::class => V1CompaniesCompanyIdInvoicesDerivationsPostResponse201Normalizer::class,

        V1CompaniesCompanyIdInvoicesDeliveriesPostResponse200::class => V1CompaniesCompanyIdInvoicesDeliveriesPostResponse200Normalizer::class,

        V1CompaniesCompanyIdInvoicesDeliveriesPostResponse200Data::class => V1CompaniesCompanyIdInvoicesDeliveriesPostResponse200DataNormalizer::class,

        V1CompaniesCompanyIdInvoicesDeliveriesPostResponse200DataFailuresItem::class => V1CompaniesCompanyIdInvoicesDeliveriesPostResponse200DataFailuresItemNormalizer::class,

        V1CompaniesCompanyIdInvoicesInvoiceIdGetResponse200::class => V1CompaniesCompanyIdInvoicesInvoiceIdGetResponse200Normalizer::class,

        V1CompaniesCompanyIdInvoicesInvoiceIdPatchResponse200::class => V1CompaniesCompanyIdInvoicesInvoiceIdPatchResponse200Normalizer::class,

        V1CompaniesCompanyIdInvoicesInvoiceIdSendPostResponse200::class => V1CompaniesCompanyIdInvoicesInvoiceIdSendPostResponse200Normalizer::class,

        V1CompaniesCompanyIdInvoicesInvoiceIdSendPostResponse200Data::class => V1CompaniesCompanyIdInvoicesInvoiceIdSendPostResponse200DataNormalizer::class,

        V1CompaniesCompanyIdInvoicesInvoiceIdIssuePostResponse200::class => V1CompaniesCompanyIdInvoicesInvoiceIdIssuePostResponse200Normalizer::class,

        V1CompaniesCompanyIdInvoicesInvoiceIdVoidPostResponse200::class => V1CompaniesCompanyIdInvoicesInvoiceIdVoidPostResponse200Normalizer::class,

        V1CompaniesCompanyIdInvoicesInvoiceIdCorrectivePostResponse201::class => V1CompaniesCompanyIdInvoicesInvoiceIdCorrectivePostResponse201Normalizer::class,

        V1CompaniesCompanyIdInvoicesInvoiceIdConvertToInvoicePostResponse201::class => V1CompaniesCompanyIdInvoicesInvoiceIdConvertToInvoicePostResponse201Normalizer::class,

        V1CompaniesCompanyIdInvoicesInvoiceIdStatusPutResponse200::class => V1CompaniesCompanyIdInvoicesInvoiceIdStatusPutResponse200Normalizer::class,

        V1CompaniesCompanyIdInvoicesInvoiceIdSchedulePutResponse200::class => V1CompaniesCompanyIdInvoicesInvoiceIdSchedulePutResponse200Normalizer::class,

        V1RecurringInvoicesGetResponse200::class => V1RecurringInvoicesGetResponse200Normalizer::class,

        V1RecurringInvoicesGetResponse200Data::class => V1RecurringInvoicesGetResponse200DataNormalizer::class,

        V1RecurringInvoicesPostResponse201::class => V1RecurringInvoicesPostResponse201Normalizer::class,

        V1RecurringInvoicesRecurringInvoiceIdGetResponse200::class => V1RecurringInvoicesRecurringInvoiceIdGetResponse200Normalizer::class,

        V1RecurringInvoicesRecurringInvoiceIdPatchResponse200::class => V1RecurringInvoicesRecurringInvoiceIdPatchResponse200Normalizer::class,

        V1RecurringInvoicesRecurringInvoiceIdPutResponse200::class => V1RecurringInvoicesRecurringInvoiceIdPutResponse200Normalizer::class,

        V1RecurringInvoicesRecurringInvoiceIdPausePostResponse200::class => V1RecurringInvoicesRecurringInvoiceIdPausePostResponse200Normalizer::class,

        V1RecurringInvoicesRecurringInvoiceIdResumePostResponse200::class => V1RecurringInvoicesRecurringInvoiceIdResumePostResponse200Normalizer::class,

        V1RecurringInvoicesRecurringInvoiceIdGeneratePostResponse201::class => V1RecurringInvoicesRecurringInvoiceIdGeneratePostResponse201Normalizer::class,

        V1RecurringInvoicesRecurringInvoiceIdGeneratePostResponse201Data::class => V1RecurringInvoicesRecurringInvoiceIdGeneratePostResponse201DataNormalizer::class,

        V1RecurringInvoicesRecurringInvoiceIdSkipPostResponse200::class => V1RecurringInvoicesRecurringInvoiceIdSkipPostResponse200Normalizer::class,

        V1RecurringInvoicesRecurringInvoiceIdPreviewGetResponse200::class => V1RecurringInvoicesRecurringInvoiceIdPreviewGetResponse200Normalizer::class,

        V1RecurringInvoicesRecurringInvoiceIdHistoryGetResponse200::class => V1RecurringInvoicesRecurringInvoiceIdHistoryGetResponse200Normalizer::class,

        V1RecurringInvoicesRecurringInvoiceIdHistoryGetResponse200Data::class => V1RecurringInvoicesRecurringInvoiceIdHistoryGetResponse200DataNormalizer::class,

        V1InvoicesInvoiceIdCreateRecurringPostResponse201::class => V1InvoicesInvoiceIdCreateRecurringPostResponse201Normalizer::class,

        V1CompaniesCompanyIdRecurringInvoicesGetResponse200::class => V1CompaniesCompanyIdRecurringInvoicesGetResponse200Normalizer::class,

        V1CompaniesCompanyIdRecurringInvoicesGetResponse200Data::class => V1CompaniesCompanyIdRecurringInvoicesGetResponse200DataNormalizer::class,

        V1CompaniesCompanyIdRecurringInvoicesPostResponse201::class => V1CompaniesCompanyIdRecurringInvoicesPostResponse201Normalizer::class,

        V1CompaniesCompanyIdRecurringInvoicesStatsGetResponse200::class => V1CompaniesCompanyIdRecurringInvoicesStatsGetResponse200Normalizer::class,

        V1CompaniesCompanyIdRecurringInvoicesRecurringInvoiceIdGetResponse200::class => V1CompaniesCompanyIdRecurringInvoicesRecurringInvoiceIdGetResponse200Normalizer::class,

        V1CompaniesCompanyIdRecurringInvoicesRecurringInvoiceIdPatchResponse200::class => V1CompaniesCompanyIdRecurringInvoicesRecurringInvoiceIdPatchResponse200Normalizer::class,

        V1CompaniesCompanyIdRecurringInvoicesRecurringInvoiceIdStatusPutResponse200::class => V1CompaniesCompanyIdRecurringInvoicesRecurringInvoiceIdStatusPutResponse200Normalizer::class,

        V1CompaniesCompanyIdRecurringInvoicesRecurringInvoiceIdSkipPostResponse200::class => V1CompaniesCompanyIdRecurringInvoicesRecurringInvoiceIdSkipPostResponse200Normalizer::class,

        V1CompaniesCompanyIdRecurringInvoicesRecurringInvoiceIdNextOccurrenceGetResponse200::class => V1CompaniesCompanyIdRecurringInvoicesRecurringInvoiceIdNextOccurrenceGetResponse200Normalizer::class,

        V1CompaniesCompanyIdRecurringInvoicesRecurringInvoiceIdHistoryGetResponse200::class => V1CompaniesCompanyIdRecurringInvoicesRecurringInvoiceIdHistoryGetResponse200Normalizer::class,

        V1CompaniesCompanyIdRecurringInvoicesRecurringInvoiceIdHistoryGetResponse200Data::class => V1CompaniesCompanyIdRecurringInvoicesRecurringInvoiceIdHistoryGetResponse200DataNormalizer::class,

        V1CompaniesCompanyIdRecurringInvoicesDerivationsPostResponse201::class => V1CompaniesCompanyIdRecurringInvoicesDerivationsPostResponse201Normalizer::class,

        V1CompaniesCompanyIdRecurringInvoicesRecurringInvoiceIdGeneratePostResponse201::class => V1CompaniesCompanyIdRecurringInvoicesRecurringInvoiceIdGeneratePostResponse201Normalizer::class,

        V1CompaniesCompanyIdRecurringInvoicesRecurringInvoiceIdGeneratePostResponse201Data::class => V1CompaniesCompanyIdRecurringInvoicesRecurringInvoiceIdGeneratePostResponse201DataNormalizer::class,

        V1CustomersGetResponse200::class => V1CustomersGetResponse200Normalizer::class,

        V1CustomersGetResponse200Data::class => V1CustomersGetResponse200DataNormalizer::class,

        V1CustomersPostResponse201::class => V1CustomersPostResponse201Normalizer::class,

        V1CustomersCustomerIdDeleteResponse200::class => V1CustomersCustomerIdDeleteResponse200Normalizer::class,

        V1CustomersCustomerIdDeleteResponse200Data::class => V1CustomersCustomerIdDeleteResponse200DataNormalizer::class,

        V1CustomersCustomerIdGetResponse200::class => V1CustomersCustomerIdGetResponse200Normalizer::class,

        V1CustomersCustomerIdPatchResponse200::class => V1CustomersCustomerIdPatchResponse200Normalizer::class,

        V1CustomersCustomerIdPutResponse200::class => V1CustomersCustomerIdPutResponse200Normalizer::class,

        V1CustomersBulkDeleteResponse200::class => V1CustomersBulkDeleteResponse200Normalizer::class,

        V1CustomersBulkPostBody::class => V1CustomersBulkPostBodyNormalizer::class,

        V1CustomersBulkPostResponse200::class => V1CustomersBulkPostResponse200Normalizer::class,

        V1CustomersBulkPostResponse201::class => V1CustomersBulkPostResponse201Normalizer::class,

        V1CustomersBulkPostResponse422::class => V1CustomersBulkPostResponse422Normalizer::class,

        V1CustomersBulkPostResponse422Error::class => V1CustomersBulkPostResponse422ErrorNormalizer::class,

        V1CustomersBulkPostResponse422ErrorErrorsItem::class => V1CustomersBulkPostResponse422ErrorErrorsItemNormalizer::class,

        V1CustomersImportCsvPreviewPostBody::class => V1CustomersImportCsvPreviewPostBodyNormalizer::class,

        V1CustomersImportCsvPreviewPostResponse200::class => V1CustomersImportCsvPreviewPostResponse200Normalizer::class,

        V1CustomersImportHoldedContactsPostBody::class => V1CustomersImportHoldedContactsPostBodyNormalizer::class,

        V1CustomersImportHoldedContactsPostResponse200::class => V1CustomersImportHoldedContactsPostResponse200Normalizer::class,

        V1CompaniesCompanyIdCustomersGetResponse200::class => V1CompaniesCompanyIdCustomersGetResponse200Normalizer::class,

        V1CompaniesCompanyIdCustomersGetResponse200Data::class => V1CompaniesCompanyIdCustomersGetResponse200DataNormalizer::class,

        V1CompaniesCompanyIdCustomersPostResponse201::class => V1CompaniesCompanyIdCustomersPostResponse201Normalizer::class,

        V1CompaniesCompanyIdCustomersBulkDeleteResponse200::class => V1CompaniesCompanyIdCustomersBulkDeleteResponse200Normalizer::class,

        V1CompaniesCompanyIdCustomersBulkPostBody::class => V1CompaniesCompanyIdCustomersBulkPostBodyNormalizer::class,

        V1CompaniesCompanyIdCustomersBulkPostResponse200::class => V1CompaniesCompanyIdCustomersBulkPostResponse200Normalizer::class,

        V1CompaniesCompanyIdCustomersBulkPostResponse201::class => V1CompaniesCompanyIdCustomersBulkPostResponse201Normalizer::class,

        V1CompaniesCompanyIdCustomersImportsPostBody::class => V1CompaniesCompanyIdCustomersImportsPostBodyNormalizer::class,

        V1CompaniesCompanyIdCustomersImportsPostResponse201::class => V1CompaniesCompanyIdCustomersImportsPostResponse201Normalizer::class,

        V1CompaniesCompanyIdCustomersImportsPreviewPostBody::class => V1CompaniesCompanyIdCustomersImportsPreviewPostBodyNormalizer::class,

        V1CompaniesCompanyIdCustomersImportsPreviewPostResponse200::class => V1CompaniesCompanyIdCustomersImportsPreviewPostResponse200Normalizer::class,

        V1CompaniesCompanyIdCustomersCustomerIdGetResponse200::class => V1CompaniesCompanyIdCustomersCustomerIdGetResponse200Normalizer::class,

        V1CompaniesCompanyIdCustomersCustomerIdPatchResponse200::class => V1CompaniesCompanyIdCustomersCustomerIdPatchResponse200Normalizer::class,

        V1ProductsGetResponse200::class => V1ProductsGetResponse200Normalizer::class,

        V1ProductsGetResponse200Data::class => V1ProductsGetResponse200DataNormalizer::class,

        V1ProductsPostResponse201::class => V1ProductsPostResponse201Normalizer::class,

        V1ProductsProductIdGetResponse200::class => V1ProductsProductIdGetResponse200Normalizer::class,

        V1ProductsProductIdPatchResponse200::class => V1ProductsProductIdPatchResponse200Normalizer::class,

        V1ProductsProductIdPutResponse200::class => V1ProductsProductIdPutResponse200Normalizer::class,

        V1ProductsSearchGetResponse200::class => V1ProductsSearchGetResponse200Normalizer::class,

        V1ProductsBulkDeleteBody::class => V1ProductsBulkDeleteBodyNormalizer::class,

        V1ProductsBulkDeleteResponse200::class => V1ProductsBulkDeleteResponse200Normalizer::class,

        V1ProductsBulkDeleteResponse200Data::class => V1ProductsBulkDeleteResponse200DataNormalizer::class,

        V1ProductsBulkDeleteResponse200DataErrorsItem::class => V1ProductsBulkDeleteResponse200DataErrorsItemNormalizer::class,

        V1ProductsBulkDeleteResponse200DataSummary::class => V1ProductsBulkDeleteResponse200DataSummaryNormalizer::class,

        V1ProductsBulkPostBody::class => V1ProductsBulkPostBodyNormalizer::class,

        V1ProductsBulkPostResponse201::class => V1ProductsBulkPostResponse201Normalizer::class,

        V1CompaniesCompanyIdProductsGetResponse200::class => V1CompaniesCompanyIdProductsGetResponse200Normalizer::class,

        V1CompaniesCompanyIdProductsGetResponse200Data::class => V1CompaniesCompanyIdProductsGetResponse200DataNormalizer::class,

        V1CompaniesCompanyIdProductsPostResponse201::class => V1CompaniesCompanyIdProductsPostResponse201Normalizer::class,

        V1CompaniesCompanyIdProductsBulkDeleteResponse200::class => V1CompaniesCompanyIdProductsBulkDeleteResponse200Normalizer::class,

        V1CompaniesCompanyIdProductsBulkDeleteResponse200Data::class => V1CompaniesCompanyIdProductsBulkDeleteResponse200DataNormalizer::class,

        V1CompaniesCompanyIdProductsBulkDeleteResponse200DataErrorsItem::class => V1CompaniesCompanyIdProductsBulkDeleteResponse200DataErrorsItemNormalizer::class,

        V1CompaniesCompanyIdProductsBulkDeleteResponse200DataSummary::class => V1CompaniesCompanyIdProductsBulkDeleteResponse200DataSummaryNormalizer::class,

        V1CompaniesCompanyIdProductsBulkPostBody::class => V1CompaniesCompanyIdProductsBulkPostBodyNormalizer::class,

        V1CompaniesCompanyIdProductsBulkPostResponse201::class => V1CompaniesCompanyIdProductsBulkPostResponse201Normalizer::class,

        V1CompaniesCompanyIdProductsProductIdGetResponse200::class => V1CompaniesCompanyIdProductsProductIdGetResponse200Normalizer::class,

        V1CompaniesCompanyIdProductsProductIdPatchResponse200::class => V1CompaniesCompanyIdProductsProductIdPatchResponse200Normalizer::class,

        V1AccountsAccountIdMembersGetResponse200::class => V1AccountsAccountIdMembersGetResponse200Normalizer::class,

        V1AccountsAccountIdMembersGetResponse200Data::class => V1AccountsAccountIdMembersGetResponse200DataNormalizer::class,

        V1AccountsAccountIdMembersMemberIdGetResponse200::class => V1AccountsAccountIdMembersMemberIdGetResponse200Normalizer::class,

        V1AccountsAccountIdMembersMemberIdPatchResponse200::class => V1AccountsAccountIdMembersMemberIdPatchResponse200Normalizer::class,

        V1AccountsAccountIdMembersMemberIdGrantsGetResponse200::class => V1AccountsAccountIdMembersMemberIdGrantsGetResponse200Normalizer::class,

        V1AccountsAccountIdMembersMemberIdGrantsGetResponse200Data::class => V1AccountsAccountIdMembersMemberIdGrantsGetResponse200DataNormalizer::class,

        V1AccountsAccountIdMembersMemberIdGrantsCompanyIdPutResponse200::class => V1AccountsAccountIdMembersMemberIdGrantsCompanyIdPutResponse200Normalizer::class,

        V1AccountsAccountIdInvitationsGetResponse200::class => V1AccountsAccountIdInvitationsGetResponse200Normalizer::class,

        V1AccountsAccountIdInvitationsGetResponse200Data::class => V1AccountsAccountIdInvitationsGetResponse200DataNormalizer::class,

        V1AccountsAccountIdInvitationsPostResponse201::class => V1AccountsAccountIdInvitationsPostResponse201Normalizer::class,

        V1AccountsAccountIdInvitationsInvitationIdGetResponse200::class => V1AccountsAccountIdInvitationsInvitationIdGetResponse200Normalizer::class,

        V1AccountsGetResponse200::class => V1AccountsGetResponse200Normalizer::class,

        V1AccountsGetResponse200Data::class => V1AccountsGetResponse200DataNormalizer::class,

        V1AccountsPostResponse201::class => V1AccountsPostResponse201Normalizer::class,

        V1AccountsAccountIdGetResponse200::class => V1AccountsAccountIdGetResponse200Normalizer::class,

        V1AccountsAccountIdClaimTokensPostResponse201::class => V1AccountsAccountIdClaimTokensPostResponse201Normalizer::class,

        V1AccountsAccountIdUsageGetResponse200::class => V1AccountsAccountIdUsageGetResponse200Normalizer::class,

        V1AccountsImportsPostResponse201::class => V1AccountsImportsPostResponse201Normalizer::class,

        V1AccountsImportsPreviewPostResponse200::class => V1AccountsImportsPreviewPostResponse200Normalizer::class,

        V1CompaniesCompanyIdFiscalSummaryGetResponse200::class => V1CompaniesCompanyIdFiscalSummaryGetResponse200Normalizer::class,

        V1ConfigurationVerifactuGetResponse200::class => V1ConfigurationVerifactuGetResponse200Normalizer::class,

        V1ConfigurationVerifactuPutResponse200::class => V1ConfigurationVerifactuPutResponse200Normalizer::class,

        V1ConfigurationInvoiceCustomizationOptionsGetResponse200::class => V1ConfigurationInvoiceCustomizationOptionsGetResponse200Normalizer::class,

        V1ConfigurationTaxesGetResponse200::class => V1ConfigurationTaxesGetResponse200Normalizer::class,

        V1ConfigurationTaxesPutResponse200::class => V1ConfigurationTaxesPutResponse200Normalizer::class,

        V1ConfigurationSeriesGetResponse200::class => V1ConfigurationSeriesGetResponse200Normalizer::class,

        V1ConfigurationSeriesGetResponse200Data::class => V1ConfigurationSeriesGetResponse200DataNormalizer::class,

        V1ConfigurationSeriesGetResponse200DataPagination::class => V1ConfigurationSeriesGetResponse200DataPaginationNormalizer::class,

        V1ConfigurationSeriesPostResponse201::class => V1ConfigurationSeriesPostResponse201Normalizer::class,

        V1ConfigurationSeriesDefaultsPostResponse200::class => V1ConfigurationSeriesDefaultsPostResponse200Normalizer::class,

        V1ConfigurationSeriesDefaultsPostResponse200Data::class => V1ConfigurationSeriesDefaultsPostResponse200DataNormalizer::class,

        V1ConfigurationSeriesDefaultsStatusGetResponse200::class => V1ConfigurationSeriesDefaultsStatusGetResponse200Normalizer::class,

        V1ConfigurationSeriesDefaultsStatusGetResponse200Data::class => V1ConfigurationSeriesDefaultsStatusGetResponse200DataNormalizer::class,

        V1ConfigurationSeriesSeriesIdPatchResponse200::class => V1ConfigurationSeriesSeriesIdPatchResponse200Normalizer::class,

        V1ConfigurationSeriesSeriesIdPutResponse200::class => V1ConfigurationSeriesSeriesIdPutResponse200Normalizer::class,

        V1ConfigurationSeriesSeriesIdDefaultPostResponse200::class => V1ConfigurationSeriesSeriesIdDefaultPostResponse200Normalizer::class,

        V1ConfigurationLanguagePutBody::class => V1ConfigurationLanguagePutBodyNormalizer::class,

        V1ConfigurationLanguagePutResponse200::class => V1ConfigurationLanguagePutResponse200Normalizer::class,

        V1ConfigurationLanguagePutResponse200Data::class => V1ConfigurationLanguagePutResponse200DataNormalizer::class,

        V1InvoiceCustomizationOptionsGetResponse200::class => V1InvoiceCustomizationOptionsGetResponse200Normalizer::class,

        V1NifValidatePostResponse200::class => V1NifValidatePostResponse200Normalizer::class,

        V1AccountsAccountIdCompaniesCompanyIdRepresentationSubmitPostBody::class => V1AccountsAccountIdCompaniesCompanyIdRepresentationSubmitPostBodyNormalizer::class,

        V1CompaniesCompanyIdRepresentationSubmitPostBody::class => V1CompaniesCompanyIdRepresentationSubmitPostBodyNormalizer::class,

        V1CompaniesCompanyIdLogoPutBody::class => V1CompaniesCompanyIdLogoPutBodyNormalizer::class,

        V1CompaniesCompanyIdLogoPutResponse200::class => V1CompaniesCompanyIdLogoPutResponse200Normalizer::class,

        V1CompaniesCompanyIdInvoiceCustomizationGetResponse200::class => V1CompaniesCompanyIdInvoiceCustomizationGetResponse200Normalizer::class,

        V1CompaniesCompanyIdInvoiceCustomizationPutResponse200::class => V1CompaniesCompanyIdInvoiceCustomizationPutResponse200Normalizer::class,

        V1CompaniesCompanyIdVerifactuConfigurationGetResponse200::class => V1CompaniesCompanyIdVerifactuConfigurationGetResponse200Normalizer::class,

        V1CompaniesCompanyIdVerifactuConfigurationPutResponse200::class => V1CompaniesCompanyIdVerifactuConfigurationPutResponse200Normalizer::class,

        V1CompaniesCompanyIdTaxConfigurationGetResponse200::class => V1CompaniesCompanyIdTaxConfigurationGetResponse200Normalizer::class,

        V1CompaniesCompanyIdTaxConfigurationPutResponse200::class => V1CompaniesCompanyIdTaxConfigurationPutResponse200Normalizer::class,

        V1CompaniesCompanyIdSeriesGetResponse200::class => V1CompaniesCompanyIdSeriesGetResponse200Normalizer::class,

        V1CompaniesCompanyIdSeriesGetResponse200Data::class => V1CompaniesCompanyIdSeriesGetResponse200DataNormalizer::class,

        V1CompaniesCompanyIdSeriesGetResponse200DataPagination::class => V1CompaniesCompanyIdSeriesGetResponse200DataPaginationNormalizer::class,

        V1CompaniesCompanyIdSeriesPostResponse201::class => V1CompaniesCompanyIdSeriesPostResponse201Normalizer::class,

        V1CompaniesCompanyIdSeriesDefaultsGetResponse200::class => V1CompaniesCompanyIdSeriesDefaultsGetResponse200Normalizer::class,

        V1CompaniesCompanyIdSeriesDefaultsGetResponse200Data::class => V1CompaniesCompanyIdSeriesDefaultsGetResponse200DataNormalizer::class,

        V1CompaniesCompanyIdSeriesDefaultsPutResponse200::class => V1CompaniesCompanyIdSeriesDefaultsPutResponse200Normalizer::class,

        V1CompaniesCompanyIdSeriesDefaultsPutResponse200Data::class => V1CompaniesCompanyIdSeriesDefaultsPutResponse200DataNormalizer::class,

        V1CompaniesCompanyIdSeriesSeriesIdGetResponse200::class => V1CompaniesCompanyIdSeriesSeriesIdGetResponse200Normalizer::class,

        V1CompaniesCompanyIdSeriesSeriesIdPatchResponse200::class => V1CompaniesCompanyIdSeriesSeriesIdPatchResponse200Normalizer::class,

        V1CompaniesCompanyIdSeriesSeriesIdDefaultPutResponse200::class => V1CompaniesCompanyIdSeriesSeriesIdDefaultPutResponse200Normalizer::class,

        V1CompaniesCompanyIdActivationsDeleteResponse200::class => V1CompaniesCompanyIdActivationsDeleteResponse200Normalizer::class,

        V1WebhooksGetResponse200::class => V1WebhooksGetResponse200Normalizer::class,

        V1WebhooksGetResponse200Data::class => V1WebhooksGetResponse200DataNormalizer::class,

        V1WebhooksPostResponse201::class => V1WebhooksPostResponse201Normalizer::class,

        V1WebhooksWebhookIdGetResponse200::class => V1WebhooksWebhookIdGetResponse200Normalizer::class,

        V1WebhooksWebhookIdPatchResponse200::class => V1WebhooksWebhookIdPatchResponse200Normalizer::class,

        V1WebhooksWebhookIdDeliveriesGetResponse200::class => V1WebhooksWebhookIdDeliveriesGetResponse200Normalizer::class,

        V1WebhooksWebhookIdDeliveriesGetResponse200Data::class => V1WebhooksWebhookIdDeliveriesGetResponse200DataNormalizer::class,

        V1WebhooksWebhookIdDeliveriesDeliveryIdRetryPostResponse200::class => V1WebhooksWebhookIdDeliveriesDeliveryIdRetryPostResponse200Normalizer::class,

        V1WebhooksWebhookIdTestPostResponse200::class => V1WebhooksWebhookIdTestPostResponse200Normalizer::class,

        V1WebhooksWebhookIdSecretPostResponse200::class => V1WebhooksWebhookIdSecretPostResponse200Normalizer::class,

        V1AccountsAccountIdWebhooksGetResponse200::class => V1AccountsAccountIdWebhooksGetResponse200Normalizer::class,

        V1AccountsAccountIdWebhooksGetResponse200Data::class => V1AccountsAccountIdWebhooksGetResponse200DataNormalizer::class,

        V1AccountsAccountIdWebhooksPostResponse201::class => V1AccountsAccountIdWebhooksPostResponse201Normalizer::class,

        V1AccountsAccountIdWebhooksWebhookIdGetResponse200::class => V1AccountsAccountIdWebhooksWebhookIdGetResponse200Normalizer::class,

        V1AccountsAccountIdWebhooksWebhookIdPatchResponse200::class => V1AccountsAccountIdWebhooksWebhookIdPatchResponse200Normalizer::class,

        V1AccountsAccountIdWebhooksWebhookIdDeliveriesGetResponse200::class => V1AccountsAccountIdWebhooksWebhookIdDeliveriesGetResponse200Normalizer::class,

        V1AccountsAccountIdWebhooksWebhookIdDeliveriesGetResponse200Data::class => V1AccountsAccountIdWebhooksWebhookIdDeliveriesGetResponse200DataNormalizer::class,

        V1AccountsAccountIdWebhooksWebhookIdDeliveriesDeliveryIdRetryPostResponse200::class => V1AccountsAccountIdWebhooksWebhookIdDeliveriesDeliveryIdRetryPostResponse200Normalizer::class,

        V1AccountsAccountIdWebhooksWebhookIdTestPostResponse200::class => V1AccountsAccountIdWebhooksWebhookIdTestPostResponse200Normalizer::class,

        V1AccountsAccountIdWebhooksWebhookIdSecretPostResponse200::class => V1AccountsAccountIdWebhooksWebhookIdSecretPostResponse200Normalizer::class,

        Reference::class => ReferenceNormalizer::class,
    ];

    protected $normalizersCache = [];

    public function supportsDenormalization(mixed $data, string $type, ?string $format = null, array $context = []): bool
    {
        return array_key_exists($type, $this->normalizers);
    }

    public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
    {
        return is_object($data) && array_key_exists(get_class($data), $this->normalizers);
    }

    public function normalize(mixed $data, ?string $format = null, array $context = []): array|string|int|float|bool|\ArrayObject|null
    {
        $normalizerClass = $this->normalizers[get_class($data)];
        $normalizer = $this->getNormalizer($normalizerClass);

        return $normalizer->normalize($data, $format, $context);
    }

    public function denormalize(mixed $data, string $type, ?string $format = null, array $context = []): mixed
    {
        $denormalizerClass = $this->normalizers[$type];
        $denormalizer = $this->getNormalizer($denormalizerClass);

        return $denormalizer->denormalize($data, $type, $format, $context);
    }

    private function getNormalizer(string $normalizerClass)
    {
        return $this->normalizersCache[$normalizerClass] ?? $this->initNormalizer($normalizerClass);
    }

    private function initNormalizer(string $normalizerClass)
    {
        $normalizer = new $normalizerClass;
        $normalizer->setNormalizer($this->normalizer);
        $normalizer->setDenormalizer($this->denormalizer);
        $this->normalizersCache[$normalizerClass] = $normalizer;

        return $normalizer;
    }

    public function getSupportedTypes(?string $format = null): array
    {
        return array_combine(array_keys($this->normalizers), array_fill(0, count($this->normalizers), false));
    }
}
