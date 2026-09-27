<?php

namespace Lenorix\BeelSdk\Generated\Endpoint;

use Http\Message\MultipartStream\MultipartStreamBuilder;
use Lenorix\BeelSdk\Generated\Exception\CreateAccountImportBadRequestException;
use Lenorix\BeelSdk\Generated\Exception\CreateAccountImportConflictException;
use Lenorix\BeelSdk\Generated\Exception\CreateAccountImportForbiddenException;
use Lenorix\BeelSdk\Generated\Exception\CreateAccountImportInternalServerErrorException;
use Lenorix\BeelSdk\Generated\Exception\CreateAccountImportPaymentRequiredException;
use Lenorix\BeelSdk\Generated\Exception\CreateAccountImportRequestEntityTooLargeException;
use Lenorix\BeelSdk\Generated\Exception\CreateAccountImportTooManyRequestsException;
use Lenorix\BeelSdk\Generated\Exception\CreateAccountImportUnauthorizedException;
use Lenorix\BeelSdk\Generated\Exception\CreateAccountImportUnprocessableEntityException;
use Lenorix\BeelSdk\Generated\Model\AccountImportUpload;
use Lenorix\BeelSdk\Generated\Model\ErrorResponse;
use Lenorix\BeelSdk\Generated\Model\V1AccountsImportsPostResponse201;
use Lenorix\BeelSdk\Generated\Runtime\Client\BaseEndpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\Endpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\EndpointTrait;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Serializer\SerializerInterface;

class CreateAccountImport extends BaseEndpoint implements Endpoint
{
    /**
     * Provisions the managed accounts described in an uploaded file, switches each one on in
     * Live, and leaves them ready to invoice. It is the same act as calling `POST /v1/accounts`
     * once per row and then `POST /v1/companies/{company_id}/activations`, with the bookkeeping
     * done for you.
     *
     * ## Idempotency and re-runs
     *
     * - **Not atomic:** each row is processed and reported independently, and a row that fails
     *   leaves the rows already provisioned in place. `statistics.accounts_created` is how many
     *   accounts this call actually created.
     * - **Declarative and re-runnable:** each pass applies only what is missing — an
     *   `external_ref` you already provisioned is reconciled, not duplicated, and so are its
     *   series and its customers. That is the recovery path for anything that went wrong: fix the
     *   cause and upload the same file again; there is no resume and no partial state to clean
     *   up.
     * - **`Idempotency-Key`:** required, but the real guarantee is in the data. Rows are
     *   idempotent by `external_ref`, so the same file uploaded twice creates nothing twice even
     *   under a different key.
     * - **Dry run:** to see what this would do without writing anything, use
     *   `POST /v1/accounts/imports/preview`, a separate operation with no effects at all — the
     *   import is never governed by a boolean flag.
     *
     * ## Files and limits
     *
     * - **`accounts_file`:** describes the accounts, one per row.
     * - **`customers_file`:** optional, and holds a list of customers applied to **every** account
     *   of the import, new and pre-existing alike, so a new managed account is born knowing all
     *   the customers and a new customer reaches all the accounts on the next pass. It is the
     *   same CSV that `GET /v1/templates/customer-import` describes, and it is idempotent by tax
     *   id.
     * - **`options.apply_customers_to_own_company`:** lands those customers on your own company
     *   as well — the one in focus, never one chosen for you. That outcome comes back apart, in
     *   `own_company_customers`, and stays out of `statistics.customers_created`.
     * - **Limits:** 5 MB per file, 100 rows in the accounts file and 1,000 in the customers file.
     *   A larger population is imported in passes, which costs nothing because the file is
     *   declarative.
     *
     * ## Live activation
     *
     * Live activation is part of the act: every row is weighed against the same verdict the
     * account state publishes, and only rows entitled to Live are executed; the rest come back
     * `BLOCKED` with the reason. The import never opens a checkout, so it never charges you by
     * surprise: settle your billing once and re-upload.
     *
     * ## Claim tokens
     *
     * `account.claim_token` and `account.claim_url`: each newly provisioned row carries them
     * in this response and nowhere else, so persist them before discarding it. A lost token is
     * re-issued with `POST /v1/accounts/{account_id}/claim-tokens`.
     *
     * @param array{
     *    "Idempotency-Key": string, //Same key as `Idempotency-Key` above, but **required**: the operation writes many rows per
    call, so a retry without a key would import the same file twice. A missing key answers
    `400 IDEMPOTENCY_KEY_REQUIRED`.
     * } $headerParameters
     */
    public function __construct(AccountImportUpload $requestBody, array $headerParameters = [])
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
        return '/v1/accounts/imports';
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
     * @return null|V1AccountsImportsPostResponse201|ErrorResponse
     *
     * @throws CreateAccountImportBadRequestException
     * @throws CreateAccountImportUnauthorizedException
     * @throws CreateAccountImportPaymentRequiredException
     * @throws CreateAccountImportForbiddenException
     * @throws CreateAccountImportConflictException
     * @throws CreateAccountImportRequestEntityTooLargeException
     * @throws CreateAccountImportUnprocessableEntityException
     * @throws CreateAccountImportTooManyRequestsException
     * @throws CreateAccountImportInternalServerErrorException
     */
    protected function transformResponseBody(ResponseInterface $response, SerializerInterface $serializer, ?string $contentType = null)
    {
        $status = $response->getStatusCode();
        $body = (string) $response->getBody();
        if (is_null($contentType) === false && ($status === 201 && stripos(strtolower($contentType), 'application/json') !== false)) {
            return $serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\V1AccountsImportsPostResponse201', 'json');
        }
        if (is_null($contentType) === false && ($status === 400 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new CreateAccountImportBadRequestException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 401 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new CreateAccountImportUnauthorizedException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 402 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new CreateAccountImportPaymentRequiredException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 403 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new CreateAccountImportForbiddenException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 409 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new CreateAccountImportConflictException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 413 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new CreateAccountImportRequestEntityTooLargeException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ResponsePayloadTooLarge', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 422 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new CreateAccountImportUnprocessableEntityException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 429 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new CreateAccountImportTooManyRequestsException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 500 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new CreateAccountImportInternalServerErrorException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
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
