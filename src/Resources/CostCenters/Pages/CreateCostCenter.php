<?php

namespace JeffersonGoncalves\FilamentErp\Accounting\Resources\CostCenters\Pages;

use Filament\Resources\Pages\CreateRecord;
use JeffersonGoncalves\FilamentErp\Accounting\Resources\CostCenters\CostCenterResource;

class CreateCostCenter extends CreateRecord
{
    protected static string $resource = CostCenterResource::class;
}
