@extends('layouts.client')

@section('content')
	<div class="auth page">

		<div class="auth--title">
			Iniciar Sesión
		</div>

		<form class="auth__form form" role="form" method="POST" action="{{ route('client::login:post') }}">
			{{ csrf_field() }}
			<input id="email" type="email" class="auth__form--input form--input" placeholder="Email" name="email" value="{{ old('email') }}" required autofocus>
			<input id="password" type="password" class="auth__form--input form--input" placeholder="Contraseña" name="password" required>
			<button type="submit" class="auth__form--submit form--submit" name="button">Entrar</button>
		</form>

		<div class="auth__links">
			<a class="auth__links--password auth__links--link" href="{{ route('client::pass_reset:get') }}">
				Olvidé la contraseña
			</a>
		@if (config("cltvo.open_register") && config("cltvo.open_site"))
			<a class="auth__links--registro auth__links--link" href="{{ route('client::register:get') }}">
				Registrar nuevo usuario
			</a>
		@endif
		</div>

	</div>
@endsection
