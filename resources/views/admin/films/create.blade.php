@extends ('layouts.admin')

@section('title')
	Agregar Actividad | 
@endsection

@section('h1')
	Agregar Actividad
@endsection

@section('action')
	<a href="{{ route( 'admin::films.index' ) }}" class="btn-floating">
		<i class="material-icons waves-effect waves-light " >view_list</i>
	</a>
@endsection

@section('content')
	@include('admin.general._page-instructions', [
		'title'		 =>  '',
		'instructions'  =>  'Llena los campos para crear una nueva Actividad'
	])

	<div class="col s10  offset-s1">
		{!! Form::open([
			'method'			 => "POST",
			'route'			  => ['admin::films.store'],
			'role'			   => 'form' ,
			'id'				 => 'create_film_form',
			'class'			  => 'row',
			]) !!}

			<div class="input-field col s4 offset-s4">
				{!! Form::select('publish_id', $publishes, null, [
					'class'		 => 'validate create-film__select-status',
					'required'	  => 'required',
					'placeholder'   => "Seleccionar",
					'form'		  => 'create_film_form',
				])  !!}
				{!! Form::label('publish_id', "Estatus de publicación:", [
					'class' => 'input-label active'
				]) !!}
			</div>
			<div class="input-field col s4">
				{!! Form::date('publish_at', null, [
					'class'		 => 'validate  datepicker',
					'required'	  => 'required',
					'placeholder'   => date("Y-m-d"),
					'form'		  => 'create_film_form',
					"id"			=> "category"
				])  !!}
				{!! Form::label('publish_at', "Fecha de publicación:", [
					'class' => 'input-label active'
				]) !!}
			</div>

			@foreach ($languages as $language)
				<div class="input-field col s12">
					{!! Form::label("label[".$language->iso6391."]", "Nombre:", [
						'class' => 'input-label active'
						]) !!}
					{!! Form::text("label[".$language->iso6391."]", null, [
						'class'		 => 'validate',
						'required'	  => 'required',
						'form'		  => 'create_film_form',
						'placeholder'   =>  "Actividad"
					]) !!}
				</div>
			@endforeach

			<div class="input-field col s4">
				{!! Form::label("date", "Fecha:", [
					'class' => 'input-label active'
					]) !!}
				{!! Form::date("date", null, [
					'class'		 => 'validate datepicker',
					'required'	  => 'required',
					'form'		  => 'create_film_form',
					'placeholder'   =>  date("Y-m-d")
				]) !!}
			</div>

			<div class="input-field col s4">
				{!! Form::label("time", "Hora:", [
					'class' => 'input-label active'
					]) !!}
				{!! Form::time("time", null, [
					'class'		 => 'validate timepicker',
					'required'	  => 'required',
					'form'		  => 'create_film_form',
					'placeholder'   =>  date("H:i")
				]) !!}
			</div>

			<div class="input-field col s4">
				{!! Form::label("timezone", "Zona horaria:", [
					'class' => 'input-label active'
					]) !!}
				{!! Form::select("timezone",$time_zones_list, "America/Mexico_City", [
					'class'		 => 'validate',
					'required'	  => 'required',
					'form'		  => 'create_film_form',
					'placeholder'   =>  'Seleccionar'
				]) !!}
			</div>

			@foreach ($languages as $language)
				<div class="input-field col s12">
					{!! Form::label("description[".$language->iso6391."]", 'Descripción:', ['class' => 'input-label active']) !!}
					{!! Form::textarea("description[".$language->iso6391."]", null, [
						'class'	   => 'validate materialize-textarea',
						//'placeholder' => "aliados mediáticos",
						// 'required'	=> 'required',
						'form'		=> 'create_film_form'
					]) !!}
				</div>
			@endforeach



			<div class="input-field col s3">
				{!! Form::label('quota', "Capacidad:", [
					'class' => 'input-label active'
					]) !!}
				{!! Form::number('quota', null, [
					'class'		 => 'validate',
					'required'	  => 'required',
					'min'			=> 0,
					'form'		  => 'create_film_form',
					'placeholder'   =>  "1000"
				]) !!}
			</div>



			<div class="input-field col s3">
				{!! Form::label('price', "Precio:", [
					'class' => 'input-label active'
					]) !!}
				{!! Form::number('price', null, [
					'class'		 => 'validate',
					'required'	  => 'required',
					'min'			=> 0,
					'step'			=> 0.01,
					'form'		  => 'create_film_form',
					'placeholder'   => "2500.50"
				]) !!}
			</div>


			<div class="input-field col s6">
				{!! Form::label('link', "Link de registro:", [
					'class' => 'input-label active'

					]) !!}
				{!! Form::url('link', null, [
					'class'		 => 'validate',
					// 'required'	  => 'required',
					'form'		  => 'create_film_form',
					'placeholder'   =>  "http://www.ticketmaster.com/"
				]) !!}
			</div>

			<div class="col s6">
				<locations-select :list="store.locations.data"></locations-select>
			</div>
			<div class="col s6">
				<registrationtypes-select :list="store.registrationtypes.data" ></registrationtypes-select>
			</div>
			<div class="col s6">
				<topics-select :list="store.topics.data" ></topics-select>
			</div>
			<div class="col s6">
				<speakers-select :list="store.speakers.data" ></speakers-select>
			</div>
			<div class="col s6">
				<categories-select :list="store.categories.data" ></categories-select>
			</div>

			<div class="col s12 ">
				<div class="pull-right">
					{!! Form::submit("Guardar", [
						'class' => 'btn waves-effect waves-light',
						'form'  => 'create_film_form'
					]) !!}
				</div>
			</div>
		{!! Form::close() !!}
	</div>

