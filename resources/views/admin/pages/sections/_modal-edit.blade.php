@extends('layouts.modal', ["modal_id"=> "pagesections-modal-edit"])

@section('modal-title')
	{!! trans('manage_pages.sections.edit_modal.label' , ["section" => "<em>@{{ item_on_edit.index }}</em>"]) !!}
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

        <div class="input-field col s6 offset-s6">
            <strong>@{{{item_on_edit.type_label}}}</strong>
        </div>

        <div class=" input-field col s12">
            {!! Form::label('description',trans('manage_pages.sections.edit_modal.form.description.label'), [
                'class' => 'input-label active',
            ]) !!}
            <v-editor :content.sync='item_on_edit.description'></v-editor>
            <input type="hidden" v-model="item_on_edit.description" name="description">
        </div>

        <div class=" input-field col s12">
            {!! Form::label('template_path',trans('manage_pages.sections.edit_modal.form.template_path.label'), [
                'class' => 'input-label active',
            ]) !!}
            {!! Form::text('template_path', null, [
                'v-model'       => 'item_on_edit.template_path',
                'class'         => 'validate',
                'required'      => 'required',
                'form'          => 'update_page_section-&#123;&#123;item_on_edit.id&#125;&#125;_form',
                'placeholder'   => trans('manage_pages.sections.edit_modal.form.template_pathtemplate_path.placeholder')
            ]) !!}
        </div>
        <div class="input-field col s12 " v-if="item_on_edit.type && !item_on_edit.type.protected && !item_on_edit.type.unlimited">
            {!! Form::label('components_max',trans('manage_pages.sections.edit_modal.form.components_max.label'), [
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

        <div class="col s12 " v-if="item_on_edit.type && !item_on_edit.type.protected ">
            <h6>{!! trans('manage_pages.sections.edit_modal.form.editable_contents.label') !!}</h6>

            <div class="row">
                @foreach ($editable_parts as $part_key => $part_label)
                    <div class="input-field col s6">
                        {{ Form::checkbox('editable_contents['.$part_key.']', true, null, [
                            'v-model'   => 'item_on_edit.editable_contents.'.$part_key,
                            'class'     => 'filled-in',
                            'id'        => 'editable_contents-'.$part_key.'-update_page_section-&#123;&#123;item_on_edit.id&#125;&#125;_form',
                            'form'	    => 'update_page_section-&#123;&#123;item_on_edit.id&#125;&#125;_form',
                            ]) }}
                        {!! Form::label('editable_contents-'.$part_key.'-update_page_section-&#123;&#123;item_on_edit.id&#125;&#125;_form', trans('manage_pages.sections.edit_modal.form.editable_contents.'.$part_key.'.label'), [
                            'class' => 'input-label'
                        ]) !!}
                    </div>
                @endforeach
            </div>
            <br><br>
        </div>

        <div class="col s12 ">
            <div class="pull-right">
                {!! Form::submit(trans('manage_pages.sections.edit_modal.form.save'), [
                    'class'  => 'btn waves-effect waves-light',
                    'form'   => 'update_page_section-&#123;&#123;item_on_edit.id&#125;&#125;_form',
                ]) !!}
            </div>
        </div>

    {!! Form::close() !!}


@overwrite
