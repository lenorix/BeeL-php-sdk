<?php

namespace Lenorix\BeelSdk\Generated\Endpoint;

use Lenorix\BeelSdk\Generated\Exception\CreateCorrectiveInvoiceBadRequestException;
use Lenorix\BeelSdk\Generated\Exception\CreateCorrectiveInvoiceForbiddenException;
use Lenorix\BeelSdk\Generated\Exception\CreateCorrectiveInvoiceInternalServerErrorException;
use Lenorix\BeelSdk\Generated\Exception\CreateCorrectiveInvoiceNotFoundException;
use Lenorix\BeelSdk\Generated\Exception\CreateCorrectiveInvoiceTooManyRequestsException;
use Lenorix\BeelSdk\Generated\Exception\CreateCorrectiveInvoiceUnauthorizedException;
use Lenorix\BeelSdk\Generated\Exception\CreateCorrectiveInvoiceUnprocessableEntityException;
use Lenorix\BeelSdk\Generated\Model\CreateCorrectiveInvoiceRequest;
use Lenorix\BeelSdk\Generated\Model\V1InvoicesInvoiceIdCorrectivePostResponse201;
use Lenorix\BeelSdk\Generated\Runtime\Client\BaseEndpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\Endpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\EndpointTrait;
use Lenorix\BeelSdk\Generated\Runtime\Client\JsonPayload;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Serializer\SerializerInterface;

class CreateCorrectiveInvoice extends BaseEndpoint implements Endpoint
{
    protected $invoice_id;

    /**
     * Issues a corrective invoice that amends an issued invoice.
     *
     * - **Deprecated:** use `POST /v1/companies/{company_id}/invoices/{invoice_id}/corrective`,
     *   which behaves identically.
     * - **Rectification type:** a `TOTAL` rectification rectifies what is still invoiced on the
     *   original, its live correctives included, and leaves it `VOIDED`; a `PARTIAL` one leaves
     *   it `RECTIFIED` and may not take the base of any rate below zero
     *   (`422 CORRECTIVE_EXCEEDS_INVOICED_AMOUNT`).
     * - **Fiscal inheritance on a `PARTIAL`:** lines that omit `irpf_rate` or
     *   `equivalence_surcharge_rate` take them from the original invoice, not from the
     *   company's current tax profile; an ambiguous original fails with
     *   `422 CORRECTIVE_ORIGINAL_MIXED_IRPF` or `422 CORRECTIVE_ORIGINAL_MIXED_SURCHARGE`.
     *   The successor operation documents the rule in full.
     *
     * **Retires on 9 December 2026.** See the [migration guide](https://docs.beel.es/changelog/resources-under-the-nif) for what moved where and what changes when you switch.
     *
     * @param  string  $invoiceId  Invoice ID to rectify
     * @param array{
     *    "Idempotency-Key"?: string, //Idempotency key to prevent duplicates in sensitive operations.

    - Any unique client-generated string (e.g. an order id). A UUID also works but is not required
    - Allowed characters: letters, digits, `_` and `-` (max 255 chars)
    - Retrying with the same key replays the first response when it was a success (2xx) or a
     server error (5xx): same status and body, plus the header `Idempotency-Replay: true`.
     After a 5xx, check whether the operation took effect before retrying with a **new** key
    - A 4xx is not stored: the key is released, so the corrected request can reuse it
    - Stored responses expire 24 hours after processing

    The key is scoped per user and environment, and bound to the request body, so retrying after
    a network timeout replays the stored response instead of repeating the operation.

    | Status | Code | When |
    |---|---|---|
    | `400` | `INVALID_IDEMPOTENCY_KEY` | The key breaks the format rules above. |
    | `409` | `IDEMPOTENCY_KEY_PROCESSING` | The first request is still in flight. Wait for the `Retry-After` seconds (2) and retry with the same key. |
    | `409` | `IDEMPOTENCY_KEY_MISMATCH` | The key was already used with a **different** body. Use a new key. |
     * } $headerParameters
     */
    public function __construct(string $invoiceId, CreateCorrectiveInvoiceRequest $requestBody, array $headerParameters = [])
    {
        $this->invoice_id = $invoiceId;
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
        return str_replace(['{invoice_id}'], [rawurlencode($this->invoice_id)], '/v1/invoices/{invoice_id}/corrective');
    }

    public function getBody(SerializerInterface $serializer, $streamFactory = null): array
    {
        if ($this->body instanceof CreateCorrectiveInvoiceRequest) {
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
     * @return null|V1InvoicesInvoiceIdCorrectivePostResponse201
     *
     * @throws CreateCorrectiveInvoiceBadRequestException
     * @throws CreateCorrectiveInvoiceUnauthorizedException
     * @throws CreateCorrectiveInvoiceForbiddenException
     * @throws CreateCorrectiveInvoiceNotFoundException
     * @throws CreateCorrectiveInvoiceUnprocessableEntityException
     * @throws CreateCorrectiveInvoiceTooManyRequestsException
     * @throws CreateCorrectiveInvoiceInternalServerErrorException
     */
    protected function transformResponseBody(ResponseInterface $response, SerializerInterface $serializer, ?string $contentType = null)
    {
        $status = $response->getStatusCode();
        $body = (string) $response->getBody();
        if (is_null($contentType) === false && ($status === 201 && stripos(strtolower($contentType), 'application/json') !== false)) {
            return $serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\V1InvoicesInvoiceIdCorrectivePostResponse201', 'json');
        }
        if (is_null($contentType) === false && ($status === 400 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new CreateCorrectiveInvoiceBadRequestException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 401 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new CreateCorrectiveInvoiceUnauthorizedException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 403 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new CreateCorrectiveInvoiceForbiddenException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 404 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new CreateCorrectiveInvoiceNotFoundException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 422 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new CreateCorrectiveInvoiceUnprocessableEntityException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 429 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new CreateCorrectiveInvoiceTooManyRequestsException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 500 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new CreateCorrectiveInvoiceInternalServerErrorException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
    }

    public function getAuthenticationScopes(): array
    {
        return ['ApiKeyAuth'];
    }
}
