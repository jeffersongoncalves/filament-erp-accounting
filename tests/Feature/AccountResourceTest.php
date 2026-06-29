<?php

use JeffersonGoncalves\Erp\Accounting\Enums\AccountType;
use JeffersonGoncalves\Erp\Accounting\Enums\RootType;
use JeffersonGoncalves\Erp\Accounting\Support\ModelResolver;
use JeffersonGoncalves\FilamentErp\Accounting\Resources\Accounts\Pages\CreateAccount;
use JeffersonGoncalves\FilamentErp\Accounting\Resources\Accounts\Pages\EditAccount;
use JeffersonGoncalves\FilamentErp\Accounting\Resources\Accounts\Pages\ListAccounts;
use Livewire\Livewire;

beforeEach(function () {
    filament()->setCurrentPanel(filament()->getPanel('admin'));
});

it('can render the account list page', function () {
    Livewire::test(ListAccounts::class)->assertSuccessful();
});

it('can list accounts in the table', function () {
    $account = ModelResolver::account()::factory()->create();

    Livewire::test(ListAccounts::class)
        ->assertCanSeeTableRecords([$account]);
});

it('can render the account create page', function () {
    Livewire::test(CreateAccount::class)->assertSuccessful();
});

it('can create an account', function () {
    Livewire::test(CreateAccount::class)
        ->fillForm([
            'name' => 'Cash In Hand',
            'account_number' => '1110',
            'root_type' => RootType::Asset->value,
            'account_type' => AccountType::Cash->value,
            'is_group' => false,
            'disabled' => false,
        ])
        ->call('create')
        ->assertHasNoFormErrors();

    expect(ModelResolver::account()::query()->where('name', 'Cash In Hand')->exists())->toBeTrue();
});

it('can render the account edit page', function () {
    $account = ModelResolver::account()::factory()->create();

    Livewire::test(EditAccount::class, ['record' => $account->getRouteKey()])
        ->assertSuccessful();
});
