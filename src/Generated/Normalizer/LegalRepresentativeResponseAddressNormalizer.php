<?php

namespace Lenorix\BeelSdk\Generated\Normalizer;

use Jane\Component\JsonSchemaRuntime\Reference;
use Lenorix\BeelSdk\Generated\Model\LegalRepresentativeResponseAddress;
use Lenorix\BeelSdk\Generated\Runtime\Normalizer\CheckArray;
use Lenorix\BeelSdk\Generated\Runtime\Normalizer\ValidatorTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class LegalRepresentativeResponseAddressNormalizer implements DenormalizerAwareInterface, DenormalizerInterface, NormalizerAwareInterface, NormalizerInterface
{
    use CheckArray;
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use ValidatorTrait;

    public function supportsDenormalization(mixed $data, string $type, ?string $format = null, array $context = []): bool
    {
        return $type === LegalRepresentativeResponseAddress::class;
    }

    public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
    {
        return is_object($data) && get_class($data) === LegalRepresentativeResponseAddress::class;
    }

    public function denormalize(mixed $data, string $type, ?string $format = null, array $context = []): mixed
    {
        $object = new LegalRepresentativeResponseAddress;
        if ($data === null || \is_array($data) === false) {
            return $object;
        }
        if (isset($data['$ref']) && ! isset($data['type']) && ! isset($data['properties']) && ! isset($data['allOf'])) {
            return new Reference($data['$ref'], $context['document-origin']);
        }
        if (isset($data['$recursiveRef'])) {
            return new Reference($data['$recursiveRef'], $context['document-origin']);
        }
        if (\array_key_exists('street', $data) && $data['street'] !== null) {
            $object->setStreet($data['street']);
            unset($data['street']);
        } elseif (\array_key_exists('street', $data) && $data['street'] === null) {
            $object->setStreet(null);
            unset($data['street']);
        }
        if (\array_key_exists('number', $data) && $data['number'] !== null) {
            $object->setNumber($data['number']);
            unset($data['number']);
        } elseif (\array_key_exists('number', $data) && $data['number'] === null) {
            $object->setNumber(null);
            unset($data['number']);
        }
        if (\array_key_exists('floor', $data) && $data['floor'] !== null) {
            $object->setFloor($data['floor']);
            unset($data['floor']);
        } elseif (\array_key_exists('floor', $data) && $data['floor'] === null) {
            $object->setFloor(null);
            unset($data['floor']);
        }
        if (\array_key_exists('door', $data) && $data['door'] !== null) {
            $object->setDoor($data['door']);
            unset($data['door']);
        } elseif (\array_key_exists('door', $data) && $data['door'] === null) {
            $object->setDoor(null);
            unset($data['door']);
        }
        if (\array_key_exists('postal_code', $data) && $data['postal_code'] !== null) {
            $object->setPostalCode($data['postal_code']);
            unset($data['postal_code']);
        } elseif (\array_key_exists('postal_code', $data) && $data['postal_code'] === null) {
            $object->setPostalCode(null);
            unset($data['postal_code']);
        }
        if (\array_key_exists('city', $data) && $data['city'] !== null) {
            $object->setCity($data['city']);
            unset($data['city']);
        } elseif (\array_key_exists('city', $data) && $data['city'] === null) {
            $object->setCity(null);
            unset($data['city']);
        }
        if (\array_key_exists('province', $data) && $data['province'] !== null) {
            $object->setProvince($data['province']);
            unset($data['province']);
        } elseif (\array_key_exists('province', $data) && $data['province'] === null) {
            $object->setProvince(null);
            unset($data['province']);
        }
        if (\array_key_exists('country', $data) && $data['country'] !== null) {
            $object->setCountry($data['country']);
            unset($data['country']);
        } elseif (\array_key_exists('country', $data) && $data['country'] === null) {
            $object->setCountry(null);
            unset($data['country']);
        }
        if (\array_key_exists('country_code', $data) && $data['country_code'] !== null) {
            $object->setCountryCode($data['country_code']);
            unset($data['country_code']);
        } elseif (\array_key_exists('country_code', $data) && $data['country_code'] === null) {
            $object->setCountryCode(null);
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
        if ($data->isInitialized('street') && $data->getStreet() !== null) {
            $dataArray['street'] = $data->getStreet();
        }
        if ($data->isInitialized('number') && $data->getNumber() !== null) {
            $dataArray['number'] = $data->getNumber();
        }
        if ($data->isInitialized('floor') && $data->getFloor() !== null) {
            $dataArray['floor'] = $data->getFloor();
        }
        if ($data->isInitialized('door') && $data->getDoor() !== null) {
            $dataArray['door'] = $data->getDoor();
        }
        if ($data->isInitialized('postalCode') && $data->getPostalCode() !== null) {
            $dataArray['postal_code'] = $data->getPostalCode();
        }
        if ($data->isInitialized('city') && $data->getCity() !== null) {
            $dataArray['city'] = $data->getCity();
        }
        if ($data->isInitialized('province') && $data->getProvince() !== null) {
            $dataArray['province'] = $data->getProvince();
        }
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
        return [LegalRepresentativeResponseAddress::class => false];
    }
}
