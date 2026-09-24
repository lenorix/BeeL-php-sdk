<?php

namespace Lenorix\BeelSdk\Generated\Endpoint;

use Http\Message\MultipartStream\MultipartStreamBuilder;
use Lenorix\BeelSdk\Generated\Exception\ImportHoldedContactsBadRequestException;
use Lenorix\BeelSdk\Generated\Exception\ImportHoldedContactsForbiddenException;
use Lenorix\BeelSdk\Generated\Exception\ImportHoldedContactsInternalServerErrorException;
use Lenorix\BeelSdk\Generated\Exception\ImportHoldedContactsRequestEntityTooLargeException;
use Lenorix\BeelSdk\Generated\Exception\ImportHoldedContactsTooManyRequestsException;
use Lenorix\BeelSdk\Generated\Exception\ImportHoldedContactsUnauthorizedException;
use Lenorix\BeelSdk\Generated\Exception\ImportHoldedContactsUnprocessableEntityException;
use Lenorix\BeelSdk\Generated\Model\ErrorResponse;
use Lenorix\BeelSdk\Generated\Model\V1CustomersImportHoldedContactsPostBody;
use Lenorix\BeelSdk\Generated\Model\V1CustomersImportHoldedContactsPostResponse200;
use Lenorix\BeelSdk\Generated\Runtime\Client\BaseEndpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\Endpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\EndpointTrait;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Serializer\SerializerInterface;

class ImportHoldedContacts extends BaseEndpoint implements Endpoint
{
    /**
     * Parses a contacts export from Holded (`.xlsx`) as Holded produces it, maps each contact
     * to a customer and returns every row with its validation outcome, as the CSV import does.
     *
     * - **Deprecated:** use `POST /v1/companies/{company_id}/customers/imports` with
     *   `source: holded`, which imports the same file. It answers `201` and requires the
     *   `Idempotency-Key` header.
     * - **Mapping:** the contact name becomes `legal_name`, the Holded ID becomes the tax
     *   identifier, and mobile takes precedence over landline for the phone.
     * - **File:** limited to 10 MB and 5,000 contacts.
     * - **`preview`:** at its default `true` nothing is persisted; `false` also imports the
     *   mapped customers.
     *
     * **Retires on 9 December 2026.** See the [migration guide](https://docs.beel.es/changelog/resources-under-the-nif) for what moved where and what changes when you switch.
     *
     * @param array{
     *    "Idempotency-Key"?: string, //Idempotency key to prevent duplicates in sensitive operations.

    - Any unique client-generated string (e.g. an order id). A UUID also works but is not required
    - Allowed characters: letters, digits, `_` and `-` (max 255 chars)
    - If the same key is sent twice, the result of the first operation is returned
    - Keys expire 24 hours after processing

    The key is scoped per user and environment, and bound to the request body, so retrying after
    a network timeout replays the stored response instead of repeating the operation.

    | Status | Code | When |
    |---|---|---|
    | `400` | `INVALID_IDEMPOTENCY_KEY` | The key breaks the format rules above. |
    | `409` | `IDEMPOTENCY_KEY_PROCESSING` | The first request is still in flight. Wait and retry with the same key. |
    | `409` | `IDEMPOTENCY_KEY_MISMATCH` | The key was already used with a **different** body. Use a new key. |
     * } $headerParameters
     */
    public function __construct(V1CustomersImportHoldedContactsPostBody $requestBody, array $headerParameters = [])
    {
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
        return '/v1/customers/import-holded-contacts';
    }

    public function getBody(SerializerInterface $serializer, $streamFactory = null): array
    {
        if ($this->body instanceof V1CustomersImportHoldedContactsPostBody) {
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
        $optionsResolver->setRequired([]);
        $optionsResolver->setDefaults([]);
        $optionsResolver->addAllowedTypes('Idempotency-Key', ['string']);

        return $optionsResolver;
    }

    /**
     * {@inheritdoc}
     *
     *
     * @return null|V1CustomersImportHoldedContactsPostResponse200|ErrorResponse
     *
     * @throws ImportHoldedContactsBadRequestException
     * @throws ImportHoldedContactsUnauthorizedException
     * @throws ImportHoldedContactsForbiddenException
     * @throws ImportHoldedContactsRequestEntityTooLargeException
     * @throws ImportHoldedContactsUnprocessableEntityException
     * @throws ImportHoldedContactsTooManyRequestsException
     * @throws ImportHoldedContactsInternalServerErrorException
     */
    protected function transformResponseBody(ResponseInterface $response, SerializerInterface $serializer, ?string $contentType = null)
    {
        $status = $response->getStatusCode();
        $body = (string) $response->getBody();
        if (is_null($contentType) === false && ($status === 200 && stripos(strtolower($contentType), 'application/json') !== false)) {
            return $serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\V1CustomersImportHoldedContactsPostResponse200', 'json');
        }
        if (is_null($contentType) === false && ($status === 400 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new ImportHoldedContactsBadRequestException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 401 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new ImportHoldedContactsUnauthorizedException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 403 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new ImportHoldedContactsForbiddenException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 413 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new ImportHoldedContactsRequestEntityTooLargeException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 422 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new ImportHoldedContactsUnprocessableEntityException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 429 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new ImportHoldedContactsTooManyRequestsException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 500 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new ImportHoldedContactsInternalServerErrorException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
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
