<?php

namespace App\Filament\Resources\AdminResource\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\User;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Peternak', User::role('Peternak')->count())
                ->description('Jumlah peternak terdaftar')
                ->icon('heroicon-o-user-group'),
            Stat::make('Total Distributor', User::role('Distributor')->count())
                ->description('Jumlah distributor terdaftar')
                ->icon('heroicon-o-truck'),
            Stat::make('Total Pedagang', User::role('Pedagang')->count())
                ->description('Jumlah pedagang terdaftar')
                ->icon('heroicon-o-shopping-bag'),
        ];
    }
}
