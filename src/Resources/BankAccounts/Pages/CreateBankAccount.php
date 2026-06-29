<?php

namespace JeffersonGoncalves\FilamentErp\Accounting\Resources\BankAccounts\Pages;

use Filament\Resources\Pages\CreateRecord;
use JeffersonGoncalves\FilamentErp\Accounting\Resources\BankAccounts\BankAccountResource;

class CreateBankAccount extends CreateRecord
{
    protected static string $resource = BankAccountResource::class;
}
