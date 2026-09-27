<?php

namespace Lenorix\BeelSdk\Generated\Normalizer;

use Jane\Component\JsonSchemaRuntime\Reference;
use Lenorix\BeelSdk\Generated\Model\CustomerValidationError;
use Lenorix\BeelSdk\Generated\Model\CustomerValidationItem;
use Lenorix\BeelSdk\Generated\Model\CustomerValidationItemCustomer;
use Lenorix\BeelSdk\Generated\Model\CustomerValidationWarning;
use Lenorix\BeelSdk\Generated\Runtime\JsonObject;
use Lenorix\BeelSdk\Generated\Runtime\Normalizer\CheckArray;
use Lenorix\BeelSdk\Generated\Runtime\Normalizer\ValidatorTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class CustomerValidationItemNormalizer implements DenormalizerAwareInterface, DenormalizerInterface, NormalizerAwareInterface, NormalizerInterface
{
    use CheckArray;
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use ValidatorTrait;

    public function supportsDenormalization(mixed $data, string $type, ?string $format = null, array $context = []): bool
    {
        return $type === CustomerValidationItem::class;
    }

    public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
    {
        return is_object($data) && get_class($data) === CustomerValidationItem::class;
    }

    public function denormalize(mixed $data, string $type, ?string $format = null, array $context = []): mixed
    {
        $object = new CustomerValidationItem;
        if ($data === null || \is_array($data) === false) {
            return $object;
        }
        if (isset($data['$ref']) && ! isset($data['type']) && ! isset($data['properties']) && ! isset($data['allOf'])) {
            return new Reference($data['$ref'], $context['document-origin']);
        }
        if (isset($data['$recursiveRef'])) {
            return new Reference($data['$recursiveRef'], $context['document-origin']);
        }
        if (\array_key_exists('index', $data)) {
            $object->setIndex($data['index']);
            unset($data['index']);
        }
        if (\array_key_exists('customer', $data)) {
            $object->setCustomer($this->denormalizer->denormalize($data['customer'], CustomerValidationItemCustomer::class, 'json', $context));
            unset($data['customer']);
        }
        if (\array_key_exists('customer_id', $data)) {
            $object->setCustomerId($data['customer_id']);
            unset($data['customer_id']);
        }
        if (\array_key_exists('status', $data)) {
            $object->setStatus($data['status']);
            unset($data['status']);
        }
        if (\array_key_exists('errors', $data)) {
            $values = [];
            foreach ($data['errors'] as $value) {
                $values[] = $this->denormalizer->denormalize($value, CustomerValidationError::class, 'json', $context);
            }
            $object->setErrors($values);
            unset($data['errors']);
        }
        if (\array_key_exists('warnings', $data)) {
            $values_1 = [];
            foreach ($data['warnings'] as $value_1) {
                $values_1[] = $this->denormalizer->denormalize($value_1, CustomerValidationWarning::class, 'json', $context);
            }
            $object->setWarnings($values_1);
            unset($data['warnings']);
        }
        if (\array_key_exists('row_number', $data) && $data['row_number'] !== null) {
            $object->setRowNumber($data['row_number']);
            unset($data['row_number']);
        } elseif (\array_key_exists('row_number', $data) && $data['row_number'] === null) {
            $object->setRowNumber(null);
            unset($data['row_number']);
        }
        foreach ($data as $key => $value_2) {
            if (preg_match('/.*/', (string) $key)) {
                $object[$key] = $value_2;
            }
        }

        return $object;
    }

    public function normalize(mixed $data, ?string $format = null, array $context = []): array|string|int|float|bool|\ArrayObject|null
    {
        $dataArray = [];
        $dataArray['index'] = $data->getIndex();
        if ($data->isInitialized('customer') && $data->getCustomer() !== null) {
            $dataArray['customer'] = $data->getCustomer() === null ? null : new JsonObject($this->normalizer->normalize($data->getCustomer(), 'json', $context));
        }
        if ($data->isInitialized('customerId') && $data->getCustomerId() !== null) {
            $dataArray['customer_id'] = $data->getCustomerId();
        }
        $dataArray['status'] = $data->getStatus();
        $values = [];
        foreach ($data->getErrors() as $value) {
            $values[] = $value === null ? null : new JsonObject($this->normalizer->normalize($value, 'json', $context));
        }
        $dataArray['errors'] = $values;
        $values_1 = [];
        foreach ($data->getWarnings() as $value_1) {
            $values_1[] = $value_1 === null ? null : new JsonObject($this->normalizer->normalize($value_1, 'json', $context));
        }
        $dataArray['warnings'] = $values_1;
        if ($data->isInitialized('rowNumber') && $data->getRowNumber() !== null) {
            $dataArray['row_number'] = $data->getRowNumber();
        }
        foreach ($data->additionalPropertyEntries() as $key => $value_2) {
            if (preg_match('/.*/', (string) $key)) {
                $dataArray[$key] = $value_2;
            }
        }

        return $dataArray;
    }

    public function getSupportedTypes(?string $format = null): array
    {
        return [CustomerValidationItem::class => false];
    }
}
