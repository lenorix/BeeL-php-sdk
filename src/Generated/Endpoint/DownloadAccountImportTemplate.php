<?php

namespace Lenorix\BeelSdk\Generated\Endpoint;

use Lenorix\BeelSdk\Generated\Exception\DownloadAccountImportTemplateForbiddenException;
use Lenorix\BeelSdk\Generated\Exception\DownloadAccountImportTemplateInternalServerErrorException;
use Lenorix\BeelSdk\Generated\Exception\DownloadAccountImportTemplateTooManyRequestsException;
use Lenorix\BeelSdk\Generated\Exception\DownloadAccountImportTemplateUnauthorizedException;
use Lenorix\BeelSdk\Generated\Model\ErrorResponse;
use Lenorix\BeelSdk\Generated\Runtime\Client\BaseEndpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\Endpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\EndpointTrait;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\Serializer\SerializerInterface;

class DownloadAccountImportTemplate extends BaseEndpoint implements Endpoint
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
     * @param  array  $accept  Accept content header text/csv|application/json
     */
    public function __construct(array $accept = [])
    {
        $this->accept = $accept;
    }

    use EndpointTrait;

    public function getMethod(): string
    {
        return 'GET';
    }

    public function getUri(): string
    {
        return '/v1/templates/account-import';
    }

    public function getBody(SerializerInterface $serializer, $streamFactory = null): array
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
     *
     * @return null|ErrorResponse
     *
     * @throws DownloadAccountImportTemplateUnauthorizedException
     * @throws DownloadAccountImportTemplateForbiddenException
     * @throws DownloadAccountImportTemplateTooManyRequestsException
     * @throws DownloadAccountImportTemplateInternalServerErrorException
     */
    protected function transformResponseBody(ResponseInterface $response, SerializerInterface $serializer, ?string $contentType = null)
    {
        $status = $response->getStatusCode();
        $body = (string) $response->getBody();
        if ($status === 200) {
        }
        if (is_null($contentType) === false && ($status === 401 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new DownloadAccountImportTemplateUnauthorizedException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 403 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new DownloadAccountImportTemplateForbiddenException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 429 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new DownloadAccountImportTemplateTooManyRequestsException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 500 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new DownloadAccountImportTemplateInternalServerErrorException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
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
