<?php

declare(strict_types=1);

namespace Lenorix\BeelSdk\Resource\Company;

use Lenorix\BeelSdk\Generated\Client;
use Lenorix\BeelSdk\Generated\Model\RepresentationActionResponseData;
use Lenorix\BeelSdk\Generated\Model\RepresentationDownloadResponseData;
use Lenorix\BeelSdk\Generated\Model\RepresentationStatusResponseData;
use Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdRepresentationSubmitPostBody;
use Lenorix\BeelSdk\Http\ResponseContext;
use Lenorix\BeelSdk\Resource\GeneratedResource;

/** The AEAT representation a company signs so BeeL can submit its invoices in production. */
final readonly class CompanyRepresentationResource extends GeneratedResource
{
    public function __construct(Client $client, private string $companyId, ?ResponseContext $responseContext = null)
    {
        parent::__construct($client, $responseContext);
    }

    /**
     * Retrieve the state of this company's representation.
     *
     * @see https://docs.beel.es/companies/getCompanyRepresentation
     */
    public function get(): RepresentationStatusResponseData
    {
        return $this->execute(fn () => $this->client->getCompanyRepresentation($this->companyId));
    }

    /**
     * Generate the representation document for the company to sign.
     *
     * @param  array<string, mixed>  $headers  Request headers, including optional `Idempotency-Key`.
     */
    public function generate(array $headers = []): RepresentationActionResponseData
    {
        return $this->execute(fn () => $this->client->generateCompanyRepresentation($this->companyId, $headers));
    }

    /**
     * Get a temporary link to download the representation document.
     *
     * Returns `download_url` and `expires_in_seconds`, not the document bytes.
     */
    public function documentLink(): RepresentationDownloadResponseData
    {
        return $this->execute(fn () => $this->client->downloadCompanyRepresentationDocument($this->companyId));
    }

    /**
     * Upload the signed representation document, sent as `multipart/form-data`.
     *
     * The signature is validated asynchronously: success means accepted for validation,
     * so poll {@see self::get()} for the outcome.
     *
     * @param  V1CompaniesCompanyIdRepresentationSubmitPostBody|array<string, mixed>  $request  The request as a model or as an array in API format.
     * @param  array<string, mixed>  $headers  Request headers, including optional `Idempotency-Key`.
     */
    public function submit(V1CompaniesCompanyIdRepresentationSubmitPostBody|array $request, array $headers = []): RepresentationActionResponseData
    {
        $request = $this->model($request, V1CompaniesCompanyIdRepresentationSubmitPostBody::class);

        return $this->execute(fn () => $this->client->submitCompanyRepresentation($this->companyId, $request, $headers));
    }

    /** Cancel the representation process in progress. */
    public function cancel(): void
    {
        $this->executeVoid(fn () => $this->client->cancelCompanyRepresentation($this->companyId));
    }
}
