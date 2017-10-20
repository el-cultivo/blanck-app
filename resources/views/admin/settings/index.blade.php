@extends('layouts.admin')


@section('title')
    {!! trans('manage_settings.index.label') !!} |
@endsection

@section('h1')
    {!! trans('manage_settings.index.label') !!}
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
