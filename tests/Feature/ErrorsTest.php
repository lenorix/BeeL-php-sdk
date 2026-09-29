<?php

declare(strict_types=1);

use GuzzleHttp\Psr7\Response;
use Lenorix\BeelSdk\Beel;
use Lenorix\BeelSdk\Exception\BeelApiError;
use Lenorix\BeelSdk\Exception\BeelAuthError;
use Lenorix\BeelSdk\Exception\BeelConflictError;
use Lenorix\BeelSdk\Exception\BeelNotFoundError;
use Lenorix\BeelSdk\Exception\BeelRateLimitError;
use Lenorix\BeelSdk\Exception\BeelUnexpectedResponseError;
use Lenorix\BeelSdk\Exception\BeelValidationError;
use Lenorix\BeelSdk\Tests\Support\RecordingPsrClient;

it('exposes API error data as a logging context without submitted values', function () {
    $transport = new RecordingPsrClient([new Response(422, ['Content-Type' => 'application/json', 'X-Request-Id' => 'req-9'], '{"success":false,"error":{"code":"INVALID","message":"Bad","details":{"field":"x"}}}')]);

    try {
        testClient($transport)->company('c')->invoices->get('inv-1');
        test()->fail('Expected a validation error.');
    } catch (BeelValidationError $exception) {
        expect($exception->context())->toBe(['status_code' => 422, 'api_code' => 'INVALID', 'request_id' => 'req-9', 'retry_after' => null])
            ->and($exception->details['field'])->toBe('x');
    }
});

it('maps an empty error response without Content-Type to BeelApiError', function () {
    $deprecations = [];
    $source = str_replace('\\', '/', (string) realpath(__DIR__.'/../../src')).'/';
    set_error_handler(static function (int $level, string $message, string $file) use (&$deprecations, $source): bool {
        // Only the SDK's own code counts: with the lowest dependencies, third-party classes emit
        // deprecations when first loaded, which can happen during this test.
        if (str_starts_with(str_replace('\\', '/', $file), $source)) {
            $deprecations[] = $message;
        }

        return true;
    }, E_DEPRECATED | E_USER_DEPRECATED);

    try {
        expect(fn () => testClient(new RecordingPsrClient([new Response(503)]))->company('c')->invoices->get('inv-1'))
            ->toThrow(BeelApiError::class, 'API error 503');
    } finally {
        restore_error_handler();
    }

    expect($deprecations)->toBe([]);
});

it('falls back to the Node.js SDK error codes when BeeL sends none', function (int $status, string $class, string $code) {
    $transport = new RecordingPsrClient([new Response($status, ['Content-Type' => 'application/json'], '{"success":false}')]);

    try {
        testClient($transport)->company('c')->invoices->get('inv-1');
        test()->fail('Expected an API error.');
    } catch (BeelApiError $exception) {
        expect($exception)->toBeInstanceOf($class)
            ->and($exception->apiCode)->toBe($code);
    }
})->with([
    [401, BeelAuthError::class, 'UNAUTHORIZED'],
    [403, BeelAuthError::class, 'FORBIDDEN'],
    [404, BeelNotFoundError::class, 'NOT_FOUND'],
    [409, BeelConflictError::class, 'CONFLICT'],
    [422, BeelValidationError::class, 'UNPROCESSABLE_ENTITY'],
    [429, BeelRateLimitError::class, 'RATE_LIMIT_EXCEEDED'],
    [400, BeelApiError::class, 'UNKNOWN'],
]);

it('uses the Node.js SDK fallback message when BeeL sends none', function (Response $response, string $message) {
    try {
        testClient(new RecordingPsrClient([$response]))->company('c')->invoices->get('inv-1');
        test()->fail('Expected an API error.');
    } catch (BeelApiError $exception) {
        expect($exception->getMessage())->toBe($message);
    }
})->with([
    'declared JSON error without message' => [new Response(404, ['Content-Type' => 'application/json'], '{"success":false}'), 'API error 404'],
    'undeclared HTML error' => [new Response(502, ['Content-Type' => 'text/html'], '<html>Bad gateway</html>'), 'API error 502'],
    'JSON error with message' => [new Response(409, ['Content-Type' => 'application/json'], '{"success":false,"error":{"code":"X","message":"Already issued"}}'), 'Already issued'],
]);

it('reports an undeclared success status as unexpected, not as a failed request', function () {
    $transport = new RecordingPsrClient([
        new Response(202, ['Content-Type' => 'application/json', 'X-Request-Id' => 'req-202'], '{"success":true,"data":{"id":"inv-1"}}'),
        jsonResponse(['success' => false, 'error' => ['code' => 'NOT_FOUND', 'message' => 'Missing']], 404),
    ]);
    $invoices = testClient($transport)->company('c')->invoices;

    try {
        $invoices->get('inv-1');
        test()->fail('Expected BeelUnexpectedResponseError.');
    } catch (BeelUnexpectedResponseError $exception) {
        expect($exception)->not->toBeInstanceOf(BeelApiError::class)
            ->and($exception->statusCode)->toBe(202)
            ->and($exception->requestId)->toBe('req-202')
            ->and($exception->getMessage())->toContain('getLastResponse()')
            ->and($exception->context())->toBe(['status_code' => 202, 'request_id' => 'req-202']);
    }

    expect(fn () => $invoices->get('inv-1'))->toThrow(BeelNotFoundError::class);
});

