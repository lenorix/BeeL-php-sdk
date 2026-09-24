<?php

namespace Lenorix\BeelSdk\Generated\Normalizer;

use Jane\Component\JsonSchemaRuntime\Reference;
use Lenorix\BeelSdk\Generated\Model\RecurringLineRequest;
use Lenorix\BeelSdk\Generated\Runtime\Normalizer\CheckArray;
use Lenorix\BeelSdk\Generated\Runtime\Normalizer\ValidatorTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class RecurringLineRequestNormalizer implements DenormalizerAwareInterface, DenormalizerInterface, NormalizerAwareInterface, NormalizerInterface
{
    use CheckArray;
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use ValidatorTrait;

    public function supportsDenormalization(mixed $data, string $type, ?string $format = null, array $context = []): bool
    {
        return $type === RecurringLineRequest::class;
    }

    public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
    {
        return is_object($data) && get_class($data) === RecurringLineRequest::class;
    }

    public function denormalize(mixed $data, string $type, ?string $format = null, array $context = []): mixed
    {
        $object = new RecurringLineRequest;
        if ($data === null || \is_array($data) === false) {
            return $object;
        }
        if (isset($data['$ref']) && ! isset($data['type']) && ! isset($data['properties']) && ! isset($data['allOf'])) {
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
        if (\array_key_exists('total_excluding_tax', $data) && \is_int($data['total_excluding_tax'])) {
            $data['total_excluding_tax'] = (float) $data['total_excluding_tax'];
        }
        if (\array_key_exists('total_including_tax', $data) && \is_int($data['total_including_tax'])) {
            $data['total_including_tax'] = (float) $data['total_including_tax'];
        }
        if (\array_key_exists('discount_percentage', $data) && \is_int($data['discount_percentage'])) {
            $data['discount_percentage'] = (float) $data['discount_percentage'];
        }
        if (\array_key_exists('vat_rate', $data) && \is_int($data['vat_rate'])) {
            $data['vat_rate'] = (float) $data['vat_rate'];
        }
        if (\array_key_exists('equivalence_surcharge_rate', $data) && \is_int($data['equivalence_surcharge_rate'])) {
            $data['equivalence_surcharge_rate'] = (float) $data['equivalence_surcharge_rate'];
        }
        if (\array_key_exists('irpf_rate', $data) && \is_int($data['irpf_rate'])) {
            $data['irpf_rate'] = (float) $data['irpf_rate'];
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
        if (\array_key_exists('total_excluding_tax', $data)) {
            $object->setTotalExcludingTax($data['total_excluding_tax']);
            unset($data['total_excluding_tax']);
        }
        if (\array_key_exists('total_including_tax', $data)) {
            $object->setTotalIncludingTax($data['total_including_tax']);
            unset($data['total_including_tax']);
        }
        if (\array_key_exists('discount_percentage', $data)) {
            $object->setDiscountPercentage($data['discount_percentage']);
            unset($data['discount_percentage']);
        }
        if (\array_key_exists('tax_type', $data)) {
            $object->setTaxType($data['tax_type']);
            unset($data['tax_type']);
        }
        if (\array_key_exists('vat_rate', $data)) {
            $object->setVatRate($data['vat_rate']);
            unset($data['vat_rate']);
        }
        if (\array_key_exists('regime_key', $data)) {
            $object->setRegimeKey($data['regime_key']);
            unset($data['regime_key']);
        }
        if (\array_key_exists('equivalence_surcharge_rate', $data) && $data['equivalence_surcharge_rate'] !== null) {
            $object->setEquivalenceSurchargeRate($data['equivalence_surcharge_rate']);
            unset($data['equivalence_surcharge_rate']);
        } elseif (\array_key_exists('equivalence_surcharge_rate', $data) && $data['equivalence_surcharge_rate'] === null) {
            $object->setEquivalenceSurchargeRate(null);
            unset($data['equivalence_surcharge_rate']);
        }
        if (\array_key_exists('irpf_rate', $data) && $data['irpf_rate'] !== null) {
            $object->setIrpfRate($data['irpf_rate']);
            unset($data['irpf_rate']);
        } elseif (\array_key_exists('irpf_rate', $data) && $data['irpf_rate'] === null) {
            $object->setIrpfRate(null);
            unset($data['irpf_rate']);
        }
        if (\array_key_exists('exemption_reason', $data)) {
            $object->setExemptionReason($data['exemption_reason']);
            unset($data['exemption_reason']);
        }
        if (\array_key_exists('exemption_reason_text', $data) && $data['exemption_reason_text'] !== null) {
            $object->setExemptionReasonText($data['exemption_reason_text']);
            unset($data['exemption_reason_text']);
        } elseif (\array_key_exists('exemption_reason_text', $data) && $data['exemption_reason_text'] === null) {
            $object->setExemptionReasonText(null);
            unset($data['exemption_reason_text']);
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
        $dataArray['description'] = $data->getDescription();
        $dataArray['quantity'] = $data->getQuantity();
        if ($data->isInitialized('unit') && $data->getUnit() !== null) {
            $dataArray['unit'] = $data->getUnit();
        }
        if ($data->isInitialized('unitPrice') && $data->getUnitPrice() !== null) {
            $dataArray['unit_price'] = $data->getUnitPrice();
        }
        if ($data->isInitialized('totalExcludingTax') && $data->getTotalExcludingTax() !== null) {
            $dataArray['total_excluding_tax'] = $data->getTotalExcludingTax();
        }
        if ($data->isInitialized('totalIncludingTax') && $data->getTotalIncludingTax() !== null) {
            $dataArray['total_including_tax'] = $data->getTotalIncludingTax();
        }
        if ($data->isInitialized('discountPercentage') && $data->getDiscountPercentage() !== null) {
            $dataArray['discount_percentage'] = $data->getDiscountPercentage();
        }
        if ($data->isInitialized('taxType') && $data->getTaxType() !== null) {
            $dataArray['tax_type'] = $data->getTaxType();
        }
        $dataArray['vat_rate'] = $data->getVatRate();
        if ($data->isInitialized('regimeKey') && $data->getRegimeKey() !== null) {
            $dataArray['regime_key'] = $data->getRegimeKey();
        }
        if ($data->isInitialized('equivalenceSurchargeRate') && $data->getEquivalenceSurchargeRate() !== null) {
            $dataArray['equivalence_surcharge_rate'] = $data->getEquivalenceSurchargeRate();
        }
        if ($data->isInitialized('irpfRate') && $data->getIrpfRate() !== null) {
            $dataArray['irpf_rate'] = $data->getIrpfRate();
        }
        if ($data->isInitialized('exemptionReason') && $data->getExemptionReason() !== null) {
            $dataArray['exemption_reason'] = $data->getExemptionReason();
        }
        if ($data->isInitialized('exemptionReasonText') && $data->getExemptionReasonText() !== null) {
            $dataArray['exemption_reason_text'] = $data->getExemptionReasonText();
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
        return [RecurringLineRequest::class => false];
    }
}
