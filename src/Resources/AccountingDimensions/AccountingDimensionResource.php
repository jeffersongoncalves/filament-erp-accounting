<?php

namespace JeffersonGoncalves\FilamentErp\Accounting\Resources\AccountingDimensions;

use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use JeffersonGoncalves\Erp\Accounting\Models\AccountingDimension;
use JeffersonGoncalves\FilamentErp\Accounting\FilamentErpAccountingPlugin;
use JeffersonGoncalves\FilamentErp\Accounting\Resources\AccountingDimensions\Pages\CreateAccountingDimension;
use JeffersonGoncalves\FilamentErp\Accounting\Resources\AccountingDimensions\Pages\EditAccountingDimension;
use JeffersonGoncalves\FilamentErp\Accounting\Resources\AccountingDimensions\Pages\ListAccountingDimensions;
use JeffersonGoncalves\FilamentErp\Accounting\Resources\AccountingDimensions\RelationManagers\ValuesRelationManager;
use JeffersonGoncalves\FilamentErp\Accounting\Resources\AccountingDimensions\Schemas\AccountingDimensionForm;
use JeffersonGoncalves\FilamentErp\Accounting\Resources\AccountingDimensions\Tables\AccountingDimensionsTable;

class AccountingDimensionResource extends Resource
{
    protected static ?string $navigationIcon = 'heroicon-o-squares-2x2';

    protected static ?int $navigationSort = 15;

    protected static ?string $recordTitleAttribute = 'label';

    public static function getModel(): string
    {
        return AccountingDimension::class;
    }

    public static function getNavigationGroup(): ?string
    {
        try {
            return FilamentErpAccountingPlugin::get()->getNavigationGroup();
        } catch (\Throwable) {
            return config('filament-erp-accounting.navigation_group', 'ERP — Accounting');
        }
    }

    public static function form(Form $form): Form
    {
        return AccountingDimensionForm::configure($form);
    }

    public static function table(Table $table): Table
    {
        return AccountingDimensionsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            ValuesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListAccountingDimensions::route('/'),
            'create' => CreateAccountingDimension::route('/create'),
            'edit' => EditAccountingDimension::route('/{record}/edit'),
        ];
    }
}
