@extends('layouts.console.app')

@section('title', 'Dasbor')

@section('stylesheets')
	<link rel="stylesheet" href="{{ asset('vendor/owlcarousel/assets/owl.carousel.min.css') }}">
	<style>
		.background-img{
			background-repeat: no-repeat;
			background-position: center;
			background-size: cover;
			border-top-left-radius: 0.35rem;
			border-bottom-left-radius: 0.35rem;
		}

		.caption {
			overflow: hidden;
			text-overflow: ellipsis;
			display: -webkit-box;
			-webkit-line-clamp: 3; /* number of lines to show */
			-webkit-box-orient: vertical;
		}

		.headline {
			overflow: hidden;
			text-overflow: ellipsis;
			display: -webkit-box;
			-webkit-line-clamp: 2; /* number of lines to show */
			-webkit-box-orient: vertical;
		}
	</style>
@endsection

@section('content')
	<div class="row">
		<div class="col-xl-3 col-md-6 mb-4">
			<div class="card border-left-primary shadow h-100 py-2">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
								Total Bisnis</div>
							<div class="h5 mb-0 font-weight-bold text-gray-800">{{ count($businessIds) }}</div>
						</div>
						<div class="col-auto">
							<i class="fas fa-store fa-2x text-gray-300"></i>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="col-xl-3 col-md-6 mb-4">
			<div class="card border-left-primary shadow h-100 py-2">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
								Total Feed Plan</div>
							<div class="h5 mb-0 font-weight-bold text-gray-800">{{ \App\Models\FeedPlan::query()->whereIn('business_id', $businessIds)->count() }}</div>
						</div>
						<div class="col-auto">
							<i class="fas fa-route fa-2x text-gray-300"></i>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	@if($feedPlans->count() > 0)
		<h4>Feed Plan Terbaru</h4>
		<div class="owl-carousel owl-theme">
			@foreach($feedPlans as $feedPlan)
				<div class="item">
					<a href="{{ route('console.feed-plans.show', $feedPlan) }}" class="card-link">
						<div class="card shadow-sm my-3">
							<div class="row no-gutters">
								<div class="col-5 background-img" style="background-image: url('{{ $feedPlan->designs->count() > 0 ? asset("storage/designs/{$feedPlan->designs->pluck('design')->first()}") : asset('img/no-photo.jpg') }}')"></div>
								<div class="col-7">
									<div class="card-body">
										<h5 class="card-title text-dark headline">{{ $feedPlan->headline }}</h5>
										<p class="caption">{!! nl2br(e($feedPlan->caption)) !!}</p>
										<p class="card-text"><small class="text-muted">{{ $feedPlan->plan_date->translatedFormat('j F Y') }} | Feed Ke-{{ $feedPlan->feed_index }}</small></p>
									</div>
								</div>
							</div>
						</div>
					</a>
				</div>
			@endforeach
		</div>
	@endif
@endsection

@section('scripts')
	<script src="{{ asset('vendor/owlcarousel/owl.carousel.min.js') }}"></script>
	<script>
		$('.owl-carousel').owlCarousel({
			margin: 15,
			responsive: {
				0: {
					items:1
				},
				600: {
					items:2
				},
				1000: {
					items:3
				}
			}
		})
	</script>
@endsection
