<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4" style="background-color: #0c5c31">
    <!-- Brand Logo -->
    <a href="/dashboard" class="brand-link">
        <img src="/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-light">Dashboard</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar font-light">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ (auth()->user()->image == null) ? '/img/AdminLTELogo.png' : asset('storage/' . auth()->user()->image) }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="/dashboard/profile" class="d-block text-capitalize">   
                    @if (strlen(auth()->user()->username) > 10)
                    {{ substr(auth()->user()->username, 0, 10) . '...' }}
                    @else
                        {{ strip_tags(auth()->user()->username) }}
                    @endif
                </a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-item">
                    <li class="nav-item ">
                        <a href="{{ url('/dashboard') }}" class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-fw fa-list-alt"></i>
                            <p>
                                Dashboard
                            </p>
                        </a>
                    </li>
                </li>
                @if (auth()->user()->role == 1)
                <li class="nav-item">
                    <li class="nav-item">
                        <a href="{{ url('dashboard/kategori') }}" class="nav-link {{ Request::is('dashboard/kategori') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-th-list"></i>
                            <p>
                                Kategori Berita
                            </p>
                        </a>
                    </li>
                </li> 
                @endif
                <li class="nav-item">
                    <li class="nav-item ">
                        <a href="{{ url('/dashboard/berita') }}" class="nav-link {{ Request::is('dashboard/berita*') ? 'active' : '' }}">
                            <i class="nav-icon far fa-newspaper"></i>
                            <p>
                                Berita
                            </p>
                        </a>
                    </li>
                </li> 
                <hr style="color: white; background-color: white" width="1px">
                @if (auth()->user()->role == 1)
                <li class="nav-item">
                    <li class="nav-item ">
                        <a href="{{ url('/dashboard/penulis') }}" class="nav-link {{ Request::is('dashboard/penulis') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-user-edit"></i>
                            <p>
                                Penulis
                            </p>
                        </a>
                    </li>
                </li> 
                @endif
            </ul>
        </nav>
    </div>
</aside>
