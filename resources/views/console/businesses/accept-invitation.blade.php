@extends('layouts.console.app')

@section('title', 'Terima Undangan')

@section('stylesheets')
@endsection

@section('breadcrumbs')
	{{ \Diglactic\Breadcrumbs\Breadcrumbs::render('console.businesses.invite', $business) }}
@endsection

@section('content')
	<div class="card shadow mb-3">
		<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
			<h6 class="m-0 font-weight-bold text-primary"><i class="fa fa-question-circle fa-fw"></i> Apakah anda ingin menerima undangan?</h6>
		</div>
		<div class="card-body text-center">
			<img src="{{ $business->logo_path }}" alt="Logo" class="img-fluid mx-auto d-block mb-3" style="max-height: 100px;">
			<h5 class="card-title">{{ $business->name }}</h5>
			<p class="card-subtitle">{{ $business->tagline }}</p>

		</div>
		<div class="card-footer text-center">
			<a href="{{ route('console.businesses.invite', ['code' => $business->invitation_code, 'process' => true]) }}" class="btn btn-success">Terima Undangan</a>
		</div>
	</div>
@endsection

@section('scripts')
@endsection
