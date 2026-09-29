<?php

declare(strict_types=1);

use Lenorix\BeelSdk\Beel;
use Lenorix\BeelSdk\Builder\InvoiceBuilder;
use Lenorix\BeelSdk\Http\QueryParameters;
use Lenorix\BeelSdk\Tests\Support\RecordingPsrClient;

it('sends boolean query parameters as true and false', function () {
    $transport = new RecordingPsrClient([
        jsonResponse(['success' => true, 'data' => ['id' => 'inv-1']], 201),
        jsonResponse(['success' => true, 'data' => ['events' => [], 'pagination' => ['current_page' => 1, 'total_pages' => 1, 'total_items' => 0, 'items_per_page' => 20]]]),
    ]);
    $company = testClient($transport)->company('c');

    $company->invoices->create(InvoiceBuilder::create()->forCustomer('customer-1')->addLine('Consulting', 1, 100)->build(), ['wait_for_pdf' => true]);
    $company->paymentConnections->events('p')->list(['needs_action' => false, 'page' => 1]);

    expect($transport->requests[0]->getUri()->getQuery())->toBe('wait_for_pdf=true')
        ->and($transport->requests[1]->getUri()->getQuery())->toContain('needs_action=false')
        ->and($transport->requests[1]->getUri()->getQuery())->toContain('page=1');
});

it('lists every boolean and list query parameter of the generated endpoints', function () {
    $booleans = [];
    $lists = [];
    foreach (glob(__DIR__.'/../../src/Generated/Endpoint/*.php') ?: [] as $file) {
        if (preg_match('/function getQueryOptionsResolver\(\).*?\n    \}\n/s', sourceCode($file), $resolver) !== 1) {
            continue;
        }
        preg_match_all("/addAllowedTypes\\('([a-z_]+)', \\['bool'\\]\\)/", $resolver[0], $matches);
        array_push($booleans, ...$matches[1]);
        preg_match_all("/addAllowedTypes\\('([a-z_]+)', \\['array'\\]\\)/", $resolver[0], $matches);
        array_push($lists, ...$matches[1]);
    }
    $booleans = array_values(array_unique($booleans));
    $lists = array_values(array_diff(array_unique($lists), ['metadata']));
    sort($booleans);
    sort($lists);

    $otherTypes = [];
    foreach (glob(__DIR__.'/../../src/Generated/Endpoint/*.php') ?: [] as $file) {
        if (preg_match('/function getQueryOptionsResolver\\(\\).*?\\n    \\}\\n/s', sourceCode($file), $resolver) !== 1) {
            continue;
        }
        foreach (QueryParameters::BOOLEANS as $name) {
            // The rewrite is keyed by name, so a same-named int or string parameter would be corrupted.
            if (preg_match("/addAllowedTypes\\('".$name."', \\['(?!bool')/", $resolver[0]) === 1) {
                $otherTypes[] = basename($file).': '.$name;
            }
        }
    }

    expect(QueryParameters::BOOLEANS)->toBe($booleans)
        ->and(QueryParameters::LISTS)->toBe($lists)
        ->and($otherTypes)->toBe([]);
});

it('filters invoices by a single payment method', function () {
    $transport = new RecordingPsrClient([invoicePage([], 1, 1, hasNext: false)]);

    testClient($transport)->company('c')->invoices->list(['payment_method' => 'CARD']);

    parse_str($transport->requests[0]->getUri()->getQuery(), $query);
    expect($query['payment_method'])->toBe('CARD');
});

it('sends a list of IDs to bulk deletes as the comma-separated value BeeL expects', function (string $resource) {
    $transport = new RecordingPsrClient([
        jsonResponse(['success' => true, 'data' => ['deleted' => 2]]),
        jsonResponse(['success' => true, 'data' => ['deleted' => 2]]),
    ]);
    $company = testClient($transport)->company('c');

    $company->{$resource}->deleteBulk(['ids' => ['id-1', 'id-2']]);
    $company->{$resource}->deleteBulk(['ids' => 'id-1,id-2']);

    expect(rawurldecode($transport->requests[0]->getUri()->getQuery()))->toBe('ids=id-1,id-2')
        ->and(rawurldecode($transport->requests[1]->getUri()->getQuery()))->toBe('ids=id-1,id-2');
})->with(['customers', 'products']);

it('accepts whole and decimal numbers in numeric list filters', function (Closure $list, array $query, string $expected) {
    $transport = new RecordingPsrClient([jsonResponse(['success' => true, 'data' => []])]);

    $list(testClient($transport), $query);

    expect(rawurldecode($transport->requests[0]->getUri()->getQuery()))->toContain($expected);
})->with([
    'invoice total' => [fn (Beel $beel, array $query) => $beel->company('c')->invoices->list($query), ['total_min' => 100], 'total_min=100'],
    'product price' => [fn (Beel $beel, array $query) => $beel->company('c')->products->list($query), ['min_price' => 9.99], 'min_price=9.99'],
    'payment amount' => [fn (Beel $beel, array $query) => $beel->company('c')->paymentConnections->events('conn-1')->list($query), ['min_amount' => 12.5], 'min_amount=12.5'],
]);

it('lists every numeric query filter of the contract as a number', function () {
    $numbers = [];
    foreach (openApiContract()['paths'] as $operations) {
        foreach ($operations as $operation) {
            foreach (is_array($operation) ? $operation['parameters'] ?? [] : [] as $parameter) {
                if (($parameter['in'] ?? null) === 'query' && ($parameter['schema']['type'] ?? null) === 'number') {
                    $numbers[] = $parameter['name'];
                }
            }
        }
    }
    $numbers = array_values(array_unique($numbers));
    sort($numbers);

    expect(QueryParameters::NUMBERS)->toBe($numbers);
});

it('accepts whole numbers in the legacy invoice list filters', function () {
    $transport = new RecordingPsrClient([jsonResponse(['success' => true, 'data' => []])]);

    testClient($transport)->invoices->list(['total_min' => 100]);

    expect(rawurldecode($transport->requests[0]->getUri()->getQuery()))->toContain('total_min=100');
});

it('accepts a single value for list filters such as status', function () {
    $transport = new RecordingPsrClient([
        invoicePage([], 1, 1, hasNext: false),
        invoicePage([], 1, 1, hasNext: false),
    ]);
    $invoices = testClient($transport)->company('c')->invoices;

    $invoices->list(['status' => 'ISSUED']);
    $invoices->list(['status' => ['DRAFT', 'ISSUED']]);

    parse_str($transport->requests[0]->getUri()->getQuery(), $single);
    parse_str($transport->requests[1]->getUri()->getQuery(), $several);

    expect($single['status'])->toBe('ISSUED')
        ->and($single['fiscal_only'])->toBe('false')
        ->and($several['status'])->toBe('DRAFT,ISSUED');
});
