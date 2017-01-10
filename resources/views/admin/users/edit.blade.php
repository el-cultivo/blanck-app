@extends('layouts.admin')

@section('title')
    Editar Usuario
@endsection

@section('h1')
    Editar Usuario
@endsection

@section('action')
    <a href="{{ route( 'admin::users.index' ) }}" class="btn-floating">
        <i class="material-icons waves-effect waves-light " >view_list</i>
    </a>
@endsection

@section('content')

    @include('admin.general._page-instructions', [
        'title'         =>  '',
        'instructions'  =>  'Edita los campos para actualizar a '.$user_edit->name
    ])

    @include('admin.users._form',[
        "form_id"       => 'edit_user_form',
        "form_route"   => ['admin::users.update',$user_edit->id],
        "form_method"   => 'PATCH'
    ])


@endsection
