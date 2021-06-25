@extends('layouts.console.app')

@section('title', 'Dasbor')

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
								Total Bisnis</div>
							<div class="h5 mb-0 font-weight-bold text-gray-800">{{ \App\Models\Business::query()->count() }}</div>
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
							<div class="h5 mb-0 font-weight-bold text-gray-800">{{ \App\Models\FeedPlan::query()->count() }}</div>
						</div>
						<div class="col-auto">
							<i class="fas fa-route fa-2x text-gray-300"></i>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('scripts')
@endsection
