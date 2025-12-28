      <div class="sidebar" data-background-color="light">
          <div class="sidebar-logo">
              <!-- Logo Header -->
              <div class="logo-header">
                  <a href="/home" class="logo" data-background-color="light">
                      <img src="{{ asset('layout') }}/assets/img/InventIF_logo.png" alt="navbar brand"
                          class="mt-4 navbar-brand d-flex align-items-center justify-content-center" height="180" />
                  </a>
                  <div class="nav-toggle btn-gray">
                      <button class="btn btn-toggle toggle-sidebar btn-light">
                          <i class="gg-menu-right text-gray"></i>
                      </button>
                      <button class="btn btn-toggle sidenav-toggler btn-light">
                          <i class="gg-menu-left text-gray"></i>
                      </button>
                  </div>
                  <button class="topbar-toggler more ">
                      <i class="gg-more-vertical-alt "></i>
                  </button>
              </div>
              <!-- End Logo Header -->
          </div>
          <div class="sidebar-wrapper scrollbar scrollbar-inner">
              <div class="sidebar-content">
                  <ul class="nav nav-secondary">
                      @if (auth()->user()->role === 'admin')
                          @foreach ($links as $link)
                              @if ($link['isDropdown'])
                                  <li class="nav-item {{ $link['isActive'] ? 'active' : '' }}">
                                      <a data-bs-toggle="collapse" href="#dashboard" class="collapsed"
                                          aria-expanded="false">
                                          <i class="{{ $link['icon'] }}"></i>
                                          <p>{{ $link['label'] }}</p>
                                          <span class="caret"></span>
                                      </a>
                                      <div class="collapse" id="dashboard">
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
                      @elseif (auth()->user()->role === 'organisasi')
                          @foreach ($organisasiLinks as $link)
                              @if ($link['isDropdown'])
                                  <li class="nav-item {{ $link['isActive'] ? 'active' : '' }}">
                                      <a data-bs-toggle="collapse" href="#{{ $link['id'] }}" class="collapsed"
                                          aria-expanded="false">
                                          <i class="{{ $link['icon'] }}"></i>
                                          <p>{{ $link['label'] }}</p>
                                          <span class="caret"></span>
                                      </a>
                                      <div class="collapse" id="{{ $link['id'] }}">
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
                      @else
                          @foreach ($umumLinks as $link)
                              @if ($link['isDropdown'])
                                  <li class="nav-item {{ $link['isActive'] ? 'active' : '' }}">
                                      <a data-bs-toggle="collapse" href="#{{ $link['id'] }}" class="collapsed"
                                          aria-expanded="false">
                                          <i class="{{ $link['icon'] }}"></i>
                                          <p>{{ $link['label'] }}</p>
                                          <span class="caret"></span>
                                      </a>
                                      <div class="collapse" id="{{ $link['id'] }}">
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
