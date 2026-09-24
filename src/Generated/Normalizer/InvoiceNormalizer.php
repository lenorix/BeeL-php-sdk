<?php

namespace Lenorix\BeelSdk\Generated\Normalizer;

use Jane\Component\JsonSchemaRuntime\Reference;
use Lenorix\BeelSdk\Generated\Model\Invoice;
use Lenorix\BeelSdk\Generated\Model\InvoiceAttachment;
use Lenorix\BeelSdk\Generated\Model\InvoiceBaseEmailConfig;
use Lenorix\BeelSdk\Generated\Model\InvoiceEmailDeliveryOutcome;
use Lenorix\BeelSdk\Generated\Model\InvoiceLine;
use Lenorix\BeelSdk\Generated\Model\InvoiceSendRecord;
use Lenorix\BeelSdk\Generated\Model\InvoiceTotals;
use Lenorix\BeelSdk\Generated\Model\IssuerData;
use Lenorix\BeelSdk\Generated\Model\PaymentInfo;
use Lenorix\BeelSdk\Generated\Model\RecipientData;
use Lenorix\BeelSdk\Generated\Model\SeriesInfo;
use Lenorix\BeelSdk\Generated\Model\VeriFactu;
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

class InvoiceNormalizer implements DenormalizerAwareInterface, DenormalizerInterface, NormalizerAwareInterface, NormalizerInterface
{
    use CheckArray;
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use ValidatorTrait;

    public function supportsDenormalization(mixed $data, string $type, ?string $format = null, array $context = []): bool
    {
        return $type === Invoice::class;
    }

    public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
    {
        return is_object($data) && get_class($data) === Invoice::class;
    }

