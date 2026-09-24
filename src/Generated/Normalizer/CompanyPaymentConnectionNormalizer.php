<?php

namespace Lenorix\BeelSdk\Generated\Normalizer;

use Jane\Component\JsonSchemaRuntime\Reference;
use Lenorix\BeelSdk\Generated\Model\CompanyPaymentConnection;
use Lenorix\BeelSdk\Generated\Model\CompanyPaymentConnectionFilters;
use Lenorix\BeelSdk\Generated\Model\CompanyPaymentConnectionSeries;
use Lenorix\BeelSdk\Generated\Model\CompanyPaymentConnectionTaxInclusiveTax;
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

class CompanyPaymentConnectionNormalizer implements DenormalizerAwareInterface, DenormalizerInterface, NormalizerAwareInterface, NormalizerInterface
{
    use CheckArray;
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use ValidatorTrait;

    public function supportsDenormalization(mixed $data, string $type, ?string $format = null, array $context = []): bool
    {
        return $type === CompanyPaymentConnection::class;
    }

    public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
    {
        return is_object($data) && get_class($data) === CompanyPaymentConnection::class;
    }

    public function denormalize(mixed $data, string $type, ?string $format = null, array $context = []): mixed
    {
        $object = new CompanyPaymentConnection;
        if ($data === null || \is_array($data) === false) {
            return $object;
        }
        if (isset($data['$ref']) && ! isset($data['type']) && ! isset($data['properties']) && ! isset($data['allOf'])) {
            return new Reference($data['$ref'], $context['document-origin']);
        }
        if (isset($data['$recursiveRef'])) {
            return new Reference($data['$recursiveRef'], $context['document-origin']);
        }
        if (\array_key_exists('simplificada_threshold', $data) && \is_int($data['simplificada_threshold'])) {
            $data['simplificada_threshold'] = (float) $data['simplificada_threshold'];
        }
        if (\array_key_exists('auto_invoice_enabled', $data) && \is_int($data['auto_invoice_enabled'])) {
            $data['auto_invoice_enabled'] = (bool) $data['auto_invoice_enabled'];
        }
        if (\array_key_exists('auto_create_customer', $data) && \is_int($data['auto_create_customer'])) {
            $data['auto_create_customer'] = (bool) $data['auto_create_customer'];
        }
        if (\array_key_exists('send_invoice_by_email', $data) && \is_int($data['send_invoice_by_email'])) {
            $data['send_invoice_by_email'] = (bool) $data['send_invoice_by_email'];
        }
        if (\array_key_exists('prices_include_tax', $data) && \is_int($data['prices_include_tax'])) {
            $data['prices_include_tax'] = (bool) $data['prices_include_tax'];
        }
        if (\array_key_exists('id', $data)) {
            $object->setId($data['id']);
            unset($data['id']);
        }
        if (\array_key_exists('provider', $data)) {
            $object->setProvider($data['provider']);
            unset($data['provider']);
        }
        if (\array_key_exists('external_account_id', $data)) {
            $object->setExternalAccountId($data['external_account_id']);
            unset($data['external_account_id']);
        }
        if (\array_key_exists('external_account_name', $data) && $data['external_account_name'] !== null) {
            $object->setExternalAccountName($data['external_account_name']);
            unset($data['external_account_name']);
        } elseif (\array_key_exists('external_account_name', $data) && $data['external_account_name'] === null) {
            $object->setExternalAccountName(null);
            unset($data['external_account_name']);
        }
        if (\array_key_exists('environment', $data)) {
            $object->setEnvironment($data['environment']);
            unset($data['environment']);
        }
        if (\array_key_exists('status', $data)) {
            $object->setStatus($data['status']);
            unset($data['status']);
        }
        if (\array_key_exists('connected_at', $data) && $data['connected_at'] !== null) {
            $date = \DateTime::createFromFormat('Y-m-d\TH:i:sP', $data['connected_at']);
            if ($date === false) {
                throw new InvalidDateException($data['connected_at'], 'Y-m-d\TH:i:sP');
            }
            $object->setConnectedAt($date);
            unset($data['connected_at']);
        } elseif (\array_key_exists('connected_at', $data) && $data['connected_at'] === null) {
            $object->setConnectedAt(null);
            unset($data['connected_at']);
        }
        if (\array_key_exists('last_event_at', $data) && $data['last_event_at'] !== null) {
            $date_1 = \DateTime::createFromFormat('Y-m-d\TH:i:sP', $data['last_event_at']);
            if ($date_1 === false) {
                throw new InvalidDateException($data['last_event_at'], 'Y-m-d\TH:i:sP');
            }
            $object->setLastEventAt($date_1);
            unset($data['last_event_at']);
        } elseif (\array_key_exists('last_event_at', $data) && $data['last_event_at'] === null) {
            $object->setLastEventAt(null);
            unset($data['last_event_at']);
        }
        if (\array_key_exists('auto_invoice_enabled', $data)) {
            $object->setAutoInvoiceEnabled($data['auto_invoice_enabled']);
            unset($data['auto_invoice_enabled']);
        }
        if (\array_key_exists('event_source', $data)) {
            $object->setEventSource($data['event_source']);
            unset($data['event_source']);
        }
        if (\array_key_exists('auto_create_customer', $data)) {
            $object->setAutoCreateCustomer($data['auto_create_customer']);
            unset($data['auto_create_customer']);
        }
        if (\array_key_exists('send_invoice_by_email', $data)) {
            $object->setSendInvoiceByEmail($data['send_invoice_by_email']);
            unset($data['send_invoice_by_email']);
        }
        if (\array_key_exists('prices_include_tax', $data)) {
            $object->setPricesIncludeTax($data['prices_include_tax']);
            unset($data['prices_include_tax']);
        }
        if (\array_key_exists('tax_inclusive_tax', $data) && $data['tax_inclusive_tax'] !== null) {
            $object->setTaxInclusiveTax($this->denormalizer->denormalize($data['tax_inclusive_tax'], CompanyPaymentConnectionTaxInclusiveTax::class, 'json', $context));
            unset($data['tax_inclusive_tax']);
        } elseif (\array_key_exists('tax_inclusive_tax', $data) && $data['tax_inclusive_tax'] === null) {
            $object->setTaxInclusiveTax(null);
            unset($data['tax_inclusive_tax']);
        }
        if (\array_key_exists('series', $data)) {
            $object->setSeries($this->denormalizer->denormalize($data['series'], CompanyPaymentConnectionSeries::class, 'json', $context));
            unset($data['series']);
        }
        if (\array_key_exists('simplificada_threshold', $data)) {
            $object->setSimplificadaThreshold($data['simplificada_threshold']);
            unset($data['simplificada_threshold']);
        }
        if (\array_key_exists('filter_config', $data)) {
            $object->setFilterConfig($this->denormalizer->denormalize($data['filter_config'], CompanyPaymentConnectionFilters::class, 'json', $context));
            unset($data['filter_config']);
        }
        if (\array_key_exists('active_filters', $data)) {
            $values = [];
            foreach ($data['active_filters'] as $value) {
                $values[] = $value;
            }
            $object->setActiveFilters($values);
            unset($data['active_filters']);
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
        $dataArray['id'] = $data->getId();
        $dataArray['provider'] = $data->getProvider();
        $dataArray['external_account_id'] = $data->getExternalAccountId();
        if ($data->isInitialized('externalAccountName') && $data->getExternalAccountName() !== null) {
            $dataArray['external_account_name'] = $data->getExternalAccountName();
        }
        $dataArray['environment'] = $data->getEnvironment();
        $dataArray['status'] = $data->getStatus();
        if ($data->isInitialized('connectedAt') && $data->getConnectedAt() !== null) {
            $dataArray['connected_at'] = $data->getConnectedAt()?->format('Y-m-d\TH:i:sP');
        }
        if ($data->isInitialized('lastEventAt') && $data->getLastEventAt() !== null) {
            $dataArray['last_event_at'] = $data->getLastEventAt()?->format('Y-m-d\TH:i:sP');
        }
        $dataArray['auto_invoice_enabled'] = $data->getAutoInvoiceEnabled();
        $dataArray['event_source'] = $data->getEventSource();
        $dataArray['auto_create_customer'] = $data->getAutoCreateCustomer();
        $dataArray['send_invoice_by_email'] = $data->getSendInvoiceByEmail();
        $dataArray['prices_include_tax'] = $data->getPricesIncludeTax();
        if ($data->isInitialized('taxInclusiveTax') && $data->getTaxInclusiveTax() !== null) {
            $dataArray['tax_inclusive_tax'] = $data->getTaxInclusiveTax() === null ? null : new JsonObject($this->normalizer->normalize($data->getTaxInclusiveTax(), 'json', $context));
        }
        if ($data->isInitialized('series') && $data->getSeries() !== null) {
            $dataArray['series'] = $data->getSeries() === null ? null : new JsonObject($this->normalizer->normalize($data->getSeries(), 'json', $context));
        }
        if ($data->isInitialized('simplificadaThreshold') && $data->getSimplificadaThreshold() !== null) {
            $dataArray['simplificada_threshold'] = $data->getSimplificadaThreshold();
        }
        if ($data->isInitialized('filterConfig') && $data->getFilterConfig() !== null) {
            $dataArray['filter_config'] = $data->getFilterConfig() === null ? null : new JsonObject($this->normalizer->normalize($data->getFilterConfig(), 'json', $context));
        }
        $values = [];
        foreach ($data->getActiveFilters() as $value) {
            $values[] = $value;
        }
        $dataArray['active_filters'] = $values;
        foreach ($data->additionalPropertyEntries() as $key => $value_1) {
            if (preg_match('/.*/', (string) $key)) {
                $dataArray[$key] = $value_1;
            }
        }

        return $dataArray;
    }

    public function getSupportedTypes(?string $format = null): array
    {
        return [CompanyPaymentConnection::class => false];
    }
}
