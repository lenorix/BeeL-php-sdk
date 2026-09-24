<?php

namespace Lenorix\BeelSdk\Generated\Endpoint;

use Lenorix\BeelSdk\Generated\Exception\DeactivateCompanyByIdForbiddenException;
use Lenorix\BeelSdk\Generated\Exception\DeactivateCompanyByIdInternalServerErrorException;
use Lenorix\BeelSdk\Generated\Exception\DeactivateCompanyByIdTooManyRequestsException;
use Lenorix\BeelSdk\Generated\Exception\DeactivateCompanyByIdUnauthorizedException;
use Lenorix\BeelSdk\Generated\Model\ErrorResponse;
use Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdActivationsDeleteResponse200;
use Lenorix\BeelSdk\Generated\Runtime\Client\BaseEndpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\Endpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\EndpointTrait;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Serializer\SerializerInterface;

class DeactivateCompanyById extends BaseEndpoint implements Endpoint
{
    protected $company_id;

    /**
     * Switches the company off in the mode given by `environment`; the other mode is
     * untouched.
     *
     * - **Sealed, not deleted:** the activation's history survives. After the switch-off takes
     *   effect the NIF can neither issue nor correct invoices in that mode until it is switched
     *   on again, and in Live that sealing is what releases the NIF for another account.
     *
     * ## When it takes effect
     *
     * - **In Live the switch-off is scheduled, not immediate:** the cycle is paid up front, so
     *   the response carries an `effective_at` and the NIF keeps invoicing until then. Nothing is
     *   refunded. `effective_at` is the end of the current billing cycle, unless the NIF was
     *   switched on within that same cycle, in which case it is the end of the next one.
     * - **`TEST`, and `PROD` under an enterprise contract:** immediate, and answer with no
     *   `effective_at`.
     *
     * ## Repeats and permissions
     *
     * - **Repeating the call:** on a mode whose switch-off is already pending it returns the same
     *   date with `already_scheduled: true`; switching off a mode that was never on is a silent
     *   no-op.
     * - **Permission:** switching off in Live requires being the billing subject of the account.
     *
     * @param  string  $companyId  Unique identifier (UUID) of the company being switched on — its identifier, not its NIF. It is the only source of context: the account that owns it is derived from it, and the `BeeL-Active-Company` header plays no part. A company you do not reach answers `403`, and so does a company that does not exist, so the existence of a company in another account is never disclosed.
     * @param array{
     *    "environment": string, //Mode to switch the NIF off in.
     * } $queryParameters
     */
    public function __construct(string $companyId, array $queryParameters = [])
    {
        $this->company_id = $companyId;
        $this->queryParameters = $queryParameters;
    }

    use EndpointTrait;

    public function getMethod(): string
    {
        return 'DELETE';
    }

    public function getUri(): string
    {
        return str_replace(['{company_id}'], [rawurlencode($this->company_id)], '/v1/companies/{company_id}/activations');
    }

    public function getBody(SerializerInterface $serializer, $streamFactory = null): array
    {
        return [[], null];
    }

    public function getExtraHeaders(): array
    {
        return ['Accept' => ['application/json']];
    }

    protected function getQueryOptionsResolver(): OptionsResolver
    {
        $optionsResolver = parent::getQueryOptionsResolver();
        $optionsResolver->setDefined(['environment']);
        $optionsResolver->setRequired(['environment']);
        $optionsResolver->setDefaults([]);
        $optionsResolver->addAllowedTypes('environment', ['string']);

        return $optionsResolver;
    }

    /**
     * {@inheritdoc}
     *
     *
     * @return null|V1CompaniesCompanyIdActivationsDeleteResponse200|ErrorResponse
     *
     * @throws DeactivateCompanyByIdUnauthorizedException
     * @throws DeactivateCompanyByIdForbiddenException
     * @throws DeactivateCompanyByIdTooManyRequestsException
     * @throws DeactivateCompanyByIdInternalServerErrorException
     */
    protected function transformResponseBody(ResponseInterface $response, SerializerInterface $serializer, ?string $contentType = null)
    {
        $status = $response->getStatusCode();
        $body = (string) $response->getBody();
        if (is_null($contentType) === false && ($status === 200 && stripos(strtolower($contentType), 'application/json') !== false)) {
            return $serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdActivationsDeleteResponse200', 'json');
        }
        if (is_null($contentType) === false && ($status === 401 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new DeactivateCompanyByIdUnauthorizedException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 403 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new DeactivateCompanyByIdForbiddenException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 429 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new DeactivateCompanyByIdTooManyRequestsException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 500 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new DeactivateCompanyByIdInternalServerErrorException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
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
