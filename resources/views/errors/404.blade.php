@extends('layouts.splash')

@section('title')
	404
@endsection

@section('content')
	<div class="container">
		<div class="content">
			<div class="title">{!! trans('page_errors.404') !!}</div>
		</div>
	</div>
@endsection
