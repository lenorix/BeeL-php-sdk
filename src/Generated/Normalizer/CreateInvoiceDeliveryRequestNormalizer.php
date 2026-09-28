<?php

namespace Lenorix\BeelSdk\Generated\Normalizer;

use Jane\Component\JsonSchemaRuntime\Reference;
use Lenorix\BeelSdk\Generated\Model\CreateInvoiceDeliveryRequest;
use Lenorix\BeelSdk\Generated\Runtime\Normalizer\CheckArray;
use Lenorix\BeelSdk\Generated\Runtime\Normalizer\ValidatorTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class CreateInvoiceDeliveryRequestNormalizer implements DenormalizerAwareInterface, DenormalizerInterface, NormalizerAwareInterface, NormalizerInterface
{
    use CheckArray;
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use ValidatorTrait;

    public function supportsDenormalization(mixed $data, string $type, ?string $format = null, array $context = []): bool
    {
        return $type === CreateInvoiceDeliveryRequest::class;
    }

    public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
    {
        return is_object($data) && get_class($data) === CreateInvoiceDeliveryRequest::class;
    }

    public function denormalize(mixed $data, string $type, ?string $format = null, array $context = []): mixed
    {
        $object = new CreateInvoiceDeliveryRequest;
        if ($data === null || \is_array($data) === false) {
            return $object;
        }
        if (isset($data['$ref']) && ! isset($data['type']) && ! isset($data['properties']) && ! isset($data['allOf'])) {
            return new Reference($data['$ref'], $context['document-origin']);
        }
        if (isset($data['$recursiveRef'])) {
            return new Reference($data['$recursiveRef'], $context['document-origin']);
        }
        if (\array_key_exists('invoice_ids', $data)) {
            $values = [];
            foreach ($data['invoice_ids'] as $value) {
                $values[] = $value;
            }
            $object->setInvoiceIds($values);
            unset($data['invoice_ids']);
        }
        if (\array_key_exists('recipients', $data)) {
            $values_1 = [];
            foreach ($data['recipients'] as $value_1) {
                $values_1[] = $value_1;
            }
            $object->setRecipients($values_1);
            unset($data['recipients']);
        }
        if (\array_key_exists('cc', $data)) {
            $values_2 = [];
            foreach ($data['cc'] as $value_2) {
                $values_2[] = $value_2;
            }
            $object->setCc($values_2);
            unset($data['cc']);
        }
        if (\array_key_exists('subject', $data)) {
            $object->setSubject($data['subject']);
            unset($data['subject']);
        }
        if (\array_key_exists('message', $data)) {
            $object->setMessage($data['message']);
            unset($data['message']);
        }
        if (\array_key_exists('language', $data)) {
            $object->setLanguage($data['language']);
            unset($data['language']);
        }
        foreach ($data as $key => $value_3) {
            if (preg_match('/.*/', (string) $key)) {
                $object[$key] = $value_3;
            }
        }

        return $object;
    }

    public function normalize(mixed $data, ?string $format = null, array $context = []): array|string|int|float|bool|\ArrayObject|null
    {
        $dataArray = [];
        $values = [];
        foreach ($data->getInvoiceIds() as $value) {
            $values[] = $value;
        }
        $dataArray['invoice_ids'] = $values;
        $values_1 = [];
        foreach ($data->getRecipients() as $value_1) {
            $values_1[] = $value_1;
        }
        $dataArray['recipients'] = $values_1;
        if ($data->isInitialized('cc') && $data->getCc() !== null) {
            $values_2 = [];
            foreach ($data->getCc() as $value_2) {
                $values_2[] = $value_2;
            }
            $dataArray['cc'] = $values_2;
        }
        if ($data->isInitialized('subject') && $data->getSubject() !== null) {
            $dataArray['subject'] = $data->getSubject();
        }
        if ($data->isInitialized('message') && $data->getMessage() !== null) {
            $dataArray['message'] = $data->getMessage();
        }
        if ($data->isInitialized('language') && $data->getLanguage() !== null) {
            $dataArray['language'] = $data->getLanguage();
        }
        foreach ($data->additionalPropertyEntries() as $key => $value_3) {
            if (preg_match('/.*/', (string) $key)) {
                $dataArray[$key] = $value_3;
            }
        }

        return $dataArray;
    }

    public function getSupportedTypes(?string $format = null): array
    {
        return [CreateInvoiceDeliveryRequest::class => false];
    }
}
