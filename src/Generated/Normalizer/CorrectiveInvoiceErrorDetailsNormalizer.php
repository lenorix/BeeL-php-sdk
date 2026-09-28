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
class CorrectiveInvoiceErrorDetailsNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use CheckArray;
    use ValidatorTrait;
    public function supportsDenormalization(mixed $data, string $type, ?string $format = null, array $context = []): bool
    {
        return $type === \Lenorix\BeelSdk\Generated\Model\CorrectiveInvoiceErrorDetails::class;
    }
    public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
    {
        return is_object($data) && get_class($data) === \Lenorix\BeelSdk\Generated\Model\CorrectiveInvoiceErrorDetails::class;
    }
    public function denormalize(mixed $data, string $type, ?string $format = null, array $context = []): mixed
    {
        $object = new \Lenorix\BeelSdk\Generated\Model\CorrectiveInvoiceErrorDetails();
        if (null === $data || false === \is_array($data)) {
            return $object;
        }
        if (isset($data['$ref']) && !isset($data['type']) && !isset($data['properties']) && !isset($data['allOf'])) {
            return new Reference($data['$ref'], $context['document-origin']);
        }
        if (isset($data['$recursiveRef'])) {
            return new Reference($data['$recursiveRef'], $context['document-origin']);
        }
        if (\array_key_exists('tax_group', $data)) {
            $object->setTaxGroup($data['tax_group']);
            unset($data['tax_group']);
        }
        if (\array_key_exists('max_reduction', $data)) {
            $object->setMaxReduction($data['max_reduction']);
            unset($data['max_reduction']);
        }
        if (\array_key_exists('deadline', $data)) {
            $date = \DateTime::createFromFormat('Y-m-d', $data['deadline']);
            if (false === $date) {
                throw new \Lenorix\BeelSdk\Generated\Runtime\Normalizer\InvalidDateException($data['deadline'], 'Y-m-d');
            }
            $object->setDeadline($date->setTime(0, 0, 0));
            unset($data['deadline']);
        }
        if (\array_key_exists('counted_from', $data)) {
            $date_1 = \DateTime::createFromFormat('Y-m-d', $data['counted_from']);
            if (false === $date_1) {
                throw new \Lenorix\BeelSdk\Generated\Runtime\Normalizer\InvalidDateException($data['counted_from'], 'Y-m-d');
            }
            $object->setCountedFrom($date_1->setTime(0, 0, 0));
            unset($data['counted_from']);
        }
        if (\array_key_exists('earliest_date', $data)) {
            $date_2 = \DateTime::createFromFormat('Y-m-d', $data['earliest_date']);
            if (false === $date_2) {
                throw new \Lenorix\BeelSdk\Generated\Runtime\Normalizer\InvalidDateException($data['earliest_date'], 'Y-m-d');
            }
            $object->setEarliestDate($date_2->setTime(0, 0, 0));
            unset($data['earliest_date']);
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
        if ($data->isInitialized('taxGroup') && null !== $data->getTaxGroup()) {
            $dataArray['tax_group'] = $data->getTaxGroup();
        }
        if ($data->isInitialized('maxReduction') && null !== $data->getMaxReduction()) {
            $dataArray['max_reduction'] = $data->getMaxReduction();
        }
        if ($data->isInitialized('deadline') && null !== $data->getDeadline()) {
            $dataArray['deadline'] = $data->getDeadline()->format('Y-m-d');
        }
        if ($data->isInitialized('countedFrom') && null !== $data->getCountedFrom()) {
            $dataArray['counted_from'] = $data->getCountedFrom()->format('Y-m-d');
        }
        if ($data->isInitialized('earliestDate') && null !== $data->getEarliestDate()) {
            $dataArray['earliest_date'] = $data->getEarliestDate()->format('Y-m-d');
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
        return [\Lenorix\BeelSdk\Generated\Model\CorrectiveInvoiceErrorDetails::class => false];
    }
}