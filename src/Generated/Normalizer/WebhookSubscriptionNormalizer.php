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
class WebhookSubscriptionNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use CheckArray;
    use ValidatorTrait;
    public function supportsDenormalization(mixed $data, string $type, ?string $format = null, array $context = []): bool
    {
        return $type === \Lenorix\BeelSdk\Generated\Model\WebhookSubscription::class;
    }
    public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
    {
        return is_object($data) && get_class($data) === \Lenorix\BeelSdk\Generated\Model\WebhookSubscription::class;
    }
    public function denormalize(mixed $data, string $type, ?string $format = null, array $context = []): mixed
    {
        $object = new \Lenorix\BeelSdk\Generated\Model\WebhookSubscription();
        if (null === $data || false === \is_array($data)) {
            return $object;
        }
        if (isset($data['$ref']) && !isset($data['type']) && !isset($data['properties']) && !isset($data['allOf'])) {
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
        if (\array_key_exists('account_relationship', $data) && $data['account_relationship'] !== null) {
            $object->setAccountRelationship($data['account_relationship']);
            unset($data['account_relationship']);
        }
        elseif (\array_key_exists('account_relationship', $data) && $data['account_relationship'] === null) {
            $object->setAccountRelationship(null);
            unset($data['account_relationship']);
        }
        if (\array_key_exists('deactivated_by', $data) && $data['deactivated_by'] !== null) {
            $object->setDeactivatedBy($data['deactivated_by']);
            unset($data['deactivated_by']);
        }
        elseif (\array_key_exists('deactivated_by', $data) && $data['deactivated_by'] === null) {
            $object->setDeactivatedBy(null);
            unset($data['deactivated_by']);
        }
        if (\array_key_exists('deactivated_at', $data) && $data['deactivated_at'] !== null) {
            $object->setDeactivatedAt($this->denormalizer->denormalize($data['deactivated_at'], \DateTime::class, 'json', $context));
            unset($data['deactivated_at']);
        }
        elseif (\array_key_exists('deactivated_at', $data) && $data['deactivated_at'] === null) {
            $object->setDeactivatedAt(null);
            unset($data['deactivated_at']);
        }
        if (\array_key_exists('last_error', $data) && $data['last_error'] !== null) {
            $object->setLastError($data['last_error']);
            unset($data['last_error']);
        }
        elseif (\array_key_exists('last_error', $data) && $data['last_error'] === null) {
            $object->setLastError(null);
            unset($data['last_error']);
        }
        if (\array_key_exists('last_error_cause', $data) && $data['last_error_cause'] !== null) {
            $object->setLastErrorCause($data['last_error_cause']);
            unset($data['last_error_cause']);
        }
        elseif (\array_key_exists('last_error_cause', $data) && $data['last_error_cause'] === null) {
            $object->setLastErrorCause(null);
            unset($data['last_error_cause']);
        }
        if (\array_key_exists('consecutive_failures', $data) && $data['consecutive_failures'] !== null) {
            $object->setConsecutiveFailures($data['consecutive_failures']);
            unset($data['consecutive_failures']);
        }
        elseif (\array_key_exists('consecutive_failures', $data) && $data['consecutive_failures'] === null) {
            $object->setConsecutiveFailures(null);
            unset($data['consecutive_failures']);
        }
        if (\array_key_exists('last_used_at', $data) && $data['last_used_at'] !== null) {
            $object->setLastUsedAt($this->denormalizer->denormalize($data['last_used_at'], \DateTime::class, 'json', $context));
            unset($data['last_used_at']);
        }
        elseif (\array_key_exists('last_used_at', $data) && $data['last_used_at'] === null) {
            $object->setLastUsedAt(null);
            unset($data['last_used_at']);
        }
        if (\array_key_exists('created_at', $data)) {
            $object->setCreatedAt($this->denormalizer->denormalize($data['created_at'], \DateTime::class, 'json', $context));
            unset($data['created_at']);
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
        if ($data->isInitialized('accountRelationship') && null !== $data->getAccountRelationship()) {
            $dataArray['account_relationship'] = $data->getAccountRelationship();
        }
        if ($data->isInitialized('deactivatedBy') && null !== $data->getDeactivatedBy()) {
            $dataArray['deactivated_by'] = $data->getDeactivatedBy();
        }
        if ($data->isInitialized('deactivatedAt') && null !== $data->getDeactivatedAt()) {
            $dataArray['deactivated_at'] = $this->normalizer->normalize($data->getDeactivatedAt(), 'json', $context);
        }
        if ($data->isInitialized('lastError') && null !== $data->getLastError()) {
            $dataArray['last_error'] = $data->getLastError();
        }
        if ($data->isInitialized('lastErrorCause') && null !== $data->getLastErrorCause()) {
            $dataArray['last_error_cause'] = $data->getLastErrorCause();
        }
        if ($data->isInitialized('consecutiveFailures') && null !== $data->getConsecutiveFailures()) {
            $dataArray['consecutive_failures'] = $data->getConsecutiveFailures();
        }
        if ($data->isInitialized('lastUsedAt') && null !== $data->getLastUsedAt()) {
            $dataArray['last_used_at'] = $this->normalizer->normalize($data->getLastUsedAt(), 'json', $context);
        }
        $dataArray['created_at'] = $this->normalizer->normalize($data->getCreatedAt(), 'json', $context);
        foreach ($data->additionalPropertyEntries() as $key => $value_1) {
            if (preg_match('/.*/', (string) $key)) {
                $dataArray[$key] = $value_1;
            }
        }
        return $dataArray;
    }
    public function getSupportedTypes(?string $format = null): array
    {
        return [\Lenorix\BeelSdk\Generated\Model\WebhookSubscription::class => false];
    }
}