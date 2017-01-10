{!! Form::open([
    'method'             => $form_method,
    'route'              => $form_route,
    'role'               => 'form' ,
    'id'                 => $form_id,
    'class'              => 'col s10  offset-s1',
    ]) !!}
    <div class="row">

        <div class="input-field col s6">
            {!! Form::label('first_name', "Nombre(s):", [
                'class' => '',


                ]) !!}
            {!! Form::text('first_name', $user_edit->first_name, [
                'class'         => 'validate',
                'required'      => 'required',
                'form'          => $form_id,
                'placeholder'   =>  "María"
            ]) !!}
        </div>

        <div class=" input-field col s6">
            {!! Form::label('last_name',"Apellido(s):", [
                'class' => '',


                ]) !!}
            {!! Form::text('last_name', $user_edit->last_name, [
                'class'         => 'validate',
                'required'      => 'required',
                'form'          => $form_id,
                'placeholder'   => "Pérez"
            ]) !!}
        </div>

        <div class="input-field col s6">
            {!! Form::label('email', "Email:", [
                'class' => '',


                ]) !!}
            {!! Form::email('email', $user_edit->email, [
                'class'       => 'validate',
                'required'    => 'required',
                'form'        => $form_id,
                'placeholder' => "ejemplo@ejemplo.com"
            ]) !!}

        </div>

        <div class="input-field col s6 ">

            {!! Form::select('roles[]', $rolesList, $user_edit->getFirstRoleId(), [
                'class'         => 'validate users-create__role-select',
                'required'      => 'required',
                 'placeholder'   => "Seleccionar",
                'form'          => $form_id,
                "id"            => "roles"
            ])  !!}

            {!! Form::label('roles', "Roles:", [

            ]) !!}

        </div>

        <div class="col s12 ">
            <div class="pull-right">
                {!! Form::submit("Guardar", [
                    'class' => 'btn waves-effect waves-light',
                    'form'  => $form_id
                ]) !!}
            </div>
        </div>
    </div>
{!! Form::close() !!}
