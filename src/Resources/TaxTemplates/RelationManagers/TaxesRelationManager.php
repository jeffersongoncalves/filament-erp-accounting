<?php

namespace JeffersonGoncalves\FilamentErp\Accounting\Resources\TaxTemplates\RelationManagers;

use Filament\Actions;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class TaxesRelationManager extends RelationManager
{
    protected static string $relationship = 'taxes';

    protected static ?string $title = 'Taxes';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->columns(2)
            ->components([
                Select::make('account_id')
                    ->label('Account')
                    ->relationship('account', 'name')
                    ->searchable()
                    ->required(),
                TextInput::make('rate')
                    ->label('Rate (%)')
                    ->numeric(),
                Select::make('charge_type')
                    ->label('Charge Type')
                    ->options([
                        'On Net Total' => 'On Net Total',
                        'On Previous Row Amount' => 'On Previous Row Amount',
                        'Actual' => 'Actual',
                    ]),
                TextInput::make('description')
                    ->maxLength(255)
                    ->nullable(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('account_id')
            ->columns([
                TextColumn::make('account.name')
                    ->label('Account')
                    ->searchable(),
                TextColumn::make('rate')
                    ->label('Rate (%)'),
                TextColumn::make('charge_type')
                    ->label('Charge Type')
                    ->badge(),
                TextColumn::make('description'),
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
