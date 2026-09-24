<?php

namespace Lenorix\BeelSdk\Generated\Normalizer;

use Jane\Component\JsonSchemaRuntime\Reference;
use Lenorix\BeelSdk\Generated\Model\WebhookEventDataInvoiceScheduleFailed;
use Lenorix\BeelSdk\Generated\Runtime\Normalizer\CheckArray;
use Lenorix\BeelSdk\Generated\Runtime\Normalizer\InvalidDateException;
use Lenorix\BeelSdk\Generated\Runtime\Normalizer\ValidatorTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class WebhookEventDataInvoiceScheduleFailedNormalizer implements DenormalizerAwareInterface, DenormalizerInterface, NormalizerAwareInterface, NormalizerInterface
{
    use CheckArray;
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use ValidatorTrait;

    public function supportsDenormalization(mixed $data, string $type, ?string $format = null, array $context = []): bool
    {
        return $type === WebhookEventDataInvoiceScheduleFailed::class;
    }

    public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
    {
        return is_object($data) && get_class($data) === WebhookEventDataInvoiceScheduleFailed::class;
    }

    public function denormalize(mixed $data, string $type, ?string $format = null, array $context = []): mixed
    {
        $object = new WebhookEventDataInvoiceScheduleFailed;
        if ($data === null || \is_array($data) === false) {
            return $object;
        }
        if (isset($data['$ref']) && ! isset($data['type']) && ! isset($data['properties']) && ! isset($data['allOf'])) {
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
        } elseif (\array_key_exists('invoice_number', $data) && $data['invoice_number'] === null) {
            $object->setInvoiceNumber(null);
        }
        if (\array_key_exists('customer_name', $data) && $data['customer_name'] !== null) {
            $object->setCustomerName($data['customer_name']);
        } elseif (\array_key_exists('customer_name', $data) && $data['customer_name'] === null) {
            $object->setCustomerName(null);
        }
        if (\array_key_exists('scheduled_for', $data) && $data['scheduled_for'] !== null) {
            $date = \DateTime::createFromFormat('Y-m-d', $data['scheduled_for']);
            if ($date === false) {
                throw new InvalidDateException($data['scheduled_for'], 'Y-m-d');
            }
            $object->setScheduledFor($date->setTime(0, 0, 0));
        } elseif (\array_key_exists('scheduled_for', $data) && $data['scheduled_for'] === null) {
            $object->setScheduledFor(null);
        }
        if (\array_key_exists('blocker', $data) && $data['blocker'] !== null) {
            $object->setBlocker($data['blocker']);
        } elseif (\array_key_exists('blocker', $data) && $data['blocker'] === null) {
            $object->setBlocker(null);
        }

        return $object;
    }

    public function normalize(mixed $data, ?string $format = null, array $context = []): array|string|int|float|bool|\ArrayObject|null
    {
        $dataArray = [];
        $dataArray['invoice_id'] = $data->getInvoiceId();
        if ($data->isInitialized('invoiceNumber') && $data->getInvoiceNumber() !== null) {
            $dataArray['invoice_number'] = $data->getInvoiceNumber();
        }
        if ($data->isInitialized('customerName') && $data->getCustomerName() !== null) {
            $dataArray['customer_name'] = $data->getCustomerName();
        }
        if ($data->isInitialized('scheduledFor') && $data->getScheduledFor() !== null) {
            $dataArray['scheduled_for'] = $data->getScheduledFor()?->format('Y-m-d');
        }
        if ($data->isInitialized('blocker') && $data->getBlocker() !== null) {
            $dataArray['blocker'] = $data->getBlocker();
        }

        return $dataArray;
    }

    public function getSupportedTypes(?string $format = null): array
    {
        return [WebhookEventDataInvoiceScheduleFailed::class => false];
    }
}
