<?php

namespace JeffersonGoncalves\FilamentErp\Accounting\Resources\ModesOfPayment\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ModeOfPaymentForm
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
                        Select::make('type')
                            ->options([
                                'Cash' => 'Cash',
                                'Bank' => 'Bank',
                                'General' => 'General',
                            ])
                            ->required(),
                        Select::make('default_account_id')
                            ->label('Default Account')
                            ->relationship('defaultAccount', 'name')
                            ->searchable()
                            ->preload()
                            ->nullable(),
                    ])->columns(2),
            ]);
    }
}
