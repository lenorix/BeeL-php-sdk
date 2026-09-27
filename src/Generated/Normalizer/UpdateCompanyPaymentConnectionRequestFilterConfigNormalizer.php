<?php

namespace Lenorix\BeelSdk\Generated\Normalizer;

use Jane\Component\JsonSchemaRuntime\Reference;
use Lenorix\BeelSdk\Generated\Model\UpdateCompanyPaymentConnectionRequestFilterConfig;
use Lenorix\BeelSdk\Generated\Runtime\Normalizer\CheckArray;
use Lenorix\BeelSdk\Generated\Runtime\Normalizer\ValidatorTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class UpdateCompanyPaymentConnectionRequestFilterConfigNormalizer implements DenormalizerAwareInterface, DenormalizerInterface, NormalizerAwareInterface, NormalizerInterface
{
    use CheckArray;
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use ValidatorTrait;

    public function supportsDenormalization(mixed $data, string $type, ?string $format = null, array $context = []): bool
    {
        return $type === UpdateCompanyPaymentConnectionRequestFilterConfig::class;
    }

    public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
    {
        return is_object($data) && get_class($data) === UpdateCompanyPaymentConnectionRequestFilterConfig::class;
    }

    public function denormalize(mixed $data, string $type, ?string $format = null, array $context = []): mixed
    {
        $object = new UpdateCompanyPaymentConnectionRequestFilterConfig;
        if ($data === null || \is_array($data) === false) {
            return $object;
        }
        if (isset($data['$ref']) && ! isset($data['type']) && ! isset($data['properties']) && ! isset($data['allOf'])) {
            return new Reference($data['$ref'], $context['document-origin']);
        }
        if (isset($data['$recursiveRef'])) {
            return new Reference($data['$recursiveRef'], $context['document-origin']);
        }
        if (\array_key_exists('min_amount', $data) && \is_int($data['min_amount'])) {
            $data['min_amount'] = (float) $data['min_amount'];
        }
        if (\array_key_exists('max_amount', $data) && \is_int($data['max_amount'])) {
            $data['max_amount'] = (float) $data['max_amount'];
        }
        if (\array_key_exists('only_mapped_customers', $data) && \is_int($data['only_mapped_customers'])) {
            $data['only_mapped_customers'] = (bool) $data['only_mapped_customers'];
        }
        if (\array_key_exists('min_amount', $data)) {
            $object->setMinAmount($data['min_amount']);
            unset($data['min_amount']);
        }
        if (\array_key_exists('max_amount', $data)) {
            $object->setMaxAmount($data['max_amount']);
            unset($data['max_amount']);
        }
        if (\array_key_exists('only_mapped_customers', $data)) {
            $object->setOnlyMappedCustomers($data['only_mapped_customers']);
            unset($data['only_mapped_customers']);
        }
        if (\array_key_exists('allowed_customer_ids', $data)) {
            $values = [];
            foreach ($data['allowed_customer_ids'] as $value) {
                $values[] = $value;
            }
            $object->setAllowedCustomerIds($values);
            unset($data['allowed_customer_ids']);
        }
        if (\array_key_exists('excluded_description_patterns', $data)) {
            $values_1 = [];
            foreach ($data['excluded_description_patterns'] as $value_1) {
                $values_1[] = $value_1;
            }
            $object->setExcludedDescriptionPatterns($values_1);
            unset($data['excluded_description_patterns']);
        }
        if (\array_key_exists('required_description_patterns', $data)) {
            $values_2 = [];
            foreach ($data['required_description_patterns'] as $value_2) {
                $values_2[] = $value_2;
            }
            $object->setRequiredDescriptionPatterns($values_2);
            unset($data['required_description_patterns']);
        }
        if (\array_key_exists('disabled_categories', $data)) {
            $values_3 = [];
            foreach ($data['disabled_categories'] as $value_3) {
                $values_3[] = $value_3;
            }
            $object->setDisabledCategories($values_3);
            unset($data['disabled_categories']);
        }
        foreach ($data as $key => $value_4) {
            if (preg_match('/.*/', (string) $key)) {
                $object[$key] = $value_4;
            }
        }

        return $object;
    }

    public function normalize(mixed $data, ?string $format = null, array $context = []): array|string|int|float|bool|\ArrayObject|null
    {
        $dataArray = [];
        if ($data->isInitialized('minAmount') && $data->getMinAmount() !== null) {
            $dataArray['min_amount'] = $data->getMinAmount();
        }
        if ($data->isInitialized('maxAmount') && $data->getMaxAmount() !== null) {
            $dataArray['max_amount'] = $data->getMaxAmount();
        }
        if ($data->isInitialized('onlyMappedCustomers') && $data->getOnlyMappedCustomers() !== null) {
            $dataArray['only_mapped_customers'] = $data->getOnlyMappedCustomers();
        }
        if ($data->isInitialized('allowedCustomerIds') && $data->getAllowedCustomerIds() !== null) {
            $values = [];
            foreach ($data->getAllowedCustomerIds() as $value) {
                $values[] = $value;
            }
            $dataArray['allowed_customer_ids'] = $values;
        }
        if ($data->isInitialized('excludedDescriptionPatterns') && $data->getExcludedDescriptionPatterns() !== null) {
            $values_1 = [];
            foreach ($data->getExcludedDescriptionPatterns() as $value_1) {
                $values_1[] = $value_1;
            }
            $dataArray['excluded_description_patterns'] = $values_1;
        }
        if ($data->isInitialized('requiredDescriptionPatterns') && $data->getRequiredDescriptionPatterns() !== null) {
            $values_2 = [];
            foreach ($data->getRequiredDescriptionPatterns() as $value_2) {
                $values_2[] = $value_2;
            }
            $dataArray['required_description_patterns'] = $values_2;
        }
        if ($data->isInitialized('disabledCategories') && $data->getDisabledCategories() !== null) {
            $values_3 = [];
            foreach ($data->getDisabledCategories() as $value_3) {
                $values_3[] = $value_3;
            }
            $dataArray['disabled_categories'] = $values_3;
        }
        foreach ($data->additionalPropertyEntries() as $key => $value_4) {
            if (preg_match('/.*/', (string) $key)) {
                $dataArray[$key] = $value_4;
            }
        }

        return $dataArray;
    }

    public function getSupportedTypes(?string $format = null): array
    {
        return [UpdateCompanyPaymentConnectionRequestFilterConfig::class => false];
    }
}
