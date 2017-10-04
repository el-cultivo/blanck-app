@extends('layouts.admin')

@section('title')
    Manuales
@endsection

@section('h1')
    Manuales
@endsection

@section('content')
    @include('admin.general._page-instructions', [
        'title'         =>  'Manuales',
        'instructions'  =>  config('cltvo.manual_url') ? '' : 'Proximamente',
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
