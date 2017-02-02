@extends('layouts.client')

@section('content')
	<div class="auth page">

		<div class="auth--title">
			Restablecer Contraseña
		</div>

		<form class="auth__form form" role="form" method="POST" action="{{ route('client::pass_reset:post') }}">
			{{ csrf_field() }}

			<input type="hidden" name="token" value="{{ $token }}" class="auth__form--input form--input">
			<input id="email" type="email" class="auth__form--input form--input" placeholder="Correo electrónico" name="email" value="{{ $email or old('email') }}" required autofocus>
			<input id="password" type="password" class="auth__form--input form--input" placeholder="Contraseña" name="password" required>
			<input id="password-confirm" type="password" class="auth__form--input form--input" placeholder="Confirmar Contraseña" name="password_confirmation" required>

			<button type="submit" class="auth__form--submit form--submit">
				Restablecer Contraseña
			</button>
		</form>

	</div>
@endsection
