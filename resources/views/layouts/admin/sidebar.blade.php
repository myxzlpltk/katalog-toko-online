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

	<hr class="sidebar-divider">

	<div class="sidebar-heading">
		Data Primer
	</div>

	<li class="nav-item @if(Route::is('admin.shops.*')) active @endif">
		<a class="nav-link" href="{{ route('admin.shops.index') }}">
			<i class="fas fa-fw fa-store"></i>
			<span>Data Toko</span>
		</a>
	</li>

	<li class="nav-item @if(Route::is('admin.categories.*')) active @endif">
		<a class="nav-link" href="{{ route('admin.categories.index') }}">
			<i class="fas fa-fw fa-tags"></i>
			<span>Data Kategori</span>
		</a>
	</li>

	<li class="nav-item @if(Route::is('admin.teachers.*')) active @endif">
		<a class="nav-link" href="{{ route('admin.teachers.index') }}">
			<i class="fas fa-fw fa-chalkboard-teacher"></i>
			<span>Data Dosen</span>
		</a>
	</li>

	<hr class="sidebar-divider d-none d-md-block">

	<div class="text-center d-none d-md-inline">
		<button class="rounded-circle border-0" id="sidebarToggle"></button>
	</div>
</ul>
