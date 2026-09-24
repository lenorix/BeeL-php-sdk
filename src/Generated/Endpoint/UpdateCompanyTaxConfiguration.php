<?php

namespace Lenorix\BeelSdk\Generated\Endpoint;

use Lenorix\BeelSdk\Generated\Exception\UpdateCompanyTaxConfigurationBadRequestException;
use Lenorix\BeelSdk\Generated\Exception\UpdateCompanyTaxConfigurationForbiddenException;
use Lenorix\BeelSdk\Generated\Exception\UpdateCompanyTaxConfigurationInternalServerErrorException;
use Lenorix\BeelSdk\Generated\Exception\UpdateCompanyTaxConfigurationTooManyRequestsException;
use Lenorix\BeelSdk\Generated\Exception\UpdateCompanyTaxConfigurationUnauthorizedException;
use Lenorix\BeelSdk\Generated\Exception\UpdateCompanyTaxConfigurationUnprocessableEntityException;
use Lenorix\BeelSdk\Generated\Model\ErrorResponse;
use Lenorix\BeelSdk\Generated\Model\UpdateTaxConfigurationRequest;
use Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdTaxConfigurationPutResponse200;
use Lenorix\BeelSdk\Generated\Runtime\Client\BaseEndpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\Endpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\EndpointTrait;
use Lenorix\BeelSdk\Generated\Runtime\Client\JsonPayload;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\Serializer\SerializerInterface;

class UpdateCompanyTaxConfiguration extends BaseEndpoint implements Endpoint
{
    protected $company_id;

    /**
     * Updates the tax configuration of a company. Fields you omit keep their current
     * value; `default_main_tax`, when sent, replaces the stored one wholesale.
     *
     * - **Regime coherence:** the main tax and its VeriFactu regime key must be coherent. Regime
     *   key `18` (equivalence surcharge) only exists for `IVA`, so pairing it with any other
     *   regime answers `422 INVALID_REGIME_KEY_FOR_TAX_TYPE`, with `details` naming the rejected
     *   key, the tax type and the keys that type admits.
     * - **Surcharge:** applying the surcharge without regime key `18` answers `422`
     *   `RECARGO_REQUIRES_REGIME_RE`.
     * - **Exemption reason:** `default_exemption_reason` travels with `default_main_tax` —
     *   sending the tax without a reason clears the stored one, and sending only the reason
     *   applies it to the tax already stored.
     *
     * @param  string  $companyId  Unique identifier (UUID) of the company the operation acts on — its identifier, not its NIF. It is the only source of context: the account that owns it is derived from it, and the `BeeL-Active-Company` header plays no part. A company you do not reach answers `403`, and so does a company that does not exist, so the existence of a company in another account is never disclosed.
     */
    public function __construct(string $companyId, UpdateTaxConfigurationRequest $requestBody)
    {
        $this->company_id = $companyId;
        $this->body = $requestBody;
    }

    use EndpointTrait;

    public function getMethod(): string
    {
        return 'PUT';
    }

    public function getUri(): string
    {
        return str_replace(['{company_id}'], [rawurlencode($this->company_id)], '/v1/companies/{company_id}/tax-configuration');
    }

    public function getBody(SerializerInterface $serializer, $streamFactory = null): array
    {
        if ($this->body instanceof UpdateTaxConfigurationRequest) {
            return [['Content-Type' => ['application/json']], JsonPayload::encode($serializer, $this->body)];
        }

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
     * @return null|V1CompaniesCompanyIdTaxConfigurationPutResponse200|ErrorResponse
     *
     * @throws UpdateCompanyTaxConfigurationBadRequestException
     * @throws UpdateCompanyTaxConfigurationUnauthorizedException
     * @throws UpdateCompanyTaxConfigurationForbiddenException
     * @throws UpdateCompanyTaxConfigurationUnprocessableEntityException
     * @throws UpdateCompanyTaxConfigurationTooManyRequestsException
     * @throws UpdateCompanyTaxConfigurationInternalServerErrorException
     */
    protected function transformResponseBody(ResponseInterface $response, SerializerInterface $serializer, ?string $contentType = null)
    {
        $status = $response->getStatusCode();
        $body = (string) $response->getBody();
        if (is_null($contentType) === false && ($status === 200 && stripos(strtolower($contentType), 'application/json') !== false)) {
            return $serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdTaxConfigurationPutResponse200', 'json');
        }
        if (is_null($contentType) === false && ($status === 400 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new UpdateCompanyTaxConfigurationBadRequestException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 401 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new UpdateCompanyTaxConfigurationUnauthorizedException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 403 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new UpdateCompanyTaxConfigurationForbiddenException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 422 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new UpdateCompanyTaxConfigurationUnprocessableEntityException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 429 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new UpdateCompanyTaxConfigurationTooManyRequestsException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 500 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new UpdateCompanyTaxConfigurationInternalServerErrorException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
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
