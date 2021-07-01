@extends('layouts.console.app')

@section('title', "Tambah Foto Usaha {$business->name}")

@section('stylesheets')
	<link rel="stylesheet" href="{{ asset('vendor/dropzone/dropzone.min.css') }}">
	<link rel="stylesheet" href="{{ asset('vendor/dropzone/basic.min.css') }}">
	<style>
		#dropzone{
			border-style: dashed;
		}
	</style>
@endsection

@section('breadcrumbs')
	{{ \Diglactic\Breadcrumbs\Breadcrumbs::render('console.businesses.business-photos.create', $business) }}
@endsection

@section('content')
	<div class="card shadow mb-3">
		<div class="card-header d-flex justify-content-between align-items-center">
			<h6 class="m-0 font-weight-bold text-primary"><i class="fa fa-clipboard-list fa-fw"></i> Formulir</h6>
			<a href="{{ route('console.businesses.show', $business) }}" class="btn btn-primary btn-sm"><i class="fa fa-check fa-fw"></i> Selesai</a>
		</div>
		<div class="card-body">
			<form action="{{ route('console.businesses.business-photos.store', $business) }}" class="dropzone" id="dropzone">
				@csrf
			</form>
		</div>
	</div>
@endsection

@section('scripts')
	<script src="{{ asset('vendor/dropzone/dropzone.min.js') }}"></script>
	<script>
		Dropzone.options.dropzone = {
			paramName: "file",
			maxFilesize: 2,
		};
	</script>
@endsection
