@extends('layouts.public.app')

@section('title', 'Pencarian Toko')
@section('bodyClass', 'ov-hid')
@section('hide-footer', true)

@section('stylesheets')
	<style>
		.filter__price .price-input:after{
			display: none;
		}
	</style>
@endsection

@section('content')
	<form action="{{ route('shop.search') }}" method="get">
		<input type="hidden" name="sort_rating" value="{{ request('sort_rating') }}">
		<div class="filter nice-scroll">
			<div class="filter__title">
				<h5><i class="fa fa-filter"></i> Filter</h5>
			</div>
			<div class="filter__search">
				<input type="text" name="query" value="{{ request('query') }}" placeholder="Pencarian...">
			</div>
			<div class="filter__select">
				<select name="category_id">
					<option value="">Semua Kategori</option>
					@foreach($categories as $category)
						<option value="{{ $category->id }}" @if($category->id == request('category_id')) selected @endif>{{ $category->name }}</option>
					@endforeach
				</select>
			</div>
			<div class="filter__price">
				<p>Harga:</p>
				<div class="price-range-wrap">
					<div class="price-range-mine ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content">
						<div class="ui-slider-range ui-corner-all ui-widget-header"></div>
						<span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
					</div>
					<div class="range-slider">
						<div class="price-input">
							<input type="text" id="min_price" name="min_price" value="{{ floor($min_price/1000) }}K">
							<span class="text-danger"> - </span>
							<input type="text" id="max_price" value="{{ ceil($max_price/1000) }}K">
						</div>
					</div>
				</div>
			</div>
			<div class="filter__btns">
				<button type="submit">Filter Hasil</button>
				<button type="button" class="filter__reset"><a href="{{ route('shop.search') }}" class="text-dark">Reset Filter</a></button>
			</div>
		</div>
	</form>

	<section class="listing nice-scroll w-100">
		<div class="listing__text__top">
			<div class="listing__text__top__left">
				<h5>Hasil Pencarian Toko</h5>
				<span>{{ $shops->total() }} Ditemukan</span>
			</div>
			<div class="listing__text__top__right">
				<form action="{{ route('shop.search') }}">
					<input type="hidden" name="query" value="{{ request('query') }}">
					<input type="hidden" name="category_id" value="{{ request('category_id') }}">
					<input type="hidden" name="sort_rating" value="{{ request('sort_rating') == 'asc' ? 'desc' : 'asc' }}">
					<button type="submit" class="btn btn-link text-dark text-decoration-none">
						Rating
						@if(request('sort_rating') == 'asc')
							<i class="fa fa-sort-amount-asc"></i>
						@else
							<i class="fa fa-sort-amount-desc"></i>
						@endif
					</button>
				</form>
			</div>
		</div>
		<div class="listing__list">
			@foreach($shops as $shop)
			<div class="listing__item">
				<div class="listing__item__pic set-bg" data-setbg="{{ asset("storage/photos/{$shop->photos_max_file}") }}">
					<img src="{{ $shop->logo_path }}" alt="">
					<div class="listing__item__pic__tag">{{ $shop->category->name }}</div>
				</div>
				<div class="listing__item__text">
					<div class="listing__item__text__inside">
						<a href="{{ route('shop.view', $shop) }}">
							<h5>{{ $shop->name }}</h5>
							<div class="listing__item__text__rating">
								<div class="listing__item__rating__star">
									{!! \App\Helpers\Helper::rating($shop->public_reviews_avg_rating) !!}
								</div>
								<h6>{{ $shop->price_range }}</h6>
							</div>
							<ul>
								<li><span class="icon_pin_alt"></span> {{ $shop->address }}</li>
								<li><span class="icon_phone"></span> {{ $shop->phone_number }}</li>
							</ul>
						</a>
					</div>
					<div class="listing__item__text__info">
						<div class="listing__item__text__info__left">Jam Buka</div>
						@if($shop->is_open)
							<div class="listing__item__text__info__right">Buka Sekarang</div>
						@else
							<div class="listing__item__text__info__right text-danger">Tutup</div>
						@endif
					</div>
				</div>
			</div>
			@endforeach
		</div>

		<div class="mb-4 d-flex justify-content-center">
			{{ $shops->links() }}
		</div>
	</section>
@endsection

@section('scripts')
	<script>
		var rangeSliderPrice = $(".price-range-mine");
		var min_price = $("#min_price");
		rangeSliderPrice.slider({
			range: 'min',
			min: {{ floor($min_price/1000) }},
			max: {{ ceil($max_price/1000) }},
			value: {{ max(floor($min_price/1000), intval(request('min_price', 0))) }},
			step: {{ max(1, round(ceil($max_price)/1000-floor($min_price/1000))/20) }},
			slide: function (event, ui) {
				min_price.val(ui.value + 'K');
			}
		});
		min_price.val(rangeSliderPrice.slider("value") + 'K');
	</script>
@endsection
