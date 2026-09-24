<?php

namespace Lenorix\BeelSdk\Generated\Normalizer;

use Jane\Component\JsonSchemaRuntime\Reference;
use Lenorix\BeelSdk\Generated\Model\VeriFactu;
use Lenorix\BeelSdk\Generated\Runtime\Normalizer\CheckArray;
use Lenorix\BeelSdk\Generated\Runtime\Normalizer\InvalidDateException;
use Lenorix\BeelSdk\Generated\Runtime\Normalizer\ValidatorTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class VeriFactuNormalizer implements DenormalizerAwareInterface, DenormalizerInterface, NormalizerAwareInterface, NormalizerInterface
{
    use CheckArray;
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use ValidatorTrait;

    public function supportsDenormalization(mixed $data, string $type, ?string $format = null, array $context = []): bool
    {
        return $type === VeriFactu::class;
    }

    public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
    {
        return is_object($data) && get_class($data) === VeriFactu::class;
    }

    public function denormalize(mixed $data, string $type, ?string $format = null, array $context = []): mixed
    {
        $object = new VeriFactu;
        if ($data === null || \is_array($data) === false) {
            return $object;
        }
        if (isset($data['$ref']) && ! isset($data['type']) && ! isset($data['properties']) && ! isset($data['allOf'])) {
            return new Reference($data['$ref'], $context['document-origin']);
        }
        if (isset($data['$recursiveRef'])) {
            return new Reference($data['$recursiveRef'], $context['document-origin']);
        }
        if (\array_key_exists('enabled', $data) && \is_int($data['enabled'])) {
            $data['enabled'] = (bool) $data['enabled'];
        }
        if (\array_key_exists('enabled', $data)) {
            $object->setEnabled($data['enabled']);
            unset($data['enabled']);
        }
        if (\array_key_exists('invoice_hash', $data)) {
            $object->setInvoiceHash($data['invoice_hash']);
            unset($data['invoice_hash']);
        }
        if (\array_key_exists('chaining_hash', $data)) {
            $object->setChainingHash($data['chaining_hash']);
            unset($data['chaining_hash']);
        }
        if (\array_key_exists('registration_number', $data)) {
            $object->setRegistrationNumber($data['registration_number']);
            unset($data['registration_number']);
        }
        if (\array_key_exists('qr_url', $data)) {
            $object->setQrUrl($data['qr_url']);
            unset($data['qr_url']);
        }
        if (\array_key_exists('qr_base64', $data) && $data['qr_base64'] !== null) {
            $object->setQrBase64($data['qr_base64']);
            unset($data['qr_base64']);
        } elseif (\array_key_exists('qr_base64', $data) && $data['qr_base64'] === null) {
            $object->setQrBase64(null);
            unset($data['qr_base64']);
        }
        if (\array_key_exists('registered_at', $data)) {
            $date = \DateTime::createFromFormat('Y-m-d\TH:i:sP', $data['registered_at']);
            if ($date === false) {
                throw new InvalidDateException($data['registered_at'], 'Y-m-d\TH:i:sP');
            }
            $object->setRegisteredAt($date);
            unset($data['registered_at']);
        }
        if (\array_key_exists('submission_status', $data)) {
            $object->setSubmissionStatus($data['submission_status']);
            unset($data['submission_status']);
        }
        if (\array_key_exists('skip_reason', $data) && $data['skip_reason'] !== null) {
            $object->setSkipReason($data['skip_reason']);
            unset($data['skip_reason']);
        } elseif (\array_key_exists('skip_reason', $data) && $data['skip_reason'] === null) {
            $object->setSkipReason(null);
            unset($data['skip_reason']);
        }
        if (\array_key_exists('error_code', $data) && $data['error_code'] !== null) {
            $object->setErrorCode($data['error_code']);
            unset($data['error_code']);
        } elseif (\array_key_exists('error_code', $data) && $data['error_code'] === null) {
            $object->setErrorCode(null);
            unset($data['error_code']);
        }
        if (\array_key_exists('error_message', $data) && $data['error_message'] !== null) {
            $object->setErrorMessage($data['error_message']);
            unset($data['error_message']);
        } elseif (\array_key_exists('error_message', $data) && $data['error_message'] === null) {
            $object->setErrorMessage(null);
            unset($data['error_message']);
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
        if ($data->isInitialized('enabled') && $data->getEnabled() !== null) {
            $dataArray['enabled'] = $data->getEnabled();
        }
        if ($data->isInitialized('invoiceHash') && $data->getInvoiceHash() !== null) {
            $dataArray['invoice_hash'] = $data->getInvoiceHash();
        }
        if ($data->isInitialized('chainingHash') && $data->getChainingHash() !== null) {
            $dataArray['chaining_hash'] = $data->getChainingHash();
        }
        if ($data->isInitialized('registrationNumber') && $data->getRegistrationNumber() !== null) {
            $dataArray['registration_number'] = $data->getRegistrationNumber();
        }
        if ($data->isInitialized('qrUrl') && $data->getQrUrl() !== null) {
            $dataArray['qr_url'] = $data->getQrUrl();
        }
        if ($data->isInitialized('qrBase64') && $data->getQrBase64() !== null) {
            $dataArray['qr_base64'] = $data->getQrBase64();
        }
        if ($data->isInitialized('registeredAt') && $data->getRegisteredAt() !== null) {
            $dataArray['registered_at'] = $data->getRegisteredAt()->format('Y-m-d\TH:i:sP');
        }
        if ($data->isInitialized('submissionStatus') && $data->getSubmissionStatus() !== null) {
            $dataArray['submission_status'] = $data->getSubmissionStatus();
        }
        if ($data->isInitialized('skipReason') && $data->getSkipReason() !== null) {
            $dataArray['skip_reason'] = $data->getSkipReason();
        }
        if ($data->isInitialized('errorCode') && $data->getErrorCode() !== null) {
            $dataArray['error_code'] = $data->getErrorCode();
        }
        if ($data->isInitialized('errorMessage') && $data->getErrorMessage() !== null) {
            $dataArray['error_message'] = $data->getErrorMessage();
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
        return [VeriFactu::class => false];
    }
}
