<?php

declare(strict_types=1);

namespace Lenorix\BeelSdk\Resource;

use Lenorix\BeelSdk\Generated\Client;
use Lenorix\BeelSdk\Generated\Model\ValidateNifRequest;
use Lenorix\BeelSdk\Generated\Model\ValidateNifResponse;
use Lenorix\BeelSdk\Http\ResponseContext;

final readonly class NifResource extends GeneratedResource
{
    public function __construct(Client $client, ?ResponseContext $responseContext = null)
    {
        parent::__construct($client, $responseContext);
    }

    public function validate(string $nif): ?ValidateNifResponse
    {
        $request = (new ValidateNifRequest)->setNif($nif);

        return $this->execute(fn () => $this->client->validateNif($request));
    }
}
