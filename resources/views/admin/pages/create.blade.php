@extends('layouts.admin')


@section('title')
    Agregar página
@endsection

@section('h1')
    Agregar página
@endsection


@section('action')
    <a href="{{ route( 'admin::pages.index' ) }}" class="btn-floating">
        <i class="material-icons waves-effect waves-light " >view_list</i>
    </a>
@endsection

@section('content')
    @include('admin.general._page-instructions', [
        'title'         =>  '',
        'instructions'  =>  'Llena los campos para crear un nuevo usuario'
    ])
    @include('admin.pages._basic-info-form',[
        "form_id"       => 'create_page_form',
        "form_route"   => ['admin::pages.store'],
        "form_method"   => 'POST'
    ])

@endsection
