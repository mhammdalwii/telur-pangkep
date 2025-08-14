<?php

namespace App\Filament\Peternak\Resources;

use App\Filament\Peternak\Resources\PermintaanResource\Pages;
use App\Filament\Peternak\Resources\PermintaanResource\RelationManagers;
use App\Models\Panen;
use App\Models\Permintaan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PermintaanResource extends Resource
{
    protected static ?string $model = Panen::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Permintaan';
    protected static ?string $pluralModelLabel = 'Riwayat Permintaan';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form->schema([]);
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->where('user_id', auth()->id())
            ->where('status', 'Telah Diambil');
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('batch_code')->label('Kode Batch'),
                // Menampilkan nama distributor melalui relasi yang baru dibuat
                Tables\Columns\TextColumn::make('distributor.name')->label('Diambil oleh Distributor'),
                Tables\Columns\TextColumn::make('jumlah_ayam')->label('Jumlah')->suffix(' ekor'),
                Tables\Columns\TextColumn::make('updated_at')->label('Tanggal Diambil')->date('d M Y'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListPermintaans::route('/'),
        ];
    }

    public static function canCreate(): bool
    {
        return false;
    }
}
