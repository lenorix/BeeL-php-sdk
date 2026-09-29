<?php

declare(strict_types=1);

use Lenorix\BeelSdk\Beel;
use Lenorix\BeelSdk\Generated\Model\AccountMember;
use Lenorix\BeelSdk\Generated\Model\CompanyData;
use Lenorix\BeelSdk\Generated\Model\Customer;
use Lenorix\BeelSdk\Generated\Model\EmailDeliveryResponse;
use Lenorix\BeelSdk\Generated\Model\GenerationHistoryResponse;
use Lenorix\BeelSdk\Generated\Model\InvitationSummary;
use Lenorix\BeelSdk\Generated\Model\Invoice;
use Lenorix\BeelSdk\Generated\Model\InvoiceSeries;
use Lenorix\BeelSdk\Generated\Model\ManagedAccountSummary;
use Lenorix\BeelSdk\Generated\Model\ManagedPaymentEvent;
use Lenorix\BeelSdk\Generated\Model\MemberGrant;
use Lenorix\BeelSdk\Generated\Model\Product;
use Lenorix\BeelSdk\Generated\Model\RecurringInvoiceResponse;
use Lenorix\BeelSdk\Generated\Model\RequestLogDetail;
use Lenorix\BeelSdk\Generated\Model\RequestLogSummary;
use Lenorix\BeelSdk\Generated\Model\WebhookDeliveryLog;
use Lenorix\BeelSdk\Generated\Model\WebhookSubscription;
use Lenorix\BeelSdk\Tests\Support\RecordingPsrClient;

it('iterates every page lazily, keeping filters and limit', function () {
    $transport = new RecordingPsrClient([
        invoicePage(['a', 'b'], 1, 2, hasNext: true),
        invoicePage(['c'], 2, 2, hasNext: false),
    ]);
    $invoices = testClient($transport)->company('company-1')->invoices->all(['status' => ['ISSUED'], 'limit' => 2]);

    expect($transport->requests)->toHaveCount(0);
    expect($invoices->current()->getId())->toBe('a')
        ->and($transport->requests)->toHaveCount(1);

    $ids = [];
    foreach ($invoices as $invoice) {
        $ids[] = $invoice->getId();
    }

    parse_str($transport->requests[1]->getUri()->getQuery(), $secondQuery);
    expect($ids)->toBe(['a', 'b', 'c'])
        ->and($transport->requests)->toHaveCount(2)
        ->and($secondQuery)->toMatchArray(['status' => 'ISSUED', 'limit' => '2', 'page' => '2']);
});

