<?php

namespace JeffersonGoncalves\FilamentErp\Accounting\Resources\AccountingDimensions\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use JeffersonGoncalves\FilamentErp\Accounting\Resources\AccountingDimensions\AccountingDimensionResource;

class ListAccountingDimensions extends ListRecords
{
    protected static string $resource = AccountingDimensionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
