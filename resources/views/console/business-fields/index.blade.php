@extends('layouts.console.app')

@section('title', 'Data Bidang Usaha')

@section('stylesheets')
	<link rel="stylesheet" href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}">
@endsection

@section('actions')
	@can('create', \App\Models\BusinessField::class)
	<a href="{{ route('console.business-fields.create') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus fa-fw"></i> Tambah Data</a>
	@endcan
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
							<th>Total Jenis Usaha</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody>
						@foreach($businessFields as $businessField)
						<tr>
							<td>{{ $loop->iteration }}</td>
							<td>{{ $businessField->name }}</td>
							<td>{{ $businessField->business_types_count }} Jenis</td>
							<td>
								@can('view', $businessField)
									<a href="{{ route('console.business-fields.business-types.index', $businessField) }}" class="btn btn-primary btn-sm">Lihat</a>
								@endcan

								@can('update', $businessField)
									<a href="{{ route('console.business-fields.edit', $businessField) }}" class="btn btn-warning btn-sm">Edit</a>
								@endcan

								@can('delete', $businessField)
								<form action="{{ route('console.business-fields.destroy', $businessField) }}" class="d-inline" method="POST">
									@csrf
									@method('DELETE')

									<button type="submit" class="btn btn-danger btn-sm" @confirmation>Hapus</button>
								</form>
								@endcan
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
