@extends('layouts.public.app')

@section('title', $shop->name)

@section('stylesheets')
@endsection

@section('header-transparent', true)

@section('content')
	<section class="listing-hero set-bg" data-setbg="{{ asset("storage/photos/{$shop->photos_max_file}") }}">
		<div class="container">
			<div class="listing__hero__option">
				<div class="listing__hero__icon">
					<img src="{{ $shop->logo_path }}" alt="">
				</div>
				<div class="listing__hero__text">
					<h2>{{ $shop->name }}</h2>
					<div class="listing__hero__widget">
						<div class="listing__hero__widget__rating">
							{!! \App\Helpers\Helper::rating($shop->reviews_avg_rating) !!}
						</div>
						<div>{{ $shop->reviews_count }} Review</div>
					</div>
					<p><span class="icon_pin_alt"></span> {{ $shop->address }}</p>
				</div>
			</div>
		</div>
	</section>

	<section class="listing-details spad">
		<div class="container">
			<div class="row">
				<div class="col-lg-8">
					<div class="listing__details__text">
						<div class="listing__details__about">
							<h4>Deskripsi</h4>
							{!! nl2br(e($shop->description)) !!}
						</div>
						<div class="listing__details__gallery">
							<h4>Galeri</h4>
							@if(count($shop->photos) > 0)
							<div class="listing__details__gallery__pic">
								<div class="listing__details__gallery__item">
									<img class="listing__details__gallery__item__large"
										 src="{{ asset("storage/photos/{$shop->photos->first()->file}") }}" alt="">
									<span><i class="fa fa-camera"></i> {{ $shop->photos->count() }} Foto</span>
								</div>
								<div class="listing__details__gallery__slider owl-carousel">
									@foreach($shop->photos as $photo)
									<img data-imgbigurl="{{ asset("storage/photos/{$photo->file}") }}"
										 src="{{ asset("storage/photos/{$photo->file}") }}" alt="">
									@endforeach
								</div>
							</div>
							@else
								<p>Tidak ada photo</p>
							@endif
						</div>
						<div class="listing__details__rating">
							<h4>Nilai</h4>
							<div class="listing__details__rating__overall">
								<h2>{{ bcdiv($shop->reviews_avg_rating, 1, 1) }}</h2>
								<div class="listing__details__rating__star">
									{!! \App\Helpers\Helper::rating($shop->reviews_avg_rating) !!}
								</div>
								<span>({{ $shop->reviews_count }} Rating)</span>
							</div>
							<div class="listing__details__rating__bar">
								@for($i=5; $i>0; $i--)
								<div class="listing__details__rating__bar__item">
									<span>{{ $i }} <span class="icon_star"></span></span>
									<div id="bar{{ $i }}" class="barfiller">
										<span class="fill" data-percentage="{{ round($shop->reviews->where('rating', $i)->count() / max($shop->reviews_count, 1) * 100) }}"></span>
									</div>
									<span class="right">{{ $shop->reviews->where('rating', $i)->count() }} Review</span>
								</div>
								@endfor
							</div>
						</div>
						<div class="listing__details__comment">
							<h4>Komentar</h4>
							@foreach($shop->reviews->where('published_at', '!=', null)->sortByDesc('created_at')->sortByDesc('rating')->take(request()->get('review') ? null : 3) as $review)
							<div class="listing__details__comment__item">
								<div class="listing__details__comment__item__text">
									<div class="listing__details__comment__item__rating">
										{!! \App\Helpers\Helper::rating($review->rating) !!}
									</div>
									<span>{{ $review->created_at->format('d F Y') }}</span>
									<h5>{{ $review->name }}</h5>
									<p>{{ $review->review_text }}</p>
								</div>
							</div>
							@endforeach

							@if($shop->reviews_count > 3 && !request()->get('review'))
								<div class="mb-4 text-center">
									<a href="{{ route('shop.view', [$shop, 'review' => true]) }}" class="site-btn">Lihat Semua Review</a>
								</div>
							@endif
						</div>
						<div class="listing__details__review">
							<h4>Tambah Review</h4>
							<form action="#">
								<input type="text" placeholder="Nama">
								<input type="text" placeholder="Email">
								<textarea placeholder="Review"></textarea>
								<button type="submit" class="site-btn">Submit</button>
							</form>
						</div>
					</div>
				</div>
				<div class="col-lg-4">
					<div class="listing__sidebar">
						<div class="listing__sidebar__contact">
							<div class="listing__sidebar__contact__map">
								<iframe
									src="https://maps.google.com/maps?width=100%25&height=200&hl=en&q={{ urlencode($shop->address) }} }}&t=&z=14&ie=UTF8&iwloc=B&output=embed"
									height="200" style="border:0;" allowfullscreen="" aria-hidden="false"
									tabindex="0"></iframe>
							</div>
							<div class="listing__sidebar__contact__text">
								<h4>Kontak</h4>
								<ul>
									<li><span class="icon_pin_alt"></span> {{ $shop->address }}</li>
									<li><span class="icon_phone"></span> {{ $shop->phone_number }}</li>
								</ul>
							</div>
						</div>
						<div class="listing__sidebar__working__hours">
							<h4>Jam Buka</h4>
							<ul>
								<li>Senin <span class="@if(!$shop->monday_open || !$shop->monday_close) closed @elseif($shop->is_open && now()->dayOfWeek == 1) opening @endif">@if(!$shop->monday_open || !$shop->monday_close) Tutup @else {{ $shop->monday_open->format('H:i') }} - {{ $shop->monday_close->format('H:i') }} @endif</span></li>
								<li>Selasa <span class="@if(!$shop->tuesday_open || !$shop->tuesday_close) closed @elseif($shop->is_open && now()->dayOfWeek == 2) opening @endif">@if(!$shop->tuesday_open || !$shop->tuesday_close) Tutup @else {{ $shop->tuesday_open->format('H:i') }} - {{ $shop->tuesday_close->format('H:i') }} @endif</span></li>
								<li>Rabu <span class="@if(!$shop->wednesday_open || !$shop->wednesday_close) closed @elseif($shop->is_open && now()->dayOfWeek == 3) opening @endif">@if(!$shop->wednesday_open || !$shop->wednesday_close) Tutup @else {{ $shop->wednesday_open->format('H:i') }} - {{ $shop->wednesday_close->format('H:i') }} @endif</span></li>
								<li>Kamis <span class="@if(!$shop->thursday_open || !$shop->thursday_close) closed @elseif($shop->is_open && now()->dayOfWeek == 4) opening @endif">@if(!$shop->thursday_open || !$shop->thursday_close) Tutup @else {{ $shop->thursday_open->format('H:i') }} - {{ $shop->thursday_close->format('H:i') }} @endif</span></li>
								<li>Jumat <span class="@if(!$shop->friday_open || !$shop->friday_close) closed @elseif($shop->is_open && now()->dayOfWeek == 5) opening @endif">@if(!$shop->friday_open || !$shop->friday_close) Tutup @else {{ $shop->friday_open->format('H:i') }} - {{ $shop->friday_close->format('H:i') }} @endif</span></li>
								<li>Sabtu <span class="@if(!$shop->saturday_open || !$shop->saturday_close) closed @elseif($shop->is_open && now()->dayOfWeek == 6) opening @endif">@if(!$shop->saturday_open || !$shop->saturday_close) Tutup @else {{ $shop->saturday_open->format('H:i') }} - {{ $shop->saturday_close->format('H:i') }} @endif</span></li>
								<li>Minggu <span class="@if(!$shop->sunday_open || !$shop->sunday_close) closed @elseif($shop->is_open && now()->dayOfWeek == 0) opening @endif">@if(!$shop->sunday_open || !$shop->sunday_close) Tutup @else {{ $shop->sunday_open->format('H:i') }} - {{ $shop->sunday_close->format('H:i') }} @endif</span></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
@endsection

@section('scripts')
@endsection
