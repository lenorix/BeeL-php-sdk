<?php

namespace Lenorix\BeelSdk\Generated\Normalizer;

use Jane\Component\JsonSchemaRuntime\Reference;
use Lenorix\BeelSdk\Generated\Model\WebhookSubscriptionWithSecret;
use Lenorix\BeelSdk\Generated\Model\WebhookSubscriptionWithSecretTestDelivery;
use Lenorix\BeelSdk\Generated\Runtime\JsonObject;
use Lenorix\BeelSdk\Generated\Runtime\Normalizer\CheckArray;
use Lenorix\BeelSdk\Generated\Runtime\Normalizer\InvalidDateException;
use Lenorix\BeelSdk\Generated\Runtime\Normalizer\ValidatorTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class WebhookSubscriptionWithSecretNormalizer implements DenormalizerAwareInterface, DenormalizerInterface, NormalizerAwareInterface, NormalizerInterface
{
    use CheckArray;
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use ValidatorTrait;

    public function supportsDenormalization(mixed $data, string $type, ?string $format = null, array $context = []): bool
    {
        return $type === WebhookSubscriptionWithSecret::class;
    }

    public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
    {
        return is_object($data) && get_class($data) === WebhookSubscriptionWithSecret::class;
    }

    public function denormalize(mixed $data, string $type, ?string $format = null, array $context = []): mixed
    {
        $object = new WebhookSubscriptionWithSecret;
        if ($data === null || \is_array($data) === false) {
            return $object;
        }
        if (isset($data['$ref']) && ! isset($data['type']) && ! isset($data['properties']) && ! isset($data['allOf'])) {
            return new Reference($data['$ref'], $context['document-origin']);
        }
        if (isset($data['$recursiveRef'])) {
            return new Reference($data['$recursiveRef'], $context['document-origin']);
        }
        if (\array_key_exists('active', $data) && \is_int($data['active'])) {
            $data['active'] = (bool) $data['active'];
        }
        if (\array_key_exists('id', $data)) {
            $object->setId($data['id']);
            unset($data['id']);
        }
        if (\array_key_exists('url', $data)) {
            $object->setUrl($data['url']);
            unset($data['url']);
        }
        if (\array_key_exists('events', $data)) {
            $values = [];
            foreach ($data['events'] as $value) {
                $values[] = $value;
            }
            $object->setEvents($values);
            unset($data['events']);
        }
        if (\array_key_exists('active', $data)) {
            $object->setActive($data['active']);
            unset($data['active']);
        }
        if (\array_key_exists('account_relationship', $data)) {
            $object->setAccountRelationship($data['account_relationship']);
            unset($data['account_relationship']);
        }
        if (\array_key_exists('deactivated_by', $data)) {
            $object->setDeactivatedBy($data['deactivated_by']);
            unset($data['deactivated_by']);
        }
        if (\array_key_exists('deactivated_at', $data) && $data['deactivated_at'] !== null) {
            $date = \DateTime::createFromFormat('Y-m-d\TH:i:sP', $data['deactivated_at']);
            if ($date === false) {
                throw new InvalidDateException($data['deactivated_at'], 'Y-m-d\TH:i:sP');
            }
            $object->setDeactivatedAt($date);
            unset($data['deactivated_at']);
        } elseif (\array_key_exists('deactivated_at', $data) && $data['deactivated_at'] === null) {
            $object->setDeactivatedAt(null);
            unset($data['deactivated_at']);
        }
        if (\array_key_exists('last_error', $data) && $data['last_error'] !== null) {
            $object->setLastError($data['last_error']);
            unset($data['last_error']);
        } elseif (\array_key_exists('last_error', $data) && $data['last_error'] === null) {
            $object->setLastError(null);
            unset($data['last_error']);
        }
        if (\array_key_exists('last_error_cause', $data)) {
            $object->setLastErrorCause($data['last_error_cause']);
            unset($data['last_error_cause']);
        }
        if (\array_key_exists('consecutive_failures', $data)) {
            $object->setConsecutiveFailures($data['consecutive_failures']);
            unset($data['consecutive_failures']);
        }
        if (\array_key_exists('last_used_at', $data) && $data['last_used_at'] !== null) {
            $date_1 = \DateTime::createFromFormat('Y-m-d\TH:i:sP', $data['last_used_at']);
            if ($date_1 === false) {
                throw new InvalidDateException($data['last_used_at'], 'Y-m-d\TH:i:sP');
            }
            $object->setLastUsedAt($date_1);
            unset($data['last_used_at']);
        } elseif (\array_key_exists('last_used_at', $data) && $data['last_used_at'] === null) {
            $object->setLastUsedAt(null);
            unset($data['last_used_at']);
        }
        if (\array_key_exists('created_at', $data)) {
            $date_2 = \DateTime::createFromFormat('Y-m-d\TH:i:sP', $data['created_at']);
            if ($date_2 === false) {
                throw new InvalidDateException($data['created_at'], 'Y-m-d\TH:i:sP');
            }
            $object->setCreatedAt($date_2);
            unset($data['created_at']);
        }
        if (\array_key_exists('secret', $data)) {
            $object->setSecret($data['secret']);
            unset($data['secret']);
        }
        if (\array_key_exists('test_delivery', $data) && $data['test_delivery'] !== null) {
            $object->setTestDelivery($this->denormalizer->denormalize($data['test_delivery'], WebhookSubscriptionWithSecretTestDelivery::class, 'json', $context));
            unset($data['test_delivery']);
        } elseif (\array_key_exists('test_delivery', $data) && $data['test_delivery'] === null) {
            $object->setTestDelivery(null);
            unset($data['test_delivery']);
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
        $dataArray['id'] = $data->getId();
        $dataArray['url'] = $data->getUrl();
        $values = [];
        foreach ($data->getEvents() as $value) {
            $values[] = $value;
        }
        $dataArray['events'] = $values;
        $dataArray['active'] = $data->getActive();
        if ($data->isInitialized('accountRelationship') && $data->getAccountRelationship() !== null) {
            $dataArray['account_relationship'] = $data->getAccountRelationship();
        }
        if ($data->isInitialized('deactivatedBy') && $data->getDeactivatedBy() !== null) {
            $dataArray['deactivated_by'] = $data->getDeactivatedBy();
        }
        if ($data->isInitialized('deactivatedAt') && $data->getDeactivatedAt() !== null) {
            $dataArray['deactivated_at'] = $data->getDeactivatedAt()?->format('Y-m-d\TH:i:sP');
        }
        if ($data->isInitialized('lastError') && $data->getLastError() !== null) {
            $dataArray['last_error'] = $data->getLastError();
        }
        if ($data->isInitialized('lastErrorCause') && $data->getLastErrorCause() !== null) {
            $dataArray['last_error_cause'] = $data->getLastErrorCause();
        }
        if ($data->isInitialized('consecutiveFailures') && $data->getConsecutiveFailures() !== null) {
            $dataArray['consecutive_failures'] = $data->getConsecutiveFailures();
        }
        if ($data->isInitialized('lastUsedAt') && $data->getLastUsedAt() !== null) {
            $dataArray['last_used_at'] = $data->getLastUsedAt()?->format('Y-m-d\TH:i:sP');
        }
        $dataArray['created_at'] = $data->getCreatedAt()->format('Y-m-d\TH:i:sP');
        if ($data->isInitialized('secret') && $data->getSecret() !== null) {
            $dataArray['secret'] = $data->getSecret();
        }
        if ($data->isInitialized('testDelivery') && $data->getTestDelivery() !== null) {
            $dataArray['test_delivery'] = $data->getTestDelivery() === null ? null : new JsonObject($this->normalizer->normalize($data->getTestDelivery(), 'json', $context));
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
        return [WebhookSubscriptionWithSecret::class => false];
    }
}
