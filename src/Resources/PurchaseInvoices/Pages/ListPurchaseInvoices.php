<?php

namespace JeffersonGoncalves\FilamentErp\Accounting\Resources\PurchaseInvoices\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use JeffersonGoncalves\FilamentErp\Accounting\Resources\PurchaseInvoices\PurchaseInvoiceResource;

class ListPurchaseInvoices extends ListRecords
{
    protected static string $resource = PurchaseInvoiceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
