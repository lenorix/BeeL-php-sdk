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
class AccountImportStatisticsNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use CheckArray;
    use ValidatorTrait;
    public function supportsDenormalization(mixed $data, string $type, ?string $format = null, array $context = []): bool
    {
        return $type === \Lenorix\BeelSdk\Generated\Model\AccountImportStatistics::class;
    }
    public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
    {
        return is_object($data) && get_class($data) === \Lenorix\BeelSdk\Generated\Model\AccountImportStatistics::class;
    }
    public function denormalize(mixed $data, string $type, ?string $format = null, array $context = []): mixed
    {
        $object = new \Lenorix\BeelSdk\Generated\Model\AccountImportStatistics();
        if (null === $data || false === \is_array($data)) {
            return $object;
        }
        if (isset($data['$ref']) && !isset($data['type']) && !isset($data['properties']) && !isset($data['allOf'])) {
            return new Reference($data['$ref'], $context['document-origin']);
        }
        if (isset($data['$recursiveRef'])) {
            return new Reference($data['$recursiveRef'], $context['document-origin']);
        }
        if (\array_key_exists('total_rows', $data)) {
            $object->setTotalRows($data['total_rows']);
            unset($data['total_rows']);
        }
        if (\array_key_exists('valid', $data)) {
            $object->setValid($data['valid']);
            unset($data['valid']);
        }
        if (\array_key_exists('with_warnings', $data)) {
            $object->setWithWarnings($data['with_warnings']);
            unset($data['with_warnings']);
        }
        if (\array_key_exists('already_existed', $data)) {
            $object->setAlreadyExisted($data['already_existed']);
            unset($data['already_existed']);
        }
        if (\array_key_exists('blocked', $data)) {
            $object->setBlocked($data['blocked']);
            unset($data['blocked']);
        }
        if (\array_key_exists('with_errors', $data)) {
            $object->setWithErrors($data['with_errors']);
            unset($data['with_errors']);
        }
        if (\array_key_exists('importable', $data)) {
            $object->setImportable($data['importable']);
            unset($data['importable']);
        }
        if (\array_key_exists('accounts_created', $data)) {
            $object->setAccountsCreated($data['accounts_created']);
            unset($data['accounts_created']);
        }
        if (\array_key_exists('live_activations_created', $data)) {
            $object->setLiveActivationsCreated($data['live_activations_created']);
            unset($data['live_activations_created']);
        }
        if (\array_key_exists('live_activations_pending', $data)) {
            $object->setLiveActivationsPending($data['live_activations_pending']);
            unset($data['live_activations_pending']);
        }
        if (\array_key_exists('series_created', $data)) {
            $object->setSeriesCreated($data['series_created']);
            unset($data['series_created']);
        }
        if (\array_key_exists('customers_created', $data) && $data['customers_created'] !== null) {
            $object->setCustomersCreated($data['customers_created']);
            unset($data['customers_created']);
        }
        elseif (\array_key_exists('customers_created', $data) && $data['customers_created'] === null) {
            $object->setCustomersCreated(null);
            unset($data['customers_created']);
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
        $dataArray['total_rows'] = $data->getTotalRows();
        $dataArray['valid'] = $data->getValid();
        $dataArray['with_warnings'] = $data->getWithWarnings();
        $dataArray['already_existed'] = $data->getAlreadyExisted();
        $dataArray['blocked'] = $data->getBlocked();
        $dataArray['with_errors'] = $data->getWithErrors();
        $dataArray['importable'] = $data->getImportable();
        $dataArray['accounts_created'] = $data->getAccountsCreated();
        $dataArray['live_activations_created'] = $data->getLiveActivationsCreated();
        $dataArray['live_activations_pending'] = $data->getLiveActivationsPending();
        $dataArray['series_created'] = $data->getSeriesCreated();
        if ($data->isInitialized('customersCreated') && null !== $data->getCustomersCreated()) {
            $dataArray['customers_created'] = $data->getCustomersCreated();
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
        return [\Lenorix\BeelSdk\Generated\Model\AccountImportStatistics::class => false];
    }
}