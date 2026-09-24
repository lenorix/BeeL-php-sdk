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
class VeriFactuConfigurationNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use CheckArray;
    use ValidatorTrait;
    public function supportsDenormalization(mixed $data, string $type, ?string $format = null, array $context = []): bool
    {
        return $type === \Lenorix\BeelSdk\Generated\Model\VeriFactuConfiguration::class;
    }
    public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
    {
        return is_object($data) && get_class($data) === \Lenorix\BeelSdk\Generated\Model\VeriFactuConfiguration::class;
    }
    public function denormalize(mixed $data, string $type, ?string $format = null, array $context = []): mixed
    {
        $object = new \Lenorix\BeelSdk\Generated\Model\VeriFactuConfiguration();
        if (null === $data || false === \is_array($data)) {
            return $object;
        }
        if (isset($data['$ref']) && !isset($data['type']) && !isset($data['properties']) && !isset($data['allOf'])) {
            return new Reference($data['$ref'], $context['document-origin']);
        }
        if (isset($data['$recursiveRef'])) {
            return new Reference($data['$recursiveRef'], $context['document-origin']);
        }
        if (\array_key_exists('enabled', $data) && \is_int($data['enabled'])) {
            $data['enabled'] = (bool) $data['enabled'];
        }
        if (\array_key_exists('signed', $data) && \is_int($data['signed'])) {
            $data['signed'] = (bool) $data['signed'];
        }
        if (\array_key_exists('activated', $data) && \is_int($data['activated'])) {
            $data['activated'] = (bool) $data['activated'];
        }
        if (\array_key_exists('pdf_generated', $data) && \is_int($data['pdf_generated'])) {
            $data['pdf_generated'] = (bool) $data['pdf_generated'];
        }
        if (\array_key_exists('enabled', $data)) {
            $object->setEnabled($data['enabled']);
            unset($data['enabled']);
        }
        if (\array_key_exists('nif_status', $data) && $data['nif_status'] !== null) {
            $object->setNifStatus($data['nif_status']);
            unset($data['nif_status']);
        }
        elseif (\array_key_exists('nif_status', $data) && $data['nif_status'] === null) {
            $object->setNifStatus(null);
            unset($data['nif_status']);
        }
        if (\array_key_exists('nif_registered_at', $data) && $data['nif_registered_at'] !== null) {
            $date = \DateTime::createFromFormat('Y-m-d\TH:i:sP', $data['nif_registered_at']);
            if (false === $date) {
                throw new \Lenorix\BeelSdk\Generated\Runtime\Normalizer\InvalidDateException($data['nif_registered_at'], 'Y-m-d\TH:i:sP');
            }
            $object->setNifRegisteredAt($date);
            unset($data['nif_registered_at']);
        }
        elseif (\array_key_exists('nif_registered_at', $data) && $data['nif_registered_at'] === null) {
            $object->setNifRegisteredAt(null);
            unset($data['nif_registered_at']);
        }
        if (\array_key_exists('status', $data) && $data['status'] !== null) {
            $object->setStatus($data['status']);
            unset($data['status']);
        }
        elseif (\array_key_exists('status', $data) && $data['status'] === null) {
            $object->setStatus(null);
            unset($data['status']);
        }
        if (\array_key_exists('signed', $data) && $data['signed'] !== null) {
            $object->setSigned($data['signed']);
            unset($data['signed']);
        }
        elseif (\array_key_exists('signed', $data) && $data['signed'] === null) {
            $object->setSigned(null);
            unset($data['signed']);
        }
        if (\array_key_exists('activated', $data) && $data['activated'] !== null) {
            $object->setActivated($data['activated']);
            unset($data['activated']);
        }
        elseif (\array_key_exists('activated', $data) && $data['activated'] === null) {
            $object->setActivated(null);
            unset($data['activated']);
        }
        if (\array_key_exists('pdf_generated', $data) && $data['pdf_generated'] !== null) {
            $object->setPdfGenerated($data['pdf_generated']);
            unset($data['pdf_generated']);
        }
        elseif (\array_key_exists('pdf_generated', $data) && $data['pdf_generated'] === null) {
            $object->setPdfGenerated(null);
            unset($data['pdf_generated']);
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
        $dataArray['enabled'] = $data->getEnabled();
        if ($data->isInitialized('nifStatus') && null !== $data->getNifStatus()) {
            $dataArray['nif_status'] = $data->getNifStatus();
        }
        if ($data->isInitialized('nifRegisteredAt') && null !== $data->getNifRegisteredAt()) {
            $dataArray['nif_registered_at'] = $data->getNifRegisteredAt()?->format('Y-m-d\TH:i:sP');
        }
        if ($data->isInitialized('status') && null !== $data->getStatus()) {
            $dataArray['status'] = $data->getStatus();
        }
        if ($data->isInitialized('signed') && null !== $data->getSigned()) {
            $dataArray['signed'] = $data->getSigned();
        }
        if ($data->isInitialized('activated') && null !== $data->getActivated()) {
            $dataArray['activated'] = $data->getActivated();
        }
        if ($data->isInitialized('pdfGenerated') && null !== $data->getPdfGenerated()) {
            $dataArray['pdf_generated'] = $data->getPdfGenerated();
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
        return [\Lenorix\BeelSdk\Generated\Model\VeriFactuConfiguration::class => false];
    }
}