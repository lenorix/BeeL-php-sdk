<?php

namespace Lenorix\BeelSdk\Generated\Normalizer;

use Jane\Component\JsonSchemaRuntime\Reference;
use Lenorix\BeelSdk\Generated\Model\ManagedPaymentEvent;
use Lenorix\BeelSdk\Generated\Runtime\Normalizer\CheckArray;
use Lenorix\BeelSdk\Generated\Runtime\Normalizer\InvalidDateException;
use Lenorix\BeelSdk\Generated\Runtime\Normalizer\ValidatorTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class ManagedPaymentEventNormalizer implements DenormalizerAwareInterface, DenormalizerInterface, NormalizerAwareInterface, NormalizerInterface
{
    use CheckArray;
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use ValidatorTrait;

    public function supportsDenormalization(mixed $data, string $type, ?string $format = null, array $context = []): bool
    {
        return $type === ManagedPaymentEvent::class;
    }

    public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
    {
        return is_object($data) && get_class($data) === ManagedPaymentEvent::class;
    }

    public function denormalize(mixed $data, string $type, ?string $format = null, array $context = []): mixed
    {
        $object = new ManagedPaymentEvent;
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
        if (\array_key_exists('fee_amount', $data) && \is_int($data['fee_amount'])) {
            $data['fee_amount'] = (float) $data['fee_amount'];
        }
        if (\array_key_exists('net_amount', $data) && \is_int($data['net_amount'])) {
            $data['net_amount'] = (float) $data['net_amount'];
        }
        if (\array_key_exists('money_returned', $data) && \is_int($data['money_returned'])) {
            $data['money_returned'] = (bool) $data['money_returned'];
        }
        if (\array_key_exists('needs_action', $data) && \is_int($data['needs_action'])) {
            $data['needs_action'] = (bool) $data['needs_action'];
        }
        if (\array_key_exists('draft_available', $data) && \is_int($data['draft_available'])) {
            $data['draft_available'] = (bool) $data['draft_available'];
        }
        if (\array_key_exists('retry_available', $data) && \is_int($data['retry_available'])) {
            $data['retry_available'] = (bool) $data['retry_available'];
        }
        if (\array_key_exists('discard_available', $data) && \is_int($data['discard_available'])) {
            $data['discard_available'] = (bool) $data['discard_available'];
        }
        if (\array_key_exists('discarded', $data) && \is_int($data['discarded'])) {
            $data['discarded'] = (bool) $data['discarded'];
        }
        if (\array_key_exists('id', $data)) {
            $object->setId($data['id']);
            unset($data['id']);
        }
        if (\array_key_exists('provider', $data)) {
            $object->setProvider($data['provider']);
            unset($data['provider']);
        }
        if (\array_key_exists('event_type', $data)) {
            $object->setEventType($data['event_type']);
            unset($data['event_type']);
        }
        if (\array_key_exists('event_kind', $data)) {
            $object->setEventKind($data['event_kind']);
            unset($data['event_kind']);
        }
        if (\array_key_exists('external_event_id', $data)) {
            $object->setExternalEventId($data['external_event_id']);
            unset($data['external_event_id']);
        }
        if (\array_key_exists('external_payment_id', $data) && $data['external_payment_id'] !== null) {
            $object->setExternalPaymentId($data['external_payment_id']);
            unset($data['external_payment_id']);
        } elseif (\array_key_exists('external_payment_id', $data) && $data['external_payment_id'] === null) {
            $object->setExternalPaymentId(null);
            unset($data['external_payment_id']);
        }
        if (\array_key_exists('source_object_id', $data) && $data['source_object_id'] !== null) {
            $object->setSourceObjectId($data['source_object_id']);
            unset($data['source_object_id']);
        } elseif (\array_key_exists('source_object_id', $data) && $data['source_object_id'] === null) {
            $object->setSourceObjectId(null);
            unset($data['source_object_id']);
        }
        if (\array_key_exists('currency', $data) && $data['currency'] !== null) {
            $object->setCurrency($data['currency']);
            unset($data['currency']);
        } elseif (\array_key_exists('currency', $data) && $data['currency'] === null) {
            $object->setCurrency(null);
            unset($data['currency']);
        }
        if (\array_key_exists('amount', $data) && $data['amount'] !== null) {
            $object->setAmount($data['amount']);
            unset($data['amount']);
        } elseif (\array_key_exists('amount', $data) && $data['amount'] === null) {
            $object->setAmount(null);
            unset($data['amount']);
        }
        if (\array_key_exists('fee_amount', $data) && $data['fee_amount'] !== null) {
            $object->setFeeAmount($data['fee_amount']);
            unset($data['fee_amount']);
        } elseif (\array_key_exists('fee_amount', $data) && $data['fee_amount'] === null) {
            $object->setFeeAmount(null);
            unset($data['fee_amount']);
        }
        if (\array_key_exists('net_amount', $data) && $data['net_amount'] !== null) {
            $object->setNetAmount($data['net_amount']);
            unset($data['net_amount']);
        } elseif (\array_key_exists('net_amount', $data) && $data['net_amount'] === null) {
            $object->setNetAmount(null);
            unset($data['net_amount']);
        }
        if (\array_key_exists('category', $data) && $data['category'] !== null) {
            $object->setCategory($data['category']);
            unset($data['category']);
        } elseif (\array_key_exists('category', $data) && $data['category'] === null) {
            $object->setCategory(null);
            unset($data['category']);
        }
        if (\array_key_exists('money_returned', $data) && $data['money_returned'] !== null) {
            $object->setMoneyReturned($data['money_returned']);
            unset($data['money_returned']);
        } elseif (\array_key_exists('money_returned', $data) && $data['money_returned'] === null) {
            $object->setMoneyReturned(null);
            unset($data['money_returned']);
        }
        if (\array_key_exists('customer_email', $data) && $data['customer_email'] !== null) {
            $object->setCustomerEmail($data['customer_email']);
            unset($data['customer_email']);
        } elseif (\array_key_exists('customer_email', $data) && $data['customer_email'] === null) {
            $object->setCustomerEmail(null);
            unset($data['customer_email']);
        }
        if (\array_key_exists('customer_name', $data) && $data['customer_name'] !== null) {
            $object->setCustomerName($data['customer_name']);
            unset($data['customer_name']);
        } elseif (\array_key_exists('customer_name', $data) && $data['customer_name'] === null) {
            $object->setCustomerName(null);
            unset($data['customer_name']);
        }
        if (\array_key_exists('status', $data)) {
            $object->setStatus($data['status']);
            unset($data['status']);
        }
        if (\array_key_exists('invoice_id', $data) && $data['invoice_id'] !== null) {
            $object->setInvoiceId($data['invoice_id']);
            unset($data['invoice_id']);
        } elseif (\array_key_exists('invoice_id', $data) && $data['invoice_id'] === null) {
            $object->setInvoiceId(null);
            unset($data['invoice_id']);
        }
        if (\array_key_exists('invoice_number', $data) && $data['invoice_number'] !== null) {
            $object->setInvoiceNumber($data['invoice_number']);
            unset($data['invoice_number']);
        } elseif (\array_key_exists('invoice_number', $data) && $data['invoice_number'] === null) {
            $object->setInvoiceNumber(null);
            unset($data['invoice_number']);
        }
        if (\array_key_exists('failure_category', $data) && $data['failure_category'] !== null) {
            $object->setFailureCategory($data['failure_category']);
            unset($data['failure_category']);
        } elseif (\array_key_exists('failure_category', $data) && $data['failure_category'] === null) {
            $object->setFailureCategory(null);
            unset($data['failure_category']);
        }
        if (\array_key_exists('failure_reason', $data) && $data['failure_reason'] !== null) {
            $object->setFailureReason($data['failure_reason']);
            unset($data['failure_reason']);
        } elseif (\array_key_exists('failure_reason', $data) && $data['failure_reason'] === null) {
            $object->setFailureReason(null);
            unset($data['failure_reason']);
        }
        if (\array_key_exists('failure_message', $data) && $data['failure_message'] !== null) {
            $object->setFailureMessage($data['failure_message']);
            unset($data['failure_message']);
        } elseif (\array_key_exists('failure_message', $data) && $data['failure_message'] === null) {
            $object->setFailureMessage(null);
            unset($data['failure_message']);
        }
        if (\array_key_exists('needs_action', $data)) {
            $object->setNeedsAction($data['needs_action']);
            unset($data['needs_action']);
        }
        if (\array_key_exists('draft_available', $data)) {
            $object->setDraftAvailable($data['draft_available']);
            unset($data['draft_available']);
        }
        if (\array_key_exists('retry_available', $data)) {
            $object->setRetryAvailable($data['retry_available']);
            unset($data['retry_available']);
        }
        if (\array_key_exists('discard_available', $data)) {
            $object->setDiscardAvailable($data['discard_available']);
            unset($data['discard_available']);
        }
        if (\array_key_exists('retry_count', $data)) {
            $object->setRetryCount($data['retry_count']);
            unset($data['retry_count']);
        }
        if (\array_key_exists('received_at', $data)) {
            $date = \DateTime::createFromFormat('Y-m-d\TH:i:sP', $data['received_at']);
            if ($date === false) {
                throw new InvalidDateException($data['received_at'], 'Y-m-d\TH:i:sP');
            }
            $object->setReceivedAt($date);
            unset($data['received_at']);
        }
        if (\array_key_exists('processed_at', $data) && $data['processed_at'] !== null) {
            $date_1 = \DateTime::createFromFormat('Y-m-d\TH:i:sP', $data['processed_at']);
            if ($date_1 === false) {
                throw new InvalidDateException($data['processed_at'], 'Y-m-d\TH:i:sP');
            }
            $object->setProcessedAt($date_1);
            unset($data['processed_at']);
        } elseif (\array_key_exists('processed_at', $data) && $data['processed_at'] === null) {
            $object->setProcessedAt(null);
            unset($data['processed_at']);
        }
        if (\array_key_exists('description', $data) && $data['description'] !== null) {
            $object->setDescription($data['description']);
            unset($data['description']);
        } elseif (\array_key_exists('description', $data) && $data['description'] === null) {
            $object->setDescription(null);
            unset($data['description']);
        }
        if (\array_key_exists('payment_method', $data) && $data['payment_method'] !== null) {
            $object->setPaymentMethod($data['payment_method']);
            unset($data['payment_method']);
        } elseif (\array_key_exists('payment_method', $data) && $data['payment_method'] === null) {
            $object->setPaymentMethod(null);
            unset($data['payment_method']);
        }
        if (\array_key_exists('discarded', $data)) {
            $object->setDiscarded($data['discarded']);
            unset($data['discarded']);
        }
        if (\array_key_exists('discarded_at', $data) && $data['discarded_at'] !== null) {
            $date_2 = \DateTime::createFromFormat('Y-m-d\TH:i:sP', $data['discarded_at']);
            if ($date_2 === false) {
                throw new InvalidDateException($data['discarded_at'], 'Y-m-d\TH:i:sP');
            }
            $object->setDiscardedAt($date_2);
            unset($data['discarded_at']);
        } elseif (\array_key_exists('discarded_at', $data) && $data['discarded_at'] === null) {
            $object->setDiscardedAt(null);
            unset($data['discarded_at']);
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
        $dataArray['id'] = $data->getId();
        $dataArray['provider'] = $data->getProvider();
        $dataArray['event_type'] = $data->getEventType();
        $dataArray['event_kind'] = $data->getEventKind();
        $dataArray['external_event_id'] = $data->getExternalEventId();
        if ($data->isInitialized('externalPaymentId') && $data->getExternalPaymentId() !== null) {
            $dataArray['external_payment_id'] = $data->getExternalPaymentId();
        }
        if ($data->isInitialized('sourceObjectId') && $data->getSourceObjectId() !== null) {
            $dataArray['source_object_id'] = $data->getSourceObjectId();
        }
        if ($data->isInitialized('currency') && $data->getCurrency() !== null) {
            $dataArray['currency'] = $data->getCurrency();
        }
        if ($data->isInitialized('amount') && $data->getAmount() !== null) {
            $dataArray['amount'] = $data->getAmount();
        }
        if ($data->isInitialized('feeAmount') && $data->getFeeAmount() !== null) {
            $dataArray['fee_amount'] = $data->getFeeAmount();
        }
        if ($data->isInitialized('netAmount') && $data->getNetAmount() !== null) {
            $dataArray['net_amount'] = $data->getNetAmount();
        }
        if ($data->isInitialized('category') && $data->getCategory() !== null) {
            $dataArray['category'] = $data->getCategory();
        }
        if ($data->isInitialized('moneyReturned') && $data->getMoneyReturned() !== null) {
            $dataArray['money_returned'] = $data->getMoneyReturned();
        }
        if ($data->isInitialized('customerEmail') && $data->getCustomerEmail() !== null) {
            $dataArray['customer_email'] = $data->getCustomerEmail();
        }
        if ($data->isInitialized('customerName') && $data->getCustomerName() !== null) {
            $dataArray['customer_name'] = $data->getCustomerName();
        }
        $dataArray['status'] = $data->getStatus();
        if ($data->isInitialized('invoiceId') && $data->getInvoiceId() !== null) {
            $dataArray['invoice_id'] = $data->getInvoiceId();
        }
        if ($data->isInitialized('invoiceNumber') && $data->getInvoiceNumber() !== null) {
            $dataArray['invoice_number'] = $data->getInvoiceNumber();
        }
        if ($data->isInitialized('failureCategory') && $data->getFailureCategory() !== null) {
            $dataArray['failure_category'] = $data->getFailureCategory();
        }
        if ($data->isInitialized('failureReason') && $data->getFailureReason() !== null) {
            $dataArray['failure_reason'] = $data->getFailureReason();
        }
        if ($data->isInitialized('failureMessage') && $data->getFailureMessage() !== null) {
            $dataArray['failure_message'] = $data->getFailureMessage();
        }
        $dataArray['needs_action'] = $data->getNeedsAction();
        $dataArray['draft_available'] = $data->getDraftAvailable();
        $dataArray['retry_available'] = $data->getRetryAvailable();
        $dataArray['discard_available'] = $data->getDiscardAvailable();
        $dataArray['retry_count'] = $data->getRetryCount();
        $dataArray['received_at'] = $data->getReceivedAt()->format('Y-m-d\TH:i:sP');
        if ($data->isInitialized('processedAt') && $data->getProcessedAt() !== null) {
            $dataArray['processed_at'] = $data->getProcessedAt()?->format('Y-m-d\TH:i:sP');
        }
        if ($data->isInitialized('description') && $data->getDescription() !== null) {
            $dataArray['description'] = $data->getDescription();
        }
        if ($data->isInitialized('paymentMethod') && $data->getPaymentMethod() !== null) {
            $dataArray['payment_method'] = $data->getPaymentMethod();
        }
        $dataArray['discarded'] = $data->getDiscarded();
        if ($data->isInitialized('discardedAt') && $data->getDiscardedAt() !== null) {
            $dataArray['discarded_at'] = $data->getDiscardedAt()?->format('Y-m-d\TH:i:sP');
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
        return [ManagedPaymentEvent::class => false];
    }
}
