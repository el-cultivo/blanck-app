@include('admin.general._page-subtitle', ['title' => trans('manage_settings.mail.title') ])
{!! Form::open([
      'method'              => 'PATCH',
      'route'               => ['admin::settings.update', 'mail'],
      'role'                => 'form' ,
      'id'                  => 'update_setting-mail_form',
      'class'               => "col s10 offset-s1"
]) !!}

    <div class="row ">

        <div class="input-field col s6 ">

            {!! Form::label('contact', trans('manage_settings.mail.contact.label'), ['class' => '']) !!}

            {!! Form::email('contact', array_get($setting_mail,'contact'), [
                'class'         => 'validate',
                'form'          => 'update_setting-mail_form',
                'placeholder'   => trans('manage_settings.mail.contact.placeholder'),
                'required'      => 'required',
            ]) !!}

        </div>

        <div class="input-field col s6 ">

            {!! Form::label('notifications', trans('manage_settings.mail.notifications.label'), ['class' => '']) !!}

            {!! Form::email('notifications', array_get($setting_mail,'notifications'), [
                'class'         => 'validate',
                'form'          => 'update_setting-mail_form',
                'placeholder'   => trans('manage_settings.mail.notifications.placeholder'),
                'required'      => 'required',
            ]) !!}

        </div>

        <div class="input-field col s12 ">

            {!! Form::label('system', trans('manage_settings.mail.system.label'), ['class' => '']) !!}

            {!! Form::email('system', array_get($setting_mail,'system'), [
                'class'         => 'validate',
                'form'          => 'update_setting-mail_form',
                'placeholder'   => trans('manage_settings.mail.system.placeholder'),
                'required'      => 'required',
            ]) !!}

        </div>

    </div>

    <div class="row ">
        @foreach($languages as $lang)
            <div class="input-field col s12 ">
                {!! Form::label('mail_greeting['.$lang->iso6391.']', trans('manage_settings.mail.mail_greeting.'.$lang->iso6391.'.label'), ['class' => '']) !!}
                {!! Form::textarea('mail_greeting['.$lang->iso6391.']', array_get($setting_mail,'mail_greeting.'.$lang->iso6391), [
                    'class' => 'materialize-textarea ',
                    'form'  => 'update_setting-mail_form',
                    'rows'  => 2,
                ]) !!}
            </div>

            <div class="input-field col s12 ">
                {!! Form::label('mail_farewell['.$lang->iso6391.']', trans('manage_settings.mail.mail_farewell.'.$lang->iso6391.'.label'), ['class' => '']) !!}
                {!! Form::textarea('mail_farewell['.$lang->iso6391.']', array_get($setting_mail,'mail_farewell.'.$lang->iso6391), [
                    'class' => 'materialize-textarea ',
                    'form'  => 'update_setting-mail_form',
                    'rows'  => 2,
                ]) !!}
            </div>

            <div class="input-field col s12 ">
                {!! Form::label('register_copy['.$lang->iso6391.']', trans('manage_settings.mail.register_copy.'.$lang->iso6391.'.label'), ['class' => '']) !!}
                {!! Form::textarea('register_copy['.$lang->iso6391.']', array_get($setting_mail,'register_copy.'.$lang->iso6391), [
                    'class' => 'materialize-textarea ',
                    'form'  => 'update_setting-mail_form',
                    'rows'  => 2,
                ]) !!}
            </div>

            {{-- <div class="input-field col s12 ">
                {!! Form::label('purchase_copy['.$lang->iso6391.']', trans('manage_settings.mail.purchase_copy.'.$lang->iso6391.'.label'), ['class' => '']) !!}
                {!! Form::textarea('purchase_copy['.$lang->iso6391.']', array_get($setting_mail,'purchase_copy.'.$lang->iso6391), [
                    'class' => 'materialize-textarea ',
                    'form'  => 'update_setting-mail_form',
                    'rows'  => 2,
                    // 
                ]) !!}
            </div> --}}

            {{-- <div class="input-field col s12 ">
                {!! Form::label('thanks_copy['.$lang->iso6391.']', trans('manage_settings.mail.thanks_copy.'.$lang->iso6391.'.label'), ['class' => '']) !!}
                {!! Form::textarea('thanks_copy['.$lang->iso6391.']', array_get($setting_mail,'thanks_copy.'.$lang->iso6391), [
                    'class' => 'materialize-textarea ',
                    'form'  => 'update_setting-mail_form',
                    'rows'  => 2,
                ]) !!}
            </div> --}}
        @endforeach

        <div class="col s12">

            <div class="pull-right">
                {!! Form::submit('manage_settings.mail.create.form.save'), [
                    'class' => 'btn waves-effect waves-light',
                    'form'  => 'update_setting-mail_form',
                    ]) !!}
            </div>
        </div>
    </div>


{!! Form::close() !!}
