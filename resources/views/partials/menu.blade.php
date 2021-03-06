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
                                <span>Manajemen Admin</span>
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
                <li class="nav-item has-treeview {{ request()->is('admin/akuns*') ? 'menu-open' : '' }} {{ request()->is('admin/penjualanterbanyaks*') ? 'menu-open' : '' }} {{ request()->is('admin/penjualanrekaps*') ? 'menu-open' : '' }} {{ request()->is('admin/produks*') ? 'menu-open' : ''}}">
                        <a class="nav-link nav-dropdown-toggle">
                            <i class="fas fa-briefcase">

                            </i>
                            <p>
                                <span>Penjualan</span>
                                <i class="right fa fa-angle-left"></i>
                            </p>
                        </a>
                <ul class="nav nav-treeview">
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
                        <a href="{{ route("admin.penjualanterbanyaks.index") }}" class="nav-link {{ request()->is('admin/penjualanterbanyaks') || request()->is('admin/penjualanterbanyaks/*') ? 'active' : '' }}">
                            <i class="fas fa-users">

                            </i>
                            <p>
                                <span>Penjualan Fakultas</span>
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route("admin.penjualanrekaps.index") }}" class="nav-link {{ request()->is('admin/penjualanrekaps') || request()->is('admin/penjualanrekaps/*') ? 'active' : '' }}">
                            <i class="fas fa-users">

                            </i>
                            <p>
                                <span>Penjualan Rekap Fakultas</span>
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route("admin.produks.index") }}" class="nav-link {{request()->is('admin/produks') || request()->is('admin/produks/*') ? 'active' : '' }}">
                            <i class="fas fa-briefcase">

                            </i>
                            <p>
                                <span>Produk</span>
                            </p>
                        </a>
                    </li>
                </ul>
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
                <li class="nav-item has-treeview {{ request()->is('admin/pesanans*') ? 'menu-open' : '' }} {{ request()->is('admin/pesananprosess*') ? 'menu-open' : '' }} {{ request()->is('admin/pesanankirims*') ? 'menu-open' : '' }} {{ request()->is('admin/pesananterimas*') ? 'menu-open' : '' }} {{ request()->is('admin/pesananbatals*') ? 'menu-open' : '' }} {{ request()->is('admin/pesananambils*') ? 'menu-open' : '' }}">
                        <a class="nav-link nav-dropdown-toggle">
                            <i class="fas fa-briefcase">

                            </i>
                            <p>
                                <span>Daftar Pesanan</span>
                                <i class="right fa fa-angle-left"></i>
                            </p>
                        </a>
                <ul class="nav nav-treeview">
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
                        <a href="{{ route("admin.pesananprosess.index") }}" class="nav-link {{ request()->is('admin/pesananprosess') || request()->is('admin/pesananprosess/*') ? 'active' : '' }}">
                            <i class="fas fa-envelope-open">

                            </i>
                            <p>
                                <span>Pesanan Proses</span>
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route("admin.pesanankirims.index") }}" class="nav-link {{ request()->is('admin/pesanankirims') || request()->is('admin/pesanankirims/*') ? 'active' : '' }}">
                            <i class="fas fa-envelope-open">

                            </i>
                            <p>
                                <span>Pesanan Kirim</span>
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route("admin.pesananterimas.index") }}" class="nav-link {{ request()->is('admin/pesananterimas') || request()->is('admin/pesananterimas/*') ? 'active' : '' }}">
                            <i class="fas fa-envelope-open">

                            </i>
                            <p>
                                <span>Pesanan Terima</span>
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route("admin.pesananbatals.index") }}" class="nav-link {{ request()->is('admin/pesananbatals') || request()->is('admin/pesananbatals/*') ? 'active' : '' }}">
                            <i class="fas fa-envelope-open">

                            </i>
                            <p>
                                <span>Pesanan Batal</span>
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route("admin.pesananambils.index") }}" class="nav-link {{ request()->is('admin/pesananambils') || request()->is('admin/pesananambils/*') ? 'active' : '' }}">
                            <i class="fas fa-envelope-open">

                            </i>
                            <p>
                                <span>Pesanan Ambil</span>
                            </p>
                        </a>
                    </li>
                </ul>
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
                    <li class="nav-item has-treeview {{ request()->is('admin/keuntungans*') ? 'menu-open' : '' }} {{ request()->is('admin/transaksis*') ? 'menu-open' : '' }} {{ request()->is('admin/saldomasuks*') ? 'menu-open' : '' }} {{ request()->is('admin/saldocairs*') ? 'menu-open' : '' }} {{ request()->is('admin/laporanjurnals*') ? 'menu-open' : '' }}">
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
                                            <span>Saldo Penjual</span>
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
                                <li class="nav-item">
                                    <a href="{{ route("admin.laporanjurnals.index") }}" class="nav-link {{ request()->is('admin/laporanjurnals') || request()->is('admin/laporanjurnals/*') ? 'active' : '' }}">
                                        <i class="fas fa-cart-arrow-down">

                                        </i>
                                        <p>
                                            <span>Laporan Transaksi</span>
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
                            <span>Keluar</span>
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>