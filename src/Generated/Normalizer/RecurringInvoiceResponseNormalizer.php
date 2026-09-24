<?php

namespace Lenorix\BeelSdk\Generated\Normalizer;

use Jane\Component\JsonSchemaRuntime\Reference;
use Lenorix\BeelSdk\Generated\Model\InvoiceLineTemplateResponse;
use Lenorix\BeelSdk\Generated\Model\RecurringEmailConfigResponse;
use Lenorix\BeelSdk\Generated\Model\RecurringInvoiceCompletion;
use Lenorix\BeelSdk\Generated\Model\RecurringInvoicePause;
use Lenorix\BeelSdk\Generated\Model\RecurringInvoiceResponse;
use Lenorix\BeelSdk\Generated\Model\RecurringInvoiceResponseRecipientAlternativeId;
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

class RecurringInvoiceResponseNormalizer implements DenormalizerAwareInterface, DenormalizerInterface, NormalizerAwareInterface, NormalizerInterface
{
    use CheckArray;
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use ValidatorTrait;

    public function supportsDenormalization(mixed $data, string $type, ?string $format = null, array $context = []): bool
    {
        return $type === RecurringInvoiceResponse::class;
    }

    public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
    {
        return is_object($data) && get_class($data) === RecurringInvoiceResponse::class;
    }

