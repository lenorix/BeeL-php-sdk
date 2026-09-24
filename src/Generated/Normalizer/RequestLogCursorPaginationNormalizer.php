<?php

namespace Lenorix\BeelSdk\Generated\Normalizer;

use Jane\Component\JsonSchemaRuntime\Reference;
use Lenorix\BeelSdk\Generated\Model\RequestLogCursorPagination;
use Lenorix\BeelSdk\Generated\Runtime\Normalizer\CheckArray;
use Lenorix\BeelSdk\Generated\Runtime\Normalizer\ValidatorTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class RequestLogCursorPaginationNormalizer implements DenormalizerAwareInterface, DenormalizerInterface, NormalizerAwareInterface, NormalizerInterface
{
    use CheckArray;
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use ValidatorTrait;

    public function supportsDenormalization(mixed $data, string $type, ?string $format = null, array $context = []): bool
    {
        return $type === RequestLogCursorPagination::class;
    }

    public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
    {
        return is_object($data) && get_class($data) === RequestLogCursorPagination::class;
    }

    public function denormalize(mixed $data, string $type, ?string $format = null, array $context = []): mixed
    {
        $object = new RequestLogCursorPagination;
        if ($data === null || \is_array($data) === false) {
            return $object;
        }
        if (isset($data['$ref']) && ! isset($data['type']) && ! isset($data['properties']) && ! isset($data['allOf'])) {
            return new Reference($data['$ref'], $context['document-origin']);
        }
        if (isset($data['$recursiveRef'])) {
            return new Reference($data['$recursiveRef'], $context['document-origin']);
        }
        if (\array_key_exists('has_next', $data) && \is_int($data['has_next'])) {
            $data['has_next'] = (bool) $data['has_next'];
        }
        if (\array_key_exists('has_previous', $data) && \is_int($data['has_previous'])) {
            $data['has_previous'] = (bool) $data['has_previous'];
        }
        if (\array_key_exists('next_cursor', $data) && $data['next_cursor'] !== null) {
            $object->setNextCursor($data['next_cursor']);
            unset($data['next_cursor']);
        } elseif (\array_key_exists('next_cursor', $data) && $data['next_cursor'] === null) {
            $object->setNextCursor(null);
            unset($data['next_cursor']);
        }
        if (\array_key_exists('prev_cursor', $data) && $data['prev_cursor'] !== null) {
            $object->setPrevCursor($data['prev_cursor']);
            unset($data['prev_cursor']);
        } elseif (\array_key_exists('prev_cursor', $data) && $data['prev_cursor'] === null) {
            $object->setPrevCursor(null);
            unset($data['prev_cursor']);
        }
        if (\array_key_exists('has_next', $data)) {
            $object->setHasNext($data['has_next']);
            unset($data['has_next']);
        }
        if (\array_key_exists('has_previous', $data)) {
            $object->setHasPrevious($data['has_previous']);
            unset($data['has_previous']);
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
        if ($data->isInitialized('nextCursor') && $data->getNextCursor() !== null) {
            $dataArray['next_cursor'] = $data->getNextCursor();
        }
        if ($data->isInitialized('prevCursor') && $data->getPrevCursor() !== null) {
            $dataArray['prev_cursor'] = $data->getPrevCursor();
        }
        $dataArray['has_next'] = $data->getHasNext();
        $dataArray['has_previous'] = $data->getHasPrevious();
        foreach ($data->additionalPropertyEntries() as $key => $value) {
            if (preg_match('/.*/', (string) $key)) {
                $dataArray[$key] = $value;
            }
        }

        return $dataArray;
    }

    public function getSupportedTypes(?string $format = null): array
    {
        return [RequestLogCursorPagination::class => false];
    }
}
