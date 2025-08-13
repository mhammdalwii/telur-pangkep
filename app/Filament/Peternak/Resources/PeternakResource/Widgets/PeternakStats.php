<?php

namespace App\Filament\Peternak\Resources\PeternakResource\Widgets;

use App\Models\Panen;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Auth;

class PeternakStats extends BaseWidget
{
    protected function getStats(): array
    {
        // Ambil ID peternak yang sedang login
        $peternakId = Auth::id();

        // Hitung total stok yang statusnya 'Siap Kirim'
        $stokSiapKirim = Panen::where('user_id', $peternakId)
            ->where('status', 'Siap Kirim')
            ->sum('jumlah_ayam'); // Asumsi ada kolom 'jumlah_panen'

        // Hitung batch yang statusnya 'Telah Diambil'
        $batchDiambil = Panen::where('user_id', $peternakId)
            ->where('status', 'Telah Diambil')
            ->count();

        return [
            Stat::make('Total Stok Siap Kirim', $stokSiapKirim . ' Ekor')
                ->description('Stok yang tersedia di kandang')
                ->icon('heroicon-o-archive-box-arrow-down'),
            Stat::make('Batch Telah Diambil', $batchDiambil . ' Batch')
                ->description('Batch yang berhasil diambil distributor')
                ->icon('heroicon-o-truck'),
        ];
    }
}
