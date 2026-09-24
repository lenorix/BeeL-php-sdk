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
class AccountImportItemNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use CheckArray;
    use ValidatorTrait;
    public function supportsDenormalization(mixed $data, string $type, ?string $format = null, array $context = []): bool
    {
        return $type === \Lenorix\BeelSdk\Generated\Model\AccountImportItem::class;
    }
    public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
    {
        return is_object($data) && get_class($data) === \Lenorix\BeelSdk\Generated\Model\AccountImportItem::class;
    }
    public function denormalize(mixed $data, string $type, ?string $format = null, array $context = []): mixed
    {
        $object = new \Lenorix\BeelSdk\Generated\Model\AccountImportItem();
        if (null === $data || false === \is_array($data)) {
            return $object;
        }
        if (isset($data['$ref']) && !isset($data['type']) && !isset($data['properties']) && !isset($data['allOf'])) {
            return new Reference($data['$ref'], $context['document-origin']);
        }
        if (isset($data['$recursiveRef'])) {
            return new Reference($data['$recursiveRef'], $context['document-origin']);
        }
        if (\array_key_exists('row_number', $data)) {
            $object->setRowNumber($data['row_number']);
            unset($data['row_number']);
        }
        if (\array_key_exists('external_ref', $data) && $data['external_ref'] !== null) {
            $object->setExternalRef($data['external_ref']);
            unset($data['external_ref']);
        }
        elseif (\array_key_exists('external_ref', $data) && $data['external_ref'] === null) {
            $object->setExternalRef(null);
            unset($data['external_ref']);
        }
        if (\array_key_exists('nif', $data) && $data['nif'] !== null) {
            $object->setNif($data['nif']);
            unset($data['nif']);
        }
        elseif (\array_key_exists('nif', $data) && $data['nif'] === null) {
            $object->setNif(null);
            unset($data['nif']);
        }
        if (\array_key_exists('status', $data)) {
            $object->setStatus($data['status']);
            unset($data['status']);
        }
        if (\array_key_exists('live_activation_verdict', $data)) {
            $object->setLiveActivationVerdict($data['live_activation_verdict']);
            unset($data['live_activation_verdict']);
        }
        if (\array_key_exists('account', $data)) {
            $object->setAccount($this->denormalizer->denormalize($data['account'], \Lenorix\BeelSdk\Generated\Model\AccountImportItemAccount::class, 'json', $context));
            unset($data['account']);
        }
        if (\array_key_exists('series', $data)) {
            $values = [];
            foreach ($data['series'] as $value) {
                $values[] = $this->denormalizer->denormalize($value, \Lenorix\BeelSdk\Generated\Model\AccountImportSeriesOutcome::class, 'json', $context);
            }
            $object->setSeries($values);
            unset($data['series']);
        }
        if (\array_key_exists('customers', $data)) {
            $object->setCustomers($this->denormalizer->denormalize($data['customers'], \Lenorix\BeelSdk\Generated\Model\AccountImportItemCustomers::class, 'json', $context));
            unset($data['customers']);
        }
        if (\array_key_exists('errors', $data)) {
            $values_1 = [];
            foreach ($data['errors'] as $value_1) {
                $values_1[] = $this->denormalizer->denormalize($value_1, \Lenorix\BeelSdk\Generated\Model\AccountImportIssue::class, 'json', $context);
            }
            $object->setErrors($values_1);
            unset($data['errors']);
        }
        if (\array_key_exists('warnings', $data)) {
            $values_2 = [];
            foreach ($data['warnings'] as $value_2) {
                $values_2[] = $this->denormalizer->denormalize($value_2, \Lenorix\BeelSdk\Generated\Model\AccountImportIssue::class, 'json', $context);
            }
            $object->setWarnings($values_2);
            unset($data['warnings']);
        }
        foreach ($data as $key => $value_3) {
            if (preg_match('/.*/', (string) $key)) {
                $object[$key] = $value_3;
            }
        }
        return $object;
    }
    public function normalize(mixed $data, ?string $format = null, array $context = []): array|string|int|float|bool|\ArrayObject|null
    {
        $dataArray = [];
        $dataArray['row_number'] = $data->getRowNumber();
        if ($data->isInitialized('externalRef') && null !== $data->getExternalRef()) {
            $dataArray['external_ref'] = $data->getExternalRef();
        }
        if ($data->isInitialized('nif') && null !== $data->getNif()) {
            $dataArray['nif'] = $data->getNif();
        }
        $dataArray['status'] = $data->getStatus();
        if ($data->isInitialized('liveActivationVerdict') && null !== $data->getLiveActivationVerdict()) {
            $dataArray['live_activation_verdict'] = $data->getLiveActivationVerdict();
        }
        if ($data->isInitialized('account') && null !== $data->getAccount()) {
            $dataArray['account'] = $data->getAccount() === null ? null : new \Lenorix\BeelSdk\Generated\Runtime\JsonObject($this->normalizer->normalize($data->getAccount(), 'json', $context));
        }
        $values = [];
        foreach ($data->getSeries() as $value) {
            $values[] = $value === null ? null : new \Lenorix\BeelSdk\Generated\Runtime\JsonObject($this->normalizer->normalize($value, 'json', $context));
        }
        $dataArray['series'] = $values;
        if ($data->isInitialized('customers') && null !== $data->getCustomers()) {
            $dataArray['customers'] = $data->getCustomers() === null ? null : new \Lenorix\BeelSdk\Generated\Runtime\JsonObject($this->normalizer->normalize($data->getCustomers(), 'json', $context));
        }
        $values_1 = [];
        foreach ($data->getErrors() as $value_1) {
            $values_1[] = $value_1 === null ? null : new \Lenorix\BeelSdk\Generated\Runtime\JsonObject($this->normalizer->normalize($value_1, 'json', $context));
        }
        $dataArray['errors'] = $values_1;
        $values_2 = [];
        foreach ($data->getWarnings() as $value_2) {
            $values_2[] = $value_2 === null ? null : new \Lenorix\BeelSdk\Generated\Runtime\JsonObject($this->normalizer->normalize($value_2, 'json', $context));
        }
        $dataArray['warnings'] = $values_2;
        foreach ($data->additionalPropertyEntries() as $key => $value_3) {
            if (preg_match('/.*/', (string) $key)) {
                $dataArray[$key] = $value_3;
            }
        }
        return $dataArray;
    }
    public function getSupportedTypes(?string $format = null): array
    {
        return [\Lenorix\BeelSdk\Generated\Model\AccountImportItem::class => false];
    }
}