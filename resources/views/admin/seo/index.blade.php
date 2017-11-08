@extends('layouts.admin')

@section('title')
    SEO
@endsection

@section('h1')
    SEO
@endsection

@section('action')
    <a href="{{ route( 'admin::seo.create' ) }}" class="btn-floating btn-icon">
        <i class="material-icons waves-effect waves-light " >add</i>
    </a>
@endsection

@section('content')

	@include('admin.general._page-instructions', [
	    'title'         =>  '',
	    'instructions'  =>  trans('manage_seo.index.instructions')
	])

	<div class="col s10 offset-s1">
	    <div class="row">
	        @include('admin.seo.index._table')
	    </div>
	</div>

@endsection