@extends('layouts.console.app')

@section('title', $feedPlan->topic)

@section('stylesheets')
@endsection

@section('breadcrumbs')
	{{ \Diglactic\Breadcrumbs\Breadcrumbs::render('console.feed-plans.show', $feedPlan) }}
@endsection

@section('actions')
	@can('update', $feedPlan)
	<a href="{{ route('console.feed-plans.edit', $feedPlan) }}" class="btn btn-warning btn-sm"><i class="fa fa-edit fa-fw"></i> Edit</a>
	@endcan

	@can('delete', $feedPlan)
	<form action="{{ route('console.feed-plans.destroy', $feedPlan) }}" class="d-inline" method="POST">
		@csrf
		@method('DELETE')

		<button type="submit" class="btn btn-danger btn-sm" @confirmation>Hapus</button>
	</form>
	@endcan
@endsection

@section('content')
	<div class="row">
		<div class="col-md-8">
			<div class="card shadow mb-3">
				<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
					<h6 class="m-0 font-weight-bold text-primary"><i class="fa fa-info-circle fa-fw"></i> Informasi Data Feed Plan Ke-{{ $feedPlan->feed_index }}</h6>
				</div>
				<div class="card-body">
					<table class="table table-borderless table-sm">
						<tr>
							<th>Topik</th>
							<td>{{ $feedPlan->topic }}</td>
						</tr>
						<tr>
							<th>Tanggal Plan</th>
							<td>{{ $feedPlan->plan_date->translatedFormat('j F Y H:i') }}</td>
						</tr>
						<tr>
							<th>Konten</th>
							<td>{!! nl2br(e($feedPlan->content)) !!}</td>
						</tr>
						<tr>
							<th>Headline</th>
							<td>{!! nl2br(e($feedPlan->headline)) !!}</td>
						</tr>
						<tr>
							<th>Caption</th>
							<td>{!! nl2br(e($feedPlan->caption)) !!}</td>
						</tr>
					</table>
				</div>
			</div>
		</div>

		<div class="col-md-4">
			<div class="card shadow mb-3">
				<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
					<h6 class="m-0 font-weight-bold text-primary"><i class="fa fa-file-image fa-fw"></i> Brief Image</h6>
				</div>
				<div class="card-body text-center">
					<img src="{{ asset("storage/briefs/{$feedPlan->brief_image}") }}" alt="Brief Image" class="img-fluid mx-auto d-block mb-3">
				</div>
			</div>
		</div>

		<div class="col-12">
			<div class="card shadow mb-3">
				<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
					<h6 class="m-0 font-weight-bold text-primary"><i class="far fa-images fa-fw"></i> Desainer</h6>
					@can('create', [\App\Models\FeedPlanDesign::class, $feedPlan])
					<a href="{{ route('console.feed-plans.feed-plan-designs.create', $feedPlan) }}" class="btn btn-primary btn-sm"><i class="fa fa-plus fa-fw"></i> Tambah Data</a>
					@endcan
				</div>
				<div class="card-body">
					<div class="row no-gutters">
						@forelse($feedPlan->designs as $design)
							<div class="col-4 col-md-3 col-lg-2">
								<div class="card m-2">
									<img src="{{ asset("storage/designs/{$design->design}") }}" alt="Desain Feed Plan" class="card-img">
								</div>

								@can('delete', $design)
								<form action="{{ route('console.feed-plan-designs.destroy', $design) }}" class="m-2" method="POST">
									@csrf
									@method('DELETE')

									<button type="submit" class="btn btn-outline-danger btn-sm btn-block" @confirmation><i class="fa fa-trash fa-fw"></i> Hapus</button>
								</form>
								@endcan
							</div>
						@empty
							<div class="col-12">
								<p class="text-muted text-center">Tidak ada data</p>
							</div>
						@endforelse
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('scripts')
@endsection
