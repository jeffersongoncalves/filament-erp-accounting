<?php

namespace JeffersonGoncalves\FilamentErp\Accounting\Resources\PaymentEntries\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use JeffersonGoncalves\FilamentErp\Accounting\Resources\PaymentEntries\PaymentEntryResource;

class ListPaymentEntries extends ListRecords
{
    protected static string $resource = PaymentEntryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
