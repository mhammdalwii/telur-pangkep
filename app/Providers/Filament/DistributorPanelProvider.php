<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use App\Filament\Distributor\Widgets\DistributorStats;
use App\Filament\Resources\ChartResource\Widgets\PriceChart;
use App\Filament\Distributor\Resources\InventarisResource;
use App\Filament\Distributor\Resources\PengambilanResource;
use App\Filament\Distributor\Resources\PesananMasukResource;
use Filament\Navigation\NavigationBuilder;
use Filament\Navigation\NavigationItem;


class DistributorPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('distributor')
            ->path('distributor')
            ->login()
            ->colors([
                'primary' => Color::Amber,
            ])
            ->navigation(function (NavigationBuilder $builder): NavigationBuilder {
                return $builder->items([
                    NavigationItem::make('Dasbor')->icon('heroicon-o-home')->url('/distributor'),
                    NavigationItem::make('Pengambilan')->icon('heroicon-o-inbox-arrow-down')->url(PengambilanResource::getUrl()),
                    NavigationItem::make('Inventaris')->icon('heroicon-o-archive-box')->url(InventarisResource::getUrl()),
                    NavigationItem::make('Pesanan Masuk')->icon('heroicon-o-shopping-cart')->url(PesananMasukResource::getUrl()),
                ]);
            })
            ->discoverPages(in: app_path('Filament/Distributor/Pages'), for: 'App\\Filament\\Distributor\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Distributor/Widgets'), for: 'App\\Filament\\Distributor\\Widgets')
            ->widgets([
                DistributorStats::class,
                PriceChart::class,
                Widgets\AccountWidget::class,
                Widgets\FilamentInfoWidget::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ])
            ->resources([
                PengambilanResource::class,
                InventarisResource::class,
                PesananMasukResource::class,
            ]);
    }
}
