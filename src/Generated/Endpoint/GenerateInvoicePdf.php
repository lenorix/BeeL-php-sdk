<?php

namespace Lenorix\BeelSdk\Generated\Endpoint;

use Lenorix\BeelSdk\Generated\Exception\GenerateInvoicePdfBadRequestException;
use Lenorix\BeelSdk\Generated\Exception\GenerateInvoicePdfForbiddenException;
use Lenorix\BeelSdk\Generated\Exception\GenerateInvoicePdfInternalServerErrorException;
use Lenorix\BeelSdk\Generated\Exception\GenerateInvoicePdfNotFoundException;
use Lenorix\BeelSdk\Generated\Exception\GenerateInvoicePdfTooManyRequestsException;
use Lenorix\BeelSdk\Generated\Exception\GenerateInvoicePdfUnauthorizedException;
use Lenorix\BeelSdk\Generated\Model\ErrorResponse;
use Lenorix\BeelSdk\Generated\Model\InvoicePdfResponse;
use Lenorix\BeelSdk\Generated\Runtime\Client\BaseEndpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\Endpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\EndpointTrait;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Serializer\SerializerInterface;

class GenerateInvoicePdf extends BaseEndpoint implements Endpoint
{
    protected $invoice_id;

    /**
     * Returns a temporary pre-signed URL to download the invoice PDF.
     *
     * - **Deprecated:** use `GET /v1/companies/{company_id}/invoices/{invoice_id}/pdf`, which
     *   behaves identically.
     * - **URL:** it expires in five minutes and only allows `GET`.
     * - **Waiting:** a PDF is produced asynchronously, so this request **waits** for it (up to
     *   ten seconds) instead of handing you a polling loop to write. Bound the wait with
     *   `Prefer: wait=N`, or opt out with `Prefer: wait=0`.
     *
     * **Retires on 9 December 2026.** See the [migration guide](https://docs.beel.es/changelog/resources-under-the-nif) for what moved where and what changes when you switch.
     *
     * @param  string  $invoiceId  Invoice ID
     * @param array{
     *    "Prefer"?: string, //RFC 7240 preference bounding how long this request may wait for a PDF that is still
    being generated: `Prefer: wait=N`, with `N` in seconds.

    By default the request waits (up to the server cap) and answers `200` with the URL, so
    the `202` is the exception rather than the normal path. Use `Prefer: wait=0` to opt out
    and get the old poll-only behaviour: an immediate `202` while the PDF is in flight.

    A value above the cap is lowered to it, and the `202` then echoes what was actually
    applied in `Preference-Applied: wait=<seconds>` — so you never have to discover the cap
    by trial and error. A value that is not a non-negative integer is ignored altogether
    (RFC 7240: a preference that is not understood is not an error), and the request falls
    back to the default wait with no `Preference-Applied` header.
     * } $headerParameters
     */
    public function __construct(string $invoiceId, array $headerParameters = [])
    {
        $this->invoice_id = $invoiceId;
        $this->headerParameters = $headerParameters;
    }

    use EndpointTrait;

    public function getMethod(): string
    {
        return 'GET';
    }

    public function getUri(): string
    {
        return str_replace(['{invoice_id}'], [rawurlencode($this->invoice_id)], '/v1/invoices/{invoice_id}/pdf');
    }

    public function getBody(SerializerInterface $serializer, $streamFactory = null): array
    {
        return [[], null];
    }

    public function getExtraHeaders(): array
    {
        return ['Accept' => ['application/json']];
    }

    protected function getHeadersOptionsResolver(): OptionsResolver
    {
        $optionsResolver = parent::getHeadersOptionsResolver();
        $optionsResolver->setDefined(['Prefer']);
        $optionsResolver->setRequired([]);
        $optionsResolver->setDefaults([]);
        $optionsResolver->addAllowedTypes('Prefer', ['string']);

        return $optionsResolver;
    }

    /**
     * {@inheritdoc}
     *
     *
     * @return null|InvoicePdfResponse|ErrorResponse
     *
     * @throws GenerateInvoicePdfBadRequestException
     * @throws GenerateInvoicePdfUnauthorizedException
     * @throws GenerateInvoicePdfForbiddenException
     * @throws GenerateInvoicePdfNotFoundException
     * @throws GenerateInvoicePdfTooManyRequestsException
     * @throws GenerateInvoicePdfInternalServerErrorException
     */
    protected function transformResponseBody(ResponseInterface $response, SerializerInterface $serializer, ?string $contentType = null)
    {
        $status = $response->getStatusCode();
        $body = (string) $response->getBody();
        if (is_null($contentType) === false && ($status === 200 && stripos(strtolower($contentType), 'application/json') !== false)) {
            return $serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\InvoicePdfResponse', 'json');
        }
        if ($status === 202) {
            return null;
        }
        if (is_null($contentType) === false && ($status === 400 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new GenerateInvoicePdfBadRequestException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 401 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new GenerateInvoicePdfUnauthorizedException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 403 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new GenerateInvoicePdfForbiddenException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 404 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new GenerateInvoicePdfNotFoundException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 429 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new GenerateInvoicePdfTooManyRequestsException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 500 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new GenerateInvoicePdfInternalServerErrorException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
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
