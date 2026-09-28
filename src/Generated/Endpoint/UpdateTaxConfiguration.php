<?php

namespace Lenorix\BeelSdk\Generated\Endpoint;

use Lenorix\BeelSdk\Generated\Exception\UpdateTaxConfigurationBadRequestException;
use Lenorix\BeelSdk\Generated\Exception\UpdateTaxConfigurationForbiddenException;
use Lenorix\BeelSdk\Generated\Exception\UpdateTaxConfigurationInternalServerErrorException;
use Lenorix\BeelSdk\Generated\Exception\UpdateTaxConfigurationUnauthorizedException;
use Lenorix\BeelSdk\Generated\Exception\UpdateTaxConfigurationUnprocessableEntityException;
use Lenorix\BeelSdk\Generated\Model\ErrorResponse;
use Lenorix\BeelSdk\Generated\Model\UpdateTaxConfigurationRequest;
use Lenorix\BeelSdk\Generated\Model\V1ConfigurationTaxesPutResponse200;
use Lenorix\BeelSdk\Generated\Runtime\Client\BaseEndpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\Endpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\EndpointTrait;
use Lenorix\BeelSdk\Generated\Runtime\Client\JsonPayload;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\Serializer\SerializerInterface;

class UpdateTaxConfiguration extends BaseEndpoint implements Endpoint
{
    /**
     * **Deprecated.** Use `PUT /v1/companies/{company_id}/tax-configuration`, which behaves
     * identically.
     *
     * Updates the tax configuration of the company in focus. Fields you omit keep their
     * current value.
     *
     * - **Regime coherence:** the main tax and its VeriFactu regime key must match. Regime key
     *   `18` (equivalence surcharge) only exists for `IVA`, so pairing it with `IGIC`, `IPSI` or
     *   `OTHER` answers `422` `INVALID_REGIME_KEY_FOR_TAX_TYPE`, with `details` naming the
     *   rejected key, the tax type and the keys that type admits.
     * - **Surcharge:** applying the surcharge without regime key `18` answers `422`
     *   `RECARGO_REQUIRES_REGIME_RE`.
     * - **Exemption reason:** `default_exemption_reason` travels with `default_main_tax` —
     *   sending the tax without a reason clears the stored one, and sending only the reason
     *   applies it to the tax already stored.
     *
     * **Retires on 9 December 2026.** See the [migration guide](https://docs.beel.es/changelog/resources-under-the-nif) for what moved where and what changes when you switch.
     */
    public function __construct(UpdateTaxConfigurationRequest $requestBody)
    {
        $this->body = $requestBody;
    }

    use EndpointTrait;

    public function getMethod(): string
    {
        return 'PUT';
    }

    public function getUri(): string
    {
        return '/v1/configuration/taxes';
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
     * @return null|V1ConfigurationTaxesPutResponse200|ErrorResponse
     *
     * @throws UpdateTaxConfigurationBadRequestException
     * @throws UpdateTaxConfigurationUnauthorizedException
     * @throws UpdateTaxConfigurationForbiddenException
     * @throws UpdateTaxConfigurationUnprocessableEntityException
     * @throws UpdateTaxConfigurationInternalServerErrorException
     */
    protected function transformResponseBody(ResponseInterface $response, SerializerInterface $serializer, ?string $contentType = null)
    {
        $status = $response->getStatusCode();
        $body = (string) $response->getBody();
        if (is_null($contentType) === false && ($status === 200 && stripos(strtolower($contentType), 'application/json') !== false)) {
            return $serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\V1ConfigurationTaxesPutResponse200', 'json');
        }
        if (is_null($contentType) === false && ($status === 400 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new UpdateTaxConfigurationBadRequestException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 401 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new UpdateTaxConfigurationUnauthorizedException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 403 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new UpdateTaxConfigurationForbiddenException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 422 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new UpdateTaxConfigurationUnprocessableEntityException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 500 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new UpdateTaxConfigurationInternalServerErrorException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
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