@endsection

@section('modals')
    <locationtypes-modal-create :list.sync="store.locationtypes.data" ></locationtypes-modal-create>
	<locations-modal-create :list.sync="store.locations.data" :store="store" ></locations-modal-create>
	<topics-modal-create :list.sync="store.topics.data" ></topics-modal-create>
	<categories-modal-create :list.sync="store.categories.data" ></categories-modal-create>
	<speakers-modal-create :list.sync="store.speakers.data" ></speakers-modal-create>
	<registrationtypes-modal-create :list.sync="store.registrationtypes.data" ></registrationtypes-modal-create>
@endsection

@section('vue_templates')

    @include('admin.locations._modal-create')
	@include('admin.locations._select-template',[
		'model'			=> '',
		'form_id'		=> 'create_film_form',
		'required'		=> 'false'
	])
    @include('admin.locations.locationtypes._modal-create')
	@include('admin.locations.locationtypes._select-template', [
		'model'			=> 'currentLocation',
		'form_id'		=> 'create_location_form',
		'required'		=> 'true'
	])

	@include('admin.films.topics._modal-create')
	@include('admin.films.topics._select-template', [
		'model'			=> '',
		'form_id'		=> 'create_film_form',
		'required'		=> 'false'
	])
    @include('admin.films.categories._modal-create')
    @include('admin.films.categories._select-template', [
 		'model'			=> '',
		'form_id'		=> 'create_film_form',
		'required'		=> 'false'
   ])

	@include('admin.speakers._modal-create')
	@include('admin.speakers._select-template', [
		'model'			=> '',
		'form_id'		=> 'create_film_form',
		'required'		=> 'false'
	])

	@include('admin.registrations.registrationtypes._modal-create')
	@include('admin.registrations.registrationtypes._select-template', [
		'model'			=> '',
		'form_id'		=> 'create_film_form',
		'required'		=> 'false'
	])

@endsection

@section('vue_store')
	<script>
		mainVueStore.categories = {
			data: undefined,
			routes: {
				get: '{{route('admin::categories.ajax.index')}}'
			}
		};
		mainVueStore.topics = {
			data: undefined,
			routes: {
				get: '{{route('admin::topics.ajax.index')}}'
			}
		};
		mainVueStore.registrationtypes = {
			data: undefined,
			routes: {
				get: '{{route('admin::registrationtypes.ajax.index')}}'
			}
		};
		mainVueStore.speakers = {
			data: undefined,
			routes: {
				get: '{{route('admin::speakers.ajax.index')}}'
			}
		};
		mainVueStore.locations = {data: undefined, routes: {get: '{{route('admin::locations.ajax.index')}}'}};
		mainVueStore.locationtypes = {data: undefined, routes: {get: '{{route('admin::locationtypes.ajax.index')}}'}};
		mainVueStore.mexico_states_and_mun = {!! $mexico_states_and_mun !!}

		mainVueStore.map_is_ready = false;
		mainVueStore.map_is_unlocked = false;
	</script>
	<script>
		var setMapToReady = function() {
			mainVueStore.map_is_ready = true; console.log(mainVueStore.map_is_ready);
		}
	</script>
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCvPZ1TstGIVmF1U0xZb7I2UwySk4dYnkM&callback=setMapToReady" async defer></script>
@endsection
