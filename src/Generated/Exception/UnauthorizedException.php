<?php

namespace Lenorix\BeelSdk\Generated\Exception;

abstract class UnauthorizedException extends \RuntimeException implements ClientException, WithResponseInterface
{
    public function __construct(string $message)
    {
        parent::__construct($message, 401);
    }
}