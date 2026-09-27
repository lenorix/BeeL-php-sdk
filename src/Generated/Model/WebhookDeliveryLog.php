<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;
class WebhookDeliveryLog implements AdditionalPropertiesInterface
{
    use AdditionalAndPatternProperties;
    /**
     * @var array
     */
    protected $initialized = [];
    public function isInitialized($property): bool
    {
        return array_key_exists($property, $this->initialized);
    }
    /**
     * @var string
     */
    protected $id;
    /**
     * @var string
     */
    protected $subscriptionId;
    /**
     * Groups all delivery attempts for the same logical event.
     *
     * @var string
     */
    protected $webhookEventId;
    /**
     * @var string
     */
    protected $eventType;
    /**
     * Sequential number of this POST within its delivery. Manual retries continue the same sequence, so this can exceed the 5 automatic attempts.
     *
     * @var int
     */
    protected $attemptNumber;
    /**
     * HTTP response status code. Null if connection failed.
     *
     * @var int|null
     */
    protected $httpStatus;
    /**
     * Body returned by your endpoint, kept for troubleshooting. Stored up to 2048 characters; longer responses are cut and `response_body_truncated` is true.
     *
     * @var string|null
     */
    protected $responseBody;
    /**
     * True when your endpoint returned more than 2048 characters and `response_body` holds only the beginning of it.
     *
     * @var bool
     */
    protected $responseBodyTruncated;
    /**
     * Length of the body your endpoint returned, before it was cut. Null for deliveries recorded before this field existed.
     *
     * @var int|null
     */
    protected $responseBodyLength;
    /**
     * Delivery duration in milliseconds.
     *
     * @var int|null
     */
    protected $durationMs;
    /**
     * @var bool
     */
    protected $success;
    /**
     * Error description for failed deliveries (timeout, connection error, etc.)
     *
     * @var string|null
     */
    protected $errorMessage;
    /**
     * The JSON payload that was sent (or attempted) to your endpoint.
     *
     * @var string|null
     */
    protected $payload;
    /**
     * HTTP headers sent to your endpoint with this delivery attempt.
     * Includes `BeeL-Signature`, `BeeL-Event`, `BeeL-Event-Id`, `BeeL-Delivery-Id`, and `Idempotency-Key`.
     * 
     *
     * @var array<string, string>|null
     */
    protected $requestHeaders;
    /**
     * @var \DateTime
     */
    protected $deliveredAt;
    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }
    /**
     * @param string $id
     *
     * @return self
     */
    public function setId(string $id): self
    {
        $this->initialized['id'] = true;
        $this->id = $id;
        return $this;
    }
    /**
     * @return string
     */
    public function getSubscriptionId(): string
    {
        return $this->subscriptionId;
    }
    /**
     * @param string $subscriptionId
     *
     * @return self
     */
    public function setSubscriptionId(string $subscriptionId): self
    {
        $this->initialized['subscriptionId'] = true;
        $this->subscriptionId = $subscriptionId;
        return $this;
    }
    /**
     * Groups all delivery attempts for the same logical event.
     *
     * @return string
     */
    public function getWebhookEventId(): string
    {
        return $this->webhookEventId;
    }
    /**
     * Groups all delivery attempts for the same logical event.
     *
     * @param string $webhookEventId
     *
     * @return self
     */
    public function setWebhookEventId(string $webhookEventId): self
    {
        $this->initialized['webhookEventId'] = true;
        $this->webhookEventId = $webhookEventId;
        return $this;
    }
    /**
     * @return string
     */
    public function getEventType(): string
    {
        return $this->eventType;
    }
    /**
     * @param string $eventType
     *
     * @return self
     */
    public function setEventType(string $eventType): self
    {
        $this->initialized['eventType'] = true;
        $this->eventType = $eventType;
        return $this;
    }
    /**
     * Sequential number of this POST within its delivery. Manual retries continue the same sequence, so this can exceed the 5 automatic attempts.
     *
     * @return int
     */
    public function getAttemptNumber(): int
    {
        return $this->attemptNumber;
    }
    /**
     * Sequential number of this POST within its delivery. Manual retries continue the same sequence, so this can exceed the 5 automatic attempts.
     *
     * @param int $attemptNumber
     *
     * @return self
     */
    public function setAttemptNumber(int $attemptNumber): self
    {
        $this->initialized['attemptNumber'] = true;
        $this->attemptNumber = $attemptNumber;
        return $this;
    }
    /**
     * HTTP response status code. Null if connection failed.
     *
     * @return int|null
     */
    public function getHttpStatus(): ?int
    {
        return $this->httpStatus;
    }
    /**
     * HTTP response status code. Null if connection failed.
     *
     * @param int|null $httpStatus
     *
     * @return self
     */
    public function setHttpStatus(?int $httpStatus): self
    {
        $this->initialized['httpStatus'] = true;
        $this->httpStatus = $httpStatus;
        return $this;
    }
    /**
     * Body returned by your endpoint, kept for troubleshooting. Stored up to 2048 characters; longer responses are cut and `response_body_truncated` is true.
     *
     * @return string|null
     */
    public function getResponseBody(): ?string
    {
        return $this->responseBody;
    }
    /**
     * Body returned by your endpoint, kept for troubleshooting. Stored up to 2048 characters; longer responses are cut and `response_body_truncated` is true.
     *
     * @param string|null $responseBody
     *
     * @return self
     */
    public function setResponseBody(?string $responseBody): self
    {
        $this->initialized['responseBody'] = true;
        $this->responseBody = $responseBody;
        return $this;
    }
    /**
     * True when your endpoint returned more than 2048 characters and `response_body` holds only the beginning of it.
     *
     * @return bool
     */
    public function getResponseBodyTruncated(): bool
    {
        return $this->responseBodyTruncated;
    }
    /**
     * True when your endpoint returned more than 2048 characters and `response_body` holds only the beginning of it.
     *
     * @param bool $responseBodyTruncated
     *
     * @return self
     */
    public function setResponseBodyTruncated(bool $responseBodyTruncated): self
    {
        $this->initialized['responseBodyTruncated'] = true;
        $this->responseBodyTruncated = $responseBodyTruncated;
        return $this;
    }
    /**
     * Length of the body your endpoint returned, before it was cut. Null for deliveries recorded before this field existed.
     *
     * @return int|null
     */
    public function getResponseBodyLength(): ?int
    {
        return $this->responseBodyLength;
    }
    /**
     * Length of the body your endpoint returned, before it was cut. Null for deliveries recorded before this field existed.
     *
     * @param int|null $responseBodyLength
     *
     * @return self
     */
    public function setResponseBodyLength(?int $responseBodyLength): self
    {
        $this->initialized['responseBodyLength'] = true;
        $this->responseBodyLength = $responseBodyLength;
        return $this;
    }
    /**
     * Delivery duration in milliseconds.
     *
     * @return int|null
     */
    public function getDurationMs(): ?int
    {
        return $this->durationMs;
    }
    /**
     * Delivery duration in milliseconds.
     *
     * @param int|null $durationMs
     *
     * @return self
     */
    public function setDurationMs(?int $durationMs): self
    {
        $this->initialized['durationMs'] = true;
        $this->durationMs = $durationMs;
        return $this;
    }
    /**
     * @return bool
     */
    public function getSuccess(): bool
    {
        return $this->success;
    }
    /**
     * @param bool $success
     *
     * @return self
     */
    public function setSuccess(bool $success): self
    {
        $this->initialized['success'] = true;
        $this->success = $success;
        return $this;
    }
    /**
     * Error description for failed deliveries (timeout, connection error, etc.)
     *
     * @return string|null
     */
    public function getErrorMessage(): ?string
    {
        return $this->errorMessage;
    }
    /**
     * Error description for failed deliveries (timeout, connection error, etc.)
     *
     * @param string|null $errorMessage
     *
     * @return self
     */
    public function setErrorMessage(?string $errorMessage): self
    {
        $this->initialized['errorMessage'] = true;
        $this->errorMessage = $errorMessage;
        return $this;
    }
    /**
     * The JSON payload that was sent (or attempted) to your endpoint.
     *
     * @return string|null
     */
    public function getPayload(): ?string
    {
        return $this->payload;
    }
    /**
     * The JSON payload that was sent (or attempted) to your endpoint.
     *
     * @param string|null $payload
     *
     * @return self
     */
    public function setPayload(?string $payload): self
    {
        $this->initialized['payload'] = true;
        $this->payload = $payload;
        return $this;
    }
    /**
     * HTTP headers sent to your endpoint with this delivery attempt.
     * Includes `BeeL-Signature`, `BeeL-Event`, `BeeL-Event-Id`, `BeeL-Delivery-Id`, and `Idempotency-Key`.
     * 
     *
     * @return array<string, string>|null
     */
    public function getRequestHeaders(): ?iterable
    {
        return $this->requestHeaders;
    }
    /**
    * HTTP headers sent to your endpoint with this delivery attempt.
    Includes `BeeL-Signature`, `BeeL-Event`, `BeeL-Event-Id`, `BeeL-Delivery-Id`, and `Idempotency-Key`.
    
    *
    * @param array<string, string>|null $requestHeaders
    *
    * @return self
    */
    public function setRequestHeaders(?iterable $requestHeaders): self
    {
        $this->initialized['requestHeaders'] = true;
        $this->requestHeaders = $requestHeaders;
        return $this;
    }
    /**
     * @return \DateTime
     */
    public function getDeliveredAt(): \DateTime
    {
        return $this->deliveredAt;
    }
    /**
     * @param \DateTime $deliveredAt
     *
     * @return self
     */
    public function setDeliveredAt(\DateTime $deliveredAt): self
    {
        $this->initialized['deliveredAt'] = true;
        $this->deliveredAt = $deliveredAt;
        return $this;
    }
    public function definedProperties(): array
    {
        return ['id' => ['id', 'getId', 'setId'], 'subscriptionId' => ['subscription_id', 'getSubscriptionId', 'setSubscriptionId'], 'webhookEventId' => ['webhook_event_id', 'getWebhookEventId', 'setWebhookEventId'], 'eventType' => ['event_type', 'getEventType', 'setEventType'], 'attemptNumber' => ['attempt_number', 'getAttemptNumber', 'setAttemptNumber'], 'httpStatus' => ['http_status', 'getHttpStatus', 'setHttpStatus'], 'responseBody' => ['response_body', 'getResponseBody', 'setResponseBody'], 'responseBodyTruncated' => ['response_body_truncated', 'getResponseBodyTruncated', 'setResponseBodyTruncated'], 'responseBodyLength' => ['response_body_length', 'getResponseBodyLength', 'setResponseBodyLength'], 'durationMs' => ['duration_ms', 'getDurationMs', 'setDurationMs'], 'success' => ['success', 'getSuccess', 'setSuccess'], 'errorMessage' => ['error_message', 'getErrorMessage', 'setErrorMessage'], 'payload' => ['payload', 'getPayload', 'setPayload'], 'requestHeaders' => ['request_headers', 'getRequestHeaders', 'setRequestHeaders'], 'deliveredAt' => ['delivered_at', 'getDeliveredAt', 'setDeliveredAt']];
    }
}