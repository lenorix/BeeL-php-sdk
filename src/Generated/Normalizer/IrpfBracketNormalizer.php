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
class IrpfBracketNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use CheckArray;
    use ValidatorTrait;
    public function supportsDenormalization(mixed $data, string $type, ?string $format = null, array $context = []): bool
    {
        return $type === \Lenorix\BeelSdk\Generated\Model\IrpfBracket::class;
    }
    public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
    {
        return is_object($data) && get_class($data) === \Lenorix\BeelSdk\Generated\Model\IrpfBracket::class;
    }
    public function denormalize(mixed $data, string $type, ?string $format = null, array $context = []): mixed
    {
        $object = new \Lenorix\BeelSdk\Generated\Model\IrpfBracket();
        if (null === $data || false === \is_array($data)) {
            return $object;
        }
        if (isset($data['$ref']) && !isset($data['type']) && !isset($data['properties']) && !isset($data['allOf'])) {
            return new Reference($data['$ref'], $context['document-origin']);
        }
        if (isset($data['$recursiveRef'])) {
            return new Reference($data['$recursiveRef'], $context['document-origin']);
        }
        if (\array_key_exists('base_from', $data) && \is_int($data['base_from'])) {
            $data['base_from'] = (float) $data['base_from'];
        }
        if (\array_key_exists('base_to', $data) && \is_int($data['base_to'])) {
            $data['base_to'] = (float) $data['base_to'];
        }
        if (\array_key_exists('rate_percentage', $data) && \is_int($data['rate_percentage'])) {
            $data['rate_percentage'] = (float) $data['rate_percentage'];
        }
        if (\array_key_exists('applicable_base', $data) && \is_int($data['applicable_base'])) {
            $data['applicable_base'] = (float) $data['applicable_base'];
        }
        if (\array_key_exists('amount', $data) && \is_int($data['amount'])) {
            $data['amount'] = (float) $data['amount'];
        }
        if (\array_key_exists('base_from', $data)) {
            $object->setBaseFrom($data['base_from']);
            unset($data['base_from']);
        }
        if (\array_key_exists('base_to', $data) && $data['base_to'] !== null) {
            $object->setBaseTo($data['base_to']);
            unset($data['base_to']);
        }
        elseif (\array_key_exists('base_to', $data) && $data['base_to'] === null) {
            $object->setBaseTo(null);
            unset($data['base_to']);
        }
        if (\array_key_exists('rate_percentage', $data)) {
            $object->setRatePercentage($data['rate_percentage']);
            unset($data['rate_percentage']);
        }
        if (\array_key_exists('applicable_base', $data)) {
            $object->setApplicableBase($data['applicable_base']);
            unset($data['applicable_base']);
        }
        if (\array_key_exists('amount', $data)) {
            $object->setAmount($data['amount']);
            unset($data['amount']);
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
        $dataArray['base_from'] = $data->getBaseFrom();
        if ($data->isInitialized('baseTo') && null !== $data->getBaseTo()) {
            $dataArray['base_to'] = $data->getBaseTo();
        }
        $dataArray['rate_percentage'] = $data->getRatePercentage();
        $dataArray['applicable_base'] = $data->getApplicableBase();
        $dataArray['amount'] = $data->getAmount();
        foreach ($data->additionalPropertyEntries() as $key => $value) {
            if (preg_match('/.*/', (string) $key)) {
                $dataArray[$key] = $value;
            }
        }
        return $dataArray;
    }
    public function getSupportedTypes(?string $format = null): array
    {
        return [\Lenorix\BeelSdk\Generated\Model\IrpfBracket::class => false];
    }
}