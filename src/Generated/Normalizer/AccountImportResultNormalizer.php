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
class AccountImportResultNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use CheckArray;
    use ValidatorTrait;
    public function supportsDenormalization(mixed $data, string $type, ?string $format = null, array $context = []): bool
    {
        return $type === \Lenorix\BeelSdk\Generated\Model\AccountImportResult::class;
    }
    public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
    {
        return is_object($data) && get_class($data) === \Lenorix\BeelSdk\Generated\Model\AccountImportResult::class;
    }
    public function denormalize(mixed $data, string $type, ?string $format = null, array $context = []): mixed
    {
        $object = new \Lenorix\BeelSdk\Generated\Model\AccountImportResult();
        if (null === $data || false === \is_array($data)) {
            return $object;
        }
        if (isset($data['$ref']) && !isset($data['type']) && !isset($data['properties']) && !isset($data['allOf'])) {
            return new Reference($data['$ref'], $context['document-origin']);
        }
        if (isset($data['$recursiveRef'])) {
            return new Reference($data['$recursiveRef'], $context['document-origin']);
        }
        if (\array_key_exists('metadata', $data)) {
            $object->setMetadata($this->denormalizer->denormalize($data['metadata'], \Lenorix\BeelSdk\Generated\Model\AccountImportMetadata::class, 'json', $context));
            unset($data['metadata']);
        }
        if (\array_key_exists('accounts_validation', $data)) {
            $values = [];
            foreach ($data['accounts_validation'] as $value) {
                $values[] = $this->denormalizer->denormalize($value, \Lenorix\BeelSdk\Generated\Model\AccountImportItem::class, 'json', $context);
            }
            $object->setAccountsValidation($values);
            unset($data['accounts_validation']);
        }
        if (\array_key_exists('customers_source', $data)) {
            $object->setCustomersSource($this->denormalizer->denormalize($data['customers_source'], \Lenorix\BeelSdk\Generated\Model\AccountImportResultCustomersSource::class, 'json', $context));
            unset($data['customers_source']);
        }
        if (\array_key_exists('own_company_customers', $data)) {
            $object->setOwnCompanyCustomers($this->denormalizer->denormalize($data['own_company_customers'], \Lenorix\BeelSdk\Generated\Model\AccountImportResultOwnCompanyCustomers::class, 'json', $context));
            unset($data['own_company_customers']);
        }
        if (\array_key_exists('statistics', $data)) {
            $object->setStatistics($this->denormalizer->denormalize($data['statistics'], \Lenorix\BeelSdk\Generated\Model\AccountImportStatistics::class, 'json', $context));
            unset($data['statistics']);
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
        $dataArray['metadata'] = $data->getMetadata() === null ? null : new \Lenorix\BeelSdk\Generated\Runtime\JsonObject($this->normalizer->normalize($data->getMetadata(), 'json', $context));
        $values = [];
        foreach ($data->getAccountsValidation() as $value) {
            $values[] = $value === null ? null : new \Lenorix\BeelSdk\Generated\Runtime\JsonObject($this->normalizer->normalize($value, 'json', $context));
        }
        $dataArray['accounts_validation'] = $values;
        if ($data->isInitialized('customersSource') && null !== $data->getCustomersSource()) {
            $dataArray['customers_source'] = $data->getCustomersSource() === null ? null : new \Lenorix\BeelSdk\Generated\Runtime\JsonObject($this->normalizer->normalize($data->getCustomersSource(), 'json', $context));
        }
        if ($data->isInitialized('ownCompanyCustomers') && null !== $data->getOwnCompanyCustomers()) {
            $dataArray['own_company_customers'] = $data->getOwnCompanyCustomers() === null ? null : new \Lenorix\BeelSdk\Generated\Runtime\JsonObject($this->normalizer->normalize($data->getOwnCompanyCustomers(), 'json', $context));
        }
        $dataArray['statistics'] = $data->getStatistics() === null ? null : new \Lenorix\BeelSdk\Generated\Runtime\JsonObject($this->normalizer->normalize($data->getStatistics(), 'json', $context));
        foreach ($data->additionalPropertyEntries() as $key => $value_1) {
            if (preg_match('/.*/', (string) $key)) {
                $dataArray[$key] = $value_1;
            }
        }
        return $dataArray;
    }
    public function getSupportedTypes(?string $format = null): array
    {
        return [\Lenorix\BeelSdk\Generated\Model\AccountImportResult::class => false];
    }
}