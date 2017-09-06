<head>
	<meta charset="UTF-8">
	<title>
		@if(View::hasSection('title'))
        	@yield('title'):
    	@endif

    	{{ env('APP_NAME') }}
	</title>

	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"/>

	<meta name="description" content="" />
	<meta name="keywords" content="" />
	<meta name="author" content="">

	<link href="{{ asset('css/mazorca.css') }}" rel="stylesheet" type="text/css" />

	{{-- Favicon --}}
	@include('general.favicon')

	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>

</head>
