
<div class="col s10 offset-s1">
	@unless (empty($title))
		<h3 class="text__p--instructions-title">{{ $title }}</h3>
	@endunless
	@unless (empty($instructions))
		<p class="text__p text__p--instructions">
			{!! $instructions !!}
		</p>
	@endunless
	<div class="divider"></div>
	<br>
</div>
