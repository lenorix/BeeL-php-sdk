<?php

namespace Lenorix\BeelSdk\Generated\Endpoint;

class InitiatePaymentConnection extends \Lenorix\BeelSdk\Generated\Runtime\Client\BaseEndpoint implements \Lenorix\BeelSdk\Generated\Runtime\Client\Endpoint
{
    protected $company_id;
    /**
    * Opens an authorization session so the holder of a company your account **manages**
    * can connect a payment provider (`stripe`), and returns the `authorization_url` where they
    * authorize it.
    *
    * - **`return_url`:** once the holder authorizes, BeeL's callback finalizes the connection
    *   and redirects back to the `return_url` of your portal, if you supplied one, with the
    *   parameters described under `return_url`.
    * - **When the connection appears:** it is created only when the holder authorizes, so it
    *   does not appear in `GET /v1/companies/{company_id}/payment-connections` until then. It
    *   is sealed under the NIF in the path, so auto-invoicing issues under that NIF.
    * - **The NIF must be activated in the mode of your API key** (`beel_sk_test_*` → Test,
    *   `beel_sk_live_*` → Live); otherwise the request answers `400`
    *   `COMPANY_NOT_ACTIVATED_IN_ENVIRONMENT` and no `authorization_url` is issued, because
    *   without activation there is no invoice series or tax configuration to invoice with.
    *   Test and Live activations are independent — a NIF activated in one mode still needs
    *   activating in the other.
    * - **One provider account, one NIF:** a provider account (`acct_...`) can be connected to a
    *   single NIF across the whole platform. Authorizing the same provider account from a second
    *   NIF does not move it: the callback fails with
    *   `OAUTH_ACCOUNT_CONNECTED_TO_OTHER_COMPANY`, and the existing connection keeps invoicing
    *   under the NIF it was sealed with. To move it, first
    *   `DELETE /v1/companies/{company_id}/payment-connections/{connection_id}` on the NIF
    *   that holds it, then open a new authorization on the NIF you want it under.
    *
    * @param string $companyId Unique identifier (UUID) of the company the authorization is opened for — its identifier, not its NIF. It is the only source of context: the account that owns it is derived from it, and the `BeeL-Active-Company` header plays no part. A company you do not reach answers `403`, and so does a company that does not exist.
    * @param \Lenorix\BeelSdk\Generated\Model\InitiatePaymentConnectionRequest $requestBody
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
    public function __construct(string $companyId, \Lenorix\BeelSdk\Generated\Model\InitiatePaymentConnectionRequest $requestBody, array $headerParameters = [])
    {
        $this->company_id = $companyId;
        $this->body = $requestBody;
        $this->headerParameters = $headerParameters;
    }
    use \Lenorix\BeelSdk\Generated\Runtime\Client\EndpointTrait;
    public function getMethod(): string
    {
        return 'POST';
    }
    public function getUri(): string
    {
        return str_replace(['{company_id}'], [rawurlencode($this->company_id)], '/v1/companies/{company_id}/payment-connections/authorizations');
    }
    public function getBody(\Symfony\Component\Serializer\SerializerInterface $serializer, $streamFactory = null): array
    {
        if ($this->body instanceof \Lenorix\BeelSdk\Generated\Model\InitiatePaymentConnectionRequest) {
            return [['Content-Type' => ['application/json']], \Lenorix\BeelSdk\Generated\Runtime\Client\JsonPayload::encode($serializer, $this->body)];
        }
        return [[], null];
    }
    public function getExtraHeaders(): array
    {
        return ['Accept' => ['application/json']];
    }
    protected function getHeadersOptionsResolver(): \Symfony\Component\OptionsResolver\OptionsResolver
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
     * @throws \Lenorix\BeelSdk\Generated\Exception\InitiatePaymentConnectionBadRequestException
     * @throws \Lenorix\BeelSdk\Generated\Exception\InitiatePaymentConnectionUnauthorizedException
     * @throws \Lenorix\BeelSdk\Generated\Exception\InitiatePaymentConnectionForbiddenException
     * @throws \Lenorix\BeelSdk\Generated\Exception\InitiatePaymentConnectionUnprocessableEntityException
     * @throws \Lenorix\BeelSdk\Generated\Exception\InitiatePaymentConnectionTooManyRequestsException
     * @throws \Lenorix\BeelSdk\Generated\Exception\InitiatePaymentConnectionInternalServerErrorException
     *
     * @return null|\Lenorix\BeelSdk\Generated\Model\InitiatePaymentConnectionResponse|\Lenorix\BeelSdk\Generated\Model\ErrorResponse
     */
    protected function transformResponseBody(\Psr\Http\Message\ResponseInterface $response, \Symfony\Component\Serializer\SerializerInterface $serializer, ?string $contentType = null)
    {
        $status = $response->getStatusCode();
        $body = (string) $response->getBody();
        if (is_null($contentType) === false && (200 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            return $serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\InitiatePaymentConnectionResponse', 'json');
        }
        if (is_null($contentType) === false && (400 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\InitiatePaymentConnectionBadRequestException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && (401 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\InitiatePaymentConnectionUnauthorizedException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && (403 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\InitiatePaymentConnectionForbiddenException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && (422 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\InitiatePaymentConnectionUnprocessableEntityException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && (429 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\InitiatePaymentConnectionTooManyRequestsException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && (500 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\InitiatePaymentConnectionInternalServerErrorException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
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