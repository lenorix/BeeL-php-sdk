<?php

namespace Lenorix\BeelSdk\Generated\Normalizer;

use Jane\Component\JsonSchemaRuntime\Reference;
use Lenorix\BeelSdk\Generated\Model\MemberPermissions;
use Lenorix\BeelSdk\Generated\Runtime\Normalizer\CheckArray;
use Lenorix\BeelSdk\Generated\Runtime\Normalizer\ValidatorTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class MemberPermissionsNormalizer implements DenormalizerAwareInterface, DenormalizerInterface, NormalizerAwareInterface, NormalizerInterface
{
    use CheckArray;
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use ValidatorTrait;

    public function supportsDenormalization(mixed $data, string $type, ?string $format = null, array $context = []): bool
    {
        return $type === MemberPermissions::class;
    }

    public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
    {
        return is_object($data) && get_class($data) === MemberPermissions::class;
    }

    public function denormalize(mixed $data, string $type, ?string $format = null, array $context = []): mixed
    {
        $object = new MemberPermissions;
        if ($data === null || \is_array($data) === false) {
            return $object;
        }
        if (isset($data['$ref']) && ! isset($data['type']) && ! isset($data['properties']) && ! isset($data['allOf'])) {
            return new Reference($data['$ref'], $context['document-origin']);
        }
        if (isset($data['$recursiveRef'])) {
            return new Reference($data['$recursiveRef'], $context['document-origin']);
        }
        if (\array_key_exists('can_change_role', $data) && \is_int($data['can_change_role'])) {
            $data['can_change_role'] = (bool) $data['can_change_role'];
        }
        if (\array_key_exists('can_remove', $data) && \is_int($data['can_remove'])) {
            $data['can_remove'] = (bool) $data['can_remove'];
        }
        if (\array_key_exists('can_transfer_ownership', $data) && \is_int($data['can_transfer_ownership'])) {
            $data['can_transfer_ownership'] = (bool) $data['can_transfer_ownership'];
        }
        if (\array_key_exists('can_edit_grants', $data) && \is_int($data['can_edit_grants'])) {
            $data['can_edit_grants'] = (bool) $data['can_edit_grants'];
        }
        if (\array_key_exists('can_change_role', $data)) {
            $object->setCanChangeRole($data['can_change_role']);
            unset($data['can_change_role']);
        }
        if (\array_key_exists('assignable_roles', $data)) {
            $values = [];
            foreach ($data['assignable_roles'] as $value) {
                $values[] = $value;
            }
            $object->setAssignableRoles($values);
            unset($data['assignable_roles']);
        }
        if (\array_key_exists('can_remove', $data)) {
            $object->setCanRemove($data['can_remove']);
            unset($data['can_remove']);
        }
        if (\array_key_exists('can_transfer_ownership', $data)) {
            $object->setCanTransferOwnership($data['can_transfer_ownership']);
            unset($data['can_transfer_ownership']);
        }
        if (\array_key_exists('can_edit_grants', $data)) {
            $object->setCanEditGrants($data['can_edit_grants']);
            unset($data['can_edit_grants']);
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
        $dataArray['can_change_role'] = $data->getCanChangeRole();
        $values = [];
        foreach ($data->getAssignableRoles() as $value) {
            $values[] = $value;
        }
        $dataArray['assignable_roles'] = $values;
        $dataArray['can_remove'] = $data->getCanRemove();
        $dataArray['can_transfer_ownership'] = $data->getCanTransferOwnership();
        $dataArray['can_edit_grants'] = $data->getCanEditGrants();
        foreach ($data->additionalPropertyEntries() as $key => $value_1) {
            if (preg_match('/.*/', (string) $key)) {
                $dataArray[$key] = $value_1;
            }
        }

        return $dataArray;
    }

    public function getSupportedTypes(?string $format = null): array
    {
        return [MemberPermissions::class => false];
    }
}
