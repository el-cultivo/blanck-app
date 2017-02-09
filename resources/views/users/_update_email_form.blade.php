{!! Form::open([
    'method'                => 'PATCH',
    'route'                 => ['user::email.update', $user->name],
    'role'                  => 'form' ,
    'id'                    => 'update_email_form',
    'class'                 => 'users__user-container--lg',
]) !!}

    <div class="users__input-container">
        {!! Form::email('email', null, [
            'class'         => 'input form--input account--input',
            'placeholder'   => 'Nuevo Correo Electrónico',
            'required'      => 'required',
            'form'          => 'update_email_form'
        ]) !!}
        {!! Form::password('password', [
            'class'         => 'input form--input account--input',
            'placeholder'   => 'Contraseña',
            'required'      => 'required',
            'form'          => 'update_email_form'
        ]) !!}
    </div>
    <div class="users__submit-container">
        {!! Form::submit('Guardar', [
            'class' => 'input__submit form--submit',
            'form'  => 'update_email_form'

        ]) !!}
    </div>

{!!Form::close()!!}
