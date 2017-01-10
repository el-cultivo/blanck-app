@extends('layouts.admin')


@section('title')
    Usuarios desactivados
@endsection


@section('h1')
    Usuarios desactivados
@endsection

@section('action')
    <a href="{{ route( 'admin::users.create' ) }}" class="btn-floating">
        <i class="material-icons waves-effect waves-light " >add</i>
    </a>
@endsection

@section('content')

    @include('admin.general._page-instructions', [
        'title'         =>  '',
        'instructions'  =>  'Da click para reactivar un usuario'
    ])

    <div class="col s10 offset-s1 ">
        @include('admin.users.trash._table')
    </div>

@endsection
