<?php

namespace Lenorix\BeelSdk\Generated\Exception;

class CreateCompanyInvoiceBatchBadRequestException extends BadRequestException
{
    /**
     * @var \Lenorix\BeelSdk\Generated\Model\ResponseInvalidJsonFormat
     */
    private $responseInvalidJsonFormat;
    /**
     * @var \Psr\Http\Message\ResponseInterface
     */
    private $response;
    public function __construct(\Lenorix\BeelSdk\Generated\Model\ResponseInvalidJsonFormat $responseInvalidJsonFormat, \Psr\Http\Message\ResponseInterface $response)
    {
        parent::__construct('`INVALID_JSON_FORMAT` — the body is not valid JSON, or a property has the wrong type or format
(a string where a number is expected, a date that does not parse, a malformed UUID, a boolean
that is not `true`/`false`). The `details` object follows `FieldDeserializationError`:
`field`, `invalid_value` and, where there is one, `expected_format` (or `allowed_values`, for a
boolean). A property the operation does not declare is not a format error: it is ignored.

A value outside an **enum**\'s vocabulary is not answered here. The property is a well-formed
string that names nothing the operation knows, so it is judged as content: `422`
(`VALIDATION_ERROR`), with the same `FieldDeserializationError` shape in `details`
(`field`, `invalid_value`, `allowed_values`).
');
        $this->responseInvalidJsonFormat = $responseInvalidJsonFormat;
        $this->response = $response;
    }
    public function getResponseInvalidJsonFormat(): \Lenorix\BeelSdk\Generated\Model\ResponseInvalidJsonFormat
    {
        return $this->responseInvalidJsonFormat;
    }
    public function getResponse(): \Psr\Http\Message\ResponseInterface
    {
        return $this->response;
    }
}