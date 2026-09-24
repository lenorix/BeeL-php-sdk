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
class FiscalSummaryResponseNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use CheckArray;
    use ValidatorTrait;
    public function supportsDenormalization(mixed $data, string $type, ?string $format = null, array $context = []): bool
    {
        return $type === \Lenorix\BeelSdk\Generated\Model\FiscalSummaryResponse::class;
    }
    public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
    {
        return is_object($data) && get_class($data) === \Lenorix\BeelSdk\Generated\Model\FiscalSummaryResponse::class;
    }
    public function denormalize(mixed $data, string $type, ?string $format = null, array $context = []): mixed
    {
        $object = new \Lenorix\BeelSdk\Generated\Model\FiscalSummaryResponse();
        if (null === $data || false === \is_array($data)) {
            return $object;
        }
        if (isset($data['$ref']) && !isset($data['type']) && !isset($data['properties']) && !isset($data['allOf'])) {
            return new Reference($data['$ref'], $context['document-origin']);
        }
        if (isset($data['$recursiveRef'])) {
            return new Reference($data['$recursiveRef'], $context['document-origin']);
        }
        if (\array_key_exists('total_taxable_base', $data) && \is_int($data['total_taxable_base'])) {
            $data['total_taxable_base'] = (float) $data['total_taxable_base'];
        }
        if (\array_key_exists('total_vat', $data) && \is_int($data['total_vat'])) {
            $data['total_vat'] = (float) $data['total_vat'];
        }
        if (\array_key_exists('total_equivalence_surcharge', $data) && \is_int($data['total_equivalence_surcharge'])) {
            $data['total_equivalence_surcharge'] = (float) $data['total_equivalence_surcharge'];
        }
        if (\array_key_exists('total_irpf_withheld', $data) && \is_int($data['total_irpf_withheld'])) {
            $data['total_irpf_withheld'] = (float) $data['total_irpf_withheld'];
        }
        if (\array_key_exists('period_base', $data) && \is_int($data['period_base'])) {
            $data['period_base'] = (float) $data['period_base'];
        }
        if (\array_key_exists('projected_annual_base', $data) && \is_int($data['projected_annual_base'])) {
            $data['projected_annual_base'] = (float) $data['projected_annual_base'];
        }
        if (\array_key_exists('estimated_annual_irpf', $data) && \is_int($data['estimated_annual_irpf'])) {
            $data['estimated_annual_irpf'] = (float) $data['estimated_annual_irpf'];
        }
        if (\array_key_exists('pending_annual_irpf', $data) && \is_int($data['pending_annual_irpf'])) {
            $data['pending_annual_irpf'] = (float) $data['pending_annual_irpf'];
        }
        if (\array_key_exists('queried_period', $data)) {
            $object->setQueriedPeriod($this->denormalizer->denormalize($data['queried_period'], \Lenorix\BeelSdk\Generated\Model\QueriedPeriod::class, 'json', $context));
            unset($data['queried_period']);
        }
        if (\array_key_exists('total_taxable_base', $data)) {
            $object->setTotalTaxableBase($data['total_taxable_base']);
            unset($data['total_taxable_base']);
        }
        if (\array_key_exists('total_vat', $data)) {
            $object->setTotalVat($data['total_vat']);
            unset($data['total_vat']);
        }
        if (\array_key_exists('tax_breakdown', $data)) {
            $values = [];
            foreach ($data['tax_breakdown'] as $value) {
                $values[] = $this->denormalizer->denormalize($value, \Lenorix\BeelSdk\Generated\Model\TaxBreakdownItem::class, 'json', $context);
            }
            $object->setTaxBreakdown($values);
            unset($data['tax_breakdown']);
        }
        if (\array_key_exists('vat_breakdown_by_rate', $data)) {
            $values_1 = new \Lenorix\BeelSdk\Generated\Runtime\JsonObject();
            foreach ($data['vat_breakdown_by_rate'] as $key => $value_1) {
                $values_1[$key] = $value_1;
            }
            $object->setVatBreakdownByRate($values_1);
            unset($data['vat_breakdown_by_rate']);
        }
        if (\array_key_exists('surcharge_breakdown', $data)) {
            $values_2 = [];
            foreach ($data['surcharge_breakdown'] as $value_2) {
                $values_2[] = $this->denormalizer->denormalize($value_2, \Lenorix\BeelSdk\Generated\Model\SurchargeBreakdownItem::class, 'json', $context);
            }
            $object->setSurchargeBreakdown($values_2);
            unset($data['surcharge_breakdown']);
        }
        if (\array_key_exists('total_equivalence_surcharge', $data)) {
            $object->setTotalEquivalenceSurcharge($data['total_equivalence_surcharge']);
            unset($data['total_equivalence_surcharge']);
        }
        if (\array_key_exists('total_irpf_withheld', $data)) {
            $object->setTotalIrpfWithheld($data['total_irpf_withheld']);
            unset($data['total_irpf_withheld']);
        }
        if (\array_key_exists('period_base', $data)) {
            $object->setPeriodBase($data['period_base']);
            unset($data['period_base']);
        }
        if (\array_key_exists('projected_annual_base', $data)) {
            $object->setProjectedAnnualBase($data['projected_annual_base']);
            unset($data['projected_annual_base']);
        }
        if (\array_key_exists('estimated_annual_irpf', $data)) {
            $object->setEstimatedAnnualIrpf($data['estimated_annual_irpf']);
            unset($data['estimated_annual_irpf']);
        }
        if (\array_key_exists('pending_annual_irpf', $data)) {
            $object->setPendingAnnualIrpf($data['pending_annual_irpf']);
            unset($data['pending_annual_irpf']);
        }
        if (\array_key_exists('bracket_details', $data)) {
            $values_3 = [];
            foreach ($data['bracket_details'] as $value_3) {
                $values_3[] = $this->denormalizer->denormalize($value_3, \Lenorix\BeelSdk\Generated\Model\IrpfBracket::class, 'json', $context);
            }
            $object->setBracketDetails($values_3);
            unset($data['bracket_details']);
        }
        if (\array_key_exists('invoices', $data)) {
            $values_4 = [];
            foreach ($data['invoices'] as $value_4) {
                $values_4[] = $this->denormalizer->denormalize($value_4, \Lenorix\BeelSdk\Generated\Model\InvoiceFiscalData::class, 'json', $context);
            }
            $object->setInvoices($values_4);
            unset($data['invoices']);
        }
        if (\array_key_exists('total_invoices', $data)) {
            $object->setTotalInvoices($data['total_invoices']);
            unset($data['total_invoices']);
        }
        foreach ($data as $key_1 => $value_5) {
            if (preg_match('/.*/', (string) $key_1)) {
                $object[$key_1] = $value_5;
            }
        }
        return $object;
    }
    public function normalize(mixed $data, ?string $format = null, array $context = []): array|string|int|float|bool|\ArrayObject|null
    {
        $dataArray = [];
        $dataArray['queried_period'] = $data->getQueriedPeriod() === null ? null : new \Lenorix\BeelSdk\Generated\Runtime\JsonObject($this->normalizer->normalize($data->getQueriedPeriod(), 'json', $context));
        $dataArray['total_taxable_base'] = $data->getTotalTaxableBase();
        $dataArray['total_vat'] = $data->getTotalVat();
        if ($data->isInitialized('taxBreakdown') && null !== $data->getTaxBreakdown()) {
            $values = [];
            foreach ($data->getTaxBreakdown() as $value) {
                $values[] = $value === null ? null : new \Lenorix\BeelSdk\Generated\Runtime\JsonObject($this->normalizer->normalize($value, 'json', $context));
            }
            $dataArray['tax_breakdown'] = $values;
        }
        if ($data->isInitialized('vatBreakdownByRate') && null !== $data->getVatBreakdownByRate()) {
            $values_1 = new \Lenorix\BeelSdk\Generated\Runtime\JsonObject();
            foreach ($data->getVatBreakdownByRate() as $key => $value_1) {
                $values_1[$key] = $value_1;
            }
            $dataArray['vat_breakdown_by_rate'] = $values_1;
        }
        if ($data->isInitialized('surchargeBreakdown') && null !== $data->getSurchargeBreakdown()) {
            $values_2 = [];
            foreach ($data->getSurchargeBreakdown() as $value_2) {
                $values_2[] = $value_2 === null ? null : new \Lenorix\BeelSdk\Generated\Runtime\JsonObject($this->normalizer->normalize($value_2, 'json', $context));
            }
            $dataArray['surcharge_breakdown'] = $values_2;
        }
        if ($data->isInitialized('totalEquivalenceSurcharge') && null !== $data->getTotalEquivalenceSurcharge()) {
            $dataArray['total_equivalence_surcharge'] = $data->getTotalEquivalenceSurcharge();
        }
        $dataArray['total_irpf_withheld'] = $data->getTotalIrpfWithheld();
        $dataArray['period_base'] = $data->getPeriodBase();
        $dataArray['projected_annual_base'] = $data->getProjectedAnnualBase();
        $dataArray['estimated_annual_irpf'] = $data->getEstimatedAnnualIrpf();
        $dataArray['pending_annual_irpf'] = $data->getPendingAnnualIrpf();
        $values_3 = [];
        foreach ($data->getBracketDetails() as $value_3) {
            $values_3[] = $value_3 === null ? null : new \Lenorix\BeelSdk\Generated\Runtime\JsonObject($this->normalizer->normalize($value_3, 'json', $context));
        }
        $dataArray['bracket_details'] = $values_3;
        if ($data->isInitialized('invoices') && null !== $data->getInvoices()) {
            $values_4 = [];
            foreach ($data->getInvoices() as $value_4) {
                $values_4[] = $value_4 === null ? null : new \Lenorix\BeelSdk\Generated\Runtime\JsonObject($this->normalizer->normalize($value_4, 'json', $context));
            }
            $dataArray['invoices'] = $values_4;
        }
        $dataArray['total_invoices'] = $data->getTotalInvoices();
        foreach ($data->additionalPropertyEntries() as $key_1 => $value_5) {
            if (preg_match('/.*/', (string) $key_1)) {
                $dataArray[$key_1] = $value_5;
            }
        }
        return $dataArray;
    }
    public function getSupportedTypes(?string $format = null): array
    {
        return [\Lenorix\BeelSdk\Generated\Model\FiscalSummaryResponse::class => false];
    }
}