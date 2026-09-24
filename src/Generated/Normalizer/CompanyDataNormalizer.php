<?php

namespace Lenorix\BeelSdk\Generated\Normalizer;

use Jane\Component\JsonSchemaRuntime\Reference;
use Lenorix\BeelSdk\Generated\Runtime\Normalizer\CheckArray;
use Lenorix\BeelSdk\Generated\Runtime\Normalizer\ValidatorTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
class CompanyDataNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use CheckArray;
    use ValidatorTrait;
    public function supportsDenormalization(mixed $data, string $type, ?string $format = null, array $context = []): bool
    {
        return $type === \Lenorix\BeelSdk\Generated\Model\CompanyData::class;
    }
    public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
    {
        return is_object($data) && get_class($data) === \Lenorix\BeelSdk\Generated\Model\CompanyData::class;
    }
    public function denormalize(mixed $data, string $type, ?string $format = null, array $context = []): mixed
    {
        $object = new \Lenorix\BeelSdk\Generated\Model\CompanyData();
        if (null === $data || false === \is_array($data)) {
            return $object;
        }
        if (isset($data['$ref']) && !isset($data['type']) && !isset($data['properties']) && !isset($data['allOf'])) {
            return new Reference($data['$ref'], $context['document-origin']);
        }
        if (isset($data['$recursiveRef'])) {
            return new Reference($data['$recursiveRef'], $context['document-origin']);
        }
        if (\array_key_exists('default_irpf_rate', $data) && \is_int($data['default_irpf_rate'])) {
            $data['default_irpf_rate'] = (float) $data['default_irpf_rate'];
        }
        if (\array_key_exists('is_primary', $data) && \is_int($data['is_primary'])) {
            $data['is_primary'] = (bool) $data['is_primary'];
        }
        if (\array_key_exists('in_prod', $data) && \is_int($data['in_prod'])) {
            $data['in_prod'] = (bool) $data['in_prod'];
        }
        if (\array_key_exists('in_test', $data) && \is_int($data['in_test'])) {
            $data['in_test'] = (bool) $data['in_test'];
        }
        if (\array_key_exists('id', $data)) {
            $object->setId($data['id']);
            unset($data['id']);
        }
        if (\array_key_exists('access_level', $data)) {
            $object->setAccessLevel($data['access_level']);
            unset($data['access_level']);
        }
        if (\array_key_exists('nif', $data)) {
            $object->setNif($data['nif']);
            unset($data['nif']);
        }
        if (\array_key_exists('legal_name', $data)) {
            $object->setLegalName($data['legal_name']);
            unset($data['legal_name']);
        }
        if (\array_key_exists('trade_name', $data)) {
            $object->setTradeName($data['trade_name']);
            unset($data['trade_name']);
        }
        if (\array_key_exists('entity_type', $data)) {
            $object->setEntityType($data['entity_type']);
            unset($data['entity_type']);
        }
        if (\array_key_exists('is_primary', $data)) {
            $object->setIsPrimary($data['is_primary']);
            unset($data['is_primary']);
        }
        if (\array_key_exists('verifactu_status', $data)) {
            $object->setVerifactuStatus($data['verifactu_status']);
            unset($data['verifactu_status']);
        }
        if (\array_key_exists('environment', $data)) {
            $object->setEnvironment($data['environment']);
            unset($data['environment']);
        }
        if (\array_key_exists('in_prod', $data)) {
            $object->setInProd($data['in_prod']);
            unset($data['in_prod']);
        }
        if (\array_key_exists('in_test', $data)) {
            $object->setInTest($data['in_test']);
            unset($data['in_test']);
        }
        if (\array_key_exists('aeat_environment', $data) && $data['aeat_environment'] !== null) {
            $object->setAeatEnvironment($data['aeat_environment']);
            unset($data['aeat_environment']);
        }
        elseif (\array_key_exists('aeat_environment', $data) && $data['aeat_environment'] === null) {
            $object->setAeatEnvironment(null);
            unset($data['aeat_environment']);
        }
        if (\array_key_exists('account_state', $data)) {
            $object->setAccountState($data['account_state']);
            unset($data['account_state']);
        }
        if (\array_key_exists('address', $data) && $data['address'] !== null) {
            $object->setAddress($this->denormalizer->denormalize($data['address'], \Lenorix\BeelSdk\Generated\Model\CompanyDataAddress::class, 'json', $context));
            unset($data['address']);
        }
        elseif (\array_key_exists('address', $data) && $data['address'] === null) {
            $object->setAddress(null);
            unset($data['address']);
        }
        if (\array_key_exists('legal_form', $data) && $data['legal_form'] !== null) {
            $object->setLegalForm($data['legal_form']);
            unset($data['legal_form']);
        }
        elseif (\array_key_exists('legal_form', $data) && $data['legal_form'] === null) {
            $object->setLegalForm(null);
            unset($data['legal_form']);
        }
        if (\array_key_exists('legal_representative', $data) && $data['legal_representative'] !== null) {
            $object->setLegalRepresentative($this->denormalizer->denormalize($data['legal_representative'], \Lenorix\BeelSdk\Generated\Model\CompanyDataLegalRepresentative::class, 'json', $context));
            unset($data['legal_representative']);
        }
        elseif (\array_key_exists('legal_representative', $data) && $data['legal_representative'] === null) {
            $object->setLegalRepresentative(null);
            unset($data['legal_representative']);
        }
        if (\array_key_exists('phone', $data) && $data['phone'] !== null) {
            $object->setPhone($data['phone']);
            unset($data['phone']);
        }
        elseif (\array_key_exists('phone', $data) && $data['phone'] === null) {
            $object->setPhone(null);
            unset($data['phone']);
        }
        if (\array_key_exists('email', $data) && $data['email'] !== null) {
            $object->setEmail($data['email']);
            unset($data['email']);
        }
        elseif (\array_key_exists('email', $data) && $data['email'] === null) {
            $object->setEmail(null);
            unset($data['email']);
        }
        if (\array_key_exists('website', $data) && $data['website'] !== null) {
            $object->setWebsite($data['website']);
            unset($data['website']);
        }
        elseif (\array_key_exists('website', $data) && $data['website'] === null) {
            $object->setWebsite(null);
            unset($data['website']);
        }
        if (\array_key_exists('logo_url', $data) && $data['logo_url'] !== null) {
            $object->setLogoUrl($data['logo_url']);
            unset($data['logo_url']);
        }
        elseif (\array_key_exists('logo_url', $data) && $data['logo_url'] === null) {
            $object->setLogoUrl(null);
            unset($data['logo_url']);
        }
        if (\array_key_exists('additional_info', $data) && $data['additional_info'] !== null) {
            $object->setAdditionalInfo($data['additional_info']);
            unset($data['additional_info']);
        }
        elseif (\array_key_exists('additional_info', $data) && $data['additional_info'] === null) {
            $object->setAdditionalInfo(null);
            unset($data['additional_info']);
        }
        if (\array_key_exists('default_iban', $data) && $data['default_iban'] !== null) {
            $object->setDefaultIban($data['default_iban']);
            unset($data['default_iban']);
        }
        elseif (\array_key_exists('default_iban', $data) && $data['default_iban'] === null) {
            $object->setDefaultIban(null);
            unset($data['default_iban']);
        }
        if (\array_key_exists('default_swift', $data) && $data['default_swift'] !== null) {
            $object->setDefaultSwift($data['default_swift']);
            unset($data['default_swift']);
        }
        elseif (\array_key_exists('default_swift', $data) && $data['default_swift'] === null) {
            $object->setDefaultSwift(null);
            unset($data['default_swift']);
        }
        if (\array_key_exists('account_holder', $data) && $data['account_holder'] !== null) {
            $object->setAccountHolder($data['account_holder']);
            unset($data['account_holder']);
        }
        elseif (\array_key_exists('account_holder', $data) && $data['account_holder'] === null) {
            $object->setAccountHolder(null);
            unset($data['account_holder']);
        }
        if (\array_key_exists('iae', $data) && $data['iae'] !== null) {
            $object->setIae($data['iae']);
            unset($data['iae']);
        }
        elseif (\array_key_exists('iae', $data) && $data['iae'] === null) {
            $object->setIae(null);
            unset($data['iae']);
        }
        if (\array_key_exists('activity_start_date', $data) && $data['activity_start_date'] !== null) {
            $date = \DateTime::createFromFormat('Y-m-d', $data['activity_start_date']);
            if (false === $date) {
                throw new \Lenorix\BeelSdk\Generated\Runtime\Normalizer\InvalidDateException($data['activity_start_date'], 'Y-m-d');
            }
            $object->setActivityStartDate($date->setTime(0, 0, 0));
            unset($data['activity_start_date']);
        }
        elseif (\array_key_exists('activity_start_date', $data) && $data['activity_start_date'] === null) {
            $object->setActivityStartDate(null);
            unset($data['activity_start_date']);
        }
        if (\array_key_exists('default_payment_term', $data) && $data['default_payment_term'] !== null) {
            $object->setDefaultPaymentTerm($data['default_payment_term']);
            unset($data['default_payment_term']);
        }
        elseif (\array_key_exists('default_payment_term', $data) && $data['default_payment_term'] === null) {
            $object->setDefaultPaymentTerm(null);
            unset($data['default_payment_term']);
        }
        if (\array_key_exists('invoice_template_type', $data) && $data['invoice_template_type'] !== null) {
            $object->setInvoiceTemplateType($data['invoice_template_type']);
            unset($data['invoice_template_type']);
        }
        elseif (\array_key_exists('invoice_template_type', $data) && $data['invoice_template_type'] === null) {
            $object->setInvoiceTemplateType(null);
            unset($data['invoice_template_type']);
        }
        if (\array_key_exists('invoice_accent_color', $data) && $data['invoice_accent_color'] !== null) {
            $object->setInvoiceAccentColor($data['invoice_accent_color']);
            unset($data['invoice_accent_color']);
        }
        elseif (\array_key_exists('invoice_accent_color', $data) && $data['invoice_accent_color'] === null) {
            $object->setInvoiceAccentColor(null);
            unset($data['invoice_accent_color']);
        }
        if (\array_key_exists('invoice_language', $data) && $data['invoice_language'] !== null) {
            $object->setInvoiceLanguage($data['invoice_language']);
            unset($data['invoice_language']);
        }
        elseif (\array_key_exists('invoice_language', $data) && $data['invoice_language'] === null) {
            $object->setInvoiceLanguage(null);
            unset($data['invoice_language']);
        }
        if (\array_key_exists('email_language', $data) && $data['email_language'] !== null) {
            $object->setEmailLanguage($data['email_language']);
            unset($data['email_language']);
        }
        elseif (\array_key_exists('email_language', $data) && $data['email_language'] === null) {
            $object->setEmailLanguage(null);
            unset($data['email_language']);
        }
        if (\array_key_exists('default_irpf_rate', $data) && $data['default_irpf_rate'] !== null) {
            $object->setDefaultIrpfRate($data['default_irpf_rate']);
            unset($data['default_irpf_rate']);
        }
        elseif (\array_key_exists('default_irpf_rate', $data) && $data['default_irpf_rate'] === null) {
            $object->setDefaultIrpfRate(null);
            unset($data['default_irpf_rate']);
        }
        if (\array_key_exists('created_at', $data)) {
            $date_1 = \DateTime::createFromFormat('Y-m-d\TH:i:sP', $data['created_at']);
            if (false === $date_1) {
                throw new \Lenorix\BeelSdk\Generated\Runtime\Normalizer\InvalidDateException($data['created_at'], 'Y-m-d\TH:i:sP');
            }
            $object->setCreatedAt($date_1);
            unset($data['created_at']);
        }
        if (\array_key_exists('readiness', $data) && $data['readiness'] !== null) {
            $object->setReadiness($this->denormalizer->denormalize($data['readiness'], \Lenorix\BeelSdk\Generated\Model\CompanyDataReadiness::class, 'json', $context));
            unset($data['readiness']);
        }
        elseif (\array_key_exists('readiness', $data) && $data['readiness'] === null) {
            $object->setReadiness(null);
            unset($data['readiness']);
        }
        foreach ($data as $key => $value) {
            if (preg_match('/.*/', (string) $key)) {
                $object[$key] = $value;
            }
        }
        return $object;
    }
    public function normalize(mixed $data, ?string $format = null, array $context = []): array|string|int|float|bool|\ArrayObject|null
    {
        $dataArray = [];
        if ($data->isInitialized('id') && null !== $data->getId()) {
            $dataArray['id'] = $data->getId();
        }
        if ($data->isInitialized('accessLevel') && null !== $data->getAccessLevel()) {
            $dataArray['access_level'] = $data->getAccessLevel();
        }
        if ($data->isInitialized('nif') && null !== $data->getNif()) {
            $dataArray['nif'] = $data->getNif();
        }
        if ($data->isInitialized('legalName') && null !== $data->getLegalName()) {
            $dataArray['legal_name'] = $data->getLegalName();
        }
        if ($data->isInitialized('tradeName') && null !== $data->getTradeName()) {
            $dataArray['trade_name'] = $data->getTradeName();
        }
        if ($data->isInitialized('entityType') && null !== $data->getEntityType()) {
            $dataArray['entity_type'] = $data->getEntityType();
        }
        if ($data->isInitialized('isPrimary') && null !== $data->getIsPrimary()) {
            $dataArray['is_primary'] = $data->getIsPrimary();
        }
        if ($data->isInitialized('verifactuStatus') && null !== $data->getVerifactuStatus()) {
            $dataArray['verifactu_status'] = $data->getVerifactuStatus();
        }
        if ($data->isInitialized('environment') && null !== $data->getEnvironment()) {
            $dataArray['environment'] = $data->getEnvironment();
        }
        if ($data->isInitialized('inProd') && null !== $data->getInProd()) {
            $dataArray['in_prod'] = $data->getInProd();
        }
        if ($data->isInitialized('inTest') && null !== $data->getInTest()) {
            $dataArray['in_test'] = $data->getInTest();
        }
        if ($data->isInitialized('aeatEnvironment') && null !== $data->getAeatEnvironment()) {
            $dataArray['aeat_environment'] = $data->getAeatEnvironment();
        }
        if ($data->isInitialized('accountState') && null !== $data->getAccountState()) {
            $dataArray['account_state'] = $data->getAccountState();
        }
        if ($data->isInitialized('address') && null !== $data->getAddress()) {
            $dataArray['address'] = $data->getAddress() === null ? null : new \Lenorix\BeelSdk\Generated\Runtime\JsonObject($this->normalizer->normalize($data->getAddress(), 'json', $context));
        }
        if ($data->isInitialized('legalForm') && null !== $data->getLegalForm()) {
            $dataArray['legal_form'] = $data->getLegalForm();
        }
        if ($data->isInitialized('legalRepresentative') && null !== $data->getLegalRepresentative()) {
            $dataArray['legal_representative'] = $data->getLegalRepresentative() === null ? null : new \Lenorix\BeelSdk\Generated\Runtime\JsonObject($this->normalizer->normalize($data->getLegalRepresentative(), 'json', $context));
        }
        if ($data->isInitialized('phone') && null !== $data->getPhone()) {
            $dataArray['phone'] = $data->getPhone();
        }
        if ($data->isInitialized('email') && null !== $data->getEmail()) {
            $dataArray['email'] = $data->getEmail();
        }
        if ($data->isInitialized('website') && null !== $data->getWebsite()) {
            $dataArray['website'] = $data->getWebsite();
        }
        if ($data->isInitialized('logoUrl') && null !== $data->getLogoUrl()) {
            $dataArray['logo_url'] = $data->getLogoUrl();
        }
        if ($data->isInitialized('additionalInfo') && null !== $data->getAdditionalInfo()) {
            $dataArray['additional_info'] = $data->getAdditionalInfo();
        }
        if ($data->isInitialized('defaultIban') && null !== $data->getDefaultIban()) {
            $dataArray['default_iban'] = $data->getDefaultIban();
        }
        if ($data->isInitialized('defaultSwift') && null !== $data->getDefaultSwift()) {
            $dataArray['default_swift'] = $data->getDefaultSwift();
        }
        if ($data->isInitialized('accountHolder') && null !== $data->getAccountHolder()) {
            $dataArray['account_holder'] = $data->getAccountHolder();
        }
        if ($data->isInitialized('iae') && null !== $data->getIae()) {
            $dataArray['iae'] = $data->getIae();
        }
        if ($data->isInitialized('activityStartDate') && null !== $data->getActivityStartDate()) {
            $dataArray['activity_start_date'] = $data->getActivityStartDate()?->format('Y-m-d');
        }
        if ($data->isInitialized('defaultPaymentTerm') && null !== $data->getDefaultPaymentTerm()) {
            $dataArray['default_payment_term'] = $data->getDefaultPaymentTerm();
        }
        if ($data->isInitialized('invoiceTemplateType') && null !== $data->getInvoiceTemplateType()) {
            $dataArray['invoice_template_type'] = $data->getInvoiceTemplateType();
        }
        if ($data->isInitialized('invoiceAccentColor') && null !== $data->getInvoiceAccentColor()) {
            $dataArray['invoice_accent_color'] = $data->getInvoiceAccentColor();
        }
        if ($data->isInitialized('invoiceLanguage') && null !== $data->getInvoiceLanguage()) {
            $dataArray['invoice_language'] = $data->getInvoiceLanguage();
        }
        if ($data->isInitialized('emailLanguage') && null !== $data->getEmailLanguage()) {
            $dataArray['email_language'] = $data->getEmailLanguage();
        }
        if ($data->isInitialized('defaultIrpfRate') && null !== $data->getDefaultIrpfRate()) {
            $dataArray['default_irpf_rate'] = $data->getDefaultIrpfRate();
        }
        if ($data->isInitialized('createdAt') && null !== $data->getCreatedAt()) {
            $dataArray['created_at'] = $data->getCreatedAt()->format('Y-m-d\TH:i:sP');
        }
        if ($data->isInitialized('readiness') && null !== $data->getReadiness()) {
            $dataArray['readiness'] = $data->getReadiness() === null ? null : new \Lenorix\BeelSdk\Generated\Runtime\JsonObject($this->normalizer->normalize($data->getReadiness(), 'json', $context));
        }
        foreach ($data->additionalPropertyEntries() as $key => $value) {
            if (preg_match('/.*/', (string) $key)) {
                $dataArray[$key] = $value;
            }
        }
        return $dataArray;
    }
    public function getSupportedTypes(?string $format = null): array
    {
        return [\Lenorix\BeelSdk\Generated\Model\CompanyData::class => false];
    }
}