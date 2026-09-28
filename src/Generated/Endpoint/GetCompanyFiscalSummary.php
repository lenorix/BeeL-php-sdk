<?php

namespace Lenorix\BeelSdk\Generated\Endpoint;

class GetCompanyFiscalSummary extends \Lenorix\BeelSdk\Generated\Runtime\Client\BaseEndpoint implements \Lenorix\BeelSdk\Generated\Runtime\Client\Endpoint
{
    protected $company_id;
    /**
    * Returns the VAT and IRPF summary of the invoices issued under this company over the requested period, together with the annual IRPF projection and its progressive bracket breakdown.
    * `start_date` and `end_date` go together: send both, or neither. Omitting both defaults to the current month; sending only one answers `400`, because a period you did not ask for is worse than an error. The range may not exceed 365 days, and every fault names itself in `details.reason`.
    * @param string $companyId Unique identifier (UUID) of the company the operation acts on — its identifier, not its NIF. It is the only source of context: the account that owns it is derived from it, and the `BeeL-Active-Company` header plays no part. A company you do not reach answers `403`, and so does a company that does not exist, so the existence of a company in another account is never disclosed.
    * @param array{
    *    "start_date"?: string, //Period start date (inclusive), as `YYYY-MM-DD`. Goes together with `end_date`:
    supply both or neither. Omitting both defaults to the current month; supplying
    only one is rejected with `400` (`PERIOD_INCOMPLETE`).
    *    "end_date"?: string, //Period end date (inclusive), as `YYYY-MM-DD`. Goes together with `start_date`:
    supply both or neither. Omitting both defaults to the current month; supplying
    only one is rejected with `400` (`PERIOD_INCOMPLETE`).
    * } $queryParameters
    */
    public function __construct(string $companyId, array $queryParameters = [])
    {
        $this->company_id = $companyId;
        $this->queryParameters = $queryParameters;
    }
    use \Lenorix\BeelSdk\Generated\Runtime\Client\EndpointTrait;
    public function getMethod(): string
    {
        return 'GET';
    }
    public function getUri(): string
    {
        return str_replace(['{company_id}'], [rawurlencode($this->company_id)], '/v1/companies/{company_id}/fiscal-summary');
    }
    public function getBody(\Symfony\Component\Serializer\SerializerInterface $serializer, $streamFactory = null): array
    {
        return [[], null];
    }
    public function getExtraHeaders(): array
    {
        return ['Accept' => ['application/json']];
    }
    protected function getQueryOptionsResolver(): \Symfony\Component\OptionsResolver\OptionsResolver
    {
        $optionsResolver = parent::getQueryOptionsResolver();
        $optionsResolver->setDefined(['start_date', 'end_date']);
        $optionsResolver->setRequired([]);
        $optionsResolver->setDefaults([]);
        $optionsResolver->addAllowedTypes('start_date', ['string']);
        $optionsResolver->addAllowedTypes('end_date', ['string']);
        return $optionsResolver;
    }
    /**
     * {@inheritdoc}
     *
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetCompanyFiscalSummaryBadRequestException
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetCompanyFiscalSummaryUnauthorizedException
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetCompanyFiscalSummaryForbiddenException
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetCompanyFiscalSummaryTooManyRequestsException
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetCompanyFiscalSummaryInternalServerErrorException
     *
     * @return null|\Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdFiscalSummaryGetResponse200|\Lenorix\BeelSdk\Generated\Model\ErrorResponse
     */
    protected function transformResponseBody(\Psr\Http\Message\ResponseInterface $response, \Symfony\Component\Serializer\SerializerInterface $serializer, ?string $contentType = null)
    {
        $status = $response->getStatusCode();
        $body = (string) $response->getBody();
        if (is_null($contentType) === false && (200 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            return $serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdFiscalSummaryGetResponse200', 'json');
        }
        if (is_null($contentType) === false && (400 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\GetCompanyFiscalSummaryBadRequestException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && (401 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\GetCompanyFiscalSummaryUnauthorizedException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && (403 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\GetCompanyFiscalSummaryForbiddenException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && (429 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\GetCompanyFiscalSummaryTooManyRequestsException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && (500 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\GetCompanyFiscalSummaryInternalServerErrorException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
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