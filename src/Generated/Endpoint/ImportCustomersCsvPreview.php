<?php

namespace Lenorix\BeelSdk\Generated\Endpoint;

use Http\Message\MultipartStream\MultipartStreamBuilder;
use Lenorix\BeelSdk\Generated\Exception\ImportCustomersCsvPreviewBadRequestException;
use Lenorix\BeelSdk\Generated\Exception\ImportCustomersCsvPreviewForbiddenException;
use Lenorix\BeelSdk\Generated\Exception\ImportCustomersCsvPreviewInternalServerErrorException;
use Lenorix\BeelSdk\Generated\Exception\ImportCustomersCsvPreviewRequestEntityTooLargeException;
use Lenorix\BeelSdk\Generated\Exception\ImportCustomersCsvPreviewTooManyRequestsException;
use Lenorix\BeelSdk\Generated\Exception\ImportCustomersCsvPreviewUnauthorizedException;
use Lenorix\BeelSdk\Generated\Exception\ImportCustomersCsvPreviewUnprocessableEntityException;
use Lenorix\BeelSdk\Generated\Model\ErrorResponse;
use Lenorix\BeelSdk\Generated\Model\V1CustomersImportCsvPreviewPostBody;
use Lenorix\BeelSdk\Generated\Model\V1CustomersImportCsvPreviewPostResponse200;
use Lenorix\BeelSdk\Generated\Runtime\Client\BaseEndpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\Endpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\EndpointTrait;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;
use Symfony\Component\Serializer\SerializerInterface;

class ImportCustomersCsvPreview extends BaseEndpoint implements Endpoint
{
    /**
     * Parses a CSV of customers and returns every row with its validation outcome, the
     * rejected ones included.
     *
     * - **Deprecated:** use `POST /v1/companies/{company_id}/customers/imports/preview`, which
     *   parses and validates the file without writing anything — what this route does by
     *   default. To actually import, use `POST /v1/companies/{company_id}/customers/imports`,
     *   where the origin of the file travels in the body as `source` and a boolean no longer
     *   decides between looking and writing.
     * - **File:** must use the headers of the template served by
     *   `GET /v1/templates/customer-import`, and is limited to 5 MB and 1,000 rows.
     * - **Validation:** each row is checked against the same rules as single-customer creation,
     *   plus duplicate detection within the file and against existing customers, and a NIF
     *   lookup in the AEAT register.
     * - **`dry_run`:** at its default `true` nothing is persisted; `false` also persists the
     *   valid customers.
     *
     * **Retires on 9 December 2026.** See the [migration guide](https://docs.beel.es/changelog/resources-under-the-nif) for what moved where and what changes when you switch.
     */
    public function __construct(V1CustomersImportCsvPreviewPostBody $requestBody)
    {
        $this->body = $requestBody;
    }

    use EndpointTrait;

    public function getMethod(): string
    {
        return 'POST';
    }

    public function getUri(): string
    {
        return '/v1/customers/import-csv-preview';
    }

    public function getBody(SerializerInterface $serializer, $streamFactory = null): array
    {
        if ($this->body instanceof V1CustomersImportCsvPreviewPostBody) {
            $bodyBuilder = new MultipartStreamBuilder($streamFactory);
            $formParameters = $serializer->normalize($this->body, 'json');
            $partOptions = ['file' => ['filename' => 'file']];
            foreach ($formParameters as $key => $value) {
                $value = is_int($value) ? (string) $value : $value;
                $value = is_bool($value) ? $value ? 'true' : 'false' : $value;
                if (is_array($value) || $value instanceof \stdClass) {
                    $value = $serializer->serialize((array) $value, 'json');
                }
                $resourceOptions = $partOptions[$key] ?? [];
                if (isset($resourceOptions['filename'])) {
                    $uri = null;
                    if ($value instanceof StreamInterface) {
                        $uri = $value->getMetadata('uri');
                    } elseif (is_resource($value)) {
                        $uri = stream_get_meta_data($value)['uri'] ?? null;
                    }
                    if (is_string($uri) && is_file($uri)) {
                        unset($resourceOptions['filename']);
                    }
                }
                $bodyBuilder->addResource($key, $value, $resourceOptions);
            }

            return [['Content-Type' => ['multipart/form-data; boundary="'.($bodyBuilder->getBoundary().'"')]], $bodyBuilder->build()];
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
     *
     * @return null|V1CustomersImportCsvPreviewPostResponse200|ErrorResponse
     *
     * @throws ImportCustomersCsvPreviewBadRequestException
     * @throws ImportCustomersCsvPreviewUnauthorizedException
     * @throws ImportCustomersCsvPreviewForbiddenException
     * @throws ImportCustomersCsvPreviewRequestEntityTooLargeException
     * @throws ImportCustomersCsvPreviewUnprocessableEntityException
     * @throws ImportCustomersCsvPreviewTooManyRequestsException
     * @throws ImportCustomersCsvPreviewInternalServerErrorException
     */
    protected function transformResponseBody(ResponseInterface $response, SerializerInterface $serializer, ?string $contentType = null)
    {
        $status = $response->getStatusCode();
        $body = (string) $response->getBody();
        if (is_null($contentType) === false && ($status === 200 && stripos(strtolower($contentType), 'application/json') !== false)) {
            return $serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\V1CustomersImportCsvPreviewPostResponse200', 'json');
        }
        if (is_null($contentType) === false && ($status === 400 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new ImportCustomersCsvPreviewBadRequestException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 401 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new ImportCustomersCsvPreviewUnauthorizedException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 403 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new ImportCustomersCsvPreviewForbiddenException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 413 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new ImportCustomersCsvPreviewRequestEntityTooLargeException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 422 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new ImportCustomersCsvPreviewUnprocessableEntityException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 429 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new ImportCustomersCsvPreviewTooManyRequestsException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 500 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new ImportCustomersCsvPreviewInternalServerErrorException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
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
