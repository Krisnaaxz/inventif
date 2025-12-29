{{-- Sidebar Component untuk Navigasi Utama --}}
<div class="sidebar" data-background-color="light">
    {{-- Bagian Logo dan Toggle Sidebar --}}
    <div class="sidebar-logo">
        <div class="logo-header">
            <a href="/home" class="logo" data-background-color="light">
                <img src="{{ asset('layout') }}/assets/img/InventIF_logo.png" alt="navbar brand"
                    class="mt-4 navbar-brand d-flex align-items-center justify-content-center" height="180" />
            </a>
            <div class="nav-toggle btn-gray">
                <button class="btn btn-toggle toggle-sidebar btn-light" title="Toggle Sidebar">
                    <i class="gg-menu-right text-gray"></i>
                </button>
                <button class="btn btn-toggle sidenav-toggler btn-light" title="Minimize Sidebar">
                    <i class="gg-menu-left text-gray"></i>
                </button>
            </div>
            <button class="topbar-toggler more" title="More Options">
                <i class="gg-more-vertical-alt"></i>
            </button>
        </div>
    </div>
    {{-- Wrapper Konten Sidebar dengan Scroll --}}
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <ul class="nav nav-secondary">
                {{-- Menu untuk Role Admin --}}
                @if (auth()->user()->role === 'admin')
                    {{-- Separator untuk Admin --}}
                    <li class="nav-section">
                        <span class="sidebar-mini-icon">
                            <i class="fa fa-crown"></i>
                        </span>
                        <h4 class="text-section">Admin Panel</h4>
                    </li>

                    @foreach ($links as $index => $link)
                        @if ($link['isDropdown'])
                            <li class="nav-item {{ $link['isActive'] ? 'active' : '' }}">
                                <a data-bs-toggle="collapse" href="#dropdown-admin-{{ $index }}"
                                    class="collapsed" aria-expanded="false">
                                    <i class="{{ $link['icon'] }}"></i>
                                    <p>{{ $link['label'] }}</p>
                                    <span class="caret"></span>
                                </a>
                                <div class="collapse" id="dropdown-admin-{{ $index }}">
                                    <ul class="nav nav-collapse">
                                        @foreach ($link['items'] as $item)
                                            <li>
                                                <a href="{{ route($item['route']) }}">
                                                    <span class="sub-item">{{ $item['label'] }}</span>
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </li>
                        @else
                            <li class="nav-item {{ $link['isActive'] ? 'active' : '' }}">
                                <a href="{{ route($link['route']) }}">
                                    <i class="{{ $link['icon'] }}"></i>
                                    <p>{{ $link['label'] }}</p>
                                </a>
                            </li>
                        @endif
                    @endforeach
                    {{-- Menu untuk Role Organisasi --}}
                @elseif (auth()->user()->role === 'organisasi')
                    {{-- Separator untuk Organisasi --}}
                    <li class="nav-section">
                        <span class="sidebar-mini-icon">
                            <i class="fa fa-building"></i>
                        </span>
                        <h4 class="text-section">Organisasi</h4>
                    </li>

                    @foreach ($organisasiLinks as $index => $link)
                        @if ($link['isDropdown'])
                            <li class="nav-item {{ $link['isActive'] ? 'active' : '' }}">
                                <a data-bs-toggle="collapse" href="#dropdown-organisasi-{{ $index }}"
                                    class="collapsed" aria-expanded="false">
                                    <i class="{{ $link['icon'] }}"></i>
                                    <p>{{ $link['label'] }}</p>
                                    <span class="caret"></span>
                                </a>
                                <div class="collapse" id="dropdown-organisasi-{{ $index }}">
                                    <ul class="nav nav-collapse">
                                        @foreach ($link['items'] as $item)
                                            <li>
                                                <a href="{{ route($item['route']) }}">
                                                    <span class="sub-item">{{ $item['label'] }}</span>
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </li>
                        @else
                            <li class="nav-item {{ $link['isActive'] ? 'active' : '' }}">
                                <a href="{{ route($link['route']) }}">
                                    <i class="{{ $link['icon'] }}"></i>
                                    <p>{{ $link['label'] }}</p>
                                </a>
                            </li>
                        @endif
                    @endforeach
                    {{-- Menu untuk Role Umum --}}
                @else
                    {{-- Separator untuk Umum --}}
                    <li class="nav-section">
                        <span class="sidebar-mini-icon">
                            <i class="fa fa-user"></i>
                        </span>
                        <h4 class="text-section">Menu Utama</h4>
                    </li>

                    @foreach ($umumLinks as $index => $link)
                        @if ($link['isDropdown'])
                            <li class="nav-item {{ $link['isActive'] ? 'active' : '' }}">
                                <a data-bs-toggle="collapse" href="#dropdown-umum-{{ $index }}"
                                    class="collapsed" aria-expanded="false">
                                    <i class="{{ $link['icon'] }}"></i>
                                    <p>{{ $link['label'] }}</p>
                                    <span class="caret"></span>
                                </a>
                                <div class="collapse" id="dropdown-umum-{{ $index }}">
                                    <ul class="nav nav-collapse">
                                        @foreach ($link['items'] as $item)
                                            <li>
                                                <a href="{{ route($item['route']) }}">
                                                    <span class="sub-item">{{ $item['label'] }}</span>
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </li>
                        @else
                            <li class="nav-item {{ $link['isActive'] ? 'active' : '' }}">
                                <a href="{{ route($link['route']) }}">
                                    <i class="{{ $link['icon'] }}"></i>
                                    <p>{{ $link['label'] }}</p>
                                </a>
                            </li>
                        @endif
                    @endforeach
                @endif
            </ul>
        </div>
    </div>
</div>
