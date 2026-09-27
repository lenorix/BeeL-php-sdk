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
class CsvImportResultNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use CheckArray;
    use ValidatorTrait;
    public function supportsDenormalization(mixed $data, string $type, ?string $format = null, array $context = []): bool
    {
        return $type === \Lenorix\BeelSdk\Generated\Model\CsvImportResult::class;
    }
    public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
    {
        return is_object($data) && get_class($data) === \Lenorix\BeelSdk\Generated\Model\CsvImportResult::class;
    }
    public function denormalize(mixed $data, string $type, ?string $format = null, array $context = []): mixed
    {
        $object = new \Lenorix\BeelSdk\Generated\Model\CsvImportResult();
        if (null === $data || false === \is_array($data)) {
            return $object;
        }
        if (isset($data['$ref']) && !isset($data['type']) && !isset($data['properties']) && !isset($data['allOf'])) {
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
                $values[] = $this->denormalizer->denormalize($value, \Lenorix\BeelSdk\Generated\Model\Customer::class, 'json', $context);
            }
            $object->setCreatedCustomers($values);
            unset($data['created_customers']);
        }
        if (\array_key_exists('errors', $data)) {
            $values_1 = [];
            foreach ($data['errors'] as $value_1) {
                $values_1[] = $this->denormalizer->denormalize($value_1, \Lenorix\BeelSdk\Generated\Model\CsvValidationError::class, 'json', $context);
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
        if ($data->isInitialized('createdCustomers') && null !== $data->getCreatedCustomers()) {
            $values = [];
            foreach ($data->getCreatedCustomers() as $value) {
                $values[] = $value === null ? null : new \Lenorix\BeelSdk\Generated\Runtime\JsonObject($this->normalizer->normalize($value, 'json', $context));
            }
            $dataArray['created_customers'] = $values;
        }
        if ($data->isInitialized('errors') && null !== $data->getErrors()) {
            $values_1 = [];
            foreach ($data->getErrors() as $value_1) {
                $values_1[] = $value_1 === null ? null : new \Lenorix\BeelSdk\Generated\Runtime\JsonObject($this->normalizer->normalize($value_1, 'json', $context));
            }
            $dataArray['errors'] = $values_1;
        }
        if ($data->isInitialized('warnings') && null !== $data->getWarnings()) {
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
        return [\Lenorix\BeelSdk\Generated\Model\CsvImportResult::class => false];
    }
}