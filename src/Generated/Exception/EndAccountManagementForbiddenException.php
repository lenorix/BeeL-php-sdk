<?php

namespace Lenorix\BeelSdk\Generated\Exception;

class EndAccountManagementForbiddenException extends ForbiddenException
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
        parent::__construct('Every cause listed under the plain `403` above, plus one specific to writes on the account\'s control plane: `LIVE_CREDENTIAL_REQUIRED`, returned when the call is made with a test API key (`beel_sk_test_…`). Members, invitations and grants are shared between Test and Live, so changing them is always a real change to the real account — there is no sandbox rehearsal of it. The same applies to changing a managed account\'s access level and to ending its management: both act on an account that may already be invoicing. Use your live API key or the dashboard; reading these resources keeps working with either key, and so does the whole account provisioning flow (provisioning and claim tokens), which creates an inert account and is what you are meant to rehearse in Test — with your test key, but still only if your subscription carries the `manage_accounts` entitlement: that gate applies in Test exactly as it does in Live, and without it the rehearsal answers `403 FEATURE_NOT_AVAILABLE` rather than this code. Accounts that have no live mode manage their people from the dashboard.');
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