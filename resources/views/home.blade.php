@extends('layouts.public.app')

@section('title', 'Selamat Datang')

@section('stylesheets')
@endsection

@section('header-transparent', true)

@section('content')
	<section class="hero set-bg" data-setbg="img/hero/hero-bg.jpg">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="hero__text">
						<div class="section-title">
						</div>
						<div class="section-title">
							<h2>Temukan Toko Terbaik Disekitar Anda</h2>
							<p>1000+ Toko dengan pelayanan terbaiknya menunggu anda </p>
						</div>
						<div class="hero__search__form">
							<form action="#">
								<input type="text" placeholder="Search..." name="query">
								<div class="select__option">
									<select name="category_id">
										<option value="">Choose Categories</option>
										@foreach($categories as $category)
											<option value="{{ $category->id }}">{{ $category->name }}</option>
										@endforeach
									</select>
								</div>
								<button type="submit">Jelajah</button>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="most-search spad">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="section-title">
						<h2>Toko yang Paling Populer</h2>
						<p>Temukan toko yang ada disekitar anda dan yang mungkin anda cari!</p>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12">
					<div class="most__search__tab">
						<ul class="nav nav-tabs" role="tablist">
							@foreach($categories as $category)
							<li class="nav-item">
								<a class="nav-link @if($loop->first) active @endif" data-toggle="tab" href="#tabs-{{ $loop->iteration }}" role="tab">
									{{ $category->name }}
								</a>
							</li>
							@endforeach
						</ul>
					</div>
					<div class="tab-content">
						@foreach($categories as $category)
						<div class="tab-pane @if($loop->first) active @endif" id="tabs-{{ $loop->iteration }}" role="tabpanel">
							<div class="row">
								@foreach($category->favoriteShops as $shop)
								<div class="col-lg-4 col-md-6">
									<div class="listing__item">
										<div class="listing__item__pic set-bg" data-setbg="{{ asset("storage/photos/{$shop->photos_max_file}") }}">
											<img src="{{ $shop->logo_path }}" alt="">
											<div class="listing__item__pic__tag">Populer</div>
										</div>
										<div class="listing__item__text">
											<div class="listing__item__text__inside">
												<a href="{{ route('shop.view', $shop) }}">
													<h5>{{ $shop->name }}</h5>
													<div class="listing__item__text__rating">
														<div class="listing__item__rating__star">
															{!! \App\Helpers\Helper::rating($shop->reviews_avg_rating) !!}
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
								</div>
								@endforeach
							</div>
						</div>
						@endforeach
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="testimonial spad set-bg" data-setbg="img/testimonial/tr7.jpg">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="section-title">
						<h2>Trusted By Over 100++ User</h2>
						<p>What people say about us</p>
					</div>
					<div class="testimonial__slider owl-carousel">
						<div class="testimonial__item" data-hash="review-1">
							<p>" We worked with Consultant. Our representative was very knowledgeable and helpful.
								Consultant made a number of suggestions to help improve our systems. Consultant
								explained how things work and why it would help."</p>
							<div class="testimonial__item__author">
								<a href="#review-3"><img src="{{ asset('img/testimonial/author-3.png') }}" alt=""></a>
								<a href="#review-1" class="active"><img src="{{ asset('img/testimonial/author-1.png') }}" alt=""></a>
								<a href="#review-2"><img src="{{ asset('img/testimonial/author-2.png') }}" alt=""></a>
							</div>
							<div class="testimonial__item__author__text">
								<h5>John Smith -</h5>
								<div class="testimonial__item__author__rating">
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
								</div>
							</div>
							<span>CEO Colorlib</span>
						</div>
						<div class="testimonial__item" data-hash="review-2">
							<p>" We worked with Consultant. Our representative was very knowledgeable and helpful.
								Consultant made a number of suggestions to help improve our systems. Consultant
								explained how things work and why it would help."</p>
							<div class="testimonial__item__author">
								<a href="#review-1"><img src="{{ asset('img/testimonial/author-1.png') }}" alt=""></a>
								<a href="#review-2" class="active"><img src="{{ asset('img/testimonial/author-2.png') }}" alt=""></a>
								<a href="#review-3"><img src="{{ asset('img/testimonial/author-3.png') }}" alt=""></a>
							</div>
							<div class="testimonial__item__author__text">
								<h5>John Smith -</h5>
								<div class="testimonial__item__author__rating">
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
								</div>
							</div>
							<span>CEO Colorlib</span>
						</div>
						<div class="testimonial__item" data-hash="review-3">
							<p>"We worked with Consultant. Our representative was very knowledgeable and helpful.
								Consultant made a number of suggestions to help improve our systems. Consultant
								explained how things work and why it would help."</p>
							<div class="testimonial__item__author">
								<a href="#review-2"><img src="{{ asset('img/testimonial/author-2.png') }}" alt=""></a>
								<a href="#review-3" class="active"><img src="{{ asset('img/testimonial/author-3.png') }}" alt=""></a>
								<a href="#review-1"><img src="{{ asset('img/testimonial/author-1.png') }}" alt=""></a>
							</div>
							<div class="testimonial__item__author__text">
								<h5>John Smith -</h5>
								<div class="testimonial__item__author__rating">
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
								</div>
							</div>
							<span>CEO Colorlib</span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="newslatter">
		<div class="container">
			<div class="row">
				<div class="col-lg-6 col-md-6">
					<div class="newslatter__text">
						<h3>Subscribe Newsletter</h3>
						<p>Subscribe to our newsletter and don’t miss anything</p>
					</div>
				</div>
				<div class="col-lg-6 col-md-6">
					<form action="#" class="newslatter__form">
						<input type="text" placeholder="Your email">
						<button type="submit">Subscribe</button>
					</form>
				</div>
			</div>
		</div>
	</section>
@endsection

@section('scripts')
@endsection
