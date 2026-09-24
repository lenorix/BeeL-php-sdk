<?php

namespace Lenorix\BeelSdk\Generated\Normalizer;

use Jane\Component\JsonSchemaRuntime\Reference;
use Lenorix\BeelSdk\Generated\Model\Pagination;
use Lenorix\BeelSdk\Generated\Model\RecurringInvoiceResponse;
use Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdRecurringInvoicesGetResponse200Data;
use Lenorix\BeelSdk\Generated\Runtime\JsonObject;
use Lenorix\BeelSdk\Generated\Runtime\Normalizer\CheckArray;
use Lenorix\BeelSdk\Generated\Runtime\Normalizer\ValidatorTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class V1CompaniesCompanyIdRecurringInvoicesGetResponse200DataNormalizer implements DenormalizerAwareInterface, DenormalizerInterface, NormalizerAwareInterface, NormalizerInterface
{
    use CheckArray;
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use ValidatorTrait;

    public function supportsDenormalization(mixed $data, string $type, ?string $format = null, array $context = []): bool
    {
        return $type === V1CompaniesCompanyIdRecurringInvoicesGetResponse200Data::class;
    }

    public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
    {
        return is_object($data) && get_class($data) === V1CompaniesCompanyIdRecurringInvoicesGetResponse200Data::class;
    }

    public function denormalize(mixed $data, string $type, ?string $format = null, array $context = []): mixed
    {
        $object = new V1CompaniesCompanyIdRecurringInvoicesGetResponse200Data;
        if ($data === null || \is_array($data) === false) {
            return $object;
        }
        if (isset($data['$ref']) && ! isset($data['type']) && ! isset($data['properties']) && ! isset($data['allOf'])) {
            return new Reference($data['$ref'], $context['document-origin']);
        }
        if (isset($data['$recursiveRef'])) {
            return new Reference($data['$recursiveRef'], $context['document-origin']);
        }
        if (\array_key_exists('recurring_invoices', $data)) {
            $values = [];
            foreach ($data['recurring_invoices'] as $value) {
                $values[] = $this->denormalizer->denormalize($value, RecurringInvoiceResponse::class, 'json', $context);
            }
            $object->setRecurringInvoices($values);
            unset($data['recurring_invoices']);
        }
        if (\array_key_exists('pagination', $data)) {
            $object->setPagination($this->denormalizer->denormalize($data['pagination'], Pagination::class, 'json', $context));
            unset($data['pagination']);
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
        $values = [];
        foreach ($data->getRecurringInvoices() as $value) {
            $values[] = $value === null ? null : new JsonObject($this->normalizer->normalize($value, 'json', $context));
        }
        $dataArray['recurring_invoices'] = $values;
        if ($data->isInitialized('pagination') && $data->getPagination() !== null) {
            $dataArray['pagination'] = $data->getPagination() === null ? null : new JsonObject($this->normalizer->normalize($data->getPagination(), 'json', $context));
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
        return [V1CompaniesCompanyIdRecurringInvoicesGetResponse200Data::class => false];
    }
}
