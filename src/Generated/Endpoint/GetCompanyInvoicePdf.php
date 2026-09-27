<?php

namespace Lenorix\BeelSdk\Generated\Endpoint;

use Lenorix\BeelSdk\Generated\Exception\GetCompanyInvoicePdfBadRequestException;
use Lenorix\BeelSdk\Generated\Exception\GetCompanyInvoicePdfForbiddenException;
use Lenorix\BeelSdk\Generated\Exception\GetCompanyInvoicePdfInternalServerErrorException;
use Lenorix\BeelSdk\Generated\Exception\GetCompanyInvoicePdfNotFoundException;
use Lenorix\BeelSdk\Generated\Exception\GetCompanyInvoicePdfTooManyRequestsException;
use Lenorix\BeelSdk\Generated\Exception\GetCompanyInvoicePdfUnauthorizedException;
use Lenorix\BeelSdk\Generated\Model\ErrorResponse;
use Lenorix\BeelSdk\Generated\Model\InvoicePdfResponse;
use Lenorix\BeelSdk\Generated\Runtime\Client\BaseEndpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\Endpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\EndpointTrait;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Serializer\SerializerInterface;

class GetCompanyInvoicePdf extends BaseEndpoint implements Endpoint
{
    protected $company_id;

    protected $invoice_id;

    /**
     * Returns a temporary pre-signed URL to download the invoice PDF.
     *
     * - **URL:** expires in five minutes and only allows `GET`.
     * - **Waiting:** a PDF is produced asynchronously, so this request **waits** for it (up to
     *   ten seconds) instead of handing you a polling loop to write. Bound the wait with
     *   `Prefer: wait=N`, or opt out with `Prefer: wait=0`.
     * - **`202`:** only when the wait elapsed with the PDF still in flight. No body is returned;
     *   ask again after `Retry-After`.
     * - **Drafts:** a draft has no fiscal PDF and answers `400 INVOICE_NOT_ISSUED_NO_PDF`
     *   immediately — that one never waits. Issue it, or render it with
     *   `GET …/{invoice_id}/pdf/preview`.
     *
     * @param  string  $companyId  Unique identifier (UUID) of the company the operation acts on — its identifier, not its NIF. It is the only source of context: the account that owns it is derived from it, and the `BeeL-Active-Company` header plays no part. A company you do not reach answers `403`, and so does a company that does not exist, so the existence of a company in another account is never disclosed.
     * @param  string  $invoiceId  Invoice ID
     * @param array{
     *    "Prefer"?: string, //RFC 7240 preference bounding how long this request may wait for a PDF that is still
    being generated: `Prefer: wait=N`, with `N` in seconds.

    By default the request waits (up to the server cap) and answers `200` with the URL, so
    the `202` is the exception rather than the normal path. Use `Prefer: wait=0` to opt out
    and get the old poll-only behaviour: an immediate `202` while the PDF is in flight.

    A value above the cap is lowered to it, and the `202` then echoes what was actually
    applied in `Preference-Applied: wait=<seconds>` — so you never have to discover the cap
    by trial and error. A value that is not a non-negative integer is ignored altogether
    (RFC 7240: a preference that is not understood is not an error), and the request falls
    back to the default wait with no `Preference-Applied` header.
     * } $headerParameters
     */
    public function __construct(string $companyId, string $invoiceId, array $headerParameters = [])
    {
        $this->company_id = $companyId;
        $this->invoice_id = $invoiceId;
        $this->headerParameters = $headerParameters;
    }

    use EndpointTrait;

    public function getMethod(): string
    {
        return 'GET';
    }

    public function getUri(): string
    {
        return str_replace(['{company_id}', '{invoice_id}'], [rawurlencode($this->company_id), rawurlencode($this->invoice_id)], '/v1/companies/{company_id}/invoices/{invoice_id}/pdf');
    }

    public function getBody(SerializerInterface $serializer, $streamFactory = null): array
    {
        return [[], null];
    }

    public function getExtraHeaders(): array
    {
        return ['Accept' => ['application/json']];
    }

    protected function getHeadersOptionsResolver(): OptionsResolver
    {
        $optionsResolver = parent::getHeadersOptionsResolver();
        $optionsResolver->setDefined(['Prefer']);
        $optionsResolver->setRequired([]);
        $optionsResolver->setDefaults([]);
        $optionsResolver->addAllowedTypes('Prefer', ['string']);

        return $optionsResolver;
    }

    /**
     * {@inheritdoc}
     *
     *
     * @return null|InvoicePdfResponse|ErrorResponse
     *
     * @throws GetCompanyInvoicePdfBadRequestException
     * @throws GetCompanyInvoicePdfUnauthorizedException
     * @throws GetCompanyInvoicePdfForbiddenException
     * @throws GetCompanyInvoicePdfNotFoundException
     * @throws GetCompanyInvoicePdfTooManyRequestsException
     * @throws GetCompanyInvoicePdfInternalServerErrorException
     */
    protected function transformResponseBody(ResponseInterface $response, SerializerInterface $serializer, ?string $contentType = null)
    {
        $status = $response->getStatusCode();
        $body = (string) $response->getBody();
        if (is_null($contentType) === false && ($status === 200 && stripos(strtolower($contentType), 'application/json') !== false)) {
            return $serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\InvoicePdfResponse', 'json');
        }
        if ($status === 202) {
            return null;
        }
        if (is_null($contentType) === false && ($status === 400 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new GetCompanyInvoicePdfBadRequestException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 401 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new GetCompanyInvoicePdfUnauthorizedException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 403 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new GetCompanyInvoicePdfForbiddenException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 404 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new GetCompanyInvoicePdfNotFoundException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 429 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new GetCompanyInvoicePdfTooManyRequestsException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 500 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new GetCompanyInvoicePdfInternalServerErrorException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
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
