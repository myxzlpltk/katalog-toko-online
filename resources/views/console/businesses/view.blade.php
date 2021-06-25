@extends('layouts.console.app')

@section('title', $business->name)

@section('stylesheets')
@endsection

@section('breadcrumbs')
	{{ \Diglactic\Breadcrumbs\Breadcrumbs::render('console.businesses.show', $business) }}
@endsection

@section('actions')
	@can('update', $business)
	<a href="{{ route('console.businesses.edit', $business) }}" class="btn btn-warning btn-sm"><i class="fa fa-edit fa-fw"></i> Edit</a>
	@endcan

	@can('delete', $business)
	<form action="{{ route('console.businesses.destroy', $business) }}" class="d-inline" method="POST">
		@csrf
		@method('DELETE')

		<button type="submit" class="btn btn-danger btn-sm" @confirmation>Hapus</button>
	</form>
	@endcan
@endsection

@section('content')
	<div class="row">
		<div class="col-md-8 order-2 order-md-1">
			<div class="card shadow mb-3">
				<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
					<h6 class="m-0 font-weight-bold text-primary"><i class="fa fa-info-circle fa-fw"></i> Informasi Data</h6>
				</div>
				<div class="card-body">
					<table class="table table-borderless table-sm">
						<tr>
							<th>Dosen Pembimbing</th>
							<td>{{ $business->teacher->user->name }}</td>
						</tr>
						<tr>
							<th>Nama Usaha</th>
							<td>{{ $business->name }}</td>
						</tr>
						<tr>
							<th>Bidang Usaha</th>
							<td>{{ $business->businessType->businessField->name }}</td>
						</tr>
						<tr>
							<th>Jenis Usaha</th>
							<td>{{ $business->businessType->name }}</td>
						</tr>
						<tr>
							<th>Deskripsi</th>
							<td>{!! nl2br(e($business->description)) !!}</td>
						</tr>
						<tr>
							<th>Tagline</th>
							<td>{{ $business->tagline }}</td>
						</tr>
						<tr>
							<th>Tautan publik</th>
							<td>
								<a href="{{ route('businesses.view', $business) }}">{{ route('businesses.view', $business) }} <i class="fa fa-external-link-alt fa-fw"></i></a>
							</td>
						</tr>
					</table>
				</div>
			</div>
		</div>

		<div class="col-md-4 order-1 order-md-2">
			<div class="card shadow mb-3">
				<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
					<h6 class="m-0 font-weight-bold text-primary"><i class="fa fa-file-image fa-fw"></i> Logo Usaha</h6>
				</div>
				<div class="card-body text-center">
					<img src="{{ $business->logo_path }}" alt="Logo" class="img-fluid mx-auto d-block mb-3" style="max-height: 100px;">
					<h5 class="card-title">{{ $business->name }}</h5>
					<p class="card-subtitle">{{ $business->tagline }}</p>
				</div>
				<div class="card-footer">
					<a href="{{ route('console.businesses.feed-plans.index', $business) }}" class="btn btn-primary btn-sm btn-block"><i class="fa fa-eye fa-fw"></i> Lihat Feed Plan</a>
				</div>
			</div>
		</div>

		<div class="col-12 order-3">
			<div class="card shadow mb-3">
				<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
					<h6 class="m-0 font-weight-bold text-primary"><i class="fa fa-info-circle fa-fw"></i> Informasi Anggota</h6>

					@can('toggle-invitation', $business)
						@if($business->invitation_code)
							<a href="{{ route('console.businesses.toggle-invitation', $business) }}" class="btn btn-danger btn-sm">Tutup undangan</a>
						@else
							<a href="{{ route('console.businesses.toggle-invitation', $business) }}" class="btn btn-primary btn-sm">Buka undangan</a>
						@endif
					@endcan
				</div>
				<div class="card-body">
					@can('toggle-invitation', $business)
						@if($business->invitation_code)
							<p>
								Tautan undangan : {{ route('console.businesses.invite', ['code' => '']) }}<strong>{{ $business->invitation_code }}</strong>
								<button type="button" id="invitation-link" data-clipboard-text="{{ route('console.businesses.invite', ['code' => $business->invitation_code]) }}" class="btn btn-light btn-sm ml-3"><i class="fa fa-copy fa-fw"></i> Salin</button>
							</p>
						@endif
					@endcan
					<div class="table-responsive">
						<table class="table">
							<thead>
							<tr>
								<th>No.</th>
								<th>NIM</th>
								<th>Nama</th>
								<th>Status</th>
								@can('is-owner', $business)
								<th>Aksi</th>
								@endcan
							</tr>
							</thead>
							<tbody>
							@foreach($business->members as $member)
								<tr>
									<td>{{ $loop->iteration }}</td>
									<td>{{ $member->nim }}</td>
									<td>{{ $member->name }}</td>
									<td>
										@if($member->id == $business->owner_id)
											Direktur
										@elseif($member->validated_at == null)
											Calon Anggota
										@else
											Anggota
										@endif
									</td>
									@can('is-owner', $business)
									<td>
										@can('delete-member', [$business, $member])
											<form action="{{ route('console.businesses.delete-member', [$business, $member]) }}" class="d-inline" method="POST">
												@csrf
												@method('DELETE')

												<button type="submit" class="btn btn-danger btn-sm" @confirmation>Hapus</button>
											</form>
										@endcan
									</td>
									@endcan
								</tr>
							@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('scripts')
	@can('toggle-invitation', $business)
		<script src="{{ asset('vendor/clipboardjs/clipboard.min.js') }}"></script>
		<script>
			var clipboard = new ClipboardJS('#invitation-link');
		</script>
	@endcan
@endsection
