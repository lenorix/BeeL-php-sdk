<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;
class WebhookTestResult implements AdditionalPropertiesInterface
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
     * Whether your endpoint responded with HTTP 2xx.
     *
     * @var bool
     */
    protected $deliverySuccess;
    /**
     * HTTP status code returned by your endpoint. Null if the connection failed.
     *
     * @var int|null
     */
    protected $httpStatus;
    /**
     * Round-trip time in milliseconds.
     *
     * @var int
     */
    protected $durationMs;
    /**
     * Error message if the delivery failed (timeout, DNS, etc.).
     *
     * @var string|null
     */
    protected $error;
    /**
     * Why the delivery failed, as a stable code. Absent when `delivery_success` is true. Branch on this, never on the wording of `error`.
     * 
     *
     * @var string
     */
    protected $failureCause;
    /**
     * Whether your endpoint responded with HTTP 2xx.
     *
     * @return bool
     */
    public function getDeliverySuccess(): bool
    {
        return $this->deliverySuccess;
    }
    /**
     * Whether your endpoint responded with HTTP 2xx.
     *
     * @param bool $deliverySuccess
     *
     * @return self
     */
    public function setDeliverySuccess(bool $deliverySuccess): self
    {
        $this->initialized['deliverySuccess'] = true;
        $this->deliverySuccess = $deliverySuccess;
        return $this;
    }
    /**
     * HTTP status code returned by your endpoint. Null if the connection failed.
     *
     * @return int|null
     */
    public function getHttpStatus(): ?int
    {
        return $this->httpStatus;
    }
    /**
     * HTTP status code returned by your endpoint. Null if the connection failed.
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
     * Round-trip time in milliseconds.
     *
     * @return int
     */
    public function getDurationMs(): int
    {
        return $this->durationMs;
    }
    /**
     * Round-trip time in milliseconds.
     *
     * @param int $durationMs
     *
     * @return self
     */
    public function setDurationMs(int $durationMs): self
    {
        $this->initialized['durationMs'] = true;
        $this->durationMs = $durationMs;
        return $this;
    }
    /**
     * Error message if the delivery failed (timeout, DNS, etc.).
     *
     * @return string|null
     */
    public function getError(): ?string
    {
        return $this->error;
    }
    /**
     * Error message if the delivery failed (timeout, DNS, etc.).
     *
     * @param string|null $error
     *
     * @return self
     */
    public function setError(?string $error): self
    {
        $this->initialized['error'] = true;
        $this->error = $error;
        return $this;
    }
    /**
     * Why the delivery failed, as a stable code. Absent when `delivery_success` is true. Branch on this, never on the wording of `error`.
     * 
     *
     * @return string
     */
    public function getFailureCause(): string
    {
        return $this->failureCause;
    }
    /**
     * Why the delivery failed, as a stable code. Absent when `delivery_success` is true. Branch on this, never on the wording of `error`.
     *
     * @param string $failureCause
     *
     * @return self
     */
    public function setFailureCause(string $failureCause): self
    {
        $this->initialized['failureCause'] = true;
        $this->failureCause = $failureCause;
        return $this;
    }
    public function definedProperties(): array
    {
        return ['deliverySuccess' => ['delivery_success', 'getDeliverySuccess', 'setDeliverySuccess'], 'httpStatus' => ['http_status', 'getHttpStatus', 'setHttpStatus'], 'durationMs' => ['duration_ms', 'getDurationMs', 'setDurationMs'], 'error' => ['error', 'getError', 'setError'], 'failureCause' => ['failure_cause', 'getFailureCause', 'setFailureCause']];
    }
}