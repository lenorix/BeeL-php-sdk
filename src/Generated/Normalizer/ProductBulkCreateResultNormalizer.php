<?php

namespace Lenorix\BeelSdk\Generated\Normalizer;

use Jane\Component\JsonSchemaRuntime\Reference;
use Lenorix\BeelSdk\Generated\Model\Product;
use Lenorix\BeelSdk\Generated\Model\ProductBulkCreateItem;
use Lenorix\BeelSdk\Generated\Model\ProductBulkCreateLegacyError;
use Lenorix\BeelSdk\Generated\Model\ProductBulkCreateMetadata;
use Lenorix\BeelSdk\Generated\Model\ProductBulkCreateResult;
use Lenorix\BeelSdk\Generated\Model\ProductBulkCreateResultSummary;
use Lenorix\BeelSdk\Generated\Model\ProductBulkCreateStatistics;
use Lenorix\BeelSdk\Generated\Runtime\JsonObject;
use Lenorix\BeelSdk\Generated\Runtime\Normalizer\CheckArray;
use Lenorix\BeelSdk\Generated\Runtime\Normalizer\ValidatorTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class ProductBulkCreateResultNormalizer implements DenormalizerAwareInterface, DenormalizerInterface, NormalizerAwareInterface, NormalizerInterface
{
    use CheckArray;
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use ValidatorTrait;

    public function supportsDenormalization(mixed $data, string $type, ?string $format = null, array $context = []): bool
    {
        return $type === ProductBulkCreateResult::class;
    }

    public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
    {
        return is_object($data) && get_class($data) === ProductBulkCreateResult::class;
    }

    public function denormalize(mixed $data, string $type, ?string $format = null, array $context = []): mixed
    {
        $object = new ProductBulkCreateResult;
        if ($data === null || \is_array($data) === false) {
            return $object;
        }
        if (isset($data['$ref']) && ! isset($data['type']) && ! isset($data['properties']) && ! isset($data['allOf'])) {
            return new Reference($data['$ref'], $context['document-origin']);
        }
        if (isset($data['$recursiveRef'])) {
            return new Reference($data['$recursiveRef'], $context['document-origin']);
        }
        if (\array_key_exists('metadata', $data)) {
            $object->setMetadata($this->denormalizer->denormalize($data['metadata'], ProductBulkCreateMetadata::class, 'json', $context));
            unset($data['metadata']);
        }
        if (\array_key_exists('products_creation', $data)) {
            $values = [];
            foreach ($data['products_creation'] as $value) {
                $values[] = $this->denormalizer->denormalize($value, ProductBulkCreateItem::class, 'json', $context);
            }
            $object->setProductsCreation($values);
            unset($data['products_creation']);
        }
        if (\array_key_exists('statistics', $data)) {
            $object->setStatistics($this->denormalizer->denormalize($data['statistics'], ProductBulkCreateStatistics::class, 'json', $context));
            unset($data['statistics']);
        }
        if (\array_key_exists('created_products', $data)) {
            $values_1 = [];
            foreach ($data['created_products'] as $value_1) {
                $values_1[] = $this->denormalizer->denormalize($value_1, Product::class, 'json', $context);
            }
            $object->setCreatedProducts($values_1);
            unset($data['created_products']);
        }
        if (\array_key_exists('errors', $data)) {
            $values_2 = [];
            foreach ($data['errors'] as $value_2) {
                $values_2[] = $this->denormalizer->denormalize($value_2, ProductBulkCreateLegacyError::class, 'json', $context);
            }
            $object->setErrors($values_2);
            unset($data['errors']);
        }
        if (\array_key_exists('summary', $data)) {
            $object->setSummary($this->denormalizer->denormalize($data['summary'], ProductBulkCreateResultSummary::class, 'json', $context));
            unset($data['summary']);
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
        $dataArray['metadata'] = $data->getMetadata() === null ? null : new JsonObject($this->normalizer->normalize($data->getMetadata(), 'json', $context));
        $values = [];
        foreach ($data->getProductsCreation() as $value) {
            $values[] = $value === null ? null : new JsonObject($this->normalizer->normalize($value, 'json', $context));
        }
        $dataArray['products_creation'] = $values;
        $dataArray['statistics'] = $data->getStatistics() === null ? null : new JsonObject($this->normalizer->normalize($data->getStatistics(), 'json', $context));
        $values_1 = [];
        foreach ($data->getCreatedProducts() as $value_1) {
            $values_1[] = $value_1 === null ? null : new JsonObject($this->normalizer->normalize($value_1, 'json', $context));
        }
        $dataArray['created_products'] = $values_1;
        if ($data->isInitialized('errors') && $data->getErrors() !== null) {
            $values_2 = [];
            foreach ($data->getErrors() as $value_2) {
                $values_2[] = $value_2 === null ? null : new JsonObject($this->normalizer->normalize($value_2, 'json', $context));
            }
            $dataArray['errors'] = $values_2;
        }
        if ($data->isInitialized('summary') && $data->getSummary() !== null) {
            $dataArray['summary'] = $data->getSummary() === null ? null : new JsonObject($this->normalizer->normalize($data->getSummary(), 'json', $context));
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
        return [ProductBulkCreateResult::class => false];
    }
}
