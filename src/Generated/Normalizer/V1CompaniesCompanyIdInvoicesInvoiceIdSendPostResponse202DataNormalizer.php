<?php

namespace Lenorix\BeelSdk\Generated\Normalizer;

use Jane\Component\JsonSchemaRuntime\Reference;
use Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdInvoicesInvoiceIdSendPostResponse202Data;
use Lenorix\BeelSdk\Generated\Runtime\Normalizer\CheckArray;
use Lenorix\BeelSdk\Generated\Runtime\Normalizer\ValidatorTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class V1CompaniesCompanyIdInvoicesInvoiceIdSendPostResponse202DataNormalizer implements DenormalizerAwareInterface, DenormalizerInterface, NormalizerAwareInterface, NormalizerInterface
{
    use CheckArray;
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use ValidatorTrait;

    public function supportsDenormalization(mixed $data, string $type, ?string $format = null, array $context = []): bool
    {
        return $type === V1CompaniesCompanyIdInvoicesInvoiceIdSendPostResponse202Data::class;
    }

    public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
    {
        return is_object($data) && get_class($data) === V1CompaniesCompanyIdInvoicesInvoiceIdSendPostResponse202Data::class;
    }

    public function denormalize(mixed $data, string $type, ?string $format = null, array $context = []): mixed
    {
        $object = new V1CompaniesCompanyIdInvoicesInvoiceIdSendPostResponse202Data;
        if ($data === null || \is_array($data) === false) {
            return $object;
        }
        if (isset($data['$ref']) && ! isset($data['type']) && ! isset($data['properties']) && ! isset($data['allOf'])) {
            return new Reference($data['$ref'], $context['document-origin']);
        }
        if (isset($data['$recursiveRef'])) {
            return new Reference($data['$recursiveRef'], $context['document-origin']);
        }
        if (\array_key_exists('email_id', $data) && $data['email_id'] !== null) {
            $object->setEmailId($data['email_id']);
            unset($data['email_id']);
        } elseif (\array_key_exists('email_id', $data) && $data['email_id'] === null) {
            $object->setEmailId(null);
            unset($data['email_id']);
        }
        if (\array_key_exists('sent_to', $data) && $data['sent_to'] !== null) {
            $values = [];
            foreach ($data['sent_to'] as $value) {
                $values[] = $value;
            }
            $object->setSentTo($values);
            unset($data['sent_to']);
        } elseif (\array_key_exists('sent_to', $data) && $data['sent_to'] === null) {
            $object->setSentTo(null);
            unset($data['sent_to']);
        }
        if (\array_key_exists('sent_at', $data) && $data['sent_at'] !== null) {
            $object->setSentAt($this->denormalizer->denormalize($data['sent_at'], \DateTime::class, 'json', $context));
            unset($data['sent_at']);
        } elseif (\array_key_exists('sent_at', $data) && $data['sent_at'] === null) {
            $object->setSentAt(null);
            unset($data['sent_at']);
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
        if ($data->isInitialized('emailId') && $data->getEmailId() !== null) {
            $dataArray['email_id'] = $data->getEmailId();
        }
        if ($data->isInitialized('sentTo') && $data->getSentTo() !== null) {
            $values = [];
            foreach ($data->getSentTo() as $value) {
                $values[] = $value;
            }
            $dataArray['sent_to'] = $values;
        }
        if ($data->isInitialized('sentAt') && $data->getSentAt() !== null) {
            $dataArray['sent_at'] = $this->normalizer->normalize($data->getSentAt(), 'json', $context);
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
        return [V1CompaniesCompanyIdInvoicesInvoiceIdSendPostResponse202Data::class => false];
    }
}
