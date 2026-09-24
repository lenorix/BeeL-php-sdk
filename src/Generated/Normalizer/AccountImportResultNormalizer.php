<?php

namespace Lenorix\BeelSdk\Generated\Normalizer;

use Jane\Component\JsonSchemaRuntime\Reference;
use Lenorix\BeelSdk\Generated\Model\AccountImportItem;
use Lenorix\BeelSdk\Generated\Model\AccountImportMetadata;
use Lenorix\BeelSdk\Generated\Model\AccountImportResult;
use Lenorix\BeelSdk\Generated\Model\AccountImportResultCustomersSource;
use Lenorix\BeelSdk\Generated\Model\AccountImportResultOwnCompanyCustomers;
use Lenorix\BeelSdk\Generated\Model\AccountImportStatistics;
use Lenorix\BeelSdk\Generated\Runtime\JsonObject;
use Lenorix\BeelSdk\Generated\Runtime\Normalizer\CheckArray;
use Lenorix\BeelSdk\Generated\Runtime\Normalizer\ValidatorTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class AccountImportResultNormalizer implements DenormalizerAwareInterface, DenormalizerInterface, NormalizerAwareInterface, NormalizerInterface
{
    use CheckArray;
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use ValidatorTrait;

    public function supportsDenormalization(mixed $data, string $type, ?string $format = null, array $context = []): bool
    {
        return $type === AccountImportResult::class;
    }

    public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
    {
        return is_object($data) && get_class($data) === AccountImportResult::class;
    }

    public function denormalize(mixed $data, string $type, ?string $format = null, array $context = []): mixed
    {
        $object = new AccountImportResult;
        if ($data === null || \is_array($data) === false) {
            return $object;
        }
        if (isset($data['$ref']) && ! isset($data['type']) && ! isset($data['properties']) && ! isset($data['allOf'])) {
            return new Reference($data['$ref'], $context['document-origin']);
        }
        if (isset($data['$recursiveRef'])) {
            return new Reference($data['$recursiveRef'], $context['document-origin']);
        }
        if (\array_key_exists('metadata', $data)) {
            $object->setMetadata($this->denormalizer->denormalize($data['metadata'], AccountImportMetadata::class, 'json', $context));
            unset($data['metadata']);
        }
        if (\array_key_exists('accounts_validation', $data)) {
            $values = [];
            foreach ($data['accounts_validation'] as $value) {
                $values[] = $this->denormalizer->denormalize($value, AccountImportItem::class, 'json', $context);
            }
            $object->setAccountsValidation($values);
            unset($data['accounts_validation']);
        }
        if (\array_key_exists('customers_source', $data)) {
            $object->setCustomersSource($this->denormalizer->denormalize($data['customers_source'], AccountImportResultCustomersSource::class, 'json', $context));
            unset($data['customers_source']);
        }
        if (\array_key_exists('own_company_customers', $data)) {
            $object->setOwnCompanyCustomers($this->denormalizer->denormalize($data['own_company_customers'], AccountImportResultOwnCompanyCustomers::class, 'json', $context));
            unset($data['own_company_customers']);
        }
        if (\array_key_exists('statistics', $data)) {
            $object->setStatistics($this->denormalizer->denormalize($data['statistics'], AccountImportStatistics::class, 'json', $context));
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
        $dataArray['metadata'] = $data->getMetadata() === null ? null : new JsonObject($this->normalizer->normalize($data->getMetadata(), 'json', $context));
        $values = [];
        foreach ($data->getAccountsValidation() as $value) {
            $values[] = $value === null ? null : new JsonObject($this->normalizer->normalize($value, 'json', $context));
        }
        $dataArray['accounts_validation'] = $values;
        if ($data->isInitialized('customersSource') && $data->getCustomersSource() !== null) {
            $dataArray['customers_source'] = $data->getCustomersSource() === null ? null : new JsonObject($this->normalizer->normalize($data->getCustomersSource(), 'json', $context));
        }
        if ($data->isInitialized('ownCompanyCustomers') && $data->getOwnCompanyCustomers() !== null) {
            $dataArray['own_company_customers'] = $data->getOwnCompanyCustomers() === null ? null : new JsonObject($this->normalizer->normalize($data->getOwnCompanyCustomers(), 'json', $context));
        }
        $dataArray['statistics'] = $data->getStatistics() === null ? null : new JsonObject($this->normalizer->normalize($data->getStatistics(), 'json', $context));
        foreach ($data->additionalPropertyEntries() as $key => $value_1) {
            if (preg_match('/.*/', (string) $key)) {
                $dataArray[$key] = $value_1;
            }
        }

        return $dataArray;
    }

    public function getSupportedTypes(?string $format = null): array
    {
        return [AccountImportResult::class => false];
    }
}
