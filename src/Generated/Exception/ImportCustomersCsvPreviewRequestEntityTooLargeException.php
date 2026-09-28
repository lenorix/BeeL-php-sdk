<?php

namespace Lenorix\BeelSdk\Generated\Exception;

class ImportCustomersCsvPreviewRequestEntityTooLargeException extends RequestEntityTooLargeException
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
        parent::__construct('The uploaded file is over 12 MB (`FILE_TOO_LARGE`) and is rejected before it is read. A CSV over its own 5 MB limit answers `400` (`CSV_FILE_TOO_LARGE`).');
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