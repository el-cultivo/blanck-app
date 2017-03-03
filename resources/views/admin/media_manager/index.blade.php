@extends('layouts.admin')


@section('title')
    Media Manager |
@endsection

@section('h1')
    Media Manager
@endsection



@section('content')

    <div class="row">

        <div class="col s10 offset-s1">

            <media-manager></media-manager>

        </div>
    </div>

@endsection

@section('modals')
    @include('admin.general._modal')
@endsection

@section('vue_templates')

    @include('admin.media_manager.vue.single-image-template')

    <template id="media-manager-template">

        <div id="media-manager__droppable-area" class="media-manager__droppable-area">
            <div class="media-manager__icon-photo-container">
                <span class="fa fa-file-image-o media-manager__icon-photo"></span>
                <span class="media-manager__icon-photo media-manager__icon-photo--text">Suelta la imagen para agregarla</span>
            </div>
        </div>

        <div class="row">

            <div class="col s12">

                {!! Form::open([
                    'method' => 'POST',
                    'class' => 'input__file media-manager__file-container',
                    'route'                => ['admin::photos.ajax.store'],
                    'role'                  => 'form',
                    'id'                    => 'create_photo_form',
                    'v-on:submit.prevent'   => 'post'
                ]) !!}

                    <div id="media-trigger_JS">

                        <label id="file_input-label" for="file_input">
                            <span class="fa fa-camera media-manager__icon-camera " v-if="DnDEvents.bin === ''"></span>
                            <span class="media-manager__icon-camera media-manager__icon-camera--add"  v-if="DnDEvents.bin === ''">Agregar</span>
                            <span class="media-manager__icon-camera media-manager__icon-camera--change media-manager__icon-camera--change"  v-if="DnDEvents.bin !== ''">Cambiar</span>
                            <img id="media-manager__dropped-img-container" class="media-manager__dropped-img-container" v-if="DnDEvents.bin !== ''">
                        </label>

                    </div>

                    <div id="media-input_JS">
                        {!! Form::file('file_input', [
                            'id'        =>   'media-manager__droppable-input',
                            'class'     => 'hide-input hide-button media-manager__droppable-input',
                            'required'  => 'required',
                            'v-model'   => 'file_input',
                            'v-on:change' => 'makePost',
                            'form'      => 'create_photo_form',
                        ]) !!}
                    </div>

                {!! Form::close() !!}

            </div>

        </div>

        <div class="row" style="padding: 30px;">

            <div class="col s8">
                <input type="search" placeholder="Buscar" name="" class="input input__search" v-model="search">
            </div>

            <div class="col s4">
                <label for="sort">Ordernar por:</label>
                <select class="form-control" placeholder="Ordenar por" name="sort" id="" v-model="sort_by">
                    <option :value="order.value" v-for="order in sort_types">@{{order.name.es}}</option>
                </select>
            </div>

        </div>

        <div class="row" v-if="filterableAndSortablePhotos.length > 0">

            <div id="media-container_JS" class="col" v-bind:class="{ 's12': chosen_img.src === '', 's8' : chosen_img.src !== ''}" style="padding: 1em;">

                <div class="row">

                    <div class="col s12 m6 l3 undraggable" v-for="photo in filterableAndSortablePhotos" v-on:click="onChosenImage($event)">

                        <div
                        	data-image-url="@{{photo.url}}"
                        	data-id="@{{photo.id}}"
                        	data-index="@{{$index}}"
                            class="undraggable"
                            style="width: 100%;padding-bottom: 100%;background-color: yellow;background-repeat:none;background-position: center;background-repeat: no-repeat;background-size: cover;margin-bottom: 1em;cursor:pointer;"
                        	v-bind:style="{backgroundImage: 'url(' + photo.url +')'}">
                        </div>

                    </div>

                </div>

            </div>

            <div class="col s4" style="padding: 1em;">

                @include('admin.media_manager.partials._updateForm')

            </div>

        </div>

        <div class="row" v-else>

            @include('admin.media_manager.partials._preloader')

        </div>


    </template>

@endsection
