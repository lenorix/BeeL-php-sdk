<?php

declare(strict_types=1);

use GuzzleHttp\Psr7\NoSeekStream;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\Utils;
use Lenorix\BeelSdk\Exception\BeelApiError;
use Lenorix\BeelSdk\Exception\BeelNotReadyError;
use Lenorix\BeelSdk\Exception\BeelUnexpectedResponseError;
use Lenorix\BeelSdk\Exception\BeelValidationError;
use Lenorix\BeelSdk\Generated\Model\CreateInvoiceExportRequest;
use Lenorix\BeelSdk\Generated\Model\InvoicePdfResponseData;
use Lenorix\BeelSdk\Generated\Model\InvoicePreviewResponseData;
use Lenorix\BeelSdk\Http\BinaryDownload;
use Lenorix\BeelSdk\Http\RequestOptions;
use Lenorix\BeelSdk\Tests\Support\RecordingPsrClient;
use Lenorix\BeelSdk\Tests\Support\TripwireStream;

it('sends the PDF wait preference and still returns the ready PDF', function () {
    $transport = new RecordingPsrClient([
        jsonResponse(['success' => true, 'data' => ['download_url' => 'https://signed.example.test/a.pdf', 'file_name' => 'a.pdf', 'expires_in_seconds' => 300]]),
        jsonResponse(['success' => true, 'data' => ['download_url' => 'https://signed.example.test/a.pdf', 'file_name' => 'a.pdf', 'expires_in_seconds' => 300]]),
    ]);
    $invoices = testClient($transport)->company('c')->invoices;

    $pdf = $invoices->getPdf('inv-1', waitSeconds: 0);
    $invoices->getPdf('inv-1');

    expect($pdf)->toBeInstanceOf(InvoicePdfResponseData::class)
        ->and($pdf->getFileName())->toBe('a.pdf')
        ->and($transport->requests[0]->getHeaderLine('Prefer'))->toBe('wait=0')
        ->and($transport->requests[1]->hasHeader('Prefer'))->toBeFalse()
        ->and(fn () => $invoices->getPdf('inv-1', waitSeconds: -1))->toThrow(InvalidArgumentException::class);
});

it('keeps mapping PDF API errors to BeelApiError', function () {
    $transport = new RecordingPsrClient([jsonResponse(['success' => false, 'error' => ['code' => 'INVOICE_NOT_ISSUED_NO_PDF', 'message' => 'Draft']], 400)]);

    try {
        testClient($transport)->company('c')->invoices->getPdf('inv-1');
        test()->fail('Expected an API error.');
    } catch (BeelApiError $exception) {
        expect($exception->apiCode)->toBe('INVOICE_NOT_ISSUED_NO_PDF')
            ->and($exception->statusCode)->toBe(400);
    }
});

it('applies the not-ready behavior to the legacy PDF endpoint', function () {
    $transport = new RecordingPsrClient([new Response(202, ['Retry-After' => '7'])]);

    try {
        testClient($transport)->invoices->getPdf('inv-1', waitSeconds: 2);
        test()->fail('Expected BeelNotReadyError.');
    } catch (BeelNotReadyError $exception) {
        expect($exception->retryAfter)->toBe(7)
            ->and($transport->requests[0]->getHeaderLine('Prefer'))->toBe('wait=2');
    }
});

it('returns the PDF archive as the untouched response stream', function (bool $seekable) {
    $body = new TripwireStream("PK\x03\x04zip-bytes", $seekable);
    $transport = new RecordingPsrClient([new Response(200, [
        'Content-Type' => 'application/zip',
        'Content-Disposition' => 'attachment; filename="facturas.zip"',
        'X-Bulk-Total' => '2',
        'X-Bulk-Successful' => '1',
        'X-Bulk-Failed' => '1',
    ], $body)]);

    $download = testClient($transport)->company('c')->invoices->createPdfArchive(archiveRequest());

    expect($download)->toBeInstanceOf(BinaryDownload::class)
        ->and($download->body)->toBe($body)
        ->and($body->reads)->toBe(0)
        ->and($download->fileName)->toBe('facturas.zip')
        ->and($download->contentType)->toBe('application/zip')
        ->and($download->contentLength)->toBe(13)
        ->and($download->counts)->toBe(['total' => 2, 'successful' => 1, 'failed' => 1])
        ->and($download->body->read(2))->toBe('PK')
        ->and($transport->requests[0]->getUri()->getPath())->toBe('/api/v1/companies/c/invoices/pdf-archive')
        ->and($transport->requests[0]->getHeaderLine('Accept'))->toContain('application/zip');
})->with(['seekable' => [true], 'non-seekable' => [false]]);

it('returns the export spreadsheet with its file name and invoice count', function () {
    $transport = new RecordingPsrClient([new Response(200, [
        'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        'Content-Disposition' => "attachment; filename=\"fallback.xlsx\"; filename*=UTF-8''facturas%20a%C3%B1o_2025.xlsx",
        'Content-Length' => '42',
        'X-Total-Invoices' => '17',
    ], new TripwireStream('PK-xlsx'))]);

    $download = testClient($transport)->company('c')->invoices
        ->withOptions(new RequestOptions(headers: ['X-Trace-Id' => 'trace-1']))
        ->export(new CreateInvoiceExportRequest);

    expect($download->fileName)->toBe('facturas año_2025.xlsx')
        ->and($download->contentLength)->toBe(42)
        ->and($download->counts)->toBe(['total' => 17])
        ->and($transport->requests[0]->getHeaderLine('X-Trace-Id'))->toBe('trace-1');
});

