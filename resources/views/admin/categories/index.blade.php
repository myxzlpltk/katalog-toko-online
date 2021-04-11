@extends('layouts.admin.app')

@section('title', 'Data Kategori')

@section('stylesheets')
	<link rel="stylesheet" href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}">
@endsection

@section('actions')
	<a href="{{ route('admin.categories.create') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus fa-fw"></i> Tambah Data</a>
@endsection

@section('content')
	<div class="card shadow mb-3">
		<div class="card-body">
			<div class="table-responsive">
				<table class="table data-table" data-autonumber="true">
					<thead>
						<tr>
							<th>No.</th>
							<th>Nama</th>
							<th>Jumlah Toko</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody>
						@foreach($categories as $category)
						<tr>
							<td>{{ $loop->iteration }}</td>
							<td>{{ $category->name }}</td>
							<td>{{ $category->shops_count }} Toko</td>
							<td>
								<a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-warning btn-sm">Edit</a>

								@if($category->shops_count == 0)
								<form action="{{ route('admin.categories.destroy', $category) }}" class="d-inline" method="POST">
									@csrf
									@method('DELETE')

									<button type="submit" class="btn btn-danger btn-sm" @confirmation>Hapus</button>
								</form>
								@endif
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
@endsection

@section('scripts')
	<script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
	<script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
@endsection
