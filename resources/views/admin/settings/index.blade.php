@extends('layouts.admin')


@section('title')
    Ajustes
@endsection

@section('h1')
    Ajustes
@endsection


@section('content')

    {{-- Redes sociales --}}
    @include('admin.settings.setting._social')

    <div class="col s10 offset-s1">
        <br> <div class="divider"></div>
    </div>

    {{-- Mail --}}
    @include('admin.settings.setting._mail')

@endsection
