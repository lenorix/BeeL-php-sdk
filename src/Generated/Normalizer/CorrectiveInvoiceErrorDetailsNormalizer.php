<?php

namespace Lenorix\BeelSdk\Generated\Normalizer;

use Jane\Component\JsonSchemaRuntime\Reference;
use Lenorix\BeelSdk\Generated\Model\CorrectiveInvoiceErrorDetails;
use Lenorix\BeelSdk\Generated\Runtime\Normalizer\CheckArray;
use Lenorix\BeelSdk\Generated\Runtime\Normalizer\InvalidDateException;
use Lenorix\BeelSdk\Generated\Runtime\Normalizer\ValidatorTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class CorrectiveInvoiceErrorDetailsNormalizer implements DenormalizerAwareInterface, DenormalizerInterface, NormalizerAwareInterface, NormalizerInterface
{
    use CheckArray;
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use ValidatorTrait;

    public function supportsDenormalization(mixed $data, string $type, ?string $format = null, array $context = []): bool
    {
        return $type === CorrectiveInvoiceErrorDetails::class;
    }

    public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
    {
        return is_object($data) && get_class($data) === CorrectiveInvoiceErrorDetails::class;
    }

    public function denormalize(mixed $data, string $type, ?string $format = null, array $context = []): mixed
    {
        $object = new CorrectiveInvoiceErrorDetails;
        if ($data === null || \is_array($data) === false) {
            return $object;
        }
        if (isset($data['$ref']) && ! isset($data['type']) && ! isset($data['properties']) && ! isset($data['allOf'])) {
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
            if ($date === false) {
                throw new InvalidDateException($data['deadline'], 'Y-m-d');
            }
            $object->setDeadline($date->setTime(0, 0, 0));
            unset($data['deadline']);
        }
        if (\array_key_exists('counted_from', $data)) {
            $date_1 = \DateTime::createFromFormat('Y-m-d', $data['counted_from']);
            if ($date_1 === false) {
                throw new InvalidDateException($data['counted_from'], 'Y-m-d');
            }
            $object->setCountedFrom($date_1->setTime(0, 0, 0));
            unset($data['counted_from']);
        }
        if (\array_key_exists('earliest_date', $data)) {
            $date_2 = \DateTime::createFromFormat('Y-m-d', $data['earliest_date']);
            if ($date_2 === false) {
                throw new InvalidDateException($data['earliest_date'], 'Y-m-d');
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
        if ($data->isInitialized('taxGroup') && $data->getTaxGroup() !== null) {
            $dataArray['tax_group'] = $data->getTaxGroup();
        }
        if ($data->isInitialized('maxReduction') && $data->getMaxReduction() !== null) {
            $dataArray['max_reduction'] = $data->getMaxReduction();
        }
        if ($data->isInitialized('deadline') && $data->getDeadline() !== null) {
            $dataArray['deadline'] = $data->getDeadline()->format('Y-m-d');
        }
        if ($data->isInitialized('countedFrom') && $data->getCountedFrom() !== null) {
            $dataArray['counted_from'] = $data->getCountedFrom()->format('Y-m-d');
        }
        if ($data->isInitialized('earliestDate') && $data->getEarliestDate() !== null) {
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
        return [CorrectiveInvoiceErrorDetails::class => false];
    }
}
