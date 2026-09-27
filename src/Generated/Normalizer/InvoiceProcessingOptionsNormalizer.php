<?php

namespace Lenorix\BeelSdk\Generated\Normalizer;

use Jane\Component\JsonSchemaRuntime\Reference;
use Lenorix\BeelSdk\Generated\Model\InvoiceProcessingOptions;
use Lenorix\BeelSdk\Generated\Model\InvoiceProcessingOptionsEmailConfig;
use Lenorix\BeelSdk\Generated\Runtime\JsonObject;
use Lenorix\BeelSdk\Generated\Runtime\Normalizer\CheckArray;
use Lenorix\BeelSdk\Generated\Runtime\Normalizer\ValidatorTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class InvoiceProcessingOptionsNormalizer implements DenormalizerAwareInterface, DenormalizerInterface, NormalizerAwareInterface, NormalizerInterface
{
    use CheckArray;
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use ValidatorTrait;

    public function supportsDenormalization(mixed $data, string $type, ?string $format = null, array $context = []): bool
    {
        return $type === InvoiceProcessingOptions::class;
    }

    public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
    {
        return is_object($data) && get_class($data) === InvoiceProcessingOptions::class;
    }

    public function denormalize(mixed $data, string $type, ?string $format = null, array $context = []): mixed
    {
        $object = new InvoiceProcessingOptions;
        if ($data === null || \is_array($data) === false) {
            return $object;
        }
        if (isset($data['$ref']) && ! isset($data['type']) && ! isset($data['properties']) && ! isset($data['allOf'])) {
            return new Reference($data['$ref'], $context['document-origin']);
        }
        if (isset($data['$recursiveRef'])) {
            return new Reference($data['$recursiveRef'], $context['document-origin']);
        }
        if (\array_key_exists('issue_directly', $data) && \is_int($data['issue_directly'])) {
            $data['issue_directly'] = (bool) $data['issue_directly'];
        }
        if (\array_key_exists('wait_for_pdf', $data) && \is_int($data['wait_for_pdf'])) {
            $data['wait_for_pdf'] = (bool) $data['wait_for_pdf'];
        }
        if (\array_key_exists('send_automatically', $data) && \is_int($data['send_automatically'])) {
            $data['send_automatically'] = (bool) $data['send_automatically'];
        }
        if (\array_key_exists('attach_source_invoices', $data) && \is_int($data['attach_source_invoices'])) {
            $data['attach_source_invoices'] = (bool) $data['attach_source_invoices'];
        }
        if (\array_key_exists('issue_directly', $data)) {
            $object->setIssueDirectly($data['issue_directly']);
            unset($data['issue_directly']);
        }
        if (\array_key_exists('wait_for_pdf', $data)) {
            $object->setWaitForPdf($data['wait_for_pdf']);
            unset($data['wait_for_pdf']);
        }
        if (\array_key_exists('send_automatically', $data)) {
            $object->setSendAutomatically($data['send_automatically']);
            unset($data['send_automatically']);
        }
        if (\array_key_exists('attach_source_invoices', $data)) {
            $object->setAttachSourceInvoices($data['attach_source_invoices']);
            unset($data['attach_source_invoices']);
        }
        if (\array_key_exists('email_config', $data)) {
            $object->setEmailConfig($this->denormalizer->denormalize($data['email_config'], InvoiceProcessingOptionsEmailConfig::class, 'json', $context));
            unset($data['email_config']);
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
        if ($data->isInitialized('issueDirectly') && $data->getIssueDirectly() !== null) {
            $dataArray['issue_directly'] = $data->getIssueDirectly();
        }
        if ($data->isInitialized('waitForPdf') && $data->getWaitForPdf() !== null) {
            $dataArray['wait_for_pdf'] = $data->getWaitForPdf();
        }
        if ($data->isInitialized('sendAutomatically') && $data->getSendAutomatically() !== null) {
            $dataArray['send_automatically'] = $data->getSendAutomatically();
        }
        if ($data->isInitialized('attachSourceInvoices') && $data->getAttachSourceInvoices() !== null) {
            $dataArray['attach_source_invoices'] = $data->getAttachSourceInvoices();
        }
        if ($data->isInitialized('emailConfig') && $data->getEmailConfig() !== null) {
            $dataArray['email_config'] = $data->getEmailConfig() === null ? null : new JsonObject($this->normalizer->normalize($data->getEmailConfig(), 'json', $context));
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
        return [InvoiceProcessingOptions::class => false];
    }
}
