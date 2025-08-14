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
use App\Filament\Peternak\Resources\PeternakResource\Widgets\PeternakStats;
use App\Filament\Resources\ChartResource\Widgets\PriceChart;
use Filament\Navigation\NavigationItem;
use App\Filament\Peternak\Resources\PanenResource;
use Filament\Navigation\NavigationBuilder;
use App\Filament\Peternak\Resources\PermintaanResource;


class PeternakPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('peternak')
            ->path('peternak')
            ->login()
            ->colors([
                'primary' => Color::Amber,
            ])
            ->discoverResources(in: app_path('Filament/Peternak/Resources'), for: 'App\\Filament\\Peternak\\Resources')
            ->discoverPages(in: app_path('Filament/Peternak/Pages'), for: 'App\\Filament\\Peternak\\Pages')
            ->discoverWidgets(in: app_path('Filament/Peternak/Widgets'), for: 'App\\Filament\\Peternak\\Widgets')
            ->widgets([
                PeternakStats::class,
                PriceChart::class,
            ])
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverResources(in: app_path('Filament/Peternak/Resources'), for: 'App\\Filament\\Peternak\\Resources')
            ->widgets([
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
            ->navigation(function (NavigationBuilder $builder): NavigationBuilder {
                return $builder->items([
                    NavigationItem::make('Dasbor')
                        ->icon('heroicon-o-home')
                        ->isActiveWhen(fn(): bool => request()->routeIs('filament.peternak.pages.dashboard'))
                        ->url(fn(): string => route('filament.peternak.pages.dashboard')),

                    NavigationItem::make('Input Panen')
                        ->icon('heroicon-o-inbox-arrow-down')
                        ->isActiveWhen(fn(): bool => request()->routeIs('filament.peternak.resources.panens.create'))
                        ->url(fn(): string => PanenResource::getUrl('create')),

                    NavigationItem::make('Stok & Label')
                        ->icon('heroicon-o-archive-box')
                        ->isActiveWhen(fn(): bool => request()->routeIs('filament.peternak.resources.panens.index'))
                        ->url(fn(): string => PanenResource::getUrl('index')),

                    NavigationItem::make('Permintaan')
                        ->icon('heroicon-o-shopping-cart')
                        ->isActiveWhen(fn(): bool => request()->routeIs('filament.peternak.resources.permintaans.*'))
                        ->url(fn(): string => PermintaanResource::getUrl()),
                ]);
            });
    }
}
