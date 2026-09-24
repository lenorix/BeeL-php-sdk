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
class RequestLogDetailNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use CheckArray;
    use ValidatorTrait;
    public function supportsDenormalization(mixed $data, string $type, ?string $format = null, array $context = []): bool
    {
        return $type === \Lenorix\BeelSdk\Generated\Model\RequestLogDetail::class;
    }
    public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
    {
        return is_object($data) && get_class($data) === \Lenorix\BeelSdk\Generated\Model\RequestLogDetail::class;
    }
    public function denormalize(mixed $data, string $type, ?string $format = null, array $context = []): mixed
    {
        $object = new \Lenorix\BeelSdk\Generated\Model\RequestLogDetail();
        if (null === $data || false === \is_array($data)) {
            return $object;
        }
        if (isset($data['$ref']) && !isset($data['type']) && !isset($data['properties']) && !isset($data['allOf'])) {
            return new Reference($data['$ref'], $context['document-origin']);
        }
        if (isset($data['$recursiveRef'])) {
            return new Reference($data['$recursiveRef'], $context['document-origin']);
        }
        if (\array_key_exists('request_id', $data)) {
            $object->setRequestId($data['request_id']);
            unset($data['request_id']);
        }
        if (\array_key_exists('timestamp', $data)) {
            $date = \DateTime::createFromFormat('Y-m-d\TH:i:sP', $data['timestamp']);
            if (false === $date) {
                throw new \Lenorix\BeelSdk\Generated\Runtime\Normalizer\InvalidDateException($data['timestamp'], 'Y-m-d\TH:i:sP');
            }
            $object->setTimestamp($date);
            unset($data['timestamp']);
        }
        if (\array_key_exists('http_method', $data)) {
            $object->setHttpMethod($data['http_method']);
            unset($data['http_method']);
        }
        if (\array_key_exists('http_path', $data)) {
            $object->setHttpPath($data['http_path']);
            unset($data['http_path']);
        }
        if (\array_key_exists('http_status', $data)) {
            $object->setHttpStatus($data['http_status']);
            unset($data['http_status']);
        }
        if (\array_key_exists('duration_ms', $data) && $data['duration_ms'] !== null) {
            $object->setDurationMs($data['duration_ms']);
            unset($data['duration_ms']);
        }
        elseif (\array_key_exists('duration_ms', $data) && $data['duration_ms'] === null) {
            $object->setDurationMs(null);
            unset($data['duration_ms']);
        }
        if (\array_key_exists('environment', $data) && $data['environment'] !== null) {
            $object->setEnvironment($data['environment']);
            unset($data['environment']);
        }
        elseif (\array_key_exists('environment', $data) && $data['environment'] === null) {
            $object->setEnvironment(null);
            unset($data['environment']);
        }
        if (\array_key_exists('api_key_id', $data) && $data['api_key_id'] !== null) {
            $object->setApiKeyId($data['api_key_id']);
            unset($data['api_key_id']);
        }
        elseif (\array_key_exists('api_key_id', $data) && $data['api_key_id'] === null) {
            $object->setApiKeyId(null);
            unset($data['api_key_id']);
        }
        if (\array_key_exists('error_code', $data) && $data['error_code'] !== null) {
            $object->setErrorCode($data['error_code']);
            unset($data['error_code']);
        }
        elseif (\array_key_exists('error_code', $data) && $data['error_code'] === null) {
            $object->setErrorCode(null);
            unset($data['error_code']);
        }
        if (\array_key_exists('client_ip', $data) && $data['client_ip'] !== null) {
            $object->setClientIp($data['client_ip']);
            unset($data['client_ip']);
        }
        elseif (\array_key_exists('client_ip', $data) && $data['client_ip'] === null) {
            $object->setClientIp(null);
            unset($data['client_ip']);
        }
        if (\array_key_exists('query_string', $data) && $data['query_string'] !== null) {
            $object->setQueryString($data['query_string']);
            unset($data['query_string']);
        }
        elseif (\array_key_exists('query_string', $data) && $data['query_string'] === null) {
            $object->setQueryString(null);
            unset($data['query_string']);
        }
        if (\array_key_exists('user_agent', $data) && $data['user_agent'] !== null) {
            $object->setUserAgent($data['user_agent']);
            unset($data['user_agent']);
        }
        elseif (\array_key_exists('user_agent', $data) && $data['user_agent'] === null) {
            $object->setUserAgent(null);
            unset($data['user_agent']);
        }
        if (\array_key_exists('request_body', $data) && $data['request_body'] !== null) {
            $object->setRequestBody($data['request_body']);
            unset($data['request_body']);
        }
        elseif (\array_key_exists('request_body', $data) && $data['request_body'] === null) {
            $object->setRequestBody(null);
            unset($data['request_body']);
        }
        if (\array_key_exists('response_body', $data) && $data['response_body'] !== null) {
            $object->setResponseBody($data['response_body']);
            unset($data['response_body']);
        }
        elseif (\array_key_exists('response_body', $data) && $data['response_body'] === null) {
            $object->setResponseBody(null);
            unset($data['response_body']);
        }
        if (\array_key_exists('request_headers', $data) && $data['request_headers'] !== null) {
            $values = new \Lenorix\BeelSdk\Generated\Runtime\JsonObject();
            foreach ($data['request_headers'] as $key => $value) {
                $values[$key] = $value;
            }
            $object->setRequestHeaders($values);
            unset($data['request_headers']);
        }
        elseif (\array_key_exists('request_headers', $data) && $data['request_headers'] === null) {
            $object->setRequestHeaders(null);
            unset($data['request_headers']);
        }
        if (\array_key_exists('response_headers', $data) && $data['response_headers'] !== null) {
            $values_1 = new \Lenorix\BeelSdk\Generated\Runtime\JsonObject();
            foreach ($data['response_headers'] as $key_1 => $value_1) {
                $values_1[$key_1] = $value_1;
            }
            $object->setResponseHeaders($values_1);
            unset($data['response_headers']);
        }
        elseif (\array_key_exists('response_headers', $data) && $data['response_headers'] === null) {
            $object->setResponseHeaders(null);
            unset($data['response_headers']);
        }
        foreach ($data as $key_2 => $value_2) {
            if (preg_match('/.*/', (string) $key_2)) {
                $object[$key_2] = $value_2;
            }
        }
        return $object;
    }
    public function normalize(mixed $data, ?string $format = null, array $context = []): array|string|int|float|bool|\ArrayObject|null
    {
        $dataArray = [];
        $dataArray['request_id'] = $data->getRequestId();
        $dataArray['timestamp'] = $data->getTimestamp()->format('Y-m-d\TH:i:sP');
        $dataArray['http_method'] = $data->getHttpMethod();
        $dataArray['http_path'] = $data->getHttpPath();
        $dataArray['http_status'] = $data->getHttpStatus();
        if ($data->isInitialized('durationMs') && null !== $data->getDurationMs()) {
            $dataArray['duration_ms'] = $data->getDurationMs();
        }
        if ($data->isInitialized('environment') && null !== $data->getEnvironment()) {
            $dataArray['environment'] = $data->getEnvironment();
        }
        if ($data->isInitialized('apiKeyId') && null !== $data->getApiKeyId()) {
            $dataArray['api_key_id'] = $data->getApiKeyId();
        }
        if ($data->isInitialized('errorCode') && null !== $data->getErrorCode()) {
            $dataArray['error_code'] = $data->getErrorCode();
        }
        if ($data->isInitialized('clientIp') && null !== $data->getClientIp()) {
            $dataArray['client_ip'] = $data->getClientIp();
        }
        if ($data->isInitialized('queryString') && null !== $data->getQueryString()) {
            $dataArray['query_string'] = $data->getQueryString();
        }
        if ($data->isInitialized('userAgent') && null !== $data->getUserAgent()) {
            $dataArray['user_agent'] = $data->getUserAgent();
        }
        if ($data->isInitialized('requestBody') && null !== $data->getRequestBody()) {
            $dataArray['request_body'] = $data->getRequestBody();
        }
        if ($data->isInitialized('responseBody') && null !== $data->getResponseBody()) {
            $dataArray['response_body'] = $data->getResponseBody();
        }
        if ($data->isInitialized('requestHeaders') && null !== $data->getRequestHeaders()) {
            $values = new \Lenorix\BeelSdk\Generated\Runtime\JsonObject();
            foreach ($data->getRequestHeaders() as $key => $value) {
                $values[$key] = $value;
            }
            $dataArray['request_headers'] = $values;
        }
        if ($data->isInitialized('responseHeaders') && null !== $data->getResponseHeaders()) {
            $values_1 = new \Lenorix\BeelSdk\Generated\Runtime\JsonObject();
            foreach ($data->getResponseHeaders() as $key_1 => $value_1) {
                $values_1[$key_1] = $value_1;
            }
            $dataArray['response_headers'] = $values_1;
        }
        foreach ($data->additionalPropertyEntries() as $key_2 => $value_2) {
            if (preg_match('/.*/', (string) $key_2)) {
                $dataArray[$key_2] = $value_2;
            }
        }
        return $dataArray;
    }
    public function getSupportedTypes(?string $format = null): array
    {
        return [\Lenorix\BeelSdk\Generated\Model\RequestLogDetail::class => false];
    }
}