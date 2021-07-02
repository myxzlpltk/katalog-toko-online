@extends('layouts.console.app')

@section('title', 'Beri Komentar Feed Plan Ke-')

@section('stylesheets')
@endsection

@section('breadcrumbs')
	{{ \Diglactic\Breadcrumbs\Breadcrumbs::render('console.feed-plans.edit-comment', $feedPlan) }}
@endsection

@section('content')
	<div class="card shadow mb-3">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary"><i class="fa fa-clipboard-list fa-fw"></i> Formulir Feed Plan Ke-{{ $feedPlan->feed_index }}</h6>
		</div>
		<div class="card-body">
			<form action="{{ route('console.feed-plans.update-comment', $feedPlan) }}" method="post" enctype="multipart/form-data">
				@csrf
				@method('PATCH')

				<div class="form-group">
					<label for="comment">Komentar <x-required/></label>
					<textarea name="comment" id="comment" class="form-control @error('comment') is-invalid @enderror" rows="3" required>{{ old('comment', $feedPlan->comment) }}</textarea>
					@error('comment')
					<div class="invalid-feedback">{{ $message }}</div>
					@enderror
				</div>
				<button type="submit" class="btn btn-primary"><i class="fa fa-save fa-fw"></i> Simpan</button>
			</form>
		</div>
	</div>
@endsection

@section('scripts')
@endsection
