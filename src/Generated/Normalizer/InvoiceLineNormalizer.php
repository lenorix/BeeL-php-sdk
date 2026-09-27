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
class InvoiceLineNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use CheckArray;
    use ValidatorTrait;
    public function supportsDenormalization(mixed $data, string $type, ?string $format = null, array $context = []): bool
    {
        return $type === \Lenorix\BeelSdk\Generated\Model\InvoiceLine::class;
    }
    public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
    {
        return is_object($data) && get_class($data) === \Lenorix\BeelSdk\Generated\Model\InvoiceLine::class;
    }
    public function denormalize(mixed $data, string $type, ?string $format = null, array $context = []): mixed
    {
        $object = new \Lenorix\BeelSdk\Generated\Model\InvoiceLine();
        if (null === $data || false === \is_array($data)) {
            return $object;
        }
        if (isset($data['$ref']) && !isset($data['type']) && !isset($data['properties']) && !isset($data['allOf'])) {
            return new Reference($data['$ref'], $context['document-origin']);
        }
        if (isset($data['$recursiveRef'])) {
            return new Reference($data['$recursiveRef'], $context['document-origin']);
        }
        if (\array_key_exists('quantity', $data) && \is_int($data['quantity'])) {
            $data['quantity'] = (float) $data['quantity'];
        }
        if (\array_key_exists('unit_price', $data) && \is_int($data['unit_price'])) {
            $data['unit_price'] = (float) $data['unit_price'];
        }
        if (\array_key_exists('discount_percentage', $data) && \is_int($data['discount_percentage'])) {
            $data['discount_percentage'] = (float) $data['discount_percentage'];
        }
        if (\array_key_exists('equivalence_surcharge_rate', $data) && \is_int($data['equivalence_surcharge_rate'])) {
            $data['equivalence_surcharge_rate'] = (float) $data['equivalence_surcharge_rate'];
        }
        if (\array_key_exists('taxable_base', $data) && \is_int($data['taxable_base'])) {
            $data['taxable_base'] = (float) $data['taxable_base'];
        }
        if (\array_key_exists('line_total', $data) && \is_int($data['line_total'])) {
            $data['line_total'] = (float) $data['line_total'];
        }
        if (\array_key_exists('total_excluding_tax', $data) && \is_int($data['total_excluding_tax'])) {
            $data['total_excluding_tax'] = (float) $data['total_excluding_tax'];
        }
        if (\array_key_exists('total_including_tax', $data) && \is_int($data['total_including_tax'])) {
            $data['total_including_tax'] = (float) $data['total_including_tax'];
        }
        if (\array_key_exists('description', $data)) {
            $object->setDescription($data['description']);
            unset($data['description']);
        }
        if (\array_key_exists('quantity', $data)) {
            $object->setQuantity($data['quantity']);
            unset($data['quantity']);
        }
        if (\array_key_exists('unit', $data)) {
            $object->setUnit($data['unit']);
            unset($data['unit']);
        }
        if (\array_key_exists('unit_price', $data)) {
            $object->setUnitPrice($data['unit_price']);
            unset($data['unit_price']);
        }
        if (\array_key_exists('discount_percentage', $data)) {
            $object->setDiscountPercentage($data['discount_percentage']);
            unset($data['discount_percentage']);
        }
        if (\array_key_exists('main_tax', $data)) {
            $object->setMainTax($this->denormalizer->denormalize($data['main_tax'], \Lenorix\BeelSdk\Generated\Model\TaxInfo::class, 'json', $context));
            unset($data['main_tax']);
        }
        if (\array_key_exists('equivalence_surcharge_rate', $data)) {
            $object->setEquivalenceSurchargeRate($data['equivalence_surcharge_rate']);
            unset($data['equivalence_surcharge_rate']);
        }
        if (\array_key_exists('irpf_rate', $data)) {
            $object->setIrpfRate($data['irpf_rate']);
            unset($data['irpf_rate']);
        }
        if (\array_key_exists('exemption_reason', $data)) {
            $object->setExemptionReason($data['exemption_reason']);
            unset($data['exemption_reason']);
        }
        if (\array_key_exists('exemption_reason_text', $data) && $data['exemption_reason_text'] !== null) {
            $object->setExemptionReasonText($data['exemption_reason_text']);
            unset($data['exemption_reason_text']);
        }
        elseif (\array_key_exists('exemption_reason_text', $data) && $data['exemption_reason_text'] === null) {
            $object->setExemptionReasonText(null);
            unset($data['exemption_reason_text']);
        }
        if (\array_key_exists('taxable_base', $data)) {
            $object->setTaxableBase($data['taxable_base']);
            unset($data['taxable_base']);
        }
        if (\array_key_exists('line_total', $data)) {
            $object->setLineTotal($data['line_total']);
            unset($data['line_total']);
        }
        if (\array_key_exists('pricing_mode', $data)) {
            $object->setPricingMode($data['pricing_mode']);
            unset($data['pricing_mode']);
        }
        if (\array_key_exists('total_excluding_tax', $data)) {
            $object->setTotalExcludingTax($data['total_excluding_tax']);
            unset($data['total_excluding_tax']);
        }
        if (\array_key_exists('total_including_tax', $data)) {
            $object->setTotalIncludingTax($data['total_including_tax']);
            unset($data['total_including_tax']);
        }
        if (\array_key_exists('line_type', $data)) {
            $object->setLineType($data['line_type']);
            unset($data['line_type']);
        }
        if (\array_key_exists('source_invoice_reference', $data) && $data['source_invoice_reference'] !== null) {
            $object->setSourceInvoiceReference($data['source_invoice_reference']);
            unset($data['source_invoice_reference']);
        }
        elseif (\array_key_exists('source_invoice_reference', $data) && $data['source_invoice_reference'] === null) {
            $object->setSourceInvoiceReference(null);
            unset($data['source_invoice_reference']);
        }
        if (\array_key_exists('source_invoice_ids', $data)) {
            $values = [];
            foreach ($data['source_invoice_ids'] as $value) {
                $values[] = $value;
            }
            $object->setSourceInvoiceIds($values);
            unset($data['source_invoice_ids']);
        }
        foreach ($data as $key => $value_1) {
            if (preg_match('/.*/', (string) $key)) {
                $object[$key] = $value_1;
            }
        }
        return $object;
    }
    public function normalize(mixed $data, ?string $format = null, array $context = []): array|string|int|float|bool|\ArrayObject|null
    {
        $dataArray = [];
        if ($data->isInitialized('description') && null !== $data->getDescription()) {
            $dataArray['description'] = $data->getDescription();
        }
        $dataArray['quantity'] = $data->getQuantity();
        if ($data->isInitialized('unit') && null !== $data->getUnit()) {
            $dataArray['unit'] = $data->getUnit();
        }
        $dataArray['unit_price'] = $data->getUnitPrice();
        if ($data->isInitialized('discountPercentage') && null !== $data->getDiscountPercentage()) {
            $dataArray['discount_percentage'] = $data->getDiscountPercentage();
        }
        if ($data->isInitialized('mainTax') && null !== $data->getMainTax()) {
            $dataArray['main_tax'] = $data->getMainTax() === null ? null : new \Lenorix\BeelSdk\Generated\Runtime\JsonObject($this->normalizer->normalize($data->getMainTax(), 'json', $context));
        }
        if ($data->isInitialized('equivalenceSurchargeRate') && null !== $data->getEquivalenceSurchargeRate()) {
            $dataArray['equivalence_surcharge_rate'] = $data->getEquivalenceSurchargeRate();
        }
        if ($data->isInitialized('irpfRate') && null !== $data->getIrpfRate()) {
            $dataArray['irpf_rate'] = $data->getIrpfRate();
        }
        if ($data->isInitialized('exemptionReason') && null !== $data->getExemptionReason()) {
            $dataArray['exemption_reason'] = $data->getExemptionReason();
        }
        if ($data->isInitialized('exemptionReasonText') && null !== $data->getExemptionReasonText()) {
            $dataArray['exemption_reason_text'] = $data->getExemptionReasonText();
        }
        if ($data->isInitialized('taxableBase') && null !== $data->getTaxableBase()) {
            $dataArray['taxable_base'] = $data->getTaxableBase();
        }
        $dataArray['line_total'] = $data->getLineTotal();
        if ($data->isInitialized('pricingMode') && null !== $data->getPricingMode()) {
            $dataArray['pricing_mode'] = $data->getPricingMode();
        }
        if ($data->isInitialized('totalExcludingTax') && null !== $data->getTotalExcludingTax()) {
            $dataArray['total_excluding_tax'] = $data->getTotalExcludingTax();
        }
        if ($data->isInitialized('totalIncludingTax') && null !== $data->getTotalIncludingTax()) {
            $dataArray['total_including_tax'] = $data->getTotalIncludingTax();
        }
        if ($data->isInitialized('lineType') && null !== $data->getLineType()) {
            $dataArray['line_type'] = $data->getLineType();
        }
        if ($data->isInitialized('sourceInvoiceReference') && null !== $data->getSourceInvoiceReference()) {
            $dataArray['source_invoice_reference'] = $data->getSourceInvoiceReference();
        }
        if ($data->isInitialized('sourceInvoiceIds') && null !== $data->getSourceInvoiceIds()) {
            $values = [];
            foreach ($data->getSourceInvoiceIds() as $value) {
                $values[] = $value;
            }
            $dataArray['source_invoice_ids'] = $values;
        }
        foreach ($data->additionalPropertyEntries() as $key => $value_1) {
            if (preg_match('/.*/', (string) $key)) {
                $dataArray[$key] = $value_1;
            }
        }
        return $dataArray;
    }
    public function getSupportedTypes(?string $format = null): array
    {
        return [\Lenorix\BeelSdk\Generated\Model\InvoiceLine::class => false];
    }
}