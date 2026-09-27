<?php

namespace Lenorix\BeelSdk\Generated\Endpoint;

use Http\Message\MultipartStream\MultipartStreamBuilder;
use Lenorix\BeelSdk\Generated\Exception\PreviewCompanyCustomerImportBadRequestException;
use Lenorix\BeelSdk\Generated\Exception\PreviewCompanyCustomerImportForbiddenException;
use Lenorix\BeelSdk\Generated\Exception\PreviewCompanyCustomerImportInternalServerErrorException;
use Lenorix\BeelSdk\Generated\Exception\PreviewCompanyCustomerImportRequestEntityTooLargeException;
use Lenorix\BeelSdk\Generated\Exception\PreviewCompanyCustomerImportTooManyRequestsException;
use Lenorix\BeelSdk\Generated\Exception\PreviewCompanyCustomerImportUnauthorizedException;
use Lenorix\BeelSdk\Generated\Exception\PreviewCompanyCustomerImportUnprocessableEntityException;
use Lenorix\BeelSdk\Generated\Model\ErrorResponse;
use Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdCustomersImportsPreviewPostBody;
use Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdCustomersImportsPreviewPostResponse200;
use Lenorix\BeelSdk\Generated\Runtime\Client\BaseEndpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\Endpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\EndpointTrait;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;
use Symfony\Component\Serializer\SerializerInterface;

class PreviewCompanyCustomerImport extends BaseEndpoint implements Endpoint
{
    protected $company_id;

    /**
     * Parses and validates the file without writing anything: no customer is created. It returns
     * the same per-record outcome the import would produce, so the caller can correct the data
     * before importing it with `POST .../customers/imports`.
     *
     * - **`source`:** the origin travels in the body, exactly as in the import.
     *
     * @param  string  $companyId  Unique identifier (UUID) of the company the operation acts on — its identifier, not its NIF. It is the only source of context: the account that owns it is derived from it, and the `BeeL-Active-Company` header plays no part. A company you do not reach answers `403`, and so does a company that does not exist, so the existence of a company in another account is never disclosed.
     */
    public function __construct(string $companyId, V1CompaniesCompanyIdCustomersImportsPreviewPostBody $requestBody)
    {
        $this->company_id = $companyId;
        $this->body = $requestBody;
    }

    use EndpointTrait;

    public function getMethod(): string
    {
        return 'POST';
    }

    public function getUri(): string
    {
        return str_replace(['{company_id}'], [rawurlencode($this->company_id)], '/v1/companies/{company_id}/customers/imports/preview');
    }

    public function getBody(SerializerInterface $serializer, $streamFactory = null): array
    {
        if ($this->body instanceof V1CompaniesCompanyIdCustomersImportsPreviewPostBody) {
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
     * @return null|V1CompaniesCompanyIdCustomersImportsPreviewPostResponse200|ErrorResponse
     *
     * @throws PreviewCompanyCustomerImportBadRequestException
     * @throws PreviewCompanyCustomerImportUnauthorizedException
     * @throws PreviewCompanyCustomerImportForbiddenException
     * @throws PreviewCompanyCustomerImportRequestEntityTooLargeException
     * @throws PreviewCompanyCustomerImportUnprocessableEntityException
     * @throws PreviewCompanyCustomerImportTooManyRequestsException
     * @throws PreviewCompanyCustomerImportInternalServerErrorException
     */
    protected function transformResponseBody(ResponseInterface $response, SerializerInterface $serializer, ?string $contentType = null)
    {
        $status = $response->getStatusCode();
        $body = (string) $response->getBody();
        if (is_null($contentType) === false && ($status === 200 && stripos(strtolower($contentType), 'application/json') !== false)) {
            return $serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdCustomersImportsPreviewPostResponse200', 'json');
        }
        if (is_null($contentType) === false && ($status === 400 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new PreviewCompanyCustomerImportBadRequestException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ResponseCustomerImportRejected', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 401 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new PreviewCompanyCustomerImportUnauthorizedException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 403 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new PreviewCompanyCustomerImportForbiddenException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 413 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new PreviewCompanyCustomerImportRequestEntityTooLargeException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 422 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new PreviewCompanyCustomerImportUnprocessableEntityException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 429 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new PreviewCompanyCustomerImportTooManyRequestsException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 500 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new PreviewCompanyCustomerImportInternalServerErrorException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
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
