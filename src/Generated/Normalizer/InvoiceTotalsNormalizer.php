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
class InvoiceTotalsNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use CheckArray;
    use ValidatorTrait;
    public function supportsDenormalization(mixed $data, string $type, ?string $format = null, array $context = []): bool
    {
        return $type === \Lenorix\BeelSdk\Generated\Model\InvoiceTotals::class;
    }
    public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
    {
        return is_object($data) && get_class($data) === \Lenorix\BeelSdk\Generated\Model\InvoiceTotals::class;
    }
    public function denormalize(mixed $data, string $type, ?string $format = null, array $context = []): mixed
    {
        $object = new \Lenorix\BeelSdk\Generated\Model\InvoiceTotals();
        if (null === $data || false === \is_array($data)) {
            return $object;
        }
        if (isset($data['$ref']) && !isset($data['type']) && !isset($data['properties']) && !isset($data['allOf'])) {
            return new Reference($data['$ref'], $context['document-origin']);
        }
        if (isset($data['$recursiveRef'])) {
            return new Reference($data['$recursiveRef'], $context['document-origin']);
        }
        if (\array_key_exists('taxable_base', $data) && \is_int($data['taxable_base'])) {
            $data['taxable_base'] = (float) $data['taxable_base'];
        }
        if (\array_key_exists('total_discounts', $data) && \is_int($data['total_discounts'])) {
            $data['total_discounts'] = (float) $data['total_discounts'];
        }
        if (\array_key_exists('total_vat', $data) && \is_int($data['total_vat'])) {
            $data['total_vat'] = (float) $data['total_vat'];
        }
        if (\array_key_exists('total_equivalence_surcharge', $data) && \is_int($data['total_equivalence_surcharge'])) {
            $data['total_equivalence_surcharge'] = (float) $data['total_equivalence_surcharge'];
        }
        if (\array_key_exists('total_irpf', $data) && \is_int($data['total_irpf'])) {
            $data['total_irpf'] = (float) $data['total_irpf'];
        }
        if (\array_key_exists('invoice_total', $data) && \is_int($data['invoice_total'])) {
            $data['invoice_total'] = (float) $data['invoice_total'];
        }
        if (\array_key_exists('total_disbursements', $data) && \is_int($data['total_disbursements'])) {
            $data['total_disbursements'] = (float) $data['total_disbursements'];
        }
        if (\array_key_exists('total_to_pay', $data) && \is_int($data['total_to_pay'])) {
            $data['total_to_pay'] = (float) $data['total_to_pay'];
        }
        if (\array_key_exists('taxable_base', $data)) {
            $object->setTaxableBase($data['taxable_base']);
            unset($data['taxable_base']);
        }
        if (\array_key_exists('total_discounts', $data)) {
            $object->setTotalDiscounts($data['total_discounts']);
            unset($data['total_discounts']);
        }
        if (\array_key_exists('vat_breakdown', $data)) {
            $values = [];
            foreach ($data['vat_breakdown'] as $value) {
                $values[] = $this->denormalizer->denormalize($value, \Lenorix\BeelSdk\Generated\Model\InvoiceTotalsVatBreakdownItem::class, 'json', $context);
            }
            $object->setVatBreakdown($values);
            unset($data['vat_breakdown']);
        }
        if (\array_key_exists('total_vat', $data)) {
            $object->setTotalVat($data['total_vat']);
            unset($data['total_vat']);
        }
        if (\array_key_exists('surcharge_breakdown', $data)) {
            $values_1 = [];
            foreach ($data['surcharge_breakdown'] as $value_1) {
                $values_1[] = $this->denormalizer->denormalize($value_1, \Lenorix\BeelSdk\Generated\Model\InvoiceTotalsSurchargeBreakdownItem::class, 'json', $context);
            }
            $object->setSurchargeBreakdown($values_1);
            unset($data['surcharge_breakdown']);
        }
        if (\array_key_exists('total_equivalence_surcharge', $data)) {
            $object->setTotalEquivalenceSurcharge($data['total_equivalence_surcharge']);
            unset($data['total_equivalence_surcharge']);
        }
        if (\array_key_exists('irpf_breakdown', $data)) {
            $values_2 = [];
            foreach ($data['irpf_breakdown'] as $value_2) {
                $values_2[] = $this->denormalizer->denormalize($value_2, \Lenorix\BeelSdk\Generated\Model\InvoiceTotalsIrpfBreakdownItem::class, 'json', $context);
            }
            $object->setIrpfBreakdown($values_2);
            unset($data['irpf_breakdown']);
        }
        if (\array_key_exists('total_irpf', $data)) {
            $object->setTotalIrpf($data['total_irpf']);
            unset($data['total_irpf']);
        }
        if (\array_key_exists('invoice_total', $data)) {
            $object->setInvoiceTotal($data['invoice_total']);
            unset($data['invoice_total']);
        }
        if (\array_key_exists('total_disbursements', $data)) {
            $object->setTotalDisbursements($data['total_disbursements']);
            unset($data['total_disbursements']);
        }
        if (\array_key_exists('total_to_pay', $data)) {
            $object->setTotalToPay($data['total_to_pay']);
            unset($data['total_to_pay']);
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
        $dataArray['taxable_base'] = $data->getTaxableBase();
        if ($data->isInitialized('totalDiscounts') && null !== $data->getTotalDiscounts()) {
            $dataArray['total_discounts'] = $data->getTotalDiscounts();
        }
        if ($data->isInitialized('vatBreakdown') && null !== $data->getVatBreakdown()) {
            $values = [];
            foreach ($data->getVatBreakdown() as $value) {
                $values[] = $value === null ? null : new \Lenorix\BeelSdk\Generated\Runtime\JsonObject($this->normalizer->normalize($value, 'json', $context));
            }
            $dataArray['vat_breakdown'] = $values;
        }
        $dataArray['total_vat'] = $data->getTotalVat();
        if ($data->isInitialized('surchargeBreakdown') && null !== $data->getSurchargeBreakdown()) {
            $values_1 = [];
            foreach ($data->getSurchargeBreakdown() as $value_1) {
                $values_1[] = $value_1 === null ? null : new \Lenorix\BeelSdk\Generated\Runtime\JsonObject($this->normalizer->normalize($value_1, 'json', $context));
            }
            $dataArray['surcharge_breakdown'] = $values_1;
        }
        $dataArray['total_equivalence_surcharge'] = $data->getTotalEquivalenceSurcharge();
        if ($data->isInitialized('irpfBreakdown') && null !== $data->getIrpfBreakdown()) {
            $values_2 = [];
            foreach ($data->getIrpfBreakdown() as $value_2) {
                $values_2[] = $value_2 === null ? null : new \Lenorix\BeelSdk\Generated\Runtime\JsonObject($this->normalizer->normalize($value_2, 'json', $context));
            }
            $dataArray['irpf_breakdown'] = $values_2;
        }
        $dataArray['total_irpf'] = $data->getTotalIrpf();
        $dataArray['invoice_total'] = $data->getInvoiceTotal();
        if ($data->isInitialized('totalDisbursements') && null !== $data->getTotalDisbursements()) {
            $dataArray['total_disbursements'] = $data->getTotalDisbursements();
        }
        if ($data->isInitialized('totalToPay') && null !== $data->getTotalToPay()) {
            $dataArray['total_to_pay'] = $data->getTotalToPay();
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
        return [\Lenorix\BeelSdk\Generated\Model\InvoiceTotals::class => false];
    }
}