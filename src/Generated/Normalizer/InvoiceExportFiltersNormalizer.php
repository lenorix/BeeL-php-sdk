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
class InvoiceExportFiltersNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use CheckArray;
    use ValidatorTrait;
    public function supportsDenormalization(mixed $data, string $type, ?string $format = null, array $context = []): bool
    {
        return $type === \Lenorix\BeelSdk\Generated\Model\InvoiceExportFilters::class;
    }
    public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
    {
        return is_object($data) && get_class($data) === \Lenorix\BeelSdk\Generated\Model\InvoiceExportFilters::class;
    }
    public function denormalize(mixed $data, string $type, ?string $format = null, array $context = []): mixed
    {
        $object = new \Lenorix\BeelSdk\Generated\Model\InvoiceExportFilters();
        if (null === $data || false === \is_array($data)) {
            return $object;
        }
        if (isset($data['$ref']) && !isset($data['type']) && !isset($data['properties']) && !isset($data['allOf'])) {
            return new Reference($data['$ref'], $context['document-origin']);
        }
        if (isset($data['$recursiveRef'])) {
            return new Reference($data['$recursiveRef'], $context['document-origin']);
        }
        if (\array_key_exists('status', $data)) {
            $object->setStatus($data['status']);
            unset($data['status']);
        }
        if (\array_key_exists('type', $data)) {
            $object->setType($data['type']);
            unset($data['type']);
        }
        if (\array_key_exists('date_from', $data)) {
            $date = \DateTime::createFromFormat('Y-m-d', $data['date_from']);
            if (false === $date) {
                throw new \Lenorix\BeelSdk\Generated\Runtime\Normalizer\InvalidDateException($data['date_from'], 'Y-m-d');
            }
            $object->setDateFrom($date->setTime(0, 0, 0));
            unset($data['date_from']);
        }
        if (\array_key_exists('date_to', $data)) {
            $date_1 = \DateTime::createFromFormat('Y-m-d', $data['date_to']);
            if (false === $date_1) {
                throw new \Lenorix\BeelSdk\Generated\Runtime\Normalizer\InvalidDateException($data['date_to'], 'Y-m-d');
            }
            $object->setDateTo($date_1->setTime(0, 0, 0));
            unset($data['date_to']);
        }
        if (\array_key_exists('customer_id', $data)) {
            $object->setCustomerId($data['customer_id']);
            unset($data['customer_id']);
        }
        if (\array_key_exists('recipient_name', $data)) {
            $object->setRecipientName($data['recipient_name']);
            unset($data['recipient_name']);
        }
        if (\array_key_exists('recipient_nif', $data)) {
            $object->setRecipientNif($data['recipient_nif']);
            unset($data['recipient_nif']);
        }
        if (\array_key_exists('series_code', $data)) {
            $object->setSeriesCode($data['series_code']);
            unset($data['series_code']);
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
        if ($data->isInitialized('status') && null !== $data->getStatus()) {
            $dataArray['status'] = $data->getStatus();
        }
        if ($data->isInitialized('type') && null !== $data->getType()) {
            $dataArray['type'] = $data->getType();
        }
        if ($data->isInitialized('dateFrom') && null !== $data->getDateFrom()) {
            $dataArray['date_from'] = $data->getDateFrom()->format('Y-m-d');
        }
        if ($data->isInitialized('dateTo') && null !== $data->getDateTo()) {
            $dataArray['date_to'] = $data->getDateTo()->format('Y-m-d');
        }
        if ($data->isInitialized('customerId') && null !== $data->getCustomerId()) {
            $dataArray['customer_id'] = $data->getCustomerId();
        }
        if ($data->isInitialized('recipientName') && null !== $data->getRecipientName()) {
            $dataArray['recipient_name'] = $data->getRecipientName();
        }
        if ($data->isInitialized('recipientNif') && null !== $data->getRecipientNif()) {
            $dataArray['recipient_nif'] = $data->getRecipientNif();
        }
        if ($data->isInitialized('seriesCode') && null !== $data->getSeriesCode()) {
            $dataArray['series_code'] = $data->getSeriesCode();
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
        return [\Lenorix\BeelSdk\Generated\Model\InvoiceExportFilters::class => false];
    }
}