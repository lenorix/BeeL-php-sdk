<?php

namespace Lenorix\BeelSdk\Generated\Endpoint;

use Lenorix\BeelSdk\Generated\Exception\DownloadRepresentationForbiddenException;
use Lenorix\BeelSdk\Generated\Exception\DownloadRepresentationInternalServerErrorException;
use Lenorix\BeelSdk\Generated\Exception\DownloadRepresentationNotFoundException;
use Lenorix\BeelSdk\Generated\Exception\DownloadRepresentationUnauthorizedException;
use Lenorix\BeelSdk\Generated\Model\ErrorResponse;
use Lenorix\BeelSdk\Generated\Model\RepresentationDownloadResponse;
use Lenorix\BeelSdk\Generated\Runtime\Client\BaseEndpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\Endpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\EndpointTrait;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\Serializer\SerializerInterface;

class DownloadRepresentation extends BaseEndpoint implements Endpoint
{
    protected $account_id;

    protected $company_id;

    /**
     * Deprecated alias of `GET /v1/companies/{company_id}/representation/document`, with
     * identical behaviour.
     *
     * **Retires on 9 December 2026.** See the [migration guide](https://docs.beel.es/changelog/resources-under-the-nif) for what moved where and what changes when you switch.
     *
     * @param  string  $accountId  Account that owns the NIF. The pair must be coherent, and which answer you get depends on how far you reach: an `{account_id}` you do not reach answers `403` before the NIF is even looked at (the same answer an account that does not exist gets); a `{company_id}` you do not reach, or reach at a level that does not allow the operation — the usual case on writes, since the level checked is the one you hold over the `{account_id}` of the path — answers `403` too; and only a `{company_id}` you do reach but that hangs from a different account answers `404`, so the existence of a NIF in another account is never disclosed.
     */
    public function __construct(string $accountId, string $companyId)
    {
        $this->account_id = $accountId;
        $this->company_id = $companyId;
    }

    use EndpointTrait;

    public function getMethod(): string
    {
        return 'GET';
    }

    public function getUri(): string
    {
        return str_replace(['{account_id}', '{company_id}'], [rawurlencode($this->account_id), rawurlencode($this->company_id)], '/v1/accounts/{account_id}/companies/{company_id}/representation/download');
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
     * @return null|RepresentationDownloadResponse|ErrorResponse
     *
     * @throws DownloadRepresentationUnauthorizedException
     * @throws DownloadRepresentationForbiddenException
     * @throws DownloadRepresentationNotFoundException
     * @throws DownloadRepresentationInternalServerErrorException
     */
    protected function transformResponseBody(ResponseInterface $response, SerializerInterface $serializer, ?string $contentType = null)
    {
        $status = $response->getStatusCode();
        $body = (string) $response->getBody();
        if (is_null($contentType) === false && ($status === 200 && stripos(strtolower($contentType), 'application/json') !== false)) {
            return $serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\RepresentationDownloadResponse', 'json');
        }
        if (is_null($contentType) === false && ($status === 401 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new DownloadRepresentationUnauthorizedException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 403 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new DownloadRepresentationForbiddenException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 404 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new DownloadRepresentationNotFoundException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 500 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new DownloadRepresentationInternalServerErrorException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
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
