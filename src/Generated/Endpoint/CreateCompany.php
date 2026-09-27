<?php

namespace Lenorix\BeelSdk\Generated\Endpoint;

use Lenorix\BeelSdk\Generated\Exception\CreateCompanyBadRequestException;
use Lenorix\BeelSdk\Generated\Exception\CreateCompanyConflictException;
use Lenorix\BeelSdk\Generated\Exception\CreateCompanyForbiddenException;
use Lenorix\BeelSdk\Generated\Exception\CreateCompanyInternalServerErrorException;
use Lenorix\BeelSdk\Generated\Exception\CreateCompanyPaymentRequiredException;
use Lenorix\BeelSdk\Generated\Exception\CreateCompanyTooManyRequestsException;
use Lenorix\BeelSdk\Generated\Exception\CreateCompanyUnauthorizedException;
use Lenorix\BeelSdk\Generated\Exception\CreateCompanyUnprocessableEntityException;
use Lenorix\BeelSdk\Generated\Model\CompanyResponse201;
use Lenorix\BeelSdk\Generated\Model\CreateCompanyRequest;
use Lenorix\BeelSdk\Generated\Model\ErrorResponse;
use Lenorix\BeelSdk\Generated\Runtime\Client\BaseEndpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\Endpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\EndpointTrait;
use Lenorix\BeelSdk\Generated\Runtime\Client\JsonPayload;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Serializer\SerializerInterface;

class CreateCompany extends BaseEndpoint implements Endpoint
{
    protected $account_id;

    /**
     * Creates a company under the account the request resolves to. The NIF is
     * registered in the name of that account's holder, never in the name of the caller.
     *
     * - **`activate`:** unless it is `false`, the company is switched on in
     *   `aeat_environment` and its three default invoice series (ordinary, simplified,
     *   corrective) are seeded there. This endpoint never switches an existing company on:
     *   that is `POST /v1/companies/{company_id}/activations`.
     * - **`numbering`:** decides the code, format, counter reset and starting number those
     *   series are born with. Only accepted when the request activates the company.
     * - **Billing:** no charge is ever started here. Creating a production NIF requires being
     *   the billing subject of the account (`403` otherwise), and an account without billing is
     *   rejected with `402`; no checkout is opened in either case.
     * - **Duplicates:** a NIF that already exists in the account is rejected with `409`, and
     *   the response carries the existing `error.details.company_id`.
     *
     * @param  string  $accountId  Your own account, or an account you provisioned. It — not the credential — decides which account the operation acts on; a `403` is returned when you do not reach it, the same response an account that does not exist gets.
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
    public function __construct(string $accountId, CreateCompanyRequest $requestBody, array $headerParameters = [])
    {
        $this->account_id = $accountId;
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
        return str_replace(['{account_id}'], [rawurlencode($this->account_id)], '/v1/accounts/{account_id}/companies');
    }

    public function getBody(SerializerInterface $serializer, $streamFactory = null): array
    {
        if ($this->body instanceof CreateCompanyRequest) {
            return [['Content-Type' => ['application/json']], JsonPayload::encode($serializer, $this->body)];
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
     * @return null|CompanyResponse201|ErrorResponse
     *
     * @throws CreateCompanyBadRequestException
     * @throws CreateCompanyUnauthorizedException
     * @throws CreateCompanyPaymentRequiredException
     * @throws CreateCompanyForbiddenException
     * @throws CreateCompanyConflictException
     * @throws CreateCompanyUnprocessableEntityException
     * @throws CreateCompanyTooManyRequestsException
     * @throws CreateCompanyInternalServerErrorException
     */
    protected function transformResponseBody(ResponseInterface $response, SerializerInterface $serializer, ?string $contentType = null)
    {
        $status = $response->getStatusCode();
        $body = (string) $response->getBody();
        if (is_null($contentType) === false && ($status === 201 && stripos(strtolower($contentType), 'application/json') !== false)) {
            return $serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\CompanyResponse201', 'json');
        }
        if (is_null($contentType) === false && ($status === 400 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new CreateCompanyBadRequestException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 401 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new CreateCompanyUnauthorizedException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 402 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new CreateCompanyPaymentRequiredException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\PaymentRequiredResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 403 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new CreateCompanyForbiddenException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 409 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new CreateCompanyConflictException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 422 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new CreateCompanyUnprocessableEntityException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 429 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new CreateCompanyTooManyRequestsException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 500 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new CreateCompanyInternalServerErrorException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
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
