@extends('layouts.admin.app')

@section('title', $shop->name)

@section('stylesheets')
	<link rel="stylesheet" href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}">
	<style>
		.my-card-img {
			width: 100%;
			height: 10vw;
			object-fit: cover;
		}
	</style>
@endsection

@section('actions')
	<a href="{{ route('admin.shops.edit', $shop) }}" class="btn btn-warning btn-sm"><i class="fa fa-edit fa-fw"></i> Edit</a>
	<form action="{{ route('admin.shops.destroy', $shop) }}" class="d-inline" method="POST">
		@csrf
		@method('DELETE')

		<button type="submit" class="btn btn-danger btn-sm" @confirmation>Hapus</button>
	</form>
@endsection

@section('content')
	<div class="row">
		<div class="col-md-8">
			<div class="card shadow mb-3">
				<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
					<h6 class="m-0 font-weight-bold text-primary"><i class="fa fa-info-circle fa-fw"></i> Informasi Data</h6>
					<a href="{{ route('shops.view', $shop) }}" class="btn btn-primary btn-sm" target="_blank">Lihat</a>
				</div>
				<div class="card-body">
					<table class="table table-borderless table-sm">
						<tr>
							<th>Nama Toko</th>
							<td>{{ $shop->name }}</td>
						</tr>
						<tr>
							<th>Kategori</th>
							<td>{{ $shop->category->name }}</td>
						</tr>
						<tr>
							<th>Deskripsi</th>
							<td>{!! nl2br(e($shop->description)) !!}</td>
						</tr>
						<tr>
							<th>Alamat</th>
							<td>{{ $shop->address }}</td>
						</tr>
						<tr>
							<th>Nomor HP</th>
							<td>{{ $shop->phone_number }}</td>
						</tr>
						<tr>
							<th>Harga</th>
							<td>{{ \App\Helpers\Helper::idr($shop->min_price) }} - {{ \App\Helpers\Helper::idr($shop->max_price) }}</td>
						</tr>
						<tr>
							<th>Rating</th>
							<td>{{ round($shop->public_reviews_avg_rating, 1) }} Bintang</td>
						</tr>
					</table>
				</div>
			</div>
		</div>

		<div class="col-md-4">
			<div class="card shadow mb-3">
				<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
					<h6 class="m-0 font-weight-bold text-primary"><i class="fa fa-file-image fa-fw"></i> Logo Toko</h6>
				</div>
				<div class="card-body">
					<img src="{{ $shop->logo_path }}" alt="Logo" class="img-fluid" style="max-height: 50px;">
				</div>
			</div>

			<div class="card shadow mb-3">
				<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
					<h6 class="m-0 font-weight-bold text-primary"><i class="far fa-clock fa-fw"></i> Jam Buka</h6>
				</div>
				<div class="card-body">
					<ul class="list-unstyled">
						<li class="d-flex justify-content-between">Senin <span class="@if(!$shop->monday_open || !$shop->monday_close) text-danger @elseif($shop->is_open && now()->dayOfWeek == 1) text-success @endif">@if(!$shop->monday_open || !$shop->monday_close) Tutup @else {{ $shop->monday_open->format('H:i') }} - {{ $shop->monday_close->format('H:i') }} @endif</span></li>
						<li class="d-flex justify-content-between">Selasa <span class="@if(!$shop->tuesday_open || !$shop->tuesday_close) text-danger @elseif($shop->is_open && now()->dayOfWeek == 2) text-success @endif">@if(!$shop->tuesday_open || !$shop->tuesday_close) Tutup @else {{ $shop->tuesday_open->format('H:i') }} - {{ $shop->tuesday_close->format('H:i') }} @endif</span></li>
						<li class="d-flex justify-content-between">Rabu <span class="@if(!$shop->wednesday_open || !$shop->wednesday_close) text-danger @elseif($shop->is_open && now()->dayOfWeek == 3) text-success @endif">@if(!$shop->wednesday_open || !$shop->wednesday_close) Tutup @else {{ $shop->wednesday_open->format('H:i') }} - {{ $shop->wednesday_close->format('H:i') }} @endif</span></li>
						<li class="d-flex justify-content-between">Kamis <span class="@if(!$shop->thursday_open || !$shop->thursday_close) text-danger @elseif($shop->is_open && now()->dayOfWeek == 4) text-success @endif">@if(!$shop->thursday_open || !$shop->thursday_close) Tutup @else {{ $shop->thursday_open->format('H:i') }} - {{ $shop->thursday_close->format('H:i') }} @endif</span></li>
						<li class="d-flex justify-content-between">Jumat <span class="@if(!$shop->friday_open || !$shop->friday_close) text-danger @elseif($shop->is_open && now()->dayOfWeek == 5) text-success @endif">@if(!$shop->friday_open || !$shop->friday_close) Tutup @else {{ $shop->friday_open->format('H:i') }} - {{ $shop->friday_close->format('H:i') }} @endif</span></li>
						<li class="d-flex justify-content-between">Sabtu <span class="@if(!$shop->saturday_open || !$shop->saturday_close) text-danger @elseif($shop->is_open && now()->dayOfWeek == 6) text-success @endif">@if(!$shop->saturday_open || !$shop->saturday_close) Tutup @else {{ $shop->saturday_open->format('H:i') }} - {{ $shop->saturday_close->format('H:i') }} @endif</span></li>
						<li class="d-flex justify-content-between">Minggu <span class="@if(!$shop->sunday_open || !$shop->sunday_close) text-danger @elseif($shop->is_open && now()->dayOfWeek == 0) text-success @endif">@if(!$shop->sunday_open || !$shop->sunday_close) Tutup @else {{ $shop->sunday_open->format('H:i') }} - {{ $shop->sunday_close->format('H:i') }} @endif</span></li>
					</ul>
				</div>
			</div>
		</div>

		<div class="col-12">
			<div class="card shadow mb-3">
				<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
					<h6 class="m-0 font-weight-bold text-primary"><i class="far fa-images fa-fw"></i> Gambar Toko</h6>
					<a href="{{ route('admin.shops.photos.create', ['shop' => $shop]) }}" class="btn btn-primary btn-sm"><i class="fa fa-plus fa-fw"></i> Tambah Data</a>
				</div>
				<div class="card-body">
					<div class="row no-gutters">
						@forelse($shop->photos as $photo)
						<div class="col-4 col-md-3 col-lg-2">
							<div class="card m-2">
								<div class="card-img-overlay d-flex justify-content-between align-items-center">
									<form action="{{ route('admin.photos.destroy', $photo) }}" class="d-inline-block mx-auto" method="POST">
										@csrf
										@method('DELETE')

										<button type="submit" class="btn btn-outline-danger btn-sm" @confirmation><i class="fa fa-trash fa-fw"></i></button>
									</form>
								</div>
								<img src="{{ asset("storage/photos/{$photo->file}") }}" alt="Photo {{ $photo->name }}" class="card-img my-card-img">
							</div>
						</div>
						@empty
						<div class="col-12">
							<p class="text-muted text-center">Tidak ada data</p>
						</div>
						@endforelse
					</div>
				</div>
			</div>

			<div class="card shadow mb-3">
				<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
					<h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-sticky-note fa-fw"></i> Data Review</h6>
				</div>
				<div class="card-body">
					<div class="table-responsive">
						{{ $dataTable->table() }}
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('scripts')
	<script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
	<script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
	{{ $dataTable->scripts() }}
@endsection
