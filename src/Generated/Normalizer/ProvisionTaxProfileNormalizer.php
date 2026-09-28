<?php

namespace Lenorix\BeelSdk\Generated\Normalizer;

use Jane\Component\JsonSchemaRuntime\Reference;
use Lenorix\BeelSdk\Generated\Model\Address;
use Lenorix\BeelSdk\Generated\Model\LegalRepresentative;
use Lenorix\BeelSdk\Generated\Model\ProvisionTaxProfile;
use Lenorix\BeelSdk\Generated\Model\TaxInfo;
use Lenorix\BeelSdk\Generated\Runtime\JsonObject;
use Lenorix\BeelSdk\Generated\Runtime\Normalizer\CheckArray;
use Lenorix\BeelSdk\Generated\Runtime\Normalizer\ValidatorTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class ProvisionTaxProfileNormalizer implements DenormalizerAwareInterface, DenormalizerInterface, NormalizerAwareInterface, NormalizerInterface
{
    use CheckArray;
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use ValidatorTrait;

    public function supportsDenormalization(mixed $data, string $type, ?string $format = null, array $context = []): bool
    {
        return $type === ProvisionTaxProfile::class;
    }

    public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
    {
        return is_object($data) && get_class($data) === ProvisionTaxProfile::class;
    }

    public function denormalize(mixed $data, string $type, ?string $format = null, array $context = []): mixed
    {
        $object = new ProvisionTaxProfile;
        if ($data === null || \is_array($data) === false) {
            return $object;
        }
        if (isset($data['$ref']) && ! isset($data['type']) && ! isset($data['properties']) && ! isset($data['allOf'])) {
            return new Reference($data['$ref'], $context['document-origin']);
        }
        if (isset($data['$recursiveRef'])) {
            return new Reference($data['$recursiveRef'], $context['document-origin']);
        }
        if (\array_key_exists('default_irpf_rate', $data) && \is_int($data['default_irpf_rate'])) {
            $data['default_irpf_rate'] = (float) $data['default_irpf_rate'];
        }
        if (\array_key_exists('nif', $data)) {
            $object->setNif($data['nif']);
            unset($data['nif']);
        }
        if (\array_key_exists('legal_name', $data)) {
            $object->setLegalName($data['legal_name']);
            unset($data['legal_name']);
        }
        if (\array_key_exists('entity_type', $data)) {
            $object->setEntityType($data['entity_type']);
            unset($data['entity_type']);
        }
        if (\array_key_exists('address', $data)) {
            $object->setAddress($this->denormalizer->denormalize($data['address'], Address::class, 'json', $context));
            unset($data['address']);
        }
        if (\array_key_exists('legal_form', $data)) {
            $object->setLegalForm($data['legal_form']);
            unset($data['legal_form']);
        }
        if (\array_key_exists('legal_representative', $data)) {
            $object->setLegalRepresentative($this->denormalizer->denormalize($data['legal_representative'], LegalRepresentative::class, 'json', $context));
            unset($data['legal_representative']);
        }
        if (\array_key_exists('trade_name', $data)) {
            $object->setTradeName($data['trade_name']);
            unset($data['trade_name']);
        }
        if (\array_key_exists('default_main_tax', $data)) {
            $object->setDefaultMainTax($this->denormalizer->denormalize($data['default_main_tax'], TaxInfo::class, 'json', $context));
            unset($data['default_main_tax']);
        }
        if (\array_key_exists('default_irpf_rate', $data)) {
            $object->setDefaultIrpfRate($data['default_irpf_rate']);
            unset($data['default_irpf_rate']);
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
        $dataArray['nif'] = $data->getNif();
        $dataArray['legal_name'] = $data->getLegalName();
        $dataArray['entity_type'] = $data->getEntityType();
        $dataArray['address'] = $data->getAddress() === null ? null : new JsonObject($this->normalizer->normalize($data->getAddress(), 'json', $context));
        if ($data->isInitialized('legalForm') && $data->getLegalForm() !== null) {
            $dataArray['legal_form'] = $data->getLegalForm();
        }
        if ($data->isInitialized('legalRepresentative') && $data->getLegalRepresentative() !== null) {
            $dataArray['legal_representative'] = $data->getLegalRepresentative() === null ? null : new JsonObject($this->normalizer->normalize($data->getLegalRepresentative(), 'json', $context));
        }
        if ($data->isInitialized('tradeName') && $data->getTradeName() !== null) {
            $dataArray['trade_name'] = $data->getTradeName();
        }
        if ($data->isInitialized('defaultMainTax') && $data->getDefaultMainTax() !== null) {
            $dataArray['default_main_tax'] = $data->getDefaultMainTax() === null ? null : new JsonObject($this->normalizer->normalize($data->getDefaultMainTax(), 'json', $context));
        }
        if ($data->isInitialized('defaultIrpfRate') && $data->getDefaultIrpfRate() !== null) {
            $dataArray['default_irpf_rate'] = $data->getDefaultIrpfRate();
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
        return [ProvisionTaxProfile::class => false];
    }
}
