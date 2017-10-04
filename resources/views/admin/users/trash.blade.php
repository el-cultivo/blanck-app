@extends('layouts.admin')


@section('title')
    Usuarios desactivados
@endsection


@section('h1')
    Usuarios desactivados
@endsection

@section('action')
    <a href="{{ route( 'admin::users.create' ) }}" class="btn-floating">
        <i class="material-icons waves-effect waves-light " >add</i>
    </a>
@endsection

@section('content')

	<users-trash :list="store.users_disabled.data"></users-trash>

@endsection

@section('vue_templates')
    <script type="x/templates" id="users-trash-template">
		<div class="">
			{{-- filtros por: industria, nombre, apellido, empresa --}}
			@include('admin.general._table-search')
		    <div class="col s10 offset-s1">
		        @include('admin.users.trash._table')
		    </div>
		</div>
    </script>
@endsection

@section('vue_store')
    <script>
        mainVueStore.users_disabled = {
            data: {!! json_encode($users_disabled) !!}
        }
    </script>
@endsection
