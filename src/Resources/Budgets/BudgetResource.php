<?php

namespace JeffersonGoncalves\FilamentErp\Accounting\Resources\Budgets;

use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use JeffersonGoncalves\Erp\Accounting\Support\ModelResolver;
use JeffersonGoncalves\FilamentErp\Accounting\FilamentErpAccountingPlugin;
use JeffersonGoncalves\FilamentErp\Accounting\Resources\Budgets\Pages\CreateBudget;
use JeffersonGoncalves\FilamentErp\Accounting\Resources\Budgets\Pages\EditBudget;
use JeffersonGoncalves\FilamentErp\Accounting\Resources\Budgets\Pages\ListBudgets;
use JeffersonGoncalves\FilamentErp\Accounting\Resources\Budgets\RelationManagers\BudgetAccountsRelationManager;
use JeffersonGoncalves\FilamentErp\Accounting\Resources\Budgets\Schemas\BudgetForm;
use JeffersonGoncalves\FilamentErp\Accounting\Resources\Budgets\Tables\BudgetsTable;

class BudgetResource extends Resource
{
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedChartPie;

    protected static ?int $navigationSort = 8;

    protected static ?string $recordTitleAttribute = 'name';

    public static function getModel(): string
    {
        return ModelResolver::budget();
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
        return BudgetForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return BudgetsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            BudgetAccountsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListBudgets::route('/'),
            'create' => CreateBudget::route('/create'),
            'edit' => EditBudget::route('/{record}/edit'),
        ];
    }
}
