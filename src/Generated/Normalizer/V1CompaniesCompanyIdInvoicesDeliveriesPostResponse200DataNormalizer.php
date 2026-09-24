<?php

namespace Lenorix\BeelSdk\Generated\Normalizer;

use Jane\Component\JsonSchemaRuntime\Reference;
use Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdInvoicesDeliveriesPostResponse200Data;
use Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdInvoicesDeliveriesPostResponse200DataFailuresItem;
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

class V1CompaniesCompanyIdInvoicesDeliveriesPostResponse200DataNormalizer implements DenormalizerAwareInterface, DenormalizerInterface, NormalizerAwareInterface, NormalizerInterface
{
    use CheckArray;
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use ValidatorTrait;

    public function supportsDenormalization(mixed $data, string $type, ?string $format = null, array $context = []): bool
    {
        return $type === V1CompaniesCompanyIdInvoicesDeliveriesPostResponse200Data::class;
    }

    public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
    {
        return is_object($data) && get_class($data) === V1CompaniesCompanyIdInvoicesDeliveriesPostResponse200Data::class;
    }

    public function denormalize(mixed $data, string $type, ?string $format = null, array $context = []): mixed
    {
        $object = new V1CompaniesCompanyIdInvoicesDeliveriesPostResponse200Data;
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
        if (\array_key_exists('total_invoices', $data)) {
            $object->setTotalInvoices($data['total_invoices']);
            unset($data['total_invoices']);
        }
        if (\array_key_exists('invoices_attached', $data)) {
            $object->setInvoicesAttached($data['invoices_attached']);
            unset($data['invoices_attached']);
        }
        if (\array_key_exists('failures', $data)) {
            $values_1 = [];
            foreach ($data['failures'] as $value_1) {
                $values_1[] = $this->denormalizer->denormalize($value_1, V1CompaniesCompanyIdInvoicesDeliveriesPostResponse200DataFailuresItem::class, 'json', $context);
            }
            $object->setFailures($values_1);
            unset($data['failures']);
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
        $dataArray['email_id'] = $data->getEmailId();
        $values = [];
        foreach ($data->getSentTo() as $value) {
            $values[] = $value;
        }
        $dataArray['sent_to'] = $values;
        $dataArray['sent_at'] = $data->getSentAt()->format('Y-m-d\TH:i:sP');
        $dataArray['total_invoices'] = $data->getTotalInvoices();
        $dataArray['invoices_attached'] = $data->getInvoicesAttached();
        if ($data->isInitialized('failures') && $data->getFailures() !== null) {
            $values_1 = [];
            foreach ($data->getFailures() as $value_1) {
                $values_1[] = $value_1 === null ? null : new JsonObject($this->normalizer->normalize($value_1, 'json', $context));
            }
            $dataArray['failures'] = $values_1;
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
        return [V1CompaniesCompanyIdInvoicesDeliveriesPostResponse200Data::class => false];
    }
}
