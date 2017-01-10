@extends('layouts.admin')

@section('title')
    Lista de Actividades |
@endsection

@section('h1')
    Lista de Actividades
@endsection

@section('action')
    <a href="{{ route( 'admin::films.create' ) }}" class="btn-floating">
        <i class="material-icons waves-effect waves-light " >add</i>
    </a>
@endsection

@section('content')
    @include('admin.general._page-instructions', [
        'title'         =>  '',
        'instructions'  =>  'Da click para editar o eliminar una actividad'
    ])


    <div class="col s11">
        @include('admin.films.index._table')
    </div>

@endsection
