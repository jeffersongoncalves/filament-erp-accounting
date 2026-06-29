<?php

namespace JeffersonGoncalves\FilamentErp\Accounting\Resources\GlEntries\Pages;

use Filament\Resources\Pages\ListRecords;
use JeffersonGoncalves\FilamentErp\Accounting\Resources\GlEntries\GlEntryResource;

class ListGlEntries extends ListRecords
{
    protected static string $resource = GlEntryResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }
}
