<?php

namespace Lenorix\BeelSdk\Generated\Normalizer;

use Jane\Component\JsonSchemaRuntime\Reference;
use Lenorix\BeelSdk\Generated\Model\CompanyNumbering;
use Lenorix\BeelSdk\Generated\Model\CompanySeriesNumbering;
use Lenorix\BeelSdk\Generated\Runtime\JsonObject;
use Lenorix\BeelSdk\Generated\Runtime\Normalizer\CheckArray;
use Lenorix\BeelSdk\Generated\Runtime\Normalizer\ValidatorTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class CompanyNumberingNormalizer implements DenormalizerAwareInterface, DenormalizerInterface, NormalizerAwareInterface, NormalizerInterface
{
    use CheckArray;
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use ValidatorTrait;

    public function supportsDenormalization(mixed $data, string $type, ?string $format = null, array $context = []): bool
    {
        return $type === CompanyNumbering::class;
    }

    public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
    {
        return is_object($data) && get_class($data) === CompanyNumbering::class;
    }

    public function denormalize(mixed $data, string $type, ?string $format = null, array $context = []): mixed
    {
        $object = new CompanyNumbering;
        if ($data === null || \is_array($data) === false) {
            return $object;
        }
        if (isset($data['$ref']) && ! isset($data['type']) && ! isset($data['properties']) && ! isset($data['allOf'])) {
            return new Reference($data['$ref'], $context['document-origin']);
        }
        if (isset($data['$recursiveRef'])) {
            return new Reference($data['$recursiveRef'], $context['document-origin']);
        }
        if (\array_key_exists('code', $data)) {
            $object->setCode($data['code']);
            unset($data['code']);
        }
        if (\array_key_exists('initial_number', $data)) {
            $object->setInitialNumber($data['initial_number']);
            unset($data['initial_number']);
        }
        if (\array_key_exists('format', $data)) {
            $object->setFormat($data['format']);
            unset($data['format']);
        }
        if (\array_key_exists('counter_reset', $data)) {
            $object->setCounterReset($data['counter_reset']);
            unset($data['counter_reset']);
        }
        if (\array_key_exists('simplified', $data)) {
            $object->setSimplified($this->denormalizer->denormalize($data['simplified'], CompanySeriesNumbering::class, 'json', $context));
            unset($data['simplified']);
        }
        if (\array_key_exists('corrective', $data)) {
            $object->setCorrective($this->denormalizer->denormalize($data['corrective'], CompanySeriesNumbering::class, 'json', $context));
            unset($data['corrective']);
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
        if ($data->isInitialized('initialNumber') && $data->getInitialNumber() !== null) {
            $dataArray['initial_number'] = $data->getInitialNumber();
        }
        if ($data->isInitialized('format') && $data->getFormat() !== null) {
            $dataArray['format'] = $data->getFormat();
        }
        if ($data->isInitialized('counterReset') && $data->getCounterReset() !== null) {
            $dataArray['counter_reset'] = $data->getCounterReset();
        }
        if ($data->isInitialized('simplified') && $data->getSimplified() !== null) {
            $dataArray['simplified'] = $data->getSimplified() === null ? null : new JsonObject($this->normalizer->normalize($data->getSimplified(), 'json', $context));
        }
        if ($data->isInitialized('corrective') && $data->getCorrective() !== null) {
            $dataArray['corrective'] = $data->getCorrective() === null ? null : new JsonObject($this->normalizer->normalize($data->getCorrective(), 'json', $context));
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
        return [CompanyNumbering::class => false];
    }
}
