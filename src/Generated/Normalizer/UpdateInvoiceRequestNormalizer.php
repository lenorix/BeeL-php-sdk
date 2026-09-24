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
class UpdateInvoiceRequestNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use CheckArray;
    use ValidatorTrait;
    public function supportsDenormalization(mixed $data, string $type, ?string $format = null, array $context = []): bool
    {
        return $type === \Lenorix\BeelSdk\Generated\Model\UpdateInvoiceRequest::class;
    }
    public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
    {
        return is_object($data) && get_class($data) === \Lenorix\BeelSdk\Generated\Model\UpdateInvoiceRequest::class;
    }
    public function denormalize(mixed $data, string $type, ?string $format = null, array $context = []): mixed
    {
        $object = new \Lenorix\BeelSdk\Generated\Model\UpdateInvoiceRequest();
        if (null === $data || false === \is_array($data)) {
            return $object;
        }
        if (isset($data['$ref']) && !isset($data['type']) && !isset($data['properties']) && !isset($data['allOf'])) {
            return new Reference($data['$ref'], $context['document-origin']);
        }
        if (isset($data['$recursiveRef'])) {
            return new Reference($data['$recursiveRef'], $context['document-origin']);
        }
        if (\array_key_exists('type', $data)) {
            $object->setType($data['type']);
            unset($data['type']);
        }
        if (\array_key_exists('series_id', $data)) {
            $object->setSeriesId($data['series_id']);
            unset($data['series_id']);
        }
        if (\array_key_exists('operation_date', $data) && $data['operation_date'] !== null) {
            $date = \DateTime::createFromFormat('Y-m-d', $data['operation_date']);
            if (false === $date) {
                throw new \Lenorix\BeelSdk\Generated\Runtime\Normalizer\InvalidDateException($data['operation_date'], 'Y-m-d');
            }
            $object->setOperationDate($date->setTime(0, 0, 0));
            unset($data['operation_date']);
        }
        elseif (\array_key_exists('operation_date', $data) && $data['operation_date'] === null) {
            $object->setOperationDate(null);
            unset($data['operation_date']);
        }
        if (\array_key_exists('due_date', $data) && $data['due_date'] !== null) {
            $date_1 = \DateTime::createFromFormat('Y-m-d', $data['due_date']);
            if (false === $date_1) {
                throw new \Lenorix\BeelSdk\Generated\Runtime\Normalizer\InvalidDateException($data['due_date'], 'Y-m-d');
            }
            $object->setDueDate($date_1->setTime(0, 0, 0));
            unset($data['due_date']);
        }
        elseif (\array_key_exists('due_date', $data) && $data['due_date'] === null) {
            $object->setDueDate(null);
            unset($data['due_date']);
        }
        if (\array_key_exists('valid_until', $data) && $data['valid_until'] !== null) {
            $date_2 = \DateTime::createFromFormat('Y-m-d', $data['valid_until']);
            if (false === $date_2) {
                throw new \Lenorix\BeelSdk\Generated\Runtime\Normalizer\InvalidDateException($data['valid_until'], 'Y-m-d');
            }
            $object->setValidUntil($date_2->setTime(0, 0, 0));
            unset($data['valid_until']);
        }
        elseif (\array_key_exists('valid_until', $data) && $data['valid_until'] === null) {
            $object->setValidUntil(null);
            unset($data['valid_until']);
        }
        if (\array_key_exists('recipient', $data)) {
            $object->setRecipient($this->denormalizer->denormalize($data['recipient'], \Lenorix\BeelSdk\Generated\Model\UpdateInvoiceRequestRecipient::class, 'json', $context));
            unset($data['recipient']);
        }
        if (\array_key_exists('lines', $data)) {
            $values = [];
            foreach ($data['lines'] as $value) {
                $values[] = $this->denormalizer->denormalize($value, \Lenorix\BeelSdk\Generated\Model\UpdateInvoiceRequestLinesItem::class, 'json', $context);
            }
            $object->setLines($values);
            unset($data['lines']);
        }
        if (\array_key_exists('payment_info', $data)) {
            $object->setPaymentInfo($this->denormalizer->denormalize($data['payment_info'], \Lenorix\BeelSdk\Generated\Model\UpdateInvoiceRequestPaymentInfo::class, 'json', $context));
            unset($data['payment_info']);
        }
        if (\array_key_exists('notes', $data)) {
            $object->setNotes($data['notes']);
            unset($data['notes']);
        }
        if (\array_key_exists('options', $data)) {
            $object->setOptions($this->denormalizer->denormalize($data['options'], \Lenorix\BeelSdk\Generated\Model\UpdateInvoiceRequestOptions::class, 'json', $context));
            unset($data['options']);
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
        if ($data->isInitialized('type') && null !== $data->getType()) {
            $dataArray['type'] = $data->getType();
        }
        if ($data->isInitialized('seriesId') && null !== $data->getSeriesId()) {
            $dataArray['series_id'] = $data->getSeriesId();
        }
        if ($data->isInitialized('operationDate') && null !== $data->getOperationDate()) {
            $dataArray['operation_date'] = $data->getOperationDate()?->format('Y-m-d');
        }
        if ($data->isInitialized('dueDate') && null !== $data->getDueDate()) {
            $dataArray['due_date'] = $data->getDueDate()?->format('Y-m-d');
        }
        if ($data->isInitialized('validUntil') && null !== $data->getValidUntil()) {
            $dataArray['valid_until'] = $data->getValidUntil()?->format('Y-m-d');
        }
        if ($data->isInitialized('recipient') && null !== $data->getRecipient()) {
            $dataArray['recipient'] = $data->getRecipient() === null ? null : new \Lenorix\BeelSdk\Generated\Runtime\JsonObject($this->normalizer->normalize($data->getRecipient(), 'json', $context));
        }
        if ($data->isInitialized('lines') && null !== $data->getLines()) {
            $values = [];
            foreach ($data->getLines() as $value) {
                $values[] = $value === null ? null : new \Lenorix\BeelSdk\Generated\Runtime\JsonObject($this->normalizer->normalize($value, 'json', $context));
            }
            $dataArray['lines'] = $values;
        }
        if ($data->isInitialized('paymentInfo') && null !== $data->getPaymentInfo()) {
            $dataArray['payment_info'] = $data->getPaymentInfo() === null ? null : new \Lenorix\BeelSdk\Generated\Runtime\JsonObject($this->normalizer->normalize($data->getPaymentInfo(), 'json', $context));
        }
        if ($data->isInitialized('notes') && null !== $data->getNotes()) {
            $dataArray['notes'] = $data->getNotes();
        }
        if ($data->isInitialized('options') && null !== $data->getOptions()) {
            $dataArray['options'] = $data->getOptions() === null ? null : new \Lenorix\BeelSdk\Generated\Runtime\JsonObject($this->normalizer->normalize($data->getOptions(), 'json', $context));
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
        return [\Lenorix\BeelSdk\Generated\Model\UpdateInvoiceRequest::class => false];
    }
}