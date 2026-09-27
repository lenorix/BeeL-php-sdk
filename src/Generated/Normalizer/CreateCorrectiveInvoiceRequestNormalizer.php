<?php

namespace Lenorix\BeelSdk\Generated\Normalizer;

use Jane\Component\JsonSchemaRuntime\Reference;
use Lenorix\BeelSdk\Generated\Model\CreateCorrectiveInvoiceRequest;
use Lenorix\BeelSdk\Generated\Model\CreateCorrectiveInvoiceRequestLinesItem;
use Lenorix\BeelSdk\Generated\Model\InvoiceProcessingOptions;
use Lenorix\BeelSdk\Generated\Runtime\JsonObject;
use Lenorix\BeelSdk\Generated\Runtime\Normalizer\CheckArray;
use Lenorix\BeelSdk\Generated\Runtime\Normalizer\ValidatorTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class CreateCorrectiveInvoiceRequestNormalizer implements DenormalizerAwareInterface, DenormalizerInterface, NormalizerAwareInterface, NormalizerInterface
{
    use CheckArray;
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use ValidatorTrait;

    public function supportsDenormalization(mixed $data, string $type, ?string $format = null, array $context = []): bool
    {
        return $type === CreateCorrectiveInvoiceRequest::class;
    }

    public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
    {
        return is_object($data) && get_class($data) === CreateCorrectiveInvoiceRequest::class;
    }

    public function denormalize(mixed $data, string $type, ?string $format = null, array $context = []): mixed
    {
        $object = new CreateCorrectiveInvoiceRequest;
        if ($data === null || \is_array($data) === false) {
            return $object;
        }
        if (isset($data['$ref']) && ! isset($data['type']) && ! isset($data['properties']) && ! isset($data['allOf'])) {
            return new Reference($data['$ref'], $context['document-origin']);
        }
        if (isset($data['$recursiveRef'])) {
            return new Reference($data['$recursiveRef'], $context['document-origin']);
        }
        if (\array_key_exists('rectification_type', $data)) {
            $object->setRectificationType($data['rectification_type']);
            unset($data['rectification_type']);
        }
        if (\array_key_exists('rectification_code', $data)) {
            $object->setRectificationCode($data['rectification_code']);
            unset($data['rectification_code']);
        }
        if (\array_key_exists('reason', $data)) {
            $object->setReason($data['reason']);
            unset($data['reason']);
        }
        if (\array_key_exists('lines', $data)) {
            $values = [];
            foreach ($data['lines'] as $value) {
                $values[] = $this->denormalizer->denormalize($value, CreateCorrectiveInvoiceRequestLinesItem::class, 'json', $context);
            }
            $object->setLines($values);
            unset($data['lines']);
        }
        if (\array_key_exists('notes', $data)) {
            $object->setNotes($data['notes']);
            unset($data['notes']);
        }
        if (\array_key_exists('series_id', $data)) {
            $object->setSeriesId($data['series_id']);
            unset($data['series_id']);
        }
        if (\array_key_exists('external_ref', $data)) {
            $object->setExternalRef($data['external_ref']);
            unset($data['external_ref']);
        }
        if (\array_key_exists('metadata', $data)) {
            $values_1 = new JsonObject;
            foreach ($data['metadata'] as $key => $value_1) {
                $values_1[$key] = $value_1;
            }
            $object->setMetadata($values_1);
            unset($data['metadata']);
        }
        if (\array_key_exists('options', $data)) {
            $object->setOptions($this->denormalizer->denormalize($data['options'], InvoiceProcessingOptions::class, 'json', $context));
            unset($data['options']);
        }
        foreach ($data as $key_1 => $value_2) {
            if (preg_match('/.*/', (string) $key_1)) {
                $object[$key_1] = $value_2;
            }
        }

        return $object;
    }

    public function normalize(mixed $data, ?string $format = null, array $context = []): array|string|int|float|bool|\ArrayObject|null
    {
        $dataArray = [];
        $dataArray['rectification_type'] = $data->getRectificationType();
        $dataArray['rectification_code'] = $data->getRectificationCode();
        $dataArray['reason'] = $data->getReason();
        if ($data->isInitialized('lines') && $data->getLines() !== null) {
            $values = [];
            foreach ($data->getLines() as $value) {
                $values[] = $value === null ? null : new JsonObject($this->normalizer->normalize($value, 'json', $context));
            }
            $dataArray['lines'] = $values;
        }
        if ($data->isInitialized('notes') && $data->getNotes() !== null) {
            $dataArray['notes'] = $data->getNotes();
        }
        if ($data->isInitialized('seriesId') && $data->getSeriesId() !== null) {
            $dataArray['series_id'] = $data->getSeriesId();
        }
        if ($data->isInitialized('externalRef') && $data->getExternalRef() !== null) {
            $dataArray['external_ref'] = $data->getExternalRef();
        }
        if ($data->isInitialized('metadata') && $data->getMetadata() !== null) {
            $values_1 = new JsonObject;
            foreach ($data->getMetadata() as $key => $value_1) {
                $values_1[$key] = $value_1;
            }
            $dataArray['metadata'] = $values_1;
        }
        if ($data->isInitialized('options') && $data->getOptions() !== null) {
            $dataArray['options'] = $data->getOptions() === null ? null : new JsonObject($this->normalizer->normalize($data->getOptions(), 'json', $context));
        }
        foreach ($data->additionalPropertyEntries() as $key_1 => $value_2) {
            if (preg_match('/.*/', (string) $key_1)) {
                $dataArray[$key_1] = $value_2;
            }
        }

        return $dataArray;
    }

    public function getSupportedTypes(?string $format = null): array
    {
        return [CreateCorrectiveInvoiceRequest::class => false];
    }
}
