<?php

namespace Lenorix\BeelSdk\Generated\Endpoint;

use Lenorix\BeelSdk\Generated\Exception\UpdateInvoiceBadRequestException;
use Lenorix\BeelSdk\Generated\Exception\UpdateInvoiceForbiddenException;
use Lenorix\BeelSdk\Generated\Exception\UpdateInvoiceInternalServerErrorException;
use Lenorix\BeelSdk\Generated\Exception\UpdateInvoiceNotFoundException;
use Lenorix\BeelSdk\Generated\Exception\UpdateInvoiceTooManyRequestsException;
use Lenorix\BeelSdk\Generated\Exception\UpdateInvoiceUnauthorizedException;
use Lenorix\BeelSdk\Generated\Exception\UpdateInvoiceUnprocessableEntityException;
use Lenorix\BeelSdk\Generated\Model\ErrorResponse;
use Lenorix\BeelSdk\Generated\Model\UpdateInvoiceRequest;
use Lenorix\BeelSdk\Generated\Model\V1InvoicesInvoiceIdPutResponse200;
use Lenorix\BeelSdk\Generated\Runtime\Client\BaseEndpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\Endpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\EndpointTrait;
use Lenorix\BeelSdk\Generated\Runtime\Client\JsonPayload;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Serializer\SerializerInterface;

class UpdateInvoice extends BaseEndpoint implements Endpoint
{
    protected $invoice_id;

    /**
     * Updates a draft invoice. Only invoices in `DRAFT` status can be modified.
     *
     * - **Deprecated:** use `PATCH /v1/companies/{company_id}/invoices/{invoice_id}`, the single
     *   update verb of the canonical form.
     * - **Difference:** only the verb changes. Both update just the fields present in the body
     *   and leave every other one untouched.
     *
     * **Retires on 9 December 2026.** See the [migration guide](https://docs.beel.es/changelog/resources-under-the-nif) for what moved where and what changes when you switch.
     *
     * @param  string  $invoiceId  Invoice ID
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
    public function __construct(string $invoiceId, UpdateInvoiceRequest $requestBody, array $headerParameters = [])
    {
        $this->invoice_id = $invoiceId;
        $this->body = $requestBody;
        $this->headerParameters = $headerParameters;
    }

    use EndpointTrait;

    public function getMethod(): string
    {
        return 'PUT';
    }

    public function getUri(): string
    {
        return str_replace(['{invoice_id}'], [rawurlencode($this->invoice_id)], '/v1/invoices/{invoice_id}');
    }

    public function getBody(SerializerInterface $serializer, $streamFactory = null): array
    {
        if ($this->body instanceof UpdateInvoiceRequest) {
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
        $optionsResolver->setDefined(['BeeL-Active-Company']);
        $optionsResolver->setRequired([]);
        $optionsResolver->setDefaults([]);
        $optionsResolver->addAllowedTypes('BeeL-Active-Company', ['string']);

        return $optionsResolver;
    }

    /**
     * {@inheritdoc}
     *
     *
     * @return null|V1InvoicesInvoiceIdPutResponse200|ErrorResponse
     *
     * @throws UpdateInvoiceBadRequestException
     * @throws UpdateInvoiceUnauthorizedException
     * @throws UpdateInvoiceForbiddenException
     * @throws UpdateInvoiceNotFoundException
     * @throws UpdateInvoiceUnprocessableEntityException
     * @throws UpdateInvoiceTooManyRequestsException
     * @throws UpdateInvoiceInternalServerErrorException
     */
    protected function transformResponseBody(ResponseInterface $response, SerializerInterface $serializer, ?string $contentType = null)
    {
        $status = $response->getStatusCode();
        $body = (string) $response->getBody();
        if (is_null($contentType) === false && ($status === 200 && stripos(strtolower($contentType), 'application/json') !== false)) {
            return $serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\V1InvoicesInvoiceIdPutResponse200', 'json');
        }
        if (is_null($contentType) === false && ($status === 400 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new UpdateInvoiceBadRequestException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ResponseInvalidJsonFormat', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 401 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new UpdateInvoiceUnauthorizedException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 403 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new UpdateInvoiceForbiddenException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 404 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new UpdateInvoiceNotFoundException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 422 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new UpdateInvoiceUnprocessableEntityException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 429 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new UpdateInvoiceTooManyRequestsException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 500 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new UpdateInvoiceInternalServerErrorException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
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
