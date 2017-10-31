@extends('layouts.admin')


@section('title')
    {!! trans('manage_pages.edit.label') !!}
@endsection

@section('h1')
    {!! trans('manage_pages.edit.label') !!}
@endsection


@section('action')
    <a href="{{ route( 'admin::pages.index' ) }}" class="btn-floating">
        <i class="material-icons waves-effect waves-light " >view_list</i>
    </a>
@endsection

@section('content')
    @include('admin.general._page-instructions', [
        'title'         =>  '',
        'instructions'  =>  trans('manage_pages.edit.instructions', ["page" => $page_edit->index] )
    ])

    @include('admin.pages._basic-info-form',[
        "form_id"       => 'edit_page_form',
        "form_route"   => ['admin::pages.update',$page_edit->id],
        "form_method"   => 'PATCH'
    ])

    @include('admin.general._page-subtitle', [
        'title'         =>  trans('manage_pages.edit.sections'),
        // 'instructions'  =>  'Edita los campos para actualizar a '.$page_edit->index
    ])

    <pagesections-checkbox :list="store.pagesections.data" :current-page="store.current_page"></pagesections-checkbox>
    <pagesections-sort :list="store.current_page.sections_minified" :current-page="store.current_page"></pagesections-sort>

@endsection


@section('modals')
	<pagesections-modal-create :list.sync="store.pagesections.data" :store="store"></pagesections-modal-create>
@endsection

@section('vue_templates')
	@include('admin.pages.sections._modal-create')
    @include('admin.pages.sections._checkbox-template')
    @include('admin.pages.sections._sort-template')
@endsection

@section('vue_store')
	<script>
        mainVueStore.current_page = {!! $page_edit !!};
		mainVueStore.pagesections = {
			data: undefined, //IMPORTANTE: tenemos que registrar esta propiedad para que el get deposite lo recibido ahí, y SOBRETODO  para que el sistema de reactividad de Vue funcione adecuadamente
			routes: {
			   get: '{{route('admin::pages.sections.ajax.index')}}'
			}
		};
	</script>
@endsection
