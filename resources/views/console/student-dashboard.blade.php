@extends('layouts.console.app')

@section('title', 'Dasbor')

@section('stylesheets')
	<link rel="stylesheet" href="{{ asset('vendor/owlcarousel/assets/owl.carousel.min.css') }}">
	<style>
		.background-img{
			background-repeat: no-repeat;
			background-position: center;
			background-size: cover;
			border-top-left-radius: 0.35rem;
			border-bottom-left-radius: 0.35rem;
		}

		.caption {
			overflow: hidden;
			text-overflow: ellipsis;
			display: -webkit-box;
			-webkit-line-clamp: 3; /* number of lines to show */
			-webkit-box-orient: vertical;
		}

		.headline {
			overflow: hidden;
			text-overflow: ellipsis;
			display: -webkit-box;
			-webkit-line-clamp: 2; /* number of lines to show */
			-webkit-box-orient: vertical;
		}
	</style>
@endsection

@section('content')
	@if($user->userable->business && $user->userable->validated_at == null)
		<div class="alert alert-success" role="alert">
			<strong><i class="fa fa-check-circle fa-fw"></i> Penerimaan undangan sedang diproses!</strong>
			<span>Silahkan minta ketua tim untuk menerima undangan.</span>
		</div>
	@elseif($user->userable->business && $user->userable->validated_at)

		@if($feedPlans->count() > 0)
			<h4>Feed Plan Terbaru</h4>
			<div class="owl-carousel owl-theme">
				@foreach($feedPlans as $feedPlan)
				<div class="item">
					<a href="{{ route('console.feed-plans.show', $feedPlan) }}" class="card-link">
						<div class="card shadow-sm my-3">
							<div class="row no-gutters">
								<div class="col-5 background-img" style="background-image: url('{{ $feedPlan->designs->count() > 0 ? asset("storage/designs/{$feedPlan->designs->pluck('design')->first()}") : asset('img/no-photo.jpg') }}')"></div>
								<div class="col-7">
									<div class="card-body">
										<h5 class="card-title text-dark headline">{{ $feedPlan->headline }}</h5>
										<p class="caption">{!! nl2br(e($feedPlan->caption)) !!}</p>
										<p class="card-text"><small class="text-muted">{{ $feedPlan->plan_date->translatedFormat('j F Y') }} | Feed Ke-{{ $feedPlan->feed_index }}</small></p>
									</div>
								</div>
							</div>
						</div>
					</a>
				</div>
				@endforeach
			</div>
		@endif

		@can('is-owner', $user->userable->business)
			@if($user->userable->business->candidateMembers->count() > 0)
				<div class="card shadow mb-3">
					<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
						<h6 class="m-0 font-weight-bold text-primary"><i class="fa fa-info-circle fa-fw"></i> Permintaan Anggota Baru</h6>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table class="table">
								<thead>
								<tr>
									<th>No.</th>
									<th>NIM</th>
									<th>Nama</th>
									<th>Aksi</th>
								</tr>
								</thead>
								<tbody>
								@foreach($user->userable->business->candidateMembers as $member)
									<tr>
										<td>{{ $loop->iteration }}</td>
										<td>{{ $member->nim }}</td>
										<td>{{ $member->name }}</td>
										<td>
											<form action="{{ route('console.businesses.accept-member', [$user->userable->business, $member]) }}" class="d-inline" method="POST">
												@csrf
												@method('PATCH')

												<button type="submit" class="btn btn-success btn-sm" @confirmation>Terima</button>
											</form>

											<form action="{{ route('console.businesses.delete-member', [$user->userable->business, $member]) }}" class="d-inline" method="POST">
												@csrf
												@method('DELETE')

												<button type="submit" class="btn btn-danger btn-sm" @confirmation>Tolak</button>
											</form>
										</td>
									</tr>
								@endforeach
								</tbody>
							</table>
						</div>
					</div>
				</div>
			@endif
		@endcan
	@else
		<div class="row justify-content-around">
			<div class="col-sm-6 col-lg-4">
				<div class="card shadow mb-3 text-center">
					<div class="card-body">
						<h4 class="card-title">Mendaftar Usaha Baru</h4>
						<p class="card-subtitle">Pilih opsi ini apabila kamu ingin mendaftarkan usaha tim kamu. Klik tombol dibawah dan lengkapi formulirnya!</p>
					</div>
					<div class="card-footer">
						<a href="{{ route('console.businesses.create') }}" class="btn btn-primary"><i class="fa fa-plus fa-fw"></i> Daftarkan Usaha</a>
					</div>
				</div>
			</div>
			<div class="col-sm-6 col-lg-4">
				<div class="card shadow mb-3 text-center">
					<div class="card-body">
						<h4 class="card-title">Bergabung ke Usaha</h4>
						<p class="card-subtitle">Pilih opsi ini apabila kamu ingin bergabung usaha tim kamu yang telah didaftarkan. Masukkan kode undangan atau minta tautan undangan.</p>
					</div>
					<div class="card-footer">
						<form action="{{ route('console.businesses.invite') }}" method="get" id="invite">
							<div class="input-group">
								<input type="text" name="code" class="form-control" placeholder="Kode Undangan" required>
								<div class="input-group-append">
									<button type="submit" class="btn btn-outline-secondary">Bergabung</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	@endif
@endsection

@section('scripts')
	<script src="{{ asset('vendor/owlcarousel/owl.carousel.min.js') }}"></script>
	<script>
		$('form#invite').submit(function (){
			code = $('[name="code"]');

			value = code.val();
			index = value.indexOf("?code=");

			if(index !== -1){
				code.val(value.substr(index + 6));
			}

			return true;
		});

		$('.owl-carousel').owlCarousel({
			margin: 15,
			responsive: {
				0: {
					items:1
				},
				600: {
					items:2
				},
				1000: {
					items:3
				}
			}
		})
	</script>
@endsection
