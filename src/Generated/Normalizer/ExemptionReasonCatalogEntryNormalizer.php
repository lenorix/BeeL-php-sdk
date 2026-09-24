<?php

namespace Lenorix\BeelSdk\Generated\Normalizer;

use Jane\Component\JsonSchemaRuntime\Reference;
use Lenorix\BeelSdk\Generated\Model\ExemptionReasonCatalogEntry;
use Lenorix\BeelSdk\Generated\Runtime\Normalizer\CheckArray;
use Lenorix\BeelSdk\Generated\Runtime\Normalizer\ValidatorTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class ExemptionReasonCatalogEntryNormalizer implements DenormalizerAwareInterface, DenormalizerInterface, NormalizerAwareInterface, NormalizerInterface
{
    use CheckArray;
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use ValidatorTrait;

    public function supportsDenormalization(mixed $data, string $type, ?string $format = null, array $context = []): bool
    {
        return $type === ExemptionReasonCatalogEntry::class;
    }

    public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
    {
        return is_object($data) && get_class($data) === ExemptionReasonCatalogEntry::class;
    }

    public function denormalize(mixed $data, string $type, ?string $format = null, array $context = []): mixed
    {
        $object = new ExemptionReasonCatalogEntry;
        if ($data === null || \is_array($data) === false) {
            return $object;
        }
        if (isset($data['$ref']) && ! isset($data['type']) && ! isset($data['properties']) && ! isset($data['allOf'])) {
            return new Reference($data['$ref'], $context['document-origin']);
        }
        if (isset($data['$recursiveRef'])) {
            return new Reference($data['$recursiveRef'], $context['document-origin']);
        }
        if (\array_key_exists('available_as_default', $data) && \is_int($data['available_as_default'])) {
            $data['available_as_default'] = (bool) $data['available_as_default'];
        }
        if (\array_key_exists('available_on_invoice_line', $data) && \is_int($data['available_on_invoice_line'])) {
            $data['available_on_invoice_line'] = (bool) $data['available_on_invoice_line'];
        }
        if (\array_key_exists('code', $data)) {
            $object->setCode($data['code']);
            unset($data['code']);
        }
        if (\array_key_exists('label', $data)) {
            $object->setLabel($data['label']);
            unset($data['label']);
        }
        if (\array_key_exists('description', $data)) {
            $object->setDescription($data['description']);
            unset($data['description']);
        }
        if (\array_key_exists('category', $data)) {
            $object->setCategory($data['category']);
            unset($data['category']);
        }
        if (\array_key_exists('classification_type', $data)) {
            $object->setClassificationType($data['classification_type']);
            unset($data['classification_type']);
        }
        if (\array_key_exists('available_as_default', $data)) {
            $object->setAvailableAsDefault($data['available_as_default']);
            unset($data['available_as_default']);
        }
        if (\array_key_exists('available_on_invoice_line', $data)) {
            $object->setAvailableOnInvoiceLine($data['available_on_invoice_line']);
            unset($data['available_on_invoice_line']);
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
        $dataArray['code'] = $data->getCode();
        $dataArray['label'] = $data->getLabel();
        $dataArray['description'] = $data->getDescription();
        $dataArray['category'] = $data->getCategory();
        $dataArray['classification_type'] = $data->getClassificationType();
        $dataArray['available_as_default'] = $data->getAvailableAsDefault();
        $dataArray['available_on_invoice_line'] = $data->getAvailableOnInvoiceLine();
        foreach ($data->additionalPropertyEntries() as $key => $value) {
            if (preg_match('/.*/', (string) $key)) {
                $dataArray[$key] = $value;
            }
        }

        return $dataArray;
    }

    public function getSupportedTypes(?string $format = null): array
    {
        return [ExemptionReasonCatalogEntry::class => false];
    }
}
