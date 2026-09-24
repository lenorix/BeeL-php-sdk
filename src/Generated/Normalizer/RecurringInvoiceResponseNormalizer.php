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
class RecurringInvoiceResponseNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use CheckArray;
    use ValidatorTrait;
    public function supportsDenormalization(mixed $data, string $type, ?string $format = null, array $context = []): bool
    {
        return $type === \Lenorix\BeelSdk\Generated\Model\RecurringInvoiceResponse::class;
    }
    public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
    {
        return is_object($data) && get_class($data) === \Lenorix\BeelSdk\Generated\Model\RecurringInvoiceResponse::class;
    }
    public function denormalize(mixed $data, string $type, ?string $format = null, array $context = []): mixed
    {
        $object = new \Lenorix\BeelSdk\Generated\Model\RecurringInvoiceResponse();
        if (null === $data || false === \is_array($data)) {
            return $object;
        }
        if (isset($data['$ref']) && !isset($data['type']) && !isset($data['properties']) && !isset($data['allOf'])) {
            return new Reference($data['$ref'], $context['document-origin']);
        }
        if (isset($data['$recursiveRef'])) {
            return new Reference($data['$recursiveRef'], $context['document-origin']);
        }
        if (\array_key_exists('amount', $data) && \is_int($data['amount'])) {
            $data['amount'] = (float) $data['amount'];
        }
        if (\array_key_exists('draft_in_advance', $data) && \is_int($data['draft_in_advance'])) {
            $data['draft_in_advance'] = (bool) $data['draft_in_advance'];
        }
        if (\array_key_exists('send_automatically', $data) && \is_int($data['send_automatically'])) {
            $data['send_automatically'] = (bool) $data['send_automatically'];
        }
        if (\array_key_exists('id', $data)) {
            $object->setId($data['id']);
            unset($data['id']);
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
        if (\array_key_exists('next_generation', $data) && $data['next_generation'] !== null) {
            $date_2 = \DateTime::createFromFormat('Y-m-d', $data['next_generation']);
            if (false === $date_2) {
                throw new \Lenorix\BeelSdk\Generated\Runtime\Normalizer\InvalidDateException($data['next_generation'], 'Y-m-d');
            }
            $object->setNextGeneration($date_2->setTime(0, 0, 0));
            unset($data['next_generation']);
        }
        elseif (\array_key_exists('next_generation', $data) && $data['next_generation'] === null) {
            $object->setNextGeneration(null);
            unset($data['next_generation']);
        }
        if (\array_key_exists('draft_in_advance', $data)) {
            $object->setDraftInAdvance($data['draft_in_advance']);
            unset($data['draft_in_advance']);
        }
        if (\array_key_exists('status', $data)) {
            $object->setStatus($data['status']);
            unset($data['status']);
        }
        if (\array_key_exists('pause', $data) && $data['pause'] !== null) {
            $object->setPause($this->denormalizer->denormalize($data['pause'], \Lenorix\BeelSdk\Generated\Model\RecurringInvoicePause::class, 'json', $context));
            unset($data['pause']);
        }
        elseif (\array_key_exists('pause', $data) && $data['pause'] === null) {
            $object->setPause(null);
            unset($data['pause']);
        }
        if (\array_key_exists('completion', $data) && $data['completion'] !== null) {
            $object->setCompletion($this->denormalizer->denormalize($data['completion'], \Lenorix\BeelSdk\Generated\Model\RecurringInvoiceCompletion::class, 'json', $context));
            unset($data['completion']);
        }
        elseif (\array_key_exists('completion', $data) && $data['completion'] === null) {
            $object->setCompletion(null);
            unset($data['completion']);
        }
        if (\array_key_exists('series_id', $data)) {
            $object->setSeriesId($data['series_id']);
            unset($data['series_id']);
        }
        if (\array_key_exists('series_code', $data)) {
            $object->setSeriesCode($data['series_code']);
            unset($data['series_code']);
        }
        if (\array_key_exists('invoice_type', $data)) {
            $object->setInvoiceType($data['invoice_type']);
            unset($data['invoice_type']);
        }
        if (\array_key_exists('customer_id', $data) && $data['customer_id'] !== null) {
            $object->setCustomerId($data['customer_id']);
            unset($data['customer_id']);
        }
        elseif (\array_key_exists('customer_id', $data) && $data['customer_id'] === null) {
            $object->setCustomerId(null);
            unset($data['customer_id']);
        }
        if (\array_key_exists('recipient_fiscal_name', $data) && $data['recipient_fiscal_name'] !== null) {
            $object->setRecipientFiscalName($data['recipient_fiscal_name']);
            unset($data['recipient_fiscal_name']);
        }
        elseif (\array_key_exists('recipient_fiscal_name', $data) && $data['recipient_fiscal_name'] === null) {
            $object->setRecipientFiscalName(null);
            unset($data['recipient_fiscal_name']);
        }
        if (\array_key_exists('recipient_nif', $data) && $data['recipient_nif'] !== null) {
            $object->setRecipientNif($data['recipient_nif']);
            unset($data['recipient_nif']);
        }
        elseif (\array_key_exists('recipient_nif', $data) && $data['recipient_nif'] === null) {
            $object->setRecipientNif(null);
            unset($data['recipient_nif']);
        }
        if (\array_key_exists('recipient_alternative_id', $data)) {
            $object->setRecipientAlternativeId($this->denormalizer->denormalize($data['recipient_alternative_id'], \Lenorix\BeelSdk\Generated\Model\RecurringInvoiceResponseRecipientAlternativeId::class, 'json', $context));
            unset($data['recipient_alternative_id']);
        }
        if (\array_key_exists('lines', $data)) {
            $values = [];
            foreach ($data['lines'] as $value) {
                $values[] = $this->denormalizer->denormalize($value, \Lenorix\BeelSdk\Generated\Model\InvoiceLineTemplateResponse::class, 'json', $context);
            }
            $object->setLines($values);
            unset($data['lines']);
        }
        if (\array_key_exists('amount', $data) && $data['amount'] !== null) {
            $object->setAmount($data['amount']);
            unset($data['amount']);
        }
        elseif (\array_key_exists('amount', $data) && $data['amount'] === null) {
            $object->setAmount(null);
            unset($data['amount']);
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
            $object->setEmailConfiguration($this->denormalizer->denormalize($data['email_configuration'], \Lenorix\BeelSdk\Generated\Model\RecurringEmailConfigResponse::class, 'json', $context));
            unset($data['email_configuration']);
        }
        elseif (\array_key_exists('email_configuration', $data) && $data['email_configuration'] === null) {
            $object->setEmailConfiguration(null);
            unset($data['email_configuration']);
        }
        if (\array_key_exists('generated_invoices', $data)) {
            $object->setGeneratedInvoices($data['generated_invoices']);
            unset($data['generated_invoices']);
        }
        if (\array_key_exists('max_invoices', $data) && $data['max_invoices'] !== null) {
            $object->setMaxInvoices($data['max_invoices']);
            unset($data['max_invoices']);
        }
        elseif (\array_key_exists('max_invoices', $data) && $data['max_invoices'] === null) {
            $object->setMaxInvoices(null);
            unset($data['max_invoices']);
        }
        if (\array_key_exists('last_generated_at', $data) && $data['last_generated_at'] !== null) {
            $date_3 = \DateTime::createFromFormat('Y-m-d\TH:i:sP', $data['last_generated_at']);
            if (false === $date_3) {
                throw new \Lenorix\BeelSdk\Generated\Runtime\Normalizer\InvalidDateException($data['last_generated_at'], 'Y-m-d\TH:i:sP');
            }
            $object->setLastGeneratedAt($date_3);
            unset($data['last_generated_at']);
        }
        elseif (\array_key_exists('last_generated_at', $data) && $data['last_generated_at'] === null) {
            $object->setLastGeneratedAt(null);
            unset($data['last_generated_at']);
        }
        if (\array_key_exists('source_invoice_id', $data) && $data['source_invoice_id'] !== null) {
            $object->setSourceInvoiceId($data['source_invoice_id']);
            unset($data['source_invoice_id']);
        }
        elseif (\array_key_exists('source_invoice_id', $data) && $data['source_invoice_id'] === null) {
            $object->setSourceInvoiceId(null);
            unset($data['source_invoice_id']);
        }
        if (\array_key_exists('created_at', $data)) {
            $date_4 = \DateTime::createFromFormat('Y-m-d\TH:i:sP', $data['created_at']);
            if (false === $date_4) {
                throw new \Lenorix\BeelSdk\Generated\Runtime\Normalizer\InvalidDateException($data['created_at'], 'Y-m-d\TH:i:sP');
            }
            $object->setCreatedAt($date_4);
            unset($data['created_at']);
        }
        if (\array_key_exists('updated_at', $data)) {
            $date_5 = \DateTime::createFromFormat('Y-m-d\TH:i:sP', $data['updated_at']);
            if (false === $date_5) {
                throw new \Lenorix\BeelSdk\Generated\Runtime\Normalizer\InvalidDateException($data['updated_at'], 'Y-m-d\TH:i:sP');
            }
            $object->setUpdatedAt($date_5);
            unset($data['updated_at']);
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
        if ($data->isInitialized('id') && null !== $data->getId()) {
            $dataArray['id'] = $data->getId();
        }
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
        if ($data->isInitialized('endDate') && null !== $data->getEndDate()) {
            $dataArray['end_date'] = $data->getEndDate()?->format('Y-m-d');
        }
        if ($data->isInitialized('nextGeneration') && null !== $data->getNextGeneration()) {
            $dataArray['next_generation'] = $data->getNextGeneration()?->format('Y-m-d');
        }
        if ($data->isInitialized('draftInAdvance') && null !== $data->getDraftInAdvance()) {
            $dataArray['draft_in_advance'] = $data->getDraftInAdvance();
        }
        if ($data->isInitialized('status') && null !== $data->getStatus()) {
            $dataArray['status'] = $data->getStatus();
        }
        if ($data->isInitialized('pause') && null !== $data->getPause()) {
            $dataArray['pause'] = $data->getPause() === null ? null : new \Lenorix\BeelSdk\Generated\Runtime\JsonObject($this->normalizer->normalize($data->getPause(), 'json', $context));
        }
        if ($data->isInitialized('completion') && null !== $data->getCompletion()) {
            $dataArray['completion'] = $data->getCompletion() === null ? null : new \Lenorix\BeelSdk\Generated\Runtime\JsonObject($this->normalizer->normalize($data->getCompletion(), 'json', $context));
        }
        if ($data->isInitialized('seriesId') && null !== $data->getSeriesId()) {
            $dataArray['series_id'] = $data->getSeriesId();
        }
        if ($data->isInitialized('seriesCode') && null !== $data->getSeriesCode()) {
            $dataArray['series_code'] = $data->getSeriesCode();
        }
        if ($data->isInitialized('invoiceType') && null !== $data->getInvoiceType()) {
            $dataArray['invoice_type'] = $data->getInvoiceType();
        }
        if ($data->isInitialized('customerId') && null !== $data->getCustomerId()) {
            $dataArray['customer_id'] = $data->getCustomerId();
        }
        if ($data->isInitialized('recipientFiscalName') && null !== $data->getRecipientFiscalName()) {
            $dataArray['recipient_fiscal_name'] = $data->getRecipientFiscalName();
        }
        if ($data->isInitialized('recipientNif') && null !== $data->getRecipientNif()) {
            $dataArray['recipient_nif'] = $data->getRecipientNif();
        }
        if ($data->isInitialized('recipientAlternativeId') && null !== $data->getRecipientAlternativeId()) {
            $dataArray['recipient_alternative_id'] = $data->getRecipientAlternativeId() === null ? null : new \Lenorix\BeelSdk\Generated\Runtime\JsonObject($this->normalizer->normalize($data->getRecipientAlternativeId(), 'json', $context));
        }
        if ($data->isInitialized('lines') && null !== $data->getLines()) {
            $values = [];
            foreach ($data->getLines() as $value) {
                $values[] = $value === null ? null : new \Lenorix\BeelSdk\Generated\Runtime\JsonObject($this->normalizer->normalize($value, 'json', $context));
            }
            $dataArray['lines'] = $values;
        }
        if ($data->isInitialized('amount') && null !== $data->getAmount()) {
            $dataArray['amount'] = $data->getAmount();
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
        if ($data->isInitialized('generatedInvoices') && null !== $data->getGeneratedInvoices()) {
            $dataArray['generated_invoices'] = $data->getGeneratedInvoices();
        }
        if ($data->isInitialized('maxInvoices') && null !== $data->getMaxInvoices()) {
            $dataArray['max_invoices'] = $data->getMaxInvoices();
        }
        if ($data->isInitialized('lastGeneratedAt') && null !== $data->getLastGeneratedAt()) {
            $dataArray['last_generated_at'] = $data->getLastGeneratedAt()?->format('Y-m-d\TH:i:sP');
        }
        if ($data->isInitialized('sourceInvoiceId') && null !== $data->getSourceInvoiceId()) {
            $dataArray['source_invoice_id'] = $data->getSourceInvoiceId();
        }
        if ($data->isInitialized('createdAt') && null !== $data->getCreatedAt()) {
            $dataArray['created_at'] = $data->getCreatedAt()->format('Y-m-d\TH:i:sP');
        }
        if ($data->isInitialized('updatedAt') && null !== $data->getUpdatedAt()) {
            $dataArray['updated_at'] = $data->getUpdatedAt()->format('Y-m-d\TH:i:sP');
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
        return [\Lenorix\BeelSdk\Generated\Model\RecurringInvoiceResponse::class => false];
    }
}