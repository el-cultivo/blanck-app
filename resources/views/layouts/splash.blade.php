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
			header{
				height: 200px;
			    width: 300px;
			    object-fit: cover;
			    margin: 0px auto;
			    background-image: url(images/elcultivo.svg);
			    background-position: center;
			    background-repeat: no-repeat;
			    background-size: 80%;
			}

			.splash {
				height: 100%;
				width: 300px;
				object-fit: cover;
				margin: 0px auto;
				background-image: url("images/aboutus-portada.svg");
				background-position: center;
				background-repeat: no-repeat;
				background-size: 40%;
			}
			.splash__svg {
				z-index: 1;
			}
			.splash__footer {
				position: fixed;
				left: 0;
				bottom: 0;
				z-index: 2;
				min-width: 100%;
				display: -webkit-box;
				display: -webkit-flex;
				display: -ms-flexbox;
				display: flex;
				-webkit-box-pack: center;
				-webkit-justify-content: center;
				-ms-flex-pack: center;
				justify-content: center;
				padding-top: 2px;
				padding-bottom: 2px;
				padding-right: 20px;
				padding-left: 20px;
				text-align: center;
				box-sizing: border-box;
				background-color: whitesmoke;
			}
			.splash__footer ul {
				width: 100%;
			}
			.splash__footer ul li {
				margin-right: 30px;
				margin-left: 30px;
				text-align: center;
				line-height: 35px;
				font-weight: normal;
				display: inline-block;

				font-weight: bold;
			}
			.splash__footer ul li a {
				text-decoration: none;
				text-transform: uppercase;
				font-family: 'Lato';				
				height: 100%;
				width: 100%;
				font-weight: 500;
				font-size: 12px;
				color: #312822;
			}
			.splash__footer ul li a:hover {
				color: #EA7640;
				text-decoration: underline;
			}

			.splash__footer ul li:last-child {
				margin-right: 0px;
				margin-left: 0px;
				display: block;
			}

			.container {
				text-align: center;
				display: table-cell;
				vertical-align: middle;
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
    	<header>
    		
    	</header>
		@yield('content')
		<section>
			<h3>sitio web en construcción</h3>
		</section>
    </body>
</html>
