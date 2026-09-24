<?php

namespace Lenorix\BeelSdk\Generated\Endpoint;

class GetEmailDeliveryIndicators extends \Lenorix\BeelSdk\Generated\Runtime\Client\BaseEndpoint implements \Lenorix\BeelSdk\Generated\Runtime\Client\Endpoint
{
    /**
     * Returns, for each related entity id given, how many emails the history holds for it, the
     * status of the most recent one and when it was sent. Lets you show the state of an entity's
     * email without loading its full history.
     *
     * - **`last_status`:** carries whatever the latest attempt ended in, `REJECTED` and `QUEUED`
     *   included, so a `count` above zero does not mean an email reached anyone.
     * - **Ids with no associated emails:** omitted from the response rather than returned with
     *   `count` 0.
     * - **Deprecated:** use `GET /v1/accounts/{account_id}/email-indicators`, which behaves
     *   identically.  The successor is a sibling of the email collection, not `…/emails/indicators`:
     *   `indicators` used to sit where an email id goes.
     *
     * **Retires on 9 December 2026.** See the [migration guide](https://docs.beel.es/changelog/resources-under-the-nif) for what moved where and what changes when you switch.
     *
     * @param array{
     *    "related_entity_ids": array, //Comma-separated list of related entity ids (e.g. invoice ids)
     * } $queryParameters
     */
    public function __construct(array $queryParameters = [])
    {
        $this->queryParameters = $queryParameters;
    }
    use \Lenorix\BeelSdk\Generated\Runtime\Client\EndpointTrait;
    public function getMethod(): string
    {
        return 'GET';
    }
    public function getUri(): string
    {
        return '/v1/emails/indicators';
    }
    public function getBody(\Symfony\Component\Serializer\SerializerInterface $serializer, $streamFactory = null): array
    {
        return [[], null];
    }
    public function getExtraHeaders(): array
    {
        return ['Accept' => ['application/json']];
    }
    protected function getQueryOptionsResolver(): \Symfony\Component\OptionsResolver\OptionsResolver
    {
        $optionsResolver = parent::getQueryOptionsResolver();
        $optionsResolver->setDefined(['related_entity_ids']);
        $optionsResolver->setRequired(['related_entity_ids']);
        $optionsResolver->setDefaults([]);
        $optionsResolver->addAllowedTypes('related_entity_ids', ['array']);
        return $optionsResolver;
    }
    protected function getQueryStyles(): array
    {
        return ['related_entity_ids' => ['style' => 'form', 'explode' => false]];
    }
    /**
     * {@inheritdoc}
     *
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetEmailDeliveryIndicatorsBadRequestException
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetEmailDeliveryIndicatorsUnauthorizedException
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetEmailDeliveryIndicatorsForbiddenException
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetEmailDeliveryIndicatorsInternalServerErrorException
     *
     * @return null|\Lenorix\BeelSdk\Generated\Model\EmailDeliveryIndicatorListResponse|\Lenorix\BeelSdk\Generated\Model\ErrorResponse
     */
    protected function transformResponseBody(\Psr\Http\Message\ResponseInterface $response, \Symfony\Component\Serializer\SerializerInterface $serializer, ?string $contentType = null)
    {
        $status = $response->getStatusCode();
        $body = (string) $response->getBody();
        if (is_null($contentType) === false && (200 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            return $serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\EmailDeliveryIndicatorListResponse', 'json');
        }
        if (is_null($contentType) === false && (400 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\GetEmailDeliveryIndicatorsBadRequestException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && (401 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\GetEmailDeliveryIndicatorsUnauthorizedException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && (403 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\GetEmailDeliveryIndicatorsForbiddenException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && (500 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\GetEmailDeliveryIndicatorsInternalServerErrorException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
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