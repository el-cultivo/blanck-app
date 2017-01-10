@extends('layouts.modal',["modal_id"=> "categories-modal-create"])

@section('modal-title')
    Agregar categoría
@overwrite

@section('modal-content')



    {!! Form::open([
        'method'                => 'POST',
        'route'                 => ['admin::categories.ajax.store'],
        'role'                  => 'form' ,
        'id'                    => 'create_category_form',
        'class'                 => 'row',
        'v-on:submit.prevent'   => 'post'
    ]) !!}

        @foreach($languages as $language)
            <div class="input-field col s12">
                {!! Form::label("label[".$language->iso6391."]", 'Nombre:', ['class' => 'input-label']) !!}
                {!! Form::text("label[".$language->iso6391."]", null, [
                    'class'       => 'validate',
                    //'placeholder' => "aliados mediáticos",
                    'required'    => 'required',
                    'form'        => 'create_category_form'
                ]) !!}
            </div>
        @endforeach

        <div class="col s12 ">
            <div class="pull-right">
                {!! Form::submit("Guardar", [
                    'class' => 'btn waves-effect waves-light',
                    'form'  => 'create_category_form'
                ]) !!}
            </div>
        </div>

    {!!Form::close()!!}

@overwrite
