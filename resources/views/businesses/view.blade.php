@extends('layouts.public.app')

@section('title', $business->name)

@section('stylesheets')
@endsection

@section('header-transparent', true)

@section('content')
	<section class="listing-hero set-bg" data-setbg="{{ $business->background_path }}">
		<div class="container">
			<div class="listing__hero__option">
				<div class="listing__hero__icon">
					<img src="{{ $business->logo_path }}" alt="" style="max-height: 60px; max-width: 60px;">
				</div>
				<div class="listing__hero__text">
					<h2 class="text-light">{{ $business->name }}</h2>
					<p class="text-light">{{ $business->tagline }}</p>
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
							{!! nl2br(e($business->description)) !!}

							<p class="mt-3 mb-2 font-weight-bolder text-dark">Media Promosi</p>

							@if($business->website)
								<a href="//{{ $business->website }}" class="mr-1"><img src="{{ asset('img/brands/website.svg') }}" alt="Website Icon" width="24"></a>
							@endif
							@if($business->instagram)
								<a href="//{{ $business->instagram }}" class="mr-1"><img src="{{ asset('img/brands/instagram.svg') }}" alt="Instagram Icon" width="24"></a>
							@endif
							@if($business->facebook)
								<a href="//{{ $business->facebook }}" class="mr-1"><img src="{{ asset('img/brands/facebook.svg') }}" alt="Facebook Icon" width="24"></a>
							@endif
						</div>
						<div class="listing__details__gallery">
							<h4>Galeri</h4>
							@if(count($business->photos) > 0)
							<div class="listing__details__gallery__pic">
								<div class="listing__details__gallery__item">
									<img class="listing__details__gallery__item__large"
										 src="{{ asset("storage/photos/{$business->photos->first()->file}") }}" alt="">
									<span><i class="fa fa-camera"></i> {{ $business->photos->count() }} Foto</span>
								</div>
								<div class="listing__details__gallery__slider owl-carousel">
									@foreach($business->photos as $photo)
									<img data-imgbigurl="{{ asset("storage/photos/{$photo->file}") }}"
										 src="{{ asset("storage/photos/{$photo->file}") }}" alt="">
									@endforeach
								</div>
							</div>
							@else
								<p>Tidak ada photo</p>
							@endif
						</div>
					</div>
				</div>
				<div class="col-lg-4">
					<div class="listing__sidebar">
						<div class="listing__sidebar__contact">
							<div class="listing__sidebar__contact__text">
								<h4>Struktur Usaha</h4>
								<p>Direktur</p>
								<ul>
									@foreach($business->activeMembers as $member)
										@if($business->owner_id == $member->id)
											<li><span class="fa fa-user fa-fw"></span> {{ $member->user->name }}</li>
										@endif
									@endforeach
								</ul>

								<p>Anggota</p>
								<ul>
									@foreach($business->activeMembers as $member)
										@if($business->owner_id != $member->id)
											<li><span class="fa fa-user fa-fw"></span> {{ $member->user->name }}</li>
										@endif
									@endforeach
								</ul>

								<p>Dosen Pembimbing</p>
								<ul>
									<li><span class="fa fa-user fa-fw"></span> {{ $business->teacher->user->name }}</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
@endsection

@section('scripts')
@endsection
