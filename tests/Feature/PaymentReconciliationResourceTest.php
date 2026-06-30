<?php

use JeffersonGoncalves\Erp\Accounting\Enums\AccountType;
use JeffersonGoncalves\Erp\Accounting\Enums\RootType;
use JeffersonGoncalves\Erp\Accounting\Models\Account;
use JeffersonGoncalves\Erp\Accounting\Models\PaymentEntry;
use JeffersonGoncalves\Erp\Accounting\Models\PaymentReconciliation;
use JeffersonGoncalves\Erp\Accounting\Models\SalesInvoice;
use JeffersonGoncalves\Erp\Core\Enums\DocStatus;
use JeffersonGoncalves\Erp\Core\Models\Company;
use JeffersonGoncalves\FilamentErp\Accounting\Resources\PaymentReconciliations\Pages\CreatePaymentReconciliation;
use JeffersonGoncalves\FilamentErp\Accounting\Resources\PaymentReconciliations\Pages\EditPaymentReconciliation;
use JeffersonGoncalves\FilamentErp\Accounting\Resources\PaymentReconciliations\Pages\ListPaymentReconciliations;
use JeffersonGoncalves\FilamentErp\Accounting\Tests\Fixtures\NewFeatureMigrations;
use Livewire\Livewire;

beforeEach(function () {
    NewFeatureMigrations::load();

    filament()->setCurrentPanel(filament()->getPanel('admin'));

    $this->company = Company::factory()->create();
    $this->receivable = Account::factory()
        ->ofType(RootType::Asset, AccountType::Receivable)
        ->create(['company_id' => $this->company->id]);
});

it('can render the payment reconciliation list page', function () {
    Livewire::test(ListPaymentReconciliations::class)->assertSuccessful();
});

it('can create a payment reconciliation', function () {
    Livewire::test(CreatePaymentReconciliation::class)
        ->fillForm([
            'party_type' => 'Customer',
            'receivable_payable_account_id' => $this->receivable->id,
            'company_id' => $this->company->id,
        ])
        ->call('create')
        ->assertHasNoFormErrors();

    expect(PaymentReconciliation::query()->count())->toBe(1);
});

it('can render the payment reconciliation edit page', function () {
    $reconciliation = PaymentReconciliation::factory()->create([
        'company_id' => $this->company->id,
        'receivable_payable_account_id' => $this->receivable->id,
    ]);

    Livewire::test(EditPaymentReconciliation::class, ['record' => $reconciliation->getRouteKey()])
        ->assertSuccessful();
});

it('submits a payment reconciliation and reduces the invoice outstanding amount', function () {
    $invoice = SalesInvoice::factory()->create([
        'company_id' => $this->company->id,
        'debit_to_id' => $this->receivable->id,
    ]);

    SalesInvoice::query()->whereKey($invoice->id)->update(['outstanding_amount' => 500]);

    $reconciliation = PaymentReconciliation::factory()->create([
        'company_id' => $this->company->id,
        'receivable_payable_account_id' => $this->receivable->id,
    ]);

    $paymentEntry = PaymentEntry::factory()->create(['company_id' => $this->company->id]);

    $reconciliation->allocations()->create([
        'payment_entry_id' => $paymentEntry->id,
        'invoice_type' => 'SalesInvoice',
        'invoice_id' => $invoice->id,
        'allocated_amount' => 200,
    ]);

    Livewire::test(ListPaymentReconciliations::class)
        ->callTableAction('submit', $reconciliation);

    expect($reconciliation->refresh()->docstatus)->toBe(DocStatus::Submitted)
        ->and((float) $invoice->refresh()->outstanding_amount)->toBe(300.0);
});
