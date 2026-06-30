<?php

namespace JeffersonGoncalves\FilamentErp\Accounting\Resources\Dunnings\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use JeffersonGoncalves\FilamentErp\Accounting\Resources\Dunnings\DunningResource;

class ListDunnings extends ListRecords
{
    protected static string $resource = DunningResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
