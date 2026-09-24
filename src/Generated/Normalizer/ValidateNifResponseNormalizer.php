<?php

namespace Lenorix\BeelSdk\Generated\Normalizer;

use Jane\Component\JsonSchemaRuntime\Reference;
use Lenorix\BeelSdk\Generated\Model\ValidateNifResponse;
use Lenorix\BeelSdk\Generated\Runtime\Normalizer\CheckArray;
use Lenorix\BeelSdk\Generated\Runtime\Normalizer\InvalidDateException;
use Lenorix\BeelSdk\Generated\Runtime\Normalizer\ValidatorTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class ValidateNifResponseNormalizer implements DenormalizerAwareInterface, DenormalizerInterface, NormalizerAwareInterface, NormalizerInterface
{
    use CheckArray;
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use ValidatorTrait;

    public function supportsDenormalization(mixed $data, string $type, ?string $format = null, array $context = []): bool
    {
        return $type === ValidateNifResponse::class;
    }

    public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
    {
        return is_object($data) && get_class($data) === ValidateNifResponse::class;
    }

    public function denormalize(mixed $data, string $type, ?string $format = null, array $context = []): mixed
    {
        $object = new ValidateNifResponse;
        if ($data === null || \is_array($data) === false) {
            return $object;
        }
        if (isset($data['$ref']) && ! isset($data['type']) && ! isset($data['properties']) && ! isset($data['allOf'])) {
            return new Reference($data['$ref'], $context['document-origin']);
        }
        if (isset($data['$recursiveRef'])) {
            return new Reference($data['$recursiveRef'], $context['document-origin']);
        }
        if (\array_key_exists('valid', $data) && \is_int($data['valid'])) {
            $data['valid'] = (bool) $data['valid'];
        }
        if (\array_key_exists('legal_name_verified', $data) && \is_int($data['legal_name_verified'])) {
            $data['legal_name_verified'] = (bool) $data['legal_name_verified'];
        }
        if (\array_key_exists('valid', $data)) {
            $object->setValid($data['valid']);
            unset($data['valid']);
        }
        if (\array_key_exists('status', $data)) {
            $object->setStatus($data['status']);
            unset($data['status']);
        }
        if (\array_key_exists('legal_name', $data) && $data['legal_name'] !== null) {
            $object->setLegalName($data['legal_name']);
            unset($data['legal_name']);
        } elseif (\array_key_exists('legal_name', $data) && $data['legal_name'] === null) {
            $object->setLegalName(null);
            unset($data['legal_name']);
        }
        if (\array_key_exists('legal_name_verified', $data)) {
            $object->setLegalNameVerified($data['legal_name_verified']);
            unset($data['legal_name_verified']);
        }
        if (\array_key_exists('census_status', $data)) {
            $object->setCensusStatus($data['census_status']);
            unset($data['census_status']);
        }
        if (\array_key_exists('message', $data)) {
            $object->setMessage($data['message']);
            unset($data['message']);
        }
        if (\array_key_exists('validated_at', $data) && $data['validated_at'] !== null) {
            $date = \DateTime::createFromFormat('Y-m-d\TH:i:sP', $data['validated_at']);
            if ($date === false) {
                throw new InvalidDateException($data['validated_at'], 'Y-m-d\TH:i:sP');
            }
            $object->setValidatedAt($date);
            unset($data['validated_at']);
        } elseif (\array_key_exists('validated_at', $data) && $data['validated_at'] === null) {
            $object->setValidatedAt(null);
            unset($data['validated_at']);
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
        $dataArray['valid'] = $data->getValid();
        $dataArray['status'] = $data->getStatus();
        if ($data->isInitialized('legalName') && $data->getLegalName() !== null) {
            $dataArray['legal_name'] = $data->getLegalName();
        }
        if ($data->isInitialized('legalNameVerified') && $data->getLegalNameVerified() !== null) {
            $dataArray['legal_name_verified'] = $data->getLegalNameVerified();
        }
        if ($data->isInitialized('censusStatus') && $data->getCensusStatus() !== null) {
            $dataArray['census_status'] = $data->getCensusStatus();
        }
        $dataArray['message'] = $data->getMessage();
        if ($data->isInitialized('validatedAt') && $data->getValidatedAt() !== null) {
            $dataArray['validated_at'] = $data->getValidatedAt()?->format('Y-m-d\TH:i:sP');
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
        return [ValidateNifResponse::class => false];
    }
}
