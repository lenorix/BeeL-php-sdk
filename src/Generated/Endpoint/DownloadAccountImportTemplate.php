<?php

namespace Lenorix\BeelSdk\Generated\Endpoint;

class DownloadAccountImportTemplate extends \Lenorix\BeelSdk\Generated\Runtime\Client\BaseEndpoint implements \Lenorix\BeelSdk\Generated\Runtime\Client\Endpoint
{
    protected $accept;
    /**
     * Downloads the sample CSV that `POST /v1/accounts/imports` expects: the required headers plus
     * one example row, separated by semicolons and written with a UTF-8 byte order mark so that
     * Excel opens it with the accents intact — the same conventions as
     * `GET /v1/templates/customer-import`.
     *
     * - **The example row is deliberately not importable:** its tax id has a valid shape and an
     *   impossible check digit, so it is rejected instead of silently provisioning an account.
     *   Replace it with your own rows.
     * - **`customers_file`:** the optional second file of that import is **not** a new format; it
     *   is the customer import template, unchanged. Download it from
     *   `GET /v1/templates/customer-import`.
     * - **Scope:** the file is the same for every credential and does not depend on any account
     *   or on any NIF.
     *
     * @param array $accept Accept content header text/csv|application/json
     */
    public function __construct(array $accept = [])
    {
        $this->accept = $accept;
    }
    use \Lenorix\BeelSdk\Generated\Runtime\Client\EndpointTrait;
    public function getMethod(): string
    {
        return 'GET';
    }
    public function getUri(): string
    {
        return '/v1/templates/account-import';
    }
    public function getBody(\Symfony\Component\Serializer\SerializerInterface $serializer, $streamFactory = null): array
    {
        return [[], null];
    }
    public function getExtraHeaders(): array
    {
        if (empty($this->accept)) {
            return ['Accept' => ['text/csv', 'application/json']];
        }
        return $this->accept;
    }
    /**
     * {@inheritdoc}
     *
     * @throws \Lenorix\BeelSdk\Generated\Exception\DownloadAccountImportTemplateUnauthorizedException
     * @throws \Lenorix\BeelSdk\Generated\Exception\DownloadAccountImportTemplateForbiddenException
     * @throws \Lenorix\BeelSdk\Generated\Exception\DownloadAccountImportTemplateTooManyRequestsException
     * @throws \Lenorix\BeelSdk\Generated\Exception\DownloadAccountImportTemplateInternalServerErrorException
     *
     * @return null|\Lenorix\BeelSdk\Generated\Model\ErrorResponse
     */
    protected function transformResponseBody(\Psr\Http\Message\ResponseInterface $response, \Symfony\Component\Serializer\SerializerInterface $serializer, ?string $contentType = null)
    {
        $status = $response->getStatusCode();
        $body = (string) $response->getBody();
        if (200 === $status) {
        }
        if (is_null($contentType) === false && (401 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\DownloadAccountImportTemplateUnauthorizedException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && (403 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\DownloadAccountImportTemplateForbiddenException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && (429 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\DownloadAccountImportTemplateTooManyRequestsException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && (500 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\DownloadAccountImportTemplateInternalServerErrorException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
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