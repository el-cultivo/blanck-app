@extends('layouts.admin')

@section('title')
    Administrador de páginas
@endsection

@section('h1')
    Administrador de páginas
@endsection

@section('action')
    <a href="{{ route( 'admin::pages.create' ) }}" class="btn-floating">
        <i class="material-icons waves-effect waves-light " >add</i>
    </a>
@endsection

@section('content')

    @include('admin.general._page-instructions', [
        'title'         =>  '',
        'instructions'  =>  'Da click para editar la estructura de una página.'
    ])

    <div class="col s10 offset-s1">
        <div class="row">
            @include('admin.pages.index._table')
        </div>
    </div>

@endsection
