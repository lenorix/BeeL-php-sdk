<?php

namespace Lenorix\BeelSdk\Generated\Normalizer;

use Jane\Component\JsonSchemaRuntime\Reference;
use Lenorix\BeelSdk\Generated\Model\CsvCustomerPreview;
use Lenorix\BeelSdk\Generated\Model\CsvValidationError;
use Lenorix\BeelSdk\Generated\Runtime\JsonObject;
use Lenorix\BeelSdk\Generated\Runtime\Normalizer\CheckArray;
use Lenorix\BeelSdk\Generated\Runtime\Normalizer\ValidatorTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class CsvCustomerPreviewNormalizer implements DenormalizerAwareInterface, DenormalizerInterface, NormalizerAwareInterface, NormalizerInterface
{
    use CheckArray;
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use ValidatorTrait;

    public function supportsDenormalization(mixed $data, string $type, ?string $format = null, array $context = []): bool
    {
        return $type === CsvCustomerPreview::class;
    }

    public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
    {
        return is_object($data) && get_class($data) === CsvCustomerPreview::class;
    }

    public function denormalize(mixed $data, string $type, ?string $format = null, array $context = []): mixed
    {
        $object = new CsvCustomerPreview;
        if ($data === null || \is_array($data) === false) {
            return $object;
        }
        if (isset($data['$ref']) && ! isset($data['type']) && ! isset($data['properties']) && ! isset($data['allOf'])) {
            return new Reference($data['$ref'], $context['document-origin']);
        }
        if (isset($data['$recursiveRef'])) {
            return new Reference($data['$recursiveRef'], $context['document-origin']);
        }
        if (\array_key_exists('row_number', $data)) {
            $object->setRowNumber($data['row_number']);
            unset($data['row_number']);
        }
        if (\array_key_exists('customer', $data) && $data['customer'] !== null) {
            $values = new JsonObject;
            foreach ($data['customer'] as $key => $value) {
                $values[$key] = $value;
            }
            $object->setCustomer($values);
            unset($data['customer']);
        } elseif (\array_key_exists('customer', $data) && $data['customer'] === null) {
            $object->setCustomer(null);
            unset($data['customer']);
        }
        if (\array_key_exists('status', $data)) {
            $object->setStatus($data['status']);
            unset($data['status']);
        }
        if (\array_key_exists('errors', $data)) {
            $values_1 = [];
            foreach ($data['errors'] as $value_1) {
                $values_1[] = $this->denormalizer->denormalize($value_1, CsvValidationError::class, 'json', $context);
            }
            $object->setErrors($values_1);
            unset($data['errors']);
        }
        if (\array_key_exists('warnings', $data)) {
            $values_2 = [];
            foreach ($data['warnings'] as $value_2) {
                $values_2[] = $value_2;
            }
            $object->setWarnings($values_2);
            unset($data['warnings']);
        }
        foreach ($data as $key_1 => $value_3) {
            if (preg_match('/.*/', (string) $key_1)) {
                $object[$key_1] = $value_3;
            }
        }

        return $object;
    }

    public function normalize(mixed $data, ?string $format = null, array $context = []): array|string|int|float|bool|\ArrayObject|null
    {
        $dataArray = [];
        $dataArray['row_number'] = $data->getRowNumber();
        $values = new JsonObject;
        foreach ($data->getCustomer() as $key => $value) {
            $values[$key] = $value;
        }
        $dataArray['customer'] = $values;
        $dataArray['status'] = $data->getStatus();
        $values_1 = [];
        foreach ($data->getErrors() as $value_1) {
            $values_1[] = $value_1 === null ? null : new JsonObject($this->normalizer->normalize($value_1, 'json', $context));
        }
        $dataArray['errors'] = $values_1;
        $values_2 = [];
        foreach ($data->getWarnings() as $value_2) {
            $values_2[] = $value_2;
        }
        $dataArray['warnings'] = $values_2;
        foreach ($data->additionalPropertyEntries() as $key_1 => $value_3) {
            if (preg_match('/.*/', (string) $key_1)) {
                $dataArray[$key_1] = $value_3;
            }
        }

        return $dataArray;
    }

    public function getSupportedTypes(?string $format = null): array
    {
        return [CsvCustomerPreview::class => false];
    }
}
