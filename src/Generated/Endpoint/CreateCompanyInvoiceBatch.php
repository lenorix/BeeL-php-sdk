<?php

namespace Lenorix\BeelSdk\Generated\Endpoint;

use Lenorix\BeelSdk\Generated\Exception\CreateCompanyInvoiceBatchBadRequestException;
use Lenorix\BeelSdk\Generated\Exception\CreateCompanyInvoiceBatchForbiddenException;
use Lenorix\BeelSdk\Generated\Exception\CreateCompanyInvoiceBatchInternalServerErrorException;
use Lenorix\BeelSdk\Generated\Exception\CreateCompanyInvoiceBatchTooManyRequestsException;
use Lenorix\BeelSdk\Generated\Exception\CreateCompanyInvoiceBatchUnauthorizedException;
use Lenorix\BeelSdk\Generated\Exception\CreateCompanyInvoiceBatchUnprocessableEntityException;
use Lenorix\BeelSdk\Generated\Model\BulkOperationResponse;
use Lenorix\BeelSdk\Generated\Model\CreateInvoiceBatchRequest;
use Lenorix\BeelSdk\Generated\Model\ErrorResponse;
use Lenorix\BeelSdk\Generated\Runtime\Client\BaseEndpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\Endpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\EndpointTrait;
use Lenorix\BeelSdk\Generated\Runtime\Client\JsonPayload;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Serializer\SerializerInterface;

class CreateCompanyInvoiceBatch extends BaseEndpoint implements Endpoint
{
    protected $company_id;

    /**
     * Applies one operation to a set of invoices of this company and reports, invoice by
     * invoice, which succeeded and which failed.
     *
     * - **Operations:** `ISSUE` issues the draft invoices; `STATUS` moves them to the
     *   `new_status` given in the body.
     * - **Limit:** up to 50 invoices per request (`invoice_ids`).
     * - **Not atomic:** each invoice is processed on its own, and since issuing is
     *   irreversible, the ones already issued stay issued if a later one fails.
     * - **Related:** downloading PDFs, sending email and exporting are not operations of this
     *   batch — use `…/invoices/pdf-archive`, `…/invoices/deliveries` and `…/invoices/exports`.
     *
     * @param  string  $companyId  Unique identifier (UUID) of the company the operation acts on — its identifier, not its NIF. It is the only source of context: the account that owns it is derived from it, and the `BeeL-Active-Company` header plays no part. A company you do not reach answers `403`, and so does a company that does not exist, so the existence of a company in another account is never disclosed.
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
    public function __construct(string $companyId, CreateInvoiceBatchRequest $requestBody, array $headerParameters = [])
    {
        $this->company_id = $companyId;
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
        return str_replace(['{company_id}'], [rawurlencode($this->company_id)], '/v1/companies/{company_id}/invoices/batches');
    }

    public function getBody(SerializerInterface $serializer, $streamFactory = null): array
    {
        if ($this->body instanceof CreateInvoiceBatchRequest) {
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
     * @return null|BulkOperationResponse|ErrorResponse
     *
     * @throws CreateCompanyInvoiceBatchBadRequestException
     * @throws CreateCompanyInvoiceBatchUnauthorizedException
     * @throws CreateCompanyInvoiceBatchForbiddenException
     * @throws CreateCompanyInvoiceBatchUnprocessableEntityException
     * @throws CreateCompanyInvoiceBatchTooManyRequestsException
     * @throws CreateCompanyInvoiceBatchInternalServerErrorException
     */
    protected function transformResponseBody(ResponseInterface $response, SerializerInterface $serializer, ?string $contentType = null)
    {
        $status = $response->getStatusCode();
        $body = (string) $response->getBody();
        if (is_null($contentType) === false && ($status === 200 && stripos(strtolower($contentType), 'application/json') !== false)) {
            return $serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\BulkOperationResponse', 'json');
        }
        if (is_null($contentType) === false && ($status === 400 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new CreateCompanyInvoiceBatchBadRequestException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ResponseInvalidJsonFormat', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 401 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new CreateCompanyInvoiceBatchUnauthorizedException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 403 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new CreateCompanyInvoiceBatchForbiddenException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 422 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new CreateCompanyInvoiceBatchUnprocessableEntityException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 429 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new CreateCompanyInvoiceBatchTooManyRequestsException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 500 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new CreateCompanyInvoiceBatchInternalServerErrorException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
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
