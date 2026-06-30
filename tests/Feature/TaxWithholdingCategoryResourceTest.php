<?php

use JeffersonGoncalves\Erp\Accounting\Models\TaxWithholdingCategory;
use JeffersonGoncalves\Erp\Core\Models\Company;
use JeffersonGoncalves\FilamentErp\Accounting\Resources\TaxWithholdingCategories\Pages\CreateTaxWithholdingCategory;
use JeffersonGoncalves\FilamentErp\Accounting\Resources\TaxWithholdingCategories\Pages\EditTaxWithholdingCategory;
use JeffersonGoncalves\FilamentErp\Accounting\Resources\TaxWithholdingCategories\Pages\ListTaxWithholdingCategories;
use JeffersonGoncalves\FilamentErp\Accounting\Resources\TaxWithholdingCategories\RelationManagers\RatesRelationManager;
use JeffersonGoncalves\FilamentErp\Accounting\Tests\Fixtures\NewFeatureMigrations;
use Livewire\Livewire;

beforeEach(function () {
    NewFeatureMigrations::load();

    filament()->setCurrentPanel(filament()->getPanel('admin'));

    $this->company = Company::factory()->create();
});

it('can render the tax withholding category list page', function () {
    Livewire::test(ListTaxWithholdingCategories::class)->assertSuccessful();
});

it('can render the tax withholding category create page', function () {
    Livewire::test(CreateTaxWithholdingCategory::class)->assertSuccessful();
});

it('can create a tax withholding category', function () {
    Livewire::test(CreateTaxWithholdingCategory::class)
        ->fillForm([
            'name' => 'Professional Fees',
            'company_id' => $this->company->id,
        ])
        ->call('create')
        ->assertHasNoFormErrors();

    expect(TaxWithholdingCategory::query()->where('name', 'Professional Fees')->exists())->toBeTrue();
});

it('can render the tax withholding category edit page', function () {
    $category = TaxWithholdingCategory::factory()->create(['company_id' => $this->company->id]);

    Livewire::test(EditTaxWithholdingCategory::class, ['record' => $category->getRouteKey()])
        ->assertSuccessful();
});

it('can render the tax withholding category rates relation manager', function () {
    $category = TaxWithholdingCategory::factory()->create(['company_id' => $this->company->id]);
    $category->rates()->create([
        'from_date' => '2024-01-01',
        'to_date' => '2024-12-31',
        'tax_rate' => 10,
        'single_threshold' => 0,
        'cumulative_threshold' => 0,
    ]);

    Livewire::test(RatesRelationManager::class, [
        'ownerRecord' => $category,
        'pageClass' => EditTaxWithholdingCategory::class,
    ])
        ->assertSuccessful()
        ->assertCanSeeTableRecords($category->rates);
});
