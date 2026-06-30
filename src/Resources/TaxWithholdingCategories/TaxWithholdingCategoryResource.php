<?php

namespace JeffersonGoncalves\FilamentErp\Accounting\Resources\TaxWithholdingCategories;

use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use JeffersonGoncalves\Erp\Accounting\Models\TaxWithholdingCategory;
use JeffersonGoncalves\FilamentErp\Accounting\FilamentErpAccountingPlugin;
use JeffersonGoncalves\FilamentErp\Accounting\Resources\TaxWithholdingCategories\Pages\CreateTaxWithholdingCategory;
use JeffersonGoncalves\FilamentErp\Accounting\Resources\TaxWithholdingCategories\Pages\EditTaxWithholdingCategory;
use JeffersonGoncalves\FilamentErp\Accounting\Resources\TaxWithholdingCategories\Pages\ListTaxWithholdingCategories;
use JeffersonGoncalves\FilamentErp\Accounting\Resources\TaxWithholdingCategories\RelationManagers\RatesRelationManager;
use JeffersonGoncalves\FilamentErp\Accounting\Resources\TaxWithholdingCategories\Schemas\TaxWithholdingCategoryForm;
use JeffersonGoncalves\FilamentErp\Accounting\Resources\TaxWithholdingCategories\Tables\TaxWithholdingCategoriesTable;

class TaxWithholdingCategoryResource extends Resource
{
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedReceiptPercent;

    protected static ?int $navigationSort = 14;

    protected static ?string $recordTitleAttribute = 'name';

    public static function getModel(): string
    {
        return TaxWithholdingCategory::class;
    }

    public static function getNavigationGroup(): ?string
    {
        try {
            return FilamentErpAccountingPlugin::get()->getNavigationGroup();
        } catch (\Throwable) {
            return config('filament-erp-accounting.navigation_group', 'ERP — Accounting');
        }
    }

    public static function form(Schema $schema): Schema
    {
        return TaxWithholdingCategoryForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return TaxWithholdingCategoriesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            RatesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListTaxWithholdingCategories::route('/'),
            'create' => CreateTaxWithholdingCategory::route('/create'),
            'edit' => EditTaxWithholdingCategory::route('/{record}/edit'),
        ];
    }
}
