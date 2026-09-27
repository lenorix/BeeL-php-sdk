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
class PatchRecurringInvoiceRequestNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use CheckArray;
    use ValidatorTrait;
    public function supportsDenormalization(mixed $data, string $type, ?string $format = null, array $context = []): bool
    {
        return $type === \Lenorix\BeelSdk\Generated\Model\PatchRecurringInvoiceRequest::class;
    }
    public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
    {
        return is_object($data) && get_class($data) === \Lenorix\BeelSdk\Generated\Model\PatchRecurringInvoiceRequest::class;
    }
    public function denormalize(mixed $data, string $type, ?string $format = null, array $context = []): mixed
    {
        $object = new \Lenorix\BeelSdk\Generated\Model\PatchRecurringInvoiceRequest();
        if (null === $data || false === \is_array($data)) {
            return $object;
        }
        if (isset($data['$ref']) && !isset($data['type']) && !isset($data['properties']) && !isset($data['allOf'])) {
            return new Reference($data['$ref'], $context['document-origin']);
        }
        if (isset($data['$recursiveRef'])) {
            return new Reference($data['$recursiveRef'], $context['document-origin']);
        }
        if (\array_key_exists('draft_in_advance', $data) && \is_int($data['draft_in_advance'])) {
            $data['draft_in_advance'] = (bool) $data['draft_in_advance'];
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
            if (false === $date) {
                throw new \Lenorix\BeelSdk\Generated\Runtime\Normalizer\InvalidDateException($data['start_date'], 'Y-m-d');
            }
            $object->setStartDate($date->setTime(0, 0, 0));
            unset($data['start_date']);
        }
        if (\array_key_exists('draft_in_advance', $data)) {
            $object->setDraftInAdvance($data['draft_in_advance']);
            unset($data['draft_in_advance']);
        }
        if (\array_key_exists('preview_days', $data)) {
            $object->setPreviewDays($data['preview_days']);
            unset($data['preview_days']);
        }
        if (\array_key_exists('end_date', $data) && $data['end_date'] !== null) {
            $date_1 = \DateTime::createFromFormat('Y-m-d', $data['end_date']);
            if (false === $date_1) {
                throw new \Lenorix\BeelSdk\Generated\Runtime\Normalizer\InvalidDateException($data['end_date'], 'Y-m-d');
            }
            $object->setEndDate($date_1->setTime(0, 0, 0));
            unset($data['end_date']);
        }
        elseif (\array_key_exists('end_date', $data) && $data['end_date'] === null) {
            $object->setEndDate(null);
            unset($data['end_date']);
        }
        if (\array_key_exists('max_invoices', $data) && $data['max_invoices'] !== null) {
            $object->setMaxInvoices($data['max_invoices']);
            unset($data['max_invoices']);
        }
        elseif (\array_key_exists('max_invoices', $data) && $data['max_invoices'] === null) {
            $object->setMaxInvoices(null);
            unset($data['max_invoices']);
        }
        if (\array_key_exists('series_id', $data)) {
            $object->setSeriesId($data['series_id']);
            unset($data['series_id']);
        }
        if (\array_key_exists('customer_id', $data) && $data['customer_id'] !== null) {
            $object->setCustomerId($data['customer_id']);
            unset($data['customer_id']);
        }
        elseif (\array_key_exists('customer_id', $data) && $data['customer_id'] === null) {
            $object->setCustomerId(null);
            unset($data['customer_id']);
        }
        if (\array_key_exists('lines', $data) && $data['lines'] !== null) {
            $values = [];
            foreach ($data['lines'] as $value) {
                $values[] = $this->denormalizer->denormalize($value, \Lenorix\BeelSdk\Generated\Model\RecurringLineRequest::class, 'json', $context);
            }
            $object->setLines($values);
            unset($data['lines']);
        }
        elseif (\array_key_exists('lines', $data) && $data['lines'] === null) {
            $object->setLines(null);
            unset($data['lines']);
        }
        if (\array_key_exists('payment_method', $data) && $data['payment_method'] !== null) {
            $object->setPaymentMethod($data['payment_method']);
            unset($data['payment_method']);
        }
        elseif (\array_key_exists('payment_method', $data) && $data['payment_method'] === null) {
            $object->setPaymentMethod(null);
            unset($data['payment_method']);
        }
        if (\array_key_exists('payment_iban', $data) && $data['payment_iban'] !== null) {
            $object->setPaymentIban($data['payment_iban']);
            unset($data['payment_iban']);
        }
        elseif (\array_key_exists('payment_iban', $data) && $data['payment_iban'] === null) {
            $object->setPaymentIban(null);
            unset($data['payment_iban']);
        }
        if (\array_key_exists('payment_swift', $data) && $data['payment_swift'] !== null) {
            $object->setPaymentSwift($data['payment_swift']);
            unset($data['payment_swift']);
        }
        elseif (\array_key_exists('payment_swift', $data) && $data['payment_swift'] === null) {
            $object->setPaymentSwift(null);
            unset($data['payment_swift']);
        }
        if (\array_key_exists('payment_term_days', $data) && $data['payment_term_days'] !== null) {
            $object->setPaymentTermDays($data['payment_term_days']);
            unset($data['payment_term_days']);
        }
        elseif (\array_key_exists('payment_term_days', $data) && $data['payment_term_days'] === null) {
            $object->setPaymentTermDays(null);
            unset($data['payment_term_days']);
        }
        if (\array_key_exists('notes', $data) && $data['notes'] !== null) {
            $object->setNotes($data['notes']);
            unset($data['notes']);
        }
        elseif (\array_key_exists('notes', $data) && $data['notes'] === null) {
            $object->setNotes(null);
            unset($data['notes']);
        }
        if (\array_key_exists('send_automatically', $data)) {
            $object->setSendAutomatically($data['send_automatically']);
            unset($data['send_automatically']);
        }
        if (\array_key_exists('email_configuration', $data) && $data['email_configuration'] !== null) {
            $object->setEmailConfiguration($this->denormalizer->denormalize($data['email_configuration'], \Lenorix\BeelSdk\Generated\Model\PatchRecurringInvoiceRequestEmailConfiguration::class, 'json', $context));
            unset($data['email_configuration']);
        }
        elseif (\array_key_exists('email_configuration', $data) && $data['email_configuration'] === null) {
            $object->setEmailConfiguration(null);
            unset($data['email_configuration']);
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
        if ($data->isInitialized('name') && null !== $data->getName()) {
            $dataArray['name'] = $data->getName();
        }
        if ($data->isInitialized('frequency') && null !== $data->getFrequency()) {
            $dataArray['frequency'] = $data->getFrequency();
        }
        if ($data->isInitialized('dayOfMonth') && null !== $data->getDayOfMonth()) {
            $dataArray['day_of_month'] = $data->getDayOfMonth();
        }
        if ($data->isInitialized('startDate') && null !== $data->getStartDate()) {
            $dataArray['start_date'] = $data->getStartDate()->format('Y-m-d');
        }
        if ($data->isInitialized('draftInAdvance') && null !== $data->getDraftInAdvance()) {
            $dataArray['draft_in_advance'] = $data->getDraftInAdvance();
        }
        if ($data->isInitialized('previewDays') && null !== $data->getPreviewDays()) {
            $dataArray['preview_days'] = $data->getPreviewDays();
        }
        if ($data->isInitialized('endDate') && null !== $data->getEndDate()) {
            $dataArray['end_date'] = $data->getEndDate()?->format('Y-m-d');
        }
        if ($data->isInitialized('maxInvoices') && null !== $data->getMaxInvoices()) {
            $dataArray['max_invoices'] = $data->getMaxInvoices();
        }
        if ($data->isInitialized('seriesId') && null !== $data->getSeriesId()) {
            $dataArray['series_id'] = $data->getSeriesId();
        }
        if ($data->isInitialized('customerId') && null !== $data->getCustomerId()) {
            $dataArray['customer_id'] = $data->getCustomerId();
        }
        if ($data->isInitialized('lines') && null !== $data->getLines()) {
            $values = [];
            foreach ($data->getLines() as $value) {
                $values[] = $value === null ? null : new \Lenorix\BeelSdk\Generated\Runtime\JsonObject($this->normalizer->normalize($value, 'json', $context));
            }
            $dataArray['lines'] = $values;
        }
        if ($data->isInitialized('paymentMethod') && null !== $data->getPaymentMethod()) {
            $dataArray['payment_method'] = $data->getPaymentMethod();
        }
        if ($data->isInitialized('paymentIban') && null !== $data->getPaymentIban()) {
            $dataArray['payment_iban'] = $data->getPaymentIban();
        }
        if ($data->isInitialized('paymentSwift') && null !== $data->getPaymentSwift()) {
            $dataArray['payment_swift'] = $data->getPaymentSwift();
        }
        if ($data->isInitialized('paymentTermDays') && null !== $data->getPaymentTermDays()) {
            $dataArray['payment_term_days'] = $data->getPaymentTermDays();
        }
        if ($data->isInitialized('notes') && null !== $data->getNotes()) {
            $dataArray['notes'] = $data->getNotes();
        }
        if ($data->isInitialized('sendAutomatically') && null !== $data->getSendAutomatically()) {
            $dataArray['send_automatically'] = $data->getSendAutomatically();
        }
        if ($data->isInitialized('emailConfiguration') && null !== $data->getEmailConfiguration()) {
            $dataArray['email_configuration'] = $data->getEmailConfiguration() === null ? null : new \Lenorix\BeelSdk\Generated\Runtime\JsonObject($this->normalizer->normalize($data->getEmailConfiguration(), 'json', $context));
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
        return [\Lenorix\BeelSdk\Generated\Model\PatchRecurringInvoiceRequest::class => false];
    }
}