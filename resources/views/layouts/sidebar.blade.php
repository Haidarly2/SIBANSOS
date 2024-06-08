<div class="sidebar">
    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            @php
                $dashboardUrl = '#';
                if (Auth::user()->id_level == 1) {
                    $dashboardUrl = url('/admin/index');
                } elseif (Auth::user()->id_level == 2) {
                    $dashboardUrl = url('/rt/index');
                } elseif (Auth::user()->id_level == 3) {
                    $dashboardUrl = url('/user/index');
                }
            @endphp
            <li class="nav-item">
                <a href="{{ $dashboardUrl }}" class="nav-link {{ $activeMenu == 'dashboard' ? 'active' : '' }}">
                    <i class="nav-icon fas fa-home"></i>
                    <p>Dashboard</p>
                </a>
            </li>
            @if (Auth::user()->id_level == 1)
                <!-- Menu untuk RW -->
                <li class="nav-header">Menu Administrasi</li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Data Warga
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        
                        <li class="nav-item">
                            <a href="{{ url('/warga') }}" class="nav-link">
                                <i class="fas fa-user-edit nav-icon"></i>
                                <p>Data Warga</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/riwayat') }}" class="nav-link">
                                <i class="fas fa-user-edit nav-icon"></i>
                                <p>Riwayat Data Warga</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/level') }}" class="nav-link">
                                <i class="fas fa-print nav-icon"></i>
                                <p>Cetak Data Warga</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-header">Menu Bantuan Sosial</li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-hand-holding-heart"></i>
                        <p>
                            Bantuan Sosial
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ url('/bansos') }}" class="nav-link">
                                <i class="fas fa-database nav-icon"></i>
                                <p>Data Bansos</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/bantuan') }}" class="nav-link">
                                <i class="fas fa-users nav-icon"></i>
                                <p>List Daftar Bantuan</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/penerima') }}" class="nav-link">
                                <i class="fas fa-users nav-icon"></i>
                                <p>Data Penerima</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/stok') }}" class="nav-link">
                                <i class="fas fa-print nav-icon"></i>
                                <p>Cetak Data Penerima</p>
                            </a>
                        </li>
                    </ul>
                </li>
            @elseif (Auth::user()->id_level == 2)
                <!-- Menu untuk RT -->
                <li class="nav-header">Menu Administrasi</li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Data Warga
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        
                        <li class="nav-item">
                            <a href="{{ url('/warga') }}" class="nav-link">
                                <i class="fas fa-user-edit nav-icon"></i>
                                <p>Data Warga</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/riwayat') }}" class="nav-link">
                                <i class="fas fa-user-edit nav-icon"></i>
                                <p>Riwayat Data Warga</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/level') }}" class="nav-link">
                                <i class="fas fa-print nav-icon"></i>
                                <p>Cetak Data Warga</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-header">Menu Bantuan Sosial</li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-hand-holding-heart"></i>
                        <p>
                            Bantuan Sosial
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ url('/bansos') }}" class="nav-link">
                                <i class="fas fa-database nav-icon"></i>
                                <p>Data Bansos</p>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ url('/setting') }}" class="nav-link">
                                <i class="fas fa-database nav-icon"></i>
                                <p>Data Penerima</p>
                            </a>
                        </li>
                    </ul>
                </li>
            @elseif (Auth::user()->id_level == 3)
                <!-- Menu untuk warga -->
            @endif
            <li class="nav-header">Menu Pengajuan</li>
            <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-file-alt"></i>
                    <p>
                        Pengajuan Surat
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ url('/setting') }}" class="nav-link">
                            <i class="far fa-file-alt nav-icon"></i>
                            <p>Pengajuan Dokumen</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('/pengajuan-bansos') }}" class="nav-link">
                            <i class="fas fa-hands-helping nav-icon"></i>
                            <p>Pengajuan Bansos</p>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-header">Menu Pengaturan</li>
            <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-cogs"></i>
                    <p>
                        Pengaturan
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ url('/profil') }}" class="nav-link">
                            <i class="fas fa-user-cog nav-icon"></i>
                            <p>Profil Pengguna</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('/setting') }}" class="nav-link">
                            <i class="fas fa-cog nav-icon"></i>
                            <p>Pengaturan Akun</p>
                        </a>
                    </li>
                </ul>
            </li> 
            
        </ul>
    </nav>
    <!-- /.sidebar-menu -->
</div>
