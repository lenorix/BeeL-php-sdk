<?php

namespace Lenorix\BeelSdk\Generated\Normalizer;

use Jane\Component\JsonSchemaRuntime\Reference;
use Lenorix\BeelSdk\Generated\Model\WebhookDeliveryLog;
use Lenorix\BeelSdk\Generated\Runtime\JsonObject;
use Lenorix\BeelSdk\Generated\Runtime\Normalizer\CheckArray;
use Lenorix\BeelSdk\Generated\Runtime\Normalizer\ValidatorTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class WebhookDeliveryLogNormalizer implements DenormalizerAwareInterface, DenormalizerInterface, NormalizerAwareInterface, NormalizerInterface
{
    use CheckArray;
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use ValidatorTrait;

    public function supportsDenormalization(mixed $data, string $type, ?string $format = null, array $context = []): bool
    {
        return $type === WebhookDeliveryLog::class;
    }

    public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
    {
        return is_object($data) && get_class($data) === WebhookDeliveryLog::class;
    }

    public function denormalize(mixed $data, string $type, ?string $format = null, array $context = []): mixed
    {
        $object = new WebhookDeliveryLog;
        if ($data === null || \is_array($data) === false) {
            return $object;
        }
        if (isset($data['$ref']) && ! isset($data['type']) && ! isset($data['properties']) && ! isset($data['allOf'])) {
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
        if (\array_key_exists('id', $data) && $data['id'] !== null) {
            $object->setId($data['id']);
            unset($data['id']);
        } elseif (\array_key_exists('id', $data) && $data['id'] === null) {
            $object->setId(null);
            unset($data['id']);
        }
        if (\array_key_exists('subscription_id', $data) && $data['subscription_id'] !== null) {
            $object->setSubscriptionId($data['subscription_id']);
            unset($data['subscription_id']);
        } elseif (\array_key_exists('subscription_id', $data) && $data['subscription_id'] === null) {
            $object->setSubscriptionId(null);
            unset($data['subscription_id']);
        }
        if (\array_key_exists('webhook_event_id', $data) && $data['webhook_event_id'] !== null) {
            $object->setWebhookEventId($data['webhook_event_id']);
            unset($data['webhook_event_id']);
        } elseif (\array_key_exists('webhook_event_id', $data) && $data['webhook_event_id'] === null) {
            $object->setWebhookEventId(null);
            unset($data['webhook_event_id']);
        }
        if (\array_key_exists('event_type', $data) && $data['event_type'] !== null) {
            $object->setEventType($data['event_type']);
            unset($data['event_type']);
        } elseif (\array_key_exists('event_type', $data) && $data['event_type'] === null) {
            $object->setEventType(null);
            unset($data['event_type']);
        }
        if (\array_key_exists('attempt_number', $data) && $data['attempt_number'] !== null) {
            $object->setAttemptNumber($data['attempt_number']);
            unset($data['attempt_number']);
        } elseif (\array_key_exists('attempt_number', $data) && $data['attempt_number'] === null) {
            $object->setAttemptNumber(null);
            unset($data['attempt_number']);
        }
        if (\array_key_exists('http_status', $data) && $data['http_status'] !== null) {
            $object->setHttpStatus($data['http_status']);
            unset($data['http_status']);
        } elseif (\array_key_exists('http_status', $data) && $data['http_status'] === null) {
            $object->setHttpStatus(null);
            unset($data['http_status']);
        }
        if (\array_key_exists('response_body', $data) && $data['response_body'] !== null) {
            $object->setResponseBody($data['response_body']);
            unset($data['response_body']);
        } elseif (\array_key_exists('response_body', $data) && $data['response_body'] === null) {
            $object->setResponseBody(null);
            unset($data['response_body']);
        }
        if (\array_key_exists('response_body_truncated', $data) && $data['response_body_truncated'] !== null) {
            $object->setResponseBodyTruncated($data['response_body_truncated']);
            unset($data['response_body_truncated']);
        } elseif (\array_key_exists('response_body_truncated', $data) && $data['response_body_truncated'] === null) {
            $object->setResponseBodyTruncated(null);
            unset($data['response_body_truncated']);
        }
        if (\array_key_exists('response_body_length', $data) && $data['response_body_length'] !== null) {
            $object->setResponseBodyLength($data['response_body_length']);
            unset($data['response_body_length']);
        } elseif (\array_key_exists('response_body_length', $data) && $data['response_body_length'] === null) {
            $object->setResponseBodyLength(null);
            unset($data['response_body_length']);
        }
        if (\array_key_exists('duration_ms', $data) && $data['duration_ms'] !== null) {
            $object->setDurationMs($data['duration_ms']);
            unset($data['duration_ms']);
        } elseif (\array_key_exists('duration_ms', $data) && $data['duration_ms'] === null) {
            $object->setDurationMs(null);
            unset($data['duration_ms']);
        }
        if (\array_key_exists('success', $data) && $data['success'] !== null) {
            $object->setSuccess($data['success']);
            unset($data['success']);
        } elseif (\array_key_exists('success', $data) && $data['success'] === null) {
            $object->setSuccess(null);
            unset($data['success']);
        }
        if (\array_key_exists('error_message', $data) && $data['error_message'] !== null) {
            $object->setErrorMessage($data['error_message']);
            unset($data['error_message']);
        } elseif (\array_key_exists('error_message', $data) && $data['error_message'] === null) {
            $object->setErrorMessage(null);
            unset($data['error_message']);
        }
        if (\array_key_exists('payload', $data) && $data['payload'] !== null) {
            $object->setPayload($data['payload']);
            unset($data['payload']);
        } elseif (\array_key_exists('payload', $data) && $data['payload'] === null) {
            $object->setPayload(null);
            unset($data['payload']);
        }
        if (\array_key_exists('request_headers', $data) && $data['request_headers'] !== null) {
            $values = new JsonObject;
            foreach ($data['request_headers'] as $key => $value) {
                $values[$key] = $value;
            }
            $object->setRequestHeaders($values);
            unset($data['request_headers']);
        } elseif (\array_key_exists('request_headers', $data) && $data['request_headers'] === null) {
            $object->setRequestHeaders(null);
            unset($data['request_headers']);
        }
        if (\array_key_exists('delivered_at', $data) && $data['delivered_at'] !== null) {
            $object->setDeliveredAt($this->denormalizer->denormalize($data['delivered_at'], \DateTime::class, 'json', $context));
            unset($data['delivered_at']);
        } elseif (\array_key_exists('delivered_at', $data) && $data['delivered_at'] === null) {
            $object->setDeliveredAt(null);
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
        if ($data->isInitialized('id') && $data->getId() !== null) {
            $dataArray['id'] = $data->getId();
        }
        if ($data->isInitialized('subscriptionId') && $data->getSubscriptionId() !== null) {
            $dataArray['subscription_id'] = $data->getSubscriptionId();
        }
        if ($data->isInitialized('webhookEventId') && $data->getWebhookEventId() !== null) {
            $dataArray['webhook_event_id'] = $data->getWebhookEventId();
        }
        if ($data->isInitialized('eventType') && $data->getEventType() !== null) {
            $dataArray['event_type'] = $data->getEventType();
        }
        if ($data->isInitialized('attemptNumber') && $data->getAttemptNumber() !== null) {
            $dataArray['attempt_number'] = $data->getAttemptNumber();
        }
        if ($data->isInitialized('httpStatus') && $data->getHttpStatus() !== null) {
            $dataArray['http_status'] = $data->getHttpStatus();
        }
        if ($data->isInitialized('responseBody') && $data->getResponseBody() !== null) {
            $dataArray['response_body'] = $data->getResponseBody();
        }
        if ($data->isInitialized('responseBodyTruncated') && $data->getResponseBodyTruncated() !== null) {
            $dataArray['response_body_truncated'] = $data->getResponseBodyTruncated();
        }
        if ($data->isInitialized('responseBodyLength') && $data->getResponseBodyLength() !== null) {
            $dataArray['response_body_length'] = $data->getResponseBodyLength();
        }
        if ($data->isInitialized('durationMs') && $data->getDurationMs() !== null) {
            $dataArray['duration_ms'] = $data->getDurationMs();
        }
        if ($data->isInitialized('success') && $data->getSuccess() !== null) {
            $dataArray['success'] = $data->getSuccess();
        }
        if ($data->isInitialized('errorMessage') && $data->getErrorMessage() !== null) {
            $dataArray['error_message'] = $data->getErrorMessage();
        }
        if ($data->isInitialized('payload') && $data->getPayload() !== null) {
            $dataArray['payload'] = $data->getPayload();
        }
        if ($data->isInitialized('requestHeaders') && $data->getRequestHeaders() !== null) {
            $values = new JsonObject;
            foreach ($data->getRequestHeaders() as $key => $value) {
                $values[$key] = $value;
            }
            $dataArray['request_headers'] = $values;
        }
        if ($data->isInitialized('deliveredAt') && $data->getDeliveredAt() !== null) {
            $dataArray['delivered_at'] = $this->normalizer->normalize($data->getDeliveredAt(), 'json', $context);
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
        return [WebhookDeliveryLog::class => false];
    }
}
