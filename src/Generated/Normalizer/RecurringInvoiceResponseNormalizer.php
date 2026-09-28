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
        if (\array_key_exists('is_failing', $data) && \is_int($data['is_failing'])) {
            $data['is_failing'] = (bool) $data['is_failing'];
        }
        if (\array_key_exists('send_automatically', $data) && \is_int($data['send_automatically'])) {
            $data['send_automatically'] = (bool) $data['send_automatically'];
        }
        if (\array_key_exists('id', $data) && $data['id'] !== null) {
            $object->setId($data['id']);
            unset($data['id']);
        } elseif (\array_key_exists('id', $data) && $data['id'] === null) {
            $object->setId(null);
            unset($data['id']);
        }
        if (\array_key_exists('name', $data) && $data['name'] !== null) {
            $object->setName($data['name']);
            unset($data['name']);
        } elseif (\array_key_exists('name', $data) && $data['name'] === null) {
            $object->setName(null);
            unset($data['name']);
        }
        if (\array_key_exists('frequency', $data) && $data['frequency'] !== null) {
            $object->setFrequency($data['frequency']);
            unset($data['frequency']);
        } elseif (\array_key_exists('frequency', $data) && $data['frequency'] === null) {
            $object->setFrequency(null);
            unset($data['frequency']);
        }
        if (\array_key_exists('day_of_month', $data) && $data['day_of_month'] !== null) {
            $object->setDayOfMonth($data['day_of_month']);
            unset($data['day_of_month']);
        } elseif (\array_key_exists('day_of_month', $data) && $data['day_of_month'] === null) {
            $object->setDayOfMonth(null);
            unset($data['day_of_month']);
        }
        if (\array_key_exists('start_date', $data) && $data['start_date'] !== null) {
            $date = \DateTime::createFromFormat('Y-m-d', $data['start_date']);
            if ($date === false) {
                throw new InvalidDateException($data['start_date'], 'Y-m-d');
            }
            $object->setStartDate($date->setTime(0, 0, 0));
            unset($data['start_date']);
        } elseif (\array_key_exists('start_date', $data) && $data['start_date'] === null) {
            $object->setStartDate(null);
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
        if (\array_key_exists('draft_in_advance', $data) && $data['draft_in_advance'] !== null) {
            $object->setDraftInAdvance($data['draft_in_advance']);
            unset($data['draft_in_advance']);
        } elseif (\array_key_exists('draft_in_advance', $data) && $data['draft_in_advance'] === null) {
            $object->setDraftInAdvance(null);
            unset($data['draft_in_advance']);
        }
        if (\array_key_exists('status', $data) && $data['status'] !== null) {
            $object->setStatus($data['status']);
            unset($data['status']);
        } elseif (\array_key_exists('status', $data) && $data['status'] === null) {
            $object->setStatus(null);
            unset($data['status']);
        }
        if (\array_key_exists('is_failing', $data) && $data['is_failing'] !== null) {
            $object->setIsFailing($data['is_failing']);
            unset($data['is_failing']);
        } elseif (\array_key_exists('is_failing', $data) && $data['is_failing'] === null) {
            $object->setIsFailing(null);
            unset($data['is_failing']);
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
        if (\array_key_exists('series_id', $data) && $data['series_id'] !== null) {
            $object->setSeriesId($data['series_id']);
            unset($data['series_id']);
        } elseif (\array_key_exists('series_id', $data) && $data['series_id'] === null) {
            $object->setSeriesId(null);
            unset($data['series_id']);
        }
        if (\array_key_exists('series_code', $data) && $data['series_code'] !== null) {
            $object->setSeriesCode($data['series_code']);
            unset($data['series_code']);
        } elseif (\array_key_exists('series_code', $data) && $data['series_code'] === null) {
            $object->setSeriesCode(null);
            unset($data['series_code']);
        }
        if (\array_key_exists('invoice_type', $data) && $data['invoice_type'] !== null) {
            $object->setInvoiceType($data['invoice_type']);
            unset($data['invoice_type']);
        } elseif (\array_key_exists('invoice_type', $data) && $data['invoice_type'] === null) {
            $object->setInvoiceType(null);
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
        if (\array_key_exists('recipient_alternative_id', $data) && $data['recipient_alternative_id'] !== null) {
            $object->setRecipientAlternativeId($this->denormalizer->denormalize($data['recipient_alternative_id'], RecurringInvoiceResponseRecipientAlternativeId::class, 'json', $context));
            unset($data['recipient_alternative_id']);
        } elseif (\array_key_exists('recipient_alternative_id', $data) && $data['recipient_alternative_id'] === null) {
            $object->setRecipientAlternativeId(null);
            unset($data['recipient_alternative_id']);
        }
        if (\array_key_exists('lines', $data) && $data['lines'] !== null) {
            $values = [];
            foreach ($data['lines'] as $value) {
                $values[] = $this->denormalizer->denormalize($value, InvoiceLineTemplateResponse::class, 'json', $context);
            }
            $object->setLines($values);
            unset($data['lines']);
        } elseif (\array_key_exists('lines', $data) && $data['lines'] === null) {
            $object->setLines(null);
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
        if (\array_key_exists('send_automatically', $data) && $data['send_automatically'] !== null) {
            $object->setSendAutomatically($data['send_automatically']);
            unset($data['send_automatically']);
        } elseif (\array_key_exists('send_automatically', $data) && $data['send_automatically'] === null) {
            $object->setSendAutomatically(null);
            unset($data['send_automatically']);
        }
        if (\array_key_exists('email_configuration', $data) && $data['email_configuration'] !== null) {
            $object->setEmailConfiguration($this->denormalizer->denormalize($data['email_configuration'], RecurringEmailConfigResponse::class, 'json', $context));
            unset($data['email_configuration']);
        } elseif (\array_key_exists('email_configuration', $data) && $data['email_configuration'] === null) {
            $object->setEmailConfiguration(null);
            unset($data['email_configuration']);
        }
        if (\array_key_exists('generated_invoices', $data) && $data['generated_invoices'] !== null) {
            $object->setGeneratedInvoices($data['generated_invoices']);
            unset($data['generated_invoices']);
        } elseif (\array_key_exists('generated_invoices', $data) && $data['generated_invoices'] === null) {
            $object->setGeneratedInvoices(null);
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
            $object->setLastGeneratedAt($this->denormalizer->denormalize($data['last_generated_at'], \DateTime::class, 'json', $context));
            unset($data['last_generated_at']);
        } elseif (\array_key_exists('last_generated_at', $data) && $data['last_generated_at'] === null) {
            $object->setLastGeneratedAt(null);
            unset($data['last_generated_at']);
        }
        if (\array_key_exists('last_generated_scheduled_date', $data) && $data['last_generated_scheduled_date'] !== null) {
            $date_3 = \DateTime::createFromFormat('Y-m-d', $data['last_generated_scheduled_date']);
            if ($date_3 === false) {
                throw new InvalidDateException($data['last_generated_scheduled_date'], 'Y-m-d');
            }
            $object->setLastGeneratedScheduledDate($date_3->setTime(0, 0, 0));
            unset($data['last_generated_scheduled_date']);
        } elseif (\array_key_exists('last_generated_scheduled_date', $data) && $data['last_generated_scheduled_date'] === null) {
            $object->setLastGeneratedScheduledDate(null);
            unset($data['last_generated_scheduled_date']);
        }
        if (\array_key_exists('source_invoice_id', $data) && $data['source_invoice_id'] !== null) {
            $object->setSourceInvoiceId($data['source_invoice_id']);
            unset($data['source_invoice_id']);
        } elseif (\array_key_exists('source_invoice_id', $data) && $data['source_invoice_id'] === null) {
            $object->setSourceInvoiceId(null);
            unset($data['source_invoice_id']);
        }
        if (\array_key_exists('created_at', $data) && $data['created_at'] !== null) {
            $object->setCreatedAt($this->denormalizer->denormalize($data['created_at'], \DateTime::class, 'json', $context));
            unset($data['created_at']);
        } elseif (\array_key_exists('created_at', $data) && $data['created_at'] === null) {
            $object->setCreatedAt(null);
            unset($data['created_at']);
        }
        if (\array_key_exists('updated_at', $data) && $data['updated_at'] !== null) {
            $object->setUpdatedAt($this->denormalizer->denormalize($data['updated_at'], \DateTime::class, 'json', $context));
            unset($data['updated_at']);
        } elseif (\array_key_exists('updated_at', $data) && $data['updated_at'] === null) {
            $object->setUpdatedAt(null);
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
            $dataArray['start_date'] = $data->getStartDate()?->format('Y-m-d');
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
        if ($data->isInitialized('isFailing') && $data->getIsFailing() !== null) {
            $dataArray['is_failing'] = $data->getIsFailing();
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
            $dataArray['last_generated_at'] = $this->normalizer->normalize($data->getLastGeneratedAt(), 'json', $context);
        }
        if ($data->isInitialized('lastGeneratedScheduledDate') && $data->getLastGeneratedScheduledDate() !== null) {
            $dataArray['last_generated_scheduled_date'] = $data->getLastGeneratedScheduledDate()?->format('Y-m-d');
        }
        if ($data->isInitialized('sourceInvoiceId') && $data->getSourceInvoiceId() !== null) {
            $dataArray['source_invoice_id'] = $data->getSourceInvoiceId();
        }
        if ($data->isInitialized('createdAt') && $data->getCreatedAt() !== null) {
            $dataArray['created_at'] = $this->normalizer->normalize($data->getCreatedAt(), 'json', $context);
        }
        if ($data->isInitialized('updatedAt') && $data->getUpdatedAt() !== null) {
            $dataArray['updated_at'] = $this->normalizer->normalize($data->getUpdatedAt(), 'json', $context);
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
