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
class CustomerBulkDeleteResultNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use CheckArray;
    use ValidatorTrait;
    public function supportsDenormalization(mixed $data, string $type, ?string $format = null, array $context = []): bool
    {
        return $type === \Lenorix\BeelSdk\Generated\Model\CustomerBulkDeleteResult::class;
    }
    public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
    {
        return is_object($data) && get_class($data) === \Lenorix\BeelSdk\Generated\Model\CustomerBulkDeleteResult::class;
    }
    public function denormalize(mixed $data, string $type, ?string $format = null, array $context = []): mixed
    {
        $object = new \Lenorix\BeelSdk\Generated\Model\CustomerBulkDeleteResult();
        if (null === $data || false === \is_array($data)) {
            return $object;
        }
        if (isset($data['$ref']) && !isset($data['type']) && !isset($data['properties']) && !isset($data['allOf'])) {
            return new Reference($data['$ref'], $context['document-origin']);
        }
        if (isset($data['$recursiveRef'])) {
            return new Reference($data['$recursiveRef'], $context['document-origin']);
        }
        if (\array_key_exists('metadata', $data)) {
            $object->setMetadata($this->denormalizer->denormalize($data['metadata'], \Lenorix\BeelSdk\Generated\Model\CustomerBulkDeleteMetadata::class, 'json', $context));
            unset($data['metadata']);
        }
        if (\array_key_exists('customers_deletion', $data)) {
            $values = [];
            foreach ($data['customers_deletion'] as $value) {
                $values[] = $this->denormalizer->denormalize($value, \Lenorix\BeelSdk\Generated\Model\CustomerBulkDeleteItem::class, 'json', $context);
            }
            $object->setCustomersDeletion($values);
            unset($data['customers_deletion']);
        }
        if (\array_key_exists('statistics', $data)) {
            $object->setStatistics($this->denormalizer->denormalize($data['statistics'], \Lenorix\BeelSdk\Generated\Model\CustomerBulkDeleteStatistics::class, 'json', $context));
            unset($data['statistics']);
        }
        if (\array_key_exists('deleted_ids', $data)) {
            $values_1 = [];
            foreach ($data['deleted_ids'] as $value_1) {
                $values_1[] = $value_1;
            }
            $object->setDeletedIds($values_1);
            unset($data['deleted_ids']);
        }
        if (\array_key_exists('deactivated_ids', $data)) {
            $values_2 = [];
            foreach ($data['deactivated_ids'] as $value_2) {
                $values_2[] = $value_2;
            }
            $object->setDeactivatedIds($values_2);
            unset($data['deactivated_ids']);
        }
        if (\array_key_exists('total', $data)) {
            $object->setTotal($data['total']);
            unset($data['total']);
        }
        if (\array_key_exists('successful', $data)) {
            $object->setSuccessful($data['successful']);
            unset($data['successful']);
        }
        if (\array_key_exists('failed', $data)) {
            $object->setFailed($data['failed']);
            unset($data['failed']);
        }
        if (\array_key_exists('errors', $data)) {
            $values_3 = [];
            foreach ($data['errors'] as $value_3) {
                $values_3[] = $this->denormalizer->denormalize($value_3, \Lenorix\BeelSdk\Generated\Model\CustomerBulkDeleteLegacyError::class, 'json', $context);
            }
            $object->setErrors($values_3);
            unset($data['errors']);
        }
        foreach ($data as $key => $value_4) {
            if (preg_match('/.*/', (string) $key)) {
                $object[$key] = $value_4;
            }
        }
        return $object;
    }
    public function normalize(mixed $data, ?string $format = null, array $context = []): array|string|int|float|bool|\ArrayObject|null
    {
        $dataArray = [];
        $dataArray['metadata'] = $data->getMetadata() === null ? null : new \Lenorix\BeelSdk\Generated\Runtime\JsonObject($this->normalizer->normalize($data->getMetadata(), 'json', $context));
        $values = [];
        foreach ($data->getCustomersDeletion() as $value) {
            $values[] = $value === null ? null : new \Lenorix\BeelSdk\Generated\Runtime\JsonObject($this->normalizer->normalize($value, 'json', $context));
        }
        $dataArray['customers_deletion'] = $values;
        $dataArray['statistics'] = $data->getStatistics() === null ? null : new \Lenorix\BeelSdk\Generated\Runtime\JsonObject($this->normalizer->normalize($data->getStatistics(), 'json', $context));
        $values_1 = [];
        foreach ($data->getDeletedIds() as $value_1) {
            $values_1[] = $value_1;
        }
        $dataArray['deleted_ids'] = $values_1;
        $values_2 = [];
        foreach ($data->getDeactivatedIds() as $value_2) {
            $values_2[] = $value_2;
        }
        $dataArray['deactivated_ids'] = $values_2;
        $dataArray['total'] = $data->getTotal();
        $dataArray['successful'] = $data->getSuccessful();
        $dataArray['failed'] = $data->getFailed();
        if ($data->isInitialized('errors') && null !== $data->getErrors()) {
            $values_3 = [];
            foreach ($data->getErrors() as $value_3) {
                $values_3[] = $value_3 === null ? null : new \Lenorix\BeelSdk\Generated\Runtime\JsonObject($this->normalizer->normalize($value_3, 'json', $context));
            }
            $dataArray['errors'] = $values_3;
        }
        foreach ($data->additionalPropertyEntries() as $key => $value_4) {
            if (preg_match('/.*/', (string) $key)) {
                $dataArray[$key] = $value_4;
            }
        }
        return $dataArray;
    }
    public function getSupportedTypes(?string $format = null): array
    {
        return [\Lenorix\BeelSdk\Generated\Model\CustomerBulkDeleteResult::class => false];
    }
}