it('iterates every paginated list into its generated item model', function (Closure $iterate, string $itemsKey, string $itemClass, string $path) {
    $transport = new RecordingPsrClient([jsonResponse(['success' => true, 'data' => [
        $itemsKey => [['id' => 'item-1']],
        'pagination' => ['current_page' => 1, 'total_pages' => 1, 'total_items' => 1, 'items_per_page' => 20, 'has_next' => false],
    ]])]);

    $items = iterator_to_array($iterate(testClient($transport)));

    expect($items)->toHaveCount(1)
        ->and($items[0])->toBeInstanceOf($itemClass)
        ->and($transport->requests[0]->getUri()->getPath())->toBe('/api'.$path);
})->with([
    'company customers' => [fn (Beel $beel) => $beel->company('c')->customers->all(), 'customers', Customer::class, '/v1/companies/c/customers'],
    'company products' => [fn (Beel $beel) => $beel->company('c')->products->all(), 'products', Product::class, '/v1/companies/c/products'],
    'company series' => [fn (Beel $beel) => $beel->company('c')->series->all(), 'series', InvoiceSeries::class, '/v1/companies/c/series'],
    'recurring invoices' => [fn (Beel $beel) => $beel->company('c')->recurringInvoices->all(), 'recurring_invoices', RecurringInvoiceResponse::class, '/v1/companies/c/recurring-invoices'],
    'recurring invoice history' => [fn (Beel $beel) => $beel->company('c')->recurringInvoices->allHistory('r'), 'history', GenerationHistoryResponse::class, '/v1/companies/c/recurring-invoices/r/history'],
    'payment events' => [fn (Beel $beel) => $beel->company('c')->paymentConnections->events('p')->all(), 'events', ManagedPaymentEvent::class, '/v1/companies/c/payment-connections/p/events'],
    'account companies' => [fn (Beel $beel) => $beel->account('a')->companies->all(), 'companies', CompanyData::class, '/v1/accounts/a/companies'],
    'account members' => [fn (Beel $beel) => $beel->account('a')->members->all(), 'members', AccountMember::class, '/v1/accounts/a/members'],
    'member grants' => [fn (Beel $beel) => $beel->account('a')->members->allGrants('m'), 'grants', MemberGrant::class, '/v1/accounts/a/members/m/grants'],
    'account invitations' => [fn (Beel $beel) => $beel->account('a')->invitations->all(), 'invitations', InvitationSummary::class, '/v1/accounts/a/invitations'],
    'account webhooks' => [fn (Beel $beel) => $beel->account('a')->webhooks->all(), 'webhooks', WebhookSubscription::class, '/v1/accounts/a/webhooks'],
    'webhook deliveries' => [fn (Beel $beel) => $beel->account('a')->webhooks->allDeliveries('w'), 'deliveries', WebhookDeliveryLog::class, '/v1/accounts/a/webhooks/w/deliveries'],
    'account emails' => [fn (Beel $beel) => $beel->account('a')->emails->all(), 'emails', EmailDeliveryResponse::class, '/v1/accounts/a/emails'],
]);

it('falls back to page counts when has_next is absent and stops on an empty page', function () {
    $transport = new RecordingPsrClient([
        invoicePage(['a'], 3, 5),
        invoicePage([], 4, 5),
    ]);

    $ids = array_map(
        static fn (Invoice $invoice): ?string => $invoice->getId(),
        iterator_to_array(testClient($transport)->company('company-1')->invoices->all(['page' => 3])),
    );

    parse_str($transport->requests[0]->getUri()->getQuery(), $firstQuery);
    expect($ids)->toBe(['a'])
        ->and($firstQuery['page'])->toBe('3')
        ->and($transport->requests)->toHaveCount(2);
});

it('stops instead of looping when BeeL ignores the requested page', function () {
    $transport = new RecordingPsrClient([
        invoicePage(['a'], 1, 3, hasNext: true),
        invoicePage(['a'], 1, 3, hasNext: true),
    ]);

    $ids = array_map(static fn (Invoice $invoice): string => $invoice->getId(), iterator_to_array(testClient($transport)->company('c')->invoices->all()));

    expect($ids)->toBe(['a', 'a'])
        ->and($transport->requests)->toHaveCount(2);
});

it('keeps paginating when BeeL does not report the current page', function (string $key, Closure $all) {
    $transport = new RecordingPsrClient([
        jsonResponse(['success' => true, 'data' => [$key => [['id' => 'a']], 'pagination' => ['has_next' => true]]]),
        jsonResponse(['success' => true, 'data' => [$key => [['id' => 'b']], 'pagination' => ['has_next' => false]]]),
    ]);

    $ids = array_map(static fn (object $item): string => $item->getId(), iterator_to_array($all(testClient($transport))));

    expect($ids)->toBe(['a', 'b']);
})->with([
    // Pagination is required in the invoice list and optional in the other two.
    'invoices' => ['invoices', fn (Beel $beel) => $beel->company('c')->invoices->all()],
    'recurring invoices' => ['recurring_invoices', fn (Beel $beel) => $beel->company('c')->recurringInvoices->all()],
    'account webhooks' => ['webhooks', fn (Beel $beel) => $beel->account('a')->webhooks->all()],
]);

