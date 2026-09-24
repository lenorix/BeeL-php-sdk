<?php

namespace Lenorix\BeelSdk\Generated\Endpoint;

use Lenorix\BeelSdk\Generated\Exception\GetEmailDeliveryForbiddenException;
use Lenorix\BeelSdk\Generated\Exception\GetEmailDeliveryInternalServerErrorException;
use Lenorix\BeelSdk\Generated\Exception\GetEmailDeliveryNotFoundException;
use Lenorix\BeelSdk\Generated\Exception\GetEmailDeliveryUnauthorizedException;
use Lenorix\BeelSdk\Generated\Model\EmailDeliveryDetailResponse;
use Lenorix\BeelSdk\Generated\Model\ErrorResponse;
use Lenorix\BeelSdk\Generated\Runtime\Client\BaseEndpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\Endpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\EndpointTrait;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\Serializer\SerializerInterface;

class GetEmailDelivery extends BaseEndpoint implements Endpoint
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
     * @param  string  $emailId  Email delivery id
     */
    public function __construct(string $emailId)
    {
        $this->email_id = $emailId;
    }

    use EndpointTrait;

    public function getMethod(): string
    {
        return 'GET';
    }

    public function getUri(): string
    {
        return str_replace(['{email_id}'], [rawurlencode($this->email_id)], '/v1/emails/{email_id}');
    }

    public function getBody(SerializerInterface $serializer, $streamFactory = null): array
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
     *
     * @return null|EmailDeliveryDetailResponse|ErrorResponse
     *
     * @throws GetEmailDeliveryUnauthorizedException
     * @throws GetEmailDeliveryForbiddenException
     * @throws GetEmailDeliveryNotFoundException
     * @throws GetEmailDeliveryInternalServerErrorException
     */
    protected function transformResponseBody(ResponseInterface $response, SerializerInterface $serializer, ?string $contentType = null)
    {
        $status = $response->getStatusCode();
        $body = (string) $response->getBody();
        if (is_null($contentType) === false && ($status === 200 && stripos(strtolower($contentType), 'application/json') !== false)) {
            return $serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\EmailDeliveryDetailResponse', 'json');
        }
        if (is_null($contentType) === false && ($status === 401 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new GetEmailDeliveryUnauthorizedException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 403 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new GetEmailDeliveryForbiddenException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 404 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new GetEmailDeliveryNotFoundException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 500 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new GetEmailDeliveryInternalServerErrorException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
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
