<script>
var mainVueStore = {
    ajaxData: function(routes_obj) {
{{--/**
     * Predefine los campos necesarios para hacer un llamado get, y permite guardar otras rutas útiles para ajax.
     *
     * El objeto routes_obj debe verse de este modo:
     * 			 { get: '{{route('client::shop.ajax.index')}}'}
     * Esto permite introducir una ruta get cuya petición se hará automáticamente en el momento se crea la instancia del mainVue.
     * @param  {[type]} routes_obj 	debe determinar campos como get, post, etc. cuyo valor es una URL
     * @return {Object} 			Dos propiedades. La más importante es "data" el cual preinicializa dicho campo para recibir el resultado del get y funcionar reactivamente. El otro es el objeto de rutas que se le ha pasado a la función.
     */--}}
        return {
            data: undefined,
            routes: routes_obj
        }
    },
    {{--/*
    //route i.e.{{route('client::shop.ajax.index')}}
    */--}}
    get: function(route) {
        return this.ajaxData({get: route})
    },
	current_language: '{{$current_lang_iso}}',
	languages: '{!!json_encode($languages)!!}',
};
</script>

@yield('vue_store'){{-- debe estar antes del bundle --}}


@if(config("cltvo.dev_mode")) 
    <script src="http://localhost:8080/bundle.js"></script>
    <script>
        if (window.CLTVO_ENV !== 'webpack') {
          	console.log('Estamos en desarollo y sin usar webpack');
            var s = document.createElement( 'script' );
            s.setAttribute( 'src', '{{elixir("bundle.js")}}' );
            document.body.appendChild( s );
        }
    </script>
@else
	<script src="{{ elixir('bundle.js') }}"></script>
@endif