it('follows next_cursor for cursor-paginated lists', function () {
    $transport = new RecordingPsrClient([
        jsonResponse(['success' => true, 'data' => ['accounts' => [['id' => 'acc-1']], 'next_cursor' => 'cur-2']]),
        jsonResponse(['success' => true, 'data' => ['accounts' => [['id' => 'acc-2']], 'next_cursor' => null]]),
    ]);

    $accounts = iterator_to_array(testClient($transport)->accounts->all(['limit' => 1]));

    parse_str($transport->requests[1]->getUri()->getQuery(), $secondQuery);
    expect($accounts)->toHaveCount(2)
        ->and($accounts[1])->toBeInstanceOf(ManagedAccountSummary::class)
        ->and($secondQuery)->toMatchArray(['limit' => '1', 'cursor' => 'cur-2']);
});

it('lists, iterates and reads account request logs', function () {
    $transport = new RecordingPsrClient([
        jsonResponse(['success' => true, 'data' => ['request_logs' => [['request_id' => 'r1']], 'pagination' => ['next_cursor' => 'c2', 'has_next' => true, 'has_previous' => false]]]),
        jsonResponse(['success' => true, 'data' => ['request_logs' => [['request_id' => 'r2']], 'pagination' => ['next_cursor' => null, 'has_next' => false, 'has_previous' => true]]]),
        jsonResponse(['success' => true, 'data' => ['request_id' => 'r1']]),
    ]);
    $logs = testClient($transport)->account('a')->requestLogs;

    $all = iterator_to_array($logs->all(['only_errors' => true]));
    $detail = $logs->get('r1');

    parse_str($transport->requests[1]->getUri()->getQuery(), $second);
    expect($all)->toHaveCount(2)
        ->and($all[0])->toBeInstanceOf(RequestLogSummary::class)
        ->and($second)->toMatchArray(['only_errors' => 'true', 'cursor' => 'c2'])
        ->and($detail)->toBeInstanceOf(RequestLogDetail::class)
        ->and($transport->requests[2]->getUri()->getPath())->toBe('/api/v1/accounts/a/request-logs/r1');
});

it('ends iteration when a page leaves out its optional list or pagination', function () {
    $transport = new RecordingPsrClient([
        jsonResponse(['success' => true, 'data' => []]),
        jsonResponse(['success' => true, 'data' => []]),
        jsonResponse(['success' => true, 'data' => ['request_logs' => []]]),
    ]);
    $account = testClient($transport)->account('a');

    expect(iterator_to_array($account->webhooks->all()))->toBe([])
        ->and(iterator_to_array($account->webhooks->allDeliveries('wh-1')))->toBe([])
        ->and(iterator_to_array($account->requestLogs->all()))->toBe([])
        ->and($transport->requests)->toHaveCount(3);
});

it('keeps paginating by page numbers when BeeL sends a null has_next', function () {
    $transport = new RecordingPsrClient([
        jsonResponse(['success' => true, 'data' => ['customers' => [['id' => 'a']], 'pagination' => ['current_page' => 1, 'total_pages' => 2, 'total_items' => 2, 'items_per_page' => 1, 'has_next' => null]]]),
        jsonResponse(['success' => true, 'data' => ['customers' => [['id' => 'b']], 'pagination' => ['current_page' => 2, 'total_pages' => 2, 'total_items' => 2, 'items_per_page' => 1, 'has_next' => null]]]),
    ]);

    $ids = array_map(static fn (object $customer): string => $customer->getId(), iterator_to_array(testClient($transport)->company('c')->customers->all()));

    expect($ids)->toBe(['a', 'b']);
});

it('stops following cursors that cycle back to a page already read', function () {
    $transport = new RecordingPsrClient([
        jsonResponse(['success' => true, 'data' => ['accounts' => [['account_id' => 'a']], 'next_cursor' => 'A']]),
        jsonResponse(['success' => true, 'data' => ['accounts' => [['account_id' => 'b']], 'next_cursor' => 'B']]),
        jsonResponse(['success' => true, 'data' => ['accounts' => [['account_id' => 'c']], 'next_cursor' => 'A']]),
    ]);

    $ids = array_map(static fn (object $account): string => $account->getAccountId(), iterator_to_array(testClient($transport)->accounts->all(), false));

    expect($ids)->toBe(['a', 'b', 'c'])
        ->and($transport->requests)->toHaveCount(3);
});
