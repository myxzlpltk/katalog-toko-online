@extends('layouts.admin.app')

@section('title', 'Dashboard')

@section('stylesheets')
	<link rel="stylesheet" href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}">
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

	<div class="card shadow mb-3">
		<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
			<h6 class="m-0 font-weight-bold text-primary">Review Belum Dipublish</h6>
			<form action="{{ route('admin.reviews.publish-all') }}" class="d-inline" method="POST">
				@csrf
				@method('PATCH')

				<button type="submit" class="btn btn-primary btn-sm" @confirmation>Publish Semua</button>
			</form>
		</div>
		<div class="card-body">
			<div class="table-responsive">{{ $dataTable->table() }}</div>
		</div>
	</div>
@endsection

@section('scripts')
	<script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
	<script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
	{{ $dataTable->scripts() }}
@endsection
