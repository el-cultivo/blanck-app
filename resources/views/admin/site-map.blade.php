@extends('layouts.admin')

@section('title')
    Mapa de rutas
@endsection

@section('h1')
    Mapa de rutas
@endsection

@section('content')
    @include('admin.general._page-instructions', [
        'title'         =>  'Rutas',
        'instructions'  =>  'Lista de rutas del sitio'
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
                                <strong>Nombre:</strong> {{$route->getName() }}<br>
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
