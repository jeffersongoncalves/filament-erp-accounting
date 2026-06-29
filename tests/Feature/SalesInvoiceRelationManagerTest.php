<?php

use JeffersonGoncalves\Erp\Accounting\Enums\AccountType;
use JeffersonGoncalves\Erp\Accounting\Enums\RootType;
use JeffersonGoncalves\Erp\Accounting\Models\Account;
use JeffersonGoncalves\Erp\Accounting\Models\SalesInvoice;
use JeffersonGoncalves\Erp\Core\Models\Company;
use JeffersonGoncalves\FilamentErp\Accounting\Resources\SalesInvoices\Pages\EditSalesInvoice;
use JeffersonGoncalves\FilamentErp\Accounting\Resources\SalesInvoices\RelationManagers\ItemsRelationManager;
use Livewire\Livewire;

beforeEach(function () {
    filament()->setCurrentPanel(filament()->getPanel('admin'));

    $this->company = Company::factory()->create();
    $this->debitTo = Account::factory()
        ->ofType(RootType::Asset, AccountType::Receivable)
        ->create(['company_id' => $this->company->id]);
    $this->income = Account::factory()
        ->ofType(RootType::Income, AccountType::Income)
        ->create(['company_id' => $this->company->id]);

    $this->invoice = SalesInvoice::factory()->create([
        'company_id' => $this->company->id,
        'debit_to_id' => $this->debitTo->id,
    ]);
});

it('can render the sales invoice items relation manager', function () {
    $this->invoice->items()->create([
        'item_code' => 'WIDGET',
        'item_name' => 'Widget',
        'qty' => 2,
        'rate' => 50,
        'income_account_id' => $this->income->id,
    ]);

    Livewire::test(ItemsRelationManager::class, [
        'ownerRecord' => $this->invoice,
        'pageClass' => EditSalesInvoice::class,
    ])
        ->assertSuccessful()
        ->assertCanSeeTableRecords($this->invoice->items);
});
