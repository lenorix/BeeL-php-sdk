<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;
class EmailDeliveryDetailResponse implements AdditionalPropertiesInterface
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
     * Detail of one recorded email, including the message content
     * (HTML / text body) retrieved live from the email provider.
     * 
     * The body is only available for emails with a provider id
     * (`external_message_id`) and while the provider retains it; when it
     * cannot be retrieved, `body_available` is `false` and the bodies are null.
     * 
     *
     * @var EmailDeliveryDetail
     */
    protected $data;
    /**
     * @var ResponseMeta
     */
    protected $meta;
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
     * Detail of one recorded email, including the message content
     * (HTML / text body) retrieved live from the email provider.
     * 
     * The body is only available for emails with a provider id
     * (`external_message_id`) and while the provider retains it; when it
     * cannot be retrieved, `body_available` is `false` and the bodies are null.
     * 
     *
     * @return EmailDeliveryDetail
     */
    public function getData(): EmailDeliveryDetail
    {
        return $this->data;
    }
    /**
    * Detail of one recorded email, including the message content
    (HTML / text body) retrieved live from the email provider.
    
    The body is only available for emails with a provider id
    (`external_message_id`) and while the provider retains it; when it
    cannot be retrieved, `body_available` is `false` and the bodies are null.
    
    *
    * @param EmailDeliveryDetail $data
    *
    * @return self
    */
    public function setData(EmailDeliveryDetail $data): self
    {
        $this->initialized['data'] = true;
        $this->data = $data;
        return $this;
    }
    /**
     * @return ResponseMeta
     */
    public function getMeta(): ResponseMeta
    {
        return $this->meta;
    }
    /**
     * @param ResponseMeta $meta
     *
     * @return self
     */
    public function setMeta(ResponseMeta $meta): self
    {
        $this->initialized['meta'] = true;
        $this->meta = $meta;
        return $this;
    }
    public function definedProperties(): array
    {
        return ['success' => ['success', 'getSuccess', 'setSuccess'], 'data' => ['data', 'getData', 'setData'], 'meta' => ['meta', 'getMeta', 'setMeta']];
    }
}