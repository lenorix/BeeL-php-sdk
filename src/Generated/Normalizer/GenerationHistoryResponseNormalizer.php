<?php

namespace Lenorix\BeelSdk\Generated\Normalizer;

use Jane\Component\JsonSchemaRuntime\Reference;
use Lenorix\BeelSdk\Generated\Model\GenerationHistoryResponse;
use Lenorix\BeelSdk\Generated\Runtime\Normalizer\CheckArray;
use Lenorix\BeelSdk\Generated\Runtime\Normalizer\InvalidDateException;
use Lenorix\BeelSdk\Generated\Runtime\Normalizer\ValidatorTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class GenerationHistoryResponseNormalizer implements DenormalizerAwareInterface, DenormalizerInterface, NormalizerAwareInterface, NormalizerInterface
{
    use CheckArray;
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use ValidatorTrait;

    public function supportsDenormalization(mixed $data, string $type, ?string $format = null, array $context = []): bool
    {
        return $type === GenerationHistoryResponse::class;
    }

    public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
    {
        return is_object($data) && get_class($data) === GenerationHistoryResponse::class;
    }

    public function denormalize(mixed $data, string $type, ?string $format = null, array $context = []): mixed
    {
        $object = new GenerationHistoryResponse;
        if ($data === null || \is_array($data) === false) {
            return $object;
        }
        if (isset($data['$ref']) && ! isset($data['type']) && ! isset($data['properties']) && ! isset($data['allOf'])) {
            return new Reference($data['$ref'], $context['document-origin']);
        }
        if (isset($data['$recursiveRef'])) {
            return new Reference($data['$recursiveRef'], $context['document-origin']);
        }
        if (\array_key_exists('total', $data) && \is_int($data['total'])) {
            $data['total'] = (float) $data['total'];
        }
        if (\array_key_exists('id', $data)) {
            $object->setId($data['id']);
            unset($data['id']);
        }
        if (\array_key_exists('invoice_id', $data)) {
            $object->setInvoiceId($data['invoice_id']);
            unset($data['invoice_id']);
        }
        if (\array_key_exists('generated_at', $data)) {
            $date = \DateTime::createFromFormat('Y-m-d\TH:i:sP', $data['generated_at']);
            if ($date === false) {
                throw new InvalidDateException($data['generated_at'], 'Y-m-d\TH:i:sP');
            }
            $object->setGeneratedAt($date);
            unset($data['generated_at']);
        }
        if (\array_key_exists('scheduled_date', $data)) {
            $date_1 = \DateTime::createFromFormat('Y-m-d', $data['scheduled_date']);
            if ($date_1 === false) {
                throw new InvalidDateException($data['scheduled_date'], 'Y-m-d');
            }
            $object->setScheduledDate($date_1->setTime(0, 0, 0));
            unset($data['scheduled_date']);
        }
        if (\array_key_exists('invoice_number', $data) && $data['invoice_number'] !== null) {
            $object->setInvoiceNumber($data['invoice_number']);
            unset($data['invoice_number']);
        } elseif (\array_key_exists('invoice_number', $data) && $data['invoice_number'] === null) {
            $object->setInvoiceNumber(null);
            unset($data['invoice_number']);
        }
        if (\array_key_exists('total', $data) && $data['total'] !== null) {
            $object->setTotal($data['total']);
            unset($data['total']);
        } elseif (\array_key_exists('total', $data) && $data['total'] === null) {
            $object->setTotal(null);
            unset($data['total']);
        }
        if (\array_key_exists('status', $data) && $data['status'] !== null) {
            $object->setStatus($data['status']);
            unset($data['status']);
        } elseif (\array_key_exists('status', $data) && $data['status'] === null) {
            $object->setStatus(null);
            unset($data['status']);
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
        if ($data->isInitialized('id') && $data->getId() !== null) {
            $dataArray['id'] = $data->getId();
        }
        if ($data->isInitialized('invoiceId') && $data->getInvoiceId() !== null) {
            $dataArray['invoice_id'] = $data->getInvoiceId();
        }
        if ($data->isInitialized('generatedAt') && $data->getGeneratedAt() !== null) {
            $dataArray['generated_at'] = $data->getGeneratedAt()->format('Y-m-d\TH:i:sP');
        }
        if ($data->isInitialized('scheduledDate') && $data->getScheduledDate() !== null) {
            $dataArray['scheduled_date'] = $data->getScheduledDate()->format('Y-m-d');
        }
        if ($data->isInitialized('invoiceNumber') && $data->getInvoiceNumber() !== null) {
            $dataArray['invoice_number'] = $data->getInvoiceNumber();
        }
        if ($data->isInitialized('total') && $data->getTotal() !== null) {
            $dataArray['total'] = $data->getTotal();
        }
        if ($data->isInitialized('status') && $data->getStatus() !== null) {
            $dataArray['status'] = $data->getStatus();
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
        return [GenerationHistoryResponse::class => false];
    }
}
