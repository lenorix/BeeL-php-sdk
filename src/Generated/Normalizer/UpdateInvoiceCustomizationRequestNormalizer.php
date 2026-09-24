<?php

namespace Lenorix\BeelSdk\Generated\Normalizer;

use Jane\Component\JsonSchemaRuntime\Reference;
use Lenorix\BeelSdk\Generated\Runtime\Normalizer\CheckArray;
use Lenorix\BeelSdk\Generated\Runtime\Normalizer\ValidatorTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
class UpdateInvoiceCustomizationRequestNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use CheckArray;
    use ValidatorTrait;
    public function supportsDenormalization(mixed $data, string $type, ?string $format = null, array $context = []): bool
    {
        return $type === \Lenorix\BeelSdk\Generated\Model\UpdateInvoiceCustomizationRequest::class;
    }
    public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
    {
        return is_object($data) && get_class($data) === \Lenorix\BeelSdk\Generated\Model\UpdateInvoiceCustomizationRequest::class;
    }
    public function denormalize(mixed $data, string $type, ?string $format = null, array $context = []): mixed
    {
        $object = new \Lenorix\BeelSdk\Generated\Model\UpdateInvoiceCustomizationRequest();
        if (null === $data || false === \is_array($data)) {
            return $object;
        }
        if (isset($data['$ref']) && !isset($data['type']) && !isset($data['properties']) && !isset($data['allOf'])) {
            return new Reference($data['$ref'], $context['document-origin']);
        }
        if (isset($data['$recursiveRef'])) {
            return new Reference($data['$recursiveRef'], $context['document-origin']);
        }
        if (\array_key_exists('invoice_template_type', $data) && $data['invoice_template_type'] !== null) {
            $object->setInvoiceTemplateType($data['invoice_template_type']);
            unset($data['invoice_template_type']);
        }
        elseif (\array_key_exists('invoice_template_type', $data) && $data['invoice_template_type'] === null) {
            $object->setInvoiceTemplateType(null);
            unset($data['invoice_template_type']);
        }
        if (\array_key_exists('invoice_accent_color', $data)) {
            $object->setInvoiceAccentColor($data['invoice_accent_color']);
            unset($data['invoice_accent_color']);
        }
        if (\array_key_exists('invoice_language', $data) && $data['invoice_language'] !== null) {
            $object->setInvoiceLanguage($data['invoice_language']);
            unset($data['invoice_language']);
        }
        elseif (\array_key_exists('invoice_language', $data) && $data['invoice_language'] === null) {
            $object->setInvoiceLanguage(null);
            unset($data['invoice_language']);
        }
        if (\array_key_exists('email_language', $data) && $data['email_language'] !== null) {
            $object->setEmailLanguage($data['email_language']);
            unset($data['email_language']);
        }
        elseif (\array_key_exists('email_language', $data) && $data['email_language'] === null) {
            $object->setEmailLanguage(null);
            unset($data['email_language']);
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
        if ($data->isInitialized('invoiceTemplateType') && null !== $data->getInvoiceTemplateType()) {
            $dataArray['invoice_template_type'] = $data->getInvoiceTemplateType();
        }
        if ($data->isInitialized('invoiceAccentColor') && null !== $data->getInvoiceAccentColor()) {
            $dataArray['invoice_accent_color'] = $data->getInvoiceAccentColor();
        }
        if ($data->isInitialized('invoiceLanguage') && null !== $data->getInvoiceLanguage()) {
            $dataArray['invoice_language'] = $data->getInvoiceLanguage();
        }
        if ($data->isInitialized('emailLanguage') && null !== $data->getEmailLanguage()) {
            $dataArray['email_language'] = $data->getEmailLanguage();
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
        return [\Lenorix\BeelSdk\Generated\Model\UpdateInvoiceCustomizationRequest::class => false];
    }
}