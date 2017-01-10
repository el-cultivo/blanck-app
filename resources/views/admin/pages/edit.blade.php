@extends('layouts.admin',['media_manager' => true])


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
            document.getElementById("update_page_form").submit();
        }
    </script>
@endsection


@section('content')

    {!! Form::open([
          'method'              => 'PATCH',
          'route'               => ['admin::pages.update', $page->id],
          'role'                => 'form' ,
          'id'                  => 'update_page_form',
    ]) !!}

        <div class="col s10 offset-s1" style="background-color: whitesmoke;padding: 2em;">

            <div class="row">

                <div class="col s4">

                    @foreach ($languages as $language)

                        <div class="input-field col s12">
                            {!! Form::text("name[".$language->iso6391."]", $page->translation($language->iso6391)->name, [
                                'class'         => 'validate',
                                'required'	    => 'required',
                                'form'		    => 'update_page_form',
                                'placeholder'   => 'Sin título',
                            ]) !!}
                            {!! Form::label("name[".$language->iso6391."]", "Título:", [
                                'class' => 'input-label'
                            ]) !!}
                        </div>

                        <div class="input-field col s12">
                            {!! Form::text("slug[".$language->iso6391."]", $page->translation($language->iso6391)->slug, [
                                'class'         => 'validate',
                                'required'	    => 'required',
                                'form'		    => 'update_page_form',
                                'placeholder'   => 'untitled',
                                'length'        => 25,
                            ]) !!}
                            {!! Form::label("slug[".$language->iso6391."]", "Post URL:", [
                                'class' => 'input-label'
                            ]) !!}
                            <small>{{ env('URL_SITE') }}/{{$page->translation($language->iso6391)->slug}}</small>
                        </div>

                        <br><br>

                    @endforeach

                </div>

                <div class="col s4">

                    <div class="input-field col s12">
                        {{ Form::checkbox('header', true, $page->header, [
                            'class' => 'filled-in',
                            'id'    => 'header',
                            'form'	=> 'update_page_form',
                        ]) }}
                        {!! Form::label('header', 'Mostrar link en header:', [
                            'class' => 'input-label'
                        ]) !!}
                    </div>

                    <div class="input-field col s12">
                        {{ Form::checkbox('footer', true, $page->footer, [
                            'class' => 'filled-in',
                            'id'    => 'footer',
                            'form'	=> 'update_page_form',
                            ]) }}
                        {!! Form::label('footer', 'Mostrar link en footer:', [
                            'class' => 'input-label'
                        ]) !!}
                    </div>

                    <div class="input-field col s12">
                        {{ Form::checkbox('tblank', true, $page->tblank, [
                            'class' => 'filled-in',
                            'id'    => 'tblank',
                            'form'	=> 'update_page_form',
                            ]) }}
                        {!! Form::label('tblank', 'Abrir página en nueva pestaña:', [
                            'class' => 'input-label'
                        ]) !!}
                    </div>

                </div>

                <div class="col s4">

                    <div class="input-field col s12">
                        Estado:
                        {!! Form::select('publish_id', $publishes, $page->publish_id, [
        					'required'      => 'required',
        					'form'		    => 'update_page_form',
        				])  !!}
                    </div>

                    <div class="input-field col s12">
                        Orden:
                        {!! Form::text('order', $page->order, [
                            'class'         => 'validate',
                            'required'	    => 'required',
                            'form'		    => 'update_page_form',
                            'placeholder'   => '0',
                        ]) !!}
                    </div>

                    <div class="input-field col s12">
                        Superior:
                        {!! Form::select('page_id', $pages, $page->page_id, [
        					'form'         => 'update_page_form',
                            'placeholder'  => 'Ninguna',
        				])  !!}
                    </div>

                </div>

            </div>

        </div>

        <div class="col s10 offset-s1" style="padding-top: 40px;">

            @include($view)

        </div>


    {{ Form::close() }}

    @include('admin.media_manager.vue.single-image-template')
    @include('admin.media_manager.vue.mediaManager-template')

@endsection

@section('vue_templates')
@endsection

@section('vue_store')
	<script>
		mainVueStore.current_page = {!! $page !!};
        console.log(mainVueStore.current_page);
	</script>
@endsection
