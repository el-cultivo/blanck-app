@extends('layouts.admin',['media_manager' => true])

@section('title')
	Editar Actividad |
@endsection

@section('h1')
	Editar Actividad
@endsection

@section('action')
	<a href="{{ route( 'admin::films.index' ) }}" class="btn-floating">
		<i class="material-icons waves-effect waves-light " >view_list</i>
	</a>
@endsection

@section('content')

    @include('admin.general._page-instructions', [
        'title'         =>  '',
        'instructions'  =>  'Edita los campos para actualizar '.$film->label
    ])

    <div class="col s10  offset-s1">
        {!! Form::open([
            'method'             => "POST",
            'route'              => ['admin::films.store'],
            'role'               => 'form' ,
            'id'                 => 'update_film_form',
            'class'              => 'row',
            ]) !!}

            <div class="col s2">
                <single-image
                    v-ref:"film"
                    :current-image="store.current_film.thumbnail_image"
                    type="films"
                    photoable-id="{{$film->id}}"
                    photoable-type="film"
                    use="thumbnail"
                    class=""
                    default-order="null"
                ></single-image>
            </div>

            <div class="col s10">
                <div class="row">
                    <div class="input-field col s4 offset-s4">
                        {!! Form::select('publish_id', $publishes, $film->publish_id, [
                            'class'         => 'validate',
                            'required'      => 'required',
                            'placeholder'   => "Seleccionar",
                            'form'          => 'update_film_form',
                        ])  !!}
                        {!! Form::label('publish_id', "Estatus de publicación:", [
                            'class' => 'input-label'
                        ]) !!}
                    </div>
                    <div class="input-field col s4">
                        {!! Form::date('publish_at', $film->publish_at->format("Y-m-d"), [
                            'class'         => 'validate  datepicker',
                            'required'      => 'required',
                            'placeholder'   => date("Y-m-d"),
                            'form'          => 'update_film_form',
                            "id"            => "category"
                        ])  !!}
                        {!! Form::label('publish_at', "Fecha de publicación:", [
                            'class' => 'input-label'
                        ]) !!}
                    </div>

                    @foreach ($languages as $language)
                        <div class="input-field col s12">
                            {!! Form::label("label[".$language->iso6391."]", "Nombre:", [
                                'class' => 'input-label'
                                ]) !!}
                            {!! Form::text("label[".$language->iso6391."]", $film->{$language->iso6391."_label"}, [
                                'class'         => 'validate',
                                'required'      => 'required',
                                'form'          => 'update_film_form',
                                'placeholder'   =>  "Actividad"
                            ]) !!}
                        </div>
                    @endforeach

                    <div class="input-field col s4">
                        {!! Form::label("date", "Fecha:", [
                            'class' => 'input-label'
                            ]) !!}
                        {!! Form::date("date", $film->date->format("Y-m-d"), [
                            'class'         => 'validate datepicker',
                            'required'      => 'required',
                            'form'          => 'update_film_form',
                            'placeholder'   =>  date("Y-m-d")
                        ]) !!}
                    </div>

                    <div class="input-field col s4">
                        {!! Form::label("time", "Fecha:", [
                            'class' => 'input-label'
                            ]) !!}
                        {!! Form::time("time", $film->date->format("H:i"), [
                            'class'         => 'validate timepicker',
                            'required'      => 'required',
                            'form'          => 'update_film_form',
                            'placeholder'   =>  date("H:i")
                        ]) !!}
                    </div>

                    <div class="input-field col s4">
                        {!! Form::label("timezone", "Zona horaria:", [
                            'class' => 'input-label'
                            ]) !!}
                        {!! Form::select("timezone",$time_zones_list, $film->timezone, [
                            'class'         => 'validate',
                            'required'      => 'required',
                            'form'          => 'update_film_form',
                            'placeholder'   =>  'Seleccionar'
                        ]) !!}
                    </div>
                </div>
            </div>


            @foreach ($languages as $language)
                <div class="input-field col s12">
                    {!! Form::label("description[".$language->iso6391."]", 'Descripción:', ['class' => 'input-label']) !!}
                    {!! Form::textarea("description[".$language->iso6391."]", $film->{$language->iso6391."_description"}, [
                        'class'       => 'validate materialize-textarea',
                        //'placeholder' => "aliados mediáticos",
                        // 'required'    => 'required',
                        'form'        => 'update_film_form'
                    ]) !!}
                </div>
            @endforeach



            <div class="input-field col s3">
                {!! Form::label('quota', "Capacidad:", [
                    'class' => 'input-label'
                    ]) !!}
                {!! Form::number('quota', $film->quota, [
                    'class'         => 'validate',
                    'required'      => 'required',
                    'min'			=> 0,
                    'form'          => 'update_film_form',
                    'placeholder'   =>  "1000"
                ]) !!}
            </div>



            <div class="input-field col s3">
                {!! Form::label('price', "Precio:", [
                    'class' => 'input-label'
                    ]) !!}
                {!! Form::number('price', $film->price, [
                    'class'         => 'validate',
                    'required'      => 'required',
                    'min'			=> 0,
                    'step'			=> 0.01,
                    'form'          => 'update_film_form',
                    'placeholder'   => "2500.50"
                ]) !!}
            </div>


            <div class="input-field col s6">
                {!! Form::label('link', "Link de registro:", [
                    'class' => 'input-label'

                    ]) !!}
                {!! Form::url('link', $film->link, [
                    'class'         => 'validate',
                    // 'required'      => 'required',
                    'form'          => 'update_film_form',
                    'placeholder'   =>  "http://www.ticketmaster.com/"
                ]) !!}
            </div>

            <div class="col s6">
                <locations-select :list="store.locations.data" :current-film="store.current_film" ></locations-select>
            </div>
            <div class="col s6">
                <registrationtypes-select :list="store.registrationtypes.data" :current-film="store.current_film" ></registrationtypes-select>
            </div>
            <div class="col s6">
                <topics-select :list="store.topics.data" :current-film="store.current_film"  ></topics-select>
            </div>
            <div class="col s6">
                <speakers-select :list="store.speakers.data" :current-film="store.current_film"></speakers-select>
            </div>
            <div class="col s6">
                <categories-select :list="store.categories.data" :current-film="store.current_film"></categories-select>
            </div>

            <div class="col s12 ">
                <div class="pull-right">
                    {!! Form::submit("Guardar", [
                        'class' => 'btn waves-effect waves-light',
                        'form'  => 'update_film_form'
                    ]) !!}
                </div>
            </div>
        {!! Form::close() !!}
    </div>

