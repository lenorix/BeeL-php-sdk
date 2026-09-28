<?php

namespace Lenorix\BeelSdk\Generated\Exception;

class PatchSeriesUnprocessableEntityException extends UnprocessableEntityException
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
        parent::__construct('The series is rejected. `error.code` is `VALIDATION_ERROR` when the body parses but a value
is not acceptable: `details` is a flat map from the offending property\'s name (in the
contract\'s `snake_case`) to a message describing what is wrong with it, or follows
`FieldDeserializationError` when the value is outside an enum\'s vocabulary. Otherwise it is
one of the series rules, among them:
- `SERIES_MONTHLY_REQUIRES_MONTH_AND_YEAR` / `SERIES_ANNUAL_REQUIRES_YEAR` — the format
  cannot tell the counter reset periods apart.
- `SERIES_INITIAL_NUMBER_OUT_OF_RANGE` — the initial number is out of range.
- `SERIES_FORMAT_NUMBER_TOO_LONG` — the longest number the series can generate (the
  format with the code, the year, the month and the counter substituted) exceeds the 60
  characters the AEAT accepts for the invoice number. The counter counts as at least 9
  digits, with or without padding: `{NUM:X}` is a minimum width and the number keeps
  growing past it.
- `SERIES_FORMAT_INVALID_CHARACTERS` — that number would contain a character the AEAT does
  not accept: only printable ASCII (32-126) is allowed, except `"`, `\'`, `<`, `>` and `=`.
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