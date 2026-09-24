<?php

namespace Lenorix\BeelSdk\Generated\Normalizer;

use Jane\Component\JsonSchemaRuntime\Reference;
use Lenorix\BeelSdk\Generated\Model\ProvisionAccountRequest;
use Lenorix\BeelSdk\Generated\Model\ProvisionAccountRequestTaxProfile;
use Lenorix\BeelSdk\Generated\Runtime\JsonObject;
use Lenorix\BeelSdk\Generated\Runtime\Normalizer\CheckArray;
use Lenorix\BeelSdk\Generated\Runtime\Normalizer\ValidatorTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class ProvisionAccountRequestNormalizer implements DenormalizerAwareInterface, DenormalizerInterface, NormalizerAwareInterface, NormalizerInterface
{
    use CheckArray;
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use ValidatorTrait;

    public function supportsDenormalization(mixed $data, string $type, ?string $format = null, array $context = []): bool
    {
        return $type === ProvisionAccountRequest::class;
    }

    public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
    {
        return is_object($data) && get_class($data) === ProvisionAccountRequest::class;
    }

    public function denormalize(mixed $data, string $type, ?string $format = null, array $context = []): mixed
    {
        $object = new ProvisionAccountRequest;
        if ($data === null || \is_array($data) === false) {
            return $object;
        }
        if (isset($data['$ref']) && ! isset($data['type']) && ! isset($data['properties']) && ! isset($data['allOf'])) {
            return new Reference($data['$ref'], $context['document-origin']);
        }
        if (isset($data['$recursiveRef'])) {
            return new Reference($data['$recursiveRef'], $context['document-origin']);
        }
        if (\array_key_exists('send_email', $data) && \is_int($data['send_email'])) {
            $data['send_email'] = (bool) $data['send_email'];
        }
        if (\array_key_exists('email', $data)) {
            $object->setEmail($data['email']);
            unset($data['email']);
        }
        if (\array_key_exists('display_name', $data)) {
            $object->setDisplayName($data['display_name']);
            unset($data['display_name']);
        }
        if (\array_key_exists('external_ref', $data)) {
            $object->setExternalRef($data['external_ref']);
            unset($data['external_ref']);
        }
        if (\array_key_exists('language', $data)) {
            $object->setLanguage($data['language']);
            unset($data['language']);
        }
        if (\array_key_exists('access_level', $data)) {
            $object->setAccessLevel($data['access_level']);
            unset($data['access_level']);
        }
        if (\array_key_exists('tax_profile', $data)) {
            $object->setTaxProfile($this->denormalizer->denormalize($data['tax_profile'], ProvisionAccountRequestTaxProfile::class, 'json', $context));
            unset($data['tax_profile']);
        }
        if (\array_key_exists('send_email', $data)) {
            $object->setSendEmail($data['send_email']);
            unset($data['send_email']);
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
        if ($data->isInitialized('email') && $data->getEmail() !== null) {
            $dataArray['email'] = $data->getEmail();
        }
        $dataArray['display_name'] = $data->getDisplayName();
        $dataArray['external_ref'] = $data->getExternalRef();
        if ($data->isInitialized('language') && $data->getLanguage() !== null) {
            $dataArray['language'] = $data->getLanguage();
        }
        if ($data->isInitialized('accessLevel') && $data->getAccessLevel() !== null) {
            $dataArray['access_level'] = $data->getAccessLevel();
        }
        if ($data->isInitialized('taxProfile') && $data->getTaxProfile() !== null) {
            $dataArray['tax_profile'] = $data->getTaxProfile() === null ? null : new JsonObject($this->normalizer->normalize($data->getTaxProfile(), 'json', $context));
        }
        if ($data->isInitialized('sendEmail') && $data->getSendEmail() !== null) {
            $dataArray['send_email'] = $data->getSendEmail();
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
        return [ProvisionAccountRequest::class => false];
    }
}
