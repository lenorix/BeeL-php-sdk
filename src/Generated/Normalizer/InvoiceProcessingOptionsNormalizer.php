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
class InvoiceProcessingOptionsNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use CheckArray;
    use ValidatorTrait;
    public function supportsDenormalization(mixed $data, string $type, ?string $format = null, array $context = []): bool
    {
        return $type === \Lenorix\BeelSdk\Generated\Model\InvoiceProcessingOptions::class;
    }
    public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
    {
        return is_object($data) && get_class($data) === \Lenorix\BeelSdk\Generated\Model\InvoiceProcessingOptions::class;
    }
    public function denormalize(mixed $data, string $type, ?string $format = null, array $context = []): mixed
    {
        $object = new \Lenorix\BeelSdk\Generated\Model\InvoiceProcessingOptions();
        if (null === $data || false === \is_array($data)) {
            return $object;
        }
        if (isset($data['$ref']) && !isset($data['type']) && !isset($data['properties']) && !isset($data['allOf'])) {
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
            $object->setEmailConfig($this->denormalizer->denormalize($data['email_config'], \Lenorix\BeelSdk\Generated\Model\InvoiceProcessingOptionsEmailConfig::class, 'json', $context));
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
        if ($data->isInitialized('issueDirectly') && null !== $data->getIssueDirectly()) {
            $dataArray['issue_directly'] = $data->getIssueDirectly();
        }
        if ($data->isInitialized('waitForPdf') && null !== $data->getWaitForPdf()) {
            $dataArray['wait_for_pdf'] = $data->getWaitForPdf();
        }
        if ($data->isInitialized('sendAutomatically') && null !== $data->getSendAutomatically()) {
            $dataArray['send_automatically'] = $data->getSendAutomatically();
        }
        if ($data->isInitialized('attachSourceInvoices') && null !== $data->getAttachSourceInvoices()) {
            $dataArray['attach_source_invoices'] = $data->getAttachSourceInvoices();
        }
        if ($data->isInitialized('emailConfig') && null !== $data->getEmailConfig()) {
            $dataArray['email_config'] = $data->getEmailConfig() === null ? null : new \Lenorix\BeelSdk\Generated\Runtime\JsonObject($this->normalizer->normalize($data->getEmailConfig(), 'json', $context));
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
        return [\Lenorix\BeelSdk\Generated\Model\InvoiceProcessingOptions::class => false];
    }
}