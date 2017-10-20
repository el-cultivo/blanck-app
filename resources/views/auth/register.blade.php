@extends('layouts.client')

@section('content')
	<div class="auth page">
		<div class="auth--wrap wrap">

			<div class="auth--title page-title">
				{!! trans('auth.register.label') !!}
			</div>

			<form class="form" role="form" method="POST" action="{{ route('client::register:post') }}">
				{{ csrf_field() }}
				<div class="">
					<input id="first_name" type="text" class="form--input" placeholder="{!! trans('auth.register.form.first_name.placeholder') !!}" name="first_name" value="{{ old('first_name') }}" required autofocus>
					<input id="last_name" type="text" class="form--input" placeholder="{!! trans('auth.register.form.last_name.placeholder') !!}" name="last_name" value="{{ old('last_name') }}" required autofocus>
					<input id="email" type="email" class="form--input" placeholder="{!! trans('auth.register.form.email.placeholder') !!}" name="email" value="{{ old('email') }}" required>
					<input id="password" type="password" class="form--input" placeholder="{!! trans('auth.register.form.password.placeholder') !!}" name="password" required>
					<input id="password-confirm" type="password" class="form--input" placeholder="{!! trans('auth.register.form.password_confirmation.placeholder') !!}" name="password_confirmation" required>
				</div>
				<button type="submit" class="form--submit">
					{!! trans('auth.register.form.save') !!}
				</button>
			</form>

			<div class="auth__links">
				<a class="auth__links--link" href="{{ route('client::login:get') }}">
					{!! trans('auth.register.back_to_login') !!}
				</a>

				<a class="auth__links--link" href="{{ route('client::pages.index') }}">
					{!! trans('auth.register.back_to_site') !!}
				</a>
			</div>

		</div>
	</div>
@endsection
