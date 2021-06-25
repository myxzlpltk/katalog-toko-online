@extends('layouts.console.app')

@section('title', 'Tambah Feed Plan Ke-')

@section('stylesheets')
@endsection

@section('breadcrumbs')
	{{ \Diglactic\Breadcrumbs\Breadcrumbs::render('console.businesses.feed-plans.create', $business) }}
@endsection

@section('content')
	<div class="card shadow mb-3">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary"><i class="fa fa-clipboard-list fa-fw"></i> Formulir Feed Plan Ke-{{ $feedIndex }}</h6>
		</div>
		<div class="card-body">
			<form action="{{ route('console.businesses.feed-plans.store', $business) }}" method="post" enctype="multipart/form-data">
				@csrf

				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label for="plan_date">Tanggal Plan <x-required/></label>
							<input type="datetime-local" name="plan_date" id="plan_date" class="form-control @error('plan_date') is-invalid @enderror" value="{{ old('plan_date') }}" required>
							@error('plan_date')
							<div class="invalid-feedback">{{ $message }}</div>
							@enderror
						</div>
						<div class="form-group">
							<label for="topic">Topik <x-required/></label>
							<input type="text" name="topic" id="topic" class="form-control @error('topic') is-invalid @enderror" value="{{ old('topic') }}" required>
							@error('topic')
							<div class="invalid-feedback">{{ $message }}</div>
							@enderror
						</div>
						<div class="form-group">
							<label for="content">Detail Konten <x-required/></label>
							<textarea name="content" id="content" class="form-control @error('content') is-invalid @enderror" rows="3" required>{{ old('content') }}</textarea>
							@error('content')
							<div class="invalid-feedback">{{ $message }}</div>
							@enderror
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="brief_image">Brief <x-required/></label>
							<div class="custom-file" id="brief_image" class="form-control @error('brief_image') is-invalid @enderror">
								<input type="file" class="custom-file-input" name="brief_image" accept="image/*" required>
								<label class="custom-file-label" for="brief_image">Pilih Berkas</label>
							</div>
							@error('brief_image')
							<div class="invalid-feedback">{{ $message }}</div>
							@enderror
						</div>
						<div class="form-group">
							<label for="headline">Headline <x-required/></label>
							<textarea name="headline" id="headline" class="form-control @error('headline') is-invalid @enderror" rows="3" required>{{ old('headline') }}</textarea>
							@error('headline')
							<div class="invalid-feedback">{{ $message }}</div>
							@enderror
						</div>
						<div class="form-group">
							<label for="caption">Caption <x-required/></label>
							<textarea name="caption" id="caption" class="form-control @error('caption') is-invalid @enderror" rows="3" required>{{ old('caption') }}</textarea>
							@error('caption')
							<div class="invalid-feedback">{{ $message }}</div>
							@enderror
						</div>
					</div>
				</div>
				<button type="submit" class="btn btn-primary"><i class="fa fa-save fa-fw"></i> Simpan</button>
			</form>
		</div>
	</div>
@endsection

@section('scripts')
@endsection
