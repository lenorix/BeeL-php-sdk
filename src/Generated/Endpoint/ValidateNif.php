<?php

namespace Lenorix\BeelSdk\Generated\Endpoint;

use Lenorix\BeelSdk\Generated\Exception\ValidateNifBadRequestException;
use Lenorix\BeelSdk\Generated\Exception\ValidateNifForbiddenException;
use Lenorix\BeelSdk\Generated\Exception\ValidateNifInternalServerErrorException;
use Lenorix\BeelSdk\Generated\Exception\ValidateNifTooManyRequestsException;
use Lenorix\BeelSdk\Generated\Exception\ValidateNifUnauthorizedException;
use Lenorix\BeelSdk\Generated\Exception\ValidateNifUnprocessableEntityException;
use Lenorix\BeelSdk\Generated\Model\ErrorResponse;
use Lenorix\BeelSdk\Generated\Model\V1NifValidatePostResponse200;
use Lenorix\BeelSdk\Generated\Model\ValidateNifRequest;
use Lenorix\BeelSdk\Generated\Runtime\Client\BaseEndpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\Endpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\EndpointTrait;
use Lenorix\BeelSdk\Generated\Runtime\Client\JsonPayload;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\Serializer\SerializerInterface;

class ValidateNif extends BaseEndpoint implements Endpoint
{
    /**
     * Checks a NIF or CIF against the AEAT register through VeriFactu and returns what the
     * register says about it. It only reads the register: it creates nothing and stores no
     * customer.
     *
     * - **`status`:** distinguishes a NIF found in the register from one that is syntactically
     *   correct but absent, and from a check that could not be completed because VeriFactu was
     *   unavailable — in which case the NIF is validated automatically once the service is back.
     * - **`valid: true`:** means different things by holder. For an individual, AEAT matched NIF
     *   and name together. For a legal entity the name you sent is **not verified** at all —
     *   AEAT identifies a company by its CIF alone — so it says nothing about your name.
     * - **`legal_name_verified`:** tells those two cases apart.
     * - **`census_status`:** says whether an identified NIF is also deregistered or revoked.
     *
     * ## Invalid input
     *
     * - **Bad syntax is an answer, not an error:** it comes back `200` with `status: INVALID`, so
     *   a pre-validation flow never has to tell rejections apart by status code.
     * - **A missing NIF is an error:** an absent or empty `nif` answers `422` `FIELD_BLANK`, with
     *   `details.field` naming it.
     */
    public function __construct(ValidateNifRequest $requestBody)
    {
        $this->body = $requestBody;
    }

    use EndpointTrait;

    public function getMethod(): string
    {
        return 'POST';
    }

    public function getUri(): string
    {
        return '/v1/nif/validate';
    }

    public function getBody(SerializerInterface $serializer, $streamFactory = null): array
    {
        if ($this->body instanceof ValidateNifRequest) {
            return [['Content-Type' => ['application/json']], JsonPayload::encode($serializer, $this->body)];
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
     *
     * @return null|V1NifValidatePostResponse200|ErrorResponse
     *
     * @throws ValidateNifBadRequestException
     * @throws ValidateNifUnauthorizedException
     * @throws ValidateNifForbiddenException
     * @throws ValidateNifUnprocessableEntityException
     * @throws ValidateNifTooManyRequestsException
     * @throws ValidateNifInternalServerErrorException
     */
    protected function transformResponseBody(ResponseInterface $response, SerializerInterface $serializer, ?string $contentType = null)
    {
        $status = $response->getStatusCode();
        $body = (string) $response->getBody();
        if (is_null($contentType) === false && ($status === 200 && stripos(strtolower($contentType), 'application/json') !== false)) {
            return $serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\V1NifValidatePostResponse200', 'json');
        }
        if (is_null($contentType) === false && ($status === 400 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new ValidateNifBadRequestException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 401 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new ValidateNifUnauthorizedException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 403 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new ValidateNifForbiddenException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 422 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new ValidateNifUnprocessableEntityException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 429 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new ValidateNifTooManyRequestsException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 500 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new ValidateNifInternalServerErrorException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
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
