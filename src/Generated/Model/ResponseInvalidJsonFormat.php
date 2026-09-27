<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;

class ResponseInvalidJsonFormat implements AdditionalPropertiesInterface
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
     * @var bool
     */
    protected $success;

    /**
     * @var ResponseInvalidJsonFormatError
     */
    protected $error;

    /**
     * @var ResponseMeta
     */
    protected $meta;

    /**
     * Stable URI that identifies the problem type and where the
     * integrator will find its documentation.
     *
     *
     * @var string
     */
    protected $type;

    /**
     * Short summary of the problem type. Stable between occurrences
     * of the same `type`.
     *
     *
     * @var string
     */
    protected $title;

    /**
     * Specific message for this occurrence, localized according to
     * `Accept-Language`. Matches the legacy `error.message`.
     *
     *
     * @var string
     */
    protected $detail;

    /**
     * URI that identifies the specific occurrence of the problem —
     * typically the path of the affected resource.
     *
     *
     * @var string
     */
    protected $instance;

    public function getSuccess(): bool
    {
        return $this->success;
    }

    public function setSuccess(bool $success): self
    {
        $this->initialized['success'] = true;
        $this->success = $success;

        return $this;
    }

    public function getError(): ResponseInvalidJsonFormatError
    {
        return $this->error;
    }

    public function setError(ResponseInvalidJsonFormatError $error): self
    {
        $this->initialized['error'] = true;
        $this->error = $error;

        return $this;
    }

    public function getMeta(): ResponseMeta
    {
        return $this->meta;
    }

    public function setMeta(ResponseMeta $meta): self
    {
        $this->initialized['meta'] = true;
        $this->meta = $meta;

        return $this;
    }

    /**
     * Stable URI that identifies the problem type and where the
     * integrator will find its documentation.
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * Stable URI that identifies the problem type and where the
    integrator will find its documentation.
     */
    public function setType(string $type): self
    {
        $this->initialized['type'] = true;
        $this->type = $type;

        return $this;
    }

    /**
     * Short summary of the problem type. Stable between occurrences
     * of the same `type`.
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * Short summary of the problem type. Stable between occurrences
    of the same `type`.
     */
    public function setTitle(string $title): self
    {
        $this->initialized['title'] = true;
        $this->title = $title;

        return $this;
    }

    /**
     * Specific message for this occurrence, localized according to
     * `Accept-Language`. Matches the legacy `error.message`.
     */
    public function getDetail(): string
    {
        return $this->detail;
    }

    /**
     * Specific message for this occurrence, localized according to
    `Accept-Language`. Matches the legacy `error.message`.
     */
    public function setDetail(string $detail): self
    {
        $this->initialized['detail'] = true;
        $this->detail = $detail;

        return $this;
    }

    /**
     * URI that identifies the specific occurrence of the problem —
     * typically the path of the affected resource.
     */
    public function getInstance(): string
    {
        return $this->instance;
    }

    /**
     * URI that identifies the specific occurrence of the problem —
    typically the path of the affected resource.
     */
    public function setInstance(string $instance): self
    {
        $this->initialized['instance'] = true;
        $this->instance = $instance;

        return $this;
    }

    public function definedProperties(): array
    {
        return ['success' => ['success', 'getSuccess', 'setSuccess'], 'error' => ['error', 'getError', 'setError'], 'meta' => ['meta', 'getMeta', 'setMeta'], 'type' => ['type', 'getType', 'setType'], 'title' => ['title', 'getTitle', 'setTitle'], 'detail' => ['detail', 'getDetail', 'setDetail'], 'instance' => ['instance', 'getInstance', 'setInstance']];
    }
}
