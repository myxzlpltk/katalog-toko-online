@extends('layouts.admin.app')

@section('title', 'Data Dosen')

@section('stylesheets')
	<link rel="stylesheet" href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}">
@endsection

@section('actions')
	@can('create', \App\Models\Teacher::class)
	<a href="{{ route('admin.teachers.create') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus fa-fw"></i> Tambah Data</a>
	@endcan
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
