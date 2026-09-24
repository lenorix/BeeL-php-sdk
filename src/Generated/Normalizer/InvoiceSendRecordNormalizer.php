<?php

namespace Lenorix\BeelSdk\Generated\Normalizer;

use Jane\Component\JsonSchemaRuntime\Reference;
use Lenorix\BeelSdk\Generated\Model\InvoiceSendRecord;
use Lenorix\BeelSdk\Generated\Runtime\Normalizer\CheckArray;
use Lenorix\BeelSdk\Generated\Runtime\Normalizer\InvalidDateException;
use Lenorix\BeelSdk\Generated\Runtime\Normalizer\ValidatorTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class InvoiceSendRecordNormalizer implements DenormalizerAwareInterface, DenormalizerInterface, NormalizerAwareInterface, NormalizerInterface
{
    use CheckArray;
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use ValidatorTrait;

    public function supportsDenormalization(mixed $data, string $type, ?string $format = null, array $context = []): bool
    {
        return $type === InvoiceSendRecord::class;
    }

    public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
    {
        return is_object($data) && get_class($data) === InvoiceSendRecord::class;
    }

    public function denormalize(mixed $data, string $type, ?string $format = null, array $context = []): mixed
    {
        $object = new InvoiceSendRecord;
        if ($data === null || \is_array($data) === false) {
            return $object;
        }
        if (isset($data['$ref']) && ! isset($data['type']) && ! isset($data['properties']) && ! isset($data['allOf'])) {
            return new Reference($data['$ref'], $context['document-origin']);
        }
        if (isset($data['$recursiveRef'])) {
            return new Reference($data['$recursiveRef'], $context['document-origin']);
        }
        if (\array_key_exists('id', $data)) {
            $object->setId($data['id']);
            unset($data['id']);
        }
        if (\array_key_exists('recipients', $data)) {
            $values = [];
            foreach ($data['recipients'] as $value) {
                $values[] = $value;
            }
            $object->setRecipients($values);
            unset($data['recipients']);
        }
        if (\array_key_exists('cc', $data)) {
            $values_1 = [];
            foreach ($data['cc'] as $value_1) {
                $values_1[] = $value_1;
            }
            $object->setCc($values_1);
            unset($data['cc']);
        }
        if (\array_key_exists('subject', $data)) {
            $object->setSubject($data['subject']);
            unset($data['subject']);
        }
        if (\array_key_exists('status', $data)) {
            $object->setStatus($data['status']);
            unset($data['status']);
        }
        if (\array_key_exists('sent_at', $data)) {
            $date = \DateTime::createFromFormat('Y-m-d\TH:i:sP', $data['sent_at']);
            if ($date === false) {
                throw new InvalidDateException($data['sent_at'], 'Y-m-d\TH:i:sP');
            }
            $object->setSentAt($date);
            unset($data['sent_at']);
        }
        if (\array_key_exists('external_message_id', $data) && $data['external_message_id'] !== null) {
            $object->setExternalMessageId($data['external_message_id']);
            unset($data['external_message_id']);
        } elseif (\array_key_exists('external_message_id', $data) && $data['external_message_id'] === null) {
            $object->setExternalMessageId(null);
            unset($data['external_message_id']);
        }
        if (\array_key_exists('error', $data) && $data['error'] !== null) {
            $object->setError($data['error']);
            unset($data['error']);
        } elseif (\array_key_exists('error', $data) && $data['error'] === null) {
            $object->setError(null);
            unset($data['error']);
        }
        foreach ($data as $key => $value_2) {
            if (preg_match('/.*/', (string) $key)) {
                $object[$key] = $value_2;
            }
        }

        return $object;
    }

    public function normalize(mixed $data, ?string $format = null, array $context = []): array|string|int|float|bool|\ArrayObject|null
    {
        $dataArray = [];
        $dataArray['id'] = $data->getId();
        $values = [];
        foreach ($data->getRecipients() as $value) {
            $values[] = $value;
        }
        $dataArray['recipients'] = $values;
        if ($data->isInitialized('cc') && $data->getCc() !== null) {
            $values_1 = [];
            foreach ($data->getCc() as $value_1) {
                $values_1[] = $value_1;
            }
            $dataArray['cc'] = $values_1;
        }
        if ($data->isInitialized('subject') && $data->getSubject() !== null) {
            $dataArray['subject'] = $data->getSubject();
        }
        $dataArray['status'] = $data->getStatus();
        if ($data->isInitialized('sentAt') && $data->getSentAt() !== null) {
            $dataArray['sent_at'] = $data->getSentAt()->format('Y-m-d\TH:i:sP');
        }
        if ($data->isInitialized('externalMessageId') && $data->getExternalMessageId() !== null) {
            $dataArray['external_message_id'] = $data->getExternalMessageId();
        }
        if ($data->isInitialized('error') && $data->getError() !== null) {
            $dataArray['error'] = $data->getError();
        }
        foreach ($data->additionalPropertyEntries() as $key => $value_2) {
            if (preg_match('/.*/', (string) $key)) {
                $dataArray[$key] = $value_2;
            }
        }

        return $dataArray;
    }

    public function getSupportedTypes(?string $format = null): array
    {
        return [InvoiceSendRecord::class => false];
    }
}
