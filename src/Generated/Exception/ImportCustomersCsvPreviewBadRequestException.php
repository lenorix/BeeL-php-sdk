<?php

namespace Lenorix\BeelSdk\Generated\Exception;

class ImportCustomersCsvPreviewBadRequestException extends BadRequestException
{
    /**
     * @var \Lenorix\BeelSdk\Generated\Model\ErrorResponse
     */
    private $errorResponse;
    /**
     * @var \Psr\Http\Message\ResponseInterface
     */
    private $response;
    public function __construct(\Lenorix\BeelSdk\Generated\Model\ErrorResponse $errorResponse, \Psr\Http\Message\ResponseInterface $response)
    {
        parent::__construct('Invalid file for one of the following reasons:
- Format is not valid CSV
- Encoding is not UTF-8
- Required headers missing
- Size exceeds 5MB
- More than 1,000 records

Which one it was travels in `error.message`. `error.details` may carry the same details
as the canonical route; do not rely on it here — migrate.
');
        $this->errorResponse = $errorResponse;
        $this->response = $response;
    }
    public function getErrorResponse(): \Lenorix\BeelSdk\Generated\Model\ErrorResponse
    {
        return $this->errorResponse;
    }
    public function getResponse(): \Psr\Http\Message\ResponseInterface
    {
        return $this->response;
    }
}