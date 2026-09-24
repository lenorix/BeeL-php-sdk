<?php

namespace Lenorix\BeelSdk\Generated\Exception;

class PreviewAccountImportRequestEntityTooLargeException extends RequestEntityTooLargeException
{
    /**
     * @var \Lenorix\BeelSdk\Generated\Model\ResponsePayloadTooLarge
     */
    private $responsePayloadTooLarge;
    /**
     * @var \Psr\Http\Message\ResponseInterface
     */
    private $response;
    public function __construct(\Lenorix\BeelSdk\Generated\Model\ResponsePayloadTooLarge $responsePayloadTooLarge, \Psr\Http\Message\ResponseInterface $response)
    {
        parent::__construct('Payload too large. On this operation that normally means an uploaded file
exceeded its own limit (`FILE_TOO_LARGE`). Any request may also be
rejected with `REQUEST_BODY_TOO_LARGE` when the body as a whole exceeds
the maximum described under *Request body size*. In both cases the
`details` object carries the applicable maximum.
');
        $this->responsePayloadTooLarge = $responsePayloadTooLarge;
        $this->response = $response;
    }
    public function getResponsePayloadTooLarge(): \Lenorix\BeelSdk\Generated\Model\ResponsePayloadTooLarge
    {
        return $this->responsePayloadTooLarge;
    }
    public function getResponse(): \Psr\Http\Message\ResponseInterface
    {
        return $this->response;
    }
}