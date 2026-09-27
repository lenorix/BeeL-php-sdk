<?php

namespace Lenorix\BeelSdk\Generated\Endpoint;

class DownloadCustomerImportTemplate extends \Lenorix\BeelSdk\Generated\Runtime\Client\BaseEndpoint implements \Lenorix\BeelSdk\Generated\Runtime\Client\Endpoint
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
        return '/v1/templates/customer-import';
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
     * @throws \Lenorix\BeelSdk\Generated\Exception\DownloadCustomerImportTemplateUnauthorizedException
     * @throws \Lenorix\BeelSdk\Generated\Exception\DownloadCustomerImportTemplateForbiddenException
     * @throws \Lenorix\BeelSdk\Generated\Exception\DownloadCustomerImportTemplateTooManyRequestsException
     * @throws \Lenorix\BeelSdk\Generated\Exception\DownloadCustomerImportTemplateInternalServerErrorException
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
            throw new \Lenorix\BeelSdk\Generated\Exception\DownloadCustomerImportTemplateUnauthorizedException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && (403 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\DownloadCustomerImportTemplateForbiddenException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && (429 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\DownloadCustomerImportTemplateTooManyRequestsException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && (500 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\DownloadCustomerImportTemplateInternalServerErrorException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
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