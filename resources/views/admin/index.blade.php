@extends('layouts.admin')

{{-- @section('title')
    Administrador
@endsection --}}

@section('h1')
    Hola {{ $user->first_name }}
@endsection

@section('content')
    @include('admin.general._page-instructions', [
        'title'         =>  'Administrador',
        'instructions'  =>  'Da click en alguno de los items del menu lateral'
    ])

    {{-- <div class="col s10 offset-s1">

    </div> --}}

@endsection
