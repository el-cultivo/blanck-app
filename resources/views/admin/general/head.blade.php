<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

    <title>
		@if(View::hasSection('title'))
        	@yield('title') &lsaquo;
    	@endif

    	{!! trans('admin.layout.admin_title') !!} &ndash; {{ config( "app.name") }}
	</title>

	<!-- Fonts -->
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+" crossorigin="anonymous">

	{{-- Favicon --}}
	@include('general.favicon')

	<!-- Styles -->
	<link rel="stylesheet" href="{{ config("cltvo.version_assets") ?  elixir('admin-bundle.css') : asset('css/admin.css')}}"  type="text/css"  >

	<!-- include summernote css/js-->
	<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.1/summernote.css" rel="stylesheet" />
	{{-- <link rel="stylesheet" href="{{ asset('css/materialNote.css') }}"> --}}

	<!-- Scripts -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
</head>
