<?php

namespace Lenorix\BeelSdk\Generated;

class Client extends \Lenorix\BeelSdk\Generated\Runtime\Client\Client
{
    /**
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetMyIdentityUnauthorizedException
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetMyIdentityForbiddenException
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetMyIdentityTooManyRequestsException
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetMyIdentityInternalServerErrorException
     *
     * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\V1MeIdentityGetResponse200|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
     */
    public function getMyIdentity(string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\GetMyIdentity(), $fetch);
    }
    /**
     * Updates the preferences of the authenticated person. Today the only mutable
     * preference is `language`.
     *
     * It applies to the interface, to template names and colours in invoice
     * customisation, and to the emails the person receives. It belongs to the person,
     * not to a fiscal profile: the languages of invoices and of emails are separate
     * settings of each company.
     *
     * @param \Lenorix\BeelSdk\Generated\Model\UpdateMeRequest $requestBody
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \Lenorix\BeelSdk\Generated\Exception\UpdateMeBadRequestException
     * @throws \Lenorix\BeelSdk\Generated\Exception\UpdateMeUnauthorizedException
     * @throws \Lenorix\BeelSdk\Generated\Exception\UpdateMeForbiddenException
     * @throws \Lenorix\BeelSdk\Generated\Exception\UpdateMeUnprocessableEntityException
     * @throws \Lenorix\BeelSdk\Generated\Exception\UpdateMeTooManyRequestsException
     * @throws \Lenorix\BeelSdk\Generated\Exception\UpdateMeInternalServerErrorException
     *
     * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\V1MePatchResponse200|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
     */
    public function updateMe(\Lenorix\BeelSdk\Generated\Model\UpdateMeRequest $requestBody, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\UpdateMe($requestBody), $fetch);
    }
    /**
    * Returns a paginated list of invoices, with filters, sorting and pagination.
    *
    * - **Deprecated:** use `GET /v1/companies/{company_id}/invoices`, which returns the same
    *   list with the same filters.
    * - **Difference:** the legacy alias `external_reference` is not carried over there. Use
    *   `external_ref`, which this route also accepts.
    *
    * **Retires on 9 December 2026.** See the [migration guide](https://docs.beel.es/changelog/resources-under-the-nif) for what moved where and what changes when you switch.
    *
    * @param array{
    *    "page"?: int, //Page number, starting at 1. The response echoes it back as `pagination.current_page`.
    *    "limit"?: int, //How many items to return per page. The response echoes it back as `pagination.items_per_page`.
    *    "search"?: string, //Global search across invoice number, recipient name, recipient NIF, and series code (partial, case-insensitive)
    *    "status"?: array, //Filter by invoice status. Accepts a comma-separated list to match any of several
    statuses, for example `status=DRAFT,ISSUED`. A single value is also valid.
    *    "type"?: string, //Filter by invoice type
    *    "fiscal_only"?: bool, //When `true`, returns only fiscal documents (STANDARD, CORRECTIVE, SIMPLIFIED),
    excluding proformas and any other non-fiscal document. Defaults to `false`
    (the list returns every document type). Ignored when an explicit `type` is given.
    *    "customer_id"?: string, //Filter by customer UUID
    *    "date_from"?: string, //Issue date from (YYYY-MM-DD)
    *    "date_to"?: string, //Issue date to (YYYY-MM-DD)
    *    "invoice_number"?: string, //Search by invoice number (e.g., 2025/0001)
    *    "recipient_name"?: string, //Filter by recipient's fiscal name (partial, case-insensitive search)
    *    "recipient_nif"?: string, //Filter by recipient's NIF (partial search)
    *    "series_code"?: string, //Filter by series code (exact match, case-insensitive). Use `search` for partial matching across the invoice number, recipient and series code.
    *    "external_ref"?: string, //Filter by exact external reference (client-supplied order/cart/contract id).
    
    This parameter was previously named `external_reference`. The old name is still accepted
    for backwards compatibility (see `external_reference` below) and will be withdrawn in a
    future major version — send `external_ref`.
    *    "external_reference"?: string, //**Deprecated** — former name of `external_ref`, still honoured so existing integrations
    keep working. Ignored when `external_ref` is also present. Use `external_ref`.
    *    "taxable_base_min"?: float, //Minimum taxable base
    *    "taxable_base_max"?: float, //Maximum taxable base
    *    "total_min"?: float, //Minimum invoice total
    *    "total_max"?: float, //Maximum invoice total
    *    "verifactu_status"?: string, //Filter by the VeriFactu submission status of the invoice, using the very same
    vocabulary that `verifactu.submission_status` publishes on each invoice.
    `NOT_SUBMITTED` selects issued invoices with VeriFactu enabled whose
    registration never happened (no live record).
    
    Only invoices with VeriFactu enabled can match. To select the ones outside the
    axis (VeriFactu disabled), use `verifactu_enabled=false` instead.
    *    "verifactu_enabled"?: bool, //Filter by whether VeriFactu is enabled for the invoice — the same flag published as
    `verifactu.enabled`. `false` returns the invoices that never reach AEAT.
    *    "metadata"?: array, //Filter by metadata key/value pairs (exact match, AND between keys).
    Repeat the bracket-style param to filter on multiple keys.
    Max 50 pairs per request. Keys must match `^[A-Za-z0-9_\-.]{1,64}$`.
    Example: `?metadata[external_order_id]=ORD-42&metadata[tenant]=acme`
    *    "sort_by"?: string, //Field to sort by (e.g., issue_date, invoice_number, invoice_total)
    *    "sort_order"?: string, //Sort direction
    * } $queryParameters
    * @param array{
    *    "BeeL-Active-Company"?: string, //Which company (tax ID) the request operates on.
    
    An API key belongs to an account, and an account may hold several companies. Endpoints that
    read or write company-owned data — invoices, customers, products, series, tax and VeriFactu
    settings — resolve their target company from this header **when the path does not already
    name one**.
    
    On a path that names the company, such as `/v1/companies/{company_id}/invoices`, the path
    is the target and this header is not read at all: it neither switches the target nor makes
    the request fail, so sending one that disagrees with the path is silently ignored rather
    than rejected. Prefer those paths whenever you need to be explicit about which tax ID you
    are operating on.
    
    On an account holding a single company the header may be omitted — that company is used.
    On an account holding several it is required: the request fails with
    `403 ACTIVE_COMPANY_REQUIRED` otherwise. A company-owned record always belongs to one tax
    ID, so operating on it without saying which one has no meaning.
    
    The company does **not** have to belong to the API key's own account: one you manage works
    too, which is what makes the `company_id` returned by `POST /v1/accounts` usable here to
    invoice on a provisioned account's behalf. What you may do with it is then decided by your
    access level over that account, and issuing also requires a signed fiscal representation.
    
    This header is how you **operate** on a company, never how you find one: a value you do not
    reach answers `403`, the same as one that does not exist, so guessing reveals nothing. Get
    the `company_id` from the response that created the company.
    
    Requires the `companies:read` scope. Returns `403` if the company is neither yours nor one
    you manage.
    * } $headerParameters
    
    * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
    * @throws \Lenorix\BeelSdk\Generated\Exception\ListInvoicesBadRequestException
    * @throws \Lenorix\BeelSdk\Generated\Exception\ListInvoicesUnauthorizedException
    * @throws \Lenorix\BeelSdk\Generated\Exception\ListInvoicesForbiddenException
    * @throws \Lenorix\BeelSdk\Generated\Exception\ListInvoicesUnprocessableEntityException
    * @throws \Lenorix\BeelSdk\Generated\Exception\ListInvoicesTooManyRequestsException
    * @throws \Lenorix\BeelSdk\Generated\Exception\ListInvoicesInternalServerErrorException
    *
    * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\V1InvoicesGetResponse200|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
    */
    public function listInvoices(array $queryParameters = [], array $headerParameters = [], string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\ListInvoices($queryParameters, $headerParameters), $fetch);
    }
    /**
    * Creates an invoice, optionally numbered and issued in the same call with
    * `options.issue_directly: true`.
    *
    * - **Deprecated:** use `POST /v1/companies/{company_id}/invoices`, which behaves
    *   identically.
    *
    * **Retires on 9 December 2026.** See the [migration guide](https://docs.beel.es/changelog/resources-under-the-nif) for what moved where and what changes when you switch.
    *
    * @param \Lenorix\BeelSdk\Generated\Model\CreateInvoiceRequest $requestBody
    * @param array{
    *    "wait_for_pdf"?: bool, //Same flag as `options.wait_for_pdf`, accepted here too so both routes to a PDF take it
    in the same place — `POST /v1/invoices/{invoice_id}/issue` declares it as a query param
    and this one used to accept it only inside the body.
    
    Only applies when the invoice is issued in this call (`options.issue_directly: true`).
    If `true`, waits for PDF generation and returns the URL in the response (~1-3s). It is
    enough to ask for it in one of the two places.
    * } $queryParameters
    * @param array{
    *    "BeeL-Active-Company"?: string, //Which company (tax ID) the request operates on.
    
    An API key belongs to an account, and an account may hold several companies. Endpoints that
    read or write company-owned data — invoices, customers, products, series, tax and VeriFactu
    settings — resolve their target company from this header **when the path does not already
    name one**.
    
    On a path that names the company, such as `/v1/companies/{company_id}/invoices`, the path
    is the target and this header is not read at all: it neither switches the target nor makes
    the request fail, so sending one that disagrees with the path is silently ignored rather
    than rejected. Prefer those paths whenever you need to be explicit about which tax ID you
    are operating on.
    
    On an account holding a single company the header may be omitted — that company is used.
    On an account holding several it is required: the request fails with
    `403 ACTIVE_COMPANY_REQUIRED` otherwise. A company-owned record always belongs to one tax
    ID, so operating on it without saying which one has no meaning.
    
    The company does **not** have to belong to the API key's own account: one you manage works
    too, which is what makes the `company_id` returned by `POST /v1/accounts` usable here to
    invoice on a provisioned account's behalf. What you may do with it is then decided by your
    access level over that account, and issuing also requires a signed fiscal representation.
    
    This header is how you **operate** on a company, never how you find one: a value you do not
    reach answers `403`, the same as one that does not exist, so guessing reveals nothing. Get
    the `company_id` from the response that created the company.
    
    Requires the `companies:read` scope. Returns `403` if the company is neither yours nor one
    you manage.
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
    
    * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
    * @throws \Lenorix\BeelSdk\Generated\Exception\CreateInvoiceBadRequestException
    * @throws \Lenorix\BeelSdk\Generated\Exception\CreateInvoiceUnauthorizedException
    * @throws \Lenorix\BeelSdk\Generated\Exception\CreateInvoiceForbiddenException
    * @throws \Lenorix\BeelSdk\Generated\Exception\CreateInvoiceConflictException
    * @throws \Lenorix\BeelSdk\Generated\Exception\CreateInvoiceUnprocessableEntityException
    * @throws \Lenorix\BeelSdk\Generated\Exception\CreateInvoiceTooManyRequestsException
    * @throws \Lenorix\BeelSdk\Generated\Exception\CreateInvoiceInternalServerErrorException
    *
    * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\V1InvoicesPostResponse201|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
    */
    public function createInvoice(\Lenorix\BeelSdk\Generated\Model\CreateInvoiceRequest $requestBody, array $queryParameters = [], array $headerParameters = [], string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\CreateInvoice($requestBody, $queryParameters, $headerParameters), $fetch);
    }
    /**
    * Deletes a draft invoice. The record is marked as deleted rather than removed.
    *
    * - **Deprecated:** use `DELETE /v1/companies/{company_id}/invoices/{invoice_id}`, which
    *   behaves identically.
    * - **Proformas:** if the draft came from converting a proforma, deleting it returns that
    *   proforma to `ACTIVE`.
    *
    * **Retires on 9 December 2026.** See the [migration guide](https://docs.beel.es/changelog/resources-under-the-nif) for what moved where and what changes when you switch.
    *
    * @param string $invoiceId Invoice ID
    * @param array{
    *    "BeeL-Active-Company"?: string, //Which company (tax ID) the request operates on.
    
    An API key belongs to an account, and an account may hold several companies. Endpoints that
    read or write company-owned data — invoices, customers, products, series, tax and VeriFactu
    settings — resolve their target company from this header **when the path does not already
    name one**.
    
    On a path that names the company, such as `/v1/companies/{company_id}/invoices`, the path
    is the target and this header is not read at all: it neither switches the target nor makes
    the request fail, so sending one that disagrees with the path is silently ignored rather
    than rejected. Prefer those paths whenever you need to be explicit about which tax ID you
    are operating on.
    
    On an account holding a single company the header may be omitted — that company is used.
    On an account holding several it is required: the request fails with
    `403 ACTIVE_COMPANY_REQUIRED` otherwise. A company-owned record always belongs to one tax
    ID, so operating on it without saying which one has no meaning.
    
    The company does **not** have to belong to the API key's own account: one you manage works
    too, which is what makes the `company_id` returned by `POST /v1/accounts` usable here to
    invoice on a provisioned account's behalf. What you may do with it is then decided by your
    access level over that account, and issuing also requires a signed fiscal representation.
    
    This header is how you **operate** on a company, never how you find one: a value you do not
    reach answers `403`, the same as one that does not exist, so guessing reveals nothing. Get
    the `company_id` from the response that created the company.
    
    Requires the `companies:read` scope. Returns `403` if the company is neither yours nor one
    you manage.
    * } $headerParameters
    
    * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
    * @throws \Lenorix\BeelSdk\Generated\Exception\DeleteInvoiceBadRequestException
    * @throws \Lenorix\BeelSdk\Generated\Exception\DeleteInvoiceUnauthorizedException
    * @throws \Lenorix\BeelSdk\Generated\Exception\DeleteInvoiceForbiddenException
    * @throws \Lenorix\BeelSdk\Generated\Exception\DeleteInvoiceNotFoundException
    * @throws \Lenorix\BeelSdk\Generated\Exception\DeleteInvoiceTooManyRequestsException
    * @throws \Lenorix\BeelSdk\Generated\Exception\DeleteInvoiceInternalServerErrorException
    *
    * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
    */
    public function deleteInvoice(string $invoiceId, array $headerParameters = [], string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\DeleteInvoice($invoiceId, $headerParameters), $fetch);
    }
    /**
    * Retrieves the full details of an invoice.
    *
    * - **Deprecated:** use `GET /v1/companies/{company_id}/invoices/{invoice_id}`, which
    *   behaves identically.
    *
    * **Retires on 9 December 2026.** See the [migration guide](https://docs.beel.es/changelog/resources-under-the-nif) for what moved where and what changes when you switch.
    *
    * @param string $invoiceId Invoice ID
    * @param array{
    *    "BeeL-Active-Company"?: string, //Which company (tax ID) the request operates on.
    
    An API key belongs to an account, and an account may hold several companies. Endpoints that
    read or write company-owned data — invoices, customers, products, series, tax and VeriFactu
    settings — resolve their target company from this header **when the path does not already
    name one**.
    
    On a path that names the company, such as `/v1/companies/{company_id}/invoices`, the path
    is the target and this header is not read at all: it neither switches the target nor makes
    the request fail, so sending one that disagrees with the path is silently ignored rather
    than rejected. Prefer those paths whenever you need to be explicit about which tax ID you
    are operating on.
    
    On an account holding a single company the header may be omitted — that company is used.
    On an account holding several it is required: the request fails with
    `403 ACTIVE_COMPANY_REQUIRED` otherwise. A company-owned record always belongs to one tax
    ID, so operating on it without saying which one has no meaning.
    
    The company does **not** have to belong to the API key's own account: one you manage works
    too, which is what makes the `company_id` returned by `POST /v1/accounts` usable here to
    invoice on a provisioned account's behalf. What you may do with it is then decided by your
    access level over that account, and issuing also requires a signed fiscal representation.
    
    This header is how you **operate** on a company, never how you find one: a value you do not
    reach answers `403`, the same as one that does not exist, so guessing reveals nothing. Get
    the `company_id` from the response that created the company.
    
    Requires the `companies:read` scope. Returns `403` if the company is neither yours nor one
    you manage.
    * } $headerParameters
    
    * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
    * @throws \Lenorix\BeelSdk\Generated\Exception\GetInvoiceBadRequestException
    * @throws \Lenorix\BeelSdk\Generated\Exception\GetInvoiceUnauthorizedException
    * @throws \Lenorix\BeelSdk\Generated\Exception\GetInvoiceForbiddenException
    * @throws \Lenorix\BeelSdk\Generated\Exception\GetInvoiceNotFoundException
    * @throws \Lenorix\BeelSdk\Generated\Exception\GetInvoiceTooManyRequestsException
    * @throws \Lenorix\BeelSdk\Generated\Exception\GetInvoiceInternalServerErrorException
    *
    * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\V1InvoicesInvoiceIdGetResponse200|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
    */
    public function getInvoice(string $invoiceId, array $headerParameters = [], string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\GetInvoice($invoiceId, $headerParameters), $fetch);
    }
    /**
    * Updates a draft invoice. Only invoices in `DRAFT` status can be modified.
    *
    * - **Deprecated:** use `PATCH /v1/companies/{company_id}/invoices/{invoice_id}`, the single
    *   update verb of the canonical form.
    * - **Difference:** only the verb changes. Both update just the fields present in the body
    *   and leave every other one untouched.
    *
    * **Retires on 9 December 2026.** See the [migration guide](https://docs.beel.es/changelog/resources-under-the-nif) for what moved where and what changes when you switch.
    *
    * @param string $invoiceId Invoice ID
    * @param \Lenorix\BeelSdk\Generated\Model\UpdateInvoiceRequest $requestBody
    * @param array{
    *    "BeeL-Active-Company"?: string, //Which company (tax ID) the request operates on.
    
    An API key belongs to an account, and an account may hold several companies. Endpoints that
    read or write company-owned data — invoices, customers, products, series, tax and VeriFactu
    settings — resolve their target company from this header **when the path does not already
    name one**.
    
    On a path that names the company, such as `/v1/companies/{company_id}/invoices`, the path
    is the target and this header is not read at all: it neither switches the target nor makes
    the request fail, so sending one that disagrees with the path is silently ignored rather
    than rejected. Prefer those paths whenever you need to be explicit about which tax ID you
    are operating on.
    
    On an account holding a single company the header may be omitted — that company is used.
    On an account holding several it is required: the request fails with
    `403 ACTIVE_COMPANY_REQUIRED` otherwise. A company-owned record always belongs to one tax
    ID, so operating on it without saying which one has no meaning.
    
    The company does **not** have to belong to the API key's own account: one you manage works
    too, which is what makes the `company_id` returned by `POST /v1/accounts` usable here to
    invoice on a provisioned account's behalf. What you may do with it is then decided by your
    access level over that account, and issuing also requires a signed fiscal representation.
    
    This header is how you **operate** on a company, never how you find one: a value you do not
    reach answers `403`, the same as one that does not exist, so guessing reveals nothing. Get
    the `company_id` from the response that created the company.
    
    Requires the `companies:read` scope. Returns `403` if the company is neither yours nor one
    you manage.
    * } $headerParameters
    
    * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
    * @throws \Lenorix\BeelSdk\Generated\Exception\UpdateInvoiceBadRequestException
    * @throws \Lenorix\BeelSdk\Generated\Exception\UpdateInvoiceUnauthorizedException
    * @throws \Lenorix\BeelSdk\Generated\Exception\UpdateInvoiceForbiddenException
    * @throws \Lenorix\BeelSdk\Generated\Exception\UpdateInvoiceNotFoundException
    * @throws \Lenorix\BeelSdk\Generated\Exception\UpdateInvoiceUnprocessableEntityException
    * @throws \Lenorix\BeelSdk\Generated\Exception\UpdateInvoiceTooManyRequestsException
    * @throws \Lenorix\BeelSdk\Generated\Exception\UpdateInvoiceInternalServerErrorException
    *
    * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\V1InvoicesInvoiceIdPutResponse200|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
    */
    public function updateInvoice(string $invoiceId, \Lenorix\BeelSdk\Generated\Model\UpdateInvoiceRequest $requestBody, array $headerParameters = [], string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\UpdateInvoice($invoiceId, $requestBody, $headerParameters), $fetch);
    }
    /**
     * Returns a single ZIP with the PDFs of the requested invoices.
     *
     * - **Deprecated:** use `POST /v1/companies/{company_id}/invoices/pdf-archive`, which
     *   behaves identically.
     * - **Limits:** up to 500 invoices per call, and the ZIP is capped at 50MB.
     * - **Missing PDFs:** invoices whose PDF is not available are left out; if none is
     *   available the call fails.
     *
     * **Retires on 9 December 2026.** See the [migration guide](https://docs.beel.es/changelog/resources-under-the-nif) for what moved where and what changes when you switch.
     *
     * @param \Lenorix\BeelSdk\Generated\Model\V1InvoicesBulkPdfPostBody $requestBody
     * @param array $accept Accept content header application/zip|application/json
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \Lenorix\BeelSdk\Generated\Exception\DownloadInvoicesPdfBulkBadRequestException
     * @throws \Lenorix\BeelSdk\Generated\Exception\DownloadInvoicesPdfBulkUnauthorizedException
     * @throws \Lenorix\BeelSdk\Generated\Exception\DownloadInvoicesPdfBulkForbiddenException
     * @throws \Lenorix\BeelSdk\Generated\Exception\DownloadInvoicesPdfBulkUnprocessableEntityException
     * @throws \Lenorix\BeelSdk\Generated\Exception\DownloadInvoicesPdfBulkTooManyRequestsException
     * @throws \Lenorix\BeelSdk\Generated\Exception\DownloadInvoicesPdfBulkInternalServerErrorException
     *
     * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
     */
    public function downloadInvoicesPdfBulk(\Lenorix\BeelSdk\Generated\Model\V1InvoicesBulkPdfPostBody $requestBody, string $fetch = self::FETCH_OBJECT, array $accept = [])
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\DownloadInvoicesPdfBulk($requestBody, $accept), $fetch);
    }
    /**
    * Sends one email carrying the PDFs of the requested invoices as attachments.
    *
    * - **Deprecated:** use `POST /v1/companies/{company_id}/invoices/deliveries`, which sends
    *   the same email from the same body, with `recipients` declared as required there.
    * - **Limits:** up to 200 invoices per call, and the attachments are capped at 25MB.
    * - **Eligible invoices:** only invoices in `ISSUED`, `SENT`, `PAID` or `OVERDUE` can be
    *   sent.
    * - **Partial failures:** invoices whose PDF cannot be attached are reported in `failures`
    *   and the message is still sent with the rest.
    *
    * **Retires on 9 December 2026.** See the [migration guide](https://docs.beel.es/changelog/resources-under-the-nif) for what moved where and what changes when you switch.
    *
    * @param \Lenorix\BeelSdk\Generated\Model\V1InvoicesBulkSendPostBody $requestBody
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
    
    * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
    * @throws \Lenorix\BeelSdk\Generated\Exception\SendInvoicesBulkEmailBadRequestException
    * @throws \Lenorix\BeelSdk\Generated\Exception\SendInvoicesBulkEmailUnauthorizedException
    * @throws \Lenorix\BeelSdk\Generated\Exception\SendInvoicesBulkEmailForbiddenException
    * @throws \Lenorix\BeelSdk\Generated\Exception\SendInvoicesBulkEmailUnprocessableEntityException
    * @throws \Lenorix\BeelSdk\Generated\Exception\SendInvoicesBulkEmailTooManyRequestsException
    * @throws \Lenorix\BeelSdk\Generated\Exception\SendInvoicesBulkEmailInternalServerErrorException
    *
    * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\V1InvoicesBulkSendPostResponse200|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
    */
    public function sendInvoicesBulkEmail(\Lenorix\BeelSdk\Generated\Model\V1InvoicesBulkSendPostBody $requestBody, array $headerParameters = [], string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\SendInvoicesBulkEmail($requestBody, $headerParameters), $fetch);
    }
    /**
    * Changes the status of several invoices at once and reports, invoice by invoice, which
    * succeeded and which failed.
    *
    * - **Deprecated:** use `POST /v1/companies/{company_id}/invoices/batches` with
    *   `operation: STATUS`, which applies the same change. `new_status` and `payment_date`
    *   travel in the same body there.
    * - **Target status:** `new_status` accepts `SENT` or `PAID`. `PAID` requires
    *   `payment_date`.
    * - **Limits:** up to 50 invoices per call.
    *
    * **Retires on 9 December 2026.** See the [migration guide](https://docs.beel.es/changelog/resources-under-the-nif) for what moved where and what changes when you switch.
    *
    * @param \Lenorix\BeelSdk\Generated\Model\V1InvoicesBulkStatusPostBody $requestBody
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
    
    * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
    * @throws \Lenorix\BeelSdk\Generated\Exception\ChangeInvoicesStatusBulkBadRequestException
    * @throws \Lenorix\BeelSdk\Generated\Exception\ChangeInvoicesStatusBulkUnauthorizedException
    * @throws \Lenorix\BeelSdk\Generated\Exception\ChangeInvoicesStatusBulkForbiddenException
    * @throws \Lenorix\BeelSdk\Generated\Exception\ChangeInvoicesStatusBulkUnprocessableEntityException
    * @throws \Lenorix\BeelSdk\Generated\Exception\ChangeInvoicesStatusBulkTooManyRequestsException
    * @throws \Lenorix\BeelSdk\Generated\Exception\ChangeInvoicesStatusBulkInternalServerErrorException
    *
    * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\BulkOperationResponse|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
    */
    public function changeInvoicesStatusBulk(\Lenorix\BeelSdk\Generated\Model\V1InvoicesBulkStatusPostBody $requestBody, array $headerParameters = [], string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\ChangeInvoicesStatusBulk($requestBody, $headerParameters), $fetch);
    }
    /**
    * Issues several draft invoices at once, each one assigned its definitive number.
    *
    * - **Deprecated:** use `POST /v1/companies/{company_id}/invoices/batches` with
    *   `operation: ISSUE`, which issues the same drafts.
    * - **Limits:** up to 50 invoices per call.
    * - **Not atomic:** each invoice is issued in its own transaction, and since issuing is
    *   irreversible, the ones already issued stay issued if a later one fails.
    *
    * **Retires on 9 December 2026.** See the [migration guide](https://docs.beel.es/changelog/resources-under-the-nif) for what moved where and what changes when you switch.
    *
    * @param \Lenorix\BeelSdk\Generated\Model\V1InvoicesBulkIssuePostBody $requestBody
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
    
    * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
    * @throws \Lenorix\BeelSdk\Generated\Exception\IssueInvoicesBulkBadRequestException
    * @throws \Lenorix\BeelSdk\Generated\Exception\IssueInvoicesBulkUnauthorizedException
    * @throws \Lenorix\BeelSdk\Generated\Exception\IssueInvoicesBulkForbiddenException
    * @throws \Lenorix\BeelSdk\Generated\Exception\IssueInvoicesBulkUnprocessableEntityException
    * @throws \Lenorix\BeelSdk\Generated\Exception\IssueInvoicesBulkTooManyRequestsException
    * @throws \Lenorix\BeelSdk\Generated\Exception\IssueInvoicesBulkInternalServerErrorException
    *
    * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\BulkOperationResponse|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
    */
    public function issueInvoicesBulk(\Lenorix\BeelSdk\Generated\Model\V1InvoicesBulkIssuePostBody $requestBody, array $headerParameters = [], string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\IssueInvoicesBulk($requestBody, $headerParameters), $fetch);
    }
    /**
    * Returns a temporary pre-signed URL to download the invoice PDF.
    *
    * - **Deprecated:** use `GET /v1/companies/{company_id}/invoices/{invoice_id}/pdf`, which
    *   behaves identically.
    * - **URL:** it expires in five minutes and only allows `GET`.
    * - **Waiting:** a PDF is produced asynchronously, so this request **waits** for it (up to
    *   ten seconds) instead of handing you a polling loop to write. Bound the wait with
    *   `Prefer: wait=N`, or opt out with `Prefer: wait=0`.
    *
    * **Retires on 9 December 2026.** See the [migration guide](https://docs.beel.es/changelog/resources-under-the-nif) for what moved where and what changes when you switch.
    *
    * @param string $invoiceId Invoice ID
    * @param array{
    *    "Prefer"?: string, //RFC 7240 preference bounding how long this request may wait for a PDF that is still
    being generated: `Prefer: wait=N`, with `N` in seconds.
    
    By default the request waits (up to the server cap) and answers `200` with the URL, so
    the `202` is the exception rather than the normal path. Use `Prefer: wait=0` to opt out
    and get the old poll-only behaviour: an immediate `202` while the PDF is in flight.
    
    A value above the cap is lowered to it, and the `202` then echoes what was actually
    applied in `Preference-Applied: wait=<seconds>` — so you never have to discover the cap
    by trial and error. A value that is not a non-negative integer is ignored altogether
    (RFC 7240: a preference that is not understood is not an error), and the request falls
    back to the default wait with no `Preference-Applied` header.
    * } $headerParameters
    
    * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
    * @throws \Lenorix\BeelSdk\Generated\Exception\GenerateInvoicePdfBadRequestException
    * @throws \Lenorix\BeelSdk\Generated\Exception\GenerateInvoicePdfUnauthorizedException
    * @throws \Lenorix\BeelSdk\Generated\Exception\GenerateInvoicePdfForbiddenException
    * @throws \Lenorix\BeelSdk\Generated\Exception\GenerateInvoicePdfNotFoundException
    * @throws \Lenorix\BeelSdk\Generated\Exception\GenerateInvoicePdfTooManyRequestsException
    * @throws \Lenorix\BeelSdk\Generated\Exception\GenerateInvoicePdfInternalServerErrorException
    *
    * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\InvoicePdfResponse|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
    */
    public function generateInvoicePdf(string $invoiceId, array $headerParameters = [], string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\GenerateInvoicePdf($invoiceId, $headerParameters), $fetch);
    }
    /**
     * Renders the PDF of a draft invoice on the fly, without storing it, and returns it as
     * `application/pdf`.
     *
     * - **Deprecated:** use `GET /v1/companies/{company_id}/invoices/{invoice_id}/pdf/preview`,
     *   which behaves identically.
     *
     * **Retires on 9 December 2026.** See the [migration guide](https://docs.beel.es/changelog/resources-under-the-nif) for what moved where and what changes when you switch.
     *
     * @param string $invoiceId Invoice ID (must be a draft)
     * @param array $accept Accept content header application/pdf|application/json
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \Lenorix\BeelSdk\Generated\Exception\PreviewDraftInvoicePdfBadRequestException
     * @throws \Lenorix\BeelSdk\Generated\Exception\PreviewDraftInvoicePdfUnauthorizedException
     * @throws \Lenorix\BeelSdk\Generated\Exception\PreviewDraftInvoicePdfForbiddenException
     * @throws \Lenorix\BeelSdk\Generated\Exception\PreviewDraftInvoicePdfNotFoundException
     * @throws \Lenorix\BeelSdk\Generated\Exception\PreviewDraftInvoicePdfTooManyRequestsException
     * @throws \Lenorix\BeelSdk\Generated\Exception\PreviewDraftInvoicePdfInternalServerErrorException
     *
     * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
     */
    public function previewDraftInvoicePdf(string $invoiceId, string $fetch = self::FETCH_OBJECT, array $accept = [])
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\PreviewDraftInvoicePdf($invoiceId, $accept), $fetch);
    }
    /**
    * Sends the invoice by email with its PDF attached.
    *
    * - **Deprecated:** use `POST /v1/companies/{company_id}/invoices/{invoice_id}/send`, which
    *   behaves identically.
    * - **Recipients:** the addresses configured for the customer are used unless the body
    *   overrides them with `recipients`.
    *
    * **Retires on 9 December 2026.** See the [migration guide](https://docs.beel.es/changelog/resources-under-the-nif) for what moved where and what changes when you switch.
    *
    * @param string $invoiceId Invoice ID
    * @param null|\Lenorix\BeelSdk\Generated\Model\SendEmailRequest $requestBody
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
    
    * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
    * @throws \Lenorix\BeelSdk\Generated\Exception\SendInvoiceEmailBadRequestException
    * @throws \Lenorix\BeelSdk\Generated\Exception\SendInvoiceEmailUnauthorizedException
    * @throws \Lenorix\BeelSdk\Generated\Exception\SendInvoiceEmailForbiddenException
    * @throws \Lenorix\BeelSdk\Generated\Exception\SendInvoiceEmailNotFoundException
    * @throws \Lenorix\BeelSdk\Generated\Exception\SendInvoiceEmailTooManyRequestsException
    * @throws \Lenorix\BeelSdk\Generated\Exception\SendInvoiceEmailInternalServerErrorException
    *
    * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\V1InvoicesInvoiceIdSendPostResponse200|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
    */
    public function sendInvoiceEmail(string $invoiceId, ?\Lenorix\BeelSdk\Generated\Model\SendEmailRequest $requestBody = null, array $headerParameters = [], string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\SendInvoiceEmail($invoiceId, $requestBody, $headerParameters), $fetch);
    }
    /**
    * Marks an invoice as paid.
    *
    * - **Deprecated:** use `PUT /v1/companies/{company_id}/invoices/{invoice_id}/status` with
    *   `{"status": "PAID"}`, which behaves identically.
    * - **Payment details:** `payment_date` and `payment_method` travel in the same body
    *   there.
    *
    * **Retires on 9 December 2026.** See the [migration guide](https://docs.beel.es/changelog/resources-under-the-nif) for what moved where and what changes when you switch.
    *
    * @param string $invoiceId Invoice ID
    * @param null|\Lenorix\BeelSdk\Generated\Model\V1InvoicesInvoiceIdMarkPaidPostBody $requestBody
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
    
    * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
    * @throws \Lenorix\BeelSdk\Generated\Exception\MarkInvoicePaidBadRequestException
    * @throws \Lenorix\BeelSdk\Generated\Exception\MarkInvoicePaidUnauthorizedException
    * @throws \Lenorix\BeelSdk\Generated\Exception\MarkInvoicePaidForbiddenException
    * @throws \Lenorix\BeelSdk\Generated\Exception\MarkInvoicePaidNotFoundException
    * @throws \Lenorix\BeelSdk\Generated\Exception\MarkInvoicePaidTooManyRequestsException
    * @throws \Lenorix\BeelSdk\Generated\Exception\MarkInvoicePaidInternalServerErrorException
    *
    * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\V1InvoicesInvoiceIdMarkPaidPostResponse200|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
    */
    public function markInvoicePaid(string $invoiceId, ?\Lenorix\BeelSdk\Generated\Model\V1InvoicesInvoiceIdMarkPaidPostBody $requestBody = null, array $headerParameters = [], string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\MarkInvoicePaid($invoiceId, $requestBody, $headerParameters), $fetch);
    }
    /**
    * Voids an issued invoice, moving it to `VOIDED`.
    *
    * - **Deprecated:** use `POST /v1/companies/{company_id}/invoices/{invoice_id}/void`, which
    *   behaves identically.
    * - **VeriFactu:** when it is enabled for the invoice, the cancellation is submitted to the
    *   AEAT.
    * - **`reason`:** required in the body. `void_date` is optional.
    *
    * **Retires on 9 December 2026.** See the [migration guide](https://docs.beel.es/changelog/resources-under-the-nif) for what moved where and what changes when you switch.
    *
    * @param string $invoiceId Invoice ID
    * @param \Lenorix\BeelSdk\Generated\Model\VoidInvoiceRequest $requestBody
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
    
    * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
    * @throws \Lenorix\BeelSdk\Generated\Exception\VoidInvoiceBadRequestException
    * @throws \Lenorix\BeelSdk\Generated\Exception\VoidInvoiceUnauthorizedException
    * @throws \Lenorix\BeelSdk\Generated\Exception\VoidInvoiceForbiddenException
    * @throws \Lenorix\BeelSdk\Generated\Exception\VoidInvoiceNotFoundException
    * @throws \Lenorix\BeelSdk\Generated\Exception\VoidInvoiceConflictException
    * @throws \Lenorix\BeelSdk\Generated\Exception\VoidInvoiceUnprocessableEntityException
    * @throws \Lenorix\BeelSdk\Generated\Exception\VoidInvoiceTooManyRequestsException
    * @throws \Lenorix\BeelSdk\Generated\Exception\VoidInvoiceInternalServerErrorException
    *
    * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\V1InvoicesInvoiceIdVoidPostResponse200|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
    */
    public function voidInvoice(string $invoiceId, \Lenorix\BeelSdk\Generated\Model\VoidInvoiceRequest $requestBody, array $headerParameters = [], string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\VoidInvoice($invoiceId, $requestBody, $headerParameters), $fetch);
    }
    /**
    * Issues a corrective invoice that amends an issued invoice.
    *
    * - **Deprecated:** use `POST /v1/companies/{company_id}/invoices/{invoice_id}/corrective`,
    *   which behaves identically.
    * - **Rectification type:** a `TOTAL` rectification leaves the original `VOIDED`; a
    *   `PARTIAL` one leaves it `RECTIFIED`.
    * - **Fiscal inheritance on a `PARTIAL`:** lines that omit `irpf_rate` or
    *   `equivalence_surcharge_rate` take them from the original invoice, not from the
    *   company's current tax profile; an ambiguous original fails with
    *   `422 CORRECTIVE_ORIGINAL_MIXED_IRPF` or `422 CORRECTIVE_ORIGINAL_MIXED_SURCHARGE`.
    *   The successor operation documents the rule in full.
    *
    * **Retires on 9 December 2026.** See the [migration guide](https://docs.beel.es/changelog/resources-under-the-nif) for what moved where and what changes when you switch.
    *
    * @param string $invoiceId Invoice ID to rectify
    * @param \Lenorix\BeelSdk\Generated\Model\CreateCorrectiveInvoiceRequest $requestBody
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
    
    * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
    * @throws \Lenorix\BeelSdk\Generated\Exception\CreateCorrectiveInvoiceBadRequestException
    * @throws \Lenorix\BeelSdk\Generated\Exception\CreateCorrectiveInvoiceUnauthorizedException
    * @throws \Lenorix\BeelSdk\Generated\Exception\CreateCorrectiveInvoiceForbiddenException
    * @throws \Lenorix\BeelSdk\Generated\Exception\CreateCorrectiveInvoiceNotFoundException
    * @throws \Lenorix\BeelSdk\Generated\Exception\CreateCorrectiveInvoiceUnprocessableEntityException
    * @throws \Lenorix\BeelSdk\Generated\Exception\CreateCorrectiveInvoiceTooManyRequestsException
    * @throws \Lenorix\BeelSdk\Generated\Exception\CreateCorrectiveInvoiceInternalServerErrorException
    *
    * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\V1InvoicesInvoiceIdCorrectivePostResponse201|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
    */
    public function createCorrectiveInvoice(string $invoiceId, \Lenorix\BeelSdk\Generated\Model\CreateCorrectiveInvoiceRequest $requestBody, array $headerParameters = [], string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\CreateCorrectiveInvoice($invoiceId, $requestBody, $headerParameters), $fetch);
    }
    /**
    * Finalizes a draft invoice: assigns its definitive number from the configured series and
    * makes it immutable. Irreversible.
    *
    * - **Deprecated:** use `POST /v1/companies/{company_id}/invoices/{invoice_id}/issue`, which
    *   behaves identically.
    * - **PDF:** the PDF is generated asynchronously unless `wait_for_pdf` is `true`, which
    *   waits for it and returns its URL.
    *
    * **Retires on 9 December 2026.** See the [migration guide](https://docs.beel.es/changelog/resources-under-the-nif) for what moved where and what changes when you switch.
    *
    * @param string $invoiceId Invoice ID
    * @param array{
    *    "wait_for_pdf"?: bool, //If `true`, waits for PDF generation and returns the URL in the response.
    Adds ~1-2s latency but guarantees PDF is immediately available.
    If `false` (default), PDF is generated asynchronously.
    *    "attach_source_invoices"?: bool, //Only applies when the invoice has automatic email sending enabled. If `true`, the
    email sent after issuing also attaches a ZIP (`suplidos_<invoice-number>.zip`) with
    the PDFs of the source invoices referenced by the invoice's SUPLIDO consolidation
    lines. Access to sources owned by managed accounts is re-checked with the same rules
    as issuing, and the request fails synchronously with an actionable error — never a
    partial ZIP — if the invoice has no consolidation sources
    (`ATTACH_SOURCE_INVOICES_NO_SOURCES`), a source is not reachable
    (`ATTACH_SOURCE_INVOICE_UNAVAILABLE`) or a source has no generated PDF
    (`ATTACH_SOURCE_PDF_MISSING`).
    * } $queryParameters
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
    
    * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
    * @throws \Lenorix\BeelSdk\Generated\Exception\IssueInvoiceBadRequestException
    * @throws \Lenorix\BeelSdk\Generated\Exception\IssueInvoiceUnauthorizedException
    * @throws \Lenorix\BeelSdk\Generated\Exception\IssueInvoiceForbiddenException
    * @throws \Lenorix\BeelSdk\Generated\Exception\IssueInvoiceNotFoundException
    * @throws \Lenorix\BeelSdk\Generated\Exception\IssueInvoiceConflictException
    * @throws \Lenorix\BeelSdk\Generated\Exception\IssueInvoiceUnprocessableEntityException
    * @throws \Lenorix\BeelSdk\Generated\Exception\IssueInvoiceTooManyRequestsException
    * @throws \Lenorix\BeelSdk\Generated\Exception\IssueInvoiceInternalServerErrorException
    *
    * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\V1InvoicesInvoiceIdIssuePostResponse200|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
    */
    public function issueInvoice(string $invoiceId, array $queryParameters = [], array $headerParameters = [], string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\IssueInvoice($invoiceId, $queryParameters, $headerParameters), $fetch);
    }
    /**
    * Converts an accepted proforma into a real invoice.
    *
    * - **Deprecated:** use
    *   `POST /v1/companies/{company_id}/invoices/{invoice_id}/convert-to-invoice`, which
    *   behaves identically.
    * - **Result:** the proforma moves to the terminal status `CONVERTED` and a new `STANDARD`
    *   invoice is created in `DRAFT`.
    * - **Issuing:** `issue: true` numbers and issues that new invoice in the same call.
    *
    * **Retires on 9 December 2026.** See the [migration guide](https://docs.beel.es/changelog/resources-under-the-nif) for what moved where and what changes when you switch.
    *
    * @param string $invoiceId Proforma ID to convert
    * @param null|\Lenorix\BeelSdk\Generated\Model\ConvertProformaToInvoiceRequest $requestBody
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
    
    * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
    * @throws \Lenorix\BeelSdk\Generated\Exception\ConvertProformaToInvoiceUnauthorizedException
    * @throws \Lenorix\BeelSdk\Generated\Exception\ConvertProformaToInvoiceForbiddenException
    * @throws \Lenorix\BeelSdk\Generated\Exception\ConvertProformaToInvoiceNotFoundException
    * @throws \Lenorix\BeelSdk\Generated\Exception\ConvertProformaToInvoiceConflictException
    * @throws \Lenorix\BeelSdk\Generated\Exception\ConvertProformaToInvoiceUnprocessableEntityException
    * @throws \Lenorix\BeelSdk\Generated\Exception\ConvertProformaToInvoiceTooManyRequestsException
    * @throws \Lenorix\BeelSdk\Generated\Exception\ConvertProformaToInvoiceInternalServerErrorException
    *
    * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\V1InvoicesInvoiceIdConvertToInvoicePostResponse201|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
    */
    public function convertProformaToInvoice(string $invoiceId, ?\Lenorix\BeelSdk\Generated\Model\ConvertProformaToInvoiceRequest $requestBody = null, array $headerParameters = [], string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\ConvertProformaToInvoice($invoiceId, $requestBody, $headerParameters), $fetch);
    }
    /**
    * Marks an issued invoice as sent through a channel outside the email system, recording
    * `sent_at`.
    *
    * - **Deprecated:** use `PUT /v1/companies/{company_id}/invoices/{invoice_id}/status` with
    *   `{"status": "SENT"}`, which behaves identically.
    * - **Timestamp:** the moment of sending travels in the same body there, as `sent_at`.
    *
    * **Retires on 9 December 2026.** See the [migration guide](https://docs.beel.es/changelog/resources-under-the-nif) for what moved where and what changes when you switch.
    *
    * @param string $invoiceId Invoice ID
    * @param null|\Lenorix\BeelSdk\Generated\Model\V1InvoicesInvoiceIdMarkSentPostBody $requestBody
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
    
    * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
    * @throws \Lenorix\BeelSdk\Generated\Exception\MarkInvoiceSentBadRequestException
    * @throws \Lenorix\BeelSdk\Generated\Exception\MarkInvoiceSentUnauthorizedException
    * @throws \Lenorix\BeelSdk\Generated\Exception\MarkInvoiceSentForbiddenException
    * @throws \Lenorix\BeelSdk\Generated\Exception\MarkInvoiceSentNotFoundException
    * @throws \Lenorix\BeelSdk\Generated\Exception\MarkInvoiceSentTooManyRequestsException
    * @throws \Lenorix\BeelSdk\Generated\Exception\MarkInvoiceSentInternalServerErrorException
    *
    * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\V1InvoicesInvoiceIdMarkSentPostResponse200|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
    */
    public function markInvoiceSent(string $invoiceId, ?\Lenorix\BeelSdk\Generated\Model\V1InvoicesInvoiceIdMarkSentPostBody $requestBody = null, array $headerParameters = [], string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\MarkInvoiceSent($invoiceId, $requestBody, $headerParameters), $fetch);
    }
    /**
    * Returns an invoice from `SENT` to `ISSUED` and clears `sent_at`, to undo a `SENT` set by
    * mistake. It never un-issues an invoice.
    *
    * - **Deprecated:** use `PUT /v1/companies/{company_id}/invoices/{invoice_id}/status` with
    *   `{"status": "ISSUED"}`, which behaves identically.
    *
    * **Retires on 9 December 2026.** See the [migration guide](https://docs.beel.es/changelog/resources-under-the-nif) for what moved where and what changes when you switch.
    *
    * @param string $invoiceId Invoice ID
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
    
    * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
    * @throws \Lenorix\BeelSdk\Generated\Exception\RevertInvoiceToIssuedBadRequestException
    * @throws \Lenorix\BeelSdk\Generated\Exception\RevertInvoiceToIssuedUnauthorizedException
    * @throws \Lenorix\BeelSdk\Generated\Exception\RevertInvoiceToIssuedForbiddenException
    * @throws \Lenorix\BeelSdk\Generated\Exception\RevertInvoiceToIssuedNotFoundException
    * @throws \Lenorix\BeelSdk\Generated\Exception\RevertInvoiceToIssuedTooManyRequestsException
    * @throws \Lenorix\BeelSdk\Generated\Exception\RevertInvoiceToIssuedInternalServerErrorException
    *
    * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\V1InvoicesInvoiceIdRevertToIssuedPostResponse200|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
    */
    public function revertInvoiceToIssued(string $invoiceId, array $headerParameters = [], string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\RevertInvoiceToIssued($invoiceId, $headerParameters), $fetch);
    }
    /**
    * Schedules a draft invoice to be processed on a future date, moving it to `SCHEDULED`.
    *
    * - **Deprecated:** use `PUT /v1/companies/{company_id}/invoices/{invoice_id}/schedule`,
    *   which schedules the same way.
    * - **Difference:** the `action` flag is replaced there by `generation_mode`, which is
    *   required.
    *
    * **Retires on 9 December 2026.** See the [migration guide](https://docs.beel.es/changelog/resources-under-the-nif) for what moved where and what changes when you switch.
    *
    * @param string $invoiceId Invoice ID
    * @param \Lenorix\BeelSdk\Generated\Model\V1InvoicesInvoiceIdSchedulePostBody $requestBody
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
    
    * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
    * @throws \Lenorix\BeelSdk\Generated\Exception\ScheduleInvoiceBadRequestException
    * @throws \Lenorix\BeelSdk\Generated\Exception\ScheduleInvoiceUnauthorizedException
    * @throws \Lenorix\BeelSdk\Generated\Exception\ScheduleInvoiceForbiddenException
    * @throws \Lenorix\BeelSdk\Generated\Exception\ScheduleInvoiceNotFoundException
    * @throws \Lenorix\BeelSdk\Generated\Exception\ScheduleInvoiceUnprocessableEntityException
    * @throws \Lenorix\BeelSdk\Generated\Exception\ScheduleInvoiceTooManyRequestsException
    * @throws \Lenorix\BeelSdk\Generated\Exception\ScheduleInvoiceInternalServerErrorException
    *
    * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\V1InvoicesInvoiceIdSchedulePostResponse200|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
    */
    public function scheduleInvoice(string $invoiceId, \Lenorix\BeelSdk\Generated\Model\V1InvoicesInvoiceIdSchedulePostBody $requestBody, array $headerParameters = [], string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\ScheduleInvoice($invoiceId, $requestBody, $headerParameters), $fetch);
    }
    /**
    * Removes the scheduling of an invoice, returning it to `DRAFT`.
    *
    * - **Deprecated:** use `DELETE /v1/companies/{company_id}/invoices/{invoice_id}/schedule`,
    *   which removes the same scheduling.
    * - **Difference:** that route answers `204` with no body, where this one answers `200` with
    *   the invoice.
    *
    * **Retires on 9 December 2026.** See the [migration guide](https://docs.beel.es/changelog/resources-under-the-nif) for what moved where and what changes when you switch.
    *
    * @param string $invoiceId Invoice ID
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
    
    * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
    * @throws \Lenorix\BeelSdk\Generated\Exception\UnscheduleInvoiceBadRequestException
    * @throws \Lenorix\BeelSdk\Generated\Exception\UnscheduleInvoiceUnauthorizedException
    * @throws \Lenorix\BeelSdk\Generated\Exception\UnscheduleInvoiceForbiddenException
    * @throws \Lenorix\BeelSdk\Generated\Exception\UnscheduleInvoiceNotFoundException
    * @throws \Lenorix\BeelSdk\Generated\Exception\UnscheduleInvoiceTooManyRequestsException
    * @throws \Lenorix\BeelSdk\Generated\Exception\UnscheduleInvoiceInternalServerErrorException
    *
    * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\V1InvoicesInvoiceIdUnschedulePostResponse200|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
    */
    public function unscheduleInvoice(string $invoiceId, array $headerParameters = [], string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\UnscheduleInvoice($invoiceId, $headerParameters), $fetch);
    }
    /**
     * Changes the date of a scheduled invoice, which stays `SCHEDULED`. The new date must be
     * today or later.
     *
     * - **Deprecated:** use `PUT /v1/companies/{company_id}/invoices/{invoice_id}/schedule`, the
     *   single verb that schedules and reschedules.
     * - **Difference:** the new date travels there in `scheduled_for`, alongside the required
     *   `generation_mode`.
     *
     * **Retires on 9 December 2026.** See the [migration guide](https://docs.beel.es/changelog/resources-under-the-nif) for what moved where and what changes when you switch.
     *
     * @param string $invoiceId Invoice ID
     * @param \Lenorix\BeelSdk\Generated\Model\V1InvoicesInvoiceIdReschedulePatchBody $requestBody
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \Lenorix\BeelSdk\Generated\Exception\RescheduleInvoiceBadRequestException
     * @throws \Lenorix\BeelSdk\Generated\Exception\RescheduleInvoiceUnauthorizedException
     * @throws \Lenorix\BeelSdk\Generated\Exception\RescheduleInvoiceForbiddenException
     * @throws \Lenorix\BeelSdk\Generated\Exception\RescheduleInvoiceNotFoundException
     * @throws \Lenorix\BeelSdk\Generated\Exception\RescheduleInvoiceUnprocessableEntityException
     * @throws \Lenorix\BeelSdk\Generated\Exception\RescheduleInvoiceTooManyRequestsException
     * @throws \Lenorix\BeelSdk\Generated\Exception\RescheduleInvoiceInternalServerErrorException
     *
     * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\V1InvoicesInvoiceIdReschedulePatchResponse200|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
     */
    public function rescheduleInvoice(string $invoiceId, \Lenorix\BeelSdk\Generated\Model\V1InvoicesInvoiceIdReschedulePatchBody $requestBody, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\RescheduleInvoice($invoiceId, $requestBody), $fetch);
    }
    /**
    * Creates a copy of an existing invoice as a new draft.
    *
    * - **Deprecated:** use `POST /v1/companies/{company_id}/invoices/derivations`, which
    *   creates the same draft.
    * - **Difference:** the source invoice travels there in the body as `from_invoice_id`
    *   instead of in the path, and `mode` is required.
    * - **What is copied:** recipient, lines, payment method, series and observations. Number,
    *   status, dates, VeriFactu data and PDF are reset.
    *
    * **Retires on 9 December 2026.** See the [migration guide](https://docs.beel.es/changelog/resources-under-the-nif) for what moved where and what changes when you switch.
    *
    * @param string $invoiceId ID of the invoice to duplicate
    * @param null|\Lenorix\BeelSdk\Generated\Model\V1InvoicesInvoiceIdDuplicatePostBody $requestBody
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
    
    * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
    * @throws \Lenorix\BeelSdk\Generated\Exception\DuplicateInvoiceBadRequestException
    * @throws \Lenorix\BeelSdk\Generated\Exception\DuplicateInvoiceUnauthorizedException
    * @throws \Lenorix\BeelSdk\Generated\Exception\DuplicateInvoiceForbiddenException
    * @throws \Lenorix\BeelSdk\Generated\Exception\DuplicateInvoiceNotFoundException
    * @throws \Lenorix\BeelSdk\Generated\Exception\DuplicateInvoiceUnprocessableEntityException
    * @throws \Lenorix\BeelSdk\Generated\Exception\DuplicateInvoiceTooManyRequestsException
    * @throws \Lenorix\BeelSdk\Generated\Exception\DuplicateInvoiceInternalServerErrorException
    *
    * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\V1InvoicesInvoiceIdDuplicatePostResponse201|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
    */
    public function duplicateInvoice(string $invoiceId, ?\Lenorix\BeelSdk\Generated\Model\V1InvoicesInvoiceIdDuplicatePostBody $requestBody = null, array $headerParameters = [], string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\DuplicateInvoice($invoiceId, $requestBody, $headerParameters), $fetch);
    }
    /**
     * Exports invoices to an XLSX file.
     *
     * - **Deprecated:** use `POST /v1/companies/{company_id}/invoices/exports`, which produces
     *   the same file.
     * - **Difference:** the selection criteria are grouped there under `filters` instead of
     *   being top-level fields.
     * - **Selection:** the invoices named in `invoice_ids`, or, when that list is absent, the
     *   ones matching the filters.
     * - **Format:** `SUMMARY` gives one row per invoice with aggregated totals, `ITEMS` one row
     *   per invoice line.
     *
     * **Retires on 9 December 2026.** See the [migration guide](https://docs.beel.es/changelog/resources-under-the-nif) for what moved where and what changes when you switch.
     *
     * @param \Lenorix\BeelSdk\Generated\Model\V1InvoicesExportExcelPostBody $requestBody
     * @param array $accept Accept content header application/vnd.openxmlformats-officedocument.spreadsheetml.sheet|application/json
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \Lenorix\BeelSdk\Generated\Exception\ExportInvoicesExcelBadRequestException
     * @throws \Lenorix\BeelSdk\Generated\Exception\ExportInvoicesExcelUnauthorizedException
     * @throws \Lenorix\BeelSdk\Generated\Exception\ExportInvoicesExcelForbiddenException
     * @throws \Lenorix\BeelSdk\Generated\Exception\ExportInvoicesExcelUnprocessableEntityException
     * @throws \Lenorix\BeelSdk\Generated\Exception\ExportInvoicesExcelTooManyRequestsException
     * @throws \Lenorix\BeelSdk\Generated\Exception\ExportInvoicesExcelInternalServerErrorException
     *
     * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
     */
    public function exportInvoicesExcel(\Lenorix\BeelSdk\Generated\Model\V1InvoicesExportExcelPostBody $requestBody, string $fetch = self::FETCH_OBJECT, array $accept = [])
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\ExportInvoicesExcel($requestBody, $accept), $fetch);
    }
    /**
    * Returns a paginated list of the invoices of this company, filterable by status, type,
    * series, customer, date range and free text. Only the documents of the company in the path
    * are returned.
    *
    * @param string $companyId Unique identifier (UUID) of the company the operation acts on — its identifier, not its NIF. It is the only source of context: the account that owns it is derived from it, and the `BeeL-Active-Company` header plays no part. A company you do not reach answers `403`, and so does a company that does not exist, so the existence of a company in another account is never disclosed.
    * @param array{
    *    "page"?: int, //Page number, starting at 1. The response echoes it back as `pagination.current_page`.
    *    "limit"?: int, //How many items to return per page. The response echoes it back as `pagination.items_per_page`.
    *    "search"?: string, //Global search across invoice number, recipient name, recipient NIF, and series code (partial, case-insensitive)
    *    "status"?: array, //Filter by invoice status. Accepts a comma-separated list to match any of several
    statuses, for example `status=DRAFT,ISSUED`. A single value is also valid.
    *    "type"?: string, //Filter by invoice type
    *    "fiscal_only"?: bool, //When `true`, returns only fiscal documents (STANDARD, CORRECTIVE, SIMPLIFIED),
    excluding proformas and any other non-fiscal document. Defaults to `false`
    (the list returns every document type). Ignored when an explicit `type` is given.
    *    "customer_id"?: string, //Filter by customer UUID
    *    "date_from"?: string, //Issue date from (YYYY-MM-DD)
    *    "date_to"?: string, //Issue date to (YYYY-MM-DD)
    *    "invoice_number"?: string, //Search by invoice number (e.g., 2025/0001)
    *    "recipient_name"?: string, //Filter by recipient's fiscal name (partial, case-insensitive search)
    *    "recipient_nif"?: string, //Filter by recipient's NIF (partial search)
    *    "series_code"?: string, //Filter by series code (exact match, case-insensitive). Use `search` for partial matching across the invoice number, recipient and series code.
    *    "external_ref"?: string, //Filter by exact external reference (client-supplied order/cart/contract id).
    *    "rectified_invoice_id"?: string, //Return the corrective invoices that correct this invoice. Accepts the id of an
    issued invoice; a single invoice can have several partial correctives.
    *    "taxable_base_min"?: float, //Minimum taxable base
    *    "taxable_base_max"?: float, //Maximum taxable base
    *    "total_min"?: float, //Minimum invoice total
    *    "total_max"?: float, //Maximum invoice total
    *    "verifactu_status"?: string, //Filter by the VeriFactu submission status of the invoice, using the very same
    vocabulary that `verifactu.submission_status` publishes on each invoice.
    `NOT_SUBMITTED` selects issued invoices with VeriFactu enabled whose
    registration never happened (no live record).
    *    "verifactu_enabled"?: bool, //Filter by whether VeriFactu is enabled for the invoice — the same flag published as
    `verifactu.enabled`. `false` returns the invoices that never reach AEAT.
    *    "metadata"?: array, //Filter by metadata key/value pairs (exact match, AND between keys).
    Repeat the bracket-style param to filter on multiple keys.
    Max 50 pairs per request. Keys must match `^[A-Za-z0-9_\-.]{1,64}$`.
    Example: `?metadata[external_order_id]=ORD-42&metadata[tenant]=acme`
    *    "sort_by"?: string, //Field to sort by (e.g., issue_date, invoice_number, invoice_total)
    *    "sort_order"?: string, //Sort direction
    * } $queryParameters
    
    * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
    * @throws \Lenorix\BeelSdk\Generated\Exception\ListCompanyInvoicesBadRequestException
    * @throws \Lenorix\BeelSdk\Generated\Exception\ListCompanyInvoicesUnauthorizedException
    * @throws \Lenorix\BeelSdk\Generated\Exception\ListCompanyInvoicesForbiddenException
    * @throws \Lenorix\BeelSdk\Generated\Exception\ListCompanyInvoicesUnprocessableEntityException
    * @throws \Lenorix\BeelSdk\Generated\Exception\ListCompanyInvoicesTooManyRequestsException
    * @throws \Lenorix\BeelSdk\Generated\Exception\ListCompanyInvoicesInternalServerErrorException
    *
    * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdInvoicesGetResponse200|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
    */
    public function listCompanyInvoices(string $companyId, array $queryParameters = [], string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\ListCompanyInvoices($companyId, $queryParameters), $fetch);
    }
    /**
    * Creates an invoice for this company. The issuer data comes from the company in the path,
    * and the document is created as a draft unless you ask for it to be issued.
    *
    * - **Issuing:** `options.issue_directly` numbers and issues the invoice in the same call.
    *   Submission to the AEAT is asynchronous, so `verifactu.submission_status` comes back as
    *   `PENDING`: a 2xx means the invoice was accepted for submission, not that the AEAT has
    *   registered it.
    * - **Document type:** `type` chooses the document. A `PROFORMA` is non-fiscal — it is born
    *   `ACTIVE`, numbered `PRO-...` from its own non-fiscal series, and ignores
    *   `issue_directly`.
    * - **Related:** to copy an existing invoice into a new draft, use
    *   `POST …/invoices/derivations`, which carries neither `type`, nor `recipient`, nor
    *   `lines`.
    *
    * @param string $companyId Unique identifier (UUID) of the company the operation acts on — its identifier, not its NIF. It is the only source of context: the account that owns it is derived from it, and the `BeeL-Active-Company` header plays no part. A company you do not reach answers `403`, and so does a company that does not exist, so the existence of a company in another account is never disclosed.
    * @param \Lenorix\BeelSdk\Generated\Model\CreateInvoiceRequest $requestBody
    * @param array{
    *    "wait_for_pdf"?: bool, //Same flag as `options.wait_for_pdf`. Only applies when the invoice is issued in this
    call (`options.issue_directly: true`).
    * } $queryParameters
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
    
    * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
    * @throws \Lenorix\BeelSdk\Generated\Exception\CreateCompanyInvoiceBadRequestException
    * @throws \Lenorix\BeelSdk\Generated\Exception\CreateCompanyInvoiceUnauthorizedException
    * @throws \Lenorix\BeelSdk\Generated\Exception\CreateCompanyInvoiceForbiddenException
    * @throws \Lenorix\BeelSdk\Generated\Exception\CreateCompanyInvoiceConflictException
    * @throws \Lenorix\BeelSdk\Generated\Exception\CreateCompanyInvoiceUnprocessableEntityException
    * @throws \Lenorix\BeelSdk\Generated\Exception\CreateCompanyInvoiceTooManyRequestsException
    * @throws \Lenorix\BeelSdk\Generated\Exception\CreateCompanyInvoiceInternalServerErrorException
    *
    * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdInvoicesPostResponse201|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
    */
    public function createCompanyInvoice(string $companyId, \Lenorix\BeelSdk\Generated\Model\CreateInvoiceRequest $requestBody, array $queryParameters = [], array $headerParameters = [], string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\CreateCompanyInvoice($companyId, $requestBody, $queryParameters, $headerParameters), $fetch);
    }
    /**
    * Creates a draft invoice derived from an existing invoice of this company. The source
    * invoice, named in `from_invoice_id`, is not modified.
    *
    * - **`mode`:** the only value is `DUPLICATE`, which copies the source into a fresh draft. Recipient, lines,
    *   payment method, series and observations are copied; number, status, dates, VeriFactu
    *   data and PDF are reset.
    * - **Series:** the one sent in `series_id`, or the source's when omitted. It is validated
    *   against the type of the copy, which is not always the source's: the copy of a
    *   `CORRECTIVE` is born `STANDARD`. An incompatible series fails with
    *   `422 SERIES_INCOMPATIBLE_DOC_TYPE`.
    *
    * @param string $companyId Unique identifier (UUID) of the company the operation acts on — its identifier, not its NIF. It is the only source of context: the account that owns it is derived from it, and the `BeeL-Active-Company` header plays no part. A company you do not reach answers `403`, and so does a company that does not exist, so the existence of a company in another account is never disclosed.
    * @param \Lenorix\BeelSdk\Generated\Model\CreateInvoiceDerivationRequest $requestBody
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
    
    * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
    * @throws \Lenorix\BeelSdk\Generated\Exception\CreateCompanyInvoiceDerivationBadRequestException
    * @throws \Lenorix\BeelSdk\Generated\Exception\CreateCompanyInvoiceDerivationUnauthorizedException
    * @throws \Lenorix\BeelSdk\Generated\Exception\CreateCompanyInvoiceDerivationForbiddenException
    * @throws \Lenorix\BeelSdk\Generated\Exception\CreateCompanyInvoiceDerivationNotFoundException
    * @throws \Lenorix\BeelSdk\Generated\Exception\CreateCompanyInvoiceDerivationUnprocessableEntityException
    * @throws \Lenorix\BeelSdk\Generated\Exception\CreateCompanyInvoiceDerivationTooManyRequestsException
    * @throws \Lenorix\BeelSdk\Generated\Exception\CreateCompanyInvoiceDerivationInternalServerErrorException
    *
    * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdInvoicesDerivationsPostResponse201|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
    */
    public function createCompanyInvoiceDerivation(string $companyId, \Lenorix\BeelSdk\Generated\Model\CreateInvoiceDerivationRequest $requestBody, array $headerParameters = [], string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\CreateCompanyInvoiceDerivation($companyId, $requestBody, $headerParameters), $fetch);
    }
    /**
    * Applies one operation to a set of invoices of this company and reports, invoice by
    * invoice, which succeeded and which failed.
    *
    * - **Operations:** `ISSUE` issues the draft invoices; `STATUS` moves them to the
    *   `new_status` given in the body.
    * - **Limit:** up to 50 invoices per request (`invoice_ids`).
    * - **Not atomic:** each invoice is processed on its own, and since issuing is
    *   irreversible, the ones already issued stay issued if a later one fails.
    * - **Related:** downloading PDFs, sending email and exporting are not operations of this
    *   batch — use `…/invoices/pdf-archive`, `…/invoices/deliveries` and `…/invoices/exports`.
    *
    * @param string $companyId Unique identifier (UUID) of the company the operation acts on — its identifier, not its NIF. It is the only source of context: the account that owns it is derived from it, and the `BeeL-Active-Company` header plays no part. A company you do not reach answers `403`, and so does a company that does not exist, so the existence of a company in another account is never disclosed.
    * @param \Lenorix\BeelSdk\Generated\Model\CreateInvoiceBatchRequest $requestBody
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
    
    * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
    * @throws \Lenorix\BeelSdk\Generated\Exception\CreateCompanyInvoiceBatchBadRequestException
    * @throws \Lenorix\BeelSdk\Generated\Exception\CreateCompanyInvoiceBatchUnauthorizedException
    * @throws \Lenorix\BeelSdk\Generated\Exception\CreateCompanyInvoiceBatchForbiddenException
    * @throws \Lenorix\BeelSdk\Generated\Exception\CreateCompanyInvoiceBatchUnprocessableEntityException
    * @throws \Lenorix\BeelSdk\Generated\Exception\CreateCompanyInvoiceBatchTooManyRequestsException
    * @throws \Lenorix\BeelSdk\Generated\Exception\CreateCompanyInvoiceBatchInternalServerErrorException
    *
    * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\BulkOperationResponse|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
    */
    public function createCompanyInvoiceBatch(string $companyId, \Lenorix\BeelSdk\Generated\Model\CreateInvoiceBatchRequest $requestBody, array $headerParameters = [], string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\CreateCompanyInvoiceBatch($companyId, $requestBody, $headerParameters), $fetch);
    }
    /**
     * Returns a single ZIP with the PDFs of the invoices of this company named in
     * `invoice_ids`.
     *
     * - **Limit:** up to 500 invoices per request.
     * - **Missing PDFs:** invoices whose PDF is not available are left out of the archive. If
     *   no PDF at all is available the call fails with `400`.
     * - **Counts:** `X-Bulk-Total`, `X-Bulk-Successful` and `X-Bulk-Failed` response headers
     *   report how many PDFs were requested and how many made it into the ZIP.
     *
     * @param string $companyId Unique identifier (UUID) of the company the operation acts on — its identifier, not its NIF. It is the only source of context: the account that owns it is derived from it, and the `BeeL-Active-Company` header plays no part. A company you do not reach answers `403`, and so does a company that does not exist, so the existence of a company in another account is never disclosed.
     * @param \Lenorix\BeelSdk\Generated\Model\CreateInvoicePdfArchiveRequest $requestBody
     * @param array $accept Accept content header application/zip|application/json
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \Lenorix\BeelSdk\Generated\Exception\CreateCompanyInvoicePdfArchiveBadRequestException
     * @throws \Lenorix\BeelSdk\Generated\Exception\CreateCompanyInvoicePdfArchiveUnauthorizedException
     * @throws \Lenorix\BeelSdk\Generated\Exception\CreateCompanyInvoicePdfArchiveForbiddenException
     * @throws \Lenorix\BeelSdk\Generated\Exception\CreateCompanyInvoicePdfArchiveUnprocessableEntityException
     * @throws \Lenorix\BeelSdk\Generated\Exception\CreateCompanyInvoicePdfArchiveTooManyRequestsException
     * @throws \Lenorix\BeelSdk\Generated\Exception\CreateCompanyInvoicePdfArchiveInternalServerErrorException
     *
     * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
     */
    public function createCompanyInvoicePdfArchive(string $companyId, \Lenorix\BeelSdk\Generated\Model\CreateInvoicePdfArchiveRequest $requestBody, string $fetch = self::FETCH_OBJECT, array $accept = [])
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\CreateCompanyInvoicePdfArchive($companyId, $requestBody, $accept), $fetch);
    }
    /**
    * Sends one email carrying the PDFs of several invoices of this company as attachments.
    *
    * - **`recipients`:** required, and must carry at least one address; no
    *   address is inferred from any profile.
    * - **Limit:** up to 200 invoices per message (`invoice_ids`).
    * - **Failures:** invoices whose PDF cannot be attached are reported in `failures`, and the
    *   message is still sent with the rest.
    *
    * @param string $companyId Unique identifier (UUID) of the company the operation acts on — its identifier, not its NIF. It is the only source of context: the account that owns it is derived from it, and the `BeeL-Active-Company` header plays no part. A company you do not reach answers `403`, and so does a company that does not exist, so the existence of a company in another account is never disclosed.
    * @param \Lenorix\BeelSdk\Generated\Model\CreateInvoiceDeliveryRequest $requestBody
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
    
    * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
    * @throws \Lenorix\BeelSdk\Generated\Exception\CreateCompanyInvoiceDeliveryBadRequestException
    * @throws \Lenorix\BeelSdk\Generated\Exception\CreateCompanyInvoiceDeliveryUnauthorizedException
    * @throws \Lenorix\BeelSdk\Generated\Exception\CreateCompanyInvoiceDeliveryForbiddenException
    * @throws \Lenorix\BeelSdk\Generated\Exception\CreateCompanyInvoiceDeliveryUnprocessableEntityException
    * @throws \Lenorix\BeelSdk\Generated\Exception\CreateCompanyInvoiceDeliveryTooManyRequestsException
    * @throws \Lenorix\BeelSdk\Generated\Exception\CreateCompanyInvoiceDeliveryInternalServerErrorException
    *
    * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdInvoicesDeliveriesPostResponse200|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
    */
    public function createCompanyInvoiceDelivery(string $companyId, \Lenorix\BeelSdk\Generated\Model\CreateInvoiceDeliveryRequest $requestBody, array $headerParameters = [], string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\CreateCompanyInvoiceDelivery($companyId, $requestBody, $headerParameters), $fetch);
    }
    /**
     * Produces a spreadsheet with the invoices of this company and returns the file in the
     * response.
     *
     * - **Selection:** the invoices named in `invoice_ids`, or, when that is absent, the ones
     *   matching `filters`. A request with neither is rejected with
     *   `400 EXPORT_SELECTION_REQUIRED`.
     * - **Format:** `SUMMARY` writes one row per invoice with aggregated totals, `ITEMS` one
     *   row per invoice line.
     * - **Limit:** up to 50000 invoices per export. Going over it is rejected with
     *   `422 EXPORT_LIMIT_EXCEEDED` — narrow the date range or split the selection. The
     *   export is never silently truncated.
     *
     * @param string $companyId Unique identifier (UUID) of the company the operation acts on — its identifier, not its NIF. It is the only source of context: the account that owns it is derived from it, and the `BeeL-Active-Company` header plays no part. A company you do not reach answers `403`, and so does a company that does not exist, so the existence of a company in another account is never disclosed.
     * @param \Lenorix\BeelSdk\Generated\Model\CreateInvoiceExportRequest $requestBody
     * @param array $accept Accept content header application/vnd.openxmlformats-officedocument.spreadsheetml.sheet|application/json
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \Lenorix\BeelSdk\Generated\Exception\CreateCompanyInvoiceExportBadRequestException
     * @throws \Lenorix\BeelSdk\Generated\Exception\CreateCompanyInvoiceExportUnauthorizedException
     * @throws \Lenorix\BeelSdk\Generated\Exception\CreateCompanyInvoiceExportForbiddenException
     * @throws \Lenorix\BeelSdk\Generated\Exception\CreateCompanyInvoiceExportUnprocessableEntityException
     * @throws \Lenorix\BeelSdk\Generated\Exception\CreateCompanyInvoiceExportTooManyRequestsException
     * @throws \Lenorix\BeelSdk\Generated\Exception\CreateCompanyInvoiceExportInternalServerErrorException
     *
     * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
     */
    public function createCompanyInvoiceExport(string $companyId, \Lenorix\BeelSdk\Generated\Model\CreateInvoiceExportRequest $requestBody, string $fetch = self::FETCH_OBJECT, array $accept = [])
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\CreateCompanyInvoiceExport($companyId, $requestBody, $accept), $fetch);
    }
    /**
     * Deletes a draft invoice of this company. The record is marked as deleted rather than
     * removed.
     *
     * - **Issued invoices:** never deleted. They are voided with `POST …/{invoice_id}/void`,
     *   which leaves the fiscal trail.
     * - **`source_proforma_id`:** when the draft came from converting a proforma, deleting it
     *   returns that proforma from `CONVERTED` to `ACTIVE`, editable and convertible again.
     *   Voiding or rectifying an issued invoice does not return its proforma; only deleting the
     *   draft does.
     *
     * @param string $companyId Unique identifier (UUID) of the company the operation acts on — its identifier, not its NIF. It is the only source of context: the account that owns it is derived from it, and the `BeeL-Active-Company` header plays no part. A company you do not reach answers `403`, and so does a company that does not exist, so the existence of a company in another account is never disclosed.
     * @param string $invoiceId Invoice ID
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \Lenorix\BeelSdk\Generated\Exception\DeleteCompanyInvoiceBadRequestException
     * @throws \Lenorix\BeelSdk\Generated\Exception\DeleteCompanyInvoiceUnauthorizedException
     * @throws \Lenorix\BeelSdk\Generated\Exception\DeleteCompanyInvoiceForbiddenException
     * @throws \Lenorix\BeelSdk\Generated\Exception\DeleteCompanyInvoiceNotFoundException
     * @throws \Lenorix\BeelSdk\Generated\Exception\DeleteCompanyInvoiceTooManyRequestsException
     * @throws \Lenorix\BeelSdk\Generated\Exception\DeleteCompanyInvoiceInternalServerErrorException
     *
     * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
     */
    public function deleteCompanyInvoice(string $companyId, string $invoiceId, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\DeleteCompanyInvoice($companyId, $invoiceId), $fetch);
    }
    /**
     * Retrieves the full details of an invoice of this company.
     * @param string $companyId Unique identifier (UUID) of the company the operation acts on — its identifier, not its NIF. It is the only source of context: the account that owns it is derived from it, and the `BeeL-Active-Company` header plays no part. A company you do not reach answers `403`, and so does a company that does not exist, so the existence of a company in another account is never disclosed.
     * @param string $invoiceId Invoice ID
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetCompanyInvoiceBadRequestException
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetCompanyInvoiceUnauthorizedException
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetCompanyInvoiceForbiddenException
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetCompanyInvoiceNotFoundException
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetCompanyInvoiceTooManyRequestsException
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetCompanyInvoiceInternalServerErrorException
     *
     * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdInvoicesInvoiceIdGetResponse200|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
     */
    public function getCompanyInvoice(string $companyId, string $invoiceId, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\GetCompanyInvoice($companyId, $invoiceId), $fetch);
    }
    /**
    * Updates only the fields present in the body, leaving every other field of the invoice as
    * it is.
    *
    * - **Status:** only a draft invoice can be modified. An issued one is amended with a
    *   corrective invoice (`POST …/{invoice_id}/corrective`) or voided.
    * - **Series:** changing `series_id` never moves the invoice to another NIF — a series of
    *   another company is not visible from here.
    *
    * @param string $companyId Unique identifier (UUID) of the company the operation acts on — its identifier, not its NIF. It is the only source of context: the account that owns it is derived from it, and the `BeeL-Active-Company` header plays no part. A company you do not reach answers `403`, and so does a company that does not exist, so the existence of a company in another account is never disclosed.
    * @param string $invoiceId Invoice ID
    * @param \Lenorix\BeelSdk\Generated\Model\UpdateInvoiceRequest $requestBody
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
    
    * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
    * @throws \Lenorix\BeelSdk\Generated\Exception\PatchCompanyInvoiceBadRequestException
    * @throws \Lenorix\BeelSdk\Generated\Exception\PatchCompanyInvoiceUnauthorizedException
    * @throws \Lenorix\BeelSdk\Generated\Exception\PatchCompanyInvoiceForbiddenException
    * @throws \Lenorix\BeelSdk\Generated\Exception\PatchCompanyInvoiceNotFoundException
    * @throws \Lenorix\BeelSdk\Generated\Exception\PatchCompanyInvoiceConflictException
    * @throws \Lenorix\BeelSdk\Generated\Exception\PatchCompanyInvoiceUnprocessableEntityException
    * @throws \Lenorix\BeelSdk\Generated\Exception\PatchCompanyInvoiceTooManyRequestsException
    * @throws \Lenorix\BeelSdk\Generated\Exception\PatchCompanyInvoiceInternalServerErrorException
    *
    * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdInvoicesInvoiceIdPatchResponse200|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
    */
    public function patchCompanyInvoice(string $companyId, string $invoiceId, \Lenorix\BeelSdk\Generated\Model\UpdateInvoiceRequest $requestBody, array $headerParameters = [], string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\PatchCompanyInvoice($companyId, $invoiceId, $requestBody, $headerParameters), $fetch);
    }
    /**
    * Returns a temporary pre-signed URL to download the invoice PDF.
    *
    * - **URL:** expires in five minutes and only allows `GET`.
    * - **Waiting:** a PDF is produced asynchronously, so this request **waits** for it (up to
    *   ten seconds) instead of handing you a polling loop to write. Bound the wait with
    *   `Prefer: wait=N`, or opt out with `Prefer: wait=0`.
    * - **`202`:** only when the wait elapsed with the PDF still in flight. No body is returned;
    *   ask again after `Retry-After`.
    * - **Drafts:** a draft has no fiscal PDF and answers `400 INVOICE_NOT_ISSUED_NO_PDF`
    *   immediately — that one never waits. Issue it, or render it with
    *   `GET …/{invoice_id}/pdf/preview`.
    *
    * @param string $companyId Unique identifier (UUID) of the company the operation acts on — its identifier, not its NIF. It is the only source of context: the account that owns it is derived from it, and the `BeeL-Active-Company` header plays no part. A company you do not reach answers `403`, and so does a company that does not exist, so the existence of a company in another account is never disclosed.
    * @param string $invoiceId Invoice ID
    * @param array{
    *    "Prefer"?: string, //RFC 7240 preference bounding how long this request may wait for a PDF that is still
    being generated: `Prefer: wait=N`, with `N` in seconds.
    
    By default the request waits (up to the server cap) and answers `200` with the URL, so
    the `202` is the exception rather than the normal path. Use `Prefer: wait=0` to opt out
    and get the old poll-only behaviour: an immediate `202` while the PDF is in flight.
    
    A value above the cap is lowered to it, and the `202` then echoes what was actually
    applied in `Preference-Applied: wait=<seconds>` — so you never have to discover the cap
    by trial and error. A value that is not a non-negative integer is ignored altogether
    (RFC 7240: a preference that is not understood is not an error), and the request falls
    back to the default wait with no `Preference-Applied` header.
    * } $headerParameters
    
    * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
    * @throws \Lenorix\BeelSdk\Generated\Exception\GetCompanyInvoicePdfBadRequestException
    * @throws \Lenorix\BeelSdk\Generated\Exception\GetCompanyInvoicePdfUnauthorizedException
    * @throws \Lenorix\BeelSdk\Generated\Exception\GetCompanyInvoicePdfForbiddenException
    * @throws \Lenorix\BeelSdk\Generated\Exception\GetCompanyInvoicePdfNotFoundException
    * @throws \Lenorix\BeelSdk\Generated\Exception\GetCompanyInvoicePdfTooManyRequestsException
    * @throws \Lenorix\BeelSdk\Generated\Exception\GetCompanyInvoicePdfInternalServerErrorException
    *
    * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\InvoicePdfResponse|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
    */
    public function getCompanyInvoicePdf(string $companyId, string $invoiceId, array $headerParameters = [], string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\GetCompanyInvoicePdf($companyId, $invoiceId, $headerParameters), $fetch);
    }
    /**
     * Returns a temporary pre-signed URL to a preview image (WebP) of the invoice, suitable for
     * inline rendering. The image is generated and cached on first request, so a later call
     * returns the cached image. The URL expires in five minutes and only allows `GET`.
     *
     * @param string $companyId Unique identifier (UUID) of the company the operation acts on — its identifier, not its NIF. It is the only source of context: the account that owns it is derived from it, and the `BeeL-Active-Company` header plays no part. A company you do not reach answers `403`, and so does a company that does not exist, so the existence of a company in another account is never disclosed.
     * @param string $invoiceId Invoice ID
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetCompanyInvoicePreviewUnauthorizedException
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetCompanyInvoicePreviewForbiddenException
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetCompanyInvoicePreviewNotFoundException
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetCompanyInvoicePreviewTooManyRequestsException
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetCompanyInvoicePreviewInternalServerErrorException
     *
     * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\InvoicePreviewResponse|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
     */
    public function getCompanyInvoicePreview(string $companyId, string $invoiceId, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\GetCompanyInvoicePreview($companyId, $invoiceId), $fetch);
    }
    /**
     * Renders the PDF of a draft invoice on the fly, without storing it and without consuming
     * numbering, so each call reflects the latest changes. The response is `application/pdf`.
     *
     * - **Document:** shows `BORRADOR` in place of the invoice number and carries no VeriFactu
     *   QR code. The issuer block is taken from the company in the path.
     * - **Drafts only:** an invoice that is not a draft answers `400` — it has a stored PDF,
     *   available at `GET …/{invoice_id}/pdf`.
     *
     * @param string $companyId Unique identifier (UUID) of the company the operation acts on — its identifier, not its NIF. It is the only source of context: the account that owns it is derived from it, and the `BeeL-Active-Company` header plays no part. A company you do not reach answers `403`, and so does a company that does not exist, so the existence of a company in another account is never disclosed.
     * @param string $invoiceId Invoice ID
     * @param array $accept Accept content header application/pdf|application/json
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \Lenorix\BeelSdk\Generated\Exception\PreviewCompanyInvoicePdfBadRequestException
     * @throws \Lenorix\BeelSdk\Generated\Exception\PreviewCompanyInvoicePdfUnauthorizedException
     * @throws \Lenorix\BeelSdk\Generated\Exception\PreviewCompanyInvoicePdfForbiddenException
     * @throws \Lenorix\BeelSdk\Generated\Exception\PreviewCompanyInvoicePdfNotFoundException
     * @throws \Lenorix\BeelSdk\Generated\Exception\PreviewCompanyInvoicePdfTooManyRequestsException
     * @throws \Lenorix\BeelSdk\Generated\Exception\PreviewCompanyInvoicePdfInternalServerErrorException
     *
     * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
     */
    public function previewCompanyInvoicePdf(string $companyId, string $invoiceId, string $fetch = self::FETCH_OBJECT, array $accept = [])
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\PreviewCompanyInvoicePdf($companyId, $invoiceId, $accept), $fetch);
    }
    /**
    * Sends the invoice by email, attaching its PDF by default. When no recipient is given, the
    * addresses configured on the customer are used.
    *
    * @param string $companyId Unique identifier (UUID) of the company the operation acts on — its identifier, not its NIF. It is the only source of context: the account that owns it is derived from it, and the `BeeL-Active-Company` header plays no part. A company you do not reach answers `403`, and so does a company that does not exist, so the existence of a company in another account is never disclosed.
    * @param string $invoiceId Invoice ID
    * @param null|\Lenorix\BeelSdk\Generated\Model\SendEmailRequest $requestBody
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
    
    * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
    * @throws \Lenorix\BeelSdk\Generated\Exception\SendCompanyInvoiceBadRequestException
    * @throws \Lenorix\BeelSdk\Generated\Exception\SendCompanyInvoiceUnauthorizedException
    * @throws \Lenorix\BeelSdk\Generated\Exception\SendCompanyInvoiceForbiddenException
    * @throws \Lenorix\BeelSdk\Generated\Exception\SendCompanyInvoiceNotFoundException
    * @throws \Lenorix\BeelSdk\Generated\Exception\SendCompanyInvoiceTooManyRequestsException
    * @throws \Lenorix\BeelSdk\Generated\Exception\SendCompanyInvoiceInternalServerErrorException
    *
    * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdInvoicesInvoiceIdSendPostResponse200|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
    */
    public function sendCompanyInvoice(string $companyId, string $invoiceId, ?\Lenorix\BeelSdk\Generated\Model\SendEmailRequest $requestBody = null, array $headerParameters = [], string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\SendCompanyInvoice($companyId, $invoiceId, $requestBody, $headerParameters), $fetch);
    }
    /**
    * Finalizes a draft invoice of this company: assigns its definitive number from the
    * configured series and makes it immutable.
    *
    * - **Irreversible:** an issued invoice is corrected with a corrective invoice
    *   (`POST …/{invoice_id}/corrective`) or voided (`POST …/{invoice_id}/void`), never edited.
    * - **Asynchronous:** PDF generation and submission to the AEAT happen after the response,
    *   so a `200` means the invoice was accepted for submission, not that the AEAT has
    *   registered it. Use `wait_for_pdf` to wait for the PDF.
    *
    * @param string $companyId Unique identifier (UUID) of the company the operation acts on — its identifier, not its NIF. It is the only source of context: the account that owns it is derived from it, and the `BeeL-Active-Company` header plays no part. A company you do not reach answers `403`, and so does a company that does not exist, so the existence of a company in another account is never disclosed.
    * @param string $invoiceId Invoice ID
    * @param array{
    *    "wait_for_pdf"?: bool, //If `true`, waits for PDF generation and returns the URL in the response. Adds ~1-2s of
    latency but guarantees the PDF is immediately available.
    *    "attach_source_invoices"?: bool, //Only applies when the invoice has automatic email sending enabled. If `true`, the
    email sent after issuing also attaches a ZIP (`suplidos_<invoice-number>.zip`) with
    the PDFs of the source invoices referenced by the invoice's SUPLIDO consolidation
    lines. Access to sources owned by managed accounts is re-checked with the same rules
    as issuing, and the request fails synchronously with an actionable error — never a
    partial ZIP — if the invoice has no consolidation sources
    (`ATTACH_SOURCE_INVOICES_NO_SOURCES`), a source is not reachable
    (`ATTACH_SOURCE_INVOICE_UNAVAILABLE`) or a source has no generated PDF
    (`ATTACH_SOURCE_PDF_MISSING`).
    * } $queryParameters
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
    
    * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
    * @throws \Lenorix\BeelSdk\Generated\Exception\IssueCompanyInvoiceBadRequestException
    * @throws \Lenorix\BeelSdk\Generated\Exception\IssueCompanyInvoiceUnauthorizedException
    * @throws \Lenorix\BeelSdk\Generated\Exception\IssueCompanyInvoiceForbiddenException
    * @throws \Lenorix\BeelSdk\Generated\Exception\IssueCompanyInvoiceNotFoundException
    * @throws \Lenorix\BeelSdk\Generated\Exception\IssueCompanyInvoiceConflictException
    * @throws \Lenorix\BeelSdk\Generated\Exception\IssueCompanyInvoiceUnprocessableEntityException
    * @throws \Lenorix\BeelSdk\Generated\Exception\IssueCompanyInvoiceTooManyRequestsException
    * @throws \Lenorix\BeelSdk\Generated\Exception\IssueCompanyInvoiceInternalServerErrorException
    *
    * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdInvoicesInvoiceIdIssuePostResponse200|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
    */
    public function issueCompanyInvoice(string $companyId, string $invoiceId, array $queryParameters = [], array $headerParameters = [], string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\IssueCompanyInvoice($companyId, $invoiceId, $queryParameters, $headerParameters), $fetch);
    }
    /**
    * Voids an issued invoice of this company. The document is kept and its number is never
    * reused.
    *
    * - **When to use it:** the operation never took place. If it did take place but with
    *   errors, issue a corrective invoice instead
    *   (`POST …/{invoice_id}/corrective`).
    * - **`reason`:** required, at least 10 characters — it is fiscal data.
    * - **VeriFactu:** when it is enabled for the invoice, a cancellation record is submitted
    *   to the AEAT.
    * - **Proformas:** voiding an `ACTIVE` proforma is a plain status change with no fiscal
    *   effect — no corrective invoice, nothing submitted to the AEAT. The voided proforma is
    *   kept as the record of a rejected or withdrawn offer and stays listed.
    *
    * @param string $companyId Unique identifier (UUID) of the company the operation acts on — its identifier, not its NIF. It is the only source of context: the account that owns it is derived from it, and the `BeeL-Active-Company` header plays no part. A company you do not reach answers `403`, and so does a company that does not exist, so the existence of a company in another account is never disclosed.
    * @param string $invoiceId Invoice ID
    * @param \Lenorix\BeelSdk\Generated\Model\VoidInvoiceRequest $requestBody
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
    
    * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
    * @throws \Lenorix\BeelSdk\Generated\Exception\VoidCompanyInvoiceBadRequestException
    * @throws \Lenorix\BeelSdk\Generated\Exception\VoidCompanyInvoiceUnauthorizedException
    * @throws \Lenorix\BeelSdk\Generated\Exception\VoidCompanyInvoiceForbiddenException
    * @throws \Lenorix\BeelSdk\Generated\Exception\VoidCompanyInvoiceNotFoundException
    * @throws \Lenorix\BeelSdk\Generated\Exception\VoidCompanyInvoiceConflictException
    * @throws \Lenorix\BeelSdk\Generated\Exception\VoidCompanyInvoiceUnprocessableEntityException
    * @throws \Lenorix\BeelSdk\Generated\Exception\VoidCompanyInvoiceTooManyRequestsException
    * @throws \Lenorix\BeelSdk\Generated\Exception\VoidCompanyInvoiceInternalServerErrorException
    *
    * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdInvoicesInvoiceIdVoidPostResponse200|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
    */
    public function voidCompanyInvoice(string $companyId, string $invoiceId, \Lenorix\BeelSdk\Generated\Model\VoidInvoiceRequest $requestBody, array $headerParameters = [], string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\VoidCompanyInvoice($companyId, $invoiceId, $requestBody, $headerParameters), $fetch);
    }
    /**
    * Issues a corrective invoice that amends the invoice in the path. It is a new fiscal
    * document with its own number, not an edit of the original.
    *
    * - **`rectification_type`:** `TOTAL` leaves the original `VOIDED` and copies its lines
    *   negated when `lines` is omitted. `PARTIAL` leaves the original `RECTIFIED` and requires
    *   the adjustment `lines`.
    * - **What can be rectified:** an ordinary or simplified invoice in `ISSUED`, `SENT`,
    *   `PAID`, `OVERDUE` or `RECTIFIED`. Rectifying a corrective fails with
    *   `422 CORRECTIVE_NOT_RECTIFIABLE` — to fix an erroneous corrective, issue another one
    *   against the original invoice.
    * - **Repeat rectifications:** several `PARTIAL` correctives are allowed, but a `VOIDED`
    *   invoice is no longer rectifiable, so a second `TOTAL` against the same invoice fails
    *   with `422 INVOICE_NOT_CORRECTIBLE_IN_CURRENT_STATUS`.
    * - **Fiscal inheritance on a `PARTIAL`:** a line that omits `irpf_rate` or
    *   `equivalence_surcharge_rate` takes it from the **original invoice** — the document
    *   being amended — and never from the company's current tax profile, so a profile that
    *   changed after the original was issued does not leak into the credit note. An explicit
    *   value always wins, `0` included. The surcharge inherits the *regime* (on/off), not the
    *   rate: the rate is re-derived from each corrective line's own VAT (21→5.2, 10→1.4,
    *   5→0.625, 4→0.5), and an original outside the regime pins the line to `0`. `SUPLIDO`
    *   lines are out of it on both sides. When the original is not unambiguous BeeL does not
    *   pick for you: different IRPF rates per line fail with
    *   `422 CORRECTIVE_ORIGINAL_MIXED_IRPF`, and a surcharge applied on some lines but not
    *   others fails with `422 CORRECTIVE_ORIGINAL_MIXED_SURCHARGE`. Declare the figure on every
    *   line to get past either — both only fire when some line actually needs to inherit.
    * - **`series_id`:** when omitted, the document is numbered in the company's default
    *   corrective series, never in the series of the original. That default is never created
    *   for you: if the company has none the request fails with
    *   `422 SERIES_DEFAULT_NOT_FOUND`, and
    *   `GET /v1/configuration/series/defaults-status` reports which default is missing.
    *
    * @param string $companyId Unique identifier (UUID) of the company the operation acts on — its identifier, not its NIF. It is the only source of context: the account that owns it is derived from it, and the `BeeL-Active-Company` header plays no part. A company you do not reach answers `403`, and so does a company that does not exist, so the existence of a company in another account is never disclosed.
    * @param string $invoiceId Invoice ID
    * @param \Lenorix\BeelSdk\Generated\Model\CreateCorrectiveInvoiceRequest $requestBody
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
    
    * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
    * @throws \Lenorix\BeelSdk\Generated\Exception\CreateCompanyCorrectiveInvoiceBadRequestException
    * @throws \Lenorix\BeelSdk\Generated\Exception\CreateCompanyCorrectiveInvoiceUnauthorizedException
    * @throws \Lenorix\BeelSdk\Generated\Exception\CreateCompanyCorrectiveInvoiceForbiddenException
    * @throws \Lenorix\BeelSdk\Generated\Exception\CreateCompanyCorrectiveInvoiceNotFoundException
    * @throws \Lenorix\BeelSdk\Generated\Exception\CreateCompanyCorrectiveInvoiceConflictException
    * @throws \Lenorix\BeelSdk\Generated\Exception\CreateCompanyCorrectiveInvoiceUnprocessableEntityException
    * @throws \Lenorix\BeelSdk\Generated\Exception\CreateCompanyCorrectiveInvoiceTooManyRequestsException
    * @throws \Lenorix\BeelSdk\Generated\Exception\CreateCompanyCorrectiveInvoiceInternalServerErrorException
    *
    * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdInvoicesInvoiceIdCorrectivePostResponse201|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
    */
    public function createCompanyCorrectiveInvoice(string $companyId, string $invoiceId, \Lenorix\BeelSdk\Generated\Model\CreateCorrectiveInvoiceRequest $requestBody, array $headerParameters = [], string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\CreateCompanyCorrectiveInvoice($companyId, $invoiceId, $requestBody, $headerParameters), $fetch);
    }
    /**
    * Converts an accepted proforma of this company into a real invoice. The new invoice is
    * created as a `STANDARD` draft linked back through `source_proforma_id`.
    *
    * - **What converts:** only proformas in status `ACTIVE`. One shown as `EXPIRED` is still
    *   `ACTIVE` underneath and converts too.
    * - **The proforma:** preserved as the record of what the customer accepted — it keeps its
    *   `PRO-...` number and PDF and moves to the terminal status `CONVERTED`.
    * - **`issue`:** with `true` the new invoice is numbered and issued in the same atomic
    *   call. If issuing fails nothing is created and the proforma stays `ACTIVE`.
    * - **Errors:** `422 CONVERSION_REQUIRES_PROFORMA` when the document is not a proforma,
    *   `422 PROFORMA_NOT_CONVERTIBLE` when it is not `ACTIVE`, and
    *   `409 PROFORMA_ALREADY_CONVERTED` when it has already been converted — a second call
    *   never creates a second invoice.
    *
    * @param string $companyId Unique identifier (UUID) of the company the operation acts on — its identifier, not its NIF. It is the only source of context: the account that owns it is derived from it, and the `BeeL-Active-Company` header plays no part. A company you do not reach answers `403`, and so does a company that does not exist, so the existence of a company in another account is never disclosed.
    * @param string $invoiceId Invoice ID
    * @param null|\Lenorix\BeelSdk\Generated\Model\ConvertProformaToInvoiceRequest $requestBody
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
    
    * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
    * @throws \Lenorix\BeelSdk\Generated\Exception\ConvertCompanyProformaToInvoiceBadRequestException
    * @throws \Lenorix\BeelSdk\Generated\Exception\ConvertCompanyProformaToInvoiceUnauthorizedException
    * @throws \Lenorix\BeelSdk\Generated\Exception\ConvertCompanyProformaToInvoiceForbiddenException
    * @throws \Lenorix\BeelSdk\Generated\Exception\ConvertCompanyProformaToInvoiceNotFoundException
    * @throws \Lenorix\BeelSdk\Generated\Exception\ConvertCompanyProformaToInvoiceConflictException
    * @throws \Lenorix\BeelSdk\Generated\Exception\ConvertCompanyProformaToInvoiceUnprocessableEntityException
    * @throws \Lenorix\BeelSdk\Generated\Exception\ConvertCompanyProformaToInvoiceTooManyRequestsException
    * @throws \Lenorix\BeelSdk\Generated\Exception\ConvertCompanyProformaToInvoiceInternalServerErrorException
    *
    * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdInvoicesInvoiceIdConvertToInvoicePostResponse201|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
    */
    public function convertCompanyProformaToInvoice(string $companyId, string $invoiceId, ?\Lenorix\BeelSdk\Generated\Model\ConvertProformaToInvoiceRequest $requestBody = null, array $headerParameters = [], string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\ConvertCompanyProformaToInvoice($companyId, $invoiceId, $requestBody, $headerParameters), $fetch);
    }
    /**
    * Sets the commercial status of an invoice. Any transition other than the ones below is
    * rejected.
    *
    * - **`PAID`:** from `ISSUED`, `SENT` or `OVERDUE`.
    * - **`SENT`:** from `ISSUED`.
    * - **`ISSUED`:** from `SENT` only, to undo a `SENT` set by mistake.
    * - **Not set here:** issuing and voiding are fiscal acts with their own operations
    *   (`POST …/{invoice_id}/issue`, `POST …/{invoice_id}/void`), and issuing is never undone.
    *
    * @param string $companyId Unique identifier (UUID) of the company the operation acts on — its identifier, not its NIF. It is the only source of context: the account that owns it is derived from it, and the `BeeL-Active-Company` header plays no part. A company you do not reach answers `403`, and so does a company that does not exist, so the existence of a company in another account is never disclosed.
    * @param string $invoiceId Invoice ID
    * @param \Lenorix\BeelSdk\Generated\Model\SetInvoiceStatusRequest $requestBody
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
    
    * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
    * @throws \Lenorix\BeelSdk\Generated\Exception\SetCompanyInvoiceStatusBadRequestException
    * @throws \Lenorix\BeelSdk\Generated\Exception\SetCompanyInvoiceStatusUnauthorizedException
    * @throws \Lenorix\BeelSdk\Generated\Exception\SetCompanyInvoiceStatusForbiddenException
    * @throws \Lenorix\BeelSdk\Generated\Exception\SetCompanyInvoiceStatusNotFoundException
    * @throws \Lenorix\BeelSdk\Generated\Exception\SetCompanyInvoiceStatusUnprocessableEntityException
    * @throws \Lenorix\BeelSdk\Generated\Exception\SetCompanyInvoiceStatusTooManyRequestsException
    * @throws \Lenorix\BeelSdk\Generated\Exception\SetCompanyInvoiceStatusInternalServerErrorException
    *
    * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdInvoicesInvoiceIdStatusPutResponse200|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
    */
    public function setCompanyInvoiceStatus(string $companyId, string $invoiceId, \Lenorix\BeelSdk\Generated\Model\SetInvoiceStatusRequest $requestBody, array $headerParameters = [], string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\SetCompanyInvoiceStatus($companyId, $invoiceId, $requestBody, $headerParameters), $fetch);
    }
    /**
    * Removes the scheduling of an invoice, returning it to a plain draft. Idempotent: an invoice
    * that is not scheduled answers `204` all the same. Unlike the `PUT`, it does not require the
    * `scheduled_invoices` feature.
    *
    * @param string $companyId Unique identifier (UUID) of the company the operation acts on — its identifier, not its NIF. It is the only source of context: the account that owns it is derived from it, and the `BeeL-Active-Company` header plays no part. A company you do not reach answers `403`, and so does a company that does not exist, so the existence of a company in another account is never disclosed.
    * @param string $invoiceId Invoice ID
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
    
    * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
    * @throws \Lenorix\BeelSdk\Generated\Exception\DeleteCompanyInvoiceScheduleBadRequestException
    * @throws \Lenorix\BeelSdk\Generated\Exception\DeleteCompanyInvoiceScheduleUnauthorizedException
    * @throws \Lenorix\BeelSdk\Generated\Exception\DeleteCompanyInvoiceScheduleForbiddenException
    * @throws \Lenorix\BeelSdk\Generated\Exception\DeleteCompanyInvoiceScheduleNotFoundException
    * @throws \Lenorix\BeelSdk\Generated\Exception\DeleteCompanyInvoiceScheduleTooManyRequestsException
    * @throws \Lenorix\BeelSdk\Generated\Exception\DeleteCompanyInvoiceScheduleInternalServerErrorException
    *
    * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
    */
    public function deleteCompanyInvoiceSchedule(string $companyId, string $invoiceId, array $headerParameters = [], string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\DeleteCompanyInvoiceSchedule($companyId, $invoiceId, $headerParameters), $fetch);
    }
    /**
     * Returns the date and generation mode currently scheduled for this invoice. An invoice with
     * no scheduling answers `404`, since the sub-resource does not exist yet. To move only the
     * date, read the current `generation_mode` here and send it back on the `PUT`.
     *
     * @param string $companyId Unique identifier (UUID) of the company the operation acts on — its identifier, not its NIF. It is the only source of context: the account that owns it is derived from it, and the `BeeL-Active-Company` header plays no part. A company you do not reach answers `403`, and so does a company that does not exist, so the existence of a company in another account is never disclosed.
     * @param string $invoiceId Invoice ID
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetCompanyInvoiceScheduleUnauthorizedException
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetCompanyInvoiceScheduleForbiddenException
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetCompanyInvoiceScheduleNotFoundException
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetCompanyInvoiceScheduleTooManyRequestsException
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetCompanyInvoiceScheduleInternalServerErrorException
     *
     * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\InvoiceScheduleResponse|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
     */
    public function getCompanyInvoiceSchedule(string $companyId, string $invoiceId, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\GetCompanyInvoiceSchedule($companyId, $invoiceId), $fetch);
    }
    /**
    * Replaces the scheduling of a draft invoice, whether it had one or not, moving it to
    * `SCHEDULED`. Both fields of the body are required.
    *
    * - **`scheduled_for`:** the date the invoice is processed on. Today or later; an earlier
    *   date is rejected with `422 SCHEDULED_DATE_IN_PAST`.
    * - **`generation_mode`:** `DRAFT` leaves the invoice as a draft for manual review,
    *   `ISSUE_AND_SEND` issues and sends it automatically. There is no default.
    * - **Availability:** requires the `scheduled_invoices` feature.
    *
    * @param string $companyId Unique identifier (UUID) of the company the operation acts on — its identifier, not its NIF. It is the only source of context: the account that owns it is derived from it, and the `BeeL-Active-Company` header plays no part. A company you do not reach answers `403`, and so does a company that does not exist, so the existence of a company in another account is never disclosed.
    * @param string $invoiceId Invoice ID
    * @param \Lenorix\BeelSdk\Generated\Model\SetInvoiceScheduleRequest $requestBody
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
    
    * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
    * @throws \Lenorix\BeelSdk\Generated\Exception\SetCompanyInvoiceScheduleBadRequestException
    * @throws \Lenorix\BeelSdk\Generated\Exception\SetCompanyInvoiceScheduleUnauthorizedException
    * @throws \Lenorix\BeelSdk\Generated\Exception\SetCompanyInvoiceScheduleForbiddenException
    * @throws \Lenorix\BeelSdk\Generated\Exception\SetCompanyInvoiceScheduleNotFoundException
    * @throws \Lenorix\BeelSdk\Generated\Exception\SetCompanyInvoiceScheduleConflictException
    * @throws \Lenorix\BeelSdk\Generated\Exception\SetCompanyInvoiceScheduleUnprocessableEntityException
    * @throws \Lenorix\BeelSdk\Generated\Exception\SetCompanyInvoiceScheduleTooManyRequestsException
    * @throws \Lenorix\BeelSdk\Generated\Exception\SetCompanyInvoiceScheduleInternalServerErrorException
    *
    * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdInvoicesInvoiceIdSchedulePutResponse200|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
    */
    public function setCompanyInvoiceSchedule(string $companyId, string $invoiceId, \Lenorix\BeelSdk\Generated\Model\SetInvoiceScheduleRequest $requestBody, array $headerParameters = [], string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\SetCompanyInvoiceSchedule($companyId, $invoiceId, $requestBody, $headerParameters), $fetch);
    }
    /**
    * **Deprecated.** Use `GET /v1/companies/{company_id}/recurring-invoices`, which returns the
    * same list with the same filters.
    *
    * Lists the recurring invoice templates of the authenticated user, with filters and
    * pagination.
    *
    * - **Filters:** `status` and `customer_id`, plus `page` and `limit` for pagination.
    * - **Sorting:** `sort_by` and `sort_order`. The legacy aliases `sortBy`/`sortOrder` are
    *   still honoured here but are not carried over to the canonical route.
    *
    * **Retires on 9 December 2026.** See the [migration guide](https://docs.beel.es/changelog/resources-under-the-nif) for what moved where and what changes when you switch.
    *
    * @param array{
    *    "status"?: string,
    *    "customer_id"?: string,
    *    "page"?: int, //Page number, starting at 1. The response echoes it back as `pagination.current_page`.
    *    "limit"?: int, //How many items to return per page. The response echoes it back as `pagination.items_per_page`.
    *    "sort_by"?: string, //Field to sort by. Defaults to `created_at` when omitted.
    
    This parameter was previously named `sortBy`. The old name is still accepted for
    backwards compatibility (see `sortBy` below) and will be withdrawn in a future major
    version — send `sort_by`.
    *    "sortBy"?: string, //**Deprecated** — former name of `sort_by`, still honoured so existing integrations keep
    working. Ignored when `sort_by` is also present. Use `sort_by`.
    *    "sort_order"?: string, //Sort direction. Defaults to `desc` when omitted.
    
    This parameter was previously named `sortOrder`. The old name is still accepted for
    backwards compatibility (see `sortOrder` below) and will be withdrawn in a future major
    version — send `sort_order`.
    *    "sortOrder"?: string, //**Deprecated** — former name of `sort_order`, still honoured so existing integrations
    keep working. Ignored when `sort_order` is also present. Use `sort_order`.
    * } $queryParameters
    
    * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
    * @throws \Lenorix\BeelSdk\Generated\Exception\ListRecurringInvoicesUnauthorizedException
    * @throws \Lenorix\BeelSdk\Generated\Exception\ListRecurringInvoicesForbiddenException
    *
    * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\V1RecurringInvoicesGetResponse200|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
    */
    public function listRecurringInvoices(array $queryParameters = [], string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\ListRecurringInvoices($queryParameters), $fetch);
    }
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
    
    * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
    * @throws \Lenorix\BeelSdk\Generated\Exception\CreateRecurringInvoiceBadRequestException
    * @throws \Lenorix\BeelSdk\Generated\Exception\CreateRecurringInvoiceForbiddenException
    * @throws \Lenorix\BeelSdk\Generated\Exception\CreateRecurringInvoiceUnprocessableEntityException
    *
    * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\V1RecurringInvoicesPostResponse201|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
    */
    public function createRecurringInvoice(\Lenorix\BeelSdk\Generated\Model\CreateRecurringInvoiceRequest $requestBody, array $headerParameters = [], string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\CreateRecurringInvoice($requestBody, $headerParameters), $fetch);
    }
    /**
     * **Deprecated.** Use `DELETE /v1/companies/{company_id}/recurring-invoices/{recurring_invoice_id}`, which behaves identically.
     *
     * Permanently deletes a recurring invoice template and cancels any pending scheduled
     * generations. Invoices already generated from it are not affected.
     *
     * **Retires on 9 December 2026.** See the [migration guide](https://docs.beel.es/changelog/resources-under-the-nif) for what moved where and what changes when you switch.
     *
     * @param string $recurringInvoiceId
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \Lenorix\BeelSdk\Generated\Exception\DeleteRecurringInvoiceForbiddenException
     * @throws \Lenorix\BeelSdk\Generated\Exception\DeleteRecurringInvoiceNotFoundException
     *
     * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
     */
    public function deleteRecurringInvoice(string $recurringInvoiceId, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\DeleteRecurringInvoice($recurringInvoiceId), $fetch);
    }
    /**
     * **Deprecated.** Use `GET /v1/companies/{company_id}/recurring-invoices/{recurring_invoice_id}`, which behaves identically.
     *
     * Retrieves the full details of a recurring invoice template, including its schedule,
     * template lines and next generation date.
     *
     * **Retires on 9 December 2026.** See the [migration guide](https://docs.beel.es/changelog/resources-under-the-nif) for what moved where and what changes when you switch.
     *
     * @param string $recurringInvoiceId
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetRecurringInvoiceForbiddenException
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetRecurringInvoiceNotFoundException
     *
     * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\V1RecurringInvoicesRecurringInvoiceIdGetResponse200|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
     */
    public function getRecurringInvoice(string $recurringInvoiceId, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\GetRecurringInvoice($recurringInvoiceId), $fetch);
    }
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
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \Lenorix\BeelSdk\Generated\Exception\PatchRecurringInvoiceBadRequestException
     * @throws \Lenorix\BeelSdk\Generated\Exception\PatchRecurringInvoiceForbiddenException
     * @throws \Lenorix\BeelSdk\Generated\Exception\PatchRecurringInvoiceNotFoundException
     * @throws \Lenorix\BeelSdk\Generated\Exception\PatchRecurringInvoiceConflictException
     * @throws \Lenorix\BeelSdk\Generated\Exception\PatchRecurringInvoiceUnprocessableEntityException
     *
     * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\V1RecurringInvoicesRecurringInvoiceIdPatchResponse200|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
     */
    public function patchRecurringInvoice(string $recurringInvoiceId, \Lenorix\BeelSdk\Generated\Model\PatchRecurringInvoiceRequest $requestBody, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\PatchRecurringInvoice($recurringInvoiceId, $requestBody), $fetch);
    }
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
     *
     * @param string $recurringInvoiceId
     * @param \Lenorix\BeelSdk\Generated\Model\UpdateRecurringInvoiceRequest $requestBody
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \Lenorix\BeelSdk\Generated\Exception\UpdateRecurringInvoiceForbiddenException
     * @throws \Lenorix\BeelSdk\Generated\Exception\UpdateRecurringInvoiceNotFoundException
     * @throws \Lenorix\BeelSdk\Generated\Exception\UpdateRecurringInvoiceConflictException
     * @throws \Lenorix\BeelSdk\Generated\Exception\UpdateRecurringInvoiceUnprocessableEntityException
     *
     * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\V1RecurringInvoicesRecurringInvoiceIdPutResponse200|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
     */
    public function updateRecurringInvoice(string $recurringInvoiceId, \Lenorix\BeelSdk\Generated\Model\UpdateRecurringInvoiceRequest $requestBody, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\UpdateRecurringInvoice($recurringInvoiceId, $requestBody), $fetch);
    }
    /**
    * **Deprecated.** Use `PUT /v1/companies/{company_id}/recurring-invoices/{recurring_invoice_id}/status` with `{"status": "PAUSED"}`, which behaves identically.
    *
    * Stops automatic generation, keeping the schedule configuration intact.
    *
    * **Retires on 9 December 2026.** See the [migration guide](https://docs.beel.es/changelog/resources-under-the-nif) for what moved where and what changes when you switch.
    *
    * @param string $recurringInvoiceId
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
    
    * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
    * @throws \Lenorix\BeelSdk\Generated\Exception\PauseRecurringInvoiceBadRequestException
    * @throws \Lenorix\BeelSdk\Generated\Exception\PauseRecurringInvoiceForbiddenException
    * @throws \Lenorix\BeelSdk\Generated\Exception\PauseRecurringInvoiceNotFoundException
    *
    * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\V1RecurringInvoicesRecurringInvoiceIdPausePostResponse200|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
    */
    public function pauseRecurringInvoice(string $recurringInvoiceId, array $headerParameters = [], string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\PauseRecurringInvoice($recurringInvoiceId, $headerParameters), $fetch);
    }
    /**
    * **Deprecated.** Use `PUT /v1/companies/{company_id}/recurring-invoices/{recurring_invoice_id}/status` with `{"status": "ACTIVE"}`, which behaves identically.
    *
    * Resumes automatic generation of a paused template. It keeps the scheduled next generation
    * date whenever that date has not fallen due yet (including today), so resuming never
    * re-issues a period you already invoiced and never undoes a skipped one. Only a date left
    * in the past is rescheduled, to the first occurrence after today; the periods missed while
    * the template was paused are not backfilled.
    *
    * **Retires on 9 December 2026.** See the [migration guide](https://docs.beel.es/changelog/resources-under-the-nif) for what moved where and what changes when you switch.
    *
    * @param string $recurringInvoiceId
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
    
    * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
    * @throws \Lenorix\BeelSdk\Generated\Exception\ResumeRecurringInvoiceBadRequestException
    * @throws \Lenorix\BeelSdk\Generated\Exception\ResumeRecurringInvoiceForbiddenException
    * @throws \Lenorix\BeelSdk\Generated\Exception\ResumeRecurringInvoiceNotFoundException
    * @throws \Lenorix\BeelSdk\Generated\Exception\ResumeRecurringInvoiceConflictException
    *
    * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\V1RecurringInvoicesRecurringInvoiceIdResumePostResponse200|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
    */
    public function resumeRecurringInvoice(string $recurringInvoiceId, array $headerParameters = [], string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\ResumeRecurringInvoice($recurringInvoiceId, $headerParameters), $fetch);
    }
    /**
    * **Deprecated.** Use
    * `POST /v1/companies/{company_id}/recurring-invoices/{recurring_invoice_id}/generate`,
    * which behaves identically.
    *
    * Runs the generation of a recurring template immediately, out of its schedule.
    *
    * - **It brings the upcoming occurrence forward, it does not add one:** the call consumes
    *   the period that was pending, so the invoice is created now and `next_generation`
    *   advances one period.
    * - **`next_generation` in the response:** the template's next date after this call, or
    *   `null` when the advance took the template past its `end_date` and its status is now
    *   `COMPLETED`.
    *
    * **Retires on 9 December 2026.** See the [migration guide](https://docs.beel.es/changelog/resources-under-the-nif) for what moved where and what changes when you switch.
    *
    * @param string $recurringInvoiceId
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
    
    * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
    * @throws \Lenorix\BeelSdk\Generated\Exception\GenerateInvoiceNowBadRequestException
    * @throws \Lenorix\BeelSdk\Generated\Exception\GenerateInvoiceNowForbiddenException
    * @throws \Lenorix\BeelSdk\Generated\Exception\GenerateInvoiceNowNotFoundException
    * @throws \Lenorix\BeelSdk\Generated\Exception\GenerateInvoiceNowConflictException
    * @throws \Lenorix\BeelSdk\Generated\Exception\GenerateInvoiceNowUnprocessableEntityException
    *
    * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\V1RecurringInvoicesRecurringInvoiceIdGeneratePostResponse201|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
    */
    public function generateInvoiceNow(string $recurringInvoiceId, array $headerParameters = [], string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\GenerateInvoiceNow($recurringInvoiceId, $headerParameters), $fetch);
    }
    /**
    * **Deprecated.** Use `POST /v1/companies/{company_id}/recurring-invoices/{recurring_invoice_id}/skip`, which behaves identically.
    *
    * Skips the next scheduled generation and advances the generation date to the following
    * period. Nothing is issued.
    *
    * **Retires on 9 December 2026.** See the [migration guide](https://docs.beel.es/changelog/resources-under-the-nif) for what moved where and what changes when you switch.
    *
    * @param string $recurringInvoiceId
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
    
    * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
    * @throws \Lenorix\BeelSdk\Generated\Exception\SkipNextGenerationBadRequestException
    * @throws \Lenorix\BeelSdk\Generated\Exception\SkipNextGenerationForbiddenException
    * @throws \Lenorix\BeelSdk\Generated\Exception\SkipNextGenerationNotFoundException
    *
    * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\V1RecurringInvoicesRecurringInvoiceIdSkipPostResponse200|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
    */
    public function skipNextGeneration(string $recurringInvoiceId, array $headerParameters = [], string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\SkipNextGeneration($recurringInvoiceId, $headerParameters), $fetch);
    }
    /**
     * **Deprecated.** Use `GET /v1/companies/{company_id}/recurring-invoices/{recurring_invoice_id}/next-occurrence`, which behaves identically.
     *
     * Returns the invoice that would be produced by the next generation of this recurring
     * template, computed from the current issuer, recipient and series data. Nothing is
     * persisted.
     *
     * **Retires on 9 December 2026.** See the [migration guide](https://docs.beel.es/changelog/resources-under-the-nif) for what moved where and what changes when you switch.
     *
     * @param string $recurringInvoiceId UUID of the recurring invoice template
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \Lenorix\BeelSdk\Generated\Exception\PreviewRecurringInvoiceUnauthorizedException
     * @throws \Lenorix\BeelSdk\Generated\Exception\PreviewRecurringInvoiceForbiddenException
     * @throws \Lenorix\BeelSdk\Generated\Exception\PreviewRecurringInvoiceNotFoundException
     * @throws \Lenorix\BeelSdk\Generated\Exception\PreviewRecurringInvoiceConflictException
     * @throws \Lenorix\BeelSdk\Generated\Exception\PreviewRecurringInvoiceUnprocessableEntityException
     *
     * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\V1RecurringInvoicesRecurringInvoiceIdPreviewGetResponse200|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
     */
    public function previewRecurringInvoice(string $recurringInvoiceId, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\PreviewRecurringInvoice($recurringInvoiceId), $fetch);
    }
    /**
     * **Deprecated.** Use `GET /v1/companies/{company_id}/recurring-invoices/{recurring_invoice_id}/history`.
     *
     * Returns the invoices previously generated from this recurring template, including their
     * status and generation dates.
     *
     * - **Response shape:** it differs from the successor's, and that is why this notice exists.
     *   This route is frozen as it shipped until its `Sunset` date: it returns the **whole**
     *   history in `data.history` and carries no `pagination`. The successor pages with
     *   `page`/`limit` and answers the first 20 generations by default. Send `limit` and read
     *   `data.pagination` when you migrate.
     *
     * **Retires on 9 December 2026.** See the [migration guide](https://docs.beel.es/changelog/resources-under-the-nif) for what moved where and what changes when you switch.
     *
     * @param string $recurringInvoiceId
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetRecurringHistoryForbiddenException
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetRecurringHistoryNotFoundException
     *
     * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\V1RecurringInvoicesRecurringInvoiceIdHistoryGetResponse200|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
     */
    public function getRecurringHistory(string $recurringInvoiceId, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\GetRecurringHistory($recurringInvoiceId), $fetch);
    }
    /**
    * **Deprecated.** Use `POST /v1/companies/{company_id}/recurring-invoices/derivations`, which creates the
    * same template. The source invoice travels in the body as `from_invoice_id`, not in the path.
    *
    * Creates a recurring invoice template taking its lines, recipient and configuration from an
    * existing invoice.
    *
    * **Retires on 9 December 2026.** See the [migration guide](https://docs.beel.es/changelog/resources-under-the-nif) for what moved where and what changes when you switch.
    *
    * @param string $invoiceId
    * @param \Lenorix\BeelSdk\Generated\Model\CreateRecurringFromInvoiceRequest $requestBody
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
    
    * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
    * @throws \Lenorix\BeelSdk\Generated\Exception\CreateRecurringFromInvoiceForbiddenException
    * @throws \Lenorix\BeelSdk\Generated\Exception\CreateRecurringFromInvoiceNotFoundException
    * @throws \Lenorix\BeelSdk\Generated\Exception\CreateRecurringFromInvoiceUnprocessableEntityException
    *
    * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\V1InvoicesInvoiceIdCreateRecurringPostResponse201|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
    */
    public function createRecurringFromInvoice(string $invoiceId, \Lenorix\BeelSdk\Generated\Model\CreateRecurringFromInvoiceRequest $requestBody, array $headerParameters = [], string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\CreateRecurringFromInvoice($invoiceId, $requestBody, $headerParameters), $fetch);
    }
    /**
    * Lists the recurring invoice templates of this company, with filters and pagination.
    * Only the templates of the company in the path are returned.
    *
    * @param string $companyId Unique identifier (UUID) of the company the operation acts on — its identifier, not its NIF. It is the only source of context: the account that owns it is derived from it, and the `BeeL-Active-Company` header plays no part. A company you do not reach answers `403`, and so does a company that does not exist, so the existence of a company in another account is never disclosed.
    * @param array{
    *    "status"?: string,
    *    "customer_id"?: string,
    *    "pause_reason"?: string, //Keeps only the schedules stopped for this reason — the same value the response returns
    in `pause.reason`. A single value; repeating the parameter is rejected.
    
    It combines with `status` as an AND, with no special case: `status=ACTIVE` together with
    any `pause_reason` answers `200` with an empty list, because an active schedule has no
    pause to have a reason. Sending it alone already implies `PAUSED`, since that is the
    only state that records one.
    *    "page"?: int, //Page number, starting at 1. The response echoes it back as `pagination.current_page`.
    *    "limit"?: int, //How many items to return per page. The response echoes it back as `pagination.items_per_page`.
    *    "sort_by"?: string, //Field to sort by. Defaults to `created_at` when omitted.
    *    "sort_order"?: string, //Sort direction. Defaults to `desc` when omitted.
    * } $queryParameters
    
    * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
    * @throws \Lenorix\BeelSdk\Generated\Exception\ListCompanyRecurringInvoicesBadRequestException
    * @throws \Lenorix\BeelSdk\Generated\Exception\ListCompanyRecurringInvoicesUnauthorizedException
    * @throws \Lenorix\BeelSdk\Generated\Exception\ListCompanyRecurringInvoicesForbiddenException
    * @throws \Lenorix\BeelSdk\Generated\Exception\ListCompanyRecurringInvoicesUnprocessableEntityException
    * @throws \Lenorix\BeelSdk\Generated\Exception\ListCompanyRecurringInvoicesTooManyRequestsException
    * @throws \Lenorix\BeelSdk\Generated\Exception\ListCompanyRecurringInvoicesInternalServerErrorException
    *
    * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdRecurringInvoicesGetResponse200|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
    */
    public function listCompanyRecurringInvoices(string $companyId, array $queryParameters = [], string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\ListCompanyRecurringInvoices($companyId, $queryParameters), $fetch);
    }
    /**
    * Creates a recurring invoice template under this company: the invoice data it repeats
    * (lines, recipient, series, payment) plus the recurrence that drives it.
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
    * @param string $companyId Unique identifier (UUID) of the company the operation acts on — its identifier, not its NIF. It is the only source of context: the account that owns it is derived from it, and the `BeeL-Active-Company` header plays no part. A company you do not reach answers `403`, and so does a company that does not exist, so the existence of a company in another account is never disclosed.
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
    
    * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
    * @throws \Lenorix\BeelSdk\Generated\Exception\CreateCompanyRecurringInvoiceBadRequestException
    * @throws \Lenorix\BeelSdk\Generated\Exception\CreateCompanyRecurringInvoiceUnauthorizedException
    * @throws \Lenorix\BeelSdk\Generated\Exception\CreateCompanyRecurringInvoiceForbiddenException
    * @throws \Lenorix\BeelSdk\Generated\Exception\CreateCompanyRecurringInvoiceNotFoundException
    * @throws \Lenorix\BeelSdk\Generated\Exception\CreateCompanyRecurringInvoiceUnprocessableEntityException
    * @throws \Lenorix\BeelSdk\Generated\Exception\CreateCompanyRecurringInvoiceTooManyRequestsException
    * @throws \Lenorix\BeelSdk\Generated\Exception\CreateCompanyRecurringInvoiceInternalServerErrorException
    *
    * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdRecurringInvoicesPostResponse201|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
    */
    public function createCompanyRecurringInvoice(string $companyId, \Lenorix\BeelSdk\Generated\Model\CreateRecurringInvoiceRequest $requestBody, array $headerParameters = [], string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\CreateCompanyRecurringInvoice($companyId, $requestBody, $headerParameters), $fetch);
    }
    /**
     * How many recurring schedules this company has alive, what they add up to per month, and
     * how much invoicing is stopped because the unattended generation broke.
     *
     * **It is the whole company, and it takes no filters.** It is an anchor, not a summary of
     * whatever the list is showing: narrowing the list by customer or by status does not move
     * these figures. Pagination does not apply either — the numbers cover every schedule of the
     * company, not a page of them.
     *
     * **The two amounts are never added together.** `active.monthly_amount` is a forecast of
     * what is going to be invoiced; `stopped.monthly_amount` is invoicing that should be
     * happening and is not. There is deliberately no grand total in the response.
     *
     * The per-schedule figures behind them are the same ones
     * `GET /v1/companies/{company_id}/recurring-invoices` publishes as `amount`, so the rows
     * and this header cannot drift: adding the `amount` of every active row by hand gives
     * `active.monthly_amount` exactly, to the cent.
     *
     * Filters of the list are **rejected**, not ignored: sending `status`, `customer_id` or any
     * other unknown parameter answers `400` naming it. Asking for a filtered header and getting
     * whole-company figures back with a `200` would be worse than being told no.
     *
     * @param string $companyId Unique identifier (UUID) of the company the operation acts on — its identifier, not its NIF. It is the only source of context: the account that owns it is derived from it, and the `BeeL-Active-Company` header plays no part. A company you do not reach answers `403`, and so does a company that does not exist, so the existence of a company in another account is never disclosed.
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetCompanyRecurringInvoiceStatsBadRequestException
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetCompanyRecurringInvoiceStatsUnauthorizedException
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetCompanyRecurringInvoiceStatsForbiddenException
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetCompanyRecurringInvoiceStatsTooManyRequestsException
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetCompanyRecurringInvoiceStatsInternalServerErrorException
     *
     * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdRecurringInvoicesStatsGetResponse200|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
     */
    public function getCompanyRecurringInvoiceStats(string $companyId, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\GetCompanyRecurringInvoiceStats($companyId), $fetch);
    }
    /**
     * Permanently deletes a recurring invoice template of this company and cancels any pending scheduled generations. Invoices already generated from it are not affected.
     * @param string $companyId Unique identifier (UUID) of the company the operation acts on — its identifier, not its NIF. It is the only source of context: the account that owns it is derived from it, and the `BeeL-Active-Company` header plays no part. A company you do not reach answers `403`, and so does a company that does not exist, so the existence of a company in another account is never disclosed.
     * @param string $recurringInvoiceId
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \Lenorix\BeelSdk\Generated\Exception\DeleteCompanyRecurringInvoiceUnauthorizedException
     * @throws \Lenorix\BeelSdk\Generated\Exception\DeleteCompanyRecurringInvoiceForbiddenException
     * @throws \Lenorix\BeelSdk\Generated\Exception\DeleteCompanyRecurringInvoiceNotFoundException
     * @throws \Lenorix\BeelSdk\Generated\Exception\DeleteCompanyRecurringInvoiceTooManyRequestsException
     * @throws \Lenorix\BeelSdk\Generated\Exception\DeleteCompanyRecurringInvoiceInternalServerErrorException
     *
     * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
     */
    public function deleteCompanyRecurringInvoice(string $companyId, string $recurringInvoiceId, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\DeleteCompanyRecurringInvoice($companyId, $recurringInvoiceId), $fetch);
    }
    /**
     * Retrieves the full details of a recurring invoice template of this company, including its schedule, template lines and next generation date.
     * @param string $companyId Unique identifier (UUID) of the company the operation acts on — its identifier, not its NIF. It is the only source of context: the account that owns it is derived from it, and the `BeeL-Active-Company` header plays no part. A company you do not reach answers `403`, and so does a company that does not exist, so the existence of a company in another account is never disclosed.
     * @param string $recurringInvoiceId
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetCompanyRecurringInvoiceBadRequestException
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetCompanyRecurringInvoiceUnauthorizedException
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetCompanyRecurringInvoiceForbiddenException
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetCompanyRecurringInvoiceNotFoundException
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetCompanyRecurringInvoiceTooManyRequestsException
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetCompanyRecurringInvoiceInternalServerErrorException
     *
     * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdRecurringInvoicesRecurringInvoiceIdGetResponse200|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
     */
    public function getCompanyRecurringInvoice(string $companyId, string $recurringInvoiceId, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\GetCompanyRecurringInvoice($companyId, $recurringInvoiceId), $fetch);
    }
    /**
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
    * @param string $companyId Unique identifier (UUID) of the company the operation acts on — its identifier, not its NIF. It is the only source of context: the account that owns it is derived from it, and the `BeeL-Active-Company` header plays no part. A company you do not reach answers `403`, and so does a company that does not exist, so the existence of a company in another account is never disclosed.
    * @param string $recurringInvoiceId
    * @param \Lenorix\BeelSdk\Generated\Model\PatchRecurringInvoiceRequest $requestBody
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
    
    * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
    * @throws \Lenorix\BeelSdk\Generated\Exception\PatchCompanyRecurringInvoiceBadRequestException
    * @throws \Lenorix\BeelSdk\Generated\Exception\PatchCompanyRecurringInvoiceUnauthorizedException
    * @throws \Lenorix\BeelSdk\Generated\Exception\PatchCompanyRecurringInvoiceForbiddenException
    * @throws \Lenorix\BeelSdk\Generated\Exception\PatchCompanyRecurringInvoiceNotFoundException
    * @throws \Lenorix\BeelSdk\Generated\Exception\PatchCompanyRecurringInvoiceConflictException
    * @throws \Lenorix\BeelSdk\Generated\Exception\PatchCompanyRecurringInvoiceUnprocessableEntityException
    * @throws \Lenorix\BeelSdk\Generated\Exception\PatchCompanyRecurringInvoiceTooManyRequestsException
    * @throws \Lenorix\BeelSdk\Generated\Exception\PatchCompanyRecurringInvoiceInternalServerErrorException
    *
    * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdRecurringInvoicesRecurringInvoiceIdPatchResponse200|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
    */
    public function patchCompanyRecurringInvoice(string $companyId, string $recurringInvoiceId, \Lenorix\BeelSdk\Generated\Model\PatchRecurringInvoiceRequest $requestBody, array $headerParameters = [], string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\PatchCompanyRecurringInvoice($companyId, $recurringInvoiceId, $requestBody, $headerParameters), $fetch);
    }
    /**
    * Sets the lifecycle status of a recurring invoice template. This is how generation is
    * paused and resumed.
    *
    * - **`PAUSED`:** stops automatic generation, keeping the schedule configuration intact.
    * - **`ACTIVE`:** resumes generation. It keeps the scheduled next generation date whenever
    *   that date has not fallen due yet (including today), so resuming never re-issues a period
    *   you already invoiced and never undoes a skipped one. Only a date left in the past is
    *   rescheduled, to the first occurrence after today; the periods missed while the template
    *   was paused are not backfilled. If nothing is left to generate — the next generation date
    *   falls beyond `end_date`, or `max_invoices` has already been reached — the template
    *   becomes `COMPLETED`; for `end_date` that holds whether the date was kept or rescheduled.
    * - **`COMPLETED`:** reached on its own when the schedule runs out. It cannot be set here;
    *   the body only accepts `ACTIVE` and `PAUSED`.
    * - **Rejected transitions:** resuming a template that is already active, or one whose
    *   `pause.blocker` is still in effect.
    *
    * @param string $companyId Unique identifier (UUID) of the company the operation acts on — its identifier, not its NIF. It is the only source of context: the account that owns it is derived from it, and the `BeeL-Active-Company` header plays no part. A company you do not reach answers `403`, and so does a company that does not exist, so the existence of a company in another account is never disclosed.
    * @param string $recurringInvoiceId
    * @param \Lenorix\BeelSdk\Generated\Model\SetRecurringInvoiceStatusRequest $requestBody
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
    
    * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
    * @throws \Lenorix\BeelSdk\Generated\Exception\SetCompanyRecurringInvoiceStatusBadRequestException
    * @throws \Lenorix\BeelSdk\Generated\Exception\SetCompanyRecurringInvoiceStatusUnauthorizedException
    * @throws \Lenorix\BeelSdk\Generated\Exception\SetCompanyRecurringInvoiceStatusForbiddenException
    * @throws \Lenorix\BeelSdk\Generated\Exception\SetCompanyRecurringInvoiceStatusNotFoundException
    * @throws \Lenorix\BeelSdk\Generated\Exception\SetCompanyRecurringInvoiceStatusUnprocessableEntityException
    * @throws \Lenorix\BeelSdk\Generated\Exception\SetCompanyRecurringInvoiceStatusTooManyRequestsException
    * @throws \Lenorix\BeelSdk\Generated\Exception\SetCompanyRecurringInvoiceStatusInternalServerErrorException
    *
    * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdRecurringInvoicesRecurringInvoiceIdStatusPutResponse200|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
    */
    public function setCompanyRecurringInvoiceStatus(string $companyId, string $recurringInvoiceId, \Lenorix\BeelSdk\Generated\Model\SetRecurringInvoiceStatusRequest $requestBody, array $headerParameters = [], string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\SetCompanyRecurringInvoiceStatus($companyId, $recurringInvoiceId, $requestBody, $headerParameters), $fetch);
    }
    /**
    * Skips the next scheduled invoice generation and advances the generation date to the following period. Nothing is issued.
    * @param string $companyId Unique identifier (UUID) of the company the operation acts on — its identifier, not its NIF. It is the only source of context: the account that owns it is derived from it, and the `BeeL-Active-Company` header plays no part. A company you do not reach answers `403`, and so does a company that does not exist, so the existence of a company in another account is never disclosed.
    * @param string $recurringInvoiceId
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
    
    * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
    * @throws \Lenorix\BeelSdk\Generated\Exception\SkipCompanyRecurringInvoiceBadRequestException
    * @throws \Lenorix\BeelSdk\Generated\Exception\SkipCompanyRecurringInvoiceUnauthorizedException
    * @throws \Lenorix\BeelSdk\Generated\Exception\SkipCompanyRecurringInvoiceForbiddenException
    * @throws \Lenorix\BeelSdk\Generated\Exception\SkipCompanyRecurringInvoiceNotFoundException
    * @throws \Lenorix\BeelSdk\Generated\Exception\SkipCompanyRecurringInvoiceTooManyRequestsException
    * @throws \Lenorix\BeelSdk\Generated\Exception\SkipCompanyRecurringInvoiceInternalServerErrorException
    *
    * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdRecurringInvoicesRecurringInvoiceIdSkipPostResponse200|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
    */
    public function skipCompanyRecurringInvoice(string $companyId, string $recurringInvoiceId, array $headerParameters = [], string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\SkipCompanyRecurringInvoice($companyId, $recurringInvoiceId, $headerParameters), $fetch);
    }
    /**
     * Returns the invoice that would be produced by the next generation of this recurring
     * template, computed from the current issuer, recipient and series data. Nothing is
     * persisted and no numbering is consumed.
     *
     * @param string $companyId Unique identifier (UUID) of the company the operation acts on — its identifier, not its NIF. It is the only source of context: the account that owns it is derived from it, and the `BeeL-Active-Company` header plays no part. A company you do not reach answers `403`, and so does a company that does not exist, so the existence of a company in another account is never disclosed.
     * @param string $recurringInvoiceId
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetCompanyRecurringInvoiceNextOccurrenceBadRequestException
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetCompanyRecurringInvoiceNextOccurrenceUnauthorizedException
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetCompanyRecurringInvoiceNextOccurrenceForbiddenException
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetCompanyRecurringInvoiceNextOccurrenceNotFoundException
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetCompanyRecurringInvoiceNextOccurrenceConflictException
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetCompanyRecurringInvoiceNextOccurrenceUnprocessableEntityException
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetCompanyRecurringInvoiceNextOccurrenceTooManyRequestsException
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetCompanyRecurringInvoiceNextOccurrenceInternalServerErrorException
     *
     * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdRecurringInvoicesRecurringInvoiceIdNextOccurrenceGetResponse200|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
     */
    public function getCompanyRecurringInvoiceNextOccurrence(string $companyId, string $recurringInvoiceId, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\GetCompanyRecurringInvoiceNextOccurrence($companyId, $recurringInvoiceId), $fetch);
    }
    /**
     * Returns the invoices previously generated from this recurring template, including their
     * status and generation dates, newest first.
     *
     * **Paginated** with the usual `page`/`limit`, and the usual defaults: without them you get
     * the 20 most recent generations, not the whole history — which grows with every cycle the
     * template runs. Read `data.pagination` to walk the rest.
     *
     * The deprecated flat alias `GET /v1/recurring-invoices/{recurring_invoice_id}/history` does
     * **not** paginate: it is frozen as it shipped until its `Sunset` date, and returns the whole
     * history with no `pagination`. Only this route pages.
     *
     * @param string $companyId Unique identifier (UUID) of the company the operation acts on — its identifier, not its NIF. It is the only source of context: the account that owns it is derived from it, and the `BeeL-Active-Company` header plays no part. A company you do not reach answers `403`, and so does a company that does not exist, so the existence of a company in another account is never disclosed.
     * @param string $recurringInvoiceId
     * @param array{
     *    "page"?: int, //Page number, starting at 1. The response echoes it back as `pagination.current_page`.
     *    "limit"?: int, //How many items to return per page. The response echoes it back as `pagination.items_per_page`.
     * } $queryParameters
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetCompanyRecurringInvoiceHistoryBadRequestException
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetCompanyRecurringInvoiceHistoryUnauthorizedException
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetCompanyRecurringInvoiceHistoryForbiddenException
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetCompanyRecurringInvoiceHistoryNotFoundException
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetCompanyRecurringInvoiceHistoryTooManyRequestsException
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetCompanyRecurringInvoiceHistoryInternalServerErrorException
     *
     * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdRecurringInvoicesRecurringInvoiceIdHistoryGetResponse200|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
     */
    public function getCompanyRecurringInvoiceHistory(string $companyId, string $recurringInvoiceId, array $queryParameters = [], string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\GetCompanyRecurringInvoiceHistory($companyId, $recurringInvoiceId, $queryParameters), $fetch);
    }
    /**
    * Creates a recurring invoice template of this company taking its lines, recipient, series
    * and payment data from an existing invoice, so only the recurrence has to be described.
    *
    * - **`from_invoice_id`:** the source invoice. It must belong to the company in the path,
    *   and one you cannot reach is reported the same way as one that does not exist. It is
    *   not modified by this call.
    * - **Recurrence:** `name`, `day_of_month` and `start_date` are required; `end_date` and
    *   `frequency` are optional. The cadence is not taken from the source invoice — a one-off
    *   invoice has none to copy — so it is described here like any other recurrence field:
    *   every 1 (`MONTHLY`), 3 (`QUARTERLY`) or 12 (`YEARLY`) months, `MONTHLY` when omitted.
    *   It governs the step from the first invoice onwards, not where that first one lands.
    * - **VeriFactu:** not inherited from the source invoice. Each generated invoice is
    *   registered with AEAT, or not, according to the company's regime when it is issued.
    *
    * @param string $companyId Unique identifier (UUID) of the company the operation acts on — its identifier, not its NIF. It is the only source of context: the account that owns it is derived from it, and the `BeeL-Active-Company` header plays no part. A company you do not reach answers `403`, and so does a company that does not exist, so the existence of a company in another account is never disclosed.
    * @param \Lenorix\BeelSdk\Generated\Model\CreateRecurringInvoiceDerivationRequest $requestBody
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
    
    * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
    * @throws \Lenorix\BeelSdk\Generated\Exception\CreateCompanyRecurringInvoiceDerivationBadRequestException
    * @throws \Lenorix\BeelSdk\Generated\Exception\CreateCompanyRecurringInvoiceDerivationUnauthorizedException
    * @throws \Lenorix\BeelSdk\Generated\Exception\CreateCompanyRecurringInvoiceDerivationForbiddenException
    * @throws \Lenorix\BeelSdk\Generated\Exception\CreateCompanyRecurringInvoiceDerivationNotFoundException
    * @throws \Lenorix\BeelSdk\Generated\Exception\CreateCompanyRecurringInvoiceDerivationUnprocessableEntityException
    * @throws \Lenorix\BeelSdk\Generated\Exception\CreateCompanyRecurringInvoiceDerivationTooManyRequestsException
    * @throws \Lenorix\BeelSdk\Generated\Exception\CreateCompanyRecurringInvoiceDerivationInternalServerErrorException
    *
    * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdRecurringInvoicesDerivationsPostResponse201|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
    */
    public function createCompanyRecurringInvoiceDerivation(string $companyId, \Lenorix\BeelSdk\Generated\Model\CreateRecurringInvoiceDerivationRequest $requestBody, array $headerParameters = [], string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\CreateCompanyRecurringInvoiceDerivation($companyId, $requestBody, $headerParameters), $fetch);
    }
    /**
    * Runs the generation of this recurring template immediately, out of its schedule. It is a
    * fiscal act: the generated invoice consumes numbering from the series of the template and,
    * when the template says so, is issued and sent.
    *
    * - **It brings the upcoming occurrence forward, it does not add one:** the call consumes
    *   the period that was pending, so the invoice is created now and `next_generation`
    *   advances one period. Generating manually, skipping and letting the schedule run each
    *   consume exactly one occurrence, so a monthly template still produces twelve invoices a
    *   year however you mix the three.
    * - **`next_generation` in the response:** the template's next date after this call
    *   consumed the pending occurrence, or `null` when the advance took the template past its
    *   `end_date` and its status is now `COMPLETED`.
    * - **An extra invoice outside the calendar:** do not use this endpoint. Create a normal
    *   invoice, or derive a draft from one the template already generated with
    *   `POST /v1/companies/{company_id}/invoices/derivations`. Either way the schedule stays
    *   where it was.
    *
    * @param string $companyId Unique identifier (UUID) of the company the operation acts on — its identifier, not its NIF. It is the only source of context: the account that owns it is derived from it, and the `BeeL-Active-Company` header plays no part. A company you do not reach answers `403`, and so does a company that does not exist, so the existence of a company in another account is never disclosed.
    * @param string $recurringInvoiceId
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
    
    * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
    * @throws \Lenorix\BeelSdk\Generated\Exception\GenerateCompanyRecurringInvoiceNowBadRequestException
    * @throws \Lenorix\BeelSdk\Generated\Exception\GenerateCompanyRecurringInvoiceNowUnauthorizedException
    * @throws \Lenorix\BeelSdk\Generated\Exception\GenerateCompanyRecurringInvoiceNowForbiddenException
    * @throws \Lenorix\BeelSdk\Generated\Exception\GenerateCompanyRecurringInvoiceNowNotFoundException
    * @throws \Lenorix\BeelSdk\Generated\Exception\GenerateCompanyRecurringInvoiceNowConflictException
    * @throws \Lenorix\BeelSdk\Generated\Exception\GenerateCompanyRecurringInvoiceNowUnprocessableEntityException
    * @throws \Lenorix\BeelSdk\Generated\Exception\GenerateCompanyRecurringInvoiceNowTooManyRequestsException
    * @throws \Lenorix\BeelSdk\Generated\Exception\GenerateCompanyRecurringInvoiceNowInternalServerErrorException
    *
    * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdRecurringInvoicesRecurringInvoiceIdGeneratePostResponse201|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
    */
    public function generateCompanyRecurringInvoiceNow(string $companyId, string $recurringInvoiceId, array $headerParameters = [], string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\GenerateCompanyRecurringInvoiceNow($companyId, $recurringInvoiceId, $headerParameters), $fetch);
    }
    /**
    * Returns a paginated list of customers, with optional filters.
    *
    * - **Deprecated:** use `GET /v1/companies/{company_id}/customers`, which behaves identically.
    *
    * **Retires on 9 December 2026.** See the [migration guide](https://docs.beel.es/changelog/resources-under-the-nif) for what moved where and what changes when you switch.
    *
    * @param array{
    *    "page"?: int, //Page number, starting at 1. The response echoes it back as `pagination.current_page`.
    *    "limit"?: int, //How many items to return per page. The response echoes it back as `pagination.items_per_page`.
    *    "active"?: bool, //Filter by active/inactive status. Defaults to `true`, so inactive customers must be requested
    explicitly with `active=false`. Deleted customers are never returned by either value.
    *    "search"?: string, //Global search by name, NIF or email
    *    "legal_name"?: string, //Filter by legal name (partial search case-insensitive)
    *    "nif"?: string, //Filter by NIF (partial search)
    *    "email"?: string, //Filter by email (partial search)
    *    "phone"?: string, //Filter by phone (partial search)
    *    "city"?: string, //Filter by city
    *    "province"?: string, //Filter by province
    *    "sort_by"?: string, //Field to sort by. Results are always tie-broken by a stable internal key, so paging through the collection never repeats or skips a customer.
    *    "sort_order"?: string, //Sort order direction
    * } $queryParameters
    
    * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
    * @throws \Lenorix\BeelSdk\Generated\Exception\ListCustomersBadRequestException
    * @throws \Lenorix\BeelSdk\Generated\Exception\ListCustomersUnauthorizedException
    * @throws \Lenorix\BeelSdk\Generated\Exception\ListCustomersForbiddenException
    * @throws \Lenorix\BeelSdk\Generated\Exception\ListCustomersUnprocessableEntityException
    * @throws \Lenorix\BeelSdk\Generated\Exception\ListCustomersTooManyRequestsException
    * @throws \Lenorix\BeelSdk\Generated\Exception\ListCustomersInternalServerErrorException
    *
    * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\V1CustomersGetResponse200|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
    */
    public function listCustomers(array $queryParameters = [], string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\ListCustomers($queryParameters), $fetch);
    }
    /**
    * Creates a new customer.
    *
    * - **Deprecated:** use `POST /v1/companies/{company_id}/customers`, which behaves
    *   identically.
    *
    * **Retires on 9 December 2026.** See the [migration guide](https://docs.beel.es/changelog/resources-under-the-nif) for what moved where and what changes when you switch.
    *
    * @param \Lenorix\BeelSdk\Generated\Model\CreateCustomerRequest $requestBody
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
    
    * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
    * @throws \Lenorix\BeelSdk\Generated\Exception\CreateCustomerBadRequestException
    * @throws \Lenorix\BeelSdk\Generated\Exception\CreateCustomerUnauthorizedException
    * @throws \Lenorix\BeelSdk\Generated\Exception\CreateCustomerForbiddenException
    * @throws \Lenorix\BeelSdk\Generated\Exception\CreateCustomerConflictException
    * @throws \Lenorix\BeelSdk\Generated\Exception\CreateCustomerUnprocessableEntityException
    * @throws \Lenorix\BeelSdk\Generated\Exception\CreateCustomerTooManyRequestsException
    * @throws \Lenorix\BeelSdk\Generated\Exception\CreateCustomerInternalServerErrorException
    *
    * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\V1CustomersPostResponse201|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
    */
    public function createCustomer(\Lenorix\BeelSdk\Generated\Model\CreateCustomerRequest $requestBody, array $headerParameters = [], string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\CreateCustomer($requestBody, $headerParameters), $fetch);
    }
    /**
     * Deletes a customer that has no invoices.
     *
     * - **Deprecated:** use `DELETE /v1/companies/{company_id}/customers/{customer_id}`, which
     *   deletes the same way but answers `204` with no body instead of `200`. This route keeps
     *   working until the date announced in its `Sunset` response header.
     *
     * ## What deleting means
     *
     * - **No longer exposed:** the customer is retained internally for tax record-keeping
     *   purposes, but is no longer exposed by the API: subsequent requests to it return `404`, and
     *   it is never included in the customer list, under any value of the `active` filter.
     * - **Identifier released:** its NIF or alternative identifier is freed, so a new customer may
     *   be created with the same identifier.
     *
     * ## Customers you cannot delete
     *
     * - **Customers with invoices:** they cannot be deleted and the request answers `409`
     *   `CLIENT_HAS_INVOICES`, leaving the customer untouched — neither deleted nor deactivated.
     * - **Deactivating instead:** to stop using a customer, whether or not it has invoices, update
     *   it with `active` set to `false`: that releases no identifier and keeps the customer
     *   retrievable through `GET /v1/customers?active=false`.
     *
     * **Retires on 9 December 2026.** See the [migration guide](https://docs.beel.es/changelog/resources-under-the-nif) for what moved where and what changes when you switch.
     *
     * @param string $customerId Customer ID
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \Lenorix\BeelSdk\Generated\Exception\DeleteCustomerUnauthorizedException
     * @throws \Lenorix\BeelSdk\Generated\Exception\DeleteCustomerForbiddenException
     * @throws \Lenorix\BeelSdk\Generated\Exception\DeleteCustomerNotFoundException
     * @throws \Lenorix\BeelSdk\Generated\Exception\DeleteCustomerConflictException
     * @throws \Lenorix\BeelSdk\Generated\Exception\DeleteCustomerTooManyRequestsException
     * @throws \Lenorix\BeelSdk\Generated\Exception\DeleteCustomerInternalServerErrorException
     *
     * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\V1CustomersCustomerIdDeleteResponse200|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
     */
    public function deleteCustomer(string $customerId, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\DeleteCustomer($customerId), $fetch);
    }
    /**
     * Retrieves the complete details of a customer.
     *
     * - **Deprecated:** use `GET /v1/companies/{company_id}/customers/{customer_id}`, which
     *   behaves identically.
     *
     * **Retires on 9 December 2026.** See the [migration guide](https://docs.beel.es/changelog/resources-under-the-nif) for what moved where and what changes when you switch.
     *
     * @param string $customerId Customer ID
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetCustomerBadRequestException
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetCustomerUnauthorizedException
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetCustomerForbiddenException
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetCustomerNotFoundException
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetCustomerTooManyRequestsException
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetCustomerInternalServerErrorException
     *
     * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\V1CustomersCustomerIdGetResponse200|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
     */
    public function getCustomer(string $customerId, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\GetCustomer($customerId), $fetch);
    }
    /**
     * Updates only the fields present in the body, leaving every other field of the customer as it
     * is.
     *
     * - **Null vs omitted:** a field sent as `null` is cleared, which is different from omitting
     *   it (see `PatchCustomerRequest`). The result goes through the same validation as `PUT`.
     * - **AEAT census:** the customer's Spanish tax identifier is only checked against the AEAT
     *   census when the request changes the `nif` or the `legal_name`. Editing anything else never
     *   asks the census.
     *   For a **legal entity** the census checks the CIF only and its `legal_name` is not
     *   verified, so the name never causes the rejection; only a **natural person**'s NIF is
     *   crossed with the name.
     *   Duplicate and format checks run on every update.
     * - **Deprecated:** use `PATCH /v1/companies/{company_id}/customers/{customer_id}`, which
     *   behaves identically.
     *
     * **Retires on 9 December 2026.** See the [migration guide](https://docs.beel.es/changelog/resources-under-the-nif) for what moved where and what changes when you switch.
     *
     * @param string $customerId Customer ID
     * @param \Lenorix\BeelSdk\Generated\Model\PatchCustomerRequest $requestBody
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \Lenorix\BeelSdk\Generated\Exception\PatchCustomerBadRequestException
     * @throws \Lenorix\BeelSdk\Generated\Exception\PatchCustomerUnauthorizedException
     * @throws \Lenorix\BeelSdk\Generated\Exception\PatchCustomerForbiddenException
     * @throws \Lenorix\BeelSdk\Generated\Exception\PatchCustomerNotFoundException
     * @throws \Lenorix\BeelSdk\Generated\Exception\PatchCustomerConflictException
     * @throws \Lenorix\BeelSdk\Generated\Exception\PatchCustomerUnprocessableEntityException
     * @throws \Lenorix\BeelSdk\Generated\Exception\PatchCustomerInternalServerErrorException
     *
     * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\V1CustomersCustomerIdPatchResponse200|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
     */
    public function patchCustomer(string $customerId, \Lenorix\BeelSdk\Generated\Model\PatchCustomerRequest $requestBody, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\PatchCustomer($customerId, $requestBody), $fetch);
    }
    /**
     * Replaces an existing customer with the body you send.
     *
     * - **Not a partial update:** `trade_name`, `email`, `website`, `billing_emails`,
     *   `contact_person`, `notes` and `general_discount` are cleared when they are absent from the
     *   body, so send the customer complete. To change only some fields, use
     *   `PATCH /v1/companies/{company_id}/customers/{customer_id}`.
     * - **AEAT census:** the customer's Spanish tax identifier is only checked against the AEAT
     *   census when the body changes the `nif` or the `legal_name` of the stored customer.
     *   Resending the same pair never asks the census, so a customer stored long ago stays
     *   editable even if its NIF is no longer listed.
     *   For a **legal entity** the census checks the CIF only and its `legal_name` is not
     *   verified, so the name never causes the rejection; only a **natural person**'s NIF is
     *   crossed with the name.
     *   Duplicate and format checks run on every update.
     * - **Deprecated:** this route will be retired on the date announced in its `Sunset` response
     *   header. The canonical form has a single update verb,
     *   `PATCH /v1/companies/{company_id}/customers/{customer_id}`, which is not a drop-in
     *   replacement for this one: it changes only the fields present in the body. To reproduce a
     *   total replacement, send every field and pass `null` in the ones you want cleared.
     *
     * **Retires on 9 December 2026.** See the [migration guide](https://docs.beel.es/changelog/resources-under-the-nif) for what moved where and what changes when you switch.
     *
     * @param string $customerId Customer ID
     * @param \Lenorix\BeelSdk\Generated\Model\UpdateCustomerRequest $requestBody
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \Lenorix\BeelSdk\Generated\Exception\UpdateCustomerBadRequestException
     * @throws \Lenorix\BeelSdk\Generated\Exception\UpdateCustomerUnauthorizedException
     * @throws \Lenorix\BeelSdk\Generated\Exception\UpdateCustomerForbiddenException
     * @throws \Lenorix\BeelSdk\Generated\Exception\UpdateCustomerNotFoundException
     * @throws \Lenorix\BeelSdk\Generated\Exception\UpdateCustomerUnprocessableEntityException
     * @throws \Lenorix\BeelSdk\Generated\Exception\UpdateCustomerTooManyRequestsException
     * @throws \Lenorix\BeelSdk\Generated\Exception\UpdateCustomerInternalServerErrorException
     *
     * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\V1CustomersCustomerIdPutResponse200|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
     */
    public function updateCustomer(string $customerId, \Lenorix\BeelSdk\Generated\Model\UpdateCustomerRequest $requestBody, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\UpdateCustomer($customerId, $requestBody), $fetch);
    }
    /**
     * Deletes the customers listed in `ids`.
     *
     * - **Deprecated:** use `DELETE /v1/companies/{company_id}/customers/bulk`, which behaves
     *   identically.
     *
     * ## Partial results
     *
     * - **Partial:** the customers that can be deleted are deleted, and the rest keep their
     *   place in `customers_deletion` with the status that explains why.
     * - **`HAS_INVOICES`:** a customer that has invoices cannot be deleted and comes back with
     *   that row status.
     *
     * ## What deleting means
     *
     * - **Semantics:** each deletion behaves as `DELETE /v1/customers/{customer_id}`. The
     *   customer is retained for tax record-keeping purposes but is no longer exposed by the
     *   API, its identifier is released for reuse, and invoices already issued to it keep their
     *   own copy of the recipient's details.
     * - **Not deactivating:** deleting frees the identifier, so the same NIF can be registered
     *   again, while `PATCH` with `active: false` leaves the customer where it is with its NIF
     *   still taken.
     *
     * **Retires on 9 December 2026.** See the [migration guide](https://docs.beel.es/changelog/resources-under-the-nif) for what moved where and what changes when you switch.
     *
     * @param array{
     *    "ids": string, //Comma-separated customer IDs
     * } $queryParameters
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \Lenorix\BeelSdk\Generated\Exception\DeactivateCustomersBulkBadRequestException
     * @throws \Lenorix\BeelSdk\Generated\Exception\DeactivateCustomersBulkUnauthorizedException
     * @throws \Lenorix\BeelSdk\Generated\Exception\DeactivateCustomersBulkForbiddenException
     * @throws \Lenorix\BeelSdk\Generated\Exception\DeactivateCustomersBulkTooManyRequestsException
     * @throws \Lenorix\BeelSdk\Generated\Exception\DeactivateCustomersBulkInternalServerErrorException
     *
     * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\V1CustomersBulkDeleteResponse200|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
     */
    public function deactivateCustomersBulk(array $queryParameters = [], string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\DeactivateCustomersBulk($queryParameters), $fetch);
    }
    /**
    * Creates up to 500 customers in a single call.
    *
    * - **Deprecated:** use `POST /v1/companies/{company_id}/customers/bulk`, which validates
    *   and creates the same way. A dry run still answers `200`; an actual creation answers
    *   `201` instead of `200`.
    * - **Atomic:** if any customer fails validation the whole batch is rejected with
    *   `422 BULK_VALIDATION_ERROR` and nothing is persisted.
    * - **`dry_run`:** with `true` the batch is only validated — tax identifiers against the
    *   AEAT register, duplicates inside the batch and against the existing customers, field
    *   formats — and nothing is written. With `false`, the default, validation is followed by
    *   creation.
    * - **Report:** both modes return the same per-record report, so a dry run and a real run
    *   are read the same way.
    *
    * **Retires on 9 December 2026.** See the [migration guide](https://docs.beel.es/changelog/resources-under-the-nif) for what moved where and what changes when you switch.
    *
    * @param \Lenorix\BeelSdk\Generated\Model\V1CustomersBulkPostBody $requestBody
    * @param array{
    *    "dry_run"?: bool, //Validate the batch without persisting it (`true`), or validate and create it (`false`,
    the default). Either way the batch is atomic.
    * } $queryParameters
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
    
    * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
    * @throws \Lenorix\BeelSdk\Generated\Exception\CreateCustomersBulkBadRequestException
    * @throws \Lenorix\BeelSdk\Generated\Exception\CreateCustomersBulkUnauthorizedException
    * @throws \Lenorix\BeelSdk\Generated\Exception\CreateCustomersBulkForbiddenException
    * @throws \Lenorix\BeelSdk\Generated\Exception\CreateCustomersBulkUnprocessableEntityException
    * @throws \Lenorix\BeelSdk\Generated\Exception\CreateCustomersBulkTooManyRequestsException
    * @throws \Lenorix\BeelSdk\Generated\Exception\CreateCustomersBulkInternalServerErrorException
    *
    * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\V1CustomersBulkPostResponse200|\Lenorix\BeelSdk\Generated\Model\V1CustomersBulkPostResponse201|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
    */
    public function createCustomersBulk(\Lenorix\BeelSdk\Generated\Model\V1CustomersBulkPostBody $requestBody, array $queryParameters = [], array $headerParameters = [], string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\CreateCustomersBulk($requestBody, $queryParameters, $headerParameters), $fetch);
    }
    /**
     * Parses a CSV of customers and returns every row with its validation outcome, the
     * rejected ones included.
     *
     * - **Deprecated:** use `POST /v1/companies/{company_id}/customers/imports/preview`, which
     *   parses and validates the file without writing anything — what this route does by
     *   default. To actually import, use `POST /v1/companies/{company_id}/customers/imports`,
     *   where the origin of the file travels in the body as `source` and a boolean no longer
     *   decides between looking and writing.
     * - **File:** must use the headers of the template served by
     *   `GET /v1/templates/customer-import`, and is limited to 5 MB and 1,000 rows.
     * - **Validation:** each row is checked against the same rules as single-customer creation,
     *   plus duplicate detection within the file and against existing customers, and a NIF
     *   lookup in the AEAT register.
     * - **`dry_run`:** at its default `true` nothing is persisted; `false` also persists the
     *   valid customers.
     *
     * **Retires on 9 December 2026.** See the [migration guide](https://docs.beel.es/changelog/resources-under-the-nif) for what moved where and what changes when you switch.
     *
     * @param \Lenorix\BeelSdk\Generated\Model\V1CustomersImportCsvPreviewPostBody $requestBody
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \Lenorix\BeelSdk\Generated\Exception\ImportCustomersCsvPreviewBadRequestException
     * @throws \Lenorix\BeelSdk\Generated\Exception\ImportCustomersCsvPreviewUnauthorizedException
     * @throws \Lenorix\BeelSdk\Generated\Exception\ImportCustomersCsvPreviewForbiddenException
     * @throws \Lenorix\BeelSdk\Generated\Exception\ImportCustomersCsvPreviewRequestEntityTooLargeException
     * @throws \Lenorix\BeelSdk\Generated\Exception\ImportCustomersCsvPreviewUnprocessableEntityException
     * @throws \Lenorix\BeelSdk\Generated\Exception\ImportCustomersCsvPreviewTooManyRequestsException
     * @throws \Lenorix\BeelSdk\Generated\Exception\ImportCustomersCsvPreviewInternalServerErrorException
     *
     * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\V1CustomersImportCsvPreviewPostResponse200|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
     */
    public function importCustomersCsvPreview(\Lenorix\BeelSdk\Generated\Model\V1CustomersImportCsvPreviewPostBody $requestBody, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\ImportCustomersCsvPreview($requestBody), $fetch);
    }
    /**
    * Parses a contacts export from Holded (`.xlsx`) as Holded produces it, maps each contact
    * to a customer and returns every row with its validation outcome, as the CSV import does.
    *
    * - **Deprecated:** use `POST /v1/companies/{company_id}/customers/imports` with
    *   `source: holded`, which imports the same file. It answers `201` and requires the
    *   `Idempotency-Key` header.
    * - **Mapping:** the contact name becomes `legal_name`, the Holded ID becomes the tax
    *   identifier, and mobile takes precedence over landline for the phone.
    * - **File:** limited to 10 MB and 5,000 contacts.
    * - **`preview`:** at its default `true` nothing is persisted; `false` also imports the
    *   mapped customers.
    *
    * **Retires on 9 December 2026.** See the [migration guide](https://docs.beel.es/changelog/resources-under-the-nif) for what moved where and what changes when you switch.
    *
    * @param \Lenorix\BeelSdk\Generated\Model\V1CustomersImportHoldedContactsPostBody $requestBody
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
    
    * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
    * @throws \Lenorix\BeelSdk\Generated\Exception\ImportHoldedContactsBadRequestException
    * @throws \Lenorix\BeelSdk\Generated\Exception\ImportHoldedContactsUnauthorizedException
    * @throws \Lenorix\BeelSdk\Generated\Exception\ImportHoldedContactsForbiddenException
    * @throws \Lenorix\BeelSdk\Generated\Exception\ImportHoldedContactsRequestEntityTooLargeException
    * @throws \Lenorix\BeelSdk\Generated\Exception\ImportHoldedContactsUnprocessableEntityException
    * @throws \Lenorix\BeelSdk\Generated\Exception\ImportHoldedContactsTooManyRequestsException
    * @throws \Lenorix\BeelSdk\Generated\Exception\ImportHoldedContactsInternalServerErrorException
    *
    * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\V1CustomersImportHoldedContactsPostResponse200|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
    */
    public function importHoldedContacts(\Lenorix\BeelSdk\Generated\Model\V1CustomersImportHoldedContactsPostBody $requestBody, array $headerParameters = [], string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\ImportHoldedContacts($requestBody, $headerParameters), $fetch);
    }
    /**
    * Returns a paginated list of the customers of this company, with optional filters.
    * Only the customers of the company in the path are returned.
    *
    * @param string $companyId Unique identifier (UUID) of the company the operation acts on — its identifier, not its NIF. It is the only source of context: the account that owns it is derived from it, and the `BeeL-Active-Company` header plays no part. A company you do not reach answers `403`, and so does a company that does not exist, so the existence of a company in another account is never disclosed.
    * @param array{
    *    "page"?: int, //Page number, starting at 1. The response echoes it back as `pagination.current_page`.
    *    "limit"?: int, //How many items to return per page. The response echoes it back as `pagination.items_per_page`.
    *    "active"?: bool, //Filter by active/inactive status. Defaults to `true`, so inactive customers must be
    requested explicitly with `active=false`. Deleted customers are never returned by
    either value.
    *    "search"?: string, //Global search by name, NIF or email
    *    "legal_name"?: string, //Filter by legal name (partial search case-insensitive)
    *    "nif"?: string, //Filter by NIF (partial search)
    *    "email"?: string, //Filter by email (partial search)
    *    "phone"?: string, //Filter by phone (partial search)
    *    "city"?: string, //Filter by city
    *    "province"?: string, //Filter by province
    *    "sort_by"?: string, //Field to sort by. Results are always tie-broken by a stable internal key, so paging through the collection never repeats or skips a customer.
    *    "sort_order"?: string, //Sort order direction
    * } $queryParameters
    
    * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
    * @throws \Lenorix\BeelSdk\Generated\Exception\ListCompanyCustomersBadRequestException
    * @throws \Lenorix\BeelSdk\Generated\Exception\ListCompanyCustomersUnauthorizedException
    * @throws \Lenorix\BeelSdk\Generated\Exception\ListCompanyCustomersForbiddenException
    * @throws \Lenorix\BeelSdk\Generated\Exception\ListCompanyCustomersUnprocessableEntityException
    * @throws \Lenorix\BeelSdk\Generated\Exception\ListCompanyCustomersTooManyRequestsException
    * @throws \Lenorix\BeelSdk\Generated\Exception\ListCompanyCustomersInternalServerErrorException
    *
    * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdCustomersGetResponse200|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
    */
    public function listCompanyCustomers(string $companyId, array $queryParameters = [], string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\ListCompanyCustomers($companyId, $queryParameters), $fetch);
    }
    /**
    * Creates a new customer under this company.
    *
    * - **`Idempotency-Key`:** it identifies the same operation on the deprecated flat route, so a
    *   retry that switches route replays instead of creating twice.
    *
    * @param string $companyId Unique identifier (UUID) of the company the operation acts on — its identifier, not its NIF. It is the only source of context: the account that owns it is derived from it, and the `BeeL-Active-Company` header plays no part. A company you do not reach answers `403`, and so does a company that does not exist, so the existence of a company in another account is never disclosed.
    * @param \Lenorix\BeelSdk\Generated\Model\CreateCustomerRequest $requestBody
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
    
    * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
    * @throws \Lenorix\BeelSdk\Generated\Exception\CreateCompanyCustomerBadRequestException
    * @throws \Lenorix\BeelSdk\Generated\Exception\CreateCompanyCustomerUnauthorizedException
    * @throws \Lenorix\BeelSdk\Generated\Exception\CreateCompanyCustomerForbiddenException
    * @throws \Lenorix\BeelSdk\Generated\Exception\CreateCompanyCustomerConflictException
    * @throws \Lenorix\BeelSdk\Generated\Exception\CreateCompanyCustomerUnprocessableEntityException
    * @throws \Lenorix\BeelSdk\Generated\Exception\CreateCompanyCustomerTooManyRequestsException
    * @throws \Lenorix\BeelSdk\Generated\Exception\CreateCompanyCustomerInternalServerErrorException
    *
    * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdCustomersPostResponse201|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
    */
    public function createCompanyCustomer(string $companyId, \Lenorix\BeelSdk\Generated\Model\CreateCustomerRequest $requestBody, array $headerParameters = [], string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\CreateCompanyCustomer($companyId, $requestBody, $headerParameters), $fetch);
    }
    /**
     * Deletes the customers listed in `ids` from this company.
     *
     * ## Partial results
     *
     * - **Partial operation:** the customers that can be deleted are deleted, and the rest keep
     *   their place in `customers_deletion` with the status that explains why. That is why it
     *   answers `200` with a body instead of `204`, and why it answers `200` even when no row
     *   could be deleted.
     * - **`HAS_INVOICES`:** a customer that has invoices cannot be deleted and comes back with
     *   that row status.
     *
     * ## What deleting means
     *
     * - **Semantics:** the same semantics as
     *   `DELETE /v1/companies/{company_id}/customers/{customer_id}` — the customer is retained
     *   internally for tax record-keeping purposes but is no longer exposed by the API, its
     *   identifier is released for reuse, and invoices already issued to it keep their own copy of
     *   the recipient's details.
     * - **Deleting is not deactivating:** deleting frees the identifier, so the same NIF can be
     *   registered again, while `PATCH` with `active: false` leaves the customer where it is with
     *   its NIF still taken.
     *
     * @param string $companyId Unique identifier (UUID) of the company the operation acts on — its identifier, not its NIF. It is the only source of context: the account that owns it is derived from it, and the `BeeL-Active-Company` header plays no part. A company you do not reach answers `403`, and so does a company that does not exist, so the existence of a company in another account is never disclosed.
     * @param array{
     *    "ids": string, //Comma-separated customer IDs
     * } $queryParameters
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \Lenorix\BeelSdk\Generated\Exception\DeleteCompanyCustomersBulkBadRequestException
     * @throws \Lenorix\BeelSdk\Generated\Exception\DeleteCompanyCustomersBulkUnauthorizedException
     * @throws \Lenorix\BeelSdk\Generated\Exception\DeleteCompanyCustomersBulkForbiddenException
     * @throws \Lenorix\BeelSdk\Generated\Exception\DeleteCompanyCustomersBulkTooManyRequestsException
     * @throws \Lenorix\BeelSdk\Generated\Exception\DeleteCompanyCustomersBulkInternalServerErrorException
     *
     * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdCustomersBulkDeleteResponse200|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
     */
    public function deleteCompanyCustomersBulk(string $companyId, array $queryParameters = [], string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\DeleteCompanyCustomersBulk($companyId, $queryParameters), $fetch);
    }
    /**
    * Creates up to 500 customers of this company in a single call.
    *
    * - **Atomic:** if any customer fails validation the whole batch is rejected with `422`
    *   `BULK_VALIDATION_ERROR` and nothing is persisted. This is not a partial operation.
    * - **`dry_run`:** with `dry_run=true` the batch is only validated — tax identifiers against
    *   the AEAT register, duplicates inside the batch and against the existing customers, field
    *   formats — nothing is written and the answer is `200`. With `dry_run=false`, the default,
    *   validation is followed by creation and the answer is `201`.
    * - **Report:** both modes return the same per-record report, so a dry run and a real run are
    *   read the same way.
    *
    * @param string $companyId Unique identifier (UUID) of the company the operation acts on — its identifier, not its NIF. It is the only source of context: the account that owns it is derived from it, and the `BeeL-Active-Company` header plays no part. A company you do not reach answers `403`, and so does a company that does not exist, so the existence of a company in another account is never disclosed.
    * @param \Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdCustomersBulkPostBody $requestBody
    * @param array{
    *    "dry_run"?: bool, //Validate the batch without persisting it (`true`), or validate and create it (`false`,
    the default). Either way the batch is atomic.
    * } $queryParameters
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
    
    * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
    * @throws \Lenorix\BeelSdk\Generated\Exception\CreateCompanyCustomersBulkBadRequestException
    * @throws \Lenorix\BeelSdk\Generated\Exception\CreateCompanyCustomersBulkUnauthorizedException
    * @throws \Lenorix\BeelSdk\Generated\Exception\CreateCompanyCustomersBulkForbiddenException
    * @throws \Lenorix\BeelSdk\Generated\Exception\CreateCompanyCustomersBulkConflictException
    * @throws \Lenorix\BeelSdk\Generated\Exception\CreateCompanyCustomersBulkUnprocessableEntityException
    * @throws \Lenorix\BeelSdk\Generated\Exception\CreateCompanyCustomersBulkTooManyRequestsException
    * @throws \Lenorix\BeelSdk\Generated\Exception\CreateCompanyCustomersBulkInternalServerErrorException
    *
    * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdCustomersBulkPostResponse200|\Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdCustomersBulkPostResponse201|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
    */
    public function createCompanyCustomersBulk(string $companyId, \Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdCustomersBulkPostBody $requestBody, array $queryParameters = [], array $headerParameters = [], string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\CreateCompanyCustomersBulk($companyId, $requestBody, $queryParameters, $headerParameters), $fetch);
    }
    /**
    * Imports customers into this company from an uploaded file.
    *
    * - **`source`:** the origin travels in the body. `csv` is a file following the import
    *   template, limited to 5 MB and 1,000 records; `holded` is an Excel (`.xlsx`) exported from
    *   Holded contacts, limited to 10 MB and 5,000 records. A file over the limit of its `source`
    *   answers `413`.
    * - **This operation writes:** the customers it accepts are created, and a record whose tax
    *   identifier already exists in this company is reported as a duplicate rather than created
    *   again, so re-importing the same file duplicates nothing.
    * - **`Idempotency-Key`:** required on this operation.
    * - **Rehearsal:** to see what would happen without writing anything, use
    *   `POST .../customers/imports/preview`, a separate operation with no effects at all — the
    *   import is never governed by a boolean flag.
    *
    * @param string $companyId Unique identifier (UUID) of the company the operation acts on — its identifier, not its NIF. It is the only source of context: the account that owns it is derived from it, and the `BeeL-Active-Company` header plays no part. A company you do not reach answers `403`, and so does a company that does not exist, so the existence of a company in another account is never disclosed.
    * @param \Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdCustomersImportsPostBody $requestBody
    * @param array{
    *    "Idempotency-Key": string, //Same key as `Idempotency-Key` above, but **required**: the operation writes many rows per
    call, so a retry without a key would import the same file twice. A missing key answers
    `400 IDEMPOTENCY_KEY_REQUIRED`.
    * } $headerParameters
    
    * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
    * @throws \Lenorix\BeelSdk\Generated\Exception\CreateCompanyCustomerImportBadRequestException
    * @throws \Lenorix\BeelSdk\Generated\Exception\CreateCompanyCustomerImportUnauthorizedException
    * @throws \Lenorix\BeelSdk\Generated\Exception\CreateCompanyCustomerImportForbiddenException
    * @throws \Lenorix\BeelSdk\Generated\Exception\CreateCompanyCustomerImportRequestEntityTooLargeException
    * @throws \Lenorix\BeelSdk\Generated\Exception\CreateCompanyCustomerImportUnprocessableEntityException
    * @throws \Lenorix\BeelSdk\Generated\Exception\CreateCompanyCustomerImportTooManyRequestsException
    * @throws \Lenorix\BeelSdk\Generated\Exception\CreateCompanyCustomerImportInternalServerErrorException
    *
    * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdCustomersImportsPostResponse201|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
    */
    public function createCompanyCustomerImport(string $companyId, \Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdCustomersImportsPostBody $requestBody, array $headerParameters = [], string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\CreateCompanyCustomerImport($companyId, $requestBody, $headerParameters), $fetch);
    }
    /**
     * Parses and validates the file without writing anything: no customer is created. It returns
     * the same per-record outcome the import would produce, so the caller can correct the data
     * before importing it with `POST .../customers/imports`.
     *
     * - **`source`:** the origin travels in the body, exactly as in the import.
     *
     * @param string $companyId Unique identifier (UUID) of the company the operation acts on — its identifier, not its NIF. It is the only source of context: the account that owns it is derived from it, and the `BeeL-Active-Company` header plays no part. A company you do not reach answers `403`, and so does a company that does not exist, so the existence of a company in another account is never disclosed.
     * @param \Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdCustomersImportsPreviewPostBody $requestBody
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \Lenorix\BeelSdk\Generated\Exception\PreviewCompanyCustomerImportBadRequestException
     * @throws \Lenorix\BeelSdk\Generated\Exception\PreviewCompanyCustomerImportUnauthorizedException
     * @throws \Lenorix\BeelSdk\Generated\Exception\PreviewCompanyCustomerImportForbiddenException
     * @throws \Lenorix\BeelSdk\Generated\Exception\PreviewCompanyCustomerImportRequestEntityTooLargeException
     * @throws \Lenorix\BeelSdk\Generated\Exception\PreviewCompanyCustomerImportUnprocessableEntityException
     * @throws \Lenorix\BeelSdk\Generated\Exception\PreviewCompanyCustomerImportTooManyRequestsException
     * @throws \Lenorix\BeelSdk\Generated\Exception\PreviewCompanyCustomerImportInternalServerErrorException
     *
     * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdCustomersImportsPreviewPostResponse200|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
     */
    public function previewCompanyCustomerImport(string $companyId, \Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdCustomersImportsPreviewPostBody $requestBody, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\PreviewCompanyCustomerImport($companyId, $requestBody), $fetch);
    }
    /**
     * Deletes a customer of this company that has no invoices.
     *
     * - **What deleting means:** the customer is retained internally for tax record-keeping
     *   purposes, but is no longer exposed by the API: subsequent requests to it return `404`, and
     *   it is never included in the customer list, under any value of the `active` filter.
     * - **Identifier released:** its NIF or alternative identifier is freed, so a new customer may
     *   be created with the same identifier.
     * - **Customers with invoices:** they cannot be deleted and the request answers `409`
     *   `CLIENT_HAS_INVOICES`. To stop using a customer, update it with `active` set to `false`
     *   instead of deleting it.
     *
     * @param string $companyId Unique identifier (UUID) of the company the operation acts on — its identifier, not its NIF. It is the only source of context: the account that owns it is derived from it, and the `BeeL-Active-Company` header plays no part. A company you do not reach answers `403`, and so does a company that does not exist, so the existence of a company in another account is never disclosed.
     * @param string $customerId Customer ID
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \Lenorix\BeelSdk\Generated\Exception\DeleteCompanyCustomerUnauthorizedException
     * @throws \Lenorix\BeelSdk\Generated\Exception\DeleteCompanyCustomerForbiddenException
     * @throws \Lenorix\BeelSdk\Generated\Exception\DeleteCompanyCustomerNotFoundException
     * @throws \Lenorix\BeelSdk\Generated\Exception\DeleteCompanyCustomerConflictException
     * @throws \Lenorix\BeelSdk\Generated\Exception\DeleteCompanyCustomerTooManyRequestsException
     * @throws \Lenorix\BeelSdk\Generated\Exception\DeleteCompanyCustomerInternalServerErrorException
     *
     * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
     */
    public function deleteCompanyCustomer(string $companyId, string $customerId, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\DeleteCompanyCustomer($companyId, $customerId), $fetch);
    }
    /**
     * Retrieves the complete details of a customer of this company.
     * @param string $companyId Unique identifier (UUID) of the company the operation acts on — its identifier, not its NIF. It is the only source of context: the account that owns it is derived from it, and the `BeeL-Active-Company` header plays no part. A company you do not reach answers `403`, and so does a company that does not exist, so the existence of a company in another account is never disclosed.
     * @param string $customerId Customer ID
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetCompanyCustomerBadRequestException
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetCompanyCustomerUnauthorizedException
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetCompanyCustomerForbiddenException
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetCompanyCustomerNotFoundException
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetCompanyCustomerTooManyRequestsException
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetCompanyCustomerInternalServerErrorException
     *
     * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdCustomersCustomerIdGetResponse200|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
     */
    public function getCompanyCustomer(string $companyId, string $customerId, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\GetCompanyCustomer($companyId, $customerId), $fetch);
    }
    /**
     * Updates only the fields present in the body, leaving every other field of the customer as it
     * is.
     *
     * - **Null vs omitted:** a field sent as `null` is cleared, which is different from omitting
     *   it (see `PatchCustomerRequest`).
     * - **AEAT census:** the customer's Spanish tax identifier is only checked against the AEAT
     *   census when the request changes the `nif` or the `legal_name`. Editing anything else —
     *   phone, notes, address, billing emails — never asks the census, so a customer stored long
     *   ago stays editable even if its NIF is no longer listed.
     *   For a **legal entity** the census checks the CIF only and its `legal_name` is not
     *   verified, so the name never causes the rejection; only a **natural person**'s NIF is
     *   crossed with the name.
     *   Duplicate and format checks run on every update.
     * - **Only update verb:** this is the canonical way to edit a customer. There is no `PUT` of
     *   full replacement under the company, which would clear the fields you omit.
     *
     * @param string $companyId Unique identifier (UUID) of the company the operation acts on — its identifier, not its NIF. It is the only source of context: the account that owns it is derived from it, and the `BeeL-Active-Company` header plays no part. A company you do not reach answers `403`, and so does a company that does not exist, so the existence of a company in another account is never disclosed.
     * @param string $customerId Customer ID
     * @param \Lenorix\BeelSdk\Generated\Model\PatchCustomerRequest $requestBody
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \Lenorix\BeelSdk\Generated\Exception\PatchCompanyCustomerBadRequestException
     * @throws \Lenorix\BeelSdk\Generated\Exception\PatchCompanyCustomerUnauthorizedException
     * @throws \Lenorix\BeelSdk\Generated\Exception\PatchCompanyCustomerForbiddenException
     * @throws \Lenorix\BeelSdk\Generated\Exception\PatchCompanyCustomerNotFoundException
     * @throws \Lenorix\BeelSdk\Generated\Exception\PatchCompanyCustomerConflictException
     * @throws \Lenorix\BeelSdk\Generated\Exception\PatchCompanyCustomerUnprocessableEntityException
     * @throws \Lenorix\BeelSdk\Generated\Exception\PatchCompanyCustomerTooManyRequestsException
     * @throws \Lenorix\BeelSdk\Generated\Exception\PatchCompanyCustomerInternalServerErrorException
     *
     * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdCustomersCustomerIdPatchResponse200|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
     */
    public function patchCompanyCustomer(string $companyId, string $customerId, \Lenorix\BeelSdk\Generated\Model\PatchCustomerRequest $requestBody, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\PatchCompanyCustomer($companyId, $customerId, $requestBody), $fetch);
    }
    /**
     * Downloads a sample CSV for customer import: the required headers plus example rows, written
     * with a UTF-8 byte order mark so that Excel opens it with the accents intact.
     *
     * - **Deprecated:** use `GET /v1/templates/customer-import`, which returns the same file.
     *   Reading a fixed template is not a `POST`, and the template belongs to no customer.
     * - **Retirement:** the response announces the retirement date in its `Sunset` header.
     *
     * **Retires on 9 December 2026.** See the [migration guide](https://docs.beel.es/changelog/resources-under-the-nif) for what moved where and what changes when you switch.
     *
     * @param array $accept Accept content header text/csv|application/json
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \Lenorix\BeelSdk\Generated\Exception\DownloadCustomerTemplateCsvUnauthorizedException
     * @throws \Lenorix\BeelSdk\Generated\Exception\DownloadCustomerTemplateCsvForbiddenException
     * @throws \Lenorix\BeelSdk\Generated\Exception\DownloadCustomerTemplateCsvTooManyRequestsException
     * @throws \Lenorix\BeelSdk\Generated\Exception\DownloadCustomerTemplateCsvInternalServerErrorException
     *
     * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
     */
    public function downloadCustomerTemplateCsv(string $fetch = self::FETCH_OBJECT, array $accept = [])
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\DownloadCustomerTemplateCsv($accept), $fetch);
    }
    /**
     * Downloads the sample CSV that `POST /v1/customers/import-csv-preview` expects: the required
     * headers plus example rows, separated by semicolons and written with a UTF-8 byte order mark
     * so that Excel opens it with the accents intact.
     *
     * - **Example rows:** every one is importable as it stands — commas, quotes and accents
     *   included — so the template can be uploaded unchanged as a first test of the import.
     * - **Scope:** the file is the same for every credential and does not depend on any account
     *   or on any NIF.
     *
     * @param array $accept Accept content header text/csv|application/json
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \Lenorix\BeelSdk\Generated\Exception\DownloadCustomerImportTemplateUnauthorizedException
     * @throws \Lenorix\BeelSdk\Generated\Exception\DownloadCustomerImportTemplateForbiddenException
     * @throws \Lenorix\BeelSdk\Generated\Exception\DownloadCustomerImportTemplateTooManyRequestsException
     * @throws \Lenorix\BeelSdk\Generated\Exception\DownloadCustomerImportTemplateInternalServerErrorException
     *
     * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
     */
    public function downloadCustomerImportTemplate(string $fetch = self::FETCH_OBJECT, array $accept = [])
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\DownloadCustomerImportTemplate($accept), $fetch);
    }
    /**
     * Downloads the sample CSV that `POST /v1/accounts/imports` expects: the required headers plus
     * one example row, separated by semicolons and written with a UTF-8 byte order mark so that
     * Excel opens it with the accents intact — the same conventions as
     * `GET /v1/templates/customer-import`.
     *
     * - **The example row is deliberately not importable:** its tax id has a valid shape and an
     *   impossible check digit, so it is rejected instead of silently provisioning an account.
     *   Replace it with your own rows.
     * - **`customers_file`:** the optional second file of that import is **not** a new format; it
     *   is the customer import template, unchanged. Download it from
     *   `GET /v1/templates/customer-import`.
     * - **Scope:** the file is the same for every credential and does not depend on any account
     *   or on any NIF.
     *
     * @param array $accept Accept content header text/csv|application/json
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \Lenorix\BeelSdk\Generated\Exception\DownloadAccountImportTemplateUnauthorizedException
     * @throws \Lenorix\BeelSdk\Generated\Exception\DownloadAccountImportTemplateForbiddenException
     * @throws \Lenorix\BeelSdk\Generated\Exception\DownloadAccountImportTemplateTooManyRequestsException
     * @throws \Lenorix\BeelSdk\Generated\Exception\DownloadAccountImportTemplateInternalServerErrorException
     *
     * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
     */
    public function downloadAccountImportTemplate(string $fetch = self::FETCH_OBJECT, array $accept = [])
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\DownloadAccountImportTemplate($accept), $fetch);
    }
    /**
     * Returns a paginated list of products and services, with optional filters.
     *
     * - **Deprecated:** use `GET /v1/companies/{company_id}/products`, which returns the same
     *   list. The free-text filter is named `q` there, not `search`.
     *
     * **Retires on 9 December 2026.** See the [migration guide](https://docs.beel.es/changelog/resources-under-the-nif) for what moved where and what changes when you switch.
     *
     * @param array{
     *    "page"?: int, //Page number, starting at 1. The response echoes it back as `pagination.current_page`.
     *    "limit"?: int, //How many items to return per page. The response echoes it back as `pagination.items_per_page`.
     *    "category"?: string, //Filter by product category
     *    "active"?: bool, //Filter by active/inactive status
     *    "search"?: string, //Global search by name, code or description
     *    "name"?: string, //Filter by name (partial search case-insensitive)
     *    "code"?: string, //Filter by code (partial search)
     *    "min_price"?: int, //Minimum price
     *    "max_price"?: int, //Maximum price
     *    "sort_by"?: string, //Field to sort by
     *    "sort_order"?: string, //Sort order direction
     * } $queryParameters
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \Lenorix\BeelSdk\Generated\Exception\ListProductsUnauthorizedException
     * @throws \Lenorix\BeelSdk\Generated\Exception\ListProductsForbiddenException
     * @throws \Lenorix\BeelSdk\Generated\Exception\ListProductsUnprocessableEntityException
     * @throws \Lenorix\BeelSdk\Generated\Exception\ListProductsInternalServerErrorException
     *
     * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\V1ProductsGetResponse200|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
     */
    public function listProducts(array $queryParameters = [], string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\ListProducts($queryParameters), $fetch);
    }
    /**
    * Creates a new product or service in the catalog.
    *
    * - **Deprecated:** use `POST /v1/companies/{company_id}/products`, which behaves
    *   identically.
    *
    * **Retires on 9 December 2026.** See the [migration guide](https://docs.beel.es/changelog/resources-under-the-nif) for what moved where and what changes when you switch.
    *
    * @param \Lenorix\BeelSdk\Generated\Model\CreateProductRequest $requestBody
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
    
    * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
    * @throws \Lenorix\BeelSdk\Generated\Exception\CreateProductBadRequestException
    * @throws \Lenorix\BeelSdk\Generated\Exception\CreateProductUnauthorizedException
    * @throws \Lenorix\BeelSdk\Generated\Exception\CreateProductForbiddenException
    * @throws \Lenorix\BeelSdk\Generated\Exception\CreateProductConflictException
    * @throws \Lenorix\BeelSdk\Generated\Exception\CreateProductUnprocessableEntityException
    * @throws \Lenorix\BeelSdk\Generated\Exception\CreateProductInternalServerErrorException
    *
    * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\V1ProductsPostResponse201|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
    */
    public function createProduct(\Lenorix\BeelSdk\Generated\Model\CreateProductRequest $requestBody, array $headerParameters = [], string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\CreateProduct($requestBody, $headerParameters), $fetch);
    }
    /**
     * Deletes a product from the catalog.
     *
     * - **Deprecated:** use `DELETE /v1/companies/{company_id}/products/{product_id}`, which
     *   behaves identically.
     *
     * **Retires on 9 December 2026.** See the [migration guide](https://docs.beel.es/changelog/resources-under-the-nif) for what moved where and what changes when you switch.
     *
     * @param string $productId Product unique UUID
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \Lenorix\BeelSdk\Generated\Exception\DeleteProductUnauthorizedException
     * @throws \Lenorix\BeelSdk\Generated\Exception\DeleteProductForbiddenException
     * @throws \Lenorix\BeelSdk\Generated\Exception\DeleteProductNotFoundException
     * @throws \Lenorix\BeelSdk\Generated\Exception\DeleteProductInternalServerErrorException
     *
     * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
     */
    public function deleteProduct(string $productId, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\DeleteProduct($productId), $fetch);
    }
    /**
     * Retrieves the details of a product.
     *
     * - **Deprecated:** use `GET /v1/companies/{company_id}/products/{product_id}`, which behaves
     *   identically.
     *
     * **Retires on 9 December 2026.** See the [migration guide](https://docs.beel.es/changelog/resources-under-the-nif) for what moved where and what changes when you switch.
     *
     * @param string $productId Product unique UUID
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetProductBadRequestException
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetProductUnauthorizedException
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetProductForbiddenException
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetProductNotFoundException
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetProductInternalServerErrorException
     *
     * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\V1ProductsProductIdGetResponse200|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
     */
    public function getProduct(string $productId, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\GetProduct($productId), $fetch);
    }
    /**
     * Updates only the fields present in the body, leaving every other field of the product as it
     * is — in particular `main_tax`, `irpf_rate` and `equivalence_surcharge_rate`, which `PUT`
     * resets.
     *
     * - **Null vs omitted:** a field sent as `null` is cleared, which is different from omitting
     *   it (see `PatchProductRequest`). The result goes through the same validation as `PUT`.
     * - **Deprecated:** use `PATCH /v1/companies/{company_id}/products/{product_id}`, which
     *   behaves identically.
     *
     * **Retires on 9 December 2026.** See the [migration guide](https://docs.beel.es/changelog/resources-under-the-nif) for what moved where and what changes when you switch.
     *
     * @param string $productId Product unique UUID
     * @param \Lenorix\BeelSdk\Generated\Model\PatchProductRequest $requestBody
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \Lenorix\BeelSdk\Generated\Exception\PatchProductBadRequestException
     * @throws \Lenorix\BeelSdk\Generated\Exception\PatchProductUnauthorizedException
     * @throws \Lenorix\BeelSdk\Generated\Exception\PatchProductForbiddenException
     * @throws \Lenorix\BeelSdk\Generated\Exception\PatchProductNotFoundException
     * @throws \Lenorix\BeelSdk\Generated\Exception\PatchProductConflictException
     * @throws \Lenorix\BeelSdk\Generated\Exception\PatchProductUnprocessableEntityException
     * @throws \Lenorix\BeelSdk\Generated\Exception\PatchProductInternalServerErrorException
     *
     * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\V1ProductsProductIdPatchResponse200|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
     */
    public function patchProduct(string $productId, \Lenorix\BeelSdk\Generated\Model\PatchProductRequest $requestBody, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\PatchProduct($productId, $requestBody), $fetch);
    }
    /**
     * Replaces an existing product with the body you send.
     *
     * - **Not a partial update:** leaving out `main_tax`, `equivalence_surcharge_rate` or
     *   `irpf_rate` resets them to the creation defaults (IVA 21%, 0% and 0%), so send the product
     *   complete. To change only some fields, use
     *   `PATCH /v1/companies/{company_id}/products/{product_id}`.
     * - **Deprecated:** this route will be retired on the date announced in its `Sunset` response
     *   header. The canonical form has a single update verb,
     *   `PATCH /v1/companies/{company_id}/products/{product_id}`, which is not a drop-in
     *   replacement for this one: it changes only the fields present in the body and resets
     *   nothing on its own. To reproduce a total replacement, send every field and pass `null` in
     *   the ones you want cleared.
     *
     * **Retires on 9 December 2026.** See the [migration guide](https://docs.beel.es/changelog/resources-under-the-nif) for what moved where and what changes when you switch.
     *
     * @param string $productId Product unique UUID
     * @param \Lenorix\BeelSdk\Generated\Model\UpdateProductRequest $requestBody
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \Lenorix\BeelSdk\Generated\Exception\UpdateProductBadRequestException
     * @throws \Lenorix\BeelSdk\Generated\Exception\UpdateProductUnauthorizedException
     * @throws \Lenorix\BeelSdk\Generated\Exception\UpdateProductForbiddenException
     * @throws \Lenorix\BeelSdk\Generated\Exception\UpdateProductNotFoundException
     * @throws \Lenorix\BeelSdk\Generated\Exception\UpdateProductConflictException
     * @throws \Lenorix\BeelSdk\Generated\Exception\UpdateProductUnprocessableEntityException
     * @throws \Lenorix\BeelSdk\Generated\Exception\UpdateProductInternalServerErrorException
     *
     * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\V1ProductsProductIdPutResponse200|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
     */
    public function updateProduct(string $productId, \Lenorix\BeelSdk\Generated\Model\UpdateProductRequest $requestBody, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\UpdateProduct($productId, $requestBody), $fetch);
    }
    /**
    * Searches the active products by name or code and returns at most 20 of them, for
    * autocomplete.
    *
    * - **Deprecated — withdrawn, not moved:** its replacement is
    *   `GET /v1/companies/{company_id}/products?q=`, which searches the name, the code **and**
    *   the description, so it returns at least everything this endpoint returned.
    * - **Response shape:** it differs, and that is why this notice exists. Here `data` is a plain
    *   array of products, limited to 20 active ones, while there `data` is the paginated envelope
    *   of the list (`data.products` + `data.pagination`). Change the way you read the response
    *   when you migrate.
    *
    * **Retires on 9 December 2026.** See the [migration guide](https://docs.beel.es/changelog/resources-under-the-nif) for what moved where and what changes when you switch.
    *
    * @param array{
    *    "search"?: string, //Search term (empty to get recent products).
    
    This parameter was previously named `q`. The old name is still accepted for backwards
    compatibility (see `q` below) and will be withdrawn in a future major version — send
    `search`.
    *    "q"?: string, //**Deprecated** — former name of `search`, still honoured so existing integrations keep
    working. Ignored when `search` is also present. Use `search`.
    *    "limit"?: int, //Result limit (max 20)
    * } $queryParameters
    
    * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
    * @throws \Lenorix\BeelSdk\Generated\Exception\SearchProductsBadRequestException
    * @throws \Lenorix\BeelSdk\Generated\Exception\SearchProductsUnauthorizedException
    * @throws \Lenorix\BeelSdk\Generated\Exception\SearchProductsForbiddenException
    * @throws \Lenorix\BeelSdk\Generated\Exception\SearchProductsUnprocessableEntityException
    * @throws \Lenorix\BeelSdk\Generated\Exception\SearchProductsInternalServerErrorException
    *
    * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\V1ProductsSearchGetResponse200|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
    */
    public function searchProducts(array $queryParameters = [], string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\SearchProducts($queryParameters), $fetch);
    }
    /**
     * Deletes up to 100 products of the catalog, listed in `product_ids`.
     *
     * - **Partial operation:** the response reports which products were deleted
     *   (`deleted_products`) and which failed (`errors`, one entry per product with its
     *   `product_id`), with the counts in `summary`. That is why it answers `200` with a body
     *   instead of `204`.
     * - **Deprecated:** use `DELETE /v1/companies/{company_id}/products/bulk`, which deletes the
     *   same way but takes the IDs in the `ids` query parameter instead of in the request body: a
     *   `DELETE` body has no defined semantics and intermediaries may drop it.
     *
     * **Retires on 9 December 2026.** See the [migration guide](https://docs.beel.es/changelog/resources-under-the-nif) for what moved where and what changes when you switch.
     *
     * @param \Lenorix\BeelSdk\Generated\Model\V1ProductsBulkDeleteBody $requestBody
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \Lenorix\BeelSdk\Generated\Exception\DeleteProductsBulkBadRequestException
     * @throws \Lenorix\BeelSdk\Generated\Exception\DeleteProductsBulkUnauthorizedException
     * @throws \Lenorix\BeelSdk\Generated\Exception\DeleteProductsBulkForbiddenException
     * @throws \Lenorix\BeelSdk\Generated\Exception\DeleteProductsBulkRequestEntityTooLargeException
     * @throws \Lenorix\BeelSdk\Generated\Exception\DeleteProductsBulkUnprocessableEntityException
     * @throws \Lenorix\BeelSdk\Generated\Exception\DeleteProductsBulkInternalServerErrorException
     *
     * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\V1ProductsBulkDeleteResponse200|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
     */
    public function deleteProductsBulk(\Lenorix\BeelSdk\Generated\Model\V1ProductsBulkDeleteBody $requestBody, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\DeleteProductsBulk($requestBody), $fetch);
    }
    /**
    * Creates up to 100 products in one call.
    *
    * - **Partial operation:** each product is processed and reported independently, so a row the
    *   domain rejects — a rate the law does not allow, a duplicate code — comes back inside the
    *   report while the rest are created.
    * - **Status code:** always `201` when the batch was processed, even if not a single product
    *   could be created. A malformed request — a missing field, an empty array, more than 100
    *   items — answers `422` instead and nothing is processed.
    * - **Deprecated:** use `POST /v1/companies/{company_id}/products/bulk`, which behaves
    *   identically.
    *
    * **Retires on 9 December 2026.** See the [migration guide](https://docs.beel.es/changelog/resources-under-the-nif) for what moved where and what changes when you switch.
    *
    * @param \Lenorix\BeelSdk\Generated\Model\V1ProductsBulkPostBody $requestBody
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
    
    * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
    * @throws \Lenorix\BeelSdk\Generated\Exception\CreateProductsBulkBadRequestException
    * @throws \Lenorix\BeelSdk\Generated\Exception\CreateProductsBulkUnauthorizedException
    * @throws \Lenorix\BeelSdk\Generated\Exception\CreateProductsBulkForbiddenException
    * @throws \Lenorix\BeelSdk\Generated\Exception\CreateProductsBulkRequestEntityTooLargeException
    * @throws \Lenorix\BeelSdk\Generated\Exception\CreateProductsBulkUnprocessableEntityException
    * @throws \Lenorix\BeelSdk\Generated\Exception\CreateProductsBulkInternalServerErrorException
    *
    * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\V1ProductsBulkPostResponse201|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
    */
    public function createProductsBulk(\Lenorix\BeelSdk\Generated\Model\V1ProductsBulkPostBody $requestBody, array $headerParameters = [], string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\CreateProductsBulk($requestBody, $headerParameters), $fetch);
    }
    /**
     * Returns a paginated list of the products/services of this company, with optional
     * filters.
     *
     * - **`q`:** searching is done on this collection, there is no separate search path. `q`
     *   matches the name, the code and the description, so it returns at least everything the
     *   withdrawn `GET /v1/products/search` returned, in the paginated envelope of this list.
     *
     * @param string $companyId Unique identifier (UUID) of the company the operation acts on — its identifier, not its NIF. It is the only source of context: the account that owns it is derived from it, and the `BeeL-Active-Company` header plays no part. A company you do not reach answers `403`, and so does a company that does not exist, so the existence of a company in another account is never disclosed.
     * @param array{
     *    "page"?: int, //Page number, starting at 1. The response echoes it back as `pagination.current_page`.
     *    "limit"?: int, //How many items to return per page. The response echoes it back as `pagination.items_per_page`.
     *    "q"?: string, //Search by name, code or description
     *    "category"?: string, //Filter by product category
     *    "active"?: bool, //Filter by active/inactive status
     *    "name"?: string, //Filter by name (partial search case-insensitive)
     *    "code"?: string, //Filter by code (partial search)
     *    "min_price"?: int, //Minimum price
     *    "max_price"?: int, //Maximum price
     *    "sort_by"?: string, //Field to sort by
     *    "sort_order"?: string, //Sort order direction
     * } $queryParameters
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \Lenorix\BeelSdk\Generated\Exception\ListCompanyProductsBadRequestException
     * @throws \Lenorix\BeelSdk\Generated\Exception\ListCompanyProductsUnauthorizedException
     * @throws \Lenorix\BeelSdk\Generated\Exception\ListCompanyProductsForbiddenException
     * @throws \Lenorix\BeelSdk\Generated\Exception\ListCompanyProductsUnprocessableEntityException
     * @throws \Lenorix\BeelSdk\Generated\Exception\ListCompanyProductsTooManyRequestsException
     * @throws \Lenorix\BeelSdk\Generated\Exception\ListCompanyProductsInternalServerErrorException
     *
     * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdProductsGetResponse200|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
     */
    public function listCompanyProducts(string $companyId, array $queryParameters = [], string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\ListCompanyProducts($companyId, $queryParameters), $fetch);
    }
    /**
    * Creates a new product or service in the catalog of this company.
    * @param string $companyId Unique identifier (UUID) of the company the operation acts on — its identifier, not its NIF. It is the only source of context: the account that owns it is derived from it, and the `BeeL-Active-Company` header plays no part. A company you do not reach answers `403`, and so does a company that does not exist, so the existence of a company in another account is never disclosed.
    * @param \Lenorix\BeelSdk\Generated\Model\CreateProductRequest $requestBody
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
    
    * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
    * @throws \Lenorix\BeelSdk\Generated\Exception\CreateCompanyProductBadRequestException
    * @throws \Lenorix\BeelSdk\Generated\Exception\CreateCompanyProductUnauthorizedException
    * @throws \Lenorix\BeelSdk\Generated\Exception\CreateCompanyProductForbiddenException
    * @throws \Lenorix\BeelSdk\Generated\Exception\CreateCompanyProductConflictException
    * @throws \Lenorix\BeelSdk\Generated\Exception\CreateCompanyProductUnprocessableEntityException
    * @throws \Lenorix\BeelSdk\Generated\Exception\CreateCompanyProductTooManyRequestsException
    * @throws \Lenorix\BeelSdk\Generated\Exception\CreateCompanyProductInternalServerErrorException
    *
    * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdProductsPostResponse201|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
    */
    public function createCompanyProduct(string $companyId, \Lenorix\BeelSdk\Generated\Model\CreateProductRequest $requestBody, array $headerParameters = [], string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\CreateCompanyProduct($companyId, $requestBody, $headerParameters), $fetch);
    }
    /**
     * Deletes the products listed in `ids` from the catalog of this company, up to 100 IDs
     * per request; send several requests for more.
     *
     * - **Partial operation:** the response reports which products were deleted
     *   (`deleted_products`) and which failed (`errors`, one entry per product with its
     *   `product_id`), with the counts in `summary`. That is why it answers `200` with a body
     *   instead of `204`.
     *
     * @param string $companyId Unique identifier (UUID) of the company the operation acts on — its identifier, not its NIF. It is the only source of context: the account that owns it is derived from it, and the `BeeL-Active-Company` header plays no part. A company you do not reach answers `403`, and so does a company that does not exist, so the existence of a company in another account is never disclosed.
     * @param array{
     *    "ids": string, //Comma-separated product IDs (max 100 per request)
     * } $queryParameters
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \Lenorix\BeelSdk\Generated\Exception\DeleteCompanyProductsBulkBadRequestException
     * @throws \Lenorix\BeelSdk\Generated\Exception\DeleteCompanyProductsBulkUnauthorizedException
     * @throws \Lenorix\BeelSdk\Generated\Exception\DeleteCompanyProductsBulkForbiddenException
     * @throws \Lenorix\BeelSdk\Generated\Exception\DeleteCompanyProductsBulkRequestEntityTooLargeException
     * @throws \Lenorix\BeelSdk\Generated\Exception\DeleteCompanyProductsBulkTooManyRequestsException
     * @throws \Lenorix\BeelSdk\Generated\Exception\DeleteCompanyProductsBulkInternalServerErrorException
     *
     * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdProductsBulkDeleteResponse200|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
     */
    public function deleteCompanyProductsBulk(string $companyId, array $queryParameters = [], string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\DeleteCompanyProductsBulk($companyId, $queryParameters), $fetch);
    }
    /**
    * Creates up to 100 products in the catalog of this company.
    *
    * - **Partial operation:** each product is processed and reported independently, so a row the
    *   domain rejects — a rate the law does not allow, a duplicate code — comes back inside the
    *   report while the rest are created.
    * - **Status code:** always `201` when the batch was processed, even if not a single product
    *   could be created. A malformed request — a missing field, an empty array, more than 100
    *   items — answers `422` instead and nothing is processed.
    *
    * @param string $companyId Unique identifier (UUID) of the company the operation acts on — its identifier, not its NIF. It is the only source of context: the account that owns it is derived from it, and the `BeeL-Active-Company` header plays no part. A company you do not reach answers `403`, and so does a company that does not exist, so the existence of a company in another account is never disclosed.
    * @param \Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdProductsBulkPostBody $requestBody
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
    
    * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
    * @throws \Lenorix\BeelSdk\Generated\Exception\CreateCompanyProductsBulkBadRequestException
    * @throws \Lenorix\BeelSdk\Generated\Exception\CreateCompanyProductsBulkUnauthorizedException
    * @throws \Lenorix\BeelSdk\Generated\Exception\CreateCompanyProductsBulkForbiddenException
    * @throws \Lenorix\BeelSdk\Generated\Exception\CreateCompanyProductsBulkRequestEntityTooLargeException
    * @throws \Lenorix\BeelSdk\Generated\Exception\CreateCompanyProductsBulkUnprocessableEntityException
    * @throws \Lenorix\BeelSdk\Generated\Exception\CreateCompanyProductsBulkTooManyRequestsException
    * @throws \Lenorix\BeelSdk\Generated\Exception\CreateCompanyProductsBulkInternalServerErrorException
    *
    * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdProductsBulkPostResponse201|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
    */
    public function createCompanyProductsBulk(string $companyId, \Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdProductsBulkPostBody $requestBody, array $headerParameters = [], string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\CreateCompanyProductsBulk($companyId, $requestBody, $headerParameters), $fetch);
    }
    /**
     * Deletes a product from the catalog of this company.
     * @param string $companyId Unique identifier (UUID) of the company the operation acts on — its identifier, not its NIF. It is the only source of context: the account that owns it is derived from it, and the `BeeL-Active-Company` header plays no part. A company you do not reach answers `403`, and so does a company that does not exist, so the existence of a company in another account is never disclosed.
     * @param string $productId Product unique UUID
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \Lenorix\BeelSdk\Generated\Exception\DeleteCompanyProductUnauthorizedException
     * @throws \Lenorix\BeelSdk\Generated\Exception\DeleteCompanyProductForbiddenException
     * @throws \Lenorix\BeelSdk\Generated\Exception\DeleteCompanyProductNotFoundException
     * @throws \Lenorix\BeelSdk\Generated\Exception\DeleteCompanyProductTooManyRequestsException
     * @throws \Lenorix\BeelSdk\Generated\Exception\DeleteCompanyProductInternalServerErrorException
     *
     * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
     */
    public function deleteCompanyProduct(string $companyId, string $productId, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\DeleteCompanyProduct($companyId, $productId), $fetch);
    }
    /**
     * Retrieves the details of a product of this company.
     * @param string $companyId Unique identifier (UUID) of the company the operation acts on — its identifier, not its NIF. It is the only source of context: the account that owns it is derived from it, and the `BeeL-Active-Company` header plays no part. A company you do not reach answers `403`, and so does a company that does not exist, so the existence of a company in another account is never disclosed.
     * @param string $productId Product unique UUID
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetCompanyProductBadRequestException
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetCompanyProductUnauthorizedException
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetCompanyProductForbiddenException
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetCompanyProductNotFoundException
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetCompanyProductTooManyRequestsException
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetCompanyProductInternalServerErrorException
     *
     * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdProductsProductIdGetResponse200|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
     */
    public function getCompanyProduct(string $companyId, string $productId, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\GetCompanyProduct($companyId, $productId), $fetch);
    }
    /**
     * Updates only the fields present in the body, leaving every other field of the product as it
     * is — in particular `main_tax`, `irpf_rate` and `equivalence_surcharge_rate`.
     *
     * - **Null vs omitted:** a field sent as `null` is cleared, which is different from omitting
     *   it (see `PatchProductRequest`).
     * - **Only update verb:** the total replacement `PUT /v1/products/{product_id}`, which reset
     *   the omitted fields to their creation defaults, is not carried over to the canonical
     *   form.
     *
     * @param string $companyId Unique identifier (UUID) of the company the operation acts on — its identifier, not its NIF. It is the only source of context: the account that owns it is derived from it, and the `BeeL-Active-Company` header plays no part. A company you do not reach answers `403`, and so does a company that does not exist, so the existence of a company in another account is never disclosed.
     * @param string $productId Product unique UUID
     * @param \Lenorix\BeelSdk\Generated\Model\PatchProductRequest $requestBody
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \Lenorix\BeelSdk\Generated\Exception\PatchCompanyProductBadRequestException
     * @throws \Lenorix\BeelSdk\Generated\Exception\PatchCompanyProductUnauthorizedException
     * @throws \Lenorix\BeelSdk\Generated\Exception\PatchCompanyProductForbiddenException
     * @throws \Lenorix\BeelSdk\Generated\Exception\PatchCompanyProductNotFoundException
     * @throws \Lenorix\BeelSdk\Generated\Exception\PatchCompanyProductConflictException
     * @throws \Lenorix\BeelSdk\Generated\Exception\PatchCompanyProductUnprocessableEntityException
     * @throws \Lenorix\BeelSdk\Generated\Exception\PatchCompanyProductTooManyRequestsException
     * @throws \Lenorix\BeelSdk\Generated\Exception\PatchCompanyProductInternalServerErrorException
     *
     * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdProductsProductIdPatchResponse200|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
     */
    public function patchCompanyProduct(string $companyId, string $productId, \Lenorix\BeelSdk\Generated\Model\PatchProductRequest $requestBody, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\PatchCompanyProduct($companyId, $productId, $requestBody), $fetch);
    }
    /**
     * Lists the people with access to the account, each with their `account_role` and, for
     * `MEMBER`s, the companies (NIFs) granted to them.
     *
     * **Paginated** with the usual `page`/`limit`, and the usual defaults: without them you get
     * the first 20 members, not all of them. Read `data.pagination` to walk the rest.
     *
     * @param string $accountId Your own account, or an account you provisioned. It — not the credential — decides which account the operation acts on; a `403` is returned when you do not reach it, the same response an account that does not exist gets.
     * @param array{
     *    "page"?: int, //Page number, starting at 1. The response echoes it back as `pagination.current_page`.
     *    "limit"?: int, //How many items to return per page. The response echoes it back as `pagination.items_per_page`.
     * } $queryParameters
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \Lenorix\BeelSdk\Generated\Exception\ListAccountMembersBadRequestException
     * @throws \Lenorix\BeelSdk\Generated\Exception\ListAccountMembersUnauthorizedException
     * @throws \Lenorix\BeelSdk\Generated\Exception\ListAccountMembersForbiddenException
     * @throws \Lenorix\BeelSdk\Generated\Exception\ListAccountMembersTooManyRequestsException
     * @throws \Lenorix\BeelSdk\Generated\Exception\ListAccountMembersInternalServerErrorException
     *
     * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\V1AccountsAccountIdMembersGetResponse200|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
     */
    public function listAccountMembers(string $accountId, array $queryParameters = [], string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\ListAccountMembers($accountId, $queryParameters), $fetch);
    }
    /**
     * Removes a member's access to the account. The account's last `OWNER` cannot be removed.
     * @param string $accountId Your own account, or an account you provisioned. It — not the credential — decides which account the operation acts on; a `403` is returned when you do not reach it, the same response an account that does not exist gets.
     * @param string $memberId Membership unique UUID.
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \Lenorix\BeelSdk\Generated\Exception\DeleteAccountMemberBadRequestException
     * @throws \Lenorix\BeelSdk\Generated\Exception\DeleteAccountMemberUnauthorizedException
     * @throws \Lenorix\BeelSdk\Generated\Exception\DeleteAccountMemberForbiddenException
     * @throws \Lenorix\BeelSdk\Generated\Exception\DeleteAccountMemberNotFoundException
     * @throws \Lenorix\BeelSdk\Generated\Exception\DeleteAccountMemberTooManyRequestsException
     * @throws \Lenorix\BeelSdk\Generated\Exception\DeleteAccountMemberInternalServerErrorException
     *
     * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
     */
    public function deleteAccountMember(string $accountId, string $memberId, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\DeleteAccountMember($accountId, $memberId), $fetch);
    }
    /**
     * Returns one member of the account, with the same shape the list returns.
     * @param string $accountId Your own account, or an account you provisioned. It — not the credential — decides which account the operation acts on; a `403` is returned when you do not reach it, the same response an account that does not exist gets.
     * @param string $memberId Membership unique UUID.
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetAccountMemberBadRequestException
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetAccountMemberUnauthorizedException
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetAccountMemberForbiddenException
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetAccountMemberNotFoundException
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetAccountMemberTooManyRequestsException
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetAccountMemberInternalServerErrorException
     *
     * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\V1AccountsAccountIdMembersMemberIdGetResponse200|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
     */
    public function getAccountMember(string $accountId, string $memberId, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\GetAccountMember($accountId, $memberId), $fetch);
    }
    /**
     * Changes a member's `account_role` between `ADMIN` and `MEMBER`.
     *
     * - **`OWNER`:** not an assignable value here. An account has exactly one owner, and
     *   ownership is handed over only through `PUT /v1/accounts/{account_id}/owner`, which
     *   promotes the new owner and steps the current one down in the same operation.
     * - **Last owner:** the account's last `OWNER` cannot be demoted.
     *
     * @param string $accountId Your own account, or an account you provisioned. It — not the credential — decides which account the operation acts on; a `403` is returned when you do not reach it, the same response an account that does not exist gets.
     * @param string $memberId Membership unique UUID.
     * @param \Lenorix\BeelSdk\Generated\Model\ChangeMemberRoleRequest $requestBody
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \Lenorix\BeelSdk\Generated\Exception\PatchAccountMemberBadRequestException
     * @throws \Lenorix\BeelSdk\Generated\Exception\PatchAccountMemberUnauthorizedException
     * @throws \Lenorix\BeelSdk\Generated\Exception\PatchAccountMemberForbiddenException
     * @throws \Lenorix\BeelSdk\Generated\Exception\PatchAccountMemberNotFoundException
     * @throws \Lenorix\BeelSdk\Generated\Exception\PatchAccountMemberUnprocessableEntityException
     * @throws \Lenorix\BeelSdk\Generated\Exception\PatchAccountMemberTooManyRequestsException
     * @throws \Lenorix\BeelSdk\Generated\Exception\PatchAccountMemberInternalServerErrorException
     *
     * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\V1AccountsAccountIdMembersMemberIdPatchResponse200|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
     */
    public function patchAccountMember(string $accountId, string $memberId, \Lenorix\BeelSdk\Generated\Model\ChangeMemberRoleRequest $requestBody, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\PatchAccountMember($accountId, $memberId, $requestBody), $fetch);
    }
    /**
     * Lists the companies (NIFs) granted to a `MEMBER` and the `access_level` of each. Empty for
     * `OWNER` and `ADMIN`, who reach every company of the account implicitly and hold no grants.
     *
     * **Paginated** with the usual `page`/`limit`, and the usual defaults: without them you get
     * the first 20 grants, not all of them. Read `data.pagination` to walk the rest.
     *
     * @param string $accountId Your own account, or an account you provisioned. It — not the credential — decides which account the operation acts on; a `403` is returned when you do not reach it, the same response an account that does not exist gets.
     * @param string $memberId Membership unique UUID.
     * @param array{
     *    "page"?: int, //Page number, starting at 1. The response echoes it back as `pagination.current_page`.
     *    "limit"?: int, //How many items to return per page. The response echoes it back as `pagination.items_per_page`.
     * } $queryParameters
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \Lenorix\BeelSdk\Generated\Exception\ListAccountMemberGrantsUnauthorizedException
     * @throws \Lenorix\BeelSdk\Generated\Exception\ListAccountMemberGrantsForbiddenException
     * @throws \Lenorix\BeelSdk\Generated\Exception\ListAccountMemberGrantsNotFoundException
     * @throws \Lenorix\BeelSdk\Generated\Exception\ListAccountMemberGrantsTooManyRequestsException
     * @throws \Lenorix\BeelSdk\Generated\Exception\ListAccountMemberGrantsInternalServerErrorException
     *
     * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\V1AccountsAccountIdMembersMemberIdGrantsGetResponse200|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
     */
    public function listAccountMemberGrants(string $accountId, string $memberId, array $queryParameters = [], string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\ListAccountMemberGrants($accountId, $memberId, $queryParameters), $fetch);
    }
    /**
     * Revokes a `MEMBER`'s access to one company. Their grants over the account's other companies are left as they were.
     * @param string $accountId Your own account, or an account you provisioned. It — not the credential — decides which account the operation acts on; a `403` is returned when you do not reach it, the same response an account that does not exist gets.
     * @param string $memberId Membership unique UUID.
     * @param string $companyId Unique identifier (UUID) of the company within the account.
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \Lenorix\BeelSdk\Generated\Exception\DeleteAccountMemberGrantUnauthorizedException
     * @throws \Lenorix\BeelSdk\Generated\Exception\DeleteAccountMemberGrantForbiddenException
     * @throws \Lenorix\BeelSdk\Generated\Exception\DeleteAccountMemberGrantNotFoundException
     * @throws \Lenorix\BeelSdk\Generated\Exception\DeleteAccountMemberGrantTooManyRequestsException
     * @throws \Lenorix\BeelSdk\Generated\Exception\DeleteAccountMemberGrantInternalServerErrorException
     *
     * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
     */
    public function deleteAccountMemberGrant(string $accountId, string $memberId, string $companyId, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\DeleteAccountMemberGrant($accountId, $memberId, $companyId), $fetch);
    }
    /**
     * Grants a `MEMBER` access to one company, or changes the `access_level` of an existing
     * grant. Only the company in the path is touched.
     *
     * - **Scope:** the member's other grants are left exactly as they were.
     * - **`access_level`:** `VIEW` or `OPERATE`. `NONE` is not accepted here — remove access by
     *   deleting the grant.
     * - **Eligible members:** grants apply only to `MEMBER`. `OWNER` and `ADMIN` reach every
     *   company implicitly and cannot receive grants.
     *
     * @param string $accountId Your own account, or an account you provisioned. It — not the credential — decides which account the operation acts on; a `403` is returned when you do not reach it, the same response an account that does not exist gets.
     * @param string $memberId Membership unique UUID.
     * @param string $companyId Unique identifier (UUID) of the company within the account.
     * @param \Lenorix\BeelSdk\Generated\Model\PutMemberGrantRequest $requestBody
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \Lenorix\BeelSdk\Generated\Exception\PutAccountMemberGrantBadRequestException
     * @throws \Lenorix\BeelSdk\Generated\Exception\PutAccountMemberGrantUnauthorizedException
     * @throws \Lenorix\BeelSdk\Generated\Exception\PutAccountMemberGrantForbiddenException
     * @throws \Lenorix\BeelSdk\Generated\Exception\PutAccountMemberGrantNotFoundException
     * @throws \Lenorix\BeelSdk\Generated\Exception\PutAccountMemberGrantUnprocessableEntityException
     * @throws \Lenorix\BeelSdk\Generated\Exception\PutAccountMemberGrantTooManyRequestsException
     * @throws \Lenorix\BeelSdk\Generated\Exception\PutAccountMemberGrantInternalServerErrorException
     *
     * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\V1AccountsAccountIdMembersMemberIdGrantsCompanyIdPutResponse200|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
     */
    public function putAccountMemberGrant(string $accountId, string $memberId, string $companyId, \Lenorix\BeelSdk\Generated\Model\PutMemberGrantRequest $requestBody, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\PutAccountMemberGrant($accountId, $memberId, $companyId, $requestBody), $fetch);
    }
    /**
    * Makes the member in the body the account's `OWNER` and steps the calling owner down to
    * `ADMIN`, so the account always keeps exactly one owner.
    *
    * - **Repeatable:** it states the desired owner rather than performing a transfer, so
    *   repeating the same call once that member already owns the account returns the same
    *   `204` instead of failing.
    * - **Credentials:** unlike the rest of this API, this operation is available only from a
    *   signed-in dashboard session. No API key, live or test, can perform it, whatever scopes
    *   it holds.
    * - **From an integration:** to hand an account over to its holder, issue a claim token with
    *   `POST /v1/accounts/{account_id}/claim-tokens` instead.
    *
    * @param string $accountId Your own account, or an account you provisioned. It — not the credential — decides which account the operation acts on; a `403` is returned when you do not reach it, the same response an account that does not exist gets.
    * @param \Lenorix\BeelSdk\Generated\Model\SetAccountOwnerRequest $requestBody
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
    
    * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
    * @throws \Lenorix\BeelSdk\Generated\Exception\PutAccountOwnerBadRequestException
    * @throws \Lenorix\BeelSdk\Generated\Exception\PutAccountOwnerUnauthorizedException
    * @throws \Lenorix\BeelSdk\Generated\Exception\PutAccountOwnerForbiddenException
    * @throws \Lenorix\BeelSdk\Generated\Exception\PutAccountOwnerNotFoundException
    * @throws \Lenorix\BeelSdk\Generated\Exception\PutAccountOwnerTooManyRequestsException
    * @throws \Lenorix\BeelSdk\Generated\Exception\PutAccountOwnerInternalServerErrorException
    *
    * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
    */
    public function putAccountOwner(string $accountId, \Lenorix\BeelSdk\Generated\Model\SetAccountOwnerRequest $requestBody, array $headerParameters = [], string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\PutAccountOwner($accountId, $requestBody, $headerParameters), $fetch);
    }
    /**
     * Lists the invitations sent to join the account, whatever their `status`. Accepted, revoked and expired invitations stay in the list: the record is the trail of who was granted access to the account's fiscal data.
     * @param string $accountId Your own account, or an account you provisioned. It — not the credential — decides which account the operation acts on; a `403` is returned when you do not reach it, the same response an account that does not exist gets.
     * @param array{
     *    "page"?: int, //Page number, starting at 1. The response echoes it back as `pagination.current_page`.
     *    "limit"?: int, //How many items to return per page. The response echoes it back as `pagination.items_per_page`.
     * } $queryParameters
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \Lenorix\BeelSdk\Generated\Exception\ListAccountInvitationsBadRequestException
     * @throws \Lenorix\BeelSdk\Generated\Exception\ListAccountInvitationsUnauthorizedException
     * @throws \Lenorix\BeelSdk\Generated\Exception\ListAccountInvitationsForbiddenException
     * @throws \Lenorix\BeelSdk\Generated\Exception\ListAccountInvitationsUnprocessableEntityException
     * @throws \Lenorix\BeelSdk\Generated\Exception\ListAccountInvitationsTooManyRequestsException
     * @throws \Lenorix\BeelSdk\Generated\Exception\ListAccountInvitationsInternalServerErrorException
     *
     * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\V1AccountsAccountIdInvitationsGetResponse200|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
     */
    public function listAccountInvitations(string $accountId, array $queryParameters = [], string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\ListAccountInvitations($accountId, $queryParameters), $fetch);
    }
    /**
    * Creates a single-use invitation for a person to join the account with the given
    * `account_role`.
    *
    * - **`token`:** the acceptance secret, returned once and never readable again, so deliver
    *   it to the invitee. `invitation_url` is the ready-to-use link built from that same token.
    * - **`grants`:** required. Send the companies a `MEMBER` starts with, or `[]` to invite
    *   them with no company access yet. Grants are only valid for `MEMBER`, since `OWNER` and
    *   `ADMIN` reach every company implicitly.
    * - **`account_role`:** `OWNER` cannot be invited. An account has exactly one owner, handed
    *   over only through `PUT /v1/accounts/{account_id}/owner`.
    * - **`send_email`:** defaults to `false`, so BeeL sends no email and you deliver the token
    *   or `invitation_url` yourself. Set it to `true` to have the invitation emailed to
    *   `invited_email` as well.
    *
    * @param string $accountId Your own account, or an account you provisioned. It — not the credential — decides which account the operation acts on; a `403` is returned when you do not reach it, the same response an account that does not exist gets.
    * @param \Lenorix\BeelSdk\Generated\Model\CreateInvitationRequest $requestBody
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
    
    * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
    * @throws \Lenorix\BeelSdk\Generated\Exception\CreateAccountInvitationBadRequestException
    * @throws \Lenorix\BeelSdk\Generated\Exception\CreateAccountInvitationUnauthorizedException
    * @throws \Lenorix\BeelSdk\Generated\Exception\CreateAccountInvitationForbiddenException
    * @throws \Lenorix\BeelSdk\Generated\Exception\CreateAccountInvitationConflictException
    * @throws \Lenorix\BeelSdk\Generated\Exception\CreateAccountInvitationUnprocessableEntityException
    * @throws \Lenorix\BeelSdk\Generated\Exception\CreateAccountInvitationTooManyRequestsException
    * @throws \Lenorix\BeelSdk\Generated\Exception\CreateAccountInvitationInternalServerErrorException
    *
    * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\V1AccountsAccountIdInvitationsPostResponse201|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
    */
    public function createAccountInvitation(string $accountId, \Lenorix\BeelSdk\Generated\Model\CreateInvitationRequest $requestBody, array $headerParameters = [], string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\CreateAccountInvitation($accountId, $requestBody, $headerParameters), $fetch);
    }
    /**
     * Revokes a `PENDING` invitation, so its acceptance link stops working.
     *
     * - **Already resolved:** an `ACCEPTED`, `REVOKED` or `EXPIRED` invitation cannot be
     *   revoked, and answers `404` without disclosing which of the three it is.
     * - **History:** revoking does not remove the invitation from the list.
     *
     * @param string $accountId Your own account, or an account you provisioned. It — not the credential — decides which account the operation acts on; a `403` is returned when you do not reach it, the same response an account that does not exist gets.
     * @param string $invitationId
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \Lenorix\BeelSdk\Generated\Exception\DeleteAccountInvitationUnauthorizedException
     * @throws \Lenorix\BeelSdk\Generated\Exception\DeleteAccountInvitationForbiddenException
     * @throws \Lenorix\BeelSdk\Generated\Exception\DeleteAccountInvitationNotFoundException
     * @throws \Lenorix\BeelSdk\Generated\Exception\DeleteAccountInvitationTooManyRequestsException
     * @throws \Lenorix\BeelSdk\Generated\Exception\DeleteAccountInvitationInternalServerErrorException
     *
     * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
     */
    public function deleteAccountInvitation(string $accountId, string $invitationId, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\DeleteAccountInvitation($accountId, $invitationId), $fetch);
    }
    /**
     * Returns one invitation of the account, with the same shape the list returns. An invitation stays readable for its whole life: `ACCEPTED`, `REVOKED` and `EXPIRED` ones are returned with their `status`, because the record is the trail of who was granted access to the account's fiscal data and revoking it does not erase it.
     * @param string $accountId Your own account, or an account you provisioned. It — not the credential — decides which account the operation acts on; a `403` is returned when you do not reach it, the same response an account that does not exist gets.
     * @param string $invitationId
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetAccountInvitationUnauthorizedException
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetAccountInvitationForbiddenException
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetAccountInvitationNotFoundException
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetAccountInvitationTooManyRequestsException
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetAccountInvitationInternalServerErrorException
     *
     * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\V1AccountsAccountIdInvitationsInvitationIdGetResponse200|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
     */
    public function getAccountInvitation(string $accountId, string $invitationId, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\GetAccountInvitation($accountId, $invitationId), $fetch);
    }
    /**
     * Returns the accounts you provisioned, newest first. Each carries its lifecycle `status`
     * (`PROVISIONED` → `CLAIMED` → `ACTIVE`), the `access_level` you hold over it and the state
     * of its claim link.
     *
     * - **`status`:** narrows the list to one lifecycle stage.
     * - **`external_ref`:** looks an account up by the reference you assigned when provisioning
     *   it; returns the 0..1 matching accounts.
     *
     * **Cursor pagination.** This collection pages by `cursor`/`next_cursor` instead of by
     * `page`, so it carries no `pagination` block. That is a documented variant of pagination,
     * not a different envelope: the collection still travels under a named key inside `data`.
     * Keep asking with the `next_cursor` of the previous response until it comes back `null`.
     *
     * @param array{
     *    "status"?: string,
     *    "external_ref"?: string, //Your own id for the account; returns the 0..1 matching accounts.
     *    "limit"?: int, //Maximum number of accounts to return per page (1–200). Defaults to 50.
     *    "cursor"?: string, //Opaque pagination cursor from a previous response's `next_cursor`.
     * } $queryParameters
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \Lenorix\BeelSdk\Generated\Exception\ListAccountsBadRequestException
     * @throws \Lenorix\BeelSdk\Generated\Exception\ListAccountsUnauthorizedException
     * @throws \Lenorix\BeelSdk\Generated\Exception\ListAccountsForbiddenException
     * @throws \Lenorix\BeelSdk\Generated\Exception\ListAccountsTooManyRequestsException
     * @throws \Lenorix\BeelSdk\Generated\Exception\ListAccountsInternalServerErrorException
     *
     * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\V1AccountsGetResponse200|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
     */
    public function listAccounts(array $queryParameters = [], string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\ListAccounts($queryParameters), $fetch);
    }
    /**
    * Provisions a new account on BeeL and, when it is born with a holder, returns a single-use
    * `claim_token` to deliver so they can set a password and take ownership.
    *
    * - **`email`:** send it to create the account with a holder. Omit it and the account is
    *   created with no person at all, no `person_id` and no `claim_token`; a holder can be
    *   added later with `POST /v1/accounts/{account_id}/claim-tokens`.
    * - **`tax_profile`:** send it and the account comes back ready to invoice, with its NIF,
    *   default invoice series and VeriFactu configuration set up and its `company_id` in the
    *   response. Omit it and the account stays empty until its holder registers a NIF.
    * - **`access_level`:** the access you retain over the account. Defaults to `NONE`;
    *   `OPERATE` requires a `tax_profile`.
    * - **`external_ref`:** the idempotency key. Resending the same one returns the existing
    *   account rather than creating a second.
    * - **Entitlement:** requires `manage_accounts`.
    *
    * ## Reactivation
    *
    * If you previously ended your management of this account
    * (`DELETE /v1/accounts/{account_id}/management`) and its holder has not claimed it yet,
    * provisioning the same email reactivates that account instead of creating a new one. The
    * same account, holder, NIFs and invoices come back under your management, with the
    * `external_ref` and `access_level` of this request, and it counts towards your billable
    * usage again. Once the holder has claimed the account it is theirs, and only they can
    * grant you access again.
    *
    * @param \Lenorix\BeelSdk\Generated\Model\ProvisionAccountRequest $requestBody
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
    
    * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
    * @throws \Lenorix\BeelSdk\Generated\Exception\ProvisionAccountBadRequestException
    * @throws \Lenorix\BeelSdk\Generated\Exception\ProvisionAccountUnauthorizedException
    * @throws \Lenorix\BeelSdk\Generated\Exception\ProvisionAccountForbiddenException
    * @throws \Lenorix\BeelSdk\Generated\Exception\ProvisionAccountConflictException
    * @throws \Lenorix\BeelSdk\Generated\Exception\ProvisionAccountUnprocessableEntityException
    * @throws \Lenorix\BeelSdk\Generated\Exception\ProvisionAccountTooManyRequestsException
    * @throws \Lenorix\BeelSdk\Generated\Exception\ProvisionAccountInternalServerErrorException
    *
    * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\V1AccountsPostResponse201|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
    */
    public function provisionAccount(\Lenorix\BeelSdk\Generated\Model\ProvisionAccountRequest $requestBody, array $headerParameters = [], string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\ProvisionAccount($requestBody, $headerParameters), $fetch);
    }
    /**
     * Returns one account you provisioned, with the same shape the list returns: its lifecycle `status`, the `access_level` you hold, the state of its claim link and its `company_id` when the account holds exactly one NIF.
     * @param string $accountId
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetAccountUnauthorizedException
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetAccountForbiddenException
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetAccountTooManyRequestsException
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetAccountInternalServerErrorException
     *
     * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\V1AccountsAccountIdGetResponse200|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
     */
    public function getAccount(string $accountId, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\GetAccount($accountId), $fetch);
    }
    /**
     * Updates the `access_level` you keep over an account you provisioned.
     *
     * - **Raising it:** only possible while the account is unclaimed. Once its holder has taken
     *   ownership you may keep or lower your access, but only they can raise it.
     * - **Billing:** the level never affects it — you pay for the account's subscription at any
     *   level.
     * - **`OPERATE`:** issuing invoices on the holder's behalf additionally requires a signed
     *   fiscal representation from them.
     * - **Entitlement:** requires `manage_accounts`.
     *
     * @param string $accountId
     * @param \Lenorix\BeelSdk\Generated\Model\ChangeAccessLevelRequest $requestBody
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \Lenorix\BeelSdk\Generated\Exception\ChangeManagedAccountAccessLevelBadRequestException
     * @throws \Lenorix\BeelSdk\Generated\Exception\ChangeManagedAccountAccessLevelUnauthorizedException
     * @throws \Lenorix\BeelSdk\Generated\Exception\ChangeManagedAccountAccessLevelForbiddenException
     * @throws \Lenorix\BeelSdk\Generated\Exception\ChangeManagedAccountAccessLevelTooManyRequestsException
     * @throws \Lenorix\BeelSdk\Generated\Exception\ChangeManagedAccountAccessLevelInternalServerErrorException
     *
     * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
     */
    public function changeManagedAccountAccessLevel(string $accountId, \Lenorix\BeelSdk\Generated\Model\ChangeAccessLevelRequest $requestBody, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\ChangeManagedAccountAccessLevel($accountId, $requestBody), $fetch);
    }
    /**
     * Ends the management relationship over an account you provisioned: you lose access to it,
     * and its NIFs stop counting towards your billable usage from the next billing cycle.
     *
     * - **The holder:** keeps the account, its NIFs and its invoices, and becomes responsible
     *   for their own subscription. Nothing is deleted or anonymised.
     * - **Reversible:** only while the account stays unclaimed. Provisioning the same email
     *   again reactivates it (see `POST /v1/accounts`), and only the manager who ended the
     *   relationship can do so. Once the holder claims the account it is theirs, and getting the
     *   management back needs their consent, not just their email address.
     * - **Entitlement:** requires `manage_accounts`.
     *
     * @param string $accountId
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \Lenorix\BeelSdk\Generated\Exception\EndAccountManagementUnauthorizedException
     * @throws \Lenorix\BeelSdk\Generated\Exception\EndAccountManagementForbiddenException
     * @throws \Lenorix\BeelSdk\Generated\Exception\EndAccountManagementTooManyRequestsException
     * @throws \Lenorix\BeelSdk\Generated\Exception\EndAccountManagementInternalServerErrorException
     *
     * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
     */
    public function endAccountManagement(string $accountId, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\EndAccountManagement($accountId), $fetch);
    }
    /**
    * Issues a single-use `claim_token`, and the `claim_url` built from it, so the account's
    * holder can set a password and take ownership.
    *
    * - **`email`:** send it when the account has no holder yet — the person is created by this
    *   call. Omit the body to re-issue the token for the holder the account already has. An
    *   `email` that differs from the existing holder's is rejected rather than replacing them.
    * - **Lifetime:** tokens last 30 days, and only the last one issued is live. Issuing again
    *   invalidates the previous token, so the old link stops working the moment you ask for a
    *   new one.
    * - **Not an invitation:** this hands the account itself over to its holder. To add a
    *   further person to an account that already has one, invite them with
    *   `POST /v1/accounts/{account_id}/invitations`.
    * - **Entitlement:** requires `manage_accounts`.
    *
    * @param string $accountId
    * @param null|\Lenorix\BeelSdk\Generated\Model\CreateClaimTokenRequest $requestBody
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
    
    * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
    * @throws \Lenorix\BeelSdk\Generated\Exception\CreateAccountClaimTokenUnauthorizedException
    * @throws \Lenorix\BeelSdk\Generated\Exception\CreateAccountClaimTokenForbiddenException
    * @throws \Lenorix\BeelSdk\Generated\Exception\CreateAccountClaimTokenNotFoundException
    * @throws \Lenorix\BeelSdk\Generated\Exception\CreateAccountClaimTokenConflictException
    * @throws \Lenorix\BeelSdk\Generated\Exception\CreateAccountClaimTokenUnprocessableEntityException
    * @throws \Lenorix\BeelSdk\Generated\Exception\CreateAccountClaimTokenTooManyRequestsException
    * @throws \Lenorix\BeelSdk\Generated\Exception\CreateAccountClaimTokenInternalServerErrorException
    *
    * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\V1AccountsAccountIdClaimTokensPostResponse201|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
    */
    public function createAccountClaimToken(string $accountId, ?\Lenorix\BeelSdk\Generated\Model\CreateClaimTokenRequest $requestBody = null, array $headerParameters = [], string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\CreateAccountClaimToken($accountId, $requestBody, $headerParameters), $fetch);
    }
    /**
     * Returns how many accounts you have provisioned and the billable count that follows from
     * them — the figure behind your offline B2B invoice.
     *
     * - **Billable unit:** the provisioned account, not the real NIF. Every account you
     *   provision counts as one, empty and unclaimed ones included.
     * - **`account_id`:** your own account. Usage is a property of the provisioner, not of each
     *   provisioned account, so any other id returns `404`.
     * - **Entitlement:** requires `manage_accounts`.
     *
     * @param string $accountId Your own account id.
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetAccountUsageUnauthorizedException
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetAccountUsageForbiddenException
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetAccountUsageNotFoundException
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetAccountUsageTooManyRequestsException
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetAccountUsageInternalServerErrorException
     *
     * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\V1AccountsAccountIdUsageGetResponse200|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
     */
    public function getAccountUsage(string $accountId, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\GetAccountUsage($accountId), $fetch);
    }
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
    * @param \Lenorix\BeelSdk\Generated\Model\AccountImportUpload $requestBody
    * @param array{
    *    "Idempotency-Key": string, //Same key as `Idempotency-Key` above, but **required**: the operation writes many rows per
    call, so a retry without a key would import the same file twice. A missing key answers
    `400 IDEMPOTENCY_KEY_REQUIRED`.
    * } $headerParameters
    
    * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
    * @throws \Lenorix\BeelSdk\Generated\Exception\CreateAccountImportBadRequestException
    * @throws \Lenorix\BeelSdk\Generated\Exception\CreateAccountImportUnauthorizedException
    * @throws \Lenorix\BeelSdk\Generated\Exception\CreateAccountImportPaymentRequiredException
    * @throws \Lenorix\BeelSdk\Generated\Exception\CreateAccountImportForbiddenException
    * @throws \Lenorix\BeelSdk\Generated\Exception\CreateAccountImportConflictException
    * @throws \Lenorix\BeelSdk\Generated\Exception\CreateAccountImportRequestEntityTooLargeException
    * @throws \Lenorix\BeelSdk\Generated\Exception\CreateAccountImportUnprocessableEntityException
    * @throws \Lenorix\BeelSdk\Generated\Exception\CreateAccountImportTooManyRequestsException
    * @throws \Lenorix\BeelSdk\Generated\Exception\CreateAccountImportInternalServerErrorException
    *
    * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\V1AccountsImportsPostResponse201|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
    */
    public function createAccountImport(\Lenorix\BeelSdk\Generated\Model\AccountImportUpload $requestBody, array $headerParameters = [], string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\CreateAccountImport($requestBody, $headerParameters), $fetch);
    }
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
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \Lenorix\BeelSdk\Generated\Exception\PreviewAccountImportBadRequestException
     * @throws \Lenorix\BeelSdk\Generated\Exception\PreviewAccountImportUnauthorizedException
     * @throws \Lenorix\BeelSdk\Generated\Exception\PreviewAccountImportPaymentRequiredException
     * @throws \Lenorix\BeelSdk\Generated\Exception\PreviewAccountImportForbiddenException
     * @throws \Lenorix\BeelSdk\Generated\Exception\PreviewAccountImportRequestEntityTooLargeException
     * @throws \Lenorix\BeelSdk\Generated\Exception\PreviewAccountImportUnprocessableEntityException
     * @throws \Lenorix\BeelSdk\Generated\Exception\PreviewAccountImportTooManyRequestsException
     * @throws \Lenorix\BeelSdk\Generated\Exception\PreviewAccountImportInternalServerErrorException
     *
     * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\V1AccountsImportsPreviewPostResponse200|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
     */
    public function previewAccountImport(\Lenorix\BeelSdk\Generated\Model\AccountImportUpload $requestBody, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\PreviewAccountImport($requestBody), $fetch);
    }
    /**
    * Returns the VAT and IRPF summary of the invoices issued under this company over the requested period, together with the annual IRPF projection and its progressive bracket breakdown.
    * `start_date` and `end_date` go together: send both, or neither. Omitting both defaults to the current month; sending only one answers `400`, because a period you did not ask for is worse than an error. The range may not exceed 365 days, and every fault names itself in `details.reason`.
    * @param string $companyId Unique identifier (UUID) of the company the operation acts on — its identifier, not its NIF. It is the only source of context: the account that owns it is derived from it, and the `BeeL-Active-Company` header plays no part. A company you do not reach answers `403`, and so does a company that does not exist, so the existence of a company in another account is never disclosed.
    * @param array{
    *    "start_date"?: string, //Period start date (inclusive), as `YYYY-MM-DD`. Goes together with `end_date`:
    supply both or neither. Omitting both defaults to the current month; supplying
    only one is rejected with `400` (`PERIOD_INCOMPLETE`).
    *    "end_date"?: string, //Period end date (inclusive), as `YYYY-MM-DD`. Goes together with `start_date`:
    supply both or neither. Omitting both defaults to the current month; supplying
    only one is rejected with `400` (`PERIOD_INCOMPLETE`).
    * } $queryParameters
    
    * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
    * @throws \Lenorix\BeelSdk\Generated\Exception\GetCompanyFiscalSummaryBadRequestException
    * @throws \Lenorix\BeelSdk\Generated\Exception\GetCompanyFiscalSummaryUnauthorizedException
    * @throws \Lenorix\BeelSdk\Generated\Exception\GetCompanyFiscalSummaryForbiddenException
    * @throws \Lenorix\BeelSdk\Generated\Exception\GetCompanyFiscalSummaryTooManyRequestsException
    * @throws \Lenorix\BeelSdk\Generated\Exception\GetCompanyFiscalSummaryInternalServerErrorException
    *
    * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdFiscalSummaryGetResponse200|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
    */
    public function getCompanyFiscalSummary(string $companyId, array $queryParameters = [], string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\GetCompanyFiscalSummary($companyId, $queryParameters), $fetch);
    }
    /**
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetVeriFactuConfigurationUnauthorizedException
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetVeriFactuConfigurationForbiddenException
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetVeriFactuConfigurationInternalServerErrorException
     *
     * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\V1ConfigurationVerifactuGetResponse200|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
     */
    public function getVeriFactuConfiguration(string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\GetVeriFactuConfiguration(), $fetch);
    }
    /**
     * **Deprecated.** Use `PUT /v1/companies/{company_id}/verifactu-configuration`, which
     * behaves identically.
     *
     * Updates the VeriFactu configuration of the company in focus.
     *
     * - **Writable fields:** only `enabled`. The rest of the returned
     *   configuration (`status`, `signed`, `activated`, `nif_status`) is resolved server-side.
     * - **Full replacement:** `enabled` is required — this PUT replaces the whole state, it is
     *   not a partial merge, so omitting it is a client error and not a silent `false`.
     * - **Turning it on registers the NIF with the provider in the same call**, atomically: if
     *   the provider rejects it nothing is persisted and the response carries the reason. In Live
     *   it requires a signed and validated AEAT representation first, or `422`
     *   `VERIFACTU_REPRESENTATION_REQUIRED`.
     * - **Sandbox is always on:** `enabled: false` there answers `422`
     *   `VERIFACTU_ALWAYS_ON_IN_SANDBOX`.
     *
     * ## Turning it off
     *
     * Setting `enabled` to false stops sending invoices to the AEAT and starts the
     * deregistration of the NIF with the VeriFactu provider. It does **not** deactivate the
     * NIF: the activation is a fact of its own for the (company, environment) pair, so issuing
     * carries on and `issuing-readiness` stays `ready`. Releasing the NIF is always
     * `DELETE /v1/companies/{company_id}/activations`, with its own guarantees.
     *
     * **Retires on 9 December 2026.** See the [migration guide](https://docs.beel.es/changelog/resources-under-the-nif) for what moved where and what changes when you switch.
     *
     * @param \Lenorix\BeelSdk\Generated\Model\UpdateVeriFactuConfigurationRequest $requestBody
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \Lenorix\BeelSdk\Generated\Exception\UpdateVeriFactuConfigurationBadRequestException
     * @throws \Lenorix\BeelSdk\Generated\Exception\UpdateVeriFactuConfigurationUnauthorizedException
     * @throws \Lenorix\BeelSdk\Generated\Exception\UpdateVeriFactuConfigurationForbiddenException
     * @throws \Lenorix\BeelSdk\Generated\Exception\UpdateVeriFactuConfigurationUnprocessableEntityException
     * @throws \Lenorix\BeelSdk\Generated\Exception\UpdateVeriFactuConfigurationInternalServerErrorException
     *
     * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\V1ConfigurationVerifactuPutResponse200|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
     */
    public function updateVeriFactuConfiguration(\Lenorix\BeelSdk\Generated\Model\UpdateVeriFactuConfigurationRequest $requestBody, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\UpdateVeriFactuConfiguration($requestBody), $fetch);
    }
    /**
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetTaxTypesUnauthorizedException
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetTaxTypesForbiddenException
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetTaxTypesInternalServerErrorException
     *
     * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\TaxTypesCatalogResponse|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
     */
    public function getTaxTypes(string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\GetTaxTypes(), $fetch);
    }
    /**
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetInvoiceCustomizationOptionsUnauthorizedException
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetInvoiceCustomizationOptionsForbiddenException
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetInvoiceCustomizationOptionsInternalServerErrorException
     *
     * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\V1ConfigurationInvoiceCustomizationOptionsGetResponse200|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
     */
    public function getInvoiceCustomizationOptions(string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\GetInvoiceCustomizationOptions(), $fetch);
    }
    /**
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetTaxConfigurationUnauthorizedException
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetTaxConfigurationForbiddenException
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetTaxConfigurationInternalServerErrorException
     *
     * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\V1ConfigurationTaxesGetResponse200|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
     */
    public function getTaxConfiguration(string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\GetTaxConfiguration(), $fetch);
    }
    /**
     * **Deprecated.** Use `PUT /v1/companies/{company_id}/tax-configuration`, which behaves
     * identically.
     *
     * Updates the tax configuration of the company in focus. Fields you omit keep their
     * current value.
     *
     * - **Regime coherence:** the main tax and its VeriFactu regime key must match. Regime key
     *   `18` (equivalence surcharge) only exists for `IVA`, so pairing it with `IGIC`, `IPSI` or
     *   `OTHER` answers `422` `INVALID_REGIME_KEY_FOR_TAX_TYPE`, with `details` naming the
     *   rejected key, the tax type and the keys that type admits.
     * - **Surcharge:** applying the surcharge without regime key `18` answers `422`
     *   `RECARGO_REQUIRES_REGIME_RE`.
     * - **Exemption reason:** `default_exemption_reason` travels with `default_main_tax` —
     *   sending the tax without a reason clears the stored one, and sending only the reason
     *   applies it to the tax already stored.
     *
     * **Retires on 9 December 2026.** See the [migration guide](https://docs.beel.es/changelog/resources-under-the-nif) for what moved where and what changes when you switch.
     *
     * @param \Lenorix\BeelSdk\Generated\Model\UpdateTaxConfigurationRequest $requestBody
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \Lenorix\BeelSdk\Generated\Exception\UpdateTaxConfigurationBadRequestException
     * @throws \Lenorix\BeelSdk\Generated\Exception\UpdateTaxConfigurationUnauthorizedException
     * @throws \Lenorix\BeelSdk\Generated\Exception\UpdateTaxConfigurationForbiddenException
     * @throws \Lenorix\BeelSdk\Generated\Exception\UpdateTaxConfigurationUnprocessableEntityException
     * @throws \Lenorix\BeelSdk\Generated\Exception\UpdateTaxConfigurationInternalServerErrorException
     *
     * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\V1ConfigurationTaxesPutResponse200|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
     */
    public function updateTaxConfiguration(\Lenorix\BeelSdk\Generated\Model\UpdateTaxConfigurationRequest $requestBody, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\UpdateTaxConfiguration($requestBody), $fetch);
    }
    /**
    * **Deprecated.** Use `GET /v1/companies/{company_id}/series`, which behaves identically.
    *
    * Retrieves the invoice series of the company in focus. The listing is always scoped
    * to one company; it never spans several.
    *
    * - **Filters:** `active` restricts to active or inactive series — omit it and you get all of
    *   them. `document_type` filters by type and always includes the `UNASSIGNED` series.
    * - **Pagination (opt-in):** send `page` and/or `limit` to receive a single page plus a
    *   `data.pagination` block with the totals. Omit both and the response carries the full list
    *   in `data.series` and no `pagination` block.
    *
    * **Retires on 9 December 2026.** See the [migration guide](https://docs.beel.es/changelog/resources-under-the-nif) for what moved where and what changes when you switch.
    *
    * @param array{
    *    "active"?: bool, //Filters by activity: `true` returns only active series, `false` only inactive ones.
    Omit it and you get **all** the series, active and inactive.
    *    "document_type"?: string, //Filter by document type (UNASSIGNED series are always included)
    *    "page"?: int, //Page number (starts at 1). Omit for the full, unpaginated list.
    *    "limit"?: int, //Items per page. Omit for the full, unpaginated list.
    * } $queryParameters
    
    * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
    * @throws \Lenorix\BeelSdk\Generated\Exception\ListSeriesUnauthorizedException
    * @throws \Lenorix\BeelSdk\Generated\Exception\ListSeriesForbiddenException
    * @throws \Lenorix\BeelSdk\Generated\Exception\ListSeriesInternalServerErrorException
    *
    * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\V1ConfigurationSeriesGetResponse200|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
    */
    public function listSeries(array $queryParameters = [], string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\ListSeries($queryParameters), $fetch);
    }
    /**
    * **Deprecated.** Use `POST /v1/companies/{company_id}/series`, which behaves identically.
    *
    * Creates a new invoice series for the company in focus.
    *
    * - **Code:** must be unique within the company; a code already taken answers `409`.
    * - **Numbering:** `format` must contain `{NUM}` or `{NUM:X}` and only accepts uppercase
    *   tokens. `counter_reset` defaults to `ANNUAL`, so a format with no year token has to be
    *   sent with `counter_reset: NEVER`.
    * - **Default series:** the first series created for a document type is marked as default
    *   even if you send `default_series: false`.
    *
    * **Retires on 9 December 2026.** See the [migration guide](https://docs.beel.es/changelog/resources-under-the-nif) for what moved where and what changes when you switch.
    *
    * @param \Lenorix\BeelSdk\Generated\Model\CreateSeriesRequest $requestBody
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
    
    * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
    * @throws \Lenorix\BeelSdk\Generated\Exception\CreateSeriesBadRequestException
    * @throws \Lenorix\BeelSdk\Generated\Exception\CreateSeriesUnauthorizedException
    * @throws \Lenorix\BeelSdk\Generated\Exception\CreateSeriesForbiddenException
    * @throws \Lenorix\BeelSdk\Generated\Exception\CreateSeriesConflictException
    * @throws \Lenorix\BeelSdk\Generated\Exception\CreateSeriesUnprocessableEntityException
    * @throws \Lenorix\BeelSdk\Generated\Exception\CreateSeriesInternalServerErrorException
    *
    * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\V1ConfigurationSeriesPostResponse201|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
    */
    public function createSeries(\Lenorix\BeelSdk\Generated\Model\CreateSeriesRequest $requestBody, array $headerParameters = [], string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\CreateSeries($requestBody, $headerParameters), $fetch);
    }
    /**
    * **Deprecated.** Use `PUT /v1/companies/{company_id}/series/defaults`, which behaves
    * identically. Ensuring a set of defaults is idempotent, so the canonical form is a `PUT`.
    *
    * Idempotently ensures the company in focus has a default invoice series for each
    * relevant `DocumentType` (`STANDARD`, `SIMPLIFIED`, `CORRECTIVE`) in the current
    * environment.
    *
    * - **Already there:** a document type that already has a default keeps it, and it is
    *   returned unchanged.
    * - **Missing:** a new series is created with code `F`, `S` or `R` and format
    *   `{CODIGO}-{YYYY}-{NUM:4}`, active and marked as default.
    * - **Code taken:** if that code is already in use by a manually created series, the document
    *   type is skipped and omitted from the response.
    *
    * **Retires on 9 December 2026.** See the [migration guide](https://docs.beel.es/changelog/resources-under-the-nif) for what moved where and what changes when you switch.
    *
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
    
    * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
    * @throws \Lenorix\BeelSdk\Generated\Exception\CreateDefaultSeriesUnauthorizedException
    * @throws \Lenorix\BeelSdk\Generated\Exception\CreateDefaultSeriesForbiddenException
    * @throws \Lenorix\BeelSdk\Generated\Exception\CreateDefaultSeriesInternalServerErrorException
    *
    * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\V1ConfigurationSeriesDefaultsPostResponse200|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
    */
    public function createDefaultSeries(array $headerParameters = [], string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\CreateDefaultSeries($headerParameters), $fetch);
    }
    /**
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetDefaultSeriesStatusUnauthorizedException
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetDefaultSeriesStatusForbiddenException
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetDefaultSeriesStatusInternalServerErrorException
     *
     * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\V1ConfigurationSeriesDefaultsStatusGetResponse200|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
     */
    public function getDefaultSeriesStatus(string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\GetDefaultSeriesStatus(), $fetch);
    }
    /**
     * **Deprecated.** Use `DELETE /v1/companies/{company_id}/series/{series_id}`, which
     * behaves identically.
     *
     * Soft-deletes an invoice series. If the series is active, it is automatically deactivated
     * before deletion.
     *
     * - **The code is NOT released:** it stays taken even after deletion, because it identifies
     *   invoices already issued under it. Recreating a series with the same code returns
     *   `409 SERIES_CODE_DUPLICATED`, so always pick a new code.
     * - **Default series:** it cannot be deleted *while another active series of the same
     *   document type exists* — promote that other one first. If it is the only series of its
     *   type, it can be deleted and the type is left with no series: a valid state in which
     *   issuing without an explicit series returns `SERIES_DEFAULT_NOT_FOUND`.
     *
     * **Retires on 9 December 2026.** See the [migration guide](https://docs.beel.es/changelog/resources-under-the-nif) for what moved where and what changes when you switch.
     *
     * @param string $seriesId Series ID
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \Lenorix\BeelSdk\Generated\Exception\DeleteSeriesBadRequestException
     * @throws \Lenorix\BeelSdk\Generated\Exception\DeleteSeriesUnauthorizedException
     * @throws \Lenorix\BeelSdk\Generated\Exception\DeleteSeriesForbiddenException
     * @throws \Lenorix\BeelSdk\Generated\Exception\DeleteSeriesNotFoundException
     * @throws \Lenorix\BeelSdk\Generated\Exception\DeleteSeriesInternalServerErrorException
     *
     * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
     */
    public function deleteSeries(string $seriesId, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\DeleteSeries($seriesId), $fetch);
    }
    /**
     * **Deprecated.** Use `PATCH /v1/companies/{company_id}/series/{series_id}`, which behaves
     * identically.
     *
     * Updates only the fields present in the body, leaving every other field of the series as it
     * is.
     *
     * - **Clearing a field:** a field sent as `null` is cleared — only `description` supports it
     *   (see `PatchSeriesRequest`).
     * - **Numbering fields:** the same guard as `PUT`. `code`, `format`, `counter_reset` and
     *   `initial_number` are rejected once the series has issued invoices.
     * - **`default_series`:** it is not a way to clear the default. Sending `false` for the
     *   series that currently *is* the default is rejected with `DEFAULT_CANNOT_BE_UNMARKED`;
     *   promote another series with
     *   `PUT /v1/companies/{company_id}/series/{series_id}/default` instead. Sending `false` for
     *   a series that is *not* the default stays a no-op `200`.
     *
     * **Retires on 9 December 2026.** See the [migration guide](https://docs.beel.es/changelog/resources-under-the-nif) for what moved where and what changes when you switch.
     *
     * @param string $seriesId Series ID
     * @param \Lenorix\BeelSdk\Generated\Model\PatchSeriesRequest $requestBody
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \Lenorix\BeelSdk\Generated\Exception\PatchSeriesBadRequestException
     * @throws \Lenorix\BeelSdk\Generated\Exception\PatchSeriesUnauthorizedException
     * @throws \Lenorix\BeelSdk\Generated\Exception\PatchSeriesForbiddenException
     * @throws \Lenorix\BeelSdk\Generated\Exception\PatchSeriesNotFoundException
     * @throws \Lenorix\BeelSdk\Generated\Exception\PatchSeriesUnprocessableEntityException
     * @throws \Lenorix\BeelSdk\Generated\Exception\PatchSeriesInternalServerErrorException
     *
     * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\V1ConfigurationSeriesSeriesIdPatchResponse200|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
     */
    public function patchSeries(string $seriesId, \Lenorix\BeelSdk\Generated\Model\PatchSeriesRequest $requestBody, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\PatchSeries($seriesId, $requestBody), $fetch);
    }
    /**
     * **Deprecated.** The canonical form has a single update verb,
     * `PATCH /v1/companies/{company_id}/series/{series_id}`. The same body produces the same
     * result there — this route already merges field by field, leaving absent fields untouched —
     * with one difference: an explicit `description: null`, which this route ignores, clears the
     * description under `PATCH`.
     *
     * Updates an existing invoice series with the body you send; absent fields keep their value.
     *
     * - **Numbering fields:** `code`, `format`, `counter_reset` and `initial_number` are rejected
     *   once the series has issued invoices (`numbering_locked` is `true`). `name`,
     *   `description`, `active`, `default_series` and `document_type` can always be changed.
     * - **`active`:** a default series cannot be deactivated — set another one as default first.
     * - **`default_series`:** sending `false` on the series that currently is the default is
     *   rejected with `DEFAULT_CANNOT_BE_UNMARKED`. Promote another series with
     *   `PUT /v1/companies/{company_id}/series/{series_id}/default`, which unmarks the previous
     *   one for you. An inactive series cannot be marked as default.
     *
     * **Retires on 9 December 2026.** See the [migration guide](https://docs.beel.es/changelog/resources-under-the-nif) for what moved where and what changes when you switch.
     *
     * @param string $seriesId Series ID
     * @param \Lenorix\BeelSdk\Generated\Model\UpdateSeriesRequest $requestBody
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \Lenorix\BeelSdk\Generated\Exception\UpdateSeriesBadRequestException
     * @throws \Lenorix\BeelSdk\Generated\Exception\UpdateSeriesUnauthorizedException
     * @throws \Lenorix\BeelSdk\Generated\Exception\UpdateSeriesForbiddenException
     * @throws \Lenorix\BeelSdk\Generated\Exception\UpdateSeriesNotFoundException
     * @throws \Lenorix\BeelSdk\Generated\Exception\UpdateSeriesUnprocessableEntityException
     * @throws \Lenorix\BeelSdk\Generated\Exception\UpdateSeriesInternalServerErrorException
     *
     * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\V1ConfigurationSeriesSeriesIdPutResponse200|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
     */
    public function updateSeries(string $seriesId, \Lenorix\BeelSdk\Generated\Model\UpdateSeriesRequest $requestBody, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\UpdateSeries($seriesId, $requestBody), $fetch);
    }
    /**
    * **Deprecated.** Use `PUT /v1/companies/{company_id}/series/{series_id}/default`, which
    * behaves identically. Marking a series as the default is idempotent, so the canonical form
    * is a `PUT`.
    *
    * Marks an invoice series as the default one for its document type.
    *
    * - **One per type:** only one series can be the default per company and document
    *   type; the previous default is automatically unmarked.
    * - **Must be active:** an inactive series cannot be marked as default.
    *
    * **Retires on 9 December 2026.** See the [migration guide](https://docs.beel.es/changelog/resources-under-the-nif) for what moved where and what changes when you switch.
    *
    * @param string $seriesId Series ID to mark as default
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
    
    * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
    * @throws \Lenorix\BeelSdk\Generated\Exception\SetDefaultSeriesBadRequestException
    * @throws \Lenorix\BeelSdk\Generated\Exception\SetDefaultSeriesUnauthorizedException
    * @throws \Lenorix\BeelSdk\Generated\Exception\SetDefaultSeriesForbiddenException
    * @throws \Lenorix\BeelSdk\Generated\Exception\SetDefaultSeriesNotFoundException
    * @throws \Lenorix\BeelSdk\Generated\Exception\SetDefaultSeriesConflictException
    * @throws \Lenorix\BeelSdk\Generated\Exception\SetDefaultSeriesInternalServerErrorException
    *
    * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\V1ConfigurationSeriesSeriesIdDefaultPostResponse200|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
    */
    public function setDefaultSeries(string $seriesId, array $headerParameters = [], string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\SetDefaultSeries($seriesId, $headerParameters), $fetch);
    }
    /**
     * **Deprecated — use `PATCH /v1/me` instead.** The preferred language belongs to the
     * person, not to a company's configuration.
     *
     * Updates the authenticated user's preferred language.
     *
     * - **What it affects:** the language of the emails BeeL sends to the user and of the
     *   translated labels the API returns, such as the invoice template names in
     *   `GET /v1/invoice-customization-options`.
     * - **Supported languages:** `es` (Spanish), `en` (English) and `ca` (Catalan).
     *
     * **Retires on 9 December 2026.** See the [migration guide](https://docs.beel.es/changelog/resources-under-the-nif) for what moved where and what changes when you switch.
     *
     * @param \Lenorix\BeelSdk\Generated\Model\V1ConfigurationLanguagePutBody $requestBody
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \Lenorix\BeelSdk\Generated\Exception\UpdateLanguageBadRequestException
     * @throws \Lenorix\BeelSdk\Generated\Exception\UpdateLanguageUnauthorizedException
     * @throws \Lenorix\BeelSdk\Generated\Exception\UpdateLanguageForbiddenException
     * @throws \Lenorix\BeelSdk\Generated\Exception\UpdateLanguageUnprocessableEntityException
     * @throws \Lenorix\BeelSdk\Generated\Exception\UpdateLanguageInternalServerErrorException
     *
     * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\V1ConfigurationLanguagePutResponse200|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
     */
    public function updateLanguage(\Lenorix\BeelSdk\Generated\Model\V1ConfigurationLanguagePutBody $requestBody, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\UpdateLanguage($requestBody), $fetch);
    }
    /**
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \Lenorix\BeelSdk\Generated\Exception\ListTaxTypesBadRequestException
     * @throws \Lenorix\BeelSdk\Generated\Exception\ListTaxTypesUnauthorizedException
     * @throws \Lenorix\BeelSdk\Generated\Exception\ListTaxTypesForbiddenException
     * @throws \Lenorix\BeelSdk\Generated\Exception\ListTaxTypesTooManyRequestsException
     * @throws \Lenorix\BeelSdk\Generated\Exception\ListTaxTypesInternalServerErrorException
     *
     * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\TaxTypesCatalogResponse|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
     */
    public function listTaxTypes(string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\ListTaxTypes(), $fetch);
    }
    /**
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \Lenorix\BeelSdk\Generated\Exception\ListInvoiceCustomizationOptionsUnauthorizedException
     * @throws \Lenorix\BeelSdk\Generated\Exception\ListInvoiceCustomizationOptionsForbiddenException
     * @throws \Lenorix\BeelSdk\Generated\Exception\ListInvoiceCustomizationOptionsTooManyRequestsException
     * @throws \Lenorix\BeelSdk\Generated\Exception\ListInvoiceCustomizationOptionsInternalServerErrorException
     *
     * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\V1InvoiceCustomizationOptionsGetResponse200|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
     */
    public function listInvoiceCustomizationOptions(string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\ListInvoiceCustomizationOptions(), $fetch);
    }
    /**
     * Checks a NIF or CIF against the AEAT register through VeriFactu and returns what the
     * register says about it. It only reads the register: it creates nothing and stores no
     * customer.
     *
     * - **`status`:** distinguishes a NIF found in the register from one that is syntactically
     *   correct but absent, and from a check that could not be completed because VeriFactu was
     *   unavailable — in which case the NIF is validated automatically once the service is back.
     * - **`valid: true`:** means different things by holder. For an individual, AEAT matched NIF
     *   and name together. For a legal entity the name you sent is **not verified** at all —
     *   AEAT identifies a company by its CIF alone — so it says nothing about your name.
     * - **`legal_name_verified`:** tells those two cases apart.
     * - **`census_status`:** says whether an identified NIF is also deregistered or revoked.
     *
     * ## Invalid input
     *
     * - **Bad syntax is an answer, not an error:** it comes back `200` with `status: INVALID`, so
     *   a pre-validation flow never has to tell rejections apart by status code.
     * - **A missing NIF is an error:** an absent or empty `nif` answers `422` `FIELD_BLANK`, with
     *   `details.field` naming it.
     *
     * @param \Lenorix\BeelSdk\Generated\Model\ValidateNifRequest $requestBody
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \Lenorix\BeelSdk\Generated\Exception\ValidateNifBadRequestException
     * @throws \Lenorix\BeelSdk\Generated\Exception\ValidateNifUnauthorizedException
     * @throws \Lenorix\BeelSdk\Generated\Exception\ValidateNifForbiddenException
     * @throws \Lenorix\BeelSdk\Generated\Exception\ValidateNifUnprocessableEntityException
     * @throws \Lenorix\BeelSdk\Generated\Exception\ValidateNifTooManyRequestsException
     * @throws \Lenorix\BeelSdk\Generated\Exception\ValidateNifInternalServerErrorException
     *
     * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\V1NifValidatePostResponse200|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
     */
    public function validateNif(\Lenorix\BeelSdk\Generated\Model\ValidateNifRequest $requestBody, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\ValidateNif($requestBody), $fetch);
    }
    /**
     * Returns the companies (NIFs) belonging to the account in the path, ordered with the
     * primary company first. An account with no companies yet returns an empty list rather
     * than an error.
     *
     * - **`search`:** filters case-insensitively on NIF, legal name and trade name.
     * - **`include=readiness`:** adds each company's issuing-readiness block.
     * - **`pagination`:** present only when the request is paginated — that is, when any of
     *   `page`, `limit` or `search` is sent. It is omitted for the full list.
     * - **Series:** not part of this response. Read them from
     *   `GET /v1/companies/{company_id}/series`.
     *
     * @param string $accountId Your own account, or an account you provisioned. It — not the credential — decides which account the operation acts on; a `403` is returned when you do not reach it, the same response an account that does not exist gets.
     * @param array{
     *    "page"?: int, //Page number, starting at 1. The response echoes it back as `pagination.current_page`.
     *    "limit"?: int, //How many items to return per page. The response echoes it back as `pagination.items_per_page`.
     *    "search"?: string, //Case-insensitive filter on NIF, legal name or trade name. Blank/omitted returns all.
     *    "include"?: string, //Include derived data. `readiness` adds each company's issuing-readiness status.
     * } $queryParameters
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \Lenorix\BeelSdk\Generated\Exception\ListCompaniesBadRequestException
     * @throws \Lenorix\BeelSdk\Generated\Exception\ListCompaniesUnauthorizedException
     * @throws \Lenorix\BeelSdk\Generated\Exception\ListCompaniesForbiddenException
     * @throws \Lenorix\BeelSdk\Generated\Exception\ListCompaniesTooManyRequestsException
     * @throws \Lenorix\BeelSdk\Generated\Exception\ListCompaniesInternalServerErrorException
     *
     * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\ListCompanies200Response|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
     */
    public function listCompanies(string $accountId, array $queryParameters = [], string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\ListCompanies($accountId, $queryParameters), $fetch);
    }
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
    * @param string $accountId Your own account, or an account you provisioned. It — not the credential — decides which account the operation acts on; a `403` is returned when you do not reach it, the same response an account that does not exist gets.
    * @param \Lenorix\BeelSdk\Generated\Model\CreateCompanyRequest $requestBody
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
    
    * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
    * @throws \Lenorix\BeelSdk\Generated\Exception\CreateCompanyBadRequestException
    * @throws \Lenorix\BeelSdk\Generated\Exception\CreateCompanyUnauthorizedException
    * @throws \Lenorix\BeelSdk\Generated\Exception\CreateCompanyPaymentRequiredException
    * @throws \Lenorix\BeelSdk\Generated\Exception\CreateCompanyForbiddenException
    * @throws \Lenorix\BeelSdk\Generated\Exception\CreateCompanyConflictException
    * @throws \Lenorix\BeelSdk\Generated\Exception\CreateCompanyUnprocessableEntityException
    * @throws \Lenorix\BeelSdk\Generated\Exception\CreateCompanyTooManyRequestsException
    * @throws \Lenorix\BeelSdk\Generated\Exception\CreateCompanyInternalServerErrorException
    *
    * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\CompanyResponse201|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
    */
    public function createCompany(string $accountId, \Lenorix\BeelSdk\Generated\Model\CreateCompanyRequest $requestBody, array $headerParameters = [], string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\CreateCompany($accountId, $requestBody, $headerParameters), $fetch);
    }
    /**
     * Returns, for each company of the account, how many fiscal documents it has
     * issued and when it last issued one.
     *
     * - **`invoice_count`:** drafts, scheduled invoices and proformas are not counted; a
     *   rectifying invoice counts as a document of its own, and a voided invoice counts only
     *   when a live rectifying invoice compensates it.
     * - **`last_invoice_at`:** issue date of the most recent document in that same set, or
     *   `null` when there is none.
     * - **Not a cursor:** the count is not monotonic — voiding an uncompensated invoice
     *   lowers it and moves `last_invoice_at` backwards — so do not synchronise on it.
     *
     * **Paginated** with the usual `page`/`limit`, and the usual defaults: without them you get
     * the stats of the first 20 companies, not of all of them. One row per company, over the same
     * universe and in the same order as `GET /v1/accounts/{account_id}/companies` — `search`
     * included — so asking both with the same `page`, `limit` and `search` lines the two
     * responses up company by company.
     *
     * @param string $accountId Your own account, or an account you provisioned. It — not the credential — decides which account the operation acts on; a `403` is returned when you do not reach it, the same response an account that does not exist gets.
     * @param array{
     *    "page"?: int, //Page number, starting at 1. The response echoes it back as `pagination.current_page`.
     *    "limit"?: int, //How many items to return per page. The response echoes it back as `pagination.items_per_page`.
     *    "search"?: string, //Case-insensitive filter on NIF, legal name or trade name — the same filter, over the same universe, as the one `GET /v1/accounts/{account_id}/companies` applies. Blank or omitted returns all.
     * } $queryParameters
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \Lenorix\BeelSdk\Generated\Exception\ListCompanyStatsBadRequestException
     * @throws \Lenorix\BeelSdk\Generated\Exception\ListCompanyStatsUnauthorizedException
     * @throws \Lenorix\BeelSdk\Generated\Exception\ListCompanyStatsForbiddenException
     * @throws \Lenorix\BeelSdk\Generated\Exception\ListCompanyStatsTooManyRequestsException
     * @throws \Lenorix\BeelSdk\Generated\Exception\ListCompanyStatsInternalServerErrorException
     *
     * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\ListCompanyStats200Response|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
     */
    public function listCompanyStats(string $accountId, array $queryParameters = [], string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\ListCompanyStats($accountId, $queryParameters), $fetch);
    }
    /**
     * Removes a company from the account: it stops appearing and stops being billed.
     *
     * - **Existing invoices:** those already issued are retained, but the company-scoped API
     *   can no longer resolve them once the NIF is removed.
     * - **What blocks removal:** a NIF activated in Live
     *   (`409 COMPANY_ACTIVE_IN_PRODUCTION`), one holding any invoice in Live — issued, draft
     *   or proforma (`409 COMPANY_HAS_INVOICES`) — and the account's primary NIF
     *   (`400 CANNOT_DELETE_PRIMARY`).
     * - **Deactivating first:** switching off in Live is scheduled to the end of the paid
     *   cycle, so the removal only becomes possible once that takes effect.
     * - **Test:** NIFs never activated, or activated only in Test, are removed right away, and
     *   invoices in Test never block.
     * - **`Idempotency-Key`:** without one, a retry after a timeout answers `403` instead of
     *   the original `204`.
     *
     * @param string $companyId Unique identifier (UUID) of the company the operation acts on — its identifier, not its NIF. It is the only source of context: the account that owns it is derived from it, and the `BeeL-Active-Company` header plays no part. A company you do not reach answers `403`, and so does a company that does not exist, so the existence of a company in another account is never disclosed.
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \Lenorix\BeelSdk\Generated\Exception\DeleteCompanyByIdBadRequestException
     * @throws \Lenorix\BeelSdk\Generated\Exception\DeleteCompanyByIdUnauthorizedException
     * @throws \Lenorix\BeelSdk\Generated\Exception\DeleteCompanyByIdForbiddenException
     * @throws \Lenorix\BeelSdk\Generated\Exception\DeleteCompanyByIdConflictException
     * @throws \Lenorix\BeelSdk\Generated\Exception\DeleteCompanyByIdTooManyRequestsException
     * @throws \Lenorix\BeelSdk\Generated\Exception\DeleteCompanyByIdInternalServerErrorException
     *
     * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
     */
    public function deleteCompanyById(string $companyId, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\DeleteCompanyById($companyId), $fetch);
    }
    /**
     * Returns the identity and activation state of a company: its fiscal data, whether it
     * is switched on in Test and in Live, and its VeriFactu registration state.
     *
     * It also returns **every field `PATCH /v1/companies/{company_id}` accepts** — contact
     * details, legal representative, bank details, IAE, activity start date, payment term and
     * the rendering block — so what was written can be read back without keeping a copy of it.
     * A field never set comes back absent: that means "nothing stored", not "hidden".
     *
     * Its invoice series are not part of this response: read them from
     * `GET /v1/companies/{company_id}/series`.
     *
     * @param string $companyId Unique identifier (UUID) of the company the operation acts on — its identifier, not its NIF. It is the only source of context: the account that owns it is derived from it, and the `BeeL-Active-Company` header plays no part. A company you do not reach answers `403`, and so does a company that does not exist, so the existence of a company in another account is never disclosed.
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetCompanyByIdBadRequestException
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetCompanyByIdUnauthorizedException
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetCompanyByIdForbiddenException
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetCompanyByIdTooManyRequestsException
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetCompanyByIdInternalServerErrorException
     *
     * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\CompanyResponse|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
     */
    public function getCompanyById(string $companyId, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\GetCompanyById($companyId), $fetch);
    }
    /**
     * Updates the editable fields of a company; the set is the one
     * `UpdateCompanyRequest` declares.
     *
     * - **Immutable fields:** `nif`, `entity_type` and `legal_form`, once set.
     * - **`legal_name`:** changing it requires the NIF to pass an AEAT census re-validation —
     *   which for a company checks the CIF only, so it cannot fail because of the name sent.
     *
     * ## Test credentials on a Live company
     *
     * Once the company is activated in Live, a test credential may only write the fields that
     * affect how the invoice looks: `logo_url`, `invoice_accent_color`,
     * `invoice_template_type`, `invoice_language`, `email_language` and `additional_info`. Any
     * other field describes the real business — fiscal address, legal representative, bank
     * details, contact data, IAE, activity start date, payment term — and answers
     * `422 FISCAL_IDENTITY_LIVE_ONLY` from Test, since the company is a single record shared by
     * both modes. A company not activated in Live accepts the whole body from Test, and sending
     * a field its current value is never a change.
     *
     * ## What comes back
     *
     * The `200` returns `CompanyData` with **every field this request accepts**, under the same
     * name and the same type — so the response is the confirmation of what was stored, and a
     * later `GET` says the same. A field you never set comes back absent, which means "nothing
     * stored", not "hidden".
     *
     * Two things live outside this body and keep their own reads: the invoice series
     * (`GET /v1/companies/{company_id}/series`) and the rendering block, which is also served
     * on its own by `GET /v1/companies/{company_id}/invoice-customization`.
     *
     * @param string $companyId Unique identifier (UUID) of the company the operation acts on — its identifier, not its NIF. It is the only source of context: the account that owns it is derived from it, and the `BeeL-Active-Company` header plays no part. A company you do not reach answers `403`, and so does a company that does not exist, so the existence of a company in another account is never disclosed.
     * @param \Lenorix\BeelSdk\Generated\Model\UpdateCompanyRequest $requestBody
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \Lenorix\BeelSdk\Generated\Exception\PatchCompanyByIdUnauthorizedException
     * @throws \Lenorix\BeelSdk\Generated\Exception\PatchCompanyByIdForbiddenException
     * @throws \Lenorix\BeelSdk\Generated\Exception\PatchCompanyByIdUnprocessableEntityException
     * @throws \Lenorix\BeelSdk\Generated\Exception\PatchCompanyByIdTooManyRequestsException
     * @throws \Lenorix\BeelSdk\Generated\Exception\PatchCompanyByIdInternalServerErrorException
     *
     * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\CompanyResponse|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
     */
    public function patchCompanyById(string $companyId, \Lenorix\BeelSdk\Generated\Model\UpdateCompanyRequest $requestBody, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\PatchCompanyById($companyId, $requestBody), $fetch);
    }
    /**
     * Returns whether a company can issue its STANDARD invoice right now in the
     * environment of the request, and the `blockers` that stop it otherwise. Readiness is a
     * per-NIF property, evaluated independently for each company of the account.
     *
     * - **`ready`:** `true` only when `blockers` is empty.
     * - **Activation:** issuing any fiscal document requires the company to be activated in the
     *   environment of that document, whether or not it goes to VeriFactu.
     * - **VeriFactu chain:** the AEAT census and signed representation are additionally
     *   demanded only when the company is under the VeriFactu regime in this environment —
     *   the same fact that decides, at issue time, whether its invoices are registered. A
     *   company with VeriFactu off is ready with a NIF, a default series and an activation,
     *   and the separate `verifactu` block reports the compliance chain independently.
     * - **Not evaluated:** the account's quota or subscription, and the payload of any
     *   particular invoice.
     *
     * @param string $companyId Unique identifier (UUID) of the company whose issuing readiness is evaluated — its identifier, not its NIF. It is the only source of context: the account that owns it is derived from it, and the `BeeL-Active-Company` header plays no part. A company you do not reach answers `403`, and so does a company that does not exist.
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetCompanyIssuingReadinessBadRequestException
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetCompanyIssuingReadinessUnauthorizedException
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetCompanyIssuingReadinessForbiddenException
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetCompanyIssuingReadinessTooManyRequestsException
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetCompanyIssuingReadinessInternalServerErrorException
     *
     * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\IssuingReadinessResponse|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
     */
    public function getCompanyIssuingReadiness(string $companyId, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\GetCompanyIssuingReadiness($companyId), $fetch);
    }
    /**
    * Deprecated alias of `POST /v1/companies/{company_id}/representation`, with identical
    * behaviour.
    *
    * **Retires on 9 December 2026.** See the [migration guide](https://docs.beel.es/changelog/resources-under-the-nif) for what moved where and what changes when you switch.
    *
    * @param string $accountId Account that owns the NIF. The pair must be coherent, and which answer you get depends on how far you reach: an `{account_id}` you do not reach answers `403` before the NIF is even looked at (the same answer an account that does not exist gets); a `{company_id}` you do not reach, or reach at a level that does not allow the operation — the usual case on writes, since the level checked is the one you hold over the `{account_id}` of the path — answers `403` too; and only a `{company_id}` you do reach but that hangs from a different account answers `404`, so the existence of a NIF in another account is never disclosed.
    * @param string $companyId
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
    
    * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
    * @throws \Lenorix\BeelSdk\Generated\Exception\GenerateRepresentationBadRequestException
    * @throws \Lenorix\BeelSdk\Generated\Exception\GenerateRepresentationUnauthorizedException
    * @throws \Lenorix\BeelSdk\Generated\Exception\GenerateRepresentationForbiddenException
    * @throws \Lenorix\BeelSdk\Generated\Exception\GenerateRepresentationNotFoundException
    * @throws \Lenorix\BeelSdk\Generated\Exception\GenerateRepresentationInternalServerErrorException
    *
    * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\RepresentationActionResponse|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
    */
    public function generateRepresentation(string $accountId, string $companyId, array $headerParameters = [], string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\GenerateRepresentation($accountId, $companyId, $headerParameters), $fetch);
    }
    /**
     * Deprecated alias of `GET /v1/companies/{company_id}/representation/document`, with
     * identical behaviour.
     *
     * **Retires on 9 December 2026.** See the [migration guide](https://docs.beel.es/changelog/resources-under-the-nif) for what moved where and what changes when you switch.
     *
     * @param string $accountId Account that owns the NIF. The pair must be coherent, and which answer you get depends on how far you reach: an `{account_id}` you do not reach answers `403` before the NIF is even looked at (the same answer an account that does not exist gets); a `{company_id}` you do not reach, or reach at a level that does not allow the operation — the usual case on writes, since the level checked is the one you hold over the `{account_id}` of the path — answers `403` too; and only a `{company_id}` you do reach but that hangs from a different account answers `404`, so the existence of a NIF in another account is never disclosed.
     * @param string $companyId
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \Lenorix\BeelSdk\Generated\Exception\DownloadRepresentationUnauthorizedException
     * @throws \Lenorix\BeelSdk\Generated\Exception\DownloadRepresentationForbiddenException
     * @throws \Lenorix\BeelSdk\Generated\Exception\DownloadRepresentationNotFoundException
     * @throws \Lenorix\BeelSdk\Generated\Exception\DownloadRepresentationInternalServerErrorException
     *
     * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\RepresentationDownloadResponse|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
     */
    public function downloadRepresentation(string $accountId, string $companyId, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\DownloadRepresentation($accountId, $companyId), $fetch);
    }
    /**
    * Deprecated alias of `POST /v1/companies/{company_id}/representation/submit`, with
    * identical behaviour.
    *
    * **Retires on 9 December 2026.** See the [migration guide](https://docs.beel.es/changelog/resources-under-the-nif) for what moved where and what changes when you switch.
    *
    * @param string $accountId Account that owns the NIF. The pair must be coherent, and which answer you get depends on how far you reach: an `{account_id}` you do not reach answers `403` before the NIF is even looked at (the same answer an account that does not exist gets); a `{company_id}` you do not reach, or reach at a level that does not allow the operation — the usual case on writes, since the level checked is the one you hold over the `{account_id}` of the path — answers `403` too; and only a `{company_id}` you do reach but that hangs from a different account answers `404`, so the existence of a NIF in another account is never disclosed.
    * @param string $companyId
    * @param \Lenorix\BeelSdk\Generated\Model\V1AccountsAccountIdCompaniesCompanyIdRepresentationSubmitPostBody $requestBody
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
    
    * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
    * @throws \Lenorix\BeelSdk\Generated\Exception\SubmitRepresentationBadRequestException
    * @throws \Lenorix\BeelSdk\Generated\Exception\SubmitRepresentationUnauthorizedException
    * @throws \Lenorix\BeelSdk\Generated\Exception\SubmitRepresentationForbiddenException
    * @throws \Lenorix\BeelSdk\Generated\Exception\SubmitRepresentationNotFoundException
    * @throws \Lenorix\BeelSdk\Generated\Exception\SubmitRepresentationRequestEntityTooLargeException
    * @throws \Lenorix\BeelSdk\Generated\Exception\SubmitRepresentationInternalServerErrorException
    *
    * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\RepresentationActionResponse|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
    */
    public function submitRepresentation(string $accountId, string $companyId, \Lenorix\BeelSdk\Generated\Model\V1AccountsAccountIdCompaniesCompanyIdRepresentationSubmitPostBody $requestBody, array $headerParameters = [], string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\SubmitRepresentation($accountId, $companyId, $requestBody, $headerParameters), $fetch);
    }
    /**
     * Deprecated alias of `GET /v1/companies/{company_id}/representation`, with identical
     * behaviour.
     *
     * **Retires on 9 December 2026.** See the [migration guide](https://docs.beel.es/changelog/resources-under-the-nif) for what moved where and what changes when you switch.
     *
     * @param string $accountId Account that owns the NIF. The pair must be coherent, and which answer you get depends on how far you reach: an `{account_id}` you do not reach answers `403` before the NIF is even looked at (the same answer an account that does not exist gets); a `{company_id}` you do not reach, or reach at a level that does not allow the operation — the usual case on writes, since the level checked is the one you hold over the `{account_id}` of the path — answers `403` too; and only a `{company_id}` you do reach but that hangs from a different account answers `404`, so the existence of a NIF in another account is never disclosed.
     * @param string $companyId
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetRepresentationStatusUnauthorizedException
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetRepresentationStatusForbiddenException
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetRepresentationStatusNotFoundException
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetRepresentationStatusInternalServerErrorException
     *
     * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\RepresentationStatusResponse|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
     */
    public function getRepresentationStatus(string $accountId, string $companyId, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\GetRepresentationStatus($accountId, $companyId), $fetch);
    }
    /**
     * Deprecated predecessor of `DELETE /v1/companies/{company_id}/representation`. It cancels
     * the same representation, but answers `200` with a body where the canonical route answers
     * `204`.
     *
     * **Retires on 9 December 2026.** See the [migration guide](https://docs.beel.es/changelog/resources-under-the-nif) for what moved where and what changes when you switch.
     *
     * @param string $accountId Account that owns the NIF. The pair must be coherent, and which answer you get depends on how far you reach: an `{account_id}` you do not reach answers `403` before the NIF is even looked at (the same answer an account that does not exist gets); a `{company_id}` you do not reach, or reach at a level that does not allow the operation — the usual case on writes, since the level checked is the one you hold over the `{account_id}` of the path — answers `403` too; and only a `{company_id}` you do reach but that hangs from a different account answers `404`, so the existence of a NIF in another account is never disclosed.
     * @param string $companyId
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \Lenorix\BeelSdk\Generated\Exception\CancelRepresentationUnauthorizedException
     * @throws \Lenorix\BeelSdk\Generated\Exception\CancelRepresentationForbiddenException
     * @throws \Lenorix\BeelSdk\Generated\Exception\CancelRepresentationNotFoundException
     * @throws \Lenorix\BeelSdk\Generated\Exception\CancelRepresentationInternalServerErrorException
     *
     * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\RepresentationActionResponse|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
     */
    public function cancelRepresentation(string $accountId, string $companyId, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\CancelRepresentation($accountId, $companyId), $fetch);
    }
    /**
     * Cancels the active AEAT representation of a company.
     *
     * - **Effect:** until a new document is generated and signed, the company can no longer
     *   submit invoices to AEAT in production. Its activation and its ability to issue
     *   non-VeriFactu invoices are untouched.
     * - **No active representation:** rejected with `400`. Cancelling is a state transition, not
     *   a delete-if-present.
     *
     * @param string $companyId Unique identifier (UUID) of the company the operation acts on — its identifier, not its NIF. It is the only source of context: the account that owns it is derived from it, and the `BeeL-Active-Company` header plays no part. A company you do not reach answers `403`, and so does a company that does not exist, so the existence of a company in another account is never disclosed.
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \Lenorix\BeelSdk\Generated\Exception\CancelCompanyRepresentationBadRequestException
     * @throws \Lenorix\BeelSdk\Generated\Exception\CancelCompanyRepresentationUnauthorizedException
     * @throws \Lenorix\BeelSdk\Generated\Exception\CancelCompanyRepresentationForbiddenException
     * @throws \Lenorix\BeelSdk\Generated\Exception\CancelCompanyRepresentationTooManyRequestsException
     * @throws \Lenorix\BeelSdk\Generated\Exception\CancelCompanyRepresentationInternalServerErrorException
     *
     * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
     */
    public function cancelCompanyRepresentation(string $companyId, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\CancelCompanyRepresentation($companyId), $fetch);
    }
    /**
     * Returns the state of the AEAT fiscal representation of a company: whether the
     * document has been generated, signed and submitted, and whether AEAT accepted it or it was
     * cancelled.
     *
     * - **`status`:** `NOT_STARTED`, `PDF_GENERATED`, `SUBMITTED`, `ACTIVE`, `ERROR` or
     *   `CANCELLED`.
     * - **Never started:** not an error. The endpoint answers `200` with `NOT_STARTED`, so
     *   polling it is always safe.
     *
     * @param string $companyId Unique identifier (UUID) of the company the operation acts on — its identifier, not its NIF. It is the only source of context: the account that owns it is derived from it, and the `BeeL-Active-Company` header plays no part. A company you do not reach answers `403`, and so does a company that does not exist, so the existence of a company in another account is never disclosed.
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetCompanyRepresentationUnauthorizedException
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetCompanyRepresentationForbiddenException
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetCompanyRepresentationTooManyRequestsException
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetCompanyRepresentationInternalServerErrorException
     *
     * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\RepresentationStatusResponse|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
     */
    public function getCompanyRepresentation(string $companyId, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\GetCompanyRepresentation($companyId), $fetch);
    }
    /**
    * Generates the unsigned AEAT representation PDF of a company, the first step of the
    * representation flow.
    *
    * - **Next steps:** download the PDF from
    *   `GET /v1/companies/{company_id}/representation/document`, sign it digitally and return
    *   it through `POST /v1/companies/{company_id}/representation/submit`.
    * - **Fiscal identity:** must be complete before the document can be produced. An incomplete
    *   one is rejected with `400` naming what is missing.
    * - **Existing representation:** a company that already holds an active one is rejected too.
    *   Cancel it first.
    *
    * @param string $companyId Unique identifier (UUID) of the company the operation acts on — its identifier, not its NIF. It is the only source of context: the account that owns it is derived from it, and the `BeeL-Active-Company` header plays no part. A company you do not reach answers `403`, and so does a company that does not exist, so the existence of a company in another account is never disclosed.
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
    
    * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
    * @throws \Lenorix\BeelSdk\Generated\Exception\GenerateCompanyRepresentationBadRequestException
    * @throws \Lenorix\BeelSdk\Generated\Exception\GenerateCompanyRepresentationUnauthorizedException
    * @throws \Lenorix\BeelSdk\Generated\Exception\GenerateCompanyRepresentationForbiddenException
    * @throws \Lenorix\BeelSdk\Generated\Exception\GenerateCompanyRepresentationUnprocessableEntityException
    * @throws \Lenorix\BeelSdk\Generated\Exception\GenerateCompanyRepresentationTooManyRequestsException
    * @throws \Lenorix\BeelSdk\Generated\Exception\GenerateCompanyRepresentationInternalServerErrorException
    *
    * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\RepresentationActionResponse|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
    */
    public function generateCompanyRepresentation(string $companyId, array $headerParameters = [], string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\GenerateCompanyRepresentation($companyId, $headerParameters), $fetch);
    }
    /**
     * Returns a presigned URL, valid for 5 minutes, to download the representation PDF of a
     * company.
     *
     * - **Which copy:** while the document is unsigned it serves the generated one; once the
     *   signed copy has been submitted it serves that.
     * - **Not generated yet:** a company that has not generated the document is rejected with
     *   `400`.
     *
     * @param string $companyId Unique identifier (UUID) of the company the operation acts on — its identifier, not its NIF. It is the only source of context: the account that owns it is derived from it, and the `BeeL-Active-Company` header plays no part. A company you do not reach answers `403`, and so does a company that does not exist, so the existence of a company in another account is never disclosed.
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \Lenorix\BeelSdk\Generated\Exception\DownloadCompanyRepresentationDocumentBadRequestException
     * @throws \Lenorix\BeelSdk\Generated\Exception\DownloadCompanyRepresentationDocumentUnauthorizedException
     * @throws \Lenorix\BeelSdk\Generated\Exception\DownloadCompanyRepresentationDocumentForbiddenException
     * @throws \Lenorix\BeelSdk\Generated\Exception\DownloadCompanyRepresentationDocumentTooManyRequestsException
     * @throws \Lenorix\BeelSdk\Generated\Exception\DownloadCompanyRepresentationDocumentInternalServerErrorException
     *
     * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\RepresentationDownloadResponse|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
     */
    public function downloadCompanyRepresentationDocument(string $companyId, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\DownloadCompanyRepresentationDocument($companyId), $fetch);
    }
    /**
    * Uploads the digitally signed representation PDF of a company, sent as
    * `multipart/form-data` in the `file` field.
    *
    * - **Validation:** the signature is validated asynchronously, so a `200` means the document
    *   was accepted for validation, not that the representation is already active. Poll
    *   `GET /v1/companies/{company_id}/representation` for the outcome.
    *
    * @param string $companyId Unique identifier (UUID) of the company the operation acts on — its identifier, not its NIF. It is the only source of context: the account that owns it is derived from it, and the `BeeL-Active-Company` header plays no part. A company you do not reach answers `403`, and so does a company that does not exist, so the existence of a company in another account is never disclosed.
    * @param \Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdRepresentationSubmitPostBody $requestBody
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
    
    * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
    * @throws \Lenorix\BeelSdk\Generated\Exception\SubmitCompanyRepresentationBadRequestException
    * @throws \Lenorix\BeelSdk\Generated\Exception\SubmitCompanyRepresentationUnauthorizedException
    * @throws \Lenorix\BeelSdk\Generated\Exception\SubmitCompanyRepresentationForbiddenException
    * @throws \Lenorix\BeelSdk\Generated\Exception\SubmitCompanyRepresentationRequestEntityTooLargeException
    * @throws \Lenorix\BeelSdk\Generated\Exception\SubmitCompanyRepresentationTooManyRequestsException
    * @throws \Lenorix\BeelSdk\Generated\Exception\SubmitCompanyRepresentationInternalServerErrorException
    *
    * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\RepresentationActionResponse|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
    */
    public function submitCompanyRepresentation(string $companyId, \Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdRepresentationSubmitPostBody $requestBody, array $headerParameters = [], string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\SubmitCompanyRepresentation($companyId, $requestBody, $headerParameters), $fetch);
    }
    /**
     * Removes the logo of a company. Invoices rendered afterwards carry no logo, and
     * already issued documents are unchanged. Deleting an absent logo also returns `204`.
     *
     * @param string $companyId Unique identifier (UUID) of the company the operation acts on — its identifier, not its NIF. It is the only source of context: the account that owns it is derived from it, and the `BeeL-Active-Company` header plays no part. A company you do not reach answers `403`, and so does a company that does not exist, so the existence of a company in another account is never disclosed.
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \Lenorix\BeelSdk\Generated\Exception\DeleteCompanyLogoByIdUnauthorizedException
     * @throws \Lenorix\BeelSdk\Generated\Exception\DeleteCompanyLogoByIdForbiddenException
     * @throws \Lenorix\BeelSdk\Generated\Exception\DeleteCompanyLogoByIdTooManyRequestsException
     * @throws \Lenorix\BeelSdk\Generated\Exception\DeleteCompanyLogoByIdInternalServerErrorException
     *
     * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
     */
    public function deleteCompanyLogoById(string $companyId, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\DeleteCompanyLogoById($companyId), $fetch);
    }
    /**
    * Uploads the logo printed on the invoices issued by a company, sent as
    * `multipart/form-data` in the `file` field and replacing the previous one if there was any.
    *
    * - **Formats:** JPEG and PNG, up to 1 MB.
    * - **Processing:** the image is validated, resized to fit within 300x300 pixels keeping
    *   its aspect ratio, and stored. The response carries the resulting `logo_url`.
    *
    * @param string $companyId Unique identifier (UUID) of the company the operation acts on — its identifier, not its NIF. It is the only source of context: the account that owns it is derived from it, and the `BeeL-Active-Company` header plays no part. A company you do not reach answers `403`, and so does a company that does not exist, so the existence of a company in another account is never disclosed.
    * @param \Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdLogoPutBody $requestBody
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
    
    * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
    * @throws \Lenorix\BeelSdk\Generated\Exception\UploadCompanyLogoByIdUnauthorizedException
    * @throws \Lenorix\BeelSdk\Generated\Exception\UploadCompanyLogoByIdForbiddenException
    * @throws \Lenorix\BeelSdk\Generated\Exception\UploadCompanyLogoByIdRequestEntityTooLargeException
    * @throws \Lenorix\BeelSdk\Generated\Exception\UploadCompanyLogoByIdUnprocessableEntityException
    * @throws \Lenorix\BeelSdk\Generated\Exception\UploadCompanyLogoByIdTooManyRequestsException
    * @throws \Lenorix\BeelSdk\Generated\Exception\UploadCompanyLogoByIdInternalServerErrorException
    *
    * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdLogoPutResponse200|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
    */
    public function uploadCompanyLogoById(string $companyId, \Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdLogoPutBody $requestBody, array $headerParameters = [], string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\UploadCompanyLogoById($companyId, $requestBody, $headerParameters), $fetch);
    }
    /**
     * Returns how the invoices of a company are rendered and delivered: PDF template,
     * accent colour, invoice language, email language and current logo. Customization is a
     * per-NIF property, so each company of the account carries its own.
     *
     * The catalogue of available templates and suggested colours is served by
     * `GET /v1/invoice-customization-options`.
     *
     * @param string $companyId Unique identifier (UUID) of the company the operation acts on — its identifier, not its NIF. It is the only source of context: the account that owns it is derived from it, and the `BeeL-Active-Company` header plays no part. A company you do not reach answers `403`, and so does a company that does not exist, so the existence of a company in another account is never disclosed.
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetCompanyInvoiceCustomizationUnauthorizedException
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetCompanyInvoiceCustomizationForbiddenException
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetCompanyInvoiceCustomizationTooManyRequestsException
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetCompanyInvoiceCustomizationInternalServerErrorException
     *
     * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdInvoiceCustomizationGetResponse200|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
     */
    public function getCompanyInvoiceCustomization(string $companyId, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\GetCompanyInvoiceCustomization($companyId), $fetch);
    }
    /**
    * Updates how the invoices of a company are rendered and delivered: PDF template,
    * accent colour, invoice language and email language. Only the properties present in the
    * request body are modified, and the logo is managed through the `logo` sub-resource.
    *
    * The change applies to invoices rendered after it and does not alter already issued
    * documents.
    *
    * @param string $companyId Unique identifier (UUID) of the company the operation acts on — its identifier, not its NIF. It is the only source of context: the account that owns it is derived from it, and the `BeeL-Active-Company` header plays no part. A company you do not reach answers `403`, and so does a company that does not exist, so the existence of a company in another account is never disclosed.
    * @param \Lenorix\BeelSdk\Generated\Model\UpdateInvoiceCustomizationRequest $requestBody
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
    
    * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
    * @throws \Lenorix\BeelSdk\Generated\Exception\UpdateCompanyInvoiceCustomizationBadRequestException
    * @throws \Lenorix\BeelSdk\Generated\Exception\UpdateCompanyInvoiceCustomizationUnauthorizedException
    * @throws \Lenorix\BeelSdk\Generated\Exception\UpdateCompanyInvoiceCustomizationForbiddenException
    * @throws \Lenorix\BeelSdk\Generated\Exception\UpdateCompanyInvoiceCustomizationConflictException
    * @throws \Lenorix\BeelSdk\Generated\Exception\UpdateCompanyInvoiceCustomizationUnprocessableEntityException
    * @throws \Lenorix\BeelSdk\Generated\Exception\UpdateCompanyInvoiceCustomizationTooManyRequestsException
    * @throws \Lenorix\BeelSdk\Generated\Exception\UpdateCompanyInvoiceCustomizationInternalServerErrorException
    *
    * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdInvoiceCustomizationPutResponse200|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
    */
    public function updateCompanyInvoiceCustomization(string $companyId, \Lenorix\BeelSdk\Generated\Model\UpdateInvoiceCustomizationRequest $requestBody, array $headerParameters = [], string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\UpdateCompanyInvoiceCustomization($companyId, $requestBody, $headerParameters), $fetch);
    }
    /**
     * Retrieves the VeriFactu configuration of this company. The configuration belongs to
     * the NIF, so the NIF in the path is what decides which one is returned.
     *
     * @param string $companyId Unique identifier (UUID) of the company the operation acts on — its identifier, not its NIF. It is the only source of context: the account that owns it is derived from it, and the `BeeL-Active-Company` header plays no part. A company you do not reach answers `403`, and so does a company that does not exist, so the existence of a company in another account is never disclosed.
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetCompanyVeriFactuConfigurationBadRequestException
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetCompanyVeriFactuConfigurationUnauthorizedException
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetCompanyVeriFactuConfigurationForbiddenException
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetCompanyVeriFactuConfigurationTooManyRequestsException
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetCompanyVeriFactuConfigurationInternalServerErrorException
     *
     * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdVerifactuConfigurationGetResponse200|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
     */
    public function getCompanyVeriFactuConfiguration(string $companyId, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\GetCompanyVeriFactuConfiguration($companyId), $fetch);
    }
    /**
     * Replaces the VeriFactu configuration of a company.
     *
     * - **Writable fields:** only `enabled`, and it is required — this is a full replacement, not
     *   a partial merge. The rest of the returned configuration is resolved server-side.
     * - **Turning it on registers the NIF with the provider in the same call**, atomically: if the
     *   provider rejects it nothing is persisted and the response carries the reason. In Live it
     *   requires a signed and validated AEAT representation first, or
     *   `422 VERIFACTU_REPRESENTATION_REQUIRED`.
     * - **Sandbox is always on:** `enabled: false` there answers
     *   `422 VERIFACTU_ALWAYS_ON_IN_SANDBOX`.
     *
     * ## Turning it off
     *
     * Setting `enabled` to false stops sending this company's invoices to AEAT and starts the
     * deregistration of the NIF with the VeriFactu provider. It does not deactivate the
     * company: the activation is a fact of its own for the (company, environment) pair, so the
     * company keeps issuing in that environment and stays `ready`. Releasing the NIF — and in
     * Live freeing it for another account — is always
     * `DELETE /v1/companies/{company_id}/activations`.
     *
     * @param string $companyId Unique identifier (UUID) of the company the operation acts on — its identifier, not its NIF. It is the only source of context: the account that owns it is derived from it, and the `BeeL-Active-Company` header plays no part. A company you do not reach answers `403`, and so does a company that does not exist, so the existence of a company in another account is never disclosed.
     * @param \Lenorix\BeelSdk\Generated\Model\UpdateVeriFactuConfigurationRequest $requestBody
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \Lenorix\BeelSdk\Generated\Exception\UpdateCompanyVeriFactuConfigurationBadRequestException
     * @throws \Lenorix\BeelSdk\Generated\Exception\UpdateCompanyVeriFactuConfigurationUnauthorizedException
     * @throws \Lenorix\BeelSdk\Generated\Exception\UpdateCompanyVeriFactuConfigurationForbiddenException
     * @throws \Lenorix\BeelSdk\Generated\Exception\UpdateCompanyVeriFactuConfigurationUnprocessableEntityException
     * @throws \Lenorix\BeelSdk\Generated\Exception\UpdateCompanyVeriFactuConfigurationTooManyRequestsException
     * @throws \Lenorix\BeelSdk\Generated\Exception\UpdateCompanyVeriFactuConfigurationInternalServerErrorException
     *
     * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdVerifactuConfigurationPutResponse200|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
     */
    public function updateCompanyVeriFactuConfiguration(string $companyId, \Lenorix\BeelSdk\Generated\Model\UpdateVeriFactuConfigurationRequest $requestBody, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\UpdateCompanyVeriFactuConfiguration($companyId, $requestBody), $fetch);
    }
    /**
     * Returns the tax configuration of a company: its default main tax (`IVA`, `IGIC`,
     * `IPSI` or `OTHER`) with the default percentage and regime key, the default exemption
     * reason, its IRPF and equivalence surcharge settings, and the default payment method and
     * payment term.
     *
     * The catalogue of tax types this configuration draws from is not company data and lives
     * outside this resource.
     *
     * @param string $companyId Unique identifier (UUID) of the company the operation acts on — its identifier, not its NIF. It is the only source of context: the account that owns it is derived from it, and the `BeeL-Active-Company` header plays no part. A company you do not reach answers `403`, and so does a company that does not exist, so the existence of a company in another account is never disclosed.
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetCompanyTaxConfigurationBadRequestException
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetCompanyTaxConfigurationUnauthorizedException
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetCompanyTaxConfigurationForbiddenException
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetCompanyTaxConfigurationTooManyRequestsException
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetCompanyTaxConfigurationInternalServerErrorException
     *
     * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdTaxConfigurationGetResponse200|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
     */
    public function getCompanyTaxConfiguration(string $companyId, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\GetCompanyTaxConfiguration($companyId), $fetch);
    }
    /**
     * Updates the tax configuration of a company. Fields you omit keep their current
     * value; `default_main_tax`, when sent, replaces the stored one wholesale.
     *
     * - **Regime coherence:** the main tax and its VeriFactu regime key must be coherent. Regime
     *   key `18` (equivalence surcharge) only exists for `IVA`, so pairing it with any other
     *   regime answers `422 INVALID_REGIME_KEY_FOR_TAX_TYPE`, with `details` naming the rejected
     *   key, the tax type and the keys that type admits.
     * - **Surcharge:** applying the surcharge without regime key `18` answers `422`
     *   `RECARGO_REQUIRES_REGIME_RE`.
     * - **Exemption reason:** `default_exemption_reason` travels with `default_main_tax` —
     *   sending the tax without a reason clears the stored one, and sending only the reason
     *   applies it to the tax already stored.
     *
     * @param string $companyId Unique identifier (UUID) of the company the operation acts on — its identifier, not its NIF. It is the only source of context: the account that owns it is derived from it, and the `BeeL-Active-Company` header plays no part. A company you do not reach answers `403`, and so does a company that does not exist, so the existence of a company in another account is never disclosed.
     * @param \Lenorix\BeelSdk\Generated\Model\UpdateTaxConfigurationRequest $requestBody
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \Lenorix\BeelSdk\Generated\Exception\UpdateCompanyTaxConfigurationBadRequestException
     * @throws \Lenorix\BeelSdk\Generated\Exception\UpdateCompanyTaxConfigurationUnauthorizedException
     * @throws \Lenorix\BeelSdk\Generated\Exception\UpdateCompanyTaxConfigurationForbiddenException
     * @throws \Lenorix\BeelSdk\Generated\Exception\UpdateCompanyTaxConfigurationUnprocessableEntityException
     * @throws \Lenorix\BeelSdk\Generated\Exception\UpdateCompanyTaxConfigurationTooManyRequestsException
     * @throws \Lenorix\BeelSdk\Generated\Exception\UpdateCompanyTaxConfigurationInternalServerErrorException
     *
     * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdTaxConfigurationPutResponse200|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
     */
    public function updateCompanyTaxConfiguration(string $companyId, \Lenorix\BeelSdk\Generated\Model\UpdateTaxConfigurationRequest $requestBody, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\UpdateCompanyTaxConfiguration($companyId, $requestBody), $fetch);
    }
    /**
    * Returns the invoice series of a company.
    *
    * - **Filters:** `active` restricts to active or inactive series — omit it and you get all of
    *   them. `document_type` filters by type and always includes the `UNASSIGNED` series, which
    *   are compatible with any type.
    * - **Pagination (opt-in):** send `page` and/or `limit` to receive a single page plus a
    *   `data.pagination` block with the totals. Omit both and the response carries the full list
    *   in `data.series` and no `pagination` block.
    *
    * @param string $companyId Unique identifier (UUID) of the company the operation acts on — its identifier, not its NIF. It is the only source of context: the account that owns it is derived from it, and the `BeeL-Active-Company` header plays no part. A company you do not reach answers `403`, and so does a company that does not exist, so the existence of a company in another account is never disclosed.
    * @param array{
    *    "active"?: bool, //Filters by activity: `true` returns only active series, `false` only inactive ones.
    Omit it and you get **all** the series, active and inactive.
    *    "document_type"?: string, //Filter by document type (UNASSIGNED series are always included)
    *    "page"?: int, //Page number (starts at 1). Omit for the full, unpaginated list.
    *    "limit"?: int, //Items per page. Omit for the full, unpaginated list.
    * } $queryParameters
    
    * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
    * @throws \Lenorix\BeelSdk\Generated\Exception\ListCompanySeriesBadRequestException
    * @throws \Lenorix\BeelSdk\Generated\Exception\ListCompanySeriesUnauthorizedException
    * @throws \Lenorix\BeelSdk\Generated\Exception\ListCompanySeriesForbiddenException
    * @throws \Lenorix\BeelSdk\Generated\Exception\ListCompanySeriesUnprocessableEntityException
    * @throws \Lenorix\BeelSdk\Generated\Exception\ListCompanySeriesTooManyRequestsException
    * @throws \Lenorix\BeelSdk\Generated\Exception\ListCompanySeriesInternalServerErrorException
    *
    * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdSeriesGetResponse200|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
    */
    public function listCompanySeries(string $companyId, array $queryParameters = [], string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\ListCompanySeries($companyId, $queryParameters), $fetch);
    }
    /**
    * Creates an invoice series under a company.
    *
    * - **Code:** must be unique within the company; a code already taken answers `409`.
    * - **Numbering:** `format` must contain `{NUM}` or `{NUM:X}` and only accepts uppercase
    *   tokens. `counter_reset` defaults to `ANNUAL`, so a format with no year token has to be
    *   sent with `counter_reset: NEVER`.
    * - **Default series:** the first series created for a document type is marked as default
    *   even if you send `default_series: false`.
    *
    * @param string $companyId Unique identifier (UUID) of the company the operation acts on — its identifier, not its NIF. It is the only source of context: the account that owns it is derived from it, and the `BeeL-Active-Company` header plays no part. A company you do not reach answers `403`, and so does a company that does not exist, so the existence of a company in another account is never disclosed.
    * @param \Lenorix\BeelSdk\Generated\Model\CreateSeriesRequest $requestBody
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
    
    * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
    * @throws \Lenorix\BeelSdk\Generated\Exception\CreateCompanySeriesBadRequestException
    * @throws \Lenorix\BeelSdk\Generated\Exception\CreateCompanySeriesUnauthorizedException
    * @throws \Lenorix\BeelSdk\Generated\Exception\CreateCompanySeriesForbiddenException
    * @throws \Lenorix\BeelSdk\Generated\Exception\CreateCompanySeriesConflictException
    * @throws \Lenorix\BeelSdk\Generated\Exception\CreateCompanySeriesUnprocessableEntityException
    * @throws \Lenorix\BeelSdk\Generated\Exception\CreateCompanySeriesTooManyRequestsException
    * @throws \Lenorix\BeelSdk\Generated\Exception\CreateCompanySeriesInternalServerErrorException
    *
    * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdSeriesPostResponse201|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
    */
    public function createCompanySeries(string $companyId, \Lenorix\BeelSdk\Generated\Model\CreateSeriesRequest $requestBody, array $headerParameters = [], string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\CreateCompanySeries($companyId, $requestBody, $headerParameters), $fetch);
    }
    /**
     * Reports, for each `DocumentType` used by automatic invoicing flows, whether the company
     * (NIF) has a default invoice series and which one: `exists`, plus the `series_id` when there
     * is one.
     *
     * - **No default:** that document type cannot be issued without naming a `series_id`
     *   explicitly, and automatic flows skip it with
     *   `failure.payment.skip.missing_default_series`.
     * - **Environment:** resolved from the request context; it takes no input.
     *
     * **Closed catalogue.** This collection is fixed and bounded — one entry per `DocumentType`:
     * it carries no `pagination`, it takes no `page`/`limit`, and every response holds the whole
     * set.
     *
     * @param string $companyId Unique identifier (UUID) of the company the operation acts on — its identifier, not its NIF. It is the only source of context: the account that owns it is derived from it, and the `BeeL-Active-Company` header plays no part. A company you do not reach answers `403`, and so does a company that does not exist, so the existence of a company in another account is never disclosed.
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetCompanyDefaultSeriesBadRequestException
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetCompanyDefaultSeriesUnauthorizedException
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetCompanyDefaultSeriesForbiddenException
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetCompanyDefaultSeriesTooManyRequestsException
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetCompanyDefaultSeriesInternalServerErrorException
     *
     * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdSeriesDefaultsGetResponse200|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
     */
    public function getCompanyDefaultSeries(string $companyId, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\GetCompanyDefaultSeries($companyId), $fetch);
    }
    /**
    * Ensures the company has a default invoice series for `STANDARD`, `SIMPLIFIED` and
    * `CORRECTIVE` in the current environment, and returns the resulting set. The request takes
    * no body: the desired end state is one default per document type, so repeating it changes
    * nothing.
    *
    * - **Already there:** a document type that already has a default keeps it, and it is
    *   returned unchanged.
    * - **Missing:** it is created with code `F`, `S` or `R` and format
    *   `{CODIGO}-{YYYY}-{NUM:4}`, active and marked as default.
    * - **Code taken:** if that code already belongs to another series, the document type is
    *   omitted from the response and is left with no default.
    *
    * **Closed catalogue.** This collection is fixed and bounded — one entry per `DocumentType`:
    * it carries no `pagination`, it takes no `page`/`limit`, and every response holds the whole
    * set.
    *
    * @param string $companyId Unique identifier (UUID) of the company the operation acts on — its identifier, not its NIF. It is the only source of context: the account that owns it is derived from it, and the `BeeL-Active-Company` header plays no part. A company you do not reach answers `403`, and so does a company that does not exist, so the existence of a company in another account is never disclosed.
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
    
    * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
    * @throws \Lenorix\BeelSdk\Generated\Exception\EnsureCompanyDefaultSeriesUnauthorizedException
    * @throws \Lenorix\BeelSdk\Generated\Exception\EnsureCompanyDefaultSeriesForbiddenException
    * @throws \Lenorix\BeelSdk\Generated\Exception\EnsureCompanyDefaultSeriesTooManyRequestsException
    * @throws \Lenorix\BeelSdk\Generated\Exception\EnsureCompanyDefaultSeriesInternalServerErrorException
    *
    * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdSeriesDefaultsPutResponse200|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
    */
    public function ensureCompanyDefaultSeries(string $companyId, array $headerParameters = [], string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\EnsureCompanyDefaultSeries($companyId, $headerParameters), $fetch);
    }
    /**
     * Soft-deletes an invoice series, deactivating it first if it is active.
     *
     * - **The code is not released:** it stays taken after the deletion because it identifies the
     *   invoices already issued under it, so recreating a series with the same code answers
     *   `409 SERIES_CODE_DUPLICATED`.
     * - **Default series:** it cannot be deleted while another active series of the same document
     *   type exists — promote that other one first. If it is the only series of its type it is
     *   deleted and the type is left with none, a valid state in which issuing without an
     *   explicit `series_id` answers `SERIES_DEFAULT_NOT_FOUND`.
     *
     * @param string $companyId Unique identifier (UUID) of the company the operation acts on — its identifier, not its NIF. It is the only source of context: the account that owns it is derived from it, and the `BeeL-Active-Company` header plays no part. A company you do not reach answers `403`, and so does a company that does not exist, so the existence of a company in another account is never disclosed.
     * @param string $seriesId Series ID
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \Lenorix\BeelSdk\Generated\Exception\DeleteCompanySeriesBadRequestException
     * @throws \Lenorix\BeelSdk\Generated\Exception\DeleteCompanySeriesUnauthorizedException
     * @throws \Lenorix\BeelSdk\Generated\Exception\DeleteCompanySeriesForbiddenException
     * @throws \Lenorix\BeelSdk\Generated\Exception\DeleteCompanySeriesNotFoundException
     * @throws \Lenorix\BeelSdk\Generated\Exception\DeleteCompanySeriesTooManyRequestsException
     * @throws \Lenorix\BeelSdk\Generated\Exception\DeleteCompanySeriesInternalServerErrorException
     *
     * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
     */
    public function deleteCompanySeries(string $companyId, string $seriesId, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\DeleteCompanySeries($companyId, $seriesId), $fetch);
    }
    /**
     * Returns one invoice series of a company, with its code, format, counter state,
     * document type and whether it is the default of that type.
     *
     * @param string $companyId Unique identifier (UUID) of the company the operation acts on — its identifier, not its NIF. It is the only source of context: the account that owns it is derived from it, and the `BeeL-Active-Company` header plays no part. A company you do not reach answers `403`, and so does a company that does not exist, so the existence of a company in another account is never disclosed.
     * @param string $seriesId Series ID
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetCompanySeriesBadRequestException
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetCompanySeriesUnauthorizedException
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetCompanySeriesForbiddenException
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetCompanySeriesNotFoundException
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetCompanySeriesTooManyRequestsException
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetCompanySeriesInternalServerErrorException
     *
     * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdSeriesSeriesIdGetResponse200|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
     */
    public function getCompanySeries(string $companyId, string $seriesId, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\GetCompanySeries($companyId, $seriesId), $fetch);
    }
    /**
     * Updates only the fields present in the body, leaving every other field of the series as
     * it is.
     *
     * - **Clearing a field:** a field sent as `null` is cleared, which only `description`
     *   supports.
     * - **Numbering fields:** `code`, `format`, `counter_reset` and `initial_number` are rejected
     *   once the series has issued invoices (`numbering_locked` is `true`).
     * - **`default_series`:** it cannot be used to clear the default. Sending `false` for the
     *   series that currently is the default answers `DEFAULT_CANNOT_BE_UNMARKED`, because it
     *   would leave the document type with active series and no default, and issuing without an
     *   explicit `series_id` would then fail with `SERIES_DEFAULT_NOT_FOUND`. Hand the default
     *   over with `PUT /v1/companies/{company_id}/series/{series_id}/default` on the new series,
     *   which unmarks the previous one. Sending `false` for a series that is not the default is a
     *   no-op.
     *
     * @param string $companyId Unique identifier (UUID) of the company the operation acts on — its identifier, not its NIF. It is the only source of context: the account that owns it is derived from it, and the `BeeL-Active-Company` header plays no part. A company you do not reach answers `403`, and so does a company that does not exist, so the existence of a company in another account is never disclosed.
     * @param string $seriesId Series ID
     * @param \Lenorix\BeelSdk\Generated\Model\PatchSeriesRequest $requestBody
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \Lenorix\BeelSdk\Generated\Exception\PatchCompanySeriesBadRequestException
     * @throws \Lenorix\BeelSdk\Generated\Exception\PatchCompanySeriesUnauthorizedException
     * @throws \Lenorix\BeelSdk\Generated\Exception\PatchCompanySeriesForbiddenException
     * @throws \Lenorix\BeelSdk\Generated\Exception\PatchCompanySeriesNotFoundException
     * @throws \Lenorix\BeelSdk\Generated\Exception\PatchCompanySeriesUnprocessableEntityException
     * @throws \Lenorix\BeelSdk\Generated\Exception\PatchCompanySeriesTooManyRequestsException
     * @throws \Lenorix\BeelSdk\Generated\Exception\PatchCompanySeriesInternalServerErrorException
     *
     * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdSeriesSeriesIdPatchResponse200|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
     */
    public function patchCompanySeries(string $companyId, string $seriesId, \Lenorix\BeelSdk\Generated\Model\PatchSeriesRequest $requestBody, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\PatchCompanySeries($companyId, $seriesId, $requestBody), $fetch);
    }
    /**
    * Marks an invoice series as the default of its document type for this company, and
    * unmarks the previous one.
    *
    * - **One per type:** only one series can be the default per company and document type.
    * - **Must be active:** an inactive series is rejected with `400`.
    * - **Idempotent:** repeating the call changes nothing.
    *
    * @param string $companyId Unique identifier (UUID) of the company the operation acts on — its identifier, not its NIF. It is the only source of context: the account that owns it is derived from it, and the `BeeL-Active-Company` header plays no part. A company you do not reach answers `403`, and so does a company that does not exist, so the existence of a company in another account is never disclosed.
    * @param string $seriesId Series ID to mark as default
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
    
    * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
    * @throws \Lenorix\BeelSdk\Generated\Exception\SetCompanyDefaultSeriesBadRequestException
    * @throws \Lenorix\BeelSdk\Generated\Exception\SetCompanyDefaultSeriesUnauthorizedException
    * @throws \Lenorix\BeelSdk\Generated\Exception\SetCompanyDefaultSeriesForbiddenException
    * @throws \Lenorix\BeelSdk\Generated\Exception\SetCompanyDefaultSeriesNotFoundException
    * @throws \Lenorix\BeelSdk\Generated\Exception\SetCompanyDefaultSeriesConflictException
    * @throws \Lenorix\BeelSdk\Generated\Exception\SetCompanyDefaultSeriesTooManyRequestsException
    * @throws \Lenorix\BeelSdk\Generated\Exception\SetCompanyDefaultSeriesInternalServerErrorException
    *
    * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdSeriesSeriesIdDefaultPutResponse200|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
    */
    public function setCompanyDefaultSeries(string $companyId, string $seriesId, array $headerParameters = [], string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\SetCompanyDefaultSeries($companyId, $seriesId, $headerParameters), $fetch);
    }
    /**
     * Switches the company off in the mode given by `environment`; the other mode is
     * untouched.
     *
     * - **Sealed, not deleted:** the activation's history survives. After the switch-off takes
     *   effect the NIF can neither issue nor correct invoices in that mode until it is switched
     *   on again, and in Live that sealing is what releases the NIF for another account.
     *
     * ## When it takes effect
     *
     * - **In Live the switch-off is scheduled, not immediate:** the cycle is paid up front, so
     *   the response carries an `effective_at` and the NIF keeps invoicing until then. Nothing is
     *   refunded. `effective_at` is the end of the current billing cycle, unless the NIF was
     *   switched on within that same cycle, in which case it is the end of the next one.
     * - **`TEST`, and `PROD` under an enterprise contract:** immediate, and answer with no
     *   `effective_at`.
     *
     * ## Repeats and permissions
     *
     * - **Repeating the call:** on a mode whose switch-off is already pending it returns the same
     *   date with `already_scheduled: true`; switching off a mode that was never on is a silent
     *   no-op.
     * - **Permission:** switching off in Live requires being the billing subject of the account.
     *
     * @param string $companyId Unique identifier (UUID) of the company being switched on — its identifier, not its NIF. It is the only source of context: the account that owns it is derived from it, and the `BeeL-Active-Company` header plays no part. A company you do not reach answers `403`, and so does a company that does not exist, so the existence of a company in another account is never disclosed.
     * @param array{
     *    "environment": string, //Mode to switch the NIF off in.
     * } $queryParameters
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \Lenorix\BeelSdk\Generated\Exception\DeactivateCompanyByIdUnauthorizedException
     * @throws \Lenorix\BeelSdk\Generated\Exception\DeactivateCompanyByIdForbiddenException
     * @throws \Lenorix\BeelSdk\Generated\Exception\DeactivateCompanyByIdTooManyRequestsException
     * @throws \Lenorix\BeelSdk\Generated\Exception\DeactivateCompanyByIdInternalServerErrorException
     *
     * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdActivationsDeleteResponse200|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
     */
    public function deactivateCompanyById(string $companyId, array $queryParameters = [], string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\DeactivateCompanyById($companyId, $queryParameters), $fetch);
    }
    /**
    * Switches an existing company on in the mode carried in the body. The mode is always
    * explicit and never taken from the credential's environment, so a Test key can switch a NIF
    * on in Live.
    *
    * ## Modes and billing
    *
    * - **`TEST`:** immediate and free.
    * - **`PROD`:** immediate when the account already has a card on file or an enterprise
    *   contract, and the NIF is added to the existing subscription. With no card on file it
    *   answers `402 CHECKOUT_REQUIRED`, returning a `checkout_url` when `success_url` and
    *   `cancel_url` are supplied. It also requires being the billing subject of the account
    *   (`403 NOT_BILLING_OWNER` otherwise).
    *
    * ## Idempotency and pending switch-offs
    *
    * - **Repeating the call:** opens no second checkout and adds no second subscription item; it
    *   returns the existing activation with `already_active: true`. The same `Idempotency-Key`
    *   sent to this route and to the nested one it replaces is the same operation, so it is
    *   replayed and never charged twice.
    * - **A pending switch-off is cancelled:** while it is pending the NIF is still on — it just
    *   carries an effective date — so switching it on again only removes that date, answers
    *   `scheduled_deactivation_cancelled: true`, and charges or credits nothing.
    *
    * @param string $companyId Unique identifier (UUID) of the company being switched on — its identifier, not its NIF. It is the only source of context: the account that owns it is derived from it, and the `BeeL-Active-Company` header plays no part. A company you do not reach answers `403`, and so does a company that does not exist, so the existence of a company in another account is never disclosed.
    * @param \Lenorix\BeelSdk\Generated\Model\ActivateCompanyRequest $requestBody
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
    
    * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
    * @throws \Lenorix\BeelSdk\Generated\Exception\ActivateCompanyByIdBadRequestException
    * @throws \Lenorix\BeelSdk\Generated\Exception\ActivateCompanyByIdUnauthorizedException
    * @throws \Lenorix\BeelSdk\Generated\Exception\ActivateCompanyByIdPaymentRequiredException
    * @throws \Lenorix\BeelSdk\Generated\Exception\ActivateCompanyByIdForbiddenException
    * @throws \Lenorix\BeelSdk\Generated\Exception\ActivateCompanyByIdConflictException
    * @throws \Lenorix\BeelSdk\Generated\Exception\ActivateCompanyByIdTooManyRequestsException
    * @throws \Lenorix\BeelSdk\Generated\Exception\ActivateCompanyByIdInternalServerErrorException
    *
    * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\CompanyActivationResponse|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
    */
    public function activateCompanyById(string $companyId, \Lenorix\BeelSdk\Generated\Model\ActivateCompanyRequest $requestBody, array $headerParameters = [], string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\ActivateCompanyById($companyId, $requestBody, $headerParameters), $fetch);
    }
    /**
     * Returns the payment provider connections of a company your account **owns or
     * manages**, with the provider-side account each one points at and its `status`. Use it to
     * check whether a NIF you provisioned has completed its connection.
     *
     * - **A NIF with no connections:** answers `200` with an empty list.
     * - **`environment`:** Test and Live connections are independent, so only the ones living in
     *   the mode of the key you ask with are returned; this field states which.
     *
     * **Closed catalogue.** A NIF is not limited to one connection per provider: within a single
     * environment it may hold several of the same provider, one per external account. What is
     * unique is the external account itself — one live connection per provider, environment and
     * external account. The set is still bounded and unpaginated: the collection carries no
     * `pagination` and takes no `page`/`limit`, and every response holds the whole set for the
     * environment of the key you ask with.
     *
     * @param string $companyId Unique identifier (UUID) of the company the operation acts on — its identifier, not its NIF. It is the only source of context: the account that owns it is derived from it, and the `BeeL-Active-Company` header plays no part. A company you do not reach answers `403`, and so does a company that does not exist, so the existence of a company in another account is never disclosed.
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \Lenorix\BeelSdk\Generated\Exception\ListCompanyPaymentConnectionsBadRequestException
     * @throws \Lenorix\BeelSdk\Generated\Exception\ListCompanyPaymentConnectionsUnauthorizedException
     * @throws \Lenorix\BeelSdk\Generated\Exception\ListCompanyPaymentConnectionsForbiddenException
     * @throws \Lenorix\BeelSdk\Generated\Exception\ListCompanyPaymentConnectionsTooManyRequestsException
     * @throws \Lenorix\BeelSdk\Generated\Exception\ListCompanyPaymentConnectionsInternalServerErrorException
     *
     * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\ListManagedPaymentConnectionsResponse|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
     */
    public function listCompanyPaymentConnections(string $companyId, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\ListCompanyPaymentConnections($companyId), $fetch);
    }
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
    
    * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
    * @throws \Lenorix\BeelSdk\Generated\Exception\InitiatePaymentConnectionBadRequestException
    * @throws \Lenorix\BeelSdk\Generated\Exception\InitiatePaymentConnectionUnauthorizedException
    * @throws \Lenorix\BeelSdk\Generated\Exception\InitiatePaymentConnectionForbiddenException
    * @throws \Lenorix\BeelSdk\Generated\Exception\InitiatePaymentConnectionUnprocessableEntityException
    * @throws \Lenorix\BeelSdk\Generated\Exception\InitiatePaymentConnectionTooManyRequestsException
    * @throws \Lenorix\BeelSdk\Generated\Exception\InitiatePaymentConnectionInternalServerErrorException
    *
    * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\InitiatePaymentConnectionResponse|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
    */
    public function initiatePaymentConnection(string $companyId, \Lenorix\BeelSdk\Generated\Model\InitiatePaymentConnectionRequest $requestBody, array $headerParameters = [], string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\InitiatePaymentConnection($companyId, $requestBody, $headerParameters), $fetch);
    }
    /**
     * Disconnects the payment connection named by `{connection_id}` of a company that your account
     * **owns or manages**.
     *
     * - **Effect:** BeeL deletes the stored credentials and auto-invoicing stops at once; charges
     *   arriving afterwards are ignored and produce no invoice. Already-issued invoices are not
     *   affected.
     * - **The provider-side authorization is not revoked:** to withdraw it, the holder must
     *   remove BeeL's access from the provider's own dashboard (in Stripe, *Settings → Connected
     *   applications*).
     *
     * @param string $companyId Unique identifier (UUID) of the company the operation acts on — its identifier, not its NIF. It is the only source of context: the account that owns it is derived from it, and the `BeeL-Active-Company` header plays no part. A company you do not reach answers `403`, and so does a company that does not exist, so the existence of a company in another account is never disclosed.
     * @param string $connectionId Unique identifier (UUID) of the payment connection the operation acts on, as returned by `GET /v1/companies/{company_id}/payment-connections`. A NIF can hold several connections of the same provider, so the provider slug alone does not name one. A connection of another NIF answers `404`, exactly like one that does not exist.
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \Lenorix\BeelSdk\Generated\Exception\DisconnectCompanyPaymentConnectionUnauthorizedException
     * @throws \Lenorix\BeelSdk\Generated\Exception\DisconnectCompanyPaymentConnectionForbiddenException
     * @throws \Lenorix\BeelSdk\Generated\Exception\DisconnectCompanyPaymentConnectionNotFoundException
     * @throws \Lenorix\BeelSdk\Generated\Exception\DisconnectCompanyPaymentConnectionTooManyRequestsException
     * @throws \Lenorix\BeelSdk\Generated\Exception\DisconnectCompanyPaymentConnectionInternalServerErrorException
     *
     * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
     */
    public function disconnectCompanyPaymentConnection(string $companyId, string $connectionId, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\DisconnectCompanyPaymentConnection($companyId, $connectionId), $fetch);
    }
    /**
    * Updates the auto-invoicing settings of the payment connection named by `{connection_id}` of a
    * company your account **owns or manages**.
    *
    * - **Partial by field:** a field you omit keeps its current value. The series fields also
    *   accept an explicit `null`, which clears the series and falls back to the company default
    *   for that document type. `filter_config` is the exception: when sent, it **replaces the
    *   whole object**, not just the sub-fields you included — a partial `filter_config` clears
    *   every filter axis you left out.
    * - **Read-only fields:** `id`, `provider`, `status`, `environment`, `external_account_id`,
    *   `connected_at`, `last_event_at` and `active_filters` are not part of this request and are
    *   ignored if sent. `status` moves through the disconnect operation, never here.
    * - **Series:** each one must exist, be active, belong to this NIF and carry a compatible
    *   document type, or the request answers `422`.
    *
    * @param string $companyId Unique identifier (UUID) of the company the operation acts on — its identifier, not its NIF. It is the only source of context: the account that owns it is derived from it, and the `BeeL-Active-Company` header plays no part. A company you do not reach answers `403`, and so does a company that does not exist, so the existence of a company in another account is never disclosed.
    * @param string $connectionId Unique identifier (UUID) of the payment connection the operation acts on, as returned by `GET /v1/companies/{company_id}/payment-connections`. A NIF can hold several connections of the same provider, so the provider slug alone does not name one. A connection of another NIF answers `404`, exactly like one that does not exist.
    * @param \Lenorix\BeelSdk\Generated\Model\UpdateCompanyPaymentConnectionRequest $requestBody
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
    
    * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
    * @throws \Lenorix\BeelSdk\Generated\Exception\UpdateCompanyPaymentConnectionUnauthorizedException
    * @throws \Lenorix\BeelSdk\Generated\Exception\UpdateCompanyPaymentConnectionForbiddenException
    * @throws \Lenorix\BeelSdk\Generated\Exception\UpdateCompanyPaymentConnectionNotFoundException
    * @throws \Lenorix\BeelSdk\Generated\Exception\UpdateCompanyPaymentConnectionUnprocessableEntityException
    * @throws \Lenorix\BeelSdk\Generated\Exception\UpdateCompanyPaymentConnectionTooManyRequestsException
    * @throws \Lenorix\BeelSdk\Generated\Exception\UpdateCompanyPaymentConnectionInternalServerErrorException
    *
    * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\CompanyPaymentConnectionResponse|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
    */
    public function updateCompanyPaymentConnection(string $companyId, string $connectionId, \Lenorix\BeelSdk\Generated\Model\UpdateCompanyPaymentConnectionRequest $requestBody, array $headerParameters = [], string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\UpdateCompanyPaymentConnection($companyId, $connectionId, $requestBody, $headerParameters), $fetch);
    }
    /**
    * Lists the payment events received through the payment provider connection of a NIF
    * (company), most recent first. Use it to audit the charges that produced an invoice and to
    * find the ones that did not.
    *
    * - **By default, every event is listed.** Nothing is hidden: events the connection
    *   skipped, duplicates and disputes are all returned. Narrow the list with the filters
    *   below; what you do not filter, you get. Set `charges_only=true` to read the same events
    *   as one row per money movement instead.
    * - **Scope:** events belong to the connection, not to the NIF directly. The
    *   `{connection_id}` segment picks one connection of the NIF in the path, and only the
    *   events of that connection are returned; an event of another NIF of the same account is
    *   never reachable from here.
    * - **Unknown connection:** a `{connection_id}` that belongs to no connection of this NIF
    *   returns `404`.
    *
    * @param string $companyId Unique identifier (UUID) of the company the events belong to — its identifier, not its NIF. It is the only source of context: the account that owns it is derived from it, and the `BeeL-Active-Company` header plays no part. A company you do not reach answers `403`, and so does a company that does not exist, so the existence of a company in another account is never disclosed.
    * @param string $connectionId Unique identifier (UUID) of the payment connection the operation acts on, as returned by `GET /v1/companies/{company_id}/payment-connections`. A NIF can hold several connections of the same provider, so the provider slug alone does not name one. A connection of another NIF answers `404`, exactly like one that does not exist.
    * @param array{
    *    "page"?: int, //Page number, starting at 1. The response echoes it back as `pagination.current_page`.
    *    "limit"?: int, //How many items to return per page. The response echoes it back as `pagination.items_per_page`.
    *    "status"?: array, //Keep only the events in these processing states. Repeat the parameter to combine
    states; omit it for all of them.
    *    "failure_reason"?: array, //Keep only the events that did not complete for these reasons. Repeat the parameter to
    combine reasons.
    *    "failure_category"?: array, //Keep only the events that did not complete for a cause in these categories. Repeat the
    parameter to combine categories. Events that completed carry no category and are
    therefore never kept by this filter.
    *    "event_kind"?: array, //Keep only the events of these kinds. Matches `event_kind`, never `event_type`: the
    kind is what the event is about, while `event_type` is the raw name the provider
    emitted (`payment_intent.succeeded`) and is not filterable. `UNKNOWN` keeps every
    event whose provider name we do not classify. Repeat the parameter to combine kinds.
    *    "min_amount"?: int, //Keep only the events whose `amount` is at or above this value.
    *    "max_amount"?: int, //Keep only the events whose `amount` is at or below this value.
    *    "needs_action"?: bool, //`true` keeps only the events still worth acting on; `false`, only the ones that are
    not. Omit it for both.
    *    "from"?: string, //Keep only the events received at or after this instant.
    *    "to"?: string, //Keep only the events received at or before this instant.
    *    "q"?: string, //Free-text search over the payer name and the provider identifiers of the charge
    (`pi_`, `ch_`, `cs_`, `evt_`). Case-insensitive, partial matches allowed. The payer
    email is deliberately not searchable.
    *    "include_discarded"?: bool, //Include the events you discarded. They are excluded by default; discarding is a
    decision about the list, not a state of the event.
    *    "charges_only"?: bool, //Return one row per money movement instead of one row per event. Today, when this
    parameter is omitted or `false`, every event is listed.
    
    **The default changes on 11 December 2026.** From that day, omitting this parameter
    reads the listing as `charges_only=true` — one row per money movement. Until then a
    request that omits it answers with `Deprecation`, `Sunset` and `Link` headers. Send
    the value you want explicitly, whichever it is, so the change of default cannot
    surprise you. See the [migration guide](https://docs.beel.es/changelog/payments-cleanup).
    
    A money movement is a sale, a failed payment, each refund and each dispute. The
    provider usually reports a single movement through several events. When this
    parameter is `true`, each movement is returned in at most two rows: its outcome and,
    when any of its events requires action, its incident. The outcome row stands for the
    events of the movement that require no action; the incident row stands for the events
    of the movement that require action, so an invoiced movement that still has something
    to resolve always shows it. Within each row, the event that produced an invoice comes
    first, then an event of a classified kind before an unclassified one, and then the
    most recent one. A sale and a failed payment of the same charge are two movements, and
    every refund and every dispute of a charge is a movement of its own; the opening and
    the closing of a dispute are the same movement.
    
    An event of an unclassified kind that requires action joins the incident row of the
    movement its identifier names: a charge joins its sale, a dispute joins that dispute,
    and a refund or a credit note joins that refund. An event whose identifier names no
    movement, or that carries no identifier at all, stays a row of its own and is never
    merged with another. Events that moved no money, such as a customer, a price or a
    product being created, are left out, except those that require action, which are
    always listed.
    
    Discarded events of a movement that is still listed through a live event are ignored: they are
    neither returned nor counted. A movement whose events are all discarded is returned as
    a single row, only when `include_discarded` is `true`, and counts once in `discarded`.
    Without other filters, the number of rows returned with `include_discarded=true` is
    therefore `total` plus `discarded`.
    
    The other filters narrow the rows returned and `pagination.total_items`, and nothing
    else. `counts` describes the whole connection in the view you asked for and disregards
    every other filter: with `charges_only=true`, its `total`, `discarded`, `needs_action`
    and `by_status` values count money movements rather than individual events, while its
    `ignored` and `failure_reasons` values keep counting events. A request that filters by
    `q` may therefore return a single row while `counts.total` still reports every movement
    of the connection.
    * } $queryParameters
    
    * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
    * @throws \Lenorix\BeelSdk\Generated\Exception\ListCompanyPaymentEventsUnauthorizedException
    * @throws \Lenorix\BeelSdk\Generated\Exception\ListCompanyPaymentEventsForbiddenException
    * @throws \Lenorix\BeelSdk\Generated\Exception\ListCompanyPaymentEventsNotFoundException
    * @throws \Lenorix\BeelSdk\Generated\Exception\ListCompanyPaymentEventsUnprocessableEntityException
    * @throws \Lenorix\BeelSdk\Generated\Exception\ListCompanyPaymentEventsTooManyRequestsException
    * @throws \Lenorix\BeelSdk\Generated\Exception\ListCompanyPaymentEventsInternalServerErrorException
    *
    * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\ListManagedPaymentEventsResponse|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
    */
    public function listCompanyPaymentEvents(string $companyId, string $connectionId, array $queryParameters = [], string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\ListCompanyPaymentEvents($companyId, $connectionId, $queryParameters), $fetch);
    }
    /**
     * Retrieves a single payment event of the NIF's connection, including the outcome of its
     * automatic invoicing and, when it failed, the stable failure code you can act on.
     *
     * - **Not found:** an event that does not belong to this NIF's connection returns `404`,
     *   the same answer an event that does not exist gets, so an event of another NIF is never
     *   disclosed.
     *
     * @param string $companyId Unique identifier (UUID) of the company the events belong to — its identifier, not its NIF. It is the only source of context: the account that owns it is derived from it, and the `BeeL-Active-Company` header plays no part. A company you do not reach answers `403`, and so does a company that does not exist, so the existence of a company in another account is never disclosed.
     * @param string $connectionId Unique identifier (UUID) of the payment connection the operation acts on, as returned by `GET /v1/companies/{company_id}/payment-connections`. A NIF can hold several connections of the same provider, so the provider slug alone does not name one. A connection of another NIF answers `404`, exactly like one that does not exist.
     * @param string $eventId Identifier of the payment event, as returned by the list operation.
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetCompanyPaymentEventUnauthorizedException
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetCompanyPaymentEventForbiddenException
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetCompanyPaymentEventNotFoundException
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetCompanyPaymentEventUnprocessableEntityException
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetCompanyPaymentEventTooManyRequestsException
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetCompanyPaymentEventInternalServerErrorException
     *
     * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\ManagedPaymentEventResponse|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
     */
    public function getCompanyPaymentEvent(string $companyId, string $connectionId, string $eventId, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\GetCompanyPaymentEvent($companyId, $connectionId, $eventId), $fetch);
    }
    /**
    * Reprocesses a payment event whose automatic invoicing did not complete, applying the
    * configuration of the NIF as it stands now. Use it after fixing what caused the failure,
    * for example a missing invoice series.
    *
    * - **`retry_available`:** only events where it is `true` can be retried. Read it instead
    *   of deriving retryability from `status` yourself; anything else returns `400`.
    * - **Limit:** the status and the skip reason must admit reprocessing, and the event must
    *   still be under the limit of 3 retries (`retry_count`). A retry that fails for a
    *   transient cause outside the event (provider outage, timeout) does not count towards
    *   the limit.
    *
    * @param string $companyId Unique identifier (UUID) of the company the events belong to — its identifier, not its NIF. It is the only source of context: the account that owns it is derived from it, and the `BeeL-Active-Company` header plays no part. A company you do not reach answers `403`, and so does a company that does not exist, so the existence of a company in another account is never disclosed.
    * @param string $connectionId Unique identifier (UUID) of the payment connection the operation acts on, as returned by `GET /v1/companies/{company_id}/payment-connections`. A NIF can hold several connections of the same provider, so the provider slug alone does not name one. A connection of another NIF answers `404`, exactly like one that does not exist.
    * @param string $eventId Identifier of the payment event, as returned by the list operation.
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
    
    * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
    * @throws \Lenorix\BeelSdk\Generated\Exception\RetryCompanyPaymentEventBadRequestException
    * @throws \Lenorix\BeelSdk\Generated\Exception\RetryCompanyPaymentEventUnauthorizedException
    * @throws \Lenorix\BeelSdk\Generated\Exception\RetryCompanyPaymentEventForbiddenException
    * @throws \Lenorix\BeelSdk\Generated\Exception\RetryCompanyPaymentEventNotFoundException
    * @throws \Lenorix\BeelSdk\Generated\Exception\RetryCompanyPaymentEventUnprocessableEntityException
    * @throws \Lenorix\BeelSdk\Generated\Exception\RetryCompanyPaymentEventTooManyRequestsException
    * @throws \Lenorix\BeelSdk\Generated\Exception\RetryCompanyPaymentEventInternalServerErrorException
    *
    * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\ManagedPaymentEventResponse|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
    */
    public function retryCompanyPaymentEvent(string $companyId, string $connectionId, string $eventId, array $headerParameters = [], string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\RetryCompanyPaymentEvent($companyId, $connectionId, $eventId, $headerParameters), $fetch);
    }
    /**
    * Builds a draft invoice from a payment event that could not be invoiced automatically,
    * applying the same recipient resolution and tax treatment the automatic flow would have
    * applied, under the NIF in the path.
    *
    * - **Draft only:** the document is not issued, not numbered against the series and not
    *   emailed. Issue it yourself once it is right.
    * - **Eligible events:** only those that produced no invoice can produce a draft; otherwise
    *   the request returns `400`.
    * - **Rejected documents:** if invoicing rules reject the resulting document the request
    *   returns `422` and no draft is created.
    *
    * @param string $companyId Unique identifier (UUID) of the company the events belong to — its identifier, not its NIF. It is the only source of context: the account that owns it is derived from it, and the `BeeL-Active-Company` header plays no part. A company you do not reach answers `403`, and so does a company that does not exist, so the existence of a company in another account is never disclosed.
    * @param string $connectionId Unique identifier (UUID) of the payment connection the operation acts on, as returned by `GET /v1/companies/{company_id}/payment-connections`. A NIF can hold several connections of the same provider, so the provider slug alone does not name one. A connection of another NIF answers `404`, exactly like one that does not exist.
    * @param string $eventId Identifier of the payment event, as returned by the list operation.
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
    
    * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
    * @throws \Lenorix\BeelSdk\Generated\Exception\GenerateCompanyPaymentEventDraftBadRequestException
    * @throws \Lenorix\BeelSdk\Generated\Exception\GenerateCompanyPaymentEventDraftUnauthorizedException
    * @throws \Lenorix\BeelSdk\Generated\Exception\GenerateCompanyPaymentEventDraftForbiddenException
    * @throws \Lenorix\BeelSdk\Generated\Exception\GenerateCompanyPaymentEventDraftNotFoundException
    * @throws \Lenorix\BeelSdk\Generated\Exception\GenerateCompanyPaymentEventDraftUnprocessableEntityException
    * @throws \Lenorix\BeelSdk\Generated\Exception\GenerateCompanyPaymentEventDraftTooManyRequestsException
    * @throws \Lenorix\BeelSdk\Generated\Exception\GenerateCompanyPaymentEventDraftInternalServerErrorException
    *
    * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\ManagedPaymentEventDraftResponse|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
    */
    public function generateCompanyPaymentEventDraft(string $companyId, string $connectionId, string $eventId, array $headerParameters = [], string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\GenerateCompanyPaymentEventDraft($companyId, $connectionId, $eventId, $headerParameters), $fetch);
    }
    /**
    * Marks a payment event as resolved outside BeeL, for example when the invoice was issued
    * through another tool or the situation was otherwise handled by hand. The event leaves the
    * events that need action without generating any invoice.
    *
    * The operation applies to the whole payment the event belongs to. Its scope is every active
    * event of the connection that shares the payment identity of the event named in the
    * request: when the event carries a payment identifier (`external_payment_id`), every event
    * with that same identifier, whatever its kind (the sale, its failed attempts, its refunds);
    * otherwise, when it carries a source object (`source_object_id`, such as a credit note or a
    * dispute), every event with that same source object; otherwise, the event alone. Within that
    * scope, the events that need action (the same criterion as the `needs_action` filter) and
    * are eligible are resolved together, in a single transaction; a failed event still pending
    * automatic retry is resolved as well, so that no retry is attempted for a payment the
    * caller has declared handled elsewhere. Events that do not need action — for instance an
    * event still in `RECEIVED` state that has not stalled — remain unchanged. The response
    * carries the event named in the request.
    *
    * - **Eligible events:** only events in `FAILED`, `SKIPPED` or `RECEIVED` can be resolved;
    *   if the event named in the request is not eligible, the request returns `400`.
    * - **Terminal:** a resolved event cannot be retried afterwards.
    *
    * @param string $companyId Unique identifier (UUID) of the company the events belong to — its identifier, not its NIF. It is the only source of context: the account that owns it is derived from it, and the `BeeL-Active-Company` header plays no part. A company you do not reach answers `403`, and so does a company that does not exist, so the existence of a company in another account is never disclosed.
    * @param string $connectionId Unique identifier (UUID) of the payment connection the operation acts on, as returned by `GET /v1/companies/{company_id}/payment-connections`. A NIF can hold several connections of the same provider, so the provider slug alone does not name one. A connection of another NIF answers `404`, exactly like one that does not exist.
    * @param string $eventId Identifier of the payment event, as returned by the list operation.
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
    
    * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
    * @throws \Lenorix\BeelSdk\Generated\Exception\ResolveCompanyPaymentEventBadRequestException
    * @throws \Lenorix\BeelSdk\Generated\Exception\ResolveCompanyPaymentEventUnauthorizedException
    * @throws \Lenorix\BeelSdk\Generated\Exception\ResolveCompanyPaymentEventForbiddenException
    * @throws \Lenorix\BeelSdk\Generated\Exception\ResolveCompanyPaymentEventNotFoundException
    * @throws \Lenorix\BeelSdk\Generated\Exception\ResolveCompanyPaymentEventUnprocessableEntityException
    * @throws \Lenorix\BeelSdk\Generated\Exception\ResolveCompanyPaymentEventTooManyRequestsException
    * @throws \Lenorix\BeelSdk\Generated\Exception\ResolveCompanyPaymentEventInternalServerErrorException
    *
    * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\ManagedPaymentEventResponse|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
    */
    public function resolveCompanyPaymentEvent(string $companyId, string $connectionId, string $eventId, array $headerParameters = [], string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\ResolveCompanyPaymentEvent($companyId, $connectionId, $eventId, $headerParameters), $fetch);
    }
    /**
    * Removes a payment event from the default list (soft delete). The event stays in the audit
    * trail and can be brought back with the restore operation.
    *
    * The operation applies to the whole payment the event belongs to. Its scope is every active,
    * eligible event of the connection that shares the payment identity of the event named in
    * the request: when the event carries a payment identifier (`external_payment_id`), every
    * event with that same identifier, whatever its kind (the sale, its failed attempts, its
    * refunds); otherwise, when it carries a source object (`source_object_id`, such as a credit
    * note or a dispute), every event with that same source object; otherwise, the event alone.
    * All of them are discarded together, in a single transaction and with the same `deleted_at`
    * timestamp. Events that are not eligible remain unchanged, and so do events still in
    * `RECEIVED` state other than the one named in the request: they have not been processed
    * yet and are left for processing. The response carries the event named in the request.
    *
    * - **Eligible events:** an event already linked to an issued invoice, or currently being
    *   processed, cannot be discarded; the request returns `400`.
    *
    * @param string $companyId Unique identifier (UUID) of the company the events belong to — its identifier, not its NIF. It is the only source of context: the account that owns it is derived from it, and the `BeeL-Active-Company` header plays no part. A company you do not reach answers `403`, and so does a company that does not exist, so the existence of a company in another account is never disclosed.
    * @param string $connectionId Unique identifier (UUID) of the payment connection the operation acts on, as returned by `GET /v1/companies/{company_id}/payment-connections`. A NIF can hold several connections of the same provider, so the provider slug alone does not name one. A connection of another NIF answers `404`, exactly like one that does not exist.
    * @param string $eventId Identifier of the payment event, as returned by the list operation.
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
    
    * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
    * @throws \Lenorix\BeelSdk\Generated\Exception\DiscardCompanyPaymentEventBadRequestException
    * @throws \Lenorix\BeelSdk\Generated\Exception\DiscardCompanyPaymentEventUnauthorizedException
    * @throws \Lenorix\BeelSdk\Generated\Exception\DiscardCompanyPaymentEventForbiddenException
    * @throws \Lenorix\BeelSdk\Generated\Exception\DiscardCompanyPaymentEventNotFoundException
    * @throws \Lenorix\BeelSdk\Generated\Exception\DiscardCompanyPaymentEventUnprocessableEntityException
    * @throws \Lenorix\BeelSdk\Generated\Exception\DiscardCompanyPaymentEventTooManyRequestsException
    * @throws \Lenorix\BeelSdk\Generated\Exception\DiscardCompanyPaymentEventInternalServerErrorException
    *
    * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\ManagedPaymentEventResponse|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
    */
    public function discardCompanyPaymentEvent(string $companyId, string $connectionId, string $eventId, array $headerParameters = [], string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\DiscardCompanyPaymentEvent($companyId, $connectionId, $eventId, $headerParameters), $fetch);
    }
    /**
    * Reverses a previous discard, bringing a payment event back into the default list.
    *
    * The operation reverses the whole discard operation: the event named in the request and
    * every event with the same payment identity (see the discard operation) that was discarded
    * together with it, that is, with exactly the same `deleted_at` timestamp. Events discarded
    * in an earlier or later operation are not affected. Idempotent — restoring an event that is
    * not discarded is a no-op.
    *
    * @param string $companyId Unique identifier (UUID) of the company the events belong to — its identifier, not its NIF. It is the only source of context: the account that owns it is derived from it, and the `BeeL-Active-Company` header plays no part. A company you do not reach answers `403`, and so does a company that does not exist, so the existence of a company in another account is never disclosed.
    * @param string $connectionId Unique identifier (UUID) of the payment connection the operation acts on, as returned by `GET /v1/companies/{company_id}/payment-connections`. A NIF can hold several connections of the same provider, so the provider slug alone does not name one. A connection of another NIF answers `404`, exactly like one that does not exist.
    * @param string $eventId Identifier of the payment event, as returned by the list operation.
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
    
    * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
    * @throws \Lenorix\BeelSdk\Generated\Exception\RestoreCompanyPaymentEventUnauthorizedException
    * @throws \Lenorix\BeelSdk\Generated\Exception\RestoreCompanyPaymentEventForbiddenException
    * @throws \Lenorix\BeelSdk\Generated\Exception\RestoreCompanyPaymentEventNotFoundException
    * @throws \Lenorix\BeelSdk\Generated\Exception\RestoreCompanyPaymentEventUnprocessableEntityException
    * @throws \Lenorix\BeelSdk\Generated\Exception\RestoreCompanyPaymentEventTooManyRequestsException
    * @throws \Lenorix\BeelSdk\Generated\Exception\RestoreCompanyPaymentEventInternalServerErrorException
    *
    * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\ManagedPaymentEventResponse|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
    */
    public function restoreCompanyPaymentEvent(string $companyId, string $connectionId, string $eventId, array $headerParameters = [], string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\RestoreCompanyPaymentEvent($companyId, $connectionId, $eventId, $headerParameters), $fetch);
    }
    /**
     * **Deprecated.** Use `GET /v1/accounts/{account_id}/webhooks`, which behaves identically.
     *
     * Returns the webhook subscriptions of the authenticated account, active
     * and inactive alike. The signing secrets are never included.
     *
     * **Retires on 9 December 2026.** See the [migration guide](https://docs.beel.es/changelog/resources-under-the-nif) for what moved where and what changes when you switch.
     *
     * @param array{
     *    "page"?: int, //Page number, starting at 1. The response echoes it back as `pagination.current_page`.
     *    "limit"?: int, //How many items to return per page. The response echoes it back as `pagination.items_per_page`.
     * } $queryParameters
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \Lenorix\BeelSdk\Generated\Exception\ListWebhookSubscriptionsUnauthorizedException
     * @throws \Lenorix\BeelSdk\Generated\Exception\ListWebhookSubscriptionsForbiddenException
     *
     * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\V1WebhooksGetResponse200|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
     */
    public function listWebhookSubscriptions(array $queryParameters = [], string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\ListWebhookSubscriptions($queryParameters), $fetch);
    }
    /**
    * **Deprecated.** Use `POST /v1/accounts/{account_id}/webhooks`, which behaves identically.
    *
    * Registers an HTTPS endpoint to receive notifications for the event types listed
    * in `events`.
    *
    * - **`secret`:** returned **only** in this response and never again. Store it before
    *   discarding the body; deliveries are signed with it and carry the signature in the
    *   `BeeL-Signature` header.
    * - **`test_delivery`:** a one-off signed delivery sent to your URL as part of creating
    *   the subscription, so you learn whether your endpoint answers without a second call.
    *   It is best effort: the subscription exists and is active whatever it says, and the
    *   field is `null` when the test could not be run at all.
    * - **`account_relationship`:** which accounts the subscription receives events from —
    *   `own` (the default), `managed`, or `all`.
    * - **Limits:** an account holds at most **10 active subscriptions**; creating an
    *   eleventh is rejected. Registering the same URL twice creates two subscriptions, and
    *   the endpoint then receives each event twice.
    *
    * **Retires on 9 December 2026.** See the [migration guide](https://docs.beel.es/changelog/resources-under-the-nif) for what moved where and what changes when you switch.
    *
    * @param \Lenorix\BeelSdk\Generated\Model\CreateWebhookSubscriptionRequest $requestBody
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
    
    * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
    * @throws \Lenorix\BeelSdk\Generated\Exception\CreateWebhookSubscriptionBadRequestException
    * @throws \Lenorix\BeelSdk\Generated\Exception\CreateWebhookSubscriptionUnauthorizedException
    * @throws \Lenorix\BeelSdk\Generated\Exception\CreateWebhookSubscriptionForbiddenException
    * @throws \Lenorix\BeelSdk\Generated\Exception\CreateWebhookSubscriptionUnprocessableEntityException
    *
    * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\V1WebhooksPostResponse201|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
    */
    public function createWebhookSubscription(\Lenorix\BeelSdk\Generated\Model\CreateWebhookSubscriptionRequest $requestBody, array $headerParameters = [], string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\CreateWebhookSubscription($requestBody, $headerParameters), $fetch);
    }
    /**
     * **Deprecated.** Use `DELETE /v1/accounts/{account_id}/webhooks/{webhook_id}`, which behaves identically.
     *
     * Permanently deletes a webhook subscription. No further events are
     * delivered to its URL. To stop deliveries reversibly, set `active` to
     * `false` instead.
     *
     * **Retires on 9 December 2026.** See the [migration guide](https://docs.beel.es/changelog/resources-under-the-nif) for what moved where and what changes when you switch.
     *
     * @param string $webhookId
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \Lenorix\BeelSdk\Generated\Exception\DeleteWebhookSubscriptionUnauthorizedException
     * @throws \Lenorix\BeelSdk\Generated\Exception\DeleteWebhookSubscriptionForbiddenException
     * @throws \Lenorix\BeelSdk\Generated\Exception\DeleteWebhookSubscriptionNotFoundException
     *
     * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
     */
    public function deleteWebhookSubscription(string $webhookId, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\DeleteWebhookSubscription($webhookId), $fetch);
    }
    /**
     * **Deprecated.** Use `GET /v1/accounts/{account_id}/webhooks/{webhook_id}`, which behaves identically.
     *
     * Returns a single webhook subscription. The signing secret is never included.
     *
     * **Retires on 9 December 2026.** See the [migration guide](https://docs.beel.es/changelog/resources-under-the-nif) for what moved where and what changes when you switch.
     *
     * @param string $webhookId
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetWebhookSubscriptionUnauthorizedException
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetWebhookSubscriptionForbiddenException
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetWebhookSubscriptionNotFoundException
     *
     * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\V1WebhooksWebhookIdGetResponse200|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
     */
    public function getWebhookSubscription(string $webhookId, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\GetWebhookSubscription($webhookId), $fetch);
    }
    /**
     * **Deprecated.** Use `PATCH /v1/accounts/{account_id}/webhooks/{webhook_id}`, which behaves identically.
     *
     * Updates the fields present in the body — `url`, `events`, `active`,
     * `account_relationship` — and leaves the rest untouched.
     *
     * - **`events`:** replaces the whole list, it does not add to it, so an event left out
     *   of it stops being delivered.
     * - **`active`:** setting it to `false` stops deliveries without discarding the delivery
     *   history. A subscription we turned off ourselves (`deactivated_by: beel`) needs a
     *   successful test delivery before it can be turned back on.
     * - **Signing secret:** not touched here. Rotate it with
     *   `POST /v1/accounts/{account_id}/webhooks/{webhook_id}/secret`.
     *
     * **Retires on 9 December 2026.** See the [migration guide](https://docs.beel.es/changelog/resources-under-the-nif) for what moved where and what changes when you switch.
     *
     * @param string $webhookId
     * @param \Lenorix\BeelSdk\Generated\Model\UpdateWebhookSubscriptionRequest $requestBody
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \Lenorix\BeelSdk\Generated\Exception\UpdateWebhookSubscriptionBadRequestException
     * @throws \Lenorix\BeelSdk\Generated\Exception\UpdateWebhookSubscriptionUnauthorizedException
     * @throws \Lenorix\BeelSdk\Generated\Exception\UpdateWebhookSubscriptionForbiddenException
     * @throws \Lenorix\BeelSdk\Generated\Exception\UpdateWebhookSubscriptionNotFoundException
     * @throws \Lenorix\BeelSdk\Generated\Exception\UpdateWebhookSubscriptionUnprocessableEntityException
     *
     * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\V1WebhooksWebhookIdPatchResponse200|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
     */
    public function updateWebhookSubscription(string $webhookId, \Lenorix\BeelSdk\Generated\Model\UpdateWebhookSubscriptionRequest $requestBody, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\UpdateWebhookSubscription($webhookId, $requestBody), $fetch);
    }
    /**
     * **Deprecated.** Use `GET /v1/accounts/{account_id}/webhooks/{webhook_id}/deliveries`, which behaves identically.
     *
     * Returns the delivery attempts of this subscription, newest first. Each entry records
     * one attempt with the response it got, so a retried event appears once per attempt.
     *
     * - **`event_type`:** narrows the list to a single event type.
     * - **`event_id`:** follows one event across every attempt made on it, without paging
     *   through the whole history.
     *
     * **Retires on 9 December 2026.** See the [migration guide](https://docs.beel.es/changelog/resources-under-the-nif) for what moved where and what changes when you switch.
     *
     * @param string $webhookId
     * @param array{
     *    "page"?: int, //Page number, starting at 1. The response echoes it back as `pagination.current_page`.
     *    "limit"?: int, //How many items to return per page. The response echoes it back as `pagination.items_per_page`.
     *    "event_type"?: string, //Only deliveries of this event type.
     *    "event_id"?: string, //Only deliveries of this event. Use it to follow every attempt on one event without paging through the whole history.
     * } $queryParameters
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \Lenorix\BeelSdk\Generated\Exception\ListWebhookDeliveriesBadRequestException
     * @throws \Lenorix\BeelSdk\Generated\Exception\ListWebhookDeliveriesUnauthorizedException
     * @throws \Lenorix\BeelSdk\Generated\Exception\ListWebhookDeliveriesForbiddenException
     * @throws \Lenorix\BeelSdk\Generated\Exception\ListWebhookDeliveriesNotFoundException
     *
     * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\V1WebhooksWebhookIdDeliveriesGetResponse200|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
     */
    public function listWebhookDeliveries(string $webhookId, array $queryParameters = [], string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\ListWebhookDeliveries($webhookId, $queryParameters), $fetch);
    }
    /**
    * **Deprecated.** Use `POST /v1/accounts/{account_id}/webhooks/{webhook_id}/deliveries/{delivery_id}/retry`, which behaves identically.
    *
    * Re-sends the original payload of a delivery immediately.
    *
    * - **Payload:** the one captured when the event happened, not a fresh snapshot, so
    *   changes made to the entity since then are not reflected.
    * - **History:** the outcome is recorded as a new entry and the original entry is kept
    *   as it was. `attempt_number` continues the same sequence, so it can exceed the 5
    *   automatic attempts.
    *
    * **Retires on 9 December 2026.** See the [migration guide](https://docs.beel.es/changelog/resources-under-the-nif) for what moved where and what changes when you switch.
    *
    * @param string $webhookId
    * @param string $deliveryId
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
    
    * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
    * @throws \Lenorix\BeelSdk\Generated\Exception\RetryWebhookDeliveryUnauthorizedException
    * @throws \Lenorix\BeelSdk\Generated\Exception\RetryWebhookDeliveryForbiddenException
    * @throws \Lenorix\BeelSdk\Generated\Exception\RetryWebhookDeliveryNotFoundException
    *
    * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\V1WebhooksWebhookIdDeliveriesDeliveryIdRetryPostResponse200|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
    */
    public function retryWebhookDelivery(string $webhookId, string $deliveryId, array $headerParameters = [], string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\RetryWebhookDelivery($webhookId, $deliveryId, $headerParameters), $fetch);
    }
    /**
    * **Deprecated.** Use `POST /v1/accounts/{account_id}/webhooks/{webhook_id}/test`, which behaves identically.
    *
    * Sends a synthetic payload to the subscription's URL immediately, outside the normal
    * delivery queue. Use it to verify that your endpoint is reachable and handles
    * deliveries correctly before you rely on real events.
    *
    * - **Payload:** carries `"test": true` and synthetic data, and is signed like any other
    *   delivery, so it also exercises your signature check.
    * - **Retries:** none. A failed test is not retried and does not appear in the delivery
    *   history.
    * - **`Idempotency-Key`:** repeating the call with the same key returns the cached
    *   result without sending the test payload again.
    * - **Result:** read `delivery_success`; a delivery your endpoint rejected is still a
    *   successful test run, not an error.
    *
    * **Retires on 9 December 2026.** See the [migration guide](https://docs.beel.es/changelog/resources-under-the-nif) for what moved where and what changes when you switch.
    *
    * @param string $webhookId
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
    
    * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
    * @throws \Lenorix\BeelSdk\Generated\Exception\TestWebhookSubscriptionUnauthorizedException
    * @throws \Lenorix\BeelSdk\Generated\Exception\TestWebhookSubscriptionForbiddenException
    * @throws \Lenorix\BeelSdk\Generated\Exception\TestWebhookSubscriptionNotFoundException
    * @throws \Lenorix\BeelSdk\Generated\Exception\TestWebhookSubscriptionConflictException
    *
    * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\V1WebhooksWebhookIdTestPostResponse200|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
    */
    public function testWebhookSubscription(string $webhookId, array $headerParameters = [], string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\TestWebhookSubscription($webhookId, $headerParameters), $fetch);
    }
    /**
    * **Deprecated.** Use `POST /v1/accounts/{account_id}/webhooks/{webhook_id}/secret`, which behaves identically.
    *
    * Generates a new HMAC signing secret for a webhook subscription.
    *
    * - **Old secret:** **immediately invalidated**. Update your signature verification
    *   logic before rotating, to avoid missing events during the transition.
    * - **New secret:** returned **once**, in this response only. It cannot be read again.
    *
    * **Retires on 9 December 2026.** See the [migration guide](https://docs.beel.es/changelog/resources-under-the-nif) for what moved where and what changes when you switch.
    *
    * @param string $webhookId
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
    
    * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
    * @throws \Lenorix\BeelSdk\Generated\Exception\RotateWebhookSecretUnauthorizedException
    * @throws \Lenorix\BeelSdk\Generated\Exception\RotateWebhookSecretForbiddenException
    * @throws \Lenorix\BeelSdk\Generated\Exception\RotateWebhookSecretNotFoundException
    *
    * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\V1WebhooksWebhookIdSecretPostResponse200|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
    */
    public function rotateWebhookSecret(string $webhookId, array $headerParameters = [], string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\RotateWebhookSecret($webhookId, $headerParameters), $fetch);
    }
    /**
     * Returns the webhook subscriptions of the account in the path, active and inactive alike. Every member of the account sees the same list: who registered a subscription is authorship, not visibility. The signing secrets are never included.
     * @param string $accountId Your own account, or an account you provisioned. It — not the credential, and not the `BeeL-Active-Company` header — decides which account the operation acts on. An account you do not reach answers `403`, and so does an account that does not exist, so the existence of somebody else's account is never disclosed.
     * @param array{
     *    "page"?: int, //Page number, starting at 1. The response echoes it back as `pagination.current_page`.
     *    "limit"?: int, //How many items to return per page. The response echoes it back as `pagination.items_per_page`.
     * } $queryParameters
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \Lenorix\BeelSdk\Generated\Exception\ListAccountWebhookSubscriptionsBadRequestException
     * @throws \Lenorix\BeelSdk\Generated\Exception\ListAccountWebhookSubscriptionsUnauthorizedException
     * @throws \Lenorix\BeelSdk\Generated\Exception\ListAccountWebhookSubscriptionsForbiddenException
     * @throws \Lenorix\BeelSdk\Generated\Exception\ListAccountWebhookSubscriptionsUnprocessableEntityException
     * @throws \Lenorix\BeelSdk\Generated\Exception\ListAccountWebhookSubscriptionsTooManyRequestsException
     * @throws \Lenorix\BeelSdk\Generated\Exception\ListAccountWebhookSubscriptionsInternalServerErrorException
     *
     * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\V1AccountsAccountIdWebhooksGetResponse200|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
     */
    public function listAccountWebhookSubscriptions(string $accountId, array $queryParameters = [], string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\ListAccountWebhookSubscriptions($accountId, $queryParameters), $fetch);
    }
    /**
    * Registers an HTTPS endpoint to receive notifications for the event types listed
    * in `events`.
    *
    * - **`secret`:** returned **only** in this response and never again. Store it before
    *   discarding the body; deliveries are signed with it and carry the signature in the
    *   `BeeL-Signature` header.
    * - **`test_delivery`:** a one-off signed delivery sent to your URL as part of creating
    *   the subscription, so you learn whether your endpoint answers without a second call.
    *   It is best effort: the subscription exists and is active whatever it says, and the
    *   field is `null` when the test could not be run at all.
    * - **`account_relationship`:** which accounts the subscription receives events from —
    *   `own` (the default), `managed`, or `all`.
    * - **Limits:** an account holds at most **10 active subscriptions**; creating an
    *   eleventh is rejected. Registering the same URL twice creates two subscriptions, and
    *   the endpoint then receives each event twice.
    *
    * @param string $accountId Your own account, or an account you provisioned. It — not the credential, and not the `BeeL-Active-Company` header — decides which account the operation acts on. An account you do not reach answers `403`, and so does an account that does not exist, so the existence of somebody else's account is never disclosed.
    * @param \Lenorix\BeelSdk\Generated\Model\CreateWebhookSubscriptionRequest $requestBody
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
    
    * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
    * @throws \Lenorix\BeelSdk\Generated\Exception\CreateAccountWebhookSubscriptionBadRequestException
    * @throws \Lenorix\BeelSdk\Generated\Exception\CreateAccountWebhookSubscriptionUnauthorizedException
    * @throws \Lenorix\BeelSdk\Generated\Exception\CreateAccountWebhookSubscriptionForbiddenException
    * @throws \Lenorix\BeelSdk\Generated\Exception\CreateAccountWebhookSubscriptionUnprocessableEntityException
    * @throws \Lenorix\BeelSdk\Generated\Exception\CreateAccountWebhookSubscriptionTooManyRequestsException
    * @throws \Lenorix\BeelSdk\Generated\Exception\CreateAccountWebhookSubscriptionInternalServerErrorException
    *
    * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\V1AccountsAccountIdWebhooksPostResponse201|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
    */
    public function createAccountWebhookSubscription(string $accountId, \Lenorix\BeelSdk\Generated\Model\CreateWebhookSubscriptionRequest $requestBody, array $headerParameters = [], string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\CreateAccountWebhookSubscription($accountId, $requestBody, $headerParameters), $fetch);
    }
    /**
     * Permanently deletes a webhook subscription. No further events are
     * delivered to its URL. To stop deliveries reversibly, set `active` to
     * `false` instead.
     *
     * @param string $accountId Your own account, or an account you provisioned. It — not the credential, and not the `BeeL-Active-Company` header — decides which account the operation acts on. An account you do not reach answers `403`, and so does an account that does not exist, so the existence of somebody else's account is never disclosed.
     * @param string $webhookId Subscription of the account in the path. A subscription of another account answers `404`, the same as one that does not exist: under the account resolved from `{account_id}` it simply is not there.
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \Lenorix\BeelSdk\Generated\Exception\DeleteAccountWebhookSubscriptionUnauthorizedException
     * @throws \Lenorix\BeelSdk\Generated\Exception\DeleteAccountWebhookSubscriptionForbiddenException
     * @throws \Lenorix\BeelSdk\Generated\Exception\DeleteAccountWebhookSubscriptionNotFoundException
     * @throws \Lenorix\BeelSdk\Generated\Exception\DeleteAccountWebhookSubscriptionTooManyRequestsException
     * @throws \Lenorix\BeelSdk\Generated\Exception\DeleteAccountWebhookSubscriptionInternalServerErrorException
     *
     * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
     */
    public function deleteAccountWebhookSubscription(string $accountId, string $webhookId, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\DeleteAccountWebhookSubscription($accountId, $webhookId), $fetch);
    }
    /**
     * Returns a single webhook subscription. The signing secret is never included.
     * @param string $accountId Your own account, or an account you provisioned. It — not the credential, and not the `BeeL-Active-Company` header — decides which account the operation acts on. An account you do not reach answers `403`, and so does an account that does not exist, so the existence of somebody else's account is never disclosed.
     * @param string $webhookId Subscription of the account in the path. A subscription of another account answers `404`, the same as one that does not exist: under the account resolved from `{account_id}` it simply is not there.
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetAccountWebhookSubscriptionUnauthorizedException
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetAccountWebhookSubscriptionForbiddenException
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetAccountWebhookSubscriptionNotFoundException
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetAccountWebhookSubscriptionTooManyRequestsException
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetAccountWebhookSubscriptionInternalServerErrorException
     *
     * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\V1AccountsAccountIdWebhooksWebhookIdGetResponse200|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
     */
    public function getAccountWebhookSubscription(string $accountId, string $webhookId, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\GetAccountWebhookSubscription($accountId, $webhookId), $fetch);
    }
    /**
     * Updates the fields present in the body — `url`, `events`, `active`,
     * `account_relationship` — and leaves the rest untouched.
     *
     * - **`events`:** replaces the whole list, it does not add to it, so an event left out
     *   of it stops being delivered.
     * - **`active`:** setting it to `false` stops deliveries without discarding the delivery
     *   history. A subscription we turned off ourselves (`deactivated_by: beel`) needs a
     *   successful test delivery before it can be turned back on.
     * - **Signing secret:** not touched here. Rotate it with
     *   `POST /v1/accounts/{account_id}/webhooks/{webhook_id}/secret`.
     *
     * @param string $accountId Your own account, or an account you provisioned. It — not the credential, and not the `BeeL-Active-Company` header — decides which account the operation acts on. An account you do not reach answers `403`, and so does an account that does not exist, so the existence of somebody else's account is never disclosed.
     * @param string $webhookId Subscription of the account in the path. A subscription of another account answers `404`, the same as one that does not exist: under the account resolved from `{account_id}` it simply is not there.
     * @param \Lenorix\BeelSdk\Generated\Model\UpdateWebhookSubscriptionRequest $requestBody
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \Lenorix\BeelSdk\Generated\Exception\PatchAccountWebhookSubscriptionBadRequestException
     * @throws \Lenorix\BeelSdk\Generated\Exception\PatchAccountWebhookSubscriptionUnauthorizedException
     * @throws \Lenorix\BeelSdk\Generated\Exception\PatchAccountWebhookSubscriptionForbiddenException
     * @throws \Lenorix\BeelSdk\Generated\Exception\PatchAccountWebhookSubscriptionNotFoundException
     * @throws \Lenorix\BeelSdk\Generated\Exception\PatchAccountWebhookSubscriptionUnprocessableEntityException
     * @throws \Lenorix\BeelSdk\Generated\Exception\PatchAccountWebhookSubscriptionTooManyRequestsException
     * @throws \Lenorix\BeelSdk\Generated\Exception\PatchAccountWebhookSubscriptionInternalServerErrorException
     *
     * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\V1AccountsAccountIdWebhooksWebhookIdPatchResponse200|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
     */
    public function patchAccountWebhookSubscription(string $accountId, string $webhookId, \Lenorix\BeelSdk\Generated\Model\UpdateWebhookSubscriptionRequest $requestBody, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\PatchAccountWebhookSubscription($accountId, $webhookId, $requestBody), $fetch);
    }
    /**
     * Returns the delivery attempts of this subscription, newest first. Each entry records
     * one attempt with the response it got, so a retried event appears once per attempt.
     *
     * - **`event_type`:** narrows the list to a single event type.
     * - **`event_id`:** follows one event across every attempt made on it, without paging
     *   through the whole history.
     *
     * @param string $accountId Your own account, or an account you provisioned. It — not the credential, and not the `BeeL-Active-Company` header — decides which account the operation acts on. An account you do not reach answers `403`, and so does an account that does not exist, so the existence of somebody else's account is never disclosed.
     * @param string $webhookId Subscription of the account in the path. A subscription of another account answers `404`, the same as one that does not exist: under the account resolved from `{account_id}` it simply is not there.
     * @param array{
     *    "page"?: int, //Page number, starting at 1. The response echoes it back as `pagination.current_page`.
     *    "limit"?: int, //How many items to return per page. The response echoes it back as `pagination.items_per_page`.
     *    "event_type"?: string, //Only deliveries of this event type.
     *    "event_id"?: string, //Only deliveries of this event. Use it to follow every attempt on one event without paging through the whole history.
     * } $queryParameters
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \Lenorix\BeelSdk\Generated\Exception\ListAccountWebhookDeliveriesUnauthorizedException
     * @throws \Lenorix\BeelSdk\Generated\Exception\ListAccountWebhookDeliveriesForbiddenException
     * @throws \Lenorix\BeelSdk\Generated\Exception\ListAccountWebhookDeliveriesNotFoundException
     * @throws \Lenorix\BeelSdk\Generated\Exception\ListAccountWebhookDeliveriesTooManyRequestsException
     * @throws \Lenorix\BeelSdk\Generated\Exception\ListAccountWebhookDeliveriesInternalServerErrorException
     *
     * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\V1AccountsAccountIdWebhooksWebhookIdDeliveriesGetResponse200|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
     */
    public function listAccountWebhookDeliveries(string $accountId, string $webhookId, array $queryParameters = [], string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\ListAccountWebhookDeliveries($accountId, $webhookId, $queryParameters), $fetch);
    }
    /**
    * Re-sends the original payload of a delivery immediately.
    *
    * - **Payload:** the one captured when the event happened, not a fresh snapshot, so
    *   changes made to the entity since then are not reflected.
    * - **History:** the outcome is recorded as a new entry and the original entry is kept
    *   as it was. `attempt_number` continues the same sequence, so it can exceed the 5
    *   automatic attempts.
    *
    * @param string $accountId Your own account, or an account you provisioned. It — not the credential, and not the `BeeL-Active-Company` header — decides which account the operation acts on. An account you do not reach answers `403`, and so does an account that does not exist, so the existence of somebody else's account is never disclosed.
    * @param string $webhookId Subscription of the account in the path. A subscription of another account answers `404`, the same as one that does not exist: under the account resolved from `{account_id}` it simply is not there.
    * @param string $deliveryId Delivery attempt of that subscription to replay.
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
    
    * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
    * @throws \Lenorix\BeelSdk\Generated\Exception\RetryAccountWebhookDeliveryUnauthorizedException
    * @throws \Lenorix\BeelSdk\Generated\Exception\RetryAccountWebhookDeliveryForbiddenException
    * @throws \Lenorix\BeelSdk\Generated\Exception\RetryAccountWebhookDeliveryNotFoundException
    * @throws \Lenorix\BeelSdk\Generated\Exception\RetryAccountWebhookDeliveryTooManyRequestsException
    * @throws \Lenorix\BeelSdk\Generated\Exception\RetryAccountWebhookDeliveryInternalServerErrorException
    *
    * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\V1AccountsAccountIdWebhooksWebhookIdDeliveriesDeliveryIdRetryPostResponse200|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
    */
    public function retryAccountWebhookDelivery(string $accountId, string $webhookId, string $deliveryId, array $headerParameters = [], string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\RetryAccountWebhookDelivery($accountId, $webhookId, $deliveryId, $headerParameters), $fetch);
    }
    /**
    * Sends a synthetic payload to the subscription's URL immediately, outside the normal
    * delivery queue. Use it to verify that your endpoint is reachable and handles
    * deliveries correctly before you rely on real events.
    *
    * - **Payload:** carries `"test": true` and synthetic data, and is signed like any other
    *   delivery, so it also exercises your signature check.
    * - **Retries:** none. A failed test is not retried and does not appear in the delivery
    *   history.
    * - **`Idempotency-Key`:** repeating the call with the same key returns the cached
    *   result without sending the test payload again.
    * - **Result:** read `delivery_success`; a delivery your endpoint rejected is still a
    *   successful test run, not an error.
    *
    * @param string $accountId Your own account, or an account you provisioned. It — not the credential, and not the `BeeL-Active-Company` header — decides which account the operation acts on. An account you do not reach answers `403`, and so does an account that does not exist, so the existence of somebody else's account is never disclosed.
    * @param string $webhookId Subscription of the account in the path. A subscription of another account answers `404`, the same as one that does not exist: under the account resolved from `{account_id}` it simply is not there.
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
    
    * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
    * @throws \Lenorix\BeelSdk\Generated\Exception\TestAccountWebhookSubscriptionUnauthorizedException
    * @throws \Lenorix\BeelSdk\Generated\Exception\TestAccountWebhookSubscriptionForbiddenException
    * @throws \Lenorix\BeelSdk\Generated\Exception\TestAccountWebhookSubscriptionNotFoundException
    * @throws \Lenorix\BeelSdk\Generated\Exception\TestAccountWebhookSubscriptionTooManyRequestsException
    * @throws \Lenorix\BeelSdk\Generated\Exception\TestAccountWebhookSubscriptionInternalServerErrorException
    *
    * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\V1AccountsAccountIdWebhooksWebhookIdTestPostResponse200|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
    */
    public function testAccountWebhookSubscription(string $accountId, string $webhookId, array $headerParameters = [], string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\TestAccountWebhookSubscription($accountId, $webhookId, $headerParameters), $fetch);
    }
    /**
    * Generates a new HMAC signing secret for a webhook subscription.
    *
    * - **Old secret:** **immediately invalidated**. Update your signature verification
    *   logic before rotating, to avoid missing events during the transition.
    * - **New secret:** returned **once**, in this response only. It cannot be read again.
    *
    * @param string $accountId Your own account, or an account you provisioned. It — not the credential, and not the `BeeL-Active-Company` header — decides which account the operation acts on. An account you do not reach answers `403`, and so does an account that does not exist, so the existence of somebody else's account is never disclosed.
    * @param string $webhookId Subscription of the account in the path. A subscription of another account answers `404`, the same as one that does not exist: under the account resolved from `{account_id}` it simply is not there.
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
    
    * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
    * @throws \Lenorix\BeelSdk\Generated\Exception\RotateAccountWebhookSecretUnauthorizedException
    * @throws \Lenorix\BeelSdk\Generated\Exception\RotateAccountWebhookSecretForbiddenException
    * @throws \Lenorix\BeelSdk\Generated\Exception\RotateAccountWebhookSecretNotFoundException
    * @throws \Lenorix\BeelSdk\Generated\Exception\RotateAccountWebhookSecretTooManyRequestsException
    * @throws \Lenorix\BeelSdk\Generated\Exception\RotateAccountWebhookSecretInternalServerErrorException
    *
    * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\V1AccountsAccountIdWebhooksWebhookIdSecretPostResponse200|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
    */
    public function rotateAccountWebhookSecret(string $accountId, string $webhookId, array $headerParameters = [], string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\RotateAccountWebhookSecret($accountId, $webhookId, $headerParameters), $fetch);
    }
    /**
     * Returns the history of public API requests made by you, with any of your API keys in this
     * environment — not only the key you are authenticating with. Only `auth_type=API_KEY`
     * traffic is recorded.
     *
     * - **The axis is the person, not the individual credential:** a second key of yours sees the
     *   same history, and narrowing it to one key is a filter (`api_key_id`), not the default.
     * - **It is still not the account's traffic:** requests made by other users of the same
     *   account, or by their API keys, are never returned. The `{account_id}` in the path
     *   authorizes the call; it does not widen what you can see.
     * - **Environment is not a filter:** results are always scoped to the environment of the
     *   credential you authenticate with — a `beel_sk_test_*` key sees the test traffic of all
     *   your test keys, a `beel_sk_live_*` key the live traffic of all your live ones. To see
     *   the other environment, use a key from that environment.
     * - **Cursor pagination:** navigate with the opaque `cursor` returned in `next_cursor` /
     *   `prev_cursor`; there is no jump to an arbitrary page N.
     * - **Time window:** defaults to the last 30 days; narrow or move it with `from`/`to`.
     *
     * @param string $accountId Account the call is authorized against. It does not widen the result set.
     * @param array{
     *    "only_errors"?: bool, //If true, only requests with status >= 400.
     *    "method"?: string, //Filter by HTTP method.
     *    "http_status"?: int, //Filter by an exact HTTP status code.
     *    "path_contains"?: string, //Filter by path substring (case-insensitive).
     *    "api_key_id"?: string, //Narrow the result to one of your API keys. Any key of yours in this environment is accepted, not just the one you authenticate with; a key belonging to someone else simply yields no results.
     *    "from"?: string, //Lower bound of the time range (inclusive). Defaults to 30 days ago.
     *    "to"?: string, //Upper bound of the time range (inclusive). Defaults to now.
     *    "cursor"?: string, //Opaque cursor returned by a previous response (next_cursor / prev_cursor).
     *    "limit"?: int,
     * } $queryParameters
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \Lenorix\BeelSdk\Generated\Exception\ListAccountRequestLogsBadRequestException
     * @throws \Lenorix\BeelSdk\Generated\Exception\ListAccountRequestLogsUnauthorizedException
     * @throws \Lenorix\BeelSdk\Generated\Exception\ListAccountRequestLogsForbiddenException
     * @throws \Lenorix\BeelSdk\Generated\Exception\ListAccountRequestLogsUnprocessableEntityException
     * @throws \Lenorix\BeelSdk\Generated\Exception\ListAccountRequestLogsTooManyRequestsException
     * @throws \Lenorix\BeelSdk\Generated\Exception\ListAccountRequestLogsInternalServerErrorException
     *
     * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\RequestLogListResponse|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
     */
    public function listAccountRequestLogs(string $accountId, array $queryParameters = [], string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\ListAccountRequestLogs($accountId, $queryParameters), $fetch);
    }
    /**
    * Returns the full detail (bodies and headers) of a request made by you, with any of your API
    * keys in this environment — including one made with a key other than the one you are
    * authenticating with, because the axis is the person, not the individual credential.
    *
    * - **`{account_id}`:** authorizes the call; it does not widen what you can see.
    * - **`404`:** the request does not exist, was made by another user (including another user
    *   of this same account), or belongs to the other environment.
    * - **The widest read `logs:read` opens:** it returns the bodies and headers that any key
    *   of yours exchanged in this environment, so a key holding only `logs:read` reads the
    *   traffic of your privileged keys too. It never crosses to another user or to another
    *   account. Grant it accordingly.
    *
    * @param string $accountId Account the call is authorized against. It does not widen the result set.
    * @param string $requestId Correlation identifier (X-Request-Id).
    * @param array{
    *    "timestamp"?: string, //Log timestamp (the one returned by the list). Narrows the search window around
    that instant so the detail also works for logs older than the default window.
    If omitted, the default recent window is searched.
    * } $queryParameters
    
    * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
    * @throws \Lenorix\BeelSdk\Generated\Exception\GetAccountRequestLogUnauthorizedException
    * @throws \Lenorix\BeelSdk\Generated\Exception\GetAccountRequestLogForbiddenException
    * @throws \Lenorix\BeelSdk\Generated\Exception\GetAccountRequestLogNotFoundException
    * @throws \Lenorix\BeelSdk\Generated\Exception\GetAccountRequestLogTooManyRequestsException
    * @throws \Lenorix\BeelSdk\Generated\Exception\GetAccountRequestLogInternalServerErrorException
    *
    * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\RequestLogSingleResponse|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
    */
    public function getAccountRequestLog(string $accountId, string $requestId, array $queryParameters = [], string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\GetAccountRequestLog($accountId, $requestId, $queryParameters), $fetch);
    }
    /**
     * Returns the history of public API requests made by you, with any of your API keys in this
     * environment — not only the key you are authenticating with. Only `auth_type=API_KEY`
     * traffic is recorded.
     *
     * - **Deprecated:** use `GET /v1/accounts/{account_id}/request-logs`, whose result set is
     *   identical.
     *
     * ## Whose traffic you see
     *
     * - **The axis is the person, not the individual credential:** a second key of yours sees the
     *   same history, and narrowing it to one key is a filter (`api_key_id`), not the default.
     *   Requests made by other users, including other users of the same account, are never
     *   returned.
     * - **Environment is not a filter:** results are always scoped to the environment of the
     *   credential you authenticate with — a `beel_sk_test_*` key sees the test traffic of all
     *   your test keys, a `beel_sk_live_*` key the live traffic of all your live ones. To see
     *   the other environment, use a key from that environment.
     *
     * ## Browsing the history
     *
     * - **Cursor pagination:** navigate with the opaque `cursor` returned in `next_cursor` /
     *   `prev_cursor`; there is no jump to an arbitrary page N.
     * - **Time window:** defaults to the last 30 days; narrow or move it with `from`/`to`.
     *
     * **Retires on 9 December 2026.** See the [migration guide](https://docs.beel.es/changelog/resources-under-the-nif) for what moved where and what changes when you switch.
     *
     * @param array{
     *    "only_errors"?: bool, //If true, only requests with status >= 400.
     *    "method"?: string, //Filter by HTTP method.
     *    "http_status"?: int, //Filter by an exact HTTP status code.
     *    "path_contains"?: string, //Filter by path substring (case-insensitive).
     *    "api_key_id"?: string, //Filter by a specific API key.
     *    "from"?: string, //Lower bound of the time range (inclusive). Defaults to 30 days ago.
     *    "to"?: string, //Upper bound of the time range (inclusive). Defaults to now.
     *    "cursor"?: string, //Opaque cursor returned by a previous response (next_cursor / prev_cursor).
     *    "limit"?: int,
     * } $queryParameters
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \Lenorix\BeelSdk\Generated\Exception\ListDeveloperRequestLogsBadRequestException
     * @throws \Lenorix\BeelSdk\Generated\Exception\ListDeveloperRequestLogsUnauthorizedException
     * @throws \Lenorix\BeelSdk\Generated\Exception\ListDeveloperRequestLogsForbiddenException
     * @throws \Lenorix\BeelSdk\Generated\Exception\ListDeveloperRequestLogsUnprocessableEntityException
     * @throws \Lenorix\BeelSdk\Generated\Exception\ListDeveloperRequestLogsInternalServerErrorException
     *
     * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\RequestLogListResponse|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
     */
    public function listDeveloperRequestLogs(array $queryParameters = [], string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\ListDeveloperRequestLogs($queryParameters), $fetch);
    }
    /**
    * Returns the full detail (bodies and headers) of a request made by you, with any of your API
    * keys in this environment — the axis is the person, not the individual credential.
    *
    * - **Deprecated:** use `GET /v1/accounts/{account_id}/request-logs/{request_id}`, whose
    *   result is identical.
    * - **`404`:** the request does not exist, was made by another user, or belongs to the other
    *   environment.
    * - **The widest read `logs:read` opens:** it returns the bodies and headers that any key
    *   of yours exchanged in this environment, so a key holding only `logs:read` reads the
    *   traffic of your privileged keys too. It never crosses to another user or to another
    *   account. Grant it accordingly.
    *
    * **Retires on 9 December 2026.** See the [migration guide](https://docs.beel.es/changelog/resources-under-the-nif) for what moved where and what changes when you switch.
    *
    * @param string $requestId Correlation identifier (X-Request-Id).
    * @param array{
    *    "timestamp"?: string, //Log timestamp (the one returned by the list). Narrows the search window around
    that instant so the detail also works for logs older than the default window.
    If omitted, the default recent window is searched.
    * } $queryParameters
    
    * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
    * @throws \Lenorix\BeelSdk\Generated\Exception\GetDeveloperRequestLogUnauthorizedException
    * @throws \Lenorix\BeelSdk\Generated\Exception\GetDeveloperRequestLogForbiddenException
    * @throws \Lenorix\BeelSdk\Generated\Exception\GetDeveloperRequestLogNotFoundException
    * @throws \Lenorix\BeelSdk\Generated\Exception\GetDeveloperRequestLogInternalServerErrorException
    *
    * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\RequestLogSingleResponse|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
    */
    public function getDeveloperRequestLog(string $requestId, array $queryParameters = [], string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\GetDeveloperRequestLog($requestId, $queryParameters), $fetch);
    }
    /**
     * Returns the emails the system recorded on behalf of the account in the path: invoice
     * deliveries, verification, onboarding. It only reads the history; it does not send or resend
     * anything.
     *
     * - **Every attempt is recorded**, not only the ones that went out: an email stopped by
     *   policy is listed with `status` `REJECTED`, and one accepted but not dispatched yet as
     *   `QUEUED`, rather than being omitted.
     * - **Order:** by `sent_at` descending, configurable with `sort_by` / `sort_order`.
     * - **Filters:** `type`, `status`, `recipient` and `related_entity_id`.
     * - **`sent_at`:** the moment the message was handed over, so it is absent while an email is
     *   still `QUEUED`.
     * - **Scope:** the account is the one named in the path; the environment is not, and comes
     *   from the credential.
     *
     * @param string $accountId Your own account, or an account you provisioned. It — not the credential — decides which account the operation acts on; a `403` is returned when you do not reach it, the same response an account that does not exist gets.
     * @param array{
     *    "page"?: int, //Page number, starting at 1. The response echoes it back as `pagination.current_page`.
     *    "limit"?: int, //How many items to return per page. The response echoes it back as `pagination.items_per_page`.
     *    "type"?: string, //Filter by email type (e.g. INVOICE_EMITTED)
     *    "status"?: string, //Filter by delivery status
     *    "recipient"?: string, //Filter to emails where any recipient contains the term (case-insensitive)
     *    "related_entity_id"?: string, //Filter to emails associated with a given related entity (e.g. an invoice id)
     *    "sort_by"?: string, //Field to sort by
     *    "sort_order"?: string, //Sort order direction
     * } $queryParameters
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \Lenorix\BeelSdk\Generated\Exception\ListAccountEmailDeliveriesBadRequestException
     * @throws \Lenorix\BeelSdk\Generated\Exception\ListAccountEmailDeliveriesUnauthorizedException
     * @throws \Lenorix\BeelSdk\Generated\Exception\ListAccountEmailDeliveriesForbiddenException
     * @throws \Lenorix\BeelSdk\Generated\Exception\ListAccountEmailDeliveriesTooManyRequestsException
     * @throws \Lenorix\BeelSdk\Generated\Exception\ListAccountEmailDeliveriesInternalServerErrorException
     *
     * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\EmailDeliveryListResponse|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
     */
    public function listAccountEmailDeliveries(string $accountId, array $queryParameters = [], string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\ListAccountEmailDeliveries($accountId, $queryParameters), $fetch);
    }
    /**
     * Returns, for each related entity id given, how many emails the history holds for it, the
     * status of the most recent one and when it was sent. Lets you show the state of an entity's
     * email without loading its full history.
     *
     * - **`last_status`:** carries whatever the latest attempt ended in, `REJECTED` and `QUEUED`
     *   included, so a `count` above zero does not mean an email reached anyone.
     * - **Ids with no associated emails:** omitted from the response rather than returned with
     *   `count` 0.
     *
     * **Closed catalogue.** This collection is fixed and bounded by the request itself — at most
     * one indicator per id in `related_entity_ids`: it carries no `pagination`, it takes no
     * `page`/`limit`, and every response holds the whole set.
     *
     * @param string $accountId Your own account, or an account you provisioned. It — not the credential — decides which account the operation acts on; a `403` is returned when you do not reach it, the same response an account that does not exist gets.
     * @param array{
     *    "related_entity_ids": array, //Comma-separated list of related entity ids (e.g. invoice ids)
     * } $queryParameters
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetAccountEmailDeliveryIndicatorsBadRequestException
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetAccountEmailDeliveryIndicatorsUnauthorizedException
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetAccountEmailDeliveryIndicatorsForbiddenException
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetAccountEmailDeliveryIndicatorsTooManyRequestsException
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetAccountEmailDeliveryIndicatorsInternalServerErrorException
     *
     * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\EmailDeliveryIndicatorListResponse|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
     */
    public function getAccountEmailDeliveryIndicators(string $accountId, array $queryParameters = [], string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\GetAccountEmailDeliveryIndicators($accountId, $queryParameters), $fetch);
    }
    /**
     * Returns one recorded email with its message body (HTML and plain text), its attachments
     * and, for batch emails, the invoices it carried.
     *
     * - **`body_available`:** the body is fetched live and is only available while the message
     *   has a provider message id and the provider still retains it; otherwise it is `false` and
     *   `html_body` / `text_body` are `null`.
     * - **An email that never left:** `QUEUED` or `REJECTED`, it has no body for that reason.
     *
     * @param string $accountId Your own account, or an account you provisioned. It — not the credential — decides which account the operation acts on; a `403` is returned when you do not reach it, the same response an account that does not exist gets.
     * @param string $emailId Email delivery id
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetAccountEmailDeliveryBadRequestException
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetAccountEmailDeliveryUnauthorizedException
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetAccountEmailDeliveryForbiddenException
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetAccountEmailDeliveryNotFoundException
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetAccountEmailDeliveryTooManyRequestsException
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetAccountEmailDeliveryInternalServerErrorException
     *
     * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\EmailDeliveryDetailResponse|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
     */
    public function getAccountEmailDelivery(string $accountId, string $emailId, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\GetAccountEmailDelivery($accountId, $emailId), $fetch);
    }
    /**
     * Returns the emails the system recorded on behalf of the authenticated account: invoice
     * deliveries, verification, onboarding. It only reads the history; it does not send or resend
     * anything.
     *
     * - **Deprecated:** use `GET /v1/accounts/{account_id}/emails`, which behaves identically.
     *
     * - **Every attempt is recorded**, not only the ones that went out: an email stopped by
     *   policy is listed with `status` `REJECTED`, and one accepted but not dispatched yet as
     *   `QUEUED`, rather than being omitted.
     * - **Order:** by `sent_at` descending, configurable with `sort_by` / `sort_order`.
     * - **Filters:** `type`, `status`, `recipient` and `related_entity_id`.
     * - **`sent_at`:** the moment the message was handed over, so it is absent while an email is
     *   still `QUEUED`.
     *
     * **Retires on 9 December 2026.** See the [migration guide](https://docs.beel.es/changelog/resources-under-the-nif) for what moved where and what changes when you switch.
     *
     * @param array{
     *    "page"?: int, //Page number, starting at 1. The response echoes it back as `pagination.current_page`.
     *    "limit"?: int, //How many items to return per page. The response echoes it back as `pagination.items_per_page`.
     *    "type"?: string, //Filter by email type (e.g. INVOICE_EMITTED)
     *    "status"?: string, //Filter by delivery status
     *    "recipient"?: string, //Filter to emails where any recipient contains the term (case-insensitive)
     *    "related_entity_id"?: string, //Filter to emails associated with a given related entity (e.g. an invoice id)
     *    "sort_by"?: string, //Field to sort by
     *    "sort_order"?: string, //Sort order direction
     * } $queryParameters
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \Lenorix\BeelSdk\Generated\Exception\ListEmailDeliveriesUnauthorizedException
     * @throws \Lenorix\BeelSdk\Generated\Exception\ListEmailDeliveriesForbiddenException
     * @throws \Lenorix\BeelSdk\Generated\Exception\ListEmailDeliveriesUnprocessableEntityException
     * @throws \Lenorix\BeelSdk\Generated\Exception\ListEmailDeliveriesInternalServerErrorException
     *
     * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\EmailDeliveryListResponse|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
     */
    public function listEmailDeliveries(array $queryParameters = [], string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\ListEmailDeliveries($queryParameters), $fetch);
    }
    /**
     * Returns, for each related entity id given, how many emails the history holds for it, the
     * status of the most recent one and when it was sent. Lets you show the state of an entity's
     * email without loading its full history.
     *
     * - **`last_status`:** carries whatever the latest attempt ended in, `REJECTED` and `QUEUED`
     *   included, so a `count` above zero does not mean an email reached anyone.
     * - **Ids with no associated emails:** omitted from the response rather than returned with
     *   `count` 0.
     * - **Deprecated:** use `GET /v1/accounts/{account_id}/email-indicators`, which behaves
     *   identically.  The successor is a sibling of the email collection, not `…/emails/indicators`:
     *   `indicators` used to sit where an email id goes.
     *
     * **Retires on 9 December 2026.** See the [migration guide](https://docs.beel.es/changelog/resources-under-the-nif) for what moved where and what changes when you switch.
     *
     * @param array{
     *    "related_entity_ids": array, //Comma-separated list of related entity ids (e.g. invoice ids)
     * } $queryParameters
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetEmailDeliveryIndicatorsBadRequestException
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetEmailDeliveryIndicatorsUnauthorizedException
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetEmailDeliveryIndicatorsForbiddenException
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetEmailDeliveryIndicatorsInternalServerErrorException
     *
     * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\EmailDeliveryIndicatorListResponse|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
     */
    public function getEmailDeliveryIndicators(array $queryParameters = [], string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\GetEmailDeliveryIndicators($queryParameters), $fetch);
    }
    /**
     * Returns one recorded email with its message body (HTML and plain text), its attachments
     * and, for batch emails, the invoices it carried.
     *
     * - **`body_available`:** the body is fetched live and is only available while the message
     *   has a provider message id and the provider still retains it; otherwise it is `false` and
     *   `html_body` / `text_body` are `null`.
     * - **An email that never left:** `QUEUED` or `REJECTED`, it has no body for that reason.
     * - **Deprecated:** use `GET /v1/accounts/{account_id}/emails/{email_id}`, which behaves
     *   identically.
     *
     * **Retires on 9 December 2026.** See the [migration guide](https://docs.beel.es/changelog/resources-under-the-nif) for what moved where and what changes when you switch.
     *
     * @param string $emailId Email delivery id
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetEmailDeliveryUnauthorizedException
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetEmailDeliveryForbiddenException
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetEmailDeliveryNotFoundException
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetEmailDeliveryInternalServerErrorException
     *
     * @return ($fetch is 'object' ? null|\Lenorix\BeelSdk\Generated\Model\EmailDeliveryDetailResponse|\Lenorix\BeelSdk\Generated\Model\ErrorResponse : \Psr\Http\Message\ResponseInterface)
     */
    public function getEmailDelivery(string $emailId, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Lenorix\BeelSdk\Generated\Endpoint\GetEmailDelivery($emailId), $fetch);
    }
    public static function create($httpClient = null, array $additionalPlugins = [], array $additionalNormalizers = [], bool $applyServerPlugins = true)
    {
        $plugins = [];
        if (null === $httpClient) {
            $httpClient = \Http\Discovery\Psr18ClientDiscovery::find();
        }
        if ($applyServerPlugins) {
            $uri = \Http\Discovery\Psr17FactoryDiscovery::findUriFactory()->createUri('https://app.beel.es/api');
            $plugins[] = new \Http\Client\Common\Plugin\AddHostPlugin($uri);
            $plugins[] = new \Http\Client\Common\Plugin\AddPathPlugin($uri);
        }
        if (count($additionalPlugins) > 0) {
            $plugins = array_merge($plugins, $additionalPlugins);
        }
        $httpClient = new \Http\Client\Common\PluginClient($httpClient, $plugins);
        $requestFactory = \Http\Discovery\Psr17FactoryDiscovery::findRequestFactory();
        $streamFactory = \Http\Discovery\Psr17FactoryDiscovery::findStreamFactory();
        $normalizers = [new \Symfony\Component\Serializer\Normalizer\ArrayDenormalizer(), new \Lenorix\BeelSdk\Generated\Normalizer\JaneObjectNormalizer()];
        if (count($additionalNormalizers) > 0) {
            $normalizers = array_merge($normalizers, $additionalNormalizers);
        }
        $serializer = new \Symfony\Component\Serializer\Serializer($normalizers, [new \Symfony\Component\Serializer\Encoder\JsonEncoder(new \Symfony\Component\Serializer\Encoder\JsonEncode(), new \Symfony\Component\Serializer\Encoder\JsonDecode(['json_decode_associative' => true])), new \Lenorix\BeelSdk\Generated\Runtime\Client\FormEncoder()]);
        return new static($httpClient, $requestFactory, $serializer, $streamFactory);
    }
}