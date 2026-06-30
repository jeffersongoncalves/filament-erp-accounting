<?php

namespace JeffersonGoncalves\FilamentErp\Accounting\Resources\TaxTemplates\RelationManagers;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Actions;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class TaxesRelationManager extends RelationManager
{
    protected static string $relationship = 'taxes';

    protected static ?string $title = 'Taxes';

    public function form(Form $form): Form
    {
        return $form
            ->columns(2)
            ->schema([
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
            ->actions([
                Actions\EditAction::make(),
                Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Actions\BulkActionGroup::make([
                    Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
