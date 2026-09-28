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
class CustomerValidationStatisticsNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use CheckArray;
    use ValidatorTrait;
    public function supportsDenormalization(mixed $data, string $type, ?string $format = null, array $context = []): bool
    {
        return $type === \Lenorix\BeelSdk\Generated\Model\CustomerValidationStatistics::class;
    }
    public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
    {
        return is_object($data) && get_class($data) === \Lenorix\BeelSdk\Generated\Model\CustomerValidationStatistics::class;
    }
    public function denormalize(mixed $data, string $type, ?string $format = null, array $context = []): mixed
    {
        $object = new \Lenorix\BeelSdk\Generated\Model\CustomerValidationStatistics();
        if (null === $data || false === \is_array($data)) {
            return $object;
        }
        if (isset($data['$ref']) && !isset($data['type']) && !isset($data['properties']) && !isset($data['allOf'])) {
            return new Reference($data['$ref'], $context['document-origin']);
        }
        if (isset($data['$recursiveRef'])) {
            return new Reference($data['$recursiveRef'], $context['document-origin']);
        }
        if (\array_key_exists('success_rate', $data) && \is_int($data['success_rate'])) {
            $data['success_rate'] = (float) $data['success_rate'];
        }
        if (\array_key_exists('total_processed', $data)) {
            $object->setTotalProcessed($data['total_processed']);
            unset($data['total_processed']);
        }
        if (\array_key_exists('valid', $data)) {
            $object->setValid($data['valid']);
            unset($data['valid']);
        }
        if (\array_key_exists('with_warnings', $data)) {
            $object->setWithWarnings($data['with_warnings']);
            unset($data['with_warnings']);
        }
        if (\array_key_exists('with_errors', $data)) {
            $object->setWithErrors($data['with_errors']);
            unset($data['with_errors']);
        }
        if (\array_key_exists('duplicates', $data)) {
            $object->setDuplicates($data['duplicates']);
            unset($data['duplicates']);
        }
        if (\array_key_exists('invalid_nifs', $data)) {
            $object->setInvalidNifs($data['invalid_nifs']);
            unset($data['invalid_nifs']);
        }
        if (\array_key_exists('imported', $data)) {
            $object->setImported($data['imported']);
            unset($data['imported']);
        }
        if (\array_key_exists('success_rate', $data)) {
            $object->setSuccessRate($data['success_rate']);
            unset($data['success_rate']);
        }
        if (\array_key_exists('importable', $data)) {
            $object->setImportable($data['importable']);
            unset($data['importable']);
        }
        if (\array_key_exists('not_importable', $data)) {
            $object->setNotImportable($data['not_importable']);
            unset($data['not_importable']);
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
        $dataArray['total_processed'] = $data->getTotalProcessed();
        $dataArray['valid'] = $data->getValid();
        $dataArray['with_warnings'] = $data->getWithWarnings();
        $dataArray['with_errors'] = $data->getWithErrors();
        $dataArray['duplicates'] = $data->getDuplicates();
        $dataArray['invalid_nifs'] = $data->getInvalidNifs();
        $dataArray['imported'] = $data->getImported();
        $dataArray['success_rate'] = $data->getSuccessRate();
        if ($data->isInitialized('importable') && null !== $data->getImportable()) {
            $dataArray['importable'] = $data->getImportable();
        }
        if ($data->isInitialized('notImportable') && null !== $data->getNotImportable()) {
            $dataArray['not_importable'] = $data->getNotImportable();
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
        return [\Lenorix\BeelSdk\Generated\Model\CustomerValidationStatistics::class => false];
    }
}