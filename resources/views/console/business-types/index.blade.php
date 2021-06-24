@extends('layouts.console.app')

@section('title', 'Data Jenis Usaha')

@section('stylesheets')
	<link rel="stylesheet" href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}">
@endsection

@section('actions')
	@can('create', \App\Models\BusinessType::class)
	<a href="{{ route('console.business-fields.business-types.create', $businessField) }}" class="btn btn-primary btn-sm"><i class="fa fa-plus fa-fw"></i> Tambah Data</a>
	@endcan
@endsection

@section('breadcrumbs')
	{{ \Diglactic\Breadcrumbs\Breadcrumbs::render('console.business-fields.business-types.index', $businessField) }}
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
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody>
						@foreach($businessField->businessTypes as $businessType)
						<tr>
							<td>{{ $loop->iteration }}</td>
							<td>{{ $businessType->name }}</td>
							<td>
								@can('update', $businessType)
									<a href="{{ route('console.business-types.edit', $businessType) }}" class="btn btn-warning btn-sm">Edit</a>
								@endcan

								@can('delete', $businessType)
								<form action="{{ route('console.business-types.destroy', $businessType) }}" class="d-inline" method="POST">
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
