@extends('layouts.console.app')

@section('title', 'Data Feed Plan')

@section('stylesheets')
	<link rel="stylesheet" href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}">
@endsection

@section('actions')
	@can('create', [\App\Models\FeedPlan::class, $business])
	<a href="{{ route('console.businesses.feed-plans.create', $business) }}" class="btn btn-primary btn-sm"><i class="fa fa-plus fa-fw"></i> Tambah Data</a>
	@endcan
@endsection

@section('breadcrumbs')
	{{ \Diglactic\Breadcrumbs\Breadcrumbs::render('console.businesses.feed-plans.index', $business) }}
@endsection

@section('content')
	<div class="card shadow mb-3">
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
