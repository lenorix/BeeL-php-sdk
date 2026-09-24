<?php

namespace Lenorix\BeelSdk\Generated\Normalizer;

use Jane\Component\JsonSchemaRuntime\Reference;
use Lenorix\BeelSdk\Generated\Model\RecipientData;
use Lenorix\BeelSdk\Generated\Model\RecipientDataAddress;
use Lenorix\BeelSdk\Generated\Model\RecipientDataAlternativeId;
use Lenorix\BeelSdk\Generated\Runtime\JsonObject;
use Lenorix\BeelSdk\Generated\Runtime\Normalizer\CheckArray;
use Lenorix\BeelSdk\Generated\Runtime\Normalizer\ValidatorTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class RecipientDataNormalizer implements DenormalizerAwareInterface, DenormalizerInterface, NormalizerAwareInterface, NormalizerInterface
{
    use CheckArray;
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use ValidatorTrait;

    public function supportsDenormalization(mixed $data, string $type, ?string $format = null, array $context = []): bool
    {
        return $type === RecipientData::class;
    }

    public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
    {
        return is_object($data) && get_class($data) === RecipientData::class;
    }

    public function denormalize(mixed $data, string $type, ?string $format = null, array $context = []): mixed
    {
        $object = new RecipientData;
        if ($data === null || \is_array($data) === false) {
            return $object;
        }
        if (isset($data['$ref']) && ! isset($data['type']) && ! isset($data['properties']) && ! isset($data['allOf'])) {
            return new Reference($data['$ref'], $context['document-origin']);
        }
        if (isset($data['$recursiveRef'])) {
            return new Reference($data['$recursiveRef'], $context['document-origin']);
        }
        if (\array_key_exists('customer_id', $data) && $data['customer_id'] !== null) {
            $object->setCustomerId($data['customer_id']);
            unset($data['customer_id']);
        } elseif (\array_key_exists('customer_id', $data) && $data['customer_id'] === null) {
            $object->setCustomerId(null);
            unset($data['customer_id']);
        }
        if (\array_key_exists('legal_name', $data)) {
            $object->setLegalName($data['legal_name']);
            unset($data['legal_name']);
        }
        if (\array_key_exists('trade_name', $data) && $data['trade_name'] !== null) {
            $object->setTradeName($data['trade_name']);
            unset($data['trade_name']);
        } elseif (\array_key_exists('trade_name', $data) && $data['trade_name'] === null) {
            $object->setTradeName(null);
            unset($data['trade_name']);
        }
        if (\array_key_exists('nif', $data) && $data['nif'] !== null) {
            $object->setNif($data['nif']);
            unset($data['nif']);
        } elseif (\array_key_exists('nif', $data) && $data['nif'] === null) {
            $object->setNif(null);
            unset($data['nif']);
        }
        if (\array_key_exists('alternative_id', $data)) {
            $object->setAlternativeId($this->denormalizer->denormalize($data['alternative_id'], RecipientDataAlternativeId::class, 'json', $context));
            unset($data['alternative_id']);
        }
        if (\array_key_exists('address', $data)) {
            $object->setAddress($this->denormalizer->denormalize($data['address'], RecipientDataAddress::class, 'json', $context));
            unset($data['address']);
        }
        if (\array_key_exists('phone', $data)) {
            $object->setPhone($data['phone']);
            unset($data['phone']);
        }
        if (\array_key_exists('email', $data)) {
            $object->setEmail($data['email']);
            unset($data['email']);
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
        if ($data->isInitialized('customerId') && $data->getCustomerId() !== null) {
            $dataArray['customer_id'] = $data->getCustomerId();
        }
        $dataArray['legal_name'] = $data->getLegalName();
        if ($data->isInitialized('tradeName') && $data->getTradeName() !== null) {
            $dataArray['trade_name'] = $data->getTradeName();
        }
        if ($data->isInitialized('nif') && $data->getNif() !== null) {
            $dataArray['nif'] = $data->getNif();
        }
        if ($data->isInitialized('alternativeId') && $data->getAlternativeId() !== null) {
            $dataArray['alternative_id'] = $data->getAlternativeId() === null ? null : new JsonObject($this->normalizer->normalize($data->getAlternativeId(), 'json', $context));
        }
        if ($data->isInitialized('address') && $data->getAddress() !== null) {
            $dataArray['address'] = $data->getAddress() === null ? null : new JsonObject($this->normalizer->normalize($data->getAddress(), 'json', $context));
        }
        if ($data->isInitialized('phone') && $data->getPhone() !== null) {
            $dataArray['phone'] = $data->getPhone();
        }
        if ($data->isInitialized('email') && $data->getEmail() !== null) {
            $dataArray['email'] = $data->getEmail();
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
        return [RecipientData::class => false];
    }
}