@endsection

@section('modals')
    <locationtypes-modal-create :list.sync="store.locationtypes.data" ></locationtypes-modal-create>
	<locations-modal-create :list.sync="store.locations.data" :store="store" ></locations-modal-create>
    <registrationtypes-modal-create :list.sync="store.registrationtypes.data" ></registrationtypes-modal-create>
    <topics-modal-create :list.sync="store.topics.data" ></topics-modal-create>
    <speakers-modal-create :list.sync="store.speakers.data" ></speakers-modal-create>
    <categories-modal-create :list.sync="store.categories.data" ></categories-modal-create>
@endsection

@section('vue_templates')

    @include('admin.films.categories._modal-create')
    @include('admin.films.categories._select-template', [
        'model'         => 'currentFilm',
        'form_id'       => 'update_film_form',
        'required'      => 'false'
    ])
    @include('admin.films.topics._modal-create')
    @include('admin.films.topics._select-template', [
        'model'         => 'currentFilm',
        'form_id'       => 'update_film_form',
        'required'      => 'false'
    ])
    
    @include('admin.speakers._modal-create')
    @include('admin.speakers._select-template', [
        'model'         => 'currentFilm',
        'form_id'       => 'update_film_form',
        'required'      => 'false'
    ])
    
    @include('admin.registrations.registrationtypes._modal-create')
    @include('admin.registrations.registrationtypes._select-template', [
        'model'         => 'currentFilm',
        'form_id'       => 'update_film_form',
        'required'      => 'false'
    ])
    
    @include('admin.locations._modal-create')
    @include('admin.locations._select-template',[
        'model'         => 'currentFilm',
        'form_id'       => 'update_film_form',
        'required'      => 'false'
    ])
    @include('admin.locations.locationtypes._modal-create')
    @include('admin.locations.locationtypes._select-template', [
        'model'         => 'currentLocation',
        'form_id'       => 'create_location_form',
        'required'      => 'true'
    ])

    @include('admin.media_manager.vue.mediaManager-template')
    @include('admin.media_manager.vue.single-image-template')

@endsection


@section('vue_store')
	<script>

		mainVueStore.current_film = {!! $film !!};
		mainVueStore.categories = {
			data: undefined, //IMPORTANTE: tenemos que registrar esta propiedad para que el get deposite lo recibido ahí, y SOBRETODO  para que el sistema de reactividad de Vue funcione adecuadamente
			routes: {
				get: '{{route('admin::categories.ajax.index')}}'
			}
		};
		mainVueStore.topics = {
			data: undefined, //IMPORTANTE: tenemos que registrar esta propiedad para que el get deposite lo recibido ahí, y SOBRETODO  para que el sistema de reactividad de Vue funcione adecuadamente
			routes: {
				get: '{{route('admin::topics.ajax.index')}}'
			}
		};
		mainVueStore.registrationtypes = {
			data: undefined, //IMPORTANTE: tenemos que registrar esta propiedad para que el get deposite lo recibido ahí, y SOBRETODO  para que el sistema de reactividad de Vue funcione adecuadamente
			routes: {
				get: '{{route('admin::registrationtypes.ajax.index')}}'
			}
		};
		mainVueStore.speakers = {
			data: undefined, //IMPORTANTE: tenemos que registrar esta propiedad para que el get deposite lo recibido ahí, y SOBRETODO  para que el sistema de reactividad de Vue funcione adecuadamente
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
