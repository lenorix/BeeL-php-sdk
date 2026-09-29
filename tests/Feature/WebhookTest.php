<?php

declare(strict_types=1);

use Lenorix\BeelSdk\Exception\WebhookHeaderError;
use Lenorix\BeelSdk\Exception\WebhookPayloadError;
use Lenorix\BeelSdk\Exception\WebhookSignatureError;
use Lenorix\BeelSdk\Exception\WebhookTimestampError;
use Lenorix\BeelSdk\Exception\WebhookVerificationError;
use Lenorix\BeelSdk\Generated\Model\WebhookEvent;
use Lenorix\BeelSdk\Generated\Model\WebhookEventDataInvoiceIssued;
use Lenorix\BeelSdk\Tests\Support\RecordingPsrClient;
use Lenorix\BeelSdk\Webhook\WebhookEventType;
use Lenorix\BeelSdk\Webhook\WebhookSignatureHeader;
use Lenorix\BeelSdk\Webhook\WebhookSigner;
use Lenorix\BeelSdk\Webhook\WebhookVerifier;

it('reports each webhook verification failure with its own exception type', function () {
    $secret = 'whsec_test';
    $now = 1_800_000_000;
    $body = '{"type":"invoice.issued","data":{}}';
    $header = (new WebhookSigner($secret))->sign($body, $now);
    $verifier = new WebhookVerifier($secret);

    $cases = [
        [fn () => $verifier->verify($body, null, $now), WebhookHeaderError::class],
        [fn () => $verifier->verify($body, 'v1=abc', $now), WebhookHeaderError::class],
        [fn () => $verifier->verify($body, $header, $now + 301), WebhookTimestampError::class],
        [fn () => (new WebhookVerifier('whsec_rotated'))->verify($body, $header, $now), WebhookSignatureError::class],
        [fn () => $verifier->verify($body.' ', $header, $now), WebhookSignatureError::class],
        [fn () => $verifier->verify('not json', (new WebhookSigner($secret))->sign('not json', $now), $now), WebhookPayloadError::class],
        [fn () => $verifier->verifyEvent('{"type":"invoice.issued","data":{"invoice_id":[]}}', (new WebhookSigner($secret))->sign('{"type":"invoice.issued","data":{"invoice_id":[]}}', $now), $now), WebhookPayloadError::class],
    ];

    foreach ($cases as [$verify, $expected]) {
        try {
            $verify();
            test()->fail("Expected {$expected}.");
        } catch (WebhookVerificationError $exception) {
            expect($exception)->toBeInstanceOf($expected);
        }
    }
});

it('signs webhook bodies that the verifier accepts', function () {
    $body = json_encode(['id' => 'evt-1', 'type' => WebhookEventType::INVOICE_ISSUED->value, 'data' => []], JSON_THROW_ON_ERROR);
    $header = (new WebhookSigner('whsec_test'))->sign($body, 1_800_000_000);

    expect($header)->toBe('t=1800000000,v1='.hash_hmac('sha256', '1800000000.'.$body, 'whsec_test'))
        ->and((new WebhookVerifier('whsec_test'))->verify($body, $header, 1_800_000_000)['id'])->toBe('evt-1')
        ->and((new WebhookVerifier('whsec_test'))->verify($body, (new WebhookSigner('whsec_test'))->sign($body))['id'])->toBe('evt-1');
});

it('builds the typed event from an already verified payload', function () {
    $verifier = new WebhookVerifier('whsec_test');
    $body = json_encode(['id' => 'evt-1', 'type' => 'invoice.issued', 'created_at' => '2026-09-25T12:00:00.123Z', 'api_version' => '2026-09-01', 'livemode' => false, 'company_id' => 'c', 'data' => ['invoice_id' => 'inv-1', 'invoice_number' => 'A-1']], JSON_THROW_ON_ERROR);
    $payload = $verifier->verify($body, (new WebhookSigner('whsec_test'))->sign($body, 1_800_000_000), 1_800_000_000);

    $event = $verifier->toEvent($payload);

    expect($event)->toBeInstanceOf(WebhookEvent::class)
        ->and($event->getData())->toBeInstanceOf(WebhookEventDataInvoiceIssued::class)
        ->and($event->getData()->getInvoiceId())->toBe('inv-1')
        ->and(fn () => $verifier->toEvent([...$payload, 'data' => ['invoice_id' => [], 'invoice_number' => 'A-1']]))->toThrow(WebhookPayloadError::class);
});

it('rejects a webhook body that is a JSON list but accepts an empty object', function () {
    $signer = new WebhookSigner('whsec_test');
    $verifier = new WebhookVerifier('whsec_test');

    expect(fn () => $verifier->verify('[1,2]', $signer->sign('[1,2]', 1_000), 1_000))->toThrow(WebhookPayloadError::class)
        ->and($verifier->verify('{}', $signer->sign('{}', 1_000), 1_000))->toBe([]);
});

