<?php

namespace Lenorix\BeelSdk\Generated\Endpoint;

use Lenorix\BeelSdk\Generated\Exception\DownloadCustomerImportTemplateForbiddenException;
use Lenorix\BeelSdk\Generated\Exception\DownloadCustomerImportTemplateInternalServerErrorException;
use Lenorix\BeelSdk\Generated\Exception\DownloadCustomerImportTemplateTooManyRequestsException;
use Lenorix\BeelSdk\Generated\Exception\DownloadCustomerImportTemplateUnauthorizedException;
use Lenorix\BeelSdk\Generated\Model\ErrorResponse;
use Lenorix\BeelSdk\Generated\Runtime\Client\BaseEndpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\Endpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\EndpointTrait;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\Serializer\SerializerInterface;

class DownloadCustomerImportTemplate extends BaseEndpoint implements Endpoint
{
    protected $accept;

    /**
     * Downloads the sample CSV that `POST /v1/customers/import-csv-preview` expects: the required
     * headers plus example rows, separated by semicolons and written with a UTF-8 byte order mark
     * so that Excel opens it with the accents intact.
     *
     * - **Example rows:** every one is importable as it stands — commas, quotes and accents
     *   included — so the template can be uploaded unchanged as a first test of the import.
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
        return '/v1/templates/customer-import';
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
     * @throws DownloadCustomerImportTemplateUnauthorizedException
     * @throws DownloadCustomerImportTemplateForbiddenException
     * @throws DownloadCustomerImportTemplateTooManyRequestsException
     * @throws DownloadCustomerImportTemplateInternalServerErrorException
     */
    protected function transformResponseBody(ResponseInterface $response, SerializerInterface $serializer, ?string $contentType = null)
    {
        $status = $response->getStatusCode();
        $body = (string) $response->getBody();
        if ($status === 200) {
        }
        if (is_null($contentType) === false && ($status === 401 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new DownloadCustomerImportTemplateUnauthorizedException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 403 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new DownloadCustomerImportTemplateForbiddenException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 429 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new DownloadCustomerImportTemplateTooManyRequestsException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 500 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new DownloadCustomerImportTemplateInternalServerErrorException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
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
