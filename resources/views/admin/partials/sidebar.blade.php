<style>
    .color-li-red{
        color: red;
    }
</style>
<nav class="sidebar vertical-scroll  ps-container ps-theme-default ps-active-y">
    <div class="logo d-flex justify-content-between">
        <a href="{{ route('dashboard') }}"><img src="{{ asset('admin/img/logo.png') }}" alt=""></a>
        <div class="sidebar_close_icon d-lg-none">
            <i class="ti-close"></i>
        </div>
    </div>
    <ul id="sidebar_menu">
        @if (Auth::check())    
        <li class="">
            <a class="" href="{{ route('dashboard') }}" aria-expanded="false">
                <div class="icon_menu">
                    <img src="{{ asset('/admin/img/menu-icon/dashboard.svg') }}" alt="">
                </div>
                @if ($title == 'Dashboard Kas')
                    <span class="dashboard-active">Dashboard</span>
                @else
                    <span>Dashboard</span>
                @endif
            </a>
        </li>
        @if (auth()->user()->role == 'Admin')    
        <li class="{{ $active == 'table' ? 'mm-active' : '' }}">
            <a class="has-arrow" href="#" aria-expanded="false">
                <div class="icon_menu">
                    <i class="ti-harddrives m-auto"></i>
                </div>
                <span>Table</span>
            </a>
            <ul>
                <li><a href="{{ route('user') }}" style="color: {{ $act == 'tableuser' ? 'red' : '' }}">Data Pengguna</a></li>
                <li><a href="{{ route('kas-masuk') }}" style="color: {{ $act == 'tablekasmasuk' ? 'red' : '' }}">Kas Masuk</a></li>
                <li><a href="{{ route('kas-keluar') }}" style="color: {{ $act == 'tablekaskeluar' ? 'red' : '' }}">Kas Keluar</a></li>
            </ul>
        </li>
        @endif


        <li class="{{ $active == 'laporan' ? 'mm-active' : '' }}">
            <a class="has-arrow" href="#" aria-expanded="false">
                <div class="icon_menu">
                    <i class="ti-folder m-auto"></i>
                </div>
                <span>Laporan</span>
            </a>
            <ul>
                <li><a href="{{ route('laporan-masuk') }}" style="color: {{ $act == 'laporanmasuk' ? 'red' : '' }}">Laporan Kas Masuk</a></li>
                <li><a href="{{ route('laporan-keluar') }}" style="color: {{ $act == 'laporankeluar' ? 'red' : '' }}">Laporan Kas Keluar</a></li>
            </ul>
        </li>
        @else
        <li>
            <a href="{{ route('login') }}" class="has-arrow">
                <div class="icon_menu ti-user">
                </div>
                <span> Login to view sidebar</span>
            </a>
        </li>
        @endif
    </ul>
</nav>
