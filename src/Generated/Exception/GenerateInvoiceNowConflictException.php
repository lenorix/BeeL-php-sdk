<?php

namespace Lenorix\BeelSdk\Generated\Exception;

use Lenorix\BeelSdk\Generated\Model\ErrorResponse;
use Psr\Http\Message\ResponseInterface;

class GenerateInvoiceNowConflictException extends ConflictException
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
        parent::__construct('The request is well formed but collides with the state that is already there. Three
families, told apart by `error.code`:

- **Uniqueness** — something with that identity already exists (`CLIENT_DUPLICATE`,
  `PRODUCT_DUPLICATE`, `SERIES_CODE_DUPLICATED`, `NIF_ALREADY_REGISTERED`,
  `MEMBER_ALREADY_IN_ACCOUNT`, `INVOICE_DUPLICATE_EXTERNAL_REFERENCE`).
- **Lifecycle** — the transition does not apply from where the resource is
  (`INVOICE_ALREADY_VOIDED`, `PROFORMA_ALREADY_CONVERTED`, `CLIENT_HAS_INVOICES`,
  `RECURRING_ALREADY_ENDED`, `RECURRING_OCCURRENCE_ALREADY_CONSUMED` — the occurrence the
  recurring template points at has already been billed; read its history instead of
  retrying).
  Read the resource before retrying: the state you assumed is not its state.
- **Concurrency and idempotency** — another write got there first
  (`CONCURRENT_MODIFICATION`), or the `Idempotency-Key` you sent is still in flight
  (`IDEMPOTENCY_KEY_PROCESSING`, retry after a moment) or was already used for a
  different body (`IDEMPOTENCY_KEY_MISMATCH`, use a new key).
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
