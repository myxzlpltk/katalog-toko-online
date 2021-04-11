@extends('layouts.admin.app')

@section('title', 'Dashboard')

@section('stylesheets')
@endsection

@section('content')
	<div class="row">
		<div class="col-xl-3 col-md-6 mb-4">
			<div class="card border-left-primary shadow h-100 py-2">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
								Total Toko</div>
							<div class="h5 mb-0 font-weight-bold text-gray-800">{{ \App\Models\Shop::query()->count() }}</div>
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
								Total Review</div>
							<div class="h5 mb-0 font-weight-bold text-gray-800">{{ \App\Models\Review::query()->count() }}</div>
						</div>
						<div class="col-auto">
							<i class="fas fa-sticky-note fa-2x text-gray-300"></i>
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
								Harga Maksimum</div>
							<div class="h5 mb-0 font-weight-bold text-gray-800">{{ \App\Helpers\Helper::idr(\App\Models\Shop::query()->max('max_price')) }}</div>
						</div>
						<div class="col-auto">
							<i class="fas fa-money-bill-wave fa-2x text-gray-300"></i>
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
								Rating Maksimum</div>
							<div class="h5 mb-0 font-weight-bold text-gray-800">{{ round(\App\Models\Shop::query()->withAvg('public_reviews', 'rating')->pluck('public_reviews_avg_rating')->max(), 1) }}</div>
						</div>
						<div class="col-auto">
							<i class="fas fa-star fa-2x text-gray-300"></i>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('scripts')
@endsection