    public function denormalize(mixed $data, string $type, ?string $format = null, array $context = []): mixed
    {
        $object = new Invoice;
        if ($data === null || \is_array($data) === false) {
            return $object;
        }
        if (isset($data['$ref']) && ! isset($data['type']) && ! isset($data['properties']) && ! isset($data['allOf'])) {
            return new Reference($data['$ref'], $context['document-origin']);
        }
        if (isset($data['$recursiveRef'])) {
            return new Reference($data['$recursiveRef'], $context['document-origin']);
        }
        if (\array_key_exists('send_automatically', $data) && \is_int($data['send_automatically'])) {
            $data['send_automatically'] = (bool) $data['send_automatically'];
        }
        if (\array_key_exists('invoice_number', $data) && $data['invoice_number'] !== null) {
            $object->setInvoiceNumber($data['invoice_number']);
            unset($data['invoice_number']);
        } elseif (\array_key_exists('invoice_number', $data) && $data['invoice_number'] === null) {
            $object->setInvoiceNumber(null);
            unset($data['invoice_number']);
        }
        if (\array_key_exists('series', $data)) {
            $object->setSeries($this->denormalizer->denormalize($data['series'], SeriesInfo::class, 'json', $context));
            unset($data['series']);
        }
        if (\array_key_exists('number', $data) && $data['number'] !== null) {
            $object->setNumber($data['number']);
            unset($data['number']);
        } elseif (\array_key_exists('number', $data) && $data['number'] === null) {
            $object->setNumber(null);
            unset($data['number']);
        }
        if (\array_key_exists('type', $data)) {
            $object->setType($data['type']);
            unset($data['type']);
        }
        if (\array_key_exists('status', $data)) {
            $object->setStatus($data['status']);
            unset($data['status']);
        }
        if (\array_key_exists('issue_date', $data)) {
            $date = \DateTime::createFromFormat('Y-m-d', $data['issue_date']);
            if ($date === false) {
                throw new InvalidDateException($data['issue_date'], 'Y-m-d');
            }
            $object->setIssueDate($date->setTime(0, 0, 0));
            unset($data['issue_date']);
        }
        if (\array_key_exists('operation_date', $data) && $data['operation_date'] !== null) {
            $date_1 = \DateTime::createFromFormat('Y-m-d', $data['operation_date']);
            if ($date_1 === false) {
                throw new InvalidDateException($data['operation_date'], 'Y-m-d');
            }
            $object->setOperationDate($date_1->setTime(0, 0, 0));
            unset($data['operation_date']);
        } elseif (\array_key_exists('operation_date', $data) && $data['operation_date'] === null) {
            $object->setOperationDate(null);
            unset($data['operation_date']);
        }
        if (\array_key_exists('due_date', $data)) {
            $date_2 = \DateTime::createFromFormat('Y-m-d', $data['due_date']);
            if ($date_2 === false) {
                throw new InvalidDateException($data['due_date'], 'Y-m-d');
            }
            $object->setDueDate($date_2->setTime(0, 0, 0));
            unset($data['due_date']);
        }
        if (\array_key_exists('valid_until', $data) && $data['valid_until'] !== null) {
            $date_3 = \DateTime::createFromFormat('Y-m-d', $data['valid_until']);
            if ($date_3 === false) {
                throw new InvalidDateException($data['valid_until'], 'Y-m-d');
            }
            $object->setValidUntil($date_3->setTime(0, 0, 0));
            unset($data['valid_until']);
        } elseif (\array_key_exists('valid_until', $data) && $data['valid_until'] === null) {
            $object->setValidUntil(null);
            unset($data['valid_until']);
        }
        if (\array_key_exists('payment_date', $data)) {
            $date_4 = \DateTime::createFromFormat('Y-m-d', $data['payment_date']);
            if ($date_4 === false) {
                throw new InvalidDateException($data['payment_date'], 'Y-m-d');
            }
            $object->setPaymentDate($date_4->setTime(0, 0, 0));
            unset($data['payment_date']);
        }
        if (\array_key_exists('sent_at', $data) && $data['sent_at'] !== null) {
            $date_5 = \DateTime::createFromFormat('Y-m-d\TH:i:sP', $data['sent_at']);
            if ($date_5 === false) {
                throw new InvalidDateException($data['sent_at'], 'Y-m-d\TH:i:sP');
            }
            $object->setSentAt($date_5);
            unset($data['sent_at']);
        } elseif (\array_key_exists('sent_at', $data) && $data['sent_at'] === null) {
            $object->setSentAt(null);
            unset($data['sent_at']);
        }
        if (\array_key_exists('paid_at', $data) && $data['paid_at'] !== null) {
            $date_6 = \DateTime::createFromFormat('Y-m-d\TH:i:sP', $data['paid_at']);
            if ($date_6 === false) {
                throw new InvalidDateException($data['paid_at'], 'Y-m-d\TH:i:sP');
            }
            $object->setPaidAt($date_6);
            unset($data['paid_at']);
        } elseif (\array_key_exists('paid_at', $data) && $data['paid_at'] === null) {
            $object->setPaidAt(null);
            unset($data['paid_at']);
        }
        if (\array_key_exists('auto_emit_after', $data) && $data['auto_emit_after'] !== null) {
            $date_7 = \DateTime::createFromFormat('Y-m-d', $data['auto_emit_after']);
            if ($date_7 === false) {
                throw new InvalidDateException($data['auto_emit_after'], 'Y-m-d');
            }
            $object->setAutoEmitAfter($date_7->setTime(0, 0, 0));
            unset($data['auto_emit_after']);
        } elseif (\array_key_exists('auto_emit_after', $data) && $data['auto_emit_after'] === null) {
            $object->setAutoEmitAfter(null);
            unset($data['auto_emit_after']);
        }
        if (\array_key_exists('scheduled_for', $data) && $data['scheduled_for'] !== null) {
            $date_8 = \DateTime::createFromFormat('Y-m-d', $data['scheduled_for']);
            if ($date_8 === false) {
                throw new InvalidDateException($data['scheduled_for'], 'Y-m-d');
            }
            $object->setScheduledFor($date_8->setTime(0, 0, 0));
            unset($data['scheduled_for']);
        } elseif (\array_key_exists('scheduled_for', $data) && $data['scheduled_for'] === null) {
            $object->setScheduledFor(null);
            unset($data['scheduled_for']);
        }
        if (\array_key_exists('scheduled_action', $data)) {
            $object->setScheduledAction($data['scheduled_action']);
            unset($data['scheduled_action']);
        }
        if (\array_key_exists('issuer', $data)) {
            $object->setIssuer($this->denormalizer->denormalize($data['issuer'], IssuerData::class, 'json', $context));
            unset($data['issuer']);
        }
        if (\array_key_exists('recipient', $data)) {
            $object->setRecipient($this->denormalizer->denormalize($data['recipient'], RecipientData::class, 'json', $context));
            unset($data['recipient']);
        }
        if (\array_key_exists('lines', $data)) {
            $values = [];
            foreach ($data['lines'] as $value) {
                $values[] = $this->denormalizer->denormalize($value, InvoiceLine::class, 'json', $context);
            }
            $object->setLines($values);
            unset($data['lines']);
        }
        if (\array_key_exists('totals', $data)) {
            $object->setTotals($this->denormalizer->denormalize($data['totals'], InvoiceTotals::class, 'json', $context));
            unset($data['totals']);
        }
        if (\array_key_exists('payment_info', $data)) {
            $object->setPaymentInfo($this->denormalizer->denormalize($data['payment_info'], PaymentInfo::class, 'json', $context));
            unset($data['payment_info']);
        }
        if (\array_key_exists('notes', $data)) {
            $object->setNotes($data['notes']);
            unset($data['notes']);
        }
        if (\array_key_exists('void_cause', $data)) {
            $object->setVoidCause($data['void_cause']);
            unset($data['void_cause']);
        }
        if (\array_key_exists('void_reason', $data)) {
            $object->setVoidReason($data['void_reason']);
            unset($data['void_reason']);
        }
        if (\array_key_exists('voided_at', $data) && $data['voided_at'] !== null) {
            $date_9 = \DateTime::createFromFormat('Y-m-d\TH:i:sP', $data['voided_at']);
            if ($date_9 === false) {
                throw new InvalidDateException($data['voided_at'], 'Y-m-d\TH:i:sP');
            }
            $object->setVoidedAt($date_9);
            unset($data['voided_at']);
        } elseif (\array_key_exists('voided_at', $data) && $data['voided_at'] === null) {
            $object->setVoidedAt(null);
            unset($data['voided_at']);
        }
        if (\array_key_exists('rectified_invoice_id', $data)) {
            $object->setRectifiedInvoiceId($data['rectified_invoice_id']);
            unset($data['rectified_invoice_id']);
        }
        if (\array_key_exists('source_proforma_id', $data)) {
            $object->setSourceProformaId($data['source_proforma_id']);
            unset($data['source_proforma_id']);
        }
        if (\array_key_exists('converted_invoice_id', $data)) {
            $object->setConvertedInvoiceId($data['converted_invoice_id']);
            unset($data['converted_invoice_id']);
        }
        if (\array_key_exists('rectification_reason', $data)) {
            $object->setRectificationReason($data['rectification_reason']);
            unset($data['rectification_reason']);
        }
        if (\array_key_exists('recurring_invoice_id', $data) && $data['recurring_invoice_id'] !== null) {
            $object->setRecurringInvoiceId($data['recurring_invoice_id']);
            unset($data['recurring_invoice_id']);
        } elseif (\array_key_exists('recurring_invoice_id', $data) && $data['recurring_invoice_id'] === null) {
            $object->setRecurringInvoiceId(null);
            unset($data['recurring_invoice_id']);
        }
        if (\array_key_exists('recurring_invoice_name', $data) && $data['recurring_invoice_name'] !== null) {
            $object->setRecurringInvoiceName($data['recurring_invoice_name']);
            unset($data['recurring_invoice_name']);
        } elseif (\array_key_exists('recurring_invoice_name', $data) && $data['recurring_invoice_name'] === null) {
            $object->setRecurringInvoiceName(null);
            unset($data['recurring_invoice_name']);
        }
        if (\array_key_exists('rectification_type', $data)) {
            $object->setRectificationType($data['rectification_type']);
            unset($data['rectification_type']);
        }
        if (\array_key_exists('rectification_code', $data)) {
            $object->setRectificationCode($data['rectification_code']);
            unset($data['rectification_code']);
        }
        if (\array_key_exists('external_ref', $data) && $data['external_ref'] !== null) {
            $object->setExternalRef($data['external_ref']);
            unset($data['external_ref']);
        } elseif (\array_key_exists('external_ref', $data) && $data['external_ref'] === null) {
            $object->setExternalRef(null);
            unset($data['external_ref']);
        }
        if (\array_key_exists('metadata', $data)) {
            $values_1 = new JsonObject;
            foreach ($data['metadata'] as $key => $value_1) {
                $values_1[$key] = $value_1;
            }
            $object->setMetadata($values_1);
            unset($data['metadata']);
        }
        if (\array_key_exists('send_automatically', $data) && $data['send_automatically'] !== null) {
            $object->setSendAutomatically($data['send_automatically']);
            unset($data['send_automatically']);
        } elseif (\array_key_exists('send_automatically', $data) && $data['send_automatically'] === null) {
            $object->setSendAutomatically(null);
            unset($data['send_automatically']);
        }
        if (\array_key_exists('email_config', $data) && $data['email_config'] !== null) {
            $object->setEmailConfig($this->denormalizer->denormalize($data['email_config'], InvoiceBaseEmailConfig::class, 'json', $context));
            unset($data['email_config']);
        } elseif (\array_key_exists('email_config', $data) && $data['email_config'] === null) {
            $object->setEmailConfig(null);
            unset($data['email_config']);
        }
        if (\array_key_exists('pdf_download_url', $data) && $data['pdf_download_url'] !== null) {
            $object->setPdfDownloadUrl($data['pdf_download_url']);
            unset($data['pdf_download_url']);
        } elseif (\array_key_exists('pdf_download_url', $data) && $data['pdf_download_url'] === null) {
            $object->setPdfDownloadUrl(null);
            unset($data['pdf_download_url']);
        }
        if (\array_key_exists('verifactu', $data)) {
            $object->setVerifactu($this->denormalizer->denormalize($data['verifactu'], VeriFactu::class, 'json', $context));
            unset($data['verifactu']);
        }
        if (\array_key_exists('attachments', $data)) {
            $values_2 = [];
            foreach ($data['attachments'] as $value_2) {
                $values_2[] = $this->denormalizer->denormalize($value_2, InvoiceAttachment::class, 'json', $context);
            }
            $object->setAttachments($values_2);
            unset($data['attachments']);
        }
        if (\array_key_exists('sending_history', $data)) {
            $values_3 = [];
            foreach ($data['sending_history'] as $value_3) {
                $values_3[] = $this->denormalizer->denormalize($value_3, InvoiceSendRecord::class, 'json', $context);
            }
            $object->setSendingHistory($values_3);
            unset($data['sending_history']);
        }
        if (\array_key_exists('email_delivery', $data)) {
            $object->setEmailDelivery($this->denormalizer->denormalize($data['email_delivery'], InvoiceEmailDeliveryOutcome::class, 'json', $context));
            unset($data['email_delivery']);
        }
        if (\array_key_exists('deleted_at', $data) && $data['deleted_at'] !== null) {
            $date_10 = \DateTime::createFromFormat('Y-m-d\TH:i:sP', $data['deleted_at']);
            if ($date_10 === false) {
                throw new InvalidDateException($data['deleted_at'], 'Y-m-d\TH:i:sP');
            }
            $object->setDeletedAt($date_10);
            unset($data['deleted_at']);
        } elseif (\array_key_exists('deleted_at', $data) && $data['deleted_at'] === null) {
            $object->setDeletedAt(null);
            unset($data['deleted_at']);
        }
        if (\array_key_exists('id', $data)) {
            $object->setId($data['id']);
            unset($data['id']);
        }
        if (\array_key_exists('created_at', $data)) {
            $date_11 = \DateTime::createFromFormat('Y-m-d\TH:i:sP', $data['created_at']);
            if ($date_11 === false) {
                throw new InvalidDateException($data['created_at'], 'Y-m-d\TH:i:sP');
            }
            $object->setCreatedAt($date_11);
            unset($data['created_at']);
        }
        if (\array_key_exists('updated_at', $data)) {
            $date_12 = \DateTime::createFromFormat('Y-m-d\TH:i:sP', $data['updated_at']);
            if ($date_12 === false) {
                throw new InvalidDateException($data['updated_at'], 'Y-m-d\TH:i:sP');
            }
            $object->setUpdatedAt($date_12);
            unset($data['updated_at']);
        }
        foreach ($data as $key_1 => $value_4) {
            if (preg_match('/.*/', (string) $key_1)) {
                $object[$key_1] = $value_4;
            }
        }

        return $object;
    }

