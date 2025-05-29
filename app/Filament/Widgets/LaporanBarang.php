<?php

namespace App\Filament\Widgets;

use App\Models\Report;
use Filament\Widgets\TableWidget as BaseWidget;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Actions\Action;

class LaporanBarang extends BaseWidget
{

    protected static ?int $sort = 2;

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Report::query()->where('status', 'menunggu')
            )
            ->columns([

                TextColumn::make('nama_barang_temuan')->label('Nama Barang'),
                TextColumn::make('status')->badge(  ),
                TextColumn::make('created_at')->label('Tanggal Request')->date('j F Y'),
            ])
            ->actions([
                Tables\Actions\Action::make('edit')
                    ->label('Edit')
                    ->url(fn($record): string => route('filament.admin.resources.reports.edit', $record))
                    ->icon('heroicon-o-pencil-square')
            ]);
    }
}