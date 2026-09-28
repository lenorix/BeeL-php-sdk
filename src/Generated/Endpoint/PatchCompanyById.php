<?php

namespace Lenorix\BeelSdk\Generated\Endpoint;

class PatchCompanyById extends \Lenorix\BeelSdk\Generated\Runtime\Client\BaseEndpoint implements \Lenorix\BeelSdk\Generated\Runtime\Client\Endpoint
{
    protected $company_id;
    /**
     * Updates the editable fields of a company; the set is the one
     * `UpdateCompanyRequest` declares.
     *
     * - **Immutable fields:** `nif`, `entity_type` and `legal_form`, once set. Sending one of
     *   them with a different value answers `422` with a code that names the field; sending the
     *   value it already has is not a change.
     * - **`legal_name`:** changing it requires the NIF to pass an AEAT census re-validation. For a
     *   legal entity (`LEGAL_ENTITY`) the census identifies the company by its NIF alone: the name
     *   is not verified, so the name sent cannot make it fail. For an `INDIVIDUAL` the name must
     *   match the one the census holds for that NIF.
     * - **Census not answering:** if the AEAT census cannot be reached, the change is not
     *   rejected. The response is `200` with the new `legal_name` stored, and BeeL repeats the
     *   census check in the background. The outcome of that check is not part of this resource:
     *   no field of `CompanyData` carries it. To know what the census says about a NIF and a name,
     *   ask `POST /v1/nif/validate`.
     * - **Addresses:** a Spanish postal code (`country_code` omitted or `ES`) must have 5 digits,
     *   in `address` and in `legal_representative.address`; otherwise `422 POSTAL_CODE_INVALID_ES`.
     *   Other countries' postal codes are free-form.
     *
     * ## Test credentials on a Live company
     *
     * Once the company is activated in Live, a test credential may only write the fields that
     * affect how the invoice looks: `logo_url`, `invoice_accent_color`,
     * `invoice_template_type`, `invoice_language`, `email_language` and `additional_info`. Any
     * other field describes the real business — fiscal address, legal representative, bank
     * details, contact data, IAE, activity start date, payment term — and answers
     * `422 FISCAL_IDENTITY_LIVE_ONLY` from Test, since the company is a single record shared by
     * both modes. A company not activated in Live accepts the whole body from Test, and sending
     * a field its current value is never a change.
     *
     * ## What comes back
     *
     * The `200` returns `CompanyData` with **every field this request accepts**, under the same
     * name and the same type — so the response is the confirmation of what was stored, and a
     * later `GET` says the same. A field you never set comes back absent, which means "nothing
     * stored", not "hidden".
     *
     * Two things live outside this body and keep their own reads: the invoice series
     * (`GET /v1/companies/{company_id}/series`) and the rendering block, which is also served
     * on its own by `GET /v1/companies/{company_id}/invoice-customization`.
     *
     * @param string $companyId Unique identifier (UUID) of the company the operation acts on — its identifier, not its NIF. It is the only source of context: the account that owns it is derived from it, and the `BeeL-Active-Company` header plays no part. A company you do not reach answers `403`, and so does a company that does not exist, so the existence of a company in another account is never disclosed.
     * @param \Lenorix\BeelSdk\Generated\Model\UpdateCompanyRequest $requestBody
     */
    public function __construct(string $companyId, \Lenorix\BeelSdk\Generated\Model\UpdateCompanyRequest $requestBody)
    {
        $this->company_id = $companyId;
        $this->body = $requestBody;
    }
    use \Lenorix\BeelSdk\Generated\Runtime\Client\EndpointTrait;
    public function getMethod(): string
    {
        return 'PATCH';
    }
    public function getUri(): string
    {
        return str_replace(['{company_id}'], [rawurlencode($this->company_id)], '/v1/companies/{company_id}');
    }
    public function getBody(\Symfony\Component\Serializer\SerializerInterface $serializer, $streamFactory = null): array
    {
        if ($this->body instanceof \Lenorix\BeelSdk\Generated\Model\UpdateCompanyRequest) {
            return [['Content-Type' => ['application/json']], \Lenorix\BeelSdk\Generated\Runtime\Client\JsonPayload::encode($serializer, $this->body)];
        }
        return [[], null];
    }
    public function getExtraHeaders(): array
    {
        return ['Accept' => ['application/json']];
    }
    /**
     * {@inheritdoc}
     *
     * @throws \Lenorix\BeelSdk\Generated\Exception\PatchCompanyByIdUnauthorizedException
     * @throws \Lenorix\BeelSdk\Generated\Exception\PatchCompanyByIdForbiddenException
     * @throws \Lenorix\BeelSdk\Generated\Exception\PatchCompanyByIdUnprocessableEntityException
     * @throws \Lenorix\BeelSdk\Generated\Exception\PatchCompanyByIdTooManyRequestsException
     * @throws \Lenorix\BeelSdk\Generated\Exception\PatchCompanyByIdInternalServerErrorException
     *
     * @return null|\Lenorix\BeelSdk\Generated\Model\CompanyResponse|\Lenorix\BeelSdk\Generated\Model\ErrorResponse
     */
    protected function transformResponseBody(\Psr\Http\Message\ResponseInterface $response, \Symfony\Component\Serializer\SerializerInterface $serializer, ?string $contentType = null)
    {
        $status = $response->getStatusCode();
        $body = (string) $response->getBody();
        if (is_null($contentType) === false && (200 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            return $serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\CompanyResponse', 'json');
        }
        if (is_null($contentType) === false && (401 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\PatchCompanyByIdUnauthorizedException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && (403 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\PatchCompanyByIdForbiddenException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && (422 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\PatchCompanyByIdUnprocessableEntityException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && (429 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\PatchCompanyByIdTooManyRequestsException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && (500 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\PatchCompanyByIdInternalServerErrorException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (stripos(strtolower($contentType), 'application/json') !== false) {
            return $serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json');
        }
    }
    public function getAuthenticationScopes(): array
    {
        return ['ApiKeyAuth'];
    }
}