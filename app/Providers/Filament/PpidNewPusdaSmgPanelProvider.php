<?php

namespace App\Providers\Filament;

use App\Filament\Widgets\AktivitasTerbaruWidget;
use App\Filament\Widgets\DeadlineWidget;
use App\Filament\Widgets\PermohonanMasukTableWidget;
use App\Filament\Widgets\PermohonanStatsWidget;
use Arseno25\FilamentPrivacyBlur\FilamentPrivacyBlurPlugin;
use BezhanSalleh\FilamentShield\FilamentShieldPlugin;
use Carbon\Carbon;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Support\Enums\Width;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use MWGuerra\FileManager\FileManagerPlugin;
use Niladam\FilamentAutoLogout\AutoLogoutPlugin;
use NoteBrainsLab\FilamentMenuManager\FilamentMenuManagerPlugin;
use Novius\LaravelFilamentNews\Filament\NewsPlugin;
use Openplain\FilamentShadcnTheme\Color as FilamentShadcnThemeColor;

class PpidNewPusdaSmgPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('ppid-new-pusda-smg')
            ->path('ppid-new-pusda-smg')
            ->login()
            ->colors([
                'primary' => FilamentShadcnThemeColor::Default,
            ])
            ->breadcrumbs(false)
            ->resourceCreatePageRedirect('index')
            ->resourceEditPageRedirect('index')
            ->databaseNotifications()
            ->databaseNotificationsPolling('30s')
            ->sidebarWidth('15rem')
            ->maxContentWidth(Width::Full)
            ->sidebarCollapsibleOnDesktop()
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\Filament\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\Filament\Pages')
            // ->pages([
            //     Dashboard::class,
            // ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\Filament\Widgets')
            ->widgets([
                // AccountWidget::class,
                // FilamentInfoWidget::class,
                // PermohonanStatsWidget::class,
                // PermohonanMasukTableWidget::class,
                // DeadlineWidget::class,
                // AktivitasTerbaruWidget::class,
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
            ->plugins([
                FilamentShieldPlugin::make()
                    ->modelLabel('Model')
                    ->pluralModelLabel('Models')
                    ->recordTitleAttribute('name')
                    ->titleCaseModelLabel(false)
                    ->navigationLabel('Roles & Permissions')
                    ->navigationIcon('heroicon-o-shield-check')
                    ->activeNavigationIcon('heroicon-s-home')
                    ->navigationGroup('Settings')
                    ->navigationBadgeColor('success')
                    ->registerNavigation(true),
                FilamentMenuManagerPlugin::make()
                    ->navigationGroup('Settings'),
                AutoLogoutPlugin::make()
                    ->color(Color::Emerald)
                    ->icon('heroicon-o-arrow-right-start-on-rectangle')
                    // ->disableIf(fn() => Auth::id() === 1)
                    ->logoutAfter(Carbon::SECONDS_PER_MINUTE * 5)
                    ->withoutWarning()
                    ->withoutTimeLeft()
                    ->timeLeftText('Nah kan , dianggurin sih jadi Force Logout :)')
                    ->timeLeftText(''),
                FilamentPrivacyBlurPlugin::make()
                    ->defaultMode('blur_click'),
                NewsPlugin::make(),
                FileManagerPlugin::make()
                    ->fileManager()
                    ->fileManagerPageSidebar(true)
                    ->fileManagerSidebarRootLabel('Root')
                    ->fileManagerSidebarHeading('Folders')
                    ->fileManagerNavigation(
                        icon: 'heroicon-o-folder',
                        label: 'Files',
                        sort: 1,
                        group: 'Content'
                    )
                    ->fileSystem()
                    ->fileSystemPageSidebar(true)
                    ->fileSystemSidebarRootLabel('Storage Root')
                    ->fileSystemSidebarHeading('Directories')
                    ->fileSystemNavigation(
                        icon: 'heroicon-o-server-stack',
                        label: 'Storage',
                        sort: 2,
                        group: 'Content'
                    )
                    ->withoutSchemaExample(),
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
