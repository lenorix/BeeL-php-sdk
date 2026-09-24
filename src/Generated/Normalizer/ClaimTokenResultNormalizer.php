<?php

namespace Lenorix\BeelSdk\Generated\Normalizer;

use Jane\Component\JsonSchemaRuntime\Reference;
use Lenorix\BeelSdk\Generated\Model\ClaimTokenResult;
use Lenorix\BeelSdk\Generated\Runtime\Normalizer\CheckArray;
use Lenorix\BeelSdk\Generated\Runtime\Normalizer\InvalidDateException;
use Lenorix\BeelSdk\Generated\Runtime\Normalizer\ValidatorTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class ClaimTokenResultNormalizer implements DenormalizerAwareInterface, DenormalizerInterface, NormalizerAwareInterface, NormalizerInterface
{
    use CheckArray;
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use ValidatorTrait;

    public function supportsDenormalization(mixed $data, string $type, ?string $format = null, array $context = []): bool
    {
        return $type === ClaimTokenResult::class;
    }

    public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
    {
        return is_object($data) && get_class($data) === ClaimTokenResult::class;
    }

    public function denormalize(mixed $data, string $type, ?string $format = null, array $context = []): mixed
    {
        $object = new ClaimTokenResult;
        if ($data === null || \is_array($data) === false) {
            return $object;
        }
        if (isset($data['$ref']) && ! isset($data['type']) && ! isset($data['properties']) && ! isset($data['allOf'])) {
            return new Reference($data['$ref'], $context['document-origin']);
        }
        if (isset($data['$recursiveRef'])) {
            return new Reference($data['$recursiveRef'], $context['document-origin']);
        }
        if (\array_key_exists('person_id', $data)) {
            $object->setPersonId($data['person_id']);
            unset($data['person_id']);
        }
        if (\array_key_exists('claim_token', $data)) {
            $object->setClaimToken($data['claim_token']);
            unset($data['claim_token']);
        }
        if (\array_key_exists('claim_url', $data)) {
            $object->setClaimUrl($data['claim_url']);
            unset($data['claim_url']);
        }
        if (\array_key_exists('expires_at', $data)) {
            $date = \DateTime::createFromFormat('Y-m-d\TH:i:sP', $data['expires_at']);
            if ($date === false) {
                throw new InvalidDateException($data['expires_at'], 'Y-m-d\TH:i:sP');
            }
            $object->setExpiresAt($date);
            unset($data['expires_at']);
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
        $dataArray['person_id'] = $data->getPersonId();
        $dataArray['claim_token'] = $data->getClaimToken();
        $dataArray['claim_url'] = $data->getClaimUrl();
        $dataArray['expires_at'] = $data->getExpiresAt()->format('Y-m-d\TH:i:sP');
        foreach ($data->additionalPropertyEntries() as $key => $value) {
            if (preg_match('/.*/', (string) $key)) {
                $dataArray[$key] = $value;
            }
        }

        return $dataArray;
    }

    public function getSupportedTypes(?string $format = null): array
    {
        return [ClaimTokenResult::class => false];
    }
}
