<?php

namespace Lenorix\BeelSdk\Generated\Endpoint;

class CreateCompanySimplifiedExchange extends \Lenorix\BeelSdk\Generated\Runtime\Client\BaseEndpoint implements \Lenorix\BeelSdk\Generated\Runtime\Client\Endpoint
{
    protected $company_id;
    /**
    * Issues a full invoice in exchange for one or more simplified invoices already issued, when
    * the customer asks for an invoice with their details. It is not a corrective invoice: it
    * documents the same operations again with the recipient identified (RD 1619/2012, art. 15.6).
    *
    * - **What it issues:** a `STANDARD` invoice with the lines of the simplified invoices and
    *   the `recipient` sent, numbered in `series_id` or in the company's default standard series.
    *   It lists the invoices it replaces in `replaced_invoice_ids`.
    * - **The simplified invoices:** each becomes `VOIDED` with `void_cause` `EXCHANGED`, in the
    *   same act: their records are not cancelled, the exchange replaces them. They must be
    *   simplified invoices (`422 EXCHANGE_REQUIRES_SIMPLIFIED`), issued and not voided,
    *   exchanged or corrected before (`422 SIMPLIFIED_NOT_EXCHANGEABLE`), and each one listed
    *   once in `simplified_invoice_ids` (`422 EXCHANGE_DUPLICATED_SIMPLIFIED`, before anything
    *   is read or numbered).
    * - **The exchange invoice** cannot be voided afterwards (`422 EXCHANGE_INVOICE_NOT_VOIDABLE`),
    *   and when it is recorded as `F3` it cannot be corrected yet (see the corrective operation).
    * - **VeriFactu:** the exchange invoice is recorded as `F3`, identifying each simplified
    *   invoice it replaces by number and issue date. Each of them must already be accepted by
    *   the AEAT, or nothing is issued: one issued without VeriFactu fails with
    *   `422 SIMPLIFIED_EXCHANGE_NOT_RECORDABLE`; one whose record is still pending fails with
    *   `422 EXCHANGE_SIMPLIFIED_NOT_YET_ACCEPTED` (wait until the AEAT accepts it and retry);
    *   one whose record was rejected fails with `422 EXCHANGE_SIMPLIFIED_RECORD_REJECTED` (fix
    *   or resubmit it first).
    *
    * @param string $companyId Unique identifier (UUID) of the company the operation acts on — its identifier, not its NIF. It is the only source of context: the account that owns it is derived from it, and the `BeeL-Active-Company` header plays no part. A company you do not reach answers `403`, and so does a company that does not exist, so the existence of a company in another account is never disclosed.
    * @param \Lenorix\BeelSdk\Generated\Model\CreateSimplifiedExchangeRequest $requestBody
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
    public function __construct(string $companyId, \Lenorix\BeelSdk\Generated\Model\CreateSimplifiedExchangeRequest $requestBody, array $headerParameters = [])
    {
        $this->company_id = $companyId;
        $this->body = $requestBody;
        $this->headerParameters = $headerParameters;
    }
    use \Lenorix\BeelSdk\Generated\Runtime\Client\EndpointTrait;
    public function getMethod(): string
    {
        return 'POST';
    }
    public function getUri(): string
    {
        return str_replace(['{company_id}'], [rawurlencode($this->company_id)], '/v1/companies/{company_id}/invoices/simplified-exchanges');
    }
    public function getBody(\Symfony\Component\Serializer\SerializerInterface $serializer, $streamFactory = null): array
    {
        if ($this->body instanceof \Lenorix\BeelSdk\Generated\Model\CreateSimplifiedExchangeRequest) {
            return [['Content-Type' => ['application/json']], \Lenorix\BeelSdk\Generated\Runtime\Client\JsonPayload::encode($serializer, $this->body)];
        }
        return [[], null];
    }
    public function getExtraHeaders(): array
    {
        return ['Accept' => ['application/json']];
    }
    protected function getHeadersOptionsResolver(): \Symfony\Component\OptionsResolver\OptionsResolver
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
     * @throws \Lenorix\BeelSdk\Generated\Exception\CreateCompanySimplifiedExchangeBadRequestException
     * @throws \Lenorix\BeelSdk\Generated\Exception\CreateCompanySimplifiedExchangeUnauthorizedException
     * @throws \Lenorix\BeelSdk\Generated\Exception\CreateCompanySimplifiedExchangeForbiddenException
     * @throws \Lenorix\BeelSdk\Generated\Exception\CreateCompanySimplifiedExchangeNotFoundException
     * @throws \Lenorix\BeelSdk\Generated\Exception\CreateCompanySimplifiedExchangeUnprocessableEntityException
     * @throws \Lenorix\BeelSdk\Generated\Exception\CreateCompanySimplifiedExchangeTooManyRequestsException
     * @throws \Lenorix\BeelSdk\Generated\Exception\CreateCompanySimplifiedExchangeInternalServerErrorException
     *
     * @return null|\Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdInvoicesSimplifiedExchangesPostResponse201|\Lenorix\BeelSdk\Generated\Model\ErrorResponse
     */
    protected function transformResponseBody(\Psr\Http\Message\ResponseInterface $response, \Symfony\Component\Serializer\SerializerInterface $serializer, ?string $contentType = null)
    {
        $status = $response->getStatusCode();
        $body = (string) $response->getBody();
        if (is_null($contentType) === false && (201 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            return $serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdInvoicesSimplifiedExchangesPostResponse201', 'json');
        }
        if (is_null($contentType) === false && (400 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\CreateCompanySimplifiedExchangeBadRequestException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ResponseInvalidJsonFormat', 'json'), $response);
        }
        if (is_null($contentType) === false && (401 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\CreateCompanySimplifiedExchangeUnauthorizedException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && (403 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\CreateCompanySimplifiedExchangeForbiddenException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && (404 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\CreateCompanySimplifiedExchangeNotFoundException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && (422 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\CreateCompanySimplifiedExchangeUnprocessableEntityException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && (429 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\CreateCompanySimplifiedExchangeTooManyRequestsException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && (500 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\CreateCompanySimplifiedExchangeInternalServerErrorException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
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