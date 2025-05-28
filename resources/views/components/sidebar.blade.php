<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center py-4" href="/">
        <div class="sidebar-brand-icon">
            <img src="{{ asset('images/logo_white.png') }}" alt="Logo" class="w-100">
        </div>
    </a>

    <hr class="sidebar-divider my-0">

    <!-- Dashboard -->
    <li class="nav-item {{ Request::is('dashboard') ? 'active' : '' }}">
        <a class="nav-link py-3 fs-4" href="/dashboard" data-bs-toggle="tooltip" data-bs-placement="right" title="Dashboard">
            <i class="fas fa-home fs-3"></i>
            <span class="ms-2">Dashboard</span>
        </a>
    </li>

    <hr class="sidebar-divider">

    <!-- Section 1 -->
    <div class="sidebar-heading text-light">
        Superadmin
    </div>

    <li class="nav-item {{ Request::is('dashboard/perusahaan*') ? 'active' : '' }}">
        <a class="nav-link py-3 fs-4" href="/dashboard/perusahaan" data-bs-toggle="tooltip" data-bs-placement="right" title="Perusahaan">
            <i class="fas fa-building fs-3"></i>
            <span class="ms-2">Perusahaan</span>
        </a>
    </li>

    <li class="nav-item {{ Request::is('dashboard/akunAdmin*') ? 'active' : '' }}">
        <a class="nav-link py-3 fs-4" href="/dashboard/akunAdmin" data-bs-toggle="tooltip" data-bs-placement="right" title="Akun Admin">
            <i class="fas fa-user-shield fs-3"></i>
            <span class="ms-2">Akun Admin</span>
        </a>
    </li>

    <li class="nav-item {{ Request::is('dashboard/layanan*') ? 'active' : '' }}">
        <a class="nav-link py-3 fs-4" href="/dashboard/layanan" data-bs-toggle="tooltip" data-bs-placement="right" title="Layanan">
            <i class="fas fa-concierge-bell fs-3"></i>
            <span class="ms-2">Layanan</span>
        </a>
    </li>

    <li class="nav-item {{ Request::is('dashboard/partner*') ? 'active' : '' }}">
        <a class="nav-link py-3 fs-4" href="/dashboard/partner" data-bs-toggle="tooltip" data-bs-placement="right" title="Partner">
            <i class="fas fa-handshake fs-3"></i>
            <span class="ms-2">Partner</span>
        </a>
    </li>

    <li class="nav-item {{ Request::is('dashboard/berita*') ? 'active' : '' }}">
        <a class="nav-link py-3 fs-4" href="/dashboard/berita" data-bs-toggle="tooltip" data-bs-placement="right" title="Berita">
            <i class="fas fa-newspaper fs-3"></i>
            <span class="ms-2">Berita</span>
        </a>
    </li>

    <li class="nav-item {{ Request::is('dashboard/banner*') ? 'active' : '' }}">
        <a class="nav-link py-3 fs-4" href="/dashboard/banner" data-bs-toggle="tooltip" data-bs-placement="right" title="Banner">
            <i class="fas fa-image fs-3"></i>
            <span class="ms-2">Banner</span>
        </a>
    </li>

    <li class="nav-item {{ Request::is('dashboard/portofolio*') ? 'active' : '' }}">
        <a class="nav-link py-3 fs-4" href="/dashboard/portofolio" data-bs-toggle="tooltip" data-bs-placement="right" title="Portofolio">
            <i class="fas fa-briefcase fs-3"></i>
            <span class="ms-2">Portofolio</span>
        </a>
    </li>

    <li class="nav-item {{ Request::is('dashboard/faq*') ? 'active' : '' }}">
        <a class="nav-link py-3 fs-4" href="/dashboard/faq" data-bs-toggle="tooltip" data-bs-placement="right" title="FAQ">
            <i class="fas fa-question-circle fs-3"></i>
            <span class="ms-2">FAQ</span>
        </a>
    </li>

    <li class="nav-item {{ Request::is('dashboard/email*') ? 'active' : '' }}">
        <a class="nav-link py-3 fs-4" href="/dashboard/email" data-bs-toggle="tooltip" data-bs-placement="right" title="Email">
            <i class="fas fa-envelope fs-3"></i>
            <span class="ms-2">Email</span>
        </a>
    </li>

    <hr class="sidebar-divider">

    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
