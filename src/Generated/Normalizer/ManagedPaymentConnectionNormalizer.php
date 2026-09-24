<?php

namespace Lenorix\BeelSdk\Generated\Normalizer;

use Jane\Component\JsonSchemaRuntime\Reference;
use Lenorix\BeelSdk\Generated\Model\ManagedPaymentConnection;
use Lenorix\BeelSdk\Generated\Runtime\Normalizer\CheckArray;
use Lenorix\BeelSdk\Generated\Runtime\Normalizer\InvalidDateException;
use Lenorix\BeelSdk\Generated\Runtime\Normalizer\ValidatorTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class ManagedPaymentConnectionNormalizer implements DenormalizerAwareInterface, DenormalizerInterface, NormalizerAwareInterface, NormalizerInterface
{
    use CheckArray;
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use ValidatorTrait;

    public function supportsDenormalization(mixed $data, string $type, ?string $format = null, array $context = []): bool
    {
        return $type === ManagedPaymentConnection::class;
    }

    public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
    {
        return is_object($data) && get_class($data) === ManagedPaymentConnection::class;
    }

    public function denormalize(mixed $data, string $type, ?string $format = null, array $context = []): mixed
    {
        $object = new ManagedPaymentConnection;
        if ($data === null || \is_array($data) === false) {
            return $object;
        }
        if (isset($data['$ref']) && ! isset($data['type']) && ! isset($data['properties']) && ! isset($data['allOf'])) {
            return new Reference($data['$ref'], $context['document-origin']);
        }
        if (isset($data['$recursiveRef'])) {
            return new Reference($data['$recursiveRef'], $context['document-origin']);
        }
        if (\array_key_exists('id', $data)) {
            $object->setId($data['id']);
            unset($data['id']);
        }
        if (\array_key_exists('provider', $data)) {
            $object->setProvider($data['provider']);
            unset($data['provider']);
        }
        if (\array_key_exists('external_account_id', $data)) {
            $object->setExternalAccountId($data['external_account_id']);
            unset($data['external_account_id']);
        }
        if (\array_key_exists('external_account_name', $data) && $data['external_account_name'] !== null) {
            $object->setExternalAccountName($data['external_account_name']);
            unset($data['external_account_name']);
        } elseif (\array_key_exists('external_account_name', $data) && $data['external_account_name'] === null) {
            $object->setExternalAccountName(null);
            unset($data['external_account_name']);
        }
        if (\array_key_exists('environment', $data)) {
            $object->setEnvironment($data['environment']);
            unset($data['environment']);
        }
        if (\array_key_exists('status', $data)) {
            $object->setStatus($data['status']);
            unset($data['status']);
        }
        if (\array_key_exists('connected_at', $data) && $data['connected_at'] !== null) {
            $date = \DateTime::createFromFormat('Y-m-d\TH:i:sP', $data['connected_at']);
            if ($date === false) {
                throw new InvalidDateException($data['connected_at'], 'Y-m-d\TH:i:sP');
            }
            $object->setConnectedAt($date);
            unset($data['connected_at']);
        } elseif (\array_key_exists('connected_at', $data) && $data['connected_at'] === null) {
            $object->setConnectedAt(null);
            unset($data['connected_at']);
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
        $dataArray['id'] = $data->getId();
        $dataArray['provider'] = $data->getProvider();
        $dataArray['external_account_id'] = $data->getExternalAccountId();
        if ($data->isInitialized('externalAccountName') && $data->getExternalAccountName() !== null) {
            $dataArray['external_account_name'] = $data->getExternalAccountName();
        }
        $dataArray['environment'] = $data->getEnvironment();
        $dataArray['status'] = $data->getStatus();
        if ($data->isInitialized('connectedAt') && $data->getConnectedAt() !== null) {
            $dataArray['connected_at'] = $data->getConnectedAt()?->format('Y-m-d\TH:i:sP');
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
        return [ManagedPaymentConnection::class => false];
    }
}
