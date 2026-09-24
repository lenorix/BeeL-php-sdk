<?php

namespace Lenorix\BeelSdk\Generated\Normalizer;

use Jane\Component\JsonSchemaRuntime\Reference;
use Lenorix\BeelSdk\Generated\Model\ResponseMeta;
use Lenorix\BeelSdk\Generated\Model\V1WebhooksWebhookIdPatchResponse200;
use Lenorix\BeelSdk\Generated\Model\WebhookSubscription;
use Lenorix\BeelSdk\Generated\Runtime\JsonObject;
use Lenorix\BeelSdk\Generated\Runtime\Normalizer\CheckArray;
use Lenorix\BeelSdk\Generated\Runtime\Normalizer\ValidatorTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class V1WebhooksWebhookIdPatchResponse200Normalizer implements DenormalizerAwareInterface, DenormalizerInterface, NormalizerAwareInterface, NormalizerInterface
{
    use CheckArray;
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use ValidatorTrait;

    public function supportsDenormalization(mixed $data, string $type, ?string $format = null, array $context = []): bool
    {
        return $type === V1WebhooksWebhookIdPatchResponse200::class;
    }

    public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
    {
        return is_object($data) && get_class($data) === V1WebhooksWebhookIdPatchResponse200::class;
    }

    public function denormalize(mixed $data, string $type, ?string $format = null, array $context = []): mixed
    {
        $object = new V1WebhooksWebhookIdPatchResponse200;
        if ($data === null || \is_array($data) === false) {
            return $object;
        }
        if (isset($data['$ref']) && ! isset($data['type']) && ! isset($data['properties']) && ! isset($data['allOf'])) {
            return new Reference($data['$ref'], $context['document-origin']);
        }
        if (isset($data['$recursiveRef'])) {
            return new Reference($data['$recursiveRef'], $context['document-origin']);
        }
        if (\array_key_exists('success', $data) && \is_int($data['success'])) {
            $data['success'] = (bool) $data['success'];
        }
        if (\array_key_exists('success', $data)) {
            $object->setSuccess($data['success']);
            unset($data['success']);
        }
        if (\array_key_exists('data', $data)) {
            $object->setData($this->denormalizer->denormalize($data['data'], WebhookSubscription::class, 'json', $context));
            unset($data['data']);
        }
        if (\array_key_exists('meta', $data)) {
            $object->setMeta($this->denormalizer->denormalize($data['meta'], ResponseMeta::class, 'json', $context));
            unset($data['meta']);
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
        $dataArray['success'] = $data->getSuccess();
        if ($data->isInitialized('data') && $data->getData() !== null) {
            $dataArray['data'] = $data->getData() === null ? null : new JsonObject($this->normalizer->normalize($data->getData(), 'json', $context));
        }
        if ($data->isInitialized('meta') && $data->getMeta() !== null) {
            $dataArray['meta'] = $data->getMeta() === null ? null : new JsonObject($this->normalizer->normalize($data->getMeta(), 'json', $context));
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
        return [V1WebhooksWebhookIdPatchResponse200::class => false];
    }
}
