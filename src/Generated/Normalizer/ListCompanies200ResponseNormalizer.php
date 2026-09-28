<?php

namespace Lenorix\BeelSdk\Generated\Normalizer;

use Jane\Component\JsonSchemaRuntime\Reference;
use Lenorix\BeelSdk\Generated\Model\ListCompanies200Response;
use Lenorix\BeelSdk\Generated\Model\ListCompanies200ResponseData;
use Lenorix\BeelSdk\Generated\Model\ResponseMeta;
use Lenorix\BeelSdk\Generated\Runtime\JsonObject;
use Lenorix\BeelSdk\Generated\Runtime\Normalizer\CheckArray;
use Lenorix\BeelSdk\Generated\Runtime\Normalizer\ValidatorTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class ListCompanies200ResponseNormalizer implements DenormalizerAwareInterface, DenormalizerInterface, NormalizerAwareInterface, NormalizerInterface
{
    use CheckArray;
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use ValidatorTrait;

    public function supportsDenormalization(mixed $data, string $type, ?string $format = null, array $context = []): bool
    {
        return $type === ListCompanies200Response::class;
    }

    public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
    {
        return is_object($data) && get_class($data) === ListCompanies200Response::class;
    }

    public function denormalize(mixed $data, string $type, ?string $format = null, array $context = []): mixed
    {
        $object = new ListCompanies200Response;
        if ($data === null || \is_array($data) === false) {
            return $object;
        }
        if (isset($data['$ref']) && ! isset($data['type']) && ! isset($data['properties']) && ! isset($data['allOf'])) {
            return new Reference($data['$ref'], $context['document-origin']);
        }
        if (isset($data['$recursiveRef'])) {
            return new Reference($data['$recursiveRef'], $context['document-origin']);
        }
        if (\array_key_exists('success', $data) && \is_int($data['success'])) {
            $data['success'] = (bool) $data['success'];
        }
        if (\array_key_exists('success', $data) && $data['success'] !== null) {
            $object->setSuccess($data['success']);
            unset($data['success']);
        } elseif (\array_key_exists('success', $data) && $data['success'] === null) {
            $object->setSuccess(null);
            unset($data['success']);
        }
        if (\array_key_exists('data', $data)) {
            $object->setData($this->denormalizer->denormalize($data['data'], ListCompanies200ResponseData::class, 'json', $context));
            unset($data['data']);
        }
        if (\array_key_exists('meta', $data) && $data['meta'] !== null) {
            $value = $data['meta'];
            if (is_array($data['meta'])) {
                $value = $this->denormalizer->denormalize($data['meta'], ResponseMeta::class, 'json', $context);
            }
            $object->setMeta($value);
            unset($data['meta']);
        } elseif (\array_key_exists('meta', $data) && $data['meta'] === null) {
            $object->setMeta(null);
            unset($data['meta']);
        }
        foreach ($data as $key => $value_1) {
            if (preg_match('/.*/', (string) $key)) {
                $object[$key] = $value_1;
            }
        }

        return $object;
    }

    public function normalize(mixed $data, ?string $format = null, array $context = []): array|string|int|float|bool|\ArrayObject|null
    {
        $dataArray = [];
        if ($data->isInitialized('success') && $data->getSuccess() !== null) {
            $dataArray['success'] = $data->getSuccess();
        }
        $dataArray['data'] = $data->getData() === null ? null : new JsonObject($this->normalizer->normalize($data->getData(), 'json', $context));
        if ($data->isInitialized('meta') && $data->getMeta() !== null) {
            $value = $data->getMeta();
            if (is_object($data->getMeta())) {
                $value = $data->getMeta() === null ? null : new JsonObject($this->normalizer->normalize($data->getMeta(), 'json', $context));
            }
            $dataArray['meta'] = $value;
        }
        foreach ($data->additionalPropertyEntries() as $key => $value_1) {
            if (preg_match('/.*/', (string) $key)) {
                $dataArray[$key] = $value_1;
            }
        }

        return $dataArray;
    }

    public function getSupportedTypes(?string $format = null): array
    {
        return [ListCompanies200Response::class => false];
    }
}
