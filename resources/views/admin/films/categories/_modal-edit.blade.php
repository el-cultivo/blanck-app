@extends('layouts.modal', ["modal_id"=> "categories-modal-edit"])

@section('modal-title')
    Editar categoría
@overwrite

@section('modal-content')
    {!! Form::open([
        'method'                => 'PATCH',
        'route'                 => ['admin::categories.ajax.update', '&#123;&#123;item_on_edit.id&#125;&#125;'],
        'role'                  => 'form' ,
        'id'                    => 'update_category-&#123;&#123;item_on_edit.id&#125;&#125;_form',
        'data-index'            => '&#123;&#123;editIndex&#125;&#125;',
        'v-on:submit.prevent'   => 'post'
    ]) !!}


    @foreach($languages as $language)
        <div class=" col s12">

            {!! Form::text("label"."[".$language->iso6391."]", null, [
                'class'         => 'validate',
                'required'      => 'required',
                'placeholder'   => "Nombre:",
                'form'          => 'update_category-&#123;&#123;item_on_edit.id&#125;&#125;_form',
                'v-model'       => 'item_on_edit.'.$language->iso6391.'_label'
            ]) !!}
        </div>
    @endforeach




    <div class="col s12 ">
        <div class="pull-right">
            {!! Form::submit('actualizar', [
                'class'  => 'btn waves-effect waves-light',
                'form'   => 'update_category-&#123;&#123;item_on_edit.id&#125;&#125;_form'
            ]) !!}
        </div>
    </div>


    {!! Form::close() !!}
@overwrite
