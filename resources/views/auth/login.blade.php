@extends('layouts.client')

@section('content')
	<div class="login page">
		<div class="login--wrap wrap">

			<div class="login--title page-title">
				Iniciar Sesión
			</div>

			<form class="login__form form" role="form" method="POST" action="{{ route('client::login:post') }}">
				{{ csrf_field() }}
				<input id="email" type="email" class="login__form--input form--input" placeholder="Email" name="email" value="{{ old('email') }}" required autofocus>
				<input id="password" type="password" class="login__form--input form--input" placeholder="Contraseña" name="password" required>
				<button type="submit" class="login__form--submit form--submit" name="button">Entrar</button>
			</form>

			<div class="login__links">
				<a class="login__links--password login__links--link" href="{{ route('client::pass_reset:get') }}">
					Olvidé la contraseña
				</a>
			{{-- @if (env('CLTVO_DEV_MODE'))
				<a class="login__links--registro login__links--link" href="{{ route('client::register:get') }}">
					Registrar nuevo usuario
				</a>
			@endif --}}
			</div>


		</div>
	</div>
@endsection
