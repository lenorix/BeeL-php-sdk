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
class WebhookDeliveryLogNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use CheckArray;
    use ValidatorTrait;
    public function supportsDenormalization(mixed $data, string $type, ?string $format = null, array $context = []): bool
    {
        return $type === \Lenorix\BeelSdk\Generated\Model\WebhookDeliveryLog::class;
    }
    public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
    {
        return is_object($data) && get_class($data) === \Lenorix\BeelSdk\Generated\Model\WebhookDeliveryLog::class;
    }
    public function denormalize(mixed $data, string $type, ?string $format = null, array $context = []): mixed
    {
        $object = new \Lenorix\BeelSdk\Generated\Model\WebhookDeliveryLog();
        if (null === $data || false === \is_array($data)) {
            return $object;
        }
        if (isset($data['$ref']) && !isset($data['type']) && !isset($data['properties']) && !isset($data['allOf'])) {
            return new Reference($data['$ref'], $context['document-origin']);
        }
        if (isset($data['$recursiveRef'])) {
            return new Reference($data['$recursiveRef'], $context['document-origin']);
        }
        if (\array_key_exists('response_body_truncated', $data) && \is_int($data['response_body_truncated'])) {
            $data['response_body_truncated'] = (bool) $data['response_body_truncated'];
        }
        if (\array_key_exists('success', $data) && \is_int($data['success'])) {
            $data['success'] = (bool) $data['success'];
        }
        if (\array_key_exists('id', $data)) {
            $object->setId($data['id']);
            unset($data['id']);
        }
        if (\array_key_exists('subscription_id', $data)) {
            $object->setSubscriptionId($data['subscription_id']);
            unset($data['subscription_id']);
        }
        if (\array_key_exists('webhook_event_id', $data)) {
            $object->setWebhookEventId($data['webhook_event_id']);
            unset($data['webhook_event_id']);
        }
        if (\array_key_exists('event_type', $data)) {
            $object->setEventType($data['event_type']);
            unset($data['event_type']);
        }
        if (\array_key_exists('attempt_number', $data)) {
            $object->setAttemptNumber($data['attempt_number']);
            unset($data['attempt_number']);
        }
        if (\array_key_exists('http_status', $data) && $data['http_status'] !== null) {
            $object->setHttpStatus($data['http_status']);
            unset($data['http_status']);
        }
        elseif (\array_key_exists('http_status', $data) && $data['http_status'] === null) {
            $object->setHttpStatus(null);
            unset($data['http_status']);
        }
        if (\array_key_exists('response_body', $data) && $data['response_body'] !== null) {
            $object->setResponseBody($data['response_body']);
            unset($data['response_body']);
        }
        elseif (\array_key_exists('response_body', $data) && $data['response_body'] === null) {
            $object->setResponseBody(null);
            unset($data['response_body']);
        }
        if (\array_key_exists('response_body_truncated', $data)) {
            $object->setResponseBodyTruncated($data['response_body_truncated']);
            unset($data['response_body_truncated']);
        }
        if (\array_key_exists('response_body_length', $data) && $data['response_body_length'] !== null) {
            $object->setResponseBodyLength($data['response_body_length']);
            unset($data['response_body_length']);
        }
        elseif (\array_key_exists('response_body_length', $data) && $data['response_body_length'] === null) {
            $object->setResponseBodyLength(null);
            unset($data['response_body_length']);
        }
        if (\array_key_exists('duration_ms', $data) && $data['duration_ms'] !== null) {
            $object->setDurationMs($data['duration_ms']);
            unset($data['duration_ms']);
        }
        elseif (\array_key_exists('duration_ms', $data) && $data['duration_ms'] === null) {
            $object->setDurationMs(null);
            unset($data['duration_ms']);
        }
        if (\array_key_exists('success', $data)) {
            $object->setSuccess($data['success']);
            unset($data['success']);
        }
        if (\array_key_exists('error_message', $data) && $data['error_message'] !== null) {
            $object->setErrorMessage($data['error_message']);
            unset($data['error_message']);
        }
        elseif (\array_key_exists('error_message', $data) && $data['error_message'] === null) {
            $object->setErrorMessage(null);
            unset($data['error_message']);
        }
        if (\array_key_exists('payload', $data) && $data['payload'] !== null) {
            $object->setPayload($data['payload']);
            unset($data['payload']);
        }
        elseif (\array_key_exists('payload', $data) && $data['payload'] === null) {
            $object->setPayload(null);
            unset($data['payload']);
        }
        if (\array_key_exists('request_headers', $data) && $data['request_headers'] !== null) {
            $values = new \Lenorix\BeelSdk\Generated\Runtime\JsonObject();
            foreach ($data['request_headers'] as $key => $value) {
                $values[$key] = $value;
            }
            $object->setRequestHeaders($values);
            unset($data['request_headers']);
        }
        elseif (\array_key_exists('request_headers', $data) && $data['request_headers'] === null) {
            $object->setRequestHeaders(null);
            unset($data['request_headers']);
        }
        if (\array_key_exists('delivered_at', $data)) {
            $date = \DateTime::createFromFormat('Y-m-d\TH:i:sP', $data['delivered_at']);
            if (false === $date) {
                throw new \Lenorix\BeelSdk\Generated\Runtime\Normalizer\InvalidDateException($data['delivered_at'], 'Y-m-d\TH:i:sP');
            }
            $object->setDeliveredAt($date);
            unset($data['delivered_at']);
        }
        foreach ($data as $key_1 => $value_1) {
            if (preg_match('/.*/', (string) $key_1)) {
                $object[$key_1] = $value_1;
            }
        }
        return $object;
    }
    public function normalize(mixed $data, ?string $format = null, array $context = []): array|string|int|float|bool|\ArrayObject|null
    {
        $dataArray = [];
        if ($data->isInitialized('id') && null !== $data->getId()) {
            $dataArray['id'] = $data->getId();
        }
        if ($data->isInitialized('subscriptionId') && null !== $data->getSubscriptionId()) {
            $dataArray['subscription_id'] = $data->getSubscriptionId();
        }
        if ($data->isInitialized('webhookEventId') && null !== $data->getWebhookEventId()) {
            $dataArray['webhook_event_id'] = $data->getWebhookEventId();
        }
        if ($data->isInitialized('eventType') && null !== $data->getEventType()) {
            $dataArray['event_type'] = $data->getEventType();
        }
        if ($data->isInitialized('attemptNumber') && null !== $data->getAttemptNumber()) {
            $dataArray['attempt_number'] = $data->getAttemptNumber();
        }
        if ($data->isInitialized('httpStatus') && null !== $data->getHttpStatus()) {
            $dataArray['http_status'] = $data->getHttpStatus();
        }
        if ($data->isInitialized('responseBody') && null !== $data->getResponseBody()) {
            $dataArray['response_body'] = $data->getResponseBody();
        }
        if ($data->isInitialized('responseBodyTruncated') && null !== $data->getResponseBodyTruncated()) {
            $dataArray['response_body_truncated'] = $data->getResponseBodyTruncated();
        }
        if ($data->isInitialized('responseBodyLength') && null !== $data->getResponseBodyLength()) {
            $dataArray['response_body_length'] = $data->getResponseBodyLength();
        }
        if ($data->isInitialized('durationMs') && null !== $data->getDurationMs()) {
            $dataArray['duration_ms'] = $data->getDurationMs();
        }
        if ($data->isInitialized('success') && null !== $data->getSuccess()) {
            $dataArray['success'] = $data->getSuccess();
        }
        if ($data->isInitialized('errorMessage') && null !== $data->getErrorMessage()) {
            $dataArray['error_message'] = $data->getErrorMessage();
        }
        if ($data->isInitialized('payload') && null !== $data->getPayload()) {
            $dataArray['payload'] = $data->getPayload();
        }
        if ($data->isInitialized('requestHeaders') && null !== $data->getRequestHeaders()) {
            $values = new \Lenorix\BeelSdk\Generated\Runtime\JsonObject();
            foreach ($data->getRequestHeaders() as $key => $value) {
                $values[$key] = $value;
            }
            $dataArray['request_headers'] = $values;
        }
        if ($data->isInitialized('deliveredAt') && null !== $data->getDeliveredAt()) {
            $dataArray['delivered_at'] = $data->getDeliveredAt()->format('Y-m-d\TH:i:sP');
        }
        foreach ($data->additionalPropertyEntries() as $key_1 => $value_1) {
            if (preg_match('/.*/', (string) $key_1)) {
                $dataArray[$key_1] = $value_1;
            }
        }
        return $dataArray;
    }
    public function getSupportedTypes(?string $format = null): array
    {
        return [\Lenorix\BeelSdk\Generated\Model\WebhookDeliveryLog::class => false];
    }
}