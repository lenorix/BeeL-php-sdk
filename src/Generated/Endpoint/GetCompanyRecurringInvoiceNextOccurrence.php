<?php

namespace Lenorix\BeelSdk\Generated\Endpoint;

use Lenorix\BeelSdk\Generated\Exception\GetCompanyRecurringInvoiceNextOccurrenceBadRequestException;
use Lenorix\BeelSdk\Generated\Exception\GetCompanyRecurringInvoiceNextOccurrenceConflictException;
use Lenorix\BeelSdk\Generated\Exception\GetCompanyRecurringInvoiceNextOccurrenceForbiddenException;
use Lenorix\BeelSdk\Generated\Exception\GetCompanyRecurringInvoiceNextOccurrenceInternalServerErrorException;
use Lenorix\BeelSdk\Generated\Exception\GetCompanyRecurringInvoiceNextOccurrenceNotFoundException;
use Lenorix\BeelSdk\Generated\Exception\GetCompanyRecurringInvoiceNextOccurrenceTooManyRequestsException;
use Lenorix\BeelSdk\Generated\Exception\GetCompanyRecurringInvoiceNextOccurrenceUnauthorizedException;
use Lenorix\BeelSdk\Generated\Exception\GetCompanyRecurringInvoiceNextOccurrenceUnprocessableEntityException;
use Lenorix\BeelSdk\Generated\Model\ErrorResponse;
use Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdRecurringInvoicesRecurringInvoiceIdNextOccurrenceGetResponse200;
use Lenorix\BeelSdk\Generated\Runtime\Client\BaseEndpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\Endpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\EndpointTrait;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\Serializer\SerializerInterface;

class GetCompanyRecurringInvoiceNextOccurrence extends BaseEndpoint implements Endpoint
{
    protected $company_id;

    protected $recurring_invoice_id;

    /**
     * Returns the invoice that would be produced by the next generation of this recurring
     * template, computed from the current issuer, recipient and series data. Nothing is
     * persisted and no numbering is consumed.
     *
     * @param  string  $companyId  Unique identifier (UUID) of the company the operation acts on — its identifier, not its NIF. It is the only source of context: the account that owns it is derived from it, and the `BeeL-Active-Company` header plays no part. A company you do not reach answers `403`, and so does a company that does not exist, so the existence of a company in another account is never disclosed.
     */
    public function __construct(string $companyId, string $recurringInvoiceId)
    {
        $this->company_id = $companyId;
        $this->recurring_invoice_id = $recurringInvoiceId;
    }

    use EndpointTrait;

    public function getMethod(): string
    {
        return 'GET';
    }

    public function getUri(): string
    {
        return str_replace(['{company_id}', '{recurring_invoice_id}'], [rawurlencode($this->company_id), rawurlencode($this->recurring_invoice_id)], '/v1/companies/{company_id}/recurring-invoices/{recurring_invoice_id}/next-occurrence');
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
     * @return null|V1CompaniesCompanyIdRecurringInvoicesRecurringInvoiceIdNextOccurrenceGetResponse200|ErrorResponse
     *
     * @throws GetCompanyRecurringInvoiceNextOccurrenceBadRequestException
     * @throws GetCompanyRecurringInvoiceNextOccurrenceUnauthorizedException
     * @throws GetCompanyRecurringInvoiceNextOccurrenceForbiddenException
     * @throws GetCompanyRecurringInvoiceNextOccurrenceNotFoundException
     * @throws GetCompanyRecurringInvoiceNextOccurrenceConflictException
     * @throws GetCompanyRecurringInvoiceNextOccurrenceUnprocessableEntityException
     * @throws GetCompanyRecurringInvoiceNextOccurrenceTooManyRequestsException
     * @throws GetCompanyRecurringInvoiceNextOccurrenceInternalServerErrorException
     */
    protected function transformResponseBody(ResponseInterface $response, SerializerInterface $serializer, ?string $contentType = null)
    {
        $status = $response->getStatusCode();
        $body = (string) $response->getBody();
        if (is_null($contentType) === false && ($status === 200 && stripos(strtolower($contentType), 'application/json') !== false)) {
            return $serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdRecurringInvoicesRecurringInvoiceIdNextOccurrenceGetResponse200', 'json');
        }
        if (is_null($contentType) === false && ($status === 400 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new GetCompanyRecurringInvoiceNextOccurrenceBadRequestException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 401 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new GetCompanyRecurringInvoiceNextOccurrenceUnauthorizedException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 403 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new GetCompanyRecurringInvoiceNextOccurrenceForbiddenException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 404 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new GetCompanyRecurringInvoiceNextOccurrenceNotFoundException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 409 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new GetCompanyRecurringInvoiceNextOccurrenceConflictException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 422 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new GetCompanyRecurringInvoiceNextOccurrenceUnprocessableEntityException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 429 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new GetCompanyRecurringInvoiceNextOccurrenceTooManyRequestsException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 500 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new GetCompanyRecurringInvoiceNextOccurrenceInternalServerErrorException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
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
