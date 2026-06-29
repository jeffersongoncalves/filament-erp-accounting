<?php

namespace JeffersonGoncalves\FilamentErp\Accounting\Resources\PaymentEntries\Pages;

use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use JeffersonGoncalves\FilamentErp\Accounting\Resources\PaymentEntries\PaymentEntryResource;

class EditPaymentEntry extends EditRecord
{
    protected static string $resource = PaymentEntryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
