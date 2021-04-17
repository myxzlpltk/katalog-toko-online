<!DOCTYPE html>
<html lang="zxx">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	{!! \Artesaos\SEOTools\Facades\SEOTools::generate() !!}
	<link rel="icon" href="https://um.ac.id/wp-content/uploads/2020/08/cropped-Lambang-UM-32x32.png" sizes="32x32" />
	<link rel="icon" href="https://um.ac.id/wp-content/uploads/2020/08/cropped-Lambang-UM-192x192.png" sizes="192x192" />
	<link rel="apple-touch-icon" href="https://um.ac.id/wp-content/uploads/2020/08/cropped-Lambang-UM-180x180.png" />
	<meta name="msapplication-TileImage" content="https://um.ac.id/wp-content/uploads/2020/08/cropped-Lambang-UM-270x270.png" />

	<title>{{ config('app.name') }} - @yield('title', 'Halaman Kosong')</title>

	<!-- Google Font -->
	<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">

	<!-- Css Styles -->
	<link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" type="text/css">
	<link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}" type="text/css">
	<link rel="stylesheet" href="{{ asset('css/elegant-icons.css') }}" type="text/css">
	<link rel="stylesheet" href="{{ asset('css/flaticon.css') }}" type="text/css">
	<link rel="stylesheet" href="{{ asset('css/nice-select.css') }}" type="text/css">
	<link rel="stylesheet" href="{{ asset('css/barfiller.css') }}" type="text/css">
	<link rel="stylesheet" href="{{ asset('css/magnific-popup.css') }}" type="text/css">
	<link rel="stylesheet" href="{{ asset('css/jquery-ui.min.css') }}" type="text/css">
	<link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}" type="text/css">
	<link rel="stylesheet" href="{{ asset('css/slicknav.min.css') }}" type="text/css">
	<link rel="stylesheet" href="{{ asset('css/style.css') }}" type="text/css">

	@yield('stylesheets')

</head>
<body class="@yield('bodyClass')">

@if(\Illuminate\Support\Facades\App::environment('production'))
	<div id="preloder">
		<div class="loader"></div>
	</div>
@endif

@include('layouts.public.header')

@yield('content')

@sectionMissing('hide-footer')
	@include('layouts.public.footer')
@endif

<script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/jquery.nice-select.min.js') }}"></script>
<script src="{{ asset('js/jquery-ui.min.js') }}"></script>
<script src="{{ asset('js/jquery.nicescroll.min.js') }}"></script>
<script src="{{ asset('js/jquery.barfiller.js') }}"></script>
<script src="{{ asset('js/jquery.magnific-popup.min.js') }}"></script>
<script src="{{ asset('js/jquery.slicknav.js') }}"></script>
<script src="{{ asset('js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('js/main.js') }}"></script>

@yield('scripts')

</body>
</html>
