<?php

declare(strict_types=1);

namespace Lenorix\BeelSdk\Resource;

use Lenorix\BeelSdk\Generated\Client;
use Lenorix\BeelSdk\Generated\Model\MyIdentity;
use Lenorix\BeelSdk\Generated\Model\MyPreferences;
use Lenorix\BeelSdk\Generated\Model\UpdateMeRequest;
use Lenorix\BeelSdk\Http\ResponseContext;

/** The authenticated principal: who the API key belongs to and what it may do. */
final readonly class MeResource extends GeneratedResource
{
    public function __construct(Client $client, ?ResponseContext $responseContext = null)
    {
        parent::__construct($client, $responseContext);
    }

    /**
     * Return the account the credential belongs to and a description of the credential itself.
     *
     * Requires no scope: any valid key succeeds, so it also checks that a key works. The
     * credential part includes its type, environment and scopes.
     *
     * @see https://docs.beel.es/identity/getMyIdentity
     */
    public function identity(): MyIdentity
    {
        return $this->execute(fn () => $this->client->getMyIdentity());
    }

    /** Update the authenticated user's preferences. */
    public function update(UpdateMeRequest $request): MyPreferences
    {
        return $this->execute(fn () => $this->client->updateMe($request));
    }
}
