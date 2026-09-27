<?php

namespace Lenorix\BeelSdk\Generated\Normalizer;

use Jane\Component\JsonSchemaRuntime\Reference;
use Lenorix\BeelSdk\Generated\Model\UpdateCompanyPaymentConnectionRequest;
use Lenorix\BeelSdk\Generated\Model\UpdateCompanyPaymentConnectionRequestFilterConfig;
use Lenorix\BeelSdk\Generated\Model\UpdateCompanyPaymentConnectionRequestTaxInclusiveTax;
use Lenorix\BeelSdk\Generated\Model\UpdateCompanyPaymentConnectionSeries;
use Lenorix\BeelSdk\Generated\Runtime\JsonObject;
use Lenorix\BeelSdk\Generated\Runtime\Normalizer\CheckArray;
use Lenorix\BeelSdk\Generated\Runtime\Normalizer\ValidatorTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class UpdateCompanyPaymentConnectionRequestNormalizer implements DenormalizerAwareInterface, DenormalizerInterface, NormalizerAwareInterface, NormalizerInterface
{
    use CheckArray;
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use ValidatorTrait;

    public function supportsDenormalization(mixed $data, string $type, ?string $format = null, array $context = []): bool
    {
        return $type === UpdateCompanyPaymentConnectionRequest::class;
    }

    public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
    {
        return is_object($data) && get_class($data) === UpdateCompanyPaymentConnectionRequest::class;
    }

    public function denormalize(mixed $data, string $type, ?string $format = null, array $context = []): mixed
    {
        $object = new UpdateCompanyPaymentConnectionRequest;
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
            $object->setTaxInclusiveTax($this->denormalizer->denormalize($data['tax_inclusive_tax'], UpdateCompanyPaymentConnectionRequestTaxInclusiveTax::class, 'json', $context));
            unset($data['tax_inclusive_tax']);
        } elseif (\array_key_exists('tax_inclusive_tax', $data) && $data['tax_inclusive_tax'] === null) {
            $object->setTaxInclusiveTax(null);
            unset($data['tax_inclusive_tax']);
        }
        if (\array_key_exists('series', $data)) {
            $object->setSeries($this->denormalizer->denormalize($data['series'], UpdateCompanyPaymentConnectionSeries::class, 'json', $context));
            unset($data['series']);
        }
        if (\array_key_exists('simplificada_threshold', $data)) {
            $object->setSimplificadaThreshold($data['simplificada_threshold']);
            unset($data['simplificada_threshold']);
        }
        if (\array_key_exists('filter_config', $data)) {
            $object->setFilterConfig($this->denormalizer->denormalize($data['filter_config'], UpdateCompanyPaymentConnectionRequestFilterConfig::class, 'json', $context));
            unset($data['filter_config']);
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
        if ($data->isInitialized('autoInvoiceEnabled') && $data->getAutoInvoiceEnabled() !== null) {
            $dataArray['auto_invoice_enabled'] = $data->getAutoInvoiceEnabled();
        }
        if ($data->isInitialized('eventSource') && $data->getEventSource() !== null) {
            $dataArray['event_source'] = $data->getEventSource();
        }
        if ($data->isInitialized('autoCreateCustomer') && $data->getAutoCreateCustomer() !== null) {
            $dataArray['auto_create_customer'] = $data->getAutoCreateCustomer();
        }
        if ($data->isInitialized('sendInvoiceByEmail') && $data->getSendInvoiceByEmail() !== null) {
            $dataArray['send_invoice_by_email'] = $data->getSendInvoiceByEmail();
        }
        if ($data->isInitialized('pricesIncludeTax') && $data->getPricesIncludeTax() !== null) {
            $dataArray['prices_include_tax'] = $data->getPricesIncludeTax();
        }
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
        foreach ($data->additionalPropertyEntries() as $key => $value) {
            if (preg_match('/.*/', (string) $key)) {
                $dataArray[$key] = $value;
            }
        }

        return $dataArray;
    }

    public function getSupportedTypes(?string $format = null): array
    {
        return [UpdateCompanyPaymentConnectionRequest::class => false];
    }
}
