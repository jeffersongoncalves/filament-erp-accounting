<?php

namespace JeffersonGoncalves\FilamentErp\Accounting\Resources\Accounts\Tables;

use Filament\Tables\Actions;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use JeffersonGoncalves\Erp\Accounting\Enums\AccountType;
use JeffersonGoncalves\Erp\Accounting\Enums\RootType;

class AccountsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('account_number')
                    ->label('Number')
                    ->searchable()
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('root_type')
                    ->label('Root Type')
                    ->badge()
                    ->sortable(),
                TextColumn::make('account_type')
                    ->label('Account Type')
                    ->badge()
                    ->toggleable(),
                IconColumn::make('is_group')
                    ->label('Group')
                    ->boolean()
                    ->sortable(),
                TextColumn::make('company.name')
                    ->label('Company')
                    ->toggleable()
                    ->sortable(),
                IconColumn::make('disabled')
                    ->label('Disabled')
                    ->boolean()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('account_number')
            ->filters([
                SelectFilter::make('root_type')
                    ->label('Root Type')
                    ->options(self::rootTypeOptions()),
                SelectFilter::make('account_type')
                    ->label('Account Type')
                    ->options(self::accountTypeOptions()),
                SelectFilter::make('company')
                    ->label('Company')
                    ->relationship('company', 'name'),
                TernaryFilter::make('is_group')
                    ->label('Is Group'),
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

    /** @return array<string, string> */
    protected static function rootTypeOptions(): array
    {
        $options = [];

        foreach (RootType::cases() as $case) {
            $options[$case->value] = $case->label();
        }

        return $options;
    }

    /** @return array<string, string> */
    protected static function accountTypeOptions(): array
    {
        $options = [];

        foreach (AccountType::cases() as $case) {
            $options[$case->value] = $case->label();
        }

        return $options;
    }
}
