@extends('layouts.admin.app')

@section('title', 'Tambah Dosen')

@section('stylesheets')
@endsection

@section('content')
	<div class="card shadow mb-3">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary"><i class="fa fa-clipboard-list fa-fw"></i> Formulir</h6>
		</div>
		<div class="card-body">
			<form action="{{ route('admin.teachers.store') }}" method="post" enctype="multipart/form-data">
				@csrf

				<div class="form-group">
					<label for="nidn">NIDN <x-required/></label>
					<input type="text" name="nidn" id="nidn" class="form-control @error('nidn') is-invalid @enderror" value="{{ old('nidn') }}" required>
					@error('nidn')
					<div class="invalid-feedback">{{ $message }}</div>
					@enderror
				</div>
				<div class="form-group">
					<label for="name">Nama <x-required/></label>
					<input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
					@error('name')
					<div class="invalid-feedback">{{ $message }}</div>
					@enderror
				</div>
				<div class="form-group">
					<label for="email">Email <x-required/></label>
					<input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
					@error('email')
					<div class="invalid-feedback">{{ $message }}</div>
					@enderror
				</div>
				<div class="form-group">
					<label for="password">Password <x-required/></label>
					<div class="input-group">
						<input type="text" name="password" id="password" class="form-control @error('password') is-invalid @enderror" value="{{ old('password') }}" required>
						<div class="input-group-append">
							<button type="button" class="btn btn-outline-secondary" id="random-password">Generate</button>
						</div>
					</div>
					@error('password')
					<div class="invalid-feedback">{{ $message }}</div>
					@enderror
				</div>
				<button type="submit" class="btn btn-primary"><i class="fa fa-save fa-fw"></i> Simpan</button>
			</form>
		</div>
	</div>
@endsection

@section('scripts')
	<script>
		function randomPassword(){
			$('[name="password"]').val(Math.random().toString(36).slice(-8));
		}

		randomPassword();

		$('#random-password').click(randomPassword);
	</script>
@endsection
