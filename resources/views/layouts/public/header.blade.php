<header class="header @sectionMissing('header-transparent') header--normal @endif">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-3 col-md-3">
				<div class="header__logo">
					<a href="#"><img src="{{ asset('img/logo.png') }}" alt=""></a>
				</div>
			</div>
			<div class="col-lg-9 col-md-9">
				<div class="header__nav">
					<nav class="header__menu mobile-menu">
						<ul>
							<li></li>
							<li></li>
							<li></li>
							<li></li>
							<li class="active"><a href="{{ route('home') }}">Home</a></li>
							<li>
								<a href="#">Kategori</a>
								<ul class="dropdown">
									@foreach(\App\Models\Category::all() as $category)
									<li><a href="{{ route('shops.search', ['category_id' => $category->id]) }}">{{ $category->name }}</a></li>
									@endforeach
								</ul>
							</li>
							<li><a href="#">Contact</a></li>
							<li><a href="#">About</a></li>
						</ul>
					</nav>
					<div class="header__menu__right">
						<a href="@auth {{ route('dashboard') }} @else {{ route('login') }} @endauth" class="login-btn"><i class="fa fa-user"></i></a>
					</div>
				</div>
			</div>
		</div>
		<div id="mobile-menu-wrap"></div>
	</div>
</header>
