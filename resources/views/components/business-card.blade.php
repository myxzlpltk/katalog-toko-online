<div class="listing__item">
	<a href="{{ route('businesses.view', $business) }}">
		<div class="listing__item__pic set-bg" data-setbg="{{ $business->background_path }}">
			<img src="{{ $business->logo_path }}" alt="" style="height: 60px;width: 60px;">
			<div class="listing__item__pic__tag">{{ $business->businessType->name }}</div>
		</div>
		<div class="listing__item__text">
			<div class="listing__item__text__inside">
				<h5>{{ $business->name }}</h5>
				<p class="text-muted">{{ $business->tagline }}</p>
			</div>
			<div class="listing__item__text__info p-0"></div>
		</div>
	</a>
</div>
