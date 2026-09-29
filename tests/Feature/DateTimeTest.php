<?php

declare(strict_types=1);

use Lenorix\BeelSdk\Builder\InvoiceBuilder;
use Lenorix\BeelSdk\Generated\Model\V1InvoicesInvoiceIdMarkSentPostBody;
use Lenorix\BeelSdk\Generated\Runtime\Normalizer\InvalidDateException;
use Lenorix\BeelSdk\Tests\Support\RecordingPsrClient;

it('keeps the microseconds of API date-times, the most PHP DateTime can hold', function () {
    $transport = new RecordingPsrClient([jsonResponse(['success' => true, 'data' => [
        'id' => 'inv-1',
        'created_at' => '2026-09-25T01:29:40.548233096Z',
        'updated_at' => '2026-09-25T12:00:00.123+02:00',
    ]])]);

    $invoice = testClient($transport)->company('c')->invoices->get('inv-1');

    expect($invoice->getCreatedAt()->format('Y-m-d\TH:i:s.uP'))->toBe('2026-09-25T01:29:40.548233+00:00')
        ->and($invoice->getUpdatedAt()->format('Y-m-d\TH:i:s.uP'))->toBe('2026-09-25T12:00:00.123000+02:00');
});

it('sends date-times with microseconds', function () {
    $transport = new RecordingPsrClient([
        jsonResponse(['success' => true, 'data' => ['id' => 'inv-1']]),
        jsonResponse(['success' => true, 'data' => ['id' => 'inv-1']]),
    ]);
    $invoices = testClient($transport)->invoices;

    $invoices->markSent('inv-1', ['sent_at' => '2026-09-25T12:00:00.123456Z']);
    $invoices->markSent('inv-1', (new V1InvoicesInvoiceIdMarkSentPostBody)->setSentAt(new DateTime('2026-09-25T12:00:00.5+02:00')));

    expect(json_decode((string) $transport->requests[0]->getBody(), true))->toBe(['sent_at' => '2026-09-25T12:00:00.123456+00:00'])
        ->and(json_decode((string) $transport->requests[1]->getBody(), true))->toBe(['sent_at' => '2026-09-25T12:00:00.500000+02:00']);
});

it('rejects an empty or non-RFC 3339 date-time instead of reading it as now', function (mixed $value) {
    $transport = new RecordingPsrClient([jsonResponse(['success' => true, 'data' => ['id' => 'inv-1', 'created_at' => $value]])]);

    expect(fn () => testClient($transport)->company('c')->invoices->get('inv-1'))->toThrow(InvalidDateException::class);
})->with(['empty' => [''], 'relative word' => ['tomorrow'], 'date only' => ['2026-09-25'], 'number' => [1_758_800_000]]);

it('rejects null in a date-time field that is never nullable, instead of reading it as now', function () {
    $transport = new RecordingPsrClient([
        jsonResponse(['success' => true, 'data' => ['id' => 'inv-1', 'created_at' => null]]),
        jsonResponse(['success' => true, 'data' => ['id' => 'inv-1', 'created_at' => '2026-09-28T10:00:00Z', 'voided_at' => null]]),
    ]);
    $invoices = testClient($transport)->company('c')->invoices;

    expect(fn () => $invoices->get('inv-1'))->toThrow(InvalidDateException::class)
        ->and($invoices->get('inv-1')->getVoidedAt())->toBeNull();
});

it('rejects a null date-time only where the field is required', function () {
    $transport = new RecordingPsrClient([
        jsonResponse(['success' => true, 'data' => ['id' => 'inv-1', 'sent_at' => null]]),
        jsonResponse(['success' => true, 'data' => ['email_id' => 'e-1', 'sent_to' => ['a@example.test'], 'sent_at' => null]]),
        jsonResponse(['success' => true, 'data' => ['id' => 'inv-2', 'created_at' => null]]),
        jsonResponse(['success' => true, 'data' => ['id' => 'inv-9', 'email' => 'a@example.test', 'expires_at' => null]]),
    ]);
    $beel = testClient($transport);
    $invoices = $beel->company('c')->invoices;

    expect($invoices->get('inv-1')->getSentAt())->toBeNull()
        ->and($invoices->send('inv-1')->getSentAt())->toBeNull()
        ->and(fn () => $invoices->get('inv-2'))->toThrow(InvalidDateException::class)
        ->and(fn () => $beel->account('a')->invitations->get('inv-9'))->toThrow(InvalidDateException::class);
});

