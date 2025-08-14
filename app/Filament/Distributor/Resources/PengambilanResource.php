<?php

namespace App\Filament\Distributor\Resources;

use App\Filament\Distributor\Resources\PengambilanResource\Pages;
use App\Filament\Distributor\Resources\PengambilanResource\RelationManagers;
use App\Models\Panen;
use App\Models\Pengambilan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Collection;
use Filament\Notifications\Notification;
use App\Models\Inventory;

class PengambilanResource extends Resource
{
    protected static ?string $model = Panen::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Pengambilan';
    protected static ?string $modelLabel = 'Stok dari Peternak';
    protected static ?string $pluralModelLabel = 'Pengambilan';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('status', 'Siap Kirim');
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('batch_code')
                    ->label('Kode Batch'),
                // Kita akan menampilkan nama Peternak melalui relasi 'user'
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Peternak'),
                Tables\Columns\TextColumn::make('jumlah_ayam')
                    ->label('Jumlah')
                    ->suffix(' ekor'),
                Tables\Columns\TextColumn::make('tanggal_panen')
                    ->label('Tgl Panen')
                    ->date('d-m-Y'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkAction::make('konfirmasi_pengambilan')
                    ->label('Konfirmasi Pengambilan')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->requiresConfirmation()
                    ->action(function (Collection $records) {
                        foreach ($records as $panen) {
                            // [LANGKAH A] Buat catatan baru di tabel inventaris
                            Inventory::create([
                                'panen_id' => $panen->id,
                                'batch_code' => $panen->batch_code,
                                'distributor_id' => auth()->id(),
                                'peternak_id' => $panen->user_id,
                                'tanggal_panen' => $panen->tanggal_panen,
                                'jumlah_ayam' => $panen->jumlah_ayam,
                                'jenis_produk' => $panen->jenis_produk,
                                'harga_per_ekor' => $panen->harga_per_ekor,
                                'status' => 'Di Gudang',
                            ]);

                            // [LANGKAH B] Ubah status data panen asli menjadi 'Telah Diambil'
                            $panen->update(['status' => 'Telah Diambil']);
                        }

                        Notification::make()
                            ->title('Pengambilan Dikonfirmasi')
                            ->body("Berhasil memindahkan " . $records->count() . " batch ke inventaris Anda.")
                            ->success()
                            ->send();
                    })
                    ->deselectRecordsAfterCompletion(),
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
            'index' => Pages\ListPengambilans::route('/'),
        ];
    }
}
