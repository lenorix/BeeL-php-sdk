<?php

namespace Lenorix\BeelSdk\Generated\Endpoint;

use Lenorix\BeelSdk\Generated\Exception\DeleteCompanyInvoiceBadRequestException;
use Lenorix\BeelSdk\Generated\Exception\DeleteCompanyInvoiceForbiddenException;
use Lenorix\BeelSdk\Generated\Exception\DeleteCompanyInvoiceInternalServerErrorException;
use Lenorix\BeelSdk\Generated\Exception\DeleteCompanyInvoiceNotFoundException;
use Lenorix\BeelSdk\Generated\Exception\DeleteCompanyInvoiceTooManyRequestsException;
use Lenorix\BeelSdk\Generated\Exception\DeleteCompanyInvoiceUnauthorizedException;
use Lenorix\BeelSdk\Generated\Model\ErrorResponse;
use Lenorix\BeelSdk\Generated\Runtime\Client\BaseEndpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\Endpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\EndpointTrait;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\Serializer\SerializerInterface;

class DeleteCompanyInvoice extends BaseEndpoint implements Endpoint
{
    protected $company_id;

    protected $invoice_id;

    /**
     * Deletes a draft invoice of this company. The record is marked as deleted rather than
     * removed.
     *
     * - **Issued invoices:** never deleted. They are voided with `POST …/{invoice_id}/void`,
     *   which leaves the fiscal trail.
     * - **`source_proforma_id`:** when the draft came from converting a proforma, deleting it
     *   returns that proforma from `CONVERTED` to `ACTIVE`, editable and convertible again.
     *   Voiding or rectifying an issued invoice does not return its proforma; only deleting the
     *   draft does.
     *
     * @param  string  $companyId  Unique identifier (UUID) of the company the operation acts on — its identifier, not its NIF. It is the only source of context: the account that owns it is derived from it, and the `BeeL-Active-Company` header plays no part. A company you do not reach answers `403`, and so does a company that does not exist, so the existence of a company in another account is never disclosed.
     * @param  string  $invoiceId  Invoice ID
     */
    public function __construct(string $companyId, string $invoiceId)
    {
        $this->company_id = $companyId;
        $this->invoice_id = $invoiceId;
    }

    use EndpointTrait;

    public function getMethod(): string
    {
        return 'DELETE';
    }

    public function getUri(): string
    {
        return str_replace(['{company_id}', '{invoice_id}'], [rawurlencode($this->company_id), rawurlencode($this->invoice_id)], '/v1/companies/{company_id}/invoices/{invoice_id}');
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
     * @return null|ErrorResponse
     *
     * @throws DeleteCompanyInvoiceBadRequestException
     * @throws DeleteCompanyInvoiceUnauthorizedException
     * @throws DeleteCompanyInvoiceForbiddenException
     * @throws DeleteCompanyInvoiceNotFoundException
     * @throws DeleteCompanyInvoiceTooManyRequestsException
     * @throws DeleteCompanyInvoiceInternalServerErrorException
     */
    protected function transformResponseBody(ResponseInterface $response, SerializerInterface $serializer, ?string $contentType = null)
    {
        $status = $response->getStatusCode();
        $body = (string) $response->getBody();
        if ($status === 204) {
            return null;
        }
        if (is_null($contentType) === false && ($status === 400 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new DeleteCompanyInvoiceBadRequestException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 401 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new DeleteCompanyInvoiceUnauthorizedException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 403 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new DeleteCompanyInvoiceForbiddenException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 404 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new DeleteCompanyInvoiceNotFoundException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 429 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new DeleteCompanyInvoiceTooManyRequestsException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 500 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new DeleteCompanyInvoiceInternalServerErrorException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
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
