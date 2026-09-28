<?php

namespace Lenorix\BeelSdk\Generated\Normalizer;

use Jane\Component\JsonSchemaRuntime\Reference;
use Lenorix\BeelSdk\Generated\Model\TaxPercentage;
use Lenorix\BeelSdk\Generated\Model\TaxRegime;
use Lenorix\BeelSdk\Generated\Model\VeriFactuRegimeKey;
use Lenorix\BeelSdk\Generated\Runtime\JsonObject;
use Lenorix\BeelSdk\Generated\Runtime\Normalizer\CheckArray;
use Lenorix\BeelSdk\Generated\Runtime\Normalizer\ValidatorTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class TaxRegimeNormalizer implements DenormalizerAwareInterface, DenormalizerInterface, NormalizerAwareInterface, NormalizerInterface
{
    use CheckArray;
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use ValidatorTrait;

    public function supportsDenormalization(mixed $data, string $type, ?string $format = null, array $context = []): bool
    {
        return $type === TaxRegime::class;
    }

    public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
    {
        return is_object($data) && get_class($data) === TaxRegime::class;
    }

    public function denormalize(mixed $data, string $type, ?string $format = null, array $context = []): mixed
    {
        $object = new TaxRegime;
        if ($data === null || \is_array($data) === false) {
            return $object;
        }
        if (isset($data['$ref']) && ! isset($data['type']) && ! isset($data['properties']) && ! isset($data['allOf'])) {
            return new Reference($data['$ref'], $context['document-origin']);
        }
        if (isset($data['$recursiveRef'])) {
            return new Reference($data['$recursiveRef'], $context['document-origin']);
        }
        if (\array_key_exists('applies_equivalence_surcharge', $data) && \is_int($data['applies_equivalence_surcharge'])) {
            $data['applies_equivalence_surcharge'] = (bool) $data['applies_equivalence_surcharge'];
        }
        if (\array_key_exists('code', $data)) {
            $object->setCode($data['code']);
            unset($data['code']);
        }
        if (\array_key_exists('name', $data)) {
            $object->setName($data['name']);
            unset($data['name']);
        }
        if (\array_key_exists('description', $data)) {
            $object->setDescription($data['description']);
            unset($data['description']);
        }
        if (\array_key_exists('tax_rates', $data)) {
            $values = [];
            foreach ($data['tax_rates'] as $value) {
                $values[] = $this->denormalizer->denormalize($value, TaxPercentage::class, 'json', $context);
            }
            $object->setTaxRates($values);
            unset($data['tax_rates']);
        }
        if (\array_key_exists('applies_equivalence_surcharge', $data)) {
            $object->setAppliesEquivalenceSurcharge($data['applies_equivalence_surcharge']);
            unset($data['applies_equivalence_surcharge']);
        }
        if (\array_key_exists('regime_keys', $data)) {
            $values_1 = [];
            foreach ($data['regime_keys'] as $value_1) {
                $values_1[] = $this->denormalizer->denormalize($value_1, VeriFactuRegimeKey::class, 'json', $context);
            }
            $object->setRegimeKeys($values_1);
            unset($data['regime_keys']);
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
        $dataArray['code'] = $data->getCode();
        $dataArray['name'] = $data->getName();
        $dataArray['description'] = $data->getDescription();
        $values = [];
        foreach ($data->getTaxRates() as $value) {
            $values[] = $value === null ? null : new JsonObject($this->normalizer->normalize($value, 'json', $context));
        }
        $dataArray['tax_rates'] = $values;
        $dataArray['applies_equivalence_surcharge'] = $data->getAppliesEquivalenceSurcharge();
        $values_1 = [];
        foreach ($data->getRegimeKeys() as $value_1) {
            $values_1[] = $value_1 === null ? null : new JsonObject($this->normalizer->normalize($value_1, 'json', $context));
        }
        $dataArray['regime_keys'] = $values_1;
        foreach ($data->additionalPropertyEntries() as $key => $value_2) {
            if (preg_match('/.*/', (string) $key)) {
                $dataArray[$key] = $value_2;
            }
        }

        return $dataArray;
    }

    public function getSupportedTypes(?string $format = null): array
    {
        return [TaxRegime::class => false];
    }
}
