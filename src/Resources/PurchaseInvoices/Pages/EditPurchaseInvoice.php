<?php

namespace JeffersonGoncalves\FilamentErp\Accounting\Resources\PurchaseInvoices\Pages;

use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use JeffersonGoncalves\FilamentErp\Accounting\Resources\PurchaseInvoices\PurchaseInvoiceResource;

class EditPurchaseInvoice extends EditRecord
{
    protected static string $resource = PurchaseInvoiceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
