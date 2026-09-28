<?php

namespace Lenorix\BeelSdk\Generated\Normalizer;

use Jane\Component\JsonSchemaRuntime\Reference;
use Lenorix\BeelSdk\Generated\Model\InvoiceSeries;
use Lenorix\BeelSdk\Generated\Runtime\Normalizer\CheckArray;
use Lenorix\BeelSdk\Generated\Runtime\Normalizer\ValidatorTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class InvoiceSeriesNormalizer implements DenormalizerAwareInterface, DenormalizerInterface, NormalizerAwareInterface, NormalizerInterface
{
    use CheckArray;
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use ValidatorTrait;

    public function supportsDenormalization(mixed $data, string $type, ?string $format = null, array $context = []): bool
    {
        return $type === InvoiceSeries::class;
    }

    public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
    {
        return is_object($data) && get_class($data) === InvoiceSeries::class;
    }

    public function denormalize(mixed $data, string $type, ?string $format = null, array $context = []): mixed
    {
        $object = new InvoiceSeries;
        if ($data === null || \is_array($data) === false) {
            return $object;
        }
        if (isset($data['$ref']) && ! isset($data['type']) && ! isset($data['properties']) && ! isset($data['allOf'])) {
            return new Reference($data['$ref'], $context['document-origin']);
        }
        if (isset($data['$recursiveRef'])) {
            return new Reference($data['$recursiveRef'], $context['document-origin']);
        }
        if (\array_key_exists('active', $data) && \is_int($data['active'])) {
            $data['active'] = (bool) $data['active'];
        }
        if (\array_key_exists('default_series', $data) && \is_int($data['default_series'])) {
            $data['default_series'] = (bool) $data['default_series'];
        }
        if (\array_key_exists('numbering_locked', $data) && \is_int($data['numbering_locked'])) {
            $data['numbering_locked'] = (bool) $data['numbering_locked'];
        }
        if (\array_key_exists('id', $data)) {
            $object->setId($data['id']);
            unset($data['id']);
        }
        if (\array_key_exists('document_type', $data)) {
            $object->setDocumentType($data['document_type']);
            unset($data['document_type']);
        }
        if (\array_key_exists('name', $data)) {
            $object->setName($data['name']);
            unset($data['name']);
        }
        if (\array_key_exists('code', $data)) {
            $object->setCode($data['code']);
            unset($data['code']);
        }
        if (\array_key_exists('description', $data) && $data['description'] !== null) {
            $object->setDescription($data['description']);
            unset($data['description']);
        } elseif (\array_key_exists('description', $data) && $data['description'] === null) {
            $object->setDescription(null);
            unset($data['description']);
        }
        if (\array_key_exists('format', $data)) {
            $object->setFormat($data['format']);
            unset($data['format']);
        }
        if (\array_key_exists('counter_reset', $data)) {
            $object->setCounterReset($data['counter_reset']);
            unset($data['counter_reset']);
        }
        if (\array_key_exists('initial_number', $data) && $data['initial_number'] !== null) {
            $object->setInitialNumber($data['initial_number']);
            unset($data['initial_number']);
        } elseif (\array_key_exists('initial_number', $data) && $data['initial_number'] === null) {
            $object->setInitialNumber(null);
            unset($data['initial_number']);
        }
        if (\array_key_exists('active', $data)) {
            $object->setActive($data['active']);
            unset($data['active']);
        }
        if (\array_key_exists('default_series', $data)) {
            $object->setDefaultSeries($data['default_series']);
            unset($data['default_series']);
        }
        if (\array_key_exists('numbering_locked', $data) && $data['numbering_locked'] !== null) {
            $object->setNumberingLocked($data['numbering_locked']);
            unset($data['numbering_locked']);
        } elseif (\array_key_exists('numbering_locked', $data) && $data['numbering_locked'] === null) {
            $object->setNumberingLocked(null);
            unset($data['numbering_locked']);
        }
        if (\array_key_exists('created_at', $data) && $data['created_at'] !== null) {
            $object->setCreatedAt($this->denormalizer->denormalize($data['created_at'], \DateTime::class, 'json', $context));
            unset($data['created_at']);
        } elseif (\array_key_exists('created_at', $data) && $data['created_at'] === null) {
            $object->setCreatedAt(null);
            unset($data['created_at']);
        }
        if (\array_key_exists('next_number', $data) && $data['next_number'] !== null) {
            $object->setNextNumber($data['next_number']);
            unset($data['next_number']);
        } elseif (\array_key_exists('next_number', $data) && $data['next_number'] === null) {
            $object->setNextNumber(null);
            unset($data['next_number']);
        }
        if (\array_key_exists('updated_at', $data) && $data['updated_at'] !== null) {
            $object->setUpdatedAt($this->denormalizer->denormalize($data['updated_at'], \DateTime::class, 'json', $context));
            unset($data['updated_at']);
        } elseif (\array_key_exists('updated_at', $data) && $data['updated_at'] === null) {
            $object->setUpdatedAt(null);
            unset($data['updated_at']);
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
        $dataArray['document_type'] = $data->getDocumentType();
        $dataArray['name'] = $data->getName();
        $dataArray['code'] = $data->getCode();
        if ($data->isInitialized('description') && $data->getDescription() !== null) {
            $dataArray['description'] = $data->getDescription();
        }
        $dataArray['format'] = $data->getFormat();
        $dataArray['counter_reset'] = $data->getCounterReset();
        if ($data->isInitialized('initialNumber') && $data->getInitialNumber() !== null) {
            $dataArray['initial_number'] = $data->getInitialNumber();
        }
        $dataArray['active'] = $data->getActive();
        $dataArray['default_series'] = $data->getDefaultSeries();
        if ($data->isInitialized('createdAt') && $data->getCreatedAt() !== null) {
            $dataArray['created_at'] = $this->normalizer->normalize($data->getCreatedAt(), 'json', $context);
        }
        if ($data->isInitialized('updatedAt') && $data->getUpdatedAt() !== null) {
            $dataArray['updated_at'] = $this->normalizer->normalize($data->getUpdatedAt(), 'json', $context);
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
        return [InvoiceSeries::class => false];
    }
}
