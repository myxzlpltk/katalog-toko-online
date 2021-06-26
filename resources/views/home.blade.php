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
							<h2>Temukan Usaha Terbaik Disekitar Anda</h2>
							<p>1000+ Usaha dengan pelayanan terbaiknya menunggu anda </p>
						</div>
						<div class="hero__search__form">
							<form action="{{ route('businesses.search') }}" method="get">
								<input type="text" placeholder="Pencarian..." name="query">
								<div class="select__option">
									<select name="business_type_id">
										<option value="">Semua Kategori</option>
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
						<h2>Usaha yang Paling Terbaru</h2>
						<p>Temukan usaha yang ada disekitar anda dan yang mungkin menginspirasi!</p>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12">
					<div class="row">
						@foreach($businesses as $business)
							<div class="col-lg-4 col-md-6">
								<x-business-card :business="$business"/>
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
