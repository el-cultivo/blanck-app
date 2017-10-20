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
            'placeholder'   => trans('user.update_email.form.email.placeholder'),
            'required'      => 'required',
            'form'          => 'update_email_form'
        ]) !!}
        {!! Form::password('password', [
            'class'         => 'input form--input account--input',
            'placeholder'   => trans('user.update_email.form.password.placeholder'),
            'required'      => 'required',
            'form'          => 'update_email_form'
        ]) !!}
    </div>
    <div class="users__submit-container">
        {!! Form::submit(trans('user.update_email.form.save'), [
            'class' => 'input__submit form--submit',
            'form'  => 'update_email_form'

        ]) !!}
    </div>

{!!Form::close()!!}
