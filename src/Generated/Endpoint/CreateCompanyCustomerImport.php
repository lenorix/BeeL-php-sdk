<?php

namespace Lenorix\BeelSdk\Generated\Endpoint;

use Http\Message\MultipartStream\MultipartStreamBuilder;
use Lenorix\BeelSdk\Generated\Exception\CreateCompanyCustomerImportBadRequestException;
use Lenorix\BeelSdk\Generated\Exception\CreateCompanyCustomerImportForbiddenException;
use Lenorix\BeelSdk\Generated\Exception\CreateCompanyCustomerImportInternalServerErrorException;
use Lenorix\BeelSdk\Generated\Exception\CreateCompanyCustomerImportRequestEntityTooLargeException;
use Lenorix\BeelSdk\Generated\Exception\CreateCompanyCustomerImportTooManyRequestsException;
use Lenorix\BeelSdk\Generated\Exception\CreateCompanyCustomerImportUnauthorizedException;
use Lenorix\BeelSdk\Generated\Exception\CreateCompanyCustomerImportUnprocessableEntityException;
use Lenorix\BeelSdk\Generated\Model\ErrorResponse;
use Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdCustomersImportsPostBody;
use Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdCustomersImportsPostResponse201;
use Lenorix\BeelSdk\Generated\Runtime\Client\BaseEndpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\Endpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\EndpointTrait;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Serializer\SerializerInterface;

class CreateCompanyCustomerImport extends BaseEndpoint implements Endpoint
{
    protected $company_id;

    /**
     * Imports customers into this company from an uploaded file.
     *
     * - **`source`:** the origin travels in the body. `csv` is a file following the import
     *   template, limited to 5 MB and 1,000 records; `holded` is an Excel (`.xlsx`) exported from
     *   Holded contacts, limited to 10 MB and 5,000 records. A file over the limit of its `source`
     *   answers `413`.
     * - **This operation writes:** the customers it accepts are created, and a record whose tax
     *   identifier already exists in this company is reported as a duplicate rather than created
     *   again, so re-importing the same file duplicates nothing.
     * - **`Idempotency-Key`:** required on this operation.
     * - **Rehearsal:** to see what would happen without writing anything, use
     *   `POST .../customers/imports/preview`, a separate operation with no effects at all — the
     *   import is never governed by a boolean flag.
     *
     * @param  string  $companyId  Unique identifier (UUID) of the company the operation acts on — its identifier, not its NIF. It is the only source of context: the account that owns it is derived from it, and the `BeeL-Active-Company` header plays no part. A company you do not reach answers `403`, and so does a company that does not exist, so the existence of a company in another account is never disclosed.
     * @param array{
     *    "Idempotency-Key": string, //Same key as `Idempotency-Key` above, but **required**: the operation writes many rows per
    call, so a retry without a key would import the same file twice. A missing key answers
    `400 IDEMPOTENCY_KEY_REQUIRED`.
     * } $headerParameters
     */
    public function __construct(string $companyId, V1CompaniesCompanyIdCustomersImportsPostBody $requestBody, array $headerParameters = [])
    {
        $this->company_id = $companyId;
        $this->body = $requestBody;
        $this->headerParameters = $headerParameters;
    }

    use EndpointTrait;

    public function getMethod(): string
    {
        return 'POST';
    }

    public function getUri(): string
    {
        return str_replace(['{company_id}'], [rawurlencode($this->company_id)], '/v1/companies/{company_id}/customers/imports');
    }

    public function getBody(SerializerInterface $serializer, $streamFactory = null): array
    {
        if ($this->body instanceof V1CompaniesCompanyIdCustomersImportsPostBody) {
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

    protected function getHeadersOptionsResolver(): OptionsResolver
    {
        $optionsResolver = parent::getHeadersOptionsResolver();
        $optionsResolver->setDefined(['Idempotency-Key']);
        $optionsResolver->setRequired(['Idempotency-Key']);
        $optionsResolver->setDefaults([]);
        $optionsResolver->addAllowedTypes('Idempotency-Key', ['string']);

        return $optionsResolver;
    }

    /**
     * {@inheritdoc}
     *
     *
     * @return null|V1CompaniesCompanyIdCustomersImportsPostResponse201|ErrorResponse
     *
     * @throws CreateCompanyCustomerImportBadRequestException
     * @throws CreateCompanyCustomerImportUnauthorizedException
     * @throws CreateCompanyCustomerImportForbiddenException
     * @throws CreateCompanyCustomerImportRequestEntityTooLargeException
     * @throws CreateCompanyCustomerImportUnprocessableEntityException
     * @throws CreateCompanyCustomerImportTooManyRequestsException
     * @throws CreateCompanyCustomerImportInternalServerErrorException
     */
    protected function transformResponseBody(ResponseInterface $response, SerializerInterface $serializer, ?string $contentType = null)
    {
        $status = $response->getStatusCode();
        $body = (string) $response->getBody();
        if (is_null($contentType) === false && ($status === 201 && stripos(strtolower($contentType), 'application/json') !== false)) {
            return $serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdCustomersImportsPostResponse201', 'json');
        }
        if (is_null($contentType) === false && ($status === 400 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new CreateCompanyCustomerImportBadRequestException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ResponseCustomerImportRejected', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 401 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new CreateCompanyCustomerImportUnauthorizedException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 403 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new CreateCompanyCustomerImportForbiddenException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 413 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new CreateCompanyCustomerImportRequestEntityTooLargeException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 422 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new CreateCompanyCustomerImportUnprocessableEntityException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 429 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new CreateCompanyCustomerImportTooManyRequestsException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 500 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new CreateCompanyCustomerImportInternalServerErrorException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
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
