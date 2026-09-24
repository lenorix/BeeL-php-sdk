<?php

namespace Lenorix\BeelSdk\Generated\Normalizer;

use Jane\Component\JsonSchemaRuntime\Reference;
use Lenorix\BeelSdk\Generated\Model\CreateInvoiceBatchRequest;
use Lenorix\BeelSdk\Generated\Runtime\Normalizer\CheckArray;
use Lenorix\BeelSdk\Generated\Runtime\Normalizer\InvalidDateException;
use Lenorix\BeelSdk\Generated\Runtime\Normalizer\ValidatorTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class CreateInvoiceBatchRequestNormalizer implements DenormalizerAwareInterface, DenormalizerInterface, NormalizerAwareInterface, NormalizerInterface
{
    use CheckArray;
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use ValidatorTrait;

    public function supportsDenormalization(mixed $data, string $type, ?string $format = null, array $context = []): bool
    {
        return $type === CreateInvoiceBatchRequest::class;
    }

    public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
    {
        return is_object($data) && get_class($data) === CreateInvoiceBatchRequest::class;
    }

    public function denormalize(mixed $data, string $type, ?string $format = null, array $context = []): mixed
    {
        $object = new CreateInvoiceBatchRequest;
        if ($data === null || \is_array($data) === false) {
            return $object;
        }
        if (isset($data['$ref']) && ! isset($data['type']) && ! isset($data['properties']) && ! isset($data['allOf'])) {
            return new Reference($data['$ref'], $context['document-origin']);
        }
        if (isset($data['$recursiveRef'])) {
            return new Reference($data['$recursiveRef'], $context['document-origin']);
        }
        if (\array_key_exists('operation', $data)) {
            $object->setOperation($data['operation']);
            unset($data['operation']);
        }
        if (\array_key_exists('invoice_ids', $data)) {
            $values = [];
            foreach ($data['invoice_ids'] as $value) {
                $values[] = $value;
            }
            $object->setInvoiceIds($values);
            unset($data['invoice_ids']);
        }
        if (\array_key_exists('new_status', $data)) {
            $object->setNewStatus($data['new_status']);
            unset($data['new_status']);
        }
        if (\array_key_exists('payment_date', $data)) {
            $date = \DateTime::createFromFormat('Y-m-d', $data['payment_date']);
            if ($date === false) {
                throw new InvalidDateException($data['payment_date'], 'Y-m-d');
            }
            $object->setPaymentDate($date->setTime(0, 0, 0));
            unset($data['payment_date']);
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
        $dataArray['operation'] = $data->getOperation();
        $values = [];
        foreach ($data->getInvoiceIds() as $value) {
            $values[] = $value;
        }
        $dataArray['invoice_ids'] = $values;
        if ($data->isInitialized('newStatus') && $data->getNewStatus() !== null) {
            $dataArray['new_status'] = $data->getNewStatus();
        }
        if ($data->isInitialized('paymentDate') && $data->getPaymentDate() !== null) {
            $dataArray['payment_date'] = $data->getPaymentDate()->format('Y-m-d');
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
        return [CreateInvoiceBatchRequest::class => false];
    }
}
