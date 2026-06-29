<?php

namespace JeffersonGoncalves\FilamentErp\Accounting\Resources\JournalEntries\Pages;

use Filament\Resources\Pages\CreateRecord;
use JeffersonGoncalves\FilamentErp\Accounting\Resources\JournalEntries\JournalEntryResource;

class CreateJournalEntry extends CreateRecord
{
    protected static string $resource = JournalEntryResource::class;
}
