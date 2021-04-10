@if ($paginator->hasPages())
	<div class="blog__pagination">
		{{-- Previous Page Link --}}
		@if (!$paginator->onFirstPage())
			<a href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">
				<i class="fa fa-long-arrow-left"></i>
			</a>
		@endif

		{{-- Pagination Elements --}}
		@foreach ($elements as $element)
			{{-- "Three Dots" Separator --}}
			@if (is_string($element))
				<a href="#" class="text-secondary" aria-disabled="true">{{ $element }}</a>
			@endif

			{{-- Array Of Links --}}
			@if (is_array($element))
				@foreach ($element as $page => $url)
					@if ($page == $paginator->currentPage())
						<a href="#" aria-current="page" style="background: #f03250;color: #ffffff;border-color: #f03250;">{{ $page }}</a>
					@else
						<a href="{{ $url }}">{{ $page }}</a>
					@endif
				@endforeach
			@endif
		@endforeach

		{{-- Next Page Link --}}
		@if ($paginator->hasMorePages())
			<a href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">
				<i class="fa fa-long-arrow-right"></i>
			</a>
		@endif
	</div>
@endif
