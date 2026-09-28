<?php

namespace Lenorix\BeelSdk\Generated\Normalizer;

use Jane\Component\JsonSchemaRuntime\Reference;
use Lenorix\BeelSdk\Generated\Model\EquivalenceSurcharge;
use Lenorix\BeelSdk\Generated\Runtime\Normalizer\CheckArray;
use Lenorix\BeelSdk\Generated\Runtime\Normalizer\InvalidDateException;
use Lenorix\BeelSdk\Generated\Runtime\Normalizer\ValidatorTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class EquivalenceSurchargeNormalizer implements DenormalizerAwareInterface, DenormalizerInterface, NormalizerAwareInterface, NormalizerInterface
{
    use CheckArray;
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use ValidatorTrait;

    public function supportsDenormalization(mixed $data, string $type, ?string $format = null, array $context = []): bool
    {
        return $type === EquivalenceSurcharge::class;
    }

    public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
    {
        return is_object($data) && get_class($data) === EquivalenceSurcharge::class;
    }

    public function denormalize(mixed $data, string $type, ?string $format = null, array $context = []): mixed
    {
        $object = new EquivalenceSurcharge;
        if ($data === null || \is_array($data) === false) {
            return $object;
        }
        if (isset($data['$ref']) && ! isset($data['type']) && ! isset($data['properties']) && ! isset($data['allOf'])) {
            return new Reference($data['$ref'], $context['document-origin']);
        }
        if (isset($data['$recursiveRef'])) {
            return new Reference($data['$recursiveRef'], $context['document-origin']);
        }
        if (\array_key_exists('percentage', $data) && \is_int($data['percentage'])) {
            $data['percentage'] = (float) $data['percentage'];
        }
        if (\array_key_exists('associated_vat', $data) && \is_int($data['associated_vat'])) {
            $data['associated_vat'] = (float) $data['associated_vat'];
        }
        if (\array_key_exists('active', $data) && \is_int($data['active'])) {
            $data['active'] = (bool) $data['active'];
        }
        if (\array_key_exists('percentage', $data)) {
            $object->setPercentage($data['percentage']);
            unset($data['percentage']);
        }
        if (\array_key_exists('associated_vat', $data)) {
            $object->setAssociatedVat($data['associated_vat']);
            unset($data['associated_vat']);
        }
        if (\array_key_exists('description', $data)) {
            $object->setDescription($data['description']);
            unset($data['description']);
        }
        if (\array_key_exists('active', $data)) {
            $object->setActive($data['active']);
            unset($data['active']);
        }
        if (\array_key_exists('valid_from', $data) && $data['valid_from'] !== null) {
            $date = \DateTime::createFromFormat('Y-m-d', $data['valid_from']);
            if ($date === false) {
                throw new InvalidDateException($data['valid_from'], 'Y-m-d');
            }
            $object->setValidFrom($date->setTime(0, 0, 0));
            unset($data['valid_from']);
        } elseif (\array_key_exists('valid_from', $data) && $data['valid_from'] === null) {
            $object->setValidFrom(null);
            unset($data['valid_from']);
        }
        if (\array_key_exists('valid_until', $data) && $data['valid_until'] !== null) {
            $date_1 = \DateTime::createFromFormat('Y-m-d', $data['valid_until']);
            if ($date_1 === false) {
                throw new InvalidDateException($data['valid_until'], 'Y-m-d');
            }
            $object->setValidUntil($date_1->setTime(0, 0, 0));
            unset($data['valid_until']);
        } elseif (\array_key_exists('valid_until', $data) && $data['valid_until'] === null) {
            $object->setValidUntil(null);
            unset($data['valid_until']);
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
        $dataArray['percentage'] = $data->getPercentage();
        $dataArray['associated_vat'] = $data->getAssociatedVat();
        $dataArray['description'] = $data->getDescription();
        $dataArray['active'] = $data->getActive();
        if ($data->isInitialized('validFrom') && $data->getValidFrom() !== null) {
            $dataArray['valid_from'] = $data->getValidFrom()?->format('Y-m-d');
        }
        if ($data->isInitialized('validUntil') && $data->getValidUntil() !== null) {
            $dataArray['valid_until'] = $data->getValidUntil()?->format('Y-m-d');
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
        return [EquivalenceSurcharge::class => false];
    }
}
