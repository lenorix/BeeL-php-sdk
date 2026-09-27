<?php

namespace Lenorix\BeelSdk\Generated\Endpoint;

use Lenorix\BeelSdk\Generated\Exception\GetEmailDeliveryIndicatorsBadRequestException;
use Lenorix\BeelSdk\Generated\Exception\GetEmailDeliveryIndicatorsForbiddenException;
use Lenorix\BeelSdk\Generated\Exception\GetEmailDeliveryIndicatorsInternalServerErrorException;
use Lenorix\BeelSdk\Generated\Exception\GetEmailDeliveryIndicatorsUnauthorizedException;
use Lenorix\BeelSdk\Generated\Model\EmailDeliveryIndicatorListResponse;
use Lenorix\BeelSdk\Generated\Model\ErrorResponse;
use Lenorix\BeelSdk\Generated\Runtime\Client\BaseEndpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\Endpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\EndpointTrait;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Serializer\SerializerInterface;

class GetEmailDeliveryIndicators extends BaseEndpoint implements Endpoint
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

    use EndpointTrait;

    public function getMethod(): string
    {
        return 'GET';
    }

    public function getUri(): string
    {
        return '/v1/emails/indicators';
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
     *
     * @return null|EmailDeliveryIndicatorListResponse|ErrorResponse
     *
     * @throws GetEmailDeliveryIndicatorsBadRequestException
     * @throws GetEmailDeliveryIndicatorsUnauthorizedException
     * @throws GetEmailDeliveryIndicatorsForbiddenException
     * @throws GetEmailDeliveryIndicatorsInternalServerErrorException
     */
    protected function transformResponseBody(ResponseInterface $response, SerializerInterface $serializer, ?string $contentType = null)
    {
        $status = $response->getStatusCode();
        $body = (string) $response->getBody();
        if (is_null($contentType) === false && ($status === 200 && stripos(strtolower($contentType), 'application/json') !== false)) {
            return $serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\EmailDeliveryIndicatorListResponse', 'json');
        }
        if (is_null($contentType) === false && ($status === 400 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new GetEmailDeliveryIndicatorsBadRequestException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 401 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new GetEmailDeliveryIndicatorsUnauthorizedException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 403 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new GetEmailDeliveryIndicatorsForbiddenException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 500 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new GetEmailDeliveryIndicatorsInternalServerErrorException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
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
