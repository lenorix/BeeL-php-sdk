<?php

namespace Lenorix\BeelSdk\Generated\Normalizer;

use Jane\Component\JsonSchemaRuntime\Reference;
use Lenorix\BeelSdk\Generated\Model\CsvCustomerPreview;
use Lenorix\BeelSdk\Generated\Model\CsvImportMetadata;
use Lenorix\BeelSdk\Generated\Model\CsvImportPreviewResult;
use Lenorix\BeelSdk\Generated\Model\CsvImportStatistics;
use Lenorix\BeelSdk\Generated\Runtime\JsonObject;
use Lenorix\BeelSdk\Generated\Runtime\Normalizer\CheckArray;
use Lenorix\BeelSdk\Generated\Runtime\Normalizer\ValidatorTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class CsvImportPreviewResultNormalizer implements DenormalizerAwareInterface, DenormalizerInterface, NormalizerAwareInterface, NormalizerInterface
{
    use CheckArray;
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use ValidatorTrait;

    public function supportsDenormalization(mixed $data, string $type, ?string $format = null, array $context = []): bool
    {
        return $type === CsvImportPreviewResult::class;
    }

    public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
    {
        return is_object($data) && get_class($data) === CsvImportPreviewResult::class;
    }

    public function denormalize(mixed $data, string $type, ?string $format = null, array $context = []): mixed
    {
        $object = new CsvImportPreviewResult;
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
            $object->setMetadata($this->denormalizer->denormalize($data['metadata'], CsvImportMetadata::class, 'json', $context));
            unset($data['metadata']);
        }
        if (\array_key_exists('customers_preview', $data)) {
            $values = [];
            foreach ($data['customers_preview'] as $value) {
                $values[] = $this->denormalizer->denormalize($value, CsvCustomerPreview::class, 'json', $context);
            }
            $object->setCustomersPreview($values);
            unset($data['customers_preview']);
        }
        if (\array_key_exists('statistics', $data)) {
            $object->setStatistics($this->denormalizer->denormalize($data['statistics'], CsvImportStatistics::class, 'json', $context));
            unset($data['statistics']);
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
        $dataArray['metadata'] = $data->getMetadata() === null ? null : new JsonObject($this->normalizer->normalize($data->getMetadata(), 'json', $context));
        $values = [];
        foreach ($data->getCustomersPreview() as $value) {
            $values[] = $value === null ? null : new JsonObject($this->normalizer->normalize($value, 'json', $context));
        }
        $dataArray['customers_preview'] = $values;
        $dataArray['statistics'] = $data->getStatistics() === null ? null : new JsonObject($this->normalizer->normalize($data->getStatistics(), 'json', $context));
        foreach ($data->additionalPropertyEntries() as $key => $value_1) {
            if (preg_match('/.*/', (string) $key)) {
                $dataArray[$key] = $value_1;
            }
        }

        return $dataArray;
    }

    public function getSupportedTypes(?string $format = null): array
    {
        return [CsvImportPreviewResult::class => false];
    }
}
