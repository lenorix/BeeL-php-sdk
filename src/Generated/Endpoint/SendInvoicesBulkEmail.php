<?php

namespace Lenorix\BeelSdk\Generated\Endpoint;

use Lenorix\BeelSdk\Generated\Exception\SendInvoicesBulkEmailBadRequestException;
use Lenorix\BeelSdk\Generated\Exception\SendInvoicesBulkEmailForbiddenException;
use Lenorix\BeelSdk\Generated\Exception\SendInvoicesBulkEmailInternalServerErrorException;
use Lenorix\BeelSdk\Generated\Exception\SendInvoicesBulkEmailTooManyRequestsException;
use Lenorix\BeelSdk\Generated\Exception\SendInvoicesBulkEmailUnauthorizedException;
use Lenorix\BeelSdk\Generated\Exception\SendInvoicesBulkEmailUnprocessableEntityException;
use Lenorix\BeelSdk\Generated\Model\ErrorResponse;
use Lenorix\BeelSdk\Generated\Model\V1InvoicesBulkSendPostBody;
use Lenorix\BeelSdk\Generated\Model\V1InvoicesBulkSendPostResponse200;
use Lenorix\BeelSdk\Generated\Runtime\Client\BaseEndpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\Endpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\EndpointTrait;
use Lenorix\BeelSdk\Generated\Runtime\Client\JsonPayload;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Serializer\SerializerInterface;

class SendInvoicesBulkEmail extends BaseEndpoint implements Endpoint
{
    /**
     * Sends one email carrying the PDFs of the requested invoices as attachments.
     *
     * - **Deprecated:** use `POST /v1/companies/{company_id}/invoices/deliveries`, which sends
     *   the same email from the same body, with `recipients` declared as required there.
     * - **Limits:** up to 200 invoices per call, and the attachments are capped at 25MB.
     * - **Eligible invoices:** only invoices in `ISSUED`, `SENT`, `PAID` or `OVERDUE` can be
     *   sent.
     * - **Partial failures:** invoices whose PDF cannot be attached are reported in `failures`
     *   and the message is still sent with the rest.
     *
     * **Retires on 9 December 2026.** See the [migration guide](https://docs.beel.es/changelog/resources-under-the-nif) for what moved where and what changes when you switch.
     *
     * @param array{
     *    "Idempotency-Key"?: string, //Idempotency key to prevent duplicates in sensitive operations.

    - Any unique client-generated string (e.g. an order id). A UUID also works but is not required
    - Allowed characters: letters, digits, `_` and `-` (max 255 chars)
    - If the same key is sent twice, the result of the first operation is returned
    - Keys expire 24 hours after processing

    The key is scoped per user and environment, and bound to the request body, so retrying after
    a network timeout replays the stored response instead of repeating the operation.

    | Status | Code | When |
    |---|---|---|
    | `400` | `INVALID_IDEMPOTENCY_KEY` | The key breaks the format rules above. |
    | `409` | `IDEMPOTENCY_KEY_PROCESSING` | The first request is still in flight. Wait and retry with the same key. |
    | `409` | `IDEMPOTENCY_KEY_MISMATCH` | The key was already used with a **different** body. Use a new key. |
     * } $headerParameters
     */
    public function __construct(V1InvoicesBulkSendPostBody $requestBody, array $headerParameters = [])
    {
        $this->body = $requestBody;
        $this->headerParameters = $headerParameters;
    }

    use EndpointTrait;

    public function getMethod(): string
    {
        return 'POST';
    }

    public function getUri(): string
    {
        return '/v1/invoices/bulk/send';
    }

    public function getBody(SerializerInterface $serializer, $streamFactory = null): array
    {
        if ($this->body instanceof V1InvoicesBulkSendPostBody) {
            return [['Content-Type' => ['application/json']], JsonPayload::encode($serializer, $this->body)];
        }

        return [[], null];
    }

    public function getExtraHeaders(): array
    {
        return ['Accept' => ['application/json']];
    }

    protected function getHeadersOptionsResolver(): OptionsResolver
    {
        $optionsResolver = parent::getHeadersOptionsResolver();
        $optionsResolver->setDefined(['Idempotency-Key']);
        $optionsResolver->setRequired([]);
        $optionsResolver->setDefaults([]);
        $optionsResolver->addAllowedTypes('Idempotency-Key', ['string']);

        return $optionsResolver;
    }

    /**
     * {@inheritdoc}
     *
     *
     * @return null|V1InvoicesBulkSendPostResponse200|ErrorResponse
     *
     * @throws SendInvoicesBulkEmailBadRequestException
     * @throws SendInvoicesBulkEmailUnauthorizedException
     * @throws SendInvoicesBulkEmailForbiddenException
     * @throws SendInvoicesBulkEmailUnprocessableEntityException
     * @throws SendInvoicesBulkEmailTooManyRequestsException
     * @throws SendInvoicesBulkEmailInternalServerErrorException
     */
    protected function transformResponseBody(ResponseInterface $response, SerializerInterface $serializer, ?string $contentType = null)
    {
        $status = $response->getStatusCode();
        $body = (string) $response->getBody();
        if (is_null($contentType) === false && ($status === 200 && stripos(strtolower($contentType), 'application/json') !== false)) {
            return $serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\V1InvoicesBulkSendPostResponse200', 'json');
        }
        if (is_null($contentType) === false && ($status === 400 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new SendInvoicesBulkEmailBadRequestException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 401 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new SendInvoicesBulkEmailUnauthorizedException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 403 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new SendInvoicesBulkEmailForbiddenException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 422 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new SendInvoicesBulkEmailUnprocessableEntityException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 429 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new SendInvoicesBulkEmailTooManyRequestsException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 500 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new SendInvoicesBulkEmailInternalServerErrorException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
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
