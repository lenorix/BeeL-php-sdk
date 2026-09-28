<?php

namespace Lenorix\BeelSdk\Generated\Exception;

interface WithResponseInterface
{
    public function getResponse(): ?\Psr\Http\Message\ResponseInterface;
}