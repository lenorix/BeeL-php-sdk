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
class CsvImportErrorDetailsNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use CheckArray;
    use ValidatorTrait;
    public function supportsDenormalization(mixed $data, string $type, ?string $format = null, array $context = []): bool
    {
        return $type === \Lenorix\BeelSdk\Generated\Model\CsvImportErrorDetails::class;
    }
    public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
    {
        return is_object($data) && get_class($data) === \Lenorix\BeelSdk\Generated\Model\CsvImportErrorDetails::class;
    }
    public function denormalize(mixed $data, string $type, ?string $format = null, array $context = []): mixed
    {
        $object = new \Lenorix\BeelSdk\Generated\Model\CsvImportErrorDetails();
        if (null === $data || false === \is_array($data)) {
            return $object;
        }
        if (isset($data['$ref']) && !isset($data['type']) && !isset($data['properties']) && !isset($data['allOf'])) {
            return new Reference($data['$ref'], $context['document-origin']);
        }
        if (isset($data['$recursiveRef'])) {
            return new Reference($data['$recursiveRef'], $context['document-origin']);
        }
        if (\array_key_exists('file_size_mb', $data) && \is_int($data['file_size_mb'])) {
            $data['file_size_mb'] = (float) $data['file_size_mb'];
        }
        if (\array_key_exists('file_size_mb', $data)) {
            $object->setFileSizeMb($data['file_size_mb']);
            unset($data['file_size_mb']);
        }
        if (\array_key_exists('max_file_size_mb', $data)) {
            $object->setMaxFileSizeMb($data['max_file_size_mb']);
            unset($data['max_file_size_mb']);
        }
        if (\array_key_exists('record_count', $data)) {
            $object->setRecordCount($data['record_count']);
            unset($data['record_count']);
        }
        if (\array_key_exists('max_records', $data)) {
            $object->setMaxRecords($data['max_records']);
            unset($data['max_records']);
        }
        if (\array_key_exists('missing_headers', $data)) {
            $values = [];
            foreach ($data['missing_headers'] as $value) {
                $values[] = $value;
            }
            $object->setMissingHeaders($values);
            unset($data['missing_headers']);
        }
        if (\array_key_exists('found_headers', $data)) {
            $values_1 = [];
            foreach ($data['found_headers'] as $value_1) {
                $values_1[] = $value_1;
            }
            $object->setFoundHeaders($values_1);
            unset($data['found_headers']);
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
        if ($data->isInitialized('fileSizeMb') && null !== $data->getFileSizeMb()) {
            $dataArray['file_size_mb'] = $data->getFileSizeMb();
        }
        if ($data->isInitialized('maxFileSizeMb') && null !== $data->getMaxFileSizeMb()) {
            $dataArray['max_file_size_mb'] = $data->getMaxFileSizeMb();
        }
        if ($data->isInitialized('recordCount') && null !== $data->getRecordCount()) {
            $dataArray['record_count'] = $data->getRecordCount();
        }
        if ($data->isInitialized('maxRecords') && null !== $data->getMaxRecords()) {
            $dataArray['max_records'] = $data->getMaxRecords();
        }
        if ($data->isInitialized('missingHeaders') && null !== $data->getMissingHeaders()) {
            $values = [];
            foreach ($data->getMissingHeaders() as $value) {
                $values[] = $value;
            }
            $dataArray['missing_headers'] = $values;
        }
        if ($data->isInitialized('foundHeaders') && null !== $data->getFoundHeaders()) {
            $values_1 = [];
            foreach ($data->getFoundHeaders() as $value_1) {
                $values_1[] = $value_1;
            }
            $dataArray['found_headers'] = $values_1;
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
        return [\Lenorix\BeelSdk\Generated\Model\CsvImportErrorDetails::class => false];
    }
}