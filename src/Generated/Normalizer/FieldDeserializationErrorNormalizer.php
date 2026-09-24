<?php

namespace Lenorix\BeelSdk\Generated\Normalizer;

use Jane\Component\JsonSchemaRuntime\Reference;
use Lenorix\BeelSdk\Generated\Model\FieldDeserializationError;
use Lenorix\BeelSdk\Generated\Runtime\Normalizer\CheckArray;
use Lenorix\BeelSdk\Generated\Runtime\Normalizer\ValidatorTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class FieldDeserializationErrorNormalizer implements DenormalizerAwareInterface, DenormalizerInterface, NormalizerAwareInterface, NormalizerInterface
{
    use CheckArray;
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use ValidatorTrait;

    public function supportsDenormalization(mixed $data, string $type, ?string $format = null, array $context = []): bool
    {
        return $type === FieldDeserializationError::class;
    }

    public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
    {
        return is_object($data) && get_class($data) === FieldDeserializationError::class;
    }

    public function denormalize(mixed $data, string $type, ?string $format = null, array $context = []): mixed
    {
        $object = new FieldDeserializationError;
        if ($data === null || \is_array($data) === false) {
            return $object;
        }
        if (isset($data['$ref']) && ! isset($data['type']) && ! isset($data['properties']) && ! isset($data['allOf'])) {
            return new Reference($data['$ref'], $context['document-origin']);
        }
        if (isset($data['$recursiveRef'])) {
            return new Reference($data['$recursiveRef'], $context['document-origin']);
        }
        if (\array_key_exists('field', $data)) {
            $object->setField($data['field']);
            unset($data['field']);
        }
        if (\array_key_exists('invalid_value', $data)) {
            $object->setInvalidValue($data['invalid_value']);
            unset($data['invalid_value']);
        }
        if (\array_key_exists('expected_format', $data) && $data['expected_format'] !== null) {
            $object->setExpectedFormat($data['expected_format']);
            unset($data['expected_format']);
        } elseif (\array_key_exists('expected_format', $data) && $data['expected_format'] === null) {
            $object->setExpectedFormat(null);
            unset($data['expected_format']);
        }
        if (\array_key_exists('allowed_values', $data) && $data['allowed_values'] !== null) {
            $object->setAllowedValues($data['allowed_values']);
            unset($data['allowed_values']);
        } elseif (\array_key_exists('allowed_values', $data) && $data['allowed_values'] === null) {
            $object->setAllowedValues(null);
            unset($data['allowed_values']);
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
        $dataArray['field'] = $data->getField();
        $dataArray['invalid_value'] = $data->getInvalidValue();
        if ($data->isInitialized('expectedFormat') && $data->getExpectedFormat() !== null) {
            $dataArray['expected_format'] = $data->getExpectedFormat();
        }
        if ($data->isInitialized('allowedValues') && $data->getAllowedValues() !== null) {
            $dataArray['allowed_values'] = $data->getAllowedValues();
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
        return [FieldDeserializationError::class => false];
    }
}
