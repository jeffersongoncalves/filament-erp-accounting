<?php

namespace JeffersonGoncalves\FilamentErp\Accounting\Resources\JournalEntries\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use JeffersonGoncalves\FilamentErp\Accounting\Resources\JournalEntries\JournalEntryResource;

class ListJournalEntries extends ListRecords
{
    protected static string $resource = JournalEntryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
