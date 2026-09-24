<?php

namespace Lenorix\BeelSdk\Generated\Endpoint;

class GetCompanyPaymentEvent extends \Lenorix\BeelSdk\Generated\Runtime\Client\BaseEndpoint implements \Lenorix\BeelSdk\Generated\Runtime\Client\Endpoint
{
    protected $company_id;
    protected $connection_id;
    protected $event_id;
    /**
     * Retrieves a single payment event of the NIF's connection, including the outcome of its
     * automatic invoicing and, when it failed, the stable failure code you can act on.
     *
     * - **Not found:** an event that does not belong to this NIF's connection returns `404`,
     *   the same answer an event that does not exist gets, so an event of another NIF is never
     *   disclosed.
     *
     * @param string $companyId Unique identifier (UUID) of the company the events belong to — its identifier, not its NIF. It is the only source of context: the account that owns it is derived from it, and the `BeeL-Active-Company` header plays no part. A company you do not reach answers `403`, and so does a company that does not exist, so the existence of a company in another account is never disclosed.
     * @param string $connectionId Unique identifier (UUID) of the payment connection the operation acts on, as returned by `GET /v1/companies/{company_id}/payment-connections`. A NIF can hold several connections of the same provider, so the provider slug alone does not name one. A connection of another NIF answers `404`, exactly like one that does not exist.
     * @param string $eventId Identifier of the payment event, as returned by the list operation.
     */
    public function __construct(string $companyId, string $connectionId, string $eventId)
    {
        $this->company_id = $companyId;
        $this->connection_id = $connectionId;
        $this->event_id = $eventId;
    }
    use \Lenorix\BeelSdk\Generated\Runtime\Client\EndpointTrait;
    public function getMethod(): string
    {
        return 'GET';
    }
    public function getUri(): string
    {
        return str_replace(['{company_id}', '{connection_id}', '{event_id}'], [rawurlencode($this->company_id), rawurlencode($this->connection_id), rawurlencode($this->event_id)], '/v1/companies/{company_id}/payment-connections/{connection_id}/events/{event_id}');
    }
    public function getBody(\Symfony\Component\Serializer\SerializerInterface $serializer, $streamFactory = null): array
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
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetCompanyPaymentEventUnauthorizedException
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetCompanyPaymentEventForbiddenException
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetCompanyPaymentEventNotFoundException
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetCompanyPaymentEventUnprocessableEntityException
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetCompanyPaymentEventTooManyRequestsException
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetCompanyPaymentEventInternalServerErrorException
     *
     * @return null|\Lenorix\BeelSdk\Generated\Model\ManagedPaymentEventResponse|\Lenorix\BeelSdk\Generated\Model\ErrorResponse
     */
    protected function transformResponseBody(\Psr\Http\Message\ResponseInterface $response, \Symfony\Component\Serializer\SerializerInterface $serializer, ?string $contentType = null)
    {
        $status = $response->getStatusCode();
        $body = (string) $response->getBody();
        if (is_null($contentType) === false && (200 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            return $serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ManagedPaymentEventResponse', 'json');
        }
        if (is_null($contentType) === false && (401 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\GetCompanyPaymentEventUnauthorizedException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && (403 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\GetCompanyPaymentEventForbiddenException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && (404 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\GetCompanyPaymentEventNotFoundException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && (422 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\GetCompanyPaymentEventUnprocessableEntityException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && (429 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\GetCompanyPaymentEventTooManyRequestsException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && (500 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\GetCompanyPaymentEventInternalServerErrorException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
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