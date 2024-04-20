<?php 
    use Illuminate\Support\Facades\Request;
?>

<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    
        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('/home') }}">
        <div class="sidebar-brand-icon">
            <i class="fas fa-paper-plane"></i>
        </div>
        <div class="sidebar-brand-text">{{ config('app.name') }}</div>
        </a>
    
        <!-- Divider -->
        <hr class="sidebar-divider my-0">
    
        <!-- Nav Item - Homepage -->
        <li class="nav-item {{ request()->is('home') ? 'active' : '' }}">
            <a class="nav-link" href="{{ url('/home') }}">
                <i class="fas fa-fw fa-home"></i>
                <span>Homepage</span>
            </a>
        </li>
    
        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Nav Item - Manage Users -->
        @if(auth()->user()->role === 'admin')
        <li class="nav-item mt-n3 {{ request()->is('manageusers') ? 'active' : '' }}">
            <a class="nav-link" href="{{ url('/manageusers') }}">
                <i class="fas fa-fw fa-user-friends"></i>
                <span>Manage Users</span>
            </a>
        </li>
        @endif

        <!-- Nav Item - Manage Mahasiswa -->
        <li class="nav-item mt-n3 {{ request()->is('managemahasiswa') ? 'active' : '' }}">
            <a class="nav-link" href="{{ url('/managemahasiswa') }}">
                <i class="fas fa-fw fa-users"></i>
                <span>Manage Mahasiswa</span>
            </a>
        </li>

        @if(auth()->user()->role === 'admin')

        <!-- Divider -->
        <hr class="sidebar-divider">


        <!-- Nav Item - Manage Kriteria -->
        <li class="nav-item mt-n3 {{ request()->is('managekriteria') ? 'active' : '' }}">
            <a class="nav-link" href="{{ url('/managekriteria') }}">
                <i class="fas fa-fw fa-list-ol"></i>
                <span>Manage Kriteria</span>
            </a>
        </li>
        
        <!-- Nav Item - Matrix Kriteria AHP -->
        <li class="nav-item mt-n3 {{ request()->is('matrixkriteriaahp') ? 'active' : '' }}">
            <a class="nav-link" href="{{ url('/matrixkriteriaahp') }}">
                <i class="fas fa-fw fa-th"></i>
                <span>Matrix Kriteria AHP</span>
            </a>
        </li>
        
        <!-- Nav Item - Bobot Kriteria TOPSIS-->
        <li class="nav-item mt-n3 {{ request()->is('bobotkriteriatopsis') ? 'active' : '' }}">
            <a class="nav-link" href="{{ url('/bobotkriteriatopsis') }}">
                <i class="fas fa-fw fa-list"></i>
                <span>Bobot Kriteria TOPSIS</span>
            </a>
        </li>
        @endif

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Nav Item - Generate Peringkat -->
        <li class="nav-item mt-n3 {{ request()->is('generate') ? 'active' : '' }}">
            <a class="nav-link" href="{{ url('/generate') }}">
                <i class="fas fa-fw fa-cogs"></i>
                <span>Generate Peringkat</span>
            </a>
        </li>

        <!-- Nav Item - Hasil Generate Peringkat -->
        <li class="nav-item mt-n3 {{ request()->is('generate/result') ? 'active' : '' }}">
            <a class="nav-link" href="{{ url('/generate/result') }}">
                <i class="fas fa-fw fa-table"></i>
                <span>Hasil Generate Peringkat</span>
            </a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">
    
        <!-- Nav Item - My Profile -->
        <li class="nav-item mt-n3 {{ request()->is('myprofile') ? 'active' : '' }}">
            <a class="nav-link" href="{{ url('/myprofile') }}">
                <i class="fas fa-fw fa-user"></i>
                <span>My Profile</span>
            </a>
        </li>
    
        <!-- Divider -->
        <hr class="sidebar-divider">
    
        <!-- Nav Item - Log Out -->
        <li class="nav-item mt-n3">
            <a class="nav-link" href="#" data-toggle="modal" data-target="#logoutModal">
                <i class="fas fa-fw fa-sign-out-alt"></i>
                <span>Logout</span>
            </a>
        </li>
    
        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">
    
        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>
    
    </ul>
    <!-- End of Sidebar -->