<?php

namespace Lenorix\BeelSdk\Generated\Endpoint;

use Lenorix\BeelSdk\Generated\Exception\DownloadCustomerTemplateCsvForbiddenException;
use Lenorix\BeelSdk\Generated\Exception\DownloadCustomerTemplateCsvInternalServerErrorException;
use Lenorix\BeelSdk\Generated\Exception\DownloadCustomerTemplateCsvTooManyRequestsException;
use Lenorix\BeelSdk\Generated\Exception\DownloadCustomerTemplateCsvUnauthorizedException;
use Lenorix\BeelSdk\Generated\Model\ErrorResponse;
use Lenorix\BeelSdk\Generated\Runtime\Client\BaseEndpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\Endpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\EndpointTrait;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\Serializer\SerializerInterface;

class DownloadCustomerTemplateCsv extends BaseEndpoint implements Endpoint
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
     * @param  array  $accept  Accept content header text/csv|application/json
     */
    public function __construct(array $accept = [])
    {
        $this->accept = $accept;
    }

    use EndpointTrait;

    public function getMethod(): string
    {
        return 'POST';
    }

    public function getUri(): string
    {
        return '/v1/customers/templates/csv';
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
     * @throws DownloadCustomerTemplateCsvUnauthorizedException
     * @throws DownloadCustomerTemplateCsvForbiddenException
     * @throws DownloadCustomerTemplateCsvTooManyRequestsException
     * @throws DownloadCustomerTemplateCsvInternalServerErrorException
     */
    protected function transformResponseBody(ResponseInterface $response, SerializerInterface $serializer, ?string $contentType = null)
    {
        $status = $response->getStatusCode();
        $body = (string) $response->getBody();
        if ($status === 200) {
        }
        if (is_null($contentType) === false && ($status === 401 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new DownloadCustomerTemplateCsvUnauthorizedException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 403 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new DownloadCustomerTemplateCsvForbiddenException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 429 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new DownloadCustomerTemplateCsvTooManyRequestsException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 500 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new DownloadCustomerTemplateCsvInternalServerErrorException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
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
