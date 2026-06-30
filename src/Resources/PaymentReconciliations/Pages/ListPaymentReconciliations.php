<?php

namespace JeffersonGoncalves\FilamentErp\Accounting\Resources\PaymentReconciliations\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use JeffersonGoncalves\FilamentErp\Accounting\Resources\PaymentReconciliations\PaymentReconciliationResource;

class ListPaymentReconciliations extends ListRecords
{
    protected static string $resource = PaymentReconciliationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
