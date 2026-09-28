<?php

namespace Lenorix\BeelSdk\Generated\Exception;

class PreviewCompanyCustomerImportBadRequestException extends BadRequestException
{
    /**
     * @var \Lenorix\BeelSdk\Generated\Model\ResponseCustomerImportRejected
     */
    private $responseCustomerImportRejected;
    /**
     * @var \Psr\Http\Message\ResponseInterface
     */
    private $response;
    public function __construct(\Lenorix\BeelSdk\Generated\Model\ResponseCustomerImportRejected $responseCustomerImportRejected, \Psr\Http\Message\ResponseInterface $response)
    {
        parent::__construct('The file was rejected as a whole, before any record was looked at: it is not valid CSV, its
encoding is not UTF-8, required columns are missing, it is over the size limit, or it carries
more records than the operation accepts.

Which one it was travels in `error.code`, and the values behind it in `error.details`:
`missing_headers` and `found_headers` for `MISSING_HEADERS`, `record_count` and
`max_records` for `TOO_MANY_RECORDS`, `file_size_mb` and `max_file_size_mb` for
`CSV_FILE_TOO_LARGE`. A rejection with nothing to quantify carries no `details`.
');
        $this->responseCustomerImportRejected = $responseCustomerImportRejected;
        $this->response = $response;
    }
    public function getResponseCustomerImportRejected(): \Lenorix\BeelSdk\Generated\Model\ResponseCustomerImportRejected
    {
        return $this->responseCustomerImportRejected;
    }
    public function getResponse(): \Psr\Http\Message\ResponseInterface
    {
        return $this->response;
    }
}