<?php

namespace Lenorix\BeelSdk\Generated\Normalizer;

use Jane\Component\JsonSchemaRuntime\Reference;
use Lenorix\BeelSdk\Generated\Model\LegalRepresentativeAddress;
use Lenorix\BeelSdk\Generated\Runtime\Normalizer\CheckArray;
use Lenorix\BeelSdk\Generated\Runtime\Normalizer\ValidatorTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class LegalRepresentativeAddressNormalizer implements DenormalizerAwareInterface, DenormalizerInterface, NormalizerAwareInterface, NormalizerInterface
{
    use CheckArray;
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use ValidatorTrait;

    public function supportsDenormalization(mixed $data, string $type, ?string $format = null, array $context = []): bool
    {
        return $type === LegalRepresentativeAddress::class;
    }

    public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
    {
        return is_object($data) && get_class($data) === LegalRepresentativeAddress::class;
    }

    public function denormalize(mixed $data, string $type, ?string $format = null, array $context = []): mixed
    {
        $object = new LegalRepresentativeAddress;
        if ($data === null || \is_array($data) === false) {
            return $object;
        }
        if (isset($data['$ref']) && ! isset($data['type']) && ! isset($data['properties']) && ! isset($data['allOf'])) {
            return new Reference($data['$ref'], $context['document-origin']);
        }
        if (isset($data['$recursiveRef'])) {
            return new Reference($data['$recursiveRef'], $context['document-origin']);
        }
        if (\array_key_exists('street', $data)) {
            $object->setStreet($data['street']);
            unset($data['street']);
        }
        if (\array_key_exists('number', $data)) {
            $object->setNumber($data['number']);
            unset($data['number']);
        }
        if (\array_key_exists('floor', $data)) {
            $object->setFloor($data['floor']);
            unset($data['floor']);
        }
        if (\array_key_exists('door', $data)) {
            $object->setDoor($data['door']);
            unset($data['door']);
        }
        if (\array_key_exists('postal_code', $data)) {
            $object->setPostalCode($data['postal_code']);
            unset($data['postal_code']);
        }
        if (\array_key_exists('city', $data)) {
            $object->setCity($data['city']);
            unset($data['city']);
        }
        if (\array_key_exists('province', $data)) {
            $object->setProvince($data['province']);
            unset($data['province']);
        }
        if (\array_key_exists('country', $data)) {
            $object->setCountry($data['country']);
            unset($data['country']);
        }
        if (\array_key_exists('country_code', $data)) {
            $object->setCountryCode($data['country_code']);
            unset($data['country_code']);
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
        $dataArray['street'] = $data->getStreet();
        if ($data->isInitialized('number') && $data->getNumber() !== null) {
            $dataArray['number'] = $data->getNumber();
        }
        if ($data->isInitialized('floor') && $data->getFloor() !== null) {
            $dataArray['floor'] = $data->getFloor();
        }
        if ($data->isInitialized('door') && $data->getDoor() !== null) {
            $dataArray['door'] = $data->getDoor();
        }
        $dataArray['postal_code'] = $data->getPostalCode();
        $dataArray['city'] = $data->getCity();
        $dataArray['province'] = $data->getProvince();
        if ($data->isInitialized('country') && $data->getCountry() !== null) {
            $dataArray['country'] = $data->getCountry();
        }
        if ($data->isInitialized('countryCode') && $data->getCountryCode() !== null) {
            $dataArray['country_code'] = $data->getCountryCode();
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
        return [LegalRepresentativeAddress::class => false];
    }
}
