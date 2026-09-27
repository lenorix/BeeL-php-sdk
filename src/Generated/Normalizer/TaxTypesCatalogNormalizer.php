<?php

namespace Lenorix\BeelSdk\Generated\Normalizer;

use Jane\Component\JsonSchemaRuntime\Reference;
use Lenorix\BeelSdk\Generated\Model\EquivalenceSurcharge;
use Lenorix\BeelSdk\Generated\Model\ExemptionReasonCatalogEntry;
use Lenorix\BeelSdk\Generated\Model\IrpfType;
use Lenorix\BeelSdk\Generated\Model\TaxRegime;
use Lenorix\BeelSdk\Generated\Model\TaxTypesCatalog;
use Lenorix\BeelSdk\Generated\Runtime\JsonObject;
use Lenorix\BeelSdk\Generated\Runtime\Normalizer\CheckArray;
use Lenorix\BeelSdk\Generated\Runtime\Normalizer\ValidatorTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class TaxTypesCatalogNormalizer implements DenormalizerAwareInterface, DenormalizerInterface, NormalizerAwareInterface, NormalizerInterface
{
    use CheckArray;
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use ValidatorTrait;

    public function supportsDenormalization(mixed $data, string $type, ?string $format = null, array $context = []): bool
    {
        return $type === TaxTypesCatalog::class;
    }

    public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
    {
        return is_object($data) && get_class($data) === TaxTypesCatalog::class;
    }

    public function denormalize(mixed $data, string $type, ?string $format = null, array $context = []): mixed
    {
        $object = new TaxTypesCatalog;
        if ($data === null || \is_array($data) === false) {
            return $object;
        }
        if (isset($data['$ref']) && ! isset($data['type']) && ! isset($data['properties']) && ! isset($data['allOf'])) {
            return new Reference($data['$ref'], $context['document-origin']);
        }
        if (isset($data['$recursiveRef'])) {
            return new Reference($data['$recursiveRef'], $context['document-origin']);
        }
        if (\array_key_exists('tax_regimes', $data)) {
            $values = [];
            foreach ($data['tax_regimes'] as $value) {
                $values[] = $this->denormalizer->denormalize($value, TaxRegime::class, 'json', $context);
            }
            $object->setTaxRegimes($values);
            unset($data['tax_regimes']);
        }
        if (\array_key_exists('irpf_types', $data)) {
            $values_1 = [];
            foreach ($data['irpf_types'] as $value_1) {
                $values_1[] = $this->denormalizer->denormalize($value_1, IrpfType::class, 'json', $context);
            }
            $object->setIrpfTypes($values_1);
            unset($data['irpf_types']);
        }
        if (\array_key_exists('equivalence_surcharges', $data)) {
            $values_2 = [];
            foreach ($data['equivalence_surcharges'] as $value_2) {
                $values_2[] = $this->denormalizer->denormalize($value_2, EquivalenceSurcharge::class, 'json', $context);
            }
            $object->setEquivalenceSurcharges($values_2);
            unset($data['equivalence_surcharges']);
        }
        if (\array_key_exists('exemption_reasons', $data)) {
            $values_3 = [];
            foreach ($data['exemption_reasons'] as $value_3) {
                $values_3[] = $this->denormalizer->denormalize($value_3, ExemptionReasonCatalogEntry::class, 'json', $context);
            }
            $object->setExemptionReasons($values_3);
            unset($data['exemption_reasons']);
        }
        foreach ($data as $key => $value_4) {
            if (preg_match('/.*/', (string) $key)) {
                $object[$key] = $value_4;
            }
        }

        return $object;
    }

    public function normalize(mixed $data, ?string $format = null, array $context = []): array|string|int|float|bool|\ArrayObject|null
    {
        $dataArray = [];
        if ($data->isInitialized('taxRegimes') && $data->getTaxRegimes() !== null) {
            $values = [];
            foreach ($data->getTaxRegimes() as $value) {
                $values[] = $value === null ? null : new JsonObject($this->normalizer->normalize($value, 'json', $context));
            }
            $dataArray['tax_regimes'] = $values;
        }
        if ($data->isInitialized('irpfTypes') && $data->getIrpfTypes() !== null) {
            $values_1 = [];
            foreach ($data->getIrpfTypes() as $value_1) {
                $values_1[] = $value_1 === null ? null : new JsonObject($this->normalizer->normalize($value_1, 'json', $context));
            }
            $dataArray['irpf_types'] = $values_1;
        }
        if ($data->isInitialized('equivalenceSurcharges') && $data->getEquivalenceSurcharges() !== null) {
            $values_2 = [];
            foreach ($data->getEquivalenceSurcharges() as $value_2) {
                $values_2[] = $value_2 === null ? null : new JsonObject($this->normalizer->normalize($value_2, 'json', $context));
            }
            $dataArray['equivalence_surcharges'] = $values_2;
        }
        if ($data->isInitialized('exemptionReasons') && $data->getExemptionReasons() !== null) {
            $values_3 = [];
            foreach ($data->getExemptionReasons() as $value_3) {
                $values_3[] = $value_3 === null ? null : new JsonObject($this->normalizer->normalize($value_3, 'json', $context));
            }
            $dataArray['exemption_reasons'] = $values_3;
        }
        foreach ($data->additionalPropertyEntries() as $key => $value_4) {
            if (preg_match('/.*/', (string) $key)) {
                $dataArray[$key] = $value_4;
            }
        }

        return $dataArray;
    }

    public function getSupportedTypes(?string $format = null): array
    {
        return [TaxTypesCatalog::class => false];
    }
}
