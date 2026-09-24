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
class WebhookEventDataInvoiceIssuedNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use CheckArray;
    use ValidatorTrait;
    public function supportsDenormalization(mixed $data, string $type, ?string $format = null, array $context = []): bool
    {
        return $type === \Lenorix\BeelSdk\Generated\Model\WebhookEventDataInvoiceIssued::class;
    }
    public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
    {
        return is_object($data) && get_class($data) === \Lenorix\BeelSdk\Generated\Model\WebhookEventDataInvoiceIssued::class;
    }
    public function denormalize(mixed $data, string $type, ?string $format = null, array $context = []): mixed
    {
        $object = new \Lenorix\BeelSdk\Generated\Model\WebhookEventDataInvoiceIssued();
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
        if (\array_key_exists('invoice_number', $data)) {
            $object->setInvoiceNumber($data['invoice_number']);
        }
        if (\array_key_exists('customer_email', $data) && $data['customer_email'] !== null) {
            $object->setCustomerEmail($data['customer_email']);
        }
        elseif (\array_key_exists('customer_email', $data) && $data['customer_email'] === null) {
            $object->setCustomerEmail(null);
        }
        if (\array_key_exists('customer_name', $data) && $data['customer_name'] !== null) {
            $object->setCustomerName($data['customer_name']);
        }
        elseif (\array_key_exists('customer_name', $data) && $data['customer_name'] === null) {
            $object->setCustomerName(null);
        }
        return $object;
    }
    public function normalize(mixed $data, ?string $format = null, array $context = []): array|string|int|float|bool|\ArrayObject|null
    {
        $dataArray = [];
        $dataArray['invoice_id'] = $data->getInvoiceId();
        $dataArray['invoice_number'] = $data->getInvoiceNumber();
        if ($data->isInitialized('customerEmail') && null !== $data->getCustomerEmail()) {
            $dataArray['customer_email'] = $data->getCustomerEmail();
        }
        if ($data->isInitialized('customerName') && null !== $data->getCustomerName()) {
            $dataArray['customer_name'] = $data->getCustomerName();
        }
        return $dataArray;
    }
    public function getSupportedTypes(?string $format = null): array
    {
        return [\Lenorix\BeelSdk\Generated\Model\WebhookEventDataInvoiceIssued::class => false];
    }
}