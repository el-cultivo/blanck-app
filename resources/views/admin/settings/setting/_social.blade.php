@include('admin.general._page-subtitle', ['title' => trans('manage_settings.social.title') ])
{!! Form::open([
      'method'              => 'PATCH',
      'route'              => ['admin::settings.update', 'social'],
      'role'                => 'form' ,
      'id'                  => 'update_setting-social_form',
      'class'               => "col s10 offset-s1"
]) !!}

    <div class="row">
        <div class="input-field col s12 ">
            {!! Form::label('facebook', trans('manage_settings.social.facebook.label'), ['class' => '']) !!}
            {!! Form::url('facebook', array_get($setting_social,'facebook'), [
                'class' => 'validate',
                'form' => 'update_setting-social_form',
                'placeholder' => trans('manage_settings.social.facebook.placeholder')
            ]) !!}
        </div>

        <div class="input-field col s12">
            {!! Form::label('twitter', trans('manage_settings.social.twitter.label'), ['class' => '']) !!}
            {!! Form::url('twitter', array_get($setting_social,'twitter'), [
                'class' => 'validate',
                'form' => 'update_setting-social_form',
                'placeholder' => trans('manage_settings.social.twitter.placeholder')
            ]) !!}
        </div>



        <div class="input-field col s12">
            {!! Form::label('instagram', trans('manage_settings.social.instagram.label'), ['class' => '']) !!}
            {!! Form::url('instagram', array_get($setting_social,'instagram'), [
                'class' => 'validate',
                'form' => 'update_setting-social_form',
                'placeholder' => trans('manage_settings.social.instagram.placeholder')
            ]) !!}
        </div>

        {{-- <div class="input-field col s12">

            {!! Form::label('pinterest', trans('manage_settings.social.pinterest.label'), ['class' => '']) !!}
            {!! Form::url('pinterest', array_get($setting_social,'pinterest'), [
                'class' => 'validate',
                'form' => 'update_setting-social_form',
                'placeholder' => trans('manage_settings.social.pinterest.placeholder')
            ]) !!}

        </div> --}}

        <div class="col s12">
            <div class="pull-right">
                {!! Form::submit(trans('manage_settings.social.create.form.save'), [
                    'class' => 'btn waves-effect waves-light',
                    'form'  => 'update_setting-social_form',
                    ]) !!}
            </div>
        </div>
    </div>

{!! Form::close() !!}
