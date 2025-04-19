<div class="sidebar">
    <!-- Sidebar Search Form -->
    <div class="form-inline mt-2">
        <div class="input-group" data-widget="sidebar-search">
            <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
                <button class="btn btn-sidebar">
                    <i class="fas fa-search fa-fw"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            
            <!-- Dashboard -->
            <li class="nav-item">
                <a href="{{ url('/') }}" class="nav-link {{ ($activeMenu == 'dashboard') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>Dashboard</p>
                </a>
            </li>

            <!-- Data Pengguna -->
            <li class="nav-header">Data Pengguna</li>
            <li class="nav-item">
                <a href="{{ url('/level') }}" class="nav-link {{ ($activeMenu == 'level') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-layer-group"></i>
                    <p>Level User</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ url('/user') }}" class="nav-link {{ ($activeMenu == 'user') ? 'active' : '' }}">
                    <i class="nav-icon far fa-user"></i>
                    <p>Data User</p>
                </a>
            </li>

            <!-- Data Departemen -->
<li class="nav-header">Data Departemen</li>
<li class="nav-item">
    <a href="{{ url('/departemen') }}" class="nav-link {{ ($activeMenu == 'departemen') ? 'active' : '' }}">
        <i class="nav-icon fas fa-building"></i>
        <p>Data Departemen</p>
    </a>
</li>


<li class="nav-item">
    <a href="{{ url('/jabatan') }}" class="nav-link {{ ($activeMenu == 'jabatan') ? 'active' : '' }}">
        <i class="nav-icon fas fa-briefcase"></i>
        <p>Data Jabatan</p>
    </a>
</li>

        <!-- Data Karyawan -->
<li class="nav-header">Data Karyawan</li>
<li class="nav-item">
    <a href="{{ url('/karyawan') }}" class="nav-link {{ ($activeMenu == 'karyawan') ? 'active' : '' }}">
        <i class="nav-icon fas fa-users"></i>
        <p>Data Karyawan</p>
    </a>
</li>

<!-- Manajemen Cuti -->
<li class="nav-header">Manajemen Cuti</li>
<li class="nav-item">
    <a href="{{ url('/cuti') }}" class="nav-link {{ ($activeMenu == 'cuti') ? 'active' : '' }}">
        <i class="nav-icon fas fa-calendar-check"></i>
        <p>Data Cuti</p>
    </a>
</li>



<!-- Logout -->
<li class="nav-header">Logout</li>
<li class="nav-item">
    <form action="{{ route('logout') }}" method="POST" style="display: inline;">
        @csrf
        <button type="submit" class="nav-link btn btn-link text-left" style="color: #c2c7d0; width: 100%; text-align: left;">
            <i class="nav-icon fas fa-sign-out-alt"></i>
            <p>Logout</p>
        </button>
    </form>
</li>



        


          

            <!-- Data Transaksi -->
        
        </ul>
    </nav>
</div>
