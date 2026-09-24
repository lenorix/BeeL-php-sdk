<?php

namespace Lenorix\BeelSdk\Generated\Normalizer;

use Jane\Component\JsonSchemaRuntime\Reference;
use Lenorix\BeelSdk\Generated\Model\ProvisionAccountResult;
use Lenorix\BeelSdk\Generated\Runtime\Normalizer\CheckArray;
use Lenorix\BeelSdk\Generated\Runtime\Normalizer\ValidatorTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class ProvisionAccountResultNormalizer implements DenormalizerAwareInterface, DenormalizerInterface, NormalizerAwareInterface, NormalizerInterface
{
    use CheckArray;
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use ValidatorTrait;

    public function supportsDenormalization(mixed $data, string $type, ?string $format = null, array $context = []): bool
    {
        return $type === ProvisionAccountResult::class;
    }

    public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
    {
        return is_object($data) && get_class($data) === ProvisionAccountResult::class;
    }

    public function denormalize(mixed $data, string $type, ?string $format = null, array $context = []): mixed
    {
        $object = new ProvisionAccountResult;
        if ($data === null || \is_array($data) === false) {
            return $object;
        }
        if (isset($data['$ref']) && ! isset($data['type']) && ! isset($data['properties']) && ! isset($data['allOf'])) {
            return new Reference($data['$ref'], $context['document-origin']);
        }
        if (isset($data['$recursiveRef'])) {
            return new Reference($data['$recursiveRef'], $context['document-origin']);
        }
        if (\array_key_exists('person_id', $data) && $data['person_id'] !== null) {
            $object->setPersonId($data['person_id']);
            unset($data['person_id']);
        } elseif (\array_key_exists('person_id', $data) && $data['person_id'] === null) {
            $object->setPersonId(null);
            unset($data['person_id']);
        }
        if (\array_key_exists('account_id', $data)) {
            $object->setAccountId($data['account_id']);
            unset($data['account_id']);
        }
        if (\array_key_exists('status', $data)) {
            $object->setStatus($data['status']);
            unset($data['status']);
        }
        if (\array_key_exists('claim_token', $data) && $data['claim_token'] !== null) {
            $object->setClaimToken($data['claim_token']);
            unset($data['claim_token']);
        } elseif (\array_key_exists('claim_token', $data) && $data['claim_token'] === null) {
            $object->setClaimToken(null);
            unset($data['claim_token']);
        }
        if (\array_key_exists('claim_url', $data) && $data['claim_url'] !== null) {
            $object->setClaimUrl($data['claim_url']);
            unset($data['claim_url']);
        } elseif (\array_key_exists('claim_url', $data) && $data['claim_url'] === null) {
            $object->setClaimUrl(null);
            unset($data['claim_url']);
        }
        if (\array_key_exists('company_id', $data) && $data['company_id'] !== null) {
            $object->setCompanyId($data['company_id']);
            unset($data['company_id']);
        } elseif (\array_key_exists('company_id', $data) && $data['company_id'] === null) {
            $object->setCompanyId(null);
            unset($data['company_id']);
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
        if ($data->isInitialized('personId') && $data->getPersonId() !== null) {
            $dataArray['person_id'] = $data->getPersonId();
        }
        $dataArray['account_id'] = $data->getAccountId();
        $dataArray['status'] = $data->getStatus();
        if ($data->isInitialized('claimToken') && $data->getClaimToken() !== null) {
            $dataArray['claim_token'] = $data->getClaimToken();
        }
        if ($data->isInitialized('claimUrl') && $data->getClaimUrl() !== null) {
            $dataArray['claim_url'] = $data->getClaimUrl();
        }
        if ($data->isInitialized('companyId') && $data->getCompanyId() !== null) {
            $dataArray['company_id'] = $data->getCompanyId();
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
        return [ProvisionAccountResult::class => false];
    }
}
