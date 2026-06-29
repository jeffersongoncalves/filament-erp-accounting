<?php

namespace JeffersonGoncalves\FilamentErp\Accounting\Resources\CostCenters\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use JeffersonGoncalves\FilamentErp\Accounting\Resources\CostCenters\CostCenterResource;

class ListCostCenters extends ListRecords
{
    protected static string $resource = CostCenterResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
