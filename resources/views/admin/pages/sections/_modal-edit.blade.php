@extends('layouts.modal', ["modal_id"=> "pagesections-modal-edit"])

@section('modal-title')
    Editar una seccion de página
@overwrite

@section('modal-content')

    {!! Form::open([
        'method'             => 'PATCH',
        'route'              => ['admin::pages.sections.ajax.update','&#123;&#123;item_on_edit.id&#125;&#125;'],
        'role'               => 'form' ,
        'id'                 => 'update_page_section-&#123;&#123;item_on_edit.id&#125;&#125;_form',
        'class'              => 'row',
        'v-on:submit.prevent' => 'post'
        ]) !!}

        <div class="input-field col s6">
            {!! Form::label('index', "Nombre:", [
                'class' => 'input-label active',
            ]) !!}
            {!! Form::text('index', null, [
                'v-model'       => 'item_on_edit.index',
                'class'         => 'validate',
                'required'      => 'required',
                'form'          => 'update_page_section-&#123;&#123;item_on_edit.id&#125;&#125;_form',
                'placeholder'   => 'home-slider'
            ]) !!}
        </div>

        <div class=" input-field col s12">
            {!! Form::label('template_path',"Client template path:", [
                'class' => 'input-label active',
            ]) !!}
            {!! Form::text('template_path', null, [
                'v-model'       => 'item_on_edit.template_path',
                'class'         => 'validate',
                'required'      => 'required',
                'form'          => 'update_page_section-&#123;&#123;item_on_edit.id&#125;&#125;_form',
                'placeholder'   => "home.slider"
            ]) !!}
        </div>
        <div class="input-field col s6 ">
            {!! Form::label('components_max',"Número maximo de componentes:", [
                'class' => 'input-label active',
            ]) !!}
            {!! Form::number('components_max', null, [
                'v-model'       => 'item_on_edit.components_max',
                'min'           => 0,
                'step'          => 1,
                'class'         => 'validate',
                'required'      => 'required',
                'form'          => 'update_page_section-&#123;&#123;item_on_edit.id&#125;&#125;_form',
                'placeholder'   => "3"
            ]) !!}
        </div>

        <div class="input-field col s6 ">
            {!! Form::select('type_id', $types_list,null, [
                'class'         => 'validate ',
                'required'      => 'required',
                'v-model'       => 'item_on_edit.type_id',
                 'placeholder'   => "Seleccionar",
                'form'          => 'update_page_section-&#123;&#123;item_on_edit.id&#125;&#125;_form',
                "id"            => "types-".'update_page_section-&#123;&#123;item_on_edit.id&#125;&#125;_form',
            ])  !!}
            {!! Form::label("types-".'update_page_section-&#123;&#123;item_on_edit.id&#125;&#125;_form', "Tipo:", [
                'class'         => 'input-label active',
            ]) !!}
        </div>

        <div class="col s12 ">
            <div class="pull-right">
                {!! Form::submit('Crear', [
                    'class'  => 'btn waves-effect waves-light',
                    'form'   => 'update_page_section-&#123;&#123;item_on_edit.id&#125;&#125;_form',
                ]) !!}
            </div>
        </div>

    {!! Form::close() !!}


@overwrite
