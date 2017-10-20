<!-- Modal Structure -->
<div id="alert__container" class="alert__container">
	<div id="alert__success" class="alert modal alert-success alerts alert__success"
		@if(session('status')) style="display:block" @endif
	>
		<span type="button" class="close alert__close alert__hide_JS modal-action modal-close waves-effect waves-green" aria-label="Close">
		<span aria-hidden="true">&times;</span></span>
		<p class="alert__text">{!! trans('alerts.success.label') !!}</p>
		@if (session('status'))
			<p class="alert__text">{{ session('status') }}</p>
		@endif
		<ul>
			<li class="text__alert-success text__alert-success_JS"></li>
			@if (isset($errors) && $errors->count() > 0)
				 @foreach ($errors->all() as $error)
					<li class="text__alert-success">{{ $error }}</li>
				@endforeach
			@endif
		</ul>
	</div>

	<div id="alert__danger" class="alert alert-danger modal alert__danger"
		@if (isset($errors) && $errors->count() > 0) style="display:block" @endif
	>
		<span type="button" class="close alert__close alert__hide_JS  modal-action modal-close waves-effect waves-green" aria-label="Close">
		<span aria-hidden="true">&times;</span></span>
		<p class="alert__text">{!! trans('alerts.error.label') !!}</p>
		<ul>
			<li class="alert__text"></li>
			@if (isset($errors) && $errors->count() > 0)
				 @foreach ($errors->all() as $error)
					<li class="alert__text">{{ $error }}</li>
				@endforeach
			@endif
		</ul>
	</div>
</div>
