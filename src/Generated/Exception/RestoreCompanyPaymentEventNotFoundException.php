<?php

namespace Lenorix\BeelSdk\Generated\Exception;

use Lenorix\BeelSdk\Generated\Model\ErrorResponse;
use Psr\Http\Message\ResponseInterface;

class RestoreCompanyPaymentEventNotFoundException extends NotFoundException
{
    /**
     * @var ErrorResponse
     */
    private $errorResponse;

    /**
     * @var ResponseInterface
     */
    private $response;

    public function __construct(ErrorResponse $errorResponse, ResponseInterface $response)
    {
        parent::__construct('`CONNECTION_NOT_FOUND` when no connection of this NIF carries this `{connection_id}`;
`EVENT_NOT_FOUND` when the connection is yours but the event is not its own. Both answer
alike to an event that does not exist: the `404` speaks of the connection and the event,
never of the NIF. A NIF you cannot reach answers `403`; a connection of another NIF
answers this `404`, so naming it reveals nothing.
');
        $this->errorResponse = $errorResponse;
        $this->response = $response;
    }

    public function getErrorResponse(): ErrorResponse
    {
        return $this->errorResponse;
    }

    public function getResponse(): ResponseInterface
    {
        return $this->response;
    }
}
