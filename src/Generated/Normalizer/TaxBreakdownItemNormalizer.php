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
class TaxBreakdownItemNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use CheckArray;
    use ValidatorTrait;
    public function supportsDenormalization(mixed $data, string $type, ?string $format = null, array $context = []): bool
    {
        return $type === \Lenorix\BeelSdk\Generated\Model\TaxBreakdownItem::class;
    }
    public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
    {
        return is_object($data) && get_class($data) === \Lenorix\BeelSdk\Generated\Model\TaxBreakdownItem::class;
    }
    public function denormalize(mixed $data, string $type, ?string $format = null, array $context = []): mixed
    {
        $object = new \Lenorix\BeelSdk\Generated\Model\TaxBreakdownItem();
        if (null === $data || false === \is_array($data)) {
            return $object;
        }
        if (isset($data['$ref']) && !isset($data['type']) && !isset($data['properties']) && !isset($data['allOf'])) {
            return new Reference($data['$ref'], $context['document-origin']);
        }
        if (isset($data['$recursiveRef'])) {
            return new Reference($data['$recursiveRef'], $context['document-origin']);
        }
        if (\array_key_exists('percentage', $data) && \is_int($data['percentage'])) {
            $data['percentage'] = (float) $data['percentage'];
        }
        if (\array_key_exists('taxable_base', $data) && \is_int($data['taxable_base'])) {
            $data['taxable_base'] = (float) $data['taxable_base'];
        }
        if (\array_key_exists('tax_amount', $data) && \is_int($data['tax_amount'])) {
            $data['tax_amount'] = (float) $data['tax_amount'];
        }
        if (\array_key_exists('tax_type', $data)) {
            $object->setTaxType($data['tax_type']);
            unset($data['tax_type']);
        }
        if (\array_key_exists('percentage', $data)) {
            $object->setPercentage($data['percentage']);
            unset($data['percentage']);
        }
        if (\array_key_exists('taxable_base', $data)) {
            $object->setTaxableBase($data['taxable_base']);
            unset($data['taxable_base']);
        }
        if (\array_key_exists('tax_amount', $data)) {
            $object->setTaxAmount($data['tax_amount']);
            unset($data['tax_amount']);
        }
        if (\array_key_exists('regime_key', $data)) {
            $object->setRegimeKey($data['regime_key']);
            unset($data['regime_key']);
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
        $dataArray['tax_type'] = $data->getTaxType();
        $dataArray['percentage'] = $data->getPercentage();
        $dataArray['taxable_base'] = $data->getTaxableBase();
        $dataArray['tax_amount'] = $data->getTaxAmount();
        if ($data->isInitialized('regimeKey') && null !== $data->getRegimeKey()) {
            $dataArray['regime_key'] = $data->getRegimeKey();
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
        return [\Lenorix\BeelSdk\Generated\Model\TaxBreakdownItem::class => false];
    }
}