@extends('layouts.admin')

@section('title')
    {!! trans('admin_access.site_map.label') !!}
@endsection

@section('h1')
    {!! trans('admin_access.site_map.label') !!}
@endsection

@section('content')
    @include('admin.general._page-instructions', [
        'title'         => trans('admin_access.site_map.label'),
        'instructions'  => trans('admin_access.site_map.instructions')
    ])

    <div class="col s10 col offset-s1 ">
        @foreach ($route_groups as $label => $route_group)
            <h5>{{$label}}</h5>

            <ul class="collapsible popout" data-collapsible="accordion">
                @foreach ($route_group as $route)
                    <li>

                        <div class="collapsible-header">
                            <i class="large material-icons">label</i>
                            <span class="">
                                {{$route->uri() }}
                            </span>
                            <small class="pull-right">
                                {{$route->getName() }}
                            </small>
                        </div>
                        <div class="collapsible-body">
                            <p>
                                <strong>{!! trans('admin_access.site_map.route_name.label') !!}</strong> {{$route->getName() }}<br>
                                <strong>Uri:</strong> {{$route->uri() }}<br><br>
                                <strong>Methods:</strong> {{ implode(' | ', $route->methods()) }} <br>
                                @if ($route->domain())
                                    <strong>Domain:</strong> {{  $route->domain()}}
                                @endif<br>
                                <strong>Controller:</strong> {{$route->getActionName() }}<br>
                                <strong>Middewares:</strong> {{  is_array($route->getAction()["middleware"]) ? implode(" | ", $route->getAction()["middleware"]) : $route->getAction()["middleware"] }}
                            </p>
                        </div>
                    </li>
                @endforeach
            </ul>
        @endforeach
    </div>
@endsection
