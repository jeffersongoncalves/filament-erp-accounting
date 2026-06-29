<?php

use JeffersonGoncalves\Erp\Accounting\Enums\AccountType;
use JeffersonGoncalves\Erp\Accounting\Enums\RootType;
use JeffersonGoncalves\Erp\Accounting\Models\Account;
use JeffersonGoncalves\Erp\Accounting\Models\SalesInvoice;
use JeffersonGoncalves\Erp\Core\Models\Company;
use JeffersonGoncalves\FilamentErp\Accounting\Resources\SalesInvoices\Pages\CreateSalesInvoice;
use JeffersonGoncalves\FilamentErp\Accounting\Resources\SalesInvoices\Pages\EditSalesInvoice;
use JeffersonGoncalves\FilamentErp\Accounting\Resources\SalesInvoices\Pages\ListSalesInvoices;
use Livewire\Livewire;

beforeEach(function () {
    filament()->setCurrentPanel(filament()->getPanel('admin'));

    $this->company = Company::factory()->create();
    $this->debitTo = Account::factory()
        ->ofType(RootType::Asset, AccountType::Receivable)
        ->create(['company_id' => $this->company->id]);
});

it('can render the sales invoice list page', function () {
    Livewire::test(ListSalesInvoices::class)->assertSuccessful();
});

it('can render the sales invoice create page', function () {
    Livewire::test(CreateSalesInvoice::class)->assertSuccessful();
});

it('can render the sales invoice edit page', function () {
    $invoice = SalesInvoice::factory()->create([
        'company_id' => $this->company->id,
        'debit_to_id' => $this->debitTo->id,
    ]);

    Livewire::test(EditSalesInvoice::class, ['record' => $invoice->getRouteKey()])
        ->assertSuccessful();
});