it('builds typed events without a verifier and flags provisioner-only events', function () {
    $event = WebhookVerifier::eventFromPayload(['id' => 'evt-1', 'type' => 'invoice.issued', 'created_at' => '2026-09-25T12:00:00.5Z', 'api_version' => '2026-09-01', 'livemode' => false, 'data' => ['invoice_id' => 'inv-1', 'invoice_number' => 'A-1']]);

    expect($event->getData())->toBeInstanceOf(WebhookEventDataInvoiceIssued::class)
        ->and(array_values(array_map(static fn (WebhookEventType $type): string => $type->value, array_filter(WebhookEventType::cases(), static fn (WebhookEventType $type): bool => $type->isProvisionerOnly()))))
        ->toBe(['account.claimed', 'company.created', 'representation.signed']);
});

it('keeps the microseconds of webhook date-times', function () {
    $body = '{"id":"evt-1","type":"invoice.issued","created_at":"2026-09-25T01:29:40.548233096Z","api_version":"2026-09-01","livemode":false,"data":{"invoice_id":"inv-1","invoice_number":"A-1"}}';

    $event = (new WebhookVerifier('whsec_test'))->verifyEvent($body, (new WebhookSigner('whsec_test'))->sign($body, 1_000), 1_000);

    expect($event->getCreatedAt()->format('Y-m-d\TH:i:s.uP'))->toBe('2026-09-25T01:29:40.548233+00:00');
});

it('rejects invalid date-times in webhooks and in request arrays', function () {
    $body = '{"id":"evt-1","type":"invoice.issued","created_at":"","api_version":"2026-09-01","livemode":false,"data":{"invoice_id":"inv-1","invoice_number":"A-1"}}';
    $transport = new RecordingPsrClient([]);

    expect(fn () => (new WebhookVerifier('whsec_test'))->verifyEvent($body, (new WebhookSigner('whsec_test'))->sign($body, 1_000), 1_000))
        ->toThrow(WebhookPayloadError::class)
        ->and(fn () => testClient($transport)->invoices->markSent('inv-1', ['sent_at' => '']))->toThrow(InvalidArgumentException::class)
        ->and($transport->requests)->toBe([]);
});

it('rejects a signed webhook body that is a JSON list, even an empty one', function (string $body) {
    $verifier = new WebhookVerifier('whsec_test');

    expect(fn () => $verifier->verify($body, (new WebhookSigner('whsec_test'))->sign($body, 1_000), 1_000))
        ->toThrow(WebhookPayloadError::class);
})->with(['[]', ' [ ] ', '[{"id":"evt-1"}]']);

it('rejects a webhook event without a field BeeL requires, instead of a TypeError later', function (array $event) {
    expect(fn () => WebhookVerifier::eventFromPayload($event))->toThrow(WebhookPayloadError::class);
})->with([
    'empty object' => [[]],
    'no id' => [array_diff_key(webhookEvent(), ['id' => true])],
    'no data' => [array_diff_key(webhookEvent(), ['data' => true])],
    'data not an object' => [webhookEvent(['data' => 'inv-1'])],
    'data without a required field' => [webhookEvent(['data' => ['invoice_id' => 'inv-1']])],
]);

it('checks the required fields of every webhook event and its data as BeeL declares them', function () {
    $schemas = openApiContract()['components']['schemas'];
    $dataSchemas = array_map(
        static fn (array $option): string => substr($option['$ref'], strlen('#/components/schemas/')),
        $schemas['WebhookEvent']['properties']['data']['oneOf'],
    );
    $models = [];
    foreach (WebhookEventType::cases() as $type) {
        $schema = substr($type->dataModel(), strrpos($type->dataModel(), '\\') + 1);
        $models[] = $schema;
        expect($type->requiredDataFields())->toBe($schemas[$schema]['required'] ?? [], $type->value);
    }
    sort($models);
    sort($dataSchemas);

    // Each event type has its own data schema, and every one the contract lists is used.
    expect((new ReflectionClass(WebhookVerifier::class))->getConstant('EVENT_REQUIRED'))->toBe($schemas['WebhookEvent']['required'])
        ->and($models)->toBe($dataSchemas);
});

it('exposes the checked and signed timestamps on a replay window failure', function () {
    $header = WebhookSignatureHeader::parse((new WebhookSigner('whsec_test'))->sign('{}', 1_000));

    try {
        (new WebhookVerifier('whsec_test', toleranceSeconds: 60))->checkTimestamp($header, 2_000);
        test()->fail('Expected a timestamp error.');
    } catch (WebhookTimestampError $exception) {
        expect($exception->timestamp)->toBe(1_000)
            ->and($exception->now)->toBe(2_000)
            ->and($exception->toleranceSeconds)->toBe(60);
    }
});

it('parses and checks the header freshness without the body or HMAC', function () {
    $header = WebhookSignatureHeader::parse('t=1800000000,v1=aa,v1=bb');
    (new WebhookVerifier('whsec_test'))->checkTimestamp($header, 1_800_000_100);

    expect($header->timestamp)->toBe(1_800_000_000)
        ->and($header->signatures)->toBe(['aa', 'bb'])
        ->and((string) $header)->toBe('t=1800000000,v1=aa,v1=bb')
        ->and(WebhookSignatureHeader::NAME)->toBe('BeeL-Signature');
});

it('keeps the data of an event type this SDK does not know as an array', function () {
    $event = WebhookVerifier::eventFromPayload(webhookEvent(['type' => 'invoice.paid']));

    expect($event->getType())->toBe('invoice.paid')
        ->and($event->getData())->toBe(['invoice_id' => 'inv-1', 'invoice_number' => 'F-2026-0001']);
});
