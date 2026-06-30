<?php

use JeffersonGoncalves\Erp\Accounting\Enums\AccountType;
use JeffersonGoncalves\Erp\Accounting\Enums\RootType;
use JeffersonGoncalves\Erp\Accounting\Models\Account;
use JeffersonGoncalves\Erp\Accounting\Models\Dunning;
use JeffersonGoncalves\Erp\Accounting\Models\GlEntry;
use JeffersonGoncalves\Erp\Core\Enums\DocStatus;
use JeffersonGoncalves\Erp\Core\Models\Company;
use JeffersonGoncalves\FilamentErp\Accounting\Resources\Dunnings\Pages\CreateDunning;
use JeffersonGoncalves\FilamentErp\Accounting\Resources\Dunnings\Pages\EditDunning;
use JeffersonGoncalves\FilamentErp\Accounting\Resources\Dunnings\Pages\ListDunnings;
use JeffersonGoncalves\FilamentErp\Accounting\Tests\Fixtures\NewFeatureMigrations;
use Livewire\Livewire;

beforeEach(function () {
    NewFeatureMigrations::load();

    filament()->setCurrentPanel(filament()->getPanel('admin'));

    $this->company = Company::factory()->create();
    $this->income = Account::factory()
        ->ofType(RootType::Income, AccountType::Income)
        ->create(['company_id' => $this->company->id]);
    $this->debitTo = Account::factory()
        ->ofType(RootType::Asset, AccountType::Receivable)
        ->create(['company_id' => $this->company->id]);
});

it('can render the dunning list page', function () {
    Livewire::test(ListDunnings::class)->assertSuccessful();
});

it('can render the dunning create page', function () {
    Livewire::test(CreateDunning::class)->assertSuccessful();
});

it('can create a dunning', function () {
    Livewire::test(CreateDunning::class)
        ->fillForm([
            'posting_date' => '2024-01-01',
            'customer_name' => 'ACME Corp',
            'party_type' => 'Customer',
            'dunning_level' => 1,
            'income_account_id' => $this->income->id,
            'debit_to_account_id' => $this->debitTo->id,
        ])
        ->call('create')
        ->assertHasNoFormErrors();

    expect(Dunning::query()->where('customer_name', 'ACME Corp')->exists())->toBeTrue();
});

it('can render the dunning edit page', function () {
    $dunning = Dunning::factory()->create([
        'company_id' => $this->company->id,
        'income_account_id' => $this->income->id,
        'debit_to_account_id' => $this->debitTo->id,
    ]);

    Livewire::test(EditDunning::class, ['record' => $dunning->getRouteKey()])
        ->assertSuccessful();
});

it('submits a dunning with interest through the table action and posts the ledger', function () {
    $dunning = Dunning::factory()->create([
        'company_id' => $this->company->id,
        'income_account_id' => $this->income->id,
        'debit_to_account_id' => $this->debitTo->id,
        'total_interest' => 100,
    ]);

    Livewire::test(ListDunnings::class)
        ->callTableAction('submit', $dunning);

    expect($dunning->refresh()->docstatus)->toBe(DocStatus::Submitted)
        ->and(GlEntry::query()->count())->toBe(2)
        ->and((float) GlEntry::query()->sum('debit'))->toBe(100.0)
        ->and((float) GlEntry::query()->sum('credit'))->toBe(100.0);
});
