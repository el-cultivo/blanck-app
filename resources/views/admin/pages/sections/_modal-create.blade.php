@extends('layouts.modal',["modal_id"=> "pagesections-modal-create"])

@section('modal-title')
    {!! trans('manage_pages.sections.create_modal.label') !!}
@overwrite

@section('modal-content')

    {!! Form::open([
        'method'             => 'POST',
        'route'              => ['admin::pages.sections.ajax.store'],
        'role'               => 'form' ,
        'id'                 => 'create_page_section_form',
        'class'              => 'row',
        'v-on:submit.prevent' => 'post'
        ]) !!}

        <div class="input-field col s12">
            {!! Form::label('index', trans('manage_pages.sections.create_modal.form.index.label') , [
                'class' => 'input-label active',
            ]) !!}
            {!! Form::text('index', null, [
                'class'         => 'validate',
                'required'      => 'required',
                'form'          => 'create_page_section_form',
                'placeholder'   => trans('manage_pages.sections.create_modal.form.index.placeholder')
            ]) !!}
        </div>
        <div class=" input-field col s12">
            {!! Form::label('description',trans('manage_pages.sections.create_modal.form.description.label'), [
                'class' => 'input-label active',
            ]) !!}
            <v-editor :content.sync='item_on_create.description'></v-editor>
            <input type="hidden" v-model="item_on_create.description" name="description">
        </div>
        <div class=" input-field col s12">
            {!! Form::label('template_path',trans('manage_pages.sections.create_modal.form.template_path.label'), [
                'class' => 'input-label active',
            ]) !!}
            {!! Form::text('template_path', null, [
                'class'         => 'validate',
                'required'      => 'required',
                'form'          => 'create_page_section_form',
                'placeholder'   => trans('manage_pages.sections.create_modal.form.template_path.placeholder')
            ]) !!}
        </div>
        <div class="input-field col s6 ">
            {!! Form::label('components_max',trans('manage_pages.sections.create_modal.form.components_max.label'), [
                'class' => 'input-label active',
            ]) !!}
            {!! Form::number('components_max', null, [
                'min'           => 0,
                'step'          => 1,
                'class'         => 'validate',
                // 'required'      => 'required',
                'form'          => 'create_page_section_form',
                'placeholder'   => "3"
            ]) !!}
        </div>

        <div class="input-field col s6 ">
            {!! Form::select('type_id', $types_list,null, [
                'class'         => 'validate ',
                'required'      => 'required',
                 'placeholder'   => trans('manage_pages.sections.create_modal.form.type_id.placeholder'),
                'form'          => 'create_page_section_form',
                "id"            => "types-".'create_page_section_form'
            ])  !!}
            {!! Form::label("types-".'create_page_section_form', trans('manage_pages.sections.create_modal.form.type_id.label'), [
                'class'         => 'input-label active',
            ]) !!}
        </div>

        <div class="col s12 ">
            <h6>{!! trans('manage_pages.sections.create_modal.form.editable_contents.label') !!}</h6>

            <div class="row">
                @foreach ($editable_parts as $part_key => $part_label)
                    <div class="input-field col s6">
                        {{ Form::checkbox('editable_contents['.$part_key.']', true, null, [
                            'class' => 'filled-in',
                            'id'    => 'editable_contents-'.$part_key.'-create_page_section_form',
                            'form'	=> 'create_page_section_form',
                            ]) }}
                        {!! Form::label('editable_contents-'.$part_key.'-create_page_section_form', trans('manage_pages.sections.create_modal.form.editable_contents.'.$part_key.'.label') , [
                            'class' => 'input-label'
                        ]) !!}
                    </div>
                @endforeach
            </div>
            <br><br>
        </div>

        <div class="col s12 ">
            <div class="pull-right">
                {!! Form::submit(trans('manage_pages.sections.create_modal.form.save'), [
                    'class'  => 'btn waves-effect waves-light',
                    'form'   => 'create_page_section_form'
                ]) !!}
            </div>
        </div>
    {!! Form::close() !!}
@overwrite
