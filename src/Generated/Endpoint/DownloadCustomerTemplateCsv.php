<?php

namespace Lenorix\BeelSdk\Generated\Endpoint;

class DownloadCustomerTemplateCsv extends \Lenorix\BeelSdk\Generated\Runtime\Client\BaseEndpoint implements \Lenorix\BeelSdk\Generated\Runtime\Client\Endpoint
{
    protected $accept;
    /**
     * Downloads a sample CSV for customer import: the required headers plus example rows, written
     * with a UTF-8 byte order mark so that Excel opens it with the accents intact.
     *
     * - **Deprecated:** use `GET /v1/templates/customer-import`, which returns the same file.
     *   Reading a fixed template is not a `POST`, and the template belongs to no customer.
     * - **Retirement:** the response announces the retirement date in its `Sunset` header.
     *
     * **Retires on 9 December 2026.** See the [migration guide](https://docs.beel.es/changelog/resources-under-the-nif) for what moved where and what changes when you switch.
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
        return 'POST';
    }
    public function getUri(): string
    {
        return '/v1/customers/templates/csv';
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
     * @throws \Lenorix\BeelSdk\Generated\Exception\DownloadCustomerTemplateCsvUnauthorizedException
     * @throws \Lenorix\BeelSdk\Generated\Exception\DownloadCustomerTemplateCsvForbiddenException
     * @throws \Lenorix\BeelSdk\Generated\Exception\DownloadCustomerTemplateCsvTooManyRequestsException
     * @throws \Lenorix\BeelSdk\Generated\Exception\DownloadCustomerTemplateCsvInternalServerErrorException
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
            throw new \Lenorix\BeelSdk\Generated\Exception\DownloadCustomerTemplateCsvUnauthorizedException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && (403 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\DownloadCustomerTemplateCsvForbiddenException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && (429 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\DownloadCustomerTemplateCsvTooManyRequestsException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && (500 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\DownloadCustomerTemplateCsvInternalServerErrorException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
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