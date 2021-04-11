@extends('layouts.admin.app')

@section('title', 'Edit Toko')

@section('stylesheets')
@endsection

@section('content')
	<div class="card shadow mb-3">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary"><i class="fa fa-clipboard-list fa-fw"></i> Formulir</h6>
		</div>
		<div class="card-body">
			<form action="{{ route('admin.shops.update', $shop) }}" method="post" enctype="multipart/form-data">
				@csrf
				@method('PATCH')

				<div class="form-group">
					<label for="name">Nama Toko <x-required/></label>
					<input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $shop->name) }}" required>
					@error('name')
					<div class="invalid-feedback">{{ $message }}</div>
					@enderror
				</div>
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
					<label for="category_id">Kategori <x-required/></label>
					<select name="category_id" id="category_id" class="custom-select @error('category_id') is-invalid @enderror" required>
						<option disabled hidden selected>-- Pilih Kategori --</option>
						@foreach($categories as $category)
							<option value="{{ $category->id }}" @if(old('category_id', $shop->category_id) == $category->id) selected @endif>{{ $category->name }}</option>
						@endforeach
					</select>
					@error('category_id')
					<div class="invalid-feedback">{{ $message }}</div>
					@enderror
				</div>
				<div class="form-group">
					<label for="description">Deskripsi <x-required/></label>
					<textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror" rows="3" required>{{ old('description', $shop->description) }}</textarea>
					@error('description')
					<div class="invalid-feedback">{{ $message }}</div>
					@enderror
				</div>
				<div class="form-group">
					<label for="address">Alamat <x-required/></label>
					<input type="text" name="address" id="address" class="form-control @error('address') is-invalid @enderror" value="{{ old('address', $shop->address) }}" required>
					@error('address')
					<div class="invalid-feedback">{{ $message }}</div>
					@enderror
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label for="phone_number">Nomor HP <x-required/></label>
							<input type="text" name="phone_number" id="phone_number" class="form-control @error('phone_number') is-invalid @enderror" value="{{ old('phone_number', $shop->phone_number) }}" required>
							@error('phone_number')
							<div class="invalid-feedback">{{ $message }}</div>
							@enderror
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<label for="min_price">Harga Minimum</label>
							<div class="input-group">
								<div class="input-group-prepend">
									<div class="input-group-text">Rp.</div>
								</div>
								<input type="text" name="min_price" id="min_price" class="form-control @error('min_price') is-invalid @enderror" value="{{ old('min_price', $shop->min_price) }}">
							</div>
							@error('min_price')
							<div class="invalid-feedback">{{ $message }}</div>
							@enderror
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<label for="max_price">Harga Maksimum</label>
							<div class="input-group">
								<div class="input-group-prepend">
									<div class="input-group-text">Rp.</div>
								</div>
								<input type="text" name="max_price" id="max_price" class="form-control @error('max_price') is-invalid @enderror" value="{{ old('max_price', $shop->max_price) }}">
							</div>
							@error('max_price')
							<div class="invalid-feedback">{{ $message }}</div>
							@enderror
						</div>
					</div>
				</div>
				<hr>
				<p><strong>Jam Buka :</strong></p>
				<div class="row">
					<div class="col-sm-6">
						<div class="form-group">
							<label for="monday_open">Jam Buka Hari Senin</label>
							<input type="time" name="monday_open" id="monday_open" class="form-control @error('monday_open') is-invalid @enderror" value="{{ old('monday_open', $shop->monday_open->format('H:i')) }}">
							@error('monday_open')
							<div class="invalid-feedback">{{ $message }}</div>
							@enderror
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label for="monday_close">Jam Tutup Hari Senin</label>
							<input type="time" name="monday_close" id="monday_close" class="form-control @error('monday_close') is-invalid @enderror" value="{{ old('monday_close', $shop->monday_close->format('H:i')) }}">
							@error('monday_close')
							<div class="invalid-feedback">{{ $message }}</div>
							@enderror
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label for="tuesday_open">Jam Buka Hari Selasa</label>
							<input type="time" name="tuesday_open" id="tuesday_open" class="form-control @error('tuesday_open') is-invalid @enderror" value="{{ old('tuesday_open', $shop->tuesday_open->format('H:i')) }}">
							@error('tuesday_open')
							<div class="invalid-feedback">{{ $message }}</div>
							@enderror
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label for="tuesday_close">Jam Tutup Hari Selasa</label>
							<input type="time" name="tuesday_close" id="tuesday_close" class="form-control @error('tuesday_close') is-invalid @enderror" value="{{ old('tuesday_close', $shop->tuesday_close->format('H:i')) }}">
							@error('tuesday_close')
							<div class="invalid-feedback">{{ $message }}</div>
							@enderror
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label for="wednesday_open">Jam Buka Hari Rabu</label>
							<input type="time" name="wednesday_open" id="wednesday_open" class="form-control @error('wednesday_open') is-invalid @enderror" value="{{ old('wednesday_open', $shop->wednesday_open->format('H:i')) }}">
							@error('wednesday_open')
							<div class="invalid-feedback">{{ $message }}</div>
							@enderror
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label for="wednesday_close">Jam Tutup Hari Rabu</label>
							<input type="time" name="wednesday_close" id="wednesday_close" class="form-control @error('wednesday_close') is-invalid @enderror" value="{{ old('wednesday_close', $shop->wednesday_close->format('H:i')) }}">
							@error('wednesday_close')
							<div class="invalid-feedback">{{ $message }}</div>
							@enderror
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label for="thursday_open">Jam Buka Hari Kamis</label>
							<input type="time" name="thursday_open" id="thursday_open" class="form-control @error('thursday_open') is-invalid @enderror" value="{{ old('thursday_open', $shop->thursday_open->format('H:i')) }}">
							@error('thursday_open')
							<div class="invalid-feedback">{{ $message }}</div>
							@enderror
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label for="thursday_close">Jam Tutup Hari Kamis</label>
							<input type="time" name="thursday_close" id="thursday_close" class="form-control @error('thursday_close') is-invalid @enderror" value="{{ old('thursday_close', $shop->thursday_close->format('H:i')) }}">
							@error('thursday_close')
							<div class="invalid-feedback">{{ $message }}</div>
							@enderror
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label for="friday_open">Jam Buka Hari Jumat</label>
							<input type="time" name="friday_open" id="friday_open" class="form-control @error('friday_open') is-invalid @enderror" value="{{ old('friday_open', $shop->friday_open->format('H:i')) }}">
							@error('friday_open')
							<div class="invalid-feedback">{{ $message }}</div>
							@enderror
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label for="friday_close">Jam Tutup Hari Jumat</label>
							<input type="time" name="friday_close" id="friday_close" class="form-control @error('friday_close') is-invalid @enderror" value="{{ old('friday_close', $shop->friday_close->format('H:i')) }}">
							@error('friday_close')
							<div class="invalid-feedback">{{ $message }}</div>
							@enderror
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label for="saturday_open">Jam Buka Hari Sabtu</label>
							<input type="time" name="saturday_open" id="saturday_open" class="form-control @error('saturday_open') is-invalid @enderror" value="{{ old('saturday_open', $shop->saturday_open->format('H:i')) }}">
							@error('saturday_open')
							<div class="invalid-feedback">{{ $message }}</div>
							@enderror
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label for="saturday_close">Jam Tutup Hari Sabtu</label>
							<input type="time" name="saturday_close" id="saturday_close" class="form-control @error('saturday_close') is-invalid @enderror" value="{{ old('saturday_close', $shop->saturday_close->format('H:i')) }}">
							@error('saturday_close')
							<div class="invalid-feedback">{{ $message }}</div>
							@enderror
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label for="sunday_open">Jam Buka Hari Minggu</label>
							<input type="time" name="sunday_open" id="sunday_open" class="form-control @error('sunday_open') is-invalid @enderror" value="{{ old('sunday_open', $shop->sunday_open->format('H:i')) }}">
							@error('sunday_open')
							<div class="invalid-feedback">{{ $message }}</div>
							@enderror
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label for="sunday_close">Jam Tutup Hari Minggu</label>
							<input type="time" name="sunday_close" id="sunday_close" class="form-control @error('sunday_close') is-invalid @enderror" value="{{ old('sunday_close', $shop->sunday_close->format('H:i')) }}">
							@error('sunday_close')
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
