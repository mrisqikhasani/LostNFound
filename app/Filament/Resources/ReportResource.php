<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ReportResource\Pages;
use App\Filament\Resources\ReportResource\RelationManagers;
use App\Models\Report;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\{TextColumn, BadgeColumn, ImageColumn};
use Filament\Forms\Components\{TextInput, Select, DateTimePicker, Textarea, FileUpload};
use Filament\Forms\Actions\{EditAction, DeleteAction};
use Filament\Tables\Filters\TabsFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Infolists\Components\Tabs;
use Filament\Support\Colors\Color;
use Filament\Support\Facades\FilamentColor;

FilamentColor::register([
    'danger' => Color::Red,
    'gray' => Color::Zinc,
    'info' => Color::Blue,
    'primary' => Color::Amber,
    'success' => Color::Green,
    'warning' => Color::Amber,
    'purple' => Color::Purple,
    'yellow' => Color::Yellow,
]);

class ReportResource extends Resource
{
    protected static ?string $model = Report::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-magnifying-glass';
    protected static ?string $navigationLabel = 'Laporan Barang';
    protected static ?string $modelLabel = 'Laporan';
    public static function form(Form $form): Form
    {
        return $form->schema([
            Select::make('user_id')
                ->relationship('user', 'name')
                ->searchable()
                ->label('Pelapor')
                ->required(),


            Select::make('region_kampus')
                ->options([
                    'Depok' => 'Depok',
                    'Kalimalang' => 'Kalimalang',
                    'Karawaci' => 'Karawaci',
                    'Cengkareng' => 'Cengkareng',
                    'Salemba' => 'Salemba',
                ])
                ->required(),

            TextInput::make('nama_barang_temuan')->label('Nama Barang')->required(),

            TextInput::make('lokasi_temuan')->label('Lokasi Temuan')->required(),

            Textarea::make('deskripsi_umum')->label('Deskripsi Umum')->required(),

            Textarea::make('deskripsi_khusus')->label('Deskripsi Rahasia')->required(),

            DateTimePicker::make('waktu_temuan')->label('Waktu Temuan Barang')->required(),

            Select::make('status')
                ->options([
                    'menunggu' => 'Menunggu',
                    'disetujui' => 'Disetujui',
                    'ditolak' => 'Ditolak',
                    'diklaim' => 'Diklaim',
                ])
                ->default('menunggu')
                ->label('Status')
                ->required(),

            Textarea::make('approve_reject_reason')
                ->label('Alasan Disetujui / Ditolak')
                ->required(fn ($get) => in_array($get('status'), ['Disetujui', 'Ditolak'])),

            FileUpload::make('foto_url')
                ->label('Foto Barang')
                ->directory('reports')
                ->image()
                ->multiple()
                ->imageEditor() // Opsional: untuk crop dll
                ->required()
                ->preserveFilenames()
                ->reorderable()
                ->downloadable()
                ->openable()
                ->columnSpanFull()
                ->getUploadedFileNameForStorageUsing(function ($file, $record) {
                    // Optionally customize file naming here
                    return $file->getClientOriginalName();
                })
                ->default(fn($record) => $record?->foto_url ?? [])
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                TextColumn::make('id')->sortable(),
                TextColumn::make('user.name')->label('Pelapor')->searchable(),
                TextColumn::make('nama_barang_temuan')->label('Nama Barang')->searchable(),

                ImageColumn::make('foto_url.0')
                    ->label('Foto')
                    ->getStateUsing(fn($record) => isset($record->foto_url[0]) ? asset('storage/' . $record->foto_url[0]) : null),


                TextColumn::make('waktu_temuan')->label('Waktu Temuan')
                    ->date('j F Y, G:i')
                    ->sortable(),
                TextColumn::make('region_kampus')->label('Region Kampus')->searchable(),
                TextColumn::make('lokasi_temuan')->label('Lokasi temuan'),
                TextColumn::make('status')
                    ->label('Status Lapor')
                    ->badge()
                    ->colors([
                        'yellow' => 'Menunggu',
                        'success' => 'Diklaim',
                        'danger' => 'Ditolak',
                        'purple' => 'Disetujui',
                    ]),

            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'menunggu' => 'Menunggu',
                        'disetujui' => 'Disetujui',
                        'ditolak' => 'Ditolak',
                        'diklaim' => 'Diklaim',
                    ]),
                Tables\Filters\SelectFilter::make('region_kampus')
                    ->options([
                        'Depok' => 'Depok',
                        'Kalimalang' => 'Kalimalang',
                        'Karawaci' => 'Karawaci',
                        'Cengkareng' => 'Cengkareng',
                        'Salemba' => 'Salemba',
                    ]),

            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListReports::route('/'),
            'create' => Pages\CreateReport::route('/create'),
            'edit' => Pages\EditReport::route('/{record}/edit'),
        ];
    }
}
