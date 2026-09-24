<?php

namespace Lenorix\BeelSdk\Generated\Normalizer;

use Jane\Component\JsonSchemaRuntime\Reference;
use Lenorix\BeelSdk\Generated\Model\WebhookEventDataRepresentationSigned;
use Lenorix\BeelSdk\Generated\Runtime\Normalizer\CheckArray;
use Lenorix\BeelSdk\Generated\Runtime\Normalizer\InvalidDateException;
use Lenorix\BeelSdk\Generated\Runtime\Normalizer\ValidatorTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class WebhookEventDataRepresentationSignedNormalizer implements DenormalizerAwareInterface, DenormalizerInterface, NormalizerAwareInterface, NormalizerInterface
{
    use CheckArray;
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use ValidatorTrait;

    public function supportsDenormalization(mixed $data, string $type, ?string $format = null, array $context = []): bool
    {
        return $type === WebhookEventDataRepresentationSigned::class;
    }

    public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
    {
        return is_object($data) && get_class($data) === WebhookEventDataRepresentationSigned::class;
    }

    public function denormalize(mixed $data, string $type, ?string $format = null, array $context = []): mixed
    {
        $object = new WebhookEventDataRepresentationSigned;
        if ($data === null || \is_array($data) === false) {
            return $object;
        }
        if (isset($data['$ref']) && ! isset($data['type']) && ! isset($data['properties']) && ! isset($data['allOf'])) {
            return new Reference($data['$ref'], $context['document-origin']);
        }
        if (isset($data['$recursiveRef'])) {
            return new Reference($data['$recursiveRef'], $context['document-origin']);
        }
        if (\array_key_exists('account_id', $data)) {
            $object->setAccountId($data['account_id']);
        }
        if (\array_key_exists('external_ref', $data)) {
            $object->setExternalRef($data['external_ref']);
        }
        if (\array_key_exists('company_id', $data)) {
            $object->setCompanyId($data['company_id']);
        }
        if (\array_key_exists('nif', $data)) {
            $object->setNif($data['nif']);
        }
        if (\array_key_exists('signed_at', $data)) {
            $date = \DateTime::createFromFormat('Y-m-d\TH:i:sP', $data['signed_at']);
            if ($date === false) {
                throw new InvalidDateException($data['signed_at'], 'Y-m-d\TH:i:sP');
            }
            $object->setSignedAt($date);
        }

        return $object;
    }

    public function normalize(mixed $data, ?string $format = null, array $context = []): array|string|int|float|bool|\ArrayObject|null
    {
        $dataArray = [];
        $dataArray['account_id'] = $data->getAccountId();
        $dataArray['external_ref'] = $data->getExternalRef();
        $dataArray['company_id'] = $data->getCompanyId();
        $dataArray['nif'] = $data->getNif();
        $dataArray['signed_at'] = $data->getSignedAt()->format('Y-m-d\TH:i:sP');

        return $dataArray;
    }

    public function getSupportedTypes(?string $format = null): array
    {
        return [WebhookEventDataRepresentationSigned::class => false];
    }
}
