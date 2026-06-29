<?php

namespace JeffersonGoncalves\FilamentErp\Accounting\Resources\CostCenters;

use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use JeffersonGoncalves\Erp\Accounting\Support\ModelResolver;
use JeffersonGoncalves\FilamentErp\Accounting\FilamentErpAccountingPlugin;
use JeffersonGoncalves\FilamentErp\Accounting\Resources\CostCenters\Pages\CreateCostCenter;
use JeffersonGoncalves\FilamentErp\Accounting\Resources\CostCenters\Pages\EditCostCenter;
use JeffersonGoncalves\FilamentErp\Accounting\Resources\CostCenters\Pages\ListCostCenters;
use JeffersonGoncalves\FilamentErp\Accounting\Resources\CostCenters\Schemas\CostCenterForm;
use JeffersonGoncalves\FilamentErp\Accounting\Resources\CostCenters\Tables\CostCentersTable;

class CostCenterResource extends Resource
{
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-group';

    protected static ?int $navigationSort = 2;

    protected static ?string $recordTitleAttribute = 'name';

    public static function getModel(): string
    {
        return ModelResolver::costCenter();
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
        return CostCenterForm::configure($form);
    }

    public static function table(Table $table): Table
    {
        return CostCentersTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListCostCenters::route('/'),
            'create' => CreateCostCenter::route('/create'),
            'edit' => EditCostCenter::route('/{record}/edit'),
        ];
    }
}
