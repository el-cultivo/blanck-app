{!! Form::open([
	'method'		=> 'PATCH',
	'route'			=> ['user::password.update', $user->name],
	'role'			=> 'form' ,
	'id'			=> 'update_password_form',
	'class'			=> 'users__user-container--lg',
]) !!}

	{!! Form::password('old_password', [
		'class'			=> 'input form--input account--input',
		'placeholder'	=> 'Contraseña Actual',
		'required'		=> 'required',
		'form'			=> 'update_password_form'
	]) !!}

	{!! Form::password('password', [
		'class'			=> 'input form--input account--input',
		'placeholder'	=> 'Nueva Contraseña',
		'required'		=> 'required',
		'form'			=> 'update_password_form'
	]) !!}

	{!! Form::password('password_confirmation', [
		'class'			=> 'input form--input account--input',
		'placeholder'	=> 'Confirmar Contraseña',
		'required'		=> 'required',
		'form'			=> 'update_password_form'
	]) !!}

	{!! Form::submit('Guardar', [
		'class'	=> 'input__submit form--submit account--submit',
		'form'	=> 'update_password_form'

	]) !!}

	<a class="account--link" href="{{ route('client::pass_reset:get') }}">
		Olvidé mi Contraseña
	</a>

{!!Form::close()!!}
