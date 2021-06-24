@extends('layouts.console.app')

@section('title', 'Tambah Usaha')

@section('stylesheets')
@endsection

@section('content')
	<div class="card shadow mb-3">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary"><i class="fa fa-clipboard-list fa-fw"></i> Formulir</h6>
		</div>
		<div class="card-body">
			<form action="{{ route('console.businesses.store') }}" method="post" enctype="multipart/form-data">
				@csrf

				<div class="form-group">
					<label for="teacher_id">Dosen Pembimbing <x-required/></label>
					<select name="teacher_id" id="teacher_id" class="custom-select @error('teacher_id') is-invalid @enderror" required>
						<option disabled hidden selected>-- Pilih Kategori --</option>
						@foreach($teachers as $teacher)
							<option value="{{ $teacher->id }}" @if(old('teacher_id') == $teacher->id) selected @endif>{{ $teacher->name }}</option>
						@endforeach
					</select>
					@error('teacher_id')
					<div class="invalid-feedback">{{ $message }}</div>
					@enderror
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label for="name">Nama Usaha <x-required/></label>
							<input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
							@error('name')
							<div class="invalid-feedback">{{ $message }}</div>
							@enderror
						</div>
						<div class="form-group">
							<label for="business_type_id">Jenis Usaha <x-required/></label>
							<select name="business_type_id" id="business_type_id" class="custom-select @error('business_type_id') is-invalid @enderror" required>
								<option disabled hidden selected>-- Pilih Kategori --</option>
								@foreach($businessFields as $businessField)
									<optgroup label="{{ $businessField->name }}">
										@foreach($businessField->businessTypes as $businessType)
											<option value="{{ $businessType->id }}" @if(old('business_type_id') == $businessType->id) selected @endif>{{ $businessType->name }}</option>
										@endforeach
									</optgroup>
								@endforeach
							</select>
							@error('business_type_id')
							<div class="invalid-feedback">{{ $message }}</div>
							@enderror
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="logo">Logo</label>
							<div class="custom-file" id="logo" class="form-control @error('logo') is-invalid @enderror">
								<input type="file" class="custom-file-input" name="logo" accept="image/*">
								<label class="custom-file-label" for="logo">Pilih Berkas</label>
							</div>
							@error('logo')
							<div class="invalid-feedback">{{ $message }}</div>
							@enderror
						</div>
						<div class="form-group">
							<label for="tagline">Tagline <x-required/></label>
							<input type="text" name="tagline" id="tagline" class="form-control @error('tagline') is-invalid @enderror" value="{{ old('tagline') }}" required>
							@error('tagline')
							<div class="invalid-feedback">{{ $message }}</div>
							@enderror
						</div>
					</div>
				</div>
				<div class="form-group">
					<label for="description">Deskripsi <x-required/></label>
					<textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror" rows="3" required>{{ old('description') }}</textarea>
					@error('description')
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
