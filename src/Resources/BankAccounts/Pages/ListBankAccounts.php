<?php

namespace JeffersonGoncalves\FilamentErp\Accounting\Resources\BankAccounts\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use JeffersonGoncalves\FilamentErp\Accounting\Resources\BankAccounts\BankAccountResource;

class ListBankAccounts extends ListRecords
{
    protected static string $resource = BankAccountResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
