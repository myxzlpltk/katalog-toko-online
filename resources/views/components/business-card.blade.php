<div class="listing__item">
	<div class="listing__item__pic set-bg" data-setbg="{{ asset("storage/briefs/{$business->feedplans_max_brief_image}") }}">
		<img src="{{ $business->logo_path }}" alt="" style="height: 60px;width: 60px;">
		<div class="listing__item__pic__tag">{{ $business->businessType->name }}</div>
	</div>
	<div class="listing__item__text">
		<div class="listing__item__text__inside">
			<a href="{{ route('businesses.view', $business) }}">
				<h5>{{ $business->name }}</h5>
				<p class="text-muted">{{ $business->tagline }}</p>
			</a>
		</div>
		<div class="listing__item__text__info p-0"></div>
	</div>
</div>
