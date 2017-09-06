<!DOCTYPE html>
<html class="splash">
    <head>
        <title>{{ config('app.name') }} by El cultivo</title>
        <link href="https://fonts.googleapis.com/css?family=Lato:100, 500" rel="stylesheet" type="text/css">

        <style>
			.splash {
				height: 100%;
				width: 100%;
				margin: 0px auto;
				background-image: url("images/logo.svg");
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

        </style>
    </head>
    <body>
		<footer class="splash__footer">
			<ul>

				<li>
					<a href="http://www.elcultivo.mx/" target="_blank">
					El cultivo
					</a>
				</li>
				<li>
					<a href="https://www.facebook.com/el.cultivo.mx" target="_blank">
					Facebook
					</a>
				</li>
				<li>
					<a href="https://twitter.com/el_cultivo" target="_blank">
					Twitter
					</a>

				</li>
				<li>
					<a href="https://www.instagram.com/el_cultivo/" target="_blank">
					Instagram
					</a>
				</li>

				<li>
					<a   href="https://www.google.com.mx/maps/place/Plaza+Grijalva+5,+Cuauht%C3%A9moc,+06500+Ciudad+de+M%C3%A9xico,+CDMX/@19.4339329,-99.1717392,17z/data=!3m1!4b1!4m5!3m4!1s0x85d1f8b50e6589ef:0xbde7084245778c26!8m2!3d19.4339329!4d-99.1695452">
					Plaza Grijalva 5, Cuauhtémoc, 06500 Ciudad de México, CDMX
					</a>
				</li>

			</ul>
		</footer>
    </body>
</html>
