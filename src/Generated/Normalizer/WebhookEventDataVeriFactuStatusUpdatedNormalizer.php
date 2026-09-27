<?php

namespace Lenorix\BeelSdk\Generated\Normalizer;

use Jane\Component\JsonSchemaRuntime\Reference;
use Lenorix\BeelSdk\Generated\Model\WebhookEventDataVeriFactuStatusUpdated;
use Lenorix\BeelSdk\Generated\Runtime\Normalizer\CheckArray;
use Lenorix\BeelSdk\Generated\Runtime\Normalizer\ValidatorTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class WebhookEventDataVeriFactuStatusUpdatedNormalizer implements DenormalizerAwareInterface, DenormalizerInterface, NormalizerAwareInterface, NormalizerInterface
{
    use CheckArray;
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use ValidatorTrait;

    public function supportsDenormalization(mixed $data, string $type, ?string $format = null, array $context = []): bool
    {
        return $type === WebhookEventDataVeriFactuStatusUpdated::class;
    }

    public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
    {
        return is_object($data) && get_class($data) === WebhookEventDataVeriFactuStatusUpdated::class;
    }

    public function denormalize(mixed $data, string $type, ?string $format = null, array $context = []): mixed
    {
        $object = new WebhookEventDataVeriFactuStatusUpdated;
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
        if (\array_key_exists('verifactu_registration_id', $data)) {
            $object->setVerifactuRegistrationId($data['verifactu_registration_id']);
        }
        if (\array_key_exists('previous_status', $data)) {
            $object->setPreviousStatus($data['previous_status']);
        }
        if (\array_key_exists('new_status', $data)) {
            $object->setNewStatus($data['new_status']);
        }
        if (\array_key_exists('qr_url', $data) && $data['qr_url'] !== null) {
            $object->setQrUrl($data['qr_url']);
        } elseif (\array_key_exists('qr_url', $data) && $data['qr_url'] === null) {
            $object->setQrUrl(null);
        }
        if (\array_key_exists('qr_base64', $data) && $data['qr_base64'] !== null) {
            $object->setQrBase64($data['qr_base64']);
        } elseif (\array_key_exists('qr_base64', $data) && $data['qr_base64'] === null) {
            $object->setQrBase64(null);
        }
        if (\array_key_exists('invoice_hash', $data) && $data['invoice_hash'] !== null) {
            $object->setInvoiceHash($data['invoice_hash']);
        } elseif (\array_key_exists('invoice_hash', $data) && $data['invoice_hash'] === null) {
            $object->setInvoiceHash(null);
        }
        if (\array_key_exists('error_code', $data) && $data['error_code'] !== null) {
            $object->setErrorCode($data['error_code']);
        } elseif (\array_key_exists('error_code', $data) && $data['error_code'] === null) {
            $object->setErrorCode(null);
        }
        if (\array_key_exists('error_message', $data) && $data['error_message'] !== null) {
            $object->setErrorMessage($data['error_message']);
        } elseif (\array_key_exists('error_message', $data) && $data['error_message'] === null) {
            $object->setErrorMessage(null);
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
        $dataArray['verifactu_registration_id'] = $data->getVerifactuRegistrationId();
        $dataArray['previous_status'] = $data->getPreviousStatus();
        $dataArray['new_status'] = $data->getNewStatus();
        if ($data->isInitialized('qrUrl') && $data->getQrUrl() !== null) {
            $dataArray['qr_url'] = $data->getQrUrl();
        }
        if ($data->isInitialized('qrBase64') && $data->getQrBase64() !== null) {
            $dataArray['qr_base64'] = $data->getQrBase64();
        }
        if ($data->isInitialized('invoiceHash') && $data->getInvoiceHash() !== null) {
            $dataArray['invoice_hash'] = $data->getInvoiceHash();
        }
        if ($data->isInitialized('errorCode') && $data->getErrorCode() !== null) {
            $dataArray['error_code'] = $data->getErrorCode();
        }
        if ($data->isInitialized('errorMessage') && $data->getErrorMessage() !== null) {
            $dataArray['error_message'] = $data->getErrorMessage();
        }

        return $dataArray;
    }

    public function getSupportedTypes(?string $format = null): array
    {
        return [WebhookEventDataVeriFactuStatusUpdated::class => false];
    }
}
