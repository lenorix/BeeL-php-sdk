<?php

declare(strict_types=1);

use Lenorix\BeelSdk\Generated\Model\CreateInvoiceRequest;
use Lenorix\BeelSdk\Http\RequestModels;
use Lenorix\BeelSdk\Tests\Support\RecordingPsrClient;

it('accepts an array in API format wherever a request model is expected', function () {
    $missing = [];
    foreach (glob(__DIR__.'/../../src/Resource/{,*/}*.php', GLOB_BRACE) ?: [] as $file) {
        $class = 'Lenorix\\BeelSdk\\Resource\\'.str_replace(['/', '.php'], ['\\', ''], substr($file, strlen(__DIR__.'/../../src/Resource/')));
        if (! class_exists($class)) {
            continue;
        }
        foreach ((new ReflectionClass($class))->getMethods(ReflectionMethod::IS_PUBLIC) as $method) {
            foreach ($method->getParameters() as $parameter) {
                $type = $parameter->getType();
                $names = $type instanceof ReflectionUnionType
                    ? array_map(static fn ($part): string => (string) $part, $type->getTypes())
                    : [$type instanceof ReflectionNamedType ? $type->getName() : ''];
                $models = array_filter($names, static fn (string $name): bool => str_starts_with($name, 'Lenorix\\BeelSdk\\Generated\\Model\\')
                    && (str_ends_with($name, 'Request') || str_ends_with($name, 'Body')));
                if ($models !== [] && ! in_array('array', $names, true)) {
                    $missing[] = $class.'::'.$method->getName().'($'.$parameter->getName().')';
                }
            }
        }
    }

    expect($missing)->toBe([]);
});

it('sends an array request with the same fields a model would send', function () {
    $invoice = [
        'type' => 'STANDARD',
        'recipient' => ['customer_id' => 'customer-1'],
        'lines' => [[
            'line_type' => 'NORMAL',
            'description' => 'Consulting',
            'quantity' => 2,
            'unit_price' => 100.5,
            'discount_percentage' => 0,
            'main_tax' => ['type' => 'IVA', 'percentage' => 21, 'regime_key' => '01'],
        ]],
        'metadata' => ['order_id' => 'A-1', 'created_at' => '2026-09-25T12:00:00.123Z'],
    ];
    $transport = new RecordingPsrClient([
        jsonResponse(['success' => true, 'data' => ['id' => 'inv-1']], 201),
        jsonResponse(['success' => true, 'data' => ['id' => 'inv-1']]),
        jsonResponse(['success' => true, 'data' => ['id' => 'inv-1']]),
    ]);
    $invoices = testClient($transport)->company('c')->invoices;

    $invoices->create($invoice);
    $invoices->void('inv-1', ['reason' => 'Billing error']);
    $invoices->schedule->set('inv-1', ['scheduled_for' => '2026-12-01', 'generation_mode' => 'DRAFT']);

    $sent = json_decode((string) $transport->requests[0]->getBody(), true);

    // Jane orders keys by schema and sends numbers as floats, exactly as it does for a hand-built model.
    expect($sent)->toEqual($invoice)
        ->and($sent['metadata'])->toBe($invoice['metadata'])
        ->and(json_decode((string) $transport->requests[1]->getBody(), true))->toBe(['reason' => 'Billing error'])
        ->and(json_decode((string) $transport->requests[2]->getBody(), true))->toBe(['scheduled_for' => '2026-12-01', 'generation_mode' => 'DRAFT']);
});

it('rejects arrays or objects that do not match the request model', function () {
    $invoices = testClient(new RecordingPsrClient([]))->company('c')->invoices;

    expect(fn () => $invoices->schedule->set('inv-1', ['scheduled_for' => 'tomorrow']))->toThrow(InvalidArgumentException::class, 'SetInvoiceScheduleRequest')
        ->and(fn () => RequestModels::from(new stdClass, CreateInvoiceRequest::class))->toThrow(InvalidArgumentException::class)
        ->and(fn () => $invoices->create(['type' => 'STANDARD', 'lines' => []]))->toThrow(InvalidArgumentException::class, 'missing the required field "recipient"');
});

it('uploads the signed representation from an array', function () {
    $transport = new RecordingPsrClient([jsonResponse(['success' => true, 'data' => ['status' => 'VALIDATING', 'message' => 'ok']])]);

    testClient($transport)->company('c')->representation->submit(['file' => '%PDF-array']);

    expect((string) $transport->requests[0]->getBody())->toContain('%PDF-array');
});

it('imports managed accounts from an array', function () {
    $transport = new RecordingPsrClient([
        jsonResponse(['success' => true, 'data' => ['metadata' => []]]),
        jsonResponse(['success' => true, 'data' => ['metadata' => []]], 201),
    ]);
    $accounts = testClient($transport)->accounts;

    $accounts->previewImport(['accounts_file' => "external_ref,nif\nclient-1,B1\n"]);
    $accounts->import(['accounts_file' => "external_ref,nif\nclient-1,B1\n"], ['Idempotency-Key' => 'import-1']);

    expect($transport->requests[0]->getUri()->getPath())->toBe('/api/v1/accounts/imports/preview')
        ->and((string) $transport->requests[0]->getBody())->toContain('client-1,B1')
        ->and($transport->requests[1]->getHeaderLine('Idempotency-Key'))->toBe('import-1');
});
