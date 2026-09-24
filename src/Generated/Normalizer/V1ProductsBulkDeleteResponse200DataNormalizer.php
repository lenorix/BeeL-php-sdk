<?php

namespace Lenorix\BeelSdk\Generated\Normalizer;

use Jane\Component\JsonSchemaRuntime\Reference;
use Lenorix\BeelSdk\Generated\Model\V1ProductsBulkDeleteResponse200Data;
use Lenorix\BeelSdk\Generated\Model\V1ProductsBulkDeleteResponse200DataErrorsItem;
use Lenorix\BeelSdk\Generated\Model\V1ProductsBulkDeleteResponse200DataSummary;
use Lenorix\BeelSdk\Generated\Runtime\JsonObject;
use Lenorix\BeelSdk\Generated\Runtime\Normalizer\CheckArray;
use Lenorix\BeelSdk\Generated\Runtime\Normalizer\ValidatorTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class V1ProductsBulkDeleteResponse200DataNormalizer implements DenormalizerAwareInterface, DenormalizerInterface, NormalizerAwareInterface, NormalizerInterface
{
    use CheckArray;
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use ValidatorTrait;

    public function supportsDenormalization(mixed $data, string $type, ?string $format = null, array $context = []): bool
    {
        return $type === V1ProductsBulkDeleteResponse200Data::class;
    }

    public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
    {
        return is_object($data) && get_class($data) === V1ProductsBulkDeleteResponse200Data::class;
    }

    public function denormalize(mixed $data, string $type, ?string $format = null, array $context = []): mixed
    {
        $object = new V1ProductsBulkDeleteResponse200Data;
        if ($data === null || \is_array($data) === false) {
            return $object;
        }
        if (isset($data['$ref']) && ! isset($data['type']) && ! isset($data['properties']) && ! isset($data['allOf'])) {
            return new Reference($data['$ref'], $context['document-origin']);
        }
        if (isset($data['$recursiveRef'])) {
            return new Reference($data['$recursiveRef'], $context['document-origin']);
        }
        if (\array_key_exists('deleted_products', $data)) {
            $values = [];
            foreach ($data['deleted_products'] as $value) {
                $values[] = $value;
            }
            $object->setDeletedProducts($values);
            unset($data['deleted_products']);
        }
        if (\array_key_exists('errors', $data)) {
            $values_1 = [];
            foreach ($data['errors'] as $value_1) {
                $values_1[] = $this->denormalizer->denormalize($value_1, V1ProductsBulkDeleteResponse200DataErrorsItem::class, 'json', $context);
            }
            $object->setErrors($values_1);
            unset($data['errors']);
        }
        if (\array_key_exists('summary', $data)) {
            $object->setSummary($this->denormalizer->denormalize($data['summary'], V1ProductsBulkDeleteResponse200DataSummary::class, 'json', $context));
            unset($data['summary']);
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
        if ($data->isInitialized('deletedProducts') && $data->getDeletedProducts() !== null) {
            $values = [];
            foreach ($data->getDeletedProducts() as $value) {
                $values[] = $value;
            }
            $dataArray['deleted_products'] = $values;
        }
        if ($data->isInitialized('errors') && $data->getErrors() !== null) {
            $values_1 = [];
            foreach ($data->getErrors() as $value_1) {
                $values_1[] = $value_1 === null ? null : new JsonObject($this->normalizer->normalize($value_1, 'json', $context));
            }
            $dataArray['errors'] = $values_1;
        }
        if ($data->isInitialized('summary') && $data->getSummary() !== null) {
            $dataArray['summary'] = $data->getSummary() === null ? null : new JsonObject($this->normalizer->normalize($data->getSummary(), 'json', $context));
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
        return [V1ProductsBulkDeleteResponse200Data::class => false];
    }
}
