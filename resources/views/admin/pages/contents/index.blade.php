@extends('layouts.admin')


@section('title')
    Páginas
@endsection

@section('h1')
    Páginas
@endsection

@section('content')

    @include('admin.general._page-instructions', [
        'title'         =>  '',
        'instructions'  =>  'Da click para ver o editar una página.'
    ])

    <div class="col s10 offset-s1">

        <div class="row">

            @include('admin.pages.contents.index._table')

        </div>

    </div>

@endsection
