<!DOCTYPE html>
<html lang="es">

	{{-- Head --}}
	@include('client.general.head')

	<body>
		@include('general._alerts')
		{{-- Analytics --}}
	    @include('client.general.analytics')

		{{-- Header --}}
		@include('client.general.header')

		<div class="main-wrap">

			@yield('content')

		</div>

		{{-- Footer --}}
		@include('client.general.footer')

		{{-- Scripts --}}
		@include('client.general.scripts')

	</body>

</html>
