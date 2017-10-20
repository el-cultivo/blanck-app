
{!! Form::open([
    'method'             => 'POST',
    'route'              => 'client::contact',
    'role'               => 'form' ,
    'id'                 => 'contact_form',
    'class'              => '',
    ]) !!}
    <div class=''>

        <div class=''>
            {!! Form::label('first_name', trans('contact_form.form.first_name.label') , [
                'class' => '',
                ]) !!}
            {!! Form::text('first_name', null, [
                'class'         => '',
                'required'      => 'required',
                'form'          => 'contact_form',
                'placeholder'   => trans('contact_form.form.first_name.placeholder')
            ]) !!}
        </div>

        <div class=' '>
            {!! Form::label('last_name',trans('contact_form.form.last_name.label'), [
                'class' => '',
                ]) !!}
            {!! Form::text('last_name', null, [
                'class'         => '',
                'required'      => 'required',
                'form'          => 'contact_form',
                'placeholder'   => trans('contact_form.form.last_name.placeholder')
            ]) !!}
        </div>

        <div class=''>
            {!! Form::label('email', trans('contact_form.form.email.label'), [
                'class' => '',
                ]) !!}
            {!! Form::email('email', null, [
                'class'       => '',
                'required'    => 'required',
                'form'        => 'contact_form',
                'placeholder' => trans('contact_form.form.email.placeholder')
            ]) !!}

        </div>

		<div class=' '>
            {!! Form::label('message',trans('contact_form.form.message.label'), [
                'class' => '',
                ]) !!}
            {!! Form::textarea('message', null, [
                'class'         => '',
                'form'          => 'contact_form',
                'placeholder'   => trans('contact_form.form.message.placeholder')
            ]) !!}
        </div>

        <div class=''>
            <div class=''>
                {!! Form::submit(trans('contact_form.form.message.send'), [
                    'class' => '',
                    'form'  => 'contact_form'
                ]) !!}
            </div>
        </div>
    </div>
{!! Form::close() !!}
