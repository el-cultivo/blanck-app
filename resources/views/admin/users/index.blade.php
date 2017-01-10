@extends('layouts.admin')


@section('title')
    Lista de Usuarios |
@endsection

@section('h1')
    Lista de Usuarios
@endsection

@section('action')
    <a href="{{ route( 'admin::users.create' ) }}" class="btn-floating">
        <i class="material-icons waves-effect waves-light " >add</i>
    </a>
@endsection

@section('content')
   {{-- @include('admin.general._page-instructions', [
        'title'         =>  '',
        'instructions'  =>  'Da click para editar o desactivar un usuario'
    ]) --}}


    <div class="col s10 offset-s1">
        @include('admin.users.index._table')
    </div>

@endsection
