<?php

namespace Lenorix\BeelSdk\Generated\Endpoint;

use Lenorix\BeelSdk\Generated\Exception\UpdateRecurringInvoiceConflictException;
use Lenorix\BeelSdk\Generated\Exception\UpdateRecurringInvoiceForbiddenException;
use Lenorix\BeelSdk\Generated\Exception\UpdateRecurringInvoiceNotFoundException;
use Lenorix\BeelSdk\Generated\Exception\UpdateRecurringInvoiceUnprocessableEntityException;
use Lenorix\BeelSdk\Generated\Model\ErrorResponse;
use Lenorix\BeelSdk\Generated\Model\UpdateRecurringInvoiceRequest;
use Lenorix\BeelSdk\Generated\Model\V1RecurringInvoicesRecurringInvoiceIdPutResponse200;
use Lenorix\BeelSdk\Generated\Runtime\Client\BaseEndpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\Endpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\EndpointTrait;
use Lenorix\BeelSdk\Generated\Runtime\Client\JsonPayload;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\Serializer\SerializerInterface;

class UpdateRecurringInvoice extends BaseEndpoint implements Endpoint
{
    protected $recurring_invoice_id;

    /**
     * **Deprecated.** The canonical form has a single update verb,
     * `PATCH /v1/companies/{company_id}/recurring-invoices/{recurring_invoice_id}`, which is not
     * a drop-in replacement: it changes only the fields present in the body. To reproduce a
     * total replacement, send every field and pass `null` in the ones you want cleared.
     *
     * Replaces the schedule, template lines and recipient of a recurring invoice with the body
     * you send. Only allowed while the template is active or paused.
     *
     * - **Not a partial update:** leaving out `end_date`, `payment_method` (with its
     *   `payment_iban`, `payment_swift` and `payment_term_days`), `notes` or
     *   `email_configuration` clears them.
     * - **`lines`:** replaced as a whole. Omitting them or sending `null` keeps the current
     *   ones, and an empty array is rejected.
     *
     * **Retires on 9 December 2026.** See the [migration guide](https://docs.beel.es/changelog/resources-under-the-nif) for what moved where and what changes when you switch.
     */
    public function __construct(string $recurringInvoiceId, UpdateRecurringInvoiceRequest $requestBody)
    {
        $this->recurring_invoice_id = $recurringInvoiceId;
        $this->body = $requestBody;
    }

    use EndpointTrait;

    public function getMethod(): string
    {
        return 'PUT';
    }

    public function getUri(): string
    {
        return str_replace(['{recurring_invoice_id}'], [rawurlencode($this->recurring_invoice_id)], '/v1/recurring-invoices/{recurring_invoice_id}');
    }

    public function getBody(SerializerInterface $serializer, $streamFactory = null): array
    {
        if ($this->body instanceof UpdateRecurringInvoiceRequest) {
            return [['Content-Type' => ['application/json']], JsonPayload::encode($serializer, $this->body)];
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
     * @return null|V1RecurringInvoicesRecurringInvoiceIdPutResponse200|ErrorResponse
     *
     * @throws UpdateRecurringInvoiceForbiddenException
     * @throws UpdateRecurringInvoiceNotFoundException
     * @throws UpdateRecurringInvoiceConflictException
     * @throws UpdateRecurringInvoiceUnprocessableEntityException
     */
    protected function transformResponseBody(ResponseInterface $response, SerializerInterface $serializer, ?string $contentType = null)
    {
        $status = $response->getStatusCode();
        $body = (string) $response->getBody();
        if (is_null($contentType) === false && ($status === 200 && stripos(strtolower($contentType), 'application/json') !== false)) {
            return $serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\V1RecurringInvoicesRecurringInvoiceIdPutResponse200', 'json');
        }
        if (is_null($contentType) === false && ($status === 403 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new UpdateRecurringInvoiceForbiddenException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 404 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new UpdateRecurringInvoiceNotFoundException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 409 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new UpdateRecurringInvoiceConflictException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 422 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new UpdateRecurringInvoiceUnprocessableEntityException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
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
