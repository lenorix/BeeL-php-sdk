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
class V1CompaniesCompanyIdSeriesGetResponse200DataPaginationNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use CheckArray;
    use ValidatorTrait;
    public function supportsDenormalization(mixed $data, string $type, ?string $format = null, array $context = []): bool
    {
        return $type === \Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdSeriesGetResponse200DataPagination::class;
    }
    public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
    {
        return is_object($data) && get_class($data) === \Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdSeriesGetResponse200DataPagination::class;
    }
    public function denormalize(mixed $data, string $type, ?string $format = null, array $context = []): mixed
    {
        $object = new \Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdSeriesGetResponse200DataPagination();
        if (null === $data || false === \is_array($data)) {
            return $object;
        }
        if (isset($data['$ref']) && !isset($data['type']) && !isset($data['properties']) && !isset($data['allOf'])) {
            return new Reference($data['$ref'], $context['document-origin']);
        }
        if (isset($data['$recursiveRef'])) {
            return new Reference($data['$recursiveRef'], $context['document-origin']);
        }
        if (\array_key_exists('has_next', $data) && \is_int($data['has_next'])) {
            $data['has_next'] = (bool) $data['has_next'];
        }
        if (\array_key_exists('has_previous', $data) && \is_int($data['has_previous'])) {
            $data['has_previous'] = (bool) $data['has_previous'];
        }
        if (\array_key_exists('current_page', $data)) {
            $object->setCurrentPage($data['current_page']);
            unset($data['current_page']);
        }
        if (\array_key_exists('total_pages', $data)) {
            $object->setTotalPages($data['total_pages']);
            unset($data['total_pages']);
        }
        if (\array_key_exists('total_items', $data)) {
            $object->setTotalItems($data['total_items']);
            unset($data['total_items']);
        }
        if (\array_key_exists('items_per_page', $data)) {
            $object->setItemsPerPage($data['items_per_page']);
            unset($data['items_per_page']);
        }
        if (\array_key_exists('has_next', $data)) {
            $object->setHasNext($data['has_next']);
            unset($data['has_next']);
        }
        if (\array_key_exists('has_previous', $data)) {
            $object->setHasPrevious($data['has_previous']);
            unset($data['has_previous']);
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
        $dataArray['current_page'] = $data->getCurrentPage();
        $dataArray['total_pages'] = $data->getTotalPages();
        $dataArray['total_items'] = $data->getTotalItems();
        $dataArray['items_per_page'] = $data->getItemsPerPage();
        if ($data->isInitialized('hasNext') && null !== $data->getHasNext()) {
            $dataArray['has_next'] = $data->getHasNext();
        }
        if ($data->isInitialized('hasPrevious') && null !== $data->getHasPrevious()) {
            $dataArray['has_previous'] = $data->getHasPrevious();
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
        return [\Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdSeriesGetResponse200DataPagination::class => false];
    }
}