<?php

namespace Lenorix\BeelSdk\Generated\Normalizer;

use Jane\Component\JsonSchemaRuntime\Reference;
use Lenorix\BeelSdk\Generated\Model\Invitation;
use Lenorix\BeelSdk\Generated\Runtime\Normalizer\CheckArray;
use Lenorix\BeelSdk\Generated\Runtime\Normalizer\InvalidDateException;
use Lenorix\BeelSdk\Generated\Runtime\Normalizer\ValidatorTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class InvitationNormalizer implements DenormalizerAwareInterface, DenormalizerInterface, NormalizerAwareInterface, NormalizerInterface
{
    use CheckArray;
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use ValidatorTrait;

    public function supportsDenormalization(mixed $data, string $type, ?string $format = null, array $context = []): bool
    {
        return $type === Invitation::class;
    }

    public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
    {
        return is_object($data) && get_class($data) === Invitation::class;
    }

    public function denormalize(mixed $data, string $type, ?string $format = null, array $context = []): mixed
    {
        $object = new Invitation;
        if ($data === null || \is_array($data) === false) {
            return $object;
        }
        if (isset($data['$ref']) && ! isset($data['type']) && ! isset($data['properties']) && ! isset($data['allOf'])) {
            return new Reference($data['$ref'], $context['document-origin']);
        }
        if (isset($data['$recursiveRef'])) {
            return new Reference($data['$recursiveRef'], $context['document-origin']);
        }
        if (\array_key_exists('invitation_id', $data)) {
            $object->setInvitationId($data['invitation_id']);
            unset($data['invitation_id']);
        }
        if (\array_key_exists('invited_email', $data)) {
            $object->setInvitedEmail($data['invited_email']);
            unset($data['invited_email']);
        }
        if (\array_key_exists('account_role', $data)) {
            $object->setAccountRole($data['account_role']);
            unset($data['account_role']);
        }
        if (\array_key_exists('expires_at', $data)) {
            $date = \DateTime::createFromFormat('Y-m-d\TH:i:sP', $data['expires_at']);
            if ($date === false) {
                throw new InvalidDateException($data['expires_at'], 'Y-m-d\TH:i:sP');
            }
            $object->setExpiresAt($date);
            unset($data['expires_at']);
        }
        if (\array_key_exists('token', $data)) {
            $object->setToken($data['token']);
            unset($data['token']);
        }
        if (\array_key_exists('invitation_url', $data) && $data['invitation_url'] !== null) {
            $object->setInvitationUrl($data['invitation_url']);
            unset($data['invitation_url']);
        } elseif (\array_key_exists('invitation_url', $data) && $data['invitation_url'] === null) {
            $object->setInvitationUrl(null);
            unset($data['invitation_url']);
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
        $dataArray['invitation_id'] = $data->getInvitationId();
        $dataArray['invited_email'] = $data->getInvitedEmail();
        $dataArray['account_role'] = $data->getAccountRole();
        $dataArray['expires_at'] = $data->getExpiresAt()->format('Y-m-d\TH:i:sP');
        $dataArray['token'] = $data->getToken();
        if ($data->isInitialized('invitationUrl') && $data->getInvitationUrl() !== null) {
            $dataArray['invitation_url'] = $data->getInvitationUrl();
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
        return [Invitation::class => false];
    }
}
