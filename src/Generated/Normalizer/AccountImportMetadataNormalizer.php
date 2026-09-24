<?php

namespace Lenorix\BeelSdk\Generated\Normalizer;

use Jane\Component\JsonSchemaRuntime\Reference;
use Lenorix\BeelSdk\Generated\Model\AccountImportMetadata;
use Lenorix\BeelSdk\Generated\Runtime\Normalizer\CheckArray;
use Lenorix\BeelSdk\Generated\Runtime\Normalizer\ValidatorTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class AccountImportMetadataNormalizer implements DenormalizerAwareInterface, DenormalizerInterface, NormalizerAwareInterface, NormalizerInterface
{
    use CheckArray;
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use ValidatorTrait;

    public function supportsDenormalization(mixed $data, string $type, ?string $format = null, array $context = []): bool
    {
        return $type === AccountImportMetadata::class;
    }

    public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
    {
        return is_object($data) && get_class($data) === AccountImportMetadata::class;
    }

    public function denormalize(mixed $data, string $type, ?string $format = null, array $context = []): mixed
    {
        $object = new AccountImportMetadata;
        if ($data === null || \is_array($data) === false) {
            return $object;
        }
        if (isset($data['$ref']) && ! isset($data['type']) && ! isset($data['properties']) && ! isset($data['allOf'])) {
            return new Reference($data['$ref'], $context['document-origin']);
        }
        if (isset($data['$recursiveRef'])) {
            return new Reference($data['$recursiveRef'], $context['document-origin']);
        }
        if (\array_key_exists('is_dry_run', $data) && \is_int($data['is_dry_run'])) {
            $data['is_dry_run'] = (bool) $data['is_dry_run'];
        }
        if (\array_key_exists('is_dry_run', $data)) {
            $object->setIsDryRun($data['is_dry_run']);
            unset($data['is_dry_run']);
        }
        if (\array_key_exists('total_rows', $data)) {
            $object->setTotalRows($data['total_rows']);
            unset($data['total_rows']);
        }
        if (\array_key_exists('processing_time_ms', $data)) {
            $object->setProcessingTimeMs($data['processing_time_ms']);
            unset($data['processing_time_ms']);
        }
        if (\array_key_exists('accounts_filename', $data) && $data['accounts_filename'] !== null) {
            $object->setAccountsFilename($data['accounts_filename']);
            unset($data['accounts_filename']);
        } elseif (\array_key_exists('accounts_filename', $data) && $data['accounts_filename'] === null) {
            $object->setAccountsFilename(null);
            unset($data['accounts_filename']);
        }
        if (\array_key_exists('customers_filename', $data) && $data['customers_filename'] !== null) {
            $object->setCustomersFilename($data['customers_filename']);
            unset($data['customers_filename']);
        } elseif (\array_key_exists('customers_filename', $data) && $data['customers_filename'] === null) {
            $object->setCustomersFilename(null);
            unset($data['customers_filename']);
        }
        if (\array_key_exists('environment', $data)) {
            $object->setEnvironment($data['environment']);
            unset($data['environment']);
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
        $dataArray['is_dry_run'] = $data->getIsDryRun();
        $dataArray['total_rows'] = $data->getTotalRows();
        $dataArray['processing_time_ms'] = $data->getProcessingTimeMs();
        if ($data->isInitialized('accountsFilename') && $data->getAccountsFilename() !== null) {
            $dataArray['accounts_filename'] = $data->getAccountsFilename();
        }
        if ($data->isInitialized('customersFilename') && $data->getCustomersFilename() !== null) {
            $dataArray['customers_filename'] = $data->getCustomersFilename();
        }
        $dataArray['environment'] = $data->getEnvironment();
        foreach ($data->additionalPropertyEntries() as $key => $value) {
            if (preg_match('/.*/', (string) $key)) {
                $dataArray[$key] = $value;
            }
        }

        return $dataArray;
    }

    public function getSupportedTypes(?string $format = null): array
    {
        return [AccountImportMetadata::class => false];
    }
}
