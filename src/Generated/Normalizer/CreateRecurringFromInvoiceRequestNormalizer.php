<?php

namespace Lenorix\BeelSdk\Generated\Normalizer;

use Jane\Component\JsonSchemaRuntime\Reference;
use Lenorix\BeelSdk\Generated\Model\CreateRecurringFromInvoiceRequest;
use Lenorix\BeelSdk\Generated\Model\RecurringEmailConfigRequest;
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

class CreateRecurringFromInvoiceRequestNormalizer implements DenormalizerAwareInterface, DenormalizerInterface, NormalizerAwareInterface, NormalizerInterface
{
    use CheckArray;
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use ValidatorTrait;

    public function supportsDenormalization(mixed $data, string $type, ?string $format = null, array $context = []): bool
    {
        return $type === CreateRecurringFromInvoiceRequest::class;
    }

    public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
    {
        return is_object($data) && get_class($data) === CreateRecurringFromInvoiceRequest::class;
    }

    public function denormalize(mixed $data, string $type, ?string $format = null, array $context = []): mixed
    {
        $object = new CreateRecurringFromInvoiceRequest;
        if ($data === null || \is_array($data) === false) {
            return $object;
        }
        if (isset($data['$ref']) && ! isset($data['type']) && ! isset($data['properties']) && ! isset($data['allOf'])) {
            return new Reference($data['$ref'], $context['document-origin']);
        }
        if (isset($data['$recursiveRef'])) {
            return new Reference($data['$recursiveRef'], $context['document-origin']);
        }
        if (\array_key_exists('send_automatically', $data) && \is_int($data['send_automatically'])) {
            $data['send_automatically'] = (bool) $data['send_automatically'];
        }
        if (\array_key_exists('name', $data)) {
            $object->setName($data['name']);
            unset($data['name']);
        }
        if (\array_key_exists('frequency', $data)) {
            $object->setFrequency($data['frequency']);
            unset($data['frequency']);
        }
        if (\array_key_exists('day_of_month', $data)) {
            $object->setDayOfMonth($data['day_of_month']);
            unset($data['day_of_month']);
        }
        if (\array_key_exists('start_date', $data)) {
            $date = \DateTime::createFromFormat('Y-m-d', $data['start_date']);
            if ($date === false) {
                throw new InvalidDateException($data['start_date'], 'Y-m-d');
            }
            $object->setStartDate($date->setTime(0, 0, 0));
            unset($data['start_date']);
        }
        if (\array_key_exists('end_date', $data) && $data['end_date'] !== null) {
            $date_1 = \DateTime::createFromFormat('Y-m-d', $data['end_date']);
            if ($date_1 === false) {
                throw new InvalidDateException($data['end_date'], 'Y-m-d');
            }
            $object->setEndDate($date_1->setTime(0, 0, 0));
            unset($data['end_date']);
        } elseif (\array_key_exists('end_date', $data) && $data['end_date'] === null) {
            $object->setEndDate(null);
            unset($data['end_date']);
        }
        if (\array_key_exists('send_automatically', $data)) {
            $object->setSendAutomatically($data['send_automatically']);
            unset($data['send_automatically']);
        }
        if (\array_key_exists('email_configuration', $data) && $data['email_configuration'] !== null) {
            $object->setEmailConfiguration($this->denormalizer->denormalize($data['email_configuration'], RecurringEmailConfigRequest::class, 'json', $context));
            unset($data['email_configuration']);
        } elseif (\array_key_exists('email_configuration', $data) && $data['email_configuration'] === null) {
            $object->setEmailConfiguration(null);
            unset($data['email_configuration']);
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
        $dataArray['name'] = $data->getName();
        if ($data->isInitialized('frequency') && $data->getFrequency() !== null) {
            $dataArray['frequency'] = $data->getFrequency();
        }
        $dataArray['day_of_month'] = $data->getDayOfMonth();
        $dataArray['start_date'] = $data->getStartDate()->format('Y-m-d');
        if ($data->isInitialized('endDate') && $data->getEndDate() !== null) {
            $dataArray['end_date'] = $data->getEndDate()?->format('Y-m-d');
        }
        if ($data->isInitialized('sendAutomatically') && $data->getSendAutomatically() !== null) {
            $dataArray['send_automatically'] = $data->getSendAutomatically();
        }
        if ($data->isInitialized('emailConfiguration') && $data->getEmailConfiguration() !== null) {
            $dataArray['email_configuration'] = $data->getEmailConfiguration() === null ? null : new JsonObject($this->normalizer->normalize($data->getEmailConfiguration(), 'json', $context));
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
        return [CreateRecurringFromInvoiceRequest::class => false];
    }
}
