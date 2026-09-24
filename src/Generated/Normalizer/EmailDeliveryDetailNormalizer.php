<?php

namespace Lenorix\BeelSdk\Generated\Normalizer;

use Jane\Component\JsonSchemaRuntime\Reference;
use Lenorix\BeelSdk\Generated\Model\EmailAttachment;
use Lenorix\BeelSdk\Generated\Model\EmailDeliveryDetail;
use Lenorix\BeelSdk\Generated\Model\RelatedInvoice;
use Lenorix\BeelSdk\Generated\Runtime\JsonObject;
use Lenorix\BeelSdk\Generated\Runtime\Normalizer\CheckArray;
use Lenorix\BeelSdk\Generated\Runtime\Normalizer\InvalidDateException;
use Lenorix\BeelSdk\Generated\Runtime\Normalizer\ValidatorTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class EmailDeliveryDetailNormalizer implements DenormalizerAwareInterface, DenormalizerInterface, NormalizerAwareInterface, NormalizerInterface
{
    use CheckArray;
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use ValidatorTrait;

    public function supportsDenormalization(mixed $data, string $type, ?string $format = null, array $context = []): bool
    {
        return $type === EmailDeliveryDetail::class;
    }

    public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
    {
        return is_object($data) && get_class($data) === EmailDeliveryDetail::class;
    }

    public function denormalize(mixed $data, string $type, ?string $format = null, array $context = []): mixed
    {
        $object = new EmailDeliveryDetail;
        if ($data === null || \is_array($data) === false) {
            return $object;
        }
        if (isset($data['$ref']) && ! isset($data['type']) && ! isset($data['properties']) && ! isset($data['allOf'])) {
            return new Reference($data['$ref'], $context['document-origin']);
        }
        if (isset($data['$recursiveRef'])) {
            return new Reference($data['$recursiveRef'], $context['document-origin']);
        }
        if (\array_key_exists('body_available', $data) && \is_int($data['body_available'])) {
            $data['body_available'] = (bool) $data['body_available'];
        }
        if (\array_key_exists('id', $data)) {
            $object->setId($data['id']);
            unset($data['id']);
        }
        if (\array_key_exists('email_type', $data)) {
            $object->setEmailType($data['email_type']);
            unset($data['email_type']);
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
        if (\array_key_exists('related_entity_type', $data) && $data['related_entity_type'] !== null) {
            $object->setRelatedEntityType($data['related_entity_type']);
            unset($data['related_entity_type']);
        } elseif (\array_key_exists('related_entity_type', $data) && $data['related_entity_type'] === null) {
            $object->setRelatedEntityType(null);
            unset($data['related_entity_type']);
        }
        if (\array_key_exists('related_entity_id', $data) && $data['related_entity_id'] !== null) {
            $object->setRelatedEntityId($data['related_entity_id']);
            unset($data['related_entity_id']);
        } elseif (\array_key_exists('related_entity_id', $data) && $data['related_entity_id'] === null) {
            $object->setRelatedEntityId(null);
            unset($data['related_entity_id']);
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
        if (\array_key_exists('body_available', $data)) {
            $object->setBodyAvailable($data['body_available']);
            unset($data['body_available']);
        }
        if (\array_key_exists('html_body', $data) && $data['html_body'] !== null) {
            $object->setHtmlBody($data['html_body']);
            unset($data['html_body']);
        } elseif (\array_key_exists('html_body', $data) && $data['html_body'] === null) {
            $object->setHtmlBody(null);
            unset($data['html_body']);
        }
        if (\array_key_exists('text_body', $data) && $data['text_body'] !== null) {
            $object->setTextBody($data['text_body']);
            unset($data['text_body']);
        } elseif (\array_key_exists('text_body', $data) && $data['text_body'] === null) {
            $object->setTextBody(null);
            unset($data['text_body']);
        }
        if (\array_key_exists('attachments', $data)) {
            $values_2 = [];
            foreach ($data['attachments'] as $value_2) {
                $values_2[] = $this->denormalizer->denormalize($value_2, EmailAttachment::class, 'json', $context);
            }
            $object->setAttachments($values_2);
            unset($data['attachments']);
        }
        if (\array_key_exists('related_invoices', $data)) {
            $values_3 = [];
            foreach ($data['related_invoices'] as $value_3) {
                $values_3[] = $this->denormalizer->denormalize($value_3, RelatedInvoice::class, 'json', $context);
            }
            $object->setRelatedInvoices($values_3);
            unset($data['related_invoices']);
        }
        foreach ($data as $key => $value_4) {
            if (preg_match('/.*/', (string) $key)) {
                $object[$key] = $value_4;
            }
        }

        return $object;
    }

    public function normalize(mixed $data, ?string $format = null, array $context = []): array|string|int|float|bool|\ArrayObject|null
    {
        $dataArray = [];
        $dataArray['id'] = $data->getId();
        $dataArray['email_type'] = $data->getEmailType();
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
        if ($data->isInitialized('relatedEntityType') && $data->getRelatedEntityType() !== null) {
            $dataArray['related_entity_type'] = $data->getRelatedEntityType();
        }
        if ($data->isInitialized('relatedEntityId') && $data->getRelatedEntityId() !== null) {
            $dataArray['related_entity_id'] = $data->getRelatedEntityId();
        }
        $dataArray['status'] = $data->getStatus();
        if ($data->isInitialized('sentAt') && $data->getSentAt() !== null) {
            $dataArray['sent_at'] = $data->getSentAt()->format('Y-m-d\TH:i:sP');
        }
        $dataArray['body_available'] = $data->getBodyAvailable();
        if ($data->isInitialized('htmlBody') && $data->getHtmlBody() !== null) {
            $dataArray['html_body'] = $data->getHtmlBody();
        }
        if ($data->isInitialized('textBody') && $data->getTextBody() !== null) {
            $dataArray['text_body'] = $data->getTextBody();
        }
        if ($data->isInitialized('attachments') && $data->getAttachments() !== null) {
            $values_2 = [];
            foreach ($data->getAttachments() as $value_2) {
                $values_2[] = $value_2 === null ? null : new JsonObject($this->normalizer->normalize($value_2, 'json', $context));
            }
            $dataArray['attachments'] = $values_2;
        }
        if ($data->isInitialized('relatedInvoices') && $data->getRelatedInvoices() !== null) {
            $values_3 = [];
            foreach ($data->getRelatedInvoices() as $value_3) {
                $values_3[] = $value_3 === null ? null : new JsonObject($this->normalizer->normalize($value_3, 'json', $context));
            }
            $dataArray['related_invoices'] = $values_3;
        }
        foreach ($data->additionalPropertyEntries() as $key => $value_4) {
            if (preg_match('/.*/', (string) $key)) {
                $dataArray[$key] = $value_4;
            }
        }

        return $dataArray;
    }

    public function getSupportedTypes(?string $format = null): array
    {
        return [EmailDeliveryDetail::class => false];
    }
}
