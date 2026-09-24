<?php

namespace Lenorix\BeelSdk\Generated\Endpoint;

class UpdateTaxConfiguration extends \Lenorix\BeelSdk\Generated\Runtime\Client\BaseEndpoint implements \Lenorix\BeelSdk\Generated\Runtime\Client\Endpoint
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
     *
     * @param \Lenorix\BeelSdk\Generated\Model\UpdateTaxConfigurationRequest $requestBody
     */
    public function __construct(\Lenorix\BeelSdk\Generated\Model\UpdateTaxConfigurationRequest $requestBody)
    {
        $this->body = $requestBody;
    }
    use \Lenorix\BeelSdk\Generated\Runtime\Client\EndpointTrait;
    public function getMethod(): string
    {
        return 'PUT';
    }
    public function getUri(): string
    {
        return '/v1/configuration/taxes';
    }
    public function getBody(\Symfony\Component\Serializer\SerializerInterface $serializer, $streamFactory = null): array
    {
        if ($this->body instanceof \Lenorix\BeelSdk\Generated\Model\UpdateTaxConfigurationRequest) {
            return [['Content-Type' => ['application/json']], \Lenorix\BeelSdk\Generated\Runtime\Client\JsonPayload::encode($serializer, $this->body)];
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
     * @throws \Lenorix\BeelSdk\Generated\Exception\UpdateTaxConfigurationBadRequestException
     * @throws \Lenorix\BeelSdk\Generated\Exception\UpdateTaxConfigurationUnauthorizedException
     * @throws \Lenorix\BeelSdk\Generated\Exception\UpdateTaxConfigurationForbiddenException
     * @throws \Lenorix\BeelSdk\Generated\Exception\UpdateTaxConfigurationUnprocessableEntityException
     * @throws \Lenorix\BeelSdk\Generated\Exception\UpdateTaxConfigurationInternalServerErrorException
     *
     * @return null|\Lenorix\BeelSdk\Generated\Model\V1ConfigurationTaxesPutResponse200|\Lenorix\BeelSdk\Generated\Model\ErrorResponse
     */
    protected function transformResponseBody(\Psr\Http\Message\ResponseInterface $response, \Symfony\Component\Serializer\SerializerInterface $serializer, ?string $contentType = null)
    {
        $status = $response->getStatusCode();
        $body = (string) $response->getBody();
        if (is_null($contentType) === false && (200 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            return $serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\V1ConfigurationTaxesPutResponse200', 'json');
        }
        if (is_null($contentType) === false && (400 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\UpdateTaxConfigurationBadRequestException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && (401 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\UpdateTaxConfigurationUnauthorizedException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && (403 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\UpdateTaxConfigurationForbiddenException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && (422 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\UpdateTaxConfigurationUnprocessableEntityException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && (500 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\UpdateTaxConfigurationInternalServerErrorException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
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