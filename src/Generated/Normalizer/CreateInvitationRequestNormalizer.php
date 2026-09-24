<?php

namespace Lenorix\BeelSdk\Generated\Normalizer;

use Jane\Component\JsonSchemaRuntime\Reference;
use Lenorix\BeelSdk\Generated\Model\CreateInvitationRequest;
use Lenorix\BeelSdk\Generated\Model\GrantAssignment;
use Lenorix\BeelSdk\Generated\Runtime\JsonObject;
use Lenorix\BeelSdk\Generated\Runtime\Normalizer\CheckArray;
use Lenorix\BeelSdk\Generated\Runtime\Normalizer\ValidatorTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class CreateInvitationRequestNormalizer implements DenormalizerAwareInterface, DenormalizerInterface, NormalizerAwareInterface, NormalizerInterface
{
    use CheckArray;
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use ValidatorTrait;

    public function supportsDenormalization(mixed $data, string $type, ?string $format = null, array $context = []): bool
    {
        return $type === CreateInvitationRequest::class;
    }

    public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
    {
        return is_object($data) && get_class($data) === CreateInvitationRequest::class;
    }

    public function denormalize(mixed $data, string $type, ?string $format = null, array $context = []): mixed
    {
        $object = new CreateInvitationRequest;
        if ($data === null || \is_array($data) === false) {
            return $object;
        }
        if (isset($data['$ref']) && ! isset($data['type']) && ! isset($data['properties']) && ! isset($data['allOf'])) {
            return new Reference($data['$ref'], $context['document-origin']);
        }
        if (isset($data['$recursiveRef'])) {
            return new Reference($data['$recursiveRef'], $context['document-origin']);
        }
        if (\array_key_exists('send_email', $data) && \is_int($data['send_email'])) {
            $data['send_email'] = (bool) $data['send_email'];
        }
        if (\array_key_exists('invited_email', $data)) {
            $object->setInvitedEmail($data['invited_email']);
            unset($data['invited_email']);
        }
        if (\array_key_exists('account_role', $data)) {
            $object->setAccountRole($data['account_role']);
            unset($data['account_role']);
        }
        if (\array_key_exists('send_email', $data)) {
            $object->setSendEmail($data['send_email']);
            unset($data['send_email']);
        }
        if (\array_key_exists('grants', $data)) {
            $values = [];
            foreach ($data['grants'] as $value) {
                $values[] = $this->denormalizer->denormalize($value, GrantAssignment::class, 'json', $context);
            }
            $object->setGrants($values);
            unset($data['grants']);
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
        $dataArray['invited_email'] = $data->getInvitedEmail();
        $dataArray['account_role'] = $data->getAccountRole();
        if ($data->isInitialized('sendEmail') && $data->getSendEmail() !== null) {
            $dataArray['send_email'] = $data->getSendEmail();
        }
        $values = [];
        foreach ($data->getGrants() as $value) {
            $values[] = $value === null ? null : new JsonObject($this->normalizer->normalize($value, 'json', $context));
        }
        $dataArray['grants'] = $values;
        foreach ($data->additionalPropertyEntries() as $key => $value_1) {
            if (preg_match('/.*/', (string) $key)) {
                $dataArray[$key] = $value_1;
            }
        }

        return $dataArray;
    }

    public function getSupportedTypes(?string $format = null): array
    {
        return [CreateInvitationRequest::class => false];
    }
}
