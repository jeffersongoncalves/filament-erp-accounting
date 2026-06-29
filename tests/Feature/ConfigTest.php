<?php

it('loads the filament-erp-accounting config file', function () {
    expect(config('filament-erp-accounting'))->toBeArray();
});

it('has a default navigation group', function () {
    expect(config('filament-erp-accounting.navigation_group'))->toBe('ERP — Accounting');
});

it('registers all resources in config', function () {
    $resources = config('filament-erp-accounting.resources');

    expect($resources)->toBeArray()
        ->toHaveKeys([
            'account',
            'cost_center',
            'payment_term',
            'mode_of_payment',
            'tax_template',
            'bank',
            'bank_account',
            'budget',
            'journal_entry',
            'payment_entry',
            'sales_invoice',
            'purchase_invoice',
            'gl_entry',
        ]);
});

it('registers the dashboard widgets in config', function () {
    expect(config('filament-erp-accounting.widgets'))->toBeArray()
        ->toHaveKeys(['receivables', 'payables', 'cash_bank_balance']);
});
