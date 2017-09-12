@if(env('APP_DEBUG') == true) 
    <script src="http://localhost:8080/functions.js"></script> 
    <script> 
        if (window.CLTVO_ENV !== 'webpack') { 
          	console.log('Estamos en desarollo y sin usar webpack'); 
            var s = document.createElement( 'script' ); 
            s.setAttribute( 'src', '{{asset('js/functions.js')}}' ); 
            document.body.appendChild( s ); 
        } 
    </script> 
@else 
    <script src="{{asset('js/functions.js')}}"></script> 
@endif 