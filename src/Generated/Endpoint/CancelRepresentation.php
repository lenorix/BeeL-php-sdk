<?php

namespace Lenorix\BeelSdk\Generated\Endpoint;

class CancelRepresentation extends \Lenorix\BeelSdk\Generated\Runtime\Client\BaseEndpoint implements \Lenorix\BeelSdk\Generated\Runtime\Client\Endpoint
{
    protected $account_id;
    protected $company_id;
    /**
     * Deprecated predecessor of `DELETE /v1/companies/{company_id}/representation`. It cancels
     * the same representation, but answers `200` with a body where the canonical route answers
     * `204`.
     *
     * **Retires on 9 December 2026.** See the [migration guide](https://docs.beel.es/changelog/resources-under-the-nif) for what moved where and what changes when you switch.
     *
     * @param string $accountId Account that owns the NIF. The pair must be coherent, and which answer you get depends on how far you reach: an `{account_id}` you do not reach answers `403` before the NIF is even looked at (the same answer an account that does not exist gets); a `{company_id}` you do not reach, or reach at a level that does not allow the operation — the usual case on writes, since the level checked is the one you hold over the `{account_id}` of the path — answers `403` too; and only a `{company_id}` you do reach but that hangs from a different account answers `404`, so the existence of a NIF in another account is never disclosed.
     * @param string $companyId
     */
    public function __construct(string $accountId, string $companyId)
    {
        $this->account_id = $accountId;
        $this->company_id = $companyId;
    }
    use \Lenorix\BeelSdk\Generated\Runtime\Client\EndpointTrait;
    public function getMethod(): string
    {
        return 'DELETE';
    }
    public function getUri(): string
    {
        return str_replace(['{account_id}', '{company_id}'], [rawurlencode($this->account_id), rawurlencode($this->company_id)], '/v1/accounts/{account_id}/companies/{company_id}/representation/cancel');
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
     * @throws \Lenorix\BeelSdk\Generated\Exception\CancelRepresentationUnauthorizedException
     * @throws \Lenorix\BeelSdk\Generated\Exception\CancelRepresentationForbiddenException
     * @throws \Lenorix\BeelSdk\Generated\Exception\CancelRepresentationNotFoundException
     * @throws \Lenorix\BeelSdk\Generated\Exception\CancelRepresentationInternalServerErrorException
     *
     * @return null|\Lenorix\BeelSdk\Generated\Model\RepresentationActionResponse|\Lenorix\BeelSdk\Generated\Model\ErrorResponse
     */
    protected function transformResponseBody(\Psr\Http\Message\ResponseInterface $response, \Symfony\Component\Serializer\SerializerInterface $serializer, ?string $contentType = null)
    {
        $status = $response->getStatusCode();
        $body = (string) $response->getBody();
        if (is_null($contentType) === false && (200 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            return $serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\RepresentationActionResponse', 'json');
        }
        if (is_null($contentType) === false && (401 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\CancelRepresentationUnauthorizedException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && (403 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\CancelRepresentationForbiddenException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && (404 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\CancelRepresentationNotFoundException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && (500 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\CancelRepresentationInternalServerErrorException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
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