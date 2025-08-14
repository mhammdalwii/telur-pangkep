<?php

namespace App\Filament\Distributor\Resources;

use App\Filament\Distributor\Resources\InventarisResource\Pages;
use App\Models\Inventory; // Model yang benar adalah Inventory
use App\Models\User;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class InventarisResource extends Resource
{
    protected static ?string $model = Inventory::class;

    protected static ?string $navigationIcon = 'heroicon-o-archive-box';
    protected static ?string $navigationLabel = 'Inventaris';
    protected static ?string $modelLabel = 'Inventaris Gudang';
    protected static ?string $pluralModelLabel = 'Inventaris Gudang';

    // Form tidak kita gunakan di halaman daftar, jadi bisa dikosongkan
    public static function form(Forms\Form $form): Forms\Form
    {
        return $form->schema([]);
    }

    // Hanya tampilkan inventaris milik distributor yang sedang login
    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('distributor_id', auth()->id());
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('batch_code')
                    ->label('Kode Batch')
                    ->searchable(),

                // Menampilkan nama peternak dari relasi
                Tables\Columns\TextColumn::make('peternak.name')
                    ->label('Asal Peternak')
                    ->searchable(),

                Tables\Columns\TextColumn::make('jumlah_ayam')
                    ->label('Jumlah')
                    ->suffix(' ekor')
                    ->sortable(),

                Tables\Columns\TextColumn::make('jenis_produk')
                    ->label('Jenis Produk')
                    ->searchable(),

                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'Di Gudang' => 'warning',
                        'Terjual Habis' => 'success',
                        default => 'gray',
                    }),
            ])
            ->filters([
                //
            ])
            ->actions([
                // Aksi untuk mengubah jenis produk
                Tables\Actions\Action::make('ubah_jenis')
                    ->label('Ubah Jenis')
                    ->icon('heroicon-o-pencil-square')
                    ->color('info')
                    ->visible(fn(Inventory $record) => $record->status === 'Di Gudang')
                    ->form([
                        Forms\Components\Select::make('jenis_produk')
                            ->options([
                                'Karkas Utuh' => 'Karkas Utuh',
                                'Dada Filet' => 'Dada Filet',
                                'Paha' => 'Paha',
                            ])
                            ->required(),
                        Forms\Components\TextInput::make('jumlah_ayam')
                            ->label('Jumlah Baru (ekor/pcs)')
                            ->numeric()
                            ->required(),
                    ])
                    ->action(function (Inventory $record, array $data) {
                        $record->update($data);
                    }),
            ])
            ->bulkActions([
                // Halaman inventaris tidak perlu bulk action
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListInventaris::route('/'),
        ];
    }
}
