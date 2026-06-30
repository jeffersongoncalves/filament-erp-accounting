<?php

use JeffersonGoncalves\Erp\Accounting\Models\AccountingDimension;
use JeffersonGoncalves\FilamentErp\Accounting\Resources\AccountingDimensions\Pages\CreateAccountingDimension;
use JeffersonGoncalves\FilamentErp\Accounting\Resources\AccountingDimensions\Pages\EditAccountingDimension;
use JeffersonGoncalves\FilamentErp\Accounting\Resources\AccountingDimensions\Pages\ListAccountingDimensions;
use JeffersonGoncalves\FilamentErp\Accounting\Resources\AccountingDimensions\RelationManagers\ValuesRelationManager;
use JeffersonGoncalves\FilamentErp\Accounting\Tests\Fixtures\NewFeatureMigrations;
use Livewire\Livewire;

beforeEach(function () {
    NewFeatureMigrations::load();

    filament()->setCurrentPanel(filament()->getPanel('admin'));
});

it('can render the accounting dimension list page', function () {
    Livewire::test(ListAccountingDimensions::class)->assertSuccessful();
});

it('can create an accounting dimension', function () {
    Livewire::test(CreateAccountingDimension::class)
        ->fillForm([
            'label' => 'Project',
            'reference_document' => 'Project',
            'is_mandatory' => false,
            'disabled' => false,
        ])
        ->call('create')
        ->assertHasNoFormErrors();

    expect(AccountingDimension::query()->where('label', 'Project')->exists())->toBeTrue();
});

it('can render the accounting dimension edit page', function () {
    $dimension = AccountingDimension::factory()->create();

    Livewire::test(EditAccountingDimension::class, ['record' => $dimension->getRouteKey()])
        ->assertSuccessful();
});

it('can render the accounting dimension values relation manager', function () {
    $dimension = AccountingDimension::factory()->create();
    $dimension->values()->create([
        'value' => 'Internal',
        'description' => 'Internal project',
    ]);

    Livewire::test(ValuesRelationManager::class, [
        'ownerRecord' => $dimension,
        'pageClass' => EditAccountingDimension::class,
    ])
        ->assertSuccessful()
        ->assertCanSeeTableRecords($dimension->values);
});
