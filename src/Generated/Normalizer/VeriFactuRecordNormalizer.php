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
class VeriFactuRecordNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use CheckArray;
    use ValidatorTrait;
    public function supportsDenormalization(mixed $data, string $type, ?string $format = null, array $context = []): bool
    {
        return $type === \Lenorix\BeelSdk\Generated\Model\VeriFactuRecord::class;
    }
    public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
    {
        return is_object($data) && get_class($data) === \Lenorix\BeelSdk\Generated\Model\VeriFactuRecord::class;
    }
    public function denormalize(mixed $data, string $type, ?string $format = null, array $context = []): mixed
    {
        $object = new \Lenorix\BeelSdk\Generated\Model\VeriFactuRecord();
        if (null === $data || false === \is_array($data)) {
            return $object;
        }
        if (isset($data['$ref']) && !isset($data['type']) && !isset($data['properties']) && !isset($data['allOf'])) {
            return new Reference($data['$ref'], $context['document-origin']);
        }
        if (isset($data['$recursiveRef'])) {
            return new Reference($data['$recursiveRef'], $context['document-origin']);
        }
        if (\array_key_exists('id', $data)) {
            $object->setId($data['id']);
            unset($data['id']);
        }
        if (\array_key_exists('operation', $data)) {
            $object->setOperation($data['operation']);
            unset($data['operation']);
        }
        if (\array_key_exists('submission_status', $data) && $data['submission_status'] !== null) {
            $object->setSubmissionStatus($data['submission_status']);
            unset($data['submission_status']);
        }
        elseif (\array_key_exists('submission_status', $data) && $data['submission_status'] === null) {
            $object->setSubmissionStatus(null);
            unset($data['submission_status']);
        }
        if (\array_key_exists('invoice_hash', $data) && $data['invoice_hash'] !== null) {
            $object->setInvoiceHash($data['invoice_hash']);
            unset($data['invoice_hash']);
        }
        elseif (\array_key_exists('invoice_hash', $data) && $data['invoice_hash'] === null) {
            $object->setInvoiceHash(null);
            unset($data['invoice_hash']);
        }
        if (\array_key_exists('registration_number', $data) && $data['registration_number'] !== null) {
            $object->setRegistrationNumber($data['registration_number']);
            unset($data['registration_number']);
        }
        elseif (\array_key_exists('registration_number', $data) && $data['registration_number'] === null) {
            $object->setRegistrationNumber(null);
            unset($data['registration_number']);
        }
        if (\array_key_exists('registered_at', $data) && $data['registered_at'] !== null) {
            $object->setRegisteredAt($this->denormalizer->denormalize($data['registered_at'], \DateTime::class, 'json', $context));
            unset($data['registered_at']);
        }
        elseif (\array_key_exists('registered_at', $data) && $data['registered_at'] === null) {
            $object->setRegisteredAt(null);
            unset($data['registered_at']);
        }
        if (\array_key_exists('qr_url', $data) && $data['qr_url'] !== null) {
            $object->setQrUrl($data['qr_url']);
            unset($data['qr_url']);
        }
        elseif (\array_key_exists('qr_url', $data) && $data['qr_url'] === null) {
            $object->setQrUrl(null);
            unset($data['qr_url']);
        }
        if (\array_key_exists('error_code', $data) && $data['error_code'] !== null) {
            $object->setErrorCode($data['error_code']);
            unset($data['error_code']);
        }
        elseif (\array_key_exists('error_code', $data) && $data['error_code'] === null) {
            $object->setErrorCode(null);
            unset($data['error_code']);
        }
        if (\array_key_exists('error_message', $data) && $data['error_message'] !== null) {
            $object->setErrorMessage($data['error_message']);
            unset($data['error_message']);
        }
        elseif (\array_key_exists('error_message', $data) && $data['error_message'] === null) {
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
        $dataArray['id'] = $data->getId();
        $dataArray['operation'] = $data->getOperation();
        if ($data->isInitialized('submissionStatus') && null !== $data->getSubmissionStatus()) {
            $dataArray['submission_status'] = $data->getSubmissionStatus();
        }
        if ($data->isInitialized('invoiceHash') && null !== $data->getInvoiceHash()) {
            $dataArray['invoice_hash'] = $data->getInvoiceHash();
        }
        if ($data->isInitialized('registrationNumber') && null !== $data->getRegistrationNumber()) {
            $dataArray['registration_number'] = $data->getRegistrationNumber();
        }
        if ($data->isInitialized('registeredAt') && null !== $data->getRegisteredAt()) {
            $dataArray['registered_at'] = $this->normalizer->normalize($data->getRegisteredAt(), 'json', $context);
        }
        if ($data->isInitialized('qrUrl') && null !== $data->getQrUrl()) {
            $dataArray['qr_url'] = $data->getQrUrl();
        }
        if ($data->isInitialized('errorCode') && null !== $data->getErrorCode()) {
            $dataArray['error_code'] = $data->getErrorCode();
        }
        if ($data->isInitialized('errorMessage') && null !== $data->getErrorMessage()) {
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
        return [\Lenorix\BeelSdk\Generated\Model\VeriFactuRecord::class => false];
    }
}