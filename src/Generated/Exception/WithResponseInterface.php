<?php

namespace Lenorix\BeelSdk\Generated\Exception;

use Psr\Http\Message\ResponseInterface;

interface WithResponseInterface
{
    public function getResponse(): ?ResponseInterface;
}
