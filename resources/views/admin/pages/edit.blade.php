@extends('layouts.admin')


@section('title')
    Madificar página
@endsection

@section('h1')
    Madificar página
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
        "form_id"       => 'edit_page_form',
        "form_route"   => ['admin::pages.update',$page_edit->id],
        "form_method"   => 'PATCH'
    ])

@endsection
