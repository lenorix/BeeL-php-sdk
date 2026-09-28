<?php

namespace Lenorix\BeelSdk\Generated\Exception;

abstract class BadGatewayException extends \RuntimeException implements ServerException, WithResponseInterface
{
    public function __construct(string $message)
    {
        parent::__construct($message, 502);
    }
}