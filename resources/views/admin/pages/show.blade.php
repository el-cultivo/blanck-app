@extends('layouts.admin')


@section('title')
    Páginas
@endsection

@section('h1')
    {{ $page->translation()->name }}
@endsection

@section('action')
    <a class="waves-effect waves-light btn" onclick="myFunction()">Guardar</a>
    <script>
        function myFunction() {
            console.log('Hello world');
            document.getElementById("myForm").submit();
        }
    </script>
@endsection


@section('content')

    {!! Form::open([
          'method'              => 'PATCH',
          'route'              => ['admin::pages.update', $page->id],
          'role'                => 'form' ,
          'id'                  => 'myForm',
    ]) !!}

        <div class="col" style="padding: 0;margin-bottom: 1em;position: fixed;overflow-y: scroll;top: 67px; height: calc( 100vh - 67px - 67px);left: 300px;width: calc( 100% - 300px - 400px);">

            {{-- <div class="row">

                <div class="col s12">

                    {{ dump($page) }}

                </div>

            </div> --}}

            {{-- <textarea id="textarea1" placeholder="Quiza puedas empezar con..." class="summernote_JS flow-text " style="width: 100%; min-height: calc( 100vh - 67px - 67px - 44px ); border: 0;padding: 1em 2em 2em 2em;outline: none;box-shadow: none;">{!! $page->translation()->content or '' !!}</textarea>

            <label for="textarea1" style="margin: 22px 22px 0 50px; display: block;">Content (ingles)</label>
            <textarea id="textarea1" placeholder="May be you can start with..." class="summernote_JS flow-text " style="width: 100%; min-height: calc( 100vh - 67px - 67px - 44px ); border: 0;padding: 1em 2em 2em 2em;outline: none;box-shadow: none;">{!! $page->translation()->content or '' !!}</textarea> --}}

            <label for="textarea1" style="margin: 20px; display: block;color: black;font-size: 14px;">Contenido (español)</label>
            <div id="" class="quilljs_JS">
                Hola!
            </div>

        </div>

        <div class="col" style="padding: 1em 1em 3em 1em;position: fixed;right: 0;overflow-y: scroll;top: 67px; height: calc( 100vh - 67px - 67px); border-left: 1px solid #eee;width: 400px;">

            <h6>Ajustes</h6>

                <br>

                <div class="input-field col s12">
                    <input placeholder="Sin titulo" id="first_name" type="text" class="validate" value="{{ $page->translation()->name }}">
                    <label for="first_name">Título</label>
                </div>

                <div class="input-field col s12">
                    <label for="input_text">Imagen destacada</label> <br><br>
                    <img class="responsive-img" src="http://placehold.it/350x200">
                </div>

                <br><br>

                <div class="input-field col s12">
                    <input type="checkbox" class="filled-in" id="filled-in-box" checked="checked" />
                    <label for="filled-in-box">Mostrar link en menú de navegación</label>
                </div>

                <br><br>

                <div class="input-field col s12">
                    <input type="checkbox" class="filled-in" id="filled-in-box-1" checked="checked" />
                    <label for="filled-in-box-1">Mostrar link en footer</label>
                </div>

                <br><br>

                <div class="input-field col s12">
                    <input type="checkbox" class="filled-in" id="filled-in-box-1" checked="checked" />
                    <label for="filled-in-box-1">Abrir en nueva pestaña</label>
                </div>

                <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>

                <div class="input-field col s12">
                    <i class="material-icons prefix">http</i>
                    <input id="input_text" type="text" length="25" value="{{$page->translation()->slug}}">
                    <label for="input_text">Post URL</label>
                    <small style="margin-left: 45px;">{{ env('URL_SITE') }}/{{$page->translation()->slug}}</small>
                </div>

                <br><br><br><br><br><br>

                <div class="input-field col s12">
                    <select>
                        <option value="1" selected>Draft</option>
                        <option value="2">Publicado</option>
                    </select>
                    <label>Estado</label>
                </div>

                <br><br><br><br><br><br>

                <div class="input-field col s12">
                    <i class="material-icons prefix">today</i>
                    <input id="icon_prefix" type="text" class="validate" value="{{ date('d-M-y') }} @ {{date('H:m')}}">
                    <label for="icon_prefix">Fecha de publicación</label>
                </div>

                <br><br><br><br><br><br>

                <div class="input-field col s12">
                    <input placeholder="0" id="first_name" type="text" class="validate" value="">
                    <label for="first_name">Orden</label>
                </div>


        </div>

    {{ Form::close() }}

@endsection
