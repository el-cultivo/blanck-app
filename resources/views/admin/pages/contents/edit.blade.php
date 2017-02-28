@extends('layouts.admin')


@section('title')
    Editar página
@endsection

@section('h1')
    Editar página
@endsection


@section('action')
    <a href="{{ route( 'admin::pages.index' ) }}" class="btn-floating">
        <i class="material-icons waves-effect waves-light " >view_list</i>
    </a>
@endsection

@section('content')
    @include('admin.general._page-instructions', [
        'title'         =>  '',
        'instructions'  =>  'Edita los campos para actualizar a '.$page_edit->index
    ])

    @include('admin.pages._basic-info-form',[
        "form_id"       => 'edit_page_contents_form',
        "form_route"   => ['admin::pages.content.update',$page_edit->id],
        "form_method"   => 'PATCH'
    ])

@endsection
