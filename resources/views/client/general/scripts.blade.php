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
