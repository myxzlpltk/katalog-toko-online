@extends('layouts.console.app')

@section('title', 'Data Usaha')

@section('stylesheets')
	<link rel="stylesheet" href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}">
@endsection

@section('actions')
	<a href="{{ route('console.businesses.xlsx') }}" class="btn btn-primary btn-sm"><i class="fa fa-download fa-fw"></i> Excel</a>
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
