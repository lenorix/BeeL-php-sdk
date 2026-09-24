<?php

namespace Lenorix\BeelSdk\Generated\Normalizer;

use Jane\Component\JsonSchemaRuntime\Reference;
use Lenorix\BeelSdk\Generated\Model\CompanyDataReadiness;
use Lenorix\BeelSdk\Generated\Model\IssuingReadinessDataVerifactu;
use Lenorix\BeelSdk\Generated\Runtime\JsonObject;
use Lenorix\BeelSdk\Generated\Runtime\Normalizer\CheckArray;
use Lenorix\BeelSdk\Generated\Runtime\Normalizer\ValidatorTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class CompanyDataReadinessNormalizer implements DenormalizerAwareInterface, DenormalizerInterface, NormalizerAwareInterface, NormalizerInterface
{
    use CheckArray;
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use ValidatorTrait;

    public function supportsDenormalization(mixed $data, string $type, ?string $format = null, array $context = []): bool
    {
        return $type === CompanyDataReadiness::class;
    }

    public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
    {
        return is_object($data) && get_class($data) === CompanyDataReadiness::class;
    }

    public function denormalize(mixed $data, string $type, ?string $format = null, array $context = []): mixed
    {
        $object = new CompanyDataReadiness;
        if ($data === null || \is_array($data) === false) {
            return $object;
        }
        if (isset($data['$ref']) && ! isset($data['type']) && ! isset($data['properties']) && ! isset($data['allOf'])) {
            return new Reference($data['$ref'], $context['document-origin']);
        }
        if (isset($data['$recursiveRef'])) {
            return new Reference($data['$recursiveRef'], $context['document-origin']);
        }
        if (\array_key_exists('ready', $data) && \is_int($data['ready'])) {
            $data['ready'] = (bool) $data['ready'];
        }
        if (\array_key_exists('ready', $data)) {
            $object->setReady($data['ready']);
            unset($data['ready']);
        }
        if (\array_key_exists('blockers', $data)) {
            $values = [];
            foreach ($data['blockers'] as $value) {
                $values[] = $value;
            }
            $object->setBlockers($values);
            unset($data['blockers']);
        }
        if (\array_key_exists('verifactu', $data)) {
            $object->setVerifactu($this->denormalizer->denormalize($data['verifactu'], IssuingReadinessDataVerifactu::class, 'json', $context));
            unset($data['verifactu']);
        }
        foreach ($data as $key => $value_1) {
            if (preg_match('/.*/', (string) $key)) {
                $object[$key] = $value_1;
            }
        }

        return $object;
    }

    public function normalize(mixed $data, ?string $format = null, array $context = []): array|string|int|float|bool|\ArrayObject|null
    {
        $dataArray = [];
        if ($data->isInitialized('ready') && $data->getReady() !== null) {
            $dataArray['ready'] = $data->getReady();
        }
        if ($data->isInitialized('blockers') && $data->getBlockers() !== null) {
            $values = [];
            foreach ($data->getBlockers() as $value) {
                $values[] = $value;
            }
            $dataArray['blockers'] = $values;
        }
        if ($data->isInitialized('verifactu') && $data->getVerifactu() !== null) {
            $dataArray['verifactu'] = $data->getVerifactu() === null ? null : new JsonObject($this->normalizer->normalize($data->getVerifactu(), 'json', $context));
        }
        foreach ($data->additionalPropertyEntries() as $key => $value_1) {
            if (preg_match('/.*/', (string) $key)) {
                $dataArray[$key] = $value_1;
            }
        }

        return $dataArray;
    }

    public function getSupportedTypes(?string $format = null): array
    {
        return [CompanyDataReadiness::class => false];
    }
}
