<?php

namespace App\Filament\Peternak\Resources;

use App\Filament\Peternak\Resources\PanenResource\Pages;
use App\Filament\Peternak\Resources\PanenResource\RelationManagers;
use App\Models\Panen;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PanenResource extends Resource
{
    protected static ?string $model = Panen::class;

    protected static ?string $navigationIcon = 'heroicon-o-inbox-arrow-down';
    protected static ?string $navigationLabel = 'Input Panen';
    protected static ?string $modelLabel = 'Data Panen';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\DatePicker::make('tanggal_panen')
                    ->label('Tanggal Panen')
                    ->default(now()) // Otomatis terisi tanggal hari ini
                    ->required(),

                Forms\Components\Select::make('asal_kandang')
                    ->label('Asal Kandang')
                    ->options([
                        'Kandang A-01 (Ayam Kampung)' => 'Kandang A-01 (Ayam Kampung)',
                        'Kandang B-02 (Ayam Broiler)' => 'Kandang B-02 (Ayam Broiler)',
                    ])
                    ->required(),

                Forms\Components\TextInput::make('jumlah_ayam')
                    ->label('Jumlah Ayam (ekor)')
                    ->numeric()
                    ->required(),

                Forms\Components\Select::make('jenis_produk')
                    ->label('Jenis Produk')
                    ->options([
                        'Karkas Utuh' => 'Karkas Utuh',
                        'Dada Filet' => 'Dada Filet',
                        'Paha' => 'Paha',
                    ])
                    ->required(),

                Forms\Components\TextInput::make('harga_per_ekor')
                    ->label('Harga per Ekor (Rp)')
                    ->numeric()
                    ->prefix('Rp')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('batch_code')
                    ->label('Kode Batch')
                    ->searchable(),

                Tables\Columns\TextColumn::make('tanggal_panen')
                    ->label('Tgl Panen')
                    ->date('d-m-Y') // Format tanggal
                    ->sortable(),

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
                        'Siap Kirim' => 'primary',
                        'Tersedia di Peternak' => 'primary',
                        'Di Gudang Distributor' => 'warning',
                        'Terjual Habis' => 'success',
                        default => 'gray',
                    }),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\Action::make('cetak_label')
                    ->label('Cetak Label')
                    ->icon('heroicon-o-printer')
                    ->color('info')
                    ->url(fn(Panen $record): string => route('panen.label.pdf', $record))
                    ->openUrlInNewTab(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function mutateFormDataBeforeCreate(array $data): array
    {
        // 1. Set user_id dari peternak yang login
        $data['user_id'] = Auth::id();

        // 2. Buat kode batch unik
        $prefix = 'PN-' . now()->format('Ymd');
        $data['batch_code'] = $prefix . '-' . Str::upper(Str::random(4));

        // 3. Set status awal
        $data['status'] = 'Siap Kirim';

        return $data;
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
            'index' => Pages\ListPanens::route('/'),
            'create' => Pages\CreatePanen::route('/create'),
            'edit' => Pages\EditPanen::route('/{record}/edit'),
        ];
    }
}
