<?php

declare(strict_types=1);

namespace Lenorix\BeelSdk\Resource;

use Lenorix\BeelSdk\Generated\Client;
use Lenorix\BeelSdk\Generated\Model\ValidateNifRequest;
use Lenorix\BeelSdk\Generated\Model\ValidateNifResponse;
use Lenorix\BeelSdk\Http\ResponseContext;

/** Validate Spanish NIF/CIF values against the AEAT census. */
final readonly class NifResource extends GeneratedResource
{
    public function __construct(Client $client, ?ResponseContext $responseContext = null)
    {
        parent::__construct($client, $responseContext);
    }

    /**
     * Check a NIF's syntax and census status with AEAT.
     *
     * A well-formed tax ID is not necessarily registered. The result distinguishes
     * census outcomes such as `VALID`, `INVALID` and `PENDING`.
     *
     * @see https://docs.beel.es/nif-validation/validateNif
     */
    public function validate(string $nif): ?ValidateNifResponse
    {
        $request = (new ValidateNifRequest)->setNif($nif);

        return $this->execute(fn () => $this->client->validateNif($request));
    }
}
