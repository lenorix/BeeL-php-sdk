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
class PatchProductRequestNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use CheckArray;
    use ValidatorTrait;
    public function supportsDenormalization(mixed $data, string $type, ?string $format = null, array $context = []): bool
    {
        return $type === \Lenorix\BeelSdk\Generated\Model\PatchProductRequest::class;
    }
    public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
    {
        return is_object($data) && get_class($data) === \Lenorix\BeelSdk\Generated\Model\PatchProductRequest::class;
    }
    public function denormalize(mixed $data, string $type, ?string $format = null, array $context = []): mixed
    {
        $object = new \Lenorix\BeelSdk\Generated\Model\PatchProductRequest();
        if (null === $data || false === \is_array($data)) {
            return $object;
        }
        if (isset($data['$ref']) && !isset($data['type']) && !isset($data['properties']) && !isset($data['allOf'])) {
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
        }
        elseif (\array_key_exists('code', $data) && $data['code'] === null) {
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
        }
        elseif (\array_key_exists('description', $data) && $data['description'] === null) {
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
        }
        elseif (\array_key_exists('default_price', $data) && $data['default_price'] === null) {
            $object->setDefaultPrice(null);
            unset($data['default_price']);
        }
        if (\array_key_exists('unit', $data) && $data['unit'] !== null) {
            $object->setUnit($data['unit']);
            unset($data['unit']);
        }
        elseif (\array_key_exists('unit', $data) && $data['unit'] === null) {
            $object->setUnit(null);
            unset($data['unit']);
        }
        if (\array_key_exists('main_tax', $data)) {
            $object->setMainTax($this->denormalizer->denormalize($data['main_tax'], \Lenorix\BeelSdk\Generated\Model\PatchProductRequestMainTax::class, 'json', $context));
            unset($data['main_tax']);
        }
        if (\array_key_exists('equivalence_surcharge_rate', $data) && $data['equivalence_surcharge_rate'] !== null) {
            $object->setEquivalenceSurchargeRate($data['equivalence_surcharge_rate']);
            unset($data['equivalence_surcharge_rate']);
        }
        elseif (\array_key_exists('equivalence_surcharge_rate', $data) && $data['equivalence_surcharge_rate'] === null) {
            $object->setEquivalenceSurchargeRate(null);
            unset($data['equivalence_surcharge_rate']);
        }
        if (\array_key_exists('irpf_rate', $data) && $data['irpf_rate'] !== null) {
            $object->setIrpfRate($data['irpf_rate']);
            unset($data['irpf_rate']);
        }
        elseif (\array_key_exists('irpf_rate', $data) && $data['irpf_rate'] === null) {
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
        if ($data->isInitialized('code') && null !== $data->getCode()) {
            $dataArray['code'] = $data->getCode();
        }
        if ($data->isInitialized('name') && null !== $data->getName()) {
            $dataArray['name'] = $data->getName();
        }
        if ($data->isInitialized('description') && null !== $data->getDescription()) {
            $dataArray['description'] = $data->getDescription();
        }
        if ($data->isInitialized('category') && null !== $data->getCategory()) {
            $dataArray['category'] = $data->getCategory();
        }
        if ($data->isInitialized('defaultPrice') && null !== $data->getDefaultPrice()) {
            $dataArray['default_price'] = $data->getDefaultPrice();
        }
        if ($data->isInitialized('unit') && null !== $data->getUnit()) {
            $dataArray['unit'] = $data->getUnit();
        }
        if ($data->isInitialized('mainTax') && null !== $data->getMainTax()) {
            $dataArray['main_tax'] = $data->getMainTax() === null ? null : new \Lenorix\BeelSdk\Generated\Runtime\JsonObject($this->normalizer->normalize($data->getMainTax(), 'json', $context));
        }
        if ($data->isInitialized('equivalenceSurchargeRate') && null !== $data->getEquivalenceSurchargeRate()) {
            $dataArray['equivalence_surcharge_rate'] = $data->getEquivalenceSurchargeRate();
        }
        if ($data->isInitialized('irpfRate') && null !== $data->getIrpfRate()) {
            $dataArray['irpf_rate'] = $data->getIrpfRate();
        }
        if ($data->isInitialized('active') && null !== $data->getActive()) {
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
        return [\Lenorix\BeelSdk\Generated\Model\PatchProductRequest::class => false];
    }
}