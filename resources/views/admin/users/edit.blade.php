@extends('layouts.admin')

@section('title')
    Editar Usuario
@endsection

@section('h1')
    Editar Usuario
@endsection

@section('action')
    <a href="{{ route( 'admin::users.index' ) }}" class="btn-floating">
        <i class="material-icons waves-effect waves-light " >view_list</i>
    </a>
@endsection

@section('content')

    @include('admin.general._page-instructions', [
        'title'         =>  '',
        'instructions'  =>  'Edita los campos para actualizar a '.$user_edit->name
    ])

    @include('admin.users._form',[
        "form_id"       => 'edit_user_form',
        "form_route"   => ['admin::users.update',$user_edit->id],
        "form_method"   => 'PATCH'
    ])

	@unless ($user_edit->id == $user->id)
		<div class="col s12 ">
			<div class="divider"></div>
		</div>

		<div class=" col s10 offset-s1">
			<roles-multi-select :list.sync="store.roles.data" :items-ids="store.current_user.roles_ids"></roles-multi-select>
		</div>
	@endunless

@endsection

@section('vue_templates')
	@unless ($user_edit->id == $user->id)
	    @include('admin.users.roles._multi-select-template', [
		  'form_id' 		=> "update_roles-user_form",
		  'form_method'		=> "patch",
		  'form_route'		=> ["admin::users.ajax.roles",$user_edit->id],
		])
	@endunless
@endsection

@section('vue_store')
	@unless ($user_edit->id == $user->id)
		<script>
			mainVueStore.current_user = {!! $user_edit !!};

			mainVueStore.roles = {
				data: {!! json_encode($roles) !!}
			};

		</script>
	@endunless
@endsection
