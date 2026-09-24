<?php

namespace Lenorix\BeelSdk\Generated\Normalizer;

use Jane\Component\JsonSchemaRuntime\Reference;
use Lenorix\BeelSdk\Generated\Model\V1InvoicesInvoiceIdSendPostResponse200Data;
use Lenorix\BeelSdk\Generated\Runtime\Normalizer\CheckArray;
use Lenorix\BeelSdk\Generated\Runtime\Normalizer\InvalidDateException;
use Lenorix\BeelSdk\Generated\Runtime\Normalizer\ValidatorTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class V1InvoicesInvoiceIdSendPostResponse200DataNormalizer implements DenormalizerAwareInterface, DenormalizerInterface, NormalizerAwareInterface, NormalizerInterface
{
    use CheckArray;
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use ValidatorTrait;

    public function supportsDenormalization(mixed $data, string $type, ?string $format = null, array $context = []): bool
    {
        return $type === V1InvoicesInvoiceIdSendPostResponse200Data::class;
    }

    public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
    {
        return is_object($data) && get_class($data) === V1InvoicesInvoiceIdSendPostResponse200Data::class;
    }

    public function denormalize(mixed $data, string $type, ?string $format = null, array $context = []): mixed
    {
        $object = new V1InvoicesInvoiceIdSendPostResponse200Data;
        if ($data === null || \is_array($data) === false) {
            return $object;
        }
        if (isset($data['$ref']) && ! isset($data['type']) && ! isset($data['properties']) && ! isset($data['allOf'])) {
            return new Reference($data['$ref'], $context['document-origin']);
        }
        if (isset($data['$recursiveRef'])) {
            return new Reference($data['$recursiveRef'], $context['document-origin']);
        }
        if (\array_key_exists('email_id', $data)) {
            $object->setEmailId($data['email_id']);
            unset($data['email_id']);
        }
        if (\array_key_exists('sent_to', $data)) {
            $values = [];
            foreach ($data['sent_to'] as $value) {
                $values[] = $value;
            }
            $object->setSentTo($values);
            unset($data['sent_to']);
        }
        if (\array_key_exists('sent_at', $data)) {
            $date = \DateTime::createFromFormat('Y-m-d\TH:i:sP', $data['sent_at']);
            if ($date === false) {
                throw new InvalidDateException($data['sent_at'], 'Y-m-d\TH:i:sP');
            }
            $object->setSentAt($date);
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
            $dataArray['sent_at'] = $data->getSentAt()->format('Y-m-d\TH:i:sP');
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
        return [V1InvoicesInvoiceIdSendPostResponse200Data::class => false];
    }
}
