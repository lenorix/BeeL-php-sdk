<?php

namespace Lenorix\BeelSdk\Generated\Normalizer;

use Jane\Component\JsonSchemaRuntime\Reference;
use Lenorix\BeelSdk\Generated\Model\InvoiceFiscalData;
use Lenorix\BeelSdk\Generated\Runtime\Normalizer\CheckArray;
use Lenorix\BeelSdk\Generated\Runtime\Normalizer\InvalidDateException;
use Lenorix\BeelSdk\Generated\Runtime\Normalizer\ValidatorTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class InvoiceFiscalDataNormalizer implements DenormalizerAwareInterface, DenormalizerInterface, NormalizerAwareInterface, NormalizerInterface
{
    use CheckArray;
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use ValidatorTrait;

    public function supportsDenormalization(mixed $data, string $type, ?string $format = null, array $context = []): bool
    {
        return $type === InvoiceFiscalData::class;
    }

    public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
    {
        return is_object($data) && get_class($data) === InvoiceFiscalData::class;
    }

    public function denormalize(mixed $data, string $type, ?string $format = null, array $context = []): mixed
    {
        $object = new InvoiceFiscalData;
        if ($data === null || \is_array($data) === false) {
            return $object;
        }
        if (isset($data['$ref']) && ! isset($data['type']) && ! isset($data['properties']) && ! isset($data['allOf'])) {
            return new Reference($data['$ref'], $context['document-origin']);
        }
        if (isset($data['$recursiveRef'])) {
            return new Reference($data['$recursiveRef'], $context['document-origin']);
        }
        if (\array_key_exists('taxable_base', $data) && \is_int($data['taxable_base'])) {
            $data['taxable_base'] = (float) $data['taxable_base'];
        }
        if (\array_key_exists('total_vat', $data) && \is_int($data['total_vat'])) {
            $data['total_vat'] = (float) $data['total_vat'];
        }
        if (\array_key_exists('total_irpf', $data) && \is_int($data['total_irpf'])) {
            $data['total_irpf'] = (float) $data['total_irpf'];
        }
        if (\array_key_exists('invoice_total', $data) && \is_int($data['invoice_total'])) {
            $data['invoice_total'] = (float) $data['invoice_total'];
        }
        if (\array_key_exists('id', $data)) {
            $object->setId($data['id']);
            unset($data['id']);
        }
        if (\array_key_exists('invoice_number', $data)) {
            $object->setInvoiceNumber($data['invoice_number']);
            unset($data['invoice_number']);
        }
        if (\array_key_exists('issue_date', $data)) {
            $date = \DateTime::createFromFormat('Y-m-d', $data['issue_date']);
            if ($date === false) {
                throw new InvalidDateException($data['issue_date'], 'Y-m-d');
            }
            $object->setIssueDate($date->setTime(0, 0, 0));
            unset($data['issue_date']);
        }
        if (\array_key_exists('customer_name', $data)) {
            $object->setCustomerName($data['customer_name']);
            unset($data['customer_name']);
        }
        if (\array_key_exists('taxable_base', $data)) {
            $object->setTaxableBase($data['taxable_base']);
            unset($data['taxable_base']);
        }
        if (\array_key_exists('total_vat', $data)) {
            $object->setTotalVat($data['total_vat']);
            unset($data['total_vat']);
        }
        if (\array_key_exists('total_irpf', $data)) {
            $object->setTotalIrpf($data['total_irpf']);
            unset($data['total_irpf']);
        }
        if (\array_key_exists('invoice_total', $data)) {
            $object->setInvoiceTotal($data['invoice_total']);
            unset($data['invoice_total']);
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
        $dataArray['id'] = $data->getId();
        $dataArray['invoice_number'] = $data->getInvoiceNumber();
        $dataArray['issue_date'] = $data->getIssueDate()->format('Y-m-d');
        if ($data->isInitialized('customerName') && $data->getCustomerName() !== null) {
            $dataArray['customer_name'] = $data->getCustomerName();
        }
        $dataArray['taxable_base'] = $data->getTaxableBase();
        $dataArray['total_vat'] = $data->getTotalVat();
        $dataArray['total_irpf'] = $data->getTotalIrpf();
        $dataArray['invoice_total'] = $data->getInvoiceTotal();
        foreach ($data->additionalPropertyEntries() as $key => $value) {
            if (preg_match('/.*/', (string) $key)) {
                $dataArray[$key] = $value;
            }
        }

        return $dataArray;
    }

    public function getSupportedTypes(?string $format = null): array
    {
        return [InvoiceFiscalData::class => false];
    }
}
