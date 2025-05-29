<?php

namespace App\Filament\Widgets;

use App\Models\Claim;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Widgets\TableWidget as BaseWidget;

class KlaimBarang extends BaseWidget
{

    protected static ?int $sort = 2;


    public function table(Table $table): Table
    {
        return $table
            ->query(
                Claim::query()->where('status_klaim', 'Diproses')
            )
            ->columns([
                // ...
                TextColumn::make('report.nama_barang_temuan')->label('Nama barang'),
                // TextColumn::make('status_klaim'),
                TextColumn::make('status_klaim')
                ->badge(),

                TextColumn::make('created_at')
                    ->label('Tanggal Klaim')
                    ->date('j F Y'),
            ])
            ->actions([
                Tables\Actions\Action::make('edit')
                    ->label('Edit')
                    ->url(fn($record): string => route('filament.admin.resources.reports.edit', $record))
                    ->icon('heroicon-o-pencil-square')
            ]);
    }
}