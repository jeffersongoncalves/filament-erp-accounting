<?php

namespace JeffersonGoncalves\FilamentErp\Accounting;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class FilamentErpAccountingServiceProvider extends PackageServiceProvider
{
    public static string $name = 'filament-erp-accounting';

    public function configurePackage(Package $package): void
    {
        $package
            ->name(static::$name)
            ->hasConfigFile()
            ->hasTranslations();
    }
}