    public function denormalize(mixed $data, string $type, ?string $format = null, array $context = []): mixed
    {
        $object = new RecurringInvoiceResponse;
        if ($data === null || \is_array($data) === false) {
            return $object;
        }
        if (isset($data['$ref']) && ! isset($data['type']) && ! isset($data['properties']) && ! isset($data['allOf'])) {
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
        if (\array_key_exists('next_generation', $data) && $data['next_generation'] !== null) {
            $date_2 = \DateTime::createFromFormat('Y-m-d', $data['next_generation']);
            if ($date_2 === false) {
                throw new InvalidDateException($data['next_generation'], 'Y-m-d');
            }
            $object->setNextGeneration($date_2->setTime(0, 0, 0));
            unset($data['next_generation']);
        } elseif (\array_key_exists('next_generation', $data) && $data['next_generation'] === null) {
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
            $object->setPause($this->denormalizer->denormalize($data['pause'], RecurringInvoicePause::class, 'json', $context));
            unset($data['pause']);
        } elseif (\array_key_exists('pause', $data) && $data['pause'] === null) {
            $object->setPause(null);
            unset($data['pause']);
        }
        if (\array_key_exists('completion', $data) && $data['completion'] !== null) {
            $object->setCompletion($this->denormalizer->denormalize($data['completion'], RecurringInvoiceCompletion::class, 'json', $context));
            unset($data['completion']);
        } elseif (\array_key_exists('completion', $data) && $data['completion'] === null) {
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
        } elseif (\array_key_exists('customer_id', $data) && $data['customer_id'] === null) {
            $object->setCustomerId(null);
            unset($data['customer_id']);
        }
        if (\array_key_exists('recipient_fiscal_name', $data) && $data['recipient_fiscal_name'] !== null) {
            $object->setRecipientFiscalName($data['recipient_fiscal_name']);
            unset($data['recipient_fiscal_name']);
        } elseif (\array_key_exists('recipient_fiscal_name', $data) && $data['recipient_fiscal_name'] === null) {
            $object->setRecipientFiscalName(null);
            unset($data['recipient_fiscal_name']);
        }
        if (\array_key_exists('recipient_nif', $data) && $data['recipient_nif'] !== null) {
            $object->setRecipientNif($data['recipient_nif']);
            unset($data['recipient_nif']);
        } elseif (\array_key_exists('recipient_nif', $data) && $data['recipient_nif'] === null) {
            $object->setRecipientNif(null);
            unset($data['recipient_nif']);
        }
        if (\array_key_exists('recipient_alternative_id', $data)) {
            $object->setRecipientAlternativeId($this->denormalizer->denormalize($data['recipient_alternative_id'], RecurringInvoiceResponseRecipientAlternativeId::class, 'json', $context));
            unset($data['recipient_alternative_id']);
        }
        if (\array_key_exists('lines', $data)) {
            $values = [];
            foreach ($data['lines'] as $value) {
                $values[] = $this->denormalizer->denormalize($value, InvoiceLineTemplateResponse::class, 'json', $context);
            }
            $object->setLines($values);
            unset($data['lines']);
        }
        if (\array_key_exists('amount', $data) && $data['amount'] !== null) {
            $object->setAmount($data['amount']);
            unset($data['amount']);
        } elseif (\array_key_exists('amount', $data) && $data['amount'] === null) {
            $object->setAmount(null);
            unset($data['amount']);
        }
        if (\array_key_exists('payment_method', $data) && $data['payment_method'] !== null) {
            $object->setPaymentMethod($data['payment_method']);
            unset($data['payment_method']);
        } elseif (\array_key_exists('payment_method', $data) && $data['payment_method'] === null) {
            $object->setPaymentMethod(null);
            unset($data['payment_method']);
        }
        if (\array_key_exists('payment_iban', $data) && $data['payment_iban'] !== null) {
            $object->setPaymentIban($data['payment_iban']);
            unset($data['payment_iban']);
        } elseif (\array_key_exists('payment_iban', $data) && $data['payment_iban'] === null) {
            $object->setPaymentIban(null);
            unset($data['payment_iban']);
        }
        if (\array_key_exists('payment_swift', $data) && $data['payment_swift'] !== null) {
            $object->setPaymentSwift($data['payment_swift']);
            unset($data['payment_swift']);
        } elseif (\array_key_exists('payment_swift', $data) && $data['payment_swift'] === null) {
            $object->setPaymentSwift(null);
            unset($data['payment_swift']);
        }
        if (\array_key_exists('payment_term_days', $data) && $data['payment_term_days'] !== null) {
            $object->setPaymentTermDays($data['payment_term_days']);
            unset($data['payment_term_days']);
        } elseif (\array_key_exists('payment_term_days', $data) && $data['payment_term_days'] === null) {
            $object->setPaymentTermDays(null);
            unset($data['payment_term_days']);
        }
        if (\array_key_exists('notes', $data) && $data['notes'] !== null) {
            $object->setNotes($data['notes']);
            unset($data['notes']);
        } elseif (\array_key_exists('notes', $data) && $data['notes'] === null) {
            $object->setNotes(null);
            unset($data['notes']);
        }
        if (\array_key_exists('send_automatically', $data)) {
            $object->setSendAutomatically($data['send_automatically']);
            unset($data['send_automatically']);
        }
        if (\array_key_exists('email_configuration', $data) && $data['email_configuration'] !== null) {
            $object->setEmailConfiguration($this->denormalizer->denormalize($data['email_configuration'], RecurringEmailConfigResponse::class, 'json', $context));
            unset($data['email_configuration']);
        } elseif (\array_key_exists('email_configuration', $data) && $data['email_configuration'] === null) {
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
        } elseif (\array_key_exists('max_invoices', $data) && $data['max_invoices'] === null) {
            $object->setMaxInvoices(null);
            unset($data['max_invoices']);
        }
        if (\array_key_exists('last_generated_at', $data) && $data['last_generated_at'] !== null) {
            $date_3 = \DateTime::createFromFormat('Y-m-d\TH:i:sP', $data['last_generated_at']);
            if ($date_3 === false) {
                throw new InvalidDateException($data['last_generated_at'], 'Y-m-d\TH:i:sP');
            }
            $object->setLastGeneratedAt($date_3);
            unset($data['last_generated_at']);
        } elseif (\array_key_exists('last_generated_at', $data) && $data['last_generated_at'] === null) {
            $object->setLastGeneratedAt(null);
            unset($data['last_generated_at']);
        }
        if (\array_key_exists('source_invoice_id', $data) && $data['source_invoice_id'] !== null) {
            $object->setSourceInvoiceId($data['source_invoice_id']);
            unset($data['source_invoice_id']);
        } elseif (\array_key_exists('source_invoice_id', $data) && $data['source_invoice_id'] === null) {
            $object->setSourceInvoiceId(null);
            unset($data['source_invoice_id']);
        }
        if (\array_key_exists('created_at', $data)) {
            $date_4 = \DateTime::createFromFormat('Y-m-d\TH:i:sP', $data['created_at']);
            if ($date_4 === false) {
                throw new InvalidDateException($data['created_at'], 'Y-m-d\TH:i:sP');
            }
            $object->setCreatedAt($date_4);
            unset($data['created_at']);
        }
        if (\array_key_exists('updated_at', $data)) {
            $date_5 = \DateTime::createFromFormat('Y-m-d\TH:i:sP', $data['updated_at']);
            if ($date_5 === false) {
                throw new InvalidDateException($data['updated_at'], 'Y-m-d\TH:i:sP');
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
        if ($data->isInitialized('id') && $data->getId() !== null) {
            $dataArray['id'] = $data->getId();
        }
        if ($data->isInitialized('name') && $data->getName() !== null) {
            $dataArray['name'] = $data->getName();
        }
        if ($data->isInitialized('frequency') && $data->getFrequency() !== null) {
            $dataArray['frequency'] = $data->getFrequency();
        }
        if ($data->isInitialized('dayOfMonth') && $data->getDayOfMonth() !== null) {
            $dataArray['day_of_month'] = $data->getDayOfMonth();
        }
        if ($data->isInitialized('startDate') && $data->getStartDate() !== null) {
            $dataArray['start_date'] = $data->getStartDate()->format('Y-m-d');
        }
        if ($data->isInitialized('endDate') && $data->getEndDate() !== null) {
            $dataArray['end_date'] = $data->getEndDate()?->format('Y-m-d');
        }
        if ($data->isInitialized('nextGeneration') && $data->getNextGeneration() !== null) {
            $dataArray['next_generation'] = $data->getNextGeneration()?->format('Y-m-d');
        }
        if ($data->isInitialized('draftInAdvance') && $data->getDraftInAdvance() !== null) {
            $dataArray['draft_in_advance'] = $data->getDraftInAdvance();
        }
        if ($data->isInitialized('status') && $data->getStatus() !== null) {
            $dataArray['status'] = $data->getStatus();
        }
        if ($data->isInitialized('pause') && $data->getPause() !== null) {
            $dataArray['pause'] = $data->getPause() === null ? null : new JsonObject($this->normalizer->normalize($data->getPause(), 'json', $context));
        }
        if ($data->isInitialized('completion') && $data->getCompletion() !== null) {
            $dataArray['completion'] = $data->getCompletion() === null ? null : new JsonObject($this->normalizer->normalize($data->getCompletion(), 'json', $context));
        }
        if ($data->isInitialized('seriesId') && $data->getSeriesId() !== null) {
            $dataArray['series_id'] = $data->getSeriesId();
        }
        if ($data->isInitialized('seriesCode') && $data->getSeriesCode() !== null) {
            $dataArray['series_code'] = $data->getSeriesCode();
        }
        if ($data->isInitialized('invoiceType') && $data->getInvoiceType() !== null) {
            $dataArray['invoice_type'] = $data->getInvoiceType();
        }
        if ($data->isInitialized('customerId') && $data->getCustomerId() !== null) {
            $dataArray['customer_id'] = $data->getCustomerId();
        }
        if ($data->isInitialized('recipientFiscalName') && $data->getRecipientFiscalName() !== null) {
            $dataArray['recipient_fiscal_name'] = $data->getRecipientFiscalName();
        }
        if ($data->isInitialized('recipientNif') && $data->getRecipientNif() !== null) {
            $dataArray['recipient_nif'] = $data->getRecipientNif();
        }
        if ($data->isInitialized('recipientAlternativeId') && $data->getRecipientAlternativeId() !== null) {
            $dataArray['recipient_alternative_id'] = $data->getRecipientAlternativeId() === null ? null : new JsonObject($this->normalizer->normalize($data->getRecipientAlternativeId(), 'json', $context));
        }
        if ($data->isInitialized('lines') && $data->getLines() !== null) {
            $values = [];
            foreach ($data->getLines() as $value) {
                $values[] = $value === null ? null : new JsonObject($this->normalizer->normalize($value, 'json', $context));
            }
            $dataArray['lines'] = $values;
        }
        if ($data->isInitialized('amount') && $data->getAmount() !== null) {
            $dataArray['amount'] = $data->getAmount();
        }
        if ($data->isInitialized('paymentMethod') && $data->getPaymentMethod() !== null) {
            $dataArray['payment_method'] = $data->getPaymentMethod();
        }
        if ($data->isInitialized('paymentIban') && $data->getPaymentIban() !== null) {
            $dataArray['payment_iban'] = $data->getPaymentIban();
        }
        if ($data->isInitialized('paymentSwift') && $data->getPaymentSwift() !== null) {
            $dataArray['payment_swift'] = $data->getPaymentSwift();
        }
        if ($data->isInitialized('paymentTermDays') && $data->getPaymentTermDays() !== null) {
            $dataArray['payment_term_days'] = $data->getPaymentTermDays();
        }
        if ($data->isInitialized('notes') && $data->getNotes() !== null) {
            $dataArray['notes'] = $data->getNotes();
        }
        if ($data->isInitialized('sendAutomatically') && $data->getSendAutomatically() !== null) {
            $dataArray['send_automatically'] = $data->getSendAutomatically();
        }
        if ($data->isInitialized('emailConfiguration') && $data->getEmailConfiguration() !== null) {
            $dataArray['email_configuration'] = $data->getEmailConfiguration() === null ? null : new JsonObject($this->normalizer->normalize($data->getEmailConfiguration(), 'json', $context));
        }
        if ($data->isInitialized('generatedInvoices') && $data->getGeneratedInvoices() !== null) {
            $dataArray['generated_invoices'] = $data->getGeneratedInvoices();
        }
        if ($data->isInitialized('maxInvoices') && $data->getMaxInvoices() !== null) {
            $dataArray['max_invoices'] = $data->getMaxInvoices();
        }
        if ($data->isInitialized('lastGeneratedAt') && $data->getLastGeneratedAt() !== null) {
            $dataArray['last_generated_at'] = $data->getLastGeneratedAt()?->format('Y-m-d\TH:i:sP');
        }
        if ($data->isInitialized('sourceInvoiceId') && $data->getSourceInvoiceId() !== null) {
            $dataArray['source_invoice_id'] = $data->getSourceInvoiceId();
        }
        if ($data->isInitialized('createdAt') && $data->getCreatedAt() !== null) {
            $dataArray['created_at'] = $data->getCreatedAt()->format('Y-m-d\TH:i:sP');
        }
        if ($data->isInitialized('updatedAt') && $data->getUpdatedAt() !== null) {
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
        return [RecurringInvoiceResponse::class => false];
    }
}
