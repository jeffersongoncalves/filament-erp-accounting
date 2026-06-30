<?php

namespace JeffersonGoncalves\FilamentErp\Accounting\Resources\AccountingDimensions\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class AccountingDimensionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(null)
            ->components([
                Section::make('Details')
                    ->schema([
                        TextInput::make('label')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('reference_document')
                            ->label('Reference Document')
                            ->required()
                            ->maxLength(255),
                        Toggle::make('is_mandatory')
                            ->label('Is Mandatory')
                            ->default(false),
                        Toggle::make('disabled')
                            ->label('Disabled')
                            ->default(false),
                    ])->columns(2),
            ]);
    }
}
