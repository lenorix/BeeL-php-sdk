<?php

namespace Lenorix\BeelSdk\Generated\Normalizer;

use Jane\Component\JsonSchemaRuntime\Reference;
use Lenorix\BeelSdk\Generated\Model\CsvImportResult;
use Lenorix\BeelSdk\Generated\Model\CsvValidationError;
use Lenorix\BeelSdk\Generated\Model\Customer;
use Lenorix\BeelSdk\Generated\Runtime\JsonObject;
use Lenorix\BeelSdk\Generated\Runtime\Normalizer\CheckArray;
use Lenorix\BeelSdk\Generated\Runtime\Normalizer\ValidatorTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class CsvImportResultNormalizer implements DenormalizerAwareInterface, DenormalizerInterface, NormalizerAwareInterface, NormalizerInterface
{
    use CheckArray;
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use ValidatorTrait;

    public function supportsDenormalization(mixed $data, string $type, ?string $format = null, array $context = []): bool
    {
        return $type === CsvImportResult::class;
    }

    public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
    {
        return is_object($data) && get_class($data) === CsvImportResult::class;
    }

    public function denormalize(mixed $data, string $type, ?string $format = null, array $context = []): mixed
    {
        $object = new CsvImportResult;
        if ($data === null || \is_array($data) === false) {
            return $object;
        }
        if (isset($data['$ref']) && ! isset($data['type']) && ! isset($data['properties']) && ! isset($data['allOf'])) {
            return new Reference($data['$ref'], $context['document-origin']);
        }
        if (isset($data['$recursiveRef'])) {
            return new Reference($data['$recursiveRef'], $context['document-origin']);
        }
        if (\array_key_exists('total_processed', $data)) {
            $object->setTotalProcessed($data['total_processed']);
            unset($data['total_processed']);
        }
        if (\array_key_exists('successful', $data)) {
            $object->setSuccessful($data['successful']);
            unset($data['successful']);
        }
        if (\array_key_exists('failed', $data)) {
            $object->setFailed($data['failed']);
            unset($data['failed']);
        }
        if (\array_key_exists('duplicates_skipped', $data)) {
            $object->setDuplicatesSkipped($data['duplicates_skipped']);
            unset($data['duplicates_skipped']);
        }
        if (\array_key_exists('created_customers', $data)) {
            $values = [];
            foreach ($data['created_customers'] as $value) {
                $values[] = $this->denormalizer->denormalize($value, Customer::class, 'json', $context);
            }
            $object->setCreatedCustomers($values);
            unset($data['created_customers']);
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
        foreach ($data as $key => $value_3) {
            if (preg_match('/.*/', (string) $key)) {
                $object[$key] = $value_3;
            }
        }

        return $object;
    }

    public function normalize(mixed $data, ?string $format = null, array $context = []): array|string|int|float|bool|\ArrayObject|null
    {
        $dataArray = [];
        $dataArray['total_processed'] = $data->getTotalProcessed();
        $dataArray['successful'] = $data->getSuccessful();
        $dataArray['failed'] = $data->getFailed();
        $dataArray['duplicates_skipped'] = $data->getDuplicatesSkipped();
        if ($data->isInitialized('createdCustomers') && $data->getCreatedCustomers() !== null) {
            $values = [];
            foreach ($data->getCreatedCustomers() as $value) {
                $values[] = $value === null ? null : new JsonObject($this->normalizer->normalize($value, 'json', $context));
            }
            $dataArray['created_customers'] = $values;
        }
        if ($data->isInitialized('errors') && $data->getErrors() !== null) {
            $values_1 = [];
            foreach ($data->getErrors() as $value_1) {
                $values_1[] = $value_1 === null ? null : new JsonObject($this->normalizer->normalize($value_1, 'json', $context));
            }
            $dataArray['errors'] = $values_1;
        }
        if ($data->isInitialized('warnings') && $data->getWarnings() !== null) {
            $values_2 = [];
            foreach ($data->getWarnings() as $value_2) {
                $values_2[] = $value_2;
            }
            $dataArray['warnings'] = $values_2;
        }
        foreach ($data->additionalPropertyEntries() as $key => $value_3) {
            if (preg_match('/.*/', (string) $key)) {
                $dataArray[$key] = $value_3;
            }
        }

        return $dataArray;
    }

    public function getSupportedTypes(?string $format = null): array
    {
        return [CsvImportResult::class => false];
    }
}
