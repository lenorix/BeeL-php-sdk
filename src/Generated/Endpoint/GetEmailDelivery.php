<?php

namespace Lenorix\BeelSdk\Generated\Endpoint;

class GetEmailDelivery extends \Lenorix\BeelSdk\Generated\Runtime\Client\BaseEndpoint implements \Lenorix\BeelSdk\Generated\Runtime\Client\Endpoint
{
    protected $email_id;
    /**
     * Returns one recorded email with its message body (HTML and plain text), its attachments
     * and, for batch emails, the invoices it carried.
     *
     * - **`body_available`:** the body is fetched live and is only available while the message
     *   has a provider message id and the provider still retains it; otherwise it is `false` and
     *   `html_body` / `text_body` are `null`.
     * - **An email that never left:** `QUEUED` or `REJECTED`, it has no body for that reason.
     * - **Deprecated:** use `GET /v1/accounts/{account_id}/emails/{email_id}`, which behaves
     *   identically.
     *
     * **Retires on 9 December 2026.** See the [migration guide](https://docs.beel.es/changelog/resources-under-the-nif) for what moved where and what changes when you switch.
     *
     * @param string $emailId Email delivery id
     */
    public function __construct(string $emailId)
    {
        $this->email_id = $emailId;
    }
    use \Lenorix\BeelSdk\Generated\Runtime\Client\EndpointTrait;
    public function getMethod(): string
    {
        return 'GET';
    }
    public function getUri(): string
    {
        return str_replace(['{email_id}'], [rawurlencode($this->email_id)], '/v1/emails/{email_id}');
    }
    public function getBody(\Symfony\Component\Serializer\SerializerInterface $serializer, $streamFactory = null): array
    {
        return [[], null];
    }
    public function getExtraHeaders(): array
    {
        return ['Accept' => ['application/json']];
    }
    /**
     * {@inheritdoc}
     *
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetEmailDeliveryUnauthorizedException
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetEmailDeliveryForbiddenException
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetEmailDeliveryNotFoundException
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetEmailDeliveryInternalServerErrorException
     *
     * @return null|\Lenorix\BeelSdk\Generated\Model\EmailDeliveryDetailResponse|\Lenorix\BeelSdk\Generated\Model\ErrorResponse
     */
    protected function transformResponseBody(\Psr\Http\Message\ResponseInterface $response, \Symfony\Component\Serializer\SerializerInterface $serializer, ?string $contentType = null)
    {
        $status = $response->getStatusCode();
        $body = (string) $response->getBody();
        if (is_null($contentType) === false && (200 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            return $serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\EmailDeliveryDetailResponse', 'json');
        }
        if (is_null($contentType) === false && (401 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\GetEmailDeliveryUnauthorizedException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && (403 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\GetEmailDeliveryForbiddenException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && (404 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\GetEmailDeliveryNotFoundException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && (500 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\GetEmailDeliveryInternalServerErrorException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (stripos(strtolower($contentType), 'application/json') !== false) {
            return $serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json');
        }
    }
    public function getAuthenticationScopes(): array
    {
        return ['ApiKeyAuth'];
    }
}