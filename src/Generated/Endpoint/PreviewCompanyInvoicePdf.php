<?php

namespace Lenorix\BeelSdk\Generated\Endpoint;

use Lenorix\BeelSdk\Generated\Exception\PreviewCompanyInvoicePdfBadRequestException;
use Lenorix\BeelSdk\Generated\Exception\PreviewCompanyInvoicePdfForbiddenException;
use Lenorix\BeelSdk\Generated\Exception\PreviewCompanyInvoicePdfInternalServerErrorException;
use Lenorix\BeelSdk\Generated\Exception\PreviewCompanyInvoicePdfNotFoundException;
use Lenorix\BeelSdk\Generated\Exception\PreviewCompanyInvoicePdfTooManyRequestsException;
use Lenorix\BeelSdk\Generated\Exception\PreviewCompanyInvoicePdfUnauthorizedException;
use Lenorix\BeelSdk\Generated\Model\ErrorResponse;
use Lenorix\BeelSdk\Generated\Runtime\Client\BaseEndpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\Endpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\EndpointTrait;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\Serializer\SerializerInterface;

class PreviewCompanyInvoicePdf extends BaseEndpoint implements Endpoint
{
    protected $company_id;

    protected $invoice_id;

    protected $accept;

    /**
     * Renders the PDF of a draft invoice on the fly, without storing it and without consuming
     * numbering, so each call reflects the latest changes. The response is `application/pdf`.
     *
     * - **Document:** shows `BORRADOR` in place of the invoice number and carries no VeriFactu
     *   QR code. The issuer block is taken from the company in the path.
     * - **Drafts only:** an invoice that is not a draft answers `400` — it has a stored PDF,
     *   available at `GET …/{invoice_id}/pdf`.
     *
     * @param  string  $companyId  Unique identifier (UUID) of the company the operation acts on — its identifier, not its NIF. It is the only source of context: the account that owns it is derived from it, and the `BeeL-Active-Company` header plays no part. A company you do not reach answers `403`, and so does a company that does not exist, so the existence of a company in another account is never disclosed.
     * @param  string  $invoiceId  Invoice ID
     * @param  array  $accept  Accept content header application/pdf|application/json
     */
    public function __construct(string $companyId, string $invoiceId, array $accept = [])
    {
        $this->company_id = $companyId;
        $this->invoice_id = $invoiceId;
        $this->accept = $accept;
    }

    use EndpointTrait;

    public function getMethod(): string
    {
        return 'GET';
    }

    public function getUri(): string
    {
        return str_replace(['{company_id}', '{invoice_id}'], [rawurlencode($this->company_id), rawurlencode($this->invoice_id)], '/v1/companies/{company_id}/invoices/{invoice_id}/pdf/preview');
    }

    public function getBody(SerializerInterface $serializer, $streamFactory = null): array
    {
        return [[], null];
    }

    public function getExtraHeaders(): array
    {
        if (empty($this->accept)) {
            return ['Accept' => ['application/pdf', 'application/json']];
        }

        return $this->accept;
    }

    /**
     * {@inheritdoc}
     *
     *
     * @return null|ErrorResponse
     *
     * @throws PreviewCompanyInvoicePdfBadRequestException
     * @throws PreviewCompanyInvoicePdfUnauthorizedException
     * @throws PreviewCompanyInvoicePdfForbiddenException
     * @throws PreviewCompanyInvoicePdfNotFoundException
     * @throws PreviewCompanyInvoicePdfTooManyRequestsException
     * @throws PreviewCompanyInvoicePdfInternalServerErrorException
     */
    protected function transformResponseBody(ResponseInterface $response, SerializerInterface $serializer, ?string $contentType = null)
    {
        $status = $response->getStatusCode();
        $body = (string) $response->getBody();
        if ($status === 200) {
        }
        if (is_null($contentType) === false && ($status === 400 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new PreviewCompanyInvoicePdfBadRequestException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 401 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new PreviewCompanyInvoicePdfUnauthorizedException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 403 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new PreviewCompanyInvoicePdfForbiddenException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 404 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new PreviewCompanyInvoicePdfNotFoundException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 429 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new PreviewCompanyInvoicePdfTooManyRequestsException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 500 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new PreviewCompanyInvoicePdfInternalServerErrorException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
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
