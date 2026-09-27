<?php

namespace Lenorix\BeelSdk\Generated\Endpoint;

class UpdateCompanyVeriFactuConfiguration extends \Lenorix\BeelSdk\Generated\Runtime\Client\BaseEndpoint implements \Lenorix\BeelSdk\Generated\Runtime\Client\Endpoint
{
    protected $company_id;
    /**
     * Replaces the VeriFactu configuration of a company.
     *
     * - **Writable fields:** only `enabled`, and it is required — this is a full replacement, not
     *   a partial merge. The rest of the returned configuration is resolved server-side.
     * - **Turning it on registers the NIF with the provider in the same call**, atomically: if the
     *   provider rejects it nothing is persisted and the response carries the reason. In Live it
     *   requires a signed and validated AEAT representation first, or
     *   `422 VERIFACTU_REPRESENTATION_REQUIRED`.
     * - **Sandbox is always on:** `enabled: false` there answers
     *   `422 VERIFACTU_ALWAYS_ON_IN_SANDBOX`.
     *
     * ## Turning it off
     *
     * Setting `enabled` to false stops sending this company's invoices to AEAT and starts the
     * deregistration of the NIF with the VeriFactu provider. It does not deactivate the
     * company: the activation is a fact of its own for the (company, environment) pair, so the
     * company keeps issuing in that environment and stays `ready`. Releasing the NIF — and in
     * Live freeing it for another account — is always
     * `DELETE /v1/companies/{company_id}/activations`.
     *
     * @param string $companyId Unique identifier (UUID) of the company the operation acts on — its identifier, not its NIF. It is the only source of context: the account that owns it is derived from it, and the `BeeL-Active-Company` header plays no part. A company you do not reach answers `403`, and so does a company that does not exist, so the existence of a company in another account is never disclosed.
     * @param \Lenorix\BeelSdk\Generated\Model\UpdateVeriFactuConfigurationRequest $requestBody
     */
    public function __construct(string $companyId, \Lenorix\BeelSdk\Generated\Model\UpdateVeriFactuConfigurationRequest $requestBody)
    {
        $this->company_id = $companyId;
        $this->body = $requestBody;
    }
    use \Lenorix\BeelSdk\Generated\Runtime\Client\EndpointTrait;
    public function getMethod(): string
    {
        return 'PUT';
    }
    public function getUri(): string
    {
        return str_replace(['{company_id}'], [rawurlencode($this->company_id)], '/v1/companies/{company_id}/verifactu-configuration');
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
     * @throws \Lenorix\BeelSdk\Generated\Exception\UpdateCompanyVeriFactuConfigurationBadRequestException
     * @throws \Lenorix\BeelSdk\Generated\Exception\UpdateCompanyVeriFactuConfigurationUnauthorizedException
     * @throws \Lenorix\BeelSdk\Generated\Exception\UpdateCompanyVeriFactuConfigurationForbiddenException
     * @throws \Lenorix\BeelSdk\Generated\Exception\UpdateCompanyVeriFactuConfigurationUnprocessableEntityException
     * @throws \Lenorix\BeelSdk\Generated\Exception\UpdateCompanyVeriFactuConfigurationTooManyRequestsException
     * @throws \Lenorix\BeelSdk\Generated\Exception\UpdateCompanyVeriFactuConfigurationInternalServerErrorException
     *
     * @return null|\Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdVerifactuConfigurationPutResponse200|\Lenorix\BeelSdk\Generated\Model\ErrorResponse
     */
    protected function transformResponseBody(\Psr\Http\Message\ResponseInterface $response, \Symfony\Component\Serializer\SerializerInterface $serializer, ?string $contentType = null)
    {
        $status = $response->getStatusCode();
        $body = (string) $response->getBody();
        if (is_null($contentType) === false && (200 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            return $serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdVerifactuConfigurationPutResponse200', 'json');
        }
        if (is_null($contentType) === false && (400 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\UpdateCompanyVeriFactuConfigurationBadRequestException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && (401 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\UpdateCompanyVeriFactuConfigurationUnauthorizedException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && (403 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\UpdateCompanyVeriFactuConfigurationForbiddenException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && (422 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\UpdateCompanyVeriFactuConfigurationUnprocessableEntityException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && (429 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\UpdateCompanyVeriFactuConfigurationTooManyRequestsException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && (500 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\UpdateCompanyVeriFactuConfigurationInternalServerErrorException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
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