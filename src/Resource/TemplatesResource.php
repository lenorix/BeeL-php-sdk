<?php

declare(strict_types=1);

namespace Lenorix\BeelSdk\Resource;

use Lenorix\BeelSdk\Generated\Client;
use Lenorix\BeelSdk\Generated\Endpoint\DownloadAccountImportTemplate;
use Lenorix\BeelSdk\Generated\Endpoint\DownloadCustomerImportTemplate;
use Lenorix\BeelSdk\Http\BinaryDownload;
use Lenorix\BeelSdk\Http\ResponseContext;

/** CSV templates for bulk imports. */
final readonly class TemplatesResource extends GeneratedResource
{
    public function __construct(Client $client, ?ResponseContext $responseContext = null)
    {
        parent::__construct($client, $responseContext);
    }

    /**
     * Download the CSV template for importing managed accounts.
     *
     * @see https://docs.beel.es/customers/downloadAccountImportTemplate
     */
    public function accountImport(): BinaryDownload
    {
        return BinaryDownload::fromResponse($this->executeRaw(new DownloadAccountImportTemplate));
    }

    /**
     * Download the CSV template for importing customers.
     *
     * @see https://docs.beel.es/customers/downloadCustomerImportTemplate
     */
    public function customerImport(): BinaryDownload
    {
        return BinaryDownload::fromResponse($this->executeRaw(new DownloadCustomerImportTemplate));
    }
}
