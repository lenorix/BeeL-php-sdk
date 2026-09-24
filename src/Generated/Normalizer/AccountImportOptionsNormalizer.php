<?php

namespace Lenorix\BeelSdk\Generated\Normalizer;

use Jane\Component\JsonSchemaRuntime\Reference;
use Lenorix\BeelSdk\Generated\Model\AccountImportOptions;
use Lenorix\BeelSdk\Generated\Model\CreateSeriesRequest;
use Lenorix\BeelSdk\Generated\Runtime\JsonObject;
use Lenorix\BeelSdk\Generated\Runtime\Normalizer\CheckArray;
use Lenorix\BeelSdk\Generated\Runtime\Normalizer\ValidatorTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class AccountImportOptionsNormalizer implements DenormalizerAwareInterface, DenormalizerInterface, NormalizerAwareInterface, NormalizerInterface
{
    use CheckArray;
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use ValidatorTrait;

    public function supportsDenormalization(mixed $data, string $type, ?string $format = null, array $context = []): bool
    {
        return $type === AccountImportOptions::class;
    }

    public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
    {
        return is_object($data) && get_class($data) === AccountImportOptions::class;
    }

    public function denormalize(mixed $data, string $type, ?string $format = null, array $context = []): mixed
    {
        $object = new AccountImportOptions;
        if ($data === null || \is_array($data) === false) {
            return $object;
        }
        if (isset($data['$ref']) && ! isset($data['type']) && ! isset($data['properties']) && ! isset($data['allOf'])) {
            return new Reference($data['$ref'], $context['document-origin']);
        }
        if (isset($data['$recursiveRef'])) {
            return new Reference($data['$recursiveRef'], $context['document-origin']);
        }
        if (\array_key_exists('apply_customers_to_own_company', $data) && \is_int($data['apply_customers_to_own_company'])) {
            $data['apply_customers_to_own_company'] = (bool) $data['apply_customers_to_own_company'];
        }
        if (\array_key_exists('access_level', $data)) {
            $object->setAccessLevel($data['access_level']);
            unset($data['access_level']);
        }
        if (\array_key_exists('series', $data)) {
            $values = [];
            foreach ($data['series'] as $value) {
                $values[] = $this->denormalizer->denormalize($value, CreateSeriesRequest::class, 'json', $context);
            }
            $object->setSeries($values);
            unset($data['series']);
        }
        if (\array_key_exists('apply_customers_to_own_company', $data)) {
            $object->setApplyCustomersToOwnCompany($data['apply_customers_to_own_company']);
            unset($data['apply_customers_to_own_company']);
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
        if ($data->isInitialized('accessLevel') && $data->getAccessLevel() !== null) {
            $dataArray['access_level'] = $data->getAccessLevel();
        }
        if ($data->isInitialized('series') && $data->getSeries() !== null) {
            $values = [];
            foreach ($data->getSeries() as $value) {
                $values[] = $value === null ? null : new JsonObject($this->normalizer->normalize($value, 'json', $context));
            }
            $dataArray['series'] = $values;
        }
        if ($data->isInitialized('applyCustomersToOwnCompany') && $data->getApplyCustomersToOwnCompany() !== null) {
            $dataArray['apply_customers_to_own_company'] = $data->getApplyCustomersToOwnCompany();
        }
        foreach ($data->additionalPropertyEntries() as $key => $value_1) {
            if (preg_match('/.*/', (string) $key)) {
                $dataArray[$key] = $value_1;
            }
        }

        return $dataArray;
    }

    public function getSupportedTypes(?string $format = null): array
    {
        return [AccountImportOptions::class => false];
    }
}
