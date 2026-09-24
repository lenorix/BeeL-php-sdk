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
class WebhookEventDataInvoiceScheduleFailedNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use CheckArray;
    use ValidatorTrait;
    public function supportsDenormalization(mixed $data, string $type, ?string $format = null, array $context = []): bool
    {
        return $type === \Lenorix\BeelSdk\Generated\Model\WebhookEventDataInvoiceScheduleFailed::class;
    }
    public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
    {
        return is_object($data) && get_class($data) === \Lenorix\BeelSdk\Generated\Model\WebhookEventDataInvoiceScheduleFailed::class;
    }
    public function denormalize(mixed $data, string $type, ?string $format = null, array $context = []): mixed
    {
        $object = new \Lenorix\BeelSdk\Generated\Model\WebhookEventDataInvoiceScheduleFailed();
        if (null === $data || false === \is_array($data)) {
            return $object;
        }
        if (isset($data['$ref']) && !isset($data['type']) && !isset($data['properties']) && !isset($data['allOf'])) {
            return new Reference($data['$ref'], $context['document-origin']);
        }
        if (isset($data['$recursiveRef'])) {
            return new Reference($data['$recursiveRef'], $context['document-origin']);
        }
        if (\array_key_exists('invoice_id', $data)) {
            $object->setInvoiceId($data['invoice_id']);
        }
        if (\array_key_exists('invoice_number', $data) && $data['invoice_number'] !== null) {
            $object->setInvoiceNumber($data['invoice_number']);
        }
        elseif (\array_key_exists('invoice_number', $data) && $data['invoice_number'] === null) {
            $object->setInvoiceNumber(null);
        }
        if (\array_key_exists('customer_name', $data) && $data['customer_name'] !== null) {
            $object->setCustomerName($data['customer_name']);
        }
        elseif (\array_key_exists('customer_name', $data) && $data['customer_name'] === null) {
            $object->setCustomerName(null);
        }
        if (\array_key_exists('scheduled_for', $data) && $data['scheduled_for'] !== null) {
            $date = \DateTime::createFromFormat('Y-m-d', $data['scheduled_for']);
            if (false === $date) {
                throw new \Lenorix\BeelSdk\Generated\Runtime\Normalizer\InvalidDateException($data['scheduled_for'], 'Y-m-d');
            }
            $object->setScheduledFor($date->setTime(0, 0, 0));
        }
        elseif (\array_key_exists('scheduled_for', $data) && $data['scheduled_for'] === null) {
            $object->setScheduledFor(null);
        }
        if (\array_key_exists('blocker', $data) && $data['blocker'] !== null) {
            $object->setBlocker($data['blocker']);
        }
        elseif (\array_key_exists('blocker', $data) && $data['blocker'] === null) {
            $object->setBlocker(null);
        }
        return $object;
    }
    public function normalize(mixed $data, ?string $format = null, array $context = []): array|string|int|float|bool|\ArrayObject|null
    {
        $dataArray = [];
        $dataArray['invoice_id'] = $data->getInvoiceId();
        if ($data->isInitialized('invoiceNumber') && null !== $data->getInvoiceNumber()) {
            $dataArray['invoice_number'] = $data->getInvoiceNumber();
        }
        if ($data->isInitialized('customerName') && null !== $data->getCustomerName()) {
            $dataArray['customer_name'] = $data->getCustomerName();
        }
        if ($data->isInitialized('scheduledFor') && null !== $data->getScheduledFor()) {
            $dataArray['scheduled_for'] = $data->getScheduledFor()?->format('Y-m-d');
        }
        if ($data->isInitialized('blocker') && null !== $data->getBlocker()) {
            $dataArray['blocker'] = $data->getBlocker();
        }
        return $dataArray;
    }
    public function getSupportedTypes(?string $format = null): array
    {
        return [\Lenorix\BeelSdk\Generated\Model\WebhookEventDataInvoiceScheduleFailed::class => false];
    }
}