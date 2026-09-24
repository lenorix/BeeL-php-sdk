<?php

namespace Lenorix\BeelSdk\Generated\Endpoint;

class PreviewAccountImport extends \Lenorix\BeelSdk\Generated\Runtime\Client\BaseEndpoint implements \Lenorix\BeelSdk\Generated\Runtime\Client\Endpoint
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
     *
     * @param \Lenorix\BeelSdk\Generated\Model\AccountImportUpload $requestBody
     */
    public function __construct(\Lenorix\BeelSdk\Generated\Model\AccountImportUpload $requestBody)
    {
        $this->body = $requestBody;
    }
    use \Lenorix\BeelSdk\Generated\Runtime\Client\EndpointTrait;
    public function getMethod(): string
    {
        return 'POST';
    }
    public function getUri(): string
    {
        return '/v1/accounts/imports/preview';
    }
    public function getBody(\Symfony\Component\Serializer\SerializerInterface $serializer, $streamFactory = null): array
    {
        if ($this->body instanceof \Lenorix\BeelSdk\Generated\Model\AccountImportUpload) {
            $bodyBuilder = new \Http\Message\MultipartStream\MultipartStreamBuilder($streamFactory);
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
                    if ($value instanceof \Psr\Http\Message\StreamInterface) {
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
            return [['Content-Type' => ['multipart/form-data; boundary="' . ($bodyBuilder->getBoundary() . '"')]], $bodyBuilder->build()];
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
     * @throws \Lenorix\BeelSdk\Generated\Exception\PreviewAccountImportBadRequestException
     * @throws \Lenorix\BeelSdk\Generated\Exception\PreviewAccountImportUnauthorizedException
     * @throws \Lenorix\BeelSdk\Generated\Exception\PreviewAccountImportPaymentRequiredException
     * @throws \Lenorix\BeelSdk\Generated\Exception\PreviewAccountImportForbiddenException
     * @throws \Lenorix\BeelSdk\Generated\Exception\PreviewAccountImportRequestEntityTooLargeException
     * @throws \Lenorix\BeelSdk\Generated\Exception\PreviewAccountImportUnprocessableEntityException
     * @throws \Lenorix\BeelSdk\Generated\Exception\PreviewAccountImportTooManyRequestsException
     * @throws \Lenorix\BeelSdk\Generated\Exception\PreviewAccountImportInternalServerErrorException
     *
     * @return null|\Lenorix\BeelSdk\Generated\Model\V1AccountsImportsPreviewPostResponse200|\Lenorix\BeelSdk\Generated\Model\ErrorResponse
     */
    protected function transformResponseBody(\Psr\Http\Message\ResponseInterface $response, \Symfony\Component\Serializer\SerializerInterface $serializer, ?string $contentType = null)
    {
        $status = $response->getStatusCode();
        $body = (string) $response->getBody();
        if (is_null($contentType) === false && (200 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            return $serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\V1AccountsImportsPreviewPostResponse200', 'json');
        }
        if (is_null($contentType) === false && (400 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\PreviewAccountImportBadRequestException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && (401 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\PreviewAccountImportUnauthorizedException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && (402 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\PreviewAccountImportPaymentRequiredException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && (403 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\PreviewAccountImportForbiddenException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && (413 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\PreviewAccountImportRequestEntityTooLargeException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ResponsePayloadTooLarge', 'json'), $response);
        }
        if (is_null($contentType) === false && (422 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\PreviewAccountImportUnprocessableEntityException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && (429 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\PreviewAccountImportTooManyRequestsException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && (500 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\PreviewAccountImportInternalServerErrorException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
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