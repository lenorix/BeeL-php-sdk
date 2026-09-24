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
class WebhookSubscriptionWithSecretTestDeliveryNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use CheckArray;
    use ValidatorTrait;
    public function supportsDenormalization(mixed $data, string $type, ?string $format = null, array $context = []): bool
    {
        return $type === \Lenorix\BeelSdk\Generated\Model\WebhookSubscriptionWithSecretTestDelivery::class;
    }
    public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
    {
        return is_object($data) && get_class($data) === \Lenorix\BeelSdk\Generated\Model\WebhookSubscriptionWithSecretTestDelivery::class;
    }
    public function denormalize(mixed $data, string $type, ?string $format = null, array $context = []): mixed
    {
        $object = new \Lenorix\BeelSdk\Generated\Model\WebhookSubscriptionWithSecretTestDelivery();
        if (null === $data || false === \is_array($data)) {
            return $object;
        }
        if (isset($data['$ref']) && !isset($data['type']) && !isset($data['properties']) && !isset($data['allOf'])) {
            return new Reference($data['$ref'], $context['document-origin']);
        }
        if (isset($data['$recursiveRef'])) {
            return new Reference($data['$recursiveRef'], $context['document-origin']);
        }
        if (\array_key_exists('delivery_success', $data) && \is_int($data['delivery_success'])) {
            $data['delivery_success'] = (bool) $data['delivery_success'];
        }
        if (\array_key_exists('delivery_success', $data)) {
            $object->setDeliverySuccess($data['delivery_success']);
            unset($data['delivery_success']);
        }
        if (\array_key_exists('http_status', $data) && $data['http_status'] !== null) {
            $object->setHttpStatus($data['http_status']);
            unset($data['http_status']);
        }
        elseif (\array_key_exists('http_status', $data) && $data['http_status'] === null) {
            $object->setHttpStatus(null);
            unset($data['http_status']);
        }
        if (\array_key_exists('duration_ms', $data)) {
            $object->setDurationMs($data['duration_ms']);
            unset($data['duration_ms']);
        }
        if (\array_key_exists('error', $data) && $data['error'] !== null) {
            $object->setError($data['error']);
            unset($data['error']);
        }
        elseif (\array_key_exists('error', $data) && $data['error'] === null) {
            $object->setError(null);
            unset($data['error']);
        }
        if (\array_key_exists('failure_cause', $data)) {
            $object->setFailureCause($data['failure_cause']);
            unset($data['failure_cause']);
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
        if ($data->isInitialized('deliverySuccess') && null !== $data->getDeliverySuccess()) {
            $dataArray['delivery_success'] = $data->getDeliverySuccess();
        }
        if ($data->isInitialized('httpStatus') && null !== $data->getHttpStatus()) {
            $dataArray['http_status'] = $data->getHttpStatus();
        }
        if ($data->isInitialized('durationMs') && null !== $data->getDurationMs()) {
            $dataArray['duration_ms'] = $data->getDurationMs();
        }
        if ($data->isInitialized('error') && null !== $data->getError()) {
            $dataArray['error'] = $data->getError();
        }
        if ($data->isInitialized('failureCause') && null !== $data->getFailureCause()) {
            $dataArray['failure_cause'] = $data->getFailureCause();
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
        return [\Lenorix\BeelSdk\Generated\Model\WebhookSubscriptionWithSecretTestDelivery::class => false];
    }
}