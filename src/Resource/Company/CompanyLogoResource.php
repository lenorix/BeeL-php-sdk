<?php

declare(strict_types=1);

namespace Lenorix\BeelSdk\Resource\Company;

use Lenorix\BeelSdk\Generated\Client;
use Lenorix\BeelSdk\Generated\Model\CompanyLogo;
use Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdLogoPutBody;
use Lenorix\BeelSdk\Http\RequestModels;
use Lenorix\BeelSdk\Http\ResponseContext;
use Lenorix\BeelSdk\Resource\GeneratedResource;
use Psr\Http\Message\StreamInterface;

/** The logo printed on this company's invoices. */
final readonly class CompanyLogoResource extends GeneratedResource
{
    public function __construct(Client $client, private string $companyId, ?ResponseContext $responseContext = null)
    {
        parent::__construct($client, $responseContext);
    }

    /**
     * Upload or replace the company logo, sent as `multipart/form-data`.
     *
     * @param  V1CompaniesCompanyIdLogoPutBody|array<string, mixed>|StreamInterface|resource|string  $logo  The image as an open file, a stream or its contents, or a request with `file`.
     * @param  array<string, mixed>  $headers  Request headers, including optional `Idempotency-Key`.
     *
     * @see https://docs.beel.es/companies/uploadCompanyLogoById
     */
    public function upload(mixed $logo, array $headers = []): CompanyLogo
    {
        if (! $logo instanceof V1CompaniesCompanyIdLogoPutBody && ! is_array($logo)) {
            if (! is_string($logo) && ! is_resource($logo) && ! $logo instanceof StreamInterface) {
                throw new \InvalidArgumentException('The logo must be a file resource, a stream, its contents as a string, or a request.');
            }
            $logo = ['file' => $logo];
        }
        $request = RequestModels::from($logo, V1CompaniesCompanyIdLogoPutBody::class);

        return $this->execute(fn () => $this->client->uploadCompanyLogoById($this->companyId, $request, $headers));
    }

    /**
     * Remove the company logo.
     *
     * @see https://docs.beel.es/companies/deleteCompanyLogoById
     */
    public function delete(): void
    {
        $this->executeVoid(fn () => $this->client->deleteCompanyLogoById($this->companyId));
    }
}
