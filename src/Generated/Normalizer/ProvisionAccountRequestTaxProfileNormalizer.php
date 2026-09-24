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
class ProvisionAccountRequestTaxProfileNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use CheckArray;
    use ValidatorTrait;
    public function supportsDenormalization(mixed $data, string $type, ?string $format = null, array $context = []): bool
    {
        return $type === \Lenorix\BeelSdk\Generated\Model\ProvisionAccountRequestTaxProfile::class;
    }
    public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
    {
        return is_object($data) && get_class($data) === \Lenorix\BeelSdk\Generated\Model\ProvisionAccountRequestTaxProfile::class;
    }
    public function denormalize(mixed $data, string $type, ?string $format = null, array $context = []): mixed
    {
        $object = new \Lenorix\BeelSdk\Generated\Model\ProvisionAccountRequestTaxProfile();
        if (null === $data || false === \is_array($data)) {
            return $object;
        }
        if (isset($data['$ref']) && !isset($data['type']) && !isset($data['properties']) && !isset($data['allOf'])) {
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
            $object->setAddress($this->denormalizer->denormalize($data['address'], \Lenorix\BeelSdk\Generated\Model\Address::class, 'json', $context));
            unset($data['address']);
        }
        if (\array_key_exists('legal_form', $data)) {
            $object->setLegalForm($data['legal_form']);
            unset($data['legal_form']);
        }
        if (\array_key_exists('legal_representative', $data)) {
            $object->setLegalRepresentative($this->denormalizer->denormalize($data['legal_representative'], \Lenorix\BeelSdk\Generated\Model\LegalRepresentative::class, 'json', $context));
            unset($data['legal_representative']);
        }
        if (\array_key_exists('trade_name', $data)) {
            $object->setTradeName($data['trade_name']);
            unset($data['trade_name']);
        }
        if (\array_key_exists('default_main_tax', $data)) {
            $object->setDefaultMainTax($this->denormalizer->denormalize($data['default_main_tax'], \Lenorix\BeelSdk\Generated\Model\TaxInfo::class, 'json', $context));
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
        $dataArray['address'] = $data->getAddress() === null ? null : new \Lenorix\BeelSdk\Generated\Runtime\JsonObject($this->normalizer->normalize($data->getAddress(), 'json', $context));
        if ($data->isInitialized('legalForm') && null !== $data->getLegalForm()) {
            $dataArray['legal_form'] = $data->getLegalForm();
        }
        if ($data->isInitialized('legalRepresentative') && null !== $data->getLegalRepresentative()) {
            $dataArray['legal_representative'] = $data->getLegalRepresentative() === null ? null : new \Lenorix\BeelSdk\Generated\Runtime\JsonObject($this->normalizer->normalize($data->getLegalRepresentative(), 'json', $context));
        }
        if ($data->isInitialized('tradeName') && null !== $data->getTradeName()) {
            $dataArray['trade_name'] = $data->getTradeName();
        }
        if ($data->isInitialized('defaultMainTax') && null !== $data->getDefaultMainTax()) {
            $dataArray['default_main_tax'] = $data->getDefaultMainTax() === null ? null : new \Lenorix\BeelSdk\Generated\Runtime\JsonObject($this->normalizer->normalize($data->getDefaultMainTax(), 'json', $context));
        }
        if ($data->isInitialized('defaultIrpfRate') && null !== $data->getDefaultIrpfRate()) {
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
        return [\Lenorix\BeelSdk\Generated\Model\ProvisionAccountRequestTaxProfile::class => false];
    }
}