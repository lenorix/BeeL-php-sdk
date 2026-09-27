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
class UpdateTaxConfigurationRequestNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use CheckArray;
    use ValidatorTrait;
    public function supportsDenormalization(mixed $data, string $type, ?string $format = null, array $context = []): bool
    {
        return $type === \Lenorix\BeelSdk\Generated\Model\UpdateTaxConfigurationRequest::class;
    }
    public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
    {
        return is_object($data) && get_class($data) === \Lenorix\BeelSdk\Generated\Model\UpdateTaxConfigurationRequest::class;
    }
    public function denormalize(mixed $data, string $type, ?string $format = null, array $context = []): mixed
    {
        $object = new \Lenorix\BeelSdk\Generated\Model\UpdateTaxConfigurationRequest();
        if (null === $data || false === \is_array($data)) {
            return $object;
        }
        if (isset($data['$ref']) && !isset($data['type']) && !isset($data['properties']) && !isset($data['allOf'])) {
            return new Reference($data['$ref'], $context['document-origin']);
        }
        if (isset($data['$recursiveRef'])) {
            return new Reference($data['$recursiveRef'], $context['document-origin']);
        }
        if (\array_key_exists('default_equivalence_surcharge', $data) && \is_int($data['default_equivalence_surcharge'])) {
            $data['default_equivalence_surcharge'] = (float) $data['default_equivalence_surcharge'];
        }
        if (\array_key_exists('apply_equivalence_surcharge', $data) && \is_int($data['apply_equivalence_surcharge'])) {
            $data['apply_equivalence_surcharge'] = (bool) $data['apply_equivalence_surcharge'];
        }
        if (\array_key_exists('apply_irpf', $data) && \is_int($data['apply_irpf'])) {
            $data['apply_irpf'] = (bool) $data['apply_irpf'];
        }
        if (\array_key_exists('irpf_exempt', $data) && \is_int($data['irpf_exempt'])) {
            $data['irpf_exempt'] = (bool) $data['irpf_exempt'];
        }
        if (\array_key_exists('default_main_tax', $data)) {
            $object->setDefaultMainTax($this->denormalizer->denormalize($data['default_main_tax'], \Lenorix\BeelSdk\Generated\Model\UpdateTaxConfigurationRequestDefaultMainTax::class, 'json', $context));
            unset($data['default_main_tax']);
        }
        if (\array_key_exists('default_exemption_reason', $data)) {
            $object->setDefaultExemptionReason($data['default_exemption_reason']);
            unset($data['default_exemption_reason']);
        }
        if (\array_key_exists('default_exemption_reason_text', $data) && $data['default_exemption_reason_text'] !== null) {
            $object->setDefaultExemptionReasonText($data['default_exemption_reason_text']);
            unset($data['default_exemption_reason_text']);
        }
        elseif (\array_key_exists('default_exemption_reason_text', $data) && $data['default_exemption_reason_text'] === null) {
            $object->setDefaultExemptionReasonText(null);
            unset($data['default_exemption_reason_text']);
        }
        if (\array_key_exists('apply_equivalence_surcharge', $data)) {
            $object->setApplyEquivalenceSurcharge($data['apply_equivalence_surcharge']);
            unset($data['apply_equivalence_surcharge']);
        }
        if (\array_key_exists('default_equivalence_surcharge', $data)) {
            $object->setDefaultEquivalenceSurcharge($data['default_equivalence_surcharge']);
            unset($data['default_equivalence_surcharge']);
        }
        if (\array_key_exists('apply_irpf', $data)) {
            $object->setApplyIrpf($data['apply_irpf']);
            unset($data['apply_irpf']);
        }
        if (\array_key_exists('default_irpf_rate', $data)) {
            $object->setDefaultIrpfRate($data['default_irpf_rate']);
            unset($data['default_irpf_rate']);
        }
        if (\array_key_exists('irpf_exempt', $data)) {
            $object->setIrpfExempt($data['irpf_exempt']);
            unset($data['irpf_exempt']);
        }
        if (\array_key_exists('default_payment_method', $data) && $data['default_payment_method'] !== null) {
            $object->setDefaultPaymentMethod($data['default_payment_method']);
            unset($data['default_payment_method']);
        }
        elseif (\array_key_exists('default_payment_method', $data) && $data['default_payment_method'] === null) {
            $object->setDefaultPaymentMethod(null);
            unset($data['default_payment_method']);
        }
        if (\array_key_exists('payment_term_days', $data) && $data['payment_term_days'] !== null) {
            $object->setPaymentTermDays($data['payment_term_days']);
            unset($data['payment_term_days']);
        }
        elseif (\array_key_exists('payment_term_days', $data) && $data['payment_term_days'] === null) {
            $object->setPaymentTermDays(null);
            unset($data['payment_term_days']);
        }
        if (\array_key_exists('proforma_validity_days', $data) && $data['proforma_validity_days'] !== null) {
            $object->setProformaValidityDays($data['proforma_validity_days']);
            unset($data['proforma_validity_days']);
        }
        elseif (\array_key_exists('proforma_validity_days', $data) && $data['proforma_validity_days'] === null) {
            $object->setProformaValidityDays(null);
            unset($data['proforma_validity_days']);
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
        if ($data->isInitialized('defaultMainTax') && null !== $data->getDefaultMainTax()) {
            $dataArray['default_main_tax'] = $data->getDefaultMainTax() === null ? null : new \Lenorix\BeelSdk\Generated\Runtime\JsonObject($this->normalizer->normalize($data->getDefaultMainTax(), 'json', $context));
        }
        if ($data->isInitialized('defaultExemptionReason') && null !== $data->getDefaultExemptionReason()) {
            $dataArray['default_exemption_reason'] = $data->getDefaultExemptionReason();
        }
        if ($data->isInitialized('defaultExemptionReasonText') && null !== $data->getDefaultExemptionReasonText()) {
            $dataArray['default_exemption_reason_text'] = $data->getDefaultExemptionReasonText();
        }
        if ($data->isInitialized('applyEquivalenceSurcharge') && null !== $data->getApplyEquivalenceSurcharge()) {
            $dataArray['apply_equivalence_surcharge'] = $data->getApplyEquivalenceSurcharge();
        }
        if ($data->isInitialized('defaultEquivalenceSurcharge') && null !== $data->getDefaultEquivalenceSurcharge()) {
            $dataArray['default_equivalence_surcharge'] = $data->getDefaultEquivalenceSurcharge();
        }
        if ($data->isInitialized('applyIrpf') && null !== $data->getApplyIrpf()) {
            $dataArray['apply_irpf'] = $data->getApplyIrpf();
        }
        if ($data->isInitialized('defaultIrpfRate') && null !== $data->getDefaultIrpfRate()) {
            $dataArray['default_irpf_rate'] = $data->getDefaultIrpfRate();
        }
        if ($data->isInitialized('irpfExempt') && null !== $data->getIrpfExempt()) {
            $dataArray['irpf_exempt'] = $data->getIrpfExempt();
        }
        if ($data->isInitialized('defaultPaymentMethod') && null !== $data->getDefaultPaymentMethod()) {
            $dataArray['default_payment_method'] = $data->getDefaultPaymentMethod();
        }
        if ($data->isInitialized('paymentTermDays') && null !== $data->getPaymentTermDays()) {
            $dataArray['payment_term_days'] = $data->getPaymentTermDays();
        }
        if ($data->isInitialized('proformaValidityDays') && null !== $data->getProformaValidityDays()) {
            $dataArray['proforma_validity_days'] = $data->getProformaValidityDays();
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
        return [\Lenorix\BeelSdk\Generated\Model\UpdateTaxConfigurationRequest::class => false];
    }
}