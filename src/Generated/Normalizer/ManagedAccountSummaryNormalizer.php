<?php

namespace Lenorix\BeelSdk\Generated\Normalizer;

use Jane\Component\JsonSchemaRuntime\Reference;
use Lenorix\BeelSdk\Generated\Model\ManagedAccountSummary;
use Lenorix\BeelSdk\Generated\Model\ManagedAccountSummaryClaim;
use Lenorix\BeelSdk\Generated\Runtime\JsonObject;
use Lenorix\BeelSdk\Generated\Runtime\Normalizer\CheckArray;
use Lenorix\BeelSdk\Generated\Runtime\Normalizer\InvalidDateException;
use Lenorix\BeelSdk\Generated\Runtime\Normalizer\ValidatorTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class ManagedAccountSummaryNormalizer implements DenormalizerAwareInterface, DenormalizerInterface, NormalizerAwareInterface, NormalizerInterface
{
    use CheckArray;
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use ValidatorTrait;

    public function supportsDenormalization(mixed $data, string $type, ?string $format = null, array $context = []): bool
    {
        return $type === ManagedAccountSummary::class;
    }

    public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
    {
        return is_object($data) && get_class($data) === ManagedAccountSummary::class;
    }

    public function denormalize(mixed $data, string $type, ?string $format = null, array $context = []): mixed
    {
        $object = new ManagedAccountSummary;
        if ($data === null || \is_array($data) === false) {
            return $object;
        }
        if (isset($data['$ref']) && ! isset($data['type']) && ! isset($data['properties']) && ! isset($data['allOf'])) {
            return new Reference($data['$ref'], $context['document-origin']);
        }
        if (isset($data['$recursiveRef'])) {
            return new Reference($data['$recursiveRef'], $context['document-origin']);
        }
        if (\array_key_exists('representation_signed', $data) && \is_int($data['representation_signed'])) {
            $data['representation_signed'] = (bool) $data['representation_signed'];
        }
        if (\array_key_exists('account_id', $data)) {
            $object->setAccountId($data['account_id']);
            unset($data['account_id']);
        }
        if (\array_key_exists('external_ref', $data)) {
            $object->setExternalRef($data['external_ref']);
            unset($data['external_ref']);
        }
        if (\array_key_exists('display_name', $data)) {
            $object->setDisplayName($data['display_name']);
            unset($data['display_name']);
        }
        if (\array_key_exists('access_level', $data)) {
            $object->setAccessLevel($data['access_level']);
            unset($data['access_level']);
        }
        if (\array_key_exists('status', $data)) {
            $object->setStatus($data['status']);
            unset($data['status']);
        }
        if (\array_key_exists('claim', $data)) {
            $object->setClaim($this->denormalizer->denormalize($data['claim'], ManagedAccountSummaryClaim::class, 'json', $context));
            unset($data['claim']);
        }
        if (\array_key_exists('company_id', $data) && $data['company_id'] !== null) {
            $object->setCompanyId($data['company_id']);
            unset($data['company_id']);
        } elseif (\array_key_exists('company_id', $data) && $data['company_id'] === null) {
            $object->setCompanyId(null);
            unset($data['company_id']);
        }
        if (\array_key_exists('representation_signed', $data)) {
            $object->setRepresentationSigned($data['representation_signed']);
            unset($data['representation_signed']);
        }
        if (\array_key_exists('created_at', $data)) {
            $date = \DateTime::createFromFormat('Y-m-d\TH:i:sP', $data['created_at']);
            if ($date === false) {
                throw new InvalidDateException($data['created_at'], 'Y-m-d\TH:i:sP');
            }
            $object->setCreatedAt($date);
            unset($data['created_at']);
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
        $dataArray['account_id'] = $data->getAccountId();
        $dataArray['external_ref'] = $data->getExternalRef();
        if ($data->isInitialized('displayName') && $data->getDisplayName() !== null) {
            $dataArray['display_name'] = $data->getDisplayName();
        }
        $dataArray['access_level'] = $data->getAccessLevel();
        $dataArray['status'] = $data->getStatus();
        $dataArray['claim'] = $data->getClaim() === null ? null : new JsonObject($this->normalizer->normalize($data->getClaim(), 'json', $context));
        if ($data->isInitialized('companyId') && $data->getCompanyId() !== null) {
            $dataArray['company_id'] = $data->getCompanyId();
        }
        $dataArray['representation_signed'] = $data->getRepresentationSigned();
        $dataArray['created_at'] = $data->getCreatedAt()->format('Y-m-d\TH:i:sP');
        foreach ($data->additionalPropertyEntries() as $key => $value) {
            if (preg_match('/.*/', (string) $key)) {
                $dataArray[$key] = $value;
            }
        }

        return $dataArray;
    }

    public function getSupportedTypes(?string $format = null): array
    {
        return [ManagedAccountSummary::class => false];
    }
}
