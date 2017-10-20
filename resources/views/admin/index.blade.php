@extends('layouts.admin')

{{-- @section('title')
    Administrador
@endsection --}}

@section('h1')
	{!! trans('admin_access.index.greeting', ["name" => $user->first_name ]) !!}
@endsection

@section('content')
    @include('admin.general._page-instructions', [
        'title'         =>  trans('admin_access.index.label'),
        'instructions'  =>  trans('admin_access.index.instructions')
    ])

    <div class="col s10 offset-s1">
    	<div class="row welcome">

	    	@foreach ( $items as $item )
                @if ($user->hasPermission($item['permission']))
                    <a class="col s4 center-align welcome__item" href="{{ route('admin::'.$item['route_name']) }}">
                        <i class="medium material-icons welcome__item--icon">{{ $item['icon'] }}</i>
                        <span class="welcome__item--label">{!! trans($item['label'] .'.admin_menu.label') !!}</span>
                    </a>
                @endif
	    	@endforeach
    	</div>
    </div>

@endsection
