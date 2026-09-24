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
class WebhookEventNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use CheckArray;
    use ValidatorTrait;
    public function supportsDenormalization(mixed $data, string $type, ?string $format = null, array $context = []): bool
    {
        return $type === \Lenorix\BeelSdk\Generated\Model\WebhookEvent::class;
    }
    public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
    {
        return is_object($data) && get_class($data) === \Lenorix\BeelSdk\Generated\Model\WebhookEvent::class;
    }
    public function denormalize(mixed $data, string $type, ?string $format = null, array $context = []): mixed
    {
        $object = new \Lenorix\BeelSdk\Generated\Model\WebhookEvent();
        if (null === $data || false === \is_array($data)) {
            return $object;
        }
        if (isset($data['$ref']) && !isset($data['type']) && !isset($data['properties']) && !isset($data['allOf'])) {
            return new Reference($data['$ref'], $context['document-origin']);
        }
        if (isset($data['$recursiveRef'])) {
            return new Reference($data['$recursiveRef'], $context['document-origin']);
        }
        if (\array_key_exists('livemode', $data) && \is_int($data['livemode'])) {
            $data['livemode'] = (bool) $data['livemode'];
        }
        if (\array_key_exists('test', $data) && \is_int($data['test'])) {
            $data['test'] = (bool) $data['test'];
        }
        if (\array_key_exists('id', $data)) {
            $object->setId($data['id']);
            unset($data['id']);
        }
        if (\array_key_exists('type', $data)) {
            $object->setType($data['type']);
            unset($data['type']);
        }
        if (\array_key_exists('created_at', $data)) {
            $date = \DateTime::createFromFormat('Y-m-d\TH:i:sP', $data['created_at']);
            if (false === $date) {
                throw new \Lenorix\BeelSdk\Generated\Runtime\Normalizer\InvalidDateException($data['created_at'], 'Y-m-d\TH:i:sP');
            }
            $object->setCreatedAt($date);
            unset($data['created_at']);
        }
        if (\array_key_exists('api_version', $data)) {
            $object->setApiVersion($data['api_version']);
            unset($data['api_version']);
        }
        if (\array_key_exists('livemode', $data)) {
            $object->setLivemode($data['livemode']);
            unset($data['livemode']);
        }
        if (\array_key_exists('test', $data) && $data['test'] !== null) {
            $object->setTest($data['test']);
            unset($data['test']);
        }
        elseif (\array_key_exists('test', $data) && $data['test'] === null) {
            $object->setTest(null);
            unset($data['test']);
        }
        if (\array_key_exists('company_id', $data) && $data['company_id'] !== null) {
            $object->setCompanyId($data['company_id']);
            unset($data['company_id']);
        }
        elseif (\array_key_exists('company_id', $data) && $data['company_id'] === null) {
            $object->setCompanyId(null);
            unset($data['company_id']);
        }
        if (\array_key_exists('nif', $data) && $data['nif'] !== null) {
            $object->setNif($data['nif']);
            unset($data['nif']);
        }
        elseif (\array_key_exists('nif', $data) && $data['nif'] === null) {
            $object->setNif(null);
            unset($data['nif']);
        }
        if (\array_key_exists('account_id', $data) && $data['account_id'] !== null) {
            $object->setAccountId($data['account_id']);
            unset($data['account_id']);
        }
        elseif (\array_key_exists('account_id', $data) && $data['account_id'] === null) {
            $object->setAccountId(null);
            unset($data['account_id']);
        }
        if (\array_key_exists('account_external_ref', $data) && $data['account_external_ref'] !== null) {
            $object->setAccountExternalRef($data['account_external_ref']);
            unset($data['account_external_ref']);
        }
        elseif (\array_key_exists('account_external_ref', $data) && $data['account_external_ref'] === null) {
            $object->setAccountExternalRef(null);
            unset($data['account_external_ref']);
        }
        if (\array_key_exists('account_relationship', $data) && $data['account_relationship'] !== null) {
            $object->setAccountRelationship($data['account_relationship']);
            unset($data['account_relationship']);
        }
        elseif (\array_key_exists('account_relationship', $data) && $data['account_relationship'] === null) {
            $object->setAccountRelationship(null);
            unset($data['account_relationship']);
        }
        if (\array_key_exists('data', $data)) {
            $value = $data['data'];
            if (is_array($data['data']) and \array_key_exists('invoice_id', $data['data']) and \array_key_exists('invoice_number', $data['data'])) {
                $value = $this->denormalizer->denormalize($data['data'], \Lenorix\BeelSdk\Generated\Model\WebhookEventDataInvoiceIssued::class, 'json', $context);
            } elseif (is_array($data['data']) and \array_key_exists('invoice_id', $data['data']) and \array_key_exists('all_recipients', $data['data']) and \array_key_exists('sent_at', $data['data'])) {
                $value = $this->denormalizer->denormalize($data['data'], \Lenorix\BeelSdk\Generated\Model\WebhookEventDataInvoiceEmailSent::class, 'json', $context);
            } elseif (is_array($data['data']) and \array_key_exists('invoice_id', $data['data'])) {
                $value = $this->denormalizer->denormalize($data['data'], \Lenorix\BeelSdk\Generated\Model\WebhookEventDataInvoicePdfGenerated::class, 'json', $context);
            } elseif (is_array($data['data']) and \array_key_exists('invoice_id', $data['data']) and \array_key_exists('invoice_number', $data['data'])) {
                $value = $this->denormalizer->denormalize($data['data'], \Lenorix\BeelSdk\Generated\Model\WebhookEventDataInvoiceVoided::class, 'json', $context);
            } elseif (is_array($data['data']) and \array_key_exists('recurring_invoice_id', $data['data']) and (\array_key_exists('reason', $data['data']) and ($data['data']['reason'] == 'DOWNGRADE' or $data['data']['reason'] == 'GENERATION_FAILURE')) and \array_key_exists('since', $data['data'])) {
                $value = $this->denormalizer->denormalize($data['data'], \Lenorix\BeelSdk\Generated\Model\WebhookEventDataRecurringInvoicePaused::class, 'json', $context);
            } elseif (is_array($data['data']) and \array_key_exists('invoice_id', $data['data'])) {
                $value = $this->denormalizer->denormalize($data['data'], \Lenorix\BeelSdk\Generated\Model\WebhookEventDataInvoiceScheduleFailed::class, 'json', $context);
            } elseif (is_array($data['data']) and \array_key_exists('invoice_id', $data['data']) and \array_key_exists('verifactu_registration_id', $data['data']) and (\array_key_exists('previous_status', $data['data']) and ($data['data']['previous_status'] == 'PENDING' or $data['data']['previous_status'] == 'ACCEPTED' or $data['data']['previous_status'] == 'VOIDED' or $data['data']['previous_status'] == 'REJECTED' or $data['data']['previous_status'] == 'NOT_SUBMITTED')) and (\array_key_exists('new_status', $data['data']) and ($data['data']['new_status'] == 'PENDING' or $data['data']['new_status'] == 'ACCEPTED' or $data['data']['new_status'] == 'VOIDED' or $data['data']['new_status'] == 'REJECTED' or $data['data']['new_status'] == 'NOT_SUBMITTED'))) {
                $value = $this->denormalizer->denormalize($data['data'], \Lenorix\BeelSdk\Generated\Model\WebhookEventDataVeriFactuStatusUpdated::class, 'json', $context);
            } elseif (is_array($data['data']) and \array_key_exists('account_id', $data['data']) and \array_key_exists('external_ref', $data['data'])) {
                $value = $this->denormalizer->denormalize($data['data'], \Lenorix\BeelSdk\Generated\Model\WebhookEventDataAccountClaimed::class, 'json', $context);
            } elseif (is_array($data['data']) and \array_key_exists('account_id', $data['data']) and \array_key_exists('external_ref', $data['data']) and \array_key_exists('nif', $data['data'])) {
                $value = $this->denormalizer->denormalize($data['data'], \Lenorix\BeelSdk\Generated\Model\WebhookEventDataCompanyCreated::class, 'json', $context);
            } elseif (is_array($data['data']) and \array_key_exists('account_id', $data['data']) and \array_key_exists('external_ref', $data['data']) and \array_key_exists('company_id', $data['data']) and \array_key_exists('nif', $data['data']) and \array_key_exists('signed_at', $data['data'])) {
                $value = $this->denormalizer->denormalize($data['data'], \Lenorix\BeelSdk\Generated\Model\WebhookEventDataRepresentationSigned::class, 'json', $context);
            }
            $object->setData($value);
            unset($data['data']);
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
        $dataArray['id'] = $data->getId();
        $dataArray['type'] = $data->getType();
        $dataArray['created_at'] = $data->getCreatedAt()->format('Y-m-d\TH:i:sP');
        $dataArray['api_version'] = $data->getApiVersion();
        $dataArray['livemode'] = $data->getLivemode();
        if ($data->isInitialized('test') && null !== $data->getTest()) {
            $dataArray['test'] = $data->getTest();
        }
        if ($data->isInitialized('companyId') && null !== $data->getCompanyId()) {
            $dataArray['company_id'] = $data->getCompanyId();
        }
        if ($data->isInitialized('nif') && null !== $data->getNif()) {
            $dataArray['nif'] = $data->getNif();
        }
        if ($data->isInitialized('accountId') && null !== $data->getAccountId()) {
            $dataArray['account_id'] = $data->getAccountId();
        }
        if ($data->isInitialized('accountExternalRef') && null !== $data->getAccountExternalRef()) {
            $dataArray['account_external_ref'] = $data->getAccountExternalRef();
        }
        if ($data->isInitialized('accountRelationship') && null !== $data->getAccountRelationship()) {
            $dataArray['account_relationship'] = $data->getAccountRelationship();
        }
        $value = $data->getData();
        if (is_object($data->getData())) {
            $value = $data->getData() === null ? null : new \Lenorix\BeelSdk\Generated\Runtime\JsonObject($this->normalizer->normalize($data->getData(), 'json', $context));
        } elseif (is_object($data->getData())) {
            $value = $data->getData() === null ? null : new \Lenorix\BeelSdk\Generated\Runtime\JsonObject($this->normalizer->normalize($data->getData(), 'json', $context));
        } elseif (is_object($data->getData())) {
            $value = $data->getData() === null ? null : new \Lenorix\BeelSdk\Generated\Runtime\JsonObject($this->normalizer->normalize($data->getData(), 'json', $context));
        } elseif (is_object($data->getData())) {
            $value = $data->getData() === null ? null : new \Lenorix\BeelSdk\Generated\Runtime\JsonObject($this->normalizer->normalize($data->getData(), 'json', $context));
        } elseif (is_object($data->getData())) {
            $value = $data->getData() === null ? null : new \Lenorix\BeelSdk\Generated\Runtime\JsonObject($this->normalizer->normalize($data->getData(), 'json', $context));
        } elseif (is_object($data->getData())) {
            $value = $data->getData() === null ? null : new \Lenorix\BeelSdk\Generated\Runtime\JsonObject($this->normalizer->normalize($data->getData(), 'json', $context));
        } elseif (is_object($data->getData())) {
            $value = $data->getData() === null ? null : new \Lenorix\BeelSdk\Generated\Runtime\JsonObject($this->normalizer->normalize($data->getData(), 'json', $context));
        } elseif (is_object($data->getData())) {
            $value = $data->getData() === null ? null : new \Lenorix\BeelSdk\Generated\Runtime\JsonObject($this->normalizer->normalize($data->getData(), 'json', $context));
        } elseif (is_object($data->getData())) {
            $value = $data->getData() === null ? null : new \Lenorix\BeelSdk\Generated\Runtime\JsonObject($this->normalizer->normalize($data->getData(), 'json', $context));
        } elseif (is_object($data->getData())) {
            $value = $data->getData() === null ? null : new \Lenorix\BeelSdk\Generated\Runtime\JsonObject($this->normalizer->normalize($data->getData(), 'json', $context));
        }
        $dataArray['data'] = $value;
        foreach ($data->additionalPropertyEntries() as $key => $value_1) {
            if (preg_match('/.*/', (string) $key)) {
                $dataArray[$key] = $value_1;
            }
        }
        return $dataArray;
    }
    public function getSupportedTypes(?string $format = null): array
    {
        return [\Lenorix\BeelSdk\Generated\Model\WebhookEvent::class => false];
    }
}