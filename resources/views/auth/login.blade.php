@extends('layouts.client')

@section('content')
	<div class="auth page">

		<div class="auth--title">
			{!! trans('auth.login.label') !!}
		</div>

		<form class="auth__form form" role="form" method="POST" action="{{ route('client::login:post') }}">
			{{ csrf_field() }}
			<input id="email" type="email" class="auth__form--input form--input" placeholder="{!! trans('auth.login.form.email.placeholder') !!}" name="email" value="{{ old('email') }}" required autofocus>
			<input id="password" type="password" class="auth__form--input form--input" placeholder="{!! trans('auth.login.form.password.placeholder') !!}" name="password" required>
			<button type="submit" class="auth__form--submit form--submit" name="button">{!! trans('auth.login.form.enter') !!}</button>
		</form>

		<div class="auth__links">
			<a class="auth__links--password auth__links--link" href="{{ route('client::pass_reset:get') }}">
				{!! trans('auth.password_reset_email.label') !!}
			</a>
		@if (config("cltvo.open_register") && config("cltvo.open_site"))
			<a class="auth__links--registro auth__links--link" href="{{ route('client::register:get') }}">
				{!! trans('auth.register.label') !!}
			</a>
		@endif
		</div>

	</div>
@endsection
