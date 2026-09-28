<?php

namespace Lenorix\BeelSdk\Generated\Normalizer;

use Jane\Component\JsonSchemaRuntime\Reference;
use Lenorix\BeelSdk\Generated\Model\Pagination;
use Lenorix\BeelSdk\Generated\Model\V1WebhooksWebhookIdDeliveriesGetResponse200Data;
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

class V1WebhooksWebhookIdDeliveriesGetResponse200DataNormalizer implements DenormalizerAwareInterface, DenormalizerInterface, NormalizerAwareInterface, NormalizerInterface
{
    use CheckArray;
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use ValidatorTrait;

    public function supportsDenormalization(mixed $data, string $type, ?string $format = null, array $context = []): bool
    {
        return $type === V1WebhooksWebhookIdDeliveriesGetResponse200Data::class;
    }

    public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
    {
        return is_object($data) && get_class($data) === V1WebhooksWebhookIdDeliveriesGetResponse200Data::class;
    }

    public function denormalize(mixed $data, string $type, ?string $format = null, array $context = []): mixed
    {
        $object = new V1WebhooksWebhookIdDeliveriesGetResponse200Data;
        if ($data === null || \is_array($data) === false) {
            return $object;
        }
        if (isset($data['$ref']) && ! isset($data['type']) && ! isset($data['properties']) && ! isset($data['allOf'])) {
            return new Reference($data['$ref'], $context['document-origin']);
        }
        if (isset($data['$recursiveRef'])) {
            return new Reference($data['$recursiveRef'], $context['document-origin']);
        }
        if (\array_key_exists('deliveries', $data) && $data['deliveries'] !== null) {
            $values = [];
            foreach ($data['deliveries'] as $value) {
                $values[] = $this->denormalizer->denormalize($value, WebhookDeliveryLog::class, 'json', $context);
            }
            $object->setDeliveries($values);
            unset($data['deliveries']);
        } elseif (\array_key_exists('deliveries', $data) && $data['deliveries'] === null) {
            $object->setDeliveries(null);
            unset($data['deliveries']);
        }
        if (\array_key_exists('pagination', $data) && $data['pagination'] !== null) {
            $value_1 = $data['pagination'];
            if (is_array($data['pagination']) and \array_key_exists('current_page', $data['pagination']) and \array_key_exists('total_pages', $data['pagination']) and \array_key_exists('total_items', $data['pagination']) and \array_key_exists('items_per_page', $data['pagination'])) {
                $value_1 = $this->denormalizer->denormalize($data['pagination'], Pagination::class, 'json', $context);
            }
            $object->setPagination($value_1);
            unset($data['pagination']);
        } elseif (\array_key_exists('pagination', $data) && $data['pagination'] === null) {
            $object->setPagination(null);
            unset($data['pagination']);
        }
        foreach ($data as $key => $value_2) {
            if (preg_match('/.*/', (string) $key)) {
                $object[$key] = $value_2;
            }
        }

        return $object;
    }

    public function normalize(mixed $data, ?string $format = null, array $context = []): array|string|int|float|bool|\ArrayObject|null
    {
        $dataArray = [];
        if ($data->isInitialized('deliveries') && $data->getDeliveries() !== null) {
            $values = [];
            foreach ($data->getDeliveries() as $value) {
                $values[] = $value === null ? null : new JsonObject($this->normalizer->normalize($value, 'json', $context));
            }
            $dataArray['deliveries'] = $values;
        }
        if ($data->isInitialized('pagination') && $data->getPagination() !== null) {
            $value_1 = $data->getPagination();
            if (is_object($data->getPagination())) {
                $value_1 = $data->getPagination() === null ? null : new JsonObject($this->normalizer->normalize($data->getPagination(), 'json', $context));
            }
            $dataArray['pagination'] = $value_1;
        }
        foreach ($data->additionalPropertyEntries() as $key => $value_2) {
            if (preg_match('/.*/', (string) $key)) {
                $dataArray[$key] = $value_2;
            }
        }

        return $dataArray;
    }

    public function getSupportedTypes(?string $format = null): array
    {
        return [V1WebhooksWebhookIdDeliveriesGetResponse200Data::class => false];
    }
}
