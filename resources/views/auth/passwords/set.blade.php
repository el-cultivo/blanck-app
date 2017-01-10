@extends('layouts.client')


@section('content')
	<div class="set page">
		<div class="set--wrap wrap">

			<div class="set--title page-title">
				Activar cuenta
			</div>

			{!! Form::open([
				'method'	=> 'PATCH',
				'route'		=> ['client::pass_set:patch',$encode_email],
				'role'		=> 'form',
				'id'		=> 'set_pasword_form',
				'class'		=> 'form'
				]) !!}

				{!! Form::password('password', [
					'class' => 'form--input',
					'required' => 'required',
					'placeholder' => 'Contraseña'
					]) !!}

				{!! Form::password('password_confirmation', [
					'class' => 'form--input',
					'required' => 'required',
					'placeholder' => 'Confirmar Contraseña'
					]) !!}

				<button type="submit" class="form--submit">
					enviar contraseña
				</button>

				</div>

			{!! Form::close() !!}

		</div>
	</div>
@endsection
