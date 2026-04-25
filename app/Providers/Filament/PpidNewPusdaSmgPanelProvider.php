<?php

namespace App\Providers\Filament;

use App\Filament\Pages\Auth\Login;
use App\Helpers\PexelsHelper;
use Arseno25\FilamentPrivacyBlur\FilamentPrivacyBlurPlugin;
use BezhanSalleh\FilamentShield\FilamentShieldPlugin;
use Carbon\Carbon;
use Caresome\FilamentAuthDesigner\AuthDesignerPlugin;
use Caresome\FilamentAuthDesigner\Data\AuthPageConfig;
use Caresome\FilamentAuthDesigner\Enums\MediaPosition;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages\Dashboard;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Support\Enums\Width;
use Filament\Widgets\AccountWidget;
use Filament\Widgets\FilamentInfoWidget;
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
            ->login(Login::class)
            ->colors([
                'primary' => FilamentShadcnThemeColor::Default,
            ])
            ->breadcrumbs(false)
            ->resourceCreatePageRedirect('index')
            ->resourceEditPageRedirect('index')
            ->databaseNotifications()
            ->databaseNotificationsPolling('30s')
            ->sidebarWidth('15rem')
            // ->subNavigationPosition(SubNavigationPosition::Start)
            ->maxContentWidth(Width::Full)
            ->sidebarCollapsibleOnDesktop()
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\Filament\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\Filament\Pages')
            ->pages([
                Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\Filament\Widgets')
            ->widgets([
                AccountWidget::class,
                FilamentInfoWidget::class,
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
            // ->plugin(\MarcoGermani87\FilamentCaptcha\FilamentCaptcha::make())
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
                AuthDesignerPlugin::make()
                    ->login(
                        fn(AuthPageConfig $config) => $config
                            ->usingPage(\App\Filament\Pages\Auth\Login::class)
                            ->media(PexelsHelper::getDailyImage())
                            ->mediaPosition(MediaPosition::Cover)
                            ->blur('2'),
                    )
                    ->themeToggle(),
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
                    // Panel sidebar (in Filament navigation)
                    // ->panelSidebar()
                    // ->panelSidebarRootLabel('All Files')
                    // ->panelSidebarHeading('Folders')

                    // File Manager page (database mode)
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

                    // File System page (storage mode, read-only)
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

                    // Disable demo page
                    ->withoutSchemaExample(),
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
