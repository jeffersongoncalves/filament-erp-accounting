<?php

namespace JeffersonGoncalves\FilamentErp\Accounting\Resources\ModesOfPayment\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use JeffersonGoncalves\FilamentErp\Accounting\Resources\ModesOfPayment\ModeOfPaymentResource;

class ListModesOfPayment extends ListRecords
{
    protected static string $resource = ModeOfPaymentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
