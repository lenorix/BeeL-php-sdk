<?php

namespace Lenorix\BeelSdk\Generated\Exception;

class CreateCompanyForbiddenException extends ForbiddenException
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
        parent::__construct('Several distinct reasons, so branch on `error.code`:

* **No `error.code` of the feature family** — you do not reach the account this request
  resolves to (the `BeeL-Active-Company` header points at a company you neither own nor
  manage with write access). Account existence is never disclosed.
* `FEATURE_NOT_AVAILABLE` — you reach the account, but its plan does not include
  `multi_nif` and it **already has at least one company**. The first NIF of an account
  is always allowed (that is onboarding); every NIF after it needs the feature.
  `error.details.feature_code` is `multi_nif` and `error.details.current_plan` carries
  the account\'s current plan (`NONE` when it has none). `multi_nif` is contact-sales,
  so there is no self-service plan to upgrade to and no `action`/upgrade target travels
  in `details` — unlike the plan-based features, where it does.
* `NOT_BILLING_OWNER` — creating a NIF **in Live** requires being the billing subject of
  the account. A collaborator, or an API key minted by a member who is not the account\'s
  owner, reaches the account and can create in Test, but cannot switch a NIF on in Live.
  The owner has to do it, or mint the key.
* `BILLING_MANAGED_BY_PROVIDER` — the account\'s billing is run by its provider, so
  creating in Live has to be requested from them; retrying will not help.

`FEATURE_NOT_AVAILABLE` runs before the environment branches, so it applies to `TEST`
and to `PROD` alike, and it runs *after* the duplicate-NIF check: re-sending a NIF you
already have is a `409`, never an upsell.

The two billing-subject codes only apply to a request that switches the NIF on in Live,
and they are answered **before** the `409` of a NIF already live in another account and
before any `402`: neither has an action you could take, so nothing about another
account\'s state is disclosed to someone who cannot act on it.
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