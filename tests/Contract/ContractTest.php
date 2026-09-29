<?php

declare(strict_types=1);

use Lenorix\BeelSdk\Enum\Environment;
use Lenorix\BeelSdk\Enum\RecurringInvoicePauseReason;
use Lenorix\BeelSdk\Enum\VeriFactuSubmissionStatus;
use Lenorix\BeelSdk\Enum\WebhookAccountRelationship;
use Lenorix\BeelSdk\Webhook\WebhookEventType;

it('exposes the Node.js SDK enums with every value in the OpenAPI contract', function () {
    expect(array_map(static fn (VeriFactuSubmissionStatus $case): string => $case->value, VeriFactuSubmissionStatus::cases()))
        ->toBe(['PENDING', 'ACCEPTED', 'VOIDED', 'REJECTED', 'NOT_SUBMITTED'])
        ->and(RecurringInvoicePauseReason::from('GENERATION_FAILURE'))->toBe(RecurringInvoicePauseReason::GENERATION_FAILURE)
        ->and(WebhookAccountRelationship::from('managed'))->toBe(WebhookAccountRelationship::MANAGED);
});

it('keeps the hand-written enums in sync with the contract', function (string $schema, string $enum) {
    $values = array_map(static fn (BackedEnum $case): string|int => $case->value, $enum::cases());
    $contract = openApiContract()['components']['schemas'][$schema]['enum'];
    sort($values);
    sort($contract);

    expect($values)->toBe($contract);
})->with([
    ['Environment', Environment::class],
    ['VeriFactuSubmissionStatus', VeriFactuSubmissionStatus::class],
    ['RecurringInvoicePauseReason', RecurringInvoicePauseReason::class],
    ['WebhookAccountRelationship', WebhookAccountRelationship::class],
    ['WebhookEventTypeEnum', WebhookEventType::class],
]);

it('keeps every docblock summary in the SDK whole', function () {
    $broken = [];
    foreach (new RecursiveIteratorIterator(new RecursiveDirectoryIterator(__DIR__.'/../../src')) as $file) {
        $path = str_replace('\\', '/', $file->getPathname());
        if ($file->getExtension() !== 'php' || str_contains($path, '/src/Generated/')) {
            continue;
        }
        // A summary cut off mid-word runs straight into the next docblock line.
        if (preg_match_all('#/\*\*[^\n/]*[A-Za-z]\h+\*\h*$#m', sourceCode($path), $matches) > 0) {
            $broken[] = basename($path).': '.implode(' | ', array_map('trim', $matches[0]));
        }
    }

    expect($broken)->toBe([]);
});
