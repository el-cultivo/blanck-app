@extends('layouts.client')

@section('content')

	<div class="home page">

		<div class="home__banner">
			<div class="home__banner--title">
				<img class="home__banner--title-img" src="{{ asset('images/home-banner-title.svg') }}">
				<br>
				<a class="home__banner--title-txt size_22" href="{{ route('client::show', 'boletos') }}">
					&iexcl;Aparta ya tus boletos!
				</a>
			</div>
		</div>

		<div class="wrap">

			<div class="home__subtitle">
				<p class="size_18">
					<b class="home__subtitle-bold">Festival Internacional de Arquitectura y Ciudad</b> &nbsp;
					<span class="home__subtitle-book">11&mdash;14 Marzo 2017 | CDMX</span>
				</p>
			</div>

			<style media="screen">

			</style>

			<div class="home__video-holder">
				<div class="home__video">
					<div class="home__video--wrapper">
						<iframe width="620" height="360" src="https://www.youtube.com/embed/kSqoRZ2hDRs?rel=0&amp;controls=0&amp;showinfo=0" frameborder="0" allowfullscreen autoplay></iframe>
					</div>
				</div>
			</div>

		</div>

		<div class="home__quote">
			<div class="home__quote--slider slider_JS">
				<div class="home__quote--slide size_36" style="background-image:url({{ asset('images/home-slide-01.jpg') }});">
					<b class="home__quote--slide-up">Vive</b> <br>
					<b class="home__quote--slide-down">La ciudad extraordinaria</b>
				</div>
				<div class="home__quote--slide size_36" style="background-image:url({{ asset('images/home-slide-02.jpg') }});">
					<b class="home__quote--slide-up">Construye</b> <br>
					<b class="home__quote--slide-down">La ciudad extraordinaria</b>
				</div>
				<div class="home__quote--slide size_36" style="background-image:url({{ asset('images/home-slide-03.jpg') }});">
					<b class="home__quote--slide-up">Piensa</b> <br>
					<b class="home__quote--slide-down">La ciudad extraordinaria</b>
				</div>
				<div class="home__quote--slide size_36" style="background-image:url({{ asset('images/home-slide-04.jpg') }});">
					<b class="home__quote--slide-up">Act&uacute;a</b> <br>
					<b class="home__quote--slide-down">La ciudad extraordinaria</b>
				</div>
			</div>

		</div>

	</div>

@endsection
