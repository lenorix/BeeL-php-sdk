<?php

namespace Lenorix\BeelSdk\Generated\Endpoint;

use Lenorix\BeelSdk\Generated\Exception\GetCompanyInvoiceScheduleForbiddenException;
use Lenorix\BeelSdk\Generated\Exception\GetCompanyInvoiceScheduleInternalServerErrorException;
use Lenorix\BeelSdk\Generated\Exception\GetCompanyInvoiceScheduleNotFoundException;
use Lenorix\BeelSdk\Generated\Exception\GetCompanyInvoiceScheduleTooManyRequestsException;
use Lenorix\BeelSdk\Generated\Exception\GetCompanyInvoiceScheduleUnauthorizedException;
use Lenorix\BeelSdk\Generated\Model\ErrorResponse;
use Lenorix\BeelSdk\Generated\Model\InvoiceScheduleResponse;
use Lenorix\BeelSdk\Generated\Runtime\Client\BaseEndpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\Endpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\EndpointTrait;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\Serializer\SerializerInterface;

class GetCompanyInvoiceSchedule extends BaseEndpoint implements Endpoint
{
    protected $company_id;

    protected $invoice_id;

    /**
     * Returns the date and generation mode currently scheduled for this invoice. An invoice with
     * no scheduling answers `404`, since the sub-resource does not exist yet. To move only the
     * date, read the current `generation_mode` here and send it back on the `PUT`.
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
        return 'GET';
    }

    public function getUri(): string
    {
        return str_replace(['{company_id}', '{invoice_id}'], [rawurlencode($this->company_id), rawurlencode($this->invoice_id)], '/v1/companies/{company_id}/invoices/{invoice_id}/schedule');
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
     * @return null|InvoiceScheduleResponse|ErrorResponse
     *
     * @throws GetCompanyInvoiceScheduleUnauthorizedException
     * @throws GetCompanyInvoiceScheduleForbiddenException
     * @throws GetCompanyInvoiceScheduleNotFoundException
     * @throws GetCompanyInvoiceScheduleTooManyRequestsException
     * @throws GetCompanyInvoiceScheduleInternalServerErrorException
     */
    protected function transformResponseBody(ResponseInterface $response, SerializerInterface $serializer, ?string $contentType = null)
    {
        $status = $response->getStatusCode();
        $body = (string) $response->getBody();
        if (is_null($contentType) === false && ($status === 200 && stripos(strtolower($contentType), 'application/json') !== false)) {
            return $serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\InvoiceScheduleResponse', 'json');
        }
        if (is_null($contentType) === false && ($status === 401 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new GetCompanyInvoiceScheduleUnauthorizedException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 403 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new GetCompanyInvoiceScheduleForbiddenException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 404 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new GetCompanyInvoiceScheduleNotFoundException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 429 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new GetCompanyInvoiceScheduleTooManyRequestsException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 500 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new GetCompanyInvoiceScheduleInternalServerErrorException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
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
