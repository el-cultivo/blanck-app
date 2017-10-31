@extends('layouts.admin')

@section('title')
    {!! trans('manage_pages.index.label') !!}
@endsection

@section('h1')
    {!! trans('manage_pages.index.label') !!}
@endsection

@section('action')
    <a href="{{ route( 'admin::pages.create' ) }}" class="btn-floating">
        <i class="material-icons waves-effect waves-light " >add</i>
    </a>
@endsection

@section('content')

    @include('admin.general._page-instructions', [
        'title'         =>  '',
        'instructions'  =>  trans('manage_pages.index.instructions')
    ])

    <div class="col s10 offset-s1">
        <div class="row">
            @include('admin.pages.index._table')
        </div>
    </div>

@endsection
