@extends('layouts.splash')

@section('title')
	404
@endsection

@section('content')
	<div class="container">
		<div class="content">
			<div class="title">{!! trans('page_errors.404.error') !!}</div>
			<h4 class="sub-ttl">{!! trans('page_errors.404.message') !!}</h4>
		</div>
	</div>
@endsection
