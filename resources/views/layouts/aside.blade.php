<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="{{ url('/') }}" class="brand-link">
        <img src="{{ asset('images/favicon.ico')}}" alt="" class="brand-image elevation-3" style="opacity: 1">
        <span class="brand-text font-weight-light">MobileArena</span>
    </a>
    <div class="sidebar">
        <div class="form-inline mt-2">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sm form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('brand.index') }}" class="nav-link @if (Request::is('brand*')) active @endif">
                        <i class="far fa-circle nav-icon"></i>
                        <p>
                            Brand
                        </p>
                    </a>
                </li>
            </ul>
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('device.index') }}" class="nav-link @if (Request::is('device*')) active @endif">
                        <i class="far fa-circle nav-icon"></i>
                        <p>
                            Device
                        </p>
                    </a>
                </li>
            </ul>
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('category.index') }}" class="nav-link @if (Request::is('category*')) active @endif">
                        <i class="far fa-circle nav-icon"></i>
                        <p>
                            Spec Category
                        </p>
                    </a>
                </li>
            </ul>
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('spec.index') }}" class="nav-link @if (Request::is('spec*')) active @endif">
                        <i class="far fa-circle nav-icon"></i>
                        <p>
                            Spec
                        </p>
                    </a>
                </li>
            </ul>
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('review.index') }}" class="nav-link @if (Request::is('review*')) active @endif">
                        <i class="far fa-circle nav-icon"></i>
                        <p>
                            Revieww
                        </p>
                    </a>
                </li>
            </ul>
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <form method="POST" action="{{ route('logout') }}" class="nav-link">
                        @csrf
                        <a hrefs="#" class="logout-btn" onclick="event.preventDefault(); this.closest('form').submit();" style="cursor: pointer;">
                            <i class="nav-icon fas fa-sign-out-alt"></i>
                            <p>
                                Logout
                            </p>
                        </a>
                    </form>
                </li>
            </ul>
        </nav>
    </div>
</aside>