@extends('layouts.client')

@section('content')
	<div class="auth page">
		<div class="auth--wrap wrap">

			<div class="auth--title page-title">
				Registrar Nuevo Usuario
			</div>

			<form class="form" role="form" method="POST" action="{{ route('client::auth:post') }}">
				{{ csrf_field() }}
				<div class="">
					<input id="first_name" type="text" class="form--input" placeholder="Nombre" name="first_name" value="{{ old('first_name') }}" required autofocus>
					<input id="last_name" type="text" class="form--input" placeholder="Apellido" name="last_name" value="{{ old('last_name') }}" required autofocus>
					<input id="email" type="email" class="form--input" placeholder="Correo Electrónico" name="email" value="{{ old('email') }}" required>
					<input id="password" type="password" class="form--input" placeholder="Contraseña" name="password" required>
					<input id="password-confirm" type="password" class="form--input" placeholder="Confirmar contraseña" name="password_confirmation" required>
				</div>
				<button type="submit" class="form--submit">
					Crear Cuenta
				</button>
			</form>

			<div class="auth__links">
				<a class="auth__links--link" href="{{ route('client::login:get') }}">
					Ya estoy registrado
				</a>

				<a class="auth__links--link" href="{{ route('client::pages.index') }}">
					Ir a la página principal
				</a>
			</div>

		</div>
	</div>
@endsection