it('reduces download file names to a safe base name', function (string $disposition, ?string $expected) {
    $transport = new RecordingPsrClient([new Response(200, ['Content-Type' => 'application/zip', 'Content-Disposition' => $disposition], 'PK')]);

    expect(testClient($transport)->company('c')->invoices->createPdfArchive(archiveRequest())->fileName)->toBe($expected);
})->with([
    'path traversal' => ['attachment; filename="../../etc/passwd"', 'passwd'],
    'encoded traversal' => ["attachment; filename*=UTF-8''..%2F..%2Fsecret.zip", 'secret.zip'],
    'windows path' => ['attachment; filename="C:\\\\temp\\\\a.zip"', 'a.zip'],
    'only dots' => ['attachment; filename=".."', null],
    'token form' => ['attachment; filename=archive.zip', 'archive.zip'],
    'no file name' => ['attachment', null],
]);

it('maps export errors to BeelApiError with their BeeL code', function () {
    $selection = new RecordingPsrClient([jsonResponse(['success' => false, 'error' => ['code' => 'EXPORT_SELECTION_REQUIRED', 'message' => 'Select invoices']], 400)]);
    $limit = new RecordingPsrClient([jsonResponse(['success' => false, 'error' => ['code' => 'EXPORT_LIMIT_EXCEEDED', 'message' => 'Too many']], 422)]);
    $gateway = new RecordingPsrClient([new Response(502, ['Content-Type' => 'text/html'], '<html>Bad gateway</html>')]);

    foreach ([[$selection, BeelApiError::class, 400, 'EXPORT_SELECTION_REQUIRED'], [$limit, BeelValidationError::class, 422, 'EXPORT_LIMIT_EXCEEDED'], [$gateway, BeelApiError::class, 502, 'UNKNOWN']] as [$transport, $class, $status, $code]) {
        try {
            testClient($transport)->company('c')->invoices->export(new CreateInvoiceExportRequest);
            test()->fail('Expected an API error.');
        } catch (BeelApiError $exception) {
            expect($exception)->toBeInstanceOf($class)
                ->and($exception->statusCode)->toBe($status)
                ->and($exception->apiCode)->toBe($code);
        }
    }
});

it('parses JSON from a transport that streams non-seekable bodies', function () {
    $transport = new RecordingPsrClient([new Response(200, ['Content-Type' => 'application/json'], new NoSeekStream(Utils::streamFor('{"success":true,"data":{"id":"inv-1","created_at":"2026-09-25T12:00:00.123Z"}}')))]);

    $invoice = testClient($transport)->company('c')->invoices->get('inv-1');

    expect($invoice->getId())->toBe('inv-1')
        ->and($invoice->getCreatedAt()->format(DATE_ATOM))->toBe('2026-09-25T12:00:00+00:00');
});

it('keeps a non-seekable JSON body readable when nothing needs normalizing', function () {
    $transport = new RecordingPsrClient([new Response(200, ['Content-Type' => 'application/json'], new NoSeekStream(Utils::streamFor('{"success":true,"data":{"id":"inv-1"}}')))]);

    expect(testClient($transport)->company('c')->invoices->get('inv-1')->getId())->toBe('inv-1');
});

it('never rewrites the query of a signed download URL', function () {
    $transport = new RecordingPsrClient([
        jsonResponse(['success' => true, 'data' => ['download_url' => 'https://signed.example.test/f.pdf?active=1&X-Sig=abc', 'file_name' => 'f.pdf', 'expires_in_seconds' => 300]]),
        new Response(200, ['Content-Type' => 'application/pdf'], '%PDF'),
    ]);

    testClient($transport)->downloadPdf('inv-1');

    expect($transport->requests[1]->getUri()->getQuery())->toBe('active=1&X-Sig=abc');
});

it('downloads draft previews and import templates as streams', function () {
    $pdf = new TripwireStream('%PDF-preview');
    $transport = new RecordingPsrClient([
        new Response(200, ['Content-Type' => 'application/pdf'], $pdf),
        new Response(200, ['Content-Type' => 'text/csv', 'Content-Disposition' => 'attachment; filename="accounts.csv"'], "name,nif\n"),
        new Response(200, ['Content-Type' => 'text/csv'], "legal_name,nif\n"),
    ]);
    $beel = testClient($transport);

    $preview = $beel->company('c')->invoices->previewPdf('inv-1');
    $accounts = $beel->templates->accountImport();
    $customers = $beel->templates->customerImport();

    expect($preview->body)->toBe($pdf)
        ->and($preview->contentType)->toBe('application/pdf')
        ->and($accounts->fileName)->toBe('accounts.csv')
        ->and($customers->contentType)->toBe('text/csv')
        ->and(array_map(static fn ($request): string => $request->getUri()->getPath(), $transport->requests))->toBe([
            '/api/v1/companies/c/invoices/inv-1/pdf/preview',
            '/api/v1/templates/account-import',
            '/api/v1/templates/customer-import',
        ]);
});

