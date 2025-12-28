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
    public $links;
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
                'isActive' => request()->routeIs('manage-user'),
                'icon' => 'fas fa-users-cog',
                'isDropdown' => false,
            ],
            [
                'label' => 'Inventaris',
                'route' => 'inventaris',
                'isActive' => request()->routeIs('inventaris.*'),
                'icon' => 'fas fa-storage',
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
            // [
            //     'label' => 'Peminjaman',
            //     'route' => 'peminjaman',
            //     'isActive' => request()->routeIs('peminjaman'),
            //     'icon' => 'fas fa-tags',
            //     'isDropdown' => true,
            // ],
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