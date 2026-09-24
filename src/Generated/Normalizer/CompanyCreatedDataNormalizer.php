<?php

namespace Lenorix\BeelSdk\Generated\Normalizer;

use Jane\Component\JsonSchemaRuntime\Reference;
use Lenorix\BeelSdk\Generated\Model\CompanyCreatedData;
use Lenorix\BeelSdk\Generated\Model\CompanyDataAddress;
use Lenorix\BeelSdk\Generated\Model\CompanyDataLegalRepresentative;
use Lenorix\BeelSdk\Generated\Model\CompanyDataReadiness;
use Lenorix\BeelSdk\Generated\Model\InvoiceSeries;
use Lenorix\BeelSdk\Generated\Runtime\JsonObject;
use Lenorix\BeelSdk\Generated\Runtime\Normalizer\CheckArray;
use Lenorix\BeelSdk\Generated\Runtime\Normalizer\InvalidDateException;
use Lenorix\BeelSdk\Generated\Runtime\Normalizer\ValidatorTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class CompanyCreatedDataNormalizer implements DenormalizerAwareInterface, DenormalizerInterface, NormalizerAwareInterface, NormalizerInterface
{
    use CheckArray;
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use ValidatorTrait;

    public function supportsDenormalization(mixed $data, string $type, ?string $format = null, array $context = []): bool
    {
        return $type === CompanyCreatedData::class;
    }

    public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
    {
        return is_object($data) && get_class($data) === CompanyCreatedData::class;
    }

    public function denormalize(mixed $data, string $type, ?string $format = null, array $context = []): mixed
    {
        $object = new CompanyCreatedData;
        if ($data === null || \is_array($data) === false) {
            return $object;
        }
        if (isset($data['$ref']) && ! isset($data['type']) && ! isset($data['properties']) && ! isset($data['allOf'])) {
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
        } elseif (\array_key_exists('aeat_environment', $data) && $data['aeat_environment'] === null) {
            $object->setAeatEnvironment(null);
            unset($data['aeat_environment']);
        }
        if (\array_key_exists('account_state', $data)) {
            $object->setAccountState($data['account_state']);
            unset($data['account_state']);
        }
        if (\array_key_exists('address', $data) && $data['address'] !== null) {
            $object->setAddress($this->denormalizer->denormalize($data['address'], CompanyDataAddress::class, 'json', $context));
            unset($data['address']);
        } elseif (\array_key_exists('address', $data) && $data['address'] === null) {
            $object->setAddress(null);
            unset($data['address']);
        }
        if (\array_key_exists('legal_form', $data) && $data['legal_form'] !== null) {
            $object->setLegalForm($data['legal_form']);
            unset($data['legal_form']);
        } elseif (\array_key_exists('legal_form', $data) && $data['legal_form'] === null) {
            $object->setLegalForm(null);
            unset($data['legal_form']);
        }
        if (\array_key_exists('legal_representative', $data) && $data['legal_representative'] !== null) {
            $object->setLegalRepresentative($this->denormalizer->denormalize($data['legal_representative'], CompanyDataLegalRepresentative::class, 'json', $context));
            unset($data['legal_representative']);
        } elseif (\array_key_exists('legal_representative', $data) && $data['legal_representative'] === null) {
            $object->setLegalRepresentative(null);
            unset($data['legal_representative']);
        }
        if (\array_key_exists('phone', $data) && $data['phone'] !== null) {
            $object->setPhone($data['phone']);
            unset($data['phone']);
        } elseif (\array_key_exists('phone', $data) && $data['phone'] === null) {
            $object->setPhone(null);
            unset($data['phone']);
        }
        if (\array_key_exists('email', $data) && $data['email'] !== null) {
            $object->setEmail($data['email']);
            unset($data['email']);
        } elseif (\array_key_exists('email', $data) && $data['email'] === null) {
            $object->setEmail(null);
            unset($data['email']);
        }
        if (\array_key_exists('website', $data) && $data['website'] !== null) {
            $object->setWebsite($data['website']);
            unset($data['website']);
        } elseif (\array_key_exists('website', $data) && $data['website'] === null) {
            $object->setWebsite(null);
            unset($data['website']);
        }
        if (\array_key_exists('logo_url', $data) && $data['logo_url'] !== null) {
            $object->setLogoUrl($data['logo_url']);
            unset($data['logo_url']);
        } elseif (\array_key_exists('logo_url', $data) && $data['logo_url'] === null) {
            $object->setLogoUrl(null);
            unset($data['logo_url']);
        }
        if (\array_key_exists('additional_info', $data) && $data['additional_info'] !== null) {
            $object->setAdditionalInfo($data['additional_info']);
            unset($data['additional_info']);
        } elseif (\array_key_exists('additional_info', $data) && $data['additional_info'] === null) {
            $object->setAdditionalInfo(null);
            unset($data['additional_info']);
        }
        if (\array_key_exists('default_iban', $data) && $data['default_iban'] !== null) {
            $object->setDefaultIban($data['default_iban']);
            unset($data['default_iban']);
        } elseif (\array_key_exists('default_iban', $data) && $data['default_iban'] === null) {
            $object->setDefaultIban(null);
            unset($data['default_iban']);
        }
        if (\array_key_exists('default_swift', $data) && $data['default_swift'] !== null) {
            $object->setDefaultSwift($data['default_swift']);
            unset($data['default_swift']);
        } elseif (\array_key_exists('default_swift', $data) && $data['default_swift'] === null) {
            $object->setDefaultSwift(null);
            unset($data['default_swift']);
        }
        if (\array_key_exists('account_holder', $data) && $data['account_holder'] !== null) {
            $object->setAccountHolder($data['account_holder']);
            unset($data['account_holder']);
        } elseif (\array_key_exists('account_holder', $data) && $data['account_holder'] === null) {
            $object->setAccountHolder(null);
            unset($data['account_holder']);
        }
        if (\array_key_exists('iae', $data) && $data['iae'] !== null) {
            $object->setIae($data['iae']);
            unset($data['iae']);
        } elseif (\array_key_exists('iae', $data) && $data['iae'] === null) {
            $object->setIae(null);
            unset($data['iae']);
        }
        if (\array_key_exists('activity_start_date', $data) && $data['activity_start_date'] !== null) {
            $date = \DateTime::createFromFormat('Y-m-d', $data['activity_start_date']);
            if ($date === false) {
                throw new InvalidDateException($data['activity_start_date'], 'Y-m-d');
            }
            $object->setActivityStartDate($date->setTime(0, 0, 0));
            unset($data['activity_start_date']);
        } elseif (\array_key_exists('activity_start_date', $data) && $data['activity_start_date'] === null) {
            $object->setActivityStartDate(null);
            unset($data['activity_start_date']);
        }
        if (\array_key_exists('default_payment_term', $data) && $data['default_payment_term'] !== null) {
            $object->setDefaultPaymentTerm($data['default_payment_term']);
            unset($data['default_payment_term']);
        } elseif (\array_key_exists('default_payment_term', $data) && $data['default_payment_term'] === null) {
            $object->setDefaultPaymentTerm(null);
            unset($data['default_payment_term']);
        }
        if (\array_key_exists('invoice_template_type', $data) && $data['invoice_template_type'] !== null) {
            $object->setInvoiceTemplateType($data['invoice_template_type']);
            unset($data['invoice_template_type']);
        } elseif (\array_key_exists('invoice_template_type', $data) && $data['invoice_template_type'] === null) {
            $object->setInvoiceTemplateType(null);
            unset($data['invoice_template_type']);
        }
        if (\array_key_exists('invoice_accent_color', $data) && $data['invoice_accent_color'] !== null) {
            $object->setInvoiceAccentColor($data['invoice_accent_color']);
            unset($data['invoice_accent_color']);
        } elseif (\array_key_exists('invoice_accent_color', $data) && $data['invoice_accent_color'] === null) {
            $object->setInvoiceAccentColor(null);
            unset($data['invoice_accent_color']);
        }
        if (\array_key_exists('invoice_language', $data) && $data['invoice_language'] !== null) {
            $object->setInvoiceLanguage($data['invoice_language']);
            unset($data['invoice_language']);
        } elseif (\array_key_exists('invoice_language', $data) && $data['invoice_language'] === null) {
            $object->setInvoiceLanguage(null);
            unset($data['invoice_language']);
        }
        if (\array_key_exists('email_language', $data) && $data['email_language'] !== null) {
            $object->setEmailLanguage($data['email_language']);
            unset($data['email_language']);
        } elseif (\array_key_exists('email_language', $data) && $data['email_language'] === null) {
            $object->setEmailLanguage(null);
            unset($data['email_language']);
        }
        if (\array_key_exists('default_irpf_rate', $data) && $data['default_irpf_rate'] !== null) {
            $object->setDefaultIrpfRate($data['default_irpf_rate']);
            unset($data['default_irpf_rate']);
        } elseif (\array_key_exists('default_irpf_rate', $data) && $data['default_irpf_rate'] === null) {
            $object->setDefaultIrpfRate(null);
            unset($data['default_irpf_rate']);
        }
        if (\array_key_exists('created_at', $data)) {
            $date_1 = \DateTime::createFromFormat('Y-m-d\TH:i:sP', $data['created_at']);
            if ($date_1 === false) {
                throw new InvalidDateException($data['created_at'], 'Y-m-d\TH:i:sP');
            }
            $object->setCreatedAt($date_1);
            unset($data['created_at']);
        }
        if (\array_key_exists('readiness', $data) && $data['readiness'] !== null) {
            $object->setReadiness($this->denormalizer->denormalize($data['readiness'], CompanyDataReadiness::class, 'json', $context));
            unset($data['readiness']);
        } elseif (\array_key_exists('readiness', $data) && $data['readiness'] === null) {
            $object->setReadiness(null);
            unset($data['readiness']);
        }
        if (\array_key_exists('series', $data)) {
            $values = [];
            foreach ($data['series'] as $value) {
                $values[] = $this->denormalizer->denormalize($value, InvoiceSeries::class, 'json', $context);
            }
            $object->setSeries($values);
            unset($data['series']);
        }
        foreach ($data as $key => $value_1) {
            if (preg_match('/.*/', (string) $key)) {
                $object[$key] = $value_1;
            }
        }

        return $object;
    }

    public function normalize(mixed $data, ?string $format = null, array $context = []): array|string|int|float|bool|\ArrayObject|null
    {
        $dataArray = [];
        if ($data->isInitialized('id') && $data->getId() !== null) {
            $dataArray['id'] = $data->getId();
        }
        if ($data->isInitialized('accessLevel') && $data->getAccessLevel() !== null) {
            $dataArray['access_level'] = $data->getAccessLevel();
        }
        if ($data->isInitialized('nif') && $data->getNif() !== null) {
            $dataArray['nif'] = $data->getNif();
        }
        if ($data->isInitialized('legalName') && $data->getLegalName() !== null) {
            $dataArray['legal_name'] = $data->getLegalName();
        }
        if ($data->isInitialized('tradeName') && $data->getTradeName() !== null) {
            $dataArray['trade_name'] = $data->getTradeName();
        }
        if ($data->isInitialized('entityType') && $data->getEntityType() !== null) {
            $dataArray['entity_type'] = $data->getEntityType();
        }
        if ($data->isInitialized('isPrimary') && $data->getIsPrimary() !== null) {
            $dataArray['is_primary'] = $data->getIsPrimary();
        }
        if ($data->isInitialized('verifactuStatus') && $data->getVerifactuStatus() !== null) {
            $dataArray['verifactu_status'] = $data->getVerifactuStatus();
        }
        if ($data->isInitialized('environment') && $data->getEnvironment() !== null) {
            $dataArray['environment'] = $data->getEnvironment();
        }
        if ($data->isInitialized('inProd') && $data->getInProd() !== null) {
            $dataArray['in_prod'] = $data->getInProd();
        }
        if ($data->isInitialized('inTest') && $data->getInTest() !== null) {
            $dataArray['in_test'] = $data->getInTest();
        }
        if ($data->isInitialized('aeatEnvironment') && $data->getAeatEnvironment() !== null) {
            $dataArray['aeat_environment'] = $data->getAeatEnvironment();
        }
        if ($data->isInitialized('accountState') && $data->getAccountState() !== null) {
            $dataArray['account_state'] = $data->getAccountState();
        }
        if ($data->isInitialized('address') && $data->getAddress() !== null) {
            $dataArray['address'] = $data->getAddress() === null ? null : new JsonObject($this->normalizer->normalize($data->getAddress(), 'json', $context));
        }
        if ($data->isInitialized('legalForm') && $data->getLegalForm() !== null) {
            $dataArray['legal_form'] = $data->getLegalForm();
        }
        if ($data->isInitialized('legalRepresentative') && $data->getLegalRepresentative() !== null) {
            $dataArray['legal_representative'] = $data->getLegalRepresentative() === null ? null : new JsonObject($this->normalizer->normalize($data->getLegalRepresentative(), 'json', $context));
        }
        if ($data->isInitialized('phone') && $data->getPhone() !== null) {
            $dataArray['phone'] = $data->getPhone();
        }
        if ($data->isInitialized('email') && $data->getEmail() !== null) {
            $dataArray['email'] = $data->getEmail();
        }
        if ($data->isInitialized('website') && $data->getWebsite() !== null) {
            $dataArray['website'] = $data->getWebsite();
        }
        if ($data->isInitialized('logoUrl') && $data->getLogoUrl() !== null) {
            $dataArray['logo_url'] = $data->getLogoUrl();
        }
        if ($data->isInitialized('additionalInfo') && $data->getAdditionalInfo() !== null) {
            $dataArray['additional_info'] = $data->getAdditionalInfo();
        }
        if ($data->isInitialized('defaultIban') && $data->getDefaultIban() !== null) {
            $dataArray['default_iban'] = $data->getDefaultIban();
        }
        if ($data->isInitialized('defaultSwift') && $data->getDefaultSwift() !== null) {
            $dataArray['default_swift'] = $data->getDefaultSwift();
        }
        if ($data->isInitialized('accountHolder') && $data->getAccountHolder() !== null) {
            $dataArray['account_holder'] = $data->getAccountHolder();
        }
        if ($data->isInitialized('iae') && $data->getIae() !== null) {
            $dataArray['iae'] = $data->getIae();
        }
        if ($data->isInitialized('activityStartDate') && $data->getActivityStartDate() !== null) {
            $dataArray['activity_start_date'] = $data->getActivityStartDate()?->format('Y-m-d');
        }
        if ($data->isInitialized('defaultPaymentTerm') && $data->getDefaultPaymentTerm() !== null) {
            $dataArray['default_payment_term'] = $data->getDefaultPaymentTerm();
        }
        if ($data->isInitialized('invoiceTemplateType') && $data->getInvoiceTemplateType() !== null) {
            $dataArray['invoice_template_type'] = $data->getInvoiceTemplateType();
        }
        if ($data->isInitialized('invoiceAccentColor') && $data->getInvoiceAccentColor() !== null) {
            $dataArray['invoice_accent_color'] = $data->getInvoiceAccentColor();
        }
        if ($data->isInitialized('invoiceLanguage') && $data->getInvoiceLanguage() !== null) {
            $dataArray['invoice_language'] = $data->getInvoiceLanguage();
        }
        if ($data->isInitialized('emailLanguage') && $data->getEmailLanguage() !== null) {
            $dataArray['email_language'] = $data->getEmailLanguage();
        }
        if ($data->isInitialized('defaultIrpfRate') && $data->getDefaultIrpfRate() !== null) {
            $dataArray['default_irpf_rate'] = $data->getDefaultIrpfRate();
        }
        if ($data->isInitialized('createdAt') && $data->getCreatedAt() !== null) {
            $dataArray['created_at'] = $data->getCreatedAt()->format('Y-m-d\TH:i:sP');
        }
        if ($data->isInitialized('readiness') && $data->getReadiness() !== null) {
            $dataArray['readiness'] = $data->getReadiness() === null ? null : new JsonObject($this->normalizer->normalize($data->getReadiness(), 'json', $context));
        }
        if ($data->isInitialized('series') && $data->getSeries() !== null) {
            $values = [];
            foreach ($data->getSeries() as $value) {
                $values[] = $value === null ? null : new JsonObject($this->normalizer->normalize($value, 'json', $context));
            }
            $dataArray['series'] = $values;
        }
        foreach ($data->additionalPropertyEntries() as $key => $value_1) {
            if (preg_match('/.*/', (string) $key)) {
                $dataArray[$key] = $value_1;
            }
        }

        return $dataArray;
    }

    public function getSupportedTypes(?string $format = null): array
    {
        return [CompanyCreatedData::class => false];
    }
}
