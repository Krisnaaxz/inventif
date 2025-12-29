{{-- Layout Utama Aplikasi InventIF --}}
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>{{ env('APP_NAME') }}</title>
    <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />
    <link rel="icon" href="{{ asset('layout') }}/assets/img/InventIF_logo.png" type="image/x-icon" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- Fonts dan Icons --}}
    <script src="{{ asset('layout') }}/assets/js/plugin/webfont/webfont.min.js"></script>
    <script>
        WebFont.load({
            google: {
                families: ["Public Sans:300,400,500,600,700"]
            },
            custom: {
                families: [
                    "Font Awesome 5 Solid",
                    "Font Awesome 5 Regular",
                    "Font Awesome 5 Brands",
                    "simple-line-icons",
                    "flaticon",
                    'aria-label'
                ],
                urls: ["{{ asset('layout') }}/assets/css/fonts.min.css"],
            },
            active: function() {
                sessionStorage.fonts = true;
            },
        });
    </script>

    {{-- CSS Files --}}
    <link rel="stylesheet" href="{{ asset('layout') }}/assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="{{ asset('layout') }}/assets/css/plugins.min.css" />
    <link rel="stylesheet" href="{{ asset('layout') }}/assets/css/kaiadmin.min.css" />
    {{-- CSS untuk demo, hapus di production --}}
    <link rel="stylesheet" href="{{ asset('layout') }}/assets/css/demo.css" />
</head>

<body>
    {{-- SweetAlert untuk notifikasi --}}
    @include('sweetalert::alert')

    {{-- Wrapper Utama --}}
    <div class="wrapper">
        {{-- Sidebar Navigasi --}}
        <x-sidebar />
        {{-- End Sidebar --}}

        {{-- Panel Utama --}}
        <div class="main-panel">
            {{-- Header Utama --}}
            <div class="main-header">
                <div class="main-header-logo">
                    {{-- Logo Header --}}
                    <div class="logo-header" data-background-color="dark">
                        <a href="index.html" class="logo">
                            <img src="{{ asset('layout') }}/assets/img/profile_temp.png" alt="navbar brand"
                                class="navbar-brand" height="20" />
                        </a>
                        <div class="nav-toggle">
                            <button class="btn btn-toggle toggle-sidebar">
                                <i class="gg-menu-right"></i>
                            </button>
                            <button class="btn btn-toggle sidenav-toggler">
                                <i class="gg-menu-left"></i>
                            </button>
                        </div>
                        <button class="topbar-toggler more">
                            <i class="gg-more-vertical-alt"></i>
                        </button>
                    </div>
                    {{-- End Logo Header --}}
                </div>

                {{-- Navbar Header --}}
                <nav class="navbar navbar-header navbar-header-transparent navbar-expand-lg border-bottom">
                    <div class="container-fluid">
                        <ul class="navbar-nav topbar-nav ms-md-auto align-items-center">
                            {{-- User Dropdown --}}
                            <li class="nav-item topbar-user dropdown hidden-caret">
                                <a class="dropdown-toggle profile-pic" data-bs-toggle="dropdown" href="#"
                                    aria-expanded="false">
                                    <div class="avatar-sm">
                                        <img src="{{ asset('layout') }}/assets/img/profile_temp.png" alt="..."
                                            class="avatar-img rounded-circle" />
                                    </div>
                                    <span class="profile-username">
                                        <span class="op-7">Hi,</span>
                                        <span class="fw-bold">{{ auth()->user()->name }}</span>
                                    </span>
                                </a>
                                <ul class="dropdown-menu dropdown-user animated fadeIn">
                                    <div class="dropdown-user-scroll scrollbar-outer">
                                        <div class="user-box">
                                            <div class="avatar-lg">
                                                <img src="{{ asset('layout') }}/assets/img/profile_temp.png"
                                                    alt="image profile" class="avatar-img rounded" />
                                            </div>
                                            <div class="u-text">
                                                <h4>{{ auth()->user()->name }} - {{ ucfirst(auth()->user()->role) }}
                                                </h4>
                                                <p class="text-muted">{{ auth()->user()->email }}</p>
                                                <div class="dropdown-divider"></div>
                                                {{-- Link Edit Profil --}}
                                                <a class="dropdown-item" href="{{ route('profile.edit') }}">
                                                    <i class="fas fa-user-edit me-2"></i> Edit Profil
                                                </a>
                                                <div class="dropdown-divider"></div>
                                                {{-- Tombol Logout --}}
                                                <a class="dropdown-item text-danger" href="{{ route('logout') }}"
                                                    onclick="event.preventDefault();
                                                            document.getElementById('logout-form').submit();">
                                                    <i class="fas fa-sign-out-alt me-2"></i> Logout
                                                </a>
                                                {{-- Form Logout Hidden --}}
                                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                    class="d-none">
                                                    @csrf
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </nav>
                {{-- End Navbar --}}
            </div>

            {{-- Konten Utama --}}
            <div class="container">
                <div class="page-inner">
                    {{-- Header Halaman --}}
                    <div class="page-header">
                        <h4 class="page-title">@yield('page_title', 'InventIF')</h4>
                        {{-- Breadcrumb atau navigasi tambahan bisa ditambahkan di sini --}}
                        @yield('breadcrumb')
                    </div>

                    {{-- Flash Messages --}}
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle"></i> {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fas fa-exclamation-triangle"></i> {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if (session('warning'))
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <i class="fas fa-exclamation-circle"></i> {{ session('warning') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if (session('info'))
                        <div class="alert alert-info alert-dismissible fade show" role="alert">
                            <i class="fas fa-info-circle"></i> {{ session('info') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    {{-- Konten Dinamis --}}
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
    {{-- JavaScript Libraries --}}
    {{-- Core JS Files --}}
    <script src="{{ asset('layout') }}/assets/js/core/jquery-3.7.1.min.js"></script>
    <script src="{{ asset('layout') }}/assets/js/core/popper.min.js"></script>
    <script src="{{ asset('layout') }}/assets/js/core/bootstrap.min.js"></script>

    {{-- Plugin JS Files --}}
    {{-- jQuery Scrollbar --}}
    <script src="{{ asset('layout') }}/assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>

    {{-- Chart JS --}}
    <script src="{{ asset('layout') }}/assets/js/plugin/chart.js/chart.min.js"></script>

    {{-- jQuery Sparkline --}}
    <script src="{{ asset('layout') }}/assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js"></script>

    {{-- Chart Circle --}}
    <script src="{{ asset('layout') }}/assets/js/plugin/chart-circle/circles.min.js"></script>

    {{-- Datatables --}}
    <script src="{{ asset('layout') }}/assets/js/plugin/datatables/datatables.min.js"></script>

    {{-- Bootstrap Notify --}}
    <script src="{{ asset('layout') }}/assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>

    {{-- jQuery Vector Maps --}}
    <script src="{{ asset('layout') }}/assets/js/plugin/jsvectormap/jsvectormap.min.js"></script>
    <script src="{{ asset('layout') }}/assets/js/plugin/jsvectormap/world.js"></script>

    {{-- Sweet Alert --}}
    <script src="{{ asset('layout') }}/assets/js/plugin/sweetalert/sweetalert.min.js"></script>

    {{-- Kaiadmin JS --}}
    <script src="{{ asset('layout') }}/assets/js/kaiadmin.min.js"></script>

    {{-- Stack untuk script tambahan --}}
    @stack('script')
</body>

</html>
