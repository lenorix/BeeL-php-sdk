<?php

namespace Lenorix\BeelSdk\Generated\Endpoint;

use Lenorix\BeelSdk\Generated\Exception\GetAccountEmailDeliveryIndicatorsBadRequestException;
use Lenorix\BeelSdk\Generated\Exception\GetAccountEmailDeliveryIndicatorsForbiddenException;
use Lenorix\BeelSdk\Generated\Exception\GetAccountEmailDeliveryIndicatorsInternalServerErrorException;
use Lenorix\BeelSdk\Generated\Exception\GetAccountEmailDeliveryIndicatorsTooManyRequestsException;
use Lenorix\BeelSdk\Generated\Exception\GetAccountEmailDeliveryIndicatorsUnauthorizedException;
use Lenorix\BeelSdk\Generated\Model\EmailDeliveryIndicatorListResponse;
use Lenorix\BeelSdk\Generated\Model\ErrorResponse;
use Lenorix\BeelSdk\Generated\Runtime\Client\BaseEndpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\Endpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\EndpointTrait;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Serializer\SerializerInterface;

class GetAccountEmailDeliveryIndicators extends BaseEndpoint implements Endpoint
{
    protected $account_id;

    /**
     * Returns, for each related entity id given, how many emails the history holds for it, the
     * status of the most recent one and when it was sent. Lets you show the state of an entity's
     * email without loading its full history.
     *
     * - **`last_status`:** carries whatever the latest attempt ended in, `REJECTED` and `QUEUED`
     *   included, so a `count` above zero does not mean an email reached anyone.
     * - **Ids with no associated emails:** omitted from the response rather than returned with
     *   `count` 0.
     *
     * **Closed catalogue.** This collection is fixed and bounded by the request itself — at most
     * one indicator per id in `related_entity_ids`: it carries no `pagination`, it takes no
     * `page`/`limit`, and every response holds the whole set.
     *
     * @param  string  $accountId  Your own account, or an account you provisioned. It — not the credential — decides which account the operation acts on; a `403` is returned when you do not reach it, the same response an account that does not exist gets.
     * @param array{
     *    "related_entity_ids": array, //Comma-separated list of related entity ids (e.g. invoice ids)
     * } $queryParameters
     */
    public function __construct(string $accountId, array $queryParameters = [])
    {
        $this->account_id = $accountId;
        $this->queryParameters = $queryParameters;
    }

    use EndpointTrait;

    public function getMethod(): string
    {
        return 'GET';
    }

    public function getUri(): string
    {
        return str_replace(['{account_id}'], [rawurlencode($this->account_id)], '/v1/accounts/{account_id}/email-indicators');
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
     * @throws GetAccountEmailDeliveryIndicatorsBadRequestException
     * @throws GetAccountEmailDeliveryIndicatorsUnauthorizedException
     * @throws GetAccountEmailDeliveryIndicatorsForbiddenException
     * @throws GetAccountEmailDeliveryIndicatorsTooManyRequestsException
     * @throws GetAccountEmailDeliveryIndicatorsInternalServerErrorException
     */
    protected function transformResponseBody(ResponseInterface $response, SerializerInterface $serializer, ?string $contentType = null)
    {
        $status = $response->getStatusCode();
        $body = (string) $response->getBody();
        if (is_null($contentType) === false && ($status === 200 && stripos(strtolower($contentType), 'application/json') !== false)) {
            return $serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\EmailDeliveryIndicatorListResponse', 'json');
        }
        if (is_null($contentType) === false && ($status === 400 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new GetAccountEmailDeliveryIndicatorsBadRequestException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 401 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new GetAccountEmailDeliveryIndicatorsUnauthorizedException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 403 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new GetAccountEmailDeliveryIndicatorsForbiddenException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 429 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new GetAccountEmailDeliveryIndicatorsTooManyRequestsException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 500 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new GetAccountEmailDeliveryIndicatorsInternalServerErrorException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
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
