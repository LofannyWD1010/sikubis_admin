<aside class="main-sidebar sidebar-dark-primary elevation-4" style="min-height: 917px;">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <span class="brand-text font-weight-light">Sikubis Admin</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route("admin.home") }}" class="nav-link">
                        <p>
                            <i class="fas fa-tachometer-alt">

                            </i>
                            <span>{{ trans('global.dashboard') }}</span>
                        </p>
                    </a>
                </li>
                @can('user_management_access')
                    <li class="nav-item has-treeview {{ request()->is('admin/permissions*') ? 'menu-open' : '' }} {{ request()->is('admin/roles*') ? 'menu-open' : '' }} {{ request()->is('admin/users*') ? 'menu-open' : '' }}">
                        <a class="nav-link nav-dropdown-toggle">
                            <i class="fas fa-users-cog">

                            </i>
                            <p>
                                <span>{{ trans('global.userManagement.title') }}</span>
                                <i class="right fa fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('permission_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.permissions.index") }}" class="nav-link {{ request()->is('admin/permissions') || request()->is('admin/permissions/*') ? 'active' : '' }}">
                                        <i class="fas fa-unlock-alt">

                                        </i>
                                        <p>
                                            <span>{{ trans('global.permission.title') }}</span>
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('role_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.roles.index") }}" class="nav-link {{ request()->is('admin/roles') || request()->is('admin/roles/*') ? 'active' : '' }}">
                                        <i class="fas fa-briefcase">

                                        </i>
                                        <p>
                                            <span>{{ trans('global.role.title') }}</span>
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('user_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.users.index") }}" class="nav-link {{ request()->is('admin/users') || request()->is('admin/users/*') ? 'active' : '' }}">
                                        <i class="fas fa-user">

                                        </i>
                                        <p>
                                            <span>{{ trans('global.user.title') }}</span>
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                <li class="nav-item">
                        <a href="{{ route("admin.akuns.index") }}" class="nav-link {{ request()->is('admin/akuns') || request()->is('admin/akuns/*') ? 'active' : '' }}">
                            <i class="fas fa-users">

                            </i>
                            <p>
                                <span>Akun Penjual</span>
                            </p>
                        </a>
                    </li>
                <li class="nav-item">
                        <a href="{{ route("admin.fakultass.index") }}" class="nav-link {{ request()->is('admin/fakultass') || request()->is('admin/fakultass/*') ? 'active' : '' }}">
                            <i class="fas fa-users">

                            </i>
                            <p>
                                <span>Fakultas</span>
                            </p>
                        </a>
                    </li>
                <li class="nav-item">
                        <a href="{{ route("admin.pesanans.index") }}" class="nav-link {{ request()->is('admin/pesanans') || request()->is('admin/pesanans/*') ? 'active' : '' }}">
                            <i class="fas fa-envelope-open">

                            </i>
                            <p>
                                <span>Pesanan</span>
                            </p>
                        </a>
                    </li>
                <li class="nav-item">
                        <a href="{{ route("admin.pencairans.index") }}" class="nav-link {{ request()->is('admin/pencairans') || request()->is('admin/pencairans/*') ? 'active' : '' }}">
                            <i class="fas fa-coins">

                            </i>
                            <p>
                                <span>Pencairan Dana</span>
                            </p>
                        </a>
                    </li>
                    <li class="nav-item has-treeview {{ request()->is('admin/keuntungans*') ? 'menu-open' : '' }} {{ request()->is('admin/transaksis*') ? 'menu-open' : '' }} {{ request()->is('admin/saldomasuks*') ? 'menu-open' : '' }} {{ request()->is('admin/saldocairs*') ? 'menu-open' : '' }}">
                        <a class="nav-link nav-dropdown-toggle">
                            <i class="fas fa-briefcase">

                            </i>
                            <p>
                                <span>Transaksi</span>
                                <i class="right fa fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route("admin.keuntungans.index") }}" class="nav-link {{ request()->is('admin/keuntungans') || request()->is('admin/keuntungans/*') ? 'active' : '' }}">
                                        <i class="fas fa-briefcase">

                                        </i>
                                        <p>
                                            <span>Saldo Keuntungan</span>
                                        </p>
                                    </a>
                                </li>
                            <li class="nav-item">
                                <a href="{{ route("admin.transaksis.index") }}" class="nav-link {{ request()->is('admin/transaksis') || request()->is('admin/transaksis/*') ? 'active' : '' }}">
                                        <i class="fas fa-briefcase">

                                        </i>
                                        <p>
                                            <span>Saldo Kas</span>
                                        </p>
                                    </a>
                            </li>
                                <li class="nav-item">
                                    <a href="{{ route("admin.saldomasuks.index") }}" class="nav-link {{ request()->is('admin/saldomasuks') || request()->is('admin/saldomasuks/*') ? 'active' : '' }}">
                                        <i class="fas fa-briefcase">

                                        </i>
                                        <p>
                                            <span>Saldo Masuk</span>
                                        </p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route("admin.saldocairs.index") }}" class="nav-link {{ request()->is('admin/saldocairs') || request()->is('admin/saldocairs/*') ? 'active' : '' }}">
                                        <i class="fas fa-briefcase">

                                        </i>
                                        <p>
                                            <span>Saldo Cair</span>
                                        </p>
                                    </a>
                                </li>
                        </ul>
                    </li>
                    <li class="nav-item has-treeview {{ request()->is('admin/laporansikubiss*') ? 'menu-open' : '' }} {{ request()->is('admin/laporanpemasukans*') ? 'menu-open' : '' }} {{ request()->is('admin/laporanpengeluarans*') ? 'menu-open' : '' }}">
                        <a class="nav-link nav-dropdown-toggle">
                            <i class="fas fa-file-alt">

                            </i>
                            <p>
                                <span>Laporan</span>
                                <i class="right fa fa-angle-left"></i>
                            </p>
                        </a>
                    <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route("admin.laporansikubiss.index") }}" class="nav-link {{ request()->is('admin/laporansikubiss') || request()->is('admin/laporansikubiss/*') ? 'active' : '' }}">
                                <i class="fas fa-file-invoice-dollar">

                                </i>
                                <p>
                                    <span>Laba Rugi</span>
                                </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route("admin.laporanpemasukans.index") }}" class="nav-link {{ request()->is('admin/laporanpemasukans') || request()->is('admin/laporanpemasukans/*') ? 'active' : '' }}">
                                <i class="fas fa-file-invoice-dollar">

                                </i>
                                <p>
                                    <span>Pemasukan</span>
                                </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route("admin.laporanpengeluarans.index") }}" class="nav-link {{ request()->is('admin/laporanpengeluarans') || request()->is('admin/laporanpengeluarans/*') ? 'active' : '' }}">
                                <i class="fas fa-file-invoice-dollar">

                                </i>
                                <p>
                                    <span>Pengeluaran</span>
                                </p>
                                </a>
                            </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{ route("admin.requests.index") }}" class="nav-link {{ request()->is('admin/requests') || request()->is('admin/requests/*') ? 'active' : '' }}">
                        <i class="fas fa-cart-arrow-down">

                        </i>
                         <p>
                            <span>Request Penjual</span>
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                        <p>
                            <i class="fas fa-sign-out-alt">

                            </i>
                            <span>{{ trans('global.logout') }}</span>
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>