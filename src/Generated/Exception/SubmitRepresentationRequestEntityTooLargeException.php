<?php

namespace Lenorix\BeelSdk\Generated\Exception;

use Lenorix\BeelSdk\Generated\Model\ResponsePayloadTooLarge;
use Psr\Http\Message\ResponseInterface;

class SubmitRepresentationRequestEntityTooLargeException extends RequestEntityTooLargeException
{
    /**
     * @var ResponsePayloadTooLarge
     */
    private $responsePayloadTooLarge;

    /**
     * @var ResponseInterface
     */
    private $response;

    public function __construct(ResponsePayloadTooLarge $responsePayloadTooLarge, ResponseInterface $response)
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

    public function getResponsePayloadTooLarge(): ResponsePayloadTooLarge
    {
        return $this->responsePayloadTooLarge;
    }

    public function getResponse(): ResponseInterface
    {
        return $this->response;
    }
}
