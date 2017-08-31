
{!! Form::open([
    'method'             => 'POST',
    'route'              => 'client::contact',
    'role'               => 'form' ,
    'id'                 => 'contact_form',
    'class'              => '',
    ]) !!}
    <div class=''>

        <div class=''>
            {!! Form::label('first_name', 'Nombre(s):', [
                'class' => '',


                ]) !!}
            {!! Form::text('first_name', null, [
                'class'         => '',
                'required'      => 'required',
                'form'          => 'contact_form',
                'placeholder'   =>  'María'
            ]) !!}
        </div>

        <div class=' '>
            {!! Form::label('last_name','Apellido(s):', [
                'class' => '',


                ]) !!}
            {!! Form::text('last_name', null, [
                'class'         => '',
                'required'      => 'required',
                'form'          => 'contact_form',
                'placeholder'   => 'Pérez'
            ]) !!}
        </div>

        <div class=''>
            {!! Form::label('email', 'Email:', [
                'class' => '',


                ]) !!}
            {!! Form::email('email', null, [
                'class'       => '',
                'required'    => 'required',
                'form'        => 'contact_form',
                'placeholder' => 'ejemplo@ejemplo.com'
            ]) !!}

        </div>

		<div class=' '>
            {!! Form::label('message','Apellido(s):', [
                'class' => '',


                ]) !!}
            {!! Form::textarea('message', null, [
                'class'         => '',
                'form'          => 'contact_form',
                'placeholder'   => 'Hola...'
            ]) !!}
        </div>

        <div class=''>
            <div class=''>
                {!! Form::submit('Guardar', [
                    'class' => '',
                    'form'  => 'contact_form'
                ]) !!}
            </div>
        </div>
    </div>
{!! Form::close() !!}
