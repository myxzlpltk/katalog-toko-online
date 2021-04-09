<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
    <div class="sidebar-brand-icon">
      <i class="fab fa-laravel"></i>
    </div>
    <div class="sidebar-brand-text mx-3">Katalog</div>
  </a>

  <hr class="sidebar-divider my-0">

  <li class="nav-item @if(Route::is('admin.dashboard')) active @endif">
    <a class="nav-link" href="{{ route('admin.dashboard') }}">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span>Dasbor</span>
    </a>
  </li>

  <hr class="sidebar-divider d-none d-md-block">

  <div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
  </div>
</ul>
