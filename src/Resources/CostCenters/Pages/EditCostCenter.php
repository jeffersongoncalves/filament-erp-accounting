<?php

namespace JeffersonGoncalves\FilamentErp\Accounting\Resources\CostCenters\Pages;

use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use JeffersonGoncalves\FilamentErp\Accounting\Resources\CostCenters\CostCenterResource;

class EditCostCenter extends EditRecord
{
    protected static string $resource = CostCenterResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
