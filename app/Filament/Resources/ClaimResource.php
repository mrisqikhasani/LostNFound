<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ClaimResource\Pages;
use App\Filament\Resources\ClaimResource\RelationManagers;
use App\Models\Claim;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\{Select, Textarea, DatePicker};
use Filament\Tables\Columns\{TextColumn, BadgeColumn, Image};
use Filament\Tables\Actions\{EditAction, DeleteAction};

class ClaimResource extends Resource
{
    protected static ?string $model = Claim::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Klaim Barang';
    // protected static ?string $navigationGroup = 'Manajemen Lost And Found';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
            Select::make('user_id')
            ->relationship('user', 'name')
            ->label('Pemilik (Pengklaim)')
            ->required()
            ->searchable(),

            Select::make('report_id')
            ->relationship('report', 'nama_barang_temuan')
            ->label('Barang yang Diklaim')
            ->required()
            ->searchable(),

            Textarea::make('deskripsi_verifikasi')
            ->label('Deskripsi Verifikasi')
            ->required(),

        Select::make('status_klaim')
            ->options([
                'diproses' => 'Diproses',
                'disetujui' => 'Disetujui',
                'ditolak' => 'Ditolak',
            ])
            ->default('diproses')
            ->label('Status Klaim')
            ->required(),

        DatePicker::make('tanggal_klaim')->label('Tanggal Klaim')->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                TextColumn::make('id')->sortable(),
                TextColumn::make('user.name')->label('Pengklaim')->searchable(),
                TextColumn::make('report.nama_barang_temuan')->label('Barang')->searchable(),
                TextColumn::make('deskripsi_verifikasi')->label('Verifikasi')->limit(30),
                BadgeColumn::make('status_klaim')
                    ->colors([
                        'primary' => 'diproses',
                        'success' => 'disetujui',
                        'danger' => 'ditolak',
                    ]),
                TextColumn::make('tanggal_klaim')->date('d M Y')->label('Tanggal'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status_klaim')
                    ->options([
                        'diproses' => 'Diproses',
                        'disetujui' => 'Disetujui',
                        'ditolak' => 'Ditolak',
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
            'index' => Pages\ListClaims::route('/'),
            'create' => Pages\CreateClaim::route('/create'),
            'edit' => Pages\EditClaim::route('/{record}/edit'),
        ];
    }
}
