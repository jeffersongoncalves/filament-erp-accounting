<?php

use JeffersonGoncalves\FilamentErp\Accounting\Resources\GlEntries\GlEntryResource;
use JeffersonGoncalves\FilamentErp\Accounting\Resources\GlEntries\Pages\ListGlEntries;
use Livewire\Livewire;

beforeEach(function () {
    filament()->setCurrentPanel(filament()->getPanel('admin'));
});

it('can render the general ledger list page', function () {
    Livewire::test(ListGlEntries::class)->assertSuccessful();
});

it('is a read-only resource without create or edit capability', function () {
    expect(GlEntryResource::canCreate())->toBeFalse()
        ->and(GlEntryResource::getPages())->toHaveKeys(['index', 'view'])
        ->and(GlEntryResource::getPages())->not->toHaveKey('create');
});
