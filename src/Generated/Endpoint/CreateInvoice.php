<?php

namespace Lenorix\BeelSdk\Generated\Endpoint;

class CreateInvoice extends \Lenorix\BeelSdk\Generated\Runtime\Client\BaseEndpoint implements \Lenorix\BeelSdk\Generated\Runtime\Client\Endpoint
{
    /**
    * Creates an invoice, optionally numbered and issued in the same call with
    * `options.issue_directly: true`.
    *
    * - **Deprecated:** use `POST /v1/companies/{company_id}/invoices`, which behaves
    *   identically.
    *
    * **Retires on 9 December 2026.** See the [migration guide](https://docs.beel.es/changelog/resources-under-the-nif) for what moved where and what changes when you switch.
    *
    * @param \Lenorix\BeelSdk\Generated\Model\CreateInvoiceRequest $requestBody
    * @param array{
    *    "wait_for_pdf"?: bool, //Same flag as `options.wait_for_pdf`, accepted here too so both routes to a PDF take it
    in the same place — `POST /v1/invoices/{invoice_id}/issue` declares it as a query param
    and this one used to accept it only inside the body.
    
    Only applies when the invoice is issued in this call (`options.issue_directly: true`).
    If `true`, waits for PDF generation and returns the URL in the response (~1-3s). It is
    enough to ask for it in one of the two places.
    * } $queryParameters
    * @param array{
    *    "BeeL-Active-Company"?: string, //Which company (tax ID) the request operates on.
    
    An API key belongs to an account, and an account may hold several companies. Endpoints that
    read or write company-owned data — invoices, customers, products, series, tax and VeriFactu
    settings — resolve their target company from this header **when the path does not already
    name one**.
    
    On a path that names the company, such as `/v1/companies/{company_id}/invoices`, the path
    is the target and this header is not read at all: it neither switches the target nor makes
    the request fail, so sending one that disagrees with the path is silently ignored rather
    than rejected. Prefer those paths whenever you need to be explicit about which tax ID you
    are operating on.
    
    On an account holding a single company the header may be omitted — that company is used.
    On an account holding several it is required: the request fails with
    `403 ACTIVE_COMPANY_REQUIRED` otherwise. A company-owned record always belongs to one tax
    ID, so operating on it without saying which one has no meaning.
    
    The company does **not** have to belong to the API key's own account: one you manage works
    too, which is what makes the `company_id` returned by `POST /v1/accounts` usable here to
    invoice on a provisioned account's behalf. What you may do with it is then decided by your
    access level over that account, and issuing also requires a signed fiscal representation.
    
    This header is how you **operate** on a company, never how you find one: a value you do not
    reach answers `403`, the same as one that does not exist, so guessing reveals nothing. Get
    the `company_id` from the response that created the company.
    
    Requires the `companies:read` scope. Returns `403` if the company is neither yours nor one
    you manage.
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
    public function __construct(\Lenorix\BeelSdk\Generated\Model\CreateInvoiceRequest $requestBody, array $queryParameters = [], array $headerParameters = [])
    {
        $this->body = $requestBody;
        $this->queryParameters = $queryParameters;
        $this->headerParameters = $headerParameters;
    }
    use \Lenorix\BeelSdk\Generated\Runtime\Client\EndpointTrait;
    public function getMethod(): string
    {
        return 'POST';
    }
    public function getUri(): string
    {
        return '/v1/invoices';
    }
    public function getBody(\Symfony\Component\Serializer\SerializerInterface $serializer, $streamFactory = null): array
    {
        if ($this->body instanceof \Lenorix\BeelSdk\Generated\Model\CreateInvoiceRequest) {
            return [['Content-Type' => ['application/json']], \Lenorix\BeelSdk\Generated\Runtime\Client\JsonPayload::encode($serializer, $this->body)];
        }
        return [[], null];
    }
    public function getExtraHeaders(): array
    {
        return ['Accept' => ['application/json']];
    }
    protected function getQueryOptionsResolver(): \Symfony\Component\OptionsResolver\OptionsResolver
    {
        $optionsResolver = parent::getQueryOptionsResolver();
        $optionsResolver->setDefined(['wait_for_pdf']);
        $optionsResolver->setRequired([]);
        $optionsResolver->setDefaults(['wait_for_pdf' => false]);
        $optionsResolver->addAllowedTypes('wait_for_pdf', ['bool']);
        return $optionsResolver;
    }
    protected function getHeadersOptionsResolver(): \Symfony\Component\OptionsResolver\OptionsResolver
    {
        $optionsResolver = parent::getHeadersOptionsResolver();
        $optionsResolver->setDefined(['BeeL-Active-Company', 'Idempotency-Key']);
        $optionsResolver->setRequired([]);
        $optionsResolver->setDefaults([]);
        $optionsResolver->addAllowedTypes('BeeL-Active-Company', ['string']);
        $optionsResolver->addAllowedTypes('Idempotency-Key', ['string']);
        return $optionsResolver;
    }
    /**
     * {@inheritdoc}
     *
     * @throws \Lenorix\BeelSdk\Generated\Exception\CreateInvoiceBadRequestException
     * @throws \Lenorix\BeelSdk\Generated\Exception\CreateInvoiceUnauthorizedException
     * @throws \Lenorix\BeelSdk\Generated\Exception\CreateInvoiceForbiddenException
     * @throws \Lenorix\BeelSdk\Generated\Exception\CreateInvoiceConflictException
     * @throws \Lenorix\BeelSdk\Generated\Exception\CreateInvoiceUnprocessableEntityException
     * @throws \Lenorix\BeelSdk\Generated\Exception\CreateInvoiceTooManyRequestsException
     * @throws \Lenorix\BeelSdk\Generated\Exception\CreateInvoiceInternalServerErrorException
     *
     * @return null|\Lenorix\BeelSdk\Generated\Model\V1InvoicesPostResponse201|\Lenorix\BeelSdk\Generated\Model\ErrorResponse
     */
    protected function transformResponseBody(\Psr\Http\Message\ResponseInterface $response, \Symfony\Component\Serializer\SerializerInterface $serializer, ?string $contentType = null)
    {
        $status = $response->getStatusCode();
        $body = (string) $response->getBody();
        if (is_null($contentType) === false && (201 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            return $serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\V1InvoicesPostResponse201', 'json');
        }
        if (is_null($contentType) === false && (400 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\CreateInvoiceBadRequestException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ResponseInvalidJsonFormat', 'json'), $response);
        }
        if (is_null($contentType) === false && (401 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\CreateInvoiceUnauthorizedException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && (403 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\CreateInvoiceForbiddenException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && (409 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\CreateInvoiceConflictException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && (422 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\CreateInvoiceUnprocessableEntityException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && (429 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\CreateInvoiceTooManyRequestsException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && (500 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\CreateInvoiceInternalServerErrorException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
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