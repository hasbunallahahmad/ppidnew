<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use NoteBrainsLab\FilamentMenuManager\Models\MenuLocation;
use NoteBrainsLab\FilamentMenuManager\Models\Menu;
use NoteBrainsLab\FilamentMenuManager\Models\MenuItem;

class MenuSeeder extends Seeder
{
    public function run(): void
    {
        // Create or get the Main Menu location
        $mainMenuLocation = MenuLocation::firstOrCreate(
            ['handle' => 'main_menu'],
            ['name' => 'Main Menu (Navbar)']
        );

        // Create the main menu
        $mainMenu = Menu::firstOrCreate(
            ['menu_location_id' => $mainMenuLocation->id],
            ['name' => 'Main Navigation Menu']
        );

        // Clear existing items for this menu
        MenuItem::where('menu_id', $mainMenu->id)->delete();

        // Add menu items with their hierarchical structure
        $this->createMenuItems($mainMenu);

        // Create Footer Menu location and menu if needed
        $footerMenuLocation = MenuLocation::firstOrCreate(
            ['handle' => 'footer'],
            ['name' => 'Footer Menu']
        );

        Menu::firstOrCreate(
            ['menu_location_id' => $footerMenuLocation->id],
            ['name' => 'Footer Navigation Menu']
        );
    }

    private function createMenuItems(Menu $menu): void
    {
        $menuItems = [
            [
                'title' => 'Beranda',
                'url' => '/',
                'icon' => 'fas fa-home',
                'order' => 1,
                'target' => '_self',
                'children' => []
            ],
            [
                'title' => 'Profil Dinas',
                'url' => '/page/tentang-dinas',
                'icon' => 'fas fa-info-circle',
                'order' => 2,
                'target' => '_self',
                'children' => [
                    [
                        'title' => 'Tentang Dinas',
                        'url' => '/page/tentang-dinas',
                        'icon' => 'fas fa-info-circle',
                        'order' => 1,
                        'target' => '_self'
                    ],
                    [
                        'title' => 'Struktur Organisasi',
                        'url' => '/page/struktur-organisasi',
                        'icon' => 'fas fa-users',
                        'order' => 2,
                        'target' => '_self'
                    ],
                    [
                        'title' => 'Visi & Misi',
                        'url' => '/page/visi-misi',
                        'icon' => 'fas fa-bullseye',
                        'order' => 3,
                        'target' => '_self'
                    ],
                    [
                        'title' => 'Dasar Hukum',
                        'url' => '/page/dasar-hukum',
                        'icon' => 'fas fa-gavel',
                        'order' => 4,
                        'target' => '_self'
                    ],
                    [
                        'title' => 'Profil PPID',
                        'url' => '/page/profil-ppid',
                        'icon' => 'fas fa-shield-alt',
                        'order' => 5,
                        'target' => '_self'
                    ]
                ]
            ],
            [
                'title' => 'Informasi Publik',
                'url' => '/page/informasi-berkala',
                'icon' => 'fas fa-files',
                'order' => 3,
                'target' => '_self',
                'children' => [
                    [
                        'title' => 'Informasi Berkala',
                        'url' => '/page/informasi-berkala',
                        'icon' => 'fas fa-calendar-alt',
                        'order' => 1,
                        'target' => '_self'
                    ],
                    [
                        'title' => 'Informasi Setiap Saat',
                        'url' => '/page/informasi-setiap-saat',
                        'icon' => 'fas fa-clock',
                        'order' => 2,
                        'target' => '_self'
                    ],
                    [
                        'title' => 'Informasi Serta Merta',
                        'url' => '/page/informasi-serta-merta',
                        'icon' => 'fas fa-bolt',
                        'order' => 3,
                        'target' => '_self'
                    ],
                    [
                        'title' => 'Informasi Dikecualikan',
                        'url' => '/page/informasi-dikecualikan',
                        'icon' => 'fas fa-lock',
                        'order' => 4,
                        'target' => '_self'
                    ],
                    [
                        'title' => 'Statistik Layanan',
                        'url' => '/page/statistik-layanan',
                        'icon' => 'fas fa-chart-bar',
                        'order' => 5,
                        'target' => '_self'
                    ]
                ]
            ],
            [
                'title' => 'Layanan Arsip',
                'url' => '/page/arsip-digital',
                'icon' => 'fas fa-archive',
                'order' => 4,
                'target' => '_self',
                'children' => [
                    [
                        'title' => 'Arsip Digital',
                        'url' => '/page/arsip-digital',
                        'icon' => 'fas fa-archive',
                        'order' => 1,
                        'target' => '_self'
                    ],
                    [
                        'title' => 'Akuisisi Arsip',
                        'url' => '/page/akuisisi-arsip',
                        'icon' => 'fas fa-folder-open',
                        'order' => 2,
                        'target' => '_self'
                    ],
                    [
                        'title' => 'Restorasi & Konservasi',
                        'url' => '/page/restorasi-konservasi',
                        'icon' => 'fas fa-tools',
                        'order' => 3,
                        'target' => '_self'
                    ],
                    [
                        'title' => 'Depo Arsip Daerah',
                        'url' => '/page/depo-arsip',
                        'icon' => 'fas fa-warehouse',
                        'order' => 4,
                        'target' => '_self'
                    ],
                    [
                        'title' => 'Bimbingan Teknis',
                        'url' => '/page/bimbingan-teknis',
                        'icon' => 'fas fa-chalkboard-teacher',
                        'order' => 5,
                        'target' => '_self'
                    ]
                ]
            ],
            [
                'title' => 'Layanan Perpustakaan',
                'url' => '/page/katalog-koleksi',
                'icon' => 'fas fa-book',
                'order' => 5,
                'target' => '_self',
                'children' => [
                    [
                        'title' => 'Katalog Koleksi',
                        'url' => '/page/katalog-koleksi',
                        'icon' => 'fas fa-book-open',
                        'order' => 1,
                        'target' => '_self'
                    ],
                    [
                        'title' => 'E-Library & E-Book',
                        'url' => '/page/e-library',
                        'icon' => 'fas fa-tablet-alt',
                        'order' => 2,
                        'target' => '_self'
                    ],
                    [
                        'title' => 'Taman Baca Masyarakat',
                        'url' => '/page/taman-baca',
                        'icon' => 'fas fa-book-reader',
                        'order' => 3,
                        'target' => '_self'
                    ],
                    [
                        'title' => 'Layanan Inklusi Sosial',
                        'url' => '/page/inklusi-sosial',
                        'icon' => 'fas fa-hands-helping',
                        'order' => 4,
                        'target' => '_self'
                    ]
                ]
            ],
            [
                'title' => 'Berita',
                'url' => '#',
                'icon' => 'fas fa-newspaper',
                'order' => 6,
                'target' => '_self',
                'children' => []
            ],
            [
                'title' => 'Ajukan Permohonan',
                'url' => '#',
                'icon' => 'fas fa-paper-plane',
                'order' => 7,
                'target' => '_self',
                'children' => []
            ]
        ];

        $this->addMenuItemsToMenu($menu, $menuItems);
    }

    private function addMenuItemsToMenu(Menu $menu, array $items, ?MenuItem $parent = null): void
    {
        foreach ($items as $itemData) {
            $children = $itemData['children'] ?? [];
            unset($itemData['children']);

            $menuItem = MenuItem::create(array_merge(
                $itemData,
                [
                    'menu_id' => $menu->id,
                    'parent_id' => $parent?->id,
                ]
            ));

            if (!empty($children)) {
                $this->addMenuItemsToMenu($menu, $children, $menuItem);
            }
        }
    }
}
