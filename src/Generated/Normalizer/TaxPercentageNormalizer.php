<?php

namespace Lenorix\BeelSdk\Generated\Normalizer;

use Jane\Component\JsonSchemaRuntime\Reference;
use Lenorix\BeelSdk\Generated\Model\TaxPercentage;
use Lenorix\BeelSdk\Generated\Runtime\Normalizer\CheckArray;
use Lenorix\BeelSdk\Generated\Runtime\Normalizer\ValidatorTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class TaxPercentageNormalizer implements DenormalizerAwareInterface, DenormalizerInterface, NormalizerAwareInterface, NormalizerInterface
{
    use CheckArray;
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use ValidatorTrait;

    public function supportsDenormalization(mixed $data, string $type, ?string $format = null, array $context = []): bool
    {
        return $type === TaxPercentage::class;
    }

    public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
    {
        return is_object($data) && get_class($data) === TaxPercentage::class;
    }

    public function denormalize(mixed $data, string $type, ?string $format = null, array $context = []): mixed
    {
        $object = new TaxPercentage;
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
        if (\array_key_exists('associated_equivalence_surcharge', $data) && \is_int($data['associated_equivalence_surcharge'])) {
            $data['associated_equivalence_surcharge'] = (float) $data['associated_equivalence_surcharge'];
        }
        if (\array_key_exists('active', $data) && \is_int($data['active'])) {
            $data['active'] = (bool) $data['active'];
        }
        if (\array_key_exists('percentage', $data)) {
            $object->setPercentage($data['percentage']);
            unset($data['percentage']);
        }
        if (\array_key_exists('description', $data)) {
            $object->setDescription($data['description']);
            unset($data['description']);
        }
        if (\array_key_exists('active', $data)) {
            $object->setActive($data['active']);
            unset($data['active']);
        }
        if (\array_key_exists('associated_equivalence_surcharge', $data) && $data['associated_equivalence_surcharge'] !== null) {
            $object->setAssociatedEquivalenceSurcharge($data['associated_equivalence_surcharge']);
            unset($data['associated_equivalence_surcharge']);
        } elseif (\array_key_exists('associated_equivalence_surcharge', $data) && $data['associated_equivalence_surcharge'] === null) {
            $object->setAssociatedEquivalenceSurcharge(null);
            unset($data['associated_equivalence_surcharge']);
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
        $dataArray['description'] = $data->getDescription();
        $dataArray['active'] = $data->getActive();
        if ($data->isInitialized('associatedEquivalenceSurcharge') && $data->getAssociatedEquivalenceSurcharge() !== null) {
            $dataArray['associated_equivalence_surcharge'] = $data->getAssociatedEquivalenceSurcharge();
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
        return [TaxPercentage::class => false];
    }
}
