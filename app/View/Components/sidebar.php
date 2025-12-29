<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class sidebar extends Component
{
    /**
     * Create a new component instance.
     */
    public $links, $organisasiLinks, $umumLinks;
    public function __construct()
    {
        $this->links = [
            [
                'label' => 'Dashboard',
                'route' => 'home',
                'isActive' => request()->routeIs('home'),
                'icon' => 'fas fa-home',
                'isDropdown' => false,
            ],
            [
                'label' => 'Manage User',
                'route' => 'manage-user.index',
                'isActive' => request()->routeIs('manage-user.*'),
                'icon' => 'fas fa-users-cog',
                'isDropdown' => false,
            ],
            [
                'label' => 'Inventaris',
                'route' => 'inventaris',
                'isActive' => request()->routeIs('inventaris.*'),
                'icon' => 'fas fa-boxes',
                'isDropdown' => true,
                'items' => [
                    [
                        'label' => 'Kategori Inventaris',
                        'route' => 'inventaris.kategori-inventaris.index',
                    ],
                    [
                        'label' => 'Daftar Inventaris',
                        'route' => 'inventaris.daftar-inventaris.index',
                    ],
                ],
            ],
            [
                'label' => 'Pengajuan',
                'route' => 'pengajuan',
                'isActive' => request()->routeIs('pengajuan.*'),
                'icon' => 'fas fa-file-alt',
                'isDropdown' => true,
                'items' => [
                    [
                        'label' => 'Peminjaman Inventaris',
                        'route' => 'pengajuan.peminjaman',
                    ],
                    [
                        'label' => 'Penyewaan Inventaris',
                        'route' => 'pengajuan.penyewaan',
                    ],
                    [
                        'label' => 'Riwayat Pengajuan',
                        'route' => 'pengajuan.index',
                    ],
                ],
            ],
        ];
        $this->organisasiLinks = [
            [
                'label' => 'Dashboard',
                'route' => 'home',
                'isActive' => request()->routeIs('home'),
                'icon' => 'fas fa-home',
                'isDropdown' => false,
            ],
            [
                'label' => 'Inventaris',
                'route' => 'inventaris.daftar-inventaris.index',
                'isActive' => request()->routeIs('inventaris.*'),
                'icon' => 'fas fa-boxes',
                'isDropdown' => false,
            ],
            [
                'label' => 'Pengajuan',
                'route' => 'pengajuan',
                'isActive' => request()->routeIs('pengajuan.*'),
                'icon' => 'fas fa-file-alt',
                'isDropdown' => true,
                'items' => [
                    [
                        'label' => 'Peminjaman Inventaris',
                        'route' => 'pengajuan.peminjaman',
                    ],
                    [
                        'label' => 'Riwayat Pengajuan',
                        'route' => 'pengajuan.index',
                    ],
                ],
            ],
        ];

        $this->umumLinks = [
            [
                'label' => 'Dashboard',
                'route' => 'home',
                'isActive' => request()->routeIs('home'),
                'icon' => 'fas fa-home',
                'isDropdown' => false,
            ],
            [
                'label' => 'Inventaris',
                'route' => 'inventaris.daftar-inventaris.index',
                'isActive' => request()->routeIs('inventaris.*'),
                'icon' => 'fas fa-boxes',
                'isDropdown' => false,
            ],
[
                'label' => 'Pengajuan',
                'route' => 'pengajuan',
                'isActive' => request()->routeIs('pengajuan.*'),
                'icon' => 'fas fa-file-alt',
                'isDropdown' => true,
                'items' => [
                    [
                        'label' => 'Penyewaan Inventaris',
                        'route' => 'pengajuan.penyewaan',
                    ],
                    [
                        'label' => 'Riwayat Pengajuan',
                        'route' => 'pengajuan.index',
                    ],
                ],
            ],
        ];
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.sidebar');
    }
}
