@extends('layouts.client')

@section('content')
	<div class="email page">
		<div class="email--wrap wrap">

			<div class="email--title page-title">
				Restablecer Contraseña
			</div>

			<form class="form" role="form" method="POST" action="{{ route('client::pass_reset_email') }}">
				{{ csrf_field() }}

				<div class="email__input-container">
					<input id="email" type="email" class="form--input" placeholder="Correo electrónico" name="email" value="{{ old('email') }}" required>
				</div>

				<div class="email__button-container">
					<button type="submit" class="form--submit">
						enviar enlace
					</button>
				</div>
			</form>

		</div>
	</div>
@endsection