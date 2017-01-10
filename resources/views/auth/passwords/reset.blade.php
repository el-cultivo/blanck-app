@extends('layouts.client')

@section('content')
	<div class="reset page">
		<div class="reset--wrap wrap">

			<div class="reset--title page-title">
				<span class="">Restablecer Contraseña</span>
			</div>

			<form class="form" role="form" method="POST" action="{{ route('client::pass_reset:post') }}">
				{{ csrf_field() }}

				<input type="hidden" name="token" value="{{ $token }}" class="form--input">
				<input id="email" type="email" class="form--input" placeholder="Correo electrónico" name="email" value="{{ $email or old('email') }}" required autofocus>
				<input id="password" type="password" class="form--input" placeholder="Contraseña" name="password" required>
				<input id="password-confirm" type="password" class="form--input" placeholder="Confirmar Contraseña" name="password_confirmation" required>

				<button type="submit" class="form--submit">
					restablecer contraseña
				</button>
			</form>

		</div>
	</div>
@endsection
