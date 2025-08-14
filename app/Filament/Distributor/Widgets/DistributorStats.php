<?php

namespace App\Filament\Distributor\Widgets;

// [PERBAIKAN] Ganti model dari Panen menjadi Inventory
use App\Models\Inventory;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Auth;

class DistributorStats extends BaseWidget
{
    protected function getStats(): array
    {
        $distributorId = Auth::id();

        // [PERBAIKAN] Query sekarang mencari di model Inventory
        $totalInventaris = Inventory::where('distributor_id', $distributorId)
            ->where('status', 'Di Gudang')
            ->sum('jumlah_ayam');

        // Placeholder untuk pesanan
        $pesananBaru = 0;

        return [
            Stat::make('Total Inventaris Gudang', $totalInventaris . ' Ekor')
                ->description('Jumlah stok di gudang Anda')
                ->icon('heroicon-o-home-modern'),
            Stat::make('Pesanan dari Pedagang', $pesananBaru . ' Pesanan Baru')
                ->description('Pesanan baru dari para pedagang')
                ->icon('heroicon-o-shopping-cart'),
        ];
    }
}
