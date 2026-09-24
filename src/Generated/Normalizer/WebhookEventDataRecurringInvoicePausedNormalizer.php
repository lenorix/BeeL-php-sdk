<?php

namespace Lenorix\BeelSdk\Generated\Normalizer;

use Jane\Component\JsonSchemaRuntime\Reference;
use Lenorix\BeelSdk\Generated\Model\WebhookEventDataRecurringInvoicePaused;
use Lenorix\BeelSdk\Generated\Runtime\Normalizer\CheckArray;
use Lenorix\BeelSdk\Generated\Runtime\Normalizer\InvalidDateException;
use Lenorix\BeelSdk\Generated\Runtime\Normalizer\ValidatorTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class WebhookEventDataRecurringInvoicePausedNormalizer implements DenormalizerAwareInterface, DenormalizerInterface, NormalizerAwareInterface, NormalizerInterface
{
    use CheckArray;
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use ValidatorTrait;

    public function supportsDenormalization(mixed $data, string $type, ?string $format = null, array $context = []): bool
    {
        return $type === WebhookEventDataRecurringInvoicePaused::class;
    }

    public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
    {
        return is_object($data) && get_class($data) === WebhookEventDataRecurringInvoicePaused::class;
    }

    public function denormalize(mixed $data, string $type, ?string $format = null, array $context = []): mixed
    {
        $object = new WebhookEventDataRecurringInvoicePaused;
        if ($data === null || \is_array($data) === false) {
            return $object;
        }
        if (isset($data['$ref']) && ! isset($data['type']) && ! isset($data['properties']) && ! isset($data['allOf'])) {
            return new Reference($data['$ref'], $context['document-origin']);
        }
        if (isset($data['$recursiveRef'])) {
            return new Reference($data['$recursiveRef'], $context['document-origin']);
        }
        if (\array_key_exists('recurring_invoice_id', $data)) {
            $object->setRecurringInvoiceId($data['recurring_invoice_id']);
        }
        if (\array_key_exists('name', $data) && $data['name'] !== null) {
            $object->setName($data['name']);
        } elseif (\array_key_exists('name', $data) && $data['name'] === null) {
            $object->setName(null);
        }
        if (\array_key_exists('reason', $data)) {
            $object->setReason($data['reason']);
        }
        if (\array_key_exists('blocker', $data) && $data['blocker'] !== null) {
            $object->setBlocker($data['blocker']);
        } elseif (\array_key_exists('blocker', $data) && $data['blocker'] === null) {
            $object->setBlocker(null);
        }
        if (\array_key_exists('since', $data)) {
            $date = \DateTime::createFromFormat('Y-m-d\TH:i:sP', $data['since']);
            if ($date === false) {
                throw new InvalidDateException($data['since'], 'Y-m-d\TH:i:sP');
            }
            $object->setSince($date);
        }

        return $object;
    }

    public function normalize(mixed $data, ?string $format = null, array $context = []): array|string|int|float|bool|\ArrayObject|null
    {
        $dataArray = [];
        $dataArray['recurring_invoice_id'] = $data->getRecurringInvoiceId();
        if ($data->isInitialized('name') && $data->getName() !== null) {
            $dataArray['name'] = $data->getName();
        }
        $dataArray['reason'] = $data->getReason();
        if ($data->isInitialized('blocker') && $data->getBlocker() !== null) {
            $dataArray['blocker'] = $data->getBlocker();
        }
        $dataArray['since'] = $data->getSince()->format('Y-m-d\TH:i:sP');

        return $dataArray;
    }

    public function getSupportedTypes(?string $format = null): array
    {
        return [WebhookEventDataRecurringInvoicePaused::class => false];
    }
}
