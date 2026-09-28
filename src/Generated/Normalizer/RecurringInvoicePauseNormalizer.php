<?php

namespace Lenorix\BeelSdk\Generated\Normalizer;

use Jane\Component\JsonSchemaRuntime\Reference;
use Lenorix\BeelSdk\Generated\Model\RecurringInvoicePause;
use Lenorix\BeelSdk\Generated\Runtime\Normalizer\CheckArray;
use Lenorix\BeelSdk\Generated\Runtime\Normalizer\ValidatorTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class RecurringInvoicePauseNormalizer implements DenormalizerAwareInterface, DenormalizerInterface, NormalizerAwareInterface, NormalizerInterface
{
    use CheckArray;
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use ValidatorTrait;

    public function supportsDenormalization(mixed $data, string $type, ?string $format = null, array $context = []): bool
    {
        return $type === RecurringInvoicePause::class;
    }

    public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
    {
        return is_object($data) && get_class($data) === RecurringInvoicePause::class;
    }

    public function denormalize(mixed $data, string $type, ?string $format = null, array $context = []): mixed
    {
        $object = new RecurringInvoicePause;
        if ($data === null || \is_array($data) === false) {
            return $object;
        }
        if (isset($data['$ref']) && ! isset($data['type']) && ! isset($data['properties']) && ! isset($data['allOf'])) {
            return new Reference($data['$ref'], $context['document-origin']);
        }
        if (isset($data['$recursiveRef'])) {
            return new Reference($data['$recursiveRef'], $context['document-origin']);
        }
        if (\array_key_exists('reason', $data) && $data['reason'] !== null) {
            $object->setReason($data['reason']);
            unset($data['reason']);
        } elseif (\array_key_exists('reason', $data) && $data['reason'] === null) {
            $object->setReason(null);
            unset($data['reason']);
        }
        if (\array_key_exists('since', $data) && $data['since'] !== null) {
            $object->setSince($this->denormalizer->denormalize($data['since'], \DateTime::class, 'json', $context));
            unset($data['since']);
        } elseif (\array_key_exists('since', $data) && $data['since'] === null) {
            $object->setSince(null);
            unset($data['since']);
        }
        if (\array_key_exists('blocker', $data) && $data['blocker'] !== null) {
            $object->setBlocker($data['blocker']);
            unset($data['blocker']);
        } elseif (\array_key_exists('blocker', $data) && $data['blocker'] === null) {
            $object->setBlocker(null);
            unset($data['blocker']);
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
        if ($data->isInitialized('reason') && $data->getReason() !== null) {
            $dataArray['reason'] = $data->getReason();
        }
        if ($data->isInitialized('since') && $data->getSince() !== null) {
            $dataArray['since'] = $this->normalizer->normalize($data->getSince(), 'json', $context);
        }
        if ($data->isInitialized('blocker') && $data->getBlocker() !== null) {
            $dataArray['blocker'] = $data->getBlocker();
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
        return [RecurringInvoicePause::class => false];
    }
}
