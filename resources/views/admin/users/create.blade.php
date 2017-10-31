@extends('layouts.admin')


@section('title')
    {!! trans('manage_users.create.label') !!}
@endsection

@section('h1')
    {!! trans('manage_users.create.label') !!}
@endsection


@section('action')
    <a href="{{ route( 'admin::users.index' ) }}" class="btn-floating">
        <i class="material-icons waves-effect waves-light " >view_list</i>
    </a>
@endsection

@section('content')
    @include('admin.general._page-instructions', [
        'title'         =>  "",
        'instructions'  =>  trans('manage_users.create.instructions')
    ])
    @include('admin.users._form',[
        "form_id"       => 'create_user_form',
        "form_route"   => ['admin::users.store'],
        "form_method"   => 'POST'
    ])

@endsection
