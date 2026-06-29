<?php

namespace JeffersonGoncalves\FilamentErp\Accounting\Concerns;

use JeffersonGoncalves\FilamentErp\Core\Concerns\HasErpPluginConfig;

trait HasErpAccountingPluginConfig
{
    use HasErpPluginConfig;

    protected function getConfigKey(): string
    {
        return 'filament-erp-accounting';
    }

    protected function getDefaultNavigationGroup(): string
    {
        return 'ERP — Accounting';
    }
}
