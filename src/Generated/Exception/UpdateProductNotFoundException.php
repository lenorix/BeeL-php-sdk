<?php

namespace Lenorix\BeelSdk\Generated\Exception;

use Lenorix\BeelSdk\Generated\Model\ErrorResponse;
use Psr\Http\Message\ResponseInterface;

class UpdateProductNotFoundException extends NotFoundException
{
    /**
     * @var ErrorResponse
     */
    private $errorResponse;

    /**
     * @var ResponseInterface
     */
    private $response;

    public function __construct(ErrorResponse $errorResponse, ResponseInterface $response)
    {
        parent::__construct('The resource addressed by the path does not exist, or is not one this credential can see —
the two are answered identically, so existence is never disclosed. `error.code` names the
kind of resource that was missing, so a client can tell which of several ids in a path
failed to resolve:

- `INVOICE_NOT_FOUND` — the `{invoice_id}` (invoices, proformas and their sub-resources).
- `RECURRING_NOT_FOUND` — the `{recurring_invoice_id}`.
- `CLIENT_NOT_FOUND` — the `{customer_id}`.
- `INVOICE_CLIENT_NOT_FOUND` — the `customer_id` referenced by an invoice body does not
  resolve to a customer of the issuing company.
- `PRODUCT_NOT_FOUND` — the `{product_id}`.
- `SERIES_NOT_FOUND` — the `{series_id}`.
- `WEBHOOK_SUBSCRIPTION_NOT_FOUND`, `DELIVERY_LOG_NOT_FOUND` — the `{webhook_id}` and the
  `{delivery_id}`.
- `NOT_FOUND` — the generic fallback, for the few resources that carry no code of their own.

Some resources declare a more specific `404` response of their own (`CONNECTION_NOT_FOUND`,
`MEMBER_NOT_FOUND`, `GRANT_NOT_FOUND`, `INVITATION_NOT_FOUND`, `REQUEST_LOG_NOT_FOUND`); it
is documented on the operation.

A `404` with `ENDPOINT_NOT_FOUND` is a different answer: the **path itself** does not exist
in this API (a typo in the route, or a resource that was never here). It says nothing about
any resource. When the path exists but not with that method, the answer is `405`, not `404`.
');
        $this->errorResponse = $errorResponse;
        $this->response = $response;
    }

    public function getErrorResponse(): ErrorResponse
    {
        return $this->errorResponse;
    }

    public function getResponse(): ResponseInterface
    {
        return $this->response;
    }
}
