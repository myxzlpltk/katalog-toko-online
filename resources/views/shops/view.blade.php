@extends('layouts.public.app')

@section('title', $shop->name)

@section('stylesheets')
	<link rel="stylesheet" href="{{ asset('vendor/jquery-bar-rating/themes/fontawesome-stars.css') }}">
@endsection

@section('header-transparent', true)

@section('content')
	<section class="listing-hero set-bg" data-setbg="{{ asset("storage/photos/{$shop->photos_max_file}") }}">
		<div class="container">
			<div class="listing__hero__option">
				<div class="listing__hero__icon">
					<img src="{{ $shop->logo_path }}" alt="" style="height: 60px;width: 60px;">
				</div>
				<div class="listing__hero__text">
					<h2 class="text-light">{{ $shop->name }}</h2>
					<div class="listing__hero__widget">
						@if($shop->public_reviews_avg_rating)
						<div class="listing__hero__widget__rating text-light">
							{!! \App\Helpers\Helper::rating($shop->public_reviews_avg_rating) !!}
						</div>
						<div class="text-light">{{ $shop->public_reviews_count }} Review</div>
						@else
							<p class="text-light">Belum ada rating</p>
						@endif
					</div>
					<p class="text-light">
						<span class="icon_pin_alt text-light"></span> {{ $shop->address }}<br>
						<span class="icon_currency text-light"></span> {{ $shop->price_range ?? 'Tidak ada data harga' }}
					</p>
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
								<h2>{{ round($shop->public_reviews_avg_rating, 1) }}</h2>
								@if($shop->public_reviews_avg_rating)
								<div class="listing__details__rating__star">
									{!! \App\Helpers\Helper::rating($shop->public_reviews_avg_rating) !!}
								</div>
								<span>({{ $shop->public_reviews_count }} Rating)</span>
								@endif
							</div>
							<div class="listing__details__rating__bar">
								@for($i=5; $i>0; $i--)
								<div class="listing__details__rating__bar__item">
									<span>{{ $i }} <span class="icon_star"></span></span>
									<div id="bar{{ $i }}" class="barfiller">
										<span class="fill" data-percentage="{{ round($shop->public_reviews->where('rating', $i)->count() / max($shop->public_reviews_count, 1) * 100) }}"></span>
									</div>
									<span class="right">{{ $shop->public_reviews->where('rating', $i)->count() }} Review</span>
								</div>
								@endfor
							</div>
						</div>
						<div class="listing__details__comment">
							<h4>Komentar</h4>
							@forelse($shop->public_reviews->take(request()->get('review') ? null : 3) as $review)
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
							@empty
							<p>Belum ada komentar</p>
							@endforelse

							@if($shop->public_reviews_count > 3 && !request()->get('review'))
								<div class="mb-4 text-center">
									<a href="{{ route('shops.view', [$shop, 'review' => true]) }}" class="site-btn">Lihat Semua Review</a>
								</div>
							@endif
						</div>
						<div class="listing__details__review">
							<h4>Tambah Review</h4>
							<form action="{{ route('shops.add-review', $shop) }}" method="post">
								@csrf
								<input type="text" name="name" value="{{ old('name') }}" placeholder="Nama" required>
								<input type="text" name="email" value="{{ old('email') }}" placeholder="Email" required>
								<textarea name="review_text" placeholder="Review" required></textarea>
								<div class="mb-3">
									<p>Rating : </p>
									<select id="rating" name="rating" class="d-none" required>
										@for($i=1; $i<=5; $i++)
											<option value="{{ $i }}" @if(old('rating', 5) == $i) selected @endif>{{ $i }}</option>
										@endfor
									</select>
									<small>Bintang <span id="rating-count">{{ old('rating', 5) }}</span></small>
								</div>
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
	<script src="{{ asset('vendor/jquery-bar-rating/jquery.barrating.min.js') }}"></script>
	<script>
		$('#rating').barrating({
			theme: 'fontawesome-stars',
			initialRating: 5,
		});

		$('#rating').change(function (){
			$('#rating-count').text($(this).val())
		});
	</script>
@endsection
