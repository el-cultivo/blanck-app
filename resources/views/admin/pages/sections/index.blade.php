@extends('layouts.admin')

@section('title')
    {!! trans('manage_pages.sections.index.label') !!}
@endsection

@section('h1')
    {!! trans('manage_pages.sections.index.label') !!}
@endsection

@section('action')
    <span  data-target="pagesections-modal-create" class=" modal-trigger btn-floating">
		<i class="material-icons waves-effect waves-light " >add</i>
	</span>
@endsection

@section('content')
	<pagesections :list="store.pagesections.data" :store.sync="store"></pagesections>
@endsection

@section('modals')
	<pagesections-modal-create :list.sync="store.pagesections.data" :store="store"></pagesections-modal-create>
@endsection

@section('vue_templates')

	@include('admin.pages.sections._modal-create')
	@include('admin.pages.sections._modal-edit')
	<template id="pagesections-template">
		<div class="">
			<div style="">
			@include('admin.general._page-instructions', [
				'title'			=> '',
				'instructions' 	=> trans('manage_pages.sections.index.instructions')
			])
			</div>
			<div class="col s10 offset-s1">
				@include('admin.pages.sections.index._table')
			</div>
			<pagesections-modal-edit :list.sync="list" :edit-index="edit_index" :store="store"></pagesections-modal-edit>
		</div>
	</template>

@endsection

@section('vue_store')
	<script>
		mainVueStore.pagesections = {
			data: undefined, //IMPORTANTE: tenemos que registrar esta propiedad para que el get deposite lo recibido ahí, y SOBRETODO  para que el sistema de reactividad de Vue funcione adecuadamente
			routes: {
			   get: '{{route('admin::pages.sections.ajax.index')}}'
			}
		};
	</script>
@endsection
