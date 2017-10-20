@extends('layouts.client')

@section('content')
	<div class="auth page">

		<div class="auth--title">
			{!! trans('auth.password_reset.label') !!}
		</div>

		<form class="auth__form form" role="form" method="POST" action="{{ route('client::pass_reset:post') }}">
			{{ csrf_field() }}

			<input type="hidden" name="token" value="{{ $token }}" class="auth__form--input form--input">
			<input id="email" type="email" class="auth__form--input form--input" placeholder="{!! trans('auth.password_reset.form.email.placeholder') !!}" name="email" value="{{ $email or old('email') }}" required autofocus>
			<input id="password" type="password" class="auth__form--input form--input" placeholder="{!! trans('auth.password_reset.form.password.placeholder') !!}" name="password" required>
			<input id="password-confirm" type="password" class="auth__form--input form--input" placeholder="{!! trans('auth.password_reset.form.password_confirmation.placeholder') !!}" name="password_confirmation" required>

			<button type="submit" class="auth__form--submit form--submit">
					{!! trans('auth.password_reset.form.save') !!}
			</button>
		</form>

	</div>
@endsection
