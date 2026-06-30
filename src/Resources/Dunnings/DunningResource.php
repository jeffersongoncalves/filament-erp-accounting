<?php

namespace JeffersonGoncalves\FilamentErp\Accounting\Resources\Dunnings;

use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use JeffersonGoncalves\Erp\Accounting\Models\Dunning;
use JeffersonGoncalves\FilamentErp\Accounting\FilamentErpAccountingPlugin;
use JeffersonGoncalves\FilamentErp\Accounting\Resources\Dunnings\Pages\CreateDunning;
use JeffersonGoncalves\FilamentErp\Accounting\Resources\Dunnings\Pages\EditDunning;
use JeffersonGoncalves\FilamentErp\Accounting\Resources\Dunnings\Pages\ListDunnings;
use JeffersonGoncalves\FilamentErp\Accounting\Resources\Dunnings\RelationManagers\OverdueInvoicesRelationManager;
use JeffersonGoncalves\FilamentErp\Accounting\Resources\Dunnings\Schemas\DunningForm;
use JeffersonGoncalves\FilamentErp\Accounting\Resources\Dunnings\Tables\DunningsTable;

class DunningResource extends Resource
{
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBellAlert;

    protected static ?int $navigationSort = 17;

    protected static ?string $recordTitleAttribute = 'customer_name';

    public static function getModel(): string
    {
        return Dunning::class;
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
        return DunningForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return DunningsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            OverdueInvoicesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListDunnings::route('/'),
            'create' => CreateDunning::route('/create'),
            'edit' => EditDunning::route('/{record}/edit'),
        ];
    }
}
