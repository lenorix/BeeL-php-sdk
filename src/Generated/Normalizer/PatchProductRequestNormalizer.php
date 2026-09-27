<?php

namespace Lenorix\BeelSdk\Generated\Normalizer;

use Jane\Component\JsonSchemaRuntime\Reference;
use Lenorix\BeelSdk\Generated\Model\PatchProductRequest;
use Lenorix\BeelSdk\Generated\Model\PatchProductRequestMainTax;
use Lenorix\BeelSdk\Generated\Runtime\JsonObject;
use Lenorix\BeelSdk\Generated\Runtime\Normalizer\CheckArray;
use Lenorix\BeelSdk\Generated\Runtime\Normalizer\ValidatorTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class PatchProductRequestNormalizer implements DenormalizerAwareInterface, DenormalizerInterface, NormalizerAwareInterface, NormalizerInterface
{
    use CheckArray;
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use ValidatorTrait;

    public function supportsDenormalization(mixed $data, string $type, ?string $format = null, array $context = []): bool
    {
        return $type === PatchProductRequest::class;
    }

    public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
    {
        return is_object($data) && get_class($data) === PatchProductRequest::class;
    }

    public function denormalize(mixed $data, string $type, ?string $format = null, array $context = []): mixed
    {
        $object = new PatchProductRequest;
        if ($data === null || \is_array($data) === false) {
            return $object;
        }
        if (isset($data['$ref']) && ! isset($data['type']) && ! isset($data['properties']) && ! isset($data['allOf'])) {
            return new Reference($data['$ref'], $context['document-origin']);
        }
        if (isset($data['$recursiveRef'])) {
            return new Reference($data['$recursiveRef'], $context['document-origin']);
        }
        if (\array_key_exists('default_price', $data) && \is_int($data['default_price'])) {
            $data['default_price'] = (float) $data['default_price'];
        }
        if (\array_key_exists('equivalence_surcharge_rate', $data) && \is_int($data['equivalence_surcharge_rate'])) {
            $data['equivalence_surcharge_rate'] = (float) $data['equivalence_surcharge_rate'];
        }
        if (\array_key_exists('irpf_rate', $data) && \is_int($data['irpf_rate'])) {
            $data['irpf_rate'] = (float) $data['irpf_rate'];
        }
        if (\array_key_exists('active', $data) && \is_int($data['active'])) {
            $data['active'] = (bool) $data['active'];
        }
        if (\array_key_exists('code', $data) && $data['code'] !== null) {
            $object->setCode($data['code']);
            unset($data['code']);
        } elseif (\array_key_exists('code', $data) && $data['code'] === null) {
            $object->setCode(null);
            unset($data['code']);
        }
        if (\array_key_exists('name', $data)) {
            $object->setName($data['name']);
            unset($data['name']);
        }
        if (\array_key_exists('description', $data) && $data['description'] !== null) {
            $object->setDescription($data['description']);
            unset($data['description']);
        } elseif (\array_key_exists('description', $data) && $data['description'] === null) {
            $object->setDescription(null);
            unset($data['description']);
        }
        if (\array_key_exists('category', $data)) {
            $object->setCategory($data['category']);
            unset($data['category']);
        }
        if (\array_key_exists('default_price', $data) && $data['default_price'] !== null) {
            $object->setDefaultPrice($data['default_price']);
            unset($data['default_price']);
        } elseif (\array_key_exists('default_price', $data) && $data['default_price'] === null) {
            $object->setDefaultPrice(null);
            unset($data['default_price']);
        }
        if (\array_key_exists('unit', $data) && $data['unit'] !== null) {
            $object->setUnit($data['unit']);
            unset($data['unit']);
        } elseif (\array_key_exists('unit', $data) && $data['unit'] === null) {
            $object->setUnit(null);
            unset($data['unit']);
        }
        if (\array_key_exists('main_tax', $data)) {
            $object->setMainTax($this->denormalizer->denormalize($data['main_tax'], PatchProductRequestMainTax::class, 'json', $context));
            unset($data['main_tax']);
        }
        if (\array_key_exists('equivalence_surcharge_rate', $data) && $data['equivalence_surcharge_rate'] !== null) {
            $object->setEquivalenceSurchargeRate($data['equivalence_surcharge_rate']);
            unset($data['equivalence_surcharge_rate']);
        } elseif (\array_key_exists('equivalence_surcharge_rate', $data) && $data['equivalence_surcharge_rate'] === null) {
            $object->setEquivalenceSurchargeRate(null);
            unset($data['equivalence_surcharge_rate']);
        }
        if (\array_key_exists('irpf_rate', $data) && $data['irpf_rate'] !== null) {
            $object->setIrpfRate($data['irpf_rate']);
            unset($data['irpf_rate']);
        } elseif (\array_key_exists('irpf_rate', $data) && $data['irpf_rate'] === null) {
            $object->setIrpfRate(null);
            unset($data['irpf_rate']);
        }
        if (\array_key_exists('active', $data)) {
            $object->setActive($data['active']);
            unset($data['active']);
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
        if ($data->isInitialized('code') && $data->getCode() !== null) {
            $dataArray['code'] = $data->getCode();
        }
        if ($data->isInitialized('name') && $data->getName() !== null) {
            $dataArray['name'] = $data->getName();
        }
        if ($data->isInitialized('description') && $data->getDescription() !== null) {
            $dataArray['description'] = $data->getDescription();
        }
        if ($data->isInitialized('category') && $data->getCategory() !== null) {
            $dataArray['category'] = $data->getCategory();
        }
        if ($data->isInitialized('defaultPrice') && $data->getDefaultPrice() !== null) {
            $dataArray['default_price'] = $data->getDefaultPrice();
        }
        if ($data->isInitialized('unit') && $data->getUnit() !== null) {
            $dataArray['unit'] = $data->getUnit();
        }
        if ($data->isInitialized('mainTax') && $data->getMainTax() !== null) {
            $dataArray['main_tax'] = $data->getMainTax() === null ? null : new JsonObject($this->normalizer->normalize($data->getMainTax(), 'json', $context));
        }
        if ($data->isInitialized('equivalenceSurchargeRate') && $data->getEquivalenceSurchargeRate() !== null) {
            $dataArray['equivalence_surcharge_rate'] = $data->getEquivalenceSurchargeRate();
        }
        if ($data->isInitialized('irpfRate') && $data->getIrpfRate() !== null) {
            $dataArray['irpf_rate'] = $data->getIrpfRate();
        }
        if ($data->isInitialized('active') && $data->getActive() !== null) {
            $dataArray['active'] = $data->getActive();
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
        return [PatchProductRequest::class => false];
    }
}
