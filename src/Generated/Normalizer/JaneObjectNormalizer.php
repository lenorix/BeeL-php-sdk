<?php

namespace Lenorix\BeelSdk\Generated\Normalizer;

use Lenorix\BeelSdk\Generated\Runtime\Normalizer\CheckArray;
use Lenorix\BeelSdk\Generated\Runtime\Normalizer\ValidatorTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
class JaneObjectNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use CheckArray;
    use ValidatorTrait;
    protected $normalizers = [
        
        \Lenorix\BeelSdk\Generated\Model\SuccessResponse::class => \Lenorix\BeelSdk\Generated\Normalizer\SuccessResponseNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\ErrorResponse::class => \Lenorix\BeelSdk\Generated\Normalizer\ErrorResponseNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\ErrorDetail::class => \Lenorix\BeelSdk\Generated\Normalizer\ErrorDetailNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\LineUnitPriceOutOfRangeDetails::class => \Lenorix\BeelSdk\Generated\Normalizer\LineUnitPriceOutOfRangeDetailsNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\ResponseMeta::class => \Lenorix\BeelSdk\Generated\Normalizer\ResponseMetaNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\Pagination::class => \Lenorix\BeelSdk\Generated\Normalizer\PaginationNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\LegalRepresentative::class => \Lenorix\BeelSdk\Generated\Normalizer\LegalRepresentativeNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\LegalRepresentativeAddress::class => \Lenorix\BeelSdk\Generated\Normalizer\LegalRepresentativeAddressNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\LegalRepresentativeResponse::class => \Lenorix\BeelSdk\Generated\Normalizer\LegalRepresentativeResponseNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\LegalRepresentativeResponseAddress::class => \Lenorix\BeelSdk\Generated\Normalizer\LegalRepresentativeResponseAddressNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\Address::class => \Lenorix\BeelSdk\Generated\Normalizer\AddressNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\AddressResponse::class => \Lenorix\BeelSdk\Generated\Normalizer\AddressResponseNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\Invoice::class => \Lenorix\BeelSdk\Generated\Normalizer\InvoiceNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\SeriesInfo::class => \Lenorix\BeelSdk\Generated\Normalizer\SeriesInfoNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\IssuerData::class => \Lenorix\BeelSdk\Generated\Normalizer\IssuerDataNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\IssuerDataAddress::class => \Lenorix\BeelSdk\Generated\Normalizer\IssuerDataAddressNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\RecipientData::class => \Lenorix\BeelSdk\Generated\Normalizer\RecipientDataNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\RecipientDataAlternativeId::class => \Lenorix\BeelSdk\Generated\Normalizer\RecipientDataAlternativeIdNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\RecipientDataAddress::class => \Lenorix\BeelSdk\Generated\Normalizer\RecipientDataAddressNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\InvoiceLine::class => \Lenorix\BeelSdk\Generated\Normalizer\InvoiceLineNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\InvoiceTotals::class => \Lenorix\BeelSdk\Generated\Normalizer\InvoiceTotalsNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\InvoiceTotalsVatBreakdownItem::class => \Lenorix\BeelSdk\Generated\Normalizer\InvoiceTotalsVatBreakdownItemNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\InvoiceTotalsSurchargeBreakdownItem::class => \Lenorix\BeelSdk\Generated\Normalizer\InvoiceTotalsSurchargeBreakdownItemNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\InvoiceTotalsIrpfBreakdownItem::class => \Lenorix\BeelSdk\Generated\Normalizer\InvoiceTotalsIrpfBreakdownItemNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\PaymentInfo::class => \Lenorix\BeelSdk\Generated\Normalizer\PaymentInfoNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\VeriFactu::class => \Lenorix\BeelSdk\Generated\Normalizer\VeriFactuNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\Recipient::class => \Lenorix\BeelSdk\Generated\Normalizer\RecipientNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\RecipientAlternativeId::class => \Lenorix\BeelSdk\Generated\Normalizer\RecipientAlternativeIdNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\CreateInvoiceRequest::class => \Lenorix\BeelSdk\Generated\Normalizer\CreateInvoiceRequestNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\CreateInvoiceRequestLinesItem::class => \Lenorix\BeelSdk\Generated\Normalizer\CreateInvoiceRequestLinesItemNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\CreateInvoiceRequestLinesItemMainTax::class => \Lenorix\BeelSdk\Generated\Normalizer\CreateInvoiceRequestLinesItemMainTaxNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\InvoiceProcessingOptions::class => \Lenorix\BeelSdk\Generated\Normalizer\InvoiceProcessingOptionsNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\InvoiceProcessingOptionsEmailConfig::class => \Lenorix\BeelSdk\Generated\Normalizer\InvoiceProcessingOptionsEmailConfigNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\UpdateInvoiceRequest::class => \Lenorix\BeelSdk\Generated\Normalizer\UpdateInvoiceRequestNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\UpdateInvoiceRequestRecipient::class => \Lenorix\BeelSdk\Generated\Normalizer\UpdateInvoiceRequestRecipientNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\UpdateInvoiceRequestLinesItem::class => \Lenorix\BeelSdk\Generated\Normalizer\UpdateInvoiceRequestLinesItemNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\UpdateInvoiceRequestPaymentInfo::class => \Lenorix\BeelSdk\Generated\Normalizer\UpdateInvoiceRequestPaymentInfoNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\UpdateInvoiceRequestOptions::class => \Lenorix\BeelSdk\Generated\Normalizer\UpdateInvoiceRequestOptionsNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\UpdateInvoiceRequestOptionsEmailConfig::class => \Lenorix\BeelSdk\Generated\Normalizer\UpdateInvoiceRequestOptionsEmailConfigNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\EmailConfiguration::class => \Lenorix\BeelSdk\Generated\Normalizer\EmailConfigurationNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\SendEmailRequest::class => \Lenorix\BeelSdk\Generated\Normalizer\SendEmailRequestNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\CreateCorrectiveInvoiceRequest::class => \Lenorix\BeelSdk\Generated\Normalizer\CreateCorrectiveInvoiceRequestNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\CreateCorrectiveInvoiceRequestLinesItem::class => \Lenorix\BeelSdk\Generated\Normalizer\CreateCorrectiveInvoiceRequestLinesItemNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\InvoicePdfResponse::class => \Lenorix\BeelSdk\Generated\Normalizer\InvoicePdfResponseNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\InvoicePdfResponseData::class => \Lenorix\BeelSdk\Generated\Normalizer\InvoicePdfResponseDataNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\Customer::class => \Lenorix\BeelSdk\Generated\Normalizer\CustomerNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\CustomerAddress::class => \Lenorix\BeelSdk\Generated\Normalizer\CustomerAddressNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\AlternativeIdentifier::class => \Lenorix\BeelSdk\Generated\Normalizer\AlternativeIdentifierNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\CreateCustomerRequest::class => \Lenorix\BeelSdk\Generated\Normalizer\CreateCustomerRequestNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\UpdateCustomerRequest::class => \Lenorix\BeelSdk\Generated\Normalizer\UpdateCustomerRequestNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\UpdateCustomerRequestAlternativeId::class => \Lenorix\BeelSdk\Generated\Normalizer\UpdateCustomerRequestAlternativeIdNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\CsvImportResult::class => \Lenorix\BeelSdk\Generated\Normalizer\CsvImportResultNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\CsvValidationError::class => \Lenorix\BeelSdk\Generated\Normalizer\CsvValidationErrorNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\TemplateCsvInfo::class => \Lenorix\BeelSdk\Generated\Normalizer\TemplateCsvInfoNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\CsvImportPreviewResult::class => \Lenorix\BeelSdk\Generated\Normalizer\CsvImportPreviewResultNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\CsvImportMetadata::class => \Lenorix\BeelSdk\Generated\Normalizer\CsvImportMetadataNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\CsvCustomerPreview::class => \Lenorix\BeelSdk\Generated\Normalizer\CsvCustomerPreviewNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\CsvCustomerPreviewCustomer::class => \Lenorix\BeelSdk\Generated\Normalizer\CsvCustomerPreviewCustomerNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\CsvImportStatistics::class => \Lenorix\BeelSdk\Generated\Normalizer\CsvImportStatisticsNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\Product::class => \Lenorix\BeelSdk\Generated\Normalizer\ProductNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\CreateProductRequest::class => \Lenorix\BeelSdk\Generated\Normalizer\CreateProductRequestNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\UpdateProductRequest::class => \Lenorix\BeelSdk\Generated\Normalizer\UpdateProductRequestNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\ProductResponse::class => \Lenorix\BeelSdk\Generated\Normalizer\ProductResponseNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\ProductsListResponse::class => \Lenorix\BeelSdk\Generated\Normalizer\ProductsListResponseNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\ProductsListResponseData::class => \Lenorix\BeelSdk\Generated\Normalizer\ProductsListResponseDataNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\ProductQueryParams::class => \Lenorix\BeelSdk\Generated\Normalizer\ProductQueryParamsNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\VeriFactuConfiguration::class => \Lenorix\BeelSdk\Generated\Normalizer\VeriFactuConfigurationNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\UpdateVeriFactuConfigurationRequest::class => \Lenorix\BeelSdk\Generated\Normalizer\UpdateVeriFactuConfigurationRequestNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\TaxConfiguration::class => \Lenorix\BeelSdk\Generated\Normalizer\TaxConfigurationNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\TaxConfigurationDefaultMainTax::class => \Lenorix\BeelSdk\Generated\Normalizer\TaxConfigurationDefaultMainTaxNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\InvoiceSeries::class => \Lenorix\BeelSdk\Generated\Normalizer\InvoiceSeriesNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\TaxRegime::class => \Lenorix\BeelSdk\Generated\Normalizer\TaxRegimeNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\VeriFactuRegimeKey::class => \Lenorix\BeelSdk\Generated\Normalizer\VeriFactuRegimeKeyNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\TaxPercentage::class => \Lenorix\BeelSdk\Generated\Normalizer\TaxPercentageNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\VatType::class => \Lenorix\BeelSdk\Generated\Normalizer\VatTypeNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\IrpfType::class => \Lenorix\BeelSdk\Generated\Normalizer\IrpfTypeNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\EquivalenceSurcharge::class => \Lenorix\BeelSdk\Generated\Normalizer\EquivalenceSurchargeNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\CreateSeriesRequest::class => \Lenorix\BeelSdk\Generated\Normalizer\CreateSeriesRequestNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\UpdateSeriesRequest::class => \Lenorix\BeelSdk\Generated\Normalizer\UpdateSeriesRequestNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\UpdateTaxConfigurationRequest::class => \Lenorix\BeelSdk\Generated\Normalizer\UpdateTaxConfigurationRequestNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\UpdateTaxConfigurationRequestDefaultMainTax::class => \Lenorix\BeelSdk\Generated\Normalizer\UpdateTaxConfigurationRequestDefaultMainTaxNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\ValidateNifRequest::class => \Lenorix\BeelSdk\Generated\Normalizer\ValidateNifRequestNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\ValidateNifResponse::class => \Lenorix\BeelSdk\Generated\Normalizer\ValidateNifResponseNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\InvoiceTemplateOption::class => \Lenorix\BeelSdk\Generated\Normalizer\InvoiceTemplateOptionNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\InvoiceCustomizationOptionsResponse::class => \Lenorix\BeelSdk\Generated\Normalizer\InvoiceCustomizationOptionsResponseNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\TaxInfo::class => \Lenorix\BeelSdk\Generated\Normalizer\TaxInfoNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\CustomerValidationUnifiedResult::class => \Lenorix\BeelSdk\Generated\Normalizer\CustomerValidationUnifiedResultNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\CustomerValidationMetadata::class => \Lenorix\BeelSdk\Generated\Normalizer\CustomerValidationMetadataNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\CustomerValidationItem::class => \Lenorix\BeelSdk\Generated\Normalizer\CustomerValidationItemNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\CustomerValidationItemCustomer::class => \Lenorix\BeelSdk\Generated\Normalizer\CustomerValidationItemCustomerNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\CustomerValidationError::class => \Lenorix\BeelSdk\Generated\Normalizer\CustomerValidationErrorNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\CustomerValidationWarning::class => \Lenorix\BeelSdk\Generated\Normalizer\CustomerValidationWarningNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\CustomerValidationStatistics::class => \Lenorix\BeelSdk\Generated\Normalizer\CustomerValidationStatisticsNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\RecurringInvoiceResponse::class => \Lenorix\BeelSdk\Generated\Normalizer\RecurringInvoiceResponseNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\RecurringInvoiceResponseRecipientAlternativeId::class => \Lenorix\BeelSdk\Generated\Normalizer\RecurringInvoiceResponseRecipientAlternativeIdNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\InvoiceLineTemplateResponse::class => \Lenorix\BeelSdk\Generated\Normalizer\InvoiceLineTemplateResponseNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\RecurringEmailConfigResponse::class => \Lenorix\BeelSdk\Generated\Normalizer\RecurringEmailConfigResponseNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\UpdateRecurringInvoiceRequest::class => \Lenorix\BeelSdk\Generated\Normalizer\UpdateRecurringInvoiceRequestNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\SetRecurringInvoiceStatusRequest::class => \Lenorix\BeelSdk\Generated\Normalizer\SetRecurringInvoiceStatusRequestNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\CreateRecurringInvoiceRequest::class => \Lenorix\BeelSdk\Generated\Normalizer\CreateRecurringInvoiceRequestNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\CreateRecurringFromInvoiceRequest::class => \Lenorix\BeelSdk\Generated\Normalizer\CreateRecurringFromInvoiceRequestNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\RecurringLineRequest::class => \Lenorix\BeelSdk\Generated\Normalizer\RecurringLineRequestNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\RecurringEmailConfigRequest::class => \Lenorix\BeelSdk\Generated\Normalizer\RecurringEmailConfigRequestNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\GenerationHistoryResponse::class => \Lenorix\BeelSdk\Generated\Normalizer\GenerationHistoryResponseNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\CreateCompanyRequest::class => \Lenorix\BeelSdk\Generated\Normalizer\CreateCompanyRequestNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\UpdateCompanyRequest::class => \Lenorix\BeelSdk\Generated\Normalizer\UpdateCompanyRequestNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\CompanyData::class => \Lenorix\BeelSdk\Generated\Normalizer\CompanyDataNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\CompanyDataAddress::class => \Lenorix\BeelSdk\Generated\Normalizer\CompanyDataAddressNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\CompanyDataLegalRepresentative::class => \Lenorix\BeelSdk\Generated\Normalizer\CompanyDataLegalRepresentativeNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\CompanyDataReadiness::class => \Lenorix\BeelSdk\Generated\Normalizer\CompanyDataReadinessNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\CompanyCreatedData::class => \Lenorix\BeelSdk\Generated\Normalizer\CompanyCreatedDataNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\CompanyResponse201::class => \Lenorix\BeelSdk\Generated\Normalizer\CompanyResponse201Normalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\CompanyResponse::class => \Lenorix\BeelSdk\Generated\Normalizer\CompanyResponseNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\ListCompanies200Response::class => \Lenorix\BeelSdk\Generated\Normalizer\ListCompanies200ResponseNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\ListCompanies200ResponseData::class => \Lenorix\BeelSdk\Generated\Normalizer\ListCompanies200ResponseDataNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\RepresentationActionResponse::class => \Lenorix\BeelSdk\Generated\Normalizer\RepresentationActionResponseNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\RepresentationActionResponseData::class => \Lenorix\BeelSdk\Generated\Normalizer\RepresentationActionResponseDataNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\RepresentationDownloadResponse::class => \Lenorix\BeelSdk\Generated\Normalizer\RepresentationDownloadResponseNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\RepresentationDownloadResponseData::class => \Lenorix\BeelSdk\Generated\Normalizer\RepresentationDownloadResponseDataNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\RepresentationStatusResponse::class => \Lenorix\BeelSdk\Generated\Normalizer\RepresentationStatusResponseNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\RepresentationStatusResponseData::class => \Lenorix\BeelSdk\Generated\Normalizer\RepresentationStatusResponseDataNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\CompanyLogo::class => \Lenorix\BeelSdk\Generated\Normalizer\CompanyLogoNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\InvoiceCustomization::class => \Lenorix\BeelSdk\Generated\Normalizer\InvoiceCustomizationNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\UpdateInvoiceCustomizationRequest::class => \Lenorix\BeelSdk\Generated\Normalizer\UpdateInvoiceCustomizationRequestNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\InitiatePaymentConnectionRequest::class => \Lenorix\BeelSdk\Generated\Normalizer\InitiatePaymentConnectionRequestNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\InitiatePaymentConnectionResponse::class => \Lenorix\BeelSdk\Generated\Normalizer\InitiatePaymentConnectionResponseNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\InitiatePaymentConnectionResponseData::class => \Lenorix\BeelSdk\Generated\Normalizer\InitiatePaymentConnectionResponseDataNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\CompanyPaymentConnection::class => \Lenorix\BeelSdk\Generated\Normalizer\CompanyPaymentConnectionNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\CompanyPaymentConnectionTaxInclusiveTax::class => \Lenorix\BeelSdk\Generated\Normalizer\CompanyPaymentConnectionTaxInclusiveTaxNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\CompanyPaymentConnectionResponse::class => \Lenorix\BeelSdk\Generated\Normalizer\CompanyPaymentConnectionResponseNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\UpdateCompanyPaymentConnectionRequest::class => \Lenorix\BeelSdk\Generated\Normalizer\UpdateCompanyPaymentConnectionRequestNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\UpdateCompanyPaymentConnectionRequestTaxInclusiveTax::class => \Lenorix\BeelSdk\Generated\Normalizer\UpdateCompanyPaymentConnectionRequestTaxInclusiveTaxNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\UpdateCompanyPaymentConnectionRequestFilterConfig::class => \Lenorix\BeelSdk\Generated\Normalizer\UpdateCompanyPaymentConnectionRequestFilterConfigNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\ManagedPaymentEvent::class => \Lenorix\BeelSdk\Generated\Normalizer\ManagedPaymentEventNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\ListManagedPaymentEventsResponse::class => \Lenorix\BeelSdk\Generated\Normalizer\ListManagedPaymentEventsResponseNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\ListManagedPaymentEventsResponseData::class => \Lenorix\BeelSdk\Generated\Normalizer\ListManagedPaymentEventsResponseDataNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\ManagedPaymentEventResponse::class => \Lenorix\BeelSdk\Generated\Normalizer\ManagedPaymentEventResponseNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\RetryManagedPaymentEventResponse::class => \Lenorix\BeelSdk\Generated\Normalizer\RetryManagedPaymentEventResponseNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\ResolveManagedPaymentEventResponse::class => \Lenorix\BeelSdk\Generated\Normalizer\ResolveManagedPaymentEventResponseNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\DiscardManagedPaymentEventResponse::class => \Lenorix\BeelSdk\Generated\Normalizer\DiscardManagedPaymentEventResponseNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\RestoreManagedPaymentEventResponse::class => \Lenorix\BeelSdk\Generated\Normalizer\RestoreManagedPaymentEventResponseNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\ManagedPaymentEventDraftResponse::class => \Lenorix\BeelSdk\Generated\Normalizer\ManagedPaymentEventDraftResponseNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\ManagedPaymentEventDraftResponseData::class => \Lenorix\BeelSdk\Generated\Normalizer\ManagedPaymentEventDraftResponseDataNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\EmailDeliveryResponse::class => \Lenorix\BeelSdk\Generated\Normalizer\EmailDeliveryResponseNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\EmailDeliveryListResponse::class => \Lenorix\BeelSdk\Generated\Normalizer\EmailDeliveryListResponseNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\EmailDeliveryListResponseData::class => \Lenorix\BeelSdk\Generated\Normalizer\EmailDeliveryListResponseDataNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\EmailDeliveryDetail::class => \Lenorix\BeelSdk\Generated\Normalizer\EmailDeliveryDetailNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\EmailAttachment::class => \Lenorix\BeelSdk\Generated\Normalizer\EmailAttachmentNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\RelatedInvoice::class => \Lenorix\BeelSdk\Generated\Normalizer\RelatedInvoiceNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\EmailDeliveryDetailResponse::class => \Lenorix\BeelSdk\Generated\Normalizer\EmailDeliveryDetailResponseNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\EmailDeliveryIndicator::class => \Lenorix\BeelSdk\Generated\Normalizer\EmailDeliveryIndicatorNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\EmailDeliveryIndicatorListResponse::class => \Lenorix\BeelSdk\Generated\Normalizer\EmailDeliveryIndicatorListResponseNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\EmailDeliveryIndicatorListResponseData::class => \Lenorix\BeelSdk\Generated\Normalizer\EmailDeliveryIndicatorListResponseDataNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\QueriedPeriod::class => \Lenorix\BeelSdk\Generated\Normalizer\QueriedPeriodNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\TaxBreakdownItem::class => \Lenorix\BeelSdk\Generated\Normalizer\TaxBreakdownItemNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\SurchargeBreakdownItem::class => \Lenorix\BeelSdk\Generated\Normalizer\SurchargeBreakdownItemNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\IrpfBracket::class => \Lenorix\BeelSdk\Generated\Normalizer\IrpfBracketNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\InvoiceFiscalData::class => \Lenorix\BeelSdk\Generated\Normalizer\InvoiceFiscalDataNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\FiscalSummaryResponse::class => \Lenorix\BeelSdk\Generated\Normalizer\FiscalSummaryResponseNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\MyCredential::class => \Lenorix\BeelSdk\Generated\Normalizer\MyCredentialNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\MyIdentity::class => \Lenorix\BeelSdk\Generated\Normalizer\MyIdentityNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\UpdateMeRequest::class => \Lenorix\BeelSdk\Generated\Normalizer\UpdateMeRequestNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\MyPreferences::class => \Lenorix\BeelSdk\Generated\Normalizer\MyPreferencesNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\InvoiceAttachment::class => \Lenorix\BeelSdk\Generated\Normalizer\InvoiceAttachmentNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\InvoiceSendRecord::class => \Lenorix\BeelSdk\Generated\Normalizer\InvoiceSendRecordNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\InvoiceEmailDeliveryOutcome::class => \Lenorix\BeelSdk\Generated\Normalizer\InvoiceEmailDeliveryOutcomeNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\InvoiceBase::class => \Lenorix\BeelSdk\Generated\Normalizer\InvoiceBaseNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\InvoiceBaseEmailConfig::class => \Lenorix\BeelSdk\Generated\Normalizer\InvoiceBaseEmailConfigNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\FieldDeserializationError::class => \Lenorix\BeelSdk\Generated\Normalizer\FieldDeserializationErrorNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\BulkOperationResult::class => \Lenorix\BeelSdk\Generated\Normalizer\BulkOperationResultNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\BulkOperationResultFailuresItem::class => \Lenorix\BeelSdk\Generated\Normalizer\BulkOperationResultFailuresItemNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\BulkOperationResponse::class => \Lenorix\BeelSdk\Generated\Normalizer\BulkOperationResponseNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\VoidInvoiceRequest::class => \Lenorix\BeelSdk\Generated\Normalizer\VoidInvoiceRequestNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\ConvertProformaToInvoiceRequest::class => \Lenorix\BeelSdk\Generated\Normalizer\ConvertProformaToInvoiceRequestNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\CreateInvoiceDerivationRequest::class => \Lenorix\BeelSdk\Generated\Normalizer\CreateInvoiceDerivationRequestNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\CreateInvoiceBatchRequest::class => \Lenorix\BeelSdk\Generated\Normalizer\CreateInvoiceBatchRequestNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\CreateInvoicePdfArchiveRequest::class => \Lenorix\BeelSdk\Generated\Normalizer\CreateInvoicePdfArchiveRequestNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\CreateInvoiceDeliveryRequest::class => \Lenorix\BeelSdk\Generated\Normalizer\CreateInvoiceDeliveryRequestNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\InvoiceExportFilters::class => \Lenorix\BeelSdk\Generated\Normalizer\InvoiceExportFiltersNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\CreateInvoiceExportRequest::class => \Lenorix\BeelSdk\Generated\Normalizer\CreateInvoiceExportRequestNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\InvoicePreviewResponse::class => \Lenorix\BeelSdk\Generated\Normalizer\InvoicePreviewResponseNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\InvoicePreviewResponseData::class => \Lenorix\BeelSdk\Generated\Normalizer\InvoicePreviewResponseDataNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\SetInvoiceStatusRequest::class => \Lenorix\BeelSdk\Generated\Normalizer\SetInvoiceStatusRequestNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\SetInvoiceStatusRequestPaymentMethod::class => \Lenorix\BeelSdk\Generated\Normalizer\SetInvoiceStatusRequestPaymentMethodNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\InvoiceSchedule::class => \Lenorix\BeelSdk\Generated\Normalizer\InvoiceScheduleNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\InvoiceScheduleResponse::class => \Lenorix\BeelSdk\Generated\Normalizer\InvoiceScheduleResponseNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\SetInvoiceScheduleRequest::class => \Lenorix\BeelSdk\Generated\Normalizer\SetInvoiceScheduleRequestNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\RecurringInvoicePause::class => \Lenorix\BeelSdk\Generated\Normalizer\RecurringInvoicePauseNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\RecurringInvoiceCompletion::class => \Lenorix\BeelSdk\Generated\Normalizer\RecurringInvoiceCompletionNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\PatchRecurringInvoiceRequest::class => \Lenorix\BeelSdk\Generated\Normalizer\PatchRecurringInvoiceRequestNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\PatchRecurringInvoiceRequestEmailConfiguration::class => \Lenorix\BeelSdk\Generated\Normalizer\PatchRecurringInvoiceRequestEmailConfigurationNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\NextOccurrence::class => \Lenorix\BeelSdk\Generated\Normalizer\NextOccurrenceNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\RecurringInvoiceStatsBlock::class => \Lenorix\BeelSdk\Generated\Normalizer\RecurringInvoiceStatsBlockNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\RecurringInvoiceStats::class => \Lenorix\BeelSdk\Generated\Normalizer\RecurringInvoiceStatsNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\CreateRecurringInvoiceDerivationRequest::class => \Lenorix\BeelSdk\Generated\Normalizer\CreateRecurringInvoiceDerivationRequestNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\PatchCustomerRequest::class => \Lenorix\BeelSdk\Generated\Normalizer\PatchCustomerRequestNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\PatchCustomerRequestAlternativeId::class => \Lenorix\BeelSdk\Generated\Normalizer\PatchCustomerRequestAlternativeIdNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\PatchCustomerRequestAddress::class => \Lenorix\BeelSdk\Generated\Normalizer\PatchCustomerRequestAddressNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\PatchCustomerRequestPreferredPaymentMethod::class => \Lenorix\BeelSdk\Generated\Normalizer\PatchCustomerRequestPreferredPaymentMethodNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\CustomerEcho::class => \Lenorix\BeelSdk\Generated\Normalizer\CustomerEchoNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\CustomerBulkDeleteMetadata::class => \Lenorix\BeelSdk\Generated\Normalizer\CustomerBulkDeleteMetadataNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\CustomerBulkDeleteError::class => \Lenorix\BeelSdk\Generated\Normalizer\CustomerBulkDeleteErrorNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\CustomerBulkDeleteItem::class => \Lenorix\BeelSdk\Generated\Normalizer\CustomerBulkDeleteItemNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\CustomerBulkDeleteItemError::class => \Lenorix\BeelSdk\Generated\Normalizer\CustomerBulkDeleteItemErrorNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\CustomerBulkDeleteStatistics::class => \Lenorix\BeelSdk\Generated\Normalizer\CustomerBulkDeleteStatisticsNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\CustomerBulkDeleteLegacyError::class => \Lenorix\BeelSdk\Generated\Normalizer\CustomerBulkDeleteLegacyErrorNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\CustomerBulkDeleteResult::class => \Lenorix\BeelSdk\Generated\Normalizer\CustomerBulkDeleteResultNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\CsvImportErrorDetails::class => \Lenorix\BeelSdk\Generated\Normalizer\CsvImportErrorDetailsNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\PatchProductRequest::class => \Lenorix\BeelSdk\Generated\Normalizer\PatchProductRequestNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\PatchProductRequestMainTax::class => \Lenorix\BeelSdk\Generated\Normalizer\PatchProductRequestMainTaxNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\ProductBulkCreateMetadata::class => \Lenorix\BeelSdk\Generated\Normalizer\ProductBulkCreateMetadataNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\ProductBulkCreateError::class => \Lenorix\BeelSdk\Generated\Normalizer\ProductBulkCreateErrorNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\ProductBulkCreateItem::class => \Lenorix\BeelSdk\Generated\Normalizer\ProductBulkCreateItemNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\ProductBulkCreateItemError::class => \Lenorix\BeelSdk\Generated\Normalizer\ProductBulkCreateItemErrorNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\ProductBulkCreateStatistics::class => \Lenorix\BeelSdk\Generated\Normalizer\ProductBulkCreateStatisticsNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\ProductBulkCreateLegacyError::class => \Lenorix\BeelSdk\Generated\Normalizer\ProductBulkCreateLegacyErrorNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\ProductBulkCreateLegacySummary::class => \Lenorix\BeelSdk\Generated\Normalizer\ProductBulkCreateLegacySummaryNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\ProductBulkCreateResult::class => \Lenorix\BeelSdk\Generated\Normalizer\ProductBulkCreateResultNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\ProductBulkCreateResultSummary::class => \Lenorix\BeelSdk\Generated\Normalizer\ProductBulkCreateResultSummaryNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\GrantAssignment::class => \Lenorix\BeelSdk\Generated\Normalizer\GrantAssignmentNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\MemberPermissions::class => \Lenorix\BeelSdk\Generated\Normalizer\MemberPermissionsNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\AccountMember::class => \Lenorix\BeelSdk\Generated\Normalizer\AccountMemberNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\ChangeMemberRoleRequest::class => \Lenorix\BeelSdk\Generated\Normalizer\ChangeMemberRoleRequestNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\PutMemberGrantRequest::class => \Lenorix\BeelSdk\Generated\Normalizer\PutMemberGrantRequestNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\SetAccountOwnerRequest::class => \Lenorix\BeelSdk\Generated\Normalizer\SetAccountOwnerRequestNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\InvitationSummary::class => \Lenorix\BeelSdk\Generated\Normalizer\InvitationSummaryNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\CreateInvitationRequest::class => \Lenorix\BeelSdk\Generated\Normalizer\CreateInvitationRequestNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\Invitation::class => \Lenorix\BeelSdk\Generated\Normalizer\InvitationNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\AccountClaim::class => \Lenorix\BeelSdk\Generated\Normalizer\AccountClaimNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\ManagedAccountSummary::class => \Lenorix\BeelSdk\Generated\Normalizer\ManagedAccountSummaryNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\ManagedAccountSummaryClaim::class => \Lenorix\BeelSdk\Generated\Normalizer\ManagedAccountSummaryClaimNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\ProvisionTaxProfile::class => \Lenorix\BeelSdk\Generated\Normalizer\ProvisionTaxProfileNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\ProvisionAccountRequest::class => \Lenorix\BeelSdk\Generated\Normalizer\ProvisionAccountRequestNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\ProvisionAccountRequestTaxProfile::class => \Lenorix\BeelSdk\Generated\Normalizer\ProvisionAccountRequestTaxProfileNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\ProvisionAccountResult::class => \Lenorix\BeelSdk\Generated\Normalizer\ProvisionAccountResultNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\ChangeAccessLevelRequest::class => \Lenorix\BeelSdk\Generated\Normalizer\ChangeAccessLevelRequestNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\CreateClaimTokenRequest::class => \Lenorix\BeelSdk\Generated\Normalizer\CreateClaimTokenRequestNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\ClaimTokenResult::class => \Lenorix\BeelSdk\Generated\Normalizer\ClaimTokenResultNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\ProvisioningUsage::class => \Lenorix\BeelSdk\Generated\Normalizer\ProvisioningUsageNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\AccountImportOptions::class => \Lenorix\BeelSdk\Generated\Normalizer\AccountImportOptionsNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\AccountImportUpload::class => \Lenorix\BeelSdk\Generated\Normalizer\AccountImportUploadNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\AccountImportMetadata::class => \Lenorix\BeelSdk\Generated\Normalizer\AccountImportMetadataNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\AccountImportSeriesOutcome::class => \Lenorix\BeelSdk\Generated\Normalizer\AccountImportSeriesOutcomeNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\AccountImportCustomersOutcome::class => \Lenorix\BeelSdk\Generated\Normalizer\AccountImportCustomersOutcomeNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\AccountImportIssue::class => \Lenorix\BeelSdk\Generated\Normalizer\AccountImportIssueNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\AccountImportItem::class => \Lenorix\BeelSdk\Generated\Normalizer\AccountImportItemNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\AccountImportItemAccount::class => \Lenorix\BeelSdk\Generated\Normalizer\AccountImportItemAccountNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\AccountImportItemCustomers::class => \Lenorix\BeelSdk\Generated\Normalizer\AccountImportItemCustomersNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\AccountImportCustomerRow::class => \Lenorix\BeelSdk\Generated\Normalizer\AccountImportCustomerRowNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\AccountImportCustomersSource::class => \Lenorix\BeelSdk\Generated\Normalizer\AccountImportCustomersSourceNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\AccountImportStatistics::class => \Lenorix\BeelSdk\Generated\Normalizer\AccountImportStatisticsNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\AccountImportResult::class => \Lenorix\BeelSdk\Generated\Normalizer\AccountImportResultNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\AccountImportResultCustomersSource::class => \Lenorix\BeelSdk\Generated\Normalizer\AccountImportResultCustomersSourceNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\AccountImportResultOwnCompanyCustomers::class => \Lenorix\BeelSdk\Generated\Normalizer\AccountImportResultOwnCompanyCustomersNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\PayloadTooLargeDetails::class => \Lenorix\BeelSdk\Generated\Normalizer\PayloadTooLargeDetailsNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\ExemptionReasonCatalogEntry::class => \Lenorix\BeelSdk\Generated\Normalizer\ExemptionReasonCatalogEntryNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\TaxTypesCatalog::class => \Lenorix\BeelSdk\Generated\Normalizer\TaxTypesCatalogNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\TaxTypesCatalogResponse::class => \Lenorix\BeelSdk\Generated\Normalizer\TaxTypesCatalogResponseNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\DocumentTypeDefaultStatus::class => \Lenorix\BeelSdk\Generated\Normalizer\DocumentTypeDefaultStatusNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\PatchSeriesRequest::class => \Lenorix\BeelSdk\Generated\Normalizer\PatchSeriesRequestNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\IssuingReadinessData::class => \Lenorix\BeelSdk\Generated\Normalizer\IssuingReadinessDataNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\IssuingReadinessDataVerifactu::class => \Lenorix\BeelSdk\Generated\Normalizer\IssuingReadinessDataVerifactuNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\CompanySeriesNumbering::class => \Lenorix\BeelSdk\Generated\Normalizer\CompanySeriesNumberingNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\CompanyNumbering::class => \Lenorix\BeelSdk\Generated\Normalizer\CompanyNumberingNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\PaymentRequiredResponse::class => \Lenorix\BeelSdk\Generated\Normalizer\PaymentRequiredResponseNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\CompanyStatsData::class => \Lenorix\BeelSdk\Generated\Normalizer\CompanyStatsDataNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\ListCompanyStats200Response::class => \Lenorix\BeelSdk\Generated\Normalizer\ListCompanyStats200ResponseNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\ListCompanyStats200ResponseData::class => \Lenorix\BeelSdk\Generated\Normalizer\ListCompanyStats200ResponseDataNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\IssuingReadinessResponse::class => \Lenorix\BeelSdk\Generated\Normalizer\IssuingReadinessResponseNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\ActivateCompanyRequest::class => \Lenorix\BeelSdk\Generated\Normalizer\ActivateCompanyRequestNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\CompanyActivation::class => \Lenorix\BeelSdk\Generated\Normalizer\CompanyActivationNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\CompanyActivationResponse::class => \Lenorix\BeelSdk\Generated\Normalizer\CompanyActivationResponseNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\CompanyDeactivation::class => \Lenorix\BeelSdk\Generated\Normalizer\CompanyDeactivationNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\ManagedPaymentConnection::class => \Lenorix\BeelSdk\Generated\Normalizer\ManagedPaymentConnectionNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\ListManagedPaymentConnectionsResponse::class => \Lenorix\BeelSdk\Generated\Normalizer\ListManagedPaymentConnectionsResponseNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\ListManagedPaymentConnectionsResponseData::class => \Lenorix\BeelSdk\Generated\Normalizer\ListManagedPaymentConnectionsResponseDataNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\UpdateCompanyPaymentConnectionSeries::class => \Lenorix\BeelSdk\Generated\Normalizer\UpdateCompanyPaymentConnectionSeriesNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\CompanyPaymentConnectionFilters::class => \Lenorix\BeelSdk\Generated\Normalizer\CompanyPaymentConnectionFiltersNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\CompanyPaymentConnectionSeries::class => \Lenorix\BeelSdk\Generated\Normalizer\CompanyPaymentConnectionSeriesNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\PaymentEventFailureReasonCount::class => \Lenorix\BeelSdk\Generated\Normalizer\PaymentEventFailureReasonCountNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\PaymentEventCounts::class => \Lenorix\BeelSdk\Generated\Normalizer\PaymentEventCountsNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\WebhookSubscription::class => \Lenorix\BeelSdk\Generated\Normalizer\WebhookSubscriptionNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\CreateWebhookSubscriptionRequest::class => \Lenorix\BeelSdk\Generated\Normalizer\CreateWebhookSubscriptionRequestNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\WebhookTestResult::class => \Lenorix\BeelSdk\Generated\Normalizer\WebhookTestResultNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\WebhookSubscriptionWithSecret::class => \Lenorix\BeelSdk\Generated\Normalizer\WebhookSubscriptionWithSecretNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\WebhookSubscriptionWithSecretTestDelivery::class => \Lenorix\BeelSdk\Generated\Normalizer\WebhookSubscriptionWithSecretTestDeliveryNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\WebhookEventDataInvoiceIssued::class => \Lenorix\BeelSdk\Generated\Normalizer\WebhookEventDataInvoiceIssuedNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\WebhookEventDataInvoiceEmailSent::class => \Lenorix\BeelSdk\Generated\Normalizer\WebhookEventDataInvoiceEmailSentNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\WebhookEventDataInvoicePdfGenerated::class => \Lenorix\BeelSdk\Generated\Normalizer\WebhookEventDataInvoicePdfGeneratedNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\WebhookEventDataInvoiceVoided::class => \Lenorix\BeelSdk\Generated\Normalizer\WebhookEventDataInvoiceVoidedNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\WebhookEventDataRecurringInvoicePaused::class => \Lenorix\BeelSdk\Generated\Normalizer\WebhookEventDataRecurringInvoicePausedNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\WebhookEventDataInvoiceScheduleFailed::class => \Lenorix\BeelSdk\Generated\Normalizer\WebhookEventDataInvoiceScheduleFailedNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\WebhookEventDataVeriFactuStatusUpdated::class => \Lenorix\BeelSdk\Generated\Normalizer\WebhookEventDataVeriFactuStatusUpdatedNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\WebhookEventDataAccountClaimed::class => \Lenorix\BeelSdk\Generated\Normalizer\WebhookEventDataAccountClaimedNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\WebhookEventDataCompanyCreated::class => \Lenorix\BeelSdk\Generated\Normalizer\WebhookEventDataCompanyCreatedNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\WebhookEventDataRepresentationSigned::class => \Lenorix\BeelSdk\Generated\Normalizer\WebhookEventDataRepresentationSignedNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\WebhookEvent::class => \Lenorix\BeelSdk\Generated\Normalizer\WebhookEventNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\UpdateWebhookSubscriptionRequest::class => \Lenorix\BeelSdk\Generated\Normalizer\UpdateWebhookSubscriptionRequestNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\WebhookDeliveryLog::class => \Lenorix\BeelSdk\Generated\Normalizer\WebhookDeliveryLogNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\RequestLogSummary::class => \Lenorix\BeelSdk\Generated\Normalizer\RequestLogSummaryNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\RequestLogCursorPagination::class => \Lenorix\BeelSdk\Generated\Normalizer\RequestLogCursorPaginationNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\RequestLogListResponse::class => \Lenorix\BeelSdk\Generated\Normalizer\RequestLogListResponseNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\RequestLogListResponseData::class => \Lenorix\BeelSdk\Generated\Normalizer\RequestLogListResponseDataNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\RequestLogDetail::class => \Lenorix\BeelSdk\Generated\Normalizer\RequestLogDetailNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\RequestLogSingleResponse::class => \Lenorix\BeelSdk\Generated\Normalizer\RequestLogSingleResponseNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\ResponseInvalidJsonFormat::class => \Lenorix\BeelSdk\Generated\Normalizer\ResponseInvalidJsonFormatNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\ResponseInvalidJsonFormatError::class => \Lenorix\BeelSdk\Generated\Normalizer\ResponseInvalidJsonFormatErrorNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\ResponseCustomerImportRejected::class => \Lenorix\BeelSdk\Generated\Normalizer\ResponseCustomerImportRejectedNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\ResponseCustomerImportRejectedError::class => \Lenorix\BeelSdk\Generated\Normalizer\ResponseCustomerImportRejectedErrorNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\ResponsePayloadTooLarge::class => \Lenorix\BeelSdk\Generated\Normalizer\ResponsePayloadTooLargeNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\ResponsePayloadTooLargeError::class => \Lenorix\BeelSdk\Generated\Normalizer\ResponsePayloadTooLargeErrorNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1MeIdentityGetResponse200::class => \Lenorix\BeelSdk\Generated\Normalizer\V1MeIdentityGetResponse200Normalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1MePatchResponse200::class => \Lenorix\BeelSdk\Generated\Normalizer\V1MePatchResponse200Normalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1InvoicesGetResponse200::class => \Lenorix\BeelSdk\Generated\Normalizer\V1InvoicesGetResponse200Normalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1InvoicesGetResponse200Data::class => \Lenorix\BeelSdk\Generated\Normalizer\V1InvoicesGetResponse200DataNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1InvoicesPostResponse201::class => \Lenorix\BeelSdk\Generated\Normalizer\V1InvoicesPostResponse201Normalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1InvoicesInvoiceIdGetResponse200::class => \Lenorix\BeelSdk\Generated\Normalizer\V1InvoicesInvoiceIdGetResponse200Normalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1InvoicesInvoiceIdPutResponse200::class => \Lenorix\BeelSdk\Generated\Normalizer\V1InvoicesInvoiceIdPutResponse200Normalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1InvoicesBulkPdfPostBody::class => \Lenorix\BeelSdk\Generated\Normalizer\V1InvoicesBulkPdfPostBodyNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1InvoicesBulkSendPostBody::class => \Lenorix\BeelSdk\Generated\Normalizer\V1InvoicesBulkSendPostBodyNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1InvoicesBulkSendPostResponse200::class => \Lenorix\BeelSdk\Generated\Normalizer\V1InvoicesBulkSendPostResponse200Normalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1InvoicesBulkSendPostResponse200Data::class => \Lenorix\BeelSdk\Generated\Normalizer\V1InvoicesBulkSendPostResponse200DataNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1InvoicesBulkSendPostResponse200DataFailuresItem::class => \Lenorix\BeelSdk\Generated\Normalizer\V1InvoicesBulkSendPostResponse200DataFailuresItemNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1InvoicesBulkStatusPostBody::class => \Lenorix\BeelSdk\Generated\Normalizer\V1InvoicesBulkStatusPostBodyNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1InvoicesBulkIssuePostBody::class => \Lenorix\BeelSdk\Generated\Normalizer\V1InvoicesBulkIssuePostBodyNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1InvoicesInvoiceIdSendPostResponse200::class => \Lenorix\BeelSdk\Generated\Normalizer\V1InvoicesInvoiceIdSendPostResponse200Normalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1InvoicesInvoiceIdSendPostResponse200Data::class => \Lenorix\BeelSdk\Generated\Normalizer\V1InvoicesInvoiceIdSendPostResponse200DataNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1InvoicesInvoiceIdMarkPaidPostBody::class => \Lenorix\BeelSdk\Generated\Normalizer\V1InvoicesInvoiceIdMarkPaidPostBodyNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1InvoicesInvoiceIdMarkPaidPostResponse200::class => \Lenorix\BeelSdk\Generated\Normalizer\V1InvoicesInvoiceIdMarkPaidPostResponse200Normalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1InvoicesInvoiceIdVoidPostResponse200::class => \Lenorix\BeelSdk\Generated\Normalizer\V1InvoicesInvoiceIdVoidPostResponse200Normalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1InvoicesInvoiceIdCorrectivePostResponse201::class => \Lenorix\BeelSdk\Generated\Normalizer\V1InvoicesInvoiceIdCorrectivePostResponse201Normalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1InvoicesInvoiceIdIssuePostResponse200::class => \Lenorix\BeelSdk\Generated\Normalizer\V1InvoicesInvoiceIdIssuePostResponse200Normalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1InvoicesInvoiceIdConvertToInvoicePostResponse201::class => \Lenorix\BeelSdk\Generated\Normalizer\V1InvoicesInvoiceIdConvertToInvoicePostResponse201Normalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1InvoicesInvoiceIdMarkSentPostBody::class => \Lenorix\BeelSdk\Generated\Normalizer\V1InvoicesInvoiceIdMarkSentPostBodyNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1InvoicesInvoiceIdMarkSentPostResponse200::class => \Lenorix\BeelSdk\Generated\Normalizer\V1InvoicesInvoiceIdMarkSentPostResponse200Normalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1InvoicesInvoiceIdRevertToIssuedPostResponse200::class => \Lenorix\BeelSdk\Generated\Normalizer\V1InvoicesInvoiceIdRevertToIssuedPostResponse200Normalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1InvoicesInvoiceIdSchedulePostBody::class => \Lenorix\BeelSdk\Generated\Normalizer\V1InvoicesInvoiceIdSchedulePostBodyNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1InvoicesInvoiceIdSchedulePostResponse200::class => \Lenorix\BeelSdk\Generated\Normalizer\V1InvoicesInvoiceIdSchedulePostResponse200Normalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1InvoicesInvoiceIdUnschedulePostResponse200::class => \Lenorix\BeelSdk\Generated\Normalizer\V1InvoicesInvoiceIdUnschedulePostResponse200Normalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1InvoicesInvoiceIdReschedulePatchBody::class => \Lenorix\BeelSdk\Generated\Normalizer\V1InvoicesInvoiceIdReschedulePatchBodyNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1InvoicesInvoiceIdReschedulePatchResponse200::class => \Lenorix\BeelSdk\Generated\Normalizer\V1InvoicesInvoiceIdReschedulePatchResponse200Normalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1InvoicesInvoiceIdDuplicatePostBody::class => \Lenorix\BeelSdk\Generated\Normalizer\V1InvoicesInvoiceIdDuplicatePostBodyNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1InvoicesInvoiceIdDuplicatePostResponse201::class => \Lenorix\BeelSdk\Generated\Normalizer\V1InvoicesInvoiceIdDuplicatePostResponse201Normalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1InvoicesExportExcelPostBody::class => \Lenorix\BeelSdk\Generated\Normalizer\V1InvoicesExportExcelPostBodyNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdInvoicesGetResponse200::class => \Lenorix\BeelSdk\Generated\Normalizer\V1CompaniesCompanyIdInvoicesGetResponse200Normalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdInvoicesGetResponse200Data::class => \Lenorix\BeelSdk\Generated\Normalizer\V1CompaniesCompanyIdInvoicesGetResponse200DataNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdInvoicesPostResponse201::class => \Lenorix\BeelSdk\Generated\Normalizer\V1CompaniesCompanyIdInvoicesPostResponse201Normalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdInvoicesDerivationsPostResponse201::class => \Lenorix\BeelSdk\Generated\Normalizer\V1CompaniesCompanyIdInvoicesDerivationsPostResponse201Normalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdInvoicesDeliveriesPostResponse200::class => \Lenorix\BeelSdk\Generated\Normalizer\V1CompaniesCompanyIdInvoicesDeliveriesPostResponse200Normalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdInvoicesDeliveriesPostResponse200Data::class => \Lenorix\BeelSdk\Generated\Normalizer\V1CompaniesCompanyIdInvoicesDeliveriesPostResponse200DataNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdInvoicesDeliveriesPostResponse200DataFailuresItem::class => \Lenorix\BeelSdk\Generated\Normalizer\V1CompaniesCompanyIdInvoicesDeliveriesPostResponse200DataFailuresItemNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdInvoicesInvoiceIdGetResponse200::class => \Lenorix\BeelSdk\Generated\Normalizer\V1CompaniesCompanyIdInvoicesInvoiceIdGetResponse200Normalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdInvoicesInvoiceIdPatchResponse200::class => \Lenorix\BeelSdk\Generated\Normalizer\V1CompaniesCompanyIdInvoicesInvoiceIdPatchResponse200Normalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdInvoicesInvoiceIdSendPostResponse200::class => \Lenorix\BeelSdk\Generated\Normalizer\V1CompaniesCompanyIdInvoicesInvoiceIdSendPostResponse200Normalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdInvoicesInvoiceIdSendPostResponse200Data::class => \Lenorix\BeelSdk\Generated\Normalizer\V1CompaniesCompanyIdInvoicesInvoiceIdSendPostResponse200DataNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdInvoicesInvoiceIdIssuePostResponse200::class => \Lenorix\BeelSdk\Generated\Normalizer\V1CompaniesCompanyIdInvoicesInvoiceIdIssuePostResponse200Normalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdInvoicesInvoiceIdVoidPostResponse200::class => \Lenorix\BeelSdk\Generated\Normalizer\V1CompaniesCompanyIdInvoicesInvoiceIdVoidPostResponse200Normalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdInvoicesInvoiceIdCorrectivePostResponse201::class => \Lenorix\BeelSdk\Generated\Normalizer\V1CompaniesCompanyIdInvoicesInvoiceIdCorrectivePostResponse201Normalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdInvoicesInvoiceIdConvertToInvoicePostResponse201::class => \Lenorix\BeelSdk\Generated\Normalizer\V1CompaniesCompanyIdInvoicesInvoiceIdConvertToInvoicePostResponse201Normalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdInvoicesInvoiceIdStatusPutResponse200::class => \Lenorix\BeelSdk\Generated\Normalizer\V1CompaniesCompanyIdInvoicesInvoiceIdStatusPutResponse200Normalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdInvoicesInvoiceIdSchedulePutResponse200::class => \Lenorix\BeelSdk\Generated\Normalizer\V1CompaniesCompanyIdInvoicesInvoiceIdSchedulePutResponse200Normalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1RecurringInvoicesGetResponse200::class => \Lenorix\BeelSdk\Generated\Normalizer\V1RecurringInvoicesGetResponse200Normalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1RecurringInvoicesGetResponse200Data::class => \Lenorix\BeelSdk\Generated\Normalizer\V1RecurringInvoicesGetResponse200DataNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1RecurringInvoicesPostResponse201::class => \Lenorix\BeelSdk\Generated\Normalizer\V1RecurringInvoicesPostResponse201Normalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1RecurringInvoicesRecurringInvoiceIdGetResponse200::class => \Lenorix\BeelSdk\Generated\Normalizer\V1RecurringInvoicesRecurringInvoiceIdGetResponse200Normalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1RecurringInvoicesRecurringInvoiceIdPatchResponse200::class => \Lenorix\BeelSdk\Generated\Normalizer\V1RecurringInvoicesRecurringInvoiceIdPatchResponse200Normalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1RecurringInvoicesRecurringInvoiceIdPutResponse200::class => \Lenorix\BeelSdk\Generated\Normalizer\V1RecurringInvoicesRecurringInvoiceIdPutResponse200Normalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1RecurringInvoicesRecurringInvoiceIdPausePostResponse200::class => \Lenorix\BeelSdk\Generated\Normalizer\V1RecurringInvoicesRecurringInvoiceIdPausePostResponse200Normalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1RecurringInvoicesRecurringInvoiceIdResumePostResponse200::class => \Lenorix\BeelSdk\Generated\Normalizer\V1RecurringInvoicesRecurringInvoiceIdResumePostResponse200Normalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1RecurringInvoicesRecurringInvoiceIdGeneratePostResponse201::class => \Lenorix\BeelSdk\Generated\Normalizer\V1RecurringInvoicesRecurringInvoiceIdGeneratePostResponse201Normalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1RecurringInvoicesRecurringInvoiceIdGeneratePostResponse201Data::class => \Lenorix\BeelSdk\Generated\Normalizer\V1RecurringInvoicesRecurringInvoiceIdGeneratePostResponse201DataNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1RecurringInvoicesRecurringInvoiceIdSkipPostResponse200::class => \Lenorix\BeelSdk\Generated\Normalizer\V1RecurringInvoicesRecurringInvoiceIdSkipPostResponse200Normalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1RecurringInvoicesRecurringInvoiceIdPreviewGetResponse200::class => \Lenorix\BeelSdk\Generated\Normalizer\V1RecurringInvoicesRecurringInvoiceIdPreviewGetResponse200Normalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1RecurringInvoicesRecurringInvoiceIdHistoryGetResponse200::class => \Lenorix\BeelSdk\Generated\Normalizer\V1RecurringInvoicesRecurringInvoiceIdHistoryGetResponse200Normalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1RecurringInvoicesRecurringInvoiceIdHistoryGetResponse200Data::class => \Lenorix\BeelSdk\Generated\Normalizer\V1RecurringInvoicesRecurringInvoiceIdHistoryGetResponse200DataNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1InvoicesInvoiceIdCreateRecurringPostResponse201::class => \Lenorix\BeelSdk\Generated\Normalizer\V1InvoicesInvoiceIdCreateRecurringPostResponse201Normalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdRecurringInvoicesGetResponse200::class => \Lenorix\BeelSdk\Generated\Normalizer\V1CompaniesCompanyIdRecurringInvoicesGetResponse200Normalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdRecurringInvoicesGetResponse200Data::class => \Lenorix\BeelSdk\Generated\Normalizer\V1CompaniesCompanyIdRecurringInvoicesGetResponse200DataNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdRecurringInvoicesPostResponse201::class => \Lenorix\BeelSdk\Generated\Normalizer\V1CompaniesCompanyIdRecurringInvoicesPostResponse201Normalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdRecurringInvoicesStatsGetResponse200::class => \Lenorix\BeelSdk\Generated\Normalizer\V1CompaniesCompanyIdRecurringInvoicesStatsGetResponse200Normalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdRecurringInvoicesRecurringInvoiceIdGetResponse200::class => \Lenorix\BeelSdk\Generated\Normalizer\V1CompaniesCompanyIdRecurringInvoicesRecurringInvoiceIdGetResponse200Normalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdRecurringInvoicesRecurringInvoiceIdPatchResponse200::class => \Lenorix\BeelSdk\Generated\Normalizer\V1CompaniesCompanyIdRecurringInvoicesRecurringInvoiceIdPatchResponse200Normalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdRecurringInvoicesRecurringInvoiceIdStatusPutResponse200::class => \Lenorix\BeelSdk\Generated\Normalizer\V1CompaniesCompanyIdRecurringInvoicesRecurringInvoiceIdStatusPutResponse200Normalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdRecurringInvoicesRecurringInvoiceIdSkipPostResponse200::class => \Lenorix\BeelSdk\Generated\Normalizer\V1CompaniesCompanyIdRecurringInvoicesRecurringInvoiceIdSkipPostResponse200Normalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdRecurringInvoicesRecurringInvoiceIdNextOccurrenceGetResponse200::class => \Lenorix\BeelSdk\Generated\Normalizer\V1CompaniesCompanyIdRecurringInvoicesRecurringInvoiceIdNextOccurrenceGetResponse200Normalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdRecurringInvoicesRecurringInvoiceIdHistoryGetResponse200::class => \Lenorix\BeelSdk\Generated\Normalizer\V1CompaniesCompanyIdRecurringInvoicesRecurringInvoiceIdHistoryGetResponse200Normalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdRecurringInvoicesRecurringInvoiceIdHistoryGetResponse200Data::class => \Lenorix\BeelSdk\Generated\Normalizer\V1CompaniesCompanyIdRecurringInvoicesRecurringInvoiceIdHistoryGetResponse200DataNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdRecurringInvoicesDerivationsPostResponse201::class => \Lenorix\BeelSdk\Generated\Normalizer\V1CompaniesCompanyIdRecurringInvoicesDerivationsPostResponse201Normalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdRecurringInvoicesRecurringInvoiceIdGeneratePostResponse201::class => \Lenorix\BeelSdk\Generated\Normalizer\V1CompaniesCompanyIdRecurringInvoicesRecurringInvoiceIdGeneratePostResponse201Normalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdRecurringInvoicesRecurringInvoiceIdGeneratePostResponse201Data::class => \Lenorix\BeelSdk\Generated\Normalizer\V1CompaniesCompanyIdRecurringInvoicesRecurringInvoiceIdGeneratePostResponse201DataNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1CustomersGetResponse200::class => \Lenorix\BeelSdk\Generated\Normalizer\V1CustomersGetResponse200Normalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1CustomersGetResponse200Data::class => \Lenorix\BeelSdk\Generated\Normalizer\V1CustomersGetResponse200DataNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1CustomersPostResponse201::class => \Lenorix\BeelSdk\Generated\Normalizer\V1CustomersPostResponse201Normalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1CustomersCustomerIdDeleteResponse200::class => \Lenorix\BeelSdk\Generated\Normalizer\V1CustomersCustomerIdDeleteResponse200Normalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1CustomersCustomerIdDeleteResponse200Data::class => \Lenorix\BeelSdk\Generated\Normalizer\V1CustomersCustomerIdDeleteResponse200DataNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1CustomersCustomerIdGetResponse200::class => \Lenorix\BeelSdk\Generated\Normalizer\V1CustomersCustomerIdGetResponse200Normalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1CustomersCustomerIdPatchResponse200::class => \Lenorix\BeelSdk\Generated\Normalizer\V1CustomersCustomerIdPatchResponse200Normalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1CustomersCustomerIdPutResponse200::class => \Lenorix\BeelSdk\Generated\Normalizer\V1CustomersCustomerIdPutResponse200Normalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1CustomersBulkDeleteResponse200::class => \Lenorix\BeelSdk\Generated\Normalizer\V1CustomersBulkDeleteResponse200Normalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1CustomersBulkPostBody::class => \Lenorix\BeelSdk\Generated\Normalizer\V1CustomersBulkPostBodyNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1CustomersBulkPostResponse200::class => \Lenorix\BeelSdk\Generated\Normalizer\V1CustomersBulkPostResponse200Normalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1CustomersBulkPostResponse201::class => \Lenorix\BeelSdk\Generated\Normalizer\V1CustomersBulkPostResponse201Normalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1CustomersBulkPostResponse422::class => \Lenorix\BeelSdk\Generated\Normalizer\V1CustomersBulkPostResponse422Normalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1CustomersBulkPostResponse422Error::class => \Lenorix\BeelSdk\Generated\Normalizer\V1CustomersBulkPostResponse422ErrorNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1CustomersBulkPostResponse422ErrorErrorsItem::class => \Lenorix\BeelSdk\Generated\Normalizer\V1CustomersBulkPostResponse422ErrorErrorsItemNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1CustomersImportCsvPreviewPostBody::class => \Lenorix\BeelSdk\Generated\Normalizer\V1CustomersImportCsvPreviewPostBodyNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1CustomersImportCsvPreviewPostResponse200::class => \Lenorix\BeelSdk\Generated\Normalizer\V1CustomersImportCsvPreviewPostResponse200Normalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1CustomersImportHoldedContactsPostBody::class => \Lenorix\BeelSdk\Generated\Normalizer\V1CustomersImportHoldedContactsPostBodyNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1CustomersImportHoldedContactsPostResponse200::class => \Lenorix\BeelSdk\Generated\Normalizer\V1CustomersImportHoldedContactsPostResponse200Normalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdCustomersGetResponse200::class => \Lenorix\BeelSdk\Generated\Normalizer\V1CompaniesCompanyIdCustomersGetResponse200Normalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdCustomersGetResponse200Data::class => \Lenorix\BeelSdk\Generated\Normalizer\V1CompaniesCompanyIdCustomersGetResponse200DataNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdCustomersPostResponse201::class => \Lenorix\BeelSdk\Generated\Normalizer\V1CompaniesCompanyIdCustomersPostResponse201Normalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdCustomersBulkDeleteResponse200::class => \Lenorix\BeelSdk\Generated\Normalizer\V1CompaniesCompanyIdCustomersBulkDeleteResponse200Normalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdCustomersBulkPostBody::class => \Lenorix\BeelSdk\Generated\Normalizer\V1CompaniesCompanyIdCustomersBulkPostBodyNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdCustomersBulkPostResponse200::class => \Lenorix\BeelSdk\Generated\Normalizer\V1CompaniesCompanyIdCustomersBulkPostResponse200Normalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdCustomersBulkPostResponse201::class => \Lenorix\BeelSdk\Generated\Normalizer\V1CompaniesCompanyIdCustomersBulkPostResponse201Normalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdCustomersImportsPostBody::class => \Lenorix\BeelSdk\Generated\Normalizer\V1CompaniesCompanyIdCustomersImportsPostBodyNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdCustomersImportsPostResponse201::class => \Lenorix\BeelSdk\Generated\Normalizer\V1CompaniesCompanyIdCustomersImportsPostResponse201Normalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdCustomersImportsPreviewPostBody::class => \Lenorix\BeelSdk\Generated\Normalizer\V1CompaniesCompanyIdCustomersImportsPreviewPostBodyNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdCustomersImportsPreviewPostResponse200::class => \Lenorix\BeelSdk\Generated\Normalizer\V1CompaniesCompanyIdCustomersImportsPreviewPostResponse200Normalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdCustomersCustomerIdGetResponse200::class => \Lenorix\BeelSdk\Generated\Normalizer\V1CompaniesCompanyIdCustomersCustomerIdGetResponse200Normalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdCustomersCustomerIdPatchResponse200::class => \Lenorix\BeelSdk\Generated\Normalizer\V1CompaniesCompanyIdCustomersCustomerIdPatchResponse200Normalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1ProductsGetResponse200::class => \Lenorix\BeelSdk\Generated\Normalizer\V1ProductsGetResponse200Normalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1ProductsGetResponse200Data::class => \Lenorix\BeelSdk\Generated\Normalizer\V1ProductsGetResponse200DataNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1ProductsPostResponse201::class => \Lenorix\BeelSdk\Generated\Normalizer\V1ProductsPostResponse201Normalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1ProductsProductIdGetResponse200::class => \Lenorix\BeelSdk\Generated\Normalizer\V1ProductsProductIdGetResponse200Normalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1ProductsProductIdPatchResponse200::class => \Lenorix\BeelSdk\Generated\Normalizer\V1ProductsProductIdPatchResponse200Normalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1ProductsProductIdPutResponse200::class => \Lenorix\BeelSdk\Generated\Normalizer\V1ProductsProductIdPutResponse200Normalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1ProductsSearchGetResponse200::class => \Lenorix\BeelSdk\Generated\Normalizer\V1ProductsSearchGetResponse200Normalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1ProductsBulkDeleteBody::class => \Lenorix\BeelSdk\Generated\Normalizer\V1ProductsBulkDeleteBodyNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1ProductsBulkDeleteResponse200::class => \Lenorix\BeelSdk\Generated\Normalizer\V1ProductsBulkDeleteResponse200Normalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1ProductsBulkDeleteResponse200Data::class => \Lenorix\BeelSdk\Generated\Normalizer\V1ProductsBulkDeleteResponse200DataNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1ProductsBulkDeleteResponse200DataErrorsItem::class => \Lenorix\BeelSdk\Generated\Normalizer\V1ProductsBulkDeleteResponse200DataErrorsItemNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1ProductsBulkDeleteResponse200DataSummary::class => \Lenorix\BeelSdk\Generated\Normalizer\V1ProductsBulkDeleteResponse200DataSummaryNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1ProductsBulkPostBody::class => \Lenorix\BeelSdk\Generated\Normalizer\V1ProductsBulkPostBodyNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1ProductsBulkPostResponse201::class => \Lenorix\BeelSdk\Generated\Normalizer\V1ProductsBulkPostResponse201Normalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdProductsGetResponse200::class => \Lenorix\BeelSdk\Generated\Normalizer\V1CompaniesCompanyIdProductsGetResponse200Normalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdProductsGetResponse200Data::class => \Lenorix\BeelSdk\Generated\Normalizer\V1CompaniesCompanyIdProductsGetResponse200DataNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdProductsPostResponse201::class => \Lenorix\BeelSdk\Generated\Normalizer\V1CompaniesCompanyIdProductsPostResponse201Normalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdProductsBulkDeleteResponse200::class => \Lenorix\BeelSdk\Generated\Normalizer\V1CompaniesCompanyIdProductsBulkDeleteResponse200Normalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdProductsBulkDeleteResponse200Data::class => \Lenorix\BeelSdk\Generated\Normalizer\V1CompaniesCompanyIdProductsBulkDeleteResponse200DataNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdProductsBulkDeleteResponse200DataErrorsItem::class => \Lenorix\BeelSdk\Generated\Normalizer\V1CompaniesCompanyIdProductsBulkDeleteResponse200DataErrorsItemNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdProductsBulkDeleteResponse200DataSummary::class => \Lenorix\BeelSdk\Generated\Normalizer\V1CompaniesCompanyIdProductsBulkDeleteResponse200DataSummaryNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdProductsBulkPostBody::class => \Lenorix\BeelSdk\Generated\Normalizer\V1CompaniesCompanyIdProductsBulkPostBodyNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdProductsBulkPostResponse201::class => \Lenorix\BeelSdk\Generated\Normalizer\V1CompaniesCompanyIdProductsBulkPostResponse201Normalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdProductsProductIdGetResponse200::class => \Lenorix\BeelSdk\Generated\Normalizer\V1CompaniesCompanyIdProductsProductIdGetResponse200Normalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdProductsProductIdPatchResponse200::class => \Lenorix\BeelSdk\Generated\Normalizer\V1CompaniesCompanyIdProductsProductIdPatchResponse200Normalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1AccountsAccountIdMembersGetResponse200::class => \Lenorix\BeelSdk\Generated\Normalizer\V1AccountsAccountIdMembersGetResponse200Normalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1AccountsAccountIdMembersGetResponse200Data::class => \Lenorix\BeelSdk\Generated\Normalizer\V1AccountsAccountIdMembersGetResponse200DataNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1AccountsAccountIdMembersMemberIdGetResponse200::class => \Lenorix\BeelSdk\Generated\Normalizer\V1AccountsAccountIdMembersMemberIdGetResponse200Normalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1AccountsAccountIdMembersMemberIdPatchResponse200::class => \Lenorix\BeelSdk\Generated\Normalizer\V1AccountsAccountIdMembersMemberIdPatchResponse200Normalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1AccountsAccountIdMembersMemberIdGrantsGetResponse200::class => \Lenorix\BeelSdk\Generated\Normalizer\V1AccountsAccountIdMembersMemberIdGrantsGetResponse200Normalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1AccountsAccountIdMembersMemberIdGrantsGetResponse200Data::class => \Lenorix\BeelSdk\Generated\Normalizer\V1AccountsAccountIdMembersMemberIdGrantsGetResponse200DataNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1AccountsAccountIdMembersMemberIdGrantsCompanyIdPutResponse200::class => \Lenorix\BeelSdk\Generated\Normalizer\V1AccountsAccountIdMembersMemberIdGrantsCompanyIdPutResponse200Normalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1AccountsAccountIdInvitationsGetResponse200::class => \Lenorix\BeelSdk\Generated\Normalizer\V1AccountsAccountIdInvitationsGetResponse200Normalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1AccountsAccountIdInvitationsGetResponse200Data::class => \Lenorix\BeelSdk\Generated\Normalizer\V1AccountsAccountIdInvitationsGetResponse200DataNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1AccountsAccountIdInvitationsPostResponse201::class => \Lenorix\BeelSdk\Generated\Normalizer\V1AccountsAccountIdInvitationsPostResponse201Normalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1AccountsAccountIdInvitationsInvitationIdGetResponse200::class => \Lenorix\BeelSdk\Generated\Normalizer\V1AccountsAccountIdInvitationsInvitationIdGetResponse200Normalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1AccountsGetResponse200::class => \Lenorix\BeelSdk\Generated\Normalizer\V1AccountsGetResponse200Normalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1AccountsGetResponse200Data::class => \Lenorix\BeelSdk\Generated\Normalizer\V1AccountsGetResponse200DataNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1AccountsPostResponse201::class => \Lenorix\BeelSdk\Generated\Normalizer\V1AccountsPostResponse201Normalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1AccountsAccountIdGetResponse200::class => \Lenorix\BeelSdk\Generated\Normalizer\V1AccountsAccountIdGetResponse200Normalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1AccountsAccountIdClaimTokensPostResponse201::class => \Lenorix\BeelSdk\Generated\Normalizer\V1AccountsAccountIdClaimTokensPostResponse201Normalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1AccountsAccountIdUsageGetResponse200::class => \Lenorix\BeelSdk\Generated\Normalizer\V1AccountsAccountIdUsageGetResponse200Normalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1AccountsImportsPostResponse201::class => \Lenorix\BeelSdk\Generated\Normalizer\V1AccountsImportsPostResponse201Normalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1AccountsImportsPreviewPostResponse200::class => \Lenorix\BeelSdk\Generated\Normalizer\V1AccountsImportsPreviewPostResponse200Normalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdFiscalSummaryGetResponse200::class => \Lenorix\BeelSdk\Generated\Normalizer\V1CompaniesCompanyIdFiscalSummaryGetResponse200Normalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1ConfigurationVerifactuGetResponse200::class => \Lenorix\BeelSdk\Generated\Normalizer\V1ConfigurationVerifactuGetResponse200Normalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1ConfigurationVerifactuPutResponse200::class => \Lenorix\BeelSdk\Generated\Normalizer\V1ConfigurationVerifactuPutResponse200Normalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1ConfigurationInvoiceCustomizationOptionsGetResponse200::class => \Lenorix\BeelSdk\Generated\Normalizer\V1ConfigurationInvoiceCustomizationOptionsGetResponse200Normalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1ConfigurationTaxesGetResponse200::class => \Lenorix\BeelSdk\Generated\Normalizer\V1ConfigurationTaxesGetResponse200Normalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1ConfigurationTaxesPutResponse200::class => \Lenorix\BeelSdk\Generated\Normalizer\V1ConfigurationTaxesPutResponse200Normalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1ConfigurationSeriesGetResponse200::class => \Lenorix\BeelSdk\Generated\Normalizer\V1ConfigurationSeriesGetResponse200Normalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1ConfigurationSeriesGetResponse200Data::class => \Lenorix\BeelSdk\Generated\Normalizer\V1ConfigurationSeriesGetResponse200DataNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1ConfigurationSeriesGetResponse200DataPagination::class => \Lenorix\BeelSdk\Generated\Normalizer\V1ConfigurationSeriesGetResponse200DataPaginationNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1ConfigurationSeriesPostResponse201::class => \Lenorix\BeelSdk\Generated\Normalizer\V1ConfigurationSeriesPostResponse201Normalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1ConfigurationSeriesDefaultsPostResponse200::class => \Lenorix\BeelSdk\Generated\Normalizer\V1ConfigurationSeriesDefaultsPostResponse200Normalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1ConfigurationSeriesDefaultsPostResponse200Data::class => \Lenorix\BeelSdk\Generated\Normalizer\V1ConfigurationSeriesDefaultsPostResponse200DataNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1ConfigurationSeriesDefaultsStatusGetResponse200::class => \Lenorix\BeelSdk\Generated\Normalizer\V1ConfigurationSeriesDefaultsStatusGetResponse200Normalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1ConfigurationSeriesDefaultsStatusGetResponse200Data::class => \Lenorix\BeelSdk\Generated\Normalizer\V1ConfigurationSeriesDefaultsStatusGetResponse200DataNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1ConfigurationSeriesSeriesIdPatchResponse200::class => \Lenorix\BeelSdk\Generated\Normalizer\V1ConfigurationSeriesSeriesIdPatchResponse200Normalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1ConfigurationSeriesSeriesIdPutResponse200::class => \Lenorix\BeelSdk\Generated\Normalizer\V1ConfigurationSeriesSeriesIdPutResponse200Normalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1ConfigurationSeriesSeriesIdDefaultPostResponse200::class => \Lenorix\BeelSdk\Generated\Normalizer\V1ConfigurationSeriesSeriesIdDefaultPostResponse200Normalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1ConfigurationLanguagePutBody::class => \Lenorix\BeelSdk\Generated\Normalizer\V1ConfigurationLanguagePutBodyNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1ConfigurationLanguagePutResponse200::class => \Lenorix\BeelSdk\Generated\Normalizer\V1ConfigurationLanguagePutResponse200Normalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1ConfigurationLanguagePutResponse200Data::class => \Lenorix\BeelSdk\Generated\Normalizer\V1ConfigurationLanguagePutResponse200DataNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1InvoiceCustomizationOptionsGetResponse200::class => \Lenorix\BeelSdk\Generated\Normalizer\V1InvoiceCustomizationOptionsGetResponse200Normalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1NifValidatePostResponse200::class => \Lenorix\BeelSdk\Generated\Normalizer\V1NifValidatePostResponse200Normalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1AccountsAccountIdCompaniesCompanyIdRepresentationSubmitPostBody::class => \Lenorix\BeelSdk\Generated\Normalizer\V1AccountsAccountIdCompaniesCompanyIdRepresentationSubmitPostBodyNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdRepresentationSubmitPostBody::class => \Lenorix\BeelSdk\Generated\Normalizer\V1CompaniesCompanyIdRepresentationSubmitPostBodyNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdLogoPutBody::class => \Lenorix\BeelSdk\Generated\Normalizer\V1CompaniesCompanyIdLogoPutBodyNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdLogoPutResponse200::class => \Lenorix\BeelSdk\Generated\Normalizer\V1CompaniesCompanyIdLogoPutResponse200Normalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdInvoiceCustomizationGetResponse200::class => \Lenorix\BeelSdk\Generated\Normalizer\V1CompaniesCompanyIdInvoiceCustomizationGetResponse200Normalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdInvoiceCustomizationPutResponse200::class => \Lenorix\BeelSdk\Generated\Normalizer\V1CompaniesCompanyIdInvoiceCustomizationPutResponse200Normalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdVerifactuConfigurationGetResponse200::class => \Lenorix\BeelSdk\Generated\Normalizer\V1CompaniesCompanyIdVerifactuConfigurationGetResponse200Normalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdVerifactuConfigurationPutResponse200::class => \Lenorix\BeelSdk\Generated\Normalizer\V1CompaniesCompanyIdVerifactuConfigurationPutResponse200Normalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdTaxConfigurationGetResponse200::class => \Lenorix\BeelSdk\Generated\Normalizer\V1CompaniesCompanyIdTaxConfigurationGetResponse200Normalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdTaxConfigurationPutResponse200::class => \Lenorix\BeelSdk\Generated\Normalizer\V1CompaniesCompanyIdTaxConfigurationPutResponse200Normalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdSeriesGetResponse200::class => \Lenorix\BeelSdk\Generated\Normalizer\V1CompaniesCompanyIdSeriesGetResponse200Normalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdSeriesGetResponse200Data::class => \Lenorix\BeelSdk\Generated\Normalizer\V1CompaniesCompanyIdSeriesGetResponse200DataNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdSeriesGetResponse200DataPagination::class => \Lenorix\BeelSdk\Generated\Normalizer\V1CompaniesCompanyIdSeriesGetResponse200DataPaginationNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdSeriesPostResponse201::class => \Lenorix\BeelSdk\Generated\Normalizer\V1CompaniesCompanyIdSeriesPostResponse201Normalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdSeriesDefaultsGetResponse200::class => \Lenorix\BeelSdk\Generated\Normalizer\V1CompaniesCompanyIdSeriesDefaultsGetResponse200Normalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdSeriesDefaultsGetResponse200Data::class => \Lenorix\BeelSdk\Generated\Normalizer\V1CompaniesCompanyIdSeriesDefaultsGetResponse200DataNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdSeriesDefaultsPutResponse200::class => \Lenorix\BeelSdk\Generated\Normalizer\V1CompaniesCompanyIdSeriesDefaultsPutResponse200Normalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdSeriesDefaultsPutResponse200Data::class => \Lenorix\BeelSdk\Generated\Normalizer\V1CompaniesCompanyIdSeriesDefaultsPutResponse200DataNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdSeriesSeriesIdGetResponse200::class => \Lenorix\BeelSdk\Generated\Normalizer\V1CompaniesCompanyIdSeriesSeriesIdGetResponse200Normalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdSeriesSeriesIdPatchResponse200::class => \Lenorix\BeelSdk\Generated\Normalizer\V1CompaniesCompanyIdSeriesSeriesIdPatchResponse200Normalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdSeriesSeriesIdDefaultPutResponse200::class => \Lenorix\BeelSdk\Generated\Normalizer\V1CompaniesCompanyIdSeriesSeriesIdDefaultPutResponse200Normalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdActivationsDeleteResponse200::class => \Lenorix\BeelSdk\Generated\Normalizer\V1CompaniesCompanyIdActivationsDeleteResponse200Normalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1WebhooksGetResponse200::class => \Lenorix\BeelSdk\Generated\Normalizer\V1WebhooksGetResponse200Normalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1WebhooksGetResponse200Data::class => \Lenorix\BeelSdk\Generated\Normalizer\V1WebhooksGetResponse200DataNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1WebhooksPostResponse201::class => \Lenorix\BeelSdk\Generated\Normalizer\V1WebhooksPostResponse201Normalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1WebhooksWebhookIdGetResponse200::class => \Lenorix\BeelSdk\Generated\Normalizer\V1WebhooksWebhookIdGetResponse200Normalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1WebhooksWebhookIdPatchResponse200::class => \Lenorix\BeelSdk\Generated\Normalizer\V1WebhooksWebhookIdPatchResponse200Normalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1WebhooksWebhookIdDeliveriesGetResponse200::class => \Lenorix\BeelSdk\Generated\Normalizer\V1WebhooksWebhookIdDeliveriesGetResponse200Normalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1WebhooksWebhookIdDeliveriesGetResponse200Data::class => \Lenorix\BeelSdk\Generated\Normalizer\V1WebhooksWebhookIdDeliveriesGetResponse200DataNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1WebhooksWebhookIdDeliveriesDeliveryIdRetryPostResponse200::class => \Lenorix\BeelSdk\Generated\Normalizer\V1WebhooksWebhookIdDeliveriesDeliveryIdRetryPostResponse200Normalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1WebhooksWebhookIdTestPostResponse200::class => \Lenorix\BeelSdk\Generated\Normalizer\V1WebhooksWebhookIdTestPostResponse200Normalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1WebhooksWebhookIdSecretPostResponse200::class => \Lenorix\BeelSdk\Generated\Normalizer\V1WebhooksWebhookIdSecretPostResponse200Normalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1AccountsAccountIdWebhooksGetResponse200::class => \Lenorix\BeelSdk\Generated\Normalizer\V1AccountsAccountIdWebhooksGetResponse200Normalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1AccountsAccountIdWebhooksGetResponse200Data::class => \Lenorix\BeelSdk\Generated\Normalizer\V1AccountsAccountIdWebhooksGetResponse200DataNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1AccountsAccountIdWebhooksPostResponse201::class => \Lenorix\BeelSdk\Generated\Normalizer\V1AccountsAccountIdWebhooksPostResponse201Normalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1AccountsAccountIdWebhooksWebhookIdGetResponse200::class => \Lenorix\BeelSdk\Generated\Normalizer\V1AccountsAccountIdWebhooksWebhookIdGetResponse200Normalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1AccountsAccountIdWebhooksWebhookIdPatchResponse200::class => \Lenorix\BeelSdk\Generated\Normalizer\V1AccountsAccountIdWebhooksWebhookIdPatchResponse200Normalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1AccountsAccountIdWebhooksWebhookIdDeliveriesGetResponse200::class => \Lenorix\BeelSdk\Generated\Normalizer\V1AccountsAccountIdWebhooksWebhookIdDeliveriesGetResponse200Normalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1AccountsAccountIdWebhooksWebhookIdDeliveriesGetResponse200Data::class => \Lenorix\BeelSdk\Generated\Normalizer\V1AccountsAccountIdWebhooksWebhookIdDeliveriesGetResponse200DataNormalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1AccountsAccountIdWebhooksWebhookIdDeliveriesDeliveryIdRetryPostResponse200::class => \Lenorix\BeelSdk\Generated\Normalizer\V1AccountsAccountIdWebhooksWebhookIdDeliveriesDeliveryIdRetryPostResponse200Normalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1AccountsAccountIdWebhooksWebhookIdTestPostResponse200::class => \Lenorix\BeelSdk\Generated\Normalizer\V1AccountsAccountIdWebhooksWebhookIdTestPostResponse200Normalizer::class,
        
        \Lenorix\BeelSdk\Generated\Model\V1AccountsAccountIdWebhooksWebhookIdSecretPostResponse200::class => \Lenorix\BeelSdk\Generated\Normalizer\V1AccountsAccountIdWebhooksWebhookIdSecretPostResponse200Normalizer::class,
        
        \Jane\Component\JsonSchemaRuntime\Reference::class => \Lenorix\BeelSdk\Generated\Runtime\Normalizer\ReferenceNormalizer::class,
    ], $normalizersCache = [];
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
        $normalizer = new $normalizerClass();
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