    public function normalize(mixed $data, ?string $format = null, array $context = []): array|string|int|float|bool|\ArrayObject|null
    {
        $dataArray = [];
        if ($data->isInitialized('invoiceNumber') && $data->getInvoiceNumber() !== null) {
            $dataArray['invoice_number'] = $data->getInvoiceNumber();
        }
        $dataArray['series'] = $data->getSeries() === null ? null : new JsonObject($this->normalizer->normalize($data->getSeries(), 'json', $context));
        if ($data->isInitialized('number') && $data->getNumber() !== null) {
            $dataArray['number'] = $data->getNumber();
        }
        $dataArray['type'] = $data->getType();
        $dataArray['status'] = $data->getStatus();
        $dataArray['issue_date'] = $data->getIssueDate()->format('Y-m-d');
        if ($data->isInitialized('operationDate') && $data->getOperationDate() !== null) {
            $dataArray['operation_date'] = $data->getOperationDate()?->format('Y-m-d');
        }
        if ($data->isInitialized('dueDate') && $data->getDueDate() !== null) {
            $dataArray['due_date'] = $data->getDueDate()->format('Y-m-d');
        }
        if ($data->isInitialized('validUntil') && $data->getValidUntil() !== null) {
            $dataArray['valid_until'] = $data->getValidUntil()?->format('Y-m-d');
        }
        if ($data->isInitialized('paymentDate') && $data->getPaymentDate() !== null) {
            $dataArray['payment_date'] = $data->getPaymentDate()->format('Y-m-d');
        }
        if ($data->isInitialized('sentAt') && $data->getSentAt() !== null) {
            $dataArray['sent_at'] = $data->getSentAt()?->format('Y-m-d\TH:i:sP');
        }
        if ($data->isInitialized('paidAt') && $data->getPaidAt() !== null) {
            $dataArray['paid_at'] = $data->getPaidAt()?->format('Y-m-d\TH:i:sP');
        }
        if ($data->isInitialized('autoEmitAfter') && $data->getAutoEmitAfter() !== null) {
            $dataArray['auto_emit_after'] = $data->getAutoEmitAfter()?->format('Y-m-d');
        }
        if ($data->isInitialized('scheduledFor') && $data->getScheduledFor() !== null) {
            $dataArray['scheduled_for'] = $data->getScheduledFor()?->format('Y-m-d');
        }
        if ($data->isInitialized('scheduledAction') && $data->getScheduledAction() !== null) {
            $dataArray['scheduled_action'] = $data->getScheduledAction();
        }
        $dataArray['issuer'] = $data->getIssuer() === null ? null : new JsonObject($this->normalizer->normalize($data->getIssuer(), 'json', $context));
        $dataArray['recipient'] = $data->getRecipient() === null ? null : new JsonObject($this->normalizer->normalize($data->getRecipient(), 'json', $context));
        $values = [];
        foreach ($data->getLines() as $value) {
            $values[] = $value === null ? null : new JsonObject($this->normalizer->normalize($value, 'json', $context));
        }
        $dataArray['lines'] = $values;
        $dataArray['totals'] = $data->getTotals() === null ? null : new JsonObject($this->normalizer->normalize($data->getTotals(), 'json', $context));
        if ($data->isInitialized('paymentInfo') && $data->getPaymentInfo() !== null) {
            $dataArray['payment_info'] = $data->getPaymentInfo() === null ? null : new JsonObject($this->normalizer->normalize($data->getPaymentInfo(), 'json', $context));
        }
        if ($data->isInitialized('notes') && $data->getNotes() !== null) {
            $dataArray['notes'] = $data->getNotes();
        }
        if ($data->isInitialized('voidCause') && $data->getVoidCause() !== null) {
            $dataArray['void_cause'] = $data->getVoidCause();
        }
        if ($data->isInitialized('voidReason') && $data->getVoidReason() !== null) {
            $dataArray['void_reason'] = $data->getVoidReason();
        }
        if ($data->isInitialized('voidedAt') && $data->getVoidedAt() !== null) {
            $dataArray['voided_at'] = $data->getVoidedAt()?->format('Y-m-d\TH:i:sP');
        }
        if ($data->isInitialized('rectifiedInvoiceId') && $data->getRectifiedInvoiceId() !== null) {
            $dataArray['rectified_invoice_id'] = $data->getRectifiedInvoiceId();
        }
        if ($data->isInitialized('sourceProformaId') && $data->getSourceProformaId() !== null) {
            $dataArray['source_proforma_id'] = $data->getSourceProformaId();
        }
        if ($data->isInitialized('convertedInvoiceId') && $data->getConvertedInvoiceId() !== null) {
            $dataArray['converted_invoice_id'] = $data->getConvertedInvoiceId();
        }
        if ($data->isInitialized('rectificationReason') && $data->getRectificationReason() !== null) {
            $dataArray['rectification_reason'] = $data->getRectificationReason();
        }
        if ($data->isInitialized('recurringInvoiceId') && $data->getRecurringInvoiceId() !== null) {
            $dataArray['recurring_invoice_id'] = $data->getRecurringInvoiceId();
        }
        if ($data->isInitialized('recurringInvoiceName') && $data->getRecurringInvoiceName() !== null) {
            $dataArray['recurring_invoice_name'] = $data->getRecurringInvoiceName();
        }
        if ($data->isInitialized('rectificationType') && $data->getRectificationType() !== null) {
            $dataArray['rectification_type'] = $data->getRectificationType();
        }
        if ($data->isInitialized('rectificationCode') && $data->getRectificationCode() !== null) {
            $dataArray['rectification_code'] = $data->getRectificationCode();
        }
        if ($data->isInitialized('externalRef') && $data->getExternalRef() !== null) {
            $dataArray['external_ref'] = $data->getExternalRef();
        }
        if ($data->isInitialized('metadata') && $data->getMetadata() !== null) {
            $values_1 = new JsonObject;
            foreach ($data->getMetadata() as $key => $value_1) {
                $values_1[$key] = $value_1;
            }
            $dataArray['metadata'] = $values_1;
        }
        if ($data->isInitialized('sendAutomatically') && $data->getSendAutomatically() !== null) {
            $dataArray['send_automatically'] = $data->getSendAutomatically();
        }
        if ($data->isInitialized('emailConfig') && $data->getEmailConfig() !== null) {
            $dataArray['email_config'] = $data->getEmailConfig() === null ? null : new JsonObject($this->normalizer->normalize($data->getEmailConfig(), 'json', $context));
        }
        if ($data->isInitialized('pdfDownloadUrl') && $data->getPdfDownloadUrl() !== null) {
            $dataArray['pdf_download_url'] = $data->getPdfDownloadUrl();
        }
        if ($data->isInitialized('verifactu') && $data->getVerifactu() !== null) {
            $dataArray['verifactu'] = $data->getVerifactu() === null ? null : new JsonObject($this->normalizer->normalize($data->getVerifactu(), 'json', $context));
        }
        if ($data->isInitialized('attachments') && $data->getAttachments() !== null) {
            $values_2 = [];
            foreach ($data->getAttachments() as $value_2) {
                $values_2[] = $value_2 === null ? null : new JsonObject($this->normalizer->normalize($value_2, 'json', $context));
            }
            $dataArray['attachments'] = $values_2;
        }
        if ($data->isInitialized('sendingHistory') && $data->getSendingHistory() !== null) {
            $values_3 = [];
            foreach ($data->getSendingHistory() as $value_3) {
                $values_3[] = $value_3 === null ? null : new JsonObject($this->normalizer->normalize($value_3, 'json', $context));
            }
            $dataArray['sending_history'] = $values_3;
        }
        if ($data->isInitialized('emailDelivery') && $data->getEmailDelivery() !== null) {
            $dataArray['email_delivery'] = $data->getEmailDelivery() === null ? null : new JsonObject($this->normalizer->normalize($data->getEmailDelivery(), 'json', $context));
        }
        if ($data->isInitialized('deletedAt') && $data->getDeletedAt() !== null) {
            $dataArray['deleted_at'] = $data->getDeletedAt()?->format('Y-m-d\TH:i:sP');
        }
        $dataArray['id'] = $data->getId();
        $dataArray['created_at'] = $data->getCreatedAt()->format('Y-m-d\TH:i:sP');
        $dataArray['updated_at'] = $data->getUpdatedAt()->format('Y-m-d\TH:i:sP');
        foreach ($data->additionalPropertyEntries() as $key_1 => $value_4) {
            if (preg_match('/.*/', (string) $key_1)) {
                $dataArray[$key_1] = $value_4;
            }
        }

        return $dataArray;
    }

    public function getSupportedTypes(?string $format = null): array
    {
        return [Invoice::class => false];
    }
}
