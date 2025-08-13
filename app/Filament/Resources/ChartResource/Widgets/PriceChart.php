<?php

namespace App\Filament\Resources\ChartResource\Widgets;

use Filament\Widgets\ChartWidget;

class PriceChart extends ChartWidget
{
    protected static ?string $heading = 'Chart';

    protected function getData(): array
    {
        return [
            'datasets' => [
                [
                    'label' => 'Harga Peternak (per ekor)',
                    'data' => [32000, 33000, 32500, 35000, 34500, 35000],
                    'borderColor' => '#34D399',
                ],
                [
                    'label' => 'Harga Distributor (per ekor)',
                    'data' => [36000, 37500, 37000, 39000, 38500, 39000],
                    'borderColor' => '#60A5FA',
                ],
            ],
            'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul'],
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
