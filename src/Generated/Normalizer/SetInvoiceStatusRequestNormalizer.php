<?php

namespace Lenorix\BeelSdk\Generated\Normalizer;

use Jane\Component\JsonSchemaRuntime\Reference;
use Lenorix\BeelSdk\Generated\Model\SetInvoiceStatusRequest;
use Lenorix\BeelSdk\Generated\Model\SetInvoiceStatusRequestPaymentMethod;
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

class SetInvoiceStatusRequestNormalizer implements DenormalizerAwareInterface, DenormalizerInterface, NormalizerAwareInterface, NormalizerInterface
{
    use CheckArray;
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use ValidatorTrait;

    public function supportsDenormalization(mixed $data, string $type, ?string $format = null, array $context = []): bool
    {
        return $type === SetInvoiceStatusRequest::class;
    }

    public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
    {
        return is_object($data) && get_class($data) === SetInvoiceStatusRequest::class;
    }

    public function denormalize(mixed $data, string $type, ?string $format = null, array $context = []): mixed
    {
        $object = new SetInvoiceStatusRequest;
        if ($data === null || \is_array($data) === false) {
            return $object;
        }
        if (isset($data['$ref']) && ! isset($data['type']) && ! isset($data['properties']) && ! isset($data['allOf'])) {
            return new Reference($data['$ref'], $context['document-origin']);
        }
        if (isset($data['$recursiveRef'])) {
            return new Reference($data['$recursiveRef'], $context['document-origin']);
        }
        if (\array_key_exists('status', $data)) {
            $object->setStatus($data['status']);
            unset($data['status']);
        }
        if (\array_key_exists('payment_date', $data)) {
            $date = \DateTime::createFromFormat('Y-m-d', $data['payment_date']);
            if ($date === false) {
                throw new InvalidDateException($data['payment_date'], 'Y-m-d');
            }
            $object->setPaymentDate($date->setTime(0, 0, 0));
            unset($data['payment_date']);
        }
        if (\array_key_exists('payment_method', $data)) {
            $object->setPaymentMethod($this->denormalizer->denormalize($data['payment_method'], SetInvoiceStatusRequestPaymentMethod::class, 'json', $context));
            unset($data['payment_method']);
        }
        if (\array_key_exists('sent_at', $data)) {
            $date_1 = \DateTime::createFromFormat('Y-m-d\TH:i:sP', $data['sent_at']);
            if ($date_1 === false) {
                throw new InvalidDateException($data['sent_at'], 'Y-m-d\TH:i:sP');
            }
            $object->setSentAt($date_1);
            unset($data['sent_at']);
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
        $dataArray['status'] = $data->getStatus();
        if ($data->isInitialized('paymentDate') && $data->getPaymentDate() !== null) {
            $dataArray['payment_date'] = $data->getPaymentDate()->format('Y-m-d');
        }
        if ($data->isInitialized('paymentMethod') && $data->getPaymentMethod() !== null) {
            $dataArray['payment_method'] = $data->getPaymentMethod() === null ? null : new JsonObject($this->normalizer->normalize($data->getPaymentMethod(), 'json', $context));
        }
        if ($data->isInitialized('sentAt') && $data->getSentAt() !== null) {
            $dataArray['sent_at'] = $data->getSentAt()->format('Y-m-d\TH:i:sP');
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
        return [SetInvoiceStatusRequest::class => false];
    }
}
