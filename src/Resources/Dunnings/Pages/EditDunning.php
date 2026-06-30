<?php

namespace JeffersonGoncalves\FilamentErp\Accounting\Resources\Dunnings\Pages;

use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use JeffersonGoncalves\FilamentErp\Accounting\Resources\Dunnings\DunningResource;

class EditDunning extends EditRecord
{
    protected static string $resource = DunningResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
