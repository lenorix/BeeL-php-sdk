<?php

namespace Lenorix\BeelSdk\Generated\Normalizer;

use Jane\Component\JsonSchemaRuntime\Reference;
use Lenorix\BeelSdk\Generated\Model\WebhookTestResult;
use Lenorix\BeelSdk\Generated\Runtime\Normalizer\CheckArray;
use Lenorix\BeelSdk\Generated\Runtime\Normalizer\ValidatorTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class WebhookTestResultNormalizer implements DenormalizerAwareInterface, DenormalizerInterface, NormalizerAwareInterface, NormalizerInterface
{
    use CheckArray;
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use ValidatorTrait;

    public function supportsDenormalization(mixed $data, string $type, ?string $format = null, array $context = []): bool
    {
        return $type === WebhookTestResult::class;
    }

    public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
    {
        return is_object($data) && get_class($data) === WebhookTestResult::class;
    }

    public function denormalize(mixed $data, string $type, ?string $format = null, array $context = []): mixed
    {
        $object = new WebhookTestResult;
        if ($data === null || \is_array($data) === false) {
            return $object;
        }
        if (isset($data['$ref']) && ! isset($data['type']) && ! isset($data['properties']) && ! isset($data['allOf'])) {
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
        } elseif (\array_key_exists('http_status', $data) && $data['http_status'] === null) {
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
        } elseif (\array_key_exists('error', $data) && $data['error'] === null) {
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
        if ($data->isInitialized('deliverySuccess') && $data->getDeliverySuccess() !== null) {
            $dataArray['delivery_success'] = $data->getDeliverySuccess();
        }
        if ($data->isInitialized('httpStatus') && $data->getHttpStatus() !== null) {
            $dataArray['http_status'] = $data->getHttpStatus();
        }
        if ($data->isInitialized('durationMs') && $data->getDurationMs() !== null) {
            $dataArray['duration_ms'] = $data->getDurationMs();
        }
        if ($data->isInitialized('error') && $data->getError() !== null) {
            $dataArray['error'] = $data->getError();
        }
        if ($data->isInitialized('failureCause') && $data->getFailureCause() !== null) {
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
        return [WebhookTestResult::class => false];
    }
}
