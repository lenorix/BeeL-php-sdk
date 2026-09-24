<?php

namespace Lenorix\BeelSdk\Generated\Endpoint;

use Http\Message\MultipartStream\MultipartStreamBuilder;
use Lenorix\BeelSdk\Generated\Exception\PreviewAccountImportBadRequestException;
use Lenorix\BeelSdk\Generated\Exception\PreviewAccountImportForbiddenException;
use Lenorix\BeelSdk\Generated\Exception\PreviewAccountImportInternalServerErrorException;
use Lenorix\BeelSdk\Generated\Exception\PreviewAccountImportPaymentRequiredException;
use Lenorix\BeelSdk\Generated\Exception\PreviewAccountImportRequestEntityTooLargeException;
use Lenorix\BeelSdk\Generated\Exception\PreviewAccountImportTooManyRequestsException;
use Lenorix\BeelSdk\Generated\Exception\PreviewAccountImportUnauthorizedException;
use Lenorix\BeelSdk\Generated\Exception\PreviewAccountImportUnprocessableEntityException;
use Lenorix\BeelSdk\Generated\Model\AccountImportUpload;
use Lenorix\BeelSdk\Generated\Model\ErrorResponse;
use Lenorix\BeelSdk\Generated\Model\V1AccountsImportsPreviewPostResponse200;
use Lenorix\BeelSdk\Generated\Runtime\Client\BaseEndpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\Endpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\EndpointTrait;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;
use Symfony\Component\Serializer\SerializerInterface;

class PreviewAccountImport extends BaseEndpoint implements Endpoint
{
    /**
     * Reads the same files as `POST /v1/accounts/imports` and answers the same shape without
     * writing anything: no account is provisioned, no NIF is switched on, no series and no
     * customer are created, and nothing is billed.
     *
     * - **Result shape:** `metadata.is_dry_run` is `true`, every write counter in `statistics` is
     *   `0`, and `statistics.importable` is what a real import would create.
     * - **Per row:** it resolves the row's own data — including the repairs a spreadsheet export
     *   needs, which `accounts_file` describes — whether the tax id is in the AEAT register,
     *   whether the `external_ref` is already an account of yours, and the Live activation
     *   verdict that decides whether the import would execute the row at all.
     * - **`statistics.live_activations_pending`:** read it before importing. Every NIF switched
     *   on in Live adds an item to your subscription, and this is the only place to see the total
     *   before it is charged.
     * - **The customers file** is checked once for the whole import: whether a customer is new to
     *   a given account depends on the account, and that only shows up when the import runs.
     */
    public function __construct(AccountImportUpload $requestBody)
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
        return '/v1/accounts/imports/preview';
    }

    public function getBody(SerializerInterface $serializer, $streamFactory = null): array
    {
        if ($this->body instanceof AccountImportUpload) {
            $bodyBuilder = new MultipartStreamBuilder($streamFactory);
            $formParameters = $serializer->normalize($this->body, 'json');
            $partOptions = ['accounts_file' => ['filename' => 'accounts_file'], 'customers_file' => ['filename' => 'customers_file'], 'options' => ['headers' => ['Content-Type' => 'application/json']]];
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
     * @return null|V1AccountsImportsPreviewPostResponse200|ErrorResponse
     *
     * @throws PreviewAccountImportBadRequestException
     * @throws PreviewAccountImportUnauthorizedException
     * @throws PreviewAccountImportPaymentRequiredException
     * @throws PreviewAccountImportForbiddenException
     * @throws PreviewAccountImportRequestEntityTooLargeException
     * @throws PreviewAccountImportUnprocessableEntityException
     * @throws PreviewAccountImportTooManyRequestsException
     * @throws PreviewAccountImportInternalServerErrorException
     */
    protected function transformResponseBody(ResponseInterface $response, SerializerInterface $serializer, ?string $contentType = null)
    {
        $status = $response->getStatusCode();
        $body = (string) $response->getBody();
        if (is_null($contentType) === false && ($status === 200 && stripos(strtolower($contentType), 'application/json') !== false)) {
            return $serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\V1AccountsImportsPreviewPostResponse200', 'json');
        }
        if (is_null($contentType) === false && ($status === 400 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new PreviewAccountImportBadRequestException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 401 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new PreviewAccountImportUnauthorizedException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 402 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new PreviewAccountImportPaymentRequiredException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 403 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new PreviewAccountImportForbiddenException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 413 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new PreviewAccountImportRequestEntityTooLargeException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ResponsePayloadTooLarge', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 422 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new PreviewAccountImportUnprocessableEntityException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 429 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new PreviewAccountImportTooManyRequestsException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 500 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new PreviewAccountImportInternalServerErrorException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
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
