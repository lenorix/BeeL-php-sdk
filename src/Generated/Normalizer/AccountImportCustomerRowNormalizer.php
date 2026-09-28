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
class AccountImportCustomerRowNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use CheckArray;
    use ValidatorTrait;
    public function supportsDenormalization(mixed $data, string $type, ?string $format = null, array $context = []): bool
    {
        return $type === \Lenorix\BeelSdk\Generated\Model\AccountImportCustomerRow::class;
    }
    public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
    {
        return is_object($data) && get_class($data) === \Lenorix\BeelSdk\Generated\Model\AccountImportCustomerRow::class;
    }
    public function denormalize(mixed $data, string $type, ?string $format = null, array $context = []): mixed
    {
        $object = new \Lenorix\BeelSdk\Generated\Model\AccountImportCustomerRow();
        if (null === $data || false === \is_array($data)) {
            return $object;
        }
        if (isset($data['$ref']) && !isset($data['type']) && !isset($data['properties']) && !isset($data['allOf'])) {
            return new Reference($data['$ref'], $context['document-origin']);
        }
        if (isset($data['$recursiveRef'])) {
            return new Reference($data['$recursiveRef'], $context['document-origin']);
        }
        if (\array_key_exists('row_number', $data)) {
            $object->setRowNumber($data['row_number']);
            unset($data['row_number']);
        }
        if (\array_key_exists('nif', $data) && $data['nif'] !== null) {
            $object->setNif($data['nif']);
            unset($data['nif']);
        }
        elseif (\array_key_exists('nif', $data) && $data['nif'] === null) {
            $object->setNif(null);
            unset($data['nif']);
        }
        if (\array_key_exists('legal_name', $data) && $data['legal_name'] !== null) {
            $object->setLegalName($data['legal_name']);
            unset($data['legal_name']);
        }
        elseif (\array_key_exists('legal_name', $data) && $data['legal_name'] === null) {
            $object->setLegalName(null);
            unset($data['legal_name']);
        }
        if (\array_key_exists('errors', $data)) {
            $values = [];
            foreach ($data['errors'] as $value) {
                $values[] = $this->denormalizer->denormalize($value, \Lenorix\BeelSdk\Generated\Model\AccountImportIssue::class, 'json', $context);
            }
            $object->setErrors($values);
            unset($data['errors']);
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
        $dataArray['row_number'] = $data->getRowNumber();
        if ($data->isInitialized('nif') && null !== $data->getNif()) {
            $dataArray['nif'] = $data->getNif();
        }
        if ($data->isInitialized('legalName') && null !== $data->getLegalName()) {
            $dataArray['legal_name'] = $data->getLegalName();
        }
        $values = [];
        foreach ($data->getErrors() as $value) {
            $values[] = $value === null ? null : new \Lenorix\BeelSdk\Generated\Runtime\JsonObject($this->normalizer->normalize($value, 'json', $context));
        }
        $dataArray['errors'] = $values;
        foreach ($data->additionalPropertyEntries() as $key => $value_1) {
            if (preg_match('/.*/', (string) $key)) {
                $dataArray[$key] = $value_1;
            }
        }
        return $dataArray;
    }
    public function getSupportedTypes(?string $format = null): array
    {
        return [\Lenorix\BeelSdk\Generated\Model\AccountImportCustomerRow::class => false];
    }
}