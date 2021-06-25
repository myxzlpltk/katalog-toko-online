<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
	<a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
		<div class="sidebar-brand-icon">
			<i class="fab fa-laravel"></i>
		</div>
		<div class="sidebar-brand-text mx-3">Katalog</div>
	</a>

	<hr class="sidebar-divider my-0">

	<li class="nav-item @if(Route::is('console.dashboard')) active @endif">
		<a class="nav-link" href="{{ route('console.dashboard') }}">
			<i class="fas fa-fw fa-tachometer-alt"></i>
			<span>Dasbor</span>
		</a>
	</li>

	@can('is-student')
		@can('view', request()->user()->userable->business)
		<hr class="sidebar-divider">

		<div class="sidebar-heading">
			Data Primer
		</div>
		@endcan
	@else
		<hr class="sidebar-divider">

		<div class="sidebar-heading">
			Data Primer
		</div>
	@endcan

	@can('is-student')
		@can('view', request()->user()->userable->business)
		<li class="nav-item @if(Route::is('console.businesses.*') && !Route::is('console.businesses.feed-plans.*')) active @endif">
			<a class="nav-link" href="{{ route('console.businesses.show', request()->user()->userable->business) }}">
				<i class="fas fa-fw fa-store"></i>
				<span>Data Usaha</span>
			</a>
		</li>
		@endcan
	@endcan

	@can('view-any', \App\Models\Business::class)
		<li class="nav-item @if(Route::is('console.businesses.*') || Route::is('console.feed-plans.*') || Route::is('console.feed-plan-designs.*')) active @endif">
			<a class="nav-link" href="{{ route('console.businesses.index') }}">
				<i class="fas fa-fw fa-store"></i>
				<span>Data Usaha</span>
			</a>
		</li>
	@endcan

	@can('is-student')
		@can('view-any', [\App\Models\FeedPlan::class, request()->user()->userable->business])
		<li class="nav-item @if(Route::is('console.businesses.feed-plans.*') || Route::is('console.feed-plans.*') || Route::is('console.feed-plan-designs.*')) active @endif">
			<a class="nav-link" href="{{ route('console.businesses.feed-plans.index', request()->user()->userable->business) }}">
				<i class="fa fa-fw fa-route"></i>
				<span>Data Feed Plan</span>
			</a>
		</li>
		@endcan
	@endcan

	@can('view-any', \App\Models\BusinessField::class)
	<li class="nav-item @if(Route::is('console.business-fields.*') || Route::is('console.business-types.*')) active @endif">
		<a class="nav-link" href="{{ route('console.business-fields.index') }}">
			<i class="fas fa-fw fa-tags"></i>
			<span>Data Bidang Usaha</span>
		</a>
	</li>
	@endcan

	@can('view-any', \App\Models\Teacher::class)
		<li class="nav-item @if(Route::is('console.teachers.*')) active @endif">
			<a class="nav-link" href="{{ route('console.teachers.index') }}">
				<i class="fas fa-fw fa-chalkboard-teacher"></i>
				<span>Data Dosen</span>
			</a>
		</li>
	@endcan

	@can('view-any', \App\Models\Student::class)
		<li class="nav-item @if(Route::is('console.students.*')) active @endif">
			<a class="nav-link" href="{{ route('console.students.index') }}">
				<i class="fas fa-fw fa-user-graduate"></i>
				<span>Data Mahasiswa</span>
			</a>
		</li>
	@endcan

	<hr class="sidebar-divider d-none d-md-block">

	<div class="text-center d-none d-md-inline">
		<button class="rounded-circle border-0" id="sidebarToggle"></button>
	</div>
</ul>
