@extends('layouts.admin')

@section('title')
    {!! trans('manage_seo.edit.label') !!}
@endsection

@section('h1')
    {!! trans('manage_seo.edit.label') !!}
@endsection

@section('action')
    <a href="{{ route( 'admin::seo.index' ) }}" class="btn-floating btn-icon">
        <i class="material-icons waves-effect waves-light " >view_list</i>
    </a>
@endsection

@section('content')
    
    @include('admin.general._page-instructions', [
        'title'         =>  '',
        'instructions'  =>  trans('manage_seo.edit.instructions')
    ])

    <div class="col s10 offset-s1">

        <div style="margin-top: 20px; margin-bottom: 30px;">
            <label for="">{{ trans('manage_seo.edit.route') }}:</label>
            <a href="{{ $seo->uri }}" target="_blank">{{ $seo->uri }}</a>
        </div>

        <div class="row">
            <div class="col s2">
                <single-image
                    :ref-path="['seo']"
                    :current-image="store.seo.thumbnail_image"
                    :photoable-id="store.seo.id"
                    photoable-type="seo"
                    default-order="null"
                    use='thumbnail'
                ></single-image>
            </div>
        </div>

        <br><br>
        
        {!! Form::open([
            'method'	=> 'PATCH',
            'route' 	=> ['admin::seo.update', $seo],
            'role'  	=> 'form' ,
            'id'    	=> 'edit_seo_form',
        ]) !!}
            <div class="row">
                <div class="col s12">

                    @foreach($languages as $lang)
                        <div class="input-field">
                            {!! Form::label('title_'.$lang->iso6391, trans('manage_seo.edit.form.title.label',["language" => $lang->label]), [
                                'class' => 'active'
                            ]) !!}
                            {!! Form::text('title['.$lang->iso6391.']', $seo->translation($lang->iso6391)->title, [
                                'class'         => 'validate',
                                'required'      => 'required',
                                'form'          => 'edit_seo_form',
                                'placeholder'   =>  trans('manage_seo.edit.form.title.placeholder'),
                                'id'            => 'title_'.$lang->iso6391
                            ]) !!}
                        </div>

                        <div class="input-field">
                            {!! Form::label('description_'.$lang->iso6391, trans('manage_seo.edit.form.description.label',["language" => $lang->label]), [
                                'class' => 'active'
                            ]) !!}
                            {!! Form::textarea('description['.$lang->iso6391.']', $seo->translation($lang->iso6391)->description, [
                                'class' 		=> 'materialize-textarea ',
                                'required'      => 'required',
                                'form'          => 'edit_seo_form',
                                'placeholder'   =>  trans('manage_seo.edit.form.description.placeholder'),
                                'id'            => 'description_'.$lang->iso6391
                            ]) !!}
                        </div>

                        @include('admin.seo._googleSearchResults', [
                            'seo' => $seo,
                            'language' => $lang
                        ])

                    @endforeach
                </div>

                <div class="col s12">
                    <div class="pull-right">
                        <br><br>
                        {!! Form::submit(trans('manage_seo.edit.form.save'), [
                            'class' => 'btn waves-effect waves-light',
                            'form'  => 'edit_seo_form'
                        ]) !!}
                    </div>
                </div>
            </div>
        {!! Form::close() !!}

    </div>

@endsection

@section('vue_templates')
    @include('admin.media_manager.vue._modal-media_manager')
    @include('admin.media_manager.vue.single-image-template')
@endsection

@section('vue_store')
    <script>
        mainVueStore.seo =  {!! $seo !!};
    </script>
@endsection

