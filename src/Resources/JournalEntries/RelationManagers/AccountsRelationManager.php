<?php

namespace JeffersonGoncalves\FilamentErp\Accounting\Resources\JournalEntries\RelationManagers;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Actions;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class AccountsRelationManager extends RelationManager
{
    protected static string $relationship = 'accounts';

    protected static ?string $title = 'Accounts';

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
                Select::make('cost_center_id')
                    ->label('Cost Center')
                    ->relationship('costCenter', 'name')
                    ->searchable()
                    ->nullable(),
                TextInput::make('debit')
                    ->numeric()
                    ->default(0),
                TextInput::make('credit')
                    ->numeric()
                    ->default(0),
                TextInput::make('party_type')
                    ->label('Party Type')
                    ->maxLength(255),
                TextInput::make('party_id')
                    ->label('Party ID')
                    ->numeric(),
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
                TextColumn::make('debit')
                    ->numeric(),
                TextColumn::make('credit')
                    ->numeric(),
                TextColumn::make('costCenter.name')
                    ->label('Cost Center')
                    ->toggleable(),
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
