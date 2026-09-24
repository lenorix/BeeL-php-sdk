<?php

namespace Lenorix\BeelSdk\Generated\Endpoint;

class UpdateVeriFactuConfiguration extends \Lenorix\BeelSdk\Generated\Runtime\Client\BaseEndpoint implements \Lenorix\BeelSdk\Generated\Runtime\Client\Endpoint
{
    /**
     * **Deprecated.** Use `PUT /v1/companies/{company_id}/verifactu-configuration`, which
     * behaves identically.
     *
     * Updates the VeriFactu configuration of the company in focus.
     *
     * - **Writable fields:** only `enabled`. The rest of the returned
     *   configuration (`status`, `signed`, `activated`, `nif_status`) is resolved server-side.
     * - **Full replacement:** `enabled` is required — this PUT replaces the whole state, it is
     *   not a partial merge, so omitting it is a client error and not a silent `false`.
     * - **Turning it on registers the NIF with the provider in the same call**, atomically: if
     *   the provider rejects it nothing is persisted and the response carries the reason. In Live
     *   it requires a signed and validated AEAT representation first, or `422`
     *   `VERIFACTU_REPRESENTATION_REQUIRED`.
     * - **Sandbox is always on:** `enabled: false` there answers `422`
     *   `VERIFACTU_ALWAYS_ON_IN_SANDBOX`.
     *
     * ## Turning it off
     *
     * Setting `enabled` to false stops sending invoices to the AEAT and starts the
     * deregistration of the NIF with the VeriFactu provider. It does **not** deactivate the
     * NIF: the activation is a fact of its own for the (company, environment) pair, so issuing
     * carries on and `issuing-readiness` stays `ready`. Releasing the NIF is always
     * `DELETE /v1/companies/{company_id}/activations`, with its own guarantees.
     *
     * **Retires on 9 December 2026.** See the [migration guide](https://docs.beel.es/changelog/resources-under-the-nif) for what moved where and what changes when you switch.
     *
     * @param \Lenorix\BeelSdk\Generated\Model\UpdateVeriFactuConfigurationRequest $requestBody
     */
    public function __construct(\Lenorix\BeelSdk\Generated\Model\UpdateVeriFactuConfigurationRequest $requestBody)
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
        return '/v1/configuration/verifactu';
    }
    public function getBody(\Symfony\Component\Serializer\SerializerInterface $serializer, $streamFactory = null): array
    {
        if ($this->body instanceof \Lenorix\BeelSdk\Generated\Model\UpdateVeriFactuConfigurationRequest) {
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
     * @throws \Lenorix\BeelSdk\Generated\Exception\UpdateVeriFactuConfigurationBadRequestException
     * @throws \Lenorix\BeelSdk\Generated\Exception\UpdateVeriFactuConfigurationUnauthorizedException
     * @throws \Lenorix\BeelSdk\Generated\Exception\UpdateVeriFactuConfigurationForbiddenException
     * @throws \Lenorix\BeelSdk\Generated\Exception\UpdateVeriFactuConfigurationUnprocessableEntityException
     * @throws \Lenorix\BeelSdk\Generated\Exception\UpdateVeriFactuConfigurationInternalServerErrorException
     *
     * @return null|\Lenorix\BeelSdk\Generated\Model\V1ConfigurationVerifactuPutResponse200|\Lenorix\BeelSdk\Generated\Model\ErrorResponse
     */
    protected function transformResponseBody(\Psr\Http\Message\ResponseInterface $response, \Symfony\Component\Serializer\SerializerInterface $serializer, ?string $contentType = null)
    {
        $status = $response->getStatusCode();
        $body = (string) $response->getBody();
        if (is_null($contentType) === false && (200 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            return $serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\V1ConfigurationVerifactuPutResponse200', 'json');
        }
        if (is_null($contentType) === false && (400 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\UpdateVeriFactuConfigurationBadRequestException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && (401 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\UpdateVeriFactuConfigurationUnauthorizedException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && (403 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\UpdateVeriFactuConfigurationForbiddenException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && (422 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\UpdateVeriFactuConfigurationUnprocessableEntityException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && (500 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\UpdateVeriFactuConfigurationInternalServerErrorException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
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