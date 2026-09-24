<?php

namespace Lenorix\BeelSdk\Generated\Endpoint;

use Lenorix\BeelSdk\Generated\Exception\GetAccountEmailDeliveryBadRequestException;
use Lenorix\BeelSdk\Generated\Exception\GetAccountEmailDeliveryForbiddenException;
use Lenorix\BeelSdk\Generated\Exception\GetAccountEmailDeliveryInternalServerErrorException;
use Lenorix\BeelSdk\Generated\Exception\GetAccountEmailDeliveryNotFoundException;
use Lenorix\BeelSdk\Generated\Exception\GetAccountEmailDeliveryTooManyRequestsException;
use Lenorix\BeelSdk\Generated\Exception\GetAccountEmailDeliveryUnauthorizedException;
use Lenorix\BeelSdk\Generated\Model\EmailDeliveryDetailResponse;
use Lenorix\BeelSdk\Generated\Model\ErrorResponse;
use Lenorix\BeelSdk\Generated\Runtime\Client\BaseEndpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\Endpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\EndpointTrait;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\Serializer\SerializerInterface;

class GetAccountEmailDelivery extends BaseEndpoint implements Endpoint
{
    protected $account_id;

    protected $email_id;

    /**
     * Returns one recorded email with its message body (HTML and plain text), its attachments
     * and, for batch emails, the invoices it carried.
     *
     * - **`body_available`:** the body is fetched live and is only available while the message
     *   has a provider message id and the provider still retains it; otherwise it is `false` and
     *   `html_body` / `text_body` are `null`.
     * - **An email that never left:** `QUEUED` or `REJECTED`, it has no body for that reason.
     *
     * @param  string  $accountId  Your own account, or an account you provisioned. It — not the credential — decides which account the operation acts on; a `403` is returned when you do not reach it, the same response an account that does not exist gets.
     * @param  string  $emailId  Email delivery id
     */
    public function __construct(string $accountId, string $emailId)
    {
        $this->account_id = $accountId;
        $this->email_id = $emailId;
    }

    use EndpointTrait;

    public function getMethod(): string
    {
        return 'GET';
    }

    public function getUri(): string
    {
        return str_replace(['{account_id}', '{email_id}'], [rawurlencode($this->account_id), rawurlencode($this->email_id)], '/v1/accounts/{account_id}/emails/{email_id}');
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
     * @throws GetAccountEmailDeliveryBadRequestException
     * @throws GetAccountEmailDeliveryUnauthorizedException
     * @throws GetAccountEmailDeliveryForbiddenException
     * @throws GetAccountEmailDeliveryNotFoundException
     * @throws GetAccountEmailDeliveryTooManyRequestsException
     * @throws GetAccountEmailDeliveryInternalServerErrorException
     */
    protected function transformResponseBody(ResponseInterface $response, SerializerInterface $serializer, ?string $contentType = null)
    {
        $status = $response->getStatusCode();
        $body = (string) $response->getBody();
        if (is_null($contentType) === false && ($status === 200 && stripos(strtolower($contentType), 'application/json') !== false)) {
            return $serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\EmailDeliveryDetailResponse', 'json');
        }
        if (is_null($contentType) === false && ($status === 400 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new GetAccountEmailDeliveryBadRequestException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 401 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new GetAccountEmailDeliveryUnauthorizedException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 403 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new GetAccountEmailDeliveryForbiddenException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 404 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new GetAccountEmailDeliveryNotFoundException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 429 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new GetAccountEmailDeliveryTooManyRequestsException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 500 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new GetAccountEmailDeliveryInternalServerErrorException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
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
