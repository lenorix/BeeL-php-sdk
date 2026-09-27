<?php

namespace Lenorix\BeelSdk\Generated\Normalizer;

use Jane\Component\JsonSchemaRuntime\Reference;
use Lenorix\BeelSdk\Generated\Model\PaymentEventCounts;
use Lenorix\BeelSdk\Generated\Model\PaymentEventFailureReasonCount;
use Lenorix\BeelSdk\Generated\Runtime\JsonObject;
use Lenorix\BeelSdk\Generated\Runtime\Normalizer\CheckArray;
use Lenorix\BeelSdk\Generated\Runtime\Normalizer\ValidatorTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class PaymentEventCountsNormalizer implements DenormalizerAwareInterface, DenormalizerInterface, NormalizerAwareInterface, NormalizerInterface
{
    use CheckArray;
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use ValidatorTrait;

    public function supportsDenormalization(mixed $data, string $type, ?string $format = null, array $context = []): bool
    {
        return $type === PaymentEventCounts::class;
    }

    public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
    {
        return is_object($data) && get_class($data) === PaymentEventCounts::class;
    }

    public function denormalize(mixed $data, string $type, ?string $format = null, array $context = []): mixed
    {
        $object = new PaymentEventCounts;
        if ($data === null || \is_array($data) === false) {
            return $object;
        }
        if (isset($data['$ref']) && ! isset($data['type']) && ! isset($data['properties']) && ! isset($data['allOf'])) {
            return new Reference($data['$ref'], $context['document-origin']);
        }
        if (isset($data['$recursiveRef'])) {
            return new Reference($data['$recursiveRef'], $context['document-origin']);
        }
        if (\array_key_exists('total', $data)) {
            $object->setTotal($data['total']);
            unset($data['total']);
        }
        if (\array_key_exists('discarded', $data)) {
            $object->setDiscarded($data['discarded']);
            unset($data['discarded']);
        }
        if (\array_key_exists('needs_action', $data)) {
            $object->setNeedsAction($data['needs_action']);
            unset($data['needs_action']);
        }
        if (\array_key_exists('ignored', $data)) {
            $object->setIgnored($data['ignored']);
            unset($data['ignored']);
        }
        if (\array_key_exists('by_status', $data)) {
            $values = new JsonObject;
            foreach ($data['by_status'] as $key => $value) {
                $values[$key] = $value;
            }
            $object->setByStatus($values);
            unset($data['by_status']);
        }
        if (\array_key_exists('by_failure_reason', $data)) {
            $values_1 = new JsonObject;
            foreach ($data['by_failure_reason'] as $key_1 => $value_1) {
                $values_1[$key_1] = $value_1;
            }
            $object->setByFailureReason($values_1);
            unset($data['by_failure_reason']);
        }
        if (\array_key_exists('failure_reasons', $data)) {
            $values_2 = [];
            foreach ($data['failure_reasons'] as $value_2) {
                $values_2[] = $this->denormalizer->denormalize($value_2, PaymentEventFailureReasonCount::class, 'json', $context);
            }
            $object->setFailureReasons($values_2);
            unset($data['failure_reasons']);
        }
        foreach ($data as $key_2 => $value_3) {
            if (preg_match('/.*/', (string) $key_2)) {
                $object[$key_2] = $value_3;
            }
        }

        return $object;
    }

    public function normalize(mixed $data, ?string $format = null, array $context = []): array|string|int|float|bool|\ArrayObject|null
    {
        $dataArray = [];
        $dataArray['total'] = $data->getTotal();
        $dataArray['discarded'] = $data->getDiscarded();
        $dataArray['needs_action'] = $data->getNeedsAction();
        $dataArray['ignored'] = $data->getIgnored();
        $values = new JsonObject;
        foreach ($data->getByStatus() as $key => $value) {
            $values[$key] = $value;
        }
        $dataArray['by_status'] = $values;
        $values_1 = new JsonObject;
        foreach ($data->getByFailureReason() as $key_1 => $value_1) {
            $values_1[$key_1] = $value_1;
        }
        $dataArray['by_failure_reason'] = $values_1;
        $values_2 = [];
        foreach ($data->getFailureReasons() as $value_2) {
            $values_2[] = $value_2 === null ? null : new JsonObject($this->normalizer->normalize($value_2, 'json', $context));
        }
        $dataArray['failure_reasons'] = $values_2;
        foreach ($data->additionalPropertyEntries() as $key_2 => $value_3) {
            if (preg_match('/.*/', (string) $key_2)) {
                $dataArray[$key_2] = $value_3;
            }
        }

        return $dataArray;
    }

    public function getSupportedTypes(?string $format = null): array
    {
        return [PaymentEventCounts::class => false];
    }
}
