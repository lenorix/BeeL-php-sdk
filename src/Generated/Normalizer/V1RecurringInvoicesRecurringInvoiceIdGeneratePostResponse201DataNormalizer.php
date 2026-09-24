<?php

namespace Lenorix\BeelSdk\Generated\Normalizer;

use Jane\Component\JsonSchemaRuntime\Reference;
use Lenorix\BeelSdk\Generated\Model\V1RecurringInvoicesRecurringInvoiceIdGeneratePostResponse201Data;
use Lenorix\BeelSdk\Generated\Runtime\Normalizer\CheckArray;
use Lenorix\BeelSdk\Generated\Runtime\Normalizer\InvalidDateException;
use Lenorix\BeelSdk\Generated\Runtime\Normalizer\ValidatorTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class V1RecurringInvoicesRecurringInvoiceIdGeneratePostResponse201DataNormalizer implements DenormalizerAwareInterface, DenormalizerInterface, NormalizerAwareInterface, NormalizerInterface
{
    use CheckArray;
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use ValidatorTrait;

    public function supportsDenormalization(mixed $data, string $type, ?string $format = null, array $context = []): bool
    {
        return $type === V1RecurringInvoicesRecurringInvoiceIdGeneratePostResponse201Data::class;
    }

    public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
    {
        return is_object($data) && get_class($data) === V1RecurringInvoicesRecurringInvoiceIdGeneratePostResponse201Data::class;
    }

    public function denormalize(mixed $data, string $type, ?string $format = null, array $context = []): mixed
    {
        $object = new V1RecurringInvoicesRecurringInvoiceIdGeneratePostResponse201Data;
        if ($data === null || \is_array($data) === false) {
            return $object;
        }
        if (isset($data['$ref']) && ! isset($data['type']) && ! isset($data['properties']) && ! isset($data['allOf'])) {
            return new Reference($data['$ref'], $context['document-origin']);
        }
        if (isset($data['$recursiveRef'])) {
            return new Reference($data['$recursiveRef'], $context['document-origin']);
        }
        if (\array_key_exists('invoice_id', $data)) {
            $object->setInvoiceId($data['invoice_id']);
            unset($data['invoice_id']);
        }
        if (\array_key_exists('next_generation', $data) && $data['next_generation'] !== null) {
            $date = \DateTime::createFromFormat('Y-m-d', $data['next_generation']);
            if ($date === false) {
                throw new InvalidDateException($data['next_generation'], 'Y-m-d');
            }
            $object->setNextGeneration($date->setTime(0, 0, 0));
            unset($data['next_generation']);
        } elseif (\array_key_exists('next_generation', $data) && $data['next_generation'] === null) {
            $object->setNextGeneration(null);
            unset($data['next_generation']);
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
        if ($data->isInitialized('invoiceId') && $data->getInvoiceId() !== null) {
            $dataArray['invoice_id'] = $data->getInvoiceId();
        }
        if ($data->isInitialized('nextGeneration') && $data->getNextGeneration() !== null) {
            $dataArray['next_generation'] = $data->getNextGeneration()?->format('Y-m-d');
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
        return [V1RecurringInvoicesRecurringInvoiceIdGeneratePostResponse201Data::class => false];
    }
}