it('reports a success status without a readable body as unexpected, not as a TypeError', function (Response $response) {
    $transport = new RecordingPsrClient([$response]);

    $deprecations = deprecationsFromSource(fn () => expect(fn () => testClient($transport)->company('c')->invoices->get('inv-1'))
        ->toThrow(BeelUnexpectedResponseError::class));

    expect($deprecations)->toBe([]);
})->with([
    'undeclared status' => fn () => new Response(202, ['X-Request-Id' => 'req-1']),
    'undeclared 204' => fn () => new Response(204),
    'declared status, empty body' => fn () => new Response(200, ['Content-Type' => 'application/json']),
    'declared status, not JSON' => fn () => new Response(200, ['Content-Type' => 'text/html'], '<html></html>'),
]);

it('maps an error status the operation does not declare from its body, or its status alone', function () {
    // getCompanyInvoice declares neither 409 nor 503.
    $transport = new RecordingPsrClient([
        new Response(409, ['Content-Type' => 'application/json'], '{"success":false,"error":{"code":"INVOICE_LOCKED","message":"Locked"},"meta":{"request_id":"req-409"}}'),
        new Response(503),
    ]);
    $invoices = testClient($transport)->company('c')->invoices;
    $errors = [];

    $deprecations = deprecationsFromSource(function () use ($invoices, &$errors) {
        foreach ([1, 2] as $attempt) {
            try {
                $invoices->get('inv-1');
            } catch (BeelApiError $exception) {
                $errors[] = $exception;
            }
        }
    });

    expect($deprecations)->toBe([])
        ->and($errors)->toHaveCount(2)
        ->and($errors[0])->toBeInstanceOf(BeelConflictError::class)
        ->and($errors[0]->apiCode)->toBe('INVOICE_LOCKED')
        ->and($errors[0]->getMessage())->toBe('Locked')
        ->and($errors[0]->requestId)->toBe('req-409')
        ->and($errors[1]->statusCode)->toBe(503);
});

it('maps an error status whose JSON Content-Type carries no JSON to BeelApiError', function () {
    $transport = new RecordingPsrClient([new Response(502, ['Content-Type' => 'application/json', 'X-Request-Id' => 'req-9'], '<html>Bad gateway</html>')]);

    try {
        testClient($transport)->company('c')->invoices->get('inv-1');
        test()->fail('Expected BeelApiError.');
    } catch (BeelApiError $exception) {
        expect($exception->statusCode)->toBe(502)
            ->and($exception->requestId)->toBe('req-9');
    }
});

it('maps an error body whose fields are not strings to BeelApiError', function (string $body, ?string $apiCode, string $message, ?string $requestId) {
    $transport = new RecordingPsrClient([new Response(503, ['Content-Type' => 'application/json'], $body)]);

    try {
        testClient($transport)->company('c')->get();
        test()->fail('Expected BeelApiError.');
    } catch (BeelApiError $exception) {
        expect($exception->statusCode)->toBe(503)
            ->and($exception->apiCode)->toBe($apiCode)
            ->and($exception->getMessage())->toBe($message)
            ->and($exception->requestId)->toBe($requestId);
    }
})->with([
    'numeric code' => ['{"error":{"code":500,"message":"Down"}}', '500', 'Down', null],
    'list message' => ['{"error":{"code":"DOWN","message":["a","b"]}}', 'DOWN', 'API error 503', null],
    'numeric request ID' => ['{"error":{"code":"DOWN"},"meta":{"request_id":123}}', 'DOWN', 'API error 503', '123'],
    'string error' => ['{"error":"Service Unavailable"}', 'UNKNOWN', 'Service Unavailable', null],
]);

it('reports a success response without data as unexpected, not as a TypeError', function () {
    $transport = new RecordingPsrClient([jsonResponse(['success' => true]), jsonResponse(['success' => true, 'data' => null])]);
    $company = testClient($transport)->company('c');

    expect(fn () => $company->get())->toThrow(BeelUnexpectedResponseError::class)
        ->and(fn () => $company->get())->toThrow(BeelUnexpectedResponseError::class);
});

it('treats a redirect as a failed request, never as a success', function (Closure $call) {
    $transport = new RecordingPsrClient([new Response(301, ['Location' => 'https://app.beel.es/api/v1/x'])]);

    expect(fn () => $call(testClient($transport)))->toThrow(BeelApiError::class);
})->with([
    'request() write' => [fn (Beel $beel) => $beel->request('POST', '/v1/companies/{company_id}/series/defaults', ['company_id' => 'c'], body: ['x' => 1])],
    'delete' => [fn (Beel $beel) => $beel->company('c')->invoices->delete('i')],
    'get' => [fn (Beel $beel) => $beel->company('c')->invoices->get('i')],
    'file download' => [fn (Beel $beel) => $beel->company('c')->invoices->export(['invoice_ids' => ['i']])],
]);

it('keeps the code BeeL sends and defaults a rate limit without delay to 60 seconds', function () {
    $coded = new RecordingPsrClient([jsonResponse(['success' => false, 'error' => ['code' => 'INVOICE_NOT_FOUND', 'message' => 'Missing']], 404)]);
    $limited = new RecordingPsrClient([jsonResponse(['success' => false, 'error' => ['code' => 'RATE_LIMITED', 'message' => 'Slow down']], 429)]);
    $withDelay = new RecordingPsrClient([new Response(429, ['Content-Type' => 'application/json', 'Retry-After' => '7'], '{"success":false}')]);

    $caught = [];
    foreach ([$coded, $limited, $withDelay] as $transport) {
        try {
            testClient($transport)->company('c')->invoices->get('inv-1');
        } catch (BeelApiError $exception) {
            $caught[] = $exception;
        }
    }

    expect($caught[0]->apiCode)->toBe('INVOICE_NOT_FOUND')
        ->and($caught[1]->apiCode)->toBe('RATE_LIMITED')
        ->and($caught[1]->retryAfterSeconds)->toBe(60)
        ->and($caught[1]->retryAfter)->toBeNull()
        ->and($caught[2]->retryAfterSeconds)->toBe(7);
});
