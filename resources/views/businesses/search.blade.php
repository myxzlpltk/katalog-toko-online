@extends('layouts.public.app')

@section('title', 'Pencarian Usaha')
@section('bodyClass', 'ov-hid')
@section('hide-footer', true)

@section('stylesheets')
	<style>
		.filter__price .price-input:after{
			display: none;
		}
	</style>
@endsection

@section('content')
	<form action="{{ route('businesses.search') }}" method="get">
		<div class="filter nice-scroll">
			<div class="filter__title">
				<h5><i class="fa fa-filter"></i> Filter</h5>
			</div>
			<div class="filter__search">
				<input type="text" name="query" value="{{ request('query') }}" placeholder="Pencarian...">
			</div>
			<div class="filter__select">
				<select name="business_type_id">
					<option value="">Semua Kategori</option>
					@foreach($businessTypes as $businessType)
						<option value="{{ $businessType->id }}" @if($businessType->id == request('business_type_id')) selected @endif>{{ $businessType->name }}</option>
					@endforeach
				</select>
			</div>
			<div class="filter__btns">
				<button type="submit">Filter Hasil</button>
				<button type="button" class="filter__reset"><a href="{{ route('businesses.search') }}" class="text-dark">Reset Filter</a></button>
			</div>
		</div>
	</form>

	<section class="listing nice-scroll w-100">
		<div class="listing__text__top">
			<div class="listing__text__top__left">
				<h5>Hasil Pencarian Usaha</h5>
				<span>{{ $businesses->total() }} Ditemukan</span>
			</div>
		</div>
		<div class="listing__list">
			@foreach($businesses as $business)
				<x-business-card :business="$business"/>
			@endforeach
		</div>

		<div class="mb-4 d-flex justify-content-center">
			{{ $businesses->links('layouts.public.pagination') }}
		</div>
	</section>
@endsection

@section('scripts')
@endsection
