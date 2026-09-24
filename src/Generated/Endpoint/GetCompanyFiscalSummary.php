<?php

namespace Lenorix\BeelSdk\Generated\Endpoint;

use Lenorix\BeelSdk\Generated\Exception\GetCompanyFiscalSummaryBadRequestException;
use Lenorix\BeelSdk\Generated\Exception\GetCompanyFiscalSummaryForbiddenException;
use Lenorix\BeelSdk\Generated\Exception\GetCompanyFiscalSummaryInternalServerErrorException;
use Lenorix\BeelSdk\Generated\Exception\GetCompanyFiscalSummaryTooManyRequestsException;
use Lenorix\BeelSdk\Generated\Exception\GetCompanyFiscalSummaryUnauthorizedException;
use Lenorix\BeelSdk\Generated\Model\ErrorResponse;
use Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdFiscalSummaryGetResponse200;
use Lenorix\BeelSdk\Generated\Runtime\Client\BaseEndpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\Endpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\EndpointTrait;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Serializer\SerializerInterface;

class GetCompanyFiscalSummary extends BaseEndpoint implements Endpoint
{
    protected $company_id;

    /**
     * Returns the VAT and IRPF summary of the invoices issued under this company over the requested period, together with the annual IRPF projection and its progressive bracket breakdown.
     * `start_date` and `end_date` go together: send both, or neither. Omitting both defaults to the current month; sending only one answers `400`, because a period you did not ask for is worse than an error. The range may not exceed 365 days, and every fault names itself in `details.reason`.
     *
     * @param  string  $companyId  Unique identifier (UUID) of the company the operation acts on — its identifier, not its NIF. It is the only source of context: the account that owns it is derived from it, and the `BeeL-Active-Company` header plays no part. A company you do not reach answers `403`, and so does a company that does not exist, so the existence of a company in another account is never disclosed.
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

    use EndpointTrait;

    public function getMethod(): string
    {
        return 'GET';
    }

    public function getUri(): string
    {
        return str_replace(['{company_id}'], [rawurlencode($this->company_id)], '/v1/companies/{company_id}/fiscal-summary');
    }

    public function getBody(SerializerInterface $serializer, $streamFactory = null): array
    {
        return [[], null];
    }

    public function getExtraHeaders(): array
    {
        return ['Accept' => ['application/json']];
    }

    protected function getQueryOptionsResolver(): OptionsResolver
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
     *
     * @return null|V1CompaniesCompanyIdFiscalSummaryGetResponse200|ErrorResponse
     *
     * @throws GetCompanyFiscalSummaryBadRequestException
     * @throws GetCompanyFiscalSummaryUnauthorizedException
     * @throws GetCompanyFiscalSummaryForbiddenException
     * @throws GetCompanyFiscalSummaryTooManyRequestsException
     * @throws GetCompanyFiscalSummaryInternalServerErrorException
     */
    protected function transformResponseBody(ResponseInterface $response, SerializerInterface $serializer, ?string $contentType = null)
    {
        $status = $response->getStatusCode();
        $body = (string) $response->getBody();
        if (is_null($contentType) === false && ($status === 200 && stripos(strtolower($contentType), 'application/json') !== false)) {
            return $serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdFiscalSummaryGetResponse200', 'json');
        }
        if (is_null($contentType) === false && ($status === 400 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new GetCompanyFiscalSummaryBadRequestException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 401 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new GetCompanyFiscalSummaryUnauthorizedException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 403 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new GetCompanyFiscalSummaryForbiddenException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 429 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new GetCompanyFiscalSummaryTooManyRequestsException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 500 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new GetCompanyFiscalSummaryInternalServerErrorException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
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
