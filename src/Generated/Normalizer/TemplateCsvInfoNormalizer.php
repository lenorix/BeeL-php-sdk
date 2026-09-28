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
class TemplateCsvInfoNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use CheckArray;
    use ValidatorTrait;
    public function supportsDenormalization(mixed $data, string $type, ?string $format = null, array $context = []): bool
    {
        return $type === \Lenorix\BeelSdk\Generated\Model\TemplateCsvInfo::class;
    }
    public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
    {
        return is_object($data) && get_class($data) === \Lenorix\BeelSdk\Generated\Model\TemplateCsvInfo::class;
    }
    public function denormalize(mixed $data, string $type, ?string $format = null, array $context = []): mixed
    {
        $object = new \Lenorix\BeelSdk\Generated\Model\TemplateCsvInfo();
        if (null === $data || false === \is_array($data)) {
            return $object;
        }
        if (isset($data['$ref']) && !isset($data['type']) && !isset($data['properties']) && !isset($data['allOf'])) {
            return new Reference($data['$ref'], $context['document-origin']);
        }
        if (isset($data['$recursiveRef'])) {
            return new Reference($data['$recursiveRef'], $context['document-origin']);
        }
        if (\array_key_exists('max_file_size_mb', $data) && \is_int($data['max_file_size_mb'])) {
            $data['max_file_size_mb'] = (float) $data['max_file_size_mb'];
        }
        if (\array_key_exists('filename', $data)) {
            $object->setFilename($data['filename']);
            unset($data['filename']);
        }
        if (\array_key_exists('headers', $data)) {
            $values = [];
            foreach ($data['headers'] as $value) {
                $values[] = $value;
            }
            $object->setHeaders($values);
            unset($data['headers']);
        }
        if (\array_key_exists('example_rows', $data)) {
            $object->setExampleRows($data['example_rows']);
            unset($data['example_rows']);
        }
        if (\array_key_exists('max_records', $data)) {
            $object->setMaxRecords($data['max_records']);
            unset($data['max_records']);
        }
        if (\array_key_exists('max_file_size_mb', $data)) {
            $object->setMaxFileSizeMb($data['max_file_size_mb']);
            unset($data['max_file_size_mb']);
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
        $dataArray['filename'] = $data->getFilename();
        $values = [];
        foreach ($data->getHeaders() as $value) {
            $values[] = $value;
        }
        $dataArray['headers'] = $values;
        $dataArray['example_rows'] = $data->getExampleRows();
        if ($data->isInitialized('maxRecords') && null !== $data->getMaxRecords()) {
            $dataArray['max_records'] = $data->getMaxRecords();
        }
        if ($data->isInitialized('maxFileSizeMb') && null !== $data->getMaxFileSizeMb()) {
            $dataArray['max_file_size_mb'] = $data->getMaxFileSizeMb();
        }
        foreach ($data->additionalPropertyEntries() as $key => $value_1) {
            if (preg_match('/.*/', (string) $key)) {
                $dataArray[$key] = $value_1;
            }
        }
        return $dataArray;
    }
    public function getSupportedTypes(?string $format = null): array
    {
        return [\Lenorix\BeelSdk\Generated\Model\TemplateCsvInfo::class => false];
    }
}