it('keeps the Content-Type charset of a download while contentType stays the media type', function (string $header, ?string $charset) {
    $transport = new RecordingPsrClient([new Response(200, ['Content-Type' => $header], "legal_name,nif\n")]);

    $download = testClient($transport)->templates->customerImport();

    expect($download->contentType)->toBe('text/csv')
        ->and($download->charset)->toBe($charset);
})->with([
    'as BeeL sends it' => ['text/csv; charset=utf-8', 'utf-8'],
    'quoted' => ['text/csv; charset="UTF-8"', 'UTF-8'],
    'upper-case name' => ['text/csv;CHARSET=iso-8859-1', 'iso-8859-1'],
    'among other parameters' => ['text/csv; header=present; charset=utf-8', 'utf-8'],
    'without charset' => ['text/csv', null],
]);

it('reports a draft preview whose PDF is not ready as not ready', function () {
    $transport = new RecordingPsrClient([
        new Response(202, ['Retry-After' => '4']),
        jsonResponse(['success' => true, 'data' => ['invoice_id' => 'inv-1']]),
    ]);
    $invoices = testClient($transport)->company('c')->invoices;

    try {
        $invoices->preview('inv-1');
        test()->fail('Expected BeelNotReadyError.');
    } catch (BeelNotReadyError $exception) {
        expect($exception->retryAfter)->toBe(4);
    }

    expect($invoices->preview('inv-1'))->toBeInstanceOf(InvoicePreviewResponseData::class);
});

it('reports a 202 as not ready whatever body and Content-Type BeeL sends', function (string $method, array $headers, string $body) {
    $transport = new RecordingPsrClient([new Response(202, ['Retry-After' => '6', ...$headers], $body)]);
    $invoices = testClient($transport)->company('c')->invoices;
    $deprecations = [];
    $source = str_replace('\\', '/', (string) realpath(__DIR__.'/../../src')).'/';
    set_error_handler(static function (int $level, string $message, string $file) use (&$deprecations, $source): bool {
        if (str_starts_with(str_replace('\\', '/', $file), $source)) {
            $deprecations[] = $message;
        }

        return true;
    }, E_DEPRECATED | E_USER_DEPRECATED);

    try {
        $method === 'preview' ? $invoices->preview('inv-1') : $invoices->getPdf('inv-1');
        test()->fail('Expected BeelNotReadyError.');
    } catch (BeelNotReadyError $exception) {
        expect($exception->retryAfter)->toBe(6);
    } finally {
        restore_error_handler();
    }

    expect($deprecations)->toBe([]);
})->with(['preview', 'getPdf'])->with([
    'no Content-Type' => [[], ''],
    'JSON, empty body' => [['Content-Type' => 'application/json'], ''],
    'JSON, empty object' => [['Content-Type' => 'application/json'], '{}'],
]);

it('reports a preview answered without a readable body as unexpected, and 202 as not ready', function () {
    $transport = new RecordingPsrClient([new Response(200), new Response(202, ['Retry-After' => '3'])]);
    $invoices = testClient($transport)->company('c')->invoices;

    $deprecations = deprecationsFromSource(fn () => expect(fn () => $invoices->preview('inv-1'))->toThrow(BeelUnexpectedResponseError::class)
        ->and(fn () => $invoices->preview('inv-1'))->toThrow(BeelNotReadyError::class));

    expect($deprecations)->toBe([]);
});

it('keeps a download file name safe to save on Windows', function (string $disposition, ?string $fileName) {
    $download = BinaryDownload::fromResponse(new Response(200, ['Content-Disposition' => $disposition]));

    expect($download->fileName)->toBe($fileName);
})->with([
    'alternate data stream' => ['attachment; filename="invoices.zip:hidden"', 'invoices.zip_hidden'],
    'reserved device name' => ['attachment; filename="CON.zip"', '_CON.zip'],
    'trailing dots and spaces' => ['attachment; filename="invoices.zip. "', 'invoices.zip'],
    'forbidden characters' => ['attachment; filename="a<b>c|d?e*f.zip"', 'a_b_c_d_e_f.zip'],
]);

it('reports a 202 PDF as not ready with its Retry-After', function () {
    $exception = pdfNotReady(new Response(202, ['Retry-After' => '3', 'X-Request-Id' => 'req-1']));

    expect($exception->retryAfter)->toBe(3)
        ->and($exception->requestId)->toBe('req-1')
        ->and($exception)->not->toBeInstanceOf(BeelApiError::class)
        ->and($exception->context())->toBe(['status_code' => 202, 'retry_after' => 3, 'request_id' => 'req-1']);
});

it('reports a 202 PDF without Retry-After with a null delay', function () {
    expect(pdfNotReady(new Response(202))->retryAfter)->toBeNull()
        ->and(pdfNotReady(new Response(202, ['Retry-After' => 'soon']))->retryAfter)->toBeNull();
});
