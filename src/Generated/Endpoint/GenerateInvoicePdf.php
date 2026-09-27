<?php

namespace Lenorix\BeelSdk\Generated\Endpoint;

class GenerateInvoicePdf extends \Lenorix\BeelSdk\Generated\Runtime\Client\BaseEndpoint implements \Lenorix\BeelSdk\Generated\Runtime\Client\Endpoint
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
    * @param string $invoiceId Invoice ID
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
    use \Lenorix\BeelSdk\Generated\Runtime\Client\EndpointTrait;
    public function getMethod(): string
    {
        return 'GET';
    }
    public function getUri(): string
    {
        return str_replace(['{invoice_id}'], [rawurlencode($this->invoice_id)], '/v1/invoices/{invoice_id}/pdf');
    }
    public function getBody(\Symfony\Component\Serializer\SerializerInterface $serializer, $streamFactory = null): array
    {
        return [[], null];
    }
    public function getExtraHeaders(): array
    {
        return ['Accept' => ['application/json']];
    }
    protected function getHeadersOptionsResolver(): \Symfony\Component\OptionsResolver\OptionsResolver
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
     * @throws \Lenorix\BeelSdk\Generated\Exception\GenerateInvoicePdfBadRequestException
     * @throws \Lenorix\BeelSdk\Generated\Exception\GenerateInvoicePdfUnauthorizedException
     * @throws \Lenorix\BeelSdk\Generated\Exception\GenerateInvoicePdfForbiddenException
     * @throws \Lenorix\BeelSdk\Generated\Exception\GenerateInvoicePdfNotFoundException
     * @throws \Lenorix\BeelSdk\Generated\Exception\GenerateInvoicePdfTooManyRequestsException
     * @throws \Lenorix\BeelSdk\Generated\Exception\GenerateInvoicePdfInternalServerErrorException
     *
     * @return null|\Lenorix\BeelSdk\Generated\Model\InvoicePdfResponse|\Lenorix\BeelSdk\Generated\Model\ErrorResponse
     */
    protected function transformResponseBody(\Psr\Http\Message\ResponseInterface $response, \Symfony\Component\Serializer\SerializerInterface $serializer, ?string $contentType = null)
    {
        $status = $response->getStatusCode();
        $body = (string) $response->getBody();
        if (is_null($contentType) === false && (200 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            return $serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\InvoicePdfResponse', 'json');
        }
        if (202 === $status) {
            return null;
        }
        if (is_null($contentType) === false && (400 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\GenerateInvoicePdfBadRequestException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && (401 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\GenerateInvoicePdfUnauthorizedException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && (403 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\GenerateInvoicePdfForbiddenException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && (404 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\GenerateInvoicePdfNotFoundException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && (429 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\GenerateInvoicePdfTooManyRequestsException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && (500 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\GenerateInvoicePdfInternalServerErrorException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
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