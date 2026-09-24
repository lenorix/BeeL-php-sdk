<?php

namespace Lenorix\BeelSdk\Generated\Endpoint;

class CreateRecurringInvoice extends \Lenorix\BeelSdk\Generated\Runtime\Client\BaseEndpoint implements \Lenorix\BeelSdk\Generated\Runtime\Client\Endpoint
{
    /**
    * **Deprecated.** Use `POST /v1/companies/{company_id}/recurring-invoices`, which behaves
    * identically.
    *
    * Creates a recurring invoice template: the invoice data it repeats (lines, recipient,
    * series, payment) plus the recurrence that drives it.
    *
    * - **Cadence:** `frequency` is how often it generates — every 1 (`MONTHLY`), 3
    *   (`QUARTERLY`) or 12 (`YEARLY`) months — on `day_of_month`, from `start_date` until
    *   `end_date` if one is given. Omitted, `MONTHLY` applies.
    * - **The cadence governs the step, not the first invoice:** the first occurrence is the
    *   first `day_of_month` on or after `start_date`, found one month at a time whatever the
    *   cadence; the cadence takes over from there. A `YEARLY` template starting 15 February
    *   with `day_of_month` 10 first invoices on 10 March, then every 10 March after that — it
    *   does not wait a year.
    * - **`start_date` in the past:** accepted and stored as sent, but it never anchors
    *   generation backwards. `next_generation` becomes the next date of the template's own
    *   calendar that is still ahead — the grid of `day_of_month` dates anchored at
    *   `start_date`, one every `frequency` — so on a quarterly or yearly template it can land
    *   months from now, not this month. The missed periods are not generated.
    * - **`draft_in_advance`:** whether the invoice is created as a draft for review before it
    *   is emitted. The window is fixed at 5 days, and both options emit on the scheduled day.
    *   Omitted, no review draft is prepared. It supersedes the deprecated `preview_days`.
    * - **VeriFactu:** the template does not carry it. Whether each generated invoice is
    *   registered with AEAT is decided when that invoice is issued, against the company's
    *   regime at that moment.
    *
    * **Retires on 9 December 2026.** See the [migration guide](https://docs.beel.es/changelog/resources-under-the-nif) for what moved where and what changes when you switch.
    *
    * @param \Lenorix\BeelSdk\Generated\Model\CreateRecurringInvoiceRequest $requestBody
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
    public function __construct(\Lenorix\BeelSdk\Generated\Model\CreateRecurringInvoiceRequest $requestBody, array $headerParameters = [])
    {
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
        return '/v1/recurring-invoices';
    }
    public function getBody(\Symfony\Component\Serializer\SerializerInterface $serializer, $streamFactory = null): array
    {
        if ($this->body instanceof \Lenorix\BeelSdk\Generated\Model\CreateRecurringInvoiceRequest) {
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
     * @throws \Lenorix\BeelSdk\Generated\Exception\CreateRecurringInvoiceBadRequestException
     * @throws \Lenorix\BeelSdk\Generated\Exception\CreateRecurringInvoiceForbiddenException
     * @throws \Lenorix\BeelSdk\Generated\Exception\CreateRecurringInvoiceUnprocessableEntityException
     *
     * @return null|\Lenorix\BeelSdk\Generated\Model\V1RecurringInvoicesPostResponse201|\Lenorix\BeelSdk\Generated\Model\ErrorResponse
     */
    protected function transformResponseBody(\Psr\Http\Message\ResponseInterface $response, \Symfony\Component\Serializer\SerializerInterface $serializer, ?string $contentType = null)
    {
        $status = $response->getStatusCode();
        $body = (string) $response->getBody();
        if (is_null($contentType) === false && (201 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            return $serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\V1RecurringInvoicesPostResponse201', 'json');
        }
        if (is_null($contentType) === false && (400 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\CreateRecurringInvoiceBadRequestException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && (403 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\CreateRecurringInvoiceForbiddenException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && (422 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\CreateRecurringInvoiceUnprocessableEntityException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
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