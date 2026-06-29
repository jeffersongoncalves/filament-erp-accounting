<?php

namespace JeffersonGoncalves\FilamentErp\Accounting\Resources\GlEntries\Tables;

use Filament\Actions;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class GlEntriesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('posting_date')
                    ->label('Date')
                    ->date()
                    ->sortable(),
                TextColumn::make('account.name')
                    ->label('Account')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('debit')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('credit')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('voucherable_type')
                    ->label('Voucher Type')
                    ->formatStateUsing(fn (?string $state): string => $state === null ? '' : class_basename($state))
                    ->toggleable(),
                TextColumn::make('voucherable_id')
                    ->label('Voucher')
                    ->toggleable(),
                TextColumn::make('party_type')
                    ->label('Party')
                    ->toggleable(isToggledHiddenByDefault: true),
                IconColumn::make('is_cancelled')
                    ->label('Cancelled')
                    ->boolean(),
            ])
            ->defaultSort('posting_date', 'desc')
            ->filters([
                SelectFilter::make('account')
                    ->label('Account')
                    ->relationship('account', 'name')
                    ->searchable()
                    ->preload(),
                SelectFilter::make('company')
                    ->label('Company')
                    ->relationship('company', 'name'),
                TernaryFilter::make('is_cancelled')
                    ->label('Cancelled'),
                Filter::make('posting_date')
                    ->schema([
                        DatePicker::make('from')->label('From'),
                        DatePicker::make('until')->label('Until'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['from'] ?? null,
                                fn (Builder $q, $date): Builder => $q->whereDate('posting_date', '>=', $date),
                            )
                            ->when(
                                $data['until'] ?? null,
                                fn (Builder $q, $date): Builder => $q->whereDate('posting_date', '<=', $date),
                            );
                    }),
            ])
            ->recordActions([
                Actions\ViewAction::make(),
            ]);
    }
}
