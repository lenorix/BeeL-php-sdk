<?php

declare(strict_types=1);

namespace Lenorix\BeelSdk\Resource\Company;

use Lenorix\BeelSdk\Enum\Environment;
use Lenorix\BeelSdk\Exception\BeelPaymentRequiredError;
use Lenorix\BeelSdk\Generated\Client;
use Lenorix\BeelSdk\Generated\Model\ActivateCompanyRequest;
use Lenorix\BeelSdk\Generated\Model\CompanyActivation;
use Lenorix\BeelSdk\Generated\Model\CompanyDeactivation;
use Lenorix\BeelSdk\Http\ResponseContext;
use Lenorix\BeelSdk\Resource\GeneratedResource;

/** Switch a company on or off in Test or Live. */
final readonly class CompanyActivationsResource extends GeneratedResource
{
    public function __construct(Client $client, private string $companyId, ?ResponseContext $responseContext = null)
    {
        parent::__construct($client, $responseContext);
    }

    /**
     * Switch the company on in the given environment.
     *
     * `TEST` is immediate and free. `PROD` is immediate when the account already has a card on
     * file or an enterprise contract; otherwise BeeL answers `402 CHECKOUT_REQUIRED`, and the
     * {@see BeelPaymentRequiredError} carries a `checkoutUrl` when both return URLs are given.
     * Repeating the call is safe.
     *
     * @param  Environment|string  $environment  `TEST` or `PROD`.
     * @param  string|null  $successUrl  Where Stripe returns after the card is captured; may embed `{CHECKOUT_SESSION_ID}`.
     * @param  string|null  $cancelUrl  Where Stripe returns if the checkout is abandoned.
     * @param  array<string, mixed>  $headers  Request headers, including optional `Idempotency-Key`.
     *
     * @throws BeelPaymentRequiredError If Live needs a card on file or billing is past due.
     *
     * @see https://docs.beel.es/companies/activateCompanyById
     */
    public function activate(Environment|string $environment, ?string $successUrl = null, ?string $cancelUrl = null, array $headers = []): CompanyActivation
    {
        $request = (new ActivateCompanyRequest)->setEnvironment($environment instanceof Environment ? $environment->value : $environment);
        if ($successUrl !== null) {
            $request->setSuccessUrl($successUrl);
        }
        if ($cancelUrl !== null) {
            $request->setCancelUrl($cancelUrl);
        }

        return $this->execute(fn () => $this->client->activateCompanyById($this->companyId, $request, $headers));
    }

    /**
     * Switch the company off in the given environment; the other one is untouched.
     *
     * In Live the switch-off is scheduled for the end of the billing cycle and the response
     * carries `effective_at`; the NIF keeps invoicing until then.
     *
     * @param  Environment|string  $environment  `TEST` or `PROD`.
     *
     * @see https://docs.beel.es/companies/deactivateCompanyById
     */
    public function deactivate(Environment|string $environment): CompanyDeactivation
    {
        $environment = $environment instanceof Environment ? $environment->value : $environment;

        return $this->execute(fn () => $this->client->deactivateCompanyById($this->companyId, ['environment' => $environment]));
    }
}
