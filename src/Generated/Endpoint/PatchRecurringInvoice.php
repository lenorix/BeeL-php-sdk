<?php

namespace Lenorix\BeelSdk\Generated\Endpoint;

class PatchRecurringInvoice extends \Lenorix\BeelSdk\Generated\Runtime\Client\BaseEndpoint implements \Lenorix\BeelSdk\Generated\Runtime\Client\Endpoint
{
    protected $recurring_invoice_id;
    /**
     * **Deprecated.** Use
     * `PATCH /v1/companies/{company_id}/recurring-invoices/{recurring_invoice_id}`, which behaves
     * identically.
     *
     * Updates only the fields present in the body, leaving every other field of the recurring
     * invoice template as it is.
     *
     * - **Omitted vs `null`:** an omitted field keeps its current value; a field sent as `null`
     *   is cleared, and only where the request schema documents the field as nullable.
     * - **`lines`:** replaced as a whole, not patched line by line. The recipient survives the
     *   change, and an empty array is rejected.
     * - **`payment_method`:** replaced as a whole together with `payment_iban`, `payment_swift`
     *   and `payment_term_days` — send them in the same request or they are dropped.
     * - **Schedule:** `frequency`, `day_of_month` and `start_date` stay put unless you send
     *   them; sending a new value for any of the three moves the next generation — resending
     *   the ones already in effect changes nothing. Changing `frequency` recalculates it on
     *   the new grid and discards a pending skip. `start_date` is only editable while the
     *   template has not generated any invoice yet.
     *
     * **Retires on 9 December 2026.** See the [migration guide](https://docs.beel.es/changelog/resources-under-the-nif) for what moved where and what changes when you switch.
     *
     * @param string $recurringInvoiceId
     * @param \Lenorix\BeelSdk\Generated\Model\PatchRecurringInvoiceRequest $requestBody
     */
    public function __construct(string $recurringInvoiceId, \Lenorix\BeelSdk\Generated\Model\PatchRecurringInvoiceRequest $requestBody)
    {
        $this->recurring_invoice_id = $recurringInvoiceId;
        $this->body = $requestBody;
    }
    use \Lenorix\BeelSdk\Generated\Runtime\Client\EndpointTrait;
    public function getMethod(): string
    {
        return 'PATCH';
    }
    public function getUri(): string
    {
        return str_replace(['{recurring_invoice_id}'], [rawurlencode($this->recurring_invoice_id)], '/v1/recurring-invoices/{recurring_invoice_id}');
    }
    public function getBody(\Symfony\Component\Serializer\SerializerInterface $serializer, $streamFactory = null): array
    {
        if ($this->body instanceof \Lenorix\BeelSdk\Generated\Model\PatchRecurringInvoiceRequest) {
            return [['Content-Type' => ['application/json']], \Lenorix\BeelSdk\Generated\Runtime\Client\JsonPayload::encode($serializer, $this->body)];
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
     * @throws \Lenorix\BeelSdk\Generated\Exception\PatchRecurringInvoiceBadRequestException
     * @throws \Lenorix\BeelSdk\Generated\Exception\PatchRecurringInvoiceForbiddenException
     * @throws \Lenorix\BeelSdk\Generated\Exception\PatchRecurringInvoiceNotFoundException
     * @throws \Lenorix\BeelSdk\Generated\Exception\PatchRecurringInvoiceConflictException
     * @throws \Lenorix\BeelSdk\Generated\Exception\PatchRecurringInvoiceUnprocessableEntityException
     *
     * @return null|\Lenorix\BeelSdk\Generated\Model\V1RecurringInvoicesRecurringInvoiceIdPatchResponse200|\Lenorix\BeelSdk\Generated\Model\ErrorResponse
     */
    protected function transformResponseBody(\Psr\Http\Message\ResponseInterface $response, \Symfony\Component\Serializer\SerializerInterface $serializer, ?string $contentType = null)
    {
        $status = $response->getStatusCode();
        $body = (string) $response->getBody();
        if (is_null($contentType) === false && (200 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            return $serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\V1RecurringInvoicesRecurringInvoiceIdPatchResponse200', 'json');
        }
        if (is_null($contentType) === false && (400 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\PatchRecurringInvoiceBadRequestException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && (403 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\PatchRecurringInvoiceForbiddenException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && (404 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\PatchRecurringInvoiceNotFoundException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && (409 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\PatchRecurringInvoiceConflictException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && (422 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\PatchRecurringInvoiceUnprocessableEntityException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
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