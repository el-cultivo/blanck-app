<!DOCTYPE html>
<html  lang="{{ $current_lang_iso }}" >
    <head>
        <title>
			@if(View::hasSection('title'))
				@yield('title'):
			@else
				{{ config('app.name') }} by El cultivo
			@endif
		</title>
        <link href="https://fonts.googleapis.com/css?family=Lato:100, 500" rel="stylesheet" type="text/css">
        <style>
			html {
				height: 100%;
				width: 100%;
			}
			body {
				height: calc(100% - 16px) ;
				width: calc(100% - 8px) ;
				background-color: #215056;
				color: #000;
                display: table;
                font-weight: 100;
                font-family: 'Lato', sans-serif;
                
			}
			.container{
				text-align: center;
			    display: table-cell;
			    vertical-align: middle;
			    height: 100vh;
			}
			header{
				height: 100px;
			    width: 300px;
			    margin: 0px auto;
			    background-image: url(images/elcultivo.svg);
			    background-position: center;
			    background-repeat: no-repeat;
			    padding: 0px;
			    margin-bottom: 50px;
			}
			.splash {
				height: 500px;
				width: auto;
				object-fit: cover;
				margin: 0px auto;
				background-image: url("images/aboutus-portada.svg");
				background-position: center;
				background-repeat: no-repeat;

			}
			h2{
				font-weight: 100;
				font-size: 42px;
			}
			h2, h3{
				color: white;
				text-align: center;
				padding: 0px;
    			margin: 0px;
			}
			h3{
				font-size: 2em;
				margin-top: 15px;
				letter-spacing: 1px;
			}
			.splash__svg {
				z-index: 1;
			}
			.container {
				text-align: center;
				display: table-cell;
				vertical-align: middle;
				background-size: 90%;
			}
			.content {
				text-align: center;
				display: inline-block;
			}
			.title {
				font-size: 72px;
				margin-bottom: 40px;
			}
        </style>
    </head>
    <body>
    	<div class="container">
	    	<header></header>
			@yield('content')
			<section>
				<h2>Sitio web en construcción</h2>
				<h3>elcultivo.mx</h3>
			</section>
		</div>
    </body>
</html>
