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
class CompanyDataReadinessNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use CheckArray;
    use ValidatorTrait;
    public function supportsDenormalization(mixed $data, string $type, ?string $format = null, array $context = []): bool
    {
        return $type === \Lenorix\BeelSdk\Generated\Model\CompanyDataReadiness::class;
    }
    public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
    {
        return is_object($data) && get_class($data) === \Lenorix\BeelSdk\Generated\Model\CompanyDataReadiness::class;
    }
    public function denormalize(mixed $data, string $type, ?string $format = null, array $context = []): mixed
    {
        $object = new \Lenorix\BeelSdk\Generated\Model\CompanyDataReadiness();
        if (null === $data || false === \is_array($data)) {
            return $object;
        }
        if (isset($data['$ref']) && !isset($data['type']) && !isset($data['properties']) && !isset($data['allOf'])) {
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
            $object->setVerifactu($this->denormalizer->denormalize($data['verifactu'], \Lenorix\BeelSdk\Generated\Model\IssuingReadinessDataVerifactu::class, 'json', $context));
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
        if ($data->isInitialized('ready') && null !== $data->getReady()) {
            $dataArray['ready'] = $data->getReady();
        }
        if ($data->isInitialized('blockers') && null !== $data->getBlockers()) {
            $values = [];
            foreach ($data->getBlockers() as $value) {
                $values[] = $value;
            }
            $dataArray['blockers'] = $values;
        }
        if ($data->isInitialized('verifactu') && null !== $data->getVerifactu()) {
            $dataArray['verifactu'] = $data->getVerifactu() === null ? null : new \Lenorix\BeelSdk\Generated\Runtime\JsonObject($this->normalizer->normalize($data->getVerifactu(), 'json', $context));
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
        return [\Lenorix\BeelSdk\Generated\Model\CompanyDataReadiness::class => false];
    }
}