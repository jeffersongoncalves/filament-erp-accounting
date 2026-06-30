<?php

namespace JeffersonGoncalves\FilamentErp\Accounting\Resources\AccountingDimensions\Pages;

use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use JeffersonGoncalves\FilamentErp\Accounting\Resources\AccountingDimensions\AccountingDimensionResource;

class EditAccountingDimension extends EditRecord
{
    protected static string $resource = AccountingDimensionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
