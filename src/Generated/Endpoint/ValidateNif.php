<?php

namespace Lenorix\BeelSdk\Generated\Endpoint;

class ValidateNif extends \Lenorix\BeelSdk\Generated\Runtime\Client\BaseEndpoint implements \Lenorix\BeelSdk\Generated\Runtime\Client\Endpoint
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
     *
     * @param \Lenorix\BeelSdk\Generated\Model\ValidateNifRequest $requestBody
     */
    public function __construct(\Lenorix\BeelSdk\Generated\Model\ValidateNifRequest $requestBody)
    {
        $this->body = $requestBody;
    }
    use \Lenorix\BeelSdk\Generated\Runtime\Client\EndpointTrait;
    public function getMethod(): string
    {
        return 'POST';
    }
    public function getUri(): string
    {
        return '/v1/nif/validate';
    }
    public function getBody(\Symfony\Component\Serializer\SerializerInterface $serializer, $streamFactory = null): array
    {
        if ($this->body instanceof \Lenorix\BeelSdk\Generated\Model\ValidateNifRequest) {
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
     * @throws \Lenorix\BeelSdk\Generated\Exception\ValidateNifBadRequestException
     * @throws \Lenorix\BeelSdk\Generated\Exception\ValidateNifUnauthorizedException
     * @throws \Lenorix\BeelSdk\Generated\Exception\ValidateNifForbiddenException
     * @throws \Lenorix\BeelSdk\Generated\Exception\ValidateNifUnprocessableEntityException
     * @throws \Lenorix\BeelSdk\Generated\Exception\ValidateNifTooManyRequestsException
     * @throws \Lenorix\BeelSdk\Generated\Exception\ValidateNifInternalServerErrorException
     *
     * @return null|\Lenorix\BeelSdk\Generated\Model\V1NifValidatePostResponse200|\Lenorix\BeelSdk\Generated\Model\ErrorResponse
     */
    protected function transformResponseBody(\Psr\Http\Message\ResponseInterface $response, \Symfony\Component\Serializer\SerializerInterface $serializer, ?string $contentType = null)
    {
        $status = $response->getStatusCode();
        $body = (string) $response->getBody();
        if (is_null($contentType) === false && (200 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            return $serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\V1NifValidatePostResponse200', 'json');
        }
        if (is_null($contentType) === false && (400 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\ValidateNifBadRequestException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && (401 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\ValidateNifUnauthorizedException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && (403 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\ValidateNifForbiddenException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && (422 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\ValidateNifUnprocessableEntityException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && (429 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\ValidateNifTooManyRequestsException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && (500 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\ValidateNifInternalServerErrorException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
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