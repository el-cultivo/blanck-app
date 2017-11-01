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
				width: calc(100% - 8px) ;
				background-color: #215056;
				color: #000;
                display: table;
                font-weight: 100;
                font-family: 'Lato', sans-serif;
                height: 100vh;
                overflow: hidden;
			}
			.container{
				text-align: center;
			    display: table-cell;
			    vertical-align: middle;
			}
			header{
				height: 25px;
    			width: 175px;
			    margin: 0px auto;
			    background-image: url(images/elcultivo.svg);
			    background-position: center;
			    background-repeat: no-repeat;
			    padding: 0px;
			    margin-bottom: 105px;
			}

			.splash {
				height: 278px;
    			width: 167px;
				object-fit: cover;
				margin: 0px auto;
				background-image: url("images/aboutus-portada.svg");
				background-position: center;
				background-repeat: no-repeat;

			}
			h2{
				font-weight: 100;
				font-size: 30px;
			}
			h2, h3{
				color: white;
				text-align: center;
				padding: 0px;
    			margin: 0px;
			}
			h3{
				font-size: 20px;
				margin-top: 10px;
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
	    	<header>
	    		
	    	</header>
			@yield('content')
			<section>

				<h2>sitio web en construcción</h2>
				<h3>elcultivo.mx</h3>

			</section>
		</div>
    </body>
</html>
