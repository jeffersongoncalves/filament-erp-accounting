<?php

namespace JeffersonGoncalves\FilamentErp\Accounting\Tests\Fixtures;

use Filament\Panel;
use Filament\PanelProvider;
use JeffersonGoncalves\FilamentErp\Accounting\FilamentErpAccountingPlugin;

class TestPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login()
            ->plugins([
                FilamentErpAccountingPlugin::make(),
            ]);
    }
}
