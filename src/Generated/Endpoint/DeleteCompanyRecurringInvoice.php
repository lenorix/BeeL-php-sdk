<?php

namespace Lenorix\BeelSdk\Generated\Endpoint;

use Lenorix\BeelSdk\Generated\Exception\DeleteCompanyRecurringInvoiceForbiddenException;
use Lenorix\BeelSdk\Generated\Exception\DeleteCompanyRecurringInvoiceInternalServerErrorException;
use Lenorix\BeelSdk\Generated\Exception\DeleteCompanyRecurringInvoiceNotFoundException;
use Lenorix\BeelSdk\Generated\Exception\DeleteCompanyRecurringInvoiceTooManyRequestsException;
use Lenorix\BeelSdk\Generated\Exception\DeleteCompanyRecurringInvoiceUnauthorizedException;
use Lenorix\BeelSdk\Generated\Model\ErrorResponse;
use Lenorix\BeelSdk\Generated\Runtime\Client\BaseEndpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\Endpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\EndpointTrait;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\Serializer\SerializerInterface;

class DeleteCompanyRecurringInvoice extends BaseEndpoint implements Endpoint
{
    protected $company_id;

    protected $recurring_invoice_id;

    /**
     * Permanently deletes a recurring invoice template of this company and cancels any pending scheduled generations. Invoices already generated from it are not affected.
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
        return 'DELETE';
    }

    public function getUri(): string
    {
        return str_replace(['{company_id}', '{recurring_invoice_id}'], [rawurlencode($this->company_id), rawurlencode($this->recurring_invoice_id)], '/v1/companies/{company_id}/recurring-invoices/{recurring_invoice_id}');
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
     * @throws DeleteCompanyRecurringInvoiceUnauthorizedException
     * @throws DeleteCompanyRecurringInvoiceForbiddenException
     * @throws DeleteCompanyRecurringInvoiceNotFoundException
     * @throws DeleteCompanyRecurringInvoiceTooManyRequestsException
     * @throws DeleteCompanyRecurringInvoiceInternalServerErrorException
     */
    protected function transformResponseBody(ResponseInterface $response, SerializerInterface $serializer, ?string $contentType = null)
    {
        $status = $response->getStatusCode();
        $body = (string) $response->getBody();
        if ($status === 204) {
            return null;
        }
        if (is_null($contentType) === false && ($status === 401 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new DeleteCompanyRecurringInvoiceUnauthorizedException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 403 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new DeleteCompanyRecurringInvoiceForbiddenException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 404 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new DeleteCompanyRecurringInvoiceNotFoundException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 429 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new DeleteCompanyRecurringInvoiceTooManyRequestsException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 500 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new DeleteCompanyRecurringInvoiceInternalServerErrorException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
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
