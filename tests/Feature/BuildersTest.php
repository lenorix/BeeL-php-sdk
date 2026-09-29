<?php

declare(strict_types=1);

use Lenorix\BeelSdk\Builder\CustomerBuilder;
use Lenorix\BeelSdk\Builder\InvoiceBuilder;

it('uses the Node.js SDK builder messages', function () {
    expect(fn () => InvoiceBuilder::create()->build())->toThrow(LogicException::class, 'Customer ID is required')
        ->and(fn () => InvoiceBuilder::create()->forCustomer('c')->build())->toThrow(LogicException::class, 'At least one invoice line is required')
        ->and(fn () => CustomerBuilder::create()->name('Acme')->nif('B1')->build())->toThrow(LogicException::class, 'Address is required');
});

it('applies a default main tax to lines added with addLine(), unless a line passes its own', function () {
    $request = InvoiceBuilder::create()
        ->forCustomer('customer-1')
        ->mainTax(['type' => 'IVA', 'percentage' => 21, 'regime_key' => '01'])
        ->addLine('Consulting', 1, 100)
        ->addLine('Books', 2, 20, 0, ['type' => 'IVA', 'percentage' => 4, 'regime_key' => '01'])
        ->build();
    $lines = $request->getLines();

    expect($lines[0]->getMainTax()->getPercentage())->toEqual(21)
        ->and($lines[1]->getMainTax()->getPercentage())->toEqual(4)
        ->and(InvoiceBuilder::create()->forCustomer('c')->addLine('No tax', 1, 1)->build()->getLines()[0]->isInitialized('mainTax'))->toBeFalse();
});

it('builds a fresh model on every build() call', function () {
    $builder = InvoiceBuilder::create()->forCustomer('customer-1')->addLine('First', 1, 10);
    $first = $builder->build();
    $builder->addLine('Second', 1, 20);
    $customers = CustomerBuilder::create()->name('Acme')->nif('B1')->address('Calle', '1', '28001', 'Madrid', 'Madrid', 'Spain');
    $customer = $customers->build();
    $customers->name('Other');

    expect($first)->not->toBe($builder->build())
        ->and($first->getLines())->toHaveCount(1)
        ->and($builder->build()->getLines())->toHaveCount(2)
        ->and($customer->getLegalName())->toBe('Acme');
});
