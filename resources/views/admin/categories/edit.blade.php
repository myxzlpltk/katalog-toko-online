@extends('layouts.admin.app')

@section('title', 'Edit Kategori')

@section('stylesheets')
@endsection

@section('content')
	<div class="card shadow mb-3">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary"><i class="fa fa-clipboard-list fa-fw"></i> Formulir</h6>
		</div>
		<div class="card-body">
			<form action="{{ route('admin.categories.update', $category) }}" method="post" enctype="multipart/form-data">
				@csrf
				@method('PATCH')

				<div class="form-group">
					<label for="name">Nama <x-required/></label>
					<input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $category->name) }}" required>
					@error('name')
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
