<?php

namespace Lenorix\BeelSdk\Generated\Endpoint;

use Lenorix\BeelSdk\Generated\Exception\GetCompanyIssuingReadinessBadRequestException;
use Lenorix\BeelSdk\Generated\Exception\GetCompanyIssuingReadinessForbiddenException;
use Lenorix\BeelSdk\Generated\Exception\GetCompanyIssuingReadinessInternalServerErrorException;
use Lenorix\BeelSdk\Generated\Exception\GetCompanyIssuingReadinessTooManyRequestsException;
use Lenorix\BeelSdk\Generated\Exception\GetCompanyIssuingReadinessUnauthorizedException;
use Lenorix\BeelSdk\Generated\Model\ErrorResponse;
use Lenorix\BeelSdk\Generated\Model\IssuingReadinessResponse;
use Lenorix\BeelSdk\Generated\Runtime\Client\BaseEndpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\Endpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\EndpointTrait;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\Serializer\SerializerInterface;

class GetCompanyIssuingReadiness extends BaseEndpoint implements Endpoint
{
    protected $company_id;

    /**
     * Returns whether a company can issue its STANDARD invoice right now in the
     * environment of the request, and the `blockers` that stop it otherwise. Readiness is a
     * per-NIF property, evaluated independently for each company of the account.
     *
     * - **`ready`:** `true` only when `blockers` is empty.
     * - **Activation:** issuing any fiscal document requires the company to be activated in the
     *   environment of that document, whether or not it goes to VeriFactu.
     * - **VeriFactu chain:** the AEAT census and signed representation are additionally
     *   demanded only when the company is under the VeriFactu regime in this environment —
     *   the same fact that decides, at issue time, whether its invoices are registered. A
     *   company with VeriFactu off is ready with a NIF, a default series and an activation,
     *   and the separate `verifactu` block reports the compliance chain independently.
     * - **Not evaluated:** the account's quota or subscription, and the payload of any
     *   particular invoice.
     *
     * @param  string  $companyId  Unique identifier (UUID) of the company whose issuing readiness is evaluated — its identifier, not its NIF. It is the only source of context: the account that owns it is derived from it, and the `BeeL-Active-Company` header plays no part. A company you do not reach answers `403`, and so does a company that does not exist.
     */
    public function __construct(string $companyId)
    {
        $this->company_id = $companyId;
    }

    use EndpointTrait;

    public function getMethod(): string
    {
        return 'GET';
    }

    public function getUri(): string
    {
        return str_replace(['{company_id}'], [rawurlencode($this->company_id)], '/v1/companies/{company_id}/issuing-readiness');
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
     * @return null|IssuingReadinessResponse|ErrorResponse
     *
     * @throws GetCompanyIssuingReadinessBadRequestException
     * @throws GetCompanyIssuingReadinessUnauthorizedException
     * @throws GetCompanyIssuingReadinessForbiddenException
     * @throws GetCompanyIssuingReadinessTooManyRequestsException
     * @throws GetCompanyIssuingReadinessInternalServerErrorException
     */
    protected function transformResponseBody(ResponseInterface $response, SerializerInterface $serializer, ?string $contentType = null)
    {
        $status = $response->getStatusCode();
        $body = (string) $response->getBody();
        if (is_null($contentType) === false && ($status === 200 && stripos(strtolower($contentType), 'application/json') !== false)) {
            return $serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\IssuingReadinessResponse', 'json');
        }
        if (is_null($contentType) === false && ($status === 400 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new GetCompanyIssuingReadinessBadRequestException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 401 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new GetCompanyIssuingReadinessUnauthorizedException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 403 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new GetCompanyIssuingReadinessForbiddenException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 429 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new GetCompanyIssuingReadinessTooManyRequestsException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 500 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new GetCompanyIssuingReadinessInternalServerErrorException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
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
