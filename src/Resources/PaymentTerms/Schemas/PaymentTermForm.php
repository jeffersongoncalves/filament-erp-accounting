<?php

namespace JeffersonGoncalves\FilamentErp\Accounting\Resources\PaymentTerms\Schemas;

use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class PaymentTermForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(null)
            ->components([
                Section::make('Details')
                    ->schema([
                        TextInput::make('name')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('due_days')
                            ->label('Due Days')
                            ->numeric()
                            ->integer(),
                        TextInput::make('invoice_portion')
                            ->label('Invoice Portion')
                            ->numeric()
                            ->step(0.01),
                        Textarea::make('description')
                            ->nullable()
                            ->columnSpanFull(),
                    ])->columns(2),
            ]);
    }
}
