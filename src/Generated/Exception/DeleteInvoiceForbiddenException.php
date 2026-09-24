<?php

namespace Lenorix\BeelSdk\Generated\Exception;

class DeleteInvoiceForbiddenException extends ForbiddenException
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
        parent::__construct('Authenticated but not allowed. Ten causes, told apart by `error.code`. The list is
**closed**: every 403 this API returns carries one of these ten, so you can branch on
them exhaustively.

- `INSUFFICIENT_SCOPE` — the credential lacks a scope the operation requires;
  `error.details.missing_scopes` lists them. Retrying will not help: mint a key that
  holds them.
- `COMPANY_READ_ONLY` — the scope is there, but your access level over that NIF only
  lets you read it.
- `ACCOUNT_MANAGEMENT_FORBIDDEN` — the scope is there, but your role over the account,
  or the management relationship you hold over it, does not cover this operation.
- `ACCOUNT_NOT_ACCESSIBLE` — the account is not yours to reach, which is also the answer
  when it does not exist, so existence is never disclosed.
- `ACTIVE_COMPANY_NOT_ACCESSIBLE` — the same, for a NIF: the company in the path, or the
  one named by `BeeL-Active-Company`, is not one this credential may reach — and again,
  this is also the answer when it does not exist.
- `COMPANY_ACCESS_REVOKED` — your access to the NIF was withdrawn while the request was
  already in flight, so the write was rejected and nothing was recorded. Retrying will
  not help until the access is granted again.
- `LIVE_CREDENTIAL_REQUIRED` — the operation changes the real account and the call came
  from a test API key (`beel_sk_test_…`). Use your live key or the dashboard.
- `FEATURE_NOT_AVAILABLE` — your subscription does not include the entitlement the
  operation needs; `error.details.feature_code` names it. This gate runs **before** the
  scope gate, so for such an operation you never see `INSUFFICIENT_SCOPE` first.
- `NO_ACTIVE_ACCOUNT` — the credential does not resolve to an account, so no scope can be
  evaluated against one. Fail-closed, not a permission that can be granted to you.
- `OPERATION_REQUIRES_SESSION` — the operation is available only from the web session; no
  API key and no OAuth2 token can perform it, whatever scopes it holds.
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