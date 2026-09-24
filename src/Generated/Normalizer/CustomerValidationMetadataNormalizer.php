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
class CustomerValidationMetadataNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use CheckArray;
    use ValidatorTrait;
    public function supportsDenormalization(mixed $data, string $type, ?string $format = null, array $context = []): bool
    {
        return $type === \Lenorix\BeelSdk\Generated\Model\CustomerValidationMetadata::class;
    }
    public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
    {
        return is_object($data) && get_class($data) === \Lenorix\BeelSdk\Generated\Model\CustomerValidationMetadata::class;
    }
    public function denormalize(mixed $data, string $type, ?string $format = null, array $context = []): mixed
    {
        $object = new \Lenorix\BeelSdk\Generated\Model\CustomerValidationMetadata();
        if (null === $data || false === \is_array($data)) {
            return $object;
        }
        if (isset($data['$ref']) && !isset($data['type']) && !isset($data['properties']) && !isset($data['allOf'])) {
            return new Reference($data['$ref'], $context['document-origin']);
        }
        if (isset($data['$recursiveRef'])) {
            return new Reference($data['$recursiveRef'], $context['document-origin']);
        }
        if (\array_key_exists('is_dry_run', $data) && \is_int($data['is_dry_run'])) {
            $data['is_dry_run'] = (bool) $data['is_dry_run'];
        }
        if (\array_key_exists('total_customers', $data)) {
            $object->setTotalCustomers($data['total_customers']);
            unset($data['total_customers']);
        }
        if (\array_key_exists('is_dry_run', $data)) {
            $object->setIsDryRun($data['is_dry_run']);
            unset($data['is_dry_run']);
        }
        if (\array_key_exists('processing_time_ms', $data)) {
            $object->setProcessingTimeMs($data['processing_time_ms']);
            unset($data['processing_time_ms']);
        }
        if (\array_key_exists('source_type', $data)) {
            $object->setSourceType($data['source_type']);
            unset($data['source_type']);
        }
        if (\array_key_exists('filename', $data) && $data['filename'] !== null) {
            $object->setFilename($data['filename']);
            unset($data['filename']);
        }
        elseif (\array_key_exists('filename', $data) && $data['filename'] === null) {
            $object->setFilename(null);
            unset($data['filename']);
        }
        if (\array_key_exists('file_size_bytes', $data) && $data['file_size_bytes'] !== null) {
            $object->setFileSizeBytes($data['file_size_bytes']);
            unset($data['file_size_bytes']);
        }
        elseif (\array_key_exists('file_size_bytes', $data) && $data['file_size_bytes'] === null) {
            $object->setFileSizeBytes(null);
            unset($data['file_size_bytes']);
        }
        if (\array_key_exists('total_rows', $data) && $data['total_rows'] !== null) {
            $object->setTotalRows($data['total_rows']);
            unset($data['total_rows']);
        }
        elseif (\array_key_exists('total_rows', $data) && $data['total_rows'] === null) {
            $object->setTotalRows(null);
            unset($data['total_rows']);
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
        $dataArray['total_customers'] = $data->getTotalCustomers();
        $dataArray['is_dry_run'] = $data->getIsDryRun();
        $dataArray['processing_time_ms'] = $data->getProcessingTimeMs();
        $dataArray['source_type'] = $data->getSourceType();
        if ($data->isInitialized('filename') && null !== $data->getFilename()) {
            $dataArray['filename'] = $data->getFilename();
        }
        if ($data->isInitialized('fileSizeBytes') && null !== $data->getFileSizeBytes()) {
            $dataArray['file_size_bytes'] = $data->getFileSizeBytes();
        }
        if ($data->isInitialized('totalRows') && null !== $data->getTotalRows()) {
            $dataArray['total_rows'] = $data->getTotalRows();
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
        return [\Lenorix\BeelSdk\Generated\Model\CustomerValidationMetadata::class => false];
    }
}