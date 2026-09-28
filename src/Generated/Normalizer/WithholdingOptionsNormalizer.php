<?php

namespace Lenorix\BeelSdk\Generated\Normalizer;

use Jane\Component\JsonSchemaRuntime\Reference;
use Lenorix\BeelSdk\Generated\Model\WithholdingOptions;
use Lenorix\BeelSdk\Generated\Runtime\Normalizer\CheckArray;
use Lenorix\BeelSdk\Generated\Runtime\Normalizer\ValidatorTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class WithholdingOptionsNormalizer implements DenormalizerAwareInterface, DenormalizerInterface, NormalizerAwareInterface, NormalizerInterface
{
    use CheckArray;
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use ValidatorTrait;

    public function supportsDenormalization(mixed $data, string $type, ?string $format = null, array $context = []): bool
    {
        return $type === WithholdingOptions::class;
    }

    public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
    {
        return is_object($data) && get_class($data) === WithholdingOptions::class;
    }

    public function denormalize(mixed $data, string $type, ?string $format = null, array $context = []): mixed
    {
        $object = new WithholdingOptions;
        if ($data === null || \is_array($data) === false) {
            return $object;
        }
        if (isset($data['$ref']) && ! isset($data['type']) && ! isset($data['properties']) && ! isset($data['allOf'])) {
            return new Reference($data['$ref'], $context['document-origin']);
        }
        if (isset($data['$recursiveRef'])) {
            return new Reference($data['$recursiveRef'], $context['document-origin']);
        }
        if (\array_key_exists('suggested_irpf_rate', $data) && \is_int($data['suggested_irpf_rate'])) {
            $data['suggested_irpf_rate'] = (float) $data['suggested_irpf_rate'];
        }
        if (\array_key_exists('allowed_irpf_rates', $data)) {
            $values = [];
            foreach ($data['allowed_irpf_rates'] as $value) {
                $values[] = $value;
            }
            $object->setAllowedIrpfRates($values);
            unset($data['allowed_irpf_rates']);
        }
        if (\array_key_exists('suggested_irpf_rate', $data) && $data['suggested_irpf_rate'] !== null) {
            $object->setSuggestedIrpfRate($data['suggested_irpf_rate']);
            unset($data['suggested_irpf_rate']);
        } elseif (\array_key_exists('suggested_irpf_rate', $data) && $data['suggested_irpf_rate'] === null) {
            $object->setSuggestedIrpfRate(null);
            unset($data['suggested_irpf_rate']);
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
        $values = [];
        foreach ($data->getAllowedIrpfRates() as $value) {
            $values[] = $value;
        }
        $dataArray['allowed_irpf_rates'] = $values;
        $dataArray['suggested_irpf_rate'] = $data->getSuggestedIrpfRate();
        foreach ($data->additionalPropertyEntries() as $key => $value_1) {
            if (preg_match('/.*/', (string) $key)) {
                $dataArray[$key] = $value_1;
            }
        }

        return $dataArray;
    }

    public function getSupportedTypes(?string $format = null): array
    {
        return [WithholdingOptions::class => false];
    }
}
