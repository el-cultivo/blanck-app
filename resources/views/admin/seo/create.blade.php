@extends('layouts.admin')

@section('title')
    {!! trans('manage_seo.create.label') !!}
@endsection

@section('h1')
    {!! trans('manage_seo.create.label') !!}
@endsection

@section('action')
    <a href="{{ route( 'admin::seo.index' ) }}" class="btn-floating btn-icon">
        <i class="material-icons waves-effect waves-light " >view_list</i>
    </a>
@endsection

@section('content')
    
    @include('admin.general._page-instructions', [
        'title'         =>  '',
        'instructions'  =>  trans('manage_seo.create.instructions')
    ])

    <div class="col s10 offset-s1">
        
        {!! Form::open([
            'method'	=> 'POST',
            'route' 	=> ['admin::seo.store'],
            'role'  	=> 'form' ,
            'id'    	=> 'create_seo_form',
        ]) !!}

            <div class="row">
                <div class="col s12">
                	
                	<div class="input-field">
                	    {!! Form::label('route_name', trans('manage_seo.create.form.route_name.label'), [
                	        'class' => 'active'
                	    ]) !!}
                	    {!! Form::text('route_name', null, [
                	        'class'         => 'validate',
                	        'required'      => 'required',
                	        'form'          => 'create_seo_form',
                	        'placeholder'   =>  trans('manage_seo.create.form.route_name.placeholder'),
                	        'id'            => 'route_name'
                	    ]) !!}
                	</div>

                    @foreach($languages as $lang)
                        <div class="input-field">
                            {!! Form::label('title_'.$lang->iso6391, trans('manage_seo.create.form.title.label',["language" => $lang->label]), [
                                'class' => 'active'
                            ]) !!}
                            {!! Form::text('title['.$lang->iso6391.']', null, [
                                'class'         => 'validate',
                                'required'      => 'required',
                                'form'          => 'create_seo_form',
                                'placeholder'   =>  trans('manage_seo.create.form.title.placeholder'),
                                'id'            => 'title_'.$lang->iso6391
                            ]) !!}
                        </div>

                        <div class="input-field">
                            {!! Form::label('description_'.$lang->iso6391, trans('manage_seo.create.form.description.label',["language" => $lang->label]), [
                                'class' => 'active'
                            ]) !!}
                            {!! Form::textarea('description['.$lang->iso6391.']', null, [
                                'class' 		=> 'materialize-textarea ',
                                'required'      => 'required',
                                'form'          => 'create_seo_form',
                                'placeholder'   =>  trans('manage_seo.create.form.description.placeholder'),
                                'id'            => 'description_'.$lang->iso6391
                            ]) !!}
                        </div>

                    @endforeach
                </div>
                <div class="col s12">
                    <div class="pull-right">
                        {!! Form::submit(trans('manage_seo.create.form.save'), [
                            'class' => 'btn waves-effect waves-light',
                            'form'  => 'create_seo_form'
                        ]) !!}
                    </div>
                </div>
            </div>
        {!! Form::close() !!}
    </div>

@endsection