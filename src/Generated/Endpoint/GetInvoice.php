<?php

namespace Lenorix\BeelSdk\Generated\Endpoint;

class GetInvoice extends \Lenorix\BeelSdk\Generated\Runtime\Client\BaseEndpoint implements \Lenorix\BeelSdk\Generated\Runtime\Client\Endpoint
{
    protected $invoice_id;
    /**
    * Retrieves the full details of an invoice.
    *
    * - **Deprecated:** use `GET /v1/companies/{company_id}/invoices/{invoice_id}`, which
    *   behaves identically.
    *
    * **Retires on 9 December 2026.** See the [migration guide](https://docs.beel.es/changelog/resources-under-the-nif) for what moved where and what changes when you switch.
    *
    * @param string $invoiceId Invoice ID
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
    * } $headerParameters
    */
    public function __construct(string $invoiceId, array $headerParameters = [])
    {
        $this->invoice_id = $invoiceId;
        $this->headerParameters = $headerParameters;
    }
    use \Lenorix\BeelSdk\Generated\Runtime\Client\EndpointTrait;
    public function getMethod(): string
    {
        return 'GET';
    }
    public function getUri(): string
    {
        return str_replace(['{invoice_id}'], [rawurlencode($this->invoice_id)], '/v1/invoices/{invoice_id}');
    }
    public function getBody(\Symfony\Component\Serializer\SerializerInterface $serializer, $streamFactory = null): array
    {
        return [[], null];
    }
    public function getExtraHeaders(): array
    {
        return ['Accept' => ['application/json']];
    }
    protected function getHeadersOptionsResolver(): \Symfony\Component\OptionsResolver\OptionsResolver
    {
        $optionsResolver = parent::getHeadersOptionsResolver();
        $optionsResolver->setDefined(['BeeL-Active-Company']);
        $optionsResolver->setRequired([]);
        $optionsResolver->setDefaults([]);
        $optionsResolver->addAllowedTypes('BeeL-Active-Company', ['string']);
        return $optionsResolver;
    }
    /**
     * {@inheritdoc}
     *
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetInvoiceBadRequestException
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetInvoiceUnauthorizedException
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetInvoiceForbiddenException
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetInvoiceNotFoundException
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetInvoiceTooManyRequestsException
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetInvoiceInternalServerErrorException
     *
     * @return null|\Lenorix\BeelSdk\Generated\Model\V1InvoicesInvoiceIdGetResponse200|\Lenorix\BeelSdk\Generated\Model\ErrorResponse
     */
    protected function transformResponseBody(\Psr\Http\Message\ResponseInterface $response, \Symfony\Component\Serializer\SerializerInterface $serializer, ?string $contentType = null)
    {
        $status = $response->getStatusCode();
        $body = (string) $response->getBody();
        if (is_null($contentType) === false && (200 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            return $serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\V1InvoicesInvoiceIdGetResponse200', 'json');
        }
        if (is_null($contentType) === false && (400 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\GetInvoiceBadRequestException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && (401 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\GetInvoiceUnauthorizedException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && (403 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\GetInvoiceForbiddenException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && (404 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\GetInvoiceNotFoundException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && (429 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\GetInvoiceTooManyRequestsException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && (500 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\GetInvoiceInternalServerErrorException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
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