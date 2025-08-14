<?php

namespace App\Filament\Distributor\Resources;

use App\Filament\Distributor\Resources\PesananMasukResource\Pages;
use App\Models\Order;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class PesananMasukResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-cart';
    protected static ?string $navigationLabel = 'Pesanan Masuk';
    protected static ?string $pluralModelLabel = 'Pesanan Masuk dari Pedagang';
    protected static ?string $modelLabel = 'Pesanan';

    // Distributor tidak membuat pesanan di sini, jadi form dikosongkan
    public static function form(Forms\Form $form): Forms\Form
    {
        return $form->schema([]);
    }

    // Filter agar hanya pesanan untuk distributor ini yang muncul
    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->where('distributor_id', auth()->id())
            ->withSum('items', 'quantity'); // Menghitung total jumlah dari order items
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('order_code')
                    ->label('ID Pesanan')
                    ->searchable(),

                Tables\Columns\TextColumn::make('user.name') // Menampilkan nama pemesan (pedagang)
                    ->label('Pemesan')
                    ->searchable(),

                // Menampilkan semua batch dalam pesanan, dipisahkan baris baru
                Tables\Columns\TextColumn::make('items.panen.batch_code')
                    ->label('Batch')
                    ->listWithLineBreaks(),

                // Menampilkan total jumlah dari hasil query withSum
                Tables\Columns\TextColumn::make('items_sum_quantity')
                    ->label('Jumlah')
                    ->suffix(' ekor'),

                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'Baru' => 'primary',
                        'Diproses' => 'warning',
                        'Selesai' => 'success',
                        'Dibatalkan' => 'danger',
                        default => 'gray',
                    }),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()->label('Lihat & Proses'),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPesananMasuks::route('/'),
            // Halaman create dinonaktifkan di bawah
            'edit' => Pages\EditPesananMasuk::route('/{record}/edit'),
        ];
    }

    // Distributor tidak bisa membuat pesanan baru dari panel ini
    public static function canCreate(): bool
    {
        return false;
    }
}