it('routes every generated date-time through DateTimeNormalizer', function () {
    $delegated = 0;
    $parsedInline = [];
    foreach (glob(__DIR__.'/../../src/Generated/Normalizer/*.php') ?: [] as $file) {
        $code = sourceCode($file);
        $delegated += substr_count($code, '\\DateTime::class');
        if (str_contains($code, 'new \\DateTime(') || str_contains($code, "createFromFormat('Y-m-d\\TH:i:sP'")) {
            $parsedInline[] = basename($file);
        }
    }

    // Without the date-time mapping in .jane-openapi, the generated code parses dates itself and
    // the SDK's strict checks and precision handling are silently bypassed.
    expect($delegated)->toBeGreaterThan(0)
        ->and($parsedInline)->toBe([]);
});

it('accepts date-time objects in request arrays and keeps their microseconds', function () {
    $transport = new RecordingPsrClient([jsonResponse(['success' => true, 'data' => ['id' => 'inv-1']])]);

    testClient($transport)->invoices->markSent('inv-1', ['sent_at' => new DateTimeImmutable('2026-09-28T10:00:00.654321+02:00')]);

    expect(json_decode((string) $transport->requests[0]->getBody(), true))->toBe(['sent_at' => '2026-09-28T10:00:00.654321+02:00']);
});

it('keeps the calendar day of a date object in its own time zone when building an invoice', function () {
    $transport = new RecordingPsrClient([jsonResponse(['success' => true, 'data' => ['id' => 'inv-1']], 201)]);
    $madrid = new DateTimeZone('Europe/Madrid');

    testClient($transport)->company('c')->invoices->create(InvoiceBuilder::create()
        ->forCustomer('customer-1')
        ->operationDate(new DateTimeImmutable('2026-03-01 00:00', $madrid))
        ->dueDate(new DateTime('2026-03-15 00:30', $madrid))
        ->addLine('Consulting', 1, 100)
        ->build());
    $sent = json_decode((string) $transport->requests[0]->getBody(), true);

    expect($sent['operation_date'])->toBe('2026-03-01')
        ->and($sent['due_date'])->toBe('2026-03-15');
});

it('rejects a date-time that does not exist instead of rolling it over', function (string $value) {
    $transport = new RecordingPsrClient([jsonResponse(['success' => true, 'data' => ['id' => 'inv-1', 'created_at' => $value]])]);

    expect(fn () => testClient($transport)->company('c')->invoices->get('inv-1'))->toThrow(InvalidDateException::class);
})->with(['2026-02-30T00:00:00Z', '2026-01-01T24:00:00Z', '2026-12-31T23:59:60Z', '2026-13-01T00:00:00Z']);

it('keeps free-text response values that look like dates as BeeL sent them', function () {
    $transport = new RecordingPsrClient([jsonResponse(['success' => true, 'data' => [
        'id' => 'inv-1',
        'notes' => '2026-09-25T12:00:00.123Z',
        'created_at' => '2026-09-25T12:00:00.123Z',
    ]])]);

    $invoice = testClient($transport)->company('c')->invoices->get('inv-1');

    expect($invoice->getNotes())->toBe('2026-09-25T12:00:00.123Z')
        ->and($invoice->getCreatedAt()?->format(DATE_ATOM))->toBe('2026-09-25T12:00:00+00:00');
});

it('never rewrites values inside free-form maps such as metadata', function () {
    $transport = new RecordingPsrClient([jsonResponse(['success' => true, 'data' => [
        'id' => 'inv-1',
        'created_at' => '2026-09-25T12:00:00.123Z',
        'metadata' => ['created_at' => '2026-09-25T12:00:00.123Z', 'nested' => ['paid_at' => '2026-01-01T00:00:00.5Z']],
    ]])]);

    $invoice = testClient($transport)->company('c')->invoices->get('inv-1');

    expect($invoice->getCreatedAt()->format(DATE_ATOM))->toBe('2026-09-25T12:00:00+00:00')
        ->and($invoice->getMetadata()['created_at'])->toBe('2026-09-25T12:00:00.123Z')
        ->and($invoice->getMetadata()['nested'])->toBe(['paid_at' => '2026-01-01T00:00:00.5Z']);
});

it('accepts null and every RFC 3339 form, and ignores free-form maps', function () {
    $transport = new RecordingPsrClient([jsonResponse(['success' => true, 'data' => [
        'id' => 'inv-1',
        'created_at' => '2026-09-25t12:00:00z',
        'updated_at' => '2026-09-25T12:00:00+02:00',
        'voided_at' => null,
        'metadata' => ['created_at' => '', 'sent_at' => 'whenever'],
    ]])]);

    $invoice = testClient($transport)->company('c')->invoices->get('inv-1');

    expect($invoice->getCreatedAt()->format(DATE_ATOM))->toBe('2026-09-25T12:00:00+00:00')
        ->and($invoice->getVoidedAt())->toBeNull()
        ->and($invoice->getMetadata()['created_at'])->toBe('');
});
