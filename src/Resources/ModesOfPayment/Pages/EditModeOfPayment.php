<?php

namespace JeffersonGoncalves\FilamentErp\Accounting\Resources\ModesOfPayment\Pages;

use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use JeffersonGoncalves\FilamentErp\Accounting\Resources\ModesOfPayment\ModeOfPaymentResource;

class EditModeOfPayment extends EditRecord
{
    protected static string $resource = ModeOfPaymentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
