<?php

namespace Lenorix\BeelSdk\Generated\Normalizer;

use Jane\Component\JsonSchemaRuntime\Reference;
use Lenorix\BeelSdk\Generated\Model\UpdateCompanyPaymentConnectionSeries;
use Lenorix\BeelSdk\Generated\Runtime\Normalizer\CheckArray;
use Lenorix\BeelSdk\Generated\Runtime\Normalizer\ValidatorTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class UpdateCompanyPaymentConnectionSeriesNormalizer implements DenormalizerAwareInterface, DenormalizerInterface, NormalizerAwareInterface, NormalizerInterface
{
    use CheckArray;
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use ValidatorTrait;

    public function supportsDenormalization(mixed $data, string $type, ?string $format = null, array $context = []): bool
    {
        return $type === UpdateCompanyPaymentConnectionSeries::class;
    }

    public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
    {
        return is_object($data) && get_class($data) === UpdateCompanyPaymentConnectionSeries::class;
    }

    public function denormalize(mixed $data, string $type, ?string $format = null, array $context = []): mixed
    {
        $object = new UpdateCompanyPaymentConnectionSeries;
        if ($data === null || \is_array($data) === false) {
            return $object;
        }
        if (isset($data['$ref']) && ! isset($data['type']) && ! isset($data['properties']) && ! isset($data['allOf'])) {
            return new Reference($data['$ref'], $context['document-origin']);
        }
        if (isset($data['$recursiveRef'])) {
            return new Reference($data['$recursiveRef'], $context['document-origin']);
        }
        if (\array_key_exists('ordinaria', $data) && $data['ordinaria'] !== null) {
            $object->setOrdinaria($data['ordinaria']);
            unset($data['ordinaria']);
        } elseif (\array_key_exists('ordinaria', $data) && $data['ordinaria'] === null) {
            $object->setOrdinaria(null);
            unset($data['ordinaria']);
        }
        if (\array_key_exists('simplificada', $data) && $data['simplificada'] !== null) {
            $object->setSimplificada($data['simplificada']);
            unset($data['simplificada']);
        } elseif (\array_key_exists('simplificada', $data) && $data['simplificada'] === null) {
            $object->setSimplificada(null);
            unset($data['simplificada']);
        }
        if (\array_key_exists('rectificativa', $data) && $data['rectificativa'] !== null) {
            $object->setRectificativa($data['rectificativa']);
            unset($data['rectificativa']);
        } elseif (\array_key_exists('rectificativa', $data) && $data['rectificativa'] === null) {
            $object->setRectificativa(null);
            unset($data['rectificativa']);
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
        if ($data->isInitialized('ordinaria') && $data->getOrdinaria() !== null) {
            $dataArray['ordinaria'] = $data->getOrdinaria();
        }
        if ($data->isInitialized('simplificada') && $data->getSimplificada() !== null) {
            $dataArray['simplificada'] = $data->getSimplificada();
        }
        if ($data->isInitialized('rectificativa') && $data->getRectificativa() !== null) {
            $dataArray['rectificativa'] = $data->getRectificativa();
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
        return [UpdateCompanyPaymentConnectionSeries::class => false];
    }
}
