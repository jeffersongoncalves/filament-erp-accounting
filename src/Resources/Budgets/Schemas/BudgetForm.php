<?php

namespace JeffersonGoncalves\FilamentErp\Accounting\Resources\Budgets\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class BudgetForm
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
                        Select::make('fiscal_year_id')
                            ->label('Fiscal Year')
                            ->relationship('fiscalYear', 'name')
                            ->searchable()
                            ->preload()
                            ->nullable(),
                        Select::make('cost_center_id')
                            ->label('Cost Center')
                            ->relationship('costCenter', 'name')
                            ->searchable()
                            ->preload()
                            ->nullable(),
                        Select::make('company_id')
                            ->label('Company')
                            ->relationship('company', 'name')
                            ->searchable()
                            ->preload()
                            ->nullable(),
                    ])->columns(2),
            ]);
    }
}
