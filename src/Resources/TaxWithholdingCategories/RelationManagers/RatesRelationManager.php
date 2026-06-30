<?php

namespace JeffersonGoncalves\FilamentErp\Accounting\Resources\TaxWithholdingCategories\RelationManagers;

use Filament\Actions;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class RatesRelationManager extends RelationManager
{
    protected static string $relationship = 'rates';

    protected static ?string $title = 'Rates';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->columns(2)
            ->components([
                DatePicker::make('from_date')
                    ->label('From Date')
                    ->required(),
                DatePicker::make('to_date')
                    ->label('To Date')
                    ->nullable(),
                TextInput::make('tax_rate')
                    ->label('Tax Rate')
                    ->numeric()
                    ->required()
                    ->default(0),
                TextInput::make('single_threshold')
                    ->label('Single Threshold')
                    ->numeric()
                    ->default(0),
                TextInput::make('cumulative_threshold')
                    ->label('Cumulative Threshold')
                    ->numeric()
                    ->default(0),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('from_date')
            ->columns([
                TextColumn::make('from_date')
                    ->label('From Date')
                    ->date()
                    ->sortable(),
                TextColumn::make('to_date')
                    ->label('To Date')
                    ->date()
                    ->toggleable(),
                TextColumn::make('tax_rate')
                    ->label('Tax Rate')
                    ->numeric(),
                TextColumn::make('single_threshold')
                    ->label('Single Threshold')
                    ->numeric()
                    ->toggleable(),
                TextColumn::make('cumulative_threshold')
                    ->label('Cumulative Threshold')
                    ->numeric()
                    ->toggleable(),
            ])
            ->headerActions([
                Actions\CreateAction::make(),
            ])
            ->recordActions([
                Actions\EditAction::make(),
                Actions\DeleteAction::make(),
            ])
            ->toolbarActions([
                Actions\BulkActionGroup::make([
                    Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
