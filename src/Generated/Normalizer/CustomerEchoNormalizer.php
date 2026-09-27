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
class CustomerEchoNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use CheckArray;
    use ValidatorTrait;
    public function supportsDenormalization(mixed $data, string $type, ?string $format = null, array $context = []): bool
    {
        return $type === \Lenorix\BeelSdk\Generated\Model\CustomerEcho::class;
    }
    public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
    {
        return is_object($data) && get_class($data) === \Lenorix\BeelSdk\Generated\Model\CustomerEcho::class;
    }
    public function denormalize(mixed $data, string $type, ?string $format = null, array $context = []): mixed
    {
        $object = new \Lenorix\BeelSdk\Generated\Model\CustomerEcho();
        if (null === $data || false === \is_array($data)) {
            return $object;
        }
        if (isset($data['$ref']) && !isset($data['type']) && !isset($data['properties']) && !isset($data['allOf'])) {
            return new Reference($data['$ref'], $context['document-origin']);
        }
        if (isset($data['$recursiveRef'])) {
            return new Reference($data['$recursiveRef'], $context['document-origin']);
        }
        if (\array_key_exists('general_discount', $data) && \is_int($data['general_discount'])) {
            $data['general_discount'] = (float) $data['general_discount'];
        }
        if (\array_key_exists('active', $data) && \is_int($data['active'])) {
            $data['active'] = (bool) $data['active'];
        }
        if (\array_key_exists('legal_name', $data)) {
            $object->setLegalName($data['legal_name']);
            unset($data['legal_name']);
        }
        if (\array_key_exists('trade_name', $data)) {
            $object->setTradeName($data['trade_name']);
            unset($data['trade_name']);
        }
        if (\array_key_exists('nif', $data)) {
            $object->setNif($data['nif']);
            unset($data['nif']);
        }
        if (\array_key_exists('alternative_id', $data) && $data['alternative_id'] !== null) {
            $object->setAlternativeId($this->denormalizer->denormalize($data['alternative_id'], \Lenorix\BeelSdk\Generated\Model\AlternativeIdentifier::class, 'json', $context));
            unset($data['alternative_id']);
        }
        elseif (\array_key_exists('alternative_id', $data) && $data['alternative_id'] === null) {
            $object->setAlternativeId(null);
            unset($data['alternative_id']);
        }
        if (\array_key_exists('address', $data)) {
            $object->setAddress($this->denormalizer->denormalize($data['address'], \Lenorix\BeelSdk\Generated\Model\Address::class, 'json', $context));
            unset($data['address']);
        }
        if (\array_key_exists('phone', $data)) {
            $object->setPhone($data['phone']);
            unset($data['phone']);
        }
        if (\array_key_exists('email', $data) && $data['email'] !== null) {
            $object->setEmail($data['email']);
            unset($data['email']);
        }
        elseif (\array_key_exists('email', $data) && $data['email'] === null) {
            $object->setEmail(null);
            unset($data['email']);
        }
        if (\array_key_exists('website', $data) && $data['website'] !== null) {
            $object->setWebsite($data['website']);
            unset($data['website']);
        }
        elseif (\array_key_exists('website', $data) && $data['website'] === null) {
            $object->setWebsite(null);
            unset($data['website']);
        }
        if (\array_key_exists('billing_emails', $data)) {
            $values = [];
            foreach ($data['billing_emails'] as $value) {
                $values[] = $value;
            }
            $object->setBillingEmails($values);
            unset($data['billing_emails']);
        }
        if (\array_key_exists('contact_person', $data)) {
            $object->setContactPerson($data['contact_person']);
            unset($data['contact_person']);
        }
        if (\array_key_exists('notes', $data)) {
            $object->setNotes($data['notes']);
            unset($data['notes']);
        }
        if (\array_key_exists('preferred_payment_method', $data)) {
            $object->setPreferredPaymentMethod($this->denormalizer->denormalize($data['preferred_payment_method'], \Lenorix\BeelSdk\Generated\Model\PaymentInfo::class, 'json', $context));
            unset($data['preferred_payment_method']);
        }
        if (\array_key_exists('general_discount', $data)) {
            $object->setGeneralDiscount($data['general_discount']);
            unset($data['general_discount']);
        }
        if (\array_key_exists('active', $data)) {
            $object->setActive($data['active']);
            unset($data['active']);
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
        $dataArray['legal_name'] = $data->getLegalName();
        if ($data->isInitialized('tradeName') && null !== $data->getTradeName()) {
            $dataArray['trade_name'] = $data->getTradeName();
        }
        if ($data->isInitialized('nif') && null !== $data->getNif()) {
            $dataArray['nif'] = $data->getNif();
        }
        if ($data->isInitialized('alternativeId') && null !== $data->getAlternativeId()) {
            $dataArray['alternative_id'] = $data->getAlternativeId() === null ? null : new \Lenorix\BeelSdk\Generated\Runtime\JsonObject($this->normalizer->normalize($data->getAlternativeId(), 'json', $context));
        }
        if ($data->isInitialized('address') && null !== $data->getAddress()) {
            $dataArray['address'] = $data->getAddress() === null ? null : new \Lenorix\BeelSdk\Generated\Runtime\JsonObject($this->normalizer->normalize($data->getAddress(), 'json', $context));
        }
        if ($data->isInitialized('phone') && null !== $data->getPhone()) {
            $dataArray['phone'] = $data->getPhone();
        }
        if ($data->isInitialized('email') && null !== $data->getEmail()) {
            $dataArray['email'] = $data->getEmail();
        }
        if ($data->isInitialized('website') && null !== $data->getWebsite()) {
            $dataArray['website'] = $data->getWebsite();
        }
        if ($data->isInitialized('billingEmails') && null !== $data->getBillingEmails()) {
            $values = [];
            foreach ($data->getBillingEmails() as $value) {
                $values[] = $value;
            }
            $dataArray['billing_emails'] = $values;
        }
        if ($data->isInitialized('contactPerson') && null !== $data->getContactPerson()) {
            $dataArray['contact_person'] = $data->getContactPerson();
        }
        if ($data->isInitialized('notes') && null !== $data->getNotes()) {
            $dataArray['notes'] = $data->getNotes();
        }
        if ($data->isInitialized('preferredPaymentMethod') && null !== $data->getPreferredPaymentMethod()) {
            $dataArray['preferred_payment_method'] = $data->getPreferredPaymentMethod() === null ? null : new \Lenorix\BeelSdk\Generated\Runtime\JsonObject($this->normalizer->normalize($data->getPreferredPaymentMethod(), 'json', $context));
        }
        if ($data->isInitialized('generalDiscount') && null !== $data->getGeneralDiscount()) {
            $dataArray['general_discount'] = $data->getGeneralDiscount();
        }
        if ($data->isInitialized('active') && null !== $data->getActive()) {
            $dataArray['active'] = $data->getActive();
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
        return [\Lenorix\BeelSdk\Generated\Model\CustomerEcho::class => false];
    }
}