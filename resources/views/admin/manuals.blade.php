@extends('layouts.admin')

@section('title')
    {!! trans('admin_access.manuals.label') !!}
@endsection

@section('h1')
    {!! trans('admin_access.manuals.label') !!}
@endsection

@section('content')
    @include('admin.general._page-instructions', [
        'title'         =>  trans('admin_access.manuals.label'),
        'instructions'  =>  config('cltvo.manual_url') ? '' : trans('admin_access.manuals.coming_soon'),
    ])

	@if (config('cltvo.manual_url'))
		<div class="col s10 offset-s1">
	        <div class="row manuals">

	            <div class="manuals__container">
	                <iframe class="manuals__container--video" src="{{ config('cltvo.manual_url') }}" frameborder="0" allowfullscreen></iframe>
	            </div>

	        </div>
	    </div>
	@endif

@endsection
