<?php

namespace JeffersonGoncalves\FilamentErp\Accounting\Resources\GlEntries\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class GlEntryInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(null)
            ->components([
                Section::make('Ledger Entry')
                    ->schema([
                        TextEntry::make('posting_date')
                            ->label('Date')
                            ->date(),
                        TextEntry::make('account.name')
                            ->label('Account'),
                        TextEntry::make('debit')
                            ->numeric(),
                        TextEntry::make('credit')
                            ->numeric(),
                        TextEntry::make('voucherable_type')
                            ->label('Voucher Type')
                            ->formatStateUsing(fn (?string $state): string => $state === null ? '' : class_basename($state)),
                        TextEntry::make('voucherable_id')
                            ->label('Voucher ID'),
                        TextEntry::make('against_account')
                            ->label('Against Account')
                            ->placeholder('—'),
                        TextEntry::make('party_type')
                            ->label('Party Type')
                            ->placeholder('—'),
                        TextEntry::make('party_id')
                            ->label('Party ID')
                            ->placeholder('—'),
                        TextEntry::make('costCenter.name')
                            ->label('Cost Center')
                            ->placeholder('—'),
                        TextEntry::make('company.name')
                            ->label('Company')
                            ->placeholder('—'),
                        IconEntry::make('is_cancelled')
                            ->label('Cancelled')
                            ->boolean(),
                        TextEntry::make('remarks')
                            ->placeholder('—')
                            ->columnSpanFull(),
                    ])->columns(2),
            ]);
    